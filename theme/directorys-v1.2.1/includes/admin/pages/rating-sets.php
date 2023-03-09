<?php

class Holo_Ratings_Sets_Page
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
            'Rating Terms',
            'Rating Terms',
            'manage_options',
            'rating-terms.php',
            array($this, 'create_page')
        );
    }

    public function create_page()
    {

        global $wpdb;

        $rating_terms_table = $wpdb->prefix . 'rating_terms';

        if (isset($_REQUEST['update_rating_terms'])) {

            foreach ($_REQUEST['term'] as $term_id => $term) {

                $wpdb->update(
                    $rating_terms_table,
                    array('term_name' => $term),
                    array('term_id' => $term_id)
                );

            }

        }

        $rating_terms = $wpdb->get_results( "SELECT * FROM $rating_terms_table", ARRAY_A );

        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        ?>

        <div class="wrap">
            <h3>Rating Terms</h3>

            <form method="post" action="">

                <table>

                <?php $index = 1; foreach ($rating_terms as $term) : ?>

                    <tr>
                        <td>Rating <?php echo $index ?></td>
                        <td><input type="text" name="term[<?php echo $term['term_id'] ?>]" value="<?php echo $term['term_name'] ?>" /></td>
                    </tr>

                <?php $index++; endforeach; ?>

                </table>

                <input type="submit" name="update_rating_terms" value="Save" />

            </form>

        </div>

        <?php

    }

}

$ratings_sets_page = new Holo_Ratings_Sets_Page();

