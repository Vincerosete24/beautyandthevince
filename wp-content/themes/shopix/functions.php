<?php
/**
 * Shopix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shopix
 */

if ( ! defined( 'SHOPIX_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'SHOPIX_VERSION', '1.0.5' );
}

if ( ! function_exists( 'shopix_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shopix_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Shopix, use a find and replace
		 * to change 'shopix' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shopix', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'shopix-900x9999', 900, 9999 );
		add_image_size( 'shopix-500x9999', 500, 9999 );
		add_image_size( 'shopix-500x500', 500, 500, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'top-menu' => esc_html__( 'Top menu', 'shopix' ),
				'primary-menu' => esc_html__( 'Primary menu', 'shopix' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'shopix_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Wide alignments
		 *
		 */		
		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'shopix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shopix_content_width() {
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound	
	$GLOBALS['content_width'] = apply_filters( 'shopix_content_width', 1340 );
}
add_action( 'after_setup_theme', 'shopix_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shopix_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'shopix' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'shopix' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	if ( class_exists( 'Woocommerce' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Shopix: WooCommerce filters', 'shopix' ),
				'id'            => 'shopix-shop-filters',
				'description'   => esc_html__( 'Add filter widgets here.', 'shopix' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	register_widget( 'Shopix_Author' );
	register_widget( 'Shopix_Recent_Posts' );

}
add_action( 'widgets_init', 'shopix_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shopix_scripts() {

	wp_enqueue_style( 'shopix-fonts', shopix_generate_fonts_url(), array(), SHOPIX_VERSION );

	wp_enqueue_style( 'shopix-style', get_stylesheet_uri(), array(), SHOPIX_VERSION );

	wp_enqueue_style( 'shopix-style-min', get_template_directory_uri() . '/assets/css/styles.min.css', array(), SHOPIX_VERSION );

	wp_enqueue_script( 'shopix-functions', get_template_directory_uri() . '/assets/js/functions.min.js', array(), SHOPIX_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shopix_scripts' );

/**
 * Gutenberg assets
 */
function shopix_block_editor_styles() {
    // Enqueue the editor styles.
    wp_enqueue_style( 'shopix-block-editor-styles', get_template_directory_uri() . '/assets/css/editor-styles.min.css','','20210120','');
}
add_action( 'enqueue_block_editor_assets', 'shopix_block_editor_styles' );

/**
 * Disable Elementor default schemes
 */
function shopix_set_elementor_defaults() {
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
	update_option( 'elementor_container_width', 1370 );
}
add_action( 'after_switch_theme', 'shopix_set_elementor_defaults' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/callbacks.php';

/**
 * Header
 */
require get_template_directory() . '/inc/class_shopix_header.php';

/**
 * Gutenberg custom styles
 */
require get_template_directory() . '/inc/editor-styles.php';

/**
 * Single page/post
 */
require get_template_directory() . '/inc/class_shopix_single_post_page.php';

/**
 * Single page metabox
 */
require get_template_directory() . '/inc/class_shopix_page_metabox.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Onboarding
 */
require get_template_directory() . '/inc/onboarding/class_shopix_install_plugins.php';
require get_template_directory() . '/inc/onboarding/class_shopix_theme_page.php';

/**
 * Classes
 */
require get_template_directory() . '/inc/class_shopix_loop_post.php';
require get_template_directory() . '/inc/class_shopix_svg_icons.php';
require get_template_directory() . '/inc/class_shopix_custom_css.php';
require get_template_directory() . '/inc/class_shopix_footer.php';
require get_template_directory() . '/inc/compatibility/elementor/class_shopix_elementor.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/class-shopix-author.php';
require get_template_directory() . '/inc/widgets/class-shopix-recent-posts.php';

/**
 * Admin notice
 */
require get_template_directory() . '/inc/onboarding/notices/persist-admin-notices-dismissal.php';

function shopix_welcome_admin_notice() {

	if ( ! PAnD::is_admin_notice_active( 'shopix-welcome-forever' ) ) {
		return;
	}

	$theme = wp_get_theme();
	
	?>
	<div data-dismissible="shopix-welcome-forever" class="shopix-admin-notice notice notice-info is-dismissible">

		<h3><?php echo esc_html( /* translators: %s: theme name */ sprintf( __( 'Welcome to %s', 'shopix' ), $theme->name ) ); ?><span class="theme-version"><?php echo esc_html( $theme->version ); ?></span></h3>
		<p style="margin-bottom:20px;"><?php echo esc_html__( 'Click the button below to install our starter site plugin and import premade demos.', 'shopix' ); ?></p>
		<?php Shopix_Install_Plugins::instance()->do_plugin_install(); ?>
		<a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=shopix-theme.php' ) ); ?>"><?php esc_html_e( 'Theme Dashboard', 'shopix' ); ?></a>

	</div>
	<?php
}
add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'shopix_welcome_admin_notice' );

/**
 * Autoloader
 */
require_once get_parent_theme_file_path( 'vendor/autoload.php' );

/**
 * Review notice
 */
require get_template_directory() . '/inc/class_shopix_theme_review_notice.php';