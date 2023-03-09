(function($){

    $.Input_Fields = {

        get_field_markup: function(sc_id, key, attribute) {

            var _field = this;

            _field.type = attribute.type;
            _field.label = attribute.label;
            _field.id = sc_id + '-' + key;
            _field.placeholder = '';
            _field.options = attribute.options;
            _field.content_class = '';
            _field.description = ( undefined !== attribute.description ? attribute.description : '' );

            if ( attribute.position === 'content' ) {

                _field.content_class = ' ' + sc_id + '-content';

            }

            _field.field_class = _field.id + _field.content_class;

            return this[_field.type].field_markup(_field);

        },

        hidden: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                    '<td><input class="' + _field.field_class + '" type="hidden" /></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                $(input).val(value);

            }

        },

        text: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                        '<td>' +
                            '<label for="' + _field.id + '">' + _field.label + '</label>' +
                            '<input class="' + _field.field_class + '" type="text" placeholder="' + _field.placeholder + '" />' +
                        '</td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                $(input).val(value);

            }

        },

        textarea: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                        '<td>' +
                    '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<textarea cols="60" rows="6" class="' + _field.id + '"></textarea></td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                        '</tr>';

            },

            handle_front_end: function(input, value) {

                $(input).val(value);

            }

        },

        editor: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                    '<td colspan="2">' +
                    '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<input type="hidden" class="' + _field.id + '" /></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                $(input).closest('td').find('.wp-editor-wrap').remove();

                function getRandomArbitrary(min, max) {

                    return Math.floor(Math.random() * (max - min) + min);

                }

                var random_id = 'holo-editor-' + getRandomArbitrary(100, 1000);

//                $(input).attr('id', random_id);


                console.log('editor field');

                return $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data:
                    {
                        action: 'holo_get_editor',
                        id: random_id
                    },
                    success: function(data) {

                        console.log(data);

                        $(input).closest('td').append(data);

                        console.log(value);

                        $(input).closest('td').find('textarea').val(value);

                        var settings	= {id: random_id , buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close"};

                        quicktags(settings);
                        QTags._buttonsInit();

                        var $current 	= $('#' + random_id);
                        var $parent		= $current.parents('.wp-editor-wrap:eq(0)');
                        var $textarea	= $parent.find('textarea.avia_tinymce');
                        var $switch_btn	= $parent.find('.wp-switch-editor').removeAttr("onclick");

                        console.log('editor input');

                        $switch_btn.bind('click', function()
                        {
                            var button = $(this);

                            if(button.is('.switch-tmce'))
                            {
                                $parent.removeClass('html-active').addClass('tmce-active');
                                window.tinyMCE.execCommand("mceAddEditor", true, random_id);
//                                window.tinyMCE.get(random_id).setContent(window.switchEditors.wpautop(value), {format:'raw'});
                            }
                            else
                            {
                                $parent.removeClass('tmce-active').addClass('html-active');
                                window.tinyMCE.execCommand("mceRemoveEditor", true, random_id);
                            }
                        }).trigger('click');

//                        save_btn.bind('click', function()
//                        {
//                            switch_btn.filter('.switch-html').trigger('click');
//                        });

                    }
                });

