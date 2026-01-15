# Cloudways Git Deployment Guide

Complete guide for deploying the Random Bit Logic WordPress theme using Cloudways Git Deployment feature.

## Overview

This repository is structured to deploy a WordPress theme to Cloudways hosting via Git. The deployment process automatically copies the theme files to your WordPress installation's themes directory.

## Prerequisites

1. **Cloudways Account** with an active WordPress application
2. **Git Repository** (GitHub, GitLab, or Bitbucket) - Already set up
3. **SSH Access** to your Cloudways server (optional, for troubleshooting)
4. **WordPress Installation** on Cloudways

## Repository Structure

```
new-rbl/
├── wp-content/
│   └── themes/
│       └── random-bit-logic/    # The WordPress theme
├── deploy.sh                     # Main deployment script
├── deploy.php                    # PHP deployment script (alternative)
├── .gitignore                    # Git ignore rules
└── CLOUDWAYS-DEPLOYMENT.md       # This file
```

## Cloudways Setup - Step by Step

### Step 1: Enable Git Deployment in Cloudways

1. **Log into Cloudways Dashboard**
   - Navigate to your application

2. **Access Deployment via Git**
   - Go to **Deployment via Git** in the left sidebar
   - Click on **Application Name** > **Deployment via Git**

3. **Add Git Repository**
   - Click "Let's Get Started" or "+" to add a new Git deployment

4. **Configure Git Settings**
   - **Git Remote Address**: Your repository URL
     ```
     https://github.com/gabriela-rbl/new-rbl.git
     ```

   - **Branch Name**: `claude/build-agency-website-BDnhF`
     (or whichever branch you want to deploy)

   - **Deployment Path**: Set to your WordPress root directory
     ```
     public_html
     ```
     (This is typically the default WordPress installation path)

### Step 2: Configure Deployment Script

In Cloudways Git Deployment settings:

1. **Enable Custom Deployment Script**
   - Toggle "Enable" for deployment script

2. **Set Deployment Script Path**
   ```bash
   bash deploy.sh
   ```

   Or if using PHP script:
   ```bash
   php deploy.php
   ```

3. **Save Configuration**

### Step 3: Add SSH Key (If Private Repository)

If your repository is private:

1. **Generate SSH Key in Cloudways**
   - In Git Deployment settings, click "Generate SSH Key"
   - Copy the generated public key

2. **Add to GitHub/GitLab**
   - GitHub: Settings > Deploy Keys > Add Deploy Key
   - Paste the key and grant read access
   - Save

### Step 4: Deploy

1. **Pull and Deploy**
   - Click "Pull" or "Deploy Now" button in Cloudways
   - Monitor the deployment log for any errors

2. **Verify Deployment**
   - Check deployment log shows "Deployment completed successfully"
   - SSH into server (optional) to verify files

## Deployment Methods

### Method 1: Automatic Deployment Script (Recommended)

The `deploy.sh` script automatically:
- Detects WordPress installation path
- Backs up existing theme
- Copies theme files to correct location
- Sets proper permissions
- Logs all actions

**Cloudways Configuration:**
```
Deployment Script: bash deploy.sh
```

### Method 2: Direct Deployment Path

Deploy directly to WordPress root and let Cloudways handle it:

**Cloudways Configuration:**
```
Deployment Path: public_html
Branch: claude/build-agency-website-BDnhF
```

The WordPress structure is already in the repo under `wp-content/themes/random-bit-logic/`.

### Method 3: Manual Deployment via SSH

If automated deployment fails:

```bash
# SSH into Cloudways server
ssh master@[your-server-ip] -p [port]

# Navigate to application directory
cd applications/[app-name]/public_html

# Clone or pull repository
git clone [repo-url] /tmp/theme-deploy
# or
cd /tmp/theme-deploy && git pull

# Copy theme
cp -R /tmp/theme-deploy/wp-content/themes/random-bit-logic wp-content/themes/

# Set permissions
chmod -R 755 wp-content/themes/random-bit-logic
find wp-content/themes/random-bit-logic -type f -exec chmod 644 {} \;

# Clean up
rm -rf /tmp/theme-deploy
```

## Post-Deployment Steps

### 1. Add Mockup Images

