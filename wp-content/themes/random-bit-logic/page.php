<?php
/**
 * Default page template
 *
 * Used as a fallback for WordPress pages that don't have
 * a specific template assigned.
 */

get_header();
?>

<section class="page-content-section">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
        ?>
                <h1><?php the_title(); ?></h1>
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>
