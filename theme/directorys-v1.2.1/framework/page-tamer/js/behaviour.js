(function($) {

    "use strict";

    $.Behaviour = function(obj) {

        this.page_tamer = obj;

        var behaviour = this;

        $(".holo-style-options").mCustomScrollbar({
            scrollInertia: 70,
            mouseWheelPixels: 70,
            advanced:{
                updateOnContentResize: true
            },
            theme: 'dark'
        });

//        $(".holo-main-options").mCustomScrollbar({
//            scrollInertia: 70,
//            mouseWheelPixels: 70,
//            advanced:{
//                updateOnContentResize: true
//            },
//            theme: 'dark'
//        });

//        $('.holo-color-palette').color_palette();

        behaviour.page_tamer.switch_button.click(function(e) {

            if (behaviour.page_tamer.status == 'on') {
                behaviour.page_tamer.switch_button.text(window.tamer_locale.main_switch_button);
                behaviour.page_tamer.default_editor.show();
                behaviour.page_tamer.page_tamer.hide();
                behaviour.page_tamer.status = 'off';
                localStorage.setItem('holo_page_tamer', 'off');
            } else {
                behaviour.page_tamer.switch_button.text(window.tamer_locale.main_switch_button_close);
                behaviour.page_tamer.default_editor.hide();
                behaviour.page_tamer.page_tamer.show();
                behaviour.page_tamer.status = 'on';
                localStorage.setItem('holo_page_tamer', 'on');
            }

        });

        behaviour.page_tamer.new_row_button.click(function(event) {

            event.preventDefault();

            var tag = 'holo_row';

            var columns_markup = '';
            var attributes_string = '';

            var columns_structures = JSON.parse(behaviour.page_tamer.columns_structures);

            $.each(columns_structures, function(key, value) {

                columns_markup += '<li class="columns-structure" data-structure="' + value.structure + '">' + value.name + '</li>';

            });

            var row_attributes = $.extend({},behaviour.page_tamer.shortcodes[tag].attributes, behaviour.page_tamer.shortcodes[tag].style_atts);

            $.each(row_attributes, function(attr, attr_value) {

                attributes_string += ' ' + attr + '="' + attr_value.default + '"';

            });

            var row_markup = '' +
                '<div class="holo-row holo-sortable" data-element-id="holo_row">' +
                '<div class="row-header clearfix">' +
                    '<ul class="row-columns-structure clearfix">' +
                    columns_markup +
                    '</ul>' +
                    '<div class="element-delete"><i class="linecons-trash-1"></i></div>' +
                    '<div class="element-settings"><i class="linecons-cog-1"></i></div>' +
                '</div>' +
                '<div class="row-content connected-columns clearfix">' +
                    '<div data-size="col-sm-12" class="holo-column col-sm-12 connected_sortables">' +
                        '<div class="column-body sortable-columns ui-droppable ui-sortable"></div>' +
                    '</div>' +
                '</div>' +
                '<div class="element-shortcode" style="display: none">[holo_row ' + attributes_string + ']</div>' +
                '</div>';

            row_markup = $(row_markup);

            behaviour.page_tamer.workplace.append(row_markup);

            behaviour.handle_columns_change();

            behaviour.page_tamer.make_them_sortable();

            behaviour.page_tamer.update_editor_content();

        });

        $('.children-container').on('click', '.holo-child', function() {

            var $clicked_sc = $(this);

            var element_id = $clicked_sc.attr('data-element-id');

            $.holo_modal.open({
                form: '#' + element_id + '-form',
                close: '.form-close',
                onStart: function() {
                    behaviour.open_shortcode_panel($clicked_sc);
                },
                onSave: function() {
                    behaviour.shortcode_child_save();
                }
            });

            behaviour.page_tamer.active_options_shortcode_child = $(this);

        });

        $('.add-child').click(function() {

            var attributes_string = '';
            var children_class = $(this).attr('data-children-class');

            $.each(behaviour.page_tamer.shortcodes[children_class].attributes, function(attr_key, attr_value) {

                attributes_string += ' ' + attr_key + '=""';

            });

            var content = '';

            var child_html =
                '<a class="holo-child" href="#' + children_class + '-form" rel="leanModal" data-element-id="' + children_class + '">' +
                    '<div class="child-body">' +
                    '<div class="element-delete"><i class="linecons-trash-1"></i></div>' +
                    '<span class="child-shortcode-title">' + behaviour.page_tamer.shortcodes[children_class].name + '</span>' +
                    '</div>' +
                    '<div class="child-shortcode" style="display: none">[' + children_class + attributes_string + ']' + content + '[/' + children_class + ']</div>' +
                    '</a>';

            $(this).closest('td').find('.children-container').append(child_html);

        });

        $('.children-container').on('click', '.holo-child .element-delete', function() {

            var element = $(this).parents('.holo-child');

            element.remove();

            return false;

        });

        behaviour.page_tamer.workplace.on('click', '.holo-element .element-header .element-delete', function(event) {

            event.stopPropagation();

            event.preventDefault();

            var element = $(this).parents('.holo-element');

            element.remove();

            behaviour.page_tamer.update_editor_content();

        });

        behaviour.page_tamer.workplace.on('click', '.holo-element .element-header .element-duplicate', function(event) {

            event.stopPropagation();

            event.preventDefault();

            var element = $(this).parents('.holo-element');
            var column = $(this).closest('.column-body');

            var $cloned_element = element.clone(true, true);

            var shortcode_id = $cloned_element.attr('data-element-id');

            var new_unique_id = shortcode_id + '-' + Math.floor(Math.random() * (9999 - 1000) + 1000);

            var element_shortcode = $cloned_element.find('.element-shortcode').html();

            var unique_id_attr = '';

            element_shortcode.match(/unique_id="(.*?)"/g).map(function(val) {
                 unique_id_attr = val;
            });

            var new_shortcode = element_shortcode.replace(unique_id_attr, 'unique_id="' + new_unique_id + '"');

            $cloned_element.find('.element-shortcode').html(new_shortcode);

            $cloned_element.appendTo(column);

            behaviour.page_tamer.update_editor_content();

        });

        behaviour.page_tamer.workplace.on('click', '.holo-row .row-header .element-delete', function() {

            var row = $(this).parents('.holo-row');

            row.remove();

            behaviour.page_tamer.update_editor_content();

        });

        $('.page-tamer-container .white-popup-block').on('click', '.image-delete', function(event) {

            event.preventDefault();

            $(this).parents('.upload-wrapper').find('img').remove();

            $(this).parents('.upload-container').find('input').val('');

            $(this).remove();

        });

        $('.page-tamer-container .white-popup-block').on('click', '.icon-delete', function(event) {

            event.preventDefault();

            $(this).closest('td').children('i').remove();

            $(this).closest('td').find('.icon-container input').val('');

            $(this).remove();

        });

        behaviour.page_tamer.workplace.on('click', '.holo-row .row-header .element-settings', function() {

            behaviour.page_tamer.active_options_shortcode = $(this).closest('.holo-row');

            var shortcode = $(this).closest('.holo-row').children('.element-shortcode').html();
            var form = '#holo_row-form';

            behaviour.page_tamer.parse_shortcode(shortcode, form);

            var modalWidth = $(form).width();

            $.holo_modal.open({
                form: form,
                title: 'Row Settings',
                close: '.form-close',
                onSave: function() {
                    behaviour.shortcode_save();
                }
            });

        });

        behaviour.page_tamer.workplace.on('click', '.holo-element', function(event) {

            event.preventDefault();

            var element_id = $(this).attr('data-element-id');

            if ( !$(this).hasClass('noclick') ) {
                behaviour.page_tamer.active_options_shortcode = $(this);

                var shortcode = $(this).find('.element-shortcode').html();

                behaviour.page_tamer.parse_shortcode(shortcode, '#' + element_id + '-form');

                $.holo_modal.open({
                    form: '#' + element_id + '-form',
                    title:  behaviour.page_tamer.shortcodes[element_id].name,
                    close: '.form-close',
                    onSave: function() {
                        behaviour.shortcode_save();
                    },
                    onStart: function() {
                        $('.holo-custom-css').change(function() {

                            if ( $(this).is(':checked') ) {

                                $('.white-popup-block').css({
                                    width: '1200px'
                                });

                                $('.holo-modal-wrapper').css({
                                    marginLeft: '-630px'
                                });

                                $('.holo-style-options').css('display', 'block');

                                $(".holo-style-options").mCustomScrollbar('update');

                            } else {

                                $('.holo-style-options').css('display', 'none');

                                $('.white-popup-block').css({
                                    width: '900px'
                                });

                                $('.holo-modal-wrapper').css({
                                    marginLeft: '-480px'
                                });

                            }

                        });
                    },
                    onClose: function() {

                    }
                });
            }

        });

        this.handle_columns_change();

    };

    $.Behaviour.prototype = {

        handle_columns_change: function() {

            var behaviour = this;

            $('.columns-structure').click(function() {

                var structure = $(this).data('structure');
                var column_classes = structure.split('|');
                var columns_number = column_classes.length;
                var this_row_content_area = $(this).parents('.holo-row').find('.row-content');
                var columns = this_row_content_area.find('.holo-column');
                var old_columns_number = this_row_content_area.children().length;

                if ( old_columns_number > 0 ) {

                    if ( old_columns_number > columns_number ) {

                        for (var i = 0; i < old_columns_number; i++ ) {

                            if ( i > (columns_number - 1) ) {

                                columns.eq(i).find('.column-body').find('.holo-element').appendTo(columns.eq(columns_number - 1).find('.column-body'));

                                columns.eq(i).remove();

                            }

                        }

                    }

                    for (var i = 0; i < columns_number; i++) {

                        if ( columns.eq(i).length > 0 ) {

                            columns.eq(i)
                                .removeAttr('class')
                                .addClass('holo-column ' + column_classes[i] + ' connected_sortables')
                                .attr('data-size', column_classes[i]);

                        } else {

                            this_row_content_area.append(
                                '<div class="holo-column ' + column_classes[i] + '" data-size="' + column_classes[i] + '">' +
                                    '<div class="column-body sortable-columns"></div>' +
                                '</div>'
                            );

                        }

                    }

                } else {

                    for (var i = 0; i < columns_number; i++) {

                        this_row_content_area.append(
                            '<div class="holo-column ' + column_classes[i] + '" data-size="' + column_classes[i] + '">' +
                                '<div class="column-body sortable-columns"></div>' +
                            '</div>'
                        );

                    }

                }

                behaviour.page_tamer.make_them_sortable();

                behaviour.page_tamer.update_editor_content();
            });

        },

        shortcode_save: function() {

            var behaviour = this;

            var active_element = behaviour.page_tamer.active_options_shortcode;

            var shortcode_id = active_element.data('element-id');

            var shortcode_obj = behaviour.page_tamer.shortcodes[shortcode_id];

            var shortcode_attributes = $.Holo.concat(shortcode_obj.style_atts, shortcode_obj.attributes);

            var shortcode_tag = shortcode_id;

            var shortcode_has_children = shortcode_obj.children_class;

            var shortcode_atts = '';
            var shortcode_content = '';

            if ( null !== shortcode_attributes ) {
                $.each(shortcode_attributes, function(key, val) {

                    if ( 'checkbox' === val.type) {

                        shortcode_atts += ' ' + key + '="' + $('.' + shortcode_tag + '-' + key + ':checked').val() + '"';

                    } else {

                        var value = $('.' + shortcode_tag + '-' + key).val();

                        shortcode_atts += ' ' + key + '="' + value + '"';

//                        if ( $('.' + shortcode_tag + '-' + key).data('attribute') == 'color-palette' ) {
//
//                            var $color_palette_container = $('.' + shortcode_tag + '-' + key).closest('td').find('.color-palette-container');
//
//                            $.each($color_palette_container.find('.palette-color'), function() {
//
//                                var key = $(this).data('color-key');
//                                var value = $(this).val();
//
//                                shortcode_atts += ' ' + key + '="' + value + '"';
//
//                            });
//
//                        }

                    }

                });

                var uninque_id = $('.unique-id').val();

                shortcode_atts += ' unique_id="' + uninque_id + '"';

            }

            if ( null !== shortcode_obj.content ) {

                if ( shortcode_obj.content.type == 'editor' ) {
                    var content_id = $('.' + shortcode_tag + '-content').closest('td').find('textarea').attr('id');

                    window.tinyMCE.execCommand("mceRemoveControl", true, content_id);

                    window.tinyMCE.execCommand("mceAddEditor", true, content_id);

                    //window.tinyMCE.removeClass('html-active').addClass('tmce-active');

                    shortcode_content += tinyMCE.get(content_id).getContent();
                } else {
                    shortcode_content += $('.' + shortcode_tag + '-content').val();
                }

            }

            if ( shortcode_has_children ) {

                $('#' + shortcode_tag + '-form').find('.children-container').children('.holo-child').each(function() {

                    shortcode_content += $(this).find('.child-shortcode').html();

                });

            }

            if ( shortcode_tag == 'holo_row' ) {

                var shortcode = '[' + shortcode_tag + shortcode_atts + ']';

            } else {

                var shortcode = '[' + shortcode_tag + shortcode_atts + ']' + shortcode_content + '[/' + shortcode_tag + ']';

            }

            active_element.children('.element-shortcode').html(shortcode);

            behaviour.page_tamer.update_editor_content();

            return false;
        },

        shortcode_child_save: function() {

            var behaviour = this;

            var active_element = behaviour.page_tamer.active_options_shortcode_child;

            var shortcode_id = active_element.data('element-id');

            var shortcode_obj = behaviour.page_tamer.shortcodes[shortcode_id];

            var shortcode_attributes = shortcode_obj.attributes;

            var shortcode_tag = shortcode_id;

            var shortcode_atts = '';

            console.log('child shortcodes attributes: ', shortcode_attributes);

            var shortcode_content = '';

            if ( null !== shortcode_attributes ) {
                $.each(shortcode_attributes, function(key, val) {

                    if ( 'checkbox' === val.type) {

                        shortcode_atts += ' ' + key + '="' + $('.' + shortcode_tag + '-' + key + ':checked').val() + '"';

                    } else {
                        shortcode_atts += ' ' + key + '="' + $('.' + shortcode_tag + '-' + key).val() + '"';
                    }

                });
            }

            if ( null !== shortcode_obj.content ) {

                if ( shortcode_obj.content.type == 'editor' ) {
                    var content_id = $('.' + shortcode_tag + '-content').closest('td').find('textarea').attr('id');

                    window.tinyMCE.execCommand("mceRemoveControl", true, content_id);

                    shortcode_content += tinyMCE.get(content_id).getContent();
                } else {
                    shortcode_content += $('.' + shortcode_tag + '-content').val();
                }

            }

            var shortcode = '[' + shortcode_tag + shortcode_atts + ']'  + shortcode_content + '[/' + shortcode_tag + ']';

            active_element.find('.child-shortcode').html(shortcode);

            return false;
        },

        editor_add: function($form) {

            var behaviour = this;

            var shortcode_id = $form.data('element-id');

            var content_editor_id = $('textarea[id^="holo-editor-"]').attr('id');

            var shortcode_obj = behaviour.page_tamer.shortcodes[shortcode_id];

            var shortcode_attributes = $.Holo.concat(shortcode_obj.style_atts, shortcode_obj.attributes);

            var shortcode_tag = shortcode_id;

            var shortcode_has_children = shortcode_obj.children_class;

            var shortcode_atts = '';
            var shortcode_content = '';

            if ( null !== shortcode_attributes ) {
                $.each(shortcode_attributes, function(key, val) {

                    if ( 'checkbox' === val.type) {

                        shortcode_atts += ' ' + key + '="' + $('.' + shortcode_tag + '-' + key + ':checked').val() + '"';

                    } else {

                        var value = $('.' + shortcode_tag + '-' + key).val();

                        shortcode_atts += ' ' + key + '="' + value + '"';

                    }

                });
            }

            if ( null !== shortcode_obj.content ) {

                if ( shortcode_obj.content.type == 'editor' ) {

                    window.tinyMCE.execCommand("mceRemoveEditor", true, content_editor_id);

                    shortcode_content += $('#' + content_editor_id).val();

                } else {
                    shortcode_content += $('.' + shortcode_tag + '-content').val();
                }

            }

            if ( shortcode_has_children ) {

                $('#' + shortcode_tag + '-form').find('.children-container').children().each(function() {

                    shortcode_content += $(this).find('.child-shortcode').html();

                });

            }

            if ( shortcode_tag == 'holo_row' ) {

                var shortcode = '[' + shortcode_tag + shortcode_atts + ']';

            } else {

                var shortcode = '[' + shortcode_tag + shortcode_atts + ']' + shortcode_content + '[/' + shortcode_tag + ']';

            }

            window.tinyMCE.execCommand('mceInsertContent', 0, shortcode);

        },

        open_shortcode_panel: function($clicked_sc) {

            var behaviour = this;

            var shortcode = $clicked_sc.find('.child-shortcode').html();

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'holo_parse_shortcode',
                    shortcode: shortcode
                },
                beforeSend: function() {

                    var id = $clicked_sc.data('element-id');

                    $('#' + id + '-form fieldset').css('visibility', 'hidden');

                },
                success: function(data) {

                    data = JSON.parse(data);

                    console.log('child content: ', data);

                    if ( null !== data.attributes ) {
                        $.each(data.attributes, function(key, value) {

                            $.Input_Fields[value.type].handle_front_end('.' + data.shortcode + '-' + key, value.value);

                        });
                    }

                    if ( null !== behaviour.page_tamer.shortcodes[data.shortcode].content ) {
                        var content_type = behaviour.page_tamer.shortcodes[data.shortcode].content.type;

                        $.Input_Fields[content_type].handle_front_end('.' + data.shortcode + '-content', data.content);
                    }

                    $('#' + data.shortcode + '-form fieldset').css('display', 'block');
                    $('#' + data.shortcode + '-form fieldset').css('visibility', 'visible');
                }
            });

        }

    }

})(jQuery);
