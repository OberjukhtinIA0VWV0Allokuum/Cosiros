(function ($) {

    $.emotions = function (text) {
        return $.emotions.parse(text);
    };

    var $t = $.emotions;

    $.extend($.emotions, {

        settings: {
            replacement: '<span title="{eId}" class="emotions emo-{eId}"></span>',
            map: {
                "o:)": "angel",
                "o.O": "confused",
                "3:)": "devil",
                "<3": "heart",
                ":*": "kiss",
                ":-)": "smile",
                ":]": "smile",
                "8|": "sunglasses",
                ":/": "unsure",
                ";)": "wink",
                ":'(": "cry",
                ">:(": "grumpy",
                ":(": "frown",
                "8)": "glasses",
                ":p": "tongue",
                ":)": "smile",
                "=)": "smile",
                ":D": "grin"
            }
        },
        shortcode: function(eId){
            var $s = $t.settings;
            for (var pattern in $s.map) {
                if($s.map[pattern] == eId)
                    return pattern;
            }

            return "";
        },
        parse: function (text) {

            var $s = $t.settings;

            for (var pattern in $s.map) {

                var encPattent = $t.encode(pattern);

                if (text.indexOf(pattern) < 0 && text.indexOf(encPattent) < 0) {
                    continue;
                }

                var rep = $s.replacement
                    .replace(/\{eId\}/g, $s.map[pattern]);

                text = text
                    .replace(new RegExp($t.quote(pattern), "g"), rep)
                    .replace(new RegExp($t.quote(encPattent), "g"), rep);
            }

            return text;
        },
        encode: function (str) {
            return (str + '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');
        },
        quote: function (str) {
            return (str + '').replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
        }
    });

    $.fn.emotions = function (action, options) {
        this.each(function () {
            var el = $(this);
            el.html($.emotions(el.html()));
        });
    };
})(jQuery);
