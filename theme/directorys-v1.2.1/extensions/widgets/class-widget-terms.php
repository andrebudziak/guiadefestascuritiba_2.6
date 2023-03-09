<?php

class Holo_Widget_Terms extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'description' => __( "A set of wordpress terms") );
        parent::__construct('corex_terms', __('DirectoryS Terms'), $widget_ops);

    }

    function widget($args, $instance) {

        extract($args);

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        $current_taxonomy = $this->get_current_taxonomy($instance);

        $tags = get_terms( $current_taxonomy, array( 'orderby' => 'count', 'order' => 'DESC' ) ); // Always query top tags

        echo $before_widget;

        echo $before_title . $title . $after_title

    ?>

    <div class="tags clearfix">

    <?php foreach ($tags as $tag) : ?>

        <a class="tag alt-text-color main-bg-color" href="<?php echo get_term_link( $tag ) ?>">
            <?php echo $tag->name ?>
        </a>

    <?php endforeach; ?>

    </div>

    <?php

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
        return $instance;
    }

    function form( $instance ) {
        $current_taxonomy = $this->get_current_taxonomy($instance);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:') ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
            <?php foreach ( get_taxonomies() as $taxonomy ) :
                $tax = get_taxonomy($taxonomy);
                if ( !$tax->show_tagcloud || empty($tax->labels->name) )
                    continue;
                ?>
                <option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
            <?php endforeach; ?>
        </select></p><?php
    }

    function get_current_taxonomy($instance) {
        if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
            return $instance['taxonomy'];

        return 'post_tag';
    }

}