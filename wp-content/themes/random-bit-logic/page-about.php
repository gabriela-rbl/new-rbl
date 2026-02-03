<?php
/**
 * Template Name: About
 * Description: Custom template for the About page with company information, team, and mission
 */

get_header();
?>

<!-- About Hero Section -->
<section class="section about-hero fade-in">
    <div class="container">
        <span class="about-label">About</span>
        <h1 class="about-hero-title">Building technology solutions for a better tomorrow</h1>
        <p class="about-hero-description">
            Made in NYC with global talent for clients around the world. Led by veterans with experience
            dating back to 1998, Random Bit Logic helps businesses navigate complex digital challenges,
            scale their operations, and achieve their most ambitious goals using AI-powered solutions.
        </p>
    </div>
</section>

<!-- Team Photo Section -->
<!--<section class="section about-team-photo fade-in">-->
<!--    <div class="container">-->
<!--        <div class="team-photo-wrapper">-->
<!--            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80"-->
<!--                 alt="Our global team"-->
<!--                 class="team-photo">-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!-- About Content Section -->
<section class="section about-content-section fade-in">
    <div class="container">
        <div class="about-content-grid">
            <div class="about-content-image">
                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=800&q=80"
                     alt="Clients achieving their goals"
                     class="content-image">
                <div class="image-badge">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 4.5L6 12L2.5 8.5" stroke="#0016FD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Decades of experience, modern approach</span>
                </div>
            </div>
            <div class="about-content-text">
                <p>
                    Every client has a unique vision. Whether launching a new product, transforming operations,
                    or breaking into new markets, the goal is to understand what success looks like for each
                    business and build the technology that gets them there.
                </p>
                <p>
                    From startups to enterprises, clients across the Americas, Europe, and Asia trust
                    this experienced team to deliver results that matter to their bottom line.
                </p>
                <p class="about-belief">
                    Your challenges deserve dedicated attention. Your growth is the measure of success.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mission Statement Section -->
<section class="section about-mission fade-in">
    <div class="container">
        <p class="mission-statement">
            Made in NYC with global talent for clients around the world. The mission: help every client
            move faster, work smarter, and grow with confidence.
        </p>
    </div>
</section>

<!-- Video CTA Section -->
<section class="section about-video-cta fade-in">
    <div class="video-background">
        <video autoplay muted loop playsinline>
            <source src="<?php echo esc_url(home_url('/wp-content/uploads/2026/02/full-video-rbl.mov')); ?>" type="video/quicktime">
            <source src="<?php echo esc_url(home_url('/wp-content/uploads/2026/02/full-video-rbl.mov')); ?>" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>
    <div class="container video-content">
        <h2>What do you want to<br>automate today?</h2>
        <div class="video-cta-links">
            <a href="#contact" class="video-cta-link">
                <span>Get Started</span>
                <span class="arrow">→</span>
            </a>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="section about-join-team">
    <div class="container fade-in">
        <div class="join-team-content">
            <h2>Our team</h2>
            <p>
                Made in NYC with global talent for clients around the world. A collaborative team
                dedicated to delivering results that matter across industries and continents.
            </p>
            <a href="mailto:careers@randombitlogic.com" class="join-team-cta">
                <span>Careers at Random Bit Logic</span>
                <span class="arrow">→</span>
            </a>
        </div>

        <div class="about-cards-grid">
            <!-- Our Story Card -->
            <div class="about-card story-card fade-in fade-in-delay-1">
                <div class="card-content">
                    <h3>Our story</h3>
                    <p>
                        Random Bit Logic brings together a team of seasoned professionals with experience
                        dating back to 1998. Headquartered in NYC with global talent, the team now serves
                        clients across the Americas, Europe, and Asia who demand more from their
                        technology partners.
                    </p>
                </div>
                <div class="card-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/office-image-2.jpg"
                         alt="Team members"
                         class="story-image">
                </div>
            </div>

            <!-- Client Focus Card -->
            <div class="about-card recognition-card fade-in fade-in-delay-2">
                <div class="recognition-badge">
                    <div class="badge-content">
                        <span class="badge-source">CLIENT SUCCESS</span>
                        <span class="badge-year">25+ Years Experience</span>
                        <span class="badge-title">Global Reach<br>Local Care</span>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Client focused</h3>
                    <p>
                        Every engagement begins with listening. Understanding client goals, challenges,
                        and what success means to their business. That client-first approach has built
                        lasting partnerships with companies who return project after project.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer CTA Section -->
<section id="footer-cta" class="section footer-cta-section">
    <div class="section footer-cta-section fade-in">
        <div id="contact-canvas-container"></div>
        <div class="container">
            <h2>Ready to achieve<br>your next milestone?</h2>

            <?php if (isset($_GET['contact']) && $_GET['contact'] === 'success'): ?>
                <div class="success-message">
                    <p style="margin: 0;">Thank you! We'll get back to you within 24 hours.</p>
                </div>
            <?php endif; ?>

            <!-- Success Message -->
            <div id="contactSuccessMessage" class="contact-success-message" style="display: none;">
                <div class="success-icon">✓</div>
                <h3>Thank You!</h3>
                <p>We'll get back to you within 24 hours.</p>
            </div>

            <form method="post" action="" class="contact-form" id="contactForm">
                <?php wp_nonce_field('rbl_contact_form', 'rbl_contact_nonce'); ?>

                <div class="form-grid">
                    <div>
                        <label>
                            I'm interested in...
                        </label>
                        <select id="serviceSelect" name="service" class="form-select">
                            <option value="" disabled selected>Select a service...</option>
                            <option value="strategy">AI Strategy Session</option>
                            <option value="ai">AI & Automation Implementation</option>
                            <option value="software">Custom Software Development</option>
                            <option value="web">Web Platform / Redesign</option>
                            <option value="other">Other / General Inquiry</option>
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <input type="text" id="name" name="name" class="form-input" placeholder="Name (*)" required>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Work Email (*)" required>
                    </div>

                    <div id="dynamic-field-container">
                        <label id="dynamic-label">
                            Tell us about your goals
                        </label>
                        <textarea id="message" name="message" class="form-input" rows="5" placeholder="What would you like to achieve?"></textarea>
                    </div>

                    <button type="submit" name="rbl_contact_submit" class="submit-btn">Let's Talk</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
