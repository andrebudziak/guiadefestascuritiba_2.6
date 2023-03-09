var $ = jQuery.noConflict();

(function($) {

//    handle_mega_menu_activation();
//    check_menu_items();
//    handle_items_move();
//
//    function handle_mega_menu_activation() {
//
//        $('.holo-mega-menu-checkbox').click(function() {
//
//            var $container = $(this).closest('.menu-item');
//
//            if( $(this).is(':checked') )
//            {
//                $container.addClass('holo-mega-menu-enabled');
//            }
//            else
//            {
//                $container.removeClass('holo-mega-menu-enabled');
//            }
//
//            check_menu_items();
//
//        });
//    }
//
//    function handle_items_move() {
//        $( ".menu-item-bar" ).live( "mouseup", function(event, ui)
//        {
//            if( !$(event.target).is('a') )
//            {
//                setTimeout(check_menu_items, 1000);
//            }
//        });
//    }
//
//    function check_menu_items() {
//        var $menu_items = $('.menu-item', '#menu-to-edit');
//
//        $menu_items.each(function(i) {
//
//            var $menu_item = $(this);
//
//            if ($menu_item.hasClass('menu-item-depth-0')) {
//
//                var $checkbox = $('.holo-mega-menu-checkbox', $menu_item);
//
//                if( $checkbox.is(':checked') ){
//                    $menu_item.addClass('holo-mega-menu-enabled');
//                }
//                else{
//                    $menu_item.removeClass('holo-mega-menu-enabled');
//                }
//
//            }
//            else {
//
//                var last_item = $menu_items.eq(i - 1);
//
//                if(last_item.hasClass('holo-mega-menu-enabled'))
//                {
//
//                    $menu_item.addClass('holo-mega-menu-enabled');
//                    $menu_item.find('.holo-mega-menu-checkbox').prop('checked', true);
//
//                }
//                else
//                {
//                    $menu_item.removeClass('holo-mega-menu-enabled');
//                    $menu_item.find('.holo-mega-menu-checkbox').prop('checked', false);
//                }
//
//            }
//
//        });
//    }

//    if(typeof wpNavMenu != 'undefined'){ wpNavMenu.addItemToMenu = holo_mega_menu.addItemToMenu; }

})(jQuery);

(function($) {

    var $post_formats = $('.post-format').val();

    if ($('.post-format[value="video"]').is(':checked')) {
        $('.postbox-container #video').show();
    }

    if ($('.post-format[value="gallery"]').is(':checked')) {
        $('.postbox-container #gallery').show();
    }

    $('.post-format').change(function() {

        var post_format = $(this).val();

        if (post_format == 'video') {

            $('.postbox-container #video').show();
            $('.postbox-container #gallery').hide();

        } else if (post_format == 'gallery') {

            $('.postbox-container #gallery').show();
            $('.postbox-container #video').hide();

        }

    })

})(jQuery);

(function($) {

    $('#ht-paypal-repay').click(function(event) {

        event.preventDefault();

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: 'user_repay'
            },
            success: function(data) {

                console.log(data);

                data = JSON.parse(data);

                if (data['error']) {

                    $submit_button.closest('form').find('.register-message').html(data['error']);

                } else {

                    window.location.href = data.paypal_url;

                }

            },
            error: function() {



            }

        });

    });

})(jQuery);

(function($) {

    $('.icons-select').iconsform();

    var badge = $('.site-category-badge-generator .site-category-badge-input').val();
    var pin = $('.site-category-badge-generator .site-category-pin-input').val();

    $('.ht-badge-add').click(function(event) {

        event.preventDefault();

        $.ht_modal.open({
            DOM_content_select: '.site-category-badge-generator',
            display_close: true,
            close_button: '.action.generate-badge',
            onStart: function($modal) {

                $modal.find('.badge-color').wpColorPicker();

                $('.ht-badge-icon-upload').click(function() {

                    $.ht_media_upload.open({
                        on_choose: function(attachment) {

                            console.log(attachment);

                            $('.badge-preview').html('<img src="' + attachment.url + '" width="50px" />');
                            $('.badge-image').val(attachment.url);

                        }
                    });

                });

                $('.action.generate-badge').click(function(e) {

                    e.preventDefault();

                    var file_url = $modal.find('input.badge-image').val();
                    var color = $modal.find('input.badge-color').val();
                    var tag_id = $('input[name="tag_ID"]').val();

                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action: 'google_map_marker',
                            file_url: file_url,
                            hex_color: color,
                            tag_id: tag_id
                        },
                        success: function (data) {

                            data = JSON.parse(data);

                            console.log(data);

                            // get timestamp for cache image reload problem
                            var timestamp = Math.round(new Date().getTime() / 1000);

                            var pin = '<img src="' + data['pin_url'] + '?lastmod=' + timestamp + '" />';
                            var badge = '<img src="' + data['badge_url'] + '?lastmod=' + timestamp + '" />';

                            $('.badge-result-container').html(pin + badge);

                            $('.site-category-badge-input').val(data['badge_url']);
                            $('.site-category-pin-input').val(data['pin_url']);

                            var upload_path = data.path;
                        }
                    });

                    return false;

                });

            }
        });

    });

    $('#site_contact .ht-name-field').each(function() {

        $(this).after('<div class="icon-container"></div>');

        $(this).appendTo('.icon-container');

    });

    $('#site_contact .ht-name-field').iconsform();

    $(".paypal-credentials-check").click(function(event) {

        event.preventDefault();

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: 'paypal_connection_check'
            },
            success: function (data) {

                data = JSON.parse(data);

                console.log(data);

                $('.paypal-check-message').html(data.message);

            }
        });

    })

})(jQuery);