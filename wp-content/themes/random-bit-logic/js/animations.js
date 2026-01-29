/**
 * Simetrik-style Scroll Animations
 * Simple fade-in animations triggered on scroll
 */

(function() {
    'use strict';

    // Page load transition for non-home pages
    function initPageTransition() {
        // Skip if on home page (WordPress adds 'home' class to body)
        if (document.body.classList.contains('home')) {
            return;
        }

        // Add page-loaded class after a minimal delay to ensure CSS is ready
        // Using requestAnimationFrame for smoother timing
        requestAnimationFrame(function() {
            requestAnimationFrame(function() {
                document.body.classList.add('page-loaded');
            });
        });
    }

    // Intersection Observer for fade-in animations
    function initScrollAnimations() {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -100px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Optionally unobserve after animation
                    // observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        const fadeElements = document.querySelectorAll('.fade-in, .fade-in-phone');
        fadeElements.forEach(element => {
            observer.observe(element);
        });
    }

    // Smooth scroll for anchor links
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Skip empty hash or just "#"
                if (!href || href === '#') return;

                const targetId = href.substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    e.preventDefault();
                    const headerOffset = 80;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // Header scroll effect
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });
    }

    // Animated placeholder for AI demo input
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

    // Typing animation for hero headline
    function initHeroTypingAnimation() {
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

    // Three.js animated element in hero
    function initThreeJS() {
        // Check if THREE is available
        if (typeof THREE === 'undefined') {
            console.warn('Three.js is not loaded');
            return;
        }

        const container = document.getElementById('canvas-container');
        if (!container) return;

        const scene = new THREE.Scene();

        // Camera Setup
        const camera = new THREE.PerspectiveCamera(50, container.clientWidth / container.clientHeight, 0.1, 1000);
        camera.position.z = 20;

        // Renderer Setup
        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        container.appendChild(renderer.domElement);

        // Create the Wireframe Sphere
        const geometry = new THREE.IcosahedronGeometry(6, 1);
        const material = new THREE.MeshBasicMaterial({
            color: 0x0016FD,
            wireframe: true,
            transparent: true,
            opacity: 0.25
        });
        const sphere = new THREE.Mesh(geometry, material);
        scene.add(sphere);

        // Create the Floating Particles
        const particlesGeo = new THREE.BufferGeometry();
        const particlesCount = 120;
        const posArray = new Float32Array(particlesCount * 3);

        for (let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 12;
        }

        particlesGeo.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
        const particlesMat = new THREE.PointsMaterial({
            size: 0.2,
            color: 0x0016FD,
            transparent: true,
            opacity: 0.6
        });
        const particles = new THREE.Points(particlesGeo, particlesMat);
        scene.add(particles);

        // Animation Loop
        const animate = () => {
            requestAnimationFrame(animate);
            sphere.rotation.y += 0.002;
            sphere.rotation.x += 0.001;
            particles.rotation.y -= 0.001;
            renderer.render(scene, camera);
        };

        animate();

        // Handle Window Resize
        window.addEventListener('resize', () => {
            const width = container.clientWidth;
            const height = container.clientHeight;
            renderer.setSize(width, height);
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
        });
    }

    // Three.js animated sphere for contact section
    function initContactThreeJS() {
        // Check if THREE is available
        if (typeof THREE === 'undefined') {
            console.warn('Three.js is not loaded');
            return;
        }

        const container = document.getElementById('contact-canvas-container');
        if (!container) return;

        const scene = new THREE.Scene();

        // Camera Setup - smaller sphere
        const camera = new THREE.PerspectiveCamera(50, container.clientWidth / container.clientHeight, 0.1, 1000);
        camera.position.z = 12;

        // Renderer Setup
        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        container.appendChild(renderer.domElement);

        // Create the Wireframe Sphere - smaller size
        const geometry = new THREE.IcosahedronGeometry(4, 1);
        const material = new THREE.MeshBasicMaterial({
            color: 0x4f46e5,
            wireframe: true,
            transparent: true,
            opacity: 0.5
        });
        const sphere = new THREE.Mesh(geometry, material);
        scene.add(sphere);

        // Create the Floating Particles - fewer particles
        const particlesGeo = new THREE.BufferGeometry();
        const particlesCount = 80;
        const posArray = new Float32Array(particlesCount * 3);

        for (let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 10;
        }

        particlesGeo.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
        const particlesMat = new THREE.PointsMaterial({
            size: 0.1,
            color: 0x4f46e5,
            transparent: true,
            opacity: 0.5
        });
        const particles = new THREE.Points(particlesGeo, particlesMat);
        scene.add(particles);

        // Animation Loop
        const animate = () => {
            requestAnimationFrame(animate);
            sphere.rotation.y += 0.002;
            sphere.rotation.x += 0.001;
            particles.rotation.y -= 0.001;
            renderer.render(scene, camera);
        };

        animate();

        // Handle Window Resize
        window.addEventListener('resize', () => {
            const width = container.clientWidth;
            const height = container.clientHeight;
            renderer.setSize(width, height);
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
        });
    }

    // Initialize all animations when DOM is ready
    function init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                initPageTransition();
                initScrollAnimations();
                initSmoothScroll();
                initHeaderScroll();
                initAnimatedPlaceholder();
                initHeroTypingAnimation();
                initThreeJS();
                initContactThreeJS();
            });
        } else {
            initPageTransition();
            initScrollAnimations();
            initSmoothScroll();
            initHeaderScroll();
            initAnimatedPlaceholder();
            initHeroTypingAnimation();
            initThreeJS();
            initContactThreeJS();
        }
    }

    init();
})();
