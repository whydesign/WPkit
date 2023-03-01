<?php
/**
 * Created by PhpStorm.
 * User: Ludwig
 * Date: 28.02.23
 * Time: 13:36
 */
/* Template Name: Boxed Template */

get_header();
?>

    <main id="primary" class="site-main uk-container uk-container-xlarge uk-padding-left uk-padding-right">

        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', 'page' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.

        get_sidebar();
        ?>

    </main><!-- #main -->

<?php
get_footer();
