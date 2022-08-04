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

    function iframeSCRIPT(element,doc){

        $(element).each(function(){

            var $this = $(this);

            if ($this.hasClass('et-carousel') && !$this.find('.tns-ovh').length) {

                var items    = $this.data('columns'),
                    items768 = ($this.hasClass('et-testimonial-container')) ? 1 : (items > 3) ? 3 : items,
                    items1024= (items > 2 && $this.hasClass('et-testimonial-container')) ? 2 : items,
                    gatter   = ($this.hasClass('et-instagram') || $this.hasClass('et-gallery')) ? 8 : 24,
                    autoplay = ($this.data('autoplay')) ? $this.data('autoplay') : false,
                    nav      = ($this.data('nav')) ? $this.data('nav') : 'arrows';

                var bullets = (nav == 'both' || nav == 'dottes') ? true : false,
                    arrows  = (nav == 'dottes') ? false : true;

                var slider = tns({
                    container: this.querySelector('.slides'),
                    mode:'carousel',
                    controlsPosition:'bottom',
                    navPosition:'bottom',
                    gutter:gatter,
                    autoplay:autoplay,
                    autoplayButtonOutput:false,
                    touch:true,
                    mouseDrag:true,
                    nav:bullets,
                    controls:arrows,
                    loop:false,
                    items: items,
                    responsive: {
                        320: {items: 1},
                        768: {items:items768},
                        1024:{items:items1024},
                        1280:{items:items}
                    }
                });

                $this.find('.tns-controls > button').prop('disabled', false);

                function transitionEnd(){
                    $this.find('.tns-controls > button').prop('disabled', false);
                }

                slider.events.on('transitionEnd', transitionEnd);

                function carouselNavMove(){
                    if ($(doc).width() >= 1340) {
                        $this.find('.tns-controls > button').on('mousemove',function(e){

                            var button = $(this);
                            var sxPos  =  e.pageX - (button.width()/2  + button.offset().left);
                            var syPos  =  e.pageY - (button.height()/2 + button.offset().top);

                            gsap.to( button, 0.4, { 
                                x: Math.round(0.8 * sxPos), 
                                y: Math.round(0.8 * syPos), 
                            });

                        });

                        $this.find('.tns-controls > button').on('mouseleave',function(){
                            gsap.to( $(this), 0.4, { 
                                x: 0, 
                                y: 0, 
                            });
                        });
                    } else {
                        gsap.to( $this.find('.tns-controls > button'), 0, { 
                            x: 0, 
                            y: 0, 
                        });
                    }
                }

                carouselNavMove();
                $(doc).resize(function(){
                    carouselNavMove();
                });

                var CSS = '.tns-slider{transition: all 0.3s !important;}';
                var id    = '#'+$this.attr('id'),
                    nm    = $this.find('.slides').children().length,
                    width = $this.find('.slides').children().first().width(),
                    ratio = nm/items;

                CSS += id+' .tns-item{width:calc('+100/nm+'%);padding-right:'+gatter+'px}';
                CSS += id+' .tns-inner {margin: 0 -'+gatter+'px 0 0}';

                CSS += id+' .slides {width:calc('+100*ratio+'%);}';

                CSS += '@media (min-width: 20em){';
                    CSS += id+' .slides {width:calc('+100*nm+'%);}';
                CSS += '}';

                CSS += '@media (min-width: 48em){';
                    CSS += id+' .slides {width:calc('+100*(nm/items768)+'%);}';
                CSS += '}';

                CSS += '@media (min-width: 64em){';
                    CSS += id+' .slides {width:calc('+100*(nm/items1024)+'%);}';
                CSS += '}';

                CSS += '@media (min-width: 80em){';
                    CSS += id+' .slides {width:calc('+100*ratio+'%);}';
                CSS += '}';

                $(doc).find("#dynamic-styles-inline-css").append(CSS);

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
                return dataObj[key] === "et_client_container";
            });

            

        /* Load element
        /*-------------*/

            var elementChildExists = Object.keys(dataObj).some(function(key) {
                return dataObj[key] === "et_client";
            });

            if((dataObj['action'] == "vc_load_shortcode" && elementChildExists)){
                var iframe = $('#vc_inline-frame');
                if (typeof(iframe) != 'undefined' && iframe != null){
                    iframe.ready(function() {
                        var doc = iframe.contents();
                        var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"]');
                        if (typeof(element) != 'undefined' && element != null) {
                            element.addClass('tns-item');
                            element.attr('aria-hidden','true');
                            element.attr('tabindex','-1');
                        }
                    });
                }
                return;
            }

            if((dataObj['action'] == "vc_load_shortcode" && elementExists)){
                var iframe = $('#vc_inline-frame');
                if (typeof(iframe) != 'undefined' && iframe != null){
                    iframe.ready(function() {
                        var doc = iframe.contents();
                        var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"] .et-client-container');
                        if (typeof(element) != 'undefined' && element != null) {
                            iframeSCRIPT(element,doc);
                        }
                    });
                }
                return;
            }
    });

})(jQuery);