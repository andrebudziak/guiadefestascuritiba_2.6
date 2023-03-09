<?php

class Holo_Widget_Recent_Comments extends WP_Widget_Recent_Comments {

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('widget_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		extract($args, EXTR_SKIP);
		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) ) );
		$output .= $before_widget;

		if ( $title ) {
			$output .= $before_title . $title . $after_title;
		}

		$output .= '<div class="recent-comments-widget widget-posts-list">';

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
                        <p class="main-text-color description">
                            ' . __('By', THEME_TEXT_DOMAIN) . ' ' . get_comment_author($comment->comment_ID) . '
                        </p>
                        <p class="name">' . get_the_title($comment->comment_post_ID) . '</p>
                    </div>
                </a>';

			}
		}

		$output .= '</div>';

		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}

}