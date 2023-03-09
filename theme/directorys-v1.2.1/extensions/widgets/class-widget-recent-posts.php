<?php

class Holo_Widget_Recent_Posts extends WP_Widget_Recent_Posts {

    function widget($args, $instance) {

        $cache = wp_cache_get('widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
        if ( ! $number )
            $number = 10;

        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        $posts = $this->get_posts($number);

//        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );

        echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }

        ?>

            <div class="recent-posts-widget widget-posts-list">

            <?php

            foreach ($posts as $post) :

//                print_r($post);

                $post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
            ?>

                <a href="<?php echo get_permalink($post->ID); ?>" class="list-item clearfix">

                <?php if ($post_thumb[0]) : ?>

                    <img src="<?php echo $post_thumb[0] ?>" class="img-responsive" alt="" height="34" />

                <?php endif; ?>

                    <div class="info">
                        <p class="name"><?php echo get_the_title($post->ID) ? get_the_title($post->ID) : get_the_ID(); ?></p>
                        <?php if ( $show_date ) : ?>
                            <p class="description main-text-color"><?php echo get_the_date('', $post->ID); ?></p>
                        <?php endif; ?>
                    </div>
                </a>

            <?php endforeach; ?>

            </div>

        <?php echo $after_widget;

        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');

    }

    function get_posts($posts_number) {

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $posts_number,
        );

        $posts_array = get_posts($args);

        return $posts_array;

    }

}