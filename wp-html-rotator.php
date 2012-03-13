<?php

/*
Plugin Name: WP HTML Rotator
Plugin URI: 
Description: Rotate HTML sections based on the timezone and hour of day.
Version: 0.0.1-SNAPSHOT
Author: Ariel Coppes and Jason Caluori
Author URI: 
*/

function html_rotation_section($atts, $content = null) {

	$DEBUG = FALSE;

	// defines the default function parameter values
	$default_atts = array( 
		'visible' => "true", 
		'start' => null,
		'end' => null,
	);

	// merges the default parameters with the current parameters
	$values = shortcode_atts($default_atts, $atts);

	$visible = $values['visible'];
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

	return $content;
}

add_shortcode('rotator', 'html_rotation_section');

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

?>
