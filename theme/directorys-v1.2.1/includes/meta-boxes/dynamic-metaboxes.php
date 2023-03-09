<?php

// Custom Meta Box

add_action( 'add_meta_boxes', 'holo_dynamic_add_custom_box' );

/* Do something with the data entered */
add_action( 'save_post', 'holo_dynamic_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function holo_dynamic_add_custom_box() {
    add_meta_box(
        'site_address',
        __( 'Contact', 'myplugin_textdomain' ),
        'holo_dynamic_address_contact',
        'site', 'normal', 'low');
}

/* Prints the box content */
function holo_dynamic_address_contact() {
    global $post;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'site_contact_nonce' );
    ?>
    <div id="meta_inner">
    <?php

    //get the saved meta as an arry
    $contact_fields = get_post_meta($post->ID,'contact',true);

    if (!$contact_fields) {

        $contact_fields['address']['icon'] = 'fa-location';
        $contact_fields['phone']['icon'] = 'fa-phone';
        $contact_fields['email']['icon'] = 'fa-mail';
        $contact_fields['website']['icon'] = 'fa-globe';

        $contact_fields['address']['value'] = 'Your Address';
        $contact_fields['phone']['value'] = 'Your Phone';
        $contact_fields['email']['value'] = 'Your Email';
        $contact_fields['website']['value'] = 'Your Website';

    }

    ?>

    <table class="ht-contact-table">
        <thead>
            <tr>
                <th>Contact Icon</th>
                <th>Contact Value</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php

        if ($contact_fields['address']) :

            ?>

            <tr>
                <td>
                    <div class="icon-container"><input type="text" class="icons-select" name="contact[address][icon]" value="<?php echo $contact_fields['address']['icon'] ?>" /></div>
                </td>
                <td>
                    <input type="text" size="50" name="contact[address][value]" value="<?php echo $contact_fields['address']['value'] ?>" />
                </td>
                <td><span class="remove">Remove Field</span></td>
            </tr>

            <?php

            unset($contact_fields['address']);

        endif;

        if ($contact_fields['phone']) :

            ?>

            <tr>
                <td>
                    <div class="icon-container"><input type="text" class="icons-select" name="contact[phone][icon]" value="<?php echo $contact_fields['phone']['icon'] ?>" /></div>
                </td>
                <td>
                    <input type="text" size="50" name="contact[phone][value]" value="<?php echo $contact_fields['phone']['value'] ?>" />
                </td>
                <td><span class="remove">Remove Field</span></td>
            </tr>

            <?php

            unset($contact_fields['phone']);

        endif;

        if ($contact_fields['email']) :

            ?>

            <tr>
                <td>
                    <div class="icon-container"><input type="text" class="icons-select" name="contact[email][icon]" value="<?php echo $contact_fields['email']['icon'] ?>" /></div>
                </td>
                <td>
                    <input type="text" size="50" name="contact[email][value]" value="<?php echo $contact_fields['email']['value'] ?>" />
                </td>
                <td><span class="remove">Remove Field</span></td>
            </tr>

            <?php

            unset($contact_fields['email']);

        endif;

        if ($contact_fields['website']) :

            ?>

            <tr>
                <td>
                    <div class="icon-container"><input type="text" class="icons-select" name="contact[website][icon]" value="<?php echo $contact_fields['website']['icon'] ?>" /></div>
                </td>
                <td>
                    <input type="text" size="50" name="contact[website][value]" value="<?php echo $contact_fields['website']['value'] ?>" />
                </td>
                <td><span class="remove">Remove Field</span></td>
            </tr>

            <?php

            unset($contact_fields['website']);

        endif;

    $c = 1;
    if ( is_array($contact_fields) && count( $contact_fields ) > 0 ) {
        foreach( $contact_fields as $contact ) {
            if ( isset( $contact['value'] ) ) {
                printf( '
                    <tr>
                        <td>
                            <div class="icon-container"><input type="text" class="icons-select" name="contact[%1$s][icon]" value="%2$s" /></div>
                        </td>
                        <td>
                            <input type="text" size="50" name="contact[%1$s][value]" value="%3$s" />
                        </td>
                        <td><span class="remove">%4$s</span></td>
                    </tr>',
                    $c, $contact['icon'], $contact['value'], __( 'Remove Field' ) );
                $c = $c +1;
            }
        }
    }

    ?>

        </tbody>
    </table>

    <span class="add button" style="margin-top: 10px"><?php _e('Add Field'); ?></span>

    <script>
        var $ =jQuery.noConflict();
        $(document).ready(function() {

            var count = <?php echo $c; ?>;

            $(".add").click(function() {
                count = count + 1;

                appendMarkup = '' +
                    '<tr><td><div class="icon-container"><input type="text" class="icons-select" name="contact[' + count + '][icon]" value="" /></div></td>' +
                    '<td><input type="text" size="50" name="contact['+count+'][value]" value="" /></td>' +
                    '<td><span class="remove">Remove Field</span></td></tr>';

                $('.ht-contact-table tbody').append(appendMarkup);

                $('.icons-select').iconsform();

                return false;
            });

            $(".remove").live('click', function() {
                $(this).closest('tr').remove();
            });

        });
    </script>
    </div><?php

}

/* When the post is saved, saves our custom data */
function holo_dynamic_save_postdata( $post_id ) {
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    if (isset($_POST['site_contact_nonce'])) {

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !wp_verify_nonce($_POST['site_contact_nonce'], plugin_basename(__FILE__)) )
            return;

        // OK, we're authenticated: we need to find and save the data

        $contact_fields = $_POST['contact'];

        update_post_meta($post_id,'contact', $contact_fields);

    }
}