After deployment, add the required mockup images:

```bash
# Via SFTP or SSH, upload these files:
wp-content/themes/random-bit-logic/assets/images/mockups/phone-mockup.png
wp-content/themes/random-bit-logic/assets/images/mockups/laptop-mockup.png
wp-content/themes/random-bit-logic/assets/images/mockups/seatserve-phones.png
```

**Via Cloudways File Manager:**
1. Go to Application > File Manager
2. Navigate to `public_html/wp-content/themes/random-bit-logic/assets/images/mockups/`
3. Upload the three image files

### 2. Activate Theme in WordPress

1. Log into WordPress Admin Panel
   ```
   https://yourdomain.com/wp-admin
   ```

2. Navigate to **Appearance > Themes**

3. Find "Random Bit Logic" theme

4. Click **Activate**

### 3. Configure Settings

1. **Site Settings**
   - Go to **Settings > General**
   - Set site title: "Random Bit Logic"
   - Set tagline: "AI-First Software Development"
   - Set admin email (for contact form)

2. **Permalink Settings**
   - Go to **Settings > Permalinks**
   - Select "Post name"
   - Save changes

3. **Test Contact Form**
   - Scroll to bottom of homepage
   - Submit a test message
   - Check if email arrives

## Troubleshooting

### Issue: Deployment Script Not Executing

**Solution:**
1. Verify script path in Cloudways: `bash deploy.sh` or `php deploy.php`
2. Check script permissions: `chmod +x deploy.sh`
3. View deployment log in Cloudways for errors

### Issue: Theme Not Appearing in WordPress

**Solution:**
1. SSH into server and verify files:
   ```bash
   ls -la public_html/wp-content/themes/random-bit-logic/
   ```
2. Check if `style.css` exists with proper header
3. Verify file permissions:
   ```bash
   chmod -R 755 public_html/wp-content/themes/random-bit-logic
   ```

### Issue: Permission Denied Errors

**Solution:**
1. Set correct ownership:
   ```bash
   chown -R master:www-data public_html/wp-content/themes/random-bit-logic
   ```
2. Set correct permissions:
   ```bash
   find public_html/wp-content/themes/random-bit-logic -type d -exec chmod 755 {} \;
   find public_html/wp-content/themes/random-bit-logic -type f -exec chmod 644 {} \;
   ```

### Issue: Deployment Log Shows Errors

**Solution:**
1. Check `deployment.log` file in application root:
   ```bash
   cat public_html/deployment.log
   ```
2. Review error messages and fix accordingly
3. Common issues:
   - Wrong deployment path
   - Missing directories
   - Permission problems

### Issue: Images Not Loading

**Solution:**
1. Verify images are uploaded to correct path:
   ```
   wp-content/themes/random-bit-logic/assets/images/mockups/
   ```
2. Check image permissions: `chmod 644 *.png`
3. Verify image filenames match exactly (case-sensitive)

### Issue: Contact Form Not Sending Emails

**Solution:**
1. **Install SMTP Plugin**
   - Go to Plugins > Add New
   - Search "WP Mail SMTP"
   - Install and activate
   - Configure with your email provider

2. **Configure Cloudways Email**
   - Use Cloudways Rackspace Email
   - Or configure external SMTP (Gmail, SendGrid, etc.)

3. **Test Email Delivery**
   - Use WP Mail SMTP's email test feature
   - Check spam folder

## Deployment Workflow

### For Ongoing Updates

1. **Make Changes Locally**
   ```bash
   # Edit theme files
   git add .
   git commit -m "Update theme"
   git push origin claude/build-agency-website-BDnhF
   ```

2. **Deploy in Cloudways**
   - Go to Deployment via Git
   - Click "Pull" or enable auto-deployment
   - Monitor deployment log

3. **Clear Cache**
   - Go to Application > Cache Management
   - Click "Purge" to clear Varnish/Redis cache
   - Clear browser cache

### Automated Deployments

Enable automatic deployments:

1. In Cloudways Git Deployment settings
2. Toggle "Auto Deploy" ON
3. Every push to the branch will trigger deployment

## Cloudways-Specific Features

### 1. Application Cache

