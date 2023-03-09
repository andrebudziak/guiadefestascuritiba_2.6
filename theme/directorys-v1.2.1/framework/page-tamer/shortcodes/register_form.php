<?php

class holo_register_form extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Register Form';
        $this->admin_icon = 'entypo-vcard';

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $accounts_select_markup = ht_get_accounts_select_markup();

        if ($accounts_select_markup != '') {

            $accounts_select_markup = '<p>' . $accounts_select_markup .  '</p>';

        }

        $return_markup = '
            <div id="ht-register-form" class="form form-2 register-form-sc">

                <form>

                    <div class="register-message"></div>

                    <p><input type="text" placeholder="Username *" name="user_login" id="user-login" class="form-control" /></p>
                    <p><input type="text" placeholder="Email *" name="user_email" id="user-email" class="form-control" /></p>

                    ' . $accounts_select_markup . '

                    <p>We are going to send you a password on your e-mail.</p>

                    <input type="submit" id="ht-register-submit" value="Register" name="ht_user_register" class="button main-bg-color">

                </form>

            </div>';

        return $return_markup;

    }

}
