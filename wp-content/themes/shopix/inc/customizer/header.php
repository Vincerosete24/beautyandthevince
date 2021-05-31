<?php
/**
 * Header Customizer options
 *
 * @package Shopix
 */

$wp_customize->add_panel(
	'shopix_header_panel',
	array(
		'title'         => esc_html__( 'Header', 'shopix' ),
		'priority'      => 11,
	)
); 

//Logo size
$wp_customize->add_setting( 'logo_size_desktop', array(
	'default'   		=> 150,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'logo_size_tablet', array(
	'default'			=> 120,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'logo_size_mobile', array(
	'default'			=> 100,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'logo_size',
	array(
		'label' => esc_html__( 'Logo max. width', 'shopix' ),
		'section' => 'title_tagline',
		'settings'   => array (
			'logo_size_desktop',
			'logo_size_tablet',
			'logo_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
		'priority' => 9
	)
) );

/**
 * Top
 */
$wp_customize->add_section(
	'shopix_header_top_bar',
	array(
		'title'         => esc_html__( 'Top bar', 'shopix' ),
		'priority'      => 11,
		'panel'			=> 'shopix_header_panel'
	)
);

$wp_customize->add_setting(
	'top_bar_tabs',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Tabs( $wp_customize, 'top_bar_tabs',
	array(
		'linked'			=> 'top_bar_tabs',
		'label'    		=> esc_html__( 'Settings', 'shopix' ),
		'label2'    	=> esc_html__( 'Styling', 'shopix' ),
		'connected'		=> 'shopix_header_top_bar',
		'connected2'	=> 'shopix_header_top_bar_styling',
		'section'  		=> 'shopix_header_top_bar',
	)
) );


$wp_customize->add_setting(
	'enable_top_bar',
	array(
		'default'           => 0,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_top_bar',
		array(
			'label'         	=> esc_html__( 'Enable top bar', 'shopix' ),
			'section'       	=> 'shopix_header_top_bar',
			'settings'      	=> 'enable_top_bar',
		)
	)
);

//Layout
$wp_customize->add_setting(
	'top_bar_layout',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Shopix_Radio_Images(
		$wp_customize,
		'top_bar_layout',
		array(
			'label'    		=> esc_html__( 'Top bar layout', 'shopix' ),
			'description'    => esc_html__( 'Hover over the images to see in detail', 'shopix' ),
			'section'  => 'shopix_header_top_bar',
			'choices'  => array(
				'default' => array(
					'label' => esc_html__( 'Default', 'shopix' ),
					'url'   => '%s/assets/images/topbar1.jpg'
				),
				'text-social' => array(
					'label' => esc_html__( 'Text and social', 'shopix' ),
					'url'   => '%s/assets/images/topbar2.jpg'
				),
				'text' => array(
					'label' => esc_html__( 'Text centered', 'shopix' ),
					'url'   => '%s/assets/images/topbar3.jpg'
				),				
			),
			'priority' 			=> 10,
			'active_callback'	=> 'shopix_top_bar_active_callback'
		)
	)
); 

//Header custom text
$wp_customize->add_setting(
	'top_header_text',
	array(
		'default'           => esc_html__( 'Your custom text here', 'shopix' ),
		'sanitize_callback' => 'shopix_sanitize_text',
	)
);
$wp_customize->add_control(
	'top_header_text',
	array(
		'label' 			=> esc_html__( 'Custom text', 'shopix' ),
		'section' 			=> 'shopix_header_top_bar',
		'type' 				=> 'text',
		'priority' 			=> 12,
		'active_callback' 	=> 'shopix_top_bar_active_callback'
	)
);

//Header social
$wp_customize->add_setting( 'header_social_profiles',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'shopix_sanitize_urls'
	)
);
$wp_customize->add_control( new Shopix_Repeater_Control( $wp_customize, 'header_social_profiles',
	array(
		'label' 		=> esc_html__( 'Social profile', 'shopix' ),
		'description' 	=> esc_html__( 'Add links to your social profiles here. You can also rearrange the links.', 'shopix' ),
		'section' 		=> 'shopix_header_top_bar',
		'button_labels' => array(
			'add' => esc_html__( 'Add new social link', 'shopix' ),
		),
		'priority' 		=> 13,
		'active_callback' 	=> 'shopix_top_bar_active_callback'
	)
) );

//nav info
$wp_customize->add_setting(
	'info_header_top_nav',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Info( $wp_customize, 'info_header_top_nav',
	array(
		'label'    			=> '<span class="panel-info-toggle">i</span>' . wp_kses_post( __( 'Looking to add a menu in the top bar? Go to <strong>Appearance > Menus</strong> to create and assign a menu for the <strong>Top Navigation</strong> location.', 'shopix' ) ),
		'section'  			=> 'shopix_header_top_bar',
		'priority' 			=> 14,
		'active_callback'	=> 'shopix_top_bar_active_callback'
	)
) );

$wp_customize->add_section(
	'shopix_header_top_bar_styling',
	array(
		'title'         => esc_html__( 'Top bar styling', 'shopix' ),
		'priority'      => 11,
		'panel'			=> 'shopix_header_panel'
	)
);

$wp_customize->add_setting(
	'top_bar_tabs_styling',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Tabs( $wp_customize, 'top_bar_tabs_styling',
	array(
		'linked'			=> 'top_bar_tabs',
		'label'    		=> esc_html__( 'Settings', 'shopix' ),
		'label2'    	=> esc_html__( 'Styling', 'shopix' ),
		'connected'		=> 'shopix_header_top_bar',
		'connected2'	=> 'shopix_header_top_bar_styling',
		'section'  		=> 'shopix_header_top_bar_styling',
	)
) );

$wp_customize->add_setting(
	'top_bar_background_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'top_bar_background_color',
		array(
			'label'    => esc_html__( 'Background color', 'shopix' ),
			'section'  => 'shopix_header_top_bar_styling',
			'priority' => 20,
		)
	)
);

$wp_customize->add_setting(
	'top_bar_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'top_bar_color',
		array(
			'label'    => esc_html__( 'Color', 'shopix' ),
			'section'  => 'shopix_header_top_bar_styling',
			'priority' => 20,
		)
	)
);

