/**
 * Theme Utilities
 * Handles theme-aware features like favicon switching
 */

(function() {
    'use strict';

    /**
     * Initialize theme-aware favicon switching
     * Switches between light and dark favicons based on user's color scheme preference
     */
    function initFaviconSwitcher() {
        const faviconLight = document.getElementById('favicon-light');
        const faviconDark = document.getElementById('favicon-dark');
        const faviconDefault = document.getElementById('favicon-default');

        // Check if favicons exist
        if (!faviconLight || !faviconDark || !faviconDefault) {
            console.warn('Favicon elements not found');
            return;
        }

        // Get theme directory URI
        const getThemeURI = () => {
            const favicon = faviconLight.href;
            return favicon.substring(0, favicon.lastIndexOf('/'));
        };

        const themeURI = getThemeURI();

        /**
         * Update favicon based on color scheme
         */
        function updateFavicon(isDark) {
            if (isDark) {
                faviconDefault.href = `${themeURI}/favicon-dark.svg`;
            } else {
                faviconDefault.href = `${themeURI}/favicon-light.svg`;
            }
        }

        // Check initial preference
        const darkModeQuery = window.matchMedia('(prefers-color-scheme: dark)');
        updateFavicon(darkModeQuery.matches);

        // Listen for changes in color scheme preference
        darkModeQuery.addEventListener('change', (e) => {
            updateFavicon(e.matches);
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFaviconSwitcher);
    } else {
        initFaviconSwitcher();
    }

})();
