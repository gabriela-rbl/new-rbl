/**
 * Hero Section Animations
 * Handles rotating text, animated counters, and interactive effects
 */

(function() {
    'use strict';

    /**
     * Initialize all hero animations
     */
    function init() {
        initRotatingText();
        initAnimatedCounters();
        initInteractiveShapes();
        initParticleEffect();
        initTypingAnimation();
    }

    /**
     * Rotating text animation in headline
     */
    function initRotatingText() {
        const rotatingContainer = document.querySelector('.headline-rotating');
        if (!rotatingContainer) return;

        const texts = rotatingContainer.querySelectorAll('.rotate-text');
        if (texts.length === 0) return;

        let currentIndex = 0;

        function rotateText() {
            // Remove active class from current text
            texts[currentIndex].classList.remove('active');

            // Move to next text
            currentIndex = (currentIndex + 1) % texts.length;

            // Add active class to next text
            texts[currentIndex].classList.add('active');
        }

        // Rotate every 3 seconds
        setInterval(rotateText, 3000);
    }

    /**
     * Typing animation for hero headline last word
     */
    function initTypingAnimation() {
        const typingElement = document.querySelector('.typing-word');
        if (!typingElement) return;

        const words = ['workflow', 'process', 'report', 'operation'];
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let isPaused = false;

        function type() {
            const currentWord = words[wordIndex];

            if (isPaused) {
                isPaused = false;
                setTimeout(type, 1500); // Pause for 1.5 seconds before deleting
                return;
            }

            if (isDeleting) {
                // Remove characters
                typingElement.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;

                if (charIndex === 0) {
                    isDeleting = false;
                    wordIndex = (wordIndex + 1) % words.length;
                    setTimeout(type, 500); // Pause before typing next word
                    return;
                }
            } else {
                // Add characters
                typingElement.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;

                if (charIndex === currentWord.length) {
                    isDeleting = true;
                    isPaused = true;
                    setTimeout(type, 2000); // Pause when word is complete
                    return;
                }
            }

            // Typing speed: faster when deleting
            const typeSpeed = isDeleting ? 50 : 100;
            setTimeout(type, typeSpeed);
        }

        // Start typing animation after initial delay
        setTimeout(type, 500);
    }

    /**
     * Animated number counters
     */
    function initAnimatedCounters() {
        const counters = document.querySelectorAll('.stat-number');
        if (counters.length === 0) return;

        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        counters.forEach(counter => observer.observe(counter));
    }

    /**
     * Animate a single counter
     */
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const steps = 60;
        const stepDuration = duration / steps;
        const increment = target / steps;
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = Math.ceil(target);
                clearInterval(timer);
            } else {
                element.textContent = Math.ceil(current);
            }
        }, stepDuration);
    }

    /**
     * Interactive geometric shapes that respond to mouse movement
     */
    function initInteractiveShapes() {
        const shapes = document.querySelectorAll('.hero-shape');
        if (shapes.length === 0) return;

        let mouseX = 0;
        let mouseY = 0;
        let targetX = 0;
        let targetY = 0;

        // Track mouse movement
        document.addEventListener('mousemove', (e) => {
            mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
            mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
        });

        // Animate shapes based on mouse position
        function animateShapes() {
            targetX += (mouseX - targetX) * 0.05;
            targetY += (mouseY - targetY) * 0.05;

            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 15;
                const x = targetX * speed;
                const y = targetY * speed;

                // Get current transform from CSS animation
                const currentTransform = window.getComputedStyle(shape).transform;

                // Apply additional transform for mouse interaction
                shape.style.transform = `${currentTransform} translate(${x}px, ${y}px)`;
            });

            requestAnimationFrame(animateShapes);
        }

        // Only run on desktop to improve performance
        if (window.innerWidth > 768) {
            animateShapes();
        }

        // Add hover effect to shapes
        shapes.forEach(shape => {
            shape.addEventListener('mouseenter', function() {
                this.style.opacity = '0.25';
                this.style.filter = 'drop-shadow(0 0 30px rgba(75, 88, 255, 0.4))';
            });

            shape.addEventListener('mouseleave', function() {
                this.style.opacity = '0.12';
                this.style.filter = 'drop-shadow(0 0 20px rgba(75, 88, 255, 0.2))';
            });
        });
    }

    /**
     * Create dynamic particle effect
     */
    function initParticleEffect() {
        const particleSystem = document.querySelector('.particle-system');
        if (!particleSystem) return;

        // Only add extra particles on desktop
        if (window.innerWidth < 768) return;

        // Create floating particles
        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.className = 'floating-particle';

            // Random position
            const x = Math.random() * 100;
            const y = Math.random() * 100;
            const size = Math.random() * 4 + 2;
            const duration = Math.random() * 10 + 15;
            const delay = Math.random() * 5;

            particle.style.cssText = `
                position: absolute;
                left: ${x}%;
                top: ${y}%;
                width: ${size}px;
                height: ${size}px;
                background: rgba(75, 88, 255, 0.3);
                border-radius: 50%;
                pointer-events: none;
                animation: floatParticle ${duration}s ease-in-out infinite;
                animation-delay: ${delay}s;
            `;

            particleSystem.appendChild(particle);
        }

        // Add particle animation CSS if not exists
        if (!document.getElementById('particle-animation-styles')) {
            const style = document.createElement('style');
            style.id = 'particle-animation-styles';
            style.textContent = `
                @keyframes floatParticle {
                    0%, 100% {
                        transform: translate(0, 0) scale(1);
                        opacity: 0.3;
                    }
                    25% {
                        transform: translate(20px, -40px) scale(1.2);
                        opacity: 0.5;
                    }
                    50% {
                        transform: translate(-10px, -80px) scale(0.8);
                        opacity: 0.3;
                    }
                    75% {
                        transform: translate(-30px, -40px) scale(1.1);
                        opacity: 0.4;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }

    /**
     * Add scroll-triggered animations for hero elements
     */
    function initScrollTriggers() {
        const heroContent = document.querySelector('.hero-content');
        if (!heroContent) return;

        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroHeight = document.querySelector('.hero').offsetHeight;

            if (scrolled < heroHeight) {
                const opacity = 1 - (scrolled / heroHeight);
                const scale = 1 - (scrolled / heroHeight) * 0.1;

                heroContent.style.opacity = opacity;
                heroContent.style.transform = `scale(${scale})`;
            }
        }, { passive: true });
    }

    /**
     * Add typing effect to description (optional enhancement)
     */
    function initTypingEffect() {
        const description = document.querySelector('.hero-description');
        if (!description || !description.hasAttribute('data-typing')) return;

        const text = description.textContent;
        description.textContent = '';
        description.style.opacity = '1';

        let charIndex = 0;
        const typingSpeed = 30;

        function typeChar() {
            if (charIndex < text.length) {
                description.textContent += text.charAt(charIndex);
                charIndex++;
                setTimeout(typeChar, typingSpeed);
            }
        }

        // Start typing after a delay
        setTimeout(typeChar, 1000);
    }

    /**
     * Enhance CTA buttons with ripple effect
     */
    function initCTARippleEffect() {
        const ctas = document.querySelectorAll('.hero-cta');

        ctas.forEach(cta => {
            cta.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.5);
                    left: ${x}px;
                    top: ${y}px;
                    pointer-events: none;
                    animation: ripple 0.6s ease-out;
                `;

                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple animation CSS
        if (!document.getElementById('ripple-animation-styles')) {
            const style = document.createElement('style');
            style.id = 'ripple-animation-styles';
            style.textContent = `
                @keyframes ripple {
                    from {
                        transform: scale(0);
                        opacity: 1;
                    }
                    to {
                        transform: scale(2);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }

    /**
     * Performance-optimized resize handler
     */
    function handleResize() {
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                // Reinitialize effects that depend on window size
                if (window.innerWidth > 768) {
                    initInteractiveShapes();
                    initParticleEffect();
                }
            }, 250);
        });
    }

    /**
     * Initialize on DOM ready
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            init();
            initScrollTriggers();
            initCTARippleEffect();
            handleResize();
        });
    } else {
        init();
        initScrollTriggers();
        initCTARippleEffect();
        handleResize();
    }

    /**
     * Expose public API
     */
    window.RBLHeroAnimations = {
        init: init,
        animateCounter: animateCounter
    };

})();
