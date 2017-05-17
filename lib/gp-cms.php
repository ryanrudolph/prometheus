<?php
/**
 * GetPhound CMS
 *
 * This file can be activated optionally during production.
 *
 * @package GetPhound CMS
 * @author  GetPhound
 * @license GPL-2.0+
 * @link    http://www.getphound.com/
 */

/* --------------------------------------------------------------------
Customize Dashboard
-------------------------------------------------------------------- */

function gp_welcome_panel() {
	echo '<div class="gp-dash-credit">';
	echo '<img src="' . esc_url( get_header_image() ). '" alt="' . esc_attr( get_bloginfo( 'title' ) ) . '" />';
	echo '<h3>Welcome to <strong>' . esc_attr( get_bloginfo( 'title' ) ) . '</strong> Content Management System</h3>';
	echo 'Designed and Developed by getphound.com';
	echo '<a href="https://getphound.com/" target="_blank"><img src="https://getphound.com/wp-content/themes/getphound/images/logo.png" alt="GetPhound" /></a>';
	echo 'For questions or technical support call (610) 999-1808.';
	echo '</div>';
}

remove_action('welcome_panel','wp_welcome_panel');
add_action('welcome_panel','gp_welcome_panel'); 

/* --------------------------------------------------------------------
Remove Widgets on Dashboard
-------------------------------------------------------------------- */

function gp_remove_dashboard_widgets() {

	//Remove WordPress default dashboard widgets
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal');
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side');
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side');
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );

	//Remove additional plugin widgets
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal'); // Yoast

}

add_action('wp_dashboard_setup', 'gp_remove_dashboard_widgets' );

/* --------------------------------------------------------------------
Remove Unwanted Menu Items from WordPress Admin
-------------------------------------------------------------------- */
function gp_remove_admin_menus (){
 
	// Check that the built-in WordPress function remove_menu_page() exists in the current installation
	if ( function_exists('remove_menu_page') ) {
	 
		/* Remove unwanted menu items by passing their slug to the remove_menu_item() function.
		You can comment out the items you want to keep. */
		 
		remove_menu_page('link-manager.php'); // Links
		remove_menu_page('edit-comments.php'); // Comments
		remove_menu_page('themes.php'); // Appearance
		remove_menu_page('plugins.php'); // Plugins
		remove_submenu_page( 'themes.php', 'customize.php' );
		remove_submenu_page( 'themes.php', 'themes.php' );
		remove_menu_page('tools.php'); // Tools
		remove_menu_page('options-general.php'); // Settings
	 
	}
 
}

// Add our function to the admin_menu action
add_action('admin_menu', 'gp_remove_admin_menus');


// Remove WordPress Admin Bar Menu Items
function wpcustom_admin_bar() {
    global $wp_admin_bar;

// To remove WordPress logo and related submenu items
   $wp_admin_bar->remove_menu('wp-logo');
   $wp_admin_bar->remove_menu('about');
   $wp_admin_bar->remove_menu('wporg');
   $wp_admin_bar->remove_menu('documentation');
   $wp_admin_bar->remove_menu('support-forums');
   $wp_admin_bar->remove_menu('feedback');

// To remove Update Icon/Menu
   $wp_admin_bar->remove_menu('updates');

// To remove Comments Icon/Menu
   $wp_admin_bar->remove_menu('comments');

}

add_action( 'wp_before_admin_bar_render', 'wpcustom_admin_bar' );
