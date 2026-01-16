<?php get_header(); ?>

<!-- Hero Section -->
<section id="hero" class="section hero">
    <!-- Enhanced Geometric Background -->
    <div class="geometric-canvas">
        <!-- Animated Grid Background -->
        <div class="geometric-grid"></div>

        <!-- Large Geometric Shapes -->
        <div class="hero-shapes">
            <div class="hero-shape shape-hexagon shape-1">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="50 1 95 25 95 75 50 99 5 75 5 25" />
                </svg>
            </div>
            <div class="hero-shape shape-circle shape-2">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="48" />
                </svg>
            </div>
            <div class="hero-shape shape-triangle shape-3">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="50 5 95 90 5 90" />
                </svg>
            </div>
            <div class="hero-shape shape-square shape-4">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <rect x="10" y="10" width="80" height="80" />
                </svg>
            </div>
            <div class="hero-shape shape-pentagon shape-5">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="50 1 98 35 79 90 21 90 2 35" />
                </svg>
            </div>
        </div>

        <!-- Floating Particles -->
        <div class="particle-system"></div>
    </div>

    <div class="container">
        <div class="hero-content">
            <!-- Geometric Badge -->
            <div class="hero-badge">
                <svg class="badge-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="12 2 19 7 19 17 12 22 5 17 5 7" stroke="currentColor" stroke-width="2" fill="none"/>
                    <circle cx="12" cy="12" r="3" fill="currentColor"/>
                </svg>
                <span>Where Geometry Meets Innovation</span>
            </div>

            <!-- Main Headline with Rotating Text -->
            <h1 class="hero-headline">
                Transform Your Business with
                <span class="headline-rotating">
                    <span class="rotate-text active" data-text="AI Automation">AI Automation</span>
                    <span class="rotate-text" data-text="Custom Software">Custom Software</span>
                    <span class="rotate-text" data-text="Smart Solutions">Smart Solutions</span>
                    <span class="rotate-text" data-text="Strategic Innovation">Strategic Innovation</span>
                </span>
            </h1>

            <!-- Value Proposition -->
            <p class="hero-description">
                We engineer <strong>custom AI-powered platforms</strong> that eliminate operational bottlenecks,
                automate complex workflows, and deliver <strong>measurable ROI</strong>.
                From strategy to deployment—tailored for enterprise decision-makers who demand results.
            </p>

            <!-- Animated Stats -->
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15 8.5L22 9.3L17 14L18.5 21L12 17.5L5.5 21L7 14L2 9.3L9 8.5L12 2Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number" data-target="50">0</span><span class="stat-suffix">+</span>
                        <span class="stat-label">Projects Delivered</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number" data-target="40">0</span><span class="stat-suffix">%</span>
                        <span class="stat-label">Avg. Efficiency Gain</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number" data-target="24">0</span><span class="stat-suffix">h</span>
                        <span class="stat-label">Strategy Response</span>
                    </div>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="hero-ctas">
                <a href="#contact" class="hero-cta primary-cta">
                    <span class="cta-text">Book Strategy Session</span>
                    <svg class="cta-arrow" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </a>
                <a href="#capabilities" class="hero-cta secondary-cta">
                    <span class="cta-text">Explore Solutions</span>
                </a>
            </div>

            <!-- Trust Indicators -->
            <div class="hero-trust">
                <span class="trust-label">Trusted by innovative companies worldwide</span>
                <div class="trust-badges">
                    <div class="trust-badge">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span>ISO Certified</span>
                    </div>
                    <div class="trust-badge">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7V12C2 17.5 6 21.5 12 22C18 21.5 22 17.5 22 12V7L12 2Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span>Enterprise Ready</span>
                    </div>
                    <div class="trust-badge">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15.5 8.5L22 9.5L17 14.5L18.5 21L12 17.5L5.5 21L7 14.5L2 9.5L8.5 8.5L12 2Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span>5-Star Rated</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <span>Scroll to explore</span>
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 5V19M12 19L19 12M12 19L5 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
</section>

