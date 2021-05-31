<?php
/**
 * Class for dynamic CSS output
 *
 * @package Shopix
 */


if ( !class_exists( 'Shopix_Custom_CSS' ) ) :

	/**
	 * Shopix_Custom_CSS 
	 */
	Class Shopix_Custom_CSS {

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
			add_action( 'wp_enqueue_scripts', array( $this, 'output_css' ), 11 );
		}

		/**
		 * Output all custom CSS
		 */
		public function output_css() {
			global $post;

			$css = '';

			/**
			 * General colors
			 */
			$css .= $this->get_background_color_css( 'accent_color', '#DCA56D', '#backtotop,.woocommerce-links .count-number,.woocommerce-cart .product-remove a:hover,.woocommerce .products .button:hover,span.onsale,.author-bio .author-link,.cat-links a,.widget_product_search .woocommerce-product-search::after,.widget_search .search-form::after,.woocommerce-pagination li .page-numbers:hover, .woocommerce-pagination li .page-numbers.current,.navigation.pagination .page-numbers:focus, .navigation.pagination .page-numbers:hover, .navigation.pagination .page-numbers.current,button,.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]:not(.search-submit),.wpforms-form button[type=submit],div.wpforms-container-full .wpforms-form button[type=submit],div.nf-form-content input[type=button]');
			$css .= $this->get_color_css( 'accent_color', '#DCA56D', '.single-product div.product .product_meta > span a:hover,ul.products .loop-product-cats a:hover,.featured-cats-inner a:hover,.featured-posts .featured-post .entry-title a:hover,.widget a:hover,.comments-area .comment-reply-link,.entry-meta a:hover,.read-more-link:hover,.entry-title a:hover,.top-bar a:hover,.site-main .post-navigation h4:hover,.comment-navigation a:hover,.posts-navigation a:hover,.post-navigation a:hover,.top-navigation a:hover,.main-navigation a:hover,.is-style-outline .wp-block-button__link,.wp-block-button__link.is-style-outline');
			$css .= $this->get_border_color_css( 'accent_color', '#DCA56D', '.is-style-outline .wp-block-button__link,.wp-block-button__link.is-style-outline,button,.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"],.wpforms-form button[type=submit],div.wpforms-container-full .wpforms-form button[type=submit],div.nf-form-content input[type=button]');
			$css .= $this->get_fill_color_css( 'accent_color', '#DCA56D', '.header-contact .er-icon svg,.header-items > a:hover .er-icon');

			$css .= $this->get_color_css( 'body_color', '#404040', 'body');
			$css .= $this->get_color_css( 'content_link_color', '#4169e1', 'a');
			$css .= $this->get_color_css( 'content_link_color_hover', '#191970', 'a:hover');
			$css .= $this->get_color_css( 'headings_color', '#000', 'h1,h2,h3,h4,h5,h6');

			//Top bar
			$css .= $this->get_background_color_css( 'top_bar_background_color', '', '.top-bar');
			$css .= $this->get_fill_color_css( 'top_bar_color', '', '.header-items>a .er-icon');
			$css .= $this->get_color_css( 'top_bar_color', '', '.top-bar, .top-bar a');

			//Main header
			$css .= $this->get_background_color_css( 'bottom_header_background_color', '', '.header-bottom');
			$css .= $this->get_background_color_css( 'middle_header_background_color', '', '.header-middle');
			$css .= $this->get_color_css( 'middle_header_color', '', '.header-middle, .site-title a, .header-middle .header-contact a, .header-middle .main-navigation div > ul > li > a, .header-contact .contact-info.heading');
			$css .= $this->get_color_css( 'bottom_header_color', '', '.header-bottom,.header-bottom .main-navigation div > ul > li > a');

			$css .= $this->get_border_color_css( 'bottom_header_border_color', '', '.header-bottom');

			//Footer
			$css .= $this->get_background_color_css( 'footer_widgets_background', '', '.footer-widgets');
			$css .= $this->get_color_css( 'footer_widgets_title_color', '', '.footer-widgets .widget .widget-title');
			$css .= $this->get_color_css( 'footer_widgets_color', '', '.footer-widgets');
			$css .= $this->get_color_css( 'footer_widgets_links_color', '', '.footer-widgets a');
			$css .= $this->get_background_color_css( 'footer_bar_bg_color', '', '.site-info');
			$css .= $this->get_color_css( 'footer_bar_color', '', '.site-info, .site-info a');

			//buttons
			$css .= $this->get_background_color_css( 'global_button_background', '#DCA56D', 'input[type="submit"]:not(.search-submit),button,.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"]:not(.search-submit),.wpforms-form button[type=submit],div.wpforms-container-full .wpforms-form button[type=submit],div.nf-form-content input[type=button]');
			$css .= $this->get_background_color_css( 'global_button_background_hover', '#bd8954', 'input[type="submit"]:not(.search-submit):hover,button:hover,.button:hover,.wp-block-button__link:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:not(.search-submit):hover,.wpforms-form button[type=submit]:hover,div.wpforms-container-full .wpforms-form button[type=submit]:hover,div.nf-form-content input[type=button]:hover');
			$css .= $this->get_color_css( 'global_button_color', '#ffffff', '.button.header-button,input[type="submit"]:not(.search-submit),button,.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"]:not(.search-submit),.wpforms-form button[type=submit],div.wpforms-container-full .wpforms-form button[type=submit],div.nf-form-content input[type=button]');
			$css .= $this->get_color_css( 'global_button_color_hover', '#ffffff', '.button.header-button:hover,input[type="submit"]:not(.search-submit):hover,button:hover,.button:hover,.wp-block-button__link:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:not(.search-submit):hover,.wpforms-form button[type=submit]:hover,div.wpforms-container-full .wpforms-form button[type=submit]:hover,div.nf-form-content input[type=button]:hover');
						
			$global_button_padding_tb 		= get_theme_mod( 'global_button_padding_tb', 13 );	
			$global_button_padding_lr 		= get_theme_mod( 'global_button_padding_lr', 24 );	
			$global_button_border_radius 	= get_theme_mod( 'global_button_border_radius', 0 );	
			$global_button_font_size 		= get_theme_mod( 'global_button_font_size', 16 );	
			
			$css .= '.elementor-button-wrapper .elementor-button,button,.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"],.wpforms-form button[type=submit],div.wpforms-container-full .wpforms-form button[type=submit],div.nf-form-content input[type=button] { font-size:' . intval( $global_button_font_size ) . 'px;border-radius:' . intval( $global_button_border_radius ) . 'px;padding-left:' . intval( $global_button_padding_lr ) . 'px;padding-right:' . intval( $global_button_padding_lr ) . 'px;padding-top:' . intval( $global_button_padding_tb ) . 'px;padding-bottom:' . intval( $global_button_padding_tb ) . 'px;}' . "\n";
		
			/**
			 * Sidebar
			 */
			$sidebar_width = get_theme_mod( 'sidebar_width', 300 );
			$css .= '.widget-area { width:' . intval( $sidebar_width ) . 'px;}' . "\n";
			$css .= '.site-main.has-sidebar { width:calc(100% - ' . intval( $sidebar_width ) . 'px);}' . "\n";

			/**
			 * Fonts
			 */		
			$defaults_headings = $defaults_body	= json_encode(
				array(
					'font' 			=> 'System default',
					'regularweight' => 'regular',
					'italicweight' 	=> 'italic',
					'boldweight' 	=> 'bold',
					'category' 		=> 'sans-serif'
				)
			);
		
			$body_font		= get_theme_mod( 'shopix_body_font', $defaults_body );
			$headings_font 	= get_theme_mod( 'shopix_headings_font', $defaults_headings );
		
			$body_font 		= json_decode( $body_font, true );
			$headings_font 	= json_decode( $headings_font, true );
			
			$css .= 'body, button, input, optgroup, select, textarea { font-family:' . esc_attr( $body_font['font'] ) . ',' . esc_attr( $body_font['category'] ) . ';}' . "\n";	
			$css .= 'body, button, input, optgroup, select, textarea { font-weight:' . esc_attr( $body_font['regularweight'] ) . ';}' . "\n";	

			$css .= $this->get_resp_font_sizes_css( 'body_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'body' );

			$body_line_height = get_theme_mod( 'body_line_height', 1.76 );
			$css .= 'body { line-height:' . esc_attr( $body_line_height ) . ';}' . "\n";

			$body_letter_spacing = get_theme_mod( 'body_letter_spacing', 0 );
			$css .= 'body { letter-spacing:' . esc_attr( $body_letter_spacing ) . 'px;}' . "\n";			

			$css .= 'h1,h2,h3,h4,h5,h6,.site-title { font-family:' . esc_attr( $headings_font['font'] ) . ',' . esc_attr( $headings_font['category'] ) . ';}' . "\n";	
			$css .= 'h1,h2,h3,h4,h5,h6,.site-title { font-weight:' . esc_attr( $headings_font['boldweight'] ) . ';}' . "\n";	

			$headings_line_height = get_theme_mod( 'headings_line_height', 1.2 );
			$css .= 'h1,h2,h3,h4,h5,h6,.site-title { line-height:' . esc_attr( $headings_line_height ) . ';}' . "\n";			

			$headings_letter_spacing = get_theme_mod( 'headings_letter_spacing', 0 );
			$css .= 'h1,h2,h3,h4,h5,h6,.site-title { letter-spacing:' . esc_attr( $headings_letter_spacing ) . 'px;}' . "\n";

			//Headings
			$css .= $this->get_resp_font_sizes_css( 'h1_heading_font_size', $defaults = array( 'desktop' => 40, 'tablet' => 36, 'mobile' => 28 ), 'h1' );
			$css .= $this->get_resp_font_sizes_css( 'h2_heading_font_size', $defaults = array( 'desktop' => 32, 'tablet' => 28, 'mobile' => 22 ), 'h2' );
			$css .= $this->get_resp_font_sizes_css( 'h3_heading_font_size', $defaults = array( 'desktop' => 28, 'tablet' => 24, 'mobile' => 18 ), 'h3' );
			$css .= $this->get_resp_font_sizes_css( 'h4_heading_font_size', $defaults = array( 'desktop' => 24, 'tablet' => 20, 'mobile' => 16 ), 'h4' );
			$css .= $this->get_resp_font_sizes_css( 'h5_heading_font_size', $defaults = array( 'desktop' => 20, 'tablet' => 16, 'mobile' => 16 ), 'h5' );
			$css .= $this->get_resp_font_sizes_css( 'h6_heading_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'h6' );

			$headings_line_height = get_theme_mod( 'headings_line_height', 1.2 );
			$css .= 'h1,h2,h3,h4,h5,h6,.site-title { line-height:' . esc_attr( $headings_line_height ) . ';}' . "\n";			

			$h1_letter_spacing = get_theme_mod( 'h1_letter_spacing' );
			$css .= 'h1 { letter-spacing:' . esc_attr( $h1_letter_spacing ) . 'px;}' . "\n";
	
			$h1_heading_line_height = get_theme_mod( 'h1_heading_line_height' );
			$css .= 'h1 { line-height:' . esc_attr( $h1_heading_line_height ) . ';}' . "\n";			
			
			$h2_letter_spacing = get_theme_mod( 'h2_letter_spacing' );
			$css .= 'h2 { letter-spacing:' . esc_attr( $h2_letter_spacing ) . 'px;}' . "\n";
	
			$h2_heading_line_height = get_theme_mod( 'h2_heading_line_height' );
			$css .= 'h2 { line-height:' . esc_attr( $h2_heading_line_height ) . ';}' . "\n";
			
			$h3_letter_spacing = get_theme_mod( 'h3_letter_spacing' );
			$css .= 'h3 { letter-spacing:' . esc_attr( $h3_letter_spacing ) . 'px;}' . "\n";
	
			$h3_heading_line_height = get_theme_mod( 'h3_heading_line_height' );
			$css .= 'h3 { line-height:' . esc_attr( $h3_heading_line_height ) . ';}' . "\n";
			
			$h4_letter_spacing = get_theme_mod( 'h4_letter_spacing' );
			$css .= 'h4 { letter-spacing:' . esc_attr( $h4_letter_spacing ) . 'px;}' . "\n";
	
			$h4_heading_line_height = get_theme_mod( 'h4_heading_line_height' );
			$css .= 'h4 { line-height:' . esc_attr( $h4_heading_line_height ) . ';}' . "\n";	
			
			$h5_letter_spacing = get_theme_mod( 'h5_letter_spacing' );
			$css .= 'h5 { letter-spacing:' . esc_attr( $h5_letter_spacing ) . 'px;}' . "\n";
	
			$h5_heading_line_height = get_theme_mod( 'h5_heading_line_height' );
			$css .= 'h5 { line-height:' . esc_attr( $h5_heading_line_height ) . ';}' . "\n";	
			
			$h6_letter_spacing = get_theme_mod( 'h6_letter_spacing' );
			$css .= 'h6 { letter-spacing:' . esc_attr( $h6_letter_spacing ) . 'px;}' . "\n";
	
			$h6_heading_line_height = get_theme_mod( 'h6_heading_line_height' );
			$css .= 'h6 { line-height:' . esc_attr( $h6_heading_line_height ) . ';}' . "\n";			

			//logo size
			$logo_size_desktop 	= get_theme_mod( 'logo_size_desktop', 150 );
			$logo_size_tablet 	= get_theme_mod( 'logo_size_tablet', 120 );
			$logo_size_mobile	= get_theme_mod( 'logo_size_mobile', 100 );

			$css .= '.custom-logo { max-width:' . intval( $logo_size_desktop ) . 'px;}' . "\n";	
			$css .= '@media ( max-width: '. $this->get_tablet_breakpoint() . 'px) { .custom-logo { max-width:' . intval( $logo_size_tablet ) . 'px;} }' . "\n";	
			$css .= '@media ( max-width: '. $this->get_mobile_breakpoint() . 'px) { .custom-logo { max-width:' . intval( $logo_size_mobile ) . 'px;} }' . "\n";	

			/**
			 * Blog
			 */
			$css .= $this->get_resp_font_sizes_css( 'archive_titles_size', $defaults = array( 'desktop' => 22, 'tablet' => 22, 'mobile' => 22 ), '.posts-loop .entry-title' );

			$single_post_header_alignment = get_theme_mod( 'single_post_header_alignment', 'left' );
			$css .= '.single-post .entry-header, .post-cats { text-align:' . esc_attr( $single_post_header_alignment ) . ';}' . "\n";

			$css = apply_filters( 'shopix_custom_css_output', $css );

			wp_add_inline_style( 'shopix-style-min', $css );	
		}

		/**
		 * Tablet breakpoint
		 */
		public static function get_tablet_breakpoint() {
			$breakpoint = '991';
			return apply_filters( 'shopix_tablet_breakpoint', $breakpoint );
		}

		/**
		 * Mobile breakpoint
		 */
		public static function get_mobile_breakpoint() {
			$breakpoint = '575';
			return apply_filters( 'shopix_mobile_breakpoint', $breakpoint );
		}	
		
		/**
		 * Get color CSS
		 */
		public static function get_color_css( $setting, $default, $selector ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ color:' . esc_attr( $mod ) . ';}' . "\n";
		}

		/**
		 * Get responsive font sizes
		 */
		public static function get_resp_font_sizes_css( $setting, $defaults = array(), $selector ) {
			$devices 	= array( 
				'desktop' 	=> '@media (min-width:  ' . ( self::get_tablet_breakpoint() + 1 ) . 'px)',
				'tablet'	=> '@media (min-width:  ' . ( self::get_mobile_breakpoint() + 1 ) . 'px) and (max-width:  '. self::get_tablet_breakpoint() . 'px)',
				'mobile'	=> '@media (max-width:  ' . self::get_mobile_breakpoint() . 'px)'
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { font-size:' . intval( $mod ) . 'px;} }' . "\n";	
			}

			return $css;
		}		

		/**
		 * Get background color CSS
		 */
		public static function get_background_color_css( $setting, $default, $selector ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ background-color:' . esc_attr( $mod ) . ';}' . "\n";
		}

		/**
		 * Get border color CSS
		 */
		public static function get_border_color_css( $setting, $default, $selector ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ border-color:' . esc_attr( $mod ) . ';}' . "\n";
		}	
		
		/**
		 * Get fill color CSS
		 */
		public static function get_fill_color_css( $setting, $default, $selector ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ fill:' . esc_attr( $mod ) . ';}' . "\n";
		}		
	}

	/**
	 * Initialize class
	 */
	Shopix_Custom_CSS::get_instance();

endif;