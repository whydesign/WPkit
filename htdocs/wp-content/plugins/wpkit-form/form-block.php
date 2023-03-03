<?php
/*
 * Plugin name: WPkit Contact Form
 * Author: whydesign
 * Author URI: https://whydesign-halle.de/
 * Description: WPkit Contact Form. A simple contact form.
 */

add_action( 'init', 'wpkit_form_register' );

function wpkit_form_register() {

    register_block_type( __DIR__ );

}
