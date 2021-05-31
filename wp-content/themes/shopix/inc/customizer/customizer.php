<?php
/**
 * Shopix Theme Customizer
 *
 * @package Shopix
 */

if ( !class_exists( 'Shopix_Customizer' ) ) {
	class Shopix_Customizer {

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
			add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'scripts' ) );
		}

		/**
		 * Options
		 */		
		function customize_register( $wp_customize ) {

			$wp_customize->register_control_type( '\Kirki\Control\sortable' );

			// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require get_template_directory() . '/inc/customizer/custom-controls/repeater/class_shopix_repeater.php';
			require get_template_directory() . '/inc/customizer/custom-controls/class_shopix_toggle.php';
			require get_template_directory() . '/inc/customizer/custom-controls/responsive-number/class_shopix_responsive_number.php';
			require get_template_directory() . '/inc/customizer/custom-controls/class_shopix_info.php';
			require get_template_directory() . '/inc/customizer/custom-controls/class_shopix_title.php';
			require get_template_directory() . '/inc/customizer/custom-controls/class_shopix_tabs.php';
			require get_template_directory() . '/inc/customizer/custom-controls/select2/class_shopix_select2.php';
			require get_template_directory() . '/inc/customizer/custom-controls/typography/class_shopix_typography.php';
			require get_template_directory() . '/inc/customizer/custom-controls/slider/class_shopix_slider.php';
			require get_template_directory() . '/inc/customizer/custom-controls/class_shopix_radio_images.php';

			// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_section( 'title_tagline' )->panel 		= 'shopix_header_panel';
			$wp_customize->get_section( 'title_tagline' )->priority 	= 1;
			$wp_customize->get_section( 'background_image' )->panel 	= 'shopix_general_panel';
			$wp_customize->get_section( 'header_image' )->panel 		= 'shopix_header_panel';
			$wp_customize->get_section( 'colors' )->panel 				= 'shopix_general_panel';
			if ( class_exists( 'WooCommerce') ) {
				$wp_customize->get_panel( 'woocommerce' )->priority 	= 31;
			}

			$wp_customize->remove_control( 'header_textcolor' );

			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'blogname',
					array(
						'selector'        => '.site-title a',
						'render_callback' => 'shopix_customize_partial_blogname',
					)
				);
				$wp_customize->selective_refresh->add_partial(
					'blogdescription',
					array(
						'selector'        => '.site-description',
						'render_callback' => 'shopix_customize_partial_blogdescription',
					)
				);
			}

			// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			//Sanitize functions
			require get_template_directory() . '/inc/customizer/sanitize.php';

			//General options
			require get_template_directory() . '/inc/customizer/general.php';			

			//Blog options
			require get_template_directory() . '/inc/customizer/blog.php';

			//Header options
			require get_template_directory() . '/inc/customizer/header.php';

			//Sidebar options
			require get_template_directory() . '/inc/customizer/sidebar.php';	

			//Footer options
			require get_template_directory() . '/inc/customizer/footer.php';
			
			//Shop options
			if ( class_exists( 'WooCommerce' ) ) {
				require get_template_directory() . '/inc/customizer/shop.php';
			}

			//Page options
			//require get_template_directory() . '/inc/customizer/pages.php';				

			//Typography options
			require get_template_directory() . '/inc/customizer/typography.php';
			// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound			
		}

		public function customize_preview_js() {
			wp_enqueue_script( 'shopix-customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'jquery', 'customize-preview' ), SHOPIX_VERSION, true );
		}		

		function scripts() {
			wp_enqueue_script( 'shopix-customizer-scripts', get_template_directory_uri() . '/assets/js/customizer-scripts.js', array( 'jquery', 'jquery-ui-core' ), '20201211', true );

			wp_enqueue_style( 'shopix-customizer-styles', get_template_directory_uri() . '/assets/css/customizer.min.css' );
		}
		
	}
}

//Initiate
Shopix_Customizer::get_instance();

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function shopix_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function shopix_customize_partial_blogdescription() {
	bloginfo( 'description' );
}