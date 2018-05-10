<?php 
/*
Plugin Name: Banners
Version: 1.0
Plugin URI: https://www.msantelices.com
Description: Agrega banners tradicionales o con animaciones al pasar el mouse.
Author: Mauricio Santelices
Author URI: https://www.msantelices.com
*/

add_action( 'widgets_init', 'cbhe_init' );
add_action('wp_enqueue_scripts', 'cbhe_assets');


function cbhe_init() {
	register_widget( 'cbhe_widget' );
}

function cbhe_assets() {
    wp_enqueue_style( 'cbhe_styles', plugins_url( 'custom-banners-hover.css', __FILE__ ) );
}

class cbhe_widget extends WP_Widget
{
    

    public function __construct()
    {
        $widget_details = array(
            'classname' => 'cbhe_widget',
            'description' => 'Agrega banners tradicionales o con animaciones al pasar el mouse.'
        );

        parent::__construct( 'cbhe_widget', 'Banners', $widget_details );
    }


    public function widget( $args, $instance )
    {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }
    ?>

    <div class='<?php echo $instance['efect'] ?>'>
        <a href='<?php echo esc_url( $instance['link_url'] ) ?>'><img src='<?php echo $instance['image'] ?>'></a>
    </div>

<?php

echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    public function form( $instance ) 
    {
        $title = '';
        if( !empty( $instance['title'] ) ) {
            $title = $instance['title'];
        }

        $image = '';
        if(isset($instance['image']))
        {
            $image = $instance['image'];
        }

        $link_url = '';
        if( !empty( $instance['link_url'] ) ) {
            $link_url = $instance['link_url'];
        } 

        $efect = '';
        if( !empty( $instance['efect'] ) ) {
            $efect = $instance['efect'];
        }

    ?>
    <!-- Titulo -->
    <p>
        <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Nombre:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>

    <!-- Imagen -->
    <p>
        <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Imagen:' ); ?></label>
        <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
    </p>

    <!-- Link -->
    <p>
        <label for="<?php echo $this->get_field_name( 'link_url' ); ?>"><?php _e( 'Enlace:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>" />
    </p>

    <!-- Efecto -->
    <p>
        <span>Efecto:</span><br>
        <input type="radio" name="<?php echo $this->get_field_name( 'efect' ); ?>" <?php checked( $instance[ 'efect' ], 'default' ); ?> value="default" id="<?php echo $this->get_field_id( 'efect-1' ); ?>">Ninguno
        <input type="radio" name="<?php echo $this->get_field_name( 'efect' ); ?>" <?php checked( $instance[ 'efect' ], 'expand'); ?> value="expand" id="<?php echo $this->get_field_id( 'efect-2' ); ?>">Expandir
        <input type="radio" name="<?php echo $this->get_field_name( 'efect' ); ?>" <?php checked( $instance[ 'efect' ], 'zoom'); ?> value="zoom" id="<?php echo $this->get_field_id( 'efect-3' ); ?>">Zoom
    </p>

<?php
}
}