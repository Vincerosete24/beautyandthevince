<?php
/**
 * Typography Customizer options
 *
 * @package Shopix
 */

/**
 * Body
 */

$wp_customize->add_panel(
	'shopix_typography',
	array(
		'title'         => esc_html__( 'Typography', 'shopix'),
		'priority'      => 11,
	)
); 

//Family
$wp_customize->add_section(
	'shopix_section_typography_body',
	array(
		'title'         => esc_html__( 'Body', 'shopix'),
		'panel'         => 'shopix_typography',
	)
);
$wp_customize->add_setting( 'shopix_body_font',
    array(
        'default'           => '{"font":"System default","regularweight":"regular","italicweight":"italic","boldweight":"bold","category":"sans-serif"}',
        'sanitize_callback' => 'shopix_google_fonts_sanitize',
    )
);
$wp_customize->add_control( new Shopix_Typography_Control( $wp_customize, 'shopix_body_font',
    array(
        'label' => esc_html__( 'Body font', 'shopix' ),
        'section' => 'shopix_section_typography_body',
        'input_attrs' => array(
            'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
        ),
    )
) );

//Font size
$wp_customize->add_setting( 'body_font_size_desktop', array(
	'default'   => 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'body_font_size_tablet', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'body_font_size_mobile', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'body_font_size',
	array(
		'label' => esc_html__( 'Font size', 'shopix' ),
		'section' => 'shopix_section_typography_body',
		'settings'   => array (
			'body_font_size_desktop',
			'body_font_size_tablet',
			'body_font_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

//Line height
$wp_customize->add_setting( 'body_line_height',
	array(
		'default' 			=> 1.76,
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'body_line_height',
	array(
		'label' => esc_html__( 'Line height', 'shopix' ),
		'section' => 'shopix_section_typography_body',
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'step' => 0.05,
		),
	)
) );

//Letter spacing
$wp_customize->add_setting( 'body_letter_spacing',
	array(
		'default' 			=> 0,
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'body_letter_spacing',
	array(
		'label' => esc_html__( 'Letter spacing [px]', 'shopix' ),
		'section' => 'shopix_section_typography_body',
		'input_attrs' => array(
			'min' => 0,
			'max' => 5,
			'step' => 0.5,
		),
	)
) );


/**
 * Headings
 */

//Family
$wp_customize->add_section(
	'shopix_section_typography_headings',
	array(
		'title'         => esc_html__( 'Headings', 'shopix'),
		'panel'         => 'shopix_typography',
	)
);

$wp_customize->add_setting(
	'title_typography_headings',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_typography_headings',
	array(
		'label'    => esc_html__( 'All headings', 'shopix' ),
		'section'  => 'shopix_section_typography_headings',
	)
) );

$wp_customize->add_setting( 'shopix_headings_font',
    array(
        'default'           => '{"font":"System default","regularweight":"regular","italicweight":"italic","boldweight":"bold","category":"sans-serif"}',
        'sanitize_callback' => 'shopix_google_fonts_sanitize',
    )
);
$wp_customize->add_control( new Shopix_Typography_Control( $wp_customize, 'shopix_headings_font',
    array(
        'label' => esc_html__( 'Headings font', 'shopix' ),
        'section' => 'shopix_section_typography_headings',
        'input_attrs' => array(
            'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => true,
        ),
    )
) );

//Line height
$wp_customize->add_setting( 'headings_line_height',
	array(
		'default' 			=> 1.2,
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'headings_line_height',
	array(
		'label' => esc_html__( 'Line height', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'step' => 0.05,
		),
	)
) );

//Letter spacing
$wp_customize->add_setting( 'headings_letter_spacing',
	array(
		'default' 			=> 0,
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'headings_letter_spacing',
	array(
		'label' => esc_html__( 'Letter spacing [px]', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 5,
			'step' => 0.5,
		),
	)
) );

/**
 * H1 heading
 */
$wp_customize->add_setting(
	'title_typography_h1_heading',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_typography_h1_heading',
	array(
		'label'    => esc_html__( 'H1 Heading', 'shopix' ),
		'section'  => 'shopix_section_typography_headings',
	)
) );

//Font size
$wp_customize->add_setting( 'h1_heading_font_size_desktop', array(
	'default'   => 40,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h1_heading_font_size_tablet', array(
	'default'	=> 36,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h1_heading_font_size_mobile', array(
	'default'	=> 28,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'h1_heading_font_size',
	array(
		'label' => esc_html__( 'Font size', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'settings'   => array (
			'h1_heading_font_size_desktop',
			'h1_heading_font_size_tablet',
			'h1_heading_font_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

//Line height
$wp_customize->add_setting( 'h1_heading_line_height',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h1_heading_line_height',
	array(
		'label' => esc_html__( 'Line height', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'step' => 0.05,
		),
	)
) );

//Letter spacing
$wp_customize->add_setting( 'h1_letter_spacing',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h1_letter_spacing',
	array(
		'label' => esc_html__( 'Letter spacing [px]', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 5,
			'step' => 0.5,
		),
	)
) );


/**
 * h2 heading
 */
$wp_customize->add_setting(
	'title_typography_h2_heading',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_typography_h2_heading',
	array(
		'label'    => esc_html__( 'H2 Heading', 'shopix' ),
		'section'  => 'shopix_section_typography_headings',
	)
) );

//Font size
$wp_customize->add_setting( 'h2_heading_font_size_desktop', array(
	'default'   => 32,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h2_heading_font_size_tablet', array(
	'default'	=> 28,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h2_heading_font_size_mobile', array(
	'default'	=> 22,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'h2_heading_font_size',
	array(
		'label' => esc_html__( 'Font size', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'settings'   => array (
			'h2_heading_font_size_desktop',
			'h2_heading_font_size_tablet',
			'h2_heading_font_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

//Line height
$wp_customize->add_setting( 'h2_heading_line_height',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h2_heading_line_height',
	array(
		'label' => esc_html__( 'Line height', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'step' => 0.05,
		),
	)
) );

//Letter spacing
$wp_customize->add_setting( 'h2_letter_spacing',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h2_letter_spacing',
	array(
		'label' => esc_html__( 'Letter spacing [px]', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 5,
			'step' => 0.5,
		),
	)
) );

/**
 * h3 heading
 */
$wp_customize->add_setting(
	'title_typography_h3_heading',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_typography_h3_heading',
	array(
		'label'    => esc_html__( 'H3 Heading', 'shopix' ),
		'section'  => 'shopix_section_typography_headings',
	)
) );

//Font size
$wp_customize->add_setting( 'h3_heading_font_size_desktop', array(
	'default'   => 28,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h3_heading_font_size_tablet', array(
	'default'	=> 24,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h3_heading_font_size_mobile', array(
	'default'	=> 18,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'h3_heading_font_size',
	array(
		'label' => esc_html__( 'Font size', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'settings'   => array (
			'h3_heading_font_size_desktop',
			'h3_heading_font_size_tablet',
			'h3_heading_font_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

//Line height
$wp_customize->add_setting( 'h3_heading_line_height',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h3_heading_line_height',
	array(
		'label' => esc_html__( 'Line height', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'step' => 0.05,
		),
	)
) );

//Letter spacing
$wp_customize->add_setting( 'h3_letter_spacing',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h3_letter_spacing',
	array(
		'label' => esc_html__( 'Letter spacing [px]', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 5,
			'step' => 0.5,
		),
	)
) );

/**
 * h4 heading
 */
$wp_customize->add_setting(
	'title_typography_h4_heading',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_typography_h4_heading',
	array(
		'label'    => esc_html__( 'H4 Heading', 'shopix' ),
		'section'  => 'shopix_section_typography_headings',
	)
) );

//Font size
$wp_customize->add_setting( 'h4_heading_font_size_desktop', array(
	'default'   => 24,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h4_heading_font_size_tablet', array(
	'default'	=> 20,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h4_heading_font_size_mobile', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'h4_heading_font_size',
	array(
		'label' => esc_html__( 'Font size', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'settings'   => array (
			'h4_heading_font_size_desktop',
			'h4_heading_font_size_tablet',
			'h4_heading_font_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

//Line height
$wp_customize->add_setting( 'h4_heading_line_height',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h4_heading_line_height',
	array(
		'label' => esc_html__( 'Line height', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'step' => 0.05,
		),
	)
) );

//Letter spacing
$wp_customize->add_setting( 'h4_letter_spacing',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h4_letter_spacing',
	array(
		'label' => esc_html__( 'Letter spacing [px]', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 5,
			'step' => 0.5,
		),
	)
) );

/**
 * h5 heading
 */
$wp_customize->add_setting(
	'title_typography_h5_heading',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_typography_h5_heading',
	array(
		'label'    => esc_html__( 'H5 Heading', 'shopix' ),
		'section'  => 'shopix_section_typography_headings',
	)
) );

//Font size
$wp_customize->add_setting( 'h5_heading_font_size_desktop', array(
	'default'   => 20,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h5_heading_font_size_tablet', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h5_heading_font_size_mobile', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'h5_heading_font_size',
	array(
		'label' => esc_html__( 'Font size', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'settings'   => array (
			'h5_heading_font_size_desktop',
			'h5_heading_font_size_tablet',
			'h5_heading_font_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

//Line height
$wp_customize->add_setting( 'h5_heading_line_height',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h5_heading_line_height',
	array(
		'label' => esc_html__( 'Line height', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'step' => 0.05,
		),
	)
) );

//Letter spacing
$wp_customize->add_setting( 'h5_letter_spacing',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h5_letter_spacing',
	array(
		'label' => esc_html__( 'Letter spacing [px]', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 5,
			'step' => 0.5,
		),
	)
) );

/**
 * h6 heading
 */
$wp_customize->add_setting(
	'title_typography_h6_heading',
	array(
		'sanitize_callback' => 'esc_html',
	)
);
$wp_customize->add_control( new Shopix_Title( $wp_customize, 'title_typography_h6_heading',
	array(
		'label'    => esc_html__( 'H6 Heading', 'shopix' ),
		'section'  => 'shopix_section_typography_headings',
	)
) );

//Font size
$wp_customize->add_setting( 'h6_heading_font_size_desktop', array(
	'default'   => 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h6_heading_font_size_tablet', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h6_heading_font_size_mobile', array(
	'default'	=> 16,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'h6_heading_font_size',
	array(
		'label' => esc_html__( 'Font size', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'settings'   => array (
			'h6_heading_font_size_desktop',
			'h6_heading_font_size_tablet',
			'h6_heading_font_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

//Line height
$wp_customize->add_setting( 'h6_heading_line_height',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h6_heading_line_height',
	array(
		'label' => esc_html__( 'Line height', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'step' => 0.05,
		),
	)
) );

//Letter spacing
$wp_customize->add_setting( 'h6_letter_spacing',
	array(
		'default' 			=> '',
		'transport' 		=> 'postMessage',
		'sanitize_callback' => 'shopix_sanitize_range'
	)
);
$wp_customize->add_control( new Shopix_Slider_Control( $wp_customize, 'h6_letter_spacing',
	array(
		'label' => esc_html__( 'Letter spacing [px]', 'shopix' ),
		'section' => 'shopix_section_typography_headings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 5,
			'step' => 0.5,
		),
	)
) );