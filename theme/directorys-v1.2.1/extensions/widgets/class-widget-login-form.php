<?php

class Holo_Widget_Login_Form extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'description' => __( "A widget that displays a login and register form form") );
        parent::__construct('corex_login', __('DirectoryS Login/Register Form'), $widget_ops);

    }

    function widget($args, $instance) {

        extract($args);

        $login_active_class = 'active-form';
        $register_active_class = '';

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }

        ?>

        <div class="login-widget">
            <div class="form form-1">
                <a class="button solid sm login <?php echo $login_active_class ?>">
                    <?php _e('Login', THEME_TEXT_DOMAIN) ?>
                </a>
                <a class="button solid sm register <?php echo $register_active_class ?>">
                    <?php _e('Register', THEME_TEXT_DOMAIN) ?>
                </a>

                <div class="login-section">
                    <form class="login-form" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ) ?>" method="post">
                        <?php echo apply_filters( 'login_form_top', '', $args ) ?>

                        <div class="text-fields">
                            <div class="input-group">
                                <input type="text" placeholder="<?php _e('Username', THEME_TEXT_DOMAIN) ?>" name="log" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>

                            <div class="input-group c-border-top">
                                <input type="password" placeholder="<?php _e('Password', THEME_TEXT_DOMAIN) ?>" name="pwd" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            </div>
                        </div>

                        <?php echo apply_filters( 'login_form_middle', '', $args ) ?>

                        <input type="submit" value="<?php _e('Login', THEME_TEXT_DOMAIN) ?>" name="wp-submit" class="button main-bg-color">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_url( site_url( 'wp-admin', 'login_admin' ) ) ?>" />

                        <?php echo apply_filters( 'login_form_bottom', '', $args ) ?>

                    </form>
                </div>

                <div class="register-section">

                    <?php

                    $user_roles = get_option('ht_user_roles');

                    $paypal_settings = get_option('ht_paypal_settings');

                    if ($paypal_settings['paypal_sandbox']) {
                        $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
                    } else {
                        $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
                    }

                    $paypal_id = $paypal_settings['paypal_username'];
                    $item_name = $paypal_settings['paypal_payment_name'];
                    $currency = $paypal_settings['paypal_currency'];

                    $accounts_select_markup = ht_get_accounts_select_markup();

                    ?>

                    <form action="<?php echo $paypal_url; ?>" method="post" id="paypal-form">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="<?php echo $paypal_id ?>">
                        <input type="hidden" name="item_name" value="<?php echo $item_name ?>">
                        <input type="hidden" name="item_number" value="2">
                        <input type="hidden" name="amount" value="">
                        <input type="hidden" name="no_shipping" value="1">
                        <input type="hidden" name="currency_code" value="<?php echo $currency ?>" />
                        <input type='hidden' name='cancel_return' value='http://dev.holobest.com/gicqsldy' />
                        <input type='hidden' name='return' value='http://dev.holobest.com/gicqsldy' />
                        <input type="hidden" name="custom" value="" />

                        <input type="submit" value="Register" name="submit" class="button main-bg-color" style="visibility: hidden">
                    </form>

                    <form method="post" id="ht-register-form">

                        <div class="register-message"></div>

                        <div class="text-fields">
                            <div class="input-group">
                                <input type="text" placeholder="<?php _e('Username', THEME_TEXT_DOMAIN) ?> *" name="user_login" id="user-login" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>

                            <div class="input-group c-border-top">
                                <input type="text" placeholder="<?php _e('Email', THEME_TEXT_DOMAIN) ?> *" name="user_email" id="user-email" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            </div>

                            <div class="input-group c-border-top">

                                <?php echo $accounts_select_markup; ?>

                            </div>
                        </div>

                        <?php do_action('register_form'); ?>

                        <input type="submit" id="ht-register-submit" value="<?php _e('Register', THEME_TEXT_DOMAIN) ?>" name="ht_user_register" class="button main-bg-color">
                    </form>

                </div>

            </div>
        </div>

        <?php

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance['title'] = strip_tags(stripslashes($new_instance['title']));

        return $instance;

    }

    function form($instance) {
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" />
        </p>

    <?php
    }


}