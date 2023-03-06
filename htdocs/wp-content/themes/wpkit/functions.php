<?php
/**
 * wpkit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpkit
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wpkit_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wpkit, use a find and replace
		* to change 'wpkit' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wpkit', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wpkit' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'wpkit_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wpkit_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wpkit_content_width', 640 );
}
add_action( 'after_setup_theme', 'wpkit_content_width', 0 );

add_action( 'customize_register', 'wpkit_customize_controls', 0 );

function wpkit_customize_controls() {

    require_once( trailingslashit( get_template_directory() ) . 'inc/control-multiple-checkbox.php' );
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wpkit_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wpkit' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wpkit' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer-1', 'wpkit' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add widgets here.', 'wpkit' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s uk-text-small uk-text-lighter">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer-2', 'wpkit' ),
            'id'            => 'footer-2',
            'description'   => esc_html__( 'Add widgets here.', 'wpkit' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer-3', 'wpkit' ),
            'id'            => 'footer-3',
            'description'   => esc_html__( 'Add widgets here.', 'wpkit' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'wpkit_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wpkit_scripts() {
	wp_enqueue_style( 'wpkit-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wpkit-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wpkit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

    wp_enqueue_script( 'uikit', get_template_directory_uri() . '/node_modules/uikit/dist/js/uikit.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'uikit-icons', get_template_directory_uri() . '/node_modules/uikit/dist/js/uikit-icons.js', array(), _S_VERSION, true );

    wp_enqueue_script('jquery');
    wp_enqueue_style( 'dashicons' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wpkit_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function slider_option_enabled(){
    if ( get_theme_mod( 'slider_activation') ) {
        return true;
    }
    return false;
}

add_action( 'customize_register', 'uikit_customizer_options' );

function get_pages_for_slider(){
    $slider_locations = array(
        'all' => __('Everywhere', 'wpkit'),
        'front_page' => __('Front Page', 'wpkit'),
        'home' => __('Main Blog Page', 'wpkit'),
        'page' => __('Single Pages', 'wpkit'),
        'single' => __('Single Posts', 'wpkit'),
        'archive' => __('Archive Pages', 'wpkit')
    );

    foreach(get_post_types(array('public' => 'true')) as $post_type) {

        if ( $post_type != 'header_slider' ) {
            $post_type_object = get_post_type_object($post_type);
            $slider_locations['post_type/' . $post_type] = __('Post Type: ', 'wpkit') . $post_type_object->label;

            foreach (get_object_taxonomies($post_type, 'objects') as $taxonomy) {

                if ($taxonomy->name !== 'post_format' && 'header_slider') {

                    $sidebar_locations['taxonomy/' . $post_type . '/' . $taxonomy->name] = $post_type_object->label . __(' Taxonomy: ', 'wpkit') . $taxonomy->label;

                }

            }
        }
    }

    return $slider_locations;
}

function sanitize_pages_for_slider( $values ) {
    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

function uikit_customizer_options($wp_customize){

    $wp_customize->remove_control('blogdescription');

    $slider_get_posts_list = get_posts( array('numberposts' => 999, 'post_type' => 'header_slider' ));

    $slider_posts_list = [];

    foreach( $slider_get_posts_list as $slider_post ) {
        $slider_posts_list[$slider_post->ID] = esc_html( get_the_title($slider_post->ID) );
    }

    //Header Slider Options
    $wp_customize->add_setting( 'slider_select', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'slider_select_control', array(
        'type' => 'select',
        'label' => __('Choose your Header-Slider', 'wpkit'),
        'priority' => 10,
        'section' => 'header_image',
        'settings' => 'slider_select',
        'choices' => $slider_posts_list,
        'active_callback' => 'slider_option_enabled',
    ));

    $wp_customize->add_setting( 'slider_activation', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'slider_activation_control', array(
        'type' => 'checkbox',
        'label' => __('Activate Header-Slider', 'wpkit'),
        'priority' => 10,
        'section' => 'header_image',
        'settings' => 'slider_activation',
    ));

    $wp_customize->add_setting( 'slider_autoplay', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'slider_autoplay_control', array(
        'type' => 'checkbox',
        'label' => __('Autoplay Header-Slider', 'wpkit'),
        'priority' => 10,
        'section' => 'header_image',
        'settings' => 'slider_autoplay',
        'choices' => $slider_posts_list,
        'active_callback' => 'slider_option_enabled',
    ));

    $wp_customize->add_setting( 'slider_dotnav', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'slider_dotnav_control', array(
        'type' => 'checkbox',
        'label' => __('Activate Dot-Navigation', 'wpkit'),
        'priority' => 10,
        'section' => 'header_image',
        'settings' => 'slider_dotnav',
        'choices' => $slider_posts_list,
        'active_callback' => 'slider_option_enabled',
    ));

    $wp_customize->add_setting( 'slider_arrownav', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'slider_arrownav_control', array(
        'type' => 'checkbox',
        'label' => __('Activate Arrow-Navigation', 'wpkit'),
        'priority' => 10,
        'section' => 'header_image',
        'settings' => 'slider_arrownav',
        'choices' => $slider_posts_list,
        'active_callback' => 'slider_option_enabled',
    ));

    $wp_customize->add_setting('slider_pages', array(
        'sanitize_callback' => 'sanitize_pages_for_slider'
    ));

    $wp_customize->add_control(new Customize_Control_Multiple_Checkbox($wp_customize, 'slider_pages',
        array(
            'section' => 'header_image',
            'label'   => __( 'Slider Pages', 'wpkit' ),
            'description'   => __('Select on which pages the header slider should be displayed.', 'wpkit'),
            'choices' => get_pages_for_slider(),
        )
    ));

    //WPkit Options (Searchform, Sticky Navbar)
    $wp_customize->add_section( 'wpkit_option_section', array(
        'title'=> __('WPkit Options', 'wpkit'),
        'priority' => 160,
        'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_setting( 'searchform_nav', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'searchform_nav_control', array(
        'type' => 'checkbox',
        'label' => __('Show Searchform in Navi', 'wpkit'),
        'priority' => 10,
        'section' => 'wpkit_option_section',
        'settings' => 'searchform_nav',
    ));

    $wp_customize->add_setting( 'sticky_nav', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'sticky_nav_control', array(
        'type' => 'checkbox',
        'label' => __('Enable Sticky Nav', 'wpkit'),
        'priority' => 10,
        'section' => 'wpkit_option_section',
        'settings' => 'sticky_nav',
    ));

}

add_action( 'init', 'wpkit_custom_post' );

function wpkit_custom_post() {

    $args_places = array(
        'labels' => array(
            'name' => _x( 'Header Slider', 'Alle Slider' ),
            'singular_name' => _x( 'Header Slider', 'Ein Slider' ),
            'menu_name' => _x( 'Header Slider', 'Alle Slider'),
        ),
        'description' => 'Header Slider',
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-slides',
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
    );

    register_post_type( 'header_slider', $args_places );

}

function block_gallery_ukslider( $block_content, $block ) {
    if ( $block['blockName'] === 'core/gallery' ) {

        preg_match_all('/<img [^>]+>/', $block_content, $image_matches, PREG_SET_ORDER);
        preg_match_all('/<figcaption class="wp-element-caption">(.*?)<\/figcaption>/s', $block_content, $caption_matches, PREG_SET_ORDER);

        $content = '<div uk-slideshow="autoplay: '.(get_theme_mod("slider_autoplay") ? "true" : "false").'; ratio: false">';
        $content .= '<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">';
        $content .= '<ul class="uk-slideshow-items" uk-height-viewport="offset-top: true; offset-bottom: 30">';

        foreach ($image_matches as $key=>$image) {
            $image_full = str_replace('-1024x683.', '.', $image[0]);
            $image_full = preg_replace('/(<img\b[^><]*)>/i', '$1 uk-cover>', $image_full);

            $content .= '<li>';
            $content .= $image_full;
            $content .= '<div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">';
            $content .= $caption_matches[$key][0];
            $content .= '</div>';
            $content .= '</li>';
        }

        $content .= '</ul>';

        if ( get_theme_mod('slider_arrownav') ) {
            $content .= '<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>';
            $content .= '<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>';
        }

        $content .= '</div>';

        if ( get_theme_mod('slider_dotnav') ) {
            $content .= '<ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>';
        }

        $content .= '</div>';

        return $content;
    }

    return $block_content;
}

add_filter( 'render_block', 'block_gallery_ukslider', 10, 2 );

function add_class_to_category( $category_list ) {
    $uk_class = 'uk-button uk-button-text';
    return str_replace('<a href="',  '<a class="'. $uk_class . '" href="', $category_list);
}

add_filter('the_category', 'add_class_to_category', 10, 3);

function add_class_to_tags( $tag_list ) {
    $uk_class = 'uk-button uk-button-text';
    return str_replace('<a href="',  '<a class="'. $uk_class . '" href="', $tag_list);
}

add_filter('the_tags', 'add_class_to_tags', 10, 3);

function textleader_custom_box() {
    add_meta_box(
        'uk_textleader',
        __('Text Leader', 'wpkit'),
        'post_leader_callback',
        'post'
    );
}
add_action( 'add_meta_boxes', 'textleader_custom_box' );

function post_leader_callback($post) {
    $value = get_post_meta( $post->ID, '_uk_textleader_meta_key', true );
    echo '<textarea style="width:100%" id="text_leader" name="text_leader">' . esc_attr( $value ) . '</textarea>';
}

function uk_textleader_save_postdata( $post_id ) {
    if ( array_key_exists( 'text_leader', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_uk_textleader_meta_key',
            $_POST['text_leader']
        );
    }
}
add_action( 'save_post', 'uk_textleader_save_postdata' );
