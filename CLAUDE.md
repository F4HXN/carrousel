# CLAUDE.md - AI Assistant Guide for Carrousel Sites Pro

This document provides essential information for AI assistants working on this WordPress plugin codebase.

## Project Overview

**Carrousel Sites Pro** is a WordPress plugin (v1.6.1) that displays multiple websites in an interactive carousel with preview and click-to-open functionality. It's designed for showcasing web portfolios with customizable styling.

- **Author**: Jean-Paul Mansouri (F4HXN)
- **License**: GPL v2 or later
- **Requirements**: WordPress 5.0+, PHP 7.0+

## Codebase Structure

```
carrousel/
├── carrousel-sites-pro.php     # Main plugin file (entry point, core class)
├── admin/
│   └── admin-page.php          # WordPress admin settings interface
├── assets/
│   ├── css/
│   │   └── carrousel-sites-pro.css   # Frontend styling (364 lines)
│   └── js/
│       ├── carrousel-sites-pro.js    # Frontend carousel logic (195 lines)
│       └── admin.js                  # Admin media uploader (77 lines)
├── README.md                   # User documentation
├── CHANGELOG.md                # Version history
├── INSTALLATION.txt            # Quick start guide
└── LICENSE.txt                 # GPL v2 license
```

## Key Files and Their Roles

### `carrousel-sites-pro.php` (Main Plugin File)
- Contains the `Carrousel_Sites_Pro` class using Singleton pattern
- Defines plugin constants: `CSP_VERSION`, `CSP_PLUGIN_DIR`, `CSP_PLUGIN_URL`
- Registers all WordPress hooks (`wp_enqueue_scripts`, `admin_menu`, `admin_init`, etc.)
- Implements the `[carrousel_sites]` shortcode
- Manages plugin settings with WordPress Options API

### `admin/admin-page.php`
- WordPress admin settings page with general settings and site management
- Dynamic form for adding/editing/removing sites
- WordPress Media Library integration for image uploads
- Reset functionality to restore defaults

### `assets/js/carrousel-sites-pro.js`
- IIFE pattern for scope isolation
- Vanilla JavaScript (no jQuery dependency)
- Handles slide navigation, auto-play, keyboard/touch events
- Implements accessibility features (ARIA attributes)

### `assets/js/admin.js`
- Uses jQuery (WordPress admin dependency)
- WordPress media uploader integration
- Event delegation for dynamic forms

### `assets/css/carrousel-sites-pro.css`
- Mobile-first responsive design
- CSS animations (`pulse-carrousel`, `float`)
- Breakpoints: 768px (tablet), 480px (mobile)

## Technologies

| Layer | Technology |
|-------|------------|
| Backend | PHP 7.0+, WordPress Plugin API |
| Frontend JS | Vanilla JavaScript (ES5+) |
| Admin JS | jQuery (WordPress dependency) |
| Styling | CSS3 (Flexbox, animations) |
| Security | WordPress nonce, sanitization, escaping |

## WordPress Settings (Options API)

The plugin stores these options in the database:

| Option Key | Type | Description |
|------------|------|-------------|
| `csp_sites` | array | Array of site objects (url, title, image, icon, description) |
| `csp_carousel_title` | string | Global carousel title |
| `csp_carousel_bg_color` | string | Background color (hex) |
| `csp_carousel_title_color` | string | Title color (hex) |
| `csp_title_shadow` | bool | Enable title shadow |
| `csp_carousel_shadow` | bool | Enable carousel shadow (default: true) |

## Shortcode Usage

```
[carrousel_sites]
[carrousel_sites title="Custom Title"]
[carrousel_sites autoplay="false"]
[carrousel_sites delay="3000"]
[carrousel_sites title="Portfolio" autoplay="true" delay="5000"]
```

## Development Conventions

### PHP Conventions
- Use WordPress coding standards
- Prefix all functions/classes with `csp_` or `Carrousel_Sites_Pro`
- Always check `ABSPATH` at file start to prevent direct access
- Use Singleton pattern for main class: `Carrousel_Sites_Pro::get_instance()`

