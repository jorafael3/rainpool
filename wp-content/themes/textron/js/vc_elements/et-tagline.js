(function($){

    "use strict";

    function uniqueID() {return Math.floor((Math.random() * 1000000) + 1);}

    function isInArray(value, array) {return array.indexOf(value) > -1;}

    String.prototype.replaceAll = function(str1, str2, ignore) {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
    }

    function hexToRgbA(hex,o){
        var c;
        if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
            c= hex.substring(1).split('');
            if(c.length== 3){
                c= [c[0], c[0], c[1], c[1], c[2], c[2]];
            }
            c= '0x'+c.join('');
            return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+','+o+')';
        }
        throw new Error('Bad Hex');
    }

    function boxMove(target,x = 0.02,y = 0.02){

        jQuery(target).each(function(){

            var $this = jQuery(this);

            $this.on('mousemove',function(e){

                var sxPos =  e.pageX - ($this.width()/2  + $this.offset().left);
                var syPos =  e.pageY - ($this.height()/2 + $this.offset().top);

                gsap.to( $this, 1, { 
                    rotationY: Math.round(y * sxPos), 
                    rotationX: Math.round(x * syPos), 
                    rotationZ: 0,
                    force3D:true,
                    transformPerspective:1000, 
                    transformOrigin:'center center'
                });

            });

            $this.on('mouseleave',function(){
                gsap.to( $this, 1, { 
                    rotationY: 0, 
                    rotationX: 0, 
                    rotationZ: 0, 
                    force3D:true,
                    transformPerspective:1000, 
                    transformOrigin:'center center'
                });
            });

        });

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

            var $this = $(this);

            var tl = new gsap.timeline({paused: true});

            tl.to($this.find('.media-placeholder'),{
                duration: 0.3,
                opacity:0,
            },'+=0.2');

            tl.from($this.find('.in'),{
                duration: 1.2,
                x:50,
                stagger: 0.1,
                opacity:0,
                ease:"expo.out"
            },'-=0.2');

            setTimeout(function(){$this.addClass('active');},200);

            tl.progress(0);
            tl.play();

            boxMove($this);
                            

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
                        return dataObj[key] === "et_tagline";
                    });

                /* Edit element
                /*-------------*/

                    if(dataObj['action'] == "vc_edit_form" && dataObj['tag'] == "et_tagline"){

                        var edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_tagline"]');

                        var element_css  = edit_element.find('textarea[name="element_css"]'),
                            element_id   = edit_element.find('input[name="element_id"]');

                        $('#vc_ui-panel-edit-element[data-vc-shortcode="et_tagline"] .vc_ui-button-action[data-vc-ui-element="button-save"]').on('click',function(){

                            if ($('#vc_ui-panel-edit-element[data-vc-shortcode="et_tagline"]').length) {

                                var ID  = uniqueID();
                                var CSS = '';

                                edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_tagline"]');

                                /* Styling
                                ---------------*/

                                    var back_color   = edit_element.find('input[name="back_color"]').val(),
                                        back_img     = edit_element.find('input[name="back_img"]').val(),
                                        title_color  = edit_element.find('input[name="title_color"]').val(),
                                        button_color = edit_element.find('input[name="button_color"]').val();

                                    if(back_img.length){
                                        CSS += '#et-tagline-'+ID+' {';
                                        back_img = edit_element.find("img[rel=\""+back_img+"\"]").attr("src").replace("-425x425", "");
                                            CSS += "background-image:url("+back_img+");";
                                        CSS += '}';
                                    }

                                    if (back_color.length) {

                                        CSS += '#et-tagline-'+ID+' .media-placeholder {';
                                            CSS += 'fill:'+back_color+';';
                                        CSS += '}';

                                        CSS +='#et-tagline-'+ID+' .post-image-overlay .post-image-overlay-content {';
                                            CSS +='background: linear-gradient(to bottom, '+hexToRgbA(back_color,0)+' 0%,'+back_color+' 100%);';
                                            CSS +='filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'+back_color+'", endColorstr="'+back_color+'",GradientType=0 );';
                                        CSS +='}';

                                        CSS +='#et-tagline-'+ID+' .post-image-overlay:before {';
                                            CSS +='background: linear-gradient(to bottom, '+hexToRgbA(back_color,0)+' 25%,'+hexToRgbA(back_color,0.7)+' 100%);';
                                            CSS +='filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'+back_color+'", endColorstr="'+back_color+'",GradientType=0 );';
                                        CSS +='}';

                                    }

                                    if (title_color.length) {
                                        CSS += '#et-tagline-'+ID+' .tagline-title {';
                                            CSS += 'color:'+title_color+';';
                                        CSS += '}';

                                        CSS += '#et-tagline-'+ID+' .placeholder {';
                                            CSS += 'fill:'+title_color+';';
                                        CSS += '}';
                                    }
                                    
                                    if (button_color.length) {
                                        CSS += '#et-tagline-'+ID+' .tagline-button {';
                                            CSS += 'color:'+button_color+';';
                                        CSS += '}';

                                        CSS += '#et-tagline-'+ID+' .tagline-button svg {';
                                            CSS += 'fill:'+button_color+';';
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
                                var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"] .et-tagline');
                                if (typeof(element) != 'undefined' && element != null) {
                                    iframeSCRIPT(element,doc);
                                }
                            });
                        }
                        return;
                    }

                    

        });

})(jQuery);