/**
 * Main header 
 */
$wp_customize->add_section(
	'shopix_main_header',
	array(
		'title'         => esc_html__( 'Main header', 'shopix' ),
		'priority'      => 11,
		'panel'			=> 'shopix_header_panel'
	)
);


$wp_customize->add_setting(
	'main_header_tabs',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Tabs( $wp_customize, 'main_header_tabs',
	array(
		'linked'			=> 'main_header_tabs',
		'label'    		=> esc_html__( 'Settings', 'shopix' ),
		'label2'    	=> esc_html__( 'Styling', 'shopix' ),
		'connected'		=> 'shopix_main_header',
		'connected2'	=> 'shopix_main_header_styling',
		'section'  		=> 'shopix_main_header',
	)
) );


//Layout
$wp_customize->add_setting(
	'main_header_layout',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Shopix_Radio_Images(
		$wp_customize,
		'main_header_layout',
		array(
			'label'    => esc_html__( 'Main header layout', 'shopix' ),
			'description'    => esc_html__( 'Hover over the images to see in detail', 'shopix' ),
			'section'  => 'shopix_main_header',
			'choices'  => array(
				'default' => array(
					'label' => esc_html__( 'Default', 'shopix' ),
					'url'   => '%s/assets/images/mainheader1.jpg'
				),
				'inline' => array(
					'label' => esc_html__( 'Inline', 'shopix' ),
					'url'   => '%s/assets/images/mainheader2.jpg'
				),
				'centered' => array(
					'label' => esc_html__( 'Centered', 'shopix' ),
					'url'   => '%s/assets/images/mainheader3.jpg'
				),				
			),
			'priority' 			=> 10,
		)
	)
); 

$wp_customize->add_setting(
	'enable_header_search',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_header_search',
		array(
			'label'         	=> esc_html__( 'Enable search', 'shopix' ),
			'section'       	=> 'shopix_main_header',
			'settings'      	=> 'enable_header_search',
		)
	)
);

$wp_customize->add_setting(
	'enable_header_contact',
	array(
		'default'           => 0,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_header_contact',
		array(
			'label'         	=> esc_html__( 'Enable header contact', 'shopix' ),
			'section'       	=> 'shopix_main_header',
			'settings'      	=> 'enable_header_contact',
		)
	)
);

$wp_customize->add_setting(
	'header_contact_text',
	array(
		'default'           => esc_html__( 'Call us', 'shopix' ),
		'sanitize_callback' => 'shopix_sanitize_text',
	)
);
$wp_customize->add_control(
	'header_contact_text',
	array(
		'label' 			=> esc_html__( 'Contact text', 'shopix' ),
		'section' 			=> 'shopix_main_header',
		'type' 				=> 'text',
		'active_callback' 	=> 'shopix_header_contact_active_callback'
	)
);

