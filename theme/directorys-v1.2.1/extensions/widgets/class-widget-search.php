<?php

class Holo_Widget_Search extends WP_Widget_Search {

	function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$form = '
			<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<div class="input-group">
					<input type="text" class="search-field form-control" placeholder="' . __( 'Search', THEME_TEXT_DOMAIN ) . '&hellip;" value="' . get_search_query() . '" name="s" title="' . __( 'Search for', THEME_TEXT_DOMAIN ) . ':" />
					<!--<input type="hidden" name="search_post_type" value="page" />-->
		            <span class="input-group-btn">
		                <button class="button main-bg-color solid search-button" type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
		            </span>
				</div>
			</form>';

        $search_form = apply_filters('get_search_form', $form);

		echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }

        echo $search_form;

		echo $after_widget;

	}

}
 