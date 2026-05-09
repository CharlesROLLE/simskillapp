# Sim Skill App

A premium flight simulation skill training platform built with Laravel 12. Browse high-skill approach procedures for FS2024, FS2020, and X-Plane 12, share your experiences via the blog, and explore VR tools and configurations — all with a modern, reactive interface.

## Features

- **Approaches** — Curated collection of challenging landing procedures for popular flight simulators
- **Blog** — Share experiences, approaches, and tips with images, video, and comments
- **VR Tools** — Guides and resources for VR hardware, plugins, and configurations
- **Admin Panel** — Full CRUD management for approaches, posts, VR tools, categories, tags, and pages with role-based permissions
- **User Authentication** — Registration, login, email verification, two-factor authentication, and password management via Laravel Fortify
- **Avatar Upload** — Profile picture support (JPG/PNG, max 1 MB)
- **Responsive Design** — Mobile-friendly layout with dark mode support

## Technologies

| Layer | Technology |
|-------|-----------|
| **Framework** | Laravel 12 |
| **PHP** | ^8.2 |
| **Frontend** | Livewire 4 (single-file components), Flux UI 2, Tailwind CSS v4 |
| **Build** | Vite 7 with `@tailwindcss/vite` plugin |
| **Auth** | Laravel Fortify 1.x (headless authentication) |
| **Authorization** | Spatie Laravel Permission 7.x (role-based) |
| **Rich Text** | Trix editor |
| **Testing** | Pest 4 + PHPUnit 12 |
| **Database** | SQLite (default), MySQL compatible |
| **Queue / Cache / Session** | Database-driven (no Redis required) |
| **Code Style** | Laravel Pint |

## Requirements

- PHP ^8.2
- Composer
- Node.js & npm
- Database (SQLite included by default, no setup needed)

## Quick Start

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
```

Or use the setup script:

```bash
composer setup
```

## Development

```bash
composer run dev
```

Runs the Artisan development server, queue listener, and Vite hot-reload concurrently.

## Testing

```bash
php artisan test --compact
```

Or with Pest directly:

```bash
vendor/bin/pest
```

## Code Style

```bash
composer lint
```

## Project Structure

```
app/
├── Http/Controllers/     — Web controllers
│   └── Admin/            — Admin panel controllers
├── Livewire/             — Livewire components (when used)
├── Models/               — Eloquent models
└── Concerns/             — Shared traits (validation rules)
bootstrap/
├── app.php               — Middleware, routing, exception config
└── providers.php         — Service providers
config/                   — All configuration files
database/
├── migrations/           — Database migrations
├── factories/            — Model factories
└── seeders/              — Database seeders
resources/
├── views/
│   ├── components/       — Shared Blade components
│   ├── layouts/          — Layout templates
│   ├── livewire/         — Livewire single-file components
│   ├── pages/            — Folio page components
│   └── partials/         — Reusable partials
routes/
├── web.php               — Public web routes
├── admin.php             — Admin panel routes
├── settings.php          — User settings routes
└── console.php           — Artisan commands
tests/
├── Feature/              — Feature tests
└── Unit/                 — Unit tests
```

## License

MIT
