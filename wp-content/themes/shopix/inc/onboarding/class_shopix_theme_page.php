<?php
/**
 * Theme page
 *
 */

class Shopix_Theme_Page {
	/**
	 * Instance of class.
	 *
	 * @var bool $instance instance variable.
	 */
	private static $instance;

	/**
	 * Check if instance already exists.
	 *
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Main ) ) {
			self::$instance = new Shopix_Theme_Page();
		}

		return self::$instance;
	}

	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'admin_menu', __CLASS__ . '::theme_page', 99 );

	}	

	/**
	 * Theme page
	 */
	public static function theme_page() {
		$theme_page = add_theme_page( esc_html__( 'Shopix theme', 'shopix' ), esc_html__( 'Shopix theme', 'shopix' ), 'edit_theme_options', 'shopix-theme.php', __CLASS__ . '::markup' );
		add_action( 'load-' . $theme_page, __CLASS__ . '::theme_page_styles' );
	}	

	/**
	 * Theme page markup
	 */
	public static function markup() {
		if ( !current_user_can( 'edit_theme_options' ) )  {
			wp_die( esc_html__( 'You do not have the right to view this page', 'shopix' ) );
		}

		$theme = wp_get_theme();

		?>
		<div class="shopix-theme-page">
			<div class="theme-page-header">
				<div class="theme-page-container">
					<h2>Shopix</h2><span class="theme-version"><?php echo esc_html( $theme->version ); ?></span>
				</div>
			</div>
			<div class="theme-page-container">
				<div class="theme-page-content">
					<div class="theme-grid">
						<div class="grid-item">
							<h3><span class="dashicons dashicons-admin-page"></span><?php echo esc_html__( 'Starter sites', 'shopix' ); ?></h3>
							<p><?php echo esc_html__( 'Looking for a quick start? You can import one of our premade demos.', 'shopix' ); ?></p>
							<?php Shopix_Install_Plugins::instance()->do_plugin_install(); ?>
						</div>
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-book-alt"></span><?php echo esc_html__( 'Documentation', 'shopix' ); ?></h3>
							<p><?php echo esc_html__( 'Our documentation can help you learn how to use the Shopix WordPress theme.', 'shopix' ); ?></p>
							<a class="button" href="https://elfwp.com/documentation/shopix/" target="_blank"><?php echo esc_html__( 'See the documentation', 'shopix' ); ?></a>
						</div>
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-sos"></span><?php echo esc_html__( 'Need help?', 'shopix' ); ?></h3>
							<p><?php echo esc_html__( 'Are you stuck? No problem! Send us a message and we\'ll be happy to help you.', 'shopix' ); ?></p>
							<a class="button" href="https://elfwp.com/support/" target="_blank"><?php echo esc_html__( 'Contact support', 'shopix' ); ?></a>
						</div>
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-welcome-write-blog"></span><?php echo esc_html__( 'Changelog', 'shopix' ); ?></h3>
							<p><?php echo esc_html__( 'Read our changelog and see what recent changes we\'ve implemented in Shopix', 'shopix' ); ?></p>
							<a class="button" href="https://elfwp.com/changelog/shopix/" target="_blank"><?php echo esc_html__( 'See the changelog', 'shopix' ); ?></a>
						</div>	
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-format-image"></span><?php echo esc_html__( 'Upload your logo', 'shopix' ); ?></h3>
							<p><?php echo esc_html__( 'Use this option to add a logo image to your menu bar.', 'shopix' ); ?></p>
							<a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=custom_logo' ) ); ?>"><?php esc_html_e( 'Upload your logo', 'shopix' ); ?></a>
						</div>
						
						<div class="grid-item">
							<h3><span class="dashicons dashicons-admin-customizer"></span><?php echo esc_html__( 'Change colors', 'shopix' ); ?></h3>
							<p><?php echo esc_html__( 'Explore the color options and make your website your own.', 'shopix' ); ?></p>
							<a class="button" href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=colors' ) ); ?>"><?php esc_html_e( 'Change colors', 'shopix' ); ?></a>
						</div>	
					</div>					
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Theme page styles and scripts
	 */
	public static function theme_page_styles() {
		add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles' );
	}

	/**
	 * Styles
	 */
	public static function styles( $hook ) {

		if ( 'appearance_page_shopix-theme' != $hook ) {
			return;
		}

		wp_enqueue_style( 'shopix-theme-page-styles', get_template_directory_uri() . '/inc/onboarding/assets/css/theme-page.min.css', array(), SHOPIX_VERSION );
	}	

}

$shopix_theme_page = new Shopix_Theme_Page();