/* GSAP config
----*/
    
    gsap.config({ nullTargetWarn:false});

/* Visual composer front-end editor
----*/

    (function($){

        "use strict";

        /* Gsap Lightbox
        ----*/

            function lightImage(src,overlay,doc){

                if (
                    src.includes('.jpg') ||
                    src.includes('.jpeg') ||
                    src.includes('.png') ||
                    src.includes('.bmp') ||
                    src.includes('.gif') ||
                    src.includes('.svg')
                ) {
                    
                    var img = doc.createElement('img');
                    img.src = src;

                    var loaded = false;

                    img.onload = function() {

                        if (loaded) {
                            return;
                        }

                        if (overlay.find('img').length == 0) {
                            overlay.prepend(img);
                        }

                        loaded = true;
                    }
                    
                }

                if (src.includes('youtu') || src.includes('vimeo')) {
                    var iframe = doc.createElement('iframe');

                    src = src.replace('watch?v=', 'embed/');
                    src = src.replace('//vimeo.com/', '//player.vimeo.com/video/');
                    src = (src.indexOf("?") == -1) ? src += '?' : src += '&';
                    
                    iframe.src = src+'autoplay=1';
                    iframe.frameborder = '0';
                    iframe.width  = '1280';
                    iframe.height = '720';
                    iframe.allow  = 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture';
                    iframe.allowfullscreen = true;
                    overlay.prepend(iframe);
                }

                if (src.includes('mp4') || src.includes('webm') || src.includes('ogv')) {
                    var video = doc.createElement('video');
                    video.src = src;
                    video.autoplay = true;
                    video.controls = true;
                    overlay.prepend(video);
                }
            }

            function gsapLightbox(element,gallery,doc){

                var structure = (gallery == true) ? 
                $('<div class="gsap-lightbox-overlay"><div class="image-wrapper"></div><a href="#" class="gsap-lightbox-controls gsap-lightbox-toggle"></a><a href="#" class="gsap-lightbox-controls gsap-lightbox-nav prev" data-direction="prev"></a><a href="#" class="gsap-lightbox-controls gsap-lightbox-nav next" data-direction="next"></a><svg class="placeholder" viewBox="0 0 20 4"><circle cx="2" cy="2" r="2" /><circle cx="10" cy="2" r="2" /><circle cx="18" cy="2" r="2" /></svg></div>') :
                $('<div class="gsap-lightbox-overlay"><div class="image-wrapper"></div><a href="#" class="gsap-lightbox-controls gsap-lightbox-toggle"></a><svg class="placeholder" viewBox="0 0 20 4"><circle cx="2" cy="2" r="2" /><circle cx="10" cy="2" r="2" /><circle cx="18" cy="2" r="2" /></svg></div>');

                $(doc).find('body').append(structure);

                var overlay = $(doc).find('.gsap-lightbox-overlay'),
                    wrapper = overlay.find('.image-wrapper'),
                    toggle  = overlay.find('.gsap-lightbox-toggle'),
                    loading = overlay.find('.gsap-lightbox-toggle');

                var tl = new gsap.timeline({paused: true});

                tl.from(toggle,0.2, {
                  opacity:0,
                  ease:"expo.out"
                },'+=0.2');

                tl.from(toggle,1.2, {
                  x:'-12px',
                  ease:"elastic.out(1, 0.5)"
                },'-=0.2');

                if (gallery == true) {

                    var nav         = overlay.find('.gsap-lightbox-nav'),
                        next        = overlay.find('.next'),
                        prev        = overlay.find('.prev'),
                        gallerySet  = [],
                        count       = 0,
                        galleryName = element.data('gallery');

                    tl.from(nav,0.2, {
                        opacity:0,
                    },'-=1.1');

                    tl.from(prev,1.2, {
                      x:'-40px',
                      ease:"elastic.out(1, 0.5)"
                    },'-=1.1');

                    tl.from(next,1.2, {
                      x:'40px',
                      ease:"elastic.out(1, 0.5)"
                    },'-=1.2');

                    $(doc).find('a[data-gallery="'+galleryName+'"]').each(function(){
                        gallerySet.push($(this).attr('href'));
                    });

                    count = gallerySet.indexOf(element.attr('href'));

                    var max = gallerySet.length;

                    if (max == 1) {
                        $(doc).find('body .gsap-lightbox-overlay .gsap-lightbox-nav').remove();
                    }
                    
                    nav.on('click',function(e){

                        overlay.find('img').remove();

                        e.preventDefault();

                        count += ($(this).data('direction') == "next") ? 1 : -1;
                        if (count < 0) {count = max - 1;}
                        if (count >= max) {count = 0;}

                        lightImage(gallerySet[count],wrapper,doc);
                    });

                }

                tl.add('active');

                tl.to(overlay,0.1, {
                    opacity:0,
                });

                setTimeout(function(){
                    overlay.addClass('active');
                    tl.progress(0);
                    tl.tweenTo('active');

                    lightImage(element.attr('href'),wrapper,doc);

                },50);

                toggle.on('click',function(e){
                    e.preventDefault();
                    tl.play();
                    overlay.removeClass('active');
                    setTimeout(function(){
                        overlay.remove();
                    },500);
                });
            }

        /* Video trigger
        ----*/

            function videoTrigger(doc){
                jQuery(doc).find('.video-btn').each(function(){

                    var $this  = jQuery(this),
                        video  = $this.parents('.post-video').find('.video-element'),
                        image  = $this.parents('.post-video').find('.image-container'),
                        embed  = (video.hasClass('iframevideo')) ? true : false,
                        back   = $this.find('.back');

                    $this.hover(
                        function(){
                            gsap.to(back,0.8, {
                              scale:1.15,
                              ease:"elastic.out"
                            });
                        },
                        function(){
                            gsap.to(back,0.8, {
                              scale:1,
                              ease:"expo.out"
                            });
                        }
                    );

                    $this.on('click',function(e){
                        e.preventDefault();

                        if (!$this.hasClass('video-modal')) {
                            image.toggleClass('playing');
                            video.toggleClass('playing');
                        }

                        if ($this.hasClass('video-modal')) {
                            gsapLightbox($this,false);
                        } else {
                            setTimeout(function(){
                                if (embed) {
                                    var src = video.attr('src');
                                    src =  (src.indexOf("?") == -1) ? src += '?' : src += '&';
                                    video.attr('src',src+'autoplay=1');
                                } else {
                                    video.trigger('play');
                                }
                            },500);
                        }

                    });

                });
            }

        /* Lazy loading
        ----*/

            function lazyLoad(container){

                let lazyImages = [].slice.call(container.querySelectorAll("img.lazy"));
                let lazyVideos = [].slice.call(container.querySelectorAll("video.lazy"));

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

                    var lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
                        entries.forEach(function(video) {
                            if (video.isIntersecting) {

                                for (var source in video.target.children) {
                                    var videoSource = video.target.children[source];
                                    if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
                                        videoSource.src = videoSource.dataset.src;
                                    }
                                }

                                video.target.load();
                                video.target.classList.remove("lazy");
                                lazyVideoObserver.unobserve(video.target);
                            }
                        });
                    });

                    lazyVideos.forEach(function(lazyVideo) {
                        lazyVideoObserver.observe(lazyVideo);
                    });

                }

            }        

        /* Box move
        ----*/

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

        var iframe = document.getElementById('vc_inline-frame');
        if (typeof(iframe) != 'undefined' && iframe != null){

            iframe.addEventListener("load", function() {

                var win = iframe.contentWindow;
                var doc = iframe.contentDocument ? iframe.contentDocument : iframe.contentWindow.document;

                setTimeout(function(){

                    /* Gsap Lightbox
                    ----*/

                        $(doc).find('.et-gallery').each(function(){

                            var $this = $(this);

                            $this.find('a').on('click',function(e){
                                e.preventDefault();
                                gsapLightbox($(this),true,doc);
                            });

                            if ($this.hasClass('slider')) {

                                $this.find('img.lazy').each(function(){
                                    var lazyImg = $(this);
                                    lazyImg.attr('src',lazyImg.data('src')).removeClass('lazy');
                                    lazyImg.parent().addClass('loaded').removeClass('lazy-inline-image');
                                    lazyImg.parent().find('svg').remove();
                                });

                                var slider = tns({
                                    container: this.querySelector('.slides'),
                                    mode:'gallery',
                                    nav:false,
                                    items: 1,
                                });
                                
                            }
                        });

                        $(doc).find('.et-button.modal-true').on('click',function(e){
                            e.preventDefault();
                            gsapLightbox($(this),false,doc);
                        });

                    /* Video trigger
                    ----*/

                        videoTrigger(doc);

                    /* Lazy load
                    ----*/

                        doc.addEventListener("DOMContentLoaded", lazyLoad(doc));

                    /* Header builder
                    ----*/

                        $(doc).find(".hbe").each(function(){

                            var $this = $(this);
                            var attr = $this.parent().attr('data-tag');
                            var hasAttribute = (typeof attr !== 'undefined' && attr !== false) ? true : false;
                            if ($this.hasClass('hbe-right') && hasAttribute) {$this.parent().addClass('hbe-right');}
                            if ($this.hasClass('hbe-left') && hasAttribute) {$this.parent().addClass('hbe-left');}
                            if ($this.hasClass('hbe-center') && hasAttribute) {$this.parent().addClass('hbe-center');}
                        });

                    /* Title section
                    ----*/

                        $(doc).find(".tse").each(function(){
                            var $this = $(this);
                            var attr = $this.parent().attr('data-tag');
                            var hasAttribute = (typeof attr !== 'undefined' && attr !== false) ? true : false;
                            if ($this.hasClass('tse-right') && hasAttribute) {$this.parent().addClass('tse-right');}
                            if ($this.hasClass('tse-left') && hasAttribute) {$this.parent().addClass('tse-left');}
                            if ($this.hasClass('tse-center') && hasAttribute) {$this.parent().addClass('tse-center');}
                        });

                    /* VC core animations
                    ----*/

                        $(doc).find('.wpb_animate_when_almost_visible').each(function(){
                            $(this).waypoint({
                                handler: function(direction) {

                                    $(this.element)
                                    .addClass('wpb_start_animation')
                                    .addClass('animated');

                                    this.destroy();
                                },
                                offset: 'bottom-in-view',
                                context: win
                            });
                        });

                    /* Remove custom cursor
                    ----*/

                        $(doc).find("body").removeClass('cursor-active');

                    /* Tiny slider
                    ----*/

                        var CSS = '.tns-slider{transition: all 0.3s !important;}';

                        $(doc).find('.et-carousel > .slides').each(function(){

                            var $this    = $(this),
                                items    = $this.parent().data('columns'),
                                items768 = ($this.parent().hasClass('et-testimonial-container')) ? 1 : (items > 3) ? 3 : items,
                                items1024= (items > 2 && $this.parent().hasClass('et-testimonial-container')) ? 2 : items,
                                gatter   = ($this.parent().hasClass('et-instagram')) ? 0 : 24,
                                autoplay = ($this.parent().data('autoplay')) ? $this.parent().data('autoplay') : false,
                                nav      = ($this.parent().data('nav')) ? $this.parent().data('nav') : 'arrows';

                                if ($this.parent().hasClass('loop-posts') && (items >= 3)) {items768 = 2;}

                                if ($this.parent().hasClass('et-gallery')) {gatter = 8;}

                                if ($this.parent().hasClass('loop-posts') || $this.hasClass('loop-products')) {gatter = 0;}

                                var bullets = (nav == 'both' || nav == 'dottes') ? true : false,
                                    arrows  = (nav == 'dottes') ? false : true;

                                if (autoplay && $this.parent().hasClass('et-testimonial-container')) {
                                    autoplay = false;
                                    $this.parent().addClass('enabled-autoplay');
                                }

                            var slider = tns({
                                container: this,
                                mode:'carousel',
                                controlsPosition:'bottom',
                                navPosition:'bottom',
                                gutter:gatter,
                                autoplay:autoplay,
                                autoplayButtonOutput:false,
                                touch:false,
                                mouseDrag:false,
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

                            $this.parents('.et-carousel').find('.tns-controls > button').prop('disabled', false);


                            function transitionStart(){
                                if ($this.parents('.et-carousel').hasClass('et-testimonial-container') && items == 1) {
                                    $this.find('.et-testimonial').each(function(){
                                        $(this).css({'opacity':'0'});
                                    });
                                }
                            }

                            function transitionEnd(){
                                $this.parents('.et-carousel').find('.tns-controls > button').prop('disabled', false);
                            }

                            slider.events.on('transitionStart', transitionStart);
                            slider.events.on('transitionEnd', transitionEnd);

                            function testimonialTransition(){
                                setTimeout(function(){
                                    if (items == 1) {

                                        gsap.to($this.find('.tns-slide-active > .et-testimonial'),{
                                            duration: 0.4,
                                            opacity:1,
                                        });

                                        gsap.from($this.find('.tns-slide-active'),{
                                            duration: 0.4,
                                        });

                                        gsap.from($this.find('.tns-slide-active .author-wrapper *'),{
                                            duration: 0.8,
                                            delay: 0.2,
                                            opacity:0,
                                            x:48,
                                            stagger: 0.05,
                                            ease:"expo.out"
                                        });

                                    }
                                },200);
                            }

                            $this.parents('.et-testimonial-container').find('.tns-controls > button').on('click',function(){
                                testimonialTransition();
                            });

                            $this.parents('.et-testimonial-container').find('.tns-nav > button').on('click',function(){
                                testimonialTransition();
                            });

                            if ($this.parents('.enabled-autoplay').length) {

                                var index = 1,
                                    max   = items;

                                $this.parents('.et-testimonial-container').find('.tns-nav > button').on('click',function(){
                                    index = $(this).index();
                                });

                                var autoplayInterval = setInterval(function(){
                                    
                                    if ($this.parents('.et-testimonial-container').find('.tns-controls > button').length) {
                                        $this.parents('.et-testimonial-container').find('.tns-controls > button[data-controls="next"]').trigger('click');
                                    } else if($this.parents('.et-testimonial-container').find('.tns-nav > button').length){
                                        $this.parents('.et-testimonial-container').find('.tns-nav > button').eq(index).trigger('click');
                                    }
                                    index++;

                                    if (index >= max) {clearInterval(autoplayInterval);}

                                }, 5000);
                            }

                            function carouselNavMove(){
                                if ($(window).width() >= 1340) {
                                    $this.parents('.et-carousel').find('.tns-controls > button').on('mousemove',function(e){

                                        var button = $(this);
                                        var sxPos  =  e.pageX - (button.width()/2  + button.offset().left);
                                        var syPos  =  e.pageY - (button.height()/2 + button.offset().top);

                                        gsap.to( button, 0.4, { 
                                            x: Math.round(0.8 * sxPos), 
                                            y: Math.round(0.8 * syPos), 
                                        });

                                    });

                                    $this.parents('.et-carousel').find('.tns-controls > button').on('mouseleave',function(){
                                        gsap.to( $(this), 0.4, { 
                                            x: 0, 
                                            y: 0, 
                                        });
                                    });
                                } else {
                                    gsap.to( $this.parents('.et-carousel').find('.tns-controls > button'), 0, { 
                                        x: 0, 
                                        y: 0, 
                                    });
                                }
                            }

                            carouselNavMove();
                            $(win).resize(function(){
                                carouselNavMove();
                            });

                            var id    = '#'+$this.attr('id'),
                                nm    = $this.children().length,
                                width = $this.children().first().width(),
                                ratio = nm/items;

                            CSS += id+' .tns-item{width:calc('+100/nm+'%);padding-right:'+gatter+'px}';
                            CSS += id+' .tns-inner {margin: 0 -'+gatter+'px 0 0}';

                            CSS += id+' {width:calc('+100*ratio+'%);}';

                            CSS += '@media (min-width: 20em){';
                                CSS += id+' {width:calc('+100*nm+'%);}';
                            CSS += '}';

                            CSS += '@media (min-width: 48em){';
                                CSS += id+' {width:calc('+100*(nm/items768)+'%);}';
                            CSS += '}';

                            CSS += '@media (min-width: 64em){';
                                CSS += id+' {width:calc('+100*(nm/items1024)+'%);}';
                            CSS += '}';

                            CSS += '@media (min-width: 80em){';
                                CSS += id+' {width:calc('+100*ratio+'%);}';
                            CSS += '}';

                        });

                        $(doc).find("#dynamic-styles-inline-css").append(CSS);

                    /* Header
                    ----*/

                        /* Megamenu tabs
                        ----*/

                            $(doc).find('.megamenu-tab').each(function(){

                                var $this             = $(this),
                                    tabs              = $this.find('.tab-item'),
                                    tabsQ             = tabs.length,
                                    tabsDefaultWidth  = 0,
                                    tabsDefaultHeight = 0,
                                    tabsContent       = $this.find('.tab-content'),
                                    action            = ($this.hasClass('action-hover')) ? 'hover' : 'click';

                                tabs.wrapAll('<div class="tabset et-clearfix"></div>');
                                tabsContent.wrapAll('<div class="tabs-container et-clearfix"></div>');

                                var tabSet = $this.find('.tabset');

                                if(!tabs.hasClass('active')){
                                    tabs.first().addClass('active');
                                }

                                tabs.each(function(){

                                    var $thiz = $(this);

                                    if ($thiz.hasClass('active')) {
                                        $thiz.siblings()
                                        .removeClass("active");
                                        tabsContent.hide(0).removeClass('active');
                                        tabsContent.eq($thiz.index()).show(0).addClass('active');
                                    }

                                });

                                if(tabsQ >= 2){

                                    if (action == 'click') {
                                        tabs.on('click', function(event){
                                            event.stopImmediatePropagation();

                                            var $self = $(this);

                                            if(!$self.hasClass("active")){

                                                $self.addClass("active");

                                                $self.siblings()
                                                .removeClass("active");

                                                if ($this.parents('.submenu-appear-none').length) {
                                                    var currentHeight = tabsContent.eq($self.index()).height();
                                                    $this.parents('.megamenu').css('height',currentHeight);
                                                }

                                                tabsContent.hide(0).removeClass('active');
                                                tabsContent.eq($self.index()).show(0).addClass('active');
                                            }
                                        });
                                    } else {
                                        tabs.on('mouseover', function(event){

                                            event.stopImmediatePropagation();

                                            var $self = $(this);

                                            if(!$self.hasClass("active")){

                                                $self.addClass("active");

                                                $self.siblings()
                                                .removeClass("active");

                                                if ($this.parents('.submenu-appear-none').length) {
                                                    var currentHeight = tabsContent.eq($self.index()).height();
                                                    $this.parents('.megamenu').css('height',currentHeight);
                                                }

                                                tabsContent.hide(0).removeClass('active');
                                                tabsContent.eq($self.index()).show(0).addClass('active');
                                            }
                                            
                                        });
                                    }
                                    
                                }

                            });

                        /* Megamenu
                        ----*/

                            function megamenuPosition(){

                                $(doc).find('.header-menu > .menu-item').each(function(){

                                    var $this = $(this);
                                    var megamenu = $this.children('.megamenu');

                                    if (megamenu.length) {
                                        if ($this.data('width') == '100') {
                                            var megamenuWidth = $(win).innerWidth();
                                            megamenu.css({
                                                'max-width':megamenuWidth+'px',
                                                'width':megamenuWidth+'px',
                                                'margin-left':'-'+($this.offset().left)+'px',
                                            });
                                        }
                                    }

                                });

                            }

                            megamenuPosition();
                            $(win).resize(megamenuPosition);

                        /* Megamenu grid autoalign
                        ----*/

                            $(doc).find('.megamenu').each(function(){
                                var $this = $(this);

                                if ($this.data('width') == '1200') {

                                    var closestLink = $this.parent().children('a');
                                    if (closestLink.length) {
                                        var parentContainer = $this.parents('.container').eq(0);
                                        var offset = closestLink.offset().left - (parentContainer.offset().left + ((parentContainer.outerWidth() - 1200)/2));
                                        $this.attr('style','margin-left:-'+offset+'px !important;');
                                    }

                                }

                            });

                        /* Submenu
                        ----*/

                            function submenuPosition(){

                                $('.et-desktop .header-menu > .menu-item').each(function(){

                                    var $this = $(this);

                                    if ($this.children('.sub-menu:not(.megamenu)').length) {

                                        if( $this.offset().left + $this.width() + $this.children('.sub-menu').width() > $(window).innerWidth()){
                                            $this.addClass('submenu-left');
                                        } else {
                                            $this.removeClass('submenu-left');
                                        }

                                    }

                                });

                            }

                            function navigationInIt(){

                                var $this               = $(this),
                                    hover               = $this.find('.menu-item-has-children'),
                                    subMenuEffect       = ($this.parent().hasClass('submenu-appear-none')) ? 'default' : 'fade',
                                    menuEffect          = (!$this.parent().hasClass('menu-hover-none')) ? true : false;

                                // Add active to first item
                                $this.children('li').first().addClass('active');

                                hover.push($this.children('.mm-true'));

                                if (menuEffect) {

                                    var active              = '',
                                        activeOffset        = 0,
                                        currentMenuItem     = $this.children('li.active'),
                                        color               = $this.data('color'),
                                        color_hover         = $this.data('color-hover');

                                    if (currentMenuItem.length) {
                                        active       = currentMenuItem;
                                        activeOffset = active.position().left;
                                    }

                                    if (active.length) {
                                        active = active.children('a').find('.effect');
                                    } else {
                                        active = $this.children('li:first-child').children('a').find('.effect')
                                    }

                                    $.each($this.children('.depth-0'),function(){

                                        var li      = $(this),
                                            effect  = li.children('a').find('.effect'),
                                            effectX = li.position().left - activeOffset,
                                            effectW = effect.width();

                                        li.on('mouseover touchstart',function(){

                                            gsap.to(active,1, {
                                                x:effectX,
                                                width:effectW,
                                                ease:'elastic.out(1, 0.75)'
                                            });

                                            li.addClass('in').siblings().removeClass('in');

                                            if (li.hasClass('active')) {
                                                li.removeClass('using');
                                            } else {
                                                li.parent().children('li.active').addClass('using');
                                            }

                                        });

                                    });


                                    $this.on('mouseleave',function(){

                                        var width = $this.children('li.active').width();

                                        if ($this.parent().hasClass('menu-hover-underline')) {
                                            width = $this.children('li.active').find('.txt').width();
                                        }

                                        gsap.to(active,1, {
                                            x:$this.children('li.active').position().left - activeOffset,
                                            width:width,
                                            ease:'elastic.out(1, 0.75)'
                                        });

                                        $this.find('.in').removeClass('in');
                                        $this.find('.using').removeClass('using');
                                    });

                                }

                                $.each(hover,function(){

                                    var li      = $(this),
                                        subMenu = li.children('.sub-menu'),
                                        height  = subMenu.height();

                                    var tl = new gsap.timeline({paused: true});

                                    if (subMenuEffect == "default") {

                                        tl.from(subMenu,1, {
                                            height:0,
                                            ease:'elastic.out(1, 0.75)'
                                        },'+=0.2');

                                        tl.from(subMenu,0.1, {
                                            opacity:0,
                                            ease:'expo.out'
                                        },'-=1');

                                    } else {

                                        tl.from(subMenu,0.3, {
                                            opacity:0,
                                            ease:'expo.out'
                                        },'+=0.2');

                                    }

                                    li.hover(
                                        function(){
                                            tl.progress(0);
                                            tl.play();

                                        },
                                        function(){
                                            tl.reverse();

                                            if (li.find('.megamenu-tab').length) {
                                                li.find('.tabset .tab-item:first-child').trigger('click');
                                            }
                                        }
                                    );


                                });
                            }

                            submenuPosition();
                            $(win).resize(submenuPosition);

                            $(doc).find('.header-menu:not(".megamenu-demo")').each(navigationInIt);

                            $(doc).find('.et-menu').each(navigationInIt);

                        /* Toggles
                        ----*/

                            function svgBackMorph(element,toggle,box,content,scrollElement){

                                var $this  = jQuery(element),
                                    start  = $this.find('.start'),
                                    end    = $this.find('.end'),
                                    icon   = $this.find('.close-toggle'),
                                    isOpen = false;

                                var tl = new gsap.timeline({paused: true});

                                    tl.to(box,0, {
                                      visibility:'visible', immediateRender:false,
                                      opacity:1, immediateRender:false
                                    },'+=0.2');

                                    tl.to(start,1.2, {
                                      morphSVG:{shape:end, shapeIndex:8},
                                      ease:"elastic.out(1, 0.75)"
                                    });

                                    tl.from(icon,0.1, {
                                      opacity:'0',
                                      ease:"sine.in"
                                    },'-=1.2');

                                    tl.from(content,0.1, {
                                      opacity:'0',
                                      ease:"sine.in"
                                    },'-=1');

                                    tl.add("open");

                                    tl.to(content,0.1, {
                                      opacity:'0',
                                      ease:"sine.out"
                                    });

                                    tl.to(icon,0.1, {
                                      opacity:'0',
                                      ease:"sine.out"
                                    },'-=0.1');

                                    tl.to(start,0.6, {
                                      morphSVG:{shape:start},
                                      ease:"elastic.out(1, 1.75)"
                                    },'+=0.2');

                                    tl.to(box,0.1, {
                                      opacity:0,
                                      ease:"sine.out"
                                    },'-=0.45');

                                    tl.to(box,0, {
                                      visibility:'hidden', immediateRender:false
                                    });

                                    tl.add("close");

                                    tl.to(content,0, {
                                      opacity:'0', immediateRender:false
                                    });

                                    tl.to(icon,0, {
                                      opacity:'0', immediateRender:false
                                    });

                                    tl.to(start,0, {
                                      morphSVG:{shape:start}, immediateRender:false
                                    });

                                    tl.to(box,0, {
                                      opacity:0, immediateRender:false
                                    });

                                    tl.to(box,0, {
                                      visibility:'hidden', immediateRender:false
                                    });

                                    tl.add("hide");

                                toggle.on('click',function(){

                                    toggle.toggleClass('active');

                                    if (toggle.hasClass('hide')) {
                                        box.css({
                                            'visibility':'hidden',
                                            'opacity':0
                                        });
                                        isOpen=false;
                                        tl.tweenFromTo('close','hide');
                                        toggle.removeClass('hide');
                                    } else {
                                        if (isOpen==false) {

                                            // Custom scroll bar
                                            setTimeout(function(){
                                                var scroll = element.querySelector(scrollElement);
                                                if (typeof scroll != "undefined" && scroll != null) {
                                                    SimpleScrollbar.initEl(scroll);
                                                }
                                            },200);

                                            tl.progress(0);
                                            tl.tweenTo("open");

                                            isOpen=true;

                                        } else {
                                            isOpen=false;
                                            tl.tweenTo("close");
                                        }
                                    }
                                });
                            }

                            /* Header search
                            ----*/

                                $(doc).find('.header-search').each(function(){

                                    var $this  = $(this),
                                        toggle = $this.find('.search-toggle'),
                                        close  = $this.find('.close-toggle'),
                                        box    = $this.find('.search-box'),
                                        start  = $this.find('.start'),
                                        end    = $this.find('.end'),
                                        icon   = $this.find('.search-icon'),
                                        input  = $this.find('input[type="text"]'),
                                        isOpen = false;

                                    var tl = new gsap.timeline({paused: true});

                                    tl.to(box,0, {
                                      visibility:'visible', immediateRender:false
                                    },'+=0.2');

                                    tl.to(start,1.2, {
                                      morphSVG:{shape:end, shapeIndex:8},
                                      ease:"elastic.out(1, 0.75)"
                                    });

                                    tl.from(icon,1.2, {
                                      x:'12px',
                                      ease:"elastic.out(1, 0.75)"
                                    },'-=1.2');

                                    tl.add("open");

                                    tl.to(start,0.6, {
                                      morphSVG:{shape:start},
                                      ease:"elastic.out(1, 1.75)"
                                    },'+=0.2');

                                    tl.to(box,0.1, {
                                      opacity:0,
                                      ease:"sine.in"
                                    },'-=0.45');

                                    tl.to(box,0, {
                                      visibility:'hidden', immediateRender:false
                                    });

                                    tl.add("close");

                                    tl.to(start,0.1, {
                                      morphSVG:{shape:start}, immediateRender:false
                                    });

                                    tl.to(box,0.1, {
                                      opacity:0, immediateRender:false
                                    });

                                    tl.to(box,0, {
                                      visibility:'hidden', immediateRender:false
                                    });

                                    tl.add("hide");

                                    toggle.on('click',function(e){

                                        box.removeClass('hide');

                                        toggle.addClass('active');

                                        input.val('');

                                        if (isOpen==false) {

                                            tl.progress(0);
                                            tl.tweenTo("open");

                                            setTimeout(function(){
                                                input.focus();
                                            },700);

                                            isOpen=true;

                                        }

                                    });

                                    close.on('click',function(e){

                                        toggle.removeClass('active');

                                        if (close.hasClass('hide')) {

                                            box.addClass('hide');

                                            e.preventDefault();
                                            input.val('');

                                            tl.seek("close");
                                            tl.play();

                                            close.removeClass('hide');

                                            isOpen=false;

                                        } else {

                                            if (!input.val()) {
                                                tl.tweenTo("close");
                                                isOpen=false;
                                            }
                                        }

                                    });

                                    $this.find('#searchsubmit').on('click',function(e){
                                        if (!input.val()) {
                                            e.preventDefault();
                                            input.val('');
                                            tl.tweenTo("close");
                                        }
                                    });

                                });

                            /* Shopping cart
                            ----*/

                                $(doc).find('.header-cart').each(function(){
                                    var element      = this,
                                        $this        = $(element),
                                        toggle       = $this.find('.cart-toggle'),
                                        box          = $this.find('.cart-box'),
                                        content      = $this.find('.widget_shopping_cart');

                                    svgBackMorph(element,toggle,box,content,'.cart_list');
                                });

                                $(doc).find('.ajax_add_to_cart').each(function(){
                                    $(this).on('click',function(){
                                        $(doc).find('.header-cart').each(function(){
                                            var cartToggle = $(this).find('.close-toggle');
                                            if (cartToggle.hasClass('active')) {
                                                cartToggle.addClass('hide').trigger('click');
                                            }
                                        });
                                    });
                                });

                            /* Language switcher
                            ----*/

                                $(doc).find('.language-switcher').each(function(){

                                    var element      = this,
                                        $this        = $(element),
                                        toggle       = $this.find('.language-toggle'),
                                        box          = $this.find('.language-box'),
                                        content      = $this.find('.language-switcher-content');

                                    // Configure svg back size
                                    var width = $this.data('width'),
                                        height = $this.find('.language-switcher-content').height() + 60,
                                        startD = $this.find('.start').attr('d'),
                                        endD   = $this.find('.end').attr('d');

                                        if (height > 370) {
                                            height = 370;
                                        }

                                        element.querySelector('.back').setAttribute('viewBox','0 0 '+width+' '+height);

                                        var widthReplaceTo  = width - 8;
                                        var heightReplaceTo = height - 8;

                                        startD = startD.replace(/272/g,widthReplaceTo);
                                        endD = endD.replace(/272/g,widthReplaceTo);
                                        endD = endD.replace(/362/g,heightReplaceTo);
                                        endD = endD.replace(/370/g,height);
                                        endD = endD.replace(/280/g,width);

                                        $this.find('.start').attr('d',startD);
                                        $this.find('.end').attr('d',endD);

                                    svgBackMorph(element,toggle,box,content,'.language-switcher-content');

                                });

                                $(doc).find('.wpml-ls-legacy-dropdown-click').each(function(){
                                    var $this = $(this);

                                    $this.find('.js-wpml-ls-item-toggle').on('click',function(){
                                        $this.find('.js-wpml-ls-sub-menu').toggleClass('active');
                                    });

                                });

                            /* Header login
                            ----*/

                                $(doc).find('.header-login').each(function(){

                                    var element      = this,
                                        $this        = $(element),
                                        toggle       = $this.find('.login-toggle'),
                                        box          = $this.find('.login-box'),
                                        content      = $this.find('.widget_reglog');

                                    // Configure svg back size
                                    var height = $this.find('.widget_reglog').outerHeight() + 60,
                                        startD = $this.find('.start').attr('d'),
                                        endD   = $this.find('.end').attr('d');

                                        element.querySelector('.back').setAttribute('viewBox','0 0 280 '+height);

                                        height += 10;

                                        var heightReplaceTo = height - 8;

                                        endD = endD.replace(/362/g,heightReplaceTo);
                                        endD = endD.replace(/370/g,height);

                                        $this.find('.start').attr('d',startD);
                                        $this.find('.end').attr('d',endD);

                                    svgBackMorph(element,toggle,box,content,'.widget_reglog');

                                });

                            /* Toggle off
                            ----*/

                                $(doc).find('.hbe-toggle').each(function(){

                                    $(this).on('click',function(){
                                        if ($(this).hasClass('active')) {

                                            $(doc).find('.hbe-toggle.active').not(this).each(function(){

                                                var $this = $(this);

                                                if ($this.hasClass('active')) {
                                                    $this.parent().find('.close-toggle').addClass('hide').trigger('click');
                                                }

                                            });
                                        }
                                    });
                                });

                    /* Elements
                    ----*/

                        /* et-button
                        ----*/

                            $(doc).find('.et-button').each(function(){

                                var $this  = $(this),
                                    effect = $this.data('effect');

                                var tl = new gsap.timeline({paused: true});

                                switch (effect) {
                                    case 'fill':

                                        var hover       = $this.find('path.hover'),
                                            icon        = $this.find('.icon svg'),
                                            color       = $this.data('color'),
                                            color_hover = $this.data('color-hover');

                                        tl.to(hover,0.6, {
                                          x:0,
                                          ease:"expo.out"
                                        },'+=0.2');

                                        tl.to($this,0.1, {
                                          css:{color:color_hover}
                                        },'-=0.6');

                                        tl.to(icon,0.1, {
                                          css:{fill:color_hover}
                                        },'-=0.1');

                                        tl.add("in");

                                        tl.to(hover,0.6, {
                                          x:'100%',
                                          ease:"expo.out"
                                        },'+=0.2');

                                        tl.to(hover,0, {
                                          x:'-100%',immediateRender:false
                                        });

                                        tl.to($this,0.1, {
                                          css:{color:color}
                                       },'-=0.6');

                                       tl.to(icon,0.1, {
                                         css:{fill:color}
                                       },'-=0.1');

                                       $this.hover(
                                            function(){
                                                tl.progress(0);
                                                tl.tweenTo("in");
                                            },
                                            function(){
                                                tl.play();
                                            }
                                        );

                                    break;

                                    case 'scale':

                                        var back = $this.find('.button-back .regular');

                                        $this.on('mouseover',function(){
                                            gsap.to(back,0.8, {
                                                scale:1.05,
                                                ease:"elastic.out"
                                            });
                                        });

                                        $this.on('mouseout',function(){
                                            gsap.to(back,0.8, {
                                                scale:1,
                                                ease:"expo.out"
                                            });
                                        });

                                    break;

                                    case 'move':

                                        $this.on('mousemove',function(e){

                                            var sxPos =  e.pageX - ($this.width()/2  + $this.offset().left);
                                            var syPos =  e.pageY - ($this.height()/2 + $this.offset().top);

                                            gsap.to( $this, 0.4, { 
                                                x: Math.round(0.1 * sxPos), 
                                                y: Math.round(0.5 * syPos), 
                                            });

                                        });

                                        $this.on('mouseleave',function(){
                                            gsap.to( $this, 0.4, { 
                                                x: 0, 
                                                y: 0, 
                                            });
                                        });

                                    break;

                                    case 'click':

                                        var regular       = $this.find('.regular'),
                                            morphPath     = regular.data('hover'),
                                            morphOriginal = regular.attr('d'),
                                            shapeIndex    = ($this.hasClass('rounded')) ? 8 : 6;

                                        $this.on('mousedown touchstart',function(){
                                            gsap.to(regular,0.6, {
                                                morphSVG:{shape: morphPath, shapeIndex: shapeIndex},
                                                ease:'elastic.out'
                                            });
                                        });

                                        $this.on('mouseup mouseleave touchend',function(){
                                            gsap.to(regular,0.6, {
                                                morphSVG:{shape: morphOriginal, shapeIndex: shapeIndex},
                                                ease:'elastic.out'
                                            });
                                        });

                                    break;
                                }

                                if ($this.hasClass('click-smooth') && $this.hasClass('modal-false')) {
                                    $this.on('click',function(){
                                        gsap.to(win, {
                                            duration: 1, 
                                            scrollTo: {y:$this.attr('href')},
                                            ease:Power3.easeOut 
                                        });
                                        return false;
                                    });
                                }

                                if ($this.hasClass('wpb_animate_when_almost_visible')) {

                                    var delay = $(this).data('animation_delay');

                                    $this.waypoint({
                                        handler: function(direction) {

                                            setTimeout(function(){
                                                $(this.element)
                                                .addClass('wpb_start_animation')
                                                .addClass('animated');
                                            },delay);

                                            this.destroy();

                                        },
                                        offset: '25%',
                                    });

                                }

                            });

                        /* et-icon
                        ----*/

                            $(doc).find('.click-true .hicon, .et-icon.click-true').each(function(){

                                var $this         = $(this),
                                    iconBack      = $this.find('.icon-back path'),
                                    morphPath     = iconBack.data('hover'),
                                    morphOriginal = iconBack.attr('d'),
                                    shapeIndex    = 8;

                                $this.on('mousedown touchstart',function(){
                                    gsap.to(iconBack,0.6, {
                                      morphSVG:{shape: morphPath, shapeIndex: shapeIndex},
                                      ease:'elastic.out'
                                    });
                                });

                                $this.on('mouseup mouseleave touchend',function(){
                                    gsap.to(iconBack,0.6, {
                                        morphSVG:{shape: morphOriginal, shapeIndex: shapeIndex},
                                        ease:'elastic.out'
                                    });
                                });

                            });

                        /* et-icon-list
                        ----*/

                            $(doc).find('.et-icon-list.animate-true').each(function(){

                                var $this = $(this),
                                    delay = '+='+(0.2 + parseInt($this.data('delay'))/1000);

                                var tl = new gsap.timeline({paused: true});

                                tl.from($this.find('li'),{
                                    duration: 0.8,
                                    x:-50,
                                    force3D:true,
                                    opacity:0,
                                    stagger: 0.1,
                                    ease:"expo.out"
                                },delay);

                                $this.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: 'bottom-in-view',
                                    context: win
                                });

                            });

                        /* et-heading
                        ----*/

                            $(doc).find('.et-heading.animate-true').each(function(){

                                var $this = $(this),
                                    delay = '+='+(parseInt(0.2 + $this.data('delay'))/1000),
                                    text  = $this.find('.text');

                                var tl = new gsap.timeline({paused: true});

                                if ($this.hasClass('curtain')) {

                                    var curtain = $this.find('.curtain');

                                    tl.to(curtain,0.8, {
                                      scaleX:1,
                                      transformOrigin:'left top',
                                      ease:"power3.out"
                                    },delay);

                                    tl.to(curtain,0.8, {
                                      scaleX:0,
                                      transformOrigin:'right top',
                                      ease:"power3.out"
                                    });

                                    tl.from(text,0.2, {
                                      opacity:0,
                                    },'-=0.8');
                                }

                                if ($this.hasClass('letter')) {
                                    var letterText = new SplitText($this.find('.text'),{type:"chars"});

                                    gsap.set($this,{perspective:500});

                                    tl.from(letterText.chars,{
                                        duration: 0.4,
                                    },delay);

                                    tl.from(letterText.chars,{
                                        duration: 0.8,
                                        opacity:0,
                                        scale:3,
                                        x:50,
                                        y:50,
                                        force3D:true,
                                        stagger: 0.01,
                                        ease:"expo.out"
                                    },'-=0.6');

                                }

                                if ($this.hasClass('words')) {

                                    var wordsText = new SplitText($this.find('.text'),{type:"words"});
                                    
                                    gsap.set($this,{perspective:500});

                                    tl.from(wordsText.words,{
                                        duration: 0.4,
                                    },delay);

                                    tl.from(wordsText.words,{
                                        duration: 0.8,
                                        opacity:0,
                                        scaleY:2,
                                        transformOrigin:'left top',
                                        y:24,
                                        force3D:true,
                                        stagger: 0.04,
                                        ease:"expo.out"
                                    },'-=0.6');

                                }

                                if ($this.hasClass('rows')) {
                                    
                                    var rowsText = new SplitText($this.find('.text'),{type:"lines"});
                                    
                                    gsap.set($this,{perspective:1000});

                                    tl.from(rowsText.lines,{
                                        duration: 0.4,
                                    },delay);

                                    tl.from(rowsText.lines,{
                                        duration: 1.2,
                                        opacity:0,
                                        rotationX:8,
                                        rotationY:-50,
                                        rotationZ:8,
                                        y:50,
                                        x:-50,
                                        z:50,
                                        transformOrigin:'left top',
                                        force3D:true,
                                        stagger: 0.08,
                                        ease:"expo.out"
                                    },'-=0.5');

                                }

                                $this.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: 'bottom-in-view',
                                    context: win
                                });

                            });
                        
                        /* et-blockquote
                        ----*/

                            $(doc).find('.et-blockquote').each(function(){

                                var $this = $(this);

                                var tl = new gsap.timeline({paused: true});

                                tl.from($this,{
                                    duration: 0.4,
                                    opacity:0,
                                },'+=0.2');

                                tl.from($this.find('.author-wrapper > *'),{
                                    duration: 0.4,
                                },'-=0.2');

                                tl.from($this.find('.author-wrapper > *'),{
                                    duration: 0.8,
                                    opacity:0,
                                    x:-32,
                                    force3D:true,
                                    stagger: 0.05,
                                    ease:"expo.out"
                                },'-=0.4');

                                $this.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: 'bottom-in-view',
                                    context: win
                                });

                            });

                        /* et-accordion
                        ----*/

                            $(doc).find('.et-accordion').each(function(){

                                var $this = $(this);

                                gsap.set($this.find('.toggle-title.active').next(),{
                                    opacity: 1,
                                    height: 'auto'
                                });

                                $this.find('.toggle-title').on('click', function(){

                                    var $self = $(this);

                                        if(!$self.hasClass('active')){
                                            if($this.hasClass('collapsible-true')){

                                                $self.addClass("active");
                                                $this.find('.toggle-title').not($self).removeClass("active")

                                                gsap.to($self.next(),0.6, {
                                                    height:'auto',
                                                    ease:"expo.out"
                                                });

                                                gsap.to($self.next(),0.2, {
                                                    opacity:1,
                                                });

                                                gsap.to($this.find('.toggle-content').not($self.next()),0.1, {
                                                    opacity:0,
                                                });

                                                gsap.to($this.find('.toggle-content').not($self.next()),0.6, {
                                                    height:0,
                                                    ease:"expo.out"
                                                });

                                            } else {
                                                $self.addClass("active");

                                                gsap.to($self.next(),0.6, {
                                                    height:'auto',
                                                    ease:"expo.out"
                                                });

                                                gsap.to($self.next(),0.2, {
                                                    opacity:1,
                                                });

                                            }
                                        } else {
                                            if(!$this.hasClass('collapsible-true')){
                                                $self.removeClass("active");

                                                gsap.to($self.next(),0.1, {
                                                    opacity:0,
                                                });

                                                gsap.to($self.next(),0.6, {
                                                    height:0,
                                                    ease:"expo.out"
                                                });
                                            }
                                        }

                                });

                            });

                        /* et-tab
                        ----*/

                            $(doc).find('.et-tab').each(function(){

                                var $this    = $(this),
                                    tabs     = $this.find('.tab'),
                                    tabsQ    = tabs.length,
                                    tabsDefaultWidth  = 0,
                                    tabsDefaultHeight = 0,
                                    tabsContent = $this.find('.tab-content');

                                tabs.wrapAll('<div class="tabset et-clearfix"></div>');
                                tabsContent.wrapAll('<div class="tabs-container et-clearfix"></div>');

                                var tabSet = $this.find('.tabset');

                                    if(!tabs.hasClass('active')){
                                        tabs.first().addClass('active');
                                    }
                                    
                                    tabs.each(function(){

                                        var $thiz = $(this);

                                        if ($thiz.hasClass('active')) {
                                            $thiz.siblings()
                                            .removeClass("active");
                                            tabsContent.hide(0).removeClass('active');
                                            tabsContent.eq($thiz.index()).show(0).addClass('active');
                                        }

                                        tabsDefaultWidth += $(this).outerWidth();
                                        tabsDefaultHeight += $(this).outerHeight();
                                    });

                                    if(tabsQ >= 2){

                                        tabs.on('click', function(){
                                            var $self = $(this);
                                            
                                            if(!$self.hasClass("active")){

                                                $self.addClass("active");

                                                $self.siblings()
                                                .removeClass("active");

                                                tabsContent.hide(0).removeClass('active');
                                                tabsContent.eq($self.index()).show(0).addClass('active');
                                            }
                                            
                                        });
                                    }

                                    function OverflowCorrection(){
                                        if(tabsDefaultWidth >= $this.outerWidth()  && $this.hasClass('horizontal')){
                                            $this.addClass('tab-full');
                                        } else {
                                            $this.removeClass('tab-full');
                                        }
                                    }

                                    OverflowCorrection();

                                    $(window).resize(OverflowCorrection);           

                            });

                        /* et-animate-box
                        ----*/

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

                            $(doc).find('.et-animate-box').each(function(){

                                var element   = this,
                                    $this     = $(element),
                                    id        = $this.attr('id'),
                                    delay     = '+='+(0.2 + parseInt($this.data('delay'))/1000),
                                    animation = $this.data('animation'),
                                    offset    = (animation == 'bottom') ? '100%': '70%',
                                    stagger   = $this.data('stagger'),
                                    content   = $this.find('.content').children();

                                animateBoxBack(element);

                                var tl = new gsap.timeline({paused: true});

                                buildAnimateBoxTimeline(tl,$this,delay,animation,stagger,content);

                                $this.waypoint({
                                    handler: function(direction) {

                                        $this.addClass('active');

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: offset,
                                    context: win
                                });

                                $(win).resize(function(){

                                    setTimeout(function(){

                                        element = doc.getElementById(id);

                                        $this = $(element);

                                        animateBoxBack(element);

                                        if (!$this.hasClass('active')) {

                                            var startC = $this.find('.box-back path').attr('data-dclone');
                                            $this.find('.box-back path').attr('d',startC);

                                            tl.seek('end').kill();

                                            tl = new gsap.timeline({paused: true});

                                            buildAnimateBoxTimeline(tl,$this,delay,animation,stagger,content);

                                            $this.waypoint({
                                                handler: function(direction) {

                                                    tl.progress(0);
                                                    tl.play();

                                                    this.destroy();

                                                },
                                                offset: offset,
                                                context: win
                                            });

                                        }

                                    },50);

                                });

                            });

                        /* et-stagger-box
                        ----*/

                            function buildStaggerBoxTimeline(tl,delay,interval,stagger,content){

                                switch(stagger){

                                    case "left":

                                        tl.from(content,{
                                            duration: 0.8,
                                            x:-50,
                                            stagger: interval,
                                            opacity:0,
                                            ease:"expo.out"
                                        },delay);

                                    break;

                                    case "right":

                                        tl.from(content,{
                                            duration: 0.8,
                                            x:50,
                                            stagger: interval,
                                            opacity:0,
                                            ease:"expo.out"
                                        },delay);

                                    break;

                                    case "top":

                                        tl.from(content,{
                                            duration: 0.8,
                                            y:-50,
                                            stagger: interval,
                                            opacity:0,
                                            ease:"expo.out"
                                        },delay);

                                    break;

                                    case "bottom":

                                        tl.from(content,{
                                            duration: 0.8,
                                            y:50,
                                            stagger: interval,
                                            opacity:0,
                                            ease:"expo.out"
                                        },delay);

                                    break;
                                }

                            }

                            $(doc).find('.et-stagger-box').each(function(){

                                var element   = this,
                                    $this     = $(element),
                                    id        = $this.attr('id'),
                                    delay     = '+='+(0.2 + parseInt($this.data('delay'))/1000),
                                    interval  = parseInt($this.data('interval'))/1000,
                                    stagger   = $this.data('stagger'),
                                    content   = $this.find('.content').children().not('.et-gap');

                                var tl = new gsap.timeline({paused: true});

                                buildStaggerBoxTimeline(tl,delay,interval,stagger,content);

                                $this.waypoint({
                                    handler: function(direction) {

                                        $this.addClass('active');

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: '70%',
                                    context: win
                                });

                            });

                        /* et-content-box
                        ----*/

                            $(doc).find('.et-icon-box-container').each(function(){

                                var $this            = $(this),
                                    animation        = $this.data('animation'),
                                    stagger          = $this.data('content-animation');

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

                                        box.waypoint({
                                            handler: function(direction) {

                                                tl.progress(0);
                                                tl.play();

                                                this.destroy();

                                            },
                                            offset: 'bottom-in-view',
                                            context: win
                                        });

                                   

                                    });

                                }

                            });

                            $(doc).find('.et-icon-box').each(function(){

                                var $this  = $(this),
                                    effect = $this.data('effect');

                                if (effect == "scale") {

                                    var back = $this.find('.et-icon .icon-back');

                                    $this.on('mouseover',function(){
                                        gsap.to(back,0.8, {
                                            scale:1.2,
                                            ease:"elastic.out"
                                        });
                                    });

                                    $this.on('mouseout',function(){
                                        gsap.to(back,0.8, {
                                            scale:1,
                                            ease:"expo.out"
                                        });
                                    });

                                } else if(effect == "transform"){

                                    $this.on('mouseover',function(){
                                        gsap.to($this,0.4, {
                                            y:-24,
                                            ease:"expo.out"
                                        });
                                    });

                                    $this.on('mouseout',function(){
                                        gsap.to($this,0.4, {
                                            y:0,
                                            ease:"expo.out"
                                        });
                                    });

                                }

                            });

                        /* et-step-box
                        ----*/

                            $(doc).find('.et-step-box').each(function(){

                                var $this = $(this),
                                    delay = (0.2 + $this.parent().index()*0.05);

                                $this.find('.step-count').text('0.'+($this.parent().index()+1));

                                var tl = new gsap.timeline({paused: true});

                                tl.from($this,{
                                    duration:0.8,
                                    delay:delay,
                                    opacity:0,
                                    x:20,
                                    y:40,
                                    ease:"expo.out"
                                });

                                $this.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: 'bottom-in-view',
                                    context: win
                                });

                            });
                        
                        /* et-pricing-table
                        ----*/

                            $(doc).find('.et-pricing-table').each(function(){

                                var $this = $(this);

                                var tl = new gsap.timeline({paused: true});

                                tl.from($this.find('.in'),{
                                    duration: 1.2,
                                    y:50,
                                    stagger: 0.03,
                                    opacity:0,
                                    ease:"expo.out"
                                },'+=0.2');

                                $this.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: '50%',
                                    context: win
                                });

                            });
                
                        /* et-testimonials
                        ----*/

                            $(doc).find('.et-testimonial-container').each(function(){

                                if ($(this).data('columns') == 1) {

                                    var $this = $(this).find('.tns-slide-active');

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

                                    $this.waypoint({
                                        handler: function(direction) {

                                            tl.progress(0);
                                            tl.play();

                                            this.destroy();

                                        },
                                        offset: 'bottom-in-view',
                                        context: win
                                    });

                                }

                            });

                        /* et-client
                        ----*/

                            $(doc).find('.et-client').each(function(){

                                var $this   = $(this),
                                    delay   = (0.2 + $this.parent().index()*0.01);

                                if ($this.parents().hasClass('grid')) {

                                    var tl = new gsap.timeline({paused: true});

                                    tl.from($this.find('.client-inner'),{
                                        duration:1.6,
                                        delay:delay,
                                        opacity:0,
                                        y:50,
                                        scaleY:1.5,
                                        transformOrigin:'left top',
                                        force3D:true,
                                        ease:"expo.out"
                                    });

                                    $this.waypoint({
                                        handler: function(direction) {

                                            tl.progress(0);
                                            tl.play();

                                            this.destroy();

                                        },
                                        offset: 'bottom-in-view',
                                        context: win
                                    });

                                }

                            });

                        /* et-person
                        ----*/

                            $(doc).find('.et-person').each(function(){

                                var $this = $(this);

                                var tl = new gsap.timeline({paused: true});

                                tl.from($this,{
                                    duration: 0.2,
                                    opacity:0,
                                },'+=0.2');

                                tl.from($this.find('.in'),{
                                    duration: 1.2,
                                    y:50,
                                    stagger: 0.05,
                                    opacity:0,
                                    ease:"expo.out"
                                },'-=0.3');

                                $this.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: '70%',
                                    context: win
                                });

                            });

                        /* et-tagline
                        ----*/

                            $(doc).find('.et-tagline').each(function(){

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

                                $this.waypoint({
                                    handler: function(direction) {

                                        setTimeout(function(){$this.addClass('active');},200);

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: '70%',
                                    context: win
                                });
                            });

                            boxMove($(doc).find('.et-tagline'));

                        /* et-image
                        ----*/

                            $(doc).find('.et-image').each(function(){

                                var $this = $(this);

                                if ($this.hasClass('animate-true')) {

                                    var delay = '+='+(0.2 + parseInt($this.data('delay'))/1000),
                                        animation = $this.data('animation');

                                    var tl = new gsap.timeline({paused: true});

                                    if (
                                        animation == "curtain-left" || 
                                        animation == "curtain-right" || 
                                        animation == "curtain-top" || 
                                        animation == "curtain-bottom"
                                    ) {

                                        var curtain = $this.find('.curtain');

                                        switch(animation){
                                            case "curtain-left":

                                                tl.to(curtain,0.8, {
                                                  scaleX:1,
                                                  transformOrigin:'left top',
                                                  ease:"power3.out"
                                                },delay);

                                                tl.to(curtain,0.8, {
                                                  scaleX:0,
                                                  transformOrigin:'right top',
                                                  ease:"power3.out"
                                                });

                                            break;

                                            case "curtain-right":

                                                tl.to(curtain,0.8, {
                                                  scaleX:1,
                                                  transformOrigin:'right top',
                                                  ease:"power3.out"
                                                },delay);

                                                tl.to(curtain,0.8, {
                                                  scaleX:0,
                                                  transformOrigin:'left top',
                                                  ease:"power3.out"
                                                });
                                            
                                            break;

                                            case "curtain-top":

                                                tl.to(curtain,0.8, {
                                                  scaleY:1,
                                                  transformOrigin:'left top',
                                                  ease:"power3.out"
                                                },delay);

                                                tl.to(curtain,0.8, {
                                                  scaleY:0,
                                                  transformOrigin:'left bottom',
                                                  ease:"power3.out"
                                                });
                                            
                                            break;

                                            case "curtain-bottom":

                                                tl.to(curtain,0.8, {
                                                  scaleY:1,
                                                  transformOrigin:'left bottom',
                                                  ease:"power3.out"
                                                },delay);

                                                tl.to(curtain,0.8, {
                                                  scaleY:0,
                                                  transformOrigin:'left top',
                                                  ease:"power3.out"
                                                });
                                            
                                            break;
                                        }

                                        tl.from($this.find('img'),0.2, {
                                          opacity:0,
                                        },'-=0.8');
                                    }

                                    if (animation == "fade-blur") {

                                        tl.from($this,{
                                            duration: 0.6,
                                            opacity:0,
                                        },delay);
                                    }

                                    if (animation == "left") {
                                        
                                        tl.from($this,{
                                            duration: 0.8,
                                            opacity:0,
                                            x:-100,
                                            transformOrigin:'left top',
                                            force3D:true,
                                            ease:"expo.out"
                                        },delay);

                                    }

                                    if (animation == "right") {
                                        
                                        tl.from($this,{
                                            duration: 0.8,
                                            opacity:0,
                                            x:100,
                                            transformOrigin:'left top',
                                            force3D:true,
                                            ease:"expo.out"
                                        },delay);

                                    }

                                    if (animation == "top") {
                                        
                                        tl.from($this,{
                                            duration: 0.8,
                                            opacity:0,
                                            y:-100,
                                            transformOrigin:'left top',
                                            force3D:true,
                                            ease:"expo.out"
                                        },delay);

                                    }

                                    if (animation == "bottom") {
                                        
                                        tl.from($this,{
                                            duration: 0.8,
                                            opacity:0,
                                            y:100,
                                            transformOrigin:'left top',
                                            force3D:true,
                                            ease:"expo.out"
                                        },delay);

                                    }

                                    $this.waypoint({
                                        handler: function(direction) {

                                            tl.progress(0);
                                            tl.play();

                                            this.destroy();

                                        },
                                        offset: '70%',
                                        context: win
                                    });

                                }

                                if ($this.hasClass('parallax')) {

                                    var x = $this.data('coordinatex'),
                                        y = $this.data('coordinatey');

                                    $(win).scroll(function(){

                                        var yPos = Math.round((0-$(win).scrollTop()) / $this.data('speed'))  +  y;

                                        gsap.to($this,0.8,{
                                            x:x,
                                            y:yPos,
                                            force3D:true,
                                            ease:"expo.out"
                                        });

                                    });
                                }
                                
                            });

                            function disableParallax(){
                                if ($(win).width() <= 1300) {
                                    $('.et-image.parallax').each(function(){
                                        $(this).addClass('disable-parallax');
                                    });
                                } else {
                                    $('.et-image.parallax').each(function(){
                                        $(this).removeClass('disable-parallax');
                                    });
                                }
                            }

                            disableParallax();
                            $(win).resize(function(){
                                disableParallax();
                            });

                        /* et-counter
                        ----*/

                            $(doc).find('.et-counter').each(function(){

                                var $this    = $(this),
                                    delay    = (0.2 + $this.index()*0.01),
                                    value    = $this.data('value'),
                                    counterV = { var: 0 },
                                    counter  = $this.find('.counter');


                                var tl = new gsap.timeline({paused: true});

                                tl.from($this.find('.in'),{
                                    duration: 0.8,
                                    delay:delay,
                                    opacity:0,
                                    stagger: 0.1,
                                    x:-50,
                                    transformOrigin:'left top',
                                    force3D:true,
                                    ease:"expo.out"
                                });


                                tl.to(counterV,{
                                    var:value,
                                    duration:1,
                                    onUpdate: function () {
                                        counter.html(Math.ceil(counterV.var));
                                    },
                                },'-=0.85');

                                tl.from($this.find('.counter-icon'),{
                                    duration: 0.2,
                                    opacity:0,
                                },'-=0.6');

                                tl.from($this.find('.counter-icon'),{
                                    duration: 1.6,
                                    scale:0.2,
                                    force3D:true,
                                    ease:"elastic.out"
                                },'-=0.6');

                                $this.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: 'bottom-in-view',
                                    context: win
                                });


                            });

                        /* et-progress
                        ----*/

                            $(doc).find('.et-progress').each(function(){

                                var $this    = $(this),
                                    type     = ($this.hasClass('circle')) ? 'circle' : 'default',
                                    delay    = (0.2 + $this.index()*0.01),
                                    value    = $this.data('percentage'),
                                    counterV = { var: 0 },
                                    counter  = $this.find('.percent');

                                var tl = new gsap.timeline({paused: true});

                                if (type == 'default') {

                                    tl.from($this.find('.bar'),{
                                        duration: 1.6,
                                        delay:delay,
                                        scaleX:0,
                                        force3D:true,
                                        transformOrigin:'left top',
                                        ease:"expo.out"
                                    });

                                    tl.from($this.find('.text'),{
                                        duration: 0.8,
                                        opacity:0,
                                        x:50,
                                        transformOrigin:'left top',
                                        force3D:true,
                                        ease:"expo.out"
                                    },'-=1.6');

                                    tl.to(counterV,{
                                        var:value,
                                        duration:1,
                                        onUpdate: function () {
                                            counter.html(Math.ceil(counterV.var));
                                        },
                                    },'-=1.4');

                                } else {

                                    var bar           = this.querySelector('.bar-circle'),
                                        circumference = 27 * 2 * Math.PI,
                                        offset        = circumference - value / 100 * circumference;

                                    bar.style.strokeDasharray = circumference+' '+circumference;
                                    bar.style.strokeDashoffset = circumference;

                                    tl.to(bar,{
                                        duration: 0.2,
                                        delay:delay,
                                        opacity:1
                                    });

                                    tl.to(bar,{
                                        duration: 2,
                                        strokeDashoffset:offset,
                                        ease:"expo.out"
                                    },'-=0.2');

                                    tl.from($this.find('.text').children(),{
                                        duration: 0.8,
                                        opacity:0,
                                        y:50,
                                        stagger:0.1,
                                        transformOrigin:'left top',
                                        force3D:true,
                                        ease:"expo.out"
                                    },'-=2');

                                    tl.to(counterV,{
                                        var:value,
                                        duration:1,
                                        onUpdate: function () {
                                            counter.html(Math.ceil(counterV.var));
                                        },
                                    },'-=2');

                                }

                                $this.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: 'bottom-in-view',
                                    context: win
                                });


                            });
                        
                        /* et-timer
                        ----*/

                            $(doc).find('.et-timer').each(function(){

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

                                    $this.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: 'bottom-in-view',
                                    context: win
                                });

                            });

                        /* et-posts
                        ----*/

                            $(doc).find('.et-shortcode-posts.full').each(function(){

                                var $this = $(this);

                                var images = tns({
                                    container: this.querySelector('.full-images-slides'),
                                    mode:'gallery',
                                    nav:false,
                                    items: 1,
                                    loop:false
                                });
                                var content = tns({
                                    container: this.querySelector('.full-content-slides'),
                                    mode:'gallery',
                                    nav:false,
                                    items: 1,
                                    loop:false
                                });

                                setTimeout(function(){
                                    $this.find('.tns-controls-trigger button').on('click',function(){

                                        var btn = $(this);

                                        $this.find('.full-images .tns-controls button[data-controls="'+btn.attr('data-controls')+'"]').trigger('click');
                                        setTimeout(function(){
                                            $this.find('.full-content .tns-controls button[data-controls="'+btn.attr('data-controls')+'"]').trigger('click');
                                        },400);
                                    });
                                },200);

                                images.events.on('transitionStart', function(){
                                    var info         = images.getInfo(),
                                        indexPrev    = info.indexCached,
                                        indexCurrent = info.index;

                                    var direction = (indexPrev > indexCurrent) ? 'prev' : 'next';

                                    if (direction == "prev") {
                                        $this.find('.full-images-slides').addClass('prev');
                                    } else {
                                        $this.find('.full-images-slides').removeClass('prev');
                                    }
                                    
                                });

                                content.events.on('transitionStart', function(){
                                    var info         = content.getInfo(),
                                        indexPrev    = info.indexCached,
                                        indexCurrent = info.index;

                                    var direction = (indexPrev > indexCurrent) ? 'prev' : 'next';

                                    if (direction == "prev") {
                                        $this.find('.full-content-slides').addClass('prev');
                                    } else {
                                        $this.find('.full-content-slides').removeClass('prev');
                                    }
                                    
                                });

                                $this.waypoint({
                                    handler: function(direction) {

                                        setTimeout(function(){

                                            $this.find('.lazy-img').each(function(){
                                                $(this).attr('src',$(this).data('src')).removeClass('lazy-img');
                                            });

                                            $this.find('img').first().on('load',function(){
                                                $this.find('.full-images-placeholder').fadeOut(function(){
                                                    $(this).remove();
                                                });
                                            });

                                        },400);

                                        this.destroy();

                                    },
                                    offset: 'bottom-in-view',
                                    context: win
                                });

                            });

                        /* et-projects
                        ----*/

                            boxMove($(doc).find('.full .loop-projects > .project'));
                          
                            $(doc).find('.et-shortcode-projects.filter').each(function(){

                                var $this = $(this);

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
                            });

                        /* et-row/et-column
                        ----*/

                            function backgroundScroll(el,speed,direction){
                                var size = (direction == "horizontal") ? el.data('img-width') : el.data('img-height');
                                if (direction == "horizontal") {
                                    el.animate({'background-position-x' :size}, {duration:speed,easing:'linear',complete:function(){el.css('background-position-x','0');backgroundScroll(el, speed,direction);}});
                                } else if (direction == "vertical") {
                                    el.animate({'background-position-y' :size}, {duration:speed,easing:'linear',complete:function(){el.css('background-position-y','0');backgroundScroll(el, speed,direction);}});
                                };
                            }

                            $(doc).find('.vc-parallax').each(function(){
                                var $this = $(this),
                                    plx = $this.find('.parallax-container');
                                
                                if ($this.hasClass('vc-video-parallax')) {
                                    plx = $this.find('.video-container');
                                }

                                var duration = parseInt($this.data('parallax-duration')),
                                    ratio    = (typeof(duration) != 'undefined' && duration != null && duration != 0) ? 0.1 : 1;

                                    duration = duration/100;

                                $(doc).scroll(function() {
                                    var yPos = Math.round(($(doc).scrollTop()-plx.offset().top) / $this.data('parallax-speed'));
                                    yPos = ratio*yPos;
                                    gsap.to(plx,{
                                        duration:duration,
                                        delay:0,
                                        y:yPos,
                                    });
                                });

                            });

                            $(doc).find('.vc-fixed-bg').each(function(){

                                var $this      = $(this), 
                                    fx         = $this.find('.fixed-container'),
                                    $secHeight = $(this).outerHeight(),         
                                    $secWidth  = $(this).outerWidth(),
                                    fxHeight   = ($secHeight > $(window).height()) ? $secHeight : $(window).height();

                                fx.css({'height':fxHeight*1.2+'px'});

                                $(window).resize(function(){
                                    fx.css({'height':fxHeight+100+'px'});
                                });
                            });

                            $(doc).find('.vc-animated-bg').each(function(){

                                var $this         = $(this), 
                                    animatedBg    = $this.find('.animated-container'),
                                    animatedDir   = $this.data('animatedbg-dir'),
                                    animatedSpeed = $this.data('animatedbg-speed');

                                    if (animatedDir == 'horizontal') {
                                        backgroundScroll(animatedBg, animatedSpeed, 'horizontal');
                                    } else if (animatedDir == 'vertical') {
                                        backgroundScroll(animatedBg, animatedSpeed, 'vertical');
                                    };
                            });

                            $(doc).find('.vc-curtain').each(function(){

                                var curtain   = $(this),
                                    row       = curtain.parent(),
                                    content   = (row.find('.container').length) ? row.find('.container') : row.find('.wpb_wrapper'),
                                    animation = curtain.data('curtain'),
                                    delay     = 0.2;

                                var tl = new gsap.timeline({paused: true});

                                if (
                                    animation == "curtain-left" || 
                                    animation == "curtain-right" || 
                                    animation == "curtain-top" || 
                                    animation == "curtain-bottom"
                                ) {

                                    switch(animation){
                                        case "curtain-left":

                                            tl.to(curtain,0.8, {
                                              scaleX:1,
                                              transformOrigin:'left top',
                                              ease:"power3.out"
                                            },delay);

                                        break;

                                        case "curtain-right":

                                            tl.to(curtain,0.8, {
                                              scaleX:1,
                                              transformOrigin:'right top',
                                              ease:"power3.out"
                                            },delay);
                                        
                                        break;

                                        case "curtain-top":

                                            tl.to(curtain,0.8, {
                                              scaleY:1,
                                              transformOrigin:'left top',
                                              ease:"power3.out"
                                            },delay);
                                        
                                        break;

                                        case "curtain-bottom":

                                            tl.to(curtain,0.8, {
                                              scaleY:1,
                                              transformOrigin:'left bottom',
                                              ease:"power3.out"
                                            },delay);

                                        break;
                                    }

                                    tl.from(content,0.2, {
                                      opacity:0,
                                    },'-=0.5');
                                }

                                row.waypoint({
                                    handler: function(direction) {

                                        tl.progress(0);
                                        tl.play();

                                        this.destroy();

                                    },
                                    offset: '70%',
                                    context: win
                                });

                            });

                        /* et-info-presentation
                        ----*/

                            $(doc).find('.et-info-present').each(function(){

                                var $this  = $(this);

                                var slider = tns({
                                    container: this.querySelector('.slides'),
                                    autoplay:$this.data('autoplay'),
                                    mode:'gallery',
                                    nav:true,
                                    controls:false,
                                    items: 1,
                                });

                            });

                        /* instagram widget
                        ----*/

                            $(doc).find('.instagram-image-list').each(function(){

                                var $this    = $(this),
                                    username = $this.data('username'),
                                    limit    = $this.data('limit');

                                $this.instastory({
                                    get: username,
                                    imageSize: '320',
                                    limit: limit,
                                    link: true,
                                    template: '<li class="post-media"><a target="_blank" class="image-container" href="{{link}}"><img width="150" height="150" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{image}}" alt="{{accessibility_caption}}"><svg class="placeholder" viewBox="0 0 20 4"><circle cx="2" cy="2" r="2" /><circle cx="10" cy="2" r="2" /><circle cx="18" cy="2" r="2" /></svg></a></li>'
                                });

                                setTimeout(function(){
                                    $this.find('img.lazy').each(function(){
                                        var lazyImg = $(this);
                                        lazyImg.attr('src',lazyImg.data('src')).removeClass('lazy');
                                        lazyImg.parent().addClass('loaded').removeClass('lazy-inline-image');
                                        lazyImg.parent().find('svg').remove();
                                    });
                                },4000);
                            });

                            $(doc).find('.et-instagram').each(function(){

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
                
                },1);
                     
            });

            /* Front-end save
            ----*/

                $( document ).ajaxComplete(function( event, xhr, settings ) {

                    if (settings['type'] != 'POST') {return;}

                    var data = settings['data'];

                    data = data.split("&");

                    var dataObj = [{}];

                    for (var i = 0; i < data.length; i++) {
                        var property = data[i].split("=");
                        dataObj[property[0]] = property[1];
                    }

                    if (dataObj['action'] == "vc_save") {

                        var url  = settings['url'];

                        $.ajax({
                            type: 'POST',
                            url:url,
                            data:{
                                action:'et_vc_save',
                                post_id :dataObj['post_id'],
                                content :dataObj['content'],
                            }
                        })
                        .fail(function(data) {
                            console.log("Ajax error");
                        });

                        return;
                    }

                });

        }

    })(jQuery);

