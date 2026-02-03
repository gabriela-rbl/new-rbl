    <!-- Consultation Popup Modal -->
    <div id="consultationPopup" class="consultation-popup">
        <div class="consultation-popup-overlay"></div>
        <div class="consultation-popup-content">
            <button class="consultation-popup-close" aria-label="Close popup">&times;</button>

            <div class="consultation-popup-header">
                <h2>Get a Free Consultation</h2>
                <p>Schedule a call with our team to discuss your project (EST 10am-4pm Mon-Fri)</p>
            </div>

            <!-- Success Message -->
            <div id="consultationSuccessMessage" class="consultation-success-message" style="display: none;">
                <div class="success-icon">✓</div>
                <h3>Consultation Request Received!</h3>
                <p>We'll confirm your appointment within 24 hours.</p>
            </div>

            <form method="post" action="" class="consultation-form" id="consultationForm">
                <?php wp_nonce_field('rbl_consultation_form', 'rbl_consultation_nonce'); ?>

                <div class="form-grid">
                    <div>
                        <label>
                            I'm interested in...
                        </label>
                        <select name="service" class="form-select">
                            <option value="" disabled selected>Select a service...</option>
                            <option value="strategy">AI Strategy Session</option>
                            <option value="ai">AI & Automation Implementation</option>
                            <option value="software">Custom Software Development</option>
                            <option value="web">Web Platform / Redesign</option>
                            <option value="other">Other / General Inquiry</option>
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <input type="text" name="name" class="form-input" placeholder="Name (*)" required>
                        <input type="email" name="email" class="form-input" placeholder="Work Email (*)" required>
                    </div>

                    <div>
                        <label>
                            Preferred consultation date
                        </label>
                        <input type="text" name="consultation_date" class="form-input" id="consultationDate" placeholder="Select a date (*)" required readonly>
                    </div>

                    <div>
                        <label>
                            Preferred time (EST)
                        </label>
                        <select name="consultation_time" class="form-select">
                            <option value="" disabled selected>Select a time</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="10:30">10:30 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="11:30">11:30 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="12:30">12:30 PM</option>
                            <option value="13:00">1:00 PM</option>
                            <option value="13:30">1:30 PM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="14:30">2:30 PM</option>
                            <option value="15:00">3:00 PM</option>
                            <option value="15:30">3:30 PM</option>
                        </select>
                    </div>

                    <div>
                        <label>
                            Tell us about your project
                        </label>
                        <textarea name="message" class="form-input" rows="4" placeholder="Briefly describe your goals..."></textarea>
                    </div>

                    <button type="submit" name="rbl_consultation_submit" class="submit-btn">Schedule Consultation</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-column">
<!--                <h3>Random Bit Logic</h3>-->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rbl-logo-white.png" alt="Random Bit Logic Logo" style="width: 150px; height: auto;">
                <p style="color: rgba(255, 255, 255, 0.7); margin-top: 1rem;">
                    AI-powered software solutions that transform businesses.<br/>
                    Based in New York, serving clients worldwide.
                </p>
                <div class="labels">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gdpr-bw.png" alt="GDPR Compliant" title="GDPR Compliant">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/made-in-nyc.png" alt="Made in NYC" title="Made in NYC">
                </div>
            </div>

            <div class="footer-column">
                <h3>Solutions</h3>
                <ul class="footer-nav">
                    <li><a href="#platform">AI & Automation</a></li>
                    <li><a href="#solutions">Custom Software</a></li>
                    <li><a href="<?php echo home_url('/#seatserve'); ?>">Our Clients</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Company</h3>
                <ul class="footer-nav">
                    <li><a href="<?php echo home_url('/about'); ?>">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/insights/')); ?>">Insights</a></li>
                    <li><a href="#" class="open-consultation-popup">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Random Bit Logic. All Rights Reserved. Shipping digital solutions since 1998.</p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
