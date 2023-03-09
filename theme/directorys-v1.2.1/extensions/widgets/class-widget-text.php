<?php

class Holo_Widget_Text extends WP_Widget_Text {

    function widget( $args, $instance ) {
        extract($args);

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );

        echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }

        ?>

        <div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
        <?php

        echo $after_widget;
    }

}