<?php
/**
 * Blog Customizer options
 *
 * @package Shopix
 */

$wp_customize->add_panel( 'shopix_panel_blog', array(
	'priority'       => 19,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Blog', 'shopix' ),
) );

/**
 * Archives
 */
$wp_customize->add_section(
	'shopix_section_blog_archives',
	array(
		'title'         => esc_html__( 'Blog archives', 'shopix'),
		'priority'      => 11,
		'panel'         => 'shopix_panel_blog',
	)
);

$wp_customize->add_setting(
	'blog_layout',
	array(
		'default'           => 'grid',
		'sanitize_callback' => 'shopix_sanitize_select',
	)
);
$wp_customize->add_control(
	'blog_layout',
	array(
		'type'      		=> 'select',
		'label'     		=> esc_html__( 'Blog layout', 'shopix' ),
		'section'   		=> 'shopix_section_blog_archives',
		'choices'   		=> array(
			'grid'	=> esc_html__( '2 columns and sidebar', 'shopix' ),
			'list'	=> esc_html__( 'List', 'shopix' ),
		)
	)
);

$wp_customize->add_setting( 'post_item_elements', array(
	'default'  => array( 'loop_image', 'loop_category', 'loop_post_title', 'loop_post_excerpt', 'loop_post_meta' ),
	'sanitize_callback'	=> 'shopix_sanitize_blog_post_elements'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'post_item_elements', array(
	'label'   		=> esc_html__( 'Post elements', 'shopix' ),
	'description'   => esc_html__( 'Drag and drop to rearrange the post elements. Click the eye icon to disable', 'shopix' ),
	'section' => 'shopix_section_blog_archives',
	'choices' => array(
		'loop_image' 		=> esc_html__( 'Featured image', 'shopix' ),
		'loop_category' 	=> esc_html__( 'Post category', 'shopix' ),
		'loop_post_title' 	=> esc_html__( 'Post title', 'shopix' ),
		'loop_post_excerpt' => esc_html__( 'Post excerpt', 'shopix' ),
		'loop_post_meta' 	=> esc_html__( 'Post meta', 'shopix' ),
	),
) ) );

$wp_customize->add_setting(
	'posts_navigation',
	array(
		'default'           => 'pagination',
		'sanitize_callback' => 'shopix_sanitize_posts_navigation',
	)
);
$wp_customize->add_control(
	'posts_navigation',
	array(
		'type'      => 'select',
		'label'     => esc_html__( 'Posts navigation', 'shopix' ),
		'section'   => 'shopix_section_blog_archives',
		'choices'   => array(
			'pagination' => esc_html__( 'Pagination', 'shopix' ),
			'navigation' => esc_html__( 'Older/Newer posts links', 'shopix' ),
		),
	)
);  

$wp_customize->add_setting(
	'excerpt_length',
	array(
		'sanitize_callback' => 'absint',
		'default'           => 15,
	)       
);
$wp_customize->add_control( 'excerpt_length', array(
	'type'        => 'number',
	'section'     => 'shopix_section_blog_archives',
	'label'       => esc_html__( 'Excerpt length', 'shopix' ),
	'input_attrs' => array(
		'min'   => 0,
		'max'   => 200,
		'step'  => 1,
	),
) );

$wp_customize->add_setting(
	'read_more_text',
	array(
		'sanitize_callback' => 'shopix_sanitize_text',
		'default'           => esc_html__( 'Read more text', 'shopix' ),
	)       
);
$wp_customize->add_control( 'read_more_text', array(
	'type'        => 'text',
	'section'     => 'shopix_section_blog_archives',
	'label'       => esc_html__( 'Read more text', 'shopix' ),
) );

//Large archive titles font size
$wp_customize->add_setting( 'archive_titles_size_desktop', array(
	'default'   => 26,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'archive_titles_size_tablet', array(
	'default'	=> 26,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'archive_titles_size_mobile', array(
	'default'	=> 22,
	'transport'	=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Shopix_Responsive_Number( $wp_customize, 'archive_titles_size',
	array(
		'label' => esc_html__( 'Post titles size', 'shopix' ),
		'section' => 'shopix_section_blog_archives',
		'settings'   => array (
			'archive_titles_size_desktop',
			'archive_titles_size_tablet',
			'archive_titles_size_mobile'
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 250,
			'step'  => 1,
		),		
	)
) );

/**
 * Singles
 */
$wp_customize->add_section(
	'shopix_section_blog_singles',
	array(
		'title'         => esc_html__( 'Single posts', 'shopix'),
		'priority'      => 11,
		'panel'         => 'shopix_panel_blog',
	)
);
$wp_customize->add_setting(
	'single_post_layout',
	array(
		'default'           => 'has-sidebar',
		'sanitize_callback' => 'shopix_sanitize_select',
	)
);
$wp_customize->add_control(
	'single_post_layout',
	array(
		'type'      		=> 'select',
		'label'     		=> esc_html__( 'Single post layout', 'shopix' ),
		'section'   		=> 'shopix_section_blog_singles',
		'choices'   		=> array(
			'has-sidebar'		=> esc_html__( 'With sidebar', 'shopix' ),
			'no-sidebar'		=> esc_html__( 'No sidebar', 'shopix' ),
		)
	)
);

$wp_customize->add_setting(
	'single_post_header_alignment',
	array(
		'default'           => 'left',
		'sanitize_callback' => 'shopix_sanitize_select',
	)
);
$wp_customize->add_control(
	'single_post_header_alignment',
	array(
		'type'      		=> 'select',
		'label'     		=> esc_html__( 'Post header alignment', 'shopix' ),
		'section'   		=> 'shopix_section_blog_singles',
		'choices'   		=> array(
			'left'		=> esc_html__( 'Left', 'shopix' ),
			'center'	=> esc_html__( 'Center', 'shopix' ),
			'right'		=> esc_html__( 'Right', 'shopix' ),
		)
	)
);

$wp_customize->add_setting(
	'single_post_enable_featured',
	array(
		'default'           => true,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'single_post_enable_featured',
		array(
			'label'         	=> esc_html__( 'Display the featured image', 'shopix' ),
			'section'       	=> 'shopix_section_blog_singles',
			'settings'      	=> 'single_post_enable_featured',
		)
	)
);

$wp_customize->add_setting(
	'single_post_enable_meta',
	array(
		'default'           => true,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'single_post_enable_meta',
		array(
			'label'         	=> esc_html__( 'Display author and post date', 'shopix' ),
			'section'       	=> 'shopix_section_blog_singles',
			'settings'      	=> 'single_post_enable_meta',
		)
	)
);

$wp_customize->add_setting(
	'single_post_enable_cats',
	array(
		'default'           => true,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'single_post_enable_cats',
		array(
			'label'         	=> esc_html__( 'Display the post categories', 'shopix' ),
			'section'       	=> 'shopix_section_blog_singles',
			'settings'      	=> 'single_post_enable_cats',
		)
	)
);

$wp_customize->add_setting(
	'single_post_enable_tags',
	array(
		'default'           => true,
		'sanitize_callback' => 'shopix_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Shopix_Toggle_Control(
		$wp_customize,
		'single_post_enable_tags',
		array(
			'label'         	=> esc_html__( 'Display the post tags', 'shopix' ),
			'section'       	=> 'shopix_section_blog_singles',
			'settings'      	=> 'single_post_enable_tags',
		)
	)
);