<?php

/*
Plugin Name: WP HTML Rotator
Plugin URI: http://wordpress.org/extend/plugins/wp-html-rotator
Description: Rotate HTML sections based on the timezone and hour of day.
Version: 0.1.0
Author: Ariel Coppes and Jason Caluori
Author URI: http://careers.stackoverflow.com/arielcoppes
*/

function html_rotation_section($atts, $content = null) {

	$DEBUG = FALSE;

	// defines the default function parameter values
	$default_atts = array( 
		'visible' => "true",
		'inverse' => null,  
		'start' => null,
		'end' => null,
	);

	// merges the default parameters with the current parameters
	$values = shortcode_atts($default_atts, $atts);

	$visible = $values['visible'];
	$inverse = $values['inverse'];
	$start = $values['start'];
	$end = $values['end'];

	if ($visible != "true")
		return null;

	if ($start == null)
		return "start attribute not provided";

	if ($end == null)
		return "end attribute not provided";

	$start_time = strtotime($start);
	$end_time = strtotime($end);

	if ($start_time == -1 or $start_time == FALSE) {
		if ($DEBUG)
			return "Wrong start attribute"."<br/>";
		return null;
	}

	if ($end_time == -1 or $end_time == FALSE) {
		if ($DEBUG == TRUE)
			return "Wrong end attribute"."<br/>";
		return null;
	}

	$current_time = time();

	if ($DEBUG) {
		echo "current_time: ".date('D, d M Y H:i:s T', $current_time)."<br/>";
		echo "start_time: ".date('D, d M Y H:i:s T', $start_time)."<br/>";
		echo "end_time: ".date('D, d M Y H:i:s T', $end_time)."<br/>";
	}

	if ($inverse == null or $inverse != 'true') {
		if ($current_time < $start_time) {
			if ($DEBUG)
				return "current time < start time"."<br/>";
			return null;
		}

		if ($current_time > $end_time) {
			if ($DEBUG)
				return "current time > end time"."<br/>";
			return null;
		}
	} else {
		if ($current_time >= $start_time and $current_time <= $end_time) {
			if ($DEBUG)
				return "current time >= start time and current time <= end time"."<br/>";
			return null;
		}

	}

	return $content;
}

add_shortcode('rotator', 'html_rotation_section');

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

// Configuration

add_action('admin_menu', 'html_rotator_menu');

function html_rotator_menu() {
	add_options_page('HTML Rotator Shortcode Generator', 'Rotator generator', 'manage_options', 'wp-html-rotator-identifier', 'html_rotator_generator');
}

function html_rotator_generator() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}

?>