/* Megamenu
----*/

    (function($){

        "use strict";

        var mmo = $('.megamenu-options');

        mmo.each(function(){

            var $this = $(this),
                mms   = $this.find('.mms select'),
                mmc   = $this.find('.mmc');

            if ( mms.val() == "true") {
                mmc.show();
            }

            mms.on("change",function(){
                if ($(this).val() == "false") {
                    mmc.hide();
                } else {
                    mmc.show();
                }
            });

        });

        function megamenuToggle(selected){
            if ( selected == 100) {
                $('.megamenu-toggle').hide(0);
            } else {
                $('.megamenu-toggle').show(0);
            }
        }

        var selected = $('select[name="enovathemes_addons_megamenu_width"] option:selected').val();
        megamenuToggle(selected);

        $('select[name="enovathemes_addons_megamenu_width"]').on("change",function(){
            selected = $(this).val();
            megamenuToggle(selected);
        });

        function megamenuFormStyles(formChecked){
            if (formChecked) {
                $('.custom-form-styling').show(0);
            } else {
                $('.custom-form-styling').hide(0);
            }
        }

        function megamenuWidgetStyles(widgetChecked){
            if (widgetChecked) {
                $('.custom-widget-styling').show(0);
            } else {
                $('.custom-widget-styling').hide(0);
            }
        }

        var formChecked = ($('input[name="enovathemes_addons_custom_form_styling"]')).is(':checked') ? true : false;

        megamenuFormStyles(formChecked);
        $('input[name="enovathemes_addons_custom_form_styling"]').on("change",function(){
            formChecked = (this.checked) ? true: false;
            megamenuFormStyles(formChecked);
        });

        var widgetChecked = ($('input[name="enovathemes_addons_custom_widget_styling"]')).is(':checked') ? true : false;
        megamenuWidgetStyles(widgetChecked);
        $('input[name="enovathemes_addons_custom_widget_styling"]').on("change",function(){
            widgetChecked = (this.checked) ? true: false;
            megamenuWidgetStyles(widgetChecked);
        });

    })(jQuery);

