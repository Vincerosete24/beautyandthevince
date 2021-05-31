<?php
/**
 * Shop Customizer options
 *
 * @package Shopix
 */

//Layout
$wp_customize->add_setting(
	'title_product_catalog_layout',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_layout',
	array(
		'label'    => esc_html__( 'Layout', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
		'priority' => -10,
	)
) );
$wp_customize->add_setting(
	'shop_archive_layout',
	array(
		'default'           => 'no-sidebar',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Shopix_Radio_Images(
		$wp_customize,
		'shop_archive_layout',
		array(
			'label'    => esc_html__( 'Product catalog and archives layout', 'shopix' ),
			'section'  => 'woocommerce_product_catalog',
			'choices'  => array(
				'no-sidebar' => array(
					'label' => esc_html__( 'Default', 'shopix' ),
					'url'   => '%s/assets/images/catalogl1.jpg'
				),
				'sidebar-left' => array(
					'label' => esc_html__( 'Sidebar left', 'shopix' ),
					'url'   => '%s/assets/images/catalogl2.jpg'
				),
				'sidebar-right' => array(
					'label' => esc_html__( 'Sidebar right', 'shopix' ),
					'url'   => '%s/assets/images/catalogl3.jpg'
				),				
			)
		)
	)
); 

$wp_customize->add_setting(
	'title_product_catalog_general_elements',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_general_elements',
	array(
		'label'    => esc_html__( 'General elements', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
	)
) );

$wp_customize->add_setting(
	'enable_catalog_title',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_catalog_title',
		array(
			'label'         	=> esc_html__( 'Enable shop and shop archives title', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);

$wp_customize->add_setting(
	'enable_catalog_breadcrumbs',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_catalog_breadcrumbs',
		array(
			'label'         	=> esc_html__( 'Enable shop breadcrumbs', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);

$wp_customize->add_setting(
	'enable_catalog_results_no',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_catalog_results_no',
		array(
			'label'         	=> esc_html__( 'Enable results number', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);

$wp_customize->add_setting(
	'enable_catalog_sorting',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_catalog_sorting',
		array(
			'label'         	=> esc_html__( 'Enable sorting', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);

$wp_customize->add_setting(
	'title_product_catalog_product_style',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_product_style',
	array(
		'label'    => esc_html__( 'Product style', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
	)
) );
$wp_customize->add_setting( 'loop_product_style', array(
	'sanitize_callback' => 'shopix_sanitize_select',
	'default' 			=> 'default',
) );
  
$wp_customize->add_control( 'loop_product_style', array(
	'type' 		=> 'select',
	'section' 	=> 'woocommerce_product_catalog',
	'label' 	=> esc_html__( 'Style', 'shopix' ),
	'choices' => array(
		'default' 	=> esc_html__( 'Regular', 'shopix' ),
		'bordered' 	=> esc_html__( 'Bordered', 'shopix' ),
		'nogap' 	=> esc_html__( 'Bordered (no gap)', 'shopix' ),
	),
) );

$wp_customize->add_setting(
	'title_product_catalog_product_image',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_product_image',
	array(
		'label'    => esc_html__( 'Product image', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
	)
) );

$wp_customize->add_setting( 'loop_product_image', array(
	'sanitize_callback' => 'shopix_sanitize_select',
	'default' 			=> 'swap',
) );
  
$wp_customize->add_control( 'loop_product_image', array(
	'type' 		=> 'select',
	'section' 	=> 'woocommerce_product_catalog',
	'label' 	=> esc_html__( 'Image hover effect', 'shopix' ),
	'choices' => array(
		'swap' 		=> esc_html__( 'Swap', 'shopix' ),
		'zoom' 		=> esc_html__( 'Zoom', 'shopix' ),
		'zoomr' 	=> esc_html__( 'Zoom&amp;rotate', 'shopix' ),
	),
) );

$wp_customize->add_setting(
	'title_product_catalog_product_title',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_product_title',
	array(
		'label'    => esc_html__( 'Product title', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
	)
) );

$wp_customize->add_setting( 'loop_product_title_size_desktop', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'loop_product_title_size_tablet', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'loop_product_title_size_mobile', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'loop_product_title_size',
	array(
		'label' => esc_html__( 'Product title font size', 'shopix' ),
		'section' => 'woocommerce_product_catalog',
		'settings'   => array (
			'loop_product_title_size_desktop',
			'loop_product_title_size_tablet',
			'loop_product_title_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

$wp_customize->add_setting(
	'loop_product_title_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'loop_product_title_color',
		array(
			'label'         	=> esc_html__( 'Product title color', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);

$wp_customize->add_setting(
	'title_product_catalog_product_price',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_product_price',
	array(
		'label'    => esc_html__( 'Product price', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
	)
) );

$wp_customize->add_setting(
	'enable_catalog_price',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_catalog_price',
		array(
			'label'         	=> esc_html__( 'Show product price', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);

$wp_customize->add_setting( 'loop_product_price_size_desktop', array(
	'default'   => 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'loop_product_price_size_tablet', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'loop_product_price_size_mobile', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'loop_product_price_size',
	array(
		'label' => esc_html__( 'Product price font size', 'shopix' ),
		'section' => 'woocommerce_product_catalog',
		'settings'   => array (
			'loop_product_price_size_desktop',
			'loop_product_price_size_tablet',
			'loop_product_price_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

$wp_customize->add_setting(
	'loop_product_price_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'loop_product_price_color',
		array(
			'label'         	=> esc_html__( 'Product price color', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);

$wp_customize->add_setting(
	'title_product_catalog_product_add_cart',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_product_add_cart',
	array(
		'label'    => esc_html__( 'Add to cart', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
	)
) );

$wp_customize->add_setting(
	'enable_catalog_add_cart',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_catalog_add_cart',
		array(
			'label'         	=> esc_html__( 'Show loop add to cart button', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);
$wp_customize->add_setting( 'loop_add_to_cart_position', array(
	'sanitize_callback' => 'shopix_sanitize_select',
	'default' 			=> 'default',
) );
  
$wp_customize->add_control( 'loop_add_to_cart_position', array(
	'type' 		=> 'select',
	'section' 	=> 'woocommerce_product_catalog',
	'label' 	=> esc_html__( 'Add to cart button position', 'shopix' ),
	'choices' => array(
		'default' => esc_html__( 'Display on hover', 'shopix' ),
		'outside' => esc_html__( 'Always display', 'shopix' ),
	),
) );
$wp_customize->add_setting(
	'loop_add_to_cart_bg_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'loop_add_to_cart_bg_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);
$wp_customize->add_setting(
	'loop_add_to_cart_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'loop_add_to_cart_color',
		array(
			'label'         	=> esc_html__( 'Color', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);
$wp_customize->add_setting(
	'loop_add_to_cart_bg_color_hover',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'loop_add_to_cart_bg_color_hover',
		array(
			'label'         	=> esc_html__( 'Hover background color', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);
$wp_customize->add_setting(
	'loop_add_to_cart_color_hover',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'loop_add_to_cart_color_hover',
		array(
			'label'         	=> esc_html__( 'Hover color', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);

$wp_customize->add_setting(
	'title_product_catalog_product_cat',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_product_cat',
	array(
		'label'    => esc_html__( 'Product categories', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
	)
) );

$wp_customize->add_setting(
	'enable_catalog_categories',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_catalog_categories',
		array(
			'label'         	=> esc_html__( 'Show product categories', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);

$wp_customize->add_setting(
	'title_product_catalog_product_ratings',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_product_ratings',
	array(
		'label'    => esc_html__( 'Product ratings', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
	)
) );

$wp_customize->add_setting(
	'enable_catalog_ratings',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_catalog_ratings',
		array(
			'label'         	=> esc_html__( 'Show product ratings', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);
$wp_customize->add_setting(
	'loop_ratings_color',
	array(
		'default'           => '#f1ce13',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'loop_ratings_color',
		array(
			'label'         	=> esc_html__( 'Ratings color', 'shopix' ),
			'section'       	=> 'woocommerce_product_catalog',
		)
	)
);


$wp_customize->add_setting(
	'title_product_catalog_sale_badge',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_product_catalog_sale_badge',
	array(
		'label'    => esc_html__( 'Sale badge', 'shopix' ),
		'section'  => 'woocommerce_product_catalog',
	)
) );
$wp_customize->add_setting(
	'sale_badge_text',
	array(
		'default'           => '%',
		'sanitize_callback' => 'shopix_sanitize_text',
	)
);
$wp_customize->add_control(
	'sale_badge_text',
	array(
		'label' 			=> esc_html__( 'Sale badge text', 'shopix' ),
		'section' 			=> 'woocommerce_product_catalog',
		'type' 				=> 'text',
	)
);

$wp_customize->add_setting( 'sale_badge_shape', array(
	'sanitize_callback' => 'shopix_sanitize_select',
	'default' 			=> 'circle',
) );
  
$wp_customize->add_control( 'sale_badge_shape', array(
	'type' 		=> 'select',
	'section' 	=> 'woocommerce_product_catalog',
	'label' 	=> esc_html__( 'Shape', 'shopix' ),
	'choices' => array(
		'circle' 	=> esc_html__( 'Circle', 'shopix' ),
		'rectangle' => esc_html__( 'Rectangle', 'shopix' ),
	),
) );


/**
 * Single products
 */
$wp_customize->add_section(
	'shopix_single_products',
	array(
		'title'         => esc_html__( 'Single products', 'shopix' ),
		'priority'      => 11,
		'panel'			=> 'woocommerce'
	)
);

//Layout
$wp_customize->add_setting(
	'single_product_layout',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Shopix_Radio_Images(
		$wp_customize,
		'single_product_layout',
		array(
			'label'    		=> esc_html__( 'Gallery layout', 'shopix' ),
			'description'    => esc_html__( 'Please note: to see the results for this option, you need to refresh your page after saving.', 'shopix' ),
			'section'  => 'shopix_single_products',
			'choices'  => array(
				'default' => array(
					'label' => esc_html__( 'Default', 'shopix' ),
					'url'   => '%s/assets/images/gallery-layout1.jpg'
				),
				'expanded' => array(
					'label' => esc_html__( 'Expanded', 'shopix' ),
					'url'   => '%s/assets/images/gallery-layout2.jpg'
				),			
			)
		)
	)
); 

$wp_customize->add_setting(
	'disable_single_product_breadcrumbs',
	array(
		'default'           => 0,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'disable_single_product_breadcrumbs',
		array(
			'label'         	=> esc_html__( 'Disable breadcrumbs', 'shopix' ),
			'section'       	=> 'shopix_single_products',
		)
	)
);

$wp_customize->add_setting(
	'disable_single_product_related',
	array(
		'default'           => 0,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'disable_single_product_related',
		array(
			'label'         	=> esc_html__( 'Disable related products', 'shopix' ),
			'section'       	=> 'shopix_single_products',
		)
	)
);

$wp_customize->add_setting(
	'disable_single_product_upsells',
	array(
		'default'           => 0,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'disable_single_product_upsells',
		array(
			'label'         	=> esc_html__( 'Disable upsell products', 'shopix' ),
			'section'       	=> 'shopix_single_products',
		)
	)
);

$wp_customize->add_setting(
	'disable_single_product_meta',
	array(
		'default'           => 0,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'disable_single_product_meta',
		array(
			'label'         	=> esc_html__( 'Disable product meta', 'shopix' ),
			'section'       	=> 'shopix_single_products',
		)
	)
);

$wp_customize->add_setting(
	'disable_single_product_rating',
	array(
		'default'           => 0,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'disable_single_product_rating',
		array(
			'label'         	=> esc_html__( 'Disable product rating', 'shopix' ),
			'section'       	=> 'shopix_single_products',
		)
	)
);


$wp_customize->add_setting(
	'single_product_reasons_heading',
	array(
		'default'           => '',
		'sanitize_callback' => 'shopix_sanitize_text',
	)
);
$wp_customize->add_control(
	'single_product_reasons_heading',
	array(
		'label' 			=> esc_html__( 'Heading', 'shopix' ),
		'section' 			=> 'shopix_single_products',
		'type' 				=> 'text',
	)
);
$wp_customize->add_setting( 'single_product_reasons',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'shopix_sanitize_text'
	)
);
$wp_customize->add_control( new Shopix_Repeater_Control( $wp_customize, 'single_product_reasons',
	array(
		'label' 		=> esc_html__( 'Reasons to buy', 'shopix' ),
		'description' 	=> esc_html__( 'This block will be displayed on all single products.', 'shopix' ),
		'section' 		=> 'shopix_single_products',
		'button_labels' => array(
			'add' => esc_html__( 'Add new reason', 'shopix' ),
		),
	)
) );
$wp_customize->add_setting(
	'trust_badge',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'trust_badge',
		array(
		   'label'          => esc_html__( 'Trust badge', 'shopix' ),
		   'description'    => esc_html__( 'You can display an image after the add to cart button to increase trust. It can contain icons like antivirus, safety etc.', 'shopix' ),
		   'type'           => 'image',
		   'section'        => 'shopix_single_products',
		)
	)
);


//Styling
$wp_customize->add_setting(
	'title_single_product_styling',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_single_product_styling',
	array(
		'label'    => esc_html__( 'Styling', 'shopix' ),
		'section'  => 'shopix_single_products',
	)
) );

$wp_customize->add_setting( 'single_product_title_size_desktop', array(
	'default'   => 40,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'single_product_title_size_tablet', array(
	'default'	=> 36,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'single_product_title_size_mobile', array(
	'default'	=> 28,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'single_product_title_size',
	array(
		'label' => esc_html__( 'Product title font size', 'shopix' ),
		'section' => 'shopix_single_products',
		'settings'   => array (
			'single_product_title_size_desktop',
			'single_product_title_size_tablet',
			'single_product_title_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

$wp_customize->add_setting(
	'single_product_title_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'single_product_title_color',
		array(
			'label'         	=> esc_html__( 'Product title color', 'shopix' ),
			'section'       	=> 'shopix_single_products',
		)
	)
);

$wp_customize->add_setting( 'single_product_price_size_desktop', array(
	'default'   => 22,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'single_product_price_size_tablet', array(
	'default'	=> 22,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'single_product_price_size_mobile', array(
	'default'	=> 22,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'single_product_price_size',
	array(
		'label' => esc_html__( 'Product price font size', 'shopix' ),
		'section' => 'shopix_single_products',
		'settings'   => array (
			'single_product_price_size_desktop',
			'single_product_price_size_tablet',
			'single_product_price_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

$wp_customize->add_setting(
	'single_product_price_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'single_product_price_color',
		array(
			'label'         	=> esc_html__( 'Product price color', 'shopix' ),
			'section'       	=> 'shopix_single_products',
		)
	)
);


//Checkout
$wp_customize->add_setting(
	'shopix_df_checkout',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'shopix_df_checkout',
		array(
			'label'         	=> esc_html__( 'Enable distraction free checkout', 'shopix' ),
			'section'       	=> 'woocommerce_checkout',
		)
	)
);