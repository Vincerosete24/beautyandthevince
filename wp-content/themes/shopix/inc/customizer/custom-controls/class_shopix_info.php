<?php
/**
 * Info control
 *
 * @package Shopix
 */

class Shopix_Info extends WP_Customize_Control {
	public $type = 'shopix-info';
	public $label = '';
	public $description = '';
	public $attr = '';

	public function render_content() {
	?>
		<?php if ( $this->label ) : ?>
			<?php if ( '' === $this->attr ) : ?>
			<p class="shopix-customizer-info"><?php echo wp_kses_post( $this->label ); ?></p>
			<?php else : ?>
				<p><?php echo $this->label; ?></p>
			<?php endif; ?>
		<?php endif; ?>
	<?php
	}
}   