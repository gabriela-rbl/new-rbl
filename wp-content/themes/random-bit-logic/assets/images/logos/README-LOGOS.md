# Client Logos Required

This directory should contain the logo images for each client featured on the website.

## Required Logo Files

### 1. seatserve-logo.png
- **Client**: SeatServe
- **Description**: Logo for SeatServe mobile app
- **Recommended Size**: 200px width (height proportional)
- **Format**: PNG with transparency
- **Usage**: SeatServe client section
- **Niche**: Mobile Apps • Delivery • Workforce Management

### 2. rosebox-logo.png
- **Client**: Rose Box
- **Description**: Logo for Rose Box e-commerce platform
- **Recommended Size**: 200px width (height proportional)
- **Format**: PNG with transparency
- **Usage**: Rose Box client section
- **Niche**: E-commerce • Branding • Inventory Management

### 3. dutchx-logo.png
- **Client**: DutchX
- **Description**: Logo for DutchX workforce management
- **Recommended Size**: 200px width (height proportional)
- **Format**: PNG with transparency
- **Usage**: DutchX client section
- **Niche**: Workforce Management • Custom Portal

### 4. empire-logo.png
- **Client**: Empire
- **Description**: Logo for Empire Chrome extension
- **Recommended Size**: 200px width (height proportional)
- **Format**: PNG with transparency
- **Usage**: Empire client section
- **Niche**: Chrome Extension • Shopping • Procurement

### 5. capsoil-logo.png
- **Client**: Capsoil
- **Description**: Logo for Capsoil automation platform
- **Recommended Size**: 200px width (height proportional)
- **Format**: PNG with transparency
- **Usage**: Capsoil client section
- **Niche**: Website • AI Automation • Process Optimization

## Logo Specifications

### Quality Requirements
- **Resolution**: 2x for retina displays (400px actual width recommended)
- **File Size**: Keep under 100KB each
- **Color Space**: sRGB
- **Format**: PNG with transparency preferred
- **Background**: Transparent background recommended

### Design Guidelines
- Logos should be horizontal/landscape orientation when possible
- Ensure good contrast against light background (#f1eded)
- If logo is very dark, consider providing a version with better visibility
- Maintain aspect ratio when resizing

### Naming Convention
- Use lowercase filenames
- Use hyphens for spaces (kebab-case)
- Format: `[client-name]-logo.png`
- Keep names consistent with code references

## How to Add Logos

1. Save each logo file to this directory:
   ```
   wp-content/themes/random-bit-logic/assets/images/logos/
   ```

2. Ensure filenames match exactly:
   - `seatserve-logo.png`
   - `rosebox-logo.png`
   - `dutchx-logo.png`
   - `empire-logo.png`
   - `capsoil-logo.png`

3. Set proper file permissions:
   ```bash
   chmod 644 *.png
   ```

4. Verify logos appear on the site by visiting each client section

## Logo Optimization

Before adding logos, optimize them:

```bash
# Using ImageOptim (Mac)
imageoptim *.png

# Using TinyPNG CLI
tinypng *.png

# Using ImageMagick
mogrify -strip -resize 400x -quality 85% *.png
```

## Fallback Behavior

If a logo file is missing:
- The img tag will show as a broken image
- Alt text will display: "[Client Name]"
- The layout will still maintain proper spacing

## Alternative Formats

If PNG is not available, you can use:
- **SVG**: Best for logos, scalable and small file size
  - Update file path to `.svg` extension in index.php
- **JPG**: If transparency not needed
  - Less ideal due to lack of transparency

## Logo Sources

Obtain logos from:
- Client brand guidelines or press kits
- Official client websites
- Direct client contact
- Logo design files from project archives

## Testing

After adding logos, verify:
- [ ] All logos display correctly on desktop
- [ ] All logos display correctly on mobile
- [ ] Logos load quickly (< 1 second)
- [ ] Logos look sharp on retina displays
- [ ] Logos have appropriate spacing
- [ ] Alt text displays if image fails to load

---

**Note**: The logo paths referenced in the theme code will display as broken images until you add the actual files to this directory. This is expected behavior during initial setup.
