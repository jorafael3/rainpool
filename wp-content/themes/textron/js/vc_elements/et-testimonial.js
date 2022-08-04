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

    function iframeSCRIPT(element){
        $(element).each(function(){

           var $this  = $(this);

           $this.parent().addClass('tns-item');

           if ($this.parents('.et-testimonial-container').data('columns') == 1) {

                var tl = new gsap.timeline({paused: true});

                tl.from($this,{
                    duration: 0.4,
                    opacity:0,
                },'+=0.2');

                tl.from($this.find('.author-wrapper *'),{
                    duration: 0.8,
                    opacity:0,
                    x:48,
                    stagger: 0.05,
                    ease:"expo.out"
                },'-=0.2');

                tl.progress(0);
                tl.play();

           }

        });
    }

    /* Ajax complete
    /*-------------*/

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
                        return dataObj[key] === "et_testimonial";
                    });

                /* Edit element
                /*-------------*/

                    if(dataObj['action'] == "vc_edit_form" && dataObj['tag'] == "et_testimonial"){

                        var edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_testimonial"]');

                        var element_id   = edit_element.find('input[name="element_id"]');

                        $('#vc_ui-panel-edit-element[data-vc-shortcode="et_testimonial"] .vc_ui-button-action[data-vc-ui-element="button-save"]').on('click',function(){

                            if ($('#vc_ui-panel-edit-element[data-vc-shortcode="et_testimonial"]').length) {

                                var ID  = uniqueID();

                                edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_testimonial"]');

                                element_id.val(ID);
                               
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
                                var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"] .et-testimonial');
                                if (typeof(element) != 'undefined' && element != null) {
                                    iframeSCRIPT(element);
                                }
                            });
                        }
                        return;
                    }

                    

        });

})(jQuery);