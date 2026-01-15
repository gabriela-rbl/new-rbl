/**
 * Main JavaScript for Random Bit Logic Theme
 * Handles form validation, interactions, and additional functionality
 */

(function() {
    'use strict';

    /**
     * Initialize all functionality
     */
    function init() {
        initContactForm();
        initMockupAnimations();
        initGeometricShapes();
        handleHashNavigation();
    }

    /**
     * Contact form validation and handling
     */
    function initContactForm() {
        const form = document.getElementById('contactForm');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            // Basic validation
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();

            if (!name || !email || !message) {
                e.preventDefault();
                alert('Please fill in all required fields.');
                return false;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                return false;
            }

            // Show loading state
            const submitButton = form.querySelector('.submit-button');
            if (submitButton) {
                submitButton.textContent = 'Sending...';
                submitButton.disabled = true;
            }

            // Form will submit normally to PHP handler
            return true;
        });

        // Add input animations
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    }

    /**
     * Enhanced mockup animations
     */
    function initMockupAnimations() {
        const mockups = document.querySelectorAll('.mockup-image');

        mockups.forEach(mockup => {
            // Add hover effect
            mockup.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05) translateY(-10px)';
            });

            mockup.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) translateY(0)';
            });

            // Add load animation
            if (mockup.complete) {
                mockup.style.opacity = '1';
            } else {
                mockup.addEventListener('load', function() {
                    this.style.opacity = '1';
                });
            }
        });
    }

    /**
     * Dynamic geometric shapes animation
     */
    function initGeometricShapes() {
        const shapesContainer = document.querySelector('.geometric-shapes');
        if (!shapesContainer) return;

        // Add mouse move parallax
        let mouseX = 0;
        let mouseY = 0;
        let targetX = 0;
        let targetY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX / window.innerWidth - 0.5;
            mouseY = e.clientY / window.innerHeight - 0.5;
        });

        function animateShapes() {
            targetX += (mouseX - targetX) * 0.05;
            targetY += (mouseY - targetY) * 0.05;

            const shapes = shapesContainer.querySelectorAll('.shape');
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 10;
                const x = targetX * speed;
                const y = targetY * speed;
                shape.style.transform = `translate(${x}px, ${y}px)`;
            });

            requestAnimationFrame(animateShapes);
        }

        // Only run on desktop
        if (window.innerWidth > 768) {
            animateShapes();
        }
    }

    /**
     * Handle hash navigation on page load
     */
    function handleHashNavigation() {
        if (window.location.hash) {
            const hash = window.location.hash;
            const targetElement = document.querySelector(hash);

            if (targetElement) {
                // Wait for page to fully load
                setTimeout(() => {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            }
        }
    }

    /**
     * Preload images
     */
    function preloadImages() {
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }

    /**
     * Add scroll progress indicator
     */
    function addScrollProgress() {
        // Create progress bar
        const progressBar = document.createElement('div');
        progressBar.className = 'scroll-progress';
        progressBar.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #0066ff, #00ff88);
            z-index: 9999;
            transition: width 0.1s ease-out;
        `;
        document.body.appendChild(progressBar);

        // Update on scroll
        window.addEventListener('scroll', () => {
            const windowHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = (window.pageYOffset / windowHeight) * 100;
            progressBar.style.width = scrolled + '%';
        }, { passive: true });
    }

    /**
     * Performance monitoring (optional)
     */
    function monitorPerformance() {
        if ('PerformanceObserver' in window) {
            const observer = new PerformanceObserver((list) => {
                for (const entry of list.getEntries()) {
                    // Log performance metrics (optional - can be sent to analytics)
                    if (entry.entryType === 'largest-contentful-paint') {
                        console.log('LCP:', entry.startTime);
                    }
                }
            });

            observer.observe({ entryTypes: ['largest-contentful-paint'] });
        }
    }

    /**
     * Initialize on DOM ready
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            init();
            preloadImages();
            addScrollProgress();
        });
    } else {
        init();
        preloadImages();
        addScrollProgress();
    }

    /**
     * Expose public API
     */
    window.RBLMain = {
        init: init
    };

})();
