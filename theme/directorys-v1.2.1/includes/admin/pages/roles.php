<?php

class Holo_Roles_Page
{

    private $rating_terms;

    public function __construct()
    {

        add_action('admin_menu', array($this, 'add_page'));
    }

    /**
     * Add options page
     */
    public function add_page()
    {

        add_submenu_page(
            'directorys_settings.php',
            'Listings Packages',
            'Listings Packages',
            'manage_options',
            'roles.php',
            array($this, 'create_page')
        );
    }

    public function create_page()
    {
        $no_curl = false;

        if (!function_exists('curl_version')) {

            $no_curl = true;

        }

        $custom_roles_option_name = 'ht_user_roles';
        $payapl_settings_name = 'ht_paypal_settings';

        $user_roles = get_option('wp_user_roles');
        $custom_roles = get_option( $custom_roles_option_name );
        $paypal_settings = get_option($payapl_settings_name);

        $new_account_options_array = array();

        if ( $custom_roles === false ) {

            $default_account_options['ht-default-package'] = array(
                'account_name' => 'Default Package',
                'account_price' => 0,
                'account_max_items' => 0,
                'account_expiration_time' => 0
            );

            add_option($custom_roles_option_name, $default_account_options);

        } else {

            $default_account_options['ht-default-package'] = array(
                'account_name' => 'Default Package',
                'account_price' => 0,
                'account_max_items' => 0,
                'account_expiration_time' => 0
            );

            $account_options = array_merge($custom_roles, $default_account_options);

            update_option($custom_roles_option_name, $account_options);

        }

        if (isset($_POST['paypal_settings_save'])) {

            $paypal_settings['paypal_sandbox'] = isset($_POST['paypal_sandbox']) ? $_POST['paypal_sandbox'] : 0;
            $paypal_settings['paypal_username'] = $_POST['paypal_username'];
            $paypal_settings['paypal_password'] = $_POST['paypal_password'];
            $paypal_settings['paypal_signature'] = $_POST['paypal_signature'];
            $paypal_settings['paypal_payment_name'] = $_POST['paypal_payment_name'];
            $paypal_settings['paypal_currency'] = $_POST['paypal_currency'];
            $paypal_settings['paypal_currency_symbol'] = $_POST['paypal_currency_symbol'];

            if ( $paypal_settings !== false ) {

                update_option($payapl_settings_name, $paypal_settings);

            } else {

                add_option($payapl_settings_name, $paypal_settings);

            }

        }

        if ($no_curl) {

            echo '<div class="alert alert-danger" style="background-color: red; padding: 5px 10px; margin-top: 20px">
                        <div class="text" style="display: inline-block"><i class="fa fa-attention-circled pull-left"></i> This feature does not work without the cURL libraries Installed! <br /> Please install the libraries or contact your host provider to get it installed.</div>
                    </div>';

        }

        ?>

        <h2>Paypal Settings</h2>

        <form method="post">
            <table>
                <tr>
                    <td>Use Sandbox Environment</td>
                    <td><input type="checkbox" name="paypal_sandbox" <?php echo ($paypal_settings['paypal_sandbox'] ? 'checked' : ''); ?> /></td>
                </tr>

                <tr>
                    <td>API Username</td>
                    <td><input type="text" name="paypal_username" value="<?php echo $paypal_settings['paypal_username'] ?>" /></td>
                </tr>

                <tr>
                    <td>API Password</td>
                    <td><input type="text" name="paypal_password" value="<?php echo $paypal_settings['paypal_password'] ?>" /></td>
                </tr>

                <tr>
                    <td>API Signature</td>
                    <td><input type="text" name="paypal_signature" value="<?php echo $paypal_settings['paypal_signature'] ?>" /></td>
                </tr>

                <tr>
                    <td>Payment Name</td>
                    <td><input type="text" name="paypal_payment_name" value="<?php echo $paypal_settings['paypal_payment_name'] ?>" /></td>
                </tr>

                <tr>
                    <td>Payment Currency Code</td>
                    <td><input type="text" name="paypal_currency" value="<?php echo $paypal_settings['paypal_currency'] ?>" /></td>
                    <td>Check the available codes <a href="https://developer.paypal.com/docs/classic/api/currency_codes" target="_blank">here</a></td>
                </tr>

                <tr>
                    <td>Payment Currency Symbol</td>
                    <td><input type="text" name="paypal_currency_symbol" value="<?php echo $paypal_settings['paypal_currency_symbol'] ?>" /></td>
                    <td>This symbol is used in front-end.</td>
                </tr>

                <tr>
                    <td><button type="submit" name="paypal_settings_save">Save Settings</button></td>
                </tr>
            </table>
        </form>

        <br />

        <div class="paypal-check-wrapper">
            <p>Check Paypal Settings (use it after you saved them)</p>
            <button class="paypal-credentials-check">Check Paypal Connection</button>
            <div class="paypal-check-message"></div>
        </div>

        <br /><br />

        <?php

        $this->display_account_types();

    }