### Security Requirements (CRITICAL)
- **Input sanitization**: Use `sanitize_text_field()`, `sanitize_hex_color()`, `esc_url_raw()`
- **Output escaping**: Use `esc_html()`, `esc_attr()`, `esc_url()` based on context
- **CSRF protection**: Use `check_admin_referer()` with nonce fields
- **Capability checking**: Verify `current_user_can('manage_options')` for admin actions
- **Direct access prevention**: Start PHP files with `if (!defined('ABSPATH')) exit;`

### JavaScript Conventions
- Frontend: Use vanilla JavaScript in IIFE pattern, no jQuery
- Admin: jQuery is acceptable (WordPress admin dependency)
- Use event delegation for dynamic elements
- Open external URLs with `window.open(url, '_blank', 'noopener,noreferrer')`

### CSS Conventions
- Use `.carousel-sites-wrapper` as root container with `!important` resets
- Prefix custom classes with `carousel-` or `site-`
- Mobile-first approach with min-width media queries
- Use CSS custom properties for theming when possible

## Common Development Tasks

### Adding a New Setting
1. Add default value in `get_default_options()` in main plugin file
2. Register the option in `admin_init` hook
3. Add form field in `admin/admin-page.php`
4. Handle save logic with proper sanitization
5. Use the option in shortcode output

### Modifying Carousel Behavior
1. Frontend logic is in `assets/js/carrousel-sites-pro.js`
2. Key functions: `initCarousel()`, `updateCarousel()`, `moveSlide()`, `goToSlide()`
3. Auto-play controlled by `startAutoPlay()` / `stopAutoPlay()`
4. Touch handling uses 50px swipe threshold

### Updating Styles
1. Edit `assets/css/carrousel-sites-pro.css`
2. Test responsive breakpoints: 768px and 480px
3. Verify accessibility (focus states, contrast)
4. Check animations on reduced-motion preference

### Debugging Tips
- Check browser console for JavaScript errors
- Verify WordPress options via `get_option('csp_sites')` in PHP
- Use `error_log()` for PHP debugging (check wp-content/debug.log)
- Test with WordPress Debug mode enabled (`WP_DEBUG`)

## Accessibility Requirements

The plugin implements WCAG accessibility standards:
- ARIA labels on interactive elements (`aria-label`, `aria-current`, `aria-hidden`)
- Keyboard navigation (arrow keys when carousel focused)
- Focus visible indicators (2px outline)
- Semantic HTML with proper `role` attributes
- Touch gesture support (swipe on mobile)

## Version Workflow

When updating the plugin version:
1. Update `CSP_VERSION` constant in `carrousel-sites-pro.php`
2. Update version in plugin header comment
3. Add entry to `CHANGELOG.md` with date and changes
4. Test all features before release

## File Modification Guidelines

| File | Modify For |
|------|------------|
| `carrousel-sites-pro.php` | Core functionality, hooks, shortcode, settings registration |
| `admin/admin-page.php` | Admin interface, form fields, settings UI |
| `assets/js/carrousel-sites-pro.js` | Frontend carousel behavior |
| `assets/js/admin.js` | Admin media uploader, dynamic forms |
| `assets/css/carrousel-sites-pro.css` | All visual styling |
| `README.md` | User-facing documentation |
| `CHANGELOG.md` | Version history (add new entries at top) |

## Testing Checklist

Before committing changes, verify:
- [ ] Carousel displays correctly on frontend
- [ ] Navigation works (buttons, indicators, keyboard, touch)
- [ ] Auto-play functions with pause on hover
- [ ] Admin settings save and load correctly
- [ ] Image upload works via media library
- [ ] Responsive design at all breakpoints
- [ ] No JavaScript console errors
- [ ] No PHP warnings/errors
- [ ] Security: inputs sanitized, outputs escaped
- [ ] Accessibility: keyboard navigation, ARIA labels

## Important Notes for AI Assistants

1. **Never remove security functions** - Always maintain `check_admin_referer()`, sanitization, and escaping
2. **Preserve the Singleton pattern** - The main class uses `get_instance()` for single instantiation
3. **Keep vanilla JS on frontend** - jQuery is only for admin; frontend must not depend on it
4. **Maintain backward compatibility** - Don't break existing shortcode attributes
5. **Update CHANGELOG.md** - Document all changes with version number and date
6. **Test responsiveness** - Changes must work at all breakpoints (desktop, 768px, 480px)
7. **French context** - Author and some comments are in French; maintain this where appropriate
