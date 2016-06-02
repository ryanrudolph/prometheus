<?php
/**
 * Prometheus - GetPhound Starter Theme.
 *
 * This file adds functions to the Prometheus Theme. Based on Genesis Sample 2.2.3.
 *
 * @package Prometheus
 * @author  GetPhound
 * @license GPL-2.0+
 * @link    http://www.ryanrudolph.com/how-to-use-prometheus
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'genesis-sample', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-sample' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.3' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

  wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
  wp_enqueue_style( 'dashicons' );
  wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );

  wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
  $output = array(
    'mainMenu' => __( 'Menu', 'genesis-sample' ),
    'subMenu'  => __( 'Menu', 'genesis-sample' ),
  );
  wp_localize_script( 'genesis-sample-responsive-menu', 'genesisSampleL10n', $output );

}

//* Remove query strings from CSS and JS inclusions
function _remove_script_version($src) {
   $parts = explode('?ver', $src);
   return $parts[0];
}

add_filter('style_loader_src', '_remove_script_version', 15, 1);
add_filter('script_loader_src', '_remove_script_version', 15, 1);

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
  'width'           => 600,
  'height'          => 160,
  'header-selector' => '.site-title a',
  'header-text'     => false,
  'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

  if ( 'secondary' != $args['theme_location'] ) {
    return $args;
  }

  $args['depth'] = 1;

  return $args;

}

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {

  return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

  $args['avatar_size'] = 60;

  return $args;

}

//* Remove Genesis widgets
add_action( 'widgets_init', 'prometheus_remove_genesis_widgets', 20 );
function prometheus_remove_genesis_widgets() {
    unregister_widget( 'Genesis_eNews_Updates'          );
    unregister_widget( 'Genesis_Featured_Page'          );
    unregister_widget( 'Genesis_Featured_Post'          );
    unregister_widget( 'Genesis_Latest_Tweets_Widget'   );
    unregister_widget( 'Genesis_User_Profile_Widget'    );
}

//* Remove edit link
add_filter( 'genesis_edit_post_link', '__return_false' );

//* Remove comments
remove_action( 'genesis_after_post', 'genesis_get_comments_template' );

//* Remove Genesis page templates
function prometheus_remove_genesis_page_templates( $page_templates ) {
  unset( $page_templates['page_archive.php'] );
  unset( $page_templates['page_blog.php'] );
  return $page_templates;
}
add_filter( 'theme_page_templates', 'prometheus_remove_genesis_page_templates' );

//* Hook in custom footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'prometheus_footer' );
function prometheus_footer() {
    echo '<p>© Copyright ' . date('Y') . ' ';
    echo bloginfo('name') . '. All Rights Reserved</p>';
}

//* Add ability to hide gravity form labels
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
