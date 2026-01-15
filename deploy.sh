#!/bin/bash

###############################################################################
# Cloudways Git Deployment Script for Random Bit Logic WordPress Theme
#
# This script is executed by Cloudways during Git deployment.
# It copies the theme files to the WordPress themes directory.
#
# @package RandomBitLogic
# @version 1.0.0
###############################################################################

# Configuration
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
THEME_SOURCE="${SCRIPT_DIR}/wp-content/themes/random-bit-logic"
DEPLOYMENT_LOG="${SCRIPT_DIR}/deployment.log"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

###############################################################################
# Functions
###############################################################################

# Log message with timestamp
log_message() {
    local message="$1"
    local timestamp=$(date '+%Y-%m-%d %H:%M:%S')
    echo "[${timestamp}] ${message}" | tee -a "${DEPLOYMENT_LOG}"
}

# Log error message
log_error() {
    echo -e "${RED}[ERROR]${NC} $1" | tee -a "${DEPLOYMENT_LOG}"
}

# Log success message
log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1" | tee -a "${DEPLOYMENT_LOG}"
}

# Log warning message
log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1" | tee -a "${DEPLOYMENT_LOG}"
}

# Detect WordPress installation path
detect_wordpress_path() {
    # Check common locations for wp-config.php
    local possible_paths=(
        "${SCRIPT_DIR}"
        "${SCRIPT_DIR}/../public_html"
        "${SCRIPT_DIR}/../public"
        "${SCRIPT_DIR}/../www"
        "/home/master/applications/*/public_html"
    )

    for path in "${possible_paths[@]}"; do
        # Expand wildcard
        for expanded_path in $path; do
            if [ -f "${expanded_path}/wp-config.php" ]; then
                echo "${expanded_path}"
                return 0
            fi
        done
    done

    # If not found, assume current directory
    echo "${SCRIPT_DIR}"
    return 1
}

# Main deployment function
deploy_theme() {
    log_message "========================================"
    log_message "Random Bit Logic Theme Deployment"
    log_message "========================================"
    log_message "Script Directory: ${SCRIPT_DIR}"
    log_message "Theme Source: ${THEME_SOURCE}"

    # Verify source exists
    if [ ! -d "${THEME_SOURCE}" ]; then
        log_error "Theme source directory not found: ${THEME_SOURCE}"
        return 1
    fi

    # Detect WordPress installation
    log_message "Detecting WordPress installation..."
    WP_ROOT=$(detect_wordpress_path)
    THEME_DEST="${WP_ROOT}/wp-content/themes/random-bit-logic"

    log_message "WordPress Root: ${WP_ROOT}"
    log_message "Theme Destination: ${THEME_DEST}"

    # Verify wp-content/themes exists
    if [ ! -d "${WP_ROOT}/wp-content/themes" ]; then
        log_error "WordPress themes directory not found: ${WP_ROOT}/wp-content/themes"
        log_warning "Please set the correct deployment path in Cloudways"
        return 1
    fi

    # Backup existing theme
    if [ -d "${THEME_DEST}" ]; then
        BACKUP_DIR="${THEME_DEST}_backup_$(date +%Y%m%d_%H%M%S)"
        log_message "Backing up existing theme to: ${BACKUP_DIR}"

        if mv "${THEME_DEST}" "${BACKUP_DIR}"; then
            log_success "Backup created successfully"
        else
            log_warning "Failed to create backup, proceeding anyway..."
        fi
    fi

    # Create theme destination directory
    log_message "Creating theme directory..."
    mkdir -p "${THEME_DEST}"

    # Copy theme files
    log_message "Copying theme files..."
    if cp -R "${THEME_SOURCE}"/* "${THEME_DEST}"/; then
        log_success "Theme files copied successfully"
    else
        log_error "Failed to copy theme files"
        return 1
    fi

    # Set proper permissions
    log_message "Setting file permissions..."
    find "${THEME_DEST}" -type d -exec chmod 755 {} \;
    find "${THEME_DEST}" -type f -exec chmod 644 {} \;
    log_success "Permissions set successfully"

    # Create uploads directory if it doesn't exist
    if [ ! -d "${WP_ROOT}/wp-content/uploads" ]; then
        log_message "Creating uploads directory..."
        mkdir -p "${WP_ROOT}/wp-content/uploads"
        chmod 755 "${WP_ROOT}/wp-content/uploads"
    fi

    # Display deployment summary
    log_message "========================================"
    log_success "Deployment completed successfully!"
    log_message "========================================"
    log_message "Theme Location: ${THEME_DEST}"
    log_message "Next Steps:"
    log_message "1. Add mockup images to: ${THEME_DEST}/assets/images/mockups/"
    log_message "2. Log into WordPress admin"
    log_message "3. Go to Appearance > Themes"
    log_message "4. Activate 'Random Bit Logic' theme"
    log_message "========================================"

    return 0
}

###############################################################################
# Main Execution
###############################################################################

# Create/clear deployment log
echo "Deployment started at $(date '+%Y-%m-%d %H:%M:%S')" > "${DEPLOYMENT_LOG}"

# Run deployment
if deploy_theme; then
    log_success "Deployment script completed successfully"
    exit 0
else
    log_error "Deployment script failed"
    exit 1
fi
