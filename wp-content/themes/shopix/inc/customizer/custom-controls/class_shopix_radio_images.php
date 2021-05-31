<?php
/**
 * Radio images
 * 
 * based on https://gist.github.com/justintadlock/2a9e3312a6fe10e8dc28
 *
 * @package Shopix
 */

class Shopix_Radio_Images extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 */
	public $type = 'shopix-radio-image';

	public function render_content() {

		/* If no choices are provided, bail. */
		if ( empty( $this->choices ) )
			return; ?>

		<?php if ( !empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( !empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>

		<div id="<?php echo esc_attr( "input_{$this->id}" ); ?>">

			<?php foreach ( $this->choices as $value => $args ) : ?>

				<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( "_customize-radio-{$this->id}" ); ?>" id="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $value ); ?> /> 

				<label for="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>">
					<span class="screen-reader-text"><?php echo esc_html( $args['label'] ); ?></span>
					<img class="small-image" src="<?php echo esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" title="<?php echo esc_attr( $args['label'] ); ?>" alt="<?php echo esc_attr( $args['label'] ); ?>" />
					<img class="large-image" src="<?php echo esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" title="<?php echo esc_attr( $args['label'] ); ?>" alt="<?php echo esc_attr( $args['label'] ); ?>" />
				</label>

			<?php endforeach; ?>

		</div><!-- .image -->

		<script type="text/javascript">
			jQuery( document ).ready( function() {
				jQuery( '#<?php echo esc_attr( "input_{$this->id}" ); ?>' ).buttonset();
			} );
		</script>
	<?php }

	/**
	 * Loads the jQuery UI Button script and hooks our custom styles in.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-button' );

		add_action( 'customize_controls_print_styles', array( $this, 'print_styles' ) );
	}

	/**
	 * Outputs custom styles to give the selected image a visible border.
	 */
	public function print_styles() { ?>

		<style type="text/css" id="customize-shopix-radio-image-css">
			.customize-control-shopix-radio-image label { position: relative;}
			.customize-control-shopix-radio-image .small-image { border: 2px solid transparent;opacity:0.4; transition: opacity 0.2s;}
			.customize-control-shopix-radio-image .small-image:hover { opacity:1; }
			.customize-control-shopix-radio-image .ui-state-active .small-image { border-color: #00a0d2;opacity:1; }
			.customize-control-shopix-radio-image .large-image { display: none;}
			.customize-control-shopix-radio-image label:hover .large-image { display: block !important; position: fixed; left: 370px; box-shadow: 0 0 30px rgba(0,0,0,0.3); max-width: 600px !important; }
		</style>
	<?php }
}