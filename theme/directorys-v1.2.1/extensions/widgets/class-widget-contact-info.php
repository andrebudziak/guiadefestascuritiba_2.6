<?php

Class Holo_Widget_Contact_Info extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'description' => __( "A place containing your contact information") );
		parent::__construct('corex_contact_info', __('DirectoryS Contact Info'), $widget_ops);

	}

	function widget( $args, $instance ) {

		extract($args);

		if ( !empty($instance['title']) ) {

			$title = $instance['title'];

		} else {

			$title = 'Contact Info';

		}

		$location = ( !empty($instance['location']) ? $instance['location'] : '' );
		$phone_number = ( !empty($instance['phone_number']) ? $instance['phone_number'] : '' );
//		$fax_number = ( !empty($instance['fax_number']) ? $instance['fax_number'] : '' );
		$email = ( !empty($instance['email']) ? $instance['email'] : '' );
		$website = ( !empty($instance['website']) ? $instance['website'] : '' );

		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }

		echo '
			<div class="contact-widget">
                <div class="line">
                    <i class="fa fa-home main-text-color"></i> <div class="text">' . $location . '</div>
                </div>
                <div class="line">
                    <i class="fa fa-phone main-text-color"></i>
                    <div class="text">' . $phone_number . '</div>
                </div>
                <!--<div class="line">
                    <i class="fa fa-fax main-text-color"></i>
                    <div class="text"></div>
                </div>-->
                <div class="line">
                    <i class="fa fa-mail-alt main-text-color"></i>
                    <div class="text">' . $email . '</div>
                </div>
                <div class="line">
                    <i class="fa fa-globe main-text-color"></i>
                    <div class="text">' . $website . '</div>
                </div>
            </div>
		';

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['location'] = strip_tags(stripslashes($new_instance['location']));
		$instance['phone_number'] = strip_tags(stripslashes($new_instance['phone_number']));
//		$instance['fax_number'] = strip_tags(stripslashes($new_instance['fax_number']));
		$instance['email'] = strip_tags(stripslashes($new_instance['email']));
		$instance['website'] = strip_tags(stripslashes($new_instance['website']));

		return $instance;

	}

	function form( $instance ) {

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('location'); ?>"><?php _e('Location:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location') ?>" value="<?php if (isset($instance['location'])) {echo esc_attr($instance['location']);} ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone_number'); ?>"><?php _e('Phone Number:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('phone_number'); ?>" name="<?php echo $this->get_field_name('phone_number') ?>" value="<?php if (isset($instance['phone_number'])) {echo esc_attr($instance['phone_number']);} ?>" />
		</p>
<!--		<p>-->
<!--			<label for="--><?php //echo $this->get_field_id('fax_number'); ?><!--">--><?php //_e('Fax Number:') ?><!--</label>-->
<!--			<input type="text" class="widefat" id="--><?php //echo $this->get_field_id('fax_number'); ?><!--" name="--><?php //echo $this->get_field_name('fax_number') ?><!--" value="--><?php //if (isset($instance['fax_number'])) {echo esc_attr($instance['fax_number']);} ?><!--" />-->
<!--		</p>-->
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('E-mail:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email') ?>" value="<?php if (isset($instance['email'])) {echo esc_attr($instance['email']);} ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('website'); ?>"><?php _e('Website:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('website'); ?>" name="<?php echo $this->get_field_name('website') ?>" value="<?php if (isset($instance['website'])) {echo esc_attr($instance['website']);} ?>" />
		</p>

	<?php

	}

}
 