<?php
/**
 * Sidebar Customizer options
 *
 * @package Shopix
 */

$wp_customize->add_section(
	'shopix_sidebar_section',
	array(
		'title'         => esc_html__( 'Sidebar', 'shopix' ),
		'priority'      => 21,
	)
); 

$wp_customize->add_setting( 'sidebar_width',
	array(
		'default' 			=> 300,
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'sidebar_width',
	array(
		'label' => esc_html__( 'Sidebar width [px]', 'shopix' ),
		'section' => 'shopix_sidebar_section',
		'input_attrs' => array(
			'min' => 150,
			'max' => 500,
			'step' => 1,
		),
	)
) );