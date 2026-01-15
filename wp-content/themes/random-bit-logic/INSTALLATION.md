# Installation Guide - Random Bit Logic WordPress Theme

## Prerequisites

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Modern web browser

## Step-by-Step Installation

### 1. Prepare WordPress Environment

Ensure you have a working WordPress installation. If you're setting up WordPress for the first time:

```bash
# Download WordPress
wget https://wordpress.org/latest.tar.gz
tar -xzf latest.tar.gz

# Configure database in wp-config.php
# Set up your web server to point to the WordPress directory
```

### 2. Install the Theme

#### Option A: Direct Copy (Recommended)

```bash
# Navigate to your WordPress themes directory
cd /path/to/wordpress/wp-content/themes/

# Copy the theme
cp -r /path/to/new-rbl/wp-content/themes/random-bit-logic .

# Set proper permissions
chmod -R 755 random-bit-logic
```

#### Option B: Upload via WordPress Admin

1. Compress the theme folder: `zip -r random-bit-logic.zip random-bit-logic/`
2. Log into WordPress admin panel
3. Navigate to **Appearance > Themes > Add New > Upload Theme**
4. Upload the ZIP file
5. Click "Install Now"

### 3. Add Required Images

The theme requires mockup images to display client projects properly. Add these images to the theme:

```bash
cd wp-content/themes/random-bit-logic/assets/images/mockups/
```

**Required Images:**

1. **phone-mockup.png** - Generic iPhone mockup (blank screen)
   - Recommended size: 1000x2000px
   - Format: PNG with transparency
   - Use for: Empire and general mobile projects

2. **laptop-mockup.png** - Generic laptop mockup (blank screen)
   - Recommended size: 2000x1250px
   - Format: PNG with transparency
   - Use for: Rose Box, DutchX, Capsoil

3. **seatserve-phones.png** - SeatServe app screenshots
   - Should show 3 phones with the app interface
   - Recommended size: 2400x1600px
   - Format: PNG
   - Use for: SeatServe section only

**Image Guidelines:**
- Use high-quality images (2x resolution for retina displays)
- Keep file sizes under 500KB (use compression if needed)
- Ensure transparency for device mockups
- Maintain consistent style across mockups

### 4. Activate the Theme

1. Log into your WordPress admin panel
2. Navigate to **Appearance > Themes**
3. Find "Random Bit Logic" theme
4. Click **Activate**

### 5. Configure Site Settings

#### Basic Settings
1. Go to **Settings > General**
2. Set your site title (e.g., "Random Bit Logic")
3. Set tagline (e.g., "AI-First Software Development")
4. Set WordPress Address and Site Address URLs
5. Set admin email (this will receive contact form submissions)

#### Permalink Settings
1. Go to **Settings > Permalinks**
2. Select "Post name" for clean URLs
3. Click **Save Changes**

### 6. Test the Contact Form

1. Navigate to your site's contact section (scroll to bottom or use URL/#contact)
2. Fill out the test form with your email
3. Submit the form
4. Check if you receive the email at the admin address

**Troubleshooting Contact Form:**
- Ensure your server can send emails (check with hosting provider)
- Install an SMTP plugin if needed (e.g., WP Mail SMTP)
- Check spam folder for test emails

### 7. Customize Content (Optional)

The theme content is currently hardcoded in `index.php`. To customize:

```bash
# Edit the main template
nano wp-content/themes/random-bit-logic/index.php
```

**Customizable Sections:**
- Hero headline and subtitle (lines ~25-35)
- Client names and descriptions (each client section)
- Services lists for each client
- Contact form introduction text

### 8. Customize Styling (Optional)

To change colors, fonts, or other design elements:

```bash
# Edit the main stylesheet
nano wp-content/themes/random-bit-logic/style.css
```

**Quick Customizations:**
- Brand colors: Edit CSS variables (lines ~21-28)
- Typography: Change font-family declarations
- Section spacing: Adjust padding in `.section` class
- Animation speed: Modify transition variables

## Verification Checklist

After installation, verify these features work:

- [ ] Theme appears in WordPress admin
- [ ] Theme activates without errors
- [ ] Homepage displays all sections
- [ ] Hero section shows properly
- [ ] All 5 client sections visible
- [ ] Scroll animations work smoothly
- [ ] Scroll snapping to sections functions
- [ ] Geometric shapes animate
- [ ] Contact form displays
- [ ] Form validation works
- [ ] Form submission sends email
- [ ] Site is responsive on mobile
- [ ] All mockup images display
- [ ] Smooth scrolling works
- [ ] Hover effects on mockups work

## Common Issues & Solutions

### Issue: Theme doesn't appear in admin
**Solution**: Check folder structure. Theme must be directly in `wp-content/themes/random-bit-logic/` with `style.css` in the root.

### Issue: Images don't display
**Solution**:
1. Verify image paths in index.php match actual image locations
2. Check file permissions: `chmod 644 assets/images/mockups/*`
3. Add placeholder images if originals not available

### Issue: Contact form doesn't send emails
**Solution**:
1. Install "WP Mail SMTP" plugin
2. Configure with your SMTP provider
3. Test email delivery in plugin settings

### Issue: Animations are choppy
**Solution**:
1. Check browser console for JavaScript errors
2. Ensure JavaScript files are loading (check browser Network tab)
3. Try disabling other plugins that might conflict

### Issue: Scroll snapping too aggressive
**Solution**: Edit `assets/js/scroll-animations.js`, function `snapToNearestSection()`, increase the distance threshold from 50 to a higher value (e.g., 100).

### Issue: Mobile display issues
**Solution**: Clear your browser cache and test in incognito/private mode. The theme is mobile-responsive by default.

## Development Setup

For theme development:

```bash
# Enable WordPress debug mode
# Edit wp-config.php and add:
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

# Watch for errors in debug.log
tail -f wp-content/debug.log
```

## Performance Optimization

For production deployment:

1. **Minify Assets**
   ```bash
   # Install minification tools
   npm install -g csso-cli uglify-js

   # Minify CSS
   csso style.css -o style.min.css

   # Minify JavaScript
   uglifyjs assets/js/*.js -o assets/js/scripts.min.js
   ```

2. **Optimize Images**
   ```bash
   # Use ImageOptim, TinyPNG, or similar
   # Target: <500KB per image, 2x resolution
   ```

3. **Enable Caching**
   - Install a caching plugin (W3 Total Cache or WP Super Cache)
   - Enable browser caching via .htaccess

4. **Use a CDN** (optional)
   - Configure CDN for static assets
   - Update image URLs in template

## Support

For theme-specific issues:
- Check the main README.md for feature documentation
- Review browser console for JavaScript errors
- Check WordPress debug.log for PHP errors

For WordPress issues:
- Visit WordPress.org documentation
- Check WordPress support forums

## Next Steps

After successful installation:

1. **Add Real Content**: Replace placeholder text with actual client information
2. **Add Real Images**: Replace mockup images with actual project screenshots
3. **Test Thoroughly**: Check all functionality across devices
4. **Optimize Performance**: Implement caching and optimization
5. **Set Up Analytics**: Add tracking code if needed
6. **Launch**: Point your domain to the WordPress installation

---

**Theme Version**: 1.0.0
**WordPress Version Tested**: 6.4+
**PHP Version Required**: 7.4+