    public function display_account_types() {

        $account_types_option_name = 'ht_packages';

        $account_types = get_option($account_types_option_name);

        $default_account_types['ht-default-package'] = array(
            'account_name' => 'Default Package',
            'account_price' => 0,
            'account_max_items' => 0,
            'account_expiration_time' => 0
        );

        if ( $account_types === false ) {

            add_option($account_types_option_name, $default_account_types);

        } else {

//            $account_types = array_merge($account_types, $default_account_types);
//
//            update_option($account_types_option_name, $account_types);

        }

        if (isset($_POST['account_submit'])) {

            $account_name = $_POST['account_name'];
            $account_name_slug = sanitize_title($account_name);
            $account_price = $_POST['account_price'];
            $account_max_items = $_POST['account_max_items'];
            $account_expiration_time = $_POST['account_expiration_time'];

            $allow_content = isset($_POST['allow_content']) ? $_POST['allow_content'] : 0;
            $allow_page_builder = isset($_POST['allow_page_builder']) ? $_POST['allow_page_builder'] : 0;
            $allow_contact = isset($_POST['allow_contact']) ? $_POST['allow_contact'] : 0;
            $allow_schedule = isset($_POST['allow_schedule']) ? $_POST['allow_schedule'] : 0;
            $allow_custom_fields = isset($_POST['allow_custom_fields']) ? $_POST['allow_custom_fields'] : 0;
            $allow_ratings = isset($_POST['allow_ratings']) ? $_POST['allow_ratings'] : 0;
            $allow_taxonomy_assign = isset($_POST['allow_taxonomy_assign']) ? $_POST['allow_taxonomy_assign'] : 0;
            $allow_taxonomy_add = isset($_POST['allow_taxonomy_add']) ? $_POST['allow_taxonomy_add'] : 0;

            $new_account_options_array[$account_name_slug] = array(
                'account_name' => $account_name,
                'account_price' => $account_price,
                'account_max_items' => $account_max_items,
                'account_expiration_time' => $account_expiration_time,
                'cap' => array(
                    'content' => $allow_content,
                    'page_builder' => $allow_page_builder,
                    'contact' => $allow_contact,
                    'schedule' => $allow_schedule,
                    'custom_fields' => $allow_custom_fields,
                    'ratings' => $allow_ratings,
                    'assign_taxonomy' => $allow_taxonomy_assign,
                    'add_taxonomy' => $allow_taxonomy_add
                )
            );

            if (is_array($account_types)) {
                $account_options = array_merge($account_types, $new_account_options_array);
            } else {
                $account_options = $new_account_options_array;
            }

            update_option($account_types_option_name, $account_options);


            $capabilities = array(
                'publish_locations' => true,
                'edit_location' => true,
                'delete_location' => true,
                'edit_published_locations' => true,
                'edit_locations' => true,
                'read' => true,
                'upload_files' => true,
                'delete_published_locations' => true
            );

            add_role(
                $account_name_slug,
                $account_name,
                $capabilities
            );

            $updated_user_role = get_role($account_name_slug);

            $updated_user_role->add_cap('upload_files');

            if ($allow_content) {
                $updated_user_role->add_cap('ht_use_editor');
            }

            if ($allow_page_builder) {
                $updated_user_role->add_cap('ht_use_page_builder');
            }

            if ($allow_contact) {
                $updated_user_role->add_cap('ht_use_contact');
            }

            if ($allow_schedule) {
                $updated_user_role->add_cap('ht_use_schedule');
            }

            if ($allow_custom_fields) {
                $updated_user_role->add_cap('ht_use_custom_Fields');
            }

            if ($allow_ratings) {
                $updated_user_role->add_cap('ht_use_ratings');
            }

            if ($allow_taxonomy_assign) {
                $updated_user_role->add_cap('ht_assign_listings_terms');
            }

            if ($allow_taxonomy_add) {
                $updated_user_role->add_cap('ht_edit_listings_terms');
            }

            $account_types = get_option( $account_types_option_name );

        }

        if (isset($_POST['account_edit'])) {

            $account_slug = $_POST['account_name_slug'];
            $user_roles = get_option('ht_packages');
            $updated_user_role = get_role($account_slug);

            $allow_content = isset($_POST['allow_content']) ? $_POST['allow_content'] : 0;
            $allow_page_builder = isset($_POST['allow_page_builder']) ? $_POST['allow_page_builder'] : 0;
            $allow_contact = isset($_POST['allow_contact']) ? $_POST['allow_contact'] : 0;
            $allow_schedule = isset($_POST['allow_schedule']) ? $_POST['allow_schedule'] : 0;
            $allow_custom_fields = isset($_POST['allow_custom_fields']) ? $_POST['allow_custom_fields'] : 0;
            $allow_ratings = isset($_POST['allow_ratings']) ? $_POST['allow_ratings'] : 0;
            $allow_taxonomy_assign = isset($_POST['allow_taxonomy_assign']) ? $_POST['allow_taxonomy_assign'] : 0;
            $allow_taxonomy_add = isset($_POST['allow_taxonomy_add']) ? $_POST['allow_taxonomy_add'] : 0;

            $updated_user_role->add_cap('upload_files');

            if ($allow_content) {
                $updated_user_role->add_cap('ht_use_editor');
            } else {
                $updated_user_role->remove_cap('ht_use_editor');
            }

            if ($allow_page_builder) {
                $updated_user_role->add_cap('ht_use_page_builder');
            } else {
                $updated_user_role->remove_cap('ht_use_page_builder');
            }

            if ($allow_contact) {
                $updated_user_role->add_cap('ht_use_contact');
            } else {
                $updated_user_role->remove_cap('ht_use_contact');
            }

            if ($allow_schedule) {
                $updated_user_role->add_cap('ht_use_schedule');
            } else {
                $updated_user_role->remove_cap('ht_use_schedule');
            }

            if ($allow_custom_fields) {
                $updated_user_role->add_cap('ht_use_custom_Fields');
            } else {
                $updated_user_role->remove_cap('ht_use_custom_Fields');
            }

            if ($allow_ratings) {
                $updated_user_role->add_cap('ht_use_ratings');
            } else {
                $updated_user_role->remove_cap('ht_use_ratings');
            }

            if ($allow_taxonomy_assign) {
                $updated_user_role->add_cap('ht_assign_listings_terms');
            } else {
                $updated_user_role->remove_cap('ht_assign_listings_terms');
            }

            if ($allow_taxonomy_add) {
                $updated_user_role->add_cap('ht_edit_listings_terms');
            } else {
                $updated_user_role->remove_cap('ht_edit_listings_terms');
            }

//            print_r($updated_user_role);

            $cap_array = array(
                'content' => $allow_content,
                'page_builder' => $allow_page_builder,
                'contact' => $allow_contact,
                'schedule' => $allow_schedule,
                'custom_fields' => $allow_custom_fields,
                'ratings' => $allow_ratings,
                'assign_taxonomy' => $allow_taxonomy_assign,
                'add_taxonomy' => $allow_taxonomy_add,
            );

            $account_types[$account_slug]['account_name'] = $_POST['account_name'];
            $account_types[$account_slug]['account_price'] = $_POST['account_price'];
            $account_types[$account_slug]['account_max_items'] = $_POST['account_max_items'];
            $account_types[$account_slug]['account_expiration_time'] = $_POST['account_expiration_time'];
            $account_types[$account_slug]['cap'] = $cap_array;

            update_option($account_types_option_name, $account_types);


        }

        if (isset($_POST['account_remove'])) {

            $account_slug = $_POST['account_name_slug'];

            foreach ($account_types as $role_slug => $slug) {

                if ($account_slug == $role_slug) {

                    unset($account_types[$role_slug]);

                }

            }

            update_option($account_types_option_name, $account_types);


        }

        echo '<h1>Account Types(Packages)</h1>';

        ?>

        <style>
            .package-settings, .package-capabilities {
                float: left;
            }

            .package-buttons {
                clear: both;
                padding-top: 20px;
            }

            .package-wrapper {
                background: #f8f8f8;
                padding: 10px;
            }

            .package-capabilities {

                margin-left: 30px;

            }

            .package-settings td {
                padding: 4px 0;
            }

            .package-settings tr:first-child td {
                padding: 0;
            }

        </style>

        <?php

        if ( count($account_types) == 1 && isset($account_types['ht-default-package']) ) {

            echo 'No account types created. The registered users can post unlimited listings and their accounts will never expire!';

        }

        if (is_array($account_types)) {

            foreach ($account_types as $role_slug => $role) {

                if ( $role_slug != 'ht-default-package') :

                    ?>

                    <form action="" method="post" class="package-wrapper clearfix">
                        <table class="package-settings">
                            <tr>
                                <td><h4>Account Settings</h4></td>
                            </tr>

                            <tr>
                                <td><label for="account-name">Account Name</label></td>
                                <td><input type="text" name="account_name" id="account-name" value="<?php echo $role['account_name'] ?>" /></td>
                            </tr>

                            <tr>
                                <td><label for="account-name-slug">Account Name Slug</label></td>
                                <td><input type="text" name="account_name_slug" id="account-name-slug" value="<?php echo $role_slug ?>" /></td>
                            </tr>

                            <tr>
                                <td><label for="account-price">Account Price</label></td>
                                <td><input type="text" name="account_price" id="account-price" value="<?php echo $role['account_price'] ?>" /></td>
                            </tr>

                            <tr>
                                <td><label for="account-max-items">Account Items Limit</label></td>
                                <td><input type="text" name="account_max_items" id="account-max-items" value="<?php echo $role['account_max_items'] ?>" /></td>
                            </tr>

                            <tr>
                                <td><label for="account-expiration-time">Account Expiration Time(in days)</label></td>
                                <td><input type="text" name="account_expiration_time" id="account-expiration-time" value="<?php echo $role['account_expiration_time'] ?>" /></td>
                            </tr>
                        </table>

                        <table class="package-capabilities">
                            <tr>
                                <td><h4>Account Capabilities</h4></td>
                            </tr>

                            <tr>
                                <td><label for="">Content</label></td>
                                <td><input type="checkbox" name="allow_content" value="1" <?php echo $role['cap']['content'] ? 'checked' : '' ?> /></td>
                            </tr>

                            <tr>
                                <td><label for="">Page Builder</label></td>
                                <td><input type="checkbox" name="allow_page_builder" <?php echo $role['cap']['page_builder'] ? 'checked' : '' ?> /></td>
                            </tr>

                            <tr>
                                <td><label for="">Contact Info</label></td>
                                <td><input type="checkbox" name="allow_contact" value="1" <?php echo $role['cap']['contact'] ? 'checked' : '' ?> /></td>
                            </tr>

                            <tr>
                                <td><label for="">Schedule Panel</label></td>
                                <td><input type="checkbox" name="allow_schedule" value="1" <?php echo $role['cap']['schedule'] ? 'checked' : '' ?> /></td>
                            </tr>

                            <tr>
                                <td><label for="">Custom Fields</label></td>
                                <td><input type="checkbox" name="allow_custom_fields" value="1" <?php echo $role['cap']['custom_fields'] ? 'checked' : '' ?> /></td>
                            </tr>

                            <tr>
                                <td><label for="">Ratings</label></td>
                                <td><input type="checkbox" name="allow_ratings" value="1" <?php echo $role['cap']['ratings'] ? 'checked' : '' ?> /></td>
                            </tr>

                            <tr>
                                <td><label for="">Assign Categories and Locations</label></td>
                                <td><input type="checkbox" name="allow_taxonomy_assign" <?php echo $role['cap']['assign_taxonomy'] ? 'checked' : '' ?> /></td>
                            </tr>

                            <tr>
                                <td><label for="">Add Categories and Locations</label></td>
                                <td><input type="checkbox" name="allow_taxonomy_add" <?php echo $role['cap']['add_taxonomy'] ? 'checked' : '' ?> /></td>
                            </tr>
                        </table>

                        <div class="package-buttons">
                            <button type="submit" name="account_edit" id="roles-create">Update Package</button>
                            <button type="submit" name="account_remove" id="roles-create">Delete Package</button>
                        </div>

                    </form>

                <?php

                endif;

                echo '<br />';

            }

        }

        ?>

        <hr />

        <style type="text/css">
            #roles-create {
                margin-top: 20px;
            }
        </style>

