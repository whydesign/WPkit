<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpkit
 */

?>
    <div class="uk-section-secondary uk-section uk-margin-large-top">
        <footer id="colophon" class="site-footer uk-container uk-container-xlarge uk-padding-left uk-padding-right uk-margin-top uk-margin-bottom">
            <div class="site-info uk-child-width-expand" uk-grid>
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php endif; ?>
                <div class="uk-width-auto@s uk-width-1-4@m">
                    <div class="uk-margin uk-text-right@s">
                        <a href="#" uk-totop uk-scroll></a>
                    </div>
                </div>
            </div><!-- .site-info -->
        </footer><!-- #colophon -->
    </div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
