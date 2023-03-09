(function($) {

    "use strict";

    $.HoloBuilder = function() {

        this.status = localStorage.getItem('holo_page_tamer');

        this.is_active_tinyMCE = typeof window.tinyMCE !== 'undefined';

        this.page_tamer = $('#page-tamer.postbox');

        this.text_area = $('.wp-editor-area');

        this.default_editor = $('#postdivrich');

        this.workplace = $('.holo-planner-workspace');

        this.switch_button_markup = $('<a class="holo-switch-to-page-tamer button-primary" href="#">' + window.tamer_locale.main_switch_button + '</a>');

        this.switch_button = '';

        this.new_row_button = $('#holo-new-row');

        this.columns = {};

        this.columns_structures = {};

        this.shortcodes = null;

        this.active_options_shortcode = '';

        this.active_options_shortcode_child = '';

        this.editor_text = '';

        this.init();

    };

    $.HoloBuilder.prototype = {

        init: function() {

            var _page_tamer = this;

            this.get_columns();
            this.get_columns_structures();

            this.place_in_position();

            $('#page-tamer .inside .page-tamer-items-pane').hide();
            $('#page-tamer .inside .page-tamer-container').hide();

            // Populate the "shortcodes" variable with the registered shortcodes from the server
            $.getJSON( ajaxurl, { action: 'holo_get_shortcodes_objects' }, function(data) {

//                console.log(data);

                _page_tamer.shortcodes = data;

                _page_tamer.generate_forms();

                _page_tamer.generate_shortcodes_models();

                $.when(_page_tamer.transform_shortcodes_to_interface()).done(function() {
                    $('#page-tamer .inside .page-tamer-items-pane').show();
                    $('#page-tamer .inside .page-tamer-container').show();
                    $('.loading-screen').hide();
                });

            });

        },

        get_columns: function() {

            var _this = this;

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'holo_get_columns'
                },
                success: function(data) {

//                    console.log(data);

                    data = JSON.parse(data);

                    _this.columns = data;

                },
                error: function() {}
            });

        },

        get_columns_structures: function() {

            var _this = this;

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'holo_get_columns_structures'
                },
                success: function(data) {

                    _this.columns_structures = data;

                },
                error: function() {

                }
            });

        },

        /**
         * Place the page builder layout
         */
        place_in_position: function() {

            this.switch_button = this.switch_button_markup.insertAfter('div#titlediv').wrap('<p class="holo-switch-wrapper" />');

            var wp_meta_boxes = $('#normal-sortables .postbox');
            var page_tamer_box = $('#page-tamer');

            if ( this.status == 'on' ) {
                this.default_editor.hide();
                this.page_tamer.show();
            }

            if ( 0 !== wp_meta_boxes.index(page_tamer_box) ) {

            }

        },

        /**
         * Generate a form markup for each registered shortcode
         */
        generate_forms: function() {

            var forms = '';

            $.each(this.shortcodes, function(sc_id, sc_obj) {

                var fields = '';
                var style_fields = '';

                if ( null !== sc_obj.content ) {

                    fields += $.Input_Fields.get_field_markup(sc_id, 'content', sc_obj.content);

                }

                if ( sc_obj.attributes !== null ) {

                    $.each(sc_obj.attributes, function(key, attribute) {

                        fields += $.Input_Fields.get_field_markup(sc_id, key, attribute);

                    });

                    $.each(sc_obj.style_atts, function(key, attribute) {

                        style_fields += $.Input_Fields.get_field_markup(sc_id, key, attribute);

                    });

                }

                if (sc_obj.children_class ) {

                    fields +=
                        '<tr>' +
                        '<td colspan="2">' +
                        '<label>Children container</label>' +
                        '<button class="add-child" data-children-class="' + sc_obj.children_class + '">+add child</button>' +
                        '<div class="children-container"></div>' +
                        '</td>' +
                        '</tr>';

                }

                if ( sc_obj.child === true ) {

                    var form_markup =
                        '<div id="' + sc_id + '-form" class="white-popup-block children-modal" data-element-id="' + sc_id + '">' +
                            '<fieldset style="border:0;">' +
                            '<table class="holo-main-options">' + fields + '</table>' +
                            '</fieldset>' +
                        '</div>';

                } else {

                    var form_markup =
                        '<div id="' + sc_id + '-form" class="white-popup-block" data-element-id="' + sc_id + '">' +
                            '<fieldset style="border:0;">' +
                            '<table>' +
                                '<tr>' +
                                    '<td class="holo-main-options">' +
                                        '<table>' + fields + '</table>' +
                                    '</td>' +
                                    '<td class="holo-style-options">' +
                                        '<table style="width: 100%">' + style_fields + '</table>' +
                                    '</td>' +
                                '</tr>' +
                            '</table>' +
                            '</fieldset>' +
                        '</div>';

                }

                forms += form_markup;

            });

            var social_icons = {
                facebook: 'Facebook Link',
                twitter: 'Twitter Link',
                google_plus: ' Google Plus Link',
                dribbble: 'Dribbble Link',
                vimeo: 'Vimeo Link',
                skype: 'Skype Link',
                linkedin: 'Linkedin Link',
                pinterest: 'Pinterest Link'
            };

            var social_inputs = '';

            $.each(social_icons, function(key, value) {

                social_inputs += '<label>' + value + '</label><br /><input type="text" class="" data-social-name="' + key + '" value="" /><br />'

            });

            forms += '<div id="social-icons-form" class="white-popup-block">' +
                '<h3>Social Icons</h3>' +
                '<div class="social-inputs">' +
                    social_inputs +

                    '<button class="social-icons-save">Save</button>' +
                '</div>' +
                '</div>';

            $('.page-tamer-container').append(forms);

        },

        /**
         * Creates a model for each registered shortcode
         */
        generate_shortcodes_models: function() {

            var _page_tamer = this;
            var models_markup = '';

            $.each(_page_tamer.shortcodes, function(key, sc_obj) {

                var shortcode_string = '';
                var attributes_string = '';
                var shortcode_content = '';

                if ( !sc_obj.child && sc_obj.show_as_model ) {

                    if ( sc_obj.attributes !== null ) {

                        var model_attributes = $.extend({}, sc_obj.attributes, sc_obj.style_atts);

                        $.each(model_attributes, function(key, attribute) {

                            var default_value = (attribute.default !== undefined ? attribute.default : '');

                            attributes_string += ' ' + key + '="' + default_value + '"';

                        });

                    }

                    shortcode_string += '[' + key + '' + attributes_string + ']' + shortcode_content + '[/' + key + ']';

                    models_markup += '' +
                        '<div class="page-tamer-item" data-element-id="' + key + '">' +
                            '<div class="element-header">' +
                                '<div class="element-drag"><i class="fa-menu"></i></div>' +
                                '<span class="shortcode-title"></span>' +
                                '<div class="element-delete"><i class="linecons-trash-1"></i></div>' +
                                '<div class="element-duplicate"><i class="fa-docs"></i></div>' +
                            '</div>' +
                            '<div class="element-body">' +
                                '<i class="fa ' + sc_obj.admin_icon + '"></i>' +
                                '<span class="shortcode-title">' + sc_obj.name + '</span>' +
                            '</div>' +
                            '<div class="element-shortcode" style="display: none">' + shortcode_string + '</div>' +
                        '</div>';
                }

            });

            $('.page-tamer-items-pane').append(models_markup);

            $(".page-tamer-items-pane > div").draggable({
                containment: '#gbox',
                cursor: 'move',
                cursorAt: {top: 17, left: 17},
                helper: 'clone',
                scroll: false,
                connectToSortable: '.holo-column .column-body',
                start: function () {},
                stop: function (event, ui) {}
            });

            $('.page-tamer-items-pane').disableSelection();

        },

        /**
         * Creates the page builder interface based on the Wordpress shortcodes
         *
         * Get the text from the main wordpress editor and send it to the server in order to be parsed
         * The server will return the html of the interface elements
         *
         */
        transform_shortcodes_to_interface: function() {

            var _page_tamer = this;

            if ( _page_tamer.is_active_tinyMCE && tinyMCE.editors['content'] ) {

//                if ($(this.default_editor).is(':visible')) {

//                var text = $('#content').val();

//                }

//                this.editor_text = window.switchEditors._wp_Nop(text);

                _page_tamer.editor_text = tinyMCE.editors['content'].getContent({format : 'raw'});

//                console.log('editor_text: ', _page_tamer.editor_text);

                return $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data:
                    {
                        action: 'holo_shortcodes_to_markup',
                        text: _page_tamer.editor_text
                    },
                    success: function(data)
                    {

                        _page_tamer.workplace.html(data);

                        _page_tamer.make_them_sortable();

                        _page_tamer.behaviour = new $.Behaviour(_page_tamer);

                        new $.Shortcodes_Generator(_page_tamer);

                    }
                });

            } else {

                setTimeout(function() {

                    if ( _page_tamer.is_active_tinyMCE && tinyMCE.editors['content'] ) {

                        console.log('init after 0.5 sec');

                        _page_tamer.editor_text = tinyMCE.editors['content'].getContent({format : 'raw'});

                        console.log('editor_text: ', _page_tamer.editor_text);

                        return $.ajax({
                            type: "POST",
                            url: ajaxurl,
                            data:
                            {
                                action: 'holo_shortcodes_to_markup',
                                text: _page_tamer.editor_text
                            },
                            success: function(data)
                            {

                                console.log('awesome');

                                _page_tamer.workplace.html(data);

                                _page_tamer.make_them_sortable();

                                _page_tamer.behaviour = new $.Behaviour(_page_tamer);

                                new $.Shortcodes_Generator(_page_tamer);

                            }
                        });
                    }
//
                }, 500);

            }

        },

        make_them_sortable: function() {

            var _this = this;

            $( ".holo-planner-workspace" ).sortable({

                placeholder: "ui-state-highlight",
                forcePlaceholderSize: true,
                handle: ".row-header",
                distance: 1,
                update: function() {
                    _this.update_editor_content();
                }

            });

            $(".holo-column .column-body").droppable({
                accept: ".page-tamer-items-pane div",
//                accept: ":not(.ui-sortable-helper)",
                drop: function (event, ui) {

                }
            });

            $( ".holo-column .column-body" ).sortable({
                placeholder: "ui-state-highlight",
                handle: ".element-header .element-drag",
                forcePlaceholderSize: true,
                distance: 10,
                connectWith: ".sortable-columns",
                tolerance: "pointer",
                cursorAt: { top: 17, left: 17 },
                start: function(event, ui) {
//                    ui.item.addClass('noclick');
                    ui.helper.addClass('moving');
                    ui.helper.css({
                        width: '200px',
                        height: '30px'
                    });
                },
                stop: function(event, ui) {
//                    ui.item.removeClass('noclick');

                    ui.item.removeClass('moving');
                    ui.item.one('mouseenter', function() {

                        $(this).find('.element-header').css('display', 'block');

                    });

                    ui.item.one('mouseleave', function() {

                        $(this).find('.element-header').css('display', '');

                    });

                    ui.item.trigger('mouseenter');

                },
                update: function(event, ui) {
                    _this.update_editor_content();

                },
                over: function(event, ui) {
//                    ui.helper.css({
//                        width: '200px',
//                        height: '30px'
//                    });

                },
                receive: function(event, ui) {

                    var received_item = $($(this).data().uiSortable.currentItem);

                    if (received_item.find('.holo-element').length == 0)
                    {

                        var element_type = received_item.data();
                        var element_text = received_item.data('text');

                        received_item.addClass('holo-element');

                    }

                    var shortcode_id = received_item.data('element-id');
                }

            }).disableSelection();

        },

        update_editor_content: function() {

            var shortcodes = this.interface_to_shortcodes();

//            window.switchEditors.go('content', 'html');

//            console.log('saved shortcode ', shortcodes);

            tinymce.get('content').focus();

            tinymce.activeEditor.setContent(shortcodes);

//            $('#content').val(shortcodes);
        },

        interface_to_shortcodes: function() {

            var shortcodes = '';

            this.workplace.find('.holo-row').each(function() {

                var row = $(this);

                if ( $(this).find('.row-content .holo-column').length !== 0 ) {

                    var columns = '';

                    $(this).find('.holo-column').each(function() {

                        var column_size = $(this).attr('data-size');

                        var shortcode_elements = '';

                        if ( $(this).find('.holo-element').length !== 0 ) {

                            $(this).find('.holo-element').each(function() {

                                var element_text = $(this).text().trim();

//                                jQuery(element_text).find('p:empty').remove();

                                shortcode_elements += $(this).find('.element-shortcode').html();

                            });

                            columns += '[holo_column size="' + column_size + '"]' + shortcode_elements  + '[/holo_column]';

                        } else {

                            columns += '[holo_column size="' + column_size + '"]' + $(this).text().trim()  + '[/holo_column]';

                        }

                    });

                    shortcodes += row.children('.element-shortcode').text() + columns + '[/holo_row]';

                } else {

                    var clean_text = $(this).find('.row-content').text().trim();

                    shortcodes += row.children('.element-shortcode').text() + clean_text  + '[/holo_row]';

                }
            });

            return shortcodes;

        },

        parse_shortcode: function(shortcode, form) {

            var form = $(form);

            var _this = this;

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'holo_parse_shortcode',
                    shortcode: shortcode
                },
                beforeSend: function() {

                    $(form).find('fieldset').css('visibility', 'hidden');

                },
                success: function(data) {

                    data = JSON.parse(data);

//                    console.log(data);

                    var children_class = _this.shortcodes[data.shortcode].children_class;

                    var deferred_inputs = [];

                    if ( null !== data.attributes ) {

                        $.each(data.attributes, function(key, value) {

                            var style_atts = _this.shortcodes[data.shortcode].style_atts[key];
                            var attributes = _this.shortcodes[data.shortcode].attributes[key];

                            var options = $.extend(style_atts,attributes);

                            if ( key !== 'unique_id' ) {

                                if ($.Input_Fields[value.type]) {
                                    deferred_inputs.push(
                                        $.Input_Fields[value.type].handle_front_end('.' + data.shortcode + '-' + key, value.value, options)
                                    );
                                }

//                                $.Input_Fields[value.type].handle_front_end('.' + data.shortcode + '-' + key, value.value, options);
                            }

//                            console.log('sc options: ', options);

                        });

                    }

                    if ( '' === data.unique_id ) {

                        $('.unique-id').val(data.shortcode + '-' + Math.floor(Math.random() * (9999 - 1000) + 1000));

                    } else {

                        $('.unique-id').val(data.unique_id);

                    }

                    if ( null !== children_class ) {

                        $(form).find('.children-container').html(data.children);

                        $(form).find('.children-container').sortable({

                            placeholder: "ui-state-highlight",
                            forcePlaceholderSize: true,
                            distance: 10,
                            start: function(event, ui) {
                                ui.item.addClass('noclick');
                            },
                            stop: function(event, ui) {
                                setTimeout( function() { ui.item.removeClass('noclick'); }, 300);
                            },
                            update: function() {
                                _this.update_editor_content();
                            },
                            receive: function(event, ui) {

                            }

                        });

                        $(form).find('.children-container').children().each(function() {

                            $(this).find('.element-delete').click(function() {

                                var element = $(this).parents('.holo-child');

                                element.remove();

                                return false;

                            });

                        });

                    } else {

                        if ( null !== _this.shortcodes[data.shortcode].content) {

//                            console.log(_this.shortcodes[data.shortcode].content);

                            var content_type = _this.shortcodes[data.shortcode].content.type;

                            deferred_inputs.push(
                                $.Input_Fields[content_type].handle_front_end('.' + data.shortcode + '-content', data.content)
                            );

                        }

                    }

                    $.when.apply(null, deferred_inputs).done(function() {
                        $('#' + data.shortcode + '-form fieldset').css('visibility', 'visible');
                    });

                    // handle input dependencies
                    $.each(data.attributes, function(attr_id, attribute) {

                        if ( undefined !== attribute.dependencies && Object.keys(attribute.dependencies).length ) {

                            $.each(attribute.dependencies, function(dep_attr_id, dep_attr_value) {

                                if ( $('.' + data.shortcode + '-' + dep_attr_id).is(':checkbox') ) {
                                    if ( $('.' + data.shortcode + '-' + dep_attr_id).is(':checked') ) {

                                        $('tr[data-attribute-id="' + data.shortcode + '-' + attr_id + '"]').css('display', 'table-row');

                                    } else {

                                        $('tr[data-attribute-id="' + data.shortcode + '-' + attr_id + '"]').css('display', 'none');

                                    }
                                } else {
                                    if ( $('.' + data.shortcode + '-' + dep_attr_id).val() == dep_attr_value) {

                                        $('tr[data-attribute-id="' + data.shortcode + '-' + attr_id + '"]').css('display', 'table-row');

                                    } else {

                                        $('tr[data-attribute-id="' + data.shortcode + '-' + attr_id + '"]').css('display', 'none');

                                    }
                                }

                                $('.' + data.shortcode + '-' + dep_attr_id).change(function() {

                                    if ( $(this).is(':checkbox') ) {

                                        if ( $(this).is(':checked') ) {

                                            $('tr[data-attribute-id="' + data.shortcode + '-' + attr_id + '"]').css('display', 'table-row');

                                        } else {
                                            $('tr[data-attribute-id="' + data.shortcode + '-' + attr_id + '"]').css('display', 'none');
                                        }

                                    } else {

                                        if ( $(this).val() == dep_attr_value) {

                                            $('tr[data-attribute-id="' + data.shortcode + '-' + attr_id + '"]').css('display', 'table-row');

                                        } else {

                                            $('tr[data-attribute-id="' + data.shortcode + '-' + attr_id + '"]').css('display', 'none');

                                        }

                                    }

                                });

                            });

                        }

                    });

                }
            });

        }

    };


    jQuery(document).ready(function() {

        var holo_builder = new $.HoloBuilder();

    });

})(jQuery);
