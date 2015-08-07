/* jQuery Alphanumeric
 * 
 * https://github.com/johnantoni/jquery.alphanumeric
*/
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(3($){$.k.q=3(p){7 b=$(h),g="D",2=$.m({f:\'!@#$%^&*()+=[]\\\\\\\';,/{}|":<>?~`.- z\',4:\'\',6:\'\'},p),s=2.6.A(\'\'),i=0,8,d;r(i;i<s.l;i++){5(2.f.c(s[i])!==-1){s[i]=\'\\\\\'+s[i]}}5(2.P){2.4+=g.J()}5(2.K){2.4+=g}2.6=s.L(\'|\');d=u v(2.6,\'w\');8=(2.f+2.4).x(d,\'\');b.y(3(e){7 a=B.C(!e.n?e.E:e.n);5(8.c(a)!==-1&&!e.F){e.G()}});b.H(3(){7 a=b.o(),j=0;r(j;j<a.l;j++){5(8.c(a[j])!==-1){b.o(\'\');9 t}}9 t});9 b};$.k.M=3(p){7 a=\'N\';9 h.O(3(){$(h).q($.m({4:a},p))})}})(I);',52,52,'||options|function|nchars|if|allow|var|ch|return|||indexOf|regex||ichars|az|this|||fn|length|extend|charCode|val||alphanumeric|for||false|new|RegExp|gi|replace|keypress|_|split|String|fromCharCode|abcdefghijklmnopqrstuvwxyz|which|ctrlKey|preventDefault|blur|jQuery|toUpperCase|allcaps|join|alpha|1234567890|each|nocaps'.split('|'),0,{}));

/* jQuery Numeric
 * 
 * Copyright (c) 2006-2014 Sam Collett (http://www.texotela.co.uk)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version 1.4.1
 * Demo: http://www.texotela.co.uk/code/jquery/numeric/
 */
(function($){$.fn.numeric=function(config,callback){if(typeof config==="boolean"){config={decimal:config,negative:true,decimalPlaces:-1}}config=config||{};if(typeof config.negative=="undefined"){config.negative=true}var decimal=config.decimal===false?"":config.decimal||".";var negative=config.negative===true?true:false;var decimalPlaces=typeof config.decimalPlaces=="undefined"?-1:config.decimalPlaces;callback=typeof callback=="function"?callback:function(){};return this.data("numeric.decimal",decimal).data("numeric.negative",negative).data("numeric.callback",callback).data("numeric.decimalPlaces",decimalPlaces).keypress($.fn.numeric.keypress).keyup($.fn.numeric.keyup).blur($.fn.numeric.blur)};$.fn.numeric.keypress=function(e){var decimal=$.data(this,"numeric.decimal");var negative=$.data(this,"numeric.negative");var decimalPlaces=$.data(this,"numeric.decimalPlaces");var key=e.charCode?e.charCode:e.keyCode?e.keyCode:0;if(key==13&&this.nodeName.toLowerCase()=="input"){return true}else if(key==13){return false}var allow=false;if(e.ctrlKey&&key==97||e.ctrlKey&&key==65){return true}if(e.ctrlKey&&key==120||e.ctrlKey&&key==88){return true}if(e.ctrlKey&&key==99||e.ctrlKey&&key==67){return true}if(e.ctrlKey&&key==122||e.ctrlKey&&key==90){return true}if(e.ctrlKey&&key==118||e.ctrlKey&&key==86||e.shiftKey&&key==45){return true}if(key<48||key>57){var value=$(this).val();if($.inArray("-",value.split(""))!==0&&negative&&key==45&&(value.length===0||parseInt($.fn.getSelectionStart(this),10)===0)){return true}if(decimal&&key==decimal.charCodeAt(0)&&$.inArray(decimal,value.split(""))!=-1){allow=false}if(key!=8&&key!=9&&key!=13&&key!=35&&key!=36&&key!=37&&key!=39&&key!=46){allow=false}else{if(typeof e.charCode!="undefined"){if(e.keyCode==e.which&&e.which!==0){allow=true;if(e.which==46){allow=false}}else if(e.keyCode!==0&&e.charCode===0&&e.which===0){allow=true}}}if(decimal&&key==decimal.charCodeAt(0)){if($.inArray(decimal,value.split(""))==-1){allow=true}else{allow=false}}}else{allow=true;if(decimal&&decimalPlaces>0){var dot=$.inArray(decimal,$(this).val().split(""));if(dot>=0&&$(this).val().length>dot+decimalPlaces){allow=false}}}return allow};$.fn.numeric.keyup=function(e){var val=$(this).val();if(val&&val.length>0){var carat=$.fn.getSelectionStart(this);var selectionEnd=$.fn.getSelectionEnd(this);var decimal=$.data(this,"numeric.decimal");var negative=$.data(this,"numeric.negative");var decimalPlaces=$.data(this,"numeric.decimalPlaces");if(decimal!==""&&decimal!==null){var dot=$.inArray(decimal,val.split(""));if(dot===0){this.value="0"+val;carat++;selectionEnd++}if(dot==1&&val.charAt(0)=="-"){this.value="-0"+val.substring(1);carat++;selectionEnd++}val=this.value}var validChars=[0,1,2,3,4,5,6,7,8,9,"-",decimal];var length=val.length;for(var i=length-1;i>=0;i--){var ch=val.charAt(i);if(i!==0&&ch=="-"){val=val.substring(0,i)+val.substring(i+1)}else if(i===0&&!negative&&ch=="-"){val=val.substring(1)}var validChar=false;for(var j=0;j<validChars.length;j++){if(ch==validChars[j]){validChar=true;break}}if(!validChar||ch==" "){val=val.substring(0,i)+val.substring(i+1)}}var firstDecimal=$.inArray(decimal,val.split(""));if(firstDecimal>0){for(var k=length-1;k>firstDecimal;k--){var chch=val.charAt(k);if(chch==decimal){val=val.substring(0,k)+val.substring(k+1)}}}if(decimal&&decimalPlaces>0){var dot=$.inArray(decimal,val.split(""));if(dot>=0){val=val.substring(0,dot+decimalPlaces+1);selectionEnd=Math.min(val.length,selectionEnd)}}this.value=val;$.fn.setSelection(this,[carat,selectionEnd])}};$.fn.numeric.blur=function(){var decimal=$.data(this,"numeric.decimal");var callback=$.data(this,"numeric.callback");var negative=$.data(this,"numeric.negative");var val=this.value;if(val!==""){var re=new RegExp(negative?"-?":""+"^\\d+$|^\\d*"+decimal+"\\d+$");if(!re.exec(val)){callback.apply(this)}}};$.fn.removeNumeric=function(){return this.data("numeric.decimal",null).data("numeric.negative",null).data("numeric.callback",null).data("numeric.decimalPlaces",null).unbind("keypress",$.fn.numeric.keypress).unbind("keyup",$.fn.numeric.keyup).unbind("blur",$.fn.numeric.blur)};$.fn.getSelectionStart=function(o){if(o.type==="number"){return undefined}else if(o.createTextRange&&document.selection){var r=document.selection.createRange().duplicate();r.moveEnd("character",o.value.length);if(r.text=="")return o.value.length;return Math.max(0,o.value.lastIndexOf(r.text))}else{try{return o.selectionStart}catch(e){return 0}}};$.fn.getSelectionEnd=function(o){if(o.type==="number"){return undefined}else if(o.createTextRange&&document.selection){var r=document.selection.createRange().duplicate();r.moveStart("character",-o.value.length);return r.text.length}else return o.selectionEnd};$.fn.setSelection=function(o,p){if(typeof p=="number"){p=[p,p]}if(p&&p.constructor==Array&&p.length==2){if(o.type==="number"){o.focus()}else if(o.createTextRange){var r=o.createTextRange();r.collapse(true);r.moveStart("character",p[0]);r.moveEnd("character",p[1]-p[0]);r.select()}else{o.focus();try{if(o.setSelectionRange){o.setSelectionRange(p[0],p[1])}}catch(e){}}}}})(jQuery);

/* jQuery Selectboxes
 *
 * Copyright (c) 2006-2009 Sam Collett (http://www.texotela.co.uk)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version 2.2.4
 * Demo: http://www.texotela.co.uk/code/jquery/select/
*/
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}(';(6($){$.u.N=6(){5 j=6(a,v,t,b,c){5 d=11.12("U");d.p=v,d.H=t;5 o=a.z;5 e=o.q;3(!a.A){a.A={};x(5 i=0;i<e;i++){a.A[o[i].p]=i}}3(c||c==0){5 f=d;x(5 g=c;g<=e;g++){5 h=a.z[g];a.z[g]=f;o[g]=f;a.A[o[g].p]=g;f=h}}3(9 a.A[v]=="V")a.A[v]=e;a.z[a.A[v]]=d;3(b){d.s=8}};5 a=W;3(a.q==0)7 4;5 k=8;5 m=B;5 l,v,t;3(9(a[0])=="D"){m=8;l=a[0]}3(a.q>=2){3(9(a[1])=="O"){k=a[1];E=a[2]}n 3(9(a[2])=="O"){k=a[2];E=a[1]}n{E=a[1]}3(!m){v=a[0];t=a[1]}}4.y(6(){3(4.F.C()!="G")7;3(m){x(5 a 13 l){j(4,a,l[a],k,E);E+=1}}n{j(4,v,t,k,E)}});7 4};$.u.14=6(b,c,d,e,f){3(9(b)!="J")7 4;3(9(c)!="D")c={};3(9(d)!="O")d=8;4.y(6(){5 a=4;$.15(b,c,6(r){$(a).N(r,d);3(9 e=="6"){3(9 f=="D"){e.16(a,f)}n{e.P(a)}}})});7 4};$.u.X=6(){5 a=W;3(a.q==0)7 4;5 d=9(a[0]);5 v,K;3(d=="J"||d=="D"||d=="6"){v=a[0];3(v.I==Y){5 l=v.q;x(5 i=0;i<l;i++){4.X(v[i],a[1])}7 4}}n 3(d=="17")K=a[0];n 7 4;4.y(6(){3(4.F.C()!="G")7;3(4.A)4.A=Z;5 b=B;5 o=4.z;3(!!v){5 c=o.q;x(5 i=c-1;i>=0;i--){3(v.I==Q){3(o[i].p.R(v)){b=8}}n 3(o[i].p==v){b=8}3(b&&a[1]===8)b=o[i].s;3(b){o[i]=Z}b=B}}n{3(a[1]===8){b=o[K].s}n{b=8}3(b){4.18(K)}}});7 4};$.u.19=6(f){5 g=$(4).10();5 a=9(f)=="V"?8:!!f;4.y(6(){3(4.F.C()!="G")7;5 o=4.z;5 d=o.q;5 e=[];x(5 i=0;i<d;i++){e[i]={v:o[i].p,t:o[i].H}}e.1a(6(b,c){L=b.t.C(),M=c.t.C();3(L==M)7 0;3(a){7 L<M?-1:1}n{7 L>M?-1:1}});x(5 i=0;i<d;i++){o[i].H=e[i].t;o[i].p=e[i].v}}).S(g,8);7 4};$.u.S=6(b,d){5 v=b;5 e=9(b);3(e=="D"&&v.I==Y){5 f=4;$.y(v,6(){f.S(4,d)})};5 c=d||B;3(e!="J"&&e!="6"&&e!="D")7 4;4.y(6(){3(4.F.C()!="G")7 4;5 o=4.z;5 a=o.q;x(5 i=0;i<a;i++){3(v.I==Q){3(o[i].p.R(v)){o[i].s=8}n 3(c){o[i].s=B}}n{3(o[i].p==v){o[i].s=8}n 3(c){o[i].s=B}}}});7 4};$.u.1b=6(b,c){5 w=c||"s";3($(b).1c()==0)7 4;4.y(6(){3(4.F.C()!="G")7 4;5 o=4.z;5 a=o.q;x(5 i=0;i<a;i++){3(w=="1d"||(w=="s"&&o[i].s)){$(b).N(o[i].p,o[i].H)}}});7 4};$.u.1e=6(b,c){5 d=B;5 v=b;5 e=9(v);5 f=9(c);3(e!="J"&&e!="6"&&e!="D")7 f=="6"?4:d;4.y(6(){3(4.F.C()!="G")7 4;3(d&&f!="6")7 B;5 o=4.z;5 a=o.q;x(5 i=0;i<a;i++){3(v.I==Q){3(o[i].p.R(v)){d=8;3(f=="6")c.P(o[i],i)}}n{3(o[i].p==v){d=8;3(f=="6")c.P(o[i],i)}}}});7 f=="6"?4:d};$.u.10=6(){5 v=[];4.T().y(6(){v[v.q]=4.p});7 v};$.u.1f=6(){5 t=[];4.T().y(6(){t[t.q]=4.H});7 t};$.u.T=6(){7 4.1g("U:s")}})(1h);',62,80,'|||if|this|var|function|return|true|typeof||||||||||||||else||value|length||selected||fn|||for|each|options|cache|false|toLowerCase|object|startindex|nodeName|select|text|constructor|string|index|o1t|o2t|addOption|boolean|call|RegExp|match|selectOptions|selectedOptions|option|undefined|arguments|removeOption|Array|null|selectedValues|document|createElement|in|ajaxAddOption|getJSON|apply|number|remove|sortOptions|sort|copyOptions|size|all|containsOption|selectedTexts|find|jQuery'.split('|'),0,{}));

/* Remove Value From Array */
Array.prototype.remove = function(el){
    return this.splice(this.indexOf(el),1);
};

/* Check if object has proprty */
Object.prototype.hasOwnProperty = function(property) {
    return this[property] !== undefined;
};

/*jslint regexp: true, nomen: true, undef: true, sloppy: true, eqeq: true, vars: true, white: true, plusplus: true, maxerr: 50, indent: 4 */
var d4plib_media_image, d4plib_admin;

;(function($, window, document, undefined) {
    d4plib_media_image = {
        handler: null,
        init: function() {
            if (wp && wp.media) {
                wp.media.frames.d4plib_media_image_frame = wp.media({
                    title: d4plib_admin_data.string_media_image_title,
                    className: "media-frame d4plib-mediaimage-frame",
                    frame: "post",
                    multiple: false,
                    library: { 
                        type: "image" 
                    },
                    button: {
                        text: d4plib_admin_data.string_media_image_button
                    }
                });

                wp.media.frames.d4plib_media_image_frame.on("insert", function() {
                    var image = wp.media.frames.d4plib_media_image_frame.state().get("selection").first().toJSON();

                    if (d4plib_media_image.handler) {
                        d4plib_media_image.handler(image);
                    }
                });
            }
        },
        open: function(handler, hide_menu) {
            d4plib_media_image.handler = handler;

            wp.media.frames.d4plib_media_image_frame.open();

            if (hide_menu) {
                jQuery(".d4plib-mediaimage-frame").addClass("hide-menu");
            }
        }
    };

    d4plib_admin = {
        scroll_offset: 40,
        active_element: null,
        init: function() {
            $(".d4p-nav-button > a").click(function(e){
                e.preventDefault();

                $(this).next().slideToggle("fast");
            });

            setTimeout(function(){
                $(".d4p-wrap .updated").slideUp("slow");
            }, 4000);

            $(window).bind("load resize orientationchange", function(){
                if (document.body.clientWidth < 800) {
                    d4plib_admin.scroll_offset = 60;
                } else {
                    d4plib_admin.scroll_offset = 40;
                }

                if (document.body.clientWidth < 640) {
                    $(".d4p-panel-scroller").removeClass("d4p-scroll-active");
                } else {
                    $(".d4p-panel-scroller").addClass("d4p-scroll-active");
                }
            });

            $(".d4p-check-uncheck a").click(function(e){
                e.preventDefault();

                var checkall = $(this).attr("href").substr(1) === "checkall";

                $(this).parent().parent().find("input[type=checkbox]").prop("checked", checkall);
            });
        },
        settings: function() {
            d4plib_media_image.init();

            $(".d4p-setting-number input, .d4p-field-number").numeric();
            $(".d4p-setting-integer input, .d4p-field-integer").numeric({decimalPlaces: 0, negative: false});

            $(".d4p-color-picker").wpColorPicker();

            $(document).on("click", ".d4p-section-toggle .d4p-toggle-title i.fa, .d4p-group h3 i.fa", function() {
                var closed = $(this).hasClass("fa-caret-down"),
                    content = $(this).parent().next();

                if (closed) {
                    $(this).removeClass("fa-caret-down").addClass("fa-caret-up");
                    content.slideDown(300);
                } else {
                    $(this).removeClass("fa-caret-up").addClass("fa-caret-down");
                    content.slideUp(300);
                }
            });

            $(document).on("click", ".d4plib-images-preview", function(e){
                e.preventDefault();

                $(this).parent().find("img").slideToggle(function(){
                    if ($(this).is(":visible")) {
                        $(this).css("display", "block");
                    }
                });
            });

            $(document).on("click", ".d4plib-images-remove", function(e){
                e.preventDefault();

                if (confirm(d4plib_admin_data.string_are_you_sure)) {
                    if ($(this).parent().parent().find(".d4plib-images-image").length === 1) {
                        $(this).parent().parent().find(".d4plib-images-none").show();
                    }

                    $(this).parent().remove();
                }
            });

            $(".d4plib-image-preview").click(function(e){
                e.preventDefault();

                $(this).parent().find("img").slideToggle(function(){
                    if ($(this).is(":visible")) {
                        $(this).css("display", "block");
                    }
                });
            });

            $(".d4plib-image-remove").click(function(e){
                e.preventDefault();

                if (confirm(d4plib_admin_data.string_are_you_sure)) {
                    $(this).parent().find(".d4plib-image").val("0");
                    $(this).parent().find("img").attr("src", "").hide();
                    $(this).parent().find(".d4plib-image-name").html(d4plib_admin_data.string_image_not_selected);

                    $(this).parent().find(".d4plib-image-preview, .d4plib-image-remove").hide();
                }
            });

            $(".d4plib-images-add").click(function(e){
                e.preventDefault();

                d4plib_admin.active_element = $(this).parent();
                d4plib_media_image.open(d4plib_admin.handlers.images, true);
            });

            $(".d4plib-image-add").click(function(e){
                e.preventDefault();

                d4plib_admin.active_element = $(this).parent();
                d4plib_media_image.open(d4plib_admin.handlers.image, true);
            });
        },
        handlers: {
            image: function(obj) {
                var $this = d4plib_admin.active_element;

                $(".d4plib-image", $this).val(obj.id);
                $(".d4plib-image-name", $this).html("(" + obj.id + ") " + obj.name);
                $("img", $this).attr("src", obj.url).hide();

                $(".d4plib-image-preview, .d4plib-image-remove", $this).show();
            },
            images: function(obj) {
                var $this = d4plib_admin.active_element,
                    name = $($this).find(".d4plib-selected-image").data("name");

                var div = $("<div class='d4plib-images-image'>");
                div.append("<input type='hidden' value='" + obj.id + "' name='" + name + "[]' />");
                div.append("<a class='button d4plib-button-action d4plib-images-remove'><i class='fa fa-ban'></i></a>");
                div.append("<a class='button d4plib-button-action d4plib-images-preview'><i class='fa fa-search'></i></a>");
                div.append("<span class='d4plib-image-name'>(" + obj.id + ") " + obj.name + '</span>');
                div.append("<img src='" + obj.url + "' />");

                $(".d4plib-selected-image", $this).append(div);

                $(".d4plib-images-none", $this).hide();
            }
        },
        scroller: function() {
            var $sidebar = $(".d4p-panel-scroller"), 
                $window = $(window);

            if ($sidebar.length > 0) {
                var offset = $sidebar.offset();

                $window.scroll(function() {
                    if ($window.scrollTop() > offset.top && $sidebar.hasClass("d4p-scroll-active")) {
                        $sidebar.stop().animate({
                            marginTop: $window.scrollTop() - offset.top + d4plib_admin.scroll_offset
                        });
                    } else {
                        $sidebar.stop().animate({
                            marginTop: 0
                        });
                    }
                });
            }
        }
    };

    d4plib_admin.init();
    d4plib_admin.settings();
    d4plib_admin.scroller();
})(jQuery, window, document);
