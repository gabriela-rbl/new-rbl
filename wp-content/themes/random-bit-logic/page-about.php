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
            Organizations face increasing complexity in their digital operations. Rapidly evolving technology landscapes,
            growing data volumes, and the need for seamless integration across platforms make it challenging to maintain
            efficiency and stay competitive without the right technology partner.
        </p>
    </div>
</section>

<!-- Team Photo Section -->
<section class="section about-team-photo fade-in">
    <div class="container">
        <div class="team-photo-wrapper">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80"
                 alt="Our global team"
                 class="team-photo">
        </div>
    </div>
</section>

<!-- About Content Section -->
<section class="section about-content-section fade-in">
    <div class="container">
        <div class="about-content-grid">
            <div class="about-content-image">
                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=800&q=80"
                     alt="Technology solutions in action"
                     class="content-image">
                <div class="image-badge">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 4.5L6 12L2.5 8.5" stroke="#0016FD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Delivering solutions since 1998</span>
                </div>
            </div>
            <div class="about-content-text">
                <p>
                    Random Bit Logic delivers comprehensive technology solutions including custom software development,
                    AI-powered automation, and intelligent systems integration. From scalable enterprise applications
                    to sophisticated data processing pipelines, the focus is on building technology that performs
                    reliably across any requirement or use case.
                </p>
                <p>
                    Clients trust this experienced global team to handle complex technical challenges,
                    streamline operations, optimize performance, and accelerate growth.
                </p>
                <p class="about-belief">
                    Technology should be a strategic advantage, not an operational burden.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mission Statement Section -->
<section class="section about-mission fade-in">
    <div class="container">
        <p class="mission-statement">
            The mission: empower organizations to operate with speed, precision, and confidence in an increasingly complex digital landscape.
        </p>
    </div>
</section>

<!-- Join the Team Section -->
<section class="section about-join-team fade-in">
    <div class="container">
        <div class="join-team-content">
            <h2>Join the team</h2>
            <p>
                At Random Bit Logic, team members experience the energy of building impactful solutions while being part
                of a collaborative group. Work with clients across the globe to shape the future of technology
                in an innovative, supportive environment.
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
                        In 1998, the founders embarked on a mission to bridge the gap between business needs
                        and technology capabilities. Together they identified an urgent need for reliable,
                        scalable software solutions. Today, Random Bit Logic is an experienced global team
                        that serves leading companies across the Americas, Europe, and Asia.
                    </p>
                </div>
                <div class="card-image">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=600&q=80"
                         alt="Team members"
                         class="story-image">
                </div>
            </div>

            <!-- Recognition Card -->
            <div class="about-card recognition-card fade-in fade-in-delay-2">
                <div class="recognition-badge">
                    <div class="badge-content">
                        <span class="badge-source">INDUSTRY RECOGNITION</span>
                        <span class="badge-year">2024</span>
                        <span class="badge-title">Top Technology<br>Solutions Provider</span>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Recognition</h3>
                    <p>
                        Random Bit Logic has been recognized as a leading technology solutions provider.
                        Through continuous innovation, the team remains dedicated to staying at the forefront
                        of automation with scalable solutions targeting the most significant challenges
                        in enterprise technology.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer CTA Section -->
<section id="footer-cta" class="section footer-cta-section fade-in">
    <div id="contact-canvas-container"></div>
    <div class="container">
        <h2>Ready to transform your<br>business workflows?</h2>

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
                        Tell us about your project
                    </label>
                    <textarea id="message" name="message" class="form-input" rows="5" placeholder="Briefly describe your goals..."></textarea>
                </div>

                <button type="submit" name="rbl_contact_submit" class="submit-btn">Send Inquiry</button>
            </div>
        </form>
    </div>
</section>

<?php get_footer(); ?>