/* Colorpicker
----*/

    (function( $ ) {

        "use strict";

        $(function() {
            $('.enovathemes-color-picker').wpColorPicker();
        });

    })( jQuery );

/* Projects
----*/

    (function($){

        "use strict";

        function projectLayoutSwitch($layout){

            if ($layout == "custom") {
                $('.project-data').hide(0);
            } else
            if($layout == "sidebar"){
                $('.sidebar-off').hide(0).siblings().show(0);
            } else {
                $('.project-data').show(0);
            }
        }

        function projectFormatSwitch($format,$layout){

            if ($format == "gallery") {
                $('.gallery-format').show(0);
                $('.format-data:not(.gallery-format)').hide(0);
            }else
            if ($format == "audio") {
                $('.audio-format').show(0);
                $('.format-data:not(.audio-format)').hide(0);
            }else
            if ($format == "video") {
                $('.video-format').show(0);
                $('.format-data:not(.video-format)').hide(0);
            }

            if ($layout == 'sidebar') {
                $('.sidebar-off').hide(0);
            }
        }

        function galleryTypeSwitch($type,$layout){

            if ($type == "carousel_thumb") {
                $('.carousel-thumbnail-off').hide(0);
            } else {
                $('.carousel-thumbnail-off').show(0);
            }

            if ($layout == 'sidebar') {
                $('.sidebar-off').hide(0);
            }

        }

        var $format = $('.cmb2-id-enovathemes-addons-project-format input[type="radio"]:checked').val();
        var $type   = $('.cmb2-id-enovathemes-addons-gallery-type select[name="enovathemes_addons_gallery_type"]').val();
        var $layout = $('.cmb2-id-enovathemes-addons-project-layout input[type="radio"]:checked').val();

        projectLayoutSwitch($layout);
        projectFormatSwitch($format,$layout);
        galleryTypeSwitch($type,$layout);

        // On change

        $('.cmb2-id-enovathemes-addons-gallery-type select[name="enovathemes_addons_gallery_type"]').on('change', function(){

            $type   = $(this).val();
            $layout = $('.cmb2-id-enovathemes-addons-project-layout input[type="radio"]:checked').val();
            $format = $('.cmb2-id-enovathemes-addons-project-format input[type="radio"]:checked').val();

            galleryTypeSwitch($type,$layout);
        });

        $('.cmb2-id-enovathemes-addons-project-format input[type="radio"]').each(function(){
            $(this).on('click', function(){

                $format = $(this).val();
                $layout = $('.cmb2-id-enovathemes-addons-project-layout input[type="radio"]:checked').val();
                $type   = $('.cmb2-id-enovathemes-addons-gallery-type select[name="enovathemes_addons_gallery_type"]').val();

                projectFormatSwitch($format,$layout);
                if ($type == "carousel_thumb") {galleryTypeSwitch($type,$layout);}

            });
        });

        $('.cmb2-id-enovathemes-addons-project-layout input[type="radio"]').each(function(){
            $(this).on('click', function(){

                $layout = $(this).val();
                $type   = $('.cmb2-id-enovathemes-addons-gallery-type select[name="enovathemes_addons_gallery_type"]').val();
                $format = $('.cmb2-id-enovathemes-addons-project-format input[type="radio"]:checked').val();

                projectLayoutSwitch($layout);
                projectFormatSwitch($format,$layout);

                if ($layout == "custom") {
                    $('.project-data').hide(0);
                }

            });
        });

    })(jQuery);

