<?php
/**
 * Template for displaying all pages
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
            <div class="container mx-auto px-4 py-12">
                <div class="entry-content prose prose-lg max-w-none">
                    <?php
                    the_content();

                    wp_link_pages([
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'katayama'),
                        'after'  => '</div>',
                    ]);
                    ?>
                </div>
            </div>
        </article>
    <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