<!-- Capabilities Section -->
<section id="capabilities" class="section capabilities-section">
    <div class="container">
        <div class="capabilities-header">
            <h2 class="capabilities-title">
                Digital craftsmanship meets<br>
                <span class="gradient-text">intelligent automation.</span>
            </h2>
            <p class="capabilities-subtitle">
                Our comprehensive technical services are designed to solve complex operational challenges for your company.
            </p>
        </div>

        <div class="capabilities-grid">
            <!-- AI & Process Automation Card -->
            <div class="capability-card" data-capability="ai">
                <div class="card-number">01</div>
                <div class="card-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 4L6 14V34L24 44L42 34V14L24 4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M24 24L24 44" stroke="currentColor" stroke-width="2"/>
                        <path d="M6 14L24 24L42 14" stroke="currentColor" stroke-width="2"/>
                        <circle cx="24" cy="24" r="4" fill="currentColor"/>
                    </svg>
                </div>
                <h3 class="card-title">AI & Process Automation</h3>
                <p class="card-description">
                    We integrate Large Language Models (LLMs) and intelligent workflows directly into your existing operations. Reduce manual data entry, automate customer support, and turn "AI Hype" into practical utility.
                </p>
                <div class="card-glow"></div>
            </div>

            <!-- Web Platforms Card -->
            <div class="capability-card" data-capability="web">
                <div class="card-number">02</div>
                <div class="card-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="10" width="40" height="28" rx="2" stroke="currentColor" stroke-width="2"/>
                        <path d="M4 18H44" stroke="currentColor" stroke-width="2"/>
                        <circle cx="10" cy="14" r="1.5" fill="currentColor"/>
                        <circle cx="15" cy="14" r="1.5" fill="currentColor"/>
                        <circle cx="20" cy="14" r="1.5" fill="currentColor"/>
                        <path d="M14 26L20 32L34 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="card-title">Web Platforms</h3>
                <p class="card-description">
                    High-performance web applications built on the language and platform that suits your business best. We prioritize speed, SEO, and scalability with good user experience for easy adoption.
                </p>
                <div class="card-glow"></div>
            </div>

            <!-- Custom Software Card -->
            <div class="capability-card" data-capability="software">
                <div class="card-number">03</div>
                <div class="card-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 14L8 24L16 34" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M32 14L40 24L32 34" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M28 10L20 38" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 class="card-title">Custom Software</h3>
                <p class="card-description">
                    When off-the-shelf SaaS fails, we build the bridge. Custom inventory management, portals, and API integrations tailored to your logic.
                </p>
                <div class="card-glow"></div>
            </div>

            <!-- AI Strategy & Roadmap Card -->
            <div class="capability-card featured-card" data-capability="strategy">
                <div class="card-number">04</div>
                <div class="card-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 38L16 28L24 34L42 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M32 10H42V20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="16" cy="28" r="3" fill="currentColor"/>
                        <circle cx="24" cy="34" r="3" fill="currentColor"/>
                    </svg>
                </div>
                <h3 class="card-title">AI Strategy & Roadmap</h3>
                <p class="card-description">
                    <strong>Asking "How do I use AI in my business?" We answer that.</strong> We audit your operations to identify high-impact AI opportunities, identify risks, and build a step-by-step implementation roadmap. No hype, just ROI.
                </p>
                <div class="card-glow"></div>
            </div>
        </div>

        <div class="capabilities-cta">
            <a href="#contact" class="strategy-cta">
                <span class="cta-text">Book Strategy Session</span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 10H16M16 10L10 4M16 10L10 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- SeatServe Section -->
