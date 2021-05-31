<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shopix
 */

get_header();
$layout = shopix_single_post_layout();

?>

	<main id="primary" class="site-main <?php echo esc_attr( $layout ); ?>">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'shopix_before_single_content' );

			get_template_part( 'template-parts/content', 'single' );

			do_action( 'shopix_after_single_content' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
if ( 'has-sidebar' === $layout ) {
	do_action( 'shopix_sidebar' );
}
get_footer();
