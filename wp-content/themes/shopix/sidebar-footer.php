<?php
/**
 * Footer widget areas
 * 
 * @package Izo
 */
?>

<?php
	if ( !is_active_sidebar( 'footer-1' ) ) {
		return;
	}


	$shopix_footer_widgets_layout = get_theme_mod( 'footer_widgets_layout', 'columns3' );

	switch ( $shopix_footer_widgets_layout ) {
		case 'columns1':
			$shopix_widget_areas = array(
				'no'	=> 1,
				'col'	=> 'col-md-12',
			);
			break;

		case 'columns2':
			$shopix_widget_areas = array(
				'no'	=> 2,
				'col'	=> 'col-md-6',
			);			
			break;
			 
		case 'columns3':
			$shopix_widget_areas = array(
				'no'	=> 3,
				'col'	=> 'col-md-4',
			);			
			break;

		case 'columns4':
			$shopix_widget_areas = array(
				'no'	=> 4,
				'col'	=> 'col-md-3',
			);			
			break;	

		default:
			return;
	}	
?>

<div class="footer-widgets <?php echo esc_attr( $shopix_footer_widgets_layout ); ?>">
	<div class="container">
		<div class="row">
		<?php for ( $shopix_counter = 1; $shopix_counter <= $shopix_widget_areas['no']; $shopix_counter++ ) { ?>
			<?php if ( is_active_sidebar( 'footer-' . $shopix_counter ) ) : ?>
			<div class="footer-column <?php echo esc_attr( $shopix_widget_areas['col'] ); ?>">
				<?php dynamic_sidebar( 'footer-' . $shopix_counter); ?>
			</div>
			<?php endif; ?>	
		<?php } ?>
		</div>
	</div>
</div>
