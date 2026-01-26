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
                    <li><a href="#enterprise">AI & Automation</a></li>
                    <li><a href="#enterprise">Custom Software</a></li>
                    <li><a href="#enterprise">Web Platforms</a></li>
                    <li><a href="#enterprise">AI Strategy</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Company</h3>
                <ul class="footer-nav">
                    <li><a href="<?php echo home_url('/#seatserve'); ?>">Our Work</a></li>
                    <li><a href="<?php echo esc_url(home_url('/insights/')); ?>">Insights</a></li>
                    <li><a href="<?php echo home_url('/#footer-cta'); ?>">Contact</a></li>
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
