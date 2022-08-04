(function($){

    "use strict";

    function uniqueID() {return Math.floor((Math.random() * 1000000) + 1);}

    String.prototype.replaceAll = function(str1, str2, ignore) {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
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

    function iframeSCRIPT(element,doc){
        $(element).each(function(){

            var $this = $(this);

            let lazyImages = [].slice.call(this.querySelectorAll("img.lazy"));

            if ("IntersectionObserver" in window) {

                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;

                            lazyImage.onload = function() {
                                lazyImage.classList.remove("lazy");
                                lazyImage.parentElement.classList.add("loaded");
                                lazyImageObserver.unobserve(lazyImage);
                            };
                            
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });

            }

            boxMove($(doc).find('.full .loop-projects > .project'));
                      
            if ($this.hasClass('filter')) {
                $this.find('.et-post-filter a').on('click',function(e){
                    var filter = $(this)
                    e.preventDefault();
                    filter.addClass('active').siblings().removeClass('active');
                    filter.parent().find('select option[value="'+filter.attr('href')+'"]').attr('selected','selected').siblings().removeAttr('selected');
                });

                $this.find('.et-post-filter select').on('change',function(){
                    var filter = $(this);
                    filter.parent().find('.filter[href="'+filter.val()+'"]').addClass('active').siblings().removeClass('active');
                });
            } else if ($this.hasClass('carousel') && !$this.find('.tns-ovh').length) {

                var items    = 3,
                    items768 = (items > 3) ? 3 : items,
                    items1024= items,
                    gatter   = 0,
                    autoplay = ($this.find('.loop-posts').data('autoplay')) ? $this.find('.loop-posts').data('autoplay') : false,
                    nav      = ($this.find('.loop-posts').data('nav')) ? $this.find('.loop-posts').data('nav') : 'arrows';

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

                if (autoplay) {

                    var index = 1,
                        max   = 3;

                    $this.find('.tns-nav > button').on('click',function(){
                        index = $(this).index();
                    });

                    var autoplayInterval = setInterval(function(){
                        
                        if ($this.find('.tns-controls > button').length) {
                            $this.find('.tns-controls > button[data-controls="next"]').trigger('click');
                        } else if($this.find('.tns-nav > button').length){
                            $this.find('.tns-nav > button').eq(index).trigger('click');
                        }
                        index++;

                        if (index >= max) {clearInterval(autoplayInterval);}

                    }, 5000);
                }

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
                return dataObj[key] === "et_projects";
            });

        /* Load element
        /*-------------*/

            if((dataObj['action'] == "vc_load_shortcode" && elementExists)){
                var iframe = $('#vc_inline-frame');
                if (typeof(iframe) != 'undefined' && iframe != null){
                    iframe.ready(function() {
                        var doc = iframe.contents();
                        iframe = document.getElementById('vc_inline-frame');
                        var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"]');
                        element = element.parent().find('.et-shortcode-projects')
                        if (typeof(element) != 'undefined' && element != null) {
                            iframeSCRIPT(element,doc);
                        }
                    });
                }
                return;
            }

    });

})(jQuery);