$wp_customize->add_setting(
	'header_contact_number',
	array(
		'default'           => esc_html__( '+111.222.333', 'shopix' ),
		'sanitize_callback' => 'shopix_sanitize_text',
	)
);
$wp_customize->add_control(
	'header_contact_number',
	array(
		'label' 			=> esc_html__( 'Contact phone number', 'shopix' ),
		'section' 			=> 'shopix_main_header',
		'type' 				=> 'text',
		'active_callback' 	=> 'shopix_header_contact_active_callback'
	)
);

$wp_customize->add_setting(
	'enable_header_woocommerce',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_header_woocommerce',
		array(
			'label'         	=> esc_html__( 'Enable WooCommerce icons', 'shopix' ),
			'section'       	=> 'shopix_main_header',
			'settings'      	=> 'enable_header_woocommerce',
		)
	)
);

$wp_customize->add_setting(
	'enable_header_button',
	array(
		'default'           => 1,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'enable_header_button',
		array(
			'label'         	=> esc_html__( 'Enable button', 'shopix' ),
			'section'       	=> 'shopix_main_header',
			'settings'      	=> 'enable_header_button',
		)
	)
);

//Header button
$wp_customize->add_setting(
	'header_button_text',
	array(
		'default'           => esc_html__( 'Click here', 'shopix' ),
		'sanitize_callback' => 'shopix_sanitize_text',
	)
);
$wp_customize->add_control(
	'header_button_text',
	array(
		'label' 			=> esc_html__( 'Button text', 'shopix' ),
		'section' 			=> 'shopix_main_header',
		'type' 				=> 'text',
		'active_callback' 	=> 'shopix_header_button_active_callback'
	)
);

$wp_customize->add_setting(
	'header_button_url',
	array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	'header_button_url',
	array(
		'label' 			=> esc_html__( 'Button link', 'shopix' ),
		'section' 			=> 'shopix_main_header',
		'type' 				=> 'text',
		'active_callback' 	=> 'shopix_header_button_active_callback'
	)
);

$wp_customize->add_section(
	'shopix_main_header_styling',
	array(
		'title'         => esc_html__( 'Main header styling', 'shopix' ),
		'priority'      => 11,
		'panel'			=> 'shopix_header_panel'
	)
);
$wp_customize->add_setting(
	'main_header_tabs_styling',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Tabs( $wp_customize, 'main_header_tabs_styling',
	array(
		'linked'		=> 'main_header_tabs',
		'label'    		=> esc_html__( 'Settings', 'shopix' ),
		'label2'    	=> esc_html__( 'Styling', 'shopix' ),
		'connected'		=> 'shopix_main_header',
		'connected2'	=> 'shopix_main_header_styling',
		'section'  		=> 'shopix_main_header_styling',
	)
) );

$wp_customize->add_setting(
	'middle_header_background_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'middle_header_background_color',
		array(
			'label'    => esc_html__( 'Background color (logo bar)', 'shopix' ),
			'section'  => 'shopix_main_header_styling',
		)
	)
);

$wp_customize->add_setting(
	'middle_header_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'middle_header_color',
		array(
			'label'    => esc_html__( 'Text color (logo bar)', 'shopix' ),
			'section'  => 'shopix_main_header_styling',
		)
	)
);

$wp_customize->add_setting(
	'bottom_header_background_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'bottom_header_background_color',
		array(
			'label'    => esc_html__( 'Background color (menu bar)', 'shopix' ),
			'section'  => 'shopix_main_header_styling',
			'active_callback'	=> 'shopix_bottom_header_bar_callback'
		)
	)
);

$wp_customize->add_setting(
	'bottom_header_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'bottom_header_color',
		array(
			'label'    			=> esc_html__( 'Text color (menu bar)', 'shopix' ),
			'section'  			=> 'shopix_main_header_styling',
			'active_callback'	=> 'shopix_bottom_header_bar_callback'
		)
	)
);

$wp_customize->add_setting(
	'bottom_header_border_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'bottom_header_border_color',
		array(
			'label'    			=> esc_html__( 'Menu bar top border color', 'shopix' ),
			'section'  			=> 'shopix_main_header_styling',
			'active_callback'	=> 'shopix_bottom_header_bar_callback'
		)
	)
);

/**
 * Header image
 */
$wp_customize->add_setting(
	'header_image_front_page',
	array(
		'default'           => 0,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'header_image_front_page',
		array(
			'label'         	=> esc_html__( 'Show the header image on your static front page', 'shopix' ),
			'description'      	=> esc_html__( 'By default, the header image is shown only on your blog page.', 'shopix' ),
			'section'       	=> 'header_image',
		)
	)
);