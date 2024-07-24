=== emBold Tailwind Blocks ===
Contributors: itsjsutxan, embold-tyler
Tags: tailwind, blocks
Requires at least: 6.0
Tested up to: 6.2.2
Stable tag: 2.3.2
Requires PHP: 8.0

A collection of Tailwind Blocks, written with ACF Composer and Blade Templates.

== Description ==

This plugin utilizes the acf-composer and acf-builder packages and allows us to include our own default
Block and Field classes in the plugin files to jumpstart theme development.

If for some reason you need to tweak or modify what comes with the plugin you can copy the file into your theme and tweak it.
Need the Statistics block to do something slightly different? Copy its app/Blocks/Statistics.php from the plugin to your theme and
the theme files take priority. You can do this with the Padding field, or any views as well.

Please view the full README.md on GitHub.

== Changelog ==

= 2.3.2 =
* Change plugin homepage to the GitHub repo

= 2.3.1 =
* Fix fatal error in view by converting template array to JSON string

= 2.3.0 =
* Update assets signature on CustomBlock class for greater flexibility

= 2.2.0 =
* Add CoreExtension class to allow adding style choices to core blocks in an object oriented manner

= 2.1.0 =
* Add "validate" property to all of our blocks with a false value by default for ACF 6.3.0 compatibility

= 2.0.2 =
* Remove nested acf/init action so that default options page gets called again

= 2.0.1 =
* Fix deprecated function

= 2.0.0 =
* Rewrote and updated a good chunk of the plugin to be compatible with Acorn v4 and Livewire.

= 1.0.0 =
* Disable plugin updates if a Acorns is lower than v4 or log1x/acf-composer is lower than v3

= 0.12.0 =
* open source the plugin

= 0.11.0 =
* gracefully timeout after a fraction of a second if API call fails

= 0.10.0 =
* default block icons to emBold blue

= 0.9.6 =
* only run splider functions when element exists

= 0.9.5 =
* Learn to type

= 0.9.4 =
* Disable plugin if ACF or ACF Pro aren't enabled.

= 0.9.3 =
* Fix critical bug in class autoloader.

= 0.9.2 =
* Trim the value pulled for the GitHub token and fallback if key missing.

= 0.9.1 =
* Give plugin unique identifier

= 0.9.0 =
* Add plugin update ability

== Upgrade Notice ==

= 0.9.2 =
* Trim the value pulled for the GitHub token and fallback if key missing.
