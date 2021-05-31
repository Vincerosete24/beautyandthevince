<?php
/**
 * The template for the header
 *
 * @package Shopix
 */
?>

<?php $shopix_header = new Shopix_Header(); ?>

<span id="header-anchor"></span>
<header id="masthead" class="site-header desktop-header">
	<div class="header-middle">
		<div class="container-fluid">
			<div class="row v-align">
				<div class="col-md-3 col-8">
					<div class="site-branding">
						<?php
						the_custom_logo();
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
						else :
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
						$shopix_description = get_bloginfo( 'description', 'display' );
						if ( $shopix_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $shopix_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->
				</div>

				<div class="col-md-5 col-2">
					<?php $shopix_header->main_navigation( $shopix_has_button = false ); ?>
				</div>		

				<div class="col-md-4 col-2">		
					<div class="align-right">	
						<?php $shopix_header->header_contact(); ?>
						<?php $shopix_header->header_woocommerce(); ?>
					</div>		
				</div>			
			</div>	
		</div>			
	</div>
</header><!-- #masthead -->
<span id="header-anchor"></span>