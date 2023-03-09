
(function($) {

    var iconsArray = [
        'fa-rub', 'fa-stack-exchange', 'fa-toggle-left', 'fa-try', 'fa-ruble', 'fa-arrow-circle-o-right', 'fa-dot-circle-o', 'fa-turkish-lira', 'fa-rouble', 'fa-arrow-circle-o-left', 'fa-wheelchair', 'fa-plus-square-o', 'fa-pagelines', 'fa-caret-square-o-left', 'fa-vimeo-square', 'fa-adjust', 'fa-arrows-h', 'fa-bar-chart-o', 'fa-bell', 'fa-bookmark', 'fa-building-o', 'fa-calendar-o', 'fa-caret-square-o-left', 'fa-check', 'fa-check-square-o', 'fa-cloud', 'fa-code-fork', 'fa-comment', 'fa-compass', 'fa-cutlery', 'fa-download', 'fa-envelope', 'fa-exclamation', 'fa-external-link-square', 'fa-fighter-jet', 'fa-fire-extinguisher', 'fa-flash' , 'fa-folder-open', 'fa-gavel', 'fa-glass', 'fa-headphones', 'fa-inbox', 'fa-keyboard-o', 'fa-lemon-o', 'fa-location-arrow', 'fa-mail-forward', 'fa-map-marker', 'fa-minus', 'fa-mobile', 'fa-music', 'fa-phone', 'fa-plus', 'fa-power-off', 'fa-question', 'fa-random', 'fa-retweet', 'fa-rss-square', 'fa-share', 'fa-shopping-cart', 'fa-sitemap', 'fa-sort-alpha-desc', 'fa-sort-desc', 'fa-sort-up', 'fa-star', 'fa-star-half-o', 'fa-sun-o', 'fa-tag', 'fa-thumb-tack', 'fa-thumbs-up', 'fa-times-circle-o', 'fa-toggle-right', 'fa-truck', 'fa-unsorted', 'fa-video-camera', 'fa-warning', 'fa-anchor', 'fa-arrows-v', 'fa-barcode', 'fa-bell-o', 'fa-bookmark-o', 'fa-bullhorn', 'fa-camera', 'fa-caret-square-o-right', 'fa-check-circle', 'fa-circle', 'fa-cloud-download', 'fa-coffee', 'fa-comment-o', 'fa-credit-card', 'fa-dashboard', 'fa-edit', 'fa-envelope-o', 'fa-exclamation-circle', 'fa-eye', 'fa-film', 'fa-flag', 'fa-flask', 'fa-folder-open-o', 'fa-gear', 'fa-globe', 'fa-heart', 'fa-info', 'fa-laptop', 'fa-level-down', 'fa-lock', 'fa-mail-reply', 'fa-meh-o', 'fa-minus-circle', 'fa-mobile-phone', 'fa-pencil', 'fa-phone-square', 'fa-plus-circle', 'fa-print', 'fa-question-circle', 'fa-refresh', 'fa-road', 'fa-search', 'fa-share-square', 'fa-sign-in', 'fa-smile-o', 'fa-sort-amount-asc', 'fa-sort-down', 'fa-spinner', 'fa-star-half', 'fa-star-o', 'fa-superscript', 'fa-tags', 'fa-thumbs-down', 'fa-ticket', 'fa-tint', 'fa-toggle-up', 'fa-umbrella', 'fa-upload', 'fa-volume-down', 'fa-wheelchair', 'fa-archive', 'fa-asterisk', 'fa-bars', 'fa-bolt', 'fa-briefcase', 'fa-bullseye', 'fa-camera-retro', 'fa-caret-square-o-up', 'fa-check-circle-o', 'fa-circle-o', 'fa-cloud-upload', 'fa-cog', 'fa-comments', 'fa-crop', 'fa-desktop', 'fa-ellipsis-h', 'fa-eraser', 'fa-exclamation-triangle', 'fa-eye-slash', 'fa-filter', 'fa-flag-checkered', 'fa-folder', 'fa-frown-o', 'fa-gears', 'fa-group', 'fa-heart-o', 'fa-info-circle', 'fa-leaf', 'fa-level-up', 'fa-magic', 'fa-mail-reply-all', 'fa-microphone', 'fa-minus-square', 'fa-money', 'fa-pencil-square', 'fa-picture-o', 'fa-plus-square', 'fa-puzzle-piece', 'fa-quote-left', 'fa-reply', 'fa-rocket', 'fa-search-minus', 'fa-share-square-o', 'fa-sign-out', 'fa-sort', 'fa-sort-amount-desc', 'fa-sort-numeric-asc', 'fa-square', 'fa-star-half-empty', 'fa-subscript', 'fa-tablet', 'fa-tasks', 'fa-thumbs-o-down', 'fa-times', 'fa-toggle-down', 'fa-trash-o', 'fa-unlock', 'fa-user', 'fa-volume-off', 'fa-wrench', 'fa-arrows', 'fa-ban', 'fa-beer', 'fa-book', 'fa-bug', 'fa-calendar', 'fa-caret-square-o-down', 'fa-certificate', 'fa-check-square', 'fa-clock-o', 'fa-code', 'fa-cogs', 'fa-comments-o', 'fa-crosshairs', 'fa-dot-circle-o', 'fa-ellipsis-v', 'fa-exchange', 'fa-external-link', 'fa-female', 'fa-fire', 'fa-flag-o', 'fa-folder-o', 'fa-gamepad', 'fa-gift', 'fa-hdd-o', 'fa-home', 'fa-key', 'fa-legal', 'fa-lightbulb-o', 'fa-magnet', 'fa-male', 'fa-microphone-slash', 'fa-minus-square-o', 'fa-moon-o', 'fa-pencil-square-o', 'fa-plane', 'fa-plus-square-o', 'fa-qrcode', 'fa-quote-right', 'fa-reply-all', 'fa-rss', 'fa-search-plus', 'fa-shield', 'fa-signal', 'fa-sort-alpha-asc', 'fa-sort-asc', 'fa-sort-numeric-desc', 'fa-square-o', 'fa-star-half-full', 'fa-suitcase', 'fa-tachometer', 'fa-terminal', 'fa-thumbs-o-up', 'fa-times-circle', 'fa-toggle-left', 'fa-trophy', 'fa-unlock-alt', 'fa-users', 'fa-volume-up', 'fa-bitcoin', 'fa-eur', 'fa-jpy', 'fa-rouble', 'fa-try', 'fa-yen', 'fa-btc', 'fa-euro', 'fa-krw', 'fa-rub', 'fa-turkish-lira', 'fa-cny', 'fa-gbp', 'fa-money', 'fa-ruble', 'fa-usd', 'fa-dollar', 'fa-inr', 'fa-rmb', 'fa-rupee', 'fa-won', 'fa-align-center', 'fa-bold', 'fa-columns', 'fa-eraser', 'fa-file-text-o', 'fa-indent', 'fa-list-alt', 'fa-paperclip', 'fa-rotate-right', 'fa-table', 'fa-th-large', 'fa-unlink', 'fa-align-justify', 'fa-chain', 'fa-copy', 'fa-file', 'fa-files-o', 'fa-italic', 'fa-list-ol', 'fa-paste', 'fa-save', 'fa-text-height', 'fa-th-list', 'fa-align-left', 'fa-chain-broken', 'fa-cut', 'fa-file-o', 'fa-floppy-o', 'fa-link', 'fa-list-ul', 'fa-repeat', 'fa-scissors', 'fa-text-width', 'fa-underline', 'fa-align-right', 'fa-clipboard', 'fa-dedent', 'fa-file-text', 'fa-font', 'fa-list', 'fa-outdent', 'fa-rotate-left', 'fa-strikethrough', 'fa-th', 'fa-undo', 'fa-angle-double-down', 'fa-angle-down', 'fa-arrow-circle-down', 'fa-arrow-circle-o-right', 'fa-arrow-down', 'fa-arrows', 'fa-caret-down', 'fa-caret-square-o-left', 'fa-chevron-circle-down', 'fa-chevron-down', 'fa-hand-o-down', 'fa-long-arrow-down', 'fa-toggle-down', 'fa-angle-double-down', 'fa-angle-left', 'fa-arrow-circle-left', 'fa-arrow-circle-o-up', 'fa-arrow-left', 'fa-arrows-alt', 'fa-caret-left', 'fa-caret-square-o-right', 'fa-chevron-circle-left', 'fa-chevron-left', 'fa-hand-o-left', 'fa-long-arrow-left', 'fa-toggle-left', 'fa-angle-double-right', 'fa-angle-right', 'fa-arrow-circle-o-down', 'fa-arrow-circle-right', 'fa-arrow-right', 'fa-arrows-h', 'fa-caret-right', 'fa-caret-square-o-up', 'fa-chevron-circle-right', 'fa-chevron-right', 'fa-hand-o-right', 'fa-long-arrow-right', 'fa-toggle-right', 'fa-angle-double-up', 'fa-angle-up', 'fa-arrow-circle-o-left', 'fa-arrow-circle-up', 'fa-arrow-up', 'fa-arrows-v', 'fa-caret-square-o-down', 'fa-caret-up', 'fa-chevron-circle-up', 'fa-chevron-up', 'fa-hand-o-up', 'fa-long-arrow-up', 'fa-toggle-up', 'fa-arrows-alt', 'fa-expand', 'fa-pause', 'fa-step-backward', 'fa-backward', 'fa-fast-backward', 'fa-compress', 'fa-fast-forward', 'fa-play-circle', 'fa-stop', 'fa-eject', 'fa-forward', 'fa-play-circle-o', 'fa-youtube-play', 'fa-adn', 'fa-bitbucket-square', 'fa-dribbble', 'fa-flickr', 'fa-github-square', 'fa-html5', 'fa-linux', 'fa-pinterest-square', 'fa-stack-overflow', 'fa-twitter', 'fa-youtube', 'fa-android', 'fa-bitcoin', 'fa-dropbox', 'fa-foursquare', 'fa-gittip', 'fa-instagram', 'fa-maxcdn', 'fa-renren', 'fa-trello', 'fa-twitter-square', 'fa-windows', 'fa-youtube-play', 'fa-apple', 'fa-btc', 'fa-facebook', 'fa-github', 'fa-google-plus', 'fa-linkedin', 'fa-pagelines', 'fa-skype', 'fa-tumblr', 'fa-vimeo-square', 'fa-xing', 'fa-youtube-square', 'fa-bitbucket', 'fa-css3', 'fa-facebook-square', 'fa-github-alt', 'fa-google-plus-square', 'fa-linkedin-square', 'fa-pinterest', 'fa-stack-exchange', 'fa-tumblr-square', 'fa-vk', 'fa-xing-square', 'fa-ambulance', 'fa-plus-square', 'fa-h-square', 'fa-stethoscope', 'fa-hospital-o', 'fa-user-md', 'fa-medkit'
    ];

    $.fn.iconsform = function(options) {

        var iconInputClass = $(this).attr('class');

        var iconInputName = $(this).attr('name');

        var iconValue = $(this).val();

        switch ( options ) {
            case 'destroy':
                destroy();
                break;
            case 'refresh':

                refresh();

            default:

                destroy();

                var noIconHighlight = '';
                var iconHighlight = '';

                if ( iconValue === '') {
                    noIconHighlight = ' selected-icon';
                }
                else {
                    iconHighlight = ' selected-icon';

//                        icons = highlightIcon(iconValue, iconHighlight);
                }

                var iconsForm =
                    '<button class="' + iconInputClass + '-button">Choose Icon</button>' +
                    '<a class="icon-delete" href="">Delete Icon</a>' +
                    '<input type="hidden" class="' + iconInputClass + '" name="' + iconInputName + '" value="' + iconValue + '" />' +
                    '<div id="holo-icons-form" class="white-popup-block" style="display: none;"><div class="' + iconInputClass + '-wrapper">' +
                        '<div class="iconsform">' +
                        '<div class="icons-container clearfix"></div>' +

                        '<div class="no-icon' + noIconHighlight + '">' +
                        'no icon' +
                        '</div>' +
                        '</div>' +

                        '<input type="hidden" class="' + iconInputClass + '" name="' + iconInputName + '" value="' + iconValue + '" /><br />' +
                        '</div>' +
                    '</div>';

                $('.icon-holder').html('<i class="' + $(this).val() + ' icon-sample"></i>');

                $(this).closest('.icon-container').html(iconsForm);

                $(this).remove();

                $('.' + iconInputClass + '-button').click(function() {
                    $.holo_modal.open({
                        form: '#holo-icons-form',
                        close: '.icons-save',
                        onStart: function() {

                            retrieveIcons(iconValue, iconInputClass);

                        },
                        onClose: function(form) {

                        },
                        onSave: function(form) {

                            var icon = form.find('input[type="hidden"]').val();

                            $('.icon-container').find('input[type="hidden"]').val(icon);
                            $('.icon-container').children('.icon-delete').remove();
                            $('.icon-container').append('<a class="icon-delete" href="">Delete Icon</a>');

                            $('.icon-container').closest('td').children('i').remove();
                            $('.icon-holder').html('<i class="' + icon + ' icon-sample"></i>');

                        }

                    });
                });

        }
    };

    function retrieveIcons(selected_icon, iconInputClass) {

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: 'get_fonts_icons'
            },
            success: function(data) {

                data = JSON.parse(data);

                console.log(data);

                var return_markup = '';

                $.each(data, function(key, value) {

                    return_markup += '<div id="' + value.name + '">';

                    $.each(value.glyphs, function(key, glyph) {

                        if ( selected_icon === glyph.css ) {

                            return_markup += '<div class="icon-wrapper selected-icon"><i class="' + value.css_prefix_text + glyph.css + '"></i></div>';

                        }
                        else {

                            return_markup += '<div class="icon-wrapper"><i class="' + value.css_prefix_text + glyph.css + '"></i></div>';

                        }

                    });

                    return_markup += '</div>';

                });

                $('.icons-container').html(return_markup);

                handleIconChange(iconInputClass);

            },
            error: function() {}
        });

    }

    function handleIconChange(inputClass) {

        jQuery('.icons-container .icon-wrapper').on('click', function() {

            var parentContainer = jQuery(this).parents('.' + inputClass + '-wrapper');

            parentContainer.find('.icon-wrapper').removeClass('selected-icon');
            parentContainer.find('.no-icon').removeClass('selected-icon');

            jQuery(this).addClass('selected-icon');

            var icon = jQuery(this).children('i').attr('class');

            parentContainer.find('.' + inputClass).val(icon);

        });

        jQuery('.no-icon').on('click', function() {

            var parentContainer = jQuery(this).parents('.' + inputClass + '-wrapper');

            parentContainer.find('.icon-wrapper').removeClass('selected-icon');

            jQuery(this).addClass('selected-icon');

            parentContainer.find('.' + inputClass).val('');

        });
    }

    function highlightIcon(iconValue, iconHighlight) {
        var icons = iconsArray.map(function(value) {
            if ( iconValue === value ) {
                return value + ' ' + iconHighlight;
            }
            else {
                return value;
            }
        });

        return icons;
    }

    function refresh() {

        var parentContainer = $('.iconsform').parent();

        parentContainer.each(function() {
            var input = $(this).find('input');

            $(this).replaceWith(input);
        });

    }

    function destroy() {

        var parentContainer = $('.iconsform').parent();

        parentContainer.each(function() {
            var input = $(this).find('input').attr('type', 'text');

            $(this).replaceWith(input);
        });

    }

}(jQuery));
