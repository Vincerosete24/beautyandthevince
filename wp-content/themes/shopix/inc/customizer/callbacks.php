<?php
/**
 * Customizer callbacks
 *
 * @package Shopix
 */
 
/**
 * Top bar active
 */
function shopix_top_bar_active_callback() {
    $enable_top_bar = get_theme_mod( 'enable_top_bar' );

	if ( $enable_top_bar ) {
		return true;
	} else {
		return false;
	}    
}

/**
 * Header button
 */
function shopix_header_button_active_callback() {
    $enable = get_theme_mod( 'enable_header_button', 1 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}    
}

/**
 * Header contact
 */
function shopix_header_contact_active_callback() {
    $enable = get_theme_mod( 'enable_header_contact', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}    
}

/**
 * Header bottom bar
 */
function shopix_bottom_header_bar_callback() {
	$layout = get_theme_mod( 'main_header_layout', 'default' );

	if ( 'inline' !== $layout ) {
		return true;
	} else {
		return false;
	}
}