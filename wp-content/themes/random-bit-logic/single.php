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
