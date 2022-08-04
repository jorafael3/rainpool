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
            
            var $this = $(this);


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
                        return dataObj[key] === "et_info_present_item";
                    });

                /* Edit element
                /*-------------*/

                    if(dataObj['action'] == "vc_edit_form" && dataObj['tag'] == "et_info_present_item"){

                        var edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_info_present_item"]');

                        var element_css  = edit_element.find('textarea[name="element_css"]'),
                            element_id   = edit_element.find('input[name="element_id"]');


                        $('#vc_ui-panel-edit-element[data-vc-shortcode="et_info_present_item"] .vc_ui-button-action[data-vc-ui-element="button-save"]').on('click',function(){

                            if ($('#vc_ui-panel-edit-element[data-vc-shortcode="et_info_present_item"]').length) {

                                var ID  = uniqueID();
                                var CSS = '';

                                edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_info_present_item"]');

                                var title_color = edit_element.find('input[name="title_color"]').val(),
                                    icon_color  = edit_element.find('input[name="icon_color"]').val(),
                                    box_color   = edit_element.find('input[name="box_color"]').val();

                                if (box_color.length) {
                                    CSS += '#presentation-box-'+ID+'  {';
                                        CSS += 'background:'+box_color+';';
                                    CSS += '}';
                                }

                                if (title_color.length) {
                                    CSS += '#presentation-box-'+ID+' .presentation-title {';
                                        CSS += 'color:'+title_color+';';
                                    CSS += '}';
                                }

                                if (icon_color.length) {
                                    CSS += '#presentation-box-'+ID+' .presentation-icon svg, #presentation-box-'+ID+' .presentation-icon svg * {';
                                        CSS += 'fill:'+icon_color+';';
                                    CSS += '}';
                                    CSS += '#presentation-box-'+ID+' .presentation-subtitle {';
                                        CSS += 'color:'+icon_color+';';
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

        });

})(jQuery);