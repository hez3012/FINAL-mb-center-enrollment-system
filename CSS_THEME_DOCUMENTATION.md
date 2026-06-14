# MB Center Enrollment System - CSS Theme Documentation

## Overview
This document describes the global CSS theme system used throughout the MB Center Enrollment System. The theme uses a cohesive **Green-YellowGreen-Yellow** color palette applied consistently across all Bootstrap components.

## File Structure
```
resources/
├── css/
│   ├── app.css           (Tailwind config)
│   └── theme.css         (NEW: Global theme system)
└── views/
    ├── welcome.blade.php (Public landing page - standalone styling)
    ├── auth/
    │   ├── login.blade.php        (links theme.css)
    │   └── register.blade.php     (links theme.css)
    ├── admin/
    │   └── layouts/app.blade.php  (links theme.css)
    └── portal/
        └── layouts/app.blade.php  (links theme.css)
```

## Color Palette

### CSS Variables (Defined in `:root`)
```css
--primary-green: #22c55e;       /* Main green color */
--secondary-green: #16a34a;     /* Darker green for accents */
--dark-green: #15803d;          /* Darkest green for text */
--light-green: #dcfce7;         /* Light green for backgrounds */
--lighter-green: #f0fdf4;       /* Very light green tint */

--yellowgreen: #84cc16;         /* Lime-green hybrid */
--lime-green: #a3e635;          /* Bright lime */

--primary-yellow: #eab308;      /* Main yellow */
--light-yellow: #fef08a;        /* Light yellow */

--light-bg: #f0fdf4;            /* Page background */
--dark-bg: #052e16;             /* Footer background */
--body-bg: #fafaf9;             /* Body background */

--text-primary: #1f2937;        /* Dark text */
--text-secondary: #6b7280;      /* Medium text */
--text-light: #9ca3af;          /* Light text */

--border-color: #e5e7eb;        /* Standard borders */
--border-light: #f3f4f6;        /* Light borders */
```

## Component Styling

### Buttons
All buttons use gradients and transitions:
- **Primary**: Green gradient with shadow
- **Success**: Green-to-YellowGreen gradient
- **Warning**: Yellow-to-YellowGreen gradient
- **Info**: Green-to-Yellow gradient
- **Outline variants**: Border + hover fill effect

### Cards
- Clean white background with subtle shadows
- Colored header with gradient backgrounds
- Hover effect: lift animation + enhanced shadow
- Border: light grey with rounded corners (12px)

### Forms
- Input fields: 2px green borders on focus
- Labels: Bold, dark text
- Input groups: Gradient backgrounds
- Smooth transitions on all interactions

### Alerts
- Gradient backgrounds matching alert type
- Left border accent (4px)
- Icon + message combination
- Primary (success/info) uses green gradients
- Warning uses yellow gradients
- Danger remains red for critical alerts

### Tables
- Green gradient header with uppercase, bold labels
- Light green hover effect on rows
- Striped rows with subtle green tint
- Modern, professional appearance

### Navigation
- **Navbar**: Dark green to light green gradient
- **Active links**: Yellow underline animation
- **Sidebar**: Light background with green active states
- **Topbar**: Clean white with subtle border

### Badges
- Gradient backgrounds matching color scheme
- Rounded corners (6px)
- Bold, uppercase text
- Shadow effects for depth

## Usage Examples

### Using the CSS in Blade Views

#### Admin/Portal Layouts
Already includes `theme.css` automatically:
```html
<link href="{{ asset('css/theme.css') }}" rel="stylesheet">
```

#### Auth Views
Also includes `theme.css` automatically.

#### Custom Views
To include the theme in any view:
```html
<link href="{{ asset('css/theme.css') }}" rel=\"stylesheet\">
```

### Bootstrap Classes with Theme
All Bootstrap utility classes are enhanced with the theme:

```html
<!-- Buttons -->
<button class="btn btn-primary">Submit</button>
<button class="btn btn-success">Approve</button>
<button class="btn btn-warning">Pending</button>
<button class="btn btn-outline-primary">Cancel</button>

<!-- Cards -->
<div class="card">
    <div class="card-header">Title</div>
    <div class="card-body">Content</div>
</div>

<!-- Alerts -->
<div class="alert alert-success">Success message</div>
<div class="alert alert-warning">Warning message</div>

<!-- Badges -->
<span class="badge badge-primary">Active</span>
<span class="badge badge-warning">Pending</span>

<!-- Tables -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Column</th>
        </tr>
    </thead>
</table>

<!-- Forms -->
<div class="form-group">
    <label class="form-label">Label</label>
    <input type="text" class="form-control">
</div>
```

## Advanced Features

### Gradient Utilities
Use custom gradient backgrounds:
```html
<div class="bg-gradient-primary">Primary gradient</div>
<div class="bg-gradient-success">Success gradient</div>
<div class="bg-gradient-warning">Warning gradient</div>
```

### Animations
Pre-built animation classes:
```html
<div class="animate-slide-up">Slides up on page load</div>
<div class="animate-slide-left">Slides left on page load</div>
<div class="animate-fade-in">Fades in on page load</div>
```

### Shadow Utilities
Enhanced shadows throughout:
```html
<div class="shadow-sm">Small shadow</div>
<div class="shadow">Medium shadow</div>
<div class="shadow-lg">Large shadow</div>
```

## Responsive Design

The CSS includes responsive breakpoints:
- **Mobile (≤768px)**: Adjusted sidebar width, button sizes
- **Tablet & Desktop**: Full layouts with all effects

## Customization

To customize the theme:

1. **Change Primary Color**:
   - Edit `--primary-green` in `resources/css/theme.css`
   - All components will automatically update

2. **Add New Color**:
   - Add to CSS variables in `:root`
   - Create utility classes (`.btn-custom`, `.bg-custom`, etc.)

3. **Modify Component Styling**:
   - Find the component section (e.g., `/* BUTTONS */`)
   - Update the relevant styles
   - All instances will update automatically

## Browser Support

- Chrome/Edge: Full support
- Firefox: Full support
- Safari: Full support
- IE11: Limited support (gradients may appear solid)

## Performance Notes

- CSS file is ~8KB uncompressed
- No JavaScript required
- All animations use CSS transitions (GPU accelerated)
- No additional font files needed

## Migration from Old Styles

If updating from the old inline styles:
1. Remove inline `<style>` blocks from template `<head>`
2. Add `<link href="{{ asset('css/theme.css') }}" rel="stylesheet">`
3. Update any custom classes to use new CSS variables
4. Test in all major browsers

## Support & Maintenance

To maintain the theme:
- Keep all CSS variables in the `:root` selector
- Use CSS variables instead of hardcoded colors
- Test new components against the color scheme
- Document custom classes in this file

---

**Last Updated**: June 13, 2024
**Theme Version**: 1.0
**Framework**: Bootstrap 5.3 + Custom CSS
