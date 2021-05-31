<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shopix
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'shopix' ); ?></a>

	<?php do_action( 'shopix_header_before' ); ?>

	<?php 
	global $post;

	if ( isset( $post ) ) {
		$disable_header	= get_post_meta( $post->ID, '_shopix_hide_header', true );	
		if ( !$disable_header ) {
			do_action( 'shopix_header' );
		}
	} else { 
		do_action( 'shopix_header' );
	}
	?>

	<?php do_action( 'shopix_header_after' ); ?>
	
	<div class="er-main-container container">
