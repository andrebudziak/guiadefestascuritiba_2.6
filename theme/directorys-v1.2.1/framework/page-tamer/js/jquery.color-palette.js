(function($) {

    $.fn.color_palette = function() {

        var value = $(this).val();

        var $input = $(this);

        if ( '' !== value ) {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data:
                {
                    action: 'holo_get_color_palettes',
                    color_palette: value
                },
                start: function() {

                },
                success: function(data)
                {

                    data = $.parseJSON(data);

                    console.log(data);

                    var colors_markup = '';

                    $.each(data.colors, function(color_id, color) {

                        colors_markup +=
                            '<label>' + color.name + '</label>' +
                                '<input type="text" class="palette-color" data-color-key="' + color_id + '" value="' + color.value + '" />';

                    });

                    $($input).closest('td').find('.color-palette-container').html(colors_markup);

                    $($input).closest('td').find('.color-palette-container .palette-color').wpColorPicker();

                }
            });
        }

        $(this).change(function() {

            var color_palette  = $(this).val();

            var $palette_container = $(this).closest('td').find('.color-palette-container');

//            var $sc_id = $(this)

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data:
                {
                    action: 'holo_get_color_palettes',
                    color_palette: color_palette
                },
                start: function() {

                },
                success: function(data)
                {

                    data = $.parseJSON(data);

                    console.log(data);

                    var colors_markup = '';

                    $.each(data.colors, function(color_id, color) {

                        colors_markup +=
                            '<label>' + color.name + '</label>' +
                            '<input type="text" data-color-key="' + color_id + '" class="palette-color" value="' + color.value + '" />';

                    });

                    $palette_container.html(colors_markup);

                    $palette_container.find('.palette-color').wpColorPicker();

                }
            });

        });

    };

    $('.holo-new-palette-button').click(function(event) {

        event.preventDefault();

        $('.holo-new-palette-container').show();

        $(this).hide();

    });

//    $('input[type="text"].holo-color-palette-field').wpColorPicker();

    $('input[type="text"].holo-color-palette-field').minicolors({
        opacity: true,
        hide: function() {
            $(this).closest('.color').find('.holo-color-palette-field-opacity').val($(this).data('opacity'));
//            console.log($(this).siblings('.holo-color-palette-field-opacity').attr('name'));
        }
    });

    $('.holo-delete-color-palette').click(function() {

        $(this).closest('.holo-color-palette-wrapper').remove();

    });

    $('.palette-select').change(function() {

        var selected_palette = $(this).val();

        $('.holo-color-palette-wrapper-display').removeClass('holo-selected-palette');
        $('.holo-color-palette-wrapper-display#' + selected_palette).addClass('holo-selected-palette');

    })

})(jQuery);