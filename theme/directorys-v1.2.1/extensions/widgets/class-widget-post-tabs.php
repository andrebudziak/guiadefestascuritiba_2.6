<?php

class Holo_Widget_Post_Tabs extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'description' => __( "A place that displays the latest posts and the latest comments") );
		parent::__construct('corex_post_tabs', __('DirectoryS Post Tabs'), $widget_ops);

	}

	function widget( $args, $instance ) {

		extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Post Tabs' );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;

        $comments_markup = $this->get_recent_comments_markup($number);
        $recent_posts_markup = $this->get_recent_posts_markup();
        $popular_posts_markup = $this->get_popular_posts_markup();

        echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }

        ?>

        <div class="post-tab-widget">
            <!-- Nav tabs -->
            <ul class="clearfix">
                <li class="active"><a href="#profile" data-toggle="tab">Recent</a></li>
                <li><a href="#messages" data-toggle="tab"><i class="fa fa-comment"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane widget-posts-list active" id="profile">
                    <?php echo $recent_posts_markup ?>
                </div>

                <div class="tab-pane widget-posts-list" id="messages">
                    <?php echo $comments_markup; ?>
                </div>
            </div>
        </div>

		<?php

        echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance['title'] = strip_tags(stripslashes($new_instance['title']));

		return $instance;

	}

	function form( $instance ) {

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" />
		</p>

	<?php

	}

    function get_recent_comments_markup($number) {

        $output = '';

        $comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) ) );

        if ( $comments ) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
            _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

            foreach ( (array) $comments as $comment) {

                $author_avatar = get_avatar( $comment->comment_ID, '34' );

                $output .=  '
                    <a class="list-item clearfix" href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">
                        ' . $author_avatar . '
                        <div class="info">
                            <p class="main-text-color txt-min description">
                                By ' . get_comment_author($comment->comment_ID) . '
                            </p>
                            <p class="name">' . get_the_title($comment->comment_post_ID) . '</p>
                        </div>
                    </a>';

            }
        }

        return $output;

    }

    function get_recent_posts_markup() {

        $output = '';

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 5,
        );

        $recent_posts = get_posts($args);

        foreach ($recent_posts as $post) {

            $post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
            $title = ( get_the_title($post->ID) ? get_the_title($post->ID) : get_the_ID() );

            $output .= '
                <a href="' . get_permalink($post->ID) . '" class="list-item clearfix">
                    <img height="34" src="' . $post_thumb[0] . '" class="img-responsive" alt="">
                    <div class="info">
                        <p class="name">' . $title . '</p>
                        <p class="description main-text-color">' . get_the_date('', $post->ID) . '</p>
                    </div>
                </a>';

        }

        return $output;
    }

    function get_popular_posts_markup() {

        $output = '';

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value'
        );

        $recent_posts = get_posts($args);

        foreach ($recent_posts as $post) {

            $post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
            $title = ( get_the_title($post->ID) ? get_the_title($post->ID) : get_the_ID() );

            $output .= '
                <a href="' . get_permalink($post->ID) . '" class="post clearfix">
                    <img src="' . $post_thumb[0] . '" class="img-responsive" alt="">
                    <p class="name">' . $title . '</p>
                    <p class="price main-text-color">' . get_the_date() . '</p>
                </a>';

        }

        return $output;

    }

}
 