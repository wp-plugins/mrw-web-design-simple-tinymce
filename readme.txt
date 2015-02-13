=== MRW Web Design Simple TinyMCE ===
Contributors: mrwweb
Tags: TinyMCE, Editor Styles, Editor, Text Editor
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1.0.5
Donate link: https://www.networkforgood.org/donation/MakeDonation.aspx?ORGID2=522061398
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Get rid of bad and obscure TinyMCE buttons. Move the rest to a single top row. Comes with a bit of help for adding custom CSS classes too.

== Description ==

Out of the box, the TinyMCE editor lets people do stupid or unnecessary things. When publishing content with a CMS, all formatting should be semantic and promote highly-readable content as much as possible.

This plugin creates a single row of buttons containing the following:

"Styleselect,"* Bold, Italic, Add/Edit Link, Break Link, Indent, Outdent, Paste as Plain Text,** Remove Styles, Special Characters, Undo, Redo, Help, Distraction Free Mode.

This plugin also provides a simple-yet-powerful filter (see below) for developers to add the ability to apply custom styles with the editor.

*\* The Styleselect contains Headings 2-4 and Blockquote as well as Strikethrough, Subscript, Superscript, and Preformatted in an "Other Formats" submenu.*

*\*\* This plugin pairs deliciously with [Paste as Plain Text](https://wordpress.org/plugins/paste-as-plain-text/).*

> I built this plugin for use on client sites and share it in hopes that others will find it helpful. I'm highly motivated to maintain it since I use it for other people.
> 
> However, **this is an opinionated plugin** and so major feature additions are unlikely and support will be limited to bugs and *basic* use of the filters.

= Filters =

The plugin hooks early to the standard `mce_buttons`, `mce_buttons_2`, 	and `tiny_mce_before_init` filters so that this plugin is [easy to override](https://wordpress.org/plugins/mrw-web-design-simple-tinymce/other-notes/).

This plugin replaces the "formatselect" with the "styleselect" for its added support of custom CSS styles. There is easy-to-use filter for allowing the application of CSS classes in the editor: `mrw_mce_text_style`. You can find an [example of the filter's usage on the "Other Notes" tag](https://wordpress.org/plugins/mrw-web-design-simple-tinymce/other_notes/). See also:

* [tinymce.com/wiki.php/Configuration:style_formats](http://tinymce.com/wiki.php/Configuration:style_formats)
* [tinymce.com/wiki.php/Configuration:formats](http://tinymce.com/wiki.php/Configuration:formats)
* [wordpress.stackexchange.com/a/128950/9844](http://wordpress.stackexchange.com/a/128950/9844)

== Installation ==

1. Upload `/mrwweb-simple-tinymce/` to the `/wp-content/plugins/` directory
1. Activate the plugin through the "Plugins" menu in WordPress
1. Write away, right away!

\- OR -

1. From your WordPress site's dashboard, go to Plugins > Add New.
1. Search for "MRW Web Design Simple TinyMCE."
1. The plugin should be the first result. Click "Install."
1. Allow the plugin to install, then click "Activate."
1. Write away, right away!

== Frequently Asked Questions ==

There are plenty of questions but none asked yet. Will update as appropriate.

== Other Notes ==

= Compatibility =

The plugin requires WordPress 4.1+ because of the new Distraction Free Writing Mode. The plugin should otherwise work well in WordPress 3.9+. The plugin will not work in any earlier versions.

= Code Recipes =

Below we have examples for adding back a button and adding a new "Text Styles" section for custom styles in the "Format" drop down.

= Add the "Insert More Tag" Button =

This is the one button that might be legitimately missing from this plugin, though I find it's rarely used. If you need it, use the following snippet in your theme's `functions.php` file. (Since the More Tag is used by a theme, the `functions.php` files is a good place for it.)

`
/* Add "Insert More Tag" Button in Text Editor After charmap */
add_filter( 'mce_buttons', 'mrw_mce_add_more_tag_button' );
function mrw_mce_add_more_tag_button( $buttons ) {
    $buttons[57] = 'wp_more';
    ksort($buttons);
    return $buttons;
}
`

= Add Custom Styles to "Text Styles" submenu of "Formats" menu =

**Warning:** The following feature is almost completely useless without an accompanying set of CSS rules in [an `editor-style.css` file](http://codex.wordpress.org/Editor_Style).

Here's how the `mrw_mce_text_style` filter works:
`
add_filter( 'mrw_mce_text_style', 'mrw_add_text_styles_example' );
/**
 * Example filter to add text styles to TinyMCE filter with Mark's "MRW TinyMCE Mods" plugin
 * 
 * Adds a "Text Styles" submenu to the "Formats" dropdown
 * 
 * This would go in a functions.php file or mu-plugin so you don't have to modify the original plugin.
 * 
 * @param array $styles Contains arrays of style_format arguments to define styles.
 * 						Note: Should be an "array of arrays"
 * 
 * @see tinymce.com/wiki.php/Configuration:style_formats
 * @see tinymce.com/wiki.php/Configuration:formats
 * @see wordpress.stackexchange.com/a/128950/9844
 */
function mrw_add_text_styles_example( $styles ) {
	$new_styles = array(
		/* Inline style that only applies to links */
		array(
			'title' => "Link Button", /* Label in "Formats" menu */
			'selector' => 'a', /* this style can ONLY be applied to existing <a> elements in the selection! */
			'classes' => 'button' /* class to add */
		),
		/* Inline style applied with a <span> */
		array(
			'title' => "Callout Text",
			'inline' => 'span', /* "inline" key for inline phrasing elements */
			'classes' => 'callout'
		),
		/* Block style applied to paragraph. Each paragraph in selection gets the classes. */
		array(
			'title' => "Warning Message",
			'block' => 'p', /* "block" key for block-level elements. these don't always behave */
			'classes' => 'message warning'  /* two classes work (space-separated) but can't be undone easily via editor */
		),
		/* Block style capable of containing other block-level elements */
		array(
			'title' => "Feature Box",
			'block' => 'section', 
			'classes' => 'feature-box',
			'wrapper' => true
		)
	);
	return array_merge( $styles, $new_styles );
}`

== Screenshots ==

1. The editor in all its minimal glory. This shows the default set of buttons and styles.

2. "Link Button" is an example of a text style that can be added with the [`mrw_mce_text_style` filter](https://wordpress.org/plugins/mrw-web-design-simple-tinymce/other-notes/). In this example, it's grayed-out by default since it can only be applied to links!

== Changelog ==

= 1.0.5 (Feb 13, 2015) =
* Improved code formatting thanks to [@robneu](https://profiles.wordpress.org/fatmedia/)!
* Add keys to the `$buttons` array filtered by `mce_buttons` for more intuitive button insertion.
* Example of above and working with "Text Styles" submenu added as "Code Recipes" in ["Other Notes"](https://wordpress.org/plugins/mrw-web-design-simple-tinymce/other_notes/).
* [Breaking Change] Remove `mrw_mce_style_formats` filter. It was a stupid idea and I doubt anyone's used it yet.
* Fixed PNG mime-types for files used by repository in `/assets/`

= 1.0.4 (Feb 6, 2015) =
* Cleaned up and submitted to the repository.
* Renamed "MRW Web Design Simple TinyMCE"
* New readme, screenshots, etc.
* Feb 12, 2015: No version update, but revised screenshots and improved readme.

= 1.0.3 (Jan 5, 2015) =
* Change "fullscreen" to "dfw" for Distraction Free Writing Mode support in 4.1.

= 1.0.2 (Sept 16, 2014) =
* Fix "Header" to "Heading." D'oh!

= 1.0.1 (May 9, 2014) =
* [Fix] Fix Help Icon

= 1.0 (May 5, 2014) =
* Initial release

== Upgrade Notice ==
= 1.0.5 =
* Better formatting and inline documentation. BREAKING CHANGE: Remove `mrw_mce_style_formats` filter. I doubt you were using it.

= 1.0.4 =
* I'm impressed you had this installed already. Welcome to the beautiful world of automatic updates.