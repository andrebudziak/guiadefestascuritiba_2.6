( function($) {
    tinymce.PluginManager.add( 'fb_test', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'fb_test', {

            text: 'DirectoryS',
            title: 'DirectoryS',
            icon: '../wp-content/themes/directorys/framework/page-tamer/css/img/settings-icon.png',
            image: '../wp-content/themes/directorys/framework/page-tamer/css/img/settings-icon.png',
            onclick: function() {

                $.holo_modal.open({
                    form: '#shortcodes-generator-window',
                    close: '.form-close'
                });
            }

        } );

    } );

} )(jQuery);
