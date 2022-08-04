(function($){

    "use strict";

    function uniqueID() {return Math.floor((Math.random() * 1000000) + 1);}

    function isInArray(value, array) {return array.indexOf(value) > -1;}

    String.prototype.replaceAll = function(str1, str2, ignore) {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
    }

    function animateBoxBack(box){

        var $this  = $(box),
            width  = $this.width(),
            height = $this.height(),
            ratio  = Math.round(100*(height/width)),
            svg    = $this.find('.box-back'),
            path   = svg.find('path');

        // get svg viewBox
        var viewBox = box.querySelector('.box-back').getAttribute('viewBox');

        var viewBoxValues = viewBox.split(' ');

        viewBoxValues  = viewBoxValues.splice(2, 2);

        var replace = viewBoxValues[1];

        var start    = path.attr('d'),
            startC   = path.attr('data-dclone'),
            end      = path.attr('data-end'),
            original = path.attr('data-original');

        start  = start.replace(new RegExp((replace-10),"g"),(ratio-10));
        start  = start.replace(new RegExp(replace,"g"),ratio);
        startC = startC.replace(new RegExp((replace-10),"g"),(ratio-10));
        startC = startC.replace(new RegExp(replace,"g"),ratio);
        end    = end.replace(new RegExp(replace,"g"),ratio);

        if (typeof(original) != 'undefined') {
            original = original.replace(new RegExp(replace,"g"),ratio);
        }

        box.querySelector('.box-back').setAttribute('viewBox','0 0 100 '+ratio);

        path.attr('d',start);
        path.attr('data-end',end);
        path.attr('data-dclone',startC);

        if (typeof(original) != 'undefined') {
            path.attr('data-original',original);
        }

    }

    function buildAnimateBoxTimeline(tl,box,delay,animation,stagger,content){

        var path = box.find('.box-back path');

        tl.from(box,0.2, {
          opacity:0,
        },delay);

        switch(animation){
            case 'top':

                tl.from(box,1.2, {
                    y:-100,
                    scaleY:0,
                    rotationZ:8,
                    force3D:true,
                    transformOrigin:'right top',
                    ease:"elastic.out(1, 0.5)"
                },'-=0.1');

            break;

            case 'bottom':

                tl.from(box,1.2, {
                    y:100,
                    scaleY:0,
                    rotationZ:8,
                    force3D:true,
                    transformOrigin:'right bottom',
                    ease:"elastic.out(1, 0.5)"
                },'-=0.1');
            
            break;

            case 'left':

                tl.from(box,1.2, {
                    x:-100,
                    scaleX:0,
                    rotationZ:-8,
                    force3D:true,
                    transformOrigin:'left center',
                    ease:"elastic.out(1, 0.5)"
                },'-=0.1');
            
            break;

            case 'right':

                tl.from(box,1.2, {
                    x:100,
                    scaleX:0,
                    rotationZ:8,
                    force3D:true,
                    transformOrigin:'right center',
                    ease:"elastic.out(1, 0.5)"
                },'-=0.1');
            
            break;
        }


        tl.to(path,1.2, {
          morphSVG:{shape:path.attr('data-end'), shapeIndex:8},
          ease:"elastic.out"
        },'-=1');

        switch(stagger){

            case "left":

                tl.from(content,{
                    duration: 0.8,
                    x:-50,
                    stagger: 0.05,
                    opacity:0,
                    ease:"expo.out"
                },'-=1.1');

            break;

            case "right":

                tl.from(content,{
                    duration: 0.8,
                    x:50,
                    stagger: 0.05,
                    opacity:0,
                    ease:"expo.out"
                },'-=1.1');

            break;

            case "top":

                tl.from(content,{
                    duration: 0.8,
                    y:-50,
                    stagger: 0.05,
                    opacity:0,
                    ease:"expo.out"
                },'-=1.1');

            break;

            case "bottom":

                tl.from(content,{
                    duration: 0.8,
                    y:50,
                    stagger: 0.05,
                    opacity:0,
                    ease:"expo.out"
                },'-=1.1');

            break;
        }

        tl.add('end');

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

            var element   = this,
                $this     = $(element),
                id        = $this.attr('id'),
                delay     = '+='+(0.2 + parseInt($this.data('delay'))/1000),
                animation = $this.data('animation'),
                stagger   = $this.data('stagger'),
                content   = $this.find('.content').children();

            animateBoxBack(element);

            var tl = new gsap.timeline({paused: true});

            buildAnimateBoxTimeline(tl,$this,delay,animation,stagger,content);

            tl.progress(0);
            tl.play();

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
                return dataObj[key] === "et_animate_box";
            });

        /* Edit element
        /*-------------*/

            if(dataObj['action'] == "vc_edit_form" && dataObj['tag'] == "et_animate_box"){

                var edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_animate_box"]'),
                    element_css  = edit_element.find('textarea[name="element_css"]'),
                    element_id   = edit_element.find('input[name="element_id"]'),
                    padding_box   = edit_element.find(".padding-box"),
                    padding       = edit_element.find('input[name="padding"]'),
                    padding_val   = padding.val(),
                    padding_array = [];

                var table              = edit_element.find(".column-responsive-padding"),
                    media_query        = table.find(".media-query"),
                    crp                = edit_element.find("input[name=\"crp\"]"),
                    resp_padding_array = [];    

                // Set defaults

                    var crp_val = crp.val();

                    if(typeof(crp_val) != "undefined" && crp_val.length){
                        var crp_array = crp_val.split(",");

                        media_query.each(function(index){
                            var $this = jQuery(this);
                            var defaults = crp_array[index].split(":");

                            if(defaults[0] == $this.data("query")){
                                $this.find("td.left option[value=\""+defaults[1]+"\"]").attr("selected","selected").siblings().removeAttr("selected");
                                $this.find("td.right option[value=\""+defaults[2]+"\"]").attr("selected","selected").siblings().removeAttr("selected");
                            }
                        });

                    }

                    if(typeof(padding_val) != "undefined" && padding_val.length){

                        var padding_array = padding_val.split(",");

                        padding_box.find("input[name=\"padding-top\"]").attr('value',padding_array[0]);
                        padding_box.find("input[name=\"padding-right\"]").attr('value',padding_array[1]);
                        padding_box.find("input[name=\"padding-bottom\"]").attr('value',padding_array[2]);
                        padding_box.find("input[name=\"padding-left\"]").attr('value',padding_array[3]);

                    }

                $('#vc_ui-panel-edit-element[data-vc-shortcode="et_animate_box"] .vc_ui-button-action[data-vc-ui-element="button-save"]').on('click',function(){

                    if ($('#vc_ui-panel-edit-element[data-vc-shortcode="et_animate_box"]').length) {

                        var ID  = uniqueID();
                        var CSS = '';

                        edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_animate_box"]');

                        /* Styling
                        ---------------*/

                            var color = edit_element.find('input[name="color"]').val();
                                
                            if (color.length) {
                                CSS += '.et-animate-box-'+ID+' svg.box-back {';
                                    CSS += 'fill:'+color+';';
                                CSS += '}';
                            }

                            /* Responsive padding
                            ---------------*/

                                if(crp.length){

                                    for(var i=0;i<media_query.length;i++){
                                        var query = jQuery(media_query[i]).data("query");
                                        var left = jQuery(media_query[i]).find("td.left option:selected").val();
                                        var right = jQuery(media_query[i]).find("td.right option:selected").val();
                                        resp_padding_array.push(query+":"+left+":"+right);
                                    }

                                    var padding_string = resp_padding_array.join();
                                    crp.val(padding_string);
                                    resp_padding_array= [];

                                }

                            /* Padding
                            ---------------*/

                                var padding_left   = edit_element.find(".padding-box input[name=\"padding-left\"]").val(),
                                    padding_top    = edit_element.find(".padding-box input[name=\"padding-top\"]").val(),
                                    padding_right  = edit_element.find(".padding-box input[name=\"padding-right\"]").val(),
                                    padding_bottom = edit_element.find(".padding-box input[name=\"padding-bottom\"]").val();

                                padding_top = (padding_top.length) ? padding_top : '0';
                                padding_right = (padding_right.length) ? padding_right : '0';
                                padding_bottom = (padding_bottom.length) ? padding_bottom : '0';
                                padding_left = (padding_left.length) ? padding_left : '0';

                                var padding_output = padding_top+','+padding_right+','+padding_bottom+','+padding_left,
                                    padding_value  = padding_top+'px '+padding_right+'px '+padding_bottom+'px '+padding_left+'px';

                                padding.val(padding_output);

                            CSS += '.et-animate-box-'+ID+' .content {';
                                CSS += 'padding:'+padding_value+';';
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
                        var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"] .et-animate-box');
                        if (typeof(element) != 'undefined' && element != null) {
                            iframeSCRIPT(element,doc);
                        }
                    });
                }
                return;
            }
    });

})(jQuery);