/* Posts
----*/

    (function($){

        "use strict";

        function formatSwitch($value){
            if ($value == "link") {
                $('#_enovathemes_addons_post_options_metabox').show(0);
                $('.link-format').show(0);
                $('.post-data:not(.link-format)').hide(0);
            }else
            if ($value == "status") {
                $('#_enovathemes_addons_post_options_metabox').show(0);
                $('.status-format').show(0);
                $('.post-data:not(.status-format)').hide(0);
            }else
            if ($value == "quote") {
                $('#_enovathemes_addons_post_options_metabox').show(0);
                $('.quote-format').show(0);
                $('.post-data:not(.quote-format)').hide(0);
            }else
            if ($value == "gallery") {
                $('#_enovathemes_addons_post_options_metabox').show(0);
                $('.gallery-format').show(0);
                $('.post-data:not(.gallery-format)').hide(0);
            }else
            if ($value == "audio") {
                $('#_enovathemes_addons_post_options_metabox').show(0);
                $('.audio-format').show(0);
                $('.post-data:not(.audio-format)').hide(0);
            }else
            if ($value == "video") {
                $('#_enovathemes_addons_post_options_metabox').show(0);
                $('.video-format').show(0);
                $('.post-data:not(.video-format)').hide(0);
            }else {
                $('.post-data').hide(0);
                $('#_enovathemes_addons_post_options_metabox').hide(0);
            }
        }

        $('#formatdiv input[type="radio"]').each(function(){
            var $this = $(this);

            $this.on('click', function(){
                formatSwitch($this.val());
            });

            if($this.is(":checked")){
                formatSwitch($this.val());
            }
        });

    })(jQuery);

