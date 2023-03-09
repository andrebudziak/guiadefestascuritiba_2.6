<?php

class HT_Dynamic_Meta_Boxes {

    public $args;
    public $post_meta_slug;
    public $meta_fields;
    public $fields_count;

    function __construct($post_meta_slug, $args = array()) {

        $this->args = $args;
        $this->post_meta_slug = $post_meta_slug;

        add_action( 'add_meta_boxes', array($this, 'add_meta_box') );

//        $this->add_meta_box();

        add_action( 'save_post', array($this, 'save_callback_function') );
    }

    function add_meta_box() {

        global $post;
        $this->meta_fields = get_post_meta($post->ID, $this->post_meta_slug, true);

        add_meta_box(
            $this->args['id'],
            $this->args['title'],
            array($this, 'display_callback_function'),
            $this->args['post_type'],
            $this->args['context'],
            $this->args['priority']
        );

    }

    public function display_callback_function() {

        wp_nonce_field( plugin_basename( __FILE__ ), $this->post_meta_slug . '_nonce' );

        $this->show_markup();

        $this->show_script();
    }

    public function show_markup() {

        ?>

        <style type="text/css">

            table.ht-contact-table tbody td {
                border-width: 0;
                box-shadow: none;
                display: table-cell;
                margin: 0;
                padding: 10px;
            }

            table.ht-contact-table tbody td {
                background-color: #efefef;
            }

            table.ht-contact-table thead th {
                text-align: left;
            }

            table.ht-contact-table .icon-holder, table.ht-contact-table .icon-container {
                display: inline-block;
            }

            table.ht-contact-table .icon-holder i {
                margin: 0;
            }

        </style>

        <div id="<?php echo $this->args['id'] ?>" class="meta_generator">

            <table class="ht-contact-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Value</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php

                $this->fields_count = 1;
                if ( is_array($this->meta_fields) && count( $this->meta_fields ) > 0 ) {
                    foreach( $this->meta_fields as $field ) {
                        if ( isset( $field['value'] ) ) {
                            printf( '
                    <tr>
                        <td>
                            <input type="text" class="ht-name-field" name="' . $this->post_meta_slug . '[%1$s][icon]" value="%2$s" />
                        </td>
                        <td>
                            <input type="text" class="ht-value-field" size="50" name="' . $this->post_meta_slug . '[%1$s][value]" value="%3$s" />
                        </td>
                        <td><span class="remove">%4$s</span></td>
                    </tr>',
                                $this->fields_count, $field['icon'], $field['value'], __( 'Remove Field' ) );
                            $this->fields_count++;
                        }
                    }
                }

                ?>

                </tbody>
            </table>

            <span class="add button" style="margin-top: 10px"><?php _e('Add Field'); ?></span>

        </div>

    <?php

    }

    public function show_script() {

        ?>

        <script type="text/javascript">
            var $ = jQuery.noConflict();
            $(document).ready(function() {

                $.fn.HT_Meta_Generator = function() {

                    var $this = $(this);

                    var count = <?php echo  $this->fields_count; ?>;

                    $this.find(".add").click(function() {
                        count = count + 1;

                        var appendMarkup = '' +
                            '<tr>' +
                            '<td>' +
                            '<input type="text" class="ht-name-field" name="<?php echo $this->post_meta_slug ?>[' + count + '][icon]" value="" />' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" class="ht-value-field" size="50" name="<?php echo $this->post_meta_slug ?>['+count+'][value]" value="" />' +
                            '</td>' +
                            '<td>' +
                            '<span class="remove">Remove Field</span>' +
                            '</td><' +
                            '/tr>';

                        $this.find('.ht-contact-table tbody').append(appendMarkup);

                        return false;
                    });

                    $this.find(".remove").live('click', function() {

                        $(this).closest('tr').remove();

                    });

                };

                $('#<?php echo $this->args['id'] ?>').HT_Meta_Generator();

            });
        </script>

        <?php

    }

    public function save_callback_function($post_id) {

        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we dont want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;

        if (isset($_POST[$this->post_meta_slug . '_nonce'])) {

            // verify this came from the our screen and with proper authorization,
            // because save_post can be triggered at other times
            if ( !wp_verify_nonce($_POST[$this->post_meta_slug . '_nonce'], plugin_basename(__FILE__)) )
                return;

            // OK, we're authenticated: we need to find and save the data

            if (isset($_POST[$this->post_meta_slug])) {

                $meta_fields = $_POST[$this->post_meta_slug];

            } else {

                $meta_fields = array();

            }

            update_post_meta($post_id, $this->post_meta_slug , $meta_fields);

        }

    }

}