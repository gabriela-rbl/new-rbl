# Mockup Images Required

This directory should contain the device mockup images used throughout the site.

## Required Images

### 1. phone-mockup.png
- **Description**: Generic iPhone mockup with blank white screen
- **Recommended Size**: 1000 x 2000 pixels
- **Format**: PNG with transparency
- **Usage**: Used for Empire section and general mobile project displays
- **Source**: Use the iPhone mockup image provided in the project brief

### 2. laptop-mockup.png
- **Description**: Generic laptop mockup with blank white screen
- **Recommended Size**: 2000 x 1250 pixels
- **Format**: PNG with transparency
- **Usage**: Used for Rose Box, DutchX, and Capsoil sections
- **Source**: Use the laptop mockup image provided in the project brief

### 3. seatserve-phones.png
- **Description**: Three iPhone mockups showing SeatServe app interface
  - Left phone: Zenit Arena with section A101, Row 12, Seat 4
  - Center phone: Liverpool FC/Anfield login screen
  - Right phone: Kingsholm Stadium with Block A, Row V, Seat 2
- **Recommended Size**: 2400 x 1600 pixels
- **Format**: PNG
- **Usage**: Used exclusively for SeatServe client section
- **Source**: Use the SeatServe three-phone mockup image provided in the project brief

## Image Specifications

### Quality Requirements
- **Resolution**: 2x for retina displays (high DPI)
- **File Size**: Keep under 500KB each (use compression)
- **Color Space**: sRGB
- **Compression**: Use PNG compression tools (TinyPNG, ImageOptim, etc.)

### Naming Convention
- Use lowercase filenames
- Use hyphens for spaces (kebab-case)
- Include descriptive names
- Keep names consistent with code references

## How to Add Images

1. Save each image file to this directory:
   ```
   wp-content/themes/random-bit-logic/assets/images/mockups/
   ```

2. Ensure filenames match exactly:
   - `phone-mockup.png`
   - `laptop-mockup.png`
   - `seatserve-phones.png`

3. Set proper file permissions:
   ```bash
   chmod 644 *.png
   ```

4. Verify images appear on the site by visiting each client section

## Image Optimization

Before adding images, optimize them:

```bash
# Using ImageOptim (Mac)
imageoptim *.png

# Using TinyPNG CLI
tinypng *.png

# Using ImageMagick
mogrify -strip -quality 85% *.png
```

## Placeholders

If you don't have the actual images yet, you can use placeholder services:

- https://placehold.co/1000x2000/png (for phone mockups)
- https://placehold.co/2000x1250/png (for laptop mockups)
- https://placehold.co/2400x1600/png (for SeatServe)

## Future Images

As you add more client projects, follow the same conventions:

```
[client-name]-[device-type].png

Examples:
- newclient-mobile.png
- newclient-desktop.png
- newclient-tablet.png
```

## Image Credits

When using mockup templates:
- Ensure you have proper licensing for mockup devices
- Consider using free mockup resources:
  - Mockuuups.studio
  - Smartmockups.com
  - Mockup.photos
  - Figma mockup templates

---

**Note**: The images referenced in the theme code will display as broken images until you add the actual files to this directory. This is expected behavior during initial setup.
