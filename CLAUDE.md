# CLAUDE.md — H.O.P.E. Enrollment System (Frontend Redesign Project)

## Project Overview
Laravel 11 + Blade + MySQL school enrollment management system for **M.B. Therapy Center**
("H.O.P.E." branding). Roles: Directress, Admin, Teacher, Staff (internal/admin side, all
sharing `resources/views/admin/**`), and Guardian (parent-facing portal,
`resources/views/portal/**`).

## ⚠️ CRITICAL RULE — READ FIRST
You are acting as a **Frontend Developer only**. This is a **visual redesign project** —
the backend (PHP logic, database, validation, permissions, routes) is already complete and
**must not be touched or broken**.

### DO NOT MODIFY, under any circumstance:
- PHP logic in `app/Http/Controllers/**`
- Models in `app/Models/**`
- Migrations, `routes/**`
- Any `name=""` form field attribute (Controllers read these via `$request->input()`)
- Any `id=""` that existing inline JS (`onchange`, `onclick`, `getElementById`) depends on
- `@if` / `@foreach` / `@php` conditional **logic** inside Blade files — this controls
  permissions, status, and data display. Restyle the *markup around it*, never the
  condition itself.
- Validation rules, `route()` calls, `action=""`, `method=""` values in `<form>` tags
- `@section` / `@yield` / `@extends` structure that other files depend on

### YOU MAY:
- Rewrite HTML structure/markup inside Blade files (as long as every `name=`/`id=`
  referenced by JS or a Controller stays exactly as-is)
- Replace Bootstrap 5 classes with Tabler's classes/structure
- Add new CSS/JS libraries via CDN `<script>`/`<link>` tags (no npm, no build step — this
  project has none)
- Fully restructure `resources/views/admin/layouts/app.blade.php` and
  `resources/views/portal/layouts/app.blade.php`
- Add new Blade partials for reusable UI pieces (stat cards, empty states, etc.)
- Swap icon sets, fonts, colors, spacing, shadows, animations — freely

**Before editing any Blade file:** scan it first for every `name=`, `id=`, and `route()`
call, and treat those as fixed anchors you must preserve through the redesign.

## Current Tech Stack
- Laravel 11, Blade, MySQL
- Bootstrap 5.3 via CDN → **being replaced by Tabler**
- Vanilla JS, no build tooling — everything loaded via CDN `<script>` tags
- `partials.camera-capture` and `partials.doc-multi-file` are shared JS partials already
  used across several forms — preserve their function names
  (`openCameraCapture`, `addDocFiles`, `lockDocSelect`, `unlockDocSelect`,
  `updateStatusOptions`, `refreshDocLockState`) since multiple pages call them.

## New Frontend Stack (CDN only — no npm/Vite)
| Library | Purpose |
|---|---|
| **Tabler** | Full replacement of Bootstrap as the UI framework |
| **Chart.js** | Dashboard analytics charts |
| **SweetAlert2** | Modern confirmation modals, success/error dialogs |
| **Toastr** | Lightweight toast notifications for quick non-blocking confirmations |
| **DataTables** | Searchable/sortable tables on index pages |
| **Flatpickr** | Modern date pickers (enrollment_date, birthdate, etc.) |
| **Select2** | Searchable dropdowns (student/guardian/role selects) |
| **Lucide Icons** | Replace Bootstrap Icons (`bi bi-*`) throughout |
| **unDraw / Storyset** | Embedded SVG illustrations — empty states, login page, 404 |
| **Animate.css** | Simple entrance/transition animations |
| **AOS** | Scroll-triggered animations |
| **Inputmask** | Phone number formatting (`09XXXXXXXXX`) |
| **Parsley.js** | Frontend validation — *supplements*, never replaces, server-side validation |

## Brand Identity (M.B. Therapy Center)
Based on the official Facebook cover/poster:
- **Primary Green** (deep forest green) — main brand color, sidebar, headers: `#1B4332`
- **Accent Gold** — CTAs, icon backgrounds, highlights: `#EAB308`
- **Cream background** — page background (not stark white): `#F5F1E8`
- **White** — card/content surfaces
- Logo: shield crest, four quadrants (puzzle piece, books, cross, leaf) — reuse the
  existing logo asset already in the project, don't recreate it