        <form action="" method="post">
            <table>

                <tr>
                    <td><label for="account-name">Account Name</label></td>
                    <td><input type="text" name="account_name" id="account-name" value="" /></td>
                </tr>

                <tr>
                    <td><label for="account-price">Account Price</label></td>
                    <td><input type="text" name="account_price" id="account-price" value="" placeholder="0 stands for 'free'" /></td>
                </tr>

                <tr>
                    <td><label for="account-max-items">Account Items Limit</label></td>
                    <td><input type="text" name="account_max_items" id="account-max-items" value="" placeholder="0 stands for 'no limit'" /></td>
                </tr>

                <tr>
                    <td><label for="account-expiration-time">Account Expiration Time(in days)</label></td>
                    <td><input type="text" name="account_expiration_time" id="account-expiration-time" value="" placeholder="0 stands for 'never'" /></td>
                </tr>

                <tr>
                    <td><h4>Account Capabilities</h4></td>
                </tr>

                <tr>
                    <td><label for="">Content</label></td>
                    <td><input type="checkbox" name="allow_content" checked /></td>
                </tr>

                <tr>
                    <td><label for="">Page Builder</label></td>
                    <td><input type="checkbox" name="allow_page_builder" checked /></td>
                </tr>

                <tr>
                    <td><label for="">Contact Info</label></td>
                    <td><input type="checkbox" name="allow_contact" checked /></td>
                </tr>

                <tr>
                    <td><label for="">Schedule Panel</label></td>
                    <td><input type="checkbox" name="allow_schedule" checked /></td>
                </tr>

                <tr>
                    <td><label for="">Custom Fields</label></td>
                    <td><input type="checkbox" name="allow_custom_fields" checked /></td>
                </tr>

                <tr>
                    <td><label for="">Ratings</label></td>
                    <td><input type="checkbox" name="allow_ratings" checked /></td>
                </tr>

                <tr>
                    <td><label for="">Assign Categories and Locations</label></td>
                    <td><input type="checkbox" name="allow_taxonomy_assign" checked /></td>
                </tr>

                <tr>
                    <td><label for="">Add Categories and Locations</label></td>
                    <td><input type="checkbox" name="allow_taxonomy_add" checked /></td>
                </tr>

                <tr>
                    <td><button type="submit" name="account_submit" id="roles-create">Add Package</button></td>
                </tr>

            </table>
        </form>

    <?php

    }

}

$roles_page = new Holo_Roles_Page();

