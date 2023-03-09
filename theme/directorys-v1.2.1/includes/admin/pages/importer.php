<?php

class Holo_Importer_Page {

    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_page' ) );
    }

    /**
     * Add options page
     */
    public function add_page()
    {
        add_menu_page(
            'Importer',
            'DirectoryS',
            'manage_options',
            'directorys_settings.php',
            array($this, 'create_page'),
            '',
            90
        );

        add_submenu_page(
            'directorys_settings.php',
            'Importer',
            'Importer',
            'manage_options',
            'directorys_settings.php',
            array($this, 'create_page')
        );
    }

    public function create_page()
    {

        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

//        $plugins = array(
//            array(
//                'slug' => 'test_plugin',
//                'name' => 'Test Plugin',
//                'source' => HOLO_TEMPLATEDIR . '/framework/plugins/required-plugins/test_plugin.zip'
//            ),
//            array(
//                'slug' => 'second_test_plugin',
//                'name' => 'Second Test Plugin',
//                'source' => HOLO_TEMPLATEDIR . '/framework/plugins/required-plugins/second_test_plugin.zip'
//            )
//        );
//
//        if ( isset($_POST['required_plugin']) ) {
//
//            print_r($_POST['required_plugin']);
//
//            // Registers the required plugins
//            Holo_Plugins_Installation::register_plugins($_POST['required_plugin']);
//
//            // Start plugins Installation
//            new Holo_Plugins_Installation();
////        add_action('admin_init', 'do_plugins_install');
//        }
        ?>

        <div class="wrap">
            <h3>Importer</h3>

<!--            <style>-->
<!--                .holo-required-plugin {-->
<!--                    float: left;-->
<!--                }-->
<!---->
<!--                .required-plugins p {-->
<!--                    display: inline-block;-->
<!--                    margin: 0;-->
<!--                }-->
<!---->
<!--                .required-plugin-status {-->
<!---->
<!--                }-->
<!--            </style>-->
<!---->
<!--            <form action="/wp_themes/wp-admin/admin.php?page=my_plugin" method="post">-->
<!--                <ul class="required-plugins">-->
<!--                    --><?php
//
//                    foreach ( $plugins as $plugin ) {
//                        ?>
<!---->
<!--                        <li>-->
<!--                            <input type="checkbox" name="required_plugin[--><?php //echo $plugin['slug'] ?><!--]" value="--><?php //echo $plugin['slug'] . ',' . $plugin['name'] . ',' . $plugin['source'] ?><!--" class="holo-required-plugin" />-->
<!--                            <p>--><?php //echo $plugin['name'] ?><!--</p>-->
<!--                            --><?php
//
//                            $installed_plugins = get_plugins();
//
//                            $installed_required_plugins = array();
//
//                            foreach ( $installed_plugins as $installed_plugin ) {
//
//                                if ($installed_plugin['Name'] === $plugin['name']) {
//                                    $installed_required_plugins[] = $installed_plugin;
//                                }
//
//                            }
//
//                            //                    print_r($installed_required_plugins);
//
//                            $installed_required_plugin = array_shift($installed_required_plugins);
//
//                            if ( $installed_required_plugin['Name'] === $plugin['name'] ) {
//                                echo '<p style="color: #00A000" class="required-plugin-status">Installed</p>';
//                            }
//                            else {
//                                echo '<p style="color: #ff2222" class="required-plugin-status">Not installed</p>';
//                            }
//
//                            ?>
<!--                        </li>-->
<!---->
<!--                    --><?php
//                    }
//                    ?>
<!--                </ul>-->
<!--                <input type="submit" name="required_plugins_submit" value="Start Installing" />-->
<!--            </form>-->

            <p>Press the button to start importing the content</p>

            <div class="importer-wrapper clearfix">
                <button id="import-button" class="button-primary" style="display: block; float: left;">import</button>
                <div class="preloader" style="background: url(<?php echo HOLO_TEMPLATE_DIR_URI . '/includes/images/preloader-blue.gif' ?>) no-repeat; background-size: 100%; width: 20px; height: 20px; display: none; float: left; margin:  3px 0 0 10px;"></div>
            </div>
        </div>

        <?php
    }

}

function holo_add_admin_menus() {

    /** Step 2 (from text above). */
    add_action( 'admin_menu', 'my_plugin_menu' );

    /** Step 1. */
    function my_plugin_menu() {
        add_submenu_page( 'options', 'My Plugin', 'My Plugin', 'my-unique-identifier', 'my_plugin', 'my_plugin_options' );
    }

    /** Step 3. */
    function my_plugin_options() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        $plugins = array(
            array(
                'slug' => 'test_plugin',
                'name' => 'Test Plugin',
                'source' => HOLO_TEMPLATEDIR . '/framework/plugins/required-plugins/test_plugin.zip'
            ),
            array(
                'slug' => 'second_test_plugin',
                'name' => 'Second Test Plugin',
                'source' => HOLO_TEMPLATEDIR . '/framework/plugins/required-plugins/second_test_plugin.zip'
            )
        );

        if ( isset($_POST['required_plugin']) ) {

            print_r($_POST['required_plugin']);

            // Registers the required plugins
            Holo_Plugins_Installation::register_plugins($_POST['required_plugin']);

            // Start plugins Installation
            new Holo_Plugins_Installation();
//        add_action('admin_init', 'do_plugins_install');
        }
        ?>

        <div class="wrap">
            <h3>Required Plugins</h3>

            <style>
                .holo-required-plugin {
                    float: left;
                }

                .required-plugins p {
                    display: inline-block;
                    margin: 0;
                }

                .required-plugin-status {

                }
            </style>

            <form action="/wp_themes/wp-admin/admin.php?page=my_plugin" method="post">
                <ul class="required-plugins">
                    <?php

                    foreach ( $plugins as $plugin ) {
                        ?>

                        <li>
                            <input type="checkbox" name="required_plugin[<?php echo $plugin['slug'] ?>]" value="<?php echo $plugin['slug'] . ',' . $plugin['name'] . ',' . $plugin['source'] ?>" class="holo-required-plugin" />
                            <p><?php echo $plugin['name'] ?></p>
                            <?php

                            $installed_plugins = get_plugins();

                            $installed_required_plugins = array();

                            foreach ( $installed_plugins as $installed_plugin ) {

                                if ($installed_plugin['Name'] === $plugin['name']) {
                                    $installed_required_plugins[] = $installed_plugin;
                                }

                            }

                            //                    print_r($installed_required_plugins);

                            $installed_required_plugin = array_shift($installed_required_plugins);

                            if ( $installed_required_plugin['Name'] === $plugin['name'] ) {
                                echo '<p style="color: #00A000" class="required-plugin-status">Installed</p>';
                            }
                            else {
                                echo '<p style="color: #ff2222" class="required-plugin-status">Not installed</p>';
                            }

                            ?>
                        </li>

                    <?php
                    }
                    ?>
                </ul>
                <input type="submit" name="required_plugins_submit" value="Start Installing" />
            </form>

            <p>Choose to import the content</p>

            <div class="importer-wrapper">
                <button id="import-button">import</button>
                <div class="preloader" style="background: url(<?php echo HOLO_TEMPLATE_DIR_URI . '/resources/preloader.gif' ?>) no-repeat; background-size: 100%; width: 20px; height: 20px; display: none;"></div>
            </div>
        </div>

    <?php
    }
}

$importer_page = new Holo_Importer_Page();