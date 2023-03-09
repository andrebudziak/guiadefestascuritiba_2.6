<?php

class Holo_Widget_Shortcode extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'description' => __( "A widget that can host any shortcode") );
        parent::__construct('corex_shortcode', __('DirectoryS Shortcode'), $widget_ops);

    }

    function widget($args, $instance) {

        extract($args);

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $shortcode = ( !empty($instance['shortcode']) ? $instance['shortcode'] : '' );

        echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }

        echo do_shortcode($shortcode);

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['shortcode'] = strip_tags(stripslashes($new_instance['shortcode']));

        return $instance;

    }

    function form($instance) {
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('shortcode'); ?>"><?php _e('Shortcode:') ?></label><br />
            <textarea cols="45" rows="6" id="<?php echo $this->get_field_id('shortcode'); ?>" name="<?php echo $this->get_field_name('shortcode'); ?>">
                <?php if (isset ( $instance['shortcode'])) {echo esc_attr( $instance['shortcode'] );} ?>
            </textarea>
        </p>

    <?php
    }


}