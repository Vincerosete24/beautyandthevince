/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );

	//accent color
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
		
			$( 'head' ).find( '#shopix-preview-styles-accent-color' ).remove();

			var output = 	'#backtotop,.woocommerce-links .count-number,.woocommerce-cart .product-remove a:hover,.woocommerce .products .button:hover,span.onsale,.author-bio .author-link,.cat-links a,.widget_product_search .woocommerce-product-search::after,.widget_search .search-form::after,.woocommerce-pagination li .page-numbers:hover, .woocommerce-pagination li .page-numbers.current,.navigation.pagination .page-numbers:focus, .navigation.pagination .page-numbers:hover, .navigation.pagination .page-numbers.current,button,.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]:not(.search-submit),.wpforms-form button[type=submit],div.wpforms-container-full .wpforms-form button[type=submit],div.nf-form-content input[type=button] { background:' + to + '; } '
							+ '.single-product div.product .product_meta > span a:hover,ul.products .loop-product-cats a:hover,.featured-cats-inner a:hover,.featured-posts .featured-post .entry-title a:hover,.widget a:hover,.comments-area .comment-reply-link,.entry-meta a:hover,.read-more-link:hover,.entry-title a:hover,.top-bar a:hover,.site-main .post-navigation h4:hover,.comment-navigation a:hover,.posts-navigation a:hover,.post-navigation a:hover,.top-navigation a:hover,.main-navigation a:hover,.is-style-outline .wp-block-button__link,.wp-block-button__link.is-style-outline { color:' + to + '; } '
							+ '.header-contact .er-icon svg,.header-items > a:hover .er-icon { fill:' + to + '; } '
							+ '.is-style-outline .wp-block-button__link,.wp-block-button__link.is-style-outline,button,.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"],.wpforms-form button[type=submit],div.wpforms-container-full .wpforms-form button[type=submit],div.nf-form-content input[type=button] { border-color:' + to + '; }';

			$( 'head' ).append( '<style id="shopix-preview-styles-accent-color">' + output + '</style>' );

		} );
	} );	

	//Responsive font sizes
	//Control: control_name
	//Settings: control_name_{{device}}
	$fontSizes 	= { "loop_product_price_size": "ul.products li.product .price","loop_product_title_size": "ul.products li.product .woocommerce-loop-product__title","single_product_price_size": ".single-product-top .price","single_product_title_size": ".single-product-top .entry-title","single_page_title_size": ".page .entry-header .entry-title", "single_post_title_size": ".single-post .entry-title", "h1_heading_font_size": "h1,.site-title","h2_heading_font_size": "h2","h3_heading_font_size": "h3","h4_heading_font_size": "h4","h5_heading_font_size": "h5","h6_heading_font_size": "h6", "body_font_size": "body", "archive_titles_size": ".posts-loop .entry-title" };
	$devices 	= { "desktop": "(min-width: 992px)", "tablet": "(min-width: 576px) and (max-width: 991px)", "mobile": "(max-width: 575px)" };
	$.each( $fontSizes, function( option, selector ) {
		$.each( $devices, function( device, mediaSize ) {
			wp.customize( option + '_' + device, function( value ) {
				value.bind( function( to ) {
				
					$( 'head' ).find( '#shopix-preview-styles-' + option + '_' + device ).remove();
		
					var output = '@media ' + mediaSize + ' {' + selector + ' { font-size:' + to + 'px; } }';
		
					$( 'head' ).append( '<style id="shopix-preview-styles-' + option + '_' + device + '">' + output + '</style>' );
				} );
			} );
		});
	});

	//line heights
	$line_height_options = { "body_line_height": "body", "h1_heading_line_height": "h1","h2_heading_line_height": "h2","h3_heading_line_height": "h3","h4_heading_line_height": "h4","h5_heading_line_height": "h5","h6_heading_line_height": "h6", "headings_line_height": "h1,h2,h3,h4,h5,h6,.site-title" };

	$.each( $line_height_options, function( option, selector ) {
		wp.customize( option, function( value ) {
			value.bind( function( to ) {
				$( selector ).css( 'line-height', to );
			} );
		} );
	});	
	
	//letter spacing
	$letter_spacing_options = { "body_letter_spacing": "body", "headings_letter_spacing": "h1,h2,h3,h4,h5,h6,.site-title", "h1_letter_spacing": "h1","h2_letter_spacing": "h2","h3_letter_spacing": "h3","h4_letter_spacing": "h4","h5_letter_spacing": "h5","h6_letter_spacing": "h6" };

	$.each( $letter_spacing_options, function( option, selector ) {
		wp.customize( option, function( value ) {
			value.bind( function( to ) {
				$( selector ).css( 'letter-spacing', to + 'px');
			} );
		} );
	});		

	//Color options
	$color_options = { "footer_bar_color":".site-info, .site-info a","footer_widgets_links_color":".footer-widgets a","footer_widgets_color":".footer-widgets","footer_widgets_title_color":".footer-widgets .widget .widget-title","bottom_header_color":".header-bottom,.header-bottom .main-navigation div > ul > li > a","middle_header_color": ".header-middle, .header-middle .site-title a, .header-middle .header-contact a, .header-middle .main-navigation div > ul > li > a, .header-contact .contact-info.heading","top_bar_color": ".top-bar, .top-bar a", "loop_add_to_cart_color": ".woocommerce .products .button","headings_color":"h1,h2,h3,h4,h5,h6", "content_link_color":".entry-content a:not(.button)", "body_color":"body", "submenu_items_color":".main-navigation ul ul a", "menu_items_color":".main-navigation > div > ul > li > a","site_title_color":".site-title a","site_desc_color":".site-description","global_button_color": ".elementor-button-wrapper .elementor-button,button,.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"],.wpforms-form button[type=submit],div.wpforms-container-full .wpforms-form button[type=submit],div.nf-form-content input[type=button]","loop_product_price_color": "ul.products li.product .price","loop_product_title_color": "ul.products li.product .woocommerce-loop-product__title","single_product_price_color": ".single-product-top .price","single_product_title_color": ".single-product-top .entry-title", "single_page_title_color": ".page .entry-header .entry-title", "single_post_title_color": ".single-post .entry-title", "mobile_menu_items_color": "#mobile-menu, #mobile-menu a", "footer_widgets_title_color": ".footer-widgets .widget-title", "footer_widgets_links_color": ".footer-widgets a", "footer_widgets_color": ".footer-widgets", "footer_bottom_color": ".site-info, .site-info a" }; //"option": "selector"
	
	$.each( $color_options, function( option, selector ) {
		wp.customize( option, function( value ) {
			value.bind( function( to ) {
				$( selector ).css( 'color', to );
			} );
		} );
	});	

	//Fill options
	$fill_options = { "top_bar_color": ".top-bar .er-icon" }; //"option": "selector"
	
	$.each( $fill_options, function( option, selector ) {
		wp.customize( option, function( value ) {
			value.bind( function( to ) {
				$( selector ).css( 'fill', to );
			} );
		} );
	});		

	$bg_color_options = { "global_button_background": "button,.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"]:not(.search-submit),.wpforms-form button[type=submit],div.wpforms-container-full .wpforms-form button[type=submit],div.nf-form-content input[type=button]", "footer_bar_bg_color":".site-info","footer_widgets_background": ".footer-widgets","middle_header_background_color": ".header-middle","bottom_header_background_color": ".header-bottom","top_bar_background_color": ".top-bar", "loop_add_to_cart_bg_color": ".woocommerce .products .button" }; //"option": "selector"

	$.each( $bg_color_options, function( option, selector ) {
		wp.customize( option, function( value ) {
			value.bind( function( to ) {
				$( selector ).css( 'background-color', to );
			} );
		} );
	});	

	//background hover
	$bg_hover_options = { "global_button_background_hover": "button:hover,.button:hover,.wp-block-button__link:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:not(.search-submit):hover,.wpforms-form button[type=submit]:hover,div.wpforms-container-full .wpforms-form button[type=submit]:hover,div.nf-form-content input[type=button]:hover","loop_add_to_cart_bg_color_hover": ".woocommerce .products .button:hover", };

	$.each( $bg_hover_options, function( option, selector ) {
		wp.customize( option, function( value ) {
			value.bind( function( to ) {
		
				$( 'head' ).find( '#shopix-preview-styles-' + option ).remove();
	
				var output = selector + ' { background-color:' + to + '!important; }';
	
				$( 'head' ).append( '<style id="shopix-preview-styles-' + option + '">' + output + '</style>' );
	
			} );
		} );
	});	

	//color hover and pseudo
	$color_hover_options = { "global_button_color_hover": "button:hover,.button:hover,.wp-block-button__link:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:not(.search-submit):hover,.wpforms-form button[type=submit]:hover,div.wpforms-container-full .wpforms-form button[type=submit]:hover,div.nf-form-content input[type=button]:hover","loop_ratings_color": ".star-rating span::before", "loop_add_to_cart_color_hover": ".woocommerce .products .button:hover", };

	$.each( $color_hover_options, function( option, selector ) {
		wp.customize( option, function( value ) {
			value.bind( function( to ) {
		
				$( 'head' ).find( '#shopix-preview-styles-' + option ).remove();
	
				var output = selector + ' { color:' + to + '!important; }';
	
				$( 'head' ).append( '<style id="shopix-preview-styles-' + option + '">' + output + '</style>' );
	
			} );
		} );
	});	
	
	//border options
	$border_options = { "bottom_header_border_color": ".header-bottom" }; //"option": "selector"
	
	$.each( $border_options, function( option, selector ) {
		wp.customize( option, function( value ) {
			value.bind( function( to ) {
				$( selector ).css( 'border-color', to );
			} );
		} );
	});		

	//Responsive max. width
	$logoSize 	= { "logo_size": ".custom-logo" };
	$devices 	= { "desktop": "(min-width: 992px)", "tablet": "(min-width: 576px) and (max-width: 991px)", "mobile": "(max-width: 575px)" };
	$.each( $logoSize, function( option, selector ) {
		$.each( $devices, function( device, mediaSize ) {
			wp.customize( option + '_' + device, function( value ) {
				value.bind( function( to ) {
				
					$( 'head' ).find( '#shopix-preview-styles-' + option + '_' + device ).remove();
		
					var output = '@media ' + mediaSize + ' {' + selector + ' { max-width:' + to + 'px; } }';
		
					$( 'head' ).append( '<style id="shopix-preview-styles-' + option + '_' + device + '">' + output + '</style>' );
				} );
			} );
		});
	});

	wp.customize( 'sidebar_width', function( value ) {
		value.bind( function( to ) {
			$( '.widget-area' ).css( 'width', to + 'px' );
			$( '.site-main.has-sidebar' ).css( 'width', 'calc( 100% - ' + to + 'px)' );
		} );
	} );

}( jQuery ) );