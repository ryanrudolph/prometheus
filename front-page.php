<?php 
/** 
* Front Page 
* 
 * This is the template for the homepage.
 *
 * @package Prometheus
 * @author  GetPhound
 * @license GPL-2.0+
 * @link    http://www.ryanrudolph.com/how-to-use-prometheus
* 
*/

// Force full width 
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' ); 

// Remove page title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

genesis();