After deployment, clear cache:
- **Varnish**: Purge from Application Management
- **Redis**: Flush from Application Management
- **Browser**: Add version query strings to assets

### 2. CDN Integration

If using Cloudways CDN:
1. Configure CDN in Application settings
2. CDN will automatically cache static assets
3. Purge CDN after theme updates

### 3. Staging Environment

Test deployments on staging first:
1. Clone application to staging
2. Deploy to staging environment
3. Test thoroughly
4. Deploy to production

### 4. Automated Backups

Cloudways provides automatic backups:
- Enable in Application > Backup Management
- Set frequency (daily recommended)
- Keep at least 7 days of backups

## Security Considerations

### 1. File Permissions

Proper permissions for WordPress:
```bash
# Directories
find wp-content/themes/random-bit-logic -type d -exec chmod 755 {} \;

# Files
find wp-content/themes/random-bit-logic -type f -exec chmod 644 {} \;

# Sensitive files
chmod 600 wp-config.php
```

### 2. Git Security

Ensure sensitive files are ignored:
- `.gitignore` includes `wp-config.php`
- Don't commit `.env` files
- Keep credentials out of repository

### 3. WordPress Security

1. Keep WordPress updated
2. Use strong passwords
3. Enable 2FA in Cloudways
4. Regular security scans

## Performance Optimization

### 1. Enable Cloudways Breeze

1. Go to Application > Breeze (CDN)
2. Enable and configure
3. Benefits:
   - Global CDN
   - Asset minification
   - Image optimization

### 2. Redis Cache

1. Enable Redis in Application settings
2. Install Redis Object Cache plugin
3. Activate and configure

### 3. Varnish

Cloudways includes Varnish by default:
- Caches static content
- Purge after deployments
- Configure cache rules if needed

## Monitoring

### 1. Deployment Logs

- Available in Cloudways Git Deployment section
- Check `deployment.log` file on server
- Monitor for errors or warnings

### 2. Application Monitoring

Cloudways provides:
- Server resource usage
- Application performance metrics
- Error logs
- Access logs

### 3. Uptime Monitoring

Set up monitoring:
- Use Cloudways built-in monitoring
- Or external services (UptimeRobot, Pingdom)
- Get alerts for downtime

## Support Resources

### Cloudways Support
- Live Chat: Available 24/7
- Ticket System: For complex issues
- Knowledge Base: https://support.cloudways.com

### Theme Support
- Repository Issues: https://github.com/gabriela-rbl/new-rbl/issues
- Documentation: README.md in repository
- Installation Guide: INSTALLATION.md

## Quick Reference

### Cloudways Git Deployment Settings

```
Repository URL: https://github.com/gabriela-rbl/new-rbl.git
Branch: claude/build-agency-website-BDnhF
Deployment Path: public_html
Deployment Script: bash deploy.sh
```

### Common Commands

```bash
# SSH into Cloudways
ssh master@[server-ip] -p [port]

# Navigate to WordPress
cd applications/[app]/public_html

# Check theme files
ls -la wp-content/themes/random-bit-logic/

# View deployment log
cat deployment.log

# Set permissions
chmod -R 755 wp-content/themes/random-bit-logic

# Restart PHP-FPM (if needed)
sudo service php-fpm restart
```

### File Paths

```
WordPress Root:     public_html/
Theme Directory:    public_html/wp-content/themes/random-bit-logic/
Uploads Directory:  public_html/wp-content/uploads/
Deployment Log:     public_html/deployment.log
```

## Checklist

Use this checklist for each deployment:

- [ ] Code committed and pushed to correct branch
- [ ] Cloudways Git settings configured correctly
- [ ] Deployment script tested
- [ ] Pull/Deploy triggered in Cloudways
- [ ] Deployment log shows success
- [ ] Theme files present on server
- [ ] Theme appears in WordPress admin
- [ ] Theme activated successfully
- [ ] Mockup images uploaded
- [ ] All sections display correctly
- [ ] Contact form works
- [ ] Mobile responsive
- [ ] Cache cleared
- [ ] SSL certificate active
- [ ] Performance tested

---

**Last Updated**: January 2026
**Version**: 1.0.0
**Cloudways Compatibility**: All WordPress stacks
