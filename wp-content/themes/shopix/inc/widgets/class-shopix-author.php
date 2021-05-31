<?php
/**
 * Author widget
 *
 * @package Shopix
 */

 class Shopix_Author extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( 'Automatically display author image, name and bio for the current author.', 'shopix' ) );
		parent::__construct( 'shopix-author-widget', __( 'ER: Author Profile', 'shopix' ), $widget_ops );
	}

	function widget($args, $instance) {
		

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		?>
		<?php
		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		?>
		<?php
		
			$author = get_the_author();
			if ( $author ) {
			?>
			<div class="author_wrap">
				<div class="author_avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 260 ); ?>
				</div>
				<h4 class="author_name"><?php the_author(); ?></h4>
				<p class="author_bio"><?php echo nl2br( get_the_author_meta('description') ); ?></p>
			</div>
			<?php
			}
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$title 		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'shopix' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
		</p>
		<p><em><?php esc_html_e( 'No configuration required. This widget will automatically display your avatar, name and bio.', 'shopix' ); ?></em></p>
		<?php
	}
}