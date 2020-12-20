<?php

//enqueue styles and scripts
function enqueue_scripts_and_styles()
{
    //wp_enqueue_style('main-styles', get_template_directory_uri() . '/main.6d0790188d013fc0ec4a.css?84804736c1c56502fcab', array(), null, false);
    //wp_enqueue_script('main-js', get_template_directory_uri() . '/main.js?84804736c1c56502fcab', array(), null, false);
    wp_enqueue_style('main_style', get_template_directory_uri() . '/sass/main.css', array(), null, false);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles');

add_theme_support('post-thumbnails');

function add_title_tag()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'add_title_tag');


//register menus
function register_my_menus()
{
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu'),
            'extra-menu' => __('Extra Menu')
        )
    );
}
add_action('init', 'register_my_menus');


//remove jquery
function remove_jquery()
 {
     if(!current_user_can('administrator')){
         wp_register_script( 'jquery' );
     }
 }

 add_action( 'wp_enqueue_scripts', 'remove_jquery');


 // REMOVE EMOJI ICONS
 function disable_emoji_feature() {
	
	// Prevent Emoji from loading on the front-end
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Remove from admin area also
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// Remove from RSS feeds also
	remove_filter( 'the_content_feed', 'wp_staticize_emoji');
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji');

	// Remove from Embeds
	remove_filter( 'embed_head', 'print_emoji_detection_script' );

	// Remove from emails
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Disable from TinyMCE editor. Currently disabled in block editor by default
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );

	/** Finally, prevent character conversion too
         ** without this, emojis still work 
         ** if it is available on the user's device
	 */

	add_filter( 'option_use_smilies', '__return_false' );

}

add_action('init', 'disable_emoji_feature');