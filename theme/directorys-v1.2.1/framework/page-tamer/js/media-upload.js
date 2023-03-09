(function($) {

    $.Holo_Media_Upload = function() {

        var get_selections = function(ids, options)
        {

            if(typeof ids == 'undefined') return;

            var id_array = ids.split(','),
                args = {orderby: "post__in", order: "ASC", type: "image", perPage: -1, post__in:id_array},
                attachments = wp.media.query( args ),
                selection = new wp.media.model.Selection( attachments.models,
                    {
                        props:    attachments.props.toJSON(),
                        multiple: true
                    });

            if(options.state == 'gallery-library' && id_array.length &&  !isNaN(parseInt(id_array[0],10)))
            {
                options.state = 'gallery-edit';
            }
            return selection;
        };

        var get_images_ids = function(images_data) {

            var images_ids = '';
            var images = images_data.split(',');

            $.each(images, function(key, image_data) {

                var image_data_array = image_data.split('|');

                images_ids += image_data_array[2] + ',';

            });

            images_ids = images_ids.substring(0, images_ids.length - 1);

            return images_ids

        };

        var $body = $('body');

        var file_frame;
        var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
        var set_to_post_id = 10; // Set this

        $body.on('click', 'button.holo-upload-image-button', function( event ){

            var _clicked_button = this;
            var images_data = $(_clicked_button).closest('.gallery-container').find('input').val();

            var data = $(_clicked_button).data();

            if ( data.state == 'gallery-library') {
                var images_ids = get_images_ids(images_data);
            }

            var img_selections = get_selections(images_ids, data);

            event.preventDefault();

            // If the media frame already exists, reopen it.
//            if ( file_frame ) {
//                // Open frame
//                file_frame.open();
//                return;
//            } else {
                // Set the wp.media post id so the uploader grabs the ID we want when initialised
                wp.media.model.settings.post.id = set_to_post_id;
//            }

            file_frame  = wp.media({
                frame:   data.frame,
                state:	 data.state,
                library: { type: 'image' },
                button:  { text: data.button },
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

                switch ( data.state ) {

                    case 'gallery-library' :

                        var images = e.toJSON();

                        var images_result = '';

                        console.log(images);

                        var images_markup = '';

                        $.each(images, function (key, attachment) {

                            images_result += attachment.url + '|' + attachment.caption + '|' + attachment.id + ',';

                            images_markup += '<img src="' + attachment.url + '" width="100" />';

                        });

                        $(_clicked_button).closest('.gallery-container').find('.gallery-wrapper').html(images_markup);

                        images_result = images_result.substring(0, images_result.length - 1);

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

                        $(_clicked_button).closest('.gallery-container').find('.gallery-wrapper').html(images_markup);

                        images_result = images_result.substring(0, images_result.length - 1);

                        $(_clicked_button).closest('.gallery-container').find('input').val(images_result);

                        break;

                    case 'holo-single-image' :

                        var attachment = file_frame.state().get('selection').first().toJSON();

                        // Do something with attachment.id and/or attachment.url here
                        $(_clicked_button).closest('.upload-container').find('.upload-wrapper').find('img').remove();
                        $(_clicked_button).closest('.upload-container').find('.upload-wrapper .upload-buttons').find('.image-delete').remove();
                        $(_clicked_button).closest('.upload-container').find('.upload-wrapper .upload-buttons').append('<a href="" class="image-delete">Delete</a>');
                        $(_clicked_button).closest('.upload-container').find('.upload-wrapper').append('<img src="' + attachment.url + '" width="200px" />');
                        $(_clicked_button).closest('.upload-container').find('input[type="hidden"]').val(attachment.url);

                        console.log(attachment);

                        break;

                }

                file_frame.close();

                // Restore the main post ID
                wp.media.model.settings.post.id = wp_media_post_id;
            });

            // Finally, open the modal
            file_frame.open();
        });

    };

    new $.Holo_Media_Upload();

})(jQuery);
