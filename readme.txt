=== MRW Web Design Simple TinyMCE ===
Contributors: mrwweb
Tags: TinyMCE, Editor Styles, Editor, Text Editor
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1.4
Donate link: https://www.networkforgood.org/donation/MakeDonation.aspx?ORGID2=522061398
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Get rid of bad and obscure TinyMCE buttons. Move the rest to a single top row. Comes with a bit of help for adding custom CSS classes too.

== Description ==

Out of the box, the TinyMCE editor lets people do stupid or unnecessary things. When publishing content with a CMS, all formatting should be semantic and promote highly-readable content as much as possible.

This plugin creates a single row of buttons containing the following:

"Styleselect,"* Bold, Italic, Add/Edit Link, Break Link, Indent, Outdent, Paste as Plain Text,** Remove Styles, Special Characters, Undo, Redo, Help, Distraction Free Mode.

\* The Styleselect contains Headings 2-4 and Blockquote as well as Strikethrough, Subscript, Superscript, and Preformatted in an "Other Formats" submenu.

\*\* This plugin pairs deliciously with [Paste as Plain Text](https://wordpress.org/plugins/paste-as-plain-text/).

> I built this plugin for use on client sites and share it in hopes that others will find it helpful. I'm highly motivated to maintain it since I use it for other people.
> 
> However, **this is an opinionated plugin** and so major feature additions are unlikely and support will be limited to bugs and *basic* use of the filters.

= Filters =

The plugin hooks early to the standard `mce_buttons`, `mce_buttons_2`, 	and `tiny_mce_before_init` filters so that this plugin is easy to override.

This plugin replaces the "formatselect" with the "styleselect" for its added support of custom CSS styles. There is easy-to-use filter for allowing the application of CSS classes in the editor: `mrw_mce_text_style`. You can find an [example of the filter's usage on GitHub](https://gist.github.com/mrwweb/9937127#file-mrw-tinymce-filter-example-php). See also:

* [tinymce.com/wiki.php/Configuration:style_formats](http://tinymce.com/wiki.php/Configuration:style_formats)
* [tinymce.com/wiki.php/Configuration:formats](http://tinymce.com/wiki.php/Configuration:formats)
* [wordpress.stackexchange.com/a/128950/9844](http://wordpress.stackexchange.com/a/128950/9844)

== Installation ==

1. Upload `/mrwweb-simple-tinymce/` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

None yet. Will add as questions are asked.

== Screenshots ==

1. The editor in all its minimal glory. This shows the default set of buttons and styles.

2. "Link Button" is an example of a text style that can be added with the `mrw_mce_text_style` filter. In this example, it's grayed-out by default since it can only be applied to links!

== Changelog ==
= 1.0.4 (Feb 6, 2015) =
* Cleaned up and submitted to the repository.
* Renamed "MRW Web Design Simple TinyMCE"
* New readme, screenshots, etc.

= 1.0.3 (Jan 5, 2015) =
* Change "fullscreen" to "dfw" for Distraction Free Writing Mode support in 4.1.

= 1.0.2 (Sept 16, 2014) =
* Fix "Header" to "Heading." D'oh!

= 1.0.1 (May 9, 2014) =
* [Fix] Fix Help Icon

= 1.0 (May 5, 2014) =
* Initial release

== Upgrade Notice ==
= 1.0.4 =
* I'm impressed you had this installed already. Welcome to the beautiful world of automatic updates.