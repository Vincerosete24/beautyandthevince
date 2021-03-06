<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shopix
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
		do_action( 'shopix_single_item_content_before', $is_page = true );

		do_action( 'shopix_single_item_content', $is_page = true );
		
		do_action( 'shopix_single_item_content_after', $is_page = true );
	?>

</article><!-- #post-<?php the_ID(); ?> -->