(function($) {

    $.Template = {

        model_markup: function() {

            return '<div class="page-tamer-item" data-element-id="' + key + '">' +
                        '<span class="shortcode-title">' + sc_obj.name + '</span>' +
                        '<div class="element-shortcode" style="display: none">' + shortcode_string + '</div>' +
                    '</div>';

        }

    }

})(jQuery);


