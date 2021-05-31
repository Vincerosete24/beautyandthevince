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

		<div class="row">
			<div class="col-md-4 col-sm-4 col-12">
				<?php shopix_post_thumbnail( 'shopix-500x500' ); ?>
			</div>	
			<div class="col-md-8 col-sm-8 col-12">
				<div class="content-list">
					<?php do_action( 'shopix_post_item_content', $layout_type = 'is-list' ); ?>
				</div>
			</div>
		</div>

		<?php do_action( 'shopix_post_item_after' ); ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->