<?php

add_action( 'widgets_init', 'ffo_facebook_widget_lazybox' );
function ffo_facebook_widget_lazybox() {
	register_widget( 'ffo_fb_likebox_placeholder' );
}
class ffo_fb_likebox_placeholder extends WP_Widget {

	public function __construct(){
		$widget_ops = array( 'classname' => 'fb-lazy-likebox' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'fb-lazy-likebox' );
		parent::__construct( 'fb-lazy-likebox', 'Lazy Load Facebook Likebox', $widget_ops, $control_ops );
	}

	public function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$page_url = $instance['page_url'];
                $width = $instance['width'];
                $height = $instance['height'];
                $tran_bg = $instance['tran_bg'];

		echo $before_widget;
                if( !$tran_bg ) {
		    echo $before_title;
		    echo $title ; 
		    echo $after_title;
                }
                ?>
                <div class="lazy-likebox-placeholder" data-href="<?= $page_url ?>" data-width="<?= $width ?>" data-height="<?= $height ?>">
                <blockquote cite="<?= $page_url ?>" class="fb-xfbml-parse-ignore"><a href="<?= $page_url ?>"><?= strip_tags( $title ) ?></a></blockquote></div>
	<?php if( !$tran_bg ) { echo $after_widget; }
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = trim(strip_tags( $new_instance['title'] ));
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
                $instance['width'] = (int)$new_instance['width'];
                $instance['height'] = (int)$new_instance['height'];
                $instance['tran_bg'] = (bool)$new_instance['tran_bg'];
		return $instance;
	}

	public function form( $instance ) {
		$defaults = array( 'title' =>__( 'Find us on Facebook' , 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Fondo transparente:</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) )  echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>si se marca esta opción el título desaparecerá</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">URL fanpage : </label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php if( !empty( $instance['page_url'] ) ) echo $instance['page_url']; ?>" class="widefat" type="text" />
		</p>
                <p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">Width: </label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php if( !empty( $instance['width'] ) ) echo $instance['width']; ?>" class="widefat" type="text" />
                </p>
                <p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">Height: </label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php if( !empty( $instance['height'] ) ) echo $instance['height']; ?>" class="widefat" type="text" />
                </p>

	<?php
	}
}
