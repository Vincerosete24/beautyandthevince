<?php
/**
 * Class to handle the theme footer and footer widgets
 *
 * @package Izo
 */


if ( !class_exists( 'Shopix_Footer' ) ) :

	/**
	 * Shopix_Footer 
	 */
	Class Shopix_Footer {

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
			add_action( 'shopix_footer', array( $this, 'footer_markup' ) );
			add_action( 'shopix_footer', array( $this, 'mobile_overlay' ) );
			add_action( 'shopix_footer_before', array( $this, 'sidebar_cart' ) );
			add_action( 'shopix_footer_widgets', array( $this, 'get_footer_widgets' ) );
			add_action( 'widgets_init', array( $this, 'register_footer_areas' ) );
			add_action( 'shopix_footer_before', array( $this, 'subscribe_section' ) );
		}

		/**
		 * Markup for the footer
		 */
		public static function footer_markup() {		

			if ( apply_filters( 'shopix_disable_footer', false ) ) {
				return;
			}

			global $post;

			if ( isset( $post ) ) {
				$disable_footer	= get_post_meta( $post->ID, '_shopix_hide_footer', true );	
				if ( $disable_footer ) {
					return;
				}
			}	
			
			if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) {
				return;
			}				
			
			?>
			<footer id="colophon" class="site-footer">

				<?php do_action( 'shopix_footer_widgets' ); ?>

				<div class="site-info">
					<div class="container">
						<?php $credits = get_theme_mod( 'footer_credits' ); ?>
						<?php if ( '' == $credits ) : ?>
							<?php printf( esc_html__( 'Proudly powered by the %1$s', 'shopix' ), '<a rel="nofollow" href="https://elfwp.com/themes/shopix/">Shopix WordPress theme</a>' ); ?>
						<?php else : ?>
							<?php echo wp_kses_post( $credits ); ?>
						<?php endif; ?>
					</div>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
			<?php
		}

		public function get_footer_widgets() {
			get_sidebar( 'footer' );
		}

		/**
		 * Register footer widget areas
		 */
		public function register_footer_areas() {
			
			$footer_widgets_layout = get_theme_mod( 'footer_widgets_layout', 'columns3' );

			switch ( $footer_widgets_layout ) {
				case 'columns3':
					$widget_areas = 3;
					break;
									
				case 'columns1':
					$widget_areas = 1;
					break;

				case 'columns2':
					$widget_areas = 2;
					break;

				case 'columns4':
					$widget_areas = 4;
					break;	

				default:
					return;
			}

			for ( $i = 1; $i <= $widget_areas; $i++ ) {
				register_sidebar(
					array(
						'name'          => /* translators: %s: footer area number */ sprintf( esc_html__( 'Footer area %s', 'shopix' ), $i ),
						'id'            => 'footer-' . $i,
						'description'   => esc_html__( 'Add widgets here.', 'shopix' ),
						'before_widget' => '<section id="%1$s" class="widget %2$s">',
						'after_widget'  => '</section>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				);	
			}		
		}

		/**
		 * Sidebar cart
		 */
		public function sidebar_cart() {
			if ( class_exists( 'Woocommerce' ) ) : ?>
				<div id="sidebar-cart" class="sidebar-cart">
					<div tabindex="0" class="sidebar-cart-close"><?php shopix_get_svg_icon( 'icon-cancel', true ); ?></div>
					<span>
						<?php
						$instance = array(
							'title' => esc_html__( 'Your cart', 'shopix' ),
						);
			
						the_widget( 'WC_Widget_Cart', $instance );
						?>
					</span>
				</div>	
				<div class="cart-overlay"></div>
			<?php endif;	
		}

		/**
		 * Mobile menu overlay
		 */
		public function mobile_overlay() {
			echo '<div class="mobile-menu-overlay"></div>';
		}

		function subscribe_section() {

			$shortcode 	= get_theme_mod( 'subscribe_shortcode' );
			$text		= get_theme_mod( 'subscribe_text', sprintf( '<h3>%1s</h3><p>%2s</p>', esc_html__( 'Subscribe to our newsletter', 'shopix' ), esc_html__( 'Get the news in your inbox.', 'shopix' ) ) );
	
			if ( '' == $shortcode ) {
				return;
			}
			?>
			
			<div class="subscribe-section">
				<div class="inner-subscribe-section">
					<div class="container">
						<div class="row v-align">
							<div class="col-md-6">
								<?php echo wp_kses_post( $text ); ?>
							</div>
							<div class="col-md-6">
								<?php echo do_shortcode( wp_kses_post( $shortcode ) ); ?>
							</div>						
						</div>
					</div>
				</div>
			</div>
	
			<?php
		}		

	}

	/**
	 * Initialize class
	 */
	Shopix_Footer::get_instance();

endif;