//                tinymce.init({
//                    selector: "#" + random_id,
//                    theme : "advanced",
//                    height:"250",
//                    width:"600",
//                    plugins: "example",
//                    entities: '',
//
//                    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,example"
////                        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,| formatselect,fontselect,fontsizeselect",
////                        theme_advanced_buttons3 : "",
////                        theme_advanced_toolbar_location : "top",
////                        theme_advanced_toolbar_align : "left",
////                        theme_advanced_statusbar_location : "bottom",
////                        theme_advanced_resizing : true
//
//                });

            }

        },

        color: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                        '<td>' +
                    '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<input class="' + _field.id + ' color-field" name="' + _field.id + '" class="color-field" type="text" /></td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                if ( '' !== value ) {

                    $(input).val(value);
                }

                $(input).wpColorPicker();

            }

        },

        radio: {

            field_markup: function(_field) {

                var radio = '';

                $.each(_field.options, function(key, message) {

                    radio += '<li><input type="radio" class="' + _field.id + '" name="' + _field.id + '" value="' + key + '" /><p>' + message + '</p></li>';

                });

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                        '<td class="checkboxes-container">' +
                    '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<ul>' +
                        radio +
                        '</ul></td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                        '</tr>';

            },

            handle_front_end: function(input, value) {

                $(input).each(function() {

                    console.log(input.attr('value'));

                    if ( $(this).attr('value') === value ) {

                        $(this).attr('checked', 'checked');

                    }

                });

            }

        },

        checkbox: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                        '<td class="checkboxes-container">' +
                    '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<ul><li><input type="checkbox" class="' + _field.id + '" value="1" /></li></ul></td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                        '</tr>';

            },

            handle_front_end: function(input, value) {

                if ( $(input).attr('value') === value ) {

                    $(input).attr('checked', 'checked');

                } else {

                    $(input).attr('checked', false);

                }

            }

        },

        select: {

            field_markup: function(_field) {

                var options = '';

                $.each(_field.options, function(value, label) {

                    options += '<option value="' + value + '">' + label + '</option>';

                });

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                        '<td>' +
                        '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<select class="' + _field.id + '">' +
                        options +
                        '</select>' +
                        '</td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                        '</tr>';

            },

            handle_front_end: function(input, value) {

                $(input).val(value);

            }

        },

        multiple_select: {

            field_markup: function(_field) {

                var options = '';

                $.each(_field.options, function(value, label) {

                    options += '<option value="' + value + '">' + label + '</option>';

                });

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                    '<td>' +
                    '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<select multiple class="' + _field.id + '">' +
                    options +
                    '</select>' +
                    '</td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                var values = value.split(',');

                $.each(values, function(index, value) {

                    $(input).find('option').each(function() {

                        if ($(this).val() == value) {
                            $(this).attr('selected', true);
                        }

                    });
                });

            }

        },

        upload: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                    '<td>' +
                    '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<div class="upload-container">' +
                    '<div class="upload-wrapper"></div>' +
                    '<input type="hidden" class="' + _field.id + '" value="" />' +
                    '</div>' +
                    '</td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                var image = '';

                if ( '' !== value ) {

                    image = '<img src="' + value +'" width="200px" />';

                }

                $(input).parents('.upload-container').find('.upload-wrapper').html(
                    '<div class="upload-buttons">' +
                        '<button class="holo-upload-image-button" data-frame="select" data-state="holo-single-image" data-button="insert image" data-random="' + Math.random() + '">Upload button</button>' +
                        '<a href="" class="image-delete">Delete</a>' +
                    '</div>' +
                    image
                );

                $(input).val(value);

            }

        },

        slider: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                    '<td>' +
                        '<label for="' + _field.id + '">' + _field.label + '</label>' +
                        '<input class="' + _field.field_class + ' value-slider-input" type="text" size="3" style="float: left" value="" />' +
                        '<div class="value-slider"></div>' +
                    '</td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value, options) {

                $(input).val(value);

                $(input).closest('td').find('.value-slider').slider({
                    range: "min",
                    value: $(input).val(),
                    min: options.min,
                    max: options.max,
                    step: options.step,
                    slide: function( event, ui ) {
                        $(ui.handle).closest('td').find('input').val( ui.value );
                    }
                });

            }

        },

        gallery: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                    '<td>' +
                    '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<div class="gallery-container">' +
                    '<button class="holo-upload-image-button" data-frame="post" data-state="gallery-library" data-button="insert gallery">Gallery button</button>' +
                    '<input type="hidden" class="' + _field.id + '" value="" />' +
                    '<div class="gallery-wrapper">' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                if ( '' !== value && value !== 'undefined') {

                    var values = value.split(',');
                    var images = '';

                    for (var i = 0; i < values.length; i++) {

                        var image_data_array = values[i].split('|');
                        var image_url = image_data_array[0];

                        images += '<img src="' + image_url +'" width="100px" />';

                    }

                    $(input).closest('td').find('.gallery-wrapper').html(images);
                    $(input).val(value);
                }

            }

        },

        icon: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                    '<td>' +
                        '<label for="' + _field.id + '">' + _field.label + '</label>' +
                        '<div class="icon-container"><input class="' + _field.field_class + '" type="text" /></div>' +
                    '</td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                $(input).val(value);

                $(input).iconsform();

            }

        },

        social: {

            field_markup: function(_field) {

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                    '<td>' +
                        '<label for="' + _field.id + '">' + _field.label + '</label>' +
                        '<div class="' + _field.field_class + '-social_icons"><input class="' + _field.field_class + '" type="hidden" value="" /></div>' +
                    '</td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                $(input).val(value);

                $(input).parents('[class$="social_icons"]').socialform();

            }

        },

        color_palette: {

            field_markup: function(_field) {

                var options = '';

                $.each(_field.options, function(value, label) {

                    options += '<option value="' + value + '">' + label + '</option>';

                });

                return '<tr data-attribute-id="' + _field.field_class + '">' +
                    '<td>' +
                    '<label for="' + _field.id + '">' + _field.label + '</label>' +
                    '<select class="' + _field.id + ' holo-color-palette" data-attribute="color-palette">'
//                        '<option value="default" selected="selected">Default</option>'
                        + options +
                    '</select>' +
                    '<div class="color-palette-container"></div>' +
                    '</td>' +
                    '<td><p class="field-type-description">' + _field.description + '</p></td>' +
                    '</tr>';

            },

            handle_front_end: function(input, value) {

                $(input).val(value);

                $('.color-palette-container').html('');

                $(input).color_palette();

            }

        },

        none: {

            field_markup: function(_field) {

                return '';

            },

            handle_front_end: function(input, value) {}

        }

    };

})(jQuery);

