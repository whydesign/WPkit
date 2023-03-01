<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpkit
 */

get_header();
?>

	<main id="primary" class="site-main uk-container uk-container-xlarge">
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <div class="uk-grid-divider" uk-grid>
        <?php else : ?>
            <div uk-grid="masonry: true; margin: uk-grid-margin-large">
        <?php endif; ?>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
        ?>

        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <div class="uk-width-1-3@m uk-width-1-4@l"><?php get_sidebar('sidebar-1'); ?></div>
            </div>
        <?php else : ?>
            </div>
        <?php endif; ?>

	</main><!-- #main -->

<?php
get_footer();