- Tagline: *"From Disabilities to Possibilities."* — style in italic serif with a small
  heart accent, matching the poster
- Typography: elegant serif display font for headings (e.g. **Playfair Display**, Google
  Fonts) + clean sans-serif body font (e.g. **Inter** or **Poppins**)
- Service icons in the poster use solid gold circles with dark green icon glyphs —
  consider this style for stat cards / quick action buttons

## Logo Assets (already in `public/`, do NOT recreate)
- `public/MB-LOGO.png`, `MB-LOGO-FULL.png`, `MB-LOGO-Simple.png`, `MB-LOGO.webp` — the
  **client's** official M.B. Therapy Center shield crest logo (green/white/yellow
  quadrants: puzzle piece, books, cross, leaf). Use this wherever the design calls for
  the *therapy center's* branding (e.g. the split-screen login branding panel, footer).
- `public/HOPE-LOGO.png` *(new — place the attached colorful "H.O.P.E." wordmark logo
  here before starting)* — this is the **system's own** logo (made by a groupmate),
  reading "H.O.P.E. — Holistic Online Profile and Enrollment System," with each letter
  in a different gradient color (green, lime/purple, yellow/teal, purple/orange) and a
  gold ribbon/wave accent above and below, "HOLISTIC ONLINE PROFILE AND ENROLLMENT
  SYSTEM" in green serif underneath. Use this for: the sidebar/topbar brand mark,
  browser favicon/title area, and the login page's branding panel alongside or above
  the MB-LOGO. Treat it as the primary "app identity" logo; MB-LOGO remains the
  "client/school identity" logo — both can appear together (e.g. HOPE logo as the
  system wordmark, MB-LOGO as a smaller "for M.B. Therapy Center" badge).

## Git Workflow
- Repo: `https://github.com/hez3012/FINAL-mb-center-enrollment-system`
- **Before making any changes**, create and switch to a new branch so the redesign can
  be compared against / reverted from the current working version:
  ```bash
  git checkout -b frontend-redesign
  ```
- Commit incrementally as you go (e.g. after the layout, after the dashboard, after
  each module) with clear messages — don't do one giant commit at the end.
- Do **not** push directly to `main`. When the redesign is complete and tested, the
  developer will review the `frontend-redesign` branch and merge it manually.

## Design Direction — Reference UI Style (IMPORTANT — read before redesigning)
The first redesign attempt did NOT match what's wanted. Study these reference patterns
(SaaS/fintech dashboard style — think Stripe, Linear, modern crypto/business dashboards)
and follow them closely:

- **Typography**: ONE consistent professional sans-serif font family throughout the
  entire app (e.g. **Inter**, **Plus Jakarta Sans**, or **Manrope** — pick one and use
  it everywhere, including headings). Do NOT mix multiple font families across
  different pages/sections. Text sizes should be confident and readable — avoid tiny
  text; stat numbers should be large and bold (e.g. 28–36px), labels small and muted.
- **Color contrast**: apply proper complementary color theory whenever text sits on a
  colored/gradient background — always check contrast (light text on dark backgrounds,
  dark text on light/pastel backgrounds). Never put low-contrast text on a busy
  gradient.
- **Gradients, not flat fills**: the brand green and gold should appear as **gradients**
  (e.g. `linear-gradient(135deg, #1B4332, #2D6A4F)` for green elements,
  `linear-gradient(135deg, #EAB308, #FBBF24)` for gold elements) — used on primary
  buttons, sidebar active states, key stat-card accents, header bars. Not everything
  needs a gradient — use it intentionally on 1–2 hero/primary elements per page, flat
  neutral colors (white/cream/light gray) elsewhere.
- **Stat cards**: clean white cards, soft shadow, rounded corners (~12–16px radius),
  icon in a colored rounded-square or circle badge, large bold number, small muted
  label below, optional small trend indicator (colored arrow + %). Keep generous
  padding — don't cram content.
