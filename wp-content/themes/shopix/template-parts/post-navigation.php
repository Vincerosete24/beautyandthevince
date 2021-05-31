<?php
/**
 * Template part for single post navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Shopix
 */

?>

<?php
	//Get previous and next posts and their respective thumbnails
	$shopix_previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$shopix_next     = get_adjacent_post( false, '', false );

	if ( ! $shopix_next && ! $shopix_previous ) {
		return;
	}

	$shopix_prev_post = get_previous_post();
	if ( $shopix_prev_post ) {
		$shopix_prev_thumbnail = get_the_post_thumbnail( $shopix_prev_post->ID, 'thumbnail' );
	} else {
		$shopix_prev_thumbnail = '';
	}
	$shopix_next_post = get_next_post();
	if ( $shopix_next_post ) {
		$shopix_next_thumbnail = get_the_post_thumbnail( $shopix_next_post->ID, 'thumbnail' );
	} else {
		$shopix_next_thumbnail ='';
	}
	if ( $shopix_prev_thumbnail ) {
		$shopix_has_prev_thumb = 'has-thumb';
	} else {
		$shopix_has_prev_thumb = '';
	}
	if ( $shopix_next_thumbnail ) {
		$shopix_has_next_thmb = 'has-thumb';
	} else {
		$shopix_has_next_thmb = '';
	}
?>

<nav class="navigation post-navigation" role="navigation">
	<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'shopix' ); ?></h2>
	<div class="nav-links">
		<?php	
			if ( get_previous_post() ) {
				echo '<div class="nav-previous ' . $shopix_has_prev_thumb . '">';
					echo '<div class="v-align">';
					if ( $shopix_prev_thumbnail ) {
						echo $shopix_prev_thumbnail;
					}
					previous_post_link( '%link', '<h4>%title</h4>' );
					echo '</div>';
				echo '</div>';
			}
			if ( get_next_post() ) {
				echo '<div class="nav-next ' . $shopix_has_next_thmb . '">';
					echo '<div class="v-align">';
					next_post_link( '%link', '<h4>%title</h4>' );
					if ( $shopix_next_thumbnail ) {
						echo $shopix_next_thumbnail;
					}
					echo '</div>';
				echo '</div>';
			}
		?>
	</div><!-- .nav-links -->
</nav><!-- .navigation -->