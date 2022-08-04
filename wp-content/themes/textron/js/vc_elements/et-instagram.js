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

            var $this    = $(this),
                slidesRaw= this.querySelector('.slides'),
                username = $this.data('username'),
                limit    = $this.data('limit');

            if ($this.hasClass('carousel')) {
                $this.find('.slides').instastory({
                    get: username,
                    imageSize: 640,
                    limit: limit,
                    link: true,
                    template: '<div class="instagram-item post-media"><a class="image-container" href="{{link}}" target="_blank"><img class="lazy" width="640" height="640" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{image}}"  alt="{{accessibility_caption}}" /><svg class="placeholder" viewBox="0 0 20 4"><circle cx="2" cy="2" r="2" /><circle cx="10" cy="2" r="2" /><circle cx="18" cy="2" r="2" /></svg><div class="post-image-overlay"><div class="post-image-overlay-content"><p><span class="feed-item-likes"><span class="feed-item-icons"></span>{{likes}}</span><span class="feed-item-comments"><span class="feed-item-icons"></span>{{comments}}</span></p><p class="feed-item-description">{{caption}}</p></div></div></a></div>'
                });
            } else {
                $this.instastory({
                    get: username,
                    imageSize: 640,
                    limit: limit,
                    link: true,
                    template: '<div class="instagram-item post-media"><a class="image-container" href="{{link}}" target="_blank"><img class="lazy" width="640" height="640" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{image}}"  alt="{{accessibility_caption}}" /><svg class="placeholder" viewBox="0 0 20 4"><circle cx="2" cy="2" r="2" /><circle cx="10" cy="2" r="2" /><circle cx="18" cy="2" r="2" /></svg><div class="post-image-overlay"><div class="post-image-overlay-content"><p><span class="feed-item-likes"><span class="feed-item-icons"></span>{{likes}}</span><span class="feed-item-comments"><span class="feed-item-icons"></span>{{comments}}</span></p><p class="feed-item-description">{{caption}}</p></div></div></a></div>'
                });
            }

            setTimeout(function(){

                if ($this.hasClass('carousel')) {

                    $this.addClass('et-carousel');

                    var slides   = $this.find('.slides'),
                        items    = slides.parent().data('columns'),
                        items768 = (items > 3) ? 3 : items,
                        items1024= items,
                        gatter   = 0,
                        autoplay = false;
                
                    var slider = tns({
                        container: slidesRaw,
                        mode:'carousel',
                        controlsPosition:'bottom',
                        navPosition:'bottom',
                        gutter:gatter,
                        autoplay:autoplay,
                        autoplayButtonOutput:false,
                        touch:true,
                        mouseDrag:true,
                        nav:false,
                        controls:true,
                        loop:false,
                        items: items,
                        responsive: {
                            320: {items: 1},
                            768: {items:items768},
                            1024:{items:items1024},
                            1280:{items:items}
                        }
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

                }

                $(doc).find("#dynamic-styles-inline-css").append(CSS);

                $this.find('img.lazy').each(function(){
                    var lazyImg = $(this);
                    lazyImg.attr('src',lazyImg.data('src')).removeClass('lazy');
                    lazyImg.parent().addClass('loaded').removeClass('lazy-inline-image');
                    lazyImg.parent().find('svg').remove();
                });
            },4000);
        
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
                return dataObj[key] === "et_instagram";
            });

        /* Load element
        /*-------------*/

            if((dataObj['action'] == "vc_load_shortcode" && elementExists)){
                var iframe = $('#vc_inline-frame');
                if (typeof(iframe) != 'undefined' && iframe != null){
                    iframe.ready(function() {
                        var doc = iframe.contents();
                        iframe = document.getElementById('vc_inline-frame');
                        var element = doc.find('.vc_element[data-model-id="'+dataObj['shortcodes[0][id]']+'"] .et-instagram');
                        if (typeof(element) != 'undefined' && element != null) {
                            iframeSCRIPT(element,doc);
                        }
                    });
                }
                return;
            }

    });

})(jQuery);