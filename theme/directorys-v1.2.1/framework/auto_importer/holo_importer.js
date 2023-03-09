(function($) {

    jQuery('#import-button').click(function() {

        $(this).attr('disabled', true);

        $('.importer-wrapper .preloader').show();

        importContent();

    });

    function importContent() {

        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'import_content'
            },
            beforeSend: function() {
                $('.importer-wrapper .preloader').show();

                //setInterval(function() {
                //    jQuery.ajax({
                //        url: ajaxurl,
                //        type: 'POST',
                //        data: {
                //            action: 'check_importer_state'
                //        },
                //        success: function(elements) {
                //            console.log('state: ', elements);
                //        },
                //        error: function() {
                //            console.log('error checking state');
                //        }
                //    });
                //}, 2000);
            },
            success: function(elements) {

                $('.importer-wrapper .preloader').hide();

                $('#import-button').removeAttr('disabled');

                $('.importer-wrapper').after(elements);

            },
            error: function() {

                console.log('error importing dummy content');
            }
        });

    }

})(jQuery);
