(function($){

    "use strict";

    function uniqueID() {return Math.floor((Math.random() * 1000000) + 1);}

    function isInArray(value, array) {return array.indexOf(value) > -1;}

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
            $this.find('ul').countdown({
                date: $this.data('enddate'),
                offset: -8,
                day: $this.data('days'),
                days: $this.data('days'),
                hour: $this.data('hours'),
                hours: $this.data('hours'),
                minute: $this.data('minutes'),
                minutes: $this.data('minutes'),
                second: $this.data('seconds'),
                seconds: $this.data('seconds')
            });

            var tl = new gsap.timeline({paused: true});

            tl.from($this.find('li'),{
                delay: 0.2,
                duration: 0.8,
                opacity:0,
                y:50,
                stagger:0.05,
                transformOrigin:'left top',
                force3D:true,
                ease:"expo.out"
            });
            
            tl.progress(0);
            tl.play();

        });
    }

    var font_weight_array = [];

    for (var i = 1; i <= 9; i++) {
        font_weight_array.push(i+'00italic');
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
                        return dataObj[key] === "et_timer";
                    });

                /* Edit element
                /*-------------*/

                    if(dataObj['action'] == "vc_edit_form" && dataObj['tag'] == "et_timer"){

                        var edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_timer"]');

                        var element_css  = edit_element.find('textarea[name="element_css"]'),
                            element_id   = edit_element.find('input[name="element_id"]');


                        $('#vc_ui-panel-edit-element[data-vc-shortcode="et_timer"] .vc_ui-button-action[data-vc-ui-element="button-save"]').on('click',function(){

                            if ($('#vc_ui-panel-edit-element[data-vc-shortcode="et_timer"]').length) {

                                var ID  = uniqueID();
                                var CSS = '';

                                edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_timer"]');

                                /* Styling
                                ---------------*/

                                    var text_color = edit_element.find('input[name="text_color"]').val(),
                                        value_color = edit_element.find('input[name="value_color"]').val();

                                    if (text_color.length) {
                                        CSS += '#et-timer-'+ID+' .timer-title {';
                                            CSS += 'color:'+text_color+';';
                                        CSS += '}';
                                    }

                                    if (value_color.length) {
                                        CSS += '#et-timer-'+ID+' .timer-count {';
                                            CSS += 'color:'+value_color+';';
                                        CSS += '}';
                                    }

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
                                var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"] .et-timer');
                                if (typeof(element) != 'undefined' && element != null) {
                                    iframeSCRIPT(element);
                                }
                            });
                        }
                        return;
                    }

                    

        });

})(jQuery);