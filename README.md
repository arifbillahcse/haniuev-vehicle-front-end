# HANIU EV — Website + Admin

Raw PHP site for HANIU, a China-based B2B electric vehicle manufacturer (e-tricycles,
e-bicycles, e-motorcycles, four-wheelers). No framework — plain PHP with a PDO/MySQL
database, chosen so it deploys on virtually any budget PHP host (no Composer, no SSH).
Vehicles, parts, and blog posts are managed through a small login-gated admin dashboard
at `/admin`.

## Running it locally

Requires PHP 8.1+ with `pdo_mysql`, and a MySQL/MariaDB database already created (this app
creates the tables inside it, but not the database itself).

1. Copy `db-config.sample.php` to `db-config.php` and fill in your host, database name,
   username, and password.
2. Start PHP:
   ```bash
   php -S localhost:8000
   # → http://localhost:8000
   ```

Tables and seed data (sample products, blog posts, and one admin login) are created
automatically from `schema.sql` the first time any page runs against an empty database.
`db-config.php` is gitignored, so real credentials never get committed — only the
`db-config.sample.php` template is. If your host disables multi-statement queries and the
auto-bootstrap doesn't run, just import `schema.sql` once yourself through phpMyAdmin (or
`mysql -u user -p dbname < schema.sql`) — everything else works the same either way.

**Default admin login:** `admin` / `ChangeMe123!` at `/admin/login.php` — change it from the
dashboard immediately after first login.

## Structure

```
index.php, about-us.php,        Public pages. Each is: config.php → header.php →
  contact.php, blog.php,        page content → footer.php.
  post.php, electric-bicycles.php,
  motors-controllers.php
config.php                      PDO/MySQL connection, schema auto-bootstrap, db_all/db_one/
                                 db_run helpers, h()/slugify()/unique_slug() helpers
db-config.sample.php            Template for db-config.php (gitignored) — your real MySQL
                                 host/name/user/password
schema.sql                      Table definitions + seed data (MySQL)
includes/header.php             <head>, SVG icon sprite, nav — shared by every public page
includes/footer.php             Footer + closing tags — shared by every public page
includes/auth.php               require_admin() / attempt_login() / logout()
includes/inquiry-handler.php    Server-side validation + save for the contact form
includes/inquiry-fields.php     The Full Name/Company/Email/Country/Message fields, shared
                                 by every page's #inquiryForm (light and About's dark variant)
includes/product-card.php       Renders one .prod card from a products row
includes/post-card.php          Renders one .prod card from a posts row (same component)
includes/category-template.php Hero + product grid for a single category — electric-bicycles.php
                                 and motors-controllers.php are ~15-line wrappers around this
admin/                          Login-gated dashboard — see "Admin dashboard" below
assets/css/style.css            Design tokens + everything shared (header, footer, buttons,
                                 forms, page hero, contact-detail rows, product cards, prose)
assets/css/about.css            Only what the About page adds; loads after style.css
assets/css/contact.css          Only what the Contact page adds; loads after style.css
assets/js/main.js               Header, menus, scroll reveal, counters, form — every page
assets/images/                  Drop your photography here (see below)
```

All pages share one header, footer, and script via PHP `require`, so the SVG icon sprite and
nav now live in exactly one place (`includes/header.php`) instead of being hand-duplicated
across files.

`electric-bicycles.php` and `motors-controllers.php` are thin wrappers that set a category
slug (or array of slugs) and hero copy, then `require includes/category-template.php`, which
queries `products` and renders the same `.prod-grid` the homepage's "Popular Models" uses. To
add another category page (tricycles, four-wheelers, batteries, ...), copy one of those two
files and change three variables — no new template, no new CSS.

A component gets promoted from a page's own stylesheet into the shared `style.css` the
moment a second page needs it — that's how the page hero (`.page-hero`, `.pill`,
`.hero-stats`) and the contact-detail rows (`.contact-rows`) ended up shared rather than
duplicated. Follow the same rule for anything new.

## Admin dashboard

