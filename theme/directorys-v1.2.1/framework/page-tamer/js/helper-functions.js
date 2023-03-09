(function($) {

    $.Holo = {

        concat: function() {

            var final_object = {};
            var args = arguments.length;

            for (var i = 0; i < args; i++) {
                for (p in arguments[i]) {

                    if (arguments[i].hasOwnProperty(p)) {
                        final_object[p] = arguments[i][p];
                    }

                }
            }

            return final_object;

        }

    };

})(jQuery);
