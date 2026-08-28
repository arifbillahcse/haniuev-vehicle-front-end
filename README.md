# HANIU EV — Front End

Static front end for HANIU, a China-based B2B electric vehicle manufacturer (e-tricycles,
e-bicycles, e-motorcycles, four-wheelers). Built from the reference design as plain
HTML / CSS / JavaScript — no build step, no framework, no dependencies.

## Running it

Open `index.html` directly, or serve the folder:

```bash
python3 -m http.server 8000
# → http://localhost:8000
```

## Structure

```
index.html                Home page
about-us.html             About page
contact.html              Contact page
electric-bicycles.html    Electric Bicycles category page
assets/css/style.css      Design tokens + everything shared (header, footer, buttons, forms,
                           the compact page hero, contact-detail rows, product cards)
assets/css/about.css      Only what the About page adds; loads after style.css
assets/css/contact.css    Only what the Contact page adds; loads after style.css
assets/js/main.js         Header, menus, scroll reveal, counters, form — drives every page
assets/images/            Drop your photography here (see below)
```

All pages share one header, footer and script. The SVG icon sprite is inlined at the
top of each HTML file — Chrome does not support external `<use href="sprite.svg#id">`
references, so the sprite is duplicated rather than linked. **Keep every
`<svg class="svg-sprite">` block identical** when adding an icon.

`electric-bicycles.html` needed no new CSS at all — it's just the shared page hero plus the
same `.prod-grid`/`.prod` card component the homepage's "Popular Models" section already
uses. That's the pattern for any other single-category page (tricycles, motorcycles,
four-wheelers): reuse `.prod-grid`, don't invent a new card.

A component gets promoted from a page's own stylesheet into the shared `style.css` the
moment a second page needs it — that's how the page hero (`.page-hero`, `.pill`,
`.hero-stats`) and the contact-detail rows (`.contact-rows`) ended up shared rather than
duplicated. If you add a fourth page that reuses something from `about.css` or
`contact.css`, move it to `style.css` the same way rather than copying it.

## Adding images

Every image slot points at a file in `assets/images/`. Until a file exists, a labelled
placeholder renders in its place, so the layout never breaks and you can see exactly what
is still missing.

| File | Used for | Suggested size |
| --- | --- | --- |
| `home-hero.jpg` | Hero background | 1920×1080 |
| `hq-aerial.jpg` | Brand positioning — aerial HQ | 1200×675 |
| `factory-floor.jpg` | Factory strength — assembly hall | 1200×900 |
| `oem-team.jpg` | OEM/ODM — engineering team | 800×800 (square, shown circular) |
| `quality-lab.jpg` | Quality commitment | 800×600 |
| `cat-tricycle.jpg` `cat-bicycle.jpg` `cat-motorcycle.jpg` `cat-fourwheeler.jpg` | Category cards | 600×800 (portrait) |
| `model-m800.jpg` `model-t500.jpg` `model-b200.jpg` `model-q400.jpg` `model-m600.jpg` `model-t300.jpg` | Product cards | 600×400 |

About page:

| File | Used for | Suggested size |
| --- | --- | --- |
| `about-hero.jpg` | Page hero background | 1920×900 |
| `story-hq.jpg` | Our Story collage — HQ building | 600×750 |
| `story-design.jpg` | Our Story collage — design desk | 600×450 |
| `story-welding.jpg` | Our Story collage — frame welding | 600×450 |
| `story-electronics.jpg` | Our Story collage — controller board | 600×750 |
| `retail-store.jpg` | Domestic strength — retail store | 900×600 |
| `team-banner.jpg` | Factory scale — team banner | 1600×600 |
| `rd-lab.jpg` | R&D Center | 800×600 |

Contact page:

| File | Used for | Suggested size |
| --- | --- | --- |
| `contact-map.jpg` | Find-us panel — location map | 600×400 |

Electric Bicycles page:

| File | Used for | Suggested size |
| --- | --- | --- |
| `bike-urban.jpg` `bike-commuter.jpg` `bike-sport.jpg` `bike-city.jpg` `bike-cargo.jpg` `bike-folding.jpg` | Model cards | 600×400 |

## Design system

Tokens live at the top of `style.css` under `:root`.

**Colour** — deep navy (`--navy-900` `#0c1a2c`) for the header, footer and alternating trust
sections; a single saturated crimson (`--red` `#da1a2d`) reserved for CTAs, badges, checks and
accents; white and a light warm grey (`--bg-alt` `#f5f7fa`) for the remaining sections. Keeping
red out of body copy is what lets it carry weight everywhere it does appear.

**Type** — Oswald (condensed, industrial) for every heading and button; Inter for body copy.
Both load from Google Fonts in `<head>`. To self-host, drop the woff2 files in
`assets/fonts/`, replace the `<link>` with `@font-face` rules, and leave the
`--font-display` / `--font-body` tokens as they are.

**Rhythm** — section backgrounds alternate white → light grey → navy so the page has a pulse
as you scroll, with no dividers needed. Dark sections carry a faint blueprint grid
(`.grid-texture`) that reinforces the engineering tone without competing for attention.

## Animation

Everything is CSS transitions plus `IntersectionObserver` — no animation library.

**Header**
- Sticky; gains a blur, darker background and shadow past 30px
- Slides out of the way on scroll-down past 400px, returns instantly on scroll-up
- Red scroll-progress bar along the bottom edge
- Nav links: red underline wipes in from the left
- Dropdowns: fade + rise, with the items staggering in behind it; caret rotates 180°
- Desktop opens on hover with a 140ms close delay so diagonal mouse travel doesn't drop the
  menu; click and keyboard both work too, and Escape closes and restores focus
- Mobile: hamburger morphs to an X, drawer slides in from the right over a blurred scrim,
  links stagger in, dropdowns become inline accordions

**Footer**
- Columns fade up in sequence
- Links slide right with their chevron; social icons lift as red wipes up from below
- Certification chips lift and glow on hover
- Factory-highlight figures count up when the footer enters view
- Legal links get an underline that wipes in

**Page**
- Sections and grid items fade up on entry, staggered via `data-reveal-delay`
- Every statistic counts up on first view (eased, 1.6s)
- Hero background moves at 0.22× scroll for depth
- Cards lift; product and category images scale inside their frame; arrows slide
- Back-to-top button appears past 700px

All of it is disabled under `prefers-reduced-motion: reduce`.

## Form

All three pages carry an `#inquiryForm` — light on Home and Contact, a translucent dark
variant (`.field--dark`) on the About page. The same handler validates required fields and
email format on the client, marks bad fields, and shows a success message. It does **not**
submit anywhere — wire the block marked `Front-end only:` in `main.js` to your endpoint.

## Browser support

Modern evergreen browsers. Uses `IntersectionObserver`, CSS custom properties, `aspect-ratio`,
`backdrop-filter` and SVG sprite `<use href>`; all degrade gracefully — the reveal animations
fall back to visible content if `IntersectionObserver` is missing.

## Notes on the reference

Two things in the source design were staging artifacts rather than deliberate choices, and
were handled rather than copied:

- The "Global Reach" map was a broken image with country labels floating on grey. It is now a
  real dotted world map in inline SVG with the same labelled pills, repositioned so they no
  longer collide.
- Contact details (`+86 000 0000 0000`, `export@haniu.com`) are placeholders carried over from
  the reference. Replace them in the footer and in the `mailto:` / `tel:` links.
