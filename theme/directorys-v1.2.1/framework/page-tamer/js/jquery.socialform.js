(function($) {

    $.fn.socialform = function(options) {

        var socialClass = $(this).find('input').attr('class');
        var socialValue = $(this).find('input').val();

        var socialform_markup = '' +
            '<button class="' + socialClass + '-button">Social Icons</button>' +
            '<input type="hidden" class="' + socialClass + '" value="' + socialValue + '" />' +
            '';

        $(this).html(socialform_markup);

        var input = $(this).find('input');

        //$.holo_modal.open({
        //    form: form,
        //    title: 'Row Settings',
        //    close: '.form-close',
        //    onSave: function() {
        //        behaviour.shortcode_save();
        //    }
        //});

        $('.' + socialClass + '-button').holo_modal({
            form: '#social-icons-form',
            close: '.social-icons-save',
            onStart: function() {

                var value = $(this).closest('div').find('input').val();

                var socials = value.split(',');

                $.each(socials, function(key, value) {

                    var get = value.split('|');

                    $('body > #social-icons-form .social-inputs').find('input[data-social-name="' + get[0] + '"]').val(get[1]);

                });

//                $('body > #social-icons-form .social-inputs').find('input').each(function() {
//
//                    var social_name = $(this).attr('data-social-name');
//
//                });

            },
            onClose: function() {

                var value = '';

                $(this).closest('.social-inputs').find('input').each(function(key, val) {

                    if ( '' !== $(this).val() ) {

                        var social_name = $(this).attr('data-social-name');

                        value += ',' + social_name + '|' + $(this).val();

                    }

                });

                input.val(value.substring(1));
            }
        });

    }

})(jQuery);
