(function($) {

    function Holo_Select(options) {

        this.options = options;

        this.init();

    }

    Holo_Select.prototype.init = function() {

        var options = this.options;

        var $select = $(this);

        var state = 0;
        var actual, clickoption, option;
        var select_options = $select.find('option');
        var select_values = '';
        var selected_value = 'Select';
        var select_name = $select.attr('name');
        var input_value = '';

        select_options.each(function(key, value) {

            var option_value = $(this).val();
            var option_name = $(this).html();

            if ($(this).is(':selected')) {
                selected_value = option_name;
                input_value = option_value;
            }

            select_values += '<li data-value="' + option_value + '">' + option_name + '</li>';

        });

        $select.css('display', 'none');

        $select.before(
            '<div class="ht-select">' +
            '<div class="ht-select-header">' +
            '<p>' + selected_value + '</p><i class="fa fa-sort"></i>' +
            '<div class="ht-select-caret">' +
            '<span class="caret down"></span>' +
            '<span class="caret up"></span>' +
            '</div>' +
            '</div>' +
            '<ul class="ht-select-options">' + select_values + '</ul>' +
            '<input type="hidden" name="' + select_name + '" value="' + input_value + '">' +
            '</div>');

        $select.remove();

        $('.ht-select').find('.ht-select-header').click(function() {
            clickoption = $(this);
            option = clickoption.parent().find('.ht-select-options');
            var dropborder = $(this).closest(".input.dropdown");
            if (state == 0) {
                option.show();
                dropborder.css('border-bottom-left-radius','0');
                /*$('.ht-select').find('.ht-select-options').css({
                 height: 'auto',
                 display: 'block'
                 });*/

                state = 1;
                actual = clickoption;
            } else {
                //option.hide();
                $('.ht-select .ht-select-options').hide();
                dropborder.css('border-bottom-left-radius','2px');
                if(actual.is(clickoption)) { state = 0; } else { option.show(); actual = clickoption; state = 1; }

            }

        });

        $('.ht-select').find('.ht-select-options li').on('click', function() {

            input_value = $(this).data('value');
            var name = $(this).html();
            var opt = $(this).closest( ".ht-select" );
            opt.find("input[type='hidden']").val(input_value);
            //$('.ht-select').find('input').val(value);
            opt.find('.ht-select-header p').html(name);
            //$('.ht-select').find('.ht-select-header p').html(name);

            $(this).closest('ul').hide();

            state = 0;

            options.onChange.call($select, $select);

        });

    };

    $.fn.Holo_Select = function(options) {

        var defaults = {
            onChange: function(){}
        };

        var options = $.extend({}, defaults, options);

        return this.each(function() {

            var $select = $(this);

            var select = new Holo_Select(options);

            $select.data('select', select);

        });

    };

})(jQuery);