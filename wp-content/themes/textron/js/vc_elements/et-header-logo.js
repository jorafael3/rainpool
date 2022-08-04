(function($){

    "use strict";

    function uniqueID() {return Math.floor((Math.random() * 1000000) + 1);}

    String.prototype.replaceAll = function(str1, str2, ignore) {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
    }

    function iframeCSS(CSS){
        var iframe = $('#vc_inline-frame');
        if (typeof(iframe) != 'undefined' && iframe != null){
            iframe.ready(function() {
                CSS = CSS.replaceAll("dir-child*",">");
                iframe.contents().find("#dynamic-styles-inline-css").append(CSS);
            });
        }
    }

    function hbeAlign(element,doc){
        var CSS = '';

        if (element.hasClass('hbe-right')) {
            CSS = '.vc_element[data-model-id="'+element.parent().attr('data-model-id')+'"] {float:right;}';
            doc.find("#dynamic-styles-inline-css").append(CSS);
            return;
        }
        if (element.hasClass('hbe-left')) {
            CSS = '.vc_element[data-model-id="'+element.parent().attr('data-model-id')+'"] {float:left;}';
            doc.find("#dynamic-styles-inline-css").append(CSS);
            return;
        }
        if (element.hasClass('hbe-center') || element.hasClass('hbe-none')) {
            CSS = '.vc_element[data-model-id="'+element.parent().attr('data-model-id')+'"] {float:none;}';
            doc.find("#dynamic-styles-inline-css").append(CSS);
            return;
        }
    }


    $( document ).ajaxComplete(function( event, xhr, settings ) {

        if (settings['type'] != 'POST') {return;}

        /* Prepare settings
        /*-------------*/

            var data = decodeURIComponent(settings['data']);

            data = data.split("&");

            var dataObj = [{}];

            for (var i = 0; i < data.length; i++) {
                var property = data[i].split("=");
                var key      = (property[0]);
                var value    = (property[1]);
                dataObj[key] = value;
            }

            var elementExists = Object.keys(dataObj).some(function(key) {
                return dataObj[key] === "et_header_logo";
            });

        /* Edit element
        /*-------------*/

            if(dataObj['action'] == "vc_edit_form" && dataObj['tag'] == "et_header_logo"){

                var edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_header_logo"]');

                var element_css  = edit_element.find('textarea[name="element_css"]'),
                    element_id   = edit_element.find('input[name="element_id"]'),
                    margin_box   = edit_element.find(".margin-box"),
                    margin       = edit_element.find('input[name="margin"]'),
                    margin_val   = margin.val(),
                    margin_array = [];

                if(typeof(margin_val) != "undefined" && margin_val.length){

                    var margin_array = margin_val.split(",");

                    margin_box.find("input[name=\"margin-top\"]").attr('value',margin_array[0]);
                    margin_box.find("input[name=\"margin-right\"]").attr('value',margin_array[1]);
                    margin_box.find("input[name=\"margin-bottom\"]").attr('value',margin_array[2]);
                    margin_box.find("input[name=\"margin-left\"]").attr('value',margin_array[3]);

                }

                $('#vc_ui-panel-edit-element[data-vc-shortcode="et_header_logo"] .vc_ui-button-action[data-vc-ui-element="button-save"]').on('click',function(){

                    if ($('#vc_ui-panel-edit-element[data-vc-shortcode="et_header_logo"]').length) {

                        var CSS = '';
                        var ID  = uniqueID();

                        edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_header_logo"]');

                        /* Styling
                        ---------------*/

                            var align        = edit_element.find('select[name="align"] option:selected').val(),
                                logo         = edit_element.find("input[name=\"logo\"]").val(),
                                width        = edit_element.find("input[name=\"width\"]").val(),
                                sticky_width = edit_element.find("input[name=\"sticky_width\"]").val();

                            if(logo.length){

                                var logo_preview = edit_element.find("img[rel=\""+logo+"\"]").attr("src");

                                if (!logo_preview.includes('svg')) {

                                    logo = logo_preview;

                                    if (typeof(logo) != 'undefined' && logo != null){
                                        logo.replace("-425x425", "").replace("-150x150", "");

                                        var logo_img = new Image();

                                        logo_img.src = logo;

                                        var logo_width = logo_img.width;
                                        var logo_height = logo_img.height;

                                        CSS += '#header-logo-'+ID+' .logo {max-height:'+logo_height+'px;}';

                                    }
                                }

                                if(width.length){
                                    CSS += '#header-logo-'+ID+' .logo {width:'+width+'px;}';
                                }

                            }

                            var sticky_logo = edit_element.find("input[name=\"sticky_logo\"]").val();
                            if(sticky_logo.length){

                                var sticky_logo_preview = edit_element.find("img[rel=\""+sticky_logo+"\"]").attr("src");

                                if (!sticky_logo_preview.includes('svg')) {
                                    sticky_logo = sticky_logo_preview;
                                    if (typeof(sticky_logo) != 'undefined' && sticky_logo != null){
                                        sticky_logo.replace("-150x150", "");

                                        var sticky_logo_img = new Image();

                                        sticky_logo_img.src = sticky_logo;

                                        var sticky_logo_width = sticky_logo_img.width;
                                        var sticky_logo_height = sticky_logo_img.height;

                                        CSS += '#header-logo-'+ID+' .sticky-logo {max-height:'+sticky_logo_height+'px;}';
                                    }
                                }

                                if(sticky_width.length){
                                    CSS += '#header-logo-'+ID+' .sticky-logo {width:'+sticky_width+'px;}';
                                }

                            }

                        /* Margin
                        ---------------*/

                            var margin_left   = edit_element.find(".margin-box input[name=\"margin-left\"]").val(),
                                margin_top    = edit_element.find(".margin-box input[name=\"margin-top\"]").val(),
                                margin_right  = edit_element.find(".margin-box input[name=\"margin-right\"]").val(),
                                margin_bottom = edit_element.find(".margin-box input[name=\"margin-bottom\"]").val();

                            margin_top = (margin_top.length) ? margin_top : '0';
                            margin_right = (margin_right.length) ? margin_right : '0';
                            margin_bottom = (margin_bottom.length) ? margin_bottom : '0';
                            margin_left = (margin_left.length) ? margin_left : '0';

                            var margin_output = margin_top+','+margin_right+','+margin_bottom+','+margin_left,
                                margin_value  = margin_top+'px '+margin_right+'px '+margin_bottom+'px '+margin_left+'px';

                            margin.val(margin_output);

                            CSS += '#header-logo-'+ID+' {';
                                CSS += 'margin:'+margin_value+';';
                            CSS += '}';

                        element_id.val(ID);

                        if (CSS) {
                            element_css.text(CSS);
                            iframeCSS(CSS);
                            CSS = '';
                        }

                    }

                });

                return;

            }


        /* Load element
        /*-------------*/

            if((dataObj['action'] == "vc_load_shortcode" && elementExists)){

                var iframe = $('#vc_inline-frame');
                if (typeof(iframe) != 'undefined' && iframe != null){
                    iframe.ready(function() {
                        var doc = iframe.contents();
                        var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"] .header-logo');
                        if (typeof(element) != 'undefined' && element != null) {
                            hbeAlign(element,doc);
                        }
                    });
                }
                return;
            }
    });

})(jQuery);
