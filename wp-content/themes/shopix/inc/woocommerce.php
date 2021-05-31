<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Shopix
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function shopix_woocommerce_setup() {

	$single_layout = get_theme_mod( 'single_product_layout', 'default' );

	if ( 'default' === $single_layout ) {
		$gallery_size = 170;
	} else {
		$gallery_size = 800;
	}

	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 350,
			'single_image_width'    => 800,
			'gallery_thumbnail_image_width' => $gallery_size,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'shopix_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function shopix_woocommerce_scripts() {
	wp_enqueue_style( 'shopix-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.min.css', array(), SHOPIX_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'shopix-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'shopix_woocommerce_scripts', 9 );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function shopix_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'shopix_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function shopix_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'shopix_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'shopix_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function shopix_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'shopix_woocommerce_wrapper_before' );

if ( ! function_exists( 'shopix_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function shopix_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'shopix_woocommerce_wrapper_after' );

/**
 * Remove sidebar, remove single product elements
 */
function shopix_woocommerce_actions() {

	$enable_catalog_breadcrumbs = get_theme_mod( 'enable_catalog_breadcrumbs', 1 );

	if ( !is_product() ) {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

		if ( $enable_catalog_breadcrumbs ) {
			add_action( 'shopix_woo_breadcrumbs', 'woocommerce_breadcrumb' );
		}
	}

	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals' );
	add_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cart_totals' );

	if ( is_checkout() || is_cart() || is_account_page() ) {
		add_filter( 'shopix_enable_sidebar', '__return_false' );
	}

	//Shop title
	$enable_catalog_title = get_theme_mod( 'enable_catalog_title', 1 );

	if ( !$enable_catalog_title ) {
		add_filter( 'woocommerce_show_page_title', '__return_false' );
	}

	//Results count
	$enable_catalog_results_no = get_theme_mod( 'enable_catalog_results_no', 1 );
	if ( !$enable_catalog_results_no ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	}

	//Sorting
	$enable_catalog_sorting = get_theme_mod( 'enable_catalog_sorting', 1 );
	if ( !$enable_catalog_sorting ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	}

	//Loop product price
	$enable_catalog_price = get_theme_mod( 'enable_catalog_price', 1 );
	if ( !$enable_catalog_price ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
	}

	//Loop product add to cart
	$enable_catalog_add_cart = get_theme_mod( 'enable_catalog_add_cart', 1 );
	if ( !$enable_catalog_add_cart ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
	}	

	//Ratings
	$enable_catalog_ratings = get_theme_mod( 'enable_catalog_ratings', 1 );
	if ( !$enable_catalog_ratings ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	}

	//Product archives sidebar
	$shop_archive_layout = get_theme_mod( 'shop_archive_layout', 'no-sidebar' );

	if ( 'no-sidebar' == $shop_archive_layout ) {
		if ( is_shop() || is_product_category() || is_product_tag()	) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
			add_filter( 'shopix_enable_sidebar', '__return_false' );
		}		
	}

	//Single products remove sidebar
	if ( is_product() ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		add_filter( 'shopix_enable_sidebar', '__return_false' );
	}

	//Loop add to cart position 
	$add_to_cart_position = get_theme_mod( 'loop_add_to_cart_position', 'default' );

	if ( 'default' === $add_to_cart_position ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
	}

	//Check if we need to disable breadcrumbs, related and upsell products, sku, cats
	if ( is_product() ) {
		$disable_single_product_breadcrumbs = get_theme_mod( 'disable_single_product_breadcrumbs' );
		$disable_single_product_related 	= get_theme_mod( 'disable_single_product_related' );
		$disable_single_product_upsells 	= get_theme_mod( 'disable_single_product_upsells' );
		$disable_single_product_meta 		= get_theme_mod( 'disable_single_product_meta' );
		$disable_single_product_rating 		= get_theme_mod( 'disable_single_product_rating' );

		if ( $disable_single_product_breadcrumbs ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb',20 );
		}

		if ( $disable_single_product_related ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}

		if ( $disable_single_product_upsells ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		}
		
		if ( $disable_single_product_meta ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		}
		
		if ( $disable_single_product_rating ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		}		
	}

	$single_layout = get_theme_mod( 'single_product_layout', 'default' );

	if ( 'expanded' === $single_layout ) {
		remove_theme_support( 'wc-product-gallery-slider' );
		remove_theme_support( 'wc-product-gallery-zoom' );
	}	
}
add_action( 'wp', 'shopix_woocommerce_actions' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'shopix_woocommerce_header_cart' ) ) {
			shopix_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'shopix_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function shopix_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		?>

		<span class="cart-count"><?php shopix_get_svg_icon( 'icon-cart', true ); ?><span class="count-number"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span></span>

		<?php
		$fragments['.cart-count'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'shopix_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'shopix_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function shopix_woocommerce_cart_link() {
		$link = '<span tabindex="0" class="cart-contents" title="' . esc_attr__( 'View your shopping cart', 'shopix' ) . '">';
		$link .= '<span class="cart-count">' . shopix_get_svg_icon( 'icon-cart', false ) . '<span class="count-number">' . esc_html( WC()->cart->get_cart_contents_count() ) . '</span></span>';
		$link .= '</span>';

		return $link;
	}
}

if ( ! function_exists( 'shopix_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function shopix_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<?php ob_start(); ?>
		<?php echo '<a class="wc-account-link d-md-none d-lg-inline-block" href="' . esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) . '" title="' . esc_html__( 'Your account', 'shopix' ) . '">' . shopix_get_svg_icon( 'icon-user', false ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<?php if ( defined( 'YITH_WCWL' ) ) : ?>
			<a class="d-md-none d-lg-inline-block" href="<?php echo esc_url( get_permalink( get_option('yith_wcwl_wishlist_page_id') ) ); ?>"><?php shopix_get_svg_icon( 'icon-heart', true ); ?></a>
		<?php elseif ( defined( 'TINVWL_URL' ) && function_exists( 'tinv_url_wishlist_default' ) ) : ?>
			<a class="d-md-none d-lg-inline-block" href="<?php echo esc_url( tinv_url_wishlist_default() ); ?>"><?php shopix_get_svg_icon( 'icon-heart', true ); ?></a>
		<?php endif; ?>

		<div id="site-header-cart" class="site-header-cart">
			<?php echo shopix_woocommerce_cart_link();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
		<?php
		return ob_get_clean();
	}
}

/**
 * Wrap products results and ordering before
 */
function shopix_wrap_products_results_ordering_before() {

	echo '<div class="woocommerce-results-wrapper">';
	echo '<div class="row">';
	echo '<div class="col-md-6">';

}
add_action( 'woocommerce_before_shop_loop', 'shopix_wrap_products_results_ordering_before', 19 );

/**
 * Add a button to toggle filters on shop archives
 */
function shopix_add_filters_button() {
	?>

	</div>
	<div class="col-md-6 align-right">

	<?php
	if ( ! is_active_sidebar( 'shopix-shop-filters' ) ) {
		return;
	}
	?>
	<div class="shop-filters-toggle"><?php shopix_get_svg_icon( 'icon-filter', true ); ?><?php echo esc_html__( 'Filters', 'shopix' ); ?></div>
	<div id="sidebar-filters" class="sidebar-filters">
		<div class="sidebar-cart-close"><?php shopix_get_svg_icon( 'icon-cancel', true ); ?></div>
		<?php dynamic_sidebar( 'shopix-shop-filters' ); ?>
	</div>

	<?php	
}
add_action( 'woocommerce_before_shop_loop', 'shopix_add_filters_button', 22 );

/**
 * Wrap products results and ordering after
 */
function shopix_wrap_products_results_ordering_after() {

	echo '</div>';
	echo '</div>';
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'shopix_wrap_products_results_ordering_after', 31 );

/**
 * Wrap single product gallery and summary before
 */
function shopix_single_product_wrap_before() {
	echo '<div class="single-product-top clear">';
}
add_action( 'woocommerce_before_single_product_summary', 'shopix_single_product_wrap_before', -99 );

/**
 * Wrap single product gallery and summary after
 */
function shopix_single_product_wrap_after() {
	echo '</div>';
}
add_action( 'woocommerce_after_single_product_summary', 'shopix_single_product_wrap_after', 9 );

/**
 * Wrap order review before
 */
function shopix_wrap_order_review_before() {
	echo '<div class="order-review-wrapper">';
}
add_action( 'woocommerce_checkout_before_order_review_heading', 'shopix_wrap_order_review_before', 5 );

/**
 * Wrap order review after
 */
function shopix_wrap_order_review_after() {
	echo '</div">';
}
add_action( 'woocommerce_checkout_after_order_review', 'shopix_wrap_order_review_after', 15 );

/**
 * Disable titles from Woocommerce tabs
 */
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
add_filter( 'woocommerce_product_description_heading', '__return_false' );

/**
 * Woocommerce related custom CSS
 */
function shopix_woocommerce_custom_css( $css ) {

	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'single_product_title_size', $defaults = array( 'desktop' => 40, 'tablet' => 36, 'mobile' => 28 ), '.single-product-top .entry-title' );
	$css .= Shopix_Custom_CSS::get_color_css( 'single_product_title_color', '', '.single-product-top .entry-title' );

	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'single_product_price_size', $defaults = array( 'desktop' => 22, 'tablet' => 22, 'mobile' => 22 ), '.single-product-top .price' );
	$css .= Shopix_Custom_CSS::get_color_css( 'single_product_price_color', '', '.single-product-top .price' );	


	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'loop_product_title_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'ul.products li.product .woocommerce-loop-product__title' );
	$css .= Shopix_Custom_CSS::get_color_css( 'loop_product_title_color', '', 'ul.products li.product .woocommerce-loop-product__title' );	

	$css .= Shopix_Custom_CSS::get_resp_font_sizes_css( 'loop_product_price_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'ul.products li.product .price' );
	$css .= Shopix_Custom_CSS::get_color_css( 'loop_product_price_color', '', 'ul.products li.product .price' );	

	$css .= Shopix_Custom_CSS::get_color_css( 'loop_add_to_cart_color', '', '.woocommerce .products .button' );	
	$css .= Shopix_Custom_CSS::get_background_color_css( 'loop_add_to_cart_bg_color', '', '.woocommerce .products .button' );	

	$css .= Shopix_Custom_CSS::get_color_css( 'loop_add_to_cart_color_hover', '', '.woocommerce .products .button:hover' );	
	$css .= Shopix_Custom_CSS::get_background_color_css( 'loop_add_to_cart_bg_color_hover', '', '.woocommerce .products .button:hover' );		
	
	$css .= Shopix_Custom_CSS::get_color_css( 'loop_ratings_color', '', '.star-rating span::before' );	

	//Bordered products
	$product_style = get_theme_mod( 'loop_product_style', 'default' );
	if ( 'bordered' === $product_style ) {
		$css .= 'ul.products li.product { border: 1px solid #ebebeb; padding-bottom:20px;}' . "\n";	
	} elseif ( 'nogap' === $product_style ) {
		$css .= 'ul.products li.product { border-right: 1px solid #ebebeb;border-bottom:1px solid #ebebeb;padding:30px;margin: 0;}' . "\n";	
		$css .= 'ul.products.columns-4 li.product { padding:15px; }' . "\n";	
		$css .= 'ul.products li.product.first { border-left: 1px solid #ebebeb;}' . "\n";	
		
		$css .= 'ul.products {display: flex; flex-wrap:wrap; }' . "\n";	
		$css .= 'ul.products.columns-3 li.product:first-of-type, ul.products.columns-3 li.product:nth-of-type(2)  { border-top: 1px solid #ebebeb }' . "\n";
		$css .= 'ul.products.columns-4 li.product:first-of-type, ul.products.columns-4 li.product:nth-of-type(2)  { border-top: 1px solid #ebebeb }' . "\n";
		$css .= 'ul.products.columns-2 li.product:first-of-type, ul.products.columns-2 li.product:nth-of-type(2)  { border-top: 1px solid #ebebeb }' . "\n";
		$css .= '@media screen and (min-width: 768px) {  ul.products.columns-2 li.product { width: 50%; } ul.products.columns-4 li.product { width: 25%; } ul.products.columns-3 li.product { width: 33.33333333%; } ul.products.columns-3 li.product:nth-of-type(3), ul.products.columns-4 li.product:nth-of-type(3), ul.products.columns-4 li.product:nth-of-type(4) {border-top: 1px solid #ebebeb; } }' . "\n";
		$css .= '@media screen and (max-width: 767px) {  ul.products li.product {padding:15px;} ul.products li.product {width:50%;} ul.products li.product:nth-of-type(2n+1) {border-left: 1px solid #ebebeb !important; } ul.products li.product.first { border-left: 0; } }' . "\n";

	}

	$loop_product_image = get_theme_mod( 'loop_product_image', 'swap' );

	if ( 'zoom' === $loop_product_image ) {
		$css .= 'ul.products li.product:hover img {-webkit-transform: scale(1.1);-ms-transform: scale(1.1);transform: scale(1.1); }' . "\n";	
	} elseif ( 'zoomr' === $loop_product_image ) {
		$css .= 'ul.products li.product:hover img {-webkit-transform: rotatez(5deg) scale(1.1);-ms-transform: rotatez(5deg) scale(1.1);transform: rotatez(5deg) scale(1.1); }' . "\n";	
	}

	$shopix_df_checkout = get_theme_mod( 'shopix_df_checkout', 1 );

	if ( is_checkout() && $shopix_df_checkout ) {
		$css .= '.woocommerce-checkout.header-centered .site-header .col-5,.woocommerce-checkout.header-centered .site-header .col-12,.woocommerce-checkout.header-inline .site-header .col-md-5, .woocommerce-checkout.header-inline .site-header .col-md-4, .woocommerce-checkout .top-bar, .woocommerce-checkout .header-bottom, .woocommerce-checkout .subscribe-section, .woocommerce-checkout .footer-widgets, .woocommerce-checkout .site-header .col-lg-4, .woocommerce-checkout .site-header .col-lg-5 { display: none !important; }' . "\n";			
		$css .= '.woocommerce-checkout.header-centered .site-header .col-7, .woocommerce-checkout.header-inline .site-header .col-md-3, .woocommerce-checkout .site-header .col-lg-3 { -webkit-box-flex: 0;-ms-flex: 0 0 100%;flex: 0 0 100%; max-width: 100%; text-align: center; }' . "\n";			

	}

	return $css;
}
add_filter( 'shopix_custom_css_output', 'shopix_woocommerce_custom_css' );

/**
 * Loop product thumbnails wrapper before
 */
function shopix_loop_thumb_wrapper_before() {
	echo '<div class="loop-thumb-wrapper">';
	echo '<div class="product-placeholder"></div>';
	woocommerce_template_loop_product_link_open(); //open product link
}
add_action( 'woocommerce_before_shop_loop_item', 'shopix_loop_thumb_wrapper_before', 11 );

/**
 * Loop product thumbnails wrapper after
 */
function shopix_loop_thumb_wrapper_after() {

	woocommerce_template_loop_product_link_close(); //close product link

	$add_to_cart_position = get_theme_mod( 'loop_add_to_cart_position', 'default' );

	if ( 'default' === $add_to_cart_position ) {
		echo '<div class="button-wrapper">';
			woocommerce_template_loop_add_to_cart();
		echo '</div>';
	}

	echo '</div>'; //close .loop-thumb-wrapper
}
add_action( 'woocommerce_before_shop_loop_item_title', 'shopix_loop_thumb_wrapper_after', 11 );

/**
 * Remove loop product actions
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

/**
 * Wrap loop product title in link before
 */
function shopix_loop_title_wrapper_before() {
	woocommerce_template_loop_product_link_open(); //open product link
}
add_action( 'woocommerce_shop_loop_item_title', 'shopix_loop_title_wrapper_before', 9 );

/**
 * Wrap loop product title in link after
 */
function shopix_loop_title_wrapper_after() {
	woocommerce_template_loop_product_link_close(); //open product link
}
add_action( 'woocommerce_shop_loop_item_title', 'shopix_loop_title_wrapper_after', 11 );

/**
 * Add product categories to product loop
 */
function shopix_loop_product_categories() {

	$enable_catalog_categories = get_theme_mod( 'enable_catalog_categories', 1 );

	if ( !$enable_catalog_categories ) {
		return;
	}

	echo '<div class="loop-product-cats">' . wc_get_product_category_list( get_the_id() ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'woocommerce_before_shop_loop_item_title', 'shopix_loop_product_categories', 15 );

/**
 * YITH quickview
 */
function shopix_filter_yith_wcqv_button() {

    global $product;
    
    $product_id = $product->get_id();

    $button = '<a href="#" class="yith-wcqv-button" data-product_id="' . esc_attr( $product_id ) . '">' . shopix_get_svg_icon( 'icon-expand', false ) . '</a>';
    return $button;
}
add_filter( 'yith_add_quick_view_button_html', 'shopix_filter_yith_wcqv_button' );

/**
 * Add image swap effect
 */
function shopix_loop_swap_effect() {

	$loop_product_image = get_theme_mod( 'loop_product_image', 'swap' );

	if ( 'swap' !== $loop_product_image ) {
		return;
	}

    $image_id = wc_get_product()->get_gallery_image_ids();

    if ( !empty( $image_id ) ) {
        echo '<img class="hover-swap" src="' . wp_get_attachment_image_src( $image_id[0], 'woocommerce_thumbnail' )[0] . '"></img>';
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'shopix_loop_swap_effect' ); 

/**
 * Reasons to buy on single products
 */
function shopix_single_reasons() {
	$reasons = get_theme_mod( 'single_product_reasons' );
	$heading = get_theme_mod( 'single_product_reasons_heading' );

	if ( empty( $reasons ) ) {
		return;
	}

	$reasons = explode( ',', $reasons );
	
	echo '<div class="buy-reasons">';
	echo '<h4>' . esc_html( $heading ) . '</h4>';
	foreach ( $reasons as $reason ) {
		echo '<div class="buy-reason">' . shopix_get_svg_icon( 'icon-check', false ) . '<span>' . wp_kses_post( $reason ) . '</span>' . '</div>';
	}
	echo '</div>';
	
}
add_action( 'woocommerce_single_product_summary', 'shopix_single_reasons', 45 );

/**
 * Trust badge
 */
function shopix_trust_badge() {
	$badge = get_theme_mod( 'trust_badge' );

	if ( $badge ) {
		echo '<div class="trust-badge"><img alt="' . esc_attr__( 'Trust badge', 'shopix' ) . '" src="' .  esc_url( $badge ) . '"/></div>';
	}

}
add_action( 'woocommerce_single_product_summary', 'shopix_trust_badge', 45 );


/**
 * Sales badge text and shape
 */
function shopix_sale_badge_text() {

	$badge_text 	= get_theme_mod( 'sale_badge_text', '%' );
	$badge_shape 	= get_theme_mod( 'sale_badge_shape', 'circle' );

	return '<span class="onsale shape-' . esc_attr( $badge_shape ) . '">' . esc_html( $badge_text ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'shopix_sale_badge_text' );