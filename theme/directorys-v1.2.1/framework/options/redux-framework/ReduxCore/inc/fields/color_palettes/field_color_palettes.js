(function($) {

    $('.palette-select').change(function() {

        var palette_value = $(this).val();

        $(this).siblings('.palette-input').val(palette_value);

    });

})(jQuery);
