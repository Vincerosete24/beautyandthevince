<?php
/**
 * Class to handle the header elements
 *
 * @package Shopix
 */


if ( !class_exists( 'Shopix_Header' ) ) :

	/**
	 * Shopix_Header 
	 */
	Class Shopix_Header {

		/**
		 * Instance
		 */		
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'shopix_header', array( $this, 'header_markup' ) );
		}

		/**
		 * Markup for the header bars
		 */
		public function header_markup() {

			if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'header' ) ) {
				return;
			}
			
			$enable_top_bar 	= get_theme_mod( 'enable_top_bar', 0 );
			$mobile_menu_layout	= get_theme_mod( 'mobile_menu_layout', 'menu-layout-default' );

			global $post;

			if ( isset( $post ) ) {
				$disable_header	= get_post_meta( $post->ID, '_shopix_hide_header', true );	
				if ( $disable_header ) {
					return;
				}
			}
			?>

			<?php 
			if ( $enable_top_bar ) {
				$this->top_bar();
			}
			?>

			<?php
			//Main header layout
			$header_layout		= get_theme_mod( 'main_header_layout', 'default' );
			get_template_part( 'template-parts/headers/layout-header', $header_layout );
			get_template_part( 'template-parts/headers/layout-header', 'mobile' );
			?>

			<?php
		}

		/**
		 * Top bar
		 */
		public function top_bar() {

			$layout = get_theme_mod( 'top_bar_layout', 'default' );
			?>
				<div class="top-bar">
					<div class="container-fluid">
						<div class="row v-align">

							<?php if ( 'default' === $layout ) : ?>
							<div class="col-lg-5">
								<?php $this->top_navigation(); ?>
							</div>		
							<div class="col-lg-7 col-md-12 col-12 align-center-mobile align-right">
								<?php $this->header_text(); ?>
								<?php $this->header_social(); ?>
							</div>	
							<?php elseif ( 'text-social' === $layout ) : ?>
							<div class="col-md-6 align-left">
								<?php $this->header_text(); ?>
							</div>		
							<div class="col-md-6 align-right">
								<?php $this->header_social(); ?>
							</div>
							<?php else : ?>
							<div class="col-md-12 align-center">
								<?php $this->header_text(); ?>
							</div>							
							<?php endif; ?>	
						</div>	
					</div>
				</div>
			<?php
		}
		
		/**
		 * Header text
		 */
		public function header_text() {
			$text = get_theme_mod( 'top_header_text', esc_html__( 'Your custom text here', 'shopix' ) );

			if ( '' === $text ) {
				return;
			}

			echo '<div class="header-text">' . wp_kses_post( $text ) . '</div>';
		}

		/**
		 * Main navigation
		 */	
		public function main_navigation( $shopix_has_button = true ) {
			$mobile_label 	= get_theme_mod( 'mobile_menu_label' );
			?>

			<?php if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'primary-menu' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary-menu') ); ?>
			<?php else: ?>	
				<button class="menu-toggle" aria-controls="primary-menu" aria-label="<?php echo esc_attr__( 'Toggle mobile menu', 'shopix' ); ?>" aria-expanded="false" <?php echo wp_kses_post( apply_filters( 'shopix_nav_toggle_data_attrs', '' ) ); ?>><?php shopix_get_svg_icon( 'icon-bars', true ); ?><span class="menu-label"><?php echo esc_html( $mobile_label ); ?></span></button>	
				<nav id="site-navigation" class="main-navigation" <?php echo wp_kses_post( apply_filters( 'shopix_nav_data_attrs', '' ) ); ?>>
					<div class="row v-align">
						<div class="mobile-menu-close" tabindex="0"><?php shopix_get_svg_icon( 'icon-cancel', true ); ?></div>
						<?php if ( $shopix_has_button ) : ?>
						<div class="col-md-9">
						<?php else : ?>
						<div class="col-md-12">
						<?php endif; ?>	
							<?php
							wp_nav_menu( array(
								'theme_location' 	=> 'primary-menu',
								'menu_id'        	=> 'primary-menu',
							) );
							?>					
						</div>
						<?php if ( $shopix_has_button ) : ?>
						<div class="col-md-3 align-right">
							<?php $this->header_button(); ?>
						</div>
						<?php endif; ?>						
					</div>
				</nav><!-- #site-navigation -->
			<?php endif; ?>
			<?php 
		}

		/**
		 * Top navigation
		 */	
		public function top_navigation() {
			?>
			<?php if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'top-menu' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'top-menu') ); ?>
			<?php else: ?>				
			<nav id="top-navigation" class="top-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location'=> 'top-menu',
					'menu_id'       => 'top-menu',
					'fallback_cb'	=> false,
					'depth'			=> 1
				) );
				?>
			</nav><!-- #top-navigation -->
			<?php endif; ?>
			<?php 
		}

		/**
		 * Header button
		 */
		public function header_button() {

			$enable = get_theme_mod( 'enable_header_button', 1 );

			if ( !$enable ) {
				return;
			}

			$text 	= get_theme_mod( 'header_button_text', esc_html__( 'Click here', 'shopix' ) );
			$url 	= get_theme_mod( 'header_button_url', '#' );

			echo '<a class="button header-button" href="' . esc_url( $url ) . '">' . esc_html( $text ) . '</a>';
		}

		/**
		 * WooCommerce icons
		 */		
		public function header_woocommerce() {

			if ( !class_exists( 'WooCommerce' ) ) {
				return;
			}

			$enable = get_theme_mod( 'enable_header_woocommerce', 1 );

			if ( !$enable ) {
				return;
			}			
	
			?>
			<div class="woocommerce-links">
				<?php echo shopix_woocommerce_header_cart(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>	
			<?php
		}

		/**
		 * Header social
		 */
		public function header_social() {
		
			$socials = get_theme_mod( 'header_social_profiles' );

			if ( !$socials ) {
				return;
			}

			$socials = explode( ',', $socials );
	
			$items = '<div class="header-items">';
			foreach ( $socials as $social ) {
				$network = shopix_get_social_network( $social );
				if ( $network ) {
					$items .= '<a target="_blank" rel="noopener noreferrer nofollow" href="' . esc_url( $social ) . '">' . shopix_get_svg_icon( 'icon-' . esc_html( $network ), false ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			$items .= '</div>';

			echo $items;
		}

		/**
		 * Header search
		 */
		public function header_search() {

			$enable = get_theme_mod( 'enable_header_search', 1 );

			if ( !$enable ) {
				return;
			}

			if ( class_exists( 'Woocommerce' ) ) {
				if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) {
					echo do_shortcode('[wcas-search-form]');
				} else {
					get_product_search_form();
				}
			} else {
				get_search_form();
			}
		}	

		/**
		 * Header search mobile
		 */
		public function header_search_mobile() {
			$enable = get_theme_mod( 'enable_header_search', 1 );

			if ( !$enable ) {
				return;
			}

			if ( class_exists( 'Woocommerce' ) ) {
				if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) {
					echo do_shortcode('[wcas-search-form]');
				} else {
					echo '<a href="#" class="mobile-search-toggle">' . shopix_get_svg_icon( 'icon-search', false ) . '</a>';
					echo '<div class="search-overlay-wrapper">';
					echo '<div class="search-overlay"><a href="#" class="search-cancel">' . shopix_get_svg_icon( 'icon-cancel', false ) . '</a></div>';
					get_product_search_form();
					echo '</div>';
				}
			} else {
				echo '<span class="mobile-search-toggle">' . shopix_get_svg_icon( 'icon-search', false ) . '</span>';
				echo '<div class="search-overlay-wrapper">';
				echo '<div class="search-overlay"></div>';
				get_search_form();
				echo '</div>';
			}			
		}

		/**
		 * Header contact
		 */
		public function header_contact() {

			$enable = get_theme_mod( 'enable_header_contact', 0 );

			if ( !$enable ) {
				return;
			}

			$text 	= get_theme_mod( 'header_contact_text', esc_html__( 'Call us', 'shopix' ) );
			$number = get_theme_mod( 'header_contact_number', esc_html__( '+111.222.333', 'shopix' ) );
			?>

			<div class="header-contact d-md-none d-lg-inline-block">
				<div class="row">
					<div class="col-md-4">
						<?php echo shopix_get_svg_icon( 'icon-headphones-alt', false ); ?>
					</div>
					<div class="col-md-8">
						<a href="tel:<?php echo esc_attr( $number ); ?>"><span class="contact-info heading"><?php echo esc_html( $text ); ?></span><span class="contact-info"><?php echo esc_html( $number ); ?></span></a>
					</div>
				</div>
			</div>

			<?php
		}

	}

	/**
	 * Initialize class
	 */
	Shopix_Header::get_instance();

endif;