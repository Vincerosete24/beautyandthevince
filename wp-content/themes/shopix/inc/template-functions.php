<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Shopix
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function shopix_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) || ( false === apply_filters( 'shopix_enable_sidebar', true ) ) ) {
		$classes[] = 'no-sidebar';
	}

	global $post;
	if ( isset( $post) ) {
		$page_layout = get_post_meta( $post->ID, '_shopix_page_layout', true );	

		if ( 'stretched'  === $page_layout ) { 
			$classes[] = 'layout-stretched';
		}
	}	

	$header_layout 	= get_theme_mod( 'main_header_layout','default' );
	$classes[]		= 'header-' . esc_attr( $header_layout );

	if ( class_exists( 'WooCommerce' ) ) {
		//Shop archives
		$shop_archive_layout = get_theme_mod( 'shop_archive_layout' , 'no-sidebar' );
		if ( is_shop() || is_product_category() || is_product_tag() ) {
			$classes = array_diff( $classes, array( 'no-sidebar', 'sidebar-left', 'sidebar-right' ) );
			$classes[] = $shop_archive_layout;
		}	
	}	

	return $classes;
}
add_filter( 'body_class', 'shopix_body_classes' );

/**
 * Add sidebar
 */
function shopix_sidebar() { 

	if ( false === apply_filters( 'shopix_enable_sidebar', true ) ) { 
		return;
	}
	
	get_sidebar();
}
add_action( 'shopix_sidebar', 'shopix_sidebar' );

/**
 * Filter the sidebar
 */
function shopix_filter_sidebar() {

	global $post;
	if ( isset( $post) ) {
		$page_layout = get_post_meta( $post->ID, '_shopix_page_layout', true );	

		if ( 'no-sidebar'  === $page_layout || 'stretched'  === $page_layout ) { 
			add_filter( 'shopix_enable_sidebar', '__return_false' );
		}
	}
}
add_action( 'wp', 'shopix_filter_sidebar' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post elements.
 * @return array
 */
function shopix_post_classes( $classes ) {

	$layout = shopix_blog_layout();


	if ( !is_singular() ) {
		if ( 'grid' === $layout ) {
			$classes[] = 'col-md-6 col-sm-6';
		} else {
			$classes[] = 'col-md-12';
		}
	}

	
	if ( class_exists( 'WooCommerce') && is_woocommerce() ) { 
		$classes = array_diff( $classes, array( 'col-md-6 col-sm-6', 'col-md-12' ) );
	}	

	//Remove hentry class from single pages
	if ( 'page' == get_post_type() ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
	}	

	return $classes;
}
add_filter( 'post_class', 'shopix_post_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function shopix_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'shopix_pingback_header' );

/**
 * Build fonts URL
 */
function shopix_generate_fonts_url() {
	$fonts_url = '';
	$subsets = 'latin';

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

	if ( 'System default' === $body_font['font'] && 'System default' === $headings_font['font'] ) {
		return; //Return if we don't need to enqueue Google fonts
	}

	$font_families = array();

	$font_families[] = $body_font['font'] . ':' . $body_font['regularweight'] . ',' . $body_font['italicweight'] . ',' . $body_font['boldweight'];
		
	$font_families[] = $headings_font['font'] . ':' . $headings_font['italicweight'] . ',' . $headings_font['boldweight'];

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( $subsets ),
		'display' => urlencode( 'swap' ),
	);

	$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );

	return esc_url_raw( $fonts_url );
}

/**
 * Excerpt length
 */
function shopix_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	$length = get_theme_mod( 'excerpt_length', '15' );

	return $length;
}
add_filter( 'excerpt_length', 'shopix_excerpt_length', 999 );

/**
 * Get SVG code. From TwentTwenty
 */
