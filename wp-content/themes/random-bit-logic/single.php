<?php
/**
 * Template for displaying single blog posts
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        // Get the first category
        $categories = get_the_category();
        $category_name = !empty($categories) ? $categories[0]->name : 'News';
?>

<!-- Single Post Hero -->
<article class="single-post">
    <header class="single-post-header">
        <div class="container">
            <div class="single-post-meta">
                <span class="single-post-category"><?php echo esc_html($category_name); ?></span>
                <time class="single-post-date" datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date('F j, Y'); ?>
                </time>
            </div>
            <h1 class="single-post-title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <p class="single-post-excerpt"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </header>

    <?php if (has_post_thumbnail()) : ?>
        <div class="single-post-featured-image">
            <div class="container">
                <?php the_post_thumbnail('full'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="single-post-content">
        <div class="container">
            <div class="single-post-layout">
                <!-- Main Content Column -->
                <div class="single-post-main">
                    <div class="post-content-wrapper">
                        <?php the_content(); ?>
                    </div>

                    <!-- Post Tags -->
                    <?php
                    $tags = get_the_tags();
                    if ($tags) :
                    ?>
                        <div class="single-post-tags">
                            <span class="tags-label">Tags:</span>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo get_tag_link($tag->term_id); ?>" class="post-tag">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Post Navigation -->
                    <nav class="single-post-navigation">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        <?php if ($prev_post) : ?>
                            <a href="<?php echo get_permalink($prev_post); ?>" class="post-nav-link post-nav-prev">
                                <span class="nav-label">&larr; Previous</span>
                                <span class="nav-title"><?php echo get_the_title($prev_post); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if ($next_post) : ?>
                            <a href="<?php echo get_permalink($next_post); ?>" class="post-nav-link post-nav-next">
                                <span class="nav-label">Next &rarr;</span>
                                <span class="nav-title"><?php echo get_the_title($next_post); ?></span>
                            </a>
                        <?php endif; ?>
                    </nav>
                </div>

                <!-- Sticky Sidebar -->
                <aside class="single-post-sidebar">
                    <div class="sidebar-form-wrapper">
                        <div class="sidebar-form-header">
                            <h3>Get in Touch</h3>
                            <p>Have questions? Let's discuss how we can help.</p>
                        </div>

                        <!-- Success Message -->
                        <div id="sidebarSuccessMessage" class="sidebar-success-message" style="display: none;">
                            <div class="success-icon">✓</div>
                            <h4>Thank You!</h4>
                            <p>We'll get back to you within 24 hours.</p>
                        </div>

                        <form method="post" action="" class="sidebar-contact-form" id="sidebarContactForm">
                            <?php wp_nonce_field('rbl_contact_form', 'rbl_sidebar_nonce'); ?>
                            <input type="hidden" name="form_source" value="sidebar">

                            <div class="sidebar-form-grid">
                                <div class="form-field">
                                    <label for="sidebar-name">Name</label>
                                    <input type="text" id="sidebar-name" name="name" class="form-input" placeholder="Your name (*)" required>
                                </div>

                                <div class="form-field">
                                    <label for="sidebar-email">Email</label>
                                    <input type="email" id="sidebar-email" name="email" class="form-input" placeholder="Work email (*)" required>
                                </div>

                                <div class="form-field">
                                    <label for="sidebar-service">I'm interested in...</label>
                                    <select id="sidebar-service" name="service" class="form-select">
                                        <option value="" disabled selected>Select a service</option>
                                        <option value="strategy">AI Strategy Session</option>
                                        <option value="ai">AI & Automation</option>
                                        <option value="software">Custom Software</option>
                                        <option value="web">Web Platform</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="form-field">
                                    <label for="sidebar-message">Message</label>
                                    <textarea id="sidebar-message" name="message" class="form-input" rows="4" placeholder="Tell us about your project..."></textarea>
                                </div>

                                <button type="submit" name="rbl_sidebar_submit" class="submit-btn">Send Message</button>
                            </div>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</article>

<!-- Back to Insights CTA -->
<section class="back-to-insights">
    <div class="container">
        <a href="<?php echo esc_url(home_url('/insights/')); ?>" class="back-link">
            <span class="arrow">&larr;</span>
            <span>Back to all insights</span>
        </a>
    </div>
</section>

<?php
    endwhile;
endif;

get_footer();
?>
