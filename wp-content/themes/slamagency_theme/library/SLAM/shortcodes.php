<?php

function slam_menu_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'menu' 			=> 'main',
		'echo'			=> '0',
		'menu_class'	=> 'shortcode-menu',
		'container'		=> false,
		'class'			=> '',
	), $atts );
	
	extract($atts);

	$atts['menu_class'] .= ' ' . $class;

	return wp_nav_menu($atts);

	// do shortcode actions here
}
add_shortcode( 'menu','slam_menu_shortcode' );

/**
 * Returns the url to the site
 * @return string: url to the site.
 */
function slam_site_url( $atts ) {
	return get_site_url();
}
add_shortcode( 'site_url','slam_site_url' );	



?>