<section id="seatserve" class="section client-section" data-client="seatserve">
    <div class="geometric-shapes client-shapes">
        <div class="client-shape circle-shape shape-lg"></div>
        <div class="client-shape circle-shape shape-md"></div>
        <div class="client-shape circle-shape shape-sm"></div>
    </div>
    <div class="container">
        <div class="client-content">
            <div class="client-info">
                <div class="client-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/seatserve-logo.png" alt="SeatServe" />
                </div>
                <div class="client-niche">Mobile Apps • Delivery • Workforce Management</div>
                <p class="client-description">
                    Revolutionizing in-stadium food delivery with cutting-edge mobile technology.
                    SeatServe brings the concession stand directly to fans' seats through an
                    intuitive mobile platform.
                </p>
                <ul class="services-list">
                    <li>iOS and Android mobile applications</li>
                    <li>Workforce management system</li>
                    <li>Real-time delivery tracking</li>
                    <li>Payment processing integration</li>
                    <li>Venue-specific customization</li>
                </ul>
                <a href="#contact" class="client-cta">Start Your Project</a>
            </div>
            <div class="client-mockup">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mockups/seatserve-phones.png"
                     alt="SeatServe Mobile Apps"
                     class="mockup-image">
            </div>
        </div>
    </div>
</section>

<!-- Rose Box Section -->
<section id="rosebox" class="section client-section" data-client="rosebox">
    <div class="geometric-shapes client-shapes">
        <div class="client-shape blob-shape shape-lg"></div>
        <div class="client-shape blob-shape shape-md"></div>
        <div class="client-shape blob-shape shape-sm"></div>
    </div>
    <div class="container">
        <div class="client-content">
            <div class="client-info">
                <div class="client-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/rosebox-logo.png" alt="Rose Box" />
                </div>
                <div class="client-niche">E-commerce • Branding • Inventory Management</div>
                <p class="client-description">
                    Premium floral e-commerce platform with sophisticated brand identity and
                    comprehensive inventory management. Crafting beautiful digital experiences
                    for luxury flower arrangements.
                </p>
                <ul class="services-list">
                    <li>Custom e-commerce platform</li>
                    <li>Brand identity and design system</li>
                    <li>Inventory management system</li>
                    <li>Order fulfillment automation</li>
                    <li>Customer relationship management</li>
                </ul>
                <a href="#contact" class="client-cta">Start Your Project</a>
            </div>
            <div class="client-mockup">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mockups/rosebox-phone.png"
                     alt="Rose Box Platform"
                     class="mockup-image">
            </div>
        </div>
    </div>
</section>

<!-- DutchX Section -->
<section id="dutchx" class="section client-section" data-client="dutchx">
    <div class="geometric-shapes client-shapes">
        <div class="client-shape square-shape shape-lg"></div>
        <div class="client-shape square-shape shape-md"></div>
        <div class="client-shape square-shape shape-sm"></div>
    </div>
    <div class="container">
        <div class="client-content">
            <div class="client-info">
                <div class="client-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/dutchx-logo.png" alt="DutchX" />
                </div>
                <div class="client-niche">Workforce Management • Custom Portal</div>
                <p class="client-description">
                    Enterprise workforce management solution with custom organizational portal.
                    Streamlining team coordination and resource allocation for optimal efficiency.
                </p>
                <ul class="services-list">
                    <li>Workforce management platform</li>
                    <li>Custom organization portal</li>
                    <li>Employee scheduling system</li>
                    <li>Time tracking and reporting</li>
                    <li>Role-based access control</li>
                </ul>
                <a href="#contact" class="client-cta">Start Your Project</a>
            </div>
            <div class="client-mockup">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mockups/laptop-mockup.png"
                     alt="DutchX Portal"
                     class="mockup-image">
            </div>
        </div>
    </div>
</section>

