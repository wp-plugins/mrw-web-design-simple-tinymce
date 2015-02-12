<?php
/*
* Plugin Name: MRW Web Design Simple TinyMCE
* Plugin URI: http://mrwweb.com/wordpress-plugins/mrw-web-design-simple-tinymce/
* Description: Removes useless buttons and adds the ability to use more advanced features of TinyMCE. Disabling this plugin may remove features from your site!
* Version: 1.0.4
* Author: Mark Root-Wiley
* Author URI: http://MRWweb.com
* Text Domain: mrwweb-simple-tinymce
* License: GPLv2 or later
*/
 
/**
 * Remove formatting buttons that cause more trouble than they're worth.
 * Merge remaining buttons onto first row.
 *
 * See: http://codex.wordpress.org/TinyMCE_Custom_Buttons
 */
add_filter( 'mce_buttons', 'mrw_mce_buttons_1', 0 );
function mrw_mce_buttons_1( $buttons ) {
	$buttons = array( 'styleselect', 'bold', 'italic', 'link', 'unlink', 'bullist', 'numlist', 'indent', 'outdent', 'pastetext', 'removeformat', 'charmap', 'undo', 'redo', 'wp_help', 'dfw' );
 
	return $buttons;
}
add_filter( 'mce_buttons_2', 'mrw_mce_buttons_2', 0 );
function mrw_mce_buttons_2( $buttons ) {
	$buttons = array();
	return $buttons;
}
 
/**
 * customize the WordPress tinymce editor
 *
 * Show kitchen sink by default. Remove h1 and address from block styles
 * 
 * deeply indebted to http://wordpress.stackexchange.com/a/128950/9844
 *
 * @param $args array exising mceargs
 * @return modified $args array
 */
add_filter( 'tiny_mce_before_init', 'mrw_mce_init', 0 );
function mrw_mce_init( $args ) {
	
	$style_formats = array(
		array(
			'title' => __( 'Paragraph', 'mrwweb-simple-tinymce' ),
			'format' => 'p'
			),
		array(
			'title' => __( 'Heading 2', 'mrwweb-simple-tinymce' ),
			'format' => 'h2'
		),
		array(
			'title' => __( 'Heading 3', 'mrwweb-simple-tinymce' ),
			'format' => 'h3'
		),
		array(
			'title' => __( 'Heading 4', 'mrwweb-simple-tinymce' ),
			'format' => 'h4'
		),
		array(
			'title' => __( 'Blockquote', 'mrwweb-simple-tinymce' ),
			'format' => 'blockquote',
			'icon' => 'blockquote'
		),
		array(
			'title' => __( 'Other Formats', 'mrwweb-simple-tinymce' ),
			'items' => array(
				array(
					'title' => __( 'Strikethrough', 'mrwweb-simple-tinymce' ),
					'format' => 'strikethrough',
					'icon' => 'strikethrough',
				),
				array(
					'title' => __( 'Superscript', 'mrwweb-simple-tinymce' ),
					'format' => 'superscript',
					'icon' => 'superscript'
				),
				array(
					'title' => __( 'Subscript', 'mrwweb-simple-tinymce' ),
					'format' => 'subscript',
					'icon' => 'subscript'
				),
				array(
					'title' => __( 'pre', 'mrwweb-simple-tinymce' ),
					'format' => 'pre'
				)
			)
		)
	);
 
	// Special custom filter to add text styles from a theme's functions.php file
	$text_styles = array();
	$text_styles = apply_filters( 'mrw_mce_text_style', $text_styles );
	if( !empty( $text_styles) ) {
		$text_styles = array(
			'title' => 'Text Styles',
			'items' => $text_styles
		);
		// put style formats second-to-last
		$other_formats = array_pop( $style_formats );
		$style_formats = array_merge( $style_formats, array( $text_styles ), array( $other_formats ) );
	}
 
	// Last minute filter for anything more complicated before json_encoded
	$style_formats = apply_filters( 'mrw_mce_style_formats', $style_formats );
 
	$args['style_formats'] = json_encode( $style_formats );
	
	return $args;
}