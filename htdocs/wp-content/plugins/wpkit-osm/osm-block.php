<?php
/*
 * Plugin name: WPkit OSM
 * Author: whydesign
 * Author URI: https://whydesign-halle.de/
 * Description: WPkit OSM Plugin and Mapbox API option. You can setup your Mapbox API under <a href="customize.php?autofocus[section]=osm_option_section">Customizer > Open Street Map</a>.
 */

add_action( 'init', 'wpkit_register' );

function wpkit_register() {
    
    $leaflet_js = 'assets/leaflet/leaflet.js';
    $leaflet_css = 'assets/leaflet/leaflet.css';
    $leaflet_version = '1.9.3';

    wp_register_style( 'leaflet-css', plugins_url($leaflet_css, __FILE__), array(), $leaflet_version );
    wp_register_script( 'leaflet-js', plugins_url($leaflet_js, __FILE__), array('jquery'), $leaflet_version, false );

    register_block_type( __DIR__ );

}

add_action( 'customize_register', 'osm_customizer_options' );

function osm_customizer_options($wp_customize){

    $wp_customize->add_section( 'osm_option_section', array(
        'title'=> __( 'Open Street Map', 'osm_option_section' ),
        'priority' => 160,
        'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_setting( 'mapbox_apikey', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'mapbox_apikey_control', array(
            'type' => 'text',
            'label' => 'Mapbox API Key',
            'priority' => 10,
            'section' => 'osm_option_section',
            'settings' => 'mapbox_apikey',
    ));

    $wp_customize->add_setting( 'mapbox_username', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'mapbox_username_control', array(
            'type' => 'text',
            'label' => 'Mapbox API User',
            'priority' => 10,
            'section' => 'osm_option_section',
            'settings' => 'mapbox_username',
    ));

    $wp_customize->add_setting( 'mapbox_style', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'mapbox_style_control', array(
            'type' => 'text',
            'label' => 'Mapbox Style',
            'priority' => 10,
            'section' => 'osm_option_section',
            'settings' => 'mapbox_style',
    ));

}

function osm_menu() {
    add_theme_page( 'OSM Optionen', 'OSM Optionen', 'edit_theme_options', 'customize.php?autofocus[section]=osm_option_section' );
}

add_action('admin_menu', 'osm_menu');