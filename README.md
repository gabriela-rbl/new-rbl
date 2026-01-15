# Random Bit Logic - Agency Website

Modern, minimalist WordPress theme for Random Bit Logic - an AI-first software development agency based in NYC with a global team.

## Overview

This WordPress theme showcases Random Bit Logic's portfolio through a dynamic, full-screen scrolling experience inspired by modern design principles. Each client project is displayed in its own immersive section with smooth scroll-triggered animations.

## Features

### Design
- **Clean & Minimalist**: Spacious layout with focus on content
- **Bold Typography**: Large, confident headlines with tech-inspired accents
- **Geometric Elements**: Animated decorative shapes with parallax effects
- **Full-Screen Sections**: Each client project displayed in dedicated viewport
- **Smooth Animations**: Scroll-triggered fade-ins and transitions
- **Responsive Design**: Mobile-first approach with adaptive layouts

### Technical
- **WordPress Theme**: Custom-built theme following WordPress standards
- **Scroll Anchoring**: Automatic snap-to-section behavior
- **Performance Optimized**: Lazy loading, efficient animations
- **Contact Form**: Built-in form with PHP handling
- **SEO Ready**: Semantic HTML5 structure
- **Cross-Browser Compatible**: Works on all modern browsers

## Project Structure

```
wp-content/themes/random-bit-logic/
├── assets/
│   ├── css/
│   ├── js/
│   │   ├── scroll-animations.js    # Scroll effects & parallax
│   │   └── main.js                 # Form handling & interactions
│   └── images/
│       └── mockups/
│           ├── phone-mockup.png
│           ├── laptop-mockup.png
│           └── seatserve-phones.png
├── templates/                       # (Future template parts)
├── style.css                        # Main stylesheet & theme header
├── functions.php                    # Theme functions & setup
└── index.php                        # Main template file
```

## Installation

1. **Copy Theme to WordPress**
   ```bash
   cp -r wp-content/themes/random-bit-logic /path/to/wordpress/wp-content/themes/
   ```

2. **Add Mockup Images**
   Place the following images in `assets/images/mockups/`:
   - `phone-mockup.png` - iPhone mockup template
   - `laptop-mockup.png` - Laptop mockup template
   - `seatserve-phones.png` - SeatServe app screenshots

3. **Activate Theme**
   - Log into WordPress admin
   - Go to Appearance > Themes
   - Activate "Random Bit Logic"

4. **Configure Settings**
   - Set site title and tagline in Settings > General
   - Configure email address for contact form submissions

## Client Sections

The theme includes dedicated sections for five major clients:

### 1. SeatServe
- Mobile apps (iOS & Android)
- Workforce management
- Real-time delivery tracking
- Stadium venue integration

### 2. Rose Box
- E-commerce platform
- Brand identity & design
- Inventory management
- Order fulfillment automation

### 3. DutchX
- Workforce management
- Custom organization portal
- Employee scheduling
- Time tracking & reporting

### 4. Empire
- Chrome extension development
- Customized shopping experience
- Procurement automation
- AI-powered recommendations

### 5. Capsoil
- Corporate website
- Process automation with AI
- Workflow optimization
- Data integration systems

## Customization

### Colors
Edit CSS variables in `style.css`:
```css
:root {
    --primary-color: #000000;
    --secondary-color: #ffffff;
    --accent-color: #0066ff;
    --text-color: #1a1a1a;
}
```

### Content
Edit section content directly in `index.php`:
- Hero headline and subtitle
- Client names and descriptions
- Services lists
- Contact form fields

### Animations
Modify animation behavior in `assets/js/scroll-animations.js`:
- Scroll snap sensitivity
- Parallax speed
- Fade-in timing
- Observer thresholds

## Development Milestones

### ✅ Phase 1: Foundation (Completed)
- [x] WordPress theme structure created
- [x] Core files (style.css, functions.php, index.php)
- [x] Asset directory organization

### ✅ Phase 2: Design System (Completed)
- [x] CSS variables and design tokens
- [x] Typography system with responsive scaling
- [x] Color scheme implementation
- [x] Geometric shape animations

### ✅ Phase 3: Hero Section (Completed)
- [x] Bold headline with code-style brackets
- [x] Agency tagline and positioning
- [x] Call-to-action button
- [x] Animated geometric background shapes

### ✅ Phase 4: Client Sections (Completed)
- [x] Full-screen section layouts
- [x] SeatServe section with mobile mockups
- [x] Rose Box e-commerce showcase
- [x] DutchX workforce management
- [x] Empire Chrome extension
- [x] Capsoil automation platform

### ✅ Phase 5: Interactions (Completed)
- [x] Scroll-triggered animations
- [x] Intersection Observer implementation
- [x] Smooth scroll anchoring
- [x] Section snap behavior
- [x] Parallax effects on geometric shapes
- [x] Mockup hover animations

### ✅ Phase 6: Contact Form (Completed)
- [x] Contact form HTML structure
- [x] Form validation (client-side)
- [x] PHP form handler
- [x] Email notifications
- [x] Success/error messages
- [x] Loading states

### ✅ Phase 7: Polish & Performance (Completed)
- [x] Responsive design for mobile/tablet
- [x] Scroll progress indicator
- [x] Image lazy loading support
- [x] Performance optimizations
- [x] Cross-browser testing structure

## Browser Support

- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance

- Lightweight CSS (no frameworks)
- Vanilla JavaScript (no jQuery)
- Optimized animations (GPU-accelerated)
- Lazy loading for images
- Minimal HTTP requests

## Future Enhancements

- [ ] Add dynamic content management via WordPress admin
- [ ] Create custom post type for client projects
- [ ] Implement dark mode toggle
- [ ] Add more animation variations
- [ ] Create additional page templates
- [ ] Add blog functionality
- [ ] Integrate analytics tracking
- [ ] Add multilingual support

## Technologies Used

- **WordPress** - CMS platform
- **HTML5** - Semantic markup
- **CSS3** - Modern styling & animations
- **JavaScript (ES6+)** - Interactive features
- **Intersection Observer API** - Scroll animations
- **PHP** - Server-side functionality

## Agency Information

**Random Bit Logic**
- Location: New York City
- Team: Global
- Focus: AI-first development
- Services: Full-stack development & AI consultancy
- Specialties: Custom web platforms, autonomous agents, business automation

## Contact

For questions about this theme or to work with Random Bit Logic, use the contact form on the website or reach out through the agency's official channels.

## License

This theme is proprietary software developed for Random Bit Logic.

---

**Version**: 1.0.0
**Last Updated**: January 2026
**Built with**: ❤️ by Random Bit Logic