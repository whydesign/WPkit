<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpkit
 */

$show_slider = get_theme_mod('slider_pages');
if (is_archive()) {
    global $wp_query;
    $taxonomy = $wp_query->get_queried_object();
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wpkit' ); ?></a>

	<header id="masthead" class="site-header uk-background-muted uk-box-shadow-medium"<?= (get_theme_mod('sticky_nav') ? (is_user_logged_in() ? ' uk-sticky="start: 200; offset: 32"' : ' uk-sticky="start: 200"') : '') ?>>
        <div class="uk-container uk-container-xlarge uk-padding-left uk-padding-right">
            <nav class="uk-navbar-container uk-margin" uk-navbar>
                <div class="uk-navbar-left">
                    <div class="uk-navbar-item uk-logo">
                        <?php if (get_theme_mod('custom_logo')) : ?>
                            the_custom_logo();
                        <?php else: ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="uk-navbar-item uk-logo"><?php bloginfo( 'name' ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="uk-navbar-right">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                            'container'      => 'ul',
                            'menu_class'     => 'uk-navbar-nav uk-visible@m',
                        )
                    );
                    ?>

                    <div id="primary-menu-mobile" class="uk-offcanvas" uk-offcanvas="flip: true; overlay: true">
                        <div class="uk-offcanvas-bar">
                            <button class="uk-offcanvas-close" type="button" uk-close></button>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'menu_id'        => 'primary-menu',
                                    'container'      => 'ul',
                                    'menu_class'     => 'uk-nav uk-nav-default',
                                )
                            );
                            ?>
                        </div>
                    </div>
                    <a class="uk-navbar-toggle uk-hidden@m" href="#" uk-toggle="target: #primary-menu-mobile">
                        <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">Menu</span>
                    </a>
                    <?php if (get_theme_mod('searchform_nav')) : ?>
                        <?= get_search_form() ?>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
	</header><!-- #masthead -->

    <?php
        if ( get_theme_mod('slider_activation') &&
        ($show_slider &&
            in_array('all', $show_slider) ||
            (in_array('front_page', $show_slider) && is_front_page()) ||
            (in_array('home', $show_slider) && is_home()) ||
            (in_array('page', $show_slider) && is_page()) ||
            (in_array('single', $show_slider) && is_single()) ||
            (in_array('archive', $show_slider) && is_archive()) ||
            (is_single() && in_array('post_type/' . get_post_type() , $show_slider)) ||
            (is_page() && !is_front_page() && in_array('post_type/page', $show_slider)) ||
            (is_archive() && is_object($taxonomy) && in_array('taxonomy/' . get_post_type() . '/' . $taxonomy->taxonomy , $show_slider)))
        ) {
            echo apply_filters( 'the_content', get_the_content(null, false, get_theme_mod('slider_select')));
        }
    ?>
