<?php
/**
 * Template Name: Insights
 * Description: A page template for displaying blog posts as Insights
 */

get_header();
?>

<!-- Insights Hero Section -->
<section class="insights-hero">
    <div class="container">
        <span class="insights-label">Blog</span>
        <h1 class="insights-title">Insights and ideas driving the future of financial & operational automation</h1>
    </div>
</section>

<!-- Insights Grid Section -->
<section class="insights-section">
    <div class="container">
        <div class="insights-grid">
            <?php
            // Query for blog posts
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 12,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $insights_query = new WP_Query($args);

            if ($insights_query->have_posts()) :
                while ($insights_query->have_posts()) : $insights_query->the_post();
                    // Get the first category
                    $categories = get_the_category();
                    $category_name = !empty($categories) ? $categories[0]->name : 'News';
            ?>
                    <article class="insight-card">
                        <a href="<?php the_permalink(); ?>" class="insight-card-link">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="insight-image">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php else : ?>
                                <div class="insight-image insight-image-placeholder">
                                    <div class="placeholder-content">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/>
                                            <path d="M21 15L16 10L5 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="insight-content">
                                <span class="insight-category"><?php echo esc_html($category_name); ?></span>
                                <h3 class="insight-title"><?php the_title(); ?></h3>
                                <time class="insight-date" datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date('F j, Y'); ?>
                                </time>
                            </div>
                        </a>
                    </article>
            <?php
                endwhile;

                // Pagination
                $total_pages = $insights_query->max_num_pages;
                if ($total_pages > 1) :
            ?>
                <div class="insights-pagination">
                    <?php
                    echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format' => '?paged=%#%',
                        'current' => max(1, $paged),
                        'total' => $total_pages,
                        'prev_text' => '&larr; Previous',
                        'next_text' => 'Next &rarr;',
                        'type' => 'list',
                    ));
                    ?>
                </div>
            <?php
                endif;
                wp_reset_postdata();
            else :
            ?>
                <div class="no-insights">
                    <p>No insights available yet. Check back soon for our latest articles and news.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Footer CTA Section -->
<section id="footer-cta" class="section footer-cta-section fade-in">
    <div id="contact-canvas-container"></div>
    <div class="container">
        <h2>Ready to transform your<br>business workflows?</h2>
    </div>

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
                <label>I'm interested in...</label>
                <select id="serviceSelect" name="service" class="form-select" required>
                    <option value="" disabled selected>Select a service...</option>
                    <option value="strategy">AI Strategy Session</option>
                    <option value="ai">AI & Automation Implementation</option>
                    <option value="software">Custom Software Development</option>
                    <option value="web">Web Platform / Redesign</option>
                    <option value="other">Other / General Inquiry</option>
                </select>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <input type="text" id="name" name="name" class="form-input" placeholder="Name" required>
                <input type="email" id="email" name="email" class="form-input" placeholder="Work Email" required>
            </div>

            <div id="dynamic-field-container">
                <label id="dynamic-label">Tell us about your project</label>
                <textarea id="message" name="message" class="form-input" rows="5" placeholder="Briefly describe your goals..." required></textarea>
            </div>

            <button type="submit" name="rbl_contact_submit" class="submit-btn">Send Inquiry</button>
        </div>
    </form>
</section>

<?php get_footer(); ?>