/* Header options
----*/

    (function($){

        "use strict";

        function toggleHeader(selected){
            switch(selected){
                case "sidebar":
                    $('.sidebar-off').hide(0);
                    $('.sidebar-on').show(0);
                break;
                case "desktop":
                    $('.sidebar-on').hide(0);
                    $('.sidebar-off').show(0);
                    $('.desktop-on').show(0);
                break;
                case "mobile":
                    $('.sidebar-off').show(0);
                    $('.sidebar-on').hide(0);
                    $('.desktop-on').hide(0);
                break;
            }
        }

        var selected = $('#enovathemes_addons_header_options_metabox select[name="enovathemes_addons_header_type"] option:selected').val();

        toggleHeader(selected)

        $('#enovathemes_addons_header_options_metabox select[name="enovathemes_addons_header_type"]').on('change', function(){

            selected = $(this).find("option:selected").val();

            toggleHeader(selected)

        });

        if ($('#enovathemes_addons_header_options_metabox select[name="enovathemes_addons_header_type"] option:selected').val() == 'desktop' || $('#enovathemes_addons_header_options_metabox select[name="enovathemes_addons_header_type"] option:selected').val() == 'sidebar') {
            $('#enovathemes_addons_header_options_metabox input[name="enovathemes_addons_desktop"]').attr('checked','checked');
        }

        if ($('#enovathemes_addons_header_options_metabox select[name="enovathemes_addons_header_type"] option:selected').val() == 'mobile') {
            $('#enovathemes_addons_header_options_metabox input[name="enovathemes_addons_desktop"]').removeAttr('checked','');
        }

        $('#enovathemes_addons_header_options_metabox select[name="enovathemes_addons_header_type"]').on('change',function(){
            if ($(this).val() == 'mobile') {
                $('#enovathemes_addons_header_options_metabox input[name="enovathemes_addons_desktop"]').removeAttr('checked','');
            } else
            if ($(this).val() == 'desktop' || $(this).val() == 'sidebar') {
                $('#enovathemes_addons_header_options_metabox input[name="enovathemes_addons_desktop"]').attr('checked','checked');
            }
        });

    })(jQuery);