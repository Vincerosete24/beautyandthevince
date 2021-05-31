<?php
/**
 * Class to handle post items on all types of archives
 *
 * @package Shopix
 */


if ( !class_exists( 'Shopix_Post_Item' ) ) :

	/**
	 * Shopix_Post_Item 
	 */
	Class Shopix_Post_Item {

		/**
		 * Instance
		 */		
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {		
			add_action( 'shopix_post_item_content', array( $this, 'render_post_elements' ) );
		}

		/**
		 * Build post item
		 */
		public function render_post_elements( $layout_type ) {

			$elements = get_theme_mod( 'post_item_elements', $this->get_default_elements() );

			if ( 'is-list' === $layout_type ) {
				$elements = array_diff( $elements, array( 'loop_image' ) );
			}

			foreach( $elements as $element ) {
				call_user_func( array( $this, $element ), $layout_type );
			}
		}

		/**
		 * Default elements for the post item
		 */
		public function get_default_elements() {
			return array( 'loop_image', 'loop_category', 'loop_post_title', 'loop_post_excerpt', 'loop_post_meta' );
		}

		/**
		 * Post element: image
		 */
		public function loop_image() {

			if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
				return;
			}

			$blog_layout = $this->blog_layout();
						
			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail( 'shopix-500x500', array(
						'alt' => the_title_attribute( array(
							'echo' => false,
						) ),
					) );					
				?>
			</a>
			<?php
		}

		/**
		 * Post element: title
		 */
		public function loop_post_title() {
			?>
			<header class="entry-header post-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</header><!-- .entry-header -->
			<?php
		}	
		
		/**
		 * Post element: first category
		 */
		public function loop_category() {
			?>
			<div class="post-cats"><?php shopix_entry_categories(); ?></div>
			<?php
		}	
		
		/**
		 * Post element: meta
		 */
		public function loop_post_meta() {
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<div class="row v-align">
						<div class="col-9">
							<?php shopix_post_date_author(); ?>
						</div>
						<div class="col-3">
							<?php shopix_entry_comments(); ?>
						</div>		
					</div>				
				</div><!-- .entry-meta -->
			<?php endif;
		}	
		
		/**
		 * Post element: excerpt
		 */
		public function loop_post_excerpt( $layout_type ) {

			$read_more_text = get_theme_mod( 'read_more_text', esc_html__( 'Read more', 'shopix' ) );
			?>
			<div class="entry-summary">
				<?php

				the_excerpt(); 
	
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shopix' ),
					'after'  => '</div>',
				) );
				?>
				<a class="read-more-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php echo esc_html( $read_more_text ); ?></a>
			</div><!-- .entry-content -->
			<?php
		}

		/**
		 * Blog layout
		 */
		public function blog_layout() {
			$blog_layout = get_theme_mod( 'blog_layout', 'grid' );

			return $blog_layout;
		}
	}

	/**
	 * Initialize class
	 */
	Shopix_Post_Item::get_instance();

endif;