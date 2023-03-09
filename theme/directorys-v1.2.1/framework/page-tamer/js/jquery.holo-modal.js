(function($) {

    $.fn.holo_modal = function(settings) {

        settings = $.extend({
            form: '',
            close: '',
            onStart: function() {},
            onClose: function() {}
        }, settings);

        $(this).click(function(event) {

            event.preventDefault();

            $(settings.form).clone().appendTo('body');
            $('body').append('<div id="' + $(settings.form).attr('id') + '-overlay"></div>');

            var form_width = $(settings.form).width();

            $('body > ' + settings.form).css({
                position: 'fixed',
                top: '50px',
                left: '50%',
                marginLeft: '-' + ((form_width / 2) + 30) + 'px',
                display: 'block',
                zIndex: 999999999999
            });

            settings.onStart.call(this);

            $(settings.close).click(function(event) {

                event.preventDefault();

                settings.onClose.call(this, $('body > ' + settings.form));

                $('body > ' + settings.form).remove();
                $('body > ' + settings.form + '-overlay').remove();

                $(settings.form).css({
                    display: 'none'
                });

            });

        });

    };

    function Holo_Modal(settings) {

        var modal_id;

        this.$html = $('html');
        this.$body = $('body');
        this.$modal = '';
        this.$modal_wrapper = '';
        this.$modal_content = '';
        this.modal_markup = '';
        this.$form_parent = '';
        this.instances = [];

        this.init(settings);

    }

    Holo_Modal.prototype = {

        init: function(settings) {

            this.settings = $.extend({
                form: '',
                save_button: 'Save',
                close_button: 'Cancel',
                title: 'No Title',
                onStart: function() {},
                onClose: function() {},
                onSave: function() {}
            }, settings);

            this.modal_id = Math.floor(Math.random() * (9999 - 1000) + 1000);

            this.modal_markup = '' +
                '<div class="holo-modal" data-modal-id="' + this.modal_id + '">' +
                    '<div class="holo-modal-wrapper">' +
                        '<div class="holo-modal-header clearfix">' +
                            '<div class="holo-modal-heading left-side">' +
                                '<h2 style="margin: 3px 0;">' + this.settings.title + '</h2>' +
                            '</div>' +
                            '<div class="holo-modal-buttons right-side">' +
                                '<button class="holo-close-item-button">Cancel</button>' +
                                '<!--<div class="custom-css-container"><input type="checkbox" class="holo-custom-css" /><label>Custom CSS</label></div>-->' +
                            '</div>' +
                        '</div>' +
                        '<div class="holo-modal-content"></div>' +
                        '<div class="holo-modal-footer">' +
                            '<div class="left-side">' +
                                '<div class="element-id">' +
                                    '<input type="text" class="unique-id" value="" />' +
                                '</div>' +
                            '</div>' +
                            '<div class="right-side"><button class="holo-save-item-button">' + this.settings.save_button  + '</button></div>' +
                        '</div>' +
                    '</div>' +
                '</div>';

            this.$body.append(this.modal_markup);

            this.$modal = $('.holo-modal[data-modal-id="' + this.modal_id + '"]');
            this.$modal_wrapper = $('.holo-modal[data-modal-id="' + this.modal_id + '"] .holo-modal-wrapper');
            this.$modal_content = $('.holo-modal[data-modal-id="' + this.modal_id + '"] .holo-modal-content');

            //this.$html.css('overflow', 'hidden');

            this.open(this.settings);

            this.onClose();

            this.onSave();

        },

        open: function(settings) {

            this.$form_parent = $(settings.form).parent();

            $(settings.form).appendTo(this.$modal_content);

//            this.$modal_content.css('width', '1000px');

            this.$modal_content.find(this.settings.form).css({
                display: 'block'
            });

            var form_width = $(this.settings.form).width();

            this.$modal_wrapper.css({
                marginLeft: '-' + ((form_width / 2) + 30) + 'px',
                height: ($('body').height() - 80) + 'px'
            });

            this.$modal_content.css({
                height: ($('body').height() - 180) + 'px'
            });

            this.instances.push(this);

            settings.onStart.call(this);

            console.log('Holo Modal Instances : ', this.instances);

        },

        close: function() {

            var _obj = this;

            _obj.settings.onClose.call(this, $('.holo-modal-content > ' + _obj.settings.form));

            _obj.$form_parent.append($(_obj.settings.form));

            var editor_id = $(_obj.settings.form).find('textarea').attr('id');

            if ( undefined !== editor_id ) {
                tinymce.execCommand('mceRemoveControl', true, editor_id);
            }

            $(_obj.settings.form).css('display', 'none');

            _obj.$modal.remove();

            _obj.$html.css('overflow', 'auto');

            $(this).unbind('click');
        },

        onClose: function() {

            var _obj = this;

            $('.holo-close-item-button').click(function(event) {

                event.preventDefault();

                _obj.$html.css('overflow', 'auto');

                _obj.settings.onClose.call(this, $('.holo-modal-content > ' + _obj.settings.form));

                _obj.$form_parent.append($(_obj.settings.form));

                var editor_id = $(_obj.settings.form).find('textarea').attr('id');

//                if ( undefined !== editor_id ) {
//                    tinymce.execCommand('mceRemoveControl', true, editor_id);
//                }

                $(_obj.settings.form).css('display', 'none');

                _obj.$modal.remove();

                $(this).unbind('click');

                delete _obj.instances[_obj.modal_id];

                console.log('Holo Modal Instances : ', _obj.instances);
            });

        },

        onSave: function() {

            var _obj = this;

            $('.holo-save-item-button').click(function(event) {

                event.preventDefault();

                _obj.settings.onSave.call(this, _obj.$modal_content.find(_obj.settings.form));

                _obj.$form_parent.append($(_obj.settings.form));

                var editor_id = $(_obj.settings.form).find('textarea').attr('id');

                if ( undefined !== editor_id ) {
                    tinymce.execCommand('mceRemoveControl', true, editor_id);
                }

                $(_obj.settings.form).css('display', 'none');

                _obj.$modal.remove();

                _obj.$html.css('overflow', 'auto');

                _obj.settings.onClose.call(this, $('.holo-modal-content > ' + _obj.settings.form));

                $(this).unbind('click');
            });

        }

    };

    $.holo_modal = {

        instances: [],

        open: function(settings) {

            var modal = new Holo_Modal(settings);

            this.instances.push(modal);

            console.log('instances', this.instances);
        }
    }

})(jQuery);