Everything under `/admin` requires login (`includes/auth.php`'s `require_admin()`, checked
at the top of every page except `login.php`).

| Page | Does |
| --- | --- |
| `admin/index.php` | Dashboard: counts, quick links, change-password form |
| `admin/products.php` | List/add/edit/delete vehicles and parts (feeds the homepage grid + category pages) |
| `admin/posts.php` | List/add/edit/delete blog posts (feeds `blog.php` / `post.php`) |
| `admin/messages.php` | Read/delete contact-form inquiries; visiting the inbox marks them read |

Each list+form page is one file using `$_GET['action']` (`list` / `new` / `edit`) and a
POST-redirect-GET pattern on save, so there's no separate "form" file to keep in sync with
the "list" file. Product/post images are entered as a filename (upload the file to
`assets/images/` yourself, then type its name) rather than a file-upload widget — deliberately
kept simple, and consistent with the placeholder-on-missing-image behavior the public site
already has everywhere else.

**To add a new category** (e.g. "Batteries & Chargers"): add its slug to the `CATEGORIES`
array at the top of `admin/products.php`, then create products in that category from the
dashboard — no database migration needed, `products.category` is a plain text column.

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

Motors & Controllers page:

| File | Used for | Suggested size |
| --- | --- | --- |
| `motor-hub500.jpg` `motor-middrive800.jpg` `motor-cargo1500.jpg` `controller-350.jpg` `controller-1000.jpg` `controller-smart500.jpg` | Model cards | 600×400 |

Blog (seed posts reference these; also settable per-post from `admin/posts.php`):

| File | Used for | Suggested size |
| --- | --- | --- |
| `blog-eec-certification.jpg` `blog-wuxi-powertrain.jpg` `blog-moq-guide.jpg` | Post cover images | 1200×800 |

New products/posts added from the admin dashboard follow the same convention: upload the
image to `assets/images/` via FTP, then type its filename into the product/post form.

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

Home, About, and Contact each carry an `#inquiryForm` — light on Home and Contact, a
translucent dark variant (`.field--dark`) on About — built from the shared
`includes/inquiry-fields.php` partial. Submission is a real HTTP POST (not JavaScript): `main.js`
only blocks the browser's default submit when client-side validation fails; a valid submit goes
through normally to `includes/inquiry-handler.php`, which re-validates server-side (never trust
the client), saves the row to the `messages` table, and re-renders the page with a server-side
success banner and the form cleared. Every inquiry is readable in `admin/messages.php`.

## Browser support

Modern evergreen browsers. Uses `IntersectionObserver`, CSS custom properties, `aspect-ratio`,
`backdrop-filter` and SVG sprite `<use href>`; all degrade gracefully — the reveal animations
fall back to visible content if `IntersectionObserver` is missing.

## Security notes

- **Passwords** are hashed with `password_hash()` (bcrypt) — never stored or compared in
  plain text.
- **SQL** is 100% parameterized through `db_all`/`db_one`/`db_run` (PDO prepared statements)
  — no string-concatenated queries anywhere, including in the admin forms.
- **`db-config.php`** holds your real database password in plain text — it's gitignored so it
  never reaches GitHub, and it lives outside `assets/` so nothing links to it publicly. Still,
  don't set the file world-readable on a shared host.
- **CSRF protection is intentionally omitted** to keep the admin small, on the judgment that a
  single low-privilege internal user is a low target. If that changes (multiple admin accounts,
  more sensitive actions), add a token check before mutating requests in `admin/*.php`.
- Product/post images are entered as filenames, not uploaded through a form — there is no
  file-upload code to secure because there is no file upload.

## Notes on the reference

Two things in the source design were staging artifacts rather than deliberate choices, and
were handled rather than copied:

- The "Global Reach" map was a broken image with country labels floating on grey. It is now a
  real dotted world map in inline SVG with the same labelled pills, repositioned so they no
  longer collide.
- Contact details (`+86 000 0000 0000`, `export@haniu.com`) are placeholders carried over from
  the reference. Replace them in the footer and in the `mailto:` / `tel:` links.
