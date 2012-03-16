=== WP HTML Rotator Plugin ===
Contributors: Ariel Coppes
Tags: html, rotator, shortcode
Requires at least: 3.1
Tested up to: 3.1.3
Stable tag: 0.1.1

== Description ==

Create HTML sections to be rotated based in the timezone and the hour of day.

== Usage ==

Right now the plugin is enabled by using the shortcode [rotator]. For example, To specify we want to show a specific piece of HTML from 9am to 5pm we do the following code:

[rotator start="9am" end="5pm"]
<div> 
   Some custom HTML.
</div>
[/rotator]

That will show the contents only if the user access the blog post or page in the specified hour range.

Currently, it supports the following parameters:

- start: a date to specify the start of the hour range, required.
- end: a date to specify the end of the hour range, required.
- visible: false to hide the html section, by default true.
- inverse: to specify if we want to show the html section outside the our range, by default false.

Both start and end are using the date format specified in http://www.php.net/manual/en/datetime.formats.php . For example, we can specify the timezone of the hour range:

[rotator start="9am -0600" end="5pm -0600"]...[/rotator]

note: Using GMT notation doesn't work in some installations, not sure which php version is required for that to work.

== Configuration == 

The first lines of the plugin contains some global variables to configure the plugin, for example, if you want to disable the generator from the admin -> settings page, among other configurations.

- WP_HTML_ROTATOR_DEBUG: defines if the plugin echoes debug information.
- WP_HTML_ROTATOR_ENABLE_WIDGETS: enables the shortcode to work on text widgets.
- WP_HTML_ROTATOR_ENABLE_GENERATOR: enable the shortcode generator to be shown in the admin panel or not.

== Changelog ==

- Added the shortcode with the default parameters.

