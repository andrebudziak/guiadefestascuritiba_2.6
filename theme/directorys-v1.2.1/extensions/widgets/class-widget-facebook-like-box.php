<?php

class Holo_Widget_Facebook_Like_Box extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'description' => __( "A facebook like box") );
        parent::__construct('corex_facebook_like_box', __('DirectoryS Facebook Like Box'), $widget_ops);

    }

    function widget($args, $instance) {

        extract($args);

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $fb_url = (!empty($instance['fb_url']) ? $instance['fb_url'] : '');
        $show_faces = (!empty($instance['show_faces']) ? 'true' : 'false');

        echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }

        ?>

        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <div class="facebook-frame">
            <div class="fb-like-box" data-href="<?php echo $fb_url ?>" data-colorscheme="light" data-show-faces="<?php echo $show_faces ?>" data-header="false" data-stream="false" data-show-border="false"></div>
        </div>

        <?php

        echo $after_widget;

    }

    function update($new_instance, $old_instance) {

        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['fb_url'] = strip_tags(stripslashes($new_instance['fb_url']));
        $instance['show_faces'] = strip_tags(stripslashes($new_instance['show_faces']));

        return $instance;

    }

    function form( $instance ) {

        $show_faces = isset( $instance['show_faces'] ) ? (bool) $instance['show_faces'] : false;

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('fb_url'); ?>"><?php _e('Facebook URL:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('fb_url'); ?>" name="<?php echo $this->get_field_name('fb_url'); ?>" value="<?php if (isset ( $instance['fb_url'])) {echo esc_attr( $instance['fb_url'] );} else { echo 'https://www.facebook.com/FacebookDevelopers';} ?>" />
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_faces ); ?> id="<?php echo $this->get_field_id( 'show_faces' ); ?>" name="<?php echo $this->get_field_name( 'show_faces' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_faces' ); ?>"><?php _e( 'Show facebook faces?' ); ?></label>
        </p>


    <?php

    }

}
 