# WCCF CMS — Church & Charity Website

A full-featured content management system built with Laravel for the **West Nile Christian Community Fellowship (WCCF)**. Features a drag-and-drop page builder, blog system, media library, admin dashboard with analytics, and a dynamic public-facing site.

## Tech Stack

- **Backend**: Laravel 13, PHP 8.3, MySQL/PostgreSQL
- **Frontend**: Tailwind CSS v4, Livewire v4, Flux UI v2
- **Auth**: Laravel Fortify (login, 2FA, passkeys)
- **Editor**: Quill v2 Rich Text Editor
- **Drag & Drop**: SortableJS

## Features

### Public Site (5 pages)
- Home, Who We Are, What We Do, Get Involved, Donate
- Dynamic page rendering via `Route::fallback()` — any slug auto-resolves
- Blog at `/news` with paginated listing and single-post pages
- Navigation from admin-managed menus

### Admin Panel (`/admin/*`)
- **Dashboard** — stat cards (users, pages, blog, media, views, activity), recent activity timeline, top pages, recent users, active sessions
- **Page Builder** — drag-and-drop sections with live canvas preview and fixed editor sidebar
  - 12 section types: Hero Banner, Hero Slider, Text Block, Image, Gallery (masonry), Video (YouTube/Upload), Stats Bar, Call to Action, Core Values, Two Columns, Vision & Mission, Recent Posts
  - Per-section form fields (no JSON editing)
  - Media browser for image/video selection
  - Heading toolbar: highlight last word, clear formatting
  - Dark mode UI
- **Blog** — CRUD with Quill editor, categories, featured images (media browser), auto-slug, publish toggle
- **Media Library** — upload, browse, delete images/videos (mp4/webm/ogg up to 100MB)
- **Menus** — hierarchical menu management with route/URL linking
- **Theme Settings** — customizable site options
- **Activity Logging** — all admin actions tracked
- **Page View Tracking** — middleware-based visitor analytics

### Section Types in Builder
| Type | Description |
|------|-------------|
| Hero Banner | Full-width banner with image, overlay, CTA buttons |
| Hero Slider | Multi-slide carousel with Ken Burns effect, badges, buttons |
| Text Block | Rich heading + content |
| Image | Single image with optional caption |
| Gallery | 4-column masonry grid with hover overlay |
| Video | YouTube URL or uploaded MP4 |
| Stats Bar | Grid of value/label statistics |
| Call to Action | Themed CTA card (navy/primary) |
| Core Values | List of values with icons |
| Two Columns | Side-by-side heading + content |
| Vision & Mission | Dual card layout with gradient accents |
| Recent Posts | Auto-populated blog post grid |

## Getting Started

```bash
# Clone & install
git clone <repo> wccf
cd wccf
composer install
npm install

# Environment
cp .env.example .env
php artisan key:generate

# Configure database in .env, then:
php artisan migrate --seed

# Build assets
npm run build

# Start development
php artisan serve
# In another terminal:
npm run dev
```

**Admin login**: Navigate to `/login` and sign in with a user that has `is_admin = true`. The seeder creates one automatically.

## Default Sections

Each of the 5 pages comes pre-seeded with rich content:

- **Home**: Hero Slider (3 slides), Stats Bar, Vision & Mission, Video, Two Columns, Gallery (12 photos), Core Values, Recent Posts, CTA
- **Who We Are**: Hero, Text Block (Our Story), Core Values
- **What We Do**: Hero, Text Block (Ministries)
- **Get Involved**: Hero, Text Block (Ways to Serve)
- **Donate**: Hero, Text Block (Ways to Give)

## Design

- **Primary Color**: `#560534` (dark maroon)
- **Accent**: Navy (`#0f1b2d`)
- **Fonts**: Rubik (headings), Lato (body)
- **Full dark mode support** in admin

## Seed Data

```bash
php artisan db:seed --class=CmsSeeder
```

Creates admin user, 5 pages with full content, sample menu with items, and theme defaults.

## Scripts

```bash
npm run dev          # Vite development
npm run build        # Production build
php artisan serve    # Laravel dev server
composer run lint    # PHP lint (Pint)
composer run test    # Run tests
```
