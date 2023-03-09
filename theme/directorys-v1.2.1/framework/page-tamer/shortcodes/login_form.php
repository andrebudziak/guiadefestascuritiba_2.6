<?php

class holo_login_form extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Login Form';
        $this->admin_icon = 'entypo-vcard';

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $return_markup = '
            <div class="form form-2 login-form-sc">

                <form action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
                    <p><input type="text" size="40" value="" name="log" placeholder="Username" /></p>
                    <p><input type="password" size="40" value="" name="pwd" placeholder="Password" /></p>

                    <p class="forgetmenot">
                    <label for="rememberme"><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember Me</label></p>
                    <span>Your privacy is important to us and we will never rent or sell your information</span>

                    <input type="submit" value="Login" name="wp-submit" class="button main-bg-color">
                    <input type="hidden" name="redirect_to" value="' . esc_url( site_url( 'wp-admin', 'login_admin' ) ) .'" />
                </form>

            </div>';

        return $return_markup;

    }

}
