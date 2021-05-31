<?php
/**
 * The template for the header
 *
 * @package Shopix
 */
?>

<?php $shopix_header = new Shopix_Header(); ?>

<header id="masthead" class="site-header desktop-header">
	<div class="header-middle">
		<div class="container-fluid">
			<div class="row v-align">
				<div class="col-md-4 col-12 d-md-none d-lg-block">
					<?php $shopix_header->header_search(); ?>
				</div>
				<div class="col-md-4 col-7">
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
				<div class="col-md-4 col-5">		
					<div class="align-right">		
						<?php $shopix_header->header_contact(); ?>
						<?php $shopix_header->header_woocommerce(); ?>
					</div>		
				</div>			
			</div>	
		</div>			
	</div>
</header><!-- #masthead -->
<div id="header-bottom" class="header-bottom">
	<div class="container-fluid">
		<?php $shopix_header->main_navigation( $shopix_has_button = false ); ?>
	</div>		
</div>	
<span id="header-anchor"></span>