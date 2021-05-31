<?php
/**
 * General Customizer options
 *
 * @package Shopix
 */

$wp_customize->add_panel(
	'shopix_general_panel',
	array(
		'title'         => esc_html__( 'General settings', 'shopix' ),
		'priority'      => 1,
	)
); 

/**
 * Colors
 */
$wp_customize->add_setting(
	'accent_color',
	array(
		'default'           => '#DCA56D',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'accent_color',
		array(
			'label'         	=> esc_html__( 'Accent color', 'shopix' ),
			'section'       	=> 'colors',
			'settings'      	=> 'accent_color',
		)
	)
);


$wp_customize->add_setting(
	'body_color',
	array(
		'default'           => '#1d1d1f',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'body_color',
		array(
			'label'         	=> esc_html__( 'Body text color', 'shopix' ),
			'section'       	=> 'colors',
		)
	)
);
$wp_customize->add_setting(
	'content_link_color',
	array(
		'default'           => '#4169e1',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'content_link_color',
		array(
			'label'         	=> esc_html__( 'Content link color', 'shopix' ),
			'section'       	=> 'colors',
		)
	)
);
$wp_customize->add_setting(
	'content_link_color_hover',
	array(
		'default'           => '#191970',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'content_link_color_hover',
		array(
			'label'         	=> esc_html__( 'Content link color (hover)', 'shopix' ),
			'section'       	=> 'colors',
		)
	)
);
$wp_customize->add_setting(
	'headings_color',
	array(
		'default'           => '#1d1d1f',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'headings_color',
		array(
			'label'         	=> esc_html__( 'H1-H6 headings', 'shopix' ),
			'section'       	=> 'colors',
		)
	)
);


$wp_customize->add_setting(
	'general_color_options_info',
	array(
		'sanitize_callback' => 'esc_html',
		'priority'			=> 19
	)
);
$wp_customize->add_control( new Shopix_Info( $wp_customize, 'general_color_options_info',
	array(
		'label'    => '<h3>' . esc_html__( 'More color options', 'shopix' ) . '</h3><a style="display:block;margin-bottom:5px;" href="javascript:wp.customize.section( \'shopix_buttons\' ).focus();">' . esc_html__( 'Button colors', 'shopix' ) . '</a><a style="display:block;margin-bottom:5px;" href="javascript:wp.customize.panel( \'shopix_header_panel\' ).focus();">' . esc_html__( 'Header area colors', 'shopix' ) . '</a><a style="display:block;margin-bottom:5px;" href="javascript:wp.customize.section( \'woocommerce_product_catalog\' ).focus();">' . esc_html__( 'WooCommerce colors', 'shopix' ) . '</a><a style="display:block;margin-bottom:5px;" href="javascript:wp.customize.section( \'shopix_footer_widgets\' ).focus();">' . esc_html__( 'Footer widgets colors', 'shopix' ) . '</a><a style="display:block;margin-bottom:5px;" href="javascript:wp.customize.section( \'shopix_footer_bar\' ).focus();">' . esc_html__( 'Footer credits colors', 'shopix' ) . '</a>',
		'attr'	   => false,
		'section'  => 'colors',
	)
) );

/**
 * Buttons
 */
$wp_customize->add_section(
	'shopix_buttons',
	array(
		'title'         => esc_html__( 'Buttons', 'shopix' ),
		'panel'			=> 'shopix_general_panel'
	)
);
$wp_customize->add_setting(
	'global_button_background',
	array(
		'default'           => '#DCA56D',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'global_button_background',
		array(
			'label'         	=> esc_html__( 'Button background color', 'shopix' ),
			'section'       	=> 'shopix_buttons',
			'settings'      	=> 'global_button_background',
		)
	)
);

$wp_customize->add_setting(
	'global_button_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'global_button_color',
		array(
			'label'         	=> esc_html__( 'Button color', 'shopix' ),
			'section'       	=> 'shopix_buttons',
			'settings'      	=> 'global_button_color',
		)
	)
);

$wp_customize->add_setting(
	'global_button_background_hover',
	array(
		'default'           => '#bd8954',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'global_button_background_hover',
		array(
			'label'         	=> esc_html__( 'Button background color (hover)', 'shopix' ),
			'section'       	=> 'shopix_buttons',
			'settings'      	=> 'global_button_background_hover',
		)
	)
);

$wp_customize->add_setting(
	'global_button_color_hover',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'global_button_color_hover',
		array(
			'label'         	=> esc_html__( 'Button color (hover)', 'shopix' ),
			'section'       	=> 'shopix_buttons',
			'settings'      	=> 'global_button_color_hover',
		)
	)
);

$wp_customize->add_setting(
	'global_button_padding_tb',
	array(
		'default'           => 14,
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	'global_button_padding_tb',
	array(
		'label' 			=> esc_html__( 'Top/bottom padding [px]', 'shopix' ),
		'section' 			=> 'shopix_buttons',
		'type' 				=> 'number',
	)
);

$wp_customize->add_setting(
	'global_button_padding_lr',
	array(
		'default'           => 26,
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	'global_button_padding_lr',
	array(
		'label' 			=> esc_html__( 'Left/right padding [px]', 'shopix' ),
		'section' 			=> 'shopix_buttons',
		'type' 				=> 'number',
	)
);

$wp_customize->add_setting(
	'global_button_border_radius',
	array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	'global_button_border_radius',
	array(
		'label' 			=> esc_html__( 'Border radius [px]', 'shopix' ),
		'section' 			=> 'shopix_buttons',
		'type' 				=> 'number',
	)
);

$wp_customize->add_setting(
	'global_button_font_size',
	array(
		'default'           => 16,
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	'global_button_font_size',
	array(
		'label' 			=> esc_html__( 'Font size [px]', 'shopix' ),
		'section' 			=> 'shopix_buttons',
		'type' 				=> 'number',
	)
);