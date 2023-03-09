/**
 * This file contains functions that takes care of the dynamic sidebars generation process
 *
 * Add the afferent markup to the page
 * Handles the deletion process via ajax
 */

(function($) {
    var form_script = $('#holo-custom-sidebar-form-script');
    var widgets_container = $('.widget-liquid-right');
    var form_container = $('.holo-custom-sidebar-form-wrapper');
    var custom_widgets = $('.sidebar-holo-sidebar');
    var delete_button = $('.custom-sidebar-delete-button');
    var nonce = form_container.find('input[name="holo-delete-custom-sidebar-nonce"]').val();

    add_delete_button();
    position_form();
    sidebar_delete_handler();

    /**
     * Add a delete button to each generated widget area
     */
    function add_delete_button() {

        custom_widgets.append('<span class="custom-sidebar-delete-button"></span>')

    }

    /**
     * Position the dynamically added form into its place
     */
    function position_form() {

        widgets_container.append(form_script.html());

    }

    /**
     * Handles the sidebar deletion
     */
    function sidebar_delete_handler() {
        widgets_container.on('click', '.custom-sidebar-delete-button', function() {

            var widget = $(this).parents('.sidebar-holo-sidebar'),
                title = widget.find('.sidebar-name h3'),
                spinner = title.find('.spinner'),
                widget_name = $.trim(title.text()),
                _this = $(this);

            $.ajax({
                type: 'POST',
                url: window.ajaxurl,
                data: {
                    action: 'delete_custom_sidebar',
                    name: widget_name,
                    _wpnonce: nonce
                },
                beforeSend: function() {
                    spinner.css('display', 'inline-block');
                },
                success: function() {
                    spinner.css('display', 'none');
                    _this.closest('.widgets-holder-wrap').remove();
                }
            })

        });
    }

})(jQuery);
