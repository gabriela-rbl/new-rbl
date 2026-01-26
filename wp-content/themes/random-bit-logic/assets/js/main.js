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
        initStickyHeader();
        initAnimatedPlaceholder();
        initMobileMenu();
        initConsultationPopup();
    }

    /**
     * Mobile menu toggle functionality
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileNavOverlay = document.querySelector('.mobile-nav-overlay');
        const mobileNavLinks = document.querySelectorAll('.mobile-nav a, .mobile-nav .mobile-login');

        if (!menuToggle || !mobileNavOverlay) return;

        // Toggle menu on button click
        menuToggle.addEventListener('click', function() {
            const isActive = this.classList.contains('active');

            if (isActive) {
                // Close menu
                this.classList.remove('active');
                mobileNavOverlay.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                // Open menu
                this.classList.add('active');
                mobileNavOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });

        // Close menu when clicking on a link
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                menuToggle.classList.remove('active');
                mobileNavOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        // Close menu on window resize if open
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                menuToggle.classList.remove('active');
                mobileNavOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    /**
     * Consultation Popup functionality
     */
    function initConsultationPopup() {
        const popup = document.getElementById('consultationPopup');
        const closeBtn = document.querySelector('.consultation-popup-close');
        const overlay = document.querySelector('.consultation-popup-overlay');
        const ctaButtons = document.querySelectorAll('.client-cta, .open-consultation-popup');
        const dateInput = document.getElementById('consultationDate');

        if (!popup) return;

        // Function to open popup
        function openPopup(e) {
            e.preventDefault();
            popup.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Function to close popup
        function closePopup() {
            popup.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Add event listeners to all CTA buttons
        ctaButtons.forEach(button => {
            button.addEventListener('click', openPopup);
        });

        // Close button
        if (closeBtn) {
            closeBtn.addEventListener('click', closePopup);
        }

        // Overlay click
        if (overlay) {
            overlay.addEventListener('click', closePopup);
        }

        // Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && popup.classList.contains('active')) {
                closePopup();
            }
        });

        // Initialize Flatpickr datepicker
        if (dateInput && typeof flatpickr !== 'undefined') {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            flatpickr(dateInput, {
                minDate: tomorrow,
                dateFormat: 'Y-m-d',
                disable: [
                    function(date) {
                        // Disable weekends (0 = Sunday, 6 = Saturday)
                        return (date.getDay() === 0 || date.getDay() === 6);
                    }
                ],
                locale: {
                    firstDayOfWeek: 1 // Start week on Monday
                },
                onChange: function(selectedDates, dateStr, instance) {
                    // Additional validation if needed
                },
                onReady: function(selectedDates, dateStr, instance) {
                    // Add custom class for styling
                    instance.calendarContainer.classList.add('rbl-datepicker');
                }
            });
        }

        // Form submission handling
        const consultationForm = document.getElementById('consultationForm');
        if (consultationForm) {
            consultationForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Basic validation
                const formData = new FormData(this);
                const service = formData.get('service');
                const name = formData.get('name');
                const email = formData.get('email');
                const date = formData.get('consultation_date');
                const time = formData.get('consultation_time');
                const message = formData.get('message');

                if (!service || !name || !email || !date || !time || !message) {
                    alert('Please fill in all required fields.');
                    return false;
                }

                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert('Please enter a valid email address.');
                    return false;
                }

                // Show loading state
                const submitButton = this.querySelector('.submit-btn');
                const originalText = submitButton.textContent;
                submitButton.textContent = 'Scheduling...';
                submitButton.disabled = true;

                // Add submit button name to FormData (required for plugin detection)
                formData.append('rbl_consultation_submit', '1');

                // Send AJAX request
                fetch(window.location.href, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Invalid response format. Please try again.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Success - show success message and hide form
                        const successMessage = document.getElementById('consultationSuccessMessage');
                        if (successMessage) {
                            consultationForm.style.display = 'none';
                            successMessage.style.display = 'block';

                            // Auto-close popup after 5 seconds
                            setTimeout(() => {
                                closePopup();
                                // Reset form and show it again for next time
                                consultationForm.style.display = 'block';
                                successMessage.style.display = 'none';
                                consultationForm.reset();
                            }, 5000);
                        }
                    } else {
                        throw new Error(data.data.message || 'Submission failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error submitting the form. Please try again.');
                })
                .finally(() => {
                    // Reset button
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                });

                return false;
            });
        }
    }

    /**
     * Sticky header with glassmorphism on scroll
     */
    function initStickyHeader() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                    if (scrollTop > 50) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }

                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }

    /**
     * Animated placeholder for AI demo input
     */
    function initAnimatedPlaceholder() {
        const input = document.querySelector('.demo-input');
        if (!input) return;

        const phrases = [
            'Are you ready to prepare your year-end audit documents?',
            'Want to see the status of yesterday\'s exceptions?',
            'Would you like to review your current transactional and financial controls?',
            'How can I help optimize your workflow today?',
            'What business process would you like to automate?'
        ];

        let phraseIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let isPaused = false;

        function typeEffect() {
            const currentPhrase = phrases[phraseIndex];

            if (!isDeleting && charIndex <= currentPhrase.length) {
                // Typing
                input.setAttribute('placeholder', currentPhrase.substring(0, charIndex));
                charIndex++;

                if (charIndex > currentPhrase.length) {
                    // Pause at end of phrase
                    isPaused = true;
                    setTimeout(() => {
                        isPaused = false;
                        isDeleting = true;
                        typeEffect();
                    }, 3000); // Pause for 3 seconds
                    return;
                }
            } else if (isDeleting && charIndex >= 0) {
                // Deleting
                input.setAttribute('placeholder', currentPhrase.substring(0, charIndex));
                charIndex--;

                if (charIndex < 0) {
                    // Move to next phrase
                    isDeleting = false;
                    phraseIndex = (phraseIndex + 1) % phrases.length;
                    charIndex = 0;
                    setTimeout(typeEffect, 500); // Pause before next phrase
                    return;
                }
            }

            // Typing speed
            const typingSpeed = isDeleting ? 30 : 50;
            if (!isPaused) {
                setTimeout(typeEffect, typingSpeed);
            }
        }

        // Start the animation
        typeEffect();

        // Prevent input interaction (demo only)
        input.addEventListener('focus', function() {
            this.blur();
        });
    }

    /**
     * Contact form validation and handling
     */
    function initContactForm() {
        const form = document.getElementById('contactForm');
        if (!form) return;

        // Dynamic field toggle based on service selection
        const serviceSelect = document.getElementById('serviceSelect');
        const dynamicLabel = document.getElementById('dynamic-label');
        const dynamicInput = document.getElementById('message');

        if (serviceSelect && dynamicLabel && dynamicInput) {
            serviceSelect.addEventListener('change', function() {
                const service = this.value;
                let label = 'Tell us about your project';
                let placeholder = 'Briefly describe your goals...';

                switch(service) {
                    case 'strategy':
                        label = 'What business challenge are you looking to solve?';
                        placeholder = 'Describe your current process and goals...';
                        break;
                    case 'ai':
                        label = 'What processes would you like to automate?';
                        placeholder = 'Describe your automation needs...';
                        break;
                    case 'software':
                        label = 'What type of software do you need?';
                        placeholder = 'Describe your software requirements...';
                        break;
                    case 'web':
                        label = 'Tell us about your web project';
                        placeholder = 'Describe your website goals...';
                        break;
                    case 'other':
                        label = 'How can we help you?';
                        placeholder = 'Tell us what you have in mind...';
                        break;
                }

                dynamicLabel.textContent = label;
                dynamicInput.placeholder = placeholder;
            });
        }

        // AJAX form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic validation
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();
            const service = document.getElementById('serviceSelect').value;

            if (!name || !email || !message || !service) {
                alert('Please fill in all required fields.');
                return false;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }

            // Show loading state
            const submitButton = form.querySelector('.submit-btn');
            const originalText = submitButton.textContent;
            if (submitButton) {
                submitButton.textContent = 'Sending...';
                submitButton.disabled = true;
            }

            // Prepare form data
            const formData = new FormData(form);

            // Add submit button name to FormData (required for plugin detection)
            formData.append('rbl_contact_submit', '1');

            // Send AJAX request
            fetch(window.location.href, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Invalid response format. Please try again.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Success - show success message and hide form
                    const successMessage = document.getElementById('contactSuccessMessage');
                    if (successMessage) {
                        form.style.display = 'none';
                        successMessage.style.display = 'block';

                        // Scroll to success message
                        successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });

                        // Reset form after a delay
                        setTimeout(() => {
                            form.style.display = 'block';
                            successMessage.style.display = 'none';
                            form.reset();
                        }, 5000);
                    }

                    // Reset button
                    if (submitButton) {
                        submitButton.textContent = originalText;
                        submitButton.disabled = false;
                    }
                } else {
                    throw new Error(data.data.message || 'Submission failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error submitting the form. Please try again.');

                // Reset button
                if (submitButton) {
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                }
            });

            return false;
        });

        // Add input animations
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.classList.remove('focused');
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
