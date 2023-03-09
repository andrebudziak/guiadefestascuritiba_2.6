<?php

class Holo_Widget_Most_Liked extends kklikeMostLiked {

    function __construct() {
        // widget actual processes
        $widget_ops = array( 'description' => __( "Displays the most liked posts") );
        parent::WP_Widget('Holo_Widget_Most_Liked', 'DirectoryS Most Liked Posts', $widget_ops);
    }

    function widget($args, $instance) {
        // outputs the content of the widget
        global $kkLikeSettings;

        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $items = esc_attr($instance['items']);
        $type = esc_attr($instance['type']);

        if($type == 'all_post_types'){
            $type = FALSE;
        }

        $like = new kkDataBase;
        $posts = $like->getTopPosts($items, $type);

        echo $before_widget;
        echo $before_title;
        echo $title;
        echo $after_title;

        echo '<div class="liked-posts">';

        $posts_number = count($posts);
        $transparency_increment = (0.6 / $posts_number);

        $index = 0;
        foreach($posts as $post){

            $transparency = 0.5 + (0.5 - ($index * $transparency_increment));

            $color = get_transparent_color(holo_get_theme_color(), $transparency);

            ?>

            <div class="element alt-text-color" style="background-color: <?php echo $color ?>">
                <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                <span class="likes pull-right">
                    <span class="txt-min"> <?php echo $post->meta_value; ?></span>
                    <i class="fa fa-heart"></i>
                </span>
            </div>

            <?php

            $index++;

        }
        echo '</div>';

        echo $after_widget;
    }

}