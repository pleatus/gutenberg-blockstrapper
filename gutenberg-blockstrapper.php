<?php

/**
 * Plugin Name: Gutenberg Blockstrapper
 * Plugin URI: https://blockstrapper.r--j.ca/
 * Description: This is a Block layout plugin utilizing Bootstrap for the Gutenberg editor.
 * Version: 1.0.1
 * Author: Ray Jaworski
 * Author URI: https://r--j.ca
 *
 * License:     GPLV3
 * @package gutenberg-blockstrapper
 */
defined( 'ABSPATH' ) || exit;

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */

add_action( 'the_content', 'replace_blockstrapper_tags' );

function gutenberg_blockstrapper_register_blocks() {
	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}
	wp_register_script(
		'gutenberg-blockstrap-container',
		plugins_url( 'block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
	);
	wp_register_script(
		'gutenberg-blockstrap-row',
		plugins_url( 'block1.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block1.js' )
	);
	wp_register_script(
		'gutenberg-blockstrap-column',
		plugins_url( 'block2.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block2.js' )
	);
	wp_register_script(
		'gutenberg-blockstrap-close',
		plugins_url( 'block3.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block3.js' )
	);
	wp_register_script(
		'gutenberg-blockstrap-column-2',
		plugins_url( 'block4.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block4.js' )
	);
	wp_register_script(
		'gutenberg-blockstrap-col-centered',
		plugins_url( 'block6.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block6.js' )
	);
	wp_register_script(
		'blockstrapper-custom',
		plugins_url( 'block5.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block5.js' )
	);
	

	
	register_block_type( 'gutenberg-blockstrap/blockstrap-container', array(
		'editor_script' => 'gutenberg-blockstrap-container',
	) );
	register_block_type( 'gutenberg-blockstrap/blockstrap-row', array(
		'editor_script' => 'gutenberg-blockstrap-row',
	) );
	register_block_type( 'gutenberg-blockstrap/blockstrap-column', array(
		'editor_script' => 'gutenberg-blockstrap-column',
	) );
	register_block_type( 'gutenberg-blockstrap/blockstrap-close', array(
		'editor_script' => 'gutenberg-blockstrap-close',
	) );
	register_block_type( 'gutenberg-blockstrap/blockstrap-column-2', array(
		'editor_script' => 'gutenberg-blockstrap-column-2',
	) );
	register_block_type( 'gutenberg-blockstrap/blockstrap-col-centered', array(
		'editor_script' => 'gutenberg-blockstrap-col-centered',
	) );
	register_block_type( 'gutenberg-blockstrapper/blockstrapper-custom', array(
		'editor_script' => 'blockstrapper-custom',
	) );
}

//checks for tags created by plugin blocks in the content and replaces them with appropriate bootstrap element on the front-end
function replace_blockstrapper_tags ( $content ) {

	$bs_container = array('「container』','<div class="container">');
	$bs_row = array('「row』','<div class="row centered">');
	$bs_column = array('「col-sm-12 col-md-6 col-lg-4』','<div class="col-sm-12 col-md-6 col-lg-4">');
	$bs_column1 = array('「col-sm-12 col-md-6 col-lg-8』','<div class="col-sm-12 col-md-6 col-lg-8">');
	$bs_emb_res = array('「jumbotron』','<div class="jumbotron">');
	$bs_close = array('「close』','</div>');
	$content = str_ireplace( $bs_container[0], $bs_container[1], $content );
	$content = str_ireplace( $bs_row[0], $bs_row[1], $content );
	$content = str_ireplace( $bs_column[0], $bs_column[1], $content );
	$content = str_ireplace( $bs_column1[0], $bs_column1[1], $content );
	$content = str_ireplace( $bs_emb_res[0], $bs_emb_res[1], $content );
	$content = str_ireplace( $bs_close[0], $bs_close[1], $content );
	return $content;
}
add_action( 'init', 'gutenberg_blockstrapper_register_blocks' );

//stuff to make blocks dynamic/editable
	//echo gettype( $content );
	//$bs_regex = '/「(.*)』/';
	//$bs_elements = [];
	//$bs_str_start_pos = strpos($content, '「');
	/*while ($bs_str_start_pos !== -1) {
		$bs_str_end_pos = strpos($content, '』',($bs_str_end_pos)?$bs_str_end_pos:0);
		$bs_str_start_pos = strpos($content, '「', $bs_str_end_pos);
		$bs_found_tag = substr($content,$bs_str_start_pos,$bs_str_end_pos - $bs_str_start_pos);
		array_push($bs_elements,$bs_found_tag);
		//$bs_match = preg_match($bs_regex, $content, $matches);
		//echo count($matches);
		echo implode(', ',$bs_elements);
		echo 'bs-string-pos: ' . $bs_str_start_pos . 'end-bs-pos: ' . $bs_str_end_pos . ' tag found: ' . $bs_found_tag;
		$bs_div_open = '<div class="';
		$bs_div_close = '">';
		return $content;
		//$content = str_ireplace( $bs_match, $bs_div_open . $content. $bs_div_close, $content );
	}
	//}
	*/
	//$bs_match = preg_match($bs_regex, $content);