<?php

class Holo_Widget_Flickr extends WP_Widget {

    function Holo_Widget_Flickr() {
        parent::WP_Widget(
            'flickr-widget',
            __('DirectoryS Flickr Widget', 'thematic'),
            array('description' => __('Displays latest images from a flickr account', 'thematic'), 'classname' => 'flickr-widget' )
        );
    }

    /* WIDGET ADMIN FORM */
    /* @instance  The array of keys and values for the widget */
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Photos on flickr',
            'id' => '51301326@N04',
            'number' => '12'
        ));
        ?>

        <p>
            <label for="<?php
            echo $this->get_field_id('title');
            ?>"><?php
                _e('Title:', 'clubber');
                ?></label>
            <input type="text" class="widefat" id="<?php
            echo $this->get_field_id('title');
            ?>" name="<?php
            echo $this->get_field_name('title');
            ?>" value="<?php
            echo $instance['title'];
            ?>" />
        </p>

        <p>
            <label for="<?php
            echo $this->get_field_id('id');
            ?>">Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
            <input class="widefat" id="<?php
            echo $this->get_field_id('id');
            ?>" name="<?php
            echo $this->get_field_name('id');
            ?>" type="text" value="<?php
            echo $instance['id'];
            ?>" />
        </p>

        <p>
            <label for="<?php
            echo $this->get_field_id('number');
            ?>">Number of photos:</label>
            <input class="widefat" id="<?php
            echo $this->get_field_id('number');
            ?>" name="<?php
            echo $this->get_field_name('number');
            ?>" type="text" value="<?php
            echo $instance['number'];
            ?>" />
        </p>

    <?php
    }

    /* UPDATE THE WIDGET */
    function update($new_instance, $old_instance) {
        $instance           = $old_instance;
        $instance['title']  = strip_tags($new_instance['title']);
        $instance['id']     = strip_tags($new_instance['id']);
        $instance['number'] = (int) $new_instance['number'];
        return $instance;
    }

    /* DISPLAY THE WIDGET */
    /* @args --> The array of form elements */
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', $instance['title']);
        $id    = $instance['id'];
        if (!$number = (int) $instance['number']) {
            $number = 3;
        } else if ($number < 1) {
            $number = 1;
        } else if ($number > 12) {
            $number = 12;
        }
        /* before widget */
        echo $before_widget;

        /* display the widget */
        ?>
        <div class="flickr-widget widget">
            <?php
            if ($title) {
                echo $before_title . $title . $after_title;
            }
            ?>

            <div class="flickr-images clearfix">
                <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php
                echo $number;
                ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php
                echo $id;
                ?>"></script>
            </div><!-- end .flickr -->
        </div><!-- end .widgets-col-flickr -->
        <?php
        /* after widget */
        echo $after_widget;
    }

}