<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used as a last-resort fallback when no more specific template matches.
 *
 * @package RandomBitLogic
 */

get_header();
?>

<section class="page-content-section">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
        ?>
                <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
        <?php
            endwhile;
        else :
        ?>
            <p>No content found.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
