<?php

/**
 * Gutenberg support
 */

function shopix_editor_styles() {

	wp_enqueue_style( 'shopix-fonts', shopix_generate_fonts_url(), array(), SHOPIX_VERSION );


	$css = '';

	/**
	 * Fonts
	 */		
	$defaults_headings 	= json_encode(
		array(
			'font' 			=> 'Source Serif Pro',
			'italicweight' 	=> '600i',
			'boldweight' 	=> '600',
			'category' 		=> 'serif'
		)
	);

	$defaults_body 	= json_encode(
		array(
			'font' 			=> 'Nunito',
			'regularweight' => '400',
			'italicweight' 	=> '400i',
			'boldweight' 	=> '700',
			'category' 		=> 'sans-serif'
		)
	);	

	$body_font		= get_theme_mod( 'shopix_body_font', $defaults_body );
	$headings_font 	= get_theme_mod( 'shopix_headings_font', $defaults_headings );

	$body_font 		= json_decode( $body_font, true );
	$headings_font 	= json_decode( $headings_font, true );

	$css .= 'div.editor-styles-wrapper { font-family:' . esc_attr( $body_font['font'] ) . ',' . esc_attr( $body_font['category'] ) . ';}' . "\n";	
	$css .= 'div.editor-styles-wrapper { font-weight:' . esc_attr( $body_font['regularweight'] ) . ';}' . "\n";	

	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'body_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'div.editor-styles-wrapper' );


	$css .= 'div.editor-styles-wrapper .editor-post-title .editor-post-title__input, div.editor-styles-wrapper h1,div.editor-styles-wrapper h2,div.editor-styles-wrapper h3,div.editor-styles-wrapper h4,div.editor-styles-wrapper h5,div.editor-styles-wrapper h6 { font-family:' . esc_attr( $headings_font['font'] ) . ',' . esc_attr( $headings_font['category'] ) . ';}' . "\n";	
	$css .= 'div.editor-styles-wrapper .editor-post-title .editor-post-title__input, div.editor-styles-wrapper h1,div.editor-styles-wrapper h2,div.editor-styles-wrapper h3,div.editor-styles-wrapper h4,div.editor-styles-wrapper h5,div.editor-styles-wrapper h6 { font-weight:' . esc_attr( $headings_font['boldweight'] ) . ';}' . "\n";	

	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'h1_heading_font_size', $defaults = array( 'desktop' => 40, 'tablet' => 36, 'mobile' => 28 ), 'h1' );
	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'h2_heading_font_size', $defaults = array( 'desktop' => 32, 'tablet' => 28, 'mobile' => 22 ), 'h2' );
	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'h3_heading_font_size', $defaults = array( 'desktop' => 28, 'tablet' => 24, 'mobile' => 18 ), 'h3' );
	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'h4_heading_font_size', $defaults = array( 'desktop' => 24, 'tablet' => 20, 'mobile' => 16 ), 'h4' );
	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'h5_heading_font_size', $defaults = array( 'desktop' => 20, 'tablet' => 16, 'mobile' => 16 ), 'h5' );
	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'h6_heading_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'h6' );

	wp_add_inline_style( 'shopix-block-editor-styles', $css );	

}
add_action( 'enqueue_block_editor_assets', 'shopix_editor_styles' );