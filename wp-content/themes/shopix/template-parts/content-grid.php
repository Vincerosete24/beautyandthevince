<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shopix
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-content-inner">
		<?php do_action( 'shopix_post_item_before' ); ?>

		<div class="content-grid">
			<?php do_action( 'shopix_post_item_content', $layout_type = 'is-grid' ); ?>
		</div>

		<?php do_action( 'shopix_post_item_after' ); ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->