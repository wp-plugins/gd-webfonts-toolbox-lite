/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(2(a){6(x p===\'2\'&&p.12){p([\'Z\'],a)}W{a(T)}}(2($){3 k=/\\+/g;2 r(s){4 m.n?s:Q(s)}2 G(s){4 m.n?s:E(s)}2 B(a){4 r(m.A?z.X(a):V(a))}2 F(s){6(s.14(\'"\')===0){s=s.U(1,-1).w(/\\\\"/g,\'"\').w(/\\\\\\\\/g,\'\\\\\')}L{s=E(s.w(k,\' \'));4 m.A?z.O(s):s}S(e){}}2 u(s,a){3 b=m.n?s:F(s);4 $.y(a)?a(b):b}3 m=$.8=2(a,b,c){6(b!==9&&!$.y(b)){c=$.C({},m.D,c);6(x c.7===\'10\'){3 d=c.7,t=c.7=M N();t.K(+t+d*P+5)}4(o.8=[r(a),\'=\',B(b),c.7?\'; 7=\'+c.7.R():\'\',c.q?\'; q=\'+c.q:\'\',c.v?\'; v=\'+c.v:\'\',c.H?\'; H\':\'\'].I(\'\'))}3 e=a?9:{};3 f=o.8?o.8.J(\'; \'):[];Y(3 i=0,l=f.11;i<l;i++){3 g=f[i].J(\'=\');3 h=G(g.13());3 j=g.I(\'=\');6(a&&a===h){e=u(j,b);15}6(!a&&(j=u(j))!==9){e[h]=j}}4 e};m.D={};$.16=2(a,b){6($.8(a)===9){4 17}$.8(a,\'\',$.C({},b,{7:-1}));4!$.8(a)}}));',62,70,'||function|var|return||if|expires|cookie|undefined||||||||||||||raw|document|define|path|encode|||read|domain|replace|typeof|isFunction|JSON|json|stringifyCookieValue|extend|defaults|decodeURIComponent|parseCookieValue|decode|secure|join|split|setTime|try|new|Date|parse|864e|encodeURIComponent|toUTCString|catch|jQuery|slice|String|else|stringify|for|jquery|number|length|amd|shift|indexOf|break|removeCookie|false'.split('|'),0,{}));

/*jslint regexp: true, nomen: true, sloppy: true, eqeq: true, vars: true, white: true, plusplus: true, maxerr: 50, indent: 4 */
var gdwft_editor;

;(function($, window, document, undefined) {
    gdwft_editor = {
        tmp: {
            included: {
                google: [],
                adobe: []
            },
            preview: {
                google: [],
                adobe: []
            },
            versions: {
                google: [],
                adobe: []
            },
            modified: {
                google: [],
                adobe: []
            },
            variants: {
                google: [],
                adobe: []
            },
            categories: {
                google: [],
                adobe: []
            },
            fonts: {
                google: [],
                adobe: []
            },
            urls: {},
            includes: {},
            rules: {},
            current_id: 0,
            url: "",
            font: {
                provider: "",
                name: ""
            }
        },
        data: {
            font: [
                "font-style", "font-variant", "font-weight", "font-size"
            ],
            prefixed: [
                "box-sizing"
            ],
            map: {
                border: {
                    value_pair: ["border-topbottom", "border-leftright"],
                    value_all: ["border-top", "border-right", "border-bottom", "border-left"]
                },
                margin: {
                    value_pair: ["margin-topbottom", "margin-leftright"],
                    value_all: ["margin-top", "margin-right", "margin-bottom", "margin-left"]
                },
                padding: {
                    value_pair: ["padding-topbottom", "padding-leftright"],
                    value_all: ["padding-top", "padding-right", "padding-bottom", "padding-left"]
                },
                "border-radius": {
                    value_all: ["border-top-left-radius", "border-top-right-radius", "border-bottom-right-radius", "border-bottom-left-radius"]
                }
            },
            pairs: {
                "border-topbottom": ["border-top", "border-bottom"],
                "border-leftright": ["border-right", "border-left"]
            },
            parents: {
                "border-top-left-radius": ["border-radius", "all"],
                "border-top-right-radius": ["border-radius", "all"],
                "border-bottom-right-radius": ["border-radius", "all"],
                "border-bottom-left-radius": ["border-radius", "all"],
                "margin-topbottom": ["margin", "pair"],
                "margin-leftright": ["margin", "pair"],
                "margin-top": ["margin", "all"],
                "margin-right": ["margin", "all"],
                "margin-bottom": ["margin", "all"],
                "margin-left": ["margin", "all"],
                "padding-topbottom": ["padding", "pair"],
                "padding-leftright": ["padding", "pair"],
                "padding-top": ["padding", "all"],
                "padding-right": ["padding", "all"],
                "padding-bottom": ["padding", "all"],
                "padding-left": ["padding", "all"],
                "border-topbottom": ["border", "pair"],
                "border-leftright": ["border", "pair"],
                "border-top": ["border", "all"],
                "border-right": ["border", "all"],
                "border-bottom": ["border", "all"],
                "border-left": ["border", "all"]
            },
            settings: {
                "color": ["select", "hex", "opacity"],
                "vertical-align": ["select", "custom", "unit"],
                "line-height": ["select", "custom", "unit"],
                "word-spacing": ["select", "custom", "unit"],
                "font-size": ["select", "custom", "unit"],
                "text-indent": ["select", "custom", "unit"],
                "letter-spacing": ["select", "custom", "unit"],
                "direction": ["select"],
                "white-space": ["select"],
                "word-break": ["select"],
                "font-style": ["select"],
                "font-variant": ["select"],
                "font-weight": ["select"],
                "text-align": ["select"],
                "text-decoration": ["select"],
                "text-transform": ["select"]
            },
            box: {
                "background": ["select", "hex", "opacity"],
                "display": ["select"],
                "clear": ["select"],
                "box-sizing": ["select"],
                "width": ["select", "custom", "unit"],
                "height": ["select", "custom", "unit"],
                "min-width": ["select", "custom", "unit"],
                "min-height": ["select", "custom", "unit"],
                "max-width": ["select", "custom", "unit"],
                "max-height": ["select", "custom", "unit"],
                "border-radius": ["select", "custom", "unit"],
                "border-top-left-radius": ["custom", "unit"],
                "border-top-right-radius": ["custom", "unit"],
                "border-bottom-right-radius": ["custom", "unit"],
                "border-bottom-left-radius": ["custom", "unit"],
                "margin": ["select", "custom", "unit"],
                "margin-topbottom": ["custom", "unit"],
                "margin-leftright": ["custom", "unit"],
                "margin-top": ["custom", "unit"],
                "margin-right": ["custom", "unit"],
                "margin-bottom": ["custom", "unit"],
                "margin-left": ["custom", "unit"],
                "padding": ["select", "custom", "unit"],
                "padding-topbottom": ["custom", "unit"],
                "padding-leftright": ["custom", "unit"],
                "padding-top": ["custom", "unit"],
                "padding-right": ["custom", "unit"],
                "padding-bottom": ["custom", "unit"],
                "padding-left": ["custom", "unit"],
                "border": ["select", "custom", "unit", "hex", "opacity", "style"],
                "border-topbottom": ["custom", "unit", "hex", "opacity", "style"],
                "border-leftright": ["custom", "unit", "hex", "opacity", "style"],
                "border-top": ["custom", "unit", "hex", "opacity", "style"],
                "border-right": ["custom", "unit", "hex", "opacity", "style"],
                "border-bottom": ["custom", "unit", "hex", "opacity", "style"],
                "border-left": ["custom", "unit", "hex", "opacity", "style"],
                "outline": ["select", "custom", "unit", "hex", "opacity", "style"]
            }
        },
        hex2rgba: function (hex, opacity) {
            if (opacity == 1) {
                return hex;
            }

            var rgb = hex.replace("#", "").match(/(.{2})/g), i = 3;

            while (i--) {
                rgb[i] = parseInt(rgb[i], 16);
            }

            if (typeof opacity == "undefined") {
                return "rgb(" + rgb.join(", ") + ")";
            }

            return "rgba(" + rgb.join(", ") + ", " + opacity + ")";
        },
        tabs: function() {
            $(document).on("click", "ul.wp-tab-bar li a", function(e){
                e.preventDefault();

                if (!$(this).parent().hasClass("wp-tab-active")) {
                    var id = $(this).attr("href");

                    $(this).parent().parent().children().removeClass("wp-tab-active");
                    $(this).parent().addClass("wp-tab-active");

                    $(this).parent().parent().parent().children("div.wp-tab-panel").hide();
                    $(id).show();
                }
            });
        },
        dialogs: {
            classes: function(extra) {
                var cls = "wp-dialog d4p-dialog gdwft-modal-dialog";

                if (gdwft_data.wp_version < 39) {
                    cls+= " wpv-pre-39";
                }

                if (extra !== "") {
                    cls+= " " + extra;
                }

                return cls;
            },
            init: function() {
                $("#gdwft-dialog-please-wait").wpdialog({
                    width: 480,
                    height: "auto",
                    minHeight: 24,
                    dialogClass: gdwft_editor.dialogs.classes("gdwft-dialog-hidex"),
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    closeOnEscape: false,
                    zIndex: 300000,
                    title: gdwft_data.dialog_title_please_wait
                });

                $("#gdwft-dialog-are-you-sure").wpdialog({
                    width: 480,
                    height: "auto",
                    minHeight: 24,
                    dialogClass: gdwft_editor.dialogs.classes("gdwft-dialog-hidex"),
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    closeOnEscape: false,
                    zIndex: 300000,
                    buttons: {
                        OK: function() {
                            window.location.href = gdwft_editor.tmp.url;
                        },
                        Cancel: function() {
                            $("#gdwft-dialog-are-you-sure").wpdialog("close");
                        }
                    }
                });
            },
            rules: function() {
                $("#gdwft-editor-selector").wpdialog({
                    width: 400,
                    height: "auto",
                    minHeight: 160,
                    maxHeight: 820,
                    dialogClass: gdwft_editor.dialogs.classes(""),
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    closeOnEscape: false,
                    zIndex: 300000,
                    buttons: {
                        Save: function() {
                            gdwft_editor.rules.save_selector();
                        },
                        Cancel: function() {
                            $("#gdwft-editor-selector").wpdialog("close");
                        }
                    }
                });

                $("#gdwft-editor-block").wpdialog({
                    width: 840,
                    height: "auto",
                    minHeight: 160,
                    maxHeight: 820,
                    dialogClass: gdwft_editor.dialogs.classes(""),
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    closeOnEscape: false,
                    zIndex: 300000,
                    buttons: {
                        Save: function() {
                            gdwft_editor.rules.save_styler();
                        },
                        Cancel: function() {
                            $("#gdwft-editor-block").wpdialog("close");
                        }
                    }
                });

                $("#gdwft-preview-css").wpdialog({
                    width: 840,
                    height: "auto",
                    minHeight: 320,
                    maxHeight: 820,
                    dialogClass: gdwft_editor.dialogs.classes(""),
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    closeOnEscape: false,
                    zIndex: 300000,
                    buttons: {
                        OK: function() {
                            $("#gdwft-preview-css").wpdialog("close");
                        }
                    }
                });

                $("#gdwft-preview-full").wpdialog({
                    width: 840,
                    height: "auto",
                    minHeight: 320,
                    maxHeight: 820,
                    dialogClass: gdwft_editor.dialogs.classes(""),
                    autoOpen: false,
                    resizable: false,
                    modal: true,
                    closeOnEscape: false,
                    zIndex: 300000,
                    buttons: {
                        OK: function() {
                            $("#gdwft-preview-full").wpdialog("close");
                        }
                    }
                });
            },
            please_wait: function(operation) {
                $("#gdwft-dialog-please-wait").wpdialog(operation);
            },
            are_you_sure: function(url) {
                gdwft_editor.tmp.url = url;

                $("#gdwft-dialog-are-you-sure").wpdialog("open");
            }
        },
        editor: {
            load: {
                reset: function(scope) {
                    if (!scope) {
                        scope = "#gdwft-editor-block";
                    }

                    if (scope === "#tab-font") {
                        $(scope + " .gdwft-block-left select").prop("selectedIndex", 0);
                    }

                    $(scope + " .gdwft-values-block").hide();

                    $(scope + " .gdwft-editor-activity-item").prop("checked", false);

                    $(scope + " .gdwft-editor-settings-select, " + scope + " .gdwft-editor-settings-unit").prop("selectedIndex", 0);
                    $(scope + " .gdwft-editor-settings-unit").prop("selectedIndex", 0);
                    $(scope + " .gdwft-editor-settings-custom").val("0");
                    $(scope + " .gdwft-editor-settings-unit").val("px");
                    $(scope + " .gdwft-editor-settings-opacity").val("1");

                    $(scope + " .gdwft-editor-settings-hex").each(function() {
                        $(this).val($(this).data("defaultValue"));
                    });

                    $(scope + " select").trigger("change");
                },
                standard: function(base, key, value, properties) {
                    for (var i = 0; i < properties.length; i++) {
                        $("#gdwft-editor-" + base + "-" + key + "-" + properties[i]).val(value[properties[i]]);

                        if (properties[i] === "select") {
                            $("#gdwft-editor-" + base + "-" + key + "-" + properties[i]).trigger("change");
                        }

                        if (properties[i] === "hex") {
                            $("#gdwft-editor-" + base + "-" + key + "-hex").minicolors("value", value[properties[i]]);
                        }

                        if (properties[i] === "opacity") {
                            $("#gdwft-editor-" + base + "-" + key + "-hex").minicolors("opacity", value[properties[i]]);
                            $("#gdwft-editor-" + base + "-" + key + "-opacity").val(value[properties[i]]);
                        }
                    }
                },
                activity: function(activity) {
                    $.each(activity, function(key, value) {
                        if (value === true || value === "true") {
                            $("#gdwft-editor-activity-" + key).prop("checked", true);
                        }
                    });
                },
                settings: function(settings) {
                    $.each(settings, function(key, value) {
                        gdwft_editor.editor.load.standard("settings", key, value, gdwft_editor.data.settings[key]);
                    });
                },
                box: function(settings) {
                    $.each(settings, function(key, value) {
                        gdwft_editor.editor.load.standard("box", key, value, gdwft_editor.data.box[key]);
                    });
                },
                custom: function(custom) {
                    var styles = '', i;

                    for (i = 0; i < custom.length; i++) {
                        styles+= custom[i] + ";\n";
                    }

                    $("#gdwft-editor-custom-styles").val(styles);
                },
                font: function(font) {
                    if (font.extra === "") {
                        font.extra = "none";
                    }

                    $("#gdwft-editor-block-font-type").val(font.type).trigger("change");

                    switch (font.type) {
                        case "generic":
                            $("#gdwft-editor-block-font-generic").val(font.value);
                            break;
                        case "stack":
                            $("#gdwft-editor-block-font-stack").val(font.value);
                            break;
                        case "google":
                            $("#gdwft-editor-block-font-google").val(font.value);
                            $("#gdwft-editor-block-font-extra").val(font.extra);
                            break;
                        case "adobe":
                            $("#gdwft-editor-block-font-adobe").val(font.value);
                            $("#gdwft-editor-block-font-extra").val(font.extra);
                            break;
                    }
                }
            },
            preview: function() {
                var rule = gdwft_editor.editor.build(), style = '';

                style+= gdwft_editor.preview.list(rule, 'font');
                style+= gdwft_editor.preview.list(rule, 'settings');
                style+= gdwft_editor.preview.list(rule, 'box');
                style+= gdwft_editor.preview.list(rule, 'custom');

                $("#gdwft-preview-full-box p").attr("style", style);
            },
            build: function() {
                var i, parent, tmp = {}, rule = {
                    activity: {
                        font: false,
                        settings: false,
                        box: false,
                        custom: false
                    },
                    font: {
                        type: $("#gdwft-editor-block-font-type").val(), 
                        value: "", 
                        extra: ""
                    },
                    settings: {},
                    box: {},
                    custom: $("#gdwft-editor-custom-styles").val()
                };

                switch (rule.font.type) {
                    case "generic":
                        rule.font.value = $("#gdwft-editor-block-font-generic").val();
                        break;
                    case "stack":
                        rule.font.value = $("#gdwft-editor-block-font-stack").val();
                        break;
                    case "google":
                        rule.font.value = $("#gdwft-editor-block-font-google").val();
                        rule.font.extra = $("#gdwft-editor-block-font-extra").val();
                        break;
                    case "adobe":
                        rule.font.value = $("#gdwft-editor-block-font-adobe").val();
                        rule.font.extra = $("#gdwft-editor-block-font-extra").val();
                        break;
                }

                $.each(gdwft_editor.data.settings, function(key, values) {
                    var i, save = true;

                    if ($.inArray("select", values) > -1) {
                        if ($("#gdwft-editor-settings-" + key + "-select").val() === '') {
                            save = false;
                        }
                    }

                    if (save) {
                        rule.settings[key] = {};

                        for (i = 0; i < values.length; i++) {
                            rule.settings[key][values[i]] = $("#gdwft-editor-settings-" + key + "-" + values[i]).val();
                        }
                    }
                });

                $.each(gdwft_editor.data.box, function(key, values) {
                    var i, save = true;

                    if ($.inArray("select", values) > -1) {
                        if ($("#gdwft-editor-box-" + key + "-select").val() === '') {
                            save = false;
                        }
                    }

                    if (save) {
                        tmp[key] = {};

                        for (i = 0; i < values.length; i++) {
                            tmp[key][values[i]] = $("#gdwft-editor-box-" + key + "-" + values[i]).val();
                        }
                    }
                });

                $.each(tmp, function(key, data){
                    if (gdwft_editor.data.parents.hasOwnProperty(key)) {
                        parent = gdwft_editor.data.parents[key];

                        if (tmp.hasOwnProperty(parent[0])) {
                            if (tmp[parent[0]].select === "value_" + parent[1]) {
                                rule.box[key] = data;
                            }
                        }
                    } else {
                        rule.box[key] = data;
                    }
                });

                $(".gdwft-editor-activity-item:checked").each(function(){
                    rule.activity[$(this).val()] = true;
                });

                return rule;
            }
        },
        rules: {
            init: function() {
                gdwft_editor.tabs();

                gdwft_editor.dialogs.rules();
                gdwft_editor.rules.switcher();
                gdwft_editor.rules.selector();
                gdwft_editor.rules.styler();
                gdwft_editor.rules.order();
                gdwft_editor.rules.controls();

                var preview_text = gdwft_data.preview_text;

                if ($.cookie("gdwft_preview_text")) {
                    preview_text = $.cookie("gdwft_preview_text");
                }

                gdwft_editor.preview.css();
                gdwft_editor.preview.full();

                $(".gdwft-preview-full-text").val(preview_text).change();
            },
            order: function() {
                $(document).on("click", ".gdwft-move-rule-top", function(e){
                    e.preventDefault();
                    
                    var item = $(this).closest("tr"),
                        parent = item.parent();

                    parent.prepend(item);

                    gdwft_editor.rules.reorder();
                });

                $(document).on("click", ".gdwft-move-rule-bottom", function(e){
                    e.preventDefault();
                    
                    var item = $(this).closest("tr"),
                        parent = item.parent();

                    parent.append(item);

                    gdwft_editor.rules.reorder();
                });

                $(document).on("click", ".gdwft-move-rule-up", function(e){
                    e.preventDefault();

                    var item = $(this).closest("tr"),
                        prev = item.prev();

                    if (prev.length === 0) {
                        return;
                    }

                    item.insertBefore(prev);

                    gdwft_editor.rules.reorder();
                });

                $(document).on("click", ".gdwft-move-rule-down", function(e){
                    e.preventDefault();

                    var item = $(this).closest("tr"),
                        next = item.next();

                    if (next.length === 0) {
                        return;
                    }

                    item.insertAfter(next);

                    gdwft_editor.rules.reorder();
                });

                $(".gdwft-grid-ctrl-dragdrop").click(function(e){
                    e.preventDefault();

                    var active = $(this).hasClass("ctrl-active");

                    if (active) {
                        $(".gdwft-rules-dragdrop").hide();
                        $(this).removeClass("ctrl-active");
                    } else {
                        $(".gdwft-rules-dragdrop").show();
                        $(this).addClass("ctrl-active");
                    }
                });

                $(".gdwft-grid-ctrl-movicons").click(function(e){
                    e.preventDefault();

                    var active = $(this).hasClass("ctrl-active");

                    if (active) {
                        $(".gdwft-rules-movicons").hide();
                        $(this).removeClass("ctrl-active");
                    } else {
                        $(".gdwft-rules-movicons").show();
                        $(this).addClass("ctrl-active");
                    }
                });

                $("table.gdwft-rules-grid tbody").sortable({
                    items: "tr.gdwft-rule",
                    placeholder: "gdwft-tr-placeholder",
                    cursor: "move",
                    axis: "y",
                    containment: "table.gdwft-rules-grid",
                    handle: ".gdwft-rules-dragdrop .fa-bars",
                    scrollSensitivity: 32,
                    helper: function(e, ui) {					
                        ui.children().each(function() {
                            $(this).width($(this).width());
                        });

                        return ui;
                    },
                    update: function(event, ui) {	
                        gdwft_editor.rules.reorder();
                    }
                });
            },
            reorder: function() {
                var order = [];

                $("table.gdwft-rules-grid tr.gdwft-rule").each(function(idx) {
                    order.push($(this).attr("gdwft-rule"));
                });

                $.ajax({
                    dataType: "html", data: { list: order },
                    type: "post", url: ajaxurl + '?action=gdwft_reorder_rules&_ajax_nonce=' + gdwft_data.nonce
                });
            },
            styler: function() {
                $(".gdwft-editor-activity-reset").click(function(e){
                    e.preventDefault();

                    if (gdwft_editor.confirm()) {
                        var scope = $(this).attr("href").substr(1);

                        gdwft_editor.editor.load.reset("#tab-" + scope);
                        gdwft_editor.editor.preview();
                    }
                });

                $(document).on("click", ".gdwft-rule-settings-edit", function(e){
                    e.preventDefault();

                    var id = $(this).attr("href").substring(1);
                    gdwft_editor.rules.load_styler(id, gdwft_editor.tmp.rules[id]);
                });

                $(".gdwft-settings-with-value").change(function(){
                    var offset = 7, value = $(this).val(),
                        name = $(this).attr('id');

                    name = name.substr(0, name.length - offset);

                    $("." + name + "-div").hide();

                    if (value.substr(0, 5) === 'value') {
                        $("#" + name + "-div-" + value).show();
                    }
                });

                $("#gdwft-editor-block-font-type").change(function(){
                    var type = $(this).val();

                    $(".gdwft-editor-block-font").hide();
                    $("#gdwft-editor-block-font-type-" + type).show();

                    if (type === "google" || type === "adobe") {
                        $("#gdwft-editor-block-font-type-extras").show();
                    }
                });

                $(".gdwft-editor-settings-opacity").change(function(){
                    var opacity = $(this).val(),
                        mini = $(this).prev().find(".gdwft-editor-settings-hex"),
                        old = mini.data("opacity");

                    if (old !== opacity) {
                        mini.minicolors("opacity", opacity);
                    }
                });

                $(".gdwft-editor-settings-hex").minicolors({
                    opacity: true, 
                    change: function(hex, opacity) {
                        $(this).parent().next().val(opacity);
                        $(this).attr("title", $(this).minicolors("rgbaString"));

                        gdwft_editor.editor.preview();
                    }
                });
            },
            controls: function() {
                $(".gdwft-rule-delete, .gdwft-rule-reset").click(function(e){
                    e.preventDefault();

                    var url = $(this).attr("href");
                    gdwft_editor.dialogs.are_you_sure(url);
                });
            },
            selector: function() {
                $(document).on("click", ".gdwft-rule-edit", function(e){
                    e.preventDefault();

                    var id = $(this).attr("href").substring(1);
                    gdwft_editor.rules.load_selector(id, gdwft_editor.tmp.rules[id]);
                });

                $("#gdwft-selector-editor-method").change(function(){
                    var sel = $(this).val();

                    $("#gdwft-editor-selector .gdwft-selector-method:visible").fadeOut(300, function(){
                        $("#gdwft-editor-selector .gdwft-selector-method-" + sel).fadeIn(200);
                    });
                });
            },
            switcher: function() {
                $("#gdwft-rule-editor-method").change(function(){
                    var sel = $(this).val();

                    $(".gdwft-rule-method:visible").fadeOut(300, function(){
                        $(".gdwft-rule-method-" + sel).fadeIn(200);
                    });
                });

                $("#gdwft-rule-type").change(function(){
                    var sel = $(this).val();

                    $(".gdwft-rule-box:visible:not(.gdwft-copy-rules-box)").fadeOut(300, function(){
                        $(".gdwft-rule-" + sel).fadeIn(200);
                    });
                });

                $("#gdwft-rule-editor-inline, #gdwft-rule-editor-block").alphanumeric();
                $("#gdwft-rule-editor-class").alphanumeric({ allow: "-_" });
            },
            load_styler: function(id, selector) {
                gdwft_editor.tmp.current_id = id;

                $("#gdwft-editor-block input, #gdwft-editor-block select").off("change.swcpreview");
                $("#gdwft-editor-id").val(id);

                gdwft_editor.editor.load.reset();
                gdwft_editor.editor.load.activity(selector.activity);

                gdwft_editor.editor.load.font(selector.font);
                gdwft_editor.editor.load.settings(selector.settings);
                gdwft_editor.editor.load.box(selector.box);
                gdwft_editor.editor.load.custom(selector.custom);

                gdwft_editor.editor.preview();

                $(".gdwft-editor-settings-hex").each(function(){
                    $(this).attr("title", $(this).minicolors("rgbaString"));
                });

                $("#gdwft-editor-block input, #gdwft-editor-block select").on("change.swcpreview", gdwft_editor.editor.preview);

                $("#gdwft-editor-block").wpdialog("open");
            },
            load_selector: function(id, selector) {
                $("#gdwft-selector-id").val(id);
                $("#gdwft-selector-label").val(selector.label);
                $("#gdwft-selector-selector").val(selector.selector);
                $("#gdwft-editor-integrate-block, #gdwft-editor-selector-block").hide();

                $("#gdwft-editor-selector").wpdialog("open");

                if (selector.type === "editor") {
                    $("#gdwft-editor-integrate-block").show();
                    $("#gdwft-selector-editor-class").val(selector.selector.substr(1));
                    $("#gdwft-selector-editor-inline").val("span");
                    $("#gdwft-selector-editor-block").val("div");
                    $("#gdwft-selector-editor-selector").val("");

                    $("#gdwft-selector-editor-" + selector.args.method).val(selector.args.value);
                    $("#gdwft-selector-editor-method").val(selector.args.method).trigger("change");
                } else {
                    $("#gdwft-editor-selector-block").show();
                }
            },
            save_selector: function() {
                $("#gdwft-form-edit-selector").submit();
            },
            save_styler: function() {
                $("#gdwft-form-edit-styler").submit();
            }
        },
        include: {
            init: function() {
                $("#gdwft-include-font-type").change(function(){
                    var sel = $(this).val();

                    $(".gdwft-rule-box:visible").fadeOut(300, function(){
                        $(".gdwft-include-type-" + sel).fadeIn(200);
                    });
                });
            }
        },
        fonts_preview: {
            include: function(provider, name) {
                var listed = $.inArray(name, gdwft_editor.tmp.included[provider]) > -1;

                gdwft_editor.tmp.font.provider = provider;
                gdwft_editor.tmp.font.name = name;

                if (listed) {
                    $(".gdwft-include-status-in").show();
                    $(".gdwft-include-status-not-in").hide();
                    $(".gdwft-include-add").hide();
                    $(".gdwft-include-remove").show();
                } else {
                    $(".gdwft-include-status-in").hide();
                    $(".gdwft-include-status-not-in").show();
                    $(".gdwft-include-add").show();
                    $(".gdwft-include-remove").hide();
                }
            },
            init: function() {
                $(".gdwft-include-add, .gdwft-include-remove").click(function(e){
                    e.preventDefault();

                    var operation = $(this).hasClass("gdwft-include-remove") ? "remove" : "add";

                    if (operation === "add") {
                        gdwft_editor.tmp.included[gdwft_editor.tmp.font.provider].push(gdwft_editor.tmp.font.name);
                    } else {
                        gdwft_editor.tmp.included[gdwft_editor.tmp.font.provider].remove(gdwft_editor.tmp.font.name);
                    }

                    $.ajax({
                        data: { 
                            include: operation, 
                            provider: gdwft_editor.tmp.font.provider, 
                            font: gdwft_editor.tmp.font.name 
                        },
                        dataType: "html", 
                        type: "post", 
                        url: ajaxurl + '?action=gdwft_preview_include&_ajax_nonce=' + gdwft_data.nonce
                    });

                    gdwft_editor.fonts_preview.include(gdwft_editor.tmp.font.provider, gdwft_editor.tmp.font.name);
                });

                $(".gdwft-preview-ctrl-background").minicolors({
                    position: "bottom",
                    change: function(hex, opacity) {
                        $(".gdwft-preview-panel-preview").css("backgroundColor", hex);
                    }
                });

                $(".gdwft-preview-ctrl-color").minicolors({
                    position: "bottom",
                    change: function(hex, opacity) {
                        $(".gdwft-preview-panel-preview p").css("color", hex);
                    }
                });

                $("#gdwft-font-type").change(function(){
                    var sel = $(this).val();

                    $(".gdwft-rule-box:visible").fadeOut(300, function(){
                        $(".gdwft-font-type-" + sel).fadeIn(200);
                    });
                });

                $(".gdwft-preview-panel-preview p").html($("#gdwft-preview-ctrl-text").val());

                $("#gdwft-font-google").change(function() {
                    var font = $(this).val(), i, active = "", extras = [], extra = "";

                    gdwft_editor.fonts_preview.include("google", font);
                    gdwft_editor.fonts.load.google(font);

                    if (gdwft_editor.tmp.versions.google[font]) {
                        extras.push(gdwft_editor.tmp.versions.google[font]);
                    }

                    if (gdwft_editor.tmp.modified.google[font]) {
                        extras.push(gdwft_editor.tmp.modified.google[font]);
                    }

                    if (extras.length > 0) {
                        extra = "(" + extras.join(", ") + ")";
                    }

                    $(".gdwft-preview-font-category").hide();

                    if (gdwft_editor.tmp.categories.google[font]) {
                        $(".gdwft-preview-font-category").show();
                        $(".gdwft-preview-font-category span").html(gdwft_editor.tmp.categories.google[font]);
                    }

                    $(".gdwft-preview-panel-preview p").css("fontFamily", "'" + font + "'");
                    $(".gdwft-preview-font-extra").html(extra);
                    $(".gdwft-preview-font-type").html("Google Web Font");
                    $(".gdwft-preview-font-name").html($("#gdwft-font-google option:selected").text());
                    $(".gdwft-preview-font-family").html('"' + font + '"');
                    $(".gdwft-preview-usage-example-name").html(font);

                    $(".gdwft-variant-normal, .gdwft-variant-italic, .gdwft-variant-oblique").hide();

                    for (i = 0; i < gdwft_editor.tmp.preview.google[font].normal.length; i++) {
                        $(".gdwft-variant-normal-" + gdwft_editor.tmp.preview.google[font].normal[i]).show();

                        if (active === "") {
                            active = ".gdwft-variant-normal-" + gdwft_editor.tmp.preview.google[font].normal[i];
                        }
                    }

                    for (i = 0; i < gdwft_editor.tmp.preview.google[font].italic.length; i++) {
                        $(".gdwft-variant-italic-" + gdwft_editor.tmp.preview.google[font].italic[i]).show();

                        if (active === "") {
                            active = ".gdwft-variant-italic-" + gdwft_editor.tmp.preview.google[font].italic[i];
                        }
                    }

                    for (i = 0; i < gdwft_editor.tmp.preview.google[font].oblique.length; i++) {
                        $(".gdwft-variant-oblique-" + gdwft_editor.tmp.preview.google[font].oblique[i]).show();

                        if (active === "") {
                            active = ".gdwft-variant-oblique-" + gdwft_editor.tmp.preview.google[font].oblique[i];
                        }
                    }

                    $(active).trigger("click");
                });

                $("#gdwft-font-adobe").change(function() {
                    var font = $(this).val(), i, active = "";

                    gdwft_editor.fonts_preview.include("adobe", font);
                    gdwft_editor.fonts.load.adobe(font);

                    $(".gdwft-preview-font-category").hide();

                    $(".gdwft-preview-panel-preview p").css("fontFamily", "'" + font + "'");
                    $(".gdwft-preview-font-extra").html("");
                    $(".gdwft-preview-font-type").html("Adobe Web Font");
                    $(".gdwft-preview-font-name").html($("#gdwft-font-adobe option:selected").text());
                    $(".gdwft-preview-font-family").html('"' + font + '"');
                    $(".gdwft-preview-usage-example-name").html(font);

                    $(".gdwft-variant-normal, .gdwft-variant-italic, .gdwft-variant-oblique").hide();

                    for (i = 0; i < gdwft_editor.tmp.preview.adobe[font].normal.length; i++) {
                        $(".gdwft-variant-normal-" + gdwft_editor.tmp.preview.adobe[font].normal[i]).show();

                        if (active === "") {
                            active = ".gdwft-variant-normal-" + gdwft_editor.tmp.preview.adobe[font].normal[i];
                        }
                    }

                    for (i = 0; i < gdwft_editor.tmp.preview.adobe[font].italic.length; i++) {
                        $(".gdwft-variant-italic-" + gdwft_editor.tmp.preview.adobe[font].italic[i]).show();

                        if (active === "") {
                            active = ".gdwft-variant-italic-" + gdwft_editor.tmp.preview.adobe[font].italic[i];
                        }
                    }

                    for (i = 0; i < gdwft_editor.tmp.preview.adobe[font].oblique.length; i++) {
                        $(".gdwft-variant-oblique-" + gdwft_editor.tmp.preview.adobe[font].oblique[i]).show();

                        if (active === "") {
                            active = ".gdwft-variant-oblique-" + gdwft_editor.tmp.preview.adobe[font].oblique[i];
                        }
                    }

                    $(active).trigger("click");
                });

                $(document).on("click", ".gdwft-preview-font-variant a", function(e){
                    e.preventDefault();

                    $(".gdwft-preview-font-variant a").removeClass("gdwft-variant-active");
                    $(this).addClass("gdwft-variant-active");

                    var weight = $(this).attr("href").substr(1),
                        style = $(this).hasClass("gdwft-variant-normal") ? "normal" : ($(this).hasClass("gdwft-variant-italic") ? "italic" : "oblique");

                    $(".gdwft-preview-panel-preview p").css("fontWeight", weight);
                    $(".gdwft-preview-panel-preview p").css("fontStyle", style);

                    $(".gdwft-preview-usage-example-weight").html(weight);
                    $(".gdwft-preview-usage-example-style").html(style);
                });

                $(document).on("change keypress keyup keydown", "#gdwft-preview-ctrl-text", function(){
                    $(".gdwft-preview-panel-preview p").html($("#gdwft-preview-ctrl-text").val());
                });

                $("#gdwft-font-google").trigger("change");
            }
        },
        preview: {
            list: function(data, get, prefix, suffix, ident) {
                var style = '', i, item, key, def, single;

                if (data === false) {
                    data = gdwft_editor.tmp.rules[gdwft_editor.tmp.current_id];
                }

                if (data.activity[get] === true) {
                    switch (get) {
                        case "font":
                            var font = data.font, fonts = [];

                            switch (font.type) {
                                case "generic":
                                    item = "font-family: " + font.value + gdwft_data.important_font + "; ";
                                    break;
                                case "stack":
                                    item = "font-family: " + $("#gdwft-editor-block-font-stack option[value=" + font.value + "]").text() + gdwft_data.important_font + "; ";
                                    break;
                                case "google":
                                case "adobe":
                                    item = 'font-family: "' + font.value + '"' + gdwft_data.important_font + '; ';
                                    break;
                                default:
                                    item = "";
                            }

                            switch (font.type) {
                                case "google":
                                    gdwft_editor.fonts.load.google(font.value);
                                    break;
                                case "adobe":
                                    gdwft_editor.fonts.load.adobe(font.value);
                                    break;
                            }

                            if (item !== "") {
                                if (prefix) {
                                    item = prefix + item;
                                }

                                if (suffix) {
                                    item = item + suffix;
                                }

                                fonts.push(item);
                            }

                            for (i = 0; i < gdwft_editor.data.font.length; i++) {
                                key = gdwft_editor.data.font[i];
                                def = gdwft_editor.data.settings[key];

                                if (data.settings.hasOwnProperty(key)) {
                                    single = gdwft_editor.preview.single(key, data.settings[key], data.settings, prefix, suffix);

                                    if (single !== "") {
                                        fonts.push(single);
                                    }
                                }
                            }

                            if (fonts.length > 0) {
                                style+= fonts.join("");
                            }
                            break;
                        case "settings":
                            var settings = [];

                            $.each(data.settings, function(key, value){
                                if ($.inArray(key, gdwft_editor.data.font) === -1) {
                                    settings.push(gdwft_editor.preview.single(key, value, data.settings, prefix, suffix));
                                }
                            });

                            if (settings.length > 0) {
                                style+= settings.join("");
                            }
                            break;
                        case "box":
                            var settings = [], done = [];

                            $.each(data.box, function(key, value) {
                                var realKey = key, realValue = value;

                                if (gdwft_editor.data.parents.hasOwnProperty(key)) {
                                    realKey = gdwft_editor.data.parents[key][0];
                                    realValue = data.box[realKey];
                                }

                                if ($.inArray(realKey, done) === -1) {
                                    settings.push(gdwft_editor.preview.single(realKey, realValue, data.box, prefix, suffix));

                                    if (realKey === "box-sizing") {
                                        settings.push(gdwft_editor.preview.single("-moz-" + realKey, realValue, data.box, prefix, suffix));
                                        settings.push(gdwft_editor.preview.single("-webkit-" + realKey, realValue, data.box, prefix, suffix));
                                    }

                                    done.push(realKey);
                                }
                            });

                            if (settings.length > 0) {
                                style+= settings.join("");
                            }
                            break;
                        case "custom":
                            var custom = [];

                            if (typeof data.custom === "string") {
                                custom.push(data.custom);
                            } else {
                                for (i = 0; i < data.custom.length; i++) {
                                    item = data.custom[i] + "; ";

                                    if (prefix) {
                                        item = prefix + item;
                                    }

                                    if (suffix) {
                                        item = item + suffix;
                                    }

                                    custom.push(item);
                                }
                            }

                            if (custom.length > 0) {
                                style+= custom.join("");
                            }
                            break;
                    }
                }

                return style;
            },
            single: function(key, value, data, prefix, suffix) {
                var i, j, z, tmp, as = "", style = "", pairs = {}, alls = {}, presuf = true;

                if (value.select.substr(0, 5) === "value") {
                    if (value.select === "value") {
                        if (key === "color" || key === "background") {
                            style = key + ": " + gdwft_editor.hex2rgba(value.hex, value.opacity) + gdwft_data.important_settings + "; ";
                        } else if (value.hasOwnProperty("hex")) {
                            style = key + ": " + value.custom + value.unit + " " + value.style + " " + gdwft_editor.hex2rgba(value.hex, value.opacity) + gdwft_data.important_settings + "; ";
                        } else {
                            style = key + ": " + value.custom + value.unit + gdwft_data.important_settings + "; ";
                        }
                    } else if (value.select === "value_pair") {
                        for (i = 0; i < gdwft_editor.data.map[key][value.select].length; i++) {
                            tmp = gdwft_editor.data.map[key][value.select][i];
                            pairs[tmp] = data[tmp];
                        }

                        if (value.hasOwnProperty("hex")) {
                            presuf = false;

                            $.each(pairs, function(x, y){
                                z = gdwft_editor.data.pairs[x];

                                for (j = 0; j < 2; j++) {
                                    as = z[j] + ": " +  + y.custom + y.unit + " " + y.style + " " + gdwft_editor.hex2rgba(y.hex, y.opacity) + gdwft_data.important_settings + "; ";

                                    if (prefix) {
                                        as = prefix + as;
                                    }

                                    if (suffix) {
                                        as = as + suffix;
                                    }

                                    style+= as;
                                }
                            });
                        } else {
                            style = key + ": ";

                            $.each(pairs, function(x, y){
                                style+= y.custom + y.unit + " ";
                            });

                            style = style.trim() + "; ";
                        }
                    } else if (value.select === "value_all") {
                        for (i = 0; i < gdwft_editor.data.map[key][value.select].length; i++) {
                            tmp = gdwft_editor.data.map[key][value.select][i];
                            alls[tmp] = data[tmp];
                        }

                        if (value.hasOwnProperty("hex")) {
                            presuf = false;

                            $.each(alls, function(x, y){
                                as = x + ": " + y.custom + y.unit + " " + y.style + " " + gdwft_editor.hex2rgba(y.hex, y.opacity) + gdwft_data.important_settings + "; ";

                                if (prefix) {
                                    as = prefix + as;
                                }

                                if (suffix) {
                                    as = as + suffix;
                                }

                                style+= as;
                            });
                        } else {
                            style = key + ": ";

                            $.each(alls, function(x, y){
                                style+= y.custom + y.unit + " ";
                            });

                            style = style.trim() + "; ";
                        }
                    }
                } else if (value.select !== "") {
                    style = key + ": " + value.select + gdwft_data.important_settings + "; ";
                }

                if (presuf && style !== "") {
                    if (prefix) {
                        style = prefix + style;
                    }

                    if (suffix) {
                        style = style + suffix;
                    }
                }

                return style;
            },
            full: function() {
                $(document).on("change keypress keyup keydown", ".gdwft-preview-full-text", function(){
                    var preview = $(this).val();

                    $(this).closest(".ui-dialog-content").find("#gdwft-preview-full-box p").html(preview);

                    $.cookie("gdwft_preview_text", preview, {expires: 365, path: "/"});
                });

                $(document).on("click", ".gdwft-rule-preview", function(e) {
                    e.preventDefault();

                    var style = '', id = $(this).attr("href").substring(1);
                    gdwft_editor.tmp.current_id = id;
                    $("#gdwft-preview-full").wpdialog("open");

                    style+= gdwft_editor.preview.list(gdwft_editor.tmp.rules[id], "font");
                    style+= gdwft_editor.preview.list(gdwft_editor.tmp.rules[id], "settings");
                    style+= gdwft_editor.preview.list(gdwft_editor.tmp.rules[id], "box");
                    style+= gdwft_editor.preview.list(gdwft_editor.tmp.rules[id], "custom");

                    $("#gdwft-preview-full p").removeAttr("style");
                    $("#gdwft-preview-full p").attr("style", style);
                });
            },
            css: function() {
                $(document).on("click", ".gdwft-rule-css", function(e) {
                    e.preventDefault();

                    var style = '', id = $(this).attr("href").substring(1);
                    gdwft_editor.tmp.current_id = id;
                    $("#gdwft-preview-css").wpdialog("open");

                    style = gdwft_editor.tmp.rules[id].selector + " {<br/>";

                    style+= gdwft_editor.preview.list(gdwft_editor.tmp.rules[id], "font", "&nbsp;&nbsp;&nbsp;&nbsp;", "<br/>");
                    style+= gdwft_editor.preview.list(gdwft_editor.tmp.rules[id], "settings", "&nbsp;&nbsp;&nbsp;&nbsp;", "<br/>");
                    style+= gdwft_editor.preview.list(gdwft_editor.tmp.rules[id], "box", "&nbsp;&nbsp;&nbsp;&nbsp;", "<br/>");
                    style+= gdwft_editor.preview.list(gdwft_editor.tmp.rules[id], "custom", "&nbsp;&nbsp;&nbsp;&nbsp;", "<br/>");

                    style+= "}";

                    $("#gdwft-css-block").html(style);
                });
            }
        },
        fonts: {
            init: function(fonts) {
                var i;

                for (i = 0; i < fonts.google.length; i++) {
                    gdwft_editor.fonts.load.google(fonts.google[i]);
                }

                for (i = 0; i < fonts.adobe.length; i++) {
                    gdwft_editor.fonts.load.adobe(fonts.adobe[i]);
                }
            },
            load: {
                google: function(name) {
                    if ($.inArray(name, gdwft_editor.tmp.fonts.google) < 0) {
                        var link = $("<link>"), url = gdwft_data.url_prefix + "fonts.googleapis.com/css?family=" + encodeURI(name);

                        if (gdwft_editor.tmp.variants.google[name]) {
                            url+= ":" + gdwft_editor.tmp.variants.google[name];
                        }

                        link.attr({
                            type: "text/css", 
                            rel: "stylesheet",
                            href: url
                        });
                        $("head").append(link);

                        gdwft_editor.tmp.fonts.google.push(name);
                    }
                },
                adobe: function(name) {
                    if ($.inArray(name, gdwft_editor.tmp.fonts.adobe) < 0) {
                        var url = gdwft_data.url_prefix + "use.edgefonts.net/" + name;

                        if (gdwft_editor.tmp.variants.adobe[name]) {
                            url+= ":" + gdwft_editor.tmp.variants.adobe[name];
                        }

                        $.getScript(url + ".js");

                        gdwft_editor.tmp.fonts.adobe.push(name);
                    }
                }
            }
        },
        confirm: function() {
            return confirm(gdwft_data.dialog_title_areyousure);
        },
        export: function() {
            $("#gdwft-tool-export").click(function(e){
                e.preventDefault();

                window.location = $("#gdwfttools-export-url").val();
            });
        },
        init: {
            numeric: function() {
                $(".gdwft-numeric-input").numeric({decimal: '.', negative: true});
                $(".gdwft-positive-input").numeric({decimal: '.', negative: false});
            }
        }
    };

    $(document).ready(function() {
        gdwft_editor.init.numeric();
        gdwft_editor.dialogs.init();
    });
})(jQuery, window, document);