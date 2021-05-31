<?php
/**
 * Footer Customizer options
 *
 * @package Shopix
 */

$wp_customize->add_panel(
	'shopix_footer_panel',
	array(
		'title'         => esc_html__( 'Footer', 'shopix' ),
		'priority'      => 29,
	)
); 

/**
 * Footer widgets
 */
$wp_customize->add_section(
	'shopix_footer_widgets',
	array(
		'title'         => esc_html__( 'Footer widgets', 'shopix' ),
		'panel'			=> 'shopix_footer_panel'
	)
);

$wp_customize->add_setting(
	'footer_widgets_layout',
	array(
		'default'           => 'columns3',
		'sanitize_callback' => 'shopix_sanitize_select',
	)
);
$wp_customize->add_control(
	'footer_widgets_layout',
	array(
		'type'      		=> 'select',
		'label'     		=> esc_html__( 'Footer widgets layout', 'shopix' ),
		'section'   		=> 'shopix_footer_widgets',
		'choices'   		=> array(
			'columns1'		=> esc_html__( '1 column', 'shopix' ),
			'columns2'		=> esc_html__( '2 columns', 'shopix' ),
			'columns3'		=> esc_html__( '3 columns', 'shopix' ),
			'columns4'		=> esc_html__( '4 columns', 'shopix' ),
		),
	)
);


$wp_customize->add_setting(
	'footer_widgets_background',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'footer_widgets_background',
		array(
			'label'         => esc_html__( 'Background color', 'shopix' ),
			'section'       => 'shopix_footer_widgets',
			'settings'      => 'footer_widgets_background',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_title_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'footer_widgets_title_color',
		array(
			'label'         => esc_html__( 'Widget titles color', 'shopix' ),
			'section'       => 'shopix_footer_widgets',
			'settings'      => 'footer_widgets_title_color',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'footer_widgets_color',
		array(
			'label'         => esc_html__( 'Content color', 'shopix' ),
			'section'       => 'shopix_footer_widgets',
			'settings'      => 'footer_widgets_color',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_links_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'footer_widgets_links_color',
		array(
			'label'         => esc_html__( 'Links color', 'shopix' ),
			'section'       => 'shopix_footer_widgets',
			'settings'      => 'footer_widgets_links_color',
		)
	)
);

/**
 * Subscribe section
 */
$wp_customize->add_section(
	'shopix_footer_subscribe',
	array(
		'title'         => esc_html__( 'Subscribe section', 'shopix' ),
		'panel'			=> 'shopix_footer_panel',
		'description'	=> sprintf( esc_html__( 'This section will display on every page. Add below a shortcode from a newsletter subscribe plugin, like Mailchimp for WP. For the MC4WP code from our demo, see %s.', 'shopix' ), '<a target="_blank" href="https://pastebin.com/rYPCKt8s">' . esc_html__( 'here', 'shopix' ) . '</a>' ),
	)
);

$wp_customize->add_setting(
	'subscribe_shortcode',
	array(
		'default'           => '',
		'sanitize_callback' => 'shopix_sanitize_text',
	)
);
$wp_customize->add_control(
	'subscribe_shortcode',
	array(
		'label' 			=> esc_html__( 'Subscribe shortcode', 'shopix' ),
		'section' 			=> 'shopix_footer_subscribe',
		'type' 				=> 'text',
	)
);


$wp_customize->add_setting(
	'subscribe_text',
	array(
		'default'           => sprintf( '<h3>%1s</h3><p>%2s</p>', esc_html__( 'Subscribe to our newsletter', 'shopix' ), esc_html__( 'Get the news in your inbox.', 'shopix' ) ),
		'sanitize_callback' => 'shopix_sanitize_text',
	)
);
$wp_customize->add_control(
	'subscribe_text',
	array(
		'label' 			=> esc_html__( 'Subscribe text', 'shopix' ),
		'section' 			=> 'shopix_footer_subscribe',
		'type' 				=> 'textarea',
	)
);

/**
 * Footer bar
 */
$wp_customize->add_section(
	'shopix_footer_bar',
	array(
		'title'         => esc_html__( 'Footer bar', 'shopix' ),
		'panel'			=> 'shopix_footer_panel'
	)
);

$wp_customize->add_setting(
	'footer_bar_bg_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'footer_bar_bg_color',
		array(
			'label'         => esc_html__( 'Background color', 'shopix' ),
			'section'       => 'shopix_footer_bar',
			'settings'      => 'footer_bar_bg_color',
		)
	)
);

$wp_customize->add_setting(
	'footer_bar_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'footer_bar_color',
		array(
			'label'         => esc_html__( 'Color', 'shopix' ),
			'section'       => 'shopix_footer_bar',
			'settings'      => 'footer_bar_color',
		)
	)
);