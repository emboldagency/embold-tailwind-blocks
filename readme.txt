=== emBold Tailwind Blocks ===
Contributors: itsjsutxan
Tags: tailwind, blocks
Requires at least: 6.0
Tested up to: 6.2.2
Stable tag: 0.9.2
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

= 0.9.2 =
* Trim the value pulled for the GitHub token and fallback if key missing.

= 0.9.1 =
* Give plugin unique identifier

= 0.9.0 =
* Add plugin update ability

== Upgrade Notice ==

= 0.9.2 =
* Trim the value pulled for the GitHub token and fallback if key missing.