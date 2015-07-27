<?php 
/** 
* Front Page 
* 
* @author Ryan Rudolph <ryan@ryanrudolph.com> 
* @copyright Copyright (c) 2015, Ryan Rudolph
* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License 
* 
*/

// Force full width 
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' ); 

// Remove Page Title (HTML5)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

genesis();

