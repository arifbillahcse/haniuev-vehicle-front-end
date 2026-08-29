/* ==========================================================================
   HANIU — interactions & animation
   Vanilla JS, no dependencies.
   ========================================================================== */
(function () {
  'use strict';

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var mqDesktop = window.matchMedia('(min-width: 961px)');

  function $(sel, ctx) { return (ctx || document).querySelector(sel); }
  function $$(sel, ctx) { return Array.prototype.slice.call((ctx || document).querySelectorAll(sel)); }

  /* ------------------------------------------------------------------
     1. HEADER — sticky state, hide-on-scroll-down, scroll progress
     ------------------------------------------------------------------ */
  function initHeader() {
    var header = $('#siteHeader');
    var progress = $('#headerProgress');
    if (!header) return;

    var lastY = window.pageYOffset;
    var ticking = false;

    function update() {
      var y = window.pageYOffset;

      header.classList.toggle('is-scrolled', y > 30);

      // Hide when scrolling down past the hero, reveal on scroll up.
      // Never hide while the mobile drawer is open.
      var drawerOpen = document.body.classList.contains('is-locked');
      if (!drawerOpen && y > 400 && y > lastY + 4) {
        header.classList.add('is-hidden');
        closeAllDropdowns();
      } else if (y < lastY - 4 || y <= 400) {
        header.classList.remove('is-hidden');
      }

      if (progress) {
        var max = document.documentElement.scrollHeight - window.innerHeight;
        progress.style.setProperty('--p', max > 0 ? (y / max).toFixed(4) : 0);
      }

      lastY = y;
      ticking = false;
    }

    window.addEventListener('scroll', function () {
      if (!ticking) { window.requestAnimationFrame(update); ticking = true; }
    }, { passive: true });

    update();
  }

  /* ------------------------------------------------------------------
     2. DROPDOWN MENUS — hover on desktop (with intent delay), tap on mobile
     ------------------------------------------------------------------ */
  var dropdownItems = [];

  function closeAllDropdowns(except) {
    dropdownItems.forEach(function (item) {
      if (item === except) return;
      item.classList.remove('is-open');
      var btn = $('.nav__toggle', item);
      if (btn) btn.setAttribute('aria-expanded', 'false');
    });
  }

  function initDropdowns() {
    dropdownItems = $$('.nav__item.has-dropdown');

    dropdownItems.forEach(function (item) {
      var btn = $('.nav__toggle', item);
      var closeTimer;

      function open() {
        window.clearTimeout(closeTimer);
        closeAllDropdowns(item);
        item.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
      }
      function close() {
        item.classList.remove('is-open');
        btn.setAttribute('aria-expanded', 'false');
      }
      function scheduleClose() {
        closeTimer = window.setTimeout(close, 140);
      }

      // Desktop: hover intent
      item.addEventListener('mouseenter', function () {
        if (mqDesktop.matches) open();
      });
      item.addEventListener('mouseleave', function () {
        if (mqDesktop.matches) scheduleClose();
      });

      // Click / tap works on every breakpoint (and for keyboard users)
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        item.classList.contains('is-open') ? close() : open();
      });

      // Keyboard: escape closes and returns focus
      item.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && item.classList.contains('is-open')) {
          close();
          btn.focus();
        }
      });
    });

    // Click outside closes
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.nav__item.has-dropdown')) closeAllDropdowns();
    });
  }

  /* ------------------------------------------------------------------
     3. MOBILE DRAWER
     ------------------------------------------------------------------ */
  function initMobileNav() {
    var burger = $('#burger');
    var nav = $('#primaryNav');
    var scrim = $('#navScrim');
    if (!burger || !nav) return;

    function setOpen(open) {
      burger.classList.toggle('is-active', open);
      nav.classList.toggle('is-open', open);
      if (scrim) scrim.classList.toggle('is-active', open);
      document.body.classList.toggle('is-locked', open);
      burger.setAttribute('aria-expanded', String(open));
      burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      if (!open) closeAllDropdowns();
    }

    burger.addEventListener('click', function () {
      setOpen(!nav.classList.contains('is-open'));
    });

    if (scrim) scrim.addEventListener('click', function () { setOpen(false); });

    // Any real link inside the drawer closes it
    $$('.nav__link:not(.nav__toggle), .dropdown a, .nav__item--cta a', nav).forEach(function (a) {
      a.addEventListener('click', function () {
        if (!mqDesktop.matches) setOpen(false);
      });
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && nav.classList.contains('is-open')) setOpen(false);
    });

    // Reset state when crossing the desktop breakpoint
    var onChange = function () { if (mqDesktop.matches) setOpen(false); };
    mqDesktop.addEventListener ? mqDesktop.addEventListener('change', onChange)
                               : mqDesktop.addListener(onChange);
  }

  /* ------------------------------------------------------------------
     4. SCROLL REVEAL
     ------------------------------------------------------------------ */
  function initReveal() {
    var items = $$('[data-reveal]');
    if (!items.length) return;

    if (reduceMotion || !('IntersectionObserver' in window)) {
      items.forEach(function (el) { el.classList.add('is-visible'); });
      return;
    }

    items.forEach(function (el) {
      var d = el.getAttribute('data-reveal-delay');
      if (d) el.style.setProperty('--d', d + 'ms');
    });

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        io.unobserve(entry.target);
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });

    items.forEach(function (el) { io.observe(el); });
  }

  /* ------------------------------------------------------------------
     5. COUNT-UP STATS
     ------------------------------------------------------------------ */
  function initCounters() {
    var nodes = $$('[data-count]');
    if (!nodes.length) return;

    function format(value, el) {
      var suffix = el.getAttribute('data-suffix') || '';
      var out = el.getAttribute('data-format') === 'comma'
        ? value.toLocaleString('en-US')
        : String(value);
      return out + suffix;
    }

    function run(el) {
      var target = parseInt(el.getAttribute('data-count'), 10) || 0;
      if (reduceMotion) { el.textContent = format(target, el); return; }

      var duration = 1600;
      var start = null;

      function step(ts) {
        if (start === null) start = ts;
        var p = Math.min((ts - start) / duration, 1);
        // easeOutExpo
        var eased = p === 1 ? 1 : 1 - Math.pow(2, -10 * p);
        el.textContent = format(Math.round(target * eased), el);
        if (p < 1) window.requestAnimationFrame(step);
      }
      window.requestAnimationFrame(step);
    }

    if (!('IntersectionObserver' in window)) {
      nodes.forEach(run);
      return;
    }

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        run(entry.target);
        io.unobserve(entry.target);
      });
    }, { threshold: 0.5 });

    nodes.forEach(function (el) { io.observe(el); });
  }

  /* ------------------------------------------------------------------
     6. HERO PARALLAX
     ------------------------------------------------------------------ */
  function initParallax() {
    var bg = $('#heroBg');
    if (!bg || reduceMotion) return;

    var ticking = false;
    function update() {
      var y = window.pageYOffset;
      if (y < window.innerHeight * 1.2) {
        bg.style.transform = 'translate3d(0,' + (y * 0.22).toFixed(1) + 'px,0)';
      }
      ticking = false;
    }
    window.addEventListener('scroll', function () {
      if (!ticking) { window.requestAnimationFrame(update); ticking = true; }
    }, { passive: true });
  }

  /* ------------------------------------------------------------------
     7. SMOOTH ANCHOR SCROLL (header-offset aware)
     ------------------------------------------------------------------ */
  function initSmoothScroll() {
    document.addEventListener('click', function (e) {
      var link = e.target.closest('a[href^="#"]');
      if (!link) return;

      var hash = link.getAttribute('href');
      if (!hash || hash === '#' || hash.length < 2) return;

      var target = document.getElementById(hash.slice(1));
      if (!target) return;

      e.preventDefault();
      var header = $('#siteHeader');
      var offset = header ? header.offsetHeight : 0;
      var top = target.getBoundingClientRect().top + window.pageYOffset - offset + 1;

      window.scrollTo({ top: top, behavior: reduceMotion ? 'auto' : 'smooth' });
    });
  }

  /* ------------------------------------------------------------------
     8. BACK TO TOP
     ------------------------------------------------------------------ */
  function initToTop() {
    var btn = $('#toTop');
    if (!btn) return;

    var ticking = false;
    function update() {
      btn.classList.toggle('is-shown', window.pageYOffset > 700);
      ticking = false;
    }
    window.addEventListener('scroll', function () {
      if (!ticking) { window.requestAnimationFrame(update); ticking = true; }
    }, { passive: true });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
    });
  }

  /* ------------------------------------------------------------------
     9. IMAGE PLACEHOLDER FALLBACK
     Marks the wrapper when the source file is missing so the CSS
     placeholder (with its data-label) shows instead of a broken icon.
     ------------------------------------------------------------------ */
  function initImageFallback() {
    $$('.media img').forEach(function (img) {
      function fail() {
        var wrap = img.closest('.media');
        if (wrap) wrap.classList.add('is-empty');
      }
      img.addEventListener('error', fail);
      // Already failed before the listener attached
      if (img.complete && img.naturalWidth === 0) fail();
    });
  }

  /* ------------------------------------------------------------------
     10. INQUIRY FORM — validation + submit feedback
     ------------------------------------------------------------------ */
  function initForm() {
    var form = $('#inquiryForm');
    if (!form) return;

    var status = $('#formStatus');
    var submit = $('#submitBtn');

    function setError(field, message) {
      var wrap = field.closest('.field');
      if (!wrap) return;
      wrap.classList.add('has-error');
      var err = $('.field__err', wrap);
      if (err) err.textContent = message;
    }
    function clearError(field) {
      var wrap = field.closest('.field');
      if (!wrap) return;
      wrap.classList.remove('has-error');
      var err = $('.field__err', wrap);
      if (err) err.textContent = '';
    }

    function validate() {
      var ok = true;
      var required = $$('[required]', form);

      required.forEach(function (field) {
        clearError(field);
        var value = field.value.trim();

        if (!value) {
          setError(field, 'This field is required.');
          ok = false;
          return;
        }
        if (field.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(value)) {
          setError(field, 'Please enter a valid email address.');
          ok = false;
        }
      });

      return ok;
    }

    // Clear the error as soon as the user starts fixing it
    $$('[required]', form).forEach(function (field) {
      field.addEventListener('input', function () { clearError(field); });
    });

    // Client-side validation only gates the submit; a real POST to this
    // same PHP page does the actual save (see includes/inquiry-handler.php).
    // Only block the browser's default submit when validation fails.
    form.addEventListener('submit', function (e) {
      if (!validate()) {
        e.preventDefault();
        var firstBad = $('.field.has-error input, .field.has-error textarea', form);
        if (firstBad) firstBad.focus();
        return;
      }
      if (submit) submit.classList.add('is-loading');
    });
  }

  /* ------------------------------------------------------------------
     11. PRODUCT GALLERY
     Clicking a thumbnail on a product detail page swaps the main image.
     No-ops on any page without a .product-gallery.
     ------------------------------------------------------------------ */
  function initProductGallery() {
    var main = $('#productMainImg');
    var thumbs = $$('.product-gallery__thumb');
    if (!main || !thumbs.length) return;

    thumbs.forEach(function (thumb) {
      thumb.addEventListener('click', function () {
        var src = thumb.getAttribute('data-img');
        if (!src) return;
        main.src = src;
        main.closest('.media').classList.remove('is-empty');
        thumbs.forEach(function (t) { t.classList.remove('is-active'); });
        thumb.classList.add('is-active');
      });
    });
  }

  /* ------------------------------------------------------------------
     12. CERTIFICATE GALLERY LIGHTBOX
     Clicking a certificate opens it full-size in a modal overlay.
     No-ops on any page without a .cert-gallery.
     ------------------------------------------------------------------ */
  function initCertGallery() {
    var items = $$('.cert-gallery__item');
    var modal = $('#certModal');
    if (!items.length || !modal) return;

    var modalImg = $('#certModalImg', modal);
    var modalCaption = $('#certModalCaption', modal);
    var closeBtn = $('#certModalClose', modal);

    function open(item) {
      modalImg.src = item.getAttribute('data-full') || '';
      modalCaption.textContent = item.getAttribute('data-name') || '';
      modal.hidden = false;
      document.body.style.overflow = 'hidden';
    }
    function close() {
      modal.hidden = true;
      document.body.style.overflow = '';
    }

    items.forEach(function (item) {
      item.addEventListener('click', function () { open(item); });
    });
    closeBtn.addEventListener('click', close);
    modal.addEventListener('click', function (e) { if (e.target === modal) close(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !modal.hidden) close(); });
  }

  /* ------------------------------------------------------------------
     13. FOOTER YEAR
     ------------------------------------------------------------------ */
  function initYear() {
    var el = $('#year');
    if (el) el.textContent = new Date().getFullYear();
  }

  /* ------------------------------------------------------------------
     BOOT
     ------------------------------------------------------------------ */
  function init() {
    initHeader();
    initDropdowns();
    initMobileNav();
    initReveal();
    initCounters();
    initParallax();
    initSmoothScroll();
    initToTop();
    initImageFallback();
    initProductGallery();
    initCertGallery();
    initForm();
    initYear();
  }

  document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', init)
    : init();
})();