<!-- Empire Section -->
<section id="empire" class="section client-section" data-client="empire">
    <div class="geometric-shapes client-shapes">
        <div class="client-shape triangle-shape shape-lg"></div>
        <div class="client-shape triangle-shape shape-md"></div>
        <div class="client-shape triangle-shape shape-sm"></div>
    </div>
    <div class="container">
        <div class="client-content">
            <div class="client-info">
                <div class="client-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/empire-logo.png" alt="Empire" />
                </div>
                <div class="client-niche">Chrome Extension • Shopping • Procurement</div>
                <p class="client-description">
                    Innovative Chrome extension revolutionizing the online shopping experience.
                    Smart procurement tools and personalized customer experiences at scale.
                </p>
                <ul class="services-list">
                    <li>Chrome extension development</li>
                    <li>Customized shopping experience</li>
                    <li>Procurement automation tools</li>
                    <li>Website expansion features</li>
                    <li>AI-powered recommendations</li>
                </ul>
                <a href="#contact" class="client-cta">Start Your Project</a>
            </div>
            <div class="client-mockup">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mockups/empire-mockup.png"
                     alt="Empire Extension"
                     class="mockup-image">
            </div>
        </div>
    </div>
</section>

<!-- Capsoil Section -->
<section id="capsoil" class="section client-section" data-client="capsoil">
    <div class="geometric-shapes client-shapes">
        <div class="client-shape hexagon-shape shape-lg"></div>
        <div class="client-shape hexagon-shape shape-md"></div>
        <div class="client-shape hexagon-shape shape-sm"></div>
    </div>
    <div class="container">
        <div class="client-content">
            <div class="client-info">
                <div class="client-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/capsoil-logo.png" alt="Capsoil" />
                </div>
                <div class="client-niche">Website • AI Automation • Process Optimization</div>
                <p class="client-description">
                    Corporate website with intelligent process automation. Leveraging AI to
                    streamline operations and enhance business workflows.
                </p>
                <ul class="services-list">
                    <li>Corporate website development</li>
                    <li>Process automation with AI</li>
                    <li>Workflow optimization</li>
                    <li>Data integration systems</li>
                    <li>Performance analytics</li>
                </ul>
                <a href="#contact" class="client-cta">Start Your Project</a>
            </div>
            <div class="client-mockup">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mockups/laptop-mockup.png"
                     alt="Capsoil Website"
                     class="mockup-image">
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section contact-section">
    <div class="container">
        <div class="contact-container">
            <div style="text-align: center; margin-bottom: 40px;">
                <h2>Start Innovating Now</h2>
<!--                <p style="color: rgba(255, 255, 255, 0.7); font-size: 1.1rem;">-->
<!--                    We provide a preliminary assessment within 24 hours.-->
<!--                </p>-->
            </div>

            <?php if (isset($_GET['contact']) && $_GET['contact'] === 'success'): ?>
                <div class="success-message" style="padding: 1.5rem; background: rgba(75, 88, 255, 0.2); border-radius: 10px; margin-bottom: 2rem; text-align: center;">
                    <p style="color: #4b58ff; margin: 0; font-weight: 600;">Thank you! We'll get back to you within 24 hours.</p>
                </div>
            <?php endif; ?>

            <form method="post" action="" class="contact-form" id="contactForm">
                <?php wp_nonce_field('rbl_contact_form', 'rbl_contact_nonce'); ?>

                <div class="form-grid">
                    <div>
                        <label style="display: block; margin-bottom: 10px; font-size: 0.9rem; font-weight: 600; color: var(--secondary-color);">
                            I'M INTERESTED IN...
                        </label>
                        <select id="serviceSelect" name="service" class="form-select" required>
                            <option value="" disabled selected>Select a Topic...</option>
                            <option value="strategy">AI Strategy Session (New!)</option>
                            <option value="ai">AI &amp; Automation Implementation</option>
                            <option value="software">Custom Software Development</option>
                            <option value="web">Web Platform / Redesign</option>
                            <option value="other">Other / General Inquiry</option>
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <input type="text" id="name" name="name" class="form-input" placeholder="Name" required>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Work Email" required>
                    </div>

                    <div id="dynamic-field-container">
                        <label id="dynamic-label" class="dynamic-label">Tell us about your project</label>
                        <textarea id="message" name="message" class="form-input" rows="5" placeholder="Briefly describe your goals..." required></textarea>
                    </div>

                    <button type="submit" name="rbl_contact_submit" class="submit-btn">Send Inquiry</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
