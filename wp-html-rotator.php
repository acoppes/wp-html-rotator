<?php

/*
Plugin Name: WP HTML Rotator
Plugin URI: 
Description: Rotate HTML sections based on the timezone and hour of day.
Version: 0.0.1-SNAPSHOT
Author: Ariel Coppes
Author URI: 
*/

function html_rotation_section($atts, $content = null) {

	// defines the default function parameter values
	$default_atts = array( 
		'visible' => "true", 
	);

	// merges the default parameters with the current parameters
	$values = shortcode_atts($default_atts, $atts);

	$visible = $values['visible'];

	if ($visible != "true")
		return null;

	return $content;
}

add_shortcode('html_rotation_section', 'html_rotation_section');

?>
