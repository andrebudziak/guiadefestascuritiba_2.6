(function($) {

    function HT_Modal(settings) {

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

    HT_Modal.prototype = {

        init: function(settings) {

            var _modal = this;

            this.settings = $.extend({
                form: '',
                save_button: 'Save',
                close_button: '',
                title: 'No Title',
                width: '500px',
                height: '500px',
                markup: '',
                DOM_content_select: '',
                display_close: true,
                onStart: function() {},
                onClose: function() {},
                onSave: function() {}
            }, settings);

            this.modal_id = Math.floor(Math.random() * (9999 - 1000) + 1000);
            this.modal_attr_id = 'ht-modal' + this.modal_id;

            var close_markup = '';

            if (_modal.settings.display_close) {

                close_markup = '<div class="ht-modal-close"><i class="fa-cancel"></i></div>'

            }

            this.modal_markup = '' +
                '<style type="text/css">' +
                    '#' + this.modal_attr_id + ' .ht-modal-wrapper { ' +
                        'position: relative;' +
                        'width: ' + this.settings.width + '; ' +
                        'height: ' + this.settings.height + '; ' +
                        'background-color: #fff;' +
                        'left: calc(50% - ' + parseInt(this.settings.width) / 2 + 'px); ' +
                        'top: calc(50% - ' + parseInt(this.settings.height) / 2 + 'px); ' +
                    '}' +
                '</style>' +
                '<div class="holo-modal" id="' + this.modal_attr_id + '">' +
                    '<div class="ht-modal-wrapper">' +
                        close_markup +
                        this.settings.markup +
                    '</div>' +
                '</div>';

            this.$body.append(this.modal_markup);
            this.$modal = $('#' + this.modal_attr_id);

            if (_modal.settings.DOM_content_select) {

                $(this.settings.DOM_content_select).clone().appendTo('#' + _modal.modal_attr_id + ' .ht-modal-wrapper');

                this.$modal.find(this.settings.DOM_content_select).show();

            }

            this.$modal_wrapper = this.$modal.find('.ht-modal-wrapper');
            this.$modal_content = this.$modal.find('.holo-modal-content');

            this.open(this.settings);

            this.onClose();

            this.onSave();

            this.$modal.find('.ht-modal-close').click(function() {

                _modal.$modal.remove();

            });

            if (this.settings.close_button) {

                $(this.settings.close_button).click(function() {

                    _modal.$modal.remove();

                })

            }


        },

        open: function(settings) {

            var self = this;

            this.instances.push(this);

            settings.onStart.call(self, self.$modal);

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

    $.ht_modal = {

        instances: [],

        open: function(settings) {

            var modal = new HT_Modal(settings);

            this.instances.push(modal);

            console.log('instances', this.instances);

        }

    }

})(jQuery);