- **Charts as supporting visuals inside cards**: circular/donut progress rings,
  small inline bar charts, and clean line/area charts (Chart.js) embedded inside their
  own card with a title and an overflow/options menu (three-dot icon) in the corner —
  mirroring a typical fintech/SaaS analytics dashboard.
- **Lists and tables**: clean rows with clear hierarchy (avatar/icon + primary text +
  secondary muted text on the left, status badge or value on the right), generous row
  height, subtle dividers (not heavy borders), hover state on rows, rounded badge
  pills for status (colored background + matching text color, not harsh saturated
  colors), pagination and filter controls styled consistently with the rest of the UI
  (not default browser-looking inputs).
- **Layout hierarchy — F-pattern / Z-pattern**: top area = page title + primary action
  button(s) aligned right; below that = a row of key stat cards; below that = the
  main content split into a wider "primary" card (chart, table, or list) and a
  narrower "secondary" sidebar-style card (recent activity, mini list, quick info) —
  this mirrors how the eye naturally scans left-to-right, top-to-bottom.
- **Forms**: clean grouped sections with clear labels above inputs (not inline/cramped),
  consistent input height and border-radius, focus states using the brand color,
  helper/error text directly below each field, generous spacing between field groups.
- **Overall feel**: spacious, confident, professional — closer to a business analytics
  dashboard than a generic admin template. Avoid visual clutter; let whitespace do
  the work.

## Full Scope (single session, redesign everything)

### Admin/Internal side (`resources/views/admin/**`)
Shared across Directress, Admin, Teacher, Staff:
- `layouts/app.blade.php` — sidebar + topbar
- Dashboard, Users, Guardians, Students, Enrollments, Audit Log, Profile Settings

### Guardian Portal (`resources/views/portal/**`)
- `layouts/app.blade.php`
- Dashboard, My Enrollments, My Activity, Profile Settings

### Auth (`resources/views/auth/**`)
- Login — **split-screen layout**: one side = branding panel (logo, school name, motto,
  brand colors, illustration), other side = the form
- Register (Guardian self-registration)
- Both: show/hide password (eye icon), password strength indicator, confirm-password
  match indicator, loading state on submit (spinner + disabled button)

## Dashboard Stat Cards — required elements
- Icon (Lucide)
- Trend percentage (e.g. ↑ 12% vs last month) — only if the underlying data supports a
  real comparison; don't fabricate numbers
- Soft shadow, rounded corners

## Dashboard Analytics — think like a Business/Data Analyst
Use Chart.js with **real data already available from existing Controllers** — do not
invent new backend queries. If a chart needs data not currently passed to the view,
**ask before adding anything to a Controller**. Suggested charts:
- Enrollment trend over time (line, by month/school year)
- Enrollment status breakdown (donut: Pending Review, Pending Payment, Enrolled,
  Rejected, Withdrawn)
- Service type distribution (bar: SpEd, Speech Therapy, OT, PT, Tutorial)
- Document submission completion rate (progress/gauge)
- **Respect existing role permissions** — Teacher/Staff dashboards must only show charts
  appropriate to what they're already allowed to see; never surface data a role
  currently can't access.

## Other UI requirements
- **Sidebar**: active-page indicator, hover effects, collapsible menu groups
- **Dashboard quick actions**: shortcut buttons (e.g. "Add Walk-in Enrollment", "Add
  Guardian") respecting existing permission checks
- **Empty states**: friendly illustration + message wherever a list/table can be empty
- **Footer**: system name + M.B. Therapy Center info, on both admin and portal layouts
- **Toast notifications**: replace plain `session('success')` text alerts with
  SweetAlert2/Toastr styled equivalents — same trigger conditions, nicer presentation

## Non-negotiables
1. Test after every major file change — confirm the page still loads with no Blade/PHP
   errors before moving on.
2. Every existing `name=""`, `id=""` used by JS or Controllers stays **exactly** as-is.
3. Never alter `@if(Auth::user()->hasPermission(...))` or similar permission conditions —
   only restyle what's inside them.
4. CDN-only — no npm install, no Vite/webpack (this project has no build step).
5. Briefly summarize what changed after each module before moving to the next.
