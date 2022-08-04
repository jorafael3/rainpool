<?php
defined( 'ABSPATH' ) || exit;

function wpiw_widget() {
	register_widget( 'Enovathemes_Addons_WP_Widget_Instagram' );
}
add_action( 'widgets_init', 'wpiw_widget' );

Class Enovathemes_Addons_WP_Widget_Instagram extends WP_Widget {

	function __construct() {
		parent::__construct(
			'instagram',
			esc_html__('* Instagram', 'enovathemes-addons'),
			array( 'description' => esc_html__('Displays your latest Instagram photos', 'enovathemes-addons'))
		);
	}

	function widget( $args, $instance ) {

		$title          = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username       = empty( $instance['username'] ) ? '' : $instance['username'];
		$limit          = empty( $instance['number'] ) ? 9 : $instance['number'];
		$target         = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$link           = empty( $instance['link'] ) ? '' : $instance['link'];
		$columns_mob    = isset($instance['columns_mob']) ? esc_attr($instance['columns_mob']) : "";
		$columns_tablet = isset($instance['columns_tablet']) ? esc_attr($instance['columns_tablet']) : "";
		$columns_desk   = isset($instance['columns_desk']) ? esc_attr($instance['columns_desk']) : "";

		echo $args['before_widget'];

		if ( ! empty( $title ) ) { echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title']; };


		if ( '' !== $username ) {
			echo '<ul class="instagram-image-list columns-mob-'.esc_attr($columns_mob).' columns-tablet-'.esc_attr($columns_tablet).' columns-desk-'.esc_attr($columns_desk).'" data-username="'.esc_attr($username).'" data-limit="'.esc_attr($limit).'">';
			echo '</ul>';
		}

		switch ( substr( $username, 0, 1 ) ) {
			case '#':
				$url = '//instagram.com/explore/tags/' . str_replace( '#', '', $username );
				break;

			default:
				$url = '//instagram.com/' . str_replace( '@', '', $username );
				break;
		}

		if ( '' !== $link ) {
			?><p class="et-clearfix"><a href="<?php echo trailingslashit( esc_url( $url ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php echo wp_kses_post( $link ); ?></a></p><?php
		}


		echo $args['after_widget'];
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array(
			'title'          => esc_html__( 'Instagram', 'enovathemes-addons' ),
			'link'           => esc_html__( 'Follow Me!', 'enovathemes-addons' ),
			'username'       => '',
			'number'         => 9,
			'target'         => '_self',
			'columns_mob'    => '1',
	 		'columns_tablet' => '1',
	 		'columns_desk'   => '1',
		) );

			$title          = $instance['title'];
			$username       = $instance['username'];
			$number         = absint( $instance['number'] );
			$target         = $instance['target'];
			$link           = $instance['link'];
			$columns_mob    = $instance['columns_mob'];
			$columns_tablet = $instance['columns_tablet'];
			$columns_desk   = $instance['columns_desk'];
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'enovathemes-addons' ); ?>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( '@username or #tag:', 'enovathemes-addons' ); ?>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos:', 'enovathemes-addons' ); ?>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in:', 'enovathemes-addons' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">
				<option value="_self" <?php selected( '_self', $target ); ?>><?php esc_html_e( 'Current window (_self)', 'enovathemes-addons' ); ?></option>
				<option value="_blank" <?php selected( '_blank', $target ); ?>><?php esc_html_e( 'New window (_blank)', 'enovathemes-addons' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link text:', 'enovathemes-addons' ); ?>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'columns_mob' ); ?>"><?php echo esc_html__( 'Columns mobile:', 'enovathemes-addons' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'columns_mob' ); ?>" name="<?php echo $this->get_field_name( 'columns_mob' ); ?>" >
            	<?php for ($i=1; $i < 11; $i++) { ?>
            		<option value="<?php echo $i; ?>" <?php selected( $instance['columns_mob'], $i ); ?>><?php echo esc_html__($i,'enovathemes-addons'); ?></option>
            	<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'columns_tablet' ); ?>"><?php echo esc_html__( 'Columns tablet:', 'enovathemes-addons' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'columns_tablet' ); ?>" name="<?php echo $this->get_field_name( 'columns_tablet' ); ?>" >
            	<?php for ($i=1; $i < 11; $i++) { ?>
            		<option value="<?php echo $i; ?>" <?php selected( $instance['columns_tablet'], $i ); ?>><?php echo esc_html__($i,'enovathemes-addons'); ?></option>
            	<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'columns_desk' ); ?>"><?php echo esc_html__( 'Columns desktop:', 'enovathemes-addons' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'columns_desk' ); ?>" name="<?php echo $this->get_field_name( 'columns_desk' ); ?>" >
            	<?php for ($i=1; $i < 11; $i++) { ?>
            		<option value="<?php echo $i; ?>" <?php selected( $instance['columns_desk'], $i ); ?>><?php echo esc_html__($i,'enovathemes-addons'); ?></option>
            	<?php } ?>
			</select>
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = trim( strip_tags( $new_instance['username'] ) );
		$instance['number'] = ! absint( $new_instance['number'] ) ? 9 : $new_instance['number'];
		$instance['target'] = $new_instance['target'];
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['columns_mob'] = trim( strip_tags( $new_instance['columns_mob'] ) );
		$instance['columns_tablet'] = trim( strip_tags( $new_instance['columns_tablet'] ) );
		$instance['columns_desk'] = trim( strip_tags( $new_instance['columns_desk'] ) );
		return $instance;
	}
}