function shopix_get_svg_icon( $icon, $echo = false ) {
	$svg_code = wp_kses(
		Shopix_SVG_Icons::get_svg_icon( $icon ),
		array(
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
			),
			'path'    => array(
				'fill'      => true,
				'fill-rule' => true,
				'd'         => true,
				'transform' => true,
			),
			'polygon' => array(
				'fill'      => true,
				'fill-rule' => true,
				'points'    => true,
				'transform' => true,
				'focusable' => true,
			),
		)
	);	

	if ( $echo != false ) {
		echo '<span class="er-icon">' . $svg_code . '</span>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return '<span class="er-icon">' . $svg_code . '</span>';
	}
}


/**
 * Get social network
 */
function shopix_get_social_network( $social ) {

	//Available networks
	$networks = array( 'facebook', 'twitter', 'instagram', 'github', 'linkedin', 'youtube', 'xing', 'instagram', 'flickr', 'dribbble', 'vk', 'weibo', 'vimeo', 'mix', 'behance', 'spotify', 'soundcloud', 'twitch', 'bandcamp', 'etsy', 'pinterest' );

	//Loop through the networks and find the current one
	foreach ( $networks as $network ) {
		$found = strpos( $social, $network );

		if ( $found !== false ) {
			return $network;
		}
	}
}

/**
 * Archives and search titles
 */
function shopix_archive_titles() { 


	if ( class_exists( 'WooCommerce' ) && is_woocommerce() && !is_product()	) : ?>
	<header class="woocommerce-products-header page-header">
		<div class="container">
		<?php do_action( 'shopix_woo_breadcrumbs' ); ?>
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>
			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>
		</div>
	</header>	
	<?php elseif ( is_archive() ) : ?>
	<header class="page-header">
		<div class="container">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>		
		</div>
	</header><!-- .page-header -->
	<?php elseif ( is_search() ) : ?>
	<header class="page-header">
		<h1 class="page-title">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'shopix' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h1>
	</header><!-- .page-header -->
	<?php
	endif;
}
add_action( 'shopix_header_after', 'shopix_archive_titles' );

/**
 * Remove archive labels
 */
function shopix_remove_archive_labels( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
add_filter( 'get_the_archive_title', 'shopix_remove_archive_labels' );

/**
 * Blog layout
 */
function shopix_blog_layout() {
	
	$blog_layout = get_theme_mod( 'blog_layout', 'grid' );

	return $blog_layout;	
}

/**
 * Single post layout
 */
function shopix_single_post_layout() {
	$single_layout = get_theme_mod( 'single_post_layout', 'has-sidebar' );

	if ( 'has-sidebar' === $single_layout ) {
		$settings = 'has-sidebar';
	} else {
		$settings = 'no-sidebar';
	}

	return $settings;
}

/**
 * Helper function to return all posts
 */
function shopix_get_posts() {
	$post_args = array(
		'numberposts' => -1
	);
	   
	$posts = get_posts( $post_args );
	
	$items = array();
	
	foreach ( $posts as $item ) {
		$items[$item->ID] = $item->post_title;
	}
	
	return $items;
}

/**
 * Output author bio on single posts
 */
function shopix_add_author_bio() {
	$enable_author_bio = get_theme_mod( 'enable_author_bio', 1 );

	if ( !$enable_author_bio ) {
		return;
	}

	get_template_part( 'template-parts/bio-author' );
}
add_action( 'shopix_after_single_content', 'shopix_add_author_bio', 12 );


/**
 * Output single post navigation
 */
function shopix_add_post_navigation() {
	get_template_part( 'template-parts/post-navigation' );
}
add_action( 'shopix_after_single_content', 'shopix_add_post_navigation', 14 );

/**
 * Back to top
 */
function shopix_back_to_top() {
	echo '<div id="backtotop" class="backtotop">' . shopix_get_svg_icon( 'icon-up', false ) . '</div>';  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'shopix_footer_after', 'shopix_back_to_top' );

/**
 * Header image
 */
function shopix_header_image() {

	if ( !get_header_image() ) {
		return;
	}

	$show_on_front = get_theme_mod( 'header_image_front_page', 0 );

	if ( is_home() || is_front_page() && $show_on_front ) {
		echo '<div class="header-image">';
			the_header_image_tag();
		echo '</div>';
	}
}
add_action( 'shopix_header_after', 'shopix_header_image' );