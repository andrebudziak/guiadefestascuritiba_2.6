<?php

class HT_Contact_Dynamic_Meta_Box extends HT_Dynamic_Meta_Boxes {

    public function show_markup() {

        if (!$this->meta_fields) {

            $this->meta_fields['address']['icon'] = 'fa-location';
            $this->meta_fields['phone']['icon'] = 'fa-phone';
            $this->meta_fields['email']['icon'] = 'fa-mail-alt';
            $this->meta_fields['website']['icon'] = 'fa-globe';

            $this->meta_fields['address']['value'] = 'Your Address';
            $this->meta_fields['phone']['value'] = 'Your Phone';
            $this->meta_fields['email']['value'] = 'Your Email';
            $this->meta_fields['website']['value'] = 'Your Website';

        }

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

                if (isset($this->meta_fields['address'])) :

                    ?>

                    <tr>
                        <td>
                            <div class="icon-container"><input type="text" class="icons-select" name="contact[address][icon]" value="<?php echo $this->meta_fields['address']['icon'] ?>" /></div>
                        </td>
                        <td>
                            <input type="text" size="50" name="contact[address][value]" value="<?php echo esc_attr($this->meta_fields['address']['value']) ?>" />
                        </td>
                        <td><span class="remove">Remove Field</span></td>
                    </tr>

                    <?php

                    unset($this->meta_fields['address']);

                endif;

                if (isset($this->meta_fields['phone'])) :

                    ?>

                    <tr>
                        <td>
                            <div class="icon-container"><input type="text" class="icons-select" name="contact[phone][icon]" value="<?php echo $this->meta_fields['phone']['icon'] ?>" /></div>
                        </td>
                        <td>
                            <input type="text" size="50" name="contact[phone][value]" value="<?php echo esc_attr($this->meta_fields['phone']['value']) ?>" />
                        </td>
                        <td><span class="remove">Remove Field</span></td>
                    </tr>

                    <?php

                    unset($this->meta_fields['phone']);

                endif;

                if (isset($this->meta_fields['email'])) :

                    ?>

                    <tr>
                        <td>
                            <div class="icon-container"><input type="text" class="icons-select" name="contact[email][icon]" value="<?php echo $this->meta_fields['email']['icon'] ?>" /></div>
                        </td>
                        <td>
                            <input type="text" size="50" name="contact[email][value]" value="<?php echo esc_attr($this->meta_fields['email']['value']) ?>" />
                        </td>
                        <td><span class="remove">Remove Field</span></td>
                    </tr>

                    <?php

                    unset($this->meta_fields['email']);

                endif;

                if (isset($this->meta_fields['website'])) :

                    ?>

                    <tr>
                        <td>
                            <div class="icon-container"><input type="text" class="icons-select" name="contact[website][icon]" value="<?php echo $this->meta_fields['website']['icon'] ?>" /></div>
                        </td>
                        <td>
                            <input type="text" size="50" name="contact[website][value]" value="<?php echo esc_attr($this->meta_fields['website']['value']) ?>" />
                        </td>
                        <td><span class="remove">Remove Field</span></td>
                    </tr>

                    <?php

                    unset($this->meta_fields['website']);

                endif;

                $this->fields_count = 1;
                if ( is_array($this->meta_fields) && count( $this->meta_fields ) > 0 ) {
                    foreach( $this->meta_fields as $field ) {
                        if ( isset( $field['value'] ) ) {
                            printf( '
                    <tr>
                        <td>
                            <div class="icon-container"><input type="text" class="icons-select" name="' . $this->post_meta_slug . '[%1$s][icon]" value="%2$s" /></div>
                        </td>
                        <td>
                            <input type="text" class="ht-value-field" size="50" name="' . $this->post_meta_slug . '[%1$s][value]" value="%3$s" />
                        </td>
                        <td><span class="remove">%4$s</span></td>
                    </tr>',
                                $this->fields_count, $field['icon'], esc_attr($field['value']), __( 'Remove Field' ) );
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
                            '<div class="icon-container"><input type="text" class="icons-select" name="<?php echo $this->post_meta_slug ?>[' + count + '][icon]" value="" /></div>' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" class="ht-value-field" size="50" name="<?php echo $this->post_meta_slug ?>['+count+'][value]" value="" />' +
                            '</td>' +
                            '<td>' +
                            '<span class="remove">Remove Field</span>' +
                            '</td><' +
                            '/tr>';

                        $this.find('.ht-contact-table tbody').append(appendMarkup);

                        $this.find('.icons-select').iconsform();

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

}