#!/bin/bash

###############################################################################
# Structure Verification Script for Random Bit Logic Theme
#
# This script verifies that all required files are present and properly
# structured for WordPress deployment.
#
# @package RandomBitLogic
# @version 1.0.0
###############################################################################

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Counters
PASSED=0
FAILED=0
WARNINGS=0

###############################################################################
# Functions
###############################################################################

print_header() {
    echo -e "${BLUE}========================================"
    echo "Random Bit Logic Theme Structure Check"
    echo -e "========================================${NC}\n"
}

check_file() {
    local file="$1"
    local description="$2"

    if [ -f "$file" ]; then
        echo -e "${GREEN}✓${NC} $description"
        ((PASSED++))
        return 0
    else
        echo -e "${RED}✗${NC} $description - MISSING: $file"
        ((FAILED++))
        return 1
    fi
}

check_dir() {
    local dir="$1"
    local description="$2"

    if [ -d "$dir" ]; then
        echo -e "${GREEN}✓${NC} $description"
        ((PASSED++))
        return 0
    else
        echo -e "${RED}✗${NC} $description - MISSING: $dir"
        ((FAILED++))
        return 1
    fi
}

check_file_content() {
    local file="$1"
    local pattern="$2"
    local description="$3"

    if [ -f "$file" ] && grep -q "$pattern" "$file"; then
        echo -e "${GREEN}✓${NC} $description"
        ((PASSED++))
        return 0
    else
        echo -e "${YELLOW}⚠${NC} $description - Pattern not found in $file"
        ((WARNINGS++))
        return 1
    fi
}

check_executable() {
    local file="$1"
    local description="$2"

    if [ -x "$file" ]; then
        echo -e "${GREEN}✓${NC} $description"
        ((PASSED++))
        return 0
    else
        echo -e "${YELLOW}⚠${NC} $description - Not executable: $file"
        ((WARNINGS++))
        return 1
    fi
}

###############################################################################
# Checks
###############################################################################

print_header

# Repository root files
echo -e "${BLUE}Repository Root Files:${NC}"
check_file "README.md" "Main documentation"
check_file "CHANGELOG.md" "Changelog"
check_file "CLOUDWAYS-DEPLOYMENT.md" "Cloudways deployment guide"
check_file ".gitignore" "Git ignore file"
check_file ".gitattributes" "Git attributes"
check_file "deploy.sh" "Bash deployment script"
check_file "deploy.php" "PHP deployment script"
check_executable "deploy.sh" "Deploy script is executable"
echo ""

# Theme directory structure
echo -e "${BLUE}Theme Directory Structure:${NC}"
THEME_DIR="wp-content/themes/random-bit-logic"
check_dir "$THEME_DIR" "Theme directory"
check_dir "$THEME_DIR/assets" "Assets directory"
check_dir "$THEME_DIR/assets/js" "JavaScript directory"
check_dir "$THEME_DIR/assets/images" "Images directory"
check_dir "$THEME_DIR/assets/images/mockups" "Mockups directory"
echo ""

# Required theme files
echo -e "${BLUE}Required Theme Files:${NC}"
check_file "$THEME_DIR/style.css" "Main stylesheet"
check_file "$THEME_DIR/functions.php" "Theme functions"
check_file "$THEME_DIR/index.php" "Main template"
check_file "$THEME_DIR/header.php" "Header template"
check_file "$THEME_DIR/footer.php" "Footer template"
check_file "$THEME_DIR/INSTALLATION.md" "Installation guide"
echo ""

# JavaScript files
echo -e "${BLUE}JavaScript Files:${NC}"
check_file "$THEME_DIR/assets/js/scroll-animations.js" "Scroll animations script"
check_file "$THEME_DIR/assets/js/main.js" "Main JavaScript file"
echo ""

# Theme file content validation
echo -e "${BLUE}Theme File Content:${NC}"
check_file_content "$THEME_DIR/style.css" "Theme Name:" "Theme header in style.css"
check_file_content "$THEME_DIR/style.css" "Random Bit Logic" "Theme name declared"
check_file_content "$THEME_DIR/style.css" "Version: 1.0.0" "Version number"
check_file_content "$THEME_DIR/functions.php" "rbl_theme_setup" "Theme setup function"
check_file_content "$THEME_DIR/index.php" "get_header" "Header template call"
check_file_content "$THEME_DIR/index.php" "get_footer" "Footer template call"
echo ""

# Check for mockup images (warning only, as they need to be added manually)
echo -e "${BLUE}Mockup Images (Manual Upload Required):${NC}"
if [ -f "$THEME_DIR/assets/images/mockups/phone-mockup.png" ]; then
    echo -e "${GREEN}✓${NC} Phone mockup image present"
    ((PASSED++))
else
    echo -e "${YELLOW}⚠${NC} Phone mockup image not found (needs manual upload)"
    ((WARNINGS++))
fi

if [ -f "$THEME_DIR/assets/images/mockups/laptop-mockup.png" ]; then
    echo -e "${GREEN}✓${NC} Laptop mockup image present"
    ((PASSED++))
else
    echo -e "${YELLOW}⚠${NC} Laptop mockup image not found (needs manual upload)"
    ((WARNINGS++))
fi

if [ -f "$THEME_DIR/assets/images/mockups/seatserve-phones.png" ]; then
    echo -e "${GREEN}✓${NC} SeatServe mockup image present"
    ((PASSED++))
else
    echo -e "${YELLOW}⚠${NC} SeatServe mockup image not found (needs manual upload)"
    ((WARNINGS++))
fi
echo ""

# Deployment readiness
echo -e "${BLUE}Deployment Readiness:${NC}"
if [ -f "deploy.sh" ] && [ -x "deploy.sh" ]; then
    echo -e "${GREEN}✓${NC} Deployment script ready"
    ((PASSED++))
else
    echo -e "${RED}✗${NC} Deployment script not executable"
    ((FAILED++))
fi

if [ -f ".gitignore" ]; then
    echo -e "${GREEN}✓${NC} Git configuration present"
    ((PASSED++))
else
    echo -e "${YELLOW}⚠${NC} Missing .gitignore"
    ((WARNINGS++))
fi

if [ -d ".git" ]; then
    echo -e "${GREEN}✓${NC} Git repository initialized"
    ((PASSED++))
else
    echo -e "${YELLOW}⚠${NC} Not a git repository"
    ((WARNINGS++))
fi
echo ""

###############################################################################
# Summary
###############################################################################

echo -e "${BLUE}========================================${NC}"
echo -e "Summary:"
echo -e "  ${GREEN}Passed:${NC} $PASSED"
echo -e "  ${YELLOW}Warnings:${NC} $WARNINGS"
echo -e "  ${RED}Failed:${NC} $FAILED"
echo -e "${BLUE}========================================${NC}\n"

if [ $FAILED -eq 0 ]; then
    echo -e "${GREEN}✓ Structure verification PASSED!${NC}"
    echo -e "Theme is ready for deployment.\n"

    if [ $WARNINGS -gt 0 ]; then
        echo -e "${YELLOW}Note: Some warnings were found (usually mockup images).${NC}"
        echo -e "These can be added after deployment.\n"
    fi

    echo "Next steps:"
    echo "1. Commit and push to Git repository"
    echo "2. Configure Cloudways Git Deployment"
    echo "3. Deploy using: bash deploy.sh"
    echo "4. Upload mockup images after deployment"
    echo "5. Activate theme in WordPress admin"
    exit 0
else
    echo -e "${RED}✗ Structure verification FAILED!${NC}"
    echo -e "Please fix the missing files/directories before deployment.\n"
    exit 1
fi
