(function($) {

    function HT_Media_Upload(settings) {

        this.init(settings);

    }

    HT_Media_Upload.prototype = {

        init: function(settings) {

            var self = this;

            self.settings = $.extend({
                state: 'holo-single-image',
                present_images: '',
                preview_container: '',
                frame: 'post',
                button_text: 'Insert',
                on_choose: function(attachment) {}
            }, settings);

            var $body = $('body');
            var file_frame;
            var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
            var set_to_post_id = 10; // Set this

            if ( self.settings.state == 'gallery-library') {
                var images_ids = self.get_images_ids(self.settings.present_images);
            }

            var img_selections = self.get_selections(images_ids);

            wp.media.model.settings.post.id = set_to_post_id;

            file_frame  = wp.media({
                frame:   self.settings.frame,
                state:	 self.settings.state,
                library: { type: 'image' },
                button:  { text: self.settings.button_text },
                selection: img_selections
            });

            file_frame.states.add([
                new wp.media.controller.Library({
                    id: 'holo-single-image',
                    title: 'Select Image',
                    priority:   10,
                    toolbar:    'select',
                    filterable: 'uploaded',
                    library:    wp.media.query( file_frame.options.library ),
                    multiple:   false,
                    editable:   true,
                    displayUserSettings: false,
                    displaySettings: true,
                    allowLocalEdits: true
                    // AttachmentView: media.view.Attachment.Library
                })
            ]);

            // When an image is selected, run a callback.
            file_frame.on( 'select update insert', function(e) {

                self.handle_image_select(e, file_frame, self.settings);

                file_frame.close();

                // Restore the main post ID
                wp.media.model.settings.post.id = wp_media_post_id;
            });

            // Finally, open the modal
            file_frame.open();

        },

        handle_image_select: function(e, file_frame, settings) {

            var self = this;

            switch ( settings.state ) {

                case 'gallery-library' :

                    var images = e.toJSON();

                    var images_result = '';

                    var images_markup = '';

                    $.each(images, function (key, attachment) {

                        images_result += attachment.url + '|' + attachment.caption + '|' + attachment.id + ',';

                        images_markup += '<img src="' + attachment.url + '" width="100" />';

                    });

                    images_result = images_result.substring(0, images_result.length - 1);

                    $(_clicked_button).closest('.gallery-container').find('.gallery-wrapper').html(images_markup);

                    $(_clicked_button).closest('.gallery-container').find('input').val(images_result);

                    break;

                case 'gallery-edit' :

                    var images = e.toJSON();

                    var images_result = '';

                    console.log(images);

                    var images_markup = '';

                    $.each(images, function (key, attachment) {

                        images_result += attachment.url + '|' + attachment.caption + '|' + attachment.id + ',';

                        images_markup += '<img src="' + attachment.url + '" width="100" />';

                    });

                    images_result = images_result.substring(0, images_result.length - 1);

                    $(_clicked_button).closest('.gallery-container').find('.gallery-wrapper').html(images_markup);

                    $(_clicked_button).closest('.gallery-container').find('input').val(images_result);

                    break;

                case 'holo-single-image' :

                    console.log(e);

                    var attachment = file_frame.state().get('selection').first().toJSON();

                    self.settings.on_choose.call(self, attachment);

                    break;

            }

        },

        get_selections: function(ids) {

            var self = this;

            if(typeof ids == 'undefined') return;

            var id_array = ids.split(','),
                args = {orderby: "post__in", order: "ASC", type: "image", perPage: -1, post__in:id_array},
                attachments = wp.media.query( args ),
                selection = new wp.media.model.Selection( attachments.models,
                    {
                        props:    attachments.props.toJSON(),
                        multiple: true
                    });

            if(self.settings.state == 'gallery-library' && id_array.length &&  !isNaN(parseInt(id_array[0],10)))
            {
                self.settings.state = 'gallery-edit';
            }

            return selection;

        },

        get_images_ids: function(images_data) {

            var images_ids = '';
            var images = images_data.split(',');

            $.each(images, function(key, image_data) {

                var image_data_array = image_data.split('|');

                images_ids += image_data_array[2] + ',';

            });

            images_ids = images_ids.substring(0, images_ids.length - 1);

            return images_ids

        }

    };

    $.ht_media_upload = {

        instances: [],

        open: function(settings) {

            new HT_Media_Upload(settings);

        }
    }

})(jQuery);
