(function($) {

    $.Shortcodes_Generator = function(page_tamer) {

        this.shortcodes = page_tamer.shortcodes;

        this.init(page_tamer);
    };

    $.Shortcodes_Generator.prototype = {

        init: function(page_tamer) {

//            var _behaviour = new $.Behaviour(page_tamer);

            var shortcodes_markup = '';

            $.each(this.shortcodes, function(sc_key, sc_obj) {

                if ( false === sc_obj.child ) {
                    shortcodes_markup += '<div><a href="#" data-element-id="' + sc_key + '">' + sc_obj.name + '</a></div>';
                }

            });

            $('body').append('' +
                '<div id="shortcodes-generator-window">' +
                     shortcodes_markup + '' +
                '</div>');

            $('#shortcodes-generator-window').on('click', 'a', function(event) {

                event.preventDefault();

                var shortcode_id = $(this).attr('data-element-id');

                var modalWidth = $('#' + shortcode_id + '-form').width();

                var deferred_inputs = [];

                $.holo_modal.open({
                    form: '#' + shortcode_id + '-form',
                    close: '.form-close',
                    onStart: function() {

                        $.holo_modal.instances[$.holo_modal.instances.length - 1].close();

                        console.log('shortcode info: ', page_tamer.shortcodes[shortcode_id]);

                        var sc_attributes = page_tamer.shortcodes[shortcode_id].attributes;

                        $.each(sc_attributes, function(key, attribute) {

                            var style_atts = page_tamer.shortcodes[shortcode_id].style_atts[key];
                            var attributes = page_tamer.shortcodes[shortcode_id].attributes[key];

                            var options = $.extend(style_atts,attributes);

                            if ( key !== 'unique_id' ) {
                                deferred_inputs.push(
                                    $.Input_Fields[attribute.type].handle_front_end('.' + shortcode_id + '-' + key, attribute.value, options)
                                );
                            }

                            console.log('sc generator options: ', options);

                        });

                        if ( null !== page_tamer.shortcodes[shortcode_id].content) {

                            console.log(page_tamer.shortcodes[shortcode_id].content);

                            var content_type = page_tamer.shortcodes[shortcode_id].content.type;

                            deferred_inputs.push(
                                $.Input_Fields[content_type].handle_front_end('.' + shortcode_id + '-content', '')
                            );
                        }

                        $.when.apply(null, deferred_inputs).done(function() {
                            console.log('cool');
                        });

                        console.log('deferred_inputs: ', deferred_inputs);

                    },
                    onSave: function($form) {

                        page_tamer.behaviour.editor_add($form);

                    }
                });

            });
        }

    };

})(jQuery);
