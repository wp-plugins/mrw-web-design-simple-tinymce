<?php
/*
* Plugin Name: MRW Web Design Simple TinyMCE
* Plugin URI: http://mrwweb.com/wordpress-plugins/mrw-web-design-simple-tinymce/
* Description: Removes useless buttons and adds the ability to use more advanced features of TinyMCE. Disabling this plugin may remove features from your site!
* Version: 1.0.6
* Author: Mark Root-Wiley
* Author URI: http://MRWweb.com
* Text Domain: mrwweb-simple-tinymce
* License: GPLv2 or later
*/

add_filter( 'mce_buttons', 'mrw_mce_buttons_1', 0 );
/**
 * Remove formatting buttons that cause more trouble than they're worth.
 * Merge remaining buttons onto first row.
 *
 * @since  1.0.0
 * @access public
 * @param  $buttons array the default TinyMCE buttons
 * @return array the modified TinyMCE buttons
 * @see    http://codex.wordpress.org/TinyMCE_Custom_Buttons
 */
function mrw_mce_buttons_1( $buttons ) {
	$buttons = array(
		0 => 'styleselect',
		5 => 'bold',
		10 => 'italic',
		15 => 'link',
		20 => 'unlink',
		25 => 'bullist',
		30 => 'numlist',
		35 => 'indent',
		40 => 'outdent',
		45 => 'pastetext',
		50 => 'removeformat',
		55 => 'charmap',
		60 => 'undo',
		65 => 'redo',
		75 => 'dfw',
	);

	if ( ! wp_is_mobile() ) {
		$buttons[70] = 'wp_help'; 
	}

	return $buttons;
}

// Return an empty array for the second row of TinyMCE buttons.
add_filter( 'mce_buttons_2', '__return_empty_array', 0 );

add_filter( 'tiny_mce_before_init', 'mrw_mce_init', 0 );
/**
 * Customize the WordPress TinyMCE editor.
 *
 * Remove h1 and address from block styles.
 * Move blockquote to block styles and del and pre to "Other Styles."
 * Add sub and sup to "Other Styles."
 *
 * @since  1.0.0
 * @access public
 * @param  $args array existing TinyMCE arguments
 * @return $args array modified TinyMCE arguments
 * @see    http://wordpress.stackexchange.com/a/128950/9844
 */
function mrw_mce_init( $args ) {
	$style_formats = array(
		array(
			'title'  => __( 'Paragraph', 'mrwweb-simple-tinymce' ),
			'format' => 'p',
		),
		array(
			'title'  => __( 'Heading 2', 'mrwweb-simple-tinymce' ),
			'format' => 'h2',
		),
		array(
			'title'  => __( 'Heading 3', 'mrwweb-simple-tinymce' ),
			'format' => 'h3',
		),
		array(
			'title'  => __( 'Heading 4', 'mrwweb-simple-tinymce' ),
			'format' => 'h4',
		),
		array(
			'title'  => __( 'Blockquote', 'mrwweb-simple-tinymce' ),
			'format' => 'blockquote',
			'icon'   => 'blockquote',
		),
		array(
			'title' => __( 'Other Formats', 'mrwweb-simple-tinymce' ),
			'items' => array(
				array(
					'title'  => __( 'Strikethrough', 'mrwweb-simple-tinymce' ),
					'format' => 'strikethrough',
					'icon'   => 'strikethrough',
				),
				array(
					'title'  => __( 'Superscript', 'mrwweb-simple-tinymce' ),
					'format' => 'superscript',
					'icon'   => 'superscript',
				),
				array(
					'title'  => __( 'Subscript', 'mrwweb-simple-tinymce' ),
					'format' => 'subscript',
					'icon'   => 'subscript',
				),
				array(
					'title'  => __( 'pre', 'mrwweb-simple-tinymce' ),
					'format' => 'pre',
				),
				array(
					'title'  => __( 'Code', 'mrwweb-simple-tinymce' ),
					'format' => 'code',
					'icon'   => 'code',
				),
			),
		),
	);

	/**
	 * Filter to add styles to "Text Styles" submenu in `styleselect`.
	 * 
	 * @since  1.0.0
	 * 
	 * @param array $text_styles array of arrays, each defining a style
	 * 
	 * @see http://wordpress.stackexchange.com/a/128950/9844
	 */
	$text_styles = array();
	$text_styles = apply_filters( 'mrw_mce_text_style', $text_styles );
	if ( ! empty( $text_styles) ) {
		// Define the "Text Style" submenu
		$text_styles = array(
			'title' => __( 'Text Styles', 'mrwweb-simple-tinymce' ),
			'items' => $text_styles,
		);

		// save "Other Formats" to append at the end.
		$other_formats = array_pop( $style_formats );
		$style_formats = array_merge(
			$style_formats,
			array( $text_styles ), // this has to be an array of arrays from above.
			array( $other_formats )
		);
	}

	$args['style_formats'] = json_encode( $style_formats );

	return $args;
}