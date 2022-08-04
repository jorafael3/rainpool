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

    function iframeSCRIPT(element,doc){
        $(element).each(function(){

            var $this = $(this),
                animation = $this.data('animation'),
                stagger   = $this.data('content-animation');

                if (animation != "none") {

                    $this.find('.et-icon-box').each(function(){

                        var box     = $(this),
                            delay   = (0.2 + box.parent().index()*0.05);

                        var tl = new gsap.timeline({paused: true});

                        switch(animation){
                            case 'fade':
                                tl.from(box,{
                                    duration:0.4,
                                    delay:delay,
                                    opacity:0,
                                });
                            break;
                            case 'appear':
                                tl.from(box,{
                                    duration:0.8,
                                    delay:delay,
                                    opacity:0,
                                    y:40,
                                    ease:"expo.out"
                                });
                            break;
                        }

                        tl.progress(0);
                        tl.play();

                    });

                }
        
        });
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
                return dataObj[key] === "et_icon_box_container";
            });

        /* Edit element
        /*-------------*/

            if(dataObj['action'] == "vc_edit_form" && dataObj['tag'] == "et_icon_box_container"){

                var edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_icon_box_container"]'),
                    element_css  = edit_element.find('textarea[name="element_css"]'),
                    element_id   = edit_element.find('input[name="element_id"]');

                $('#vc_ui-panel-edit-element[data-vc-shortcode="et_icon_box_container"] .vc_ui-button-action[data-vc-ui-element="button-save"]').on('click',function(){

                    if ($('#vc_ui-panel-edit-element[data-vc-shortcode="et_icon_box_container"]').length) {

                        var ID  = uniqueID();
                        var CSS = '';

                        edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_icon_box_container"]');

                        /* Styling
                        ---------------*/

                            var height        = edit_element.find('select[name="height"] option:selected').val(),
                                custom_height = edit_element.find('input[name="custom_height"]').val();

                            CSS += '#et-icon-box-container-'+ID+' {';
                                if (height.length) {
                                    if (height == 'custom' && custom_height.length) {height = custom_height;}
                                    CSS += 'min-height:'+height+' !important;';
                                }
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
                        var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"] .et-icon-box-container');
                        if (typeof(element) != 'undefined' && element != null) {
                            iframeSCRIPT(element,doc);
                        }
                    });
                }
                return;
            }
    });

})(jQuery);