// head {
var __nodeId__ = "ss_components_cpForm__main_controls_input";
var __nodeNs__ = "ss_components_cpForm";
// }

(function (__nodeNs__, __nodeId__) {
    $.widget(__nodeNs__ + "." + __nodeId__, $.ewma.node, {
        options: {},

        __create: function () {
            var w = this;
            var o = w.options;
            var $w = w.element;

            w.bind();
        },

        bind: function () {
            var w = this;
            var $w = w.element;

            var updateStringValue = function ($input) {
                w.r('update', {
                    value: $input.val()
                });
            };

            var $input = $("input", $w);

            $input.rebind("blur cut paste", function () {
                updateStringValue($(this));
            });

            $input.rebind("keyup", function (e) {
                if (e.which === 13) {
                    updateStringValue($(this));
                }

                e.stopPropagation();
            });
        },

        savedHighlight: function () {
            var $field = $("input", this.element);

            $field.removeClass("updating").addClass("saved");

            setTimeout(function () {
                $field.removeClass("saved");
            }, 1000);
        }
    });
})(__nodeNs__, __nodeId__);
