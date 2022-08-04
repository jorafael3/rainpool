/* Cursor color change
----*/
	
	jQuery.fn.cursorColor = function() {

        if (jQuery('body').hasClass('cursor-active')) {

        	var color 	    = jQuery(this).data('color'),
        		cursorColor = jQuery('.cursor').data('color');

        	if (color === cursorColor) {

        		jQuery(this).on('mouseover',function(){
        			jQuery('.cursor').css('background-color','#ffffff');
        			jQuery('.cursor-follower').css({
        				'background-color':'#ffffff',
        				'opacity':'0.2'
        			});
        		});

        		jQuery(this).on('mouseleave',function(){
        			jQuery('.cursor').css('background-color',color);
        			jQuery('.cursor-follower').css({
        				'background-color':color,
        				'opacity':'0.2'
        			});
        		});

        	}

        }
        
    };

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

/* Inview
----*/
	
	jQuery.fn.inView = function(win,observe) {

        var observe  = (observe) ? observe : 0.6,
            win      = (win) ? win : window,
        	height 	 = jQuery(this).outerHeight(),
            scrolled = jQuery(win).scrollTop(),
            viewed   = scrolled + jQuery(win).height(),
            top 	 = jQuery(this).offset().top,
            bottom   = top + height;
        return (top + height * observe) <= viewed && (bottom - height * observe) >= scrolled;
        
    };

/* Lazy loading
----*/

	function lazyLoad(container){

		let lazyImages = [].slice.call(container.querySelectorAll("img.lazy"));
		let lazyBack   = [].slice.call(container.querySelectorAll(".lazy-back"));
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

			let lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
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

		} else {

			let active = false;

			const lazyLoad = function() {
				if (active === false) {

				  	active = true;

					setTimeout(function() {

						lazyImages.forEach(function(lazyImage) {

							if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {

								lazyImage.src = lazyImage.dataset.src;

								lazyImage.onload = function() {
								    lazyImage.classList.remove("lazy");
								    lazyImage.parentElement.classList.add("loaded");
								    lazyImages = lazyImages.filter(function(image) {
										return image !== lazyImage;
									});
								};

								if (lazyImages.length === 0) {
									document.removeEventListener("scroll", lazyLoad);
									window.removeEventListener("resize", lazyLoad);
									window.removeEventListener("orientationchange", lazyLoad);
								}
							}
						});

						lazyVideos.forEach(function(lazyVideo) {

							if ((lazyVideo.getBoundingClientRect().top <= window.innerHeight && lazyVideo.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyVideo).display !== "none") {

								for (var source in lazyVideo.children) {
									var videoSource = lazyVideo.children[source];
									if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
										videoSource.src = videoSource.dataset.src;
									}
								}

								if (lazyVideos.length === 0) {
									document.removeEventListener("scroll", lazyLoad);
									window.removeEventListener("resize", lazyLoad);
									window.removeEventListener("orientationchange", lazyLoad);
								}
							}
						});

						active = false;

					}, 200);
				}
			};

			document.addEventListener("scroll", lazyLoad);
			window.addEventListener("resize", lazyLoad);
			window.addEventListener("orientationchange", lazyLoad);

		}

	}

	document.addEventListener("DOMContentLoaded", lazyLoad(document));

/* Custom cursor
----*/

	function animateCursor(){
		if (jQuery(window).width() >= 1280) {
			if (jQuery('body').hasClass('cursor-active')) {

				jQuery('body').addClass('cursor-animated');

				var cursor   = jQuery(".cursor").addClass('visible'),
					follower = jQuery(".cursor-follower").addClass('visible');

				var posX = 0,
					posY = 0;

				var mouseX = 0,
					mouseY = 0;

				gsap.to({}, 0.01, {
				  repeat: -1,
				  onRepeat: function() {
					posX += (mouseX - posX) / 9;
					posY += (mouseY - posY) / 9;

					gsap.set(follower, {
						css: {
							left: posX - 12,
							top: posY - 12
						}
					});

					gsap.set(cursor, {
						css: {
							left: mouseX,
							top: mouseY
						}
					});
				  }
				});

				jQuery(document).on("mousemove", function(e) {
					mouseX = e.pageX;
					mouseY = e.pageY;
				});

				setTimeout(function(){

					jQuery(".mi-link, .hbe-toggle, .close-toggle, a, button, .flex-control-nav li, .toggle-title, .tab").on("mouseenter", function() {
						cursor.addClass("active");
						follower.addClass("active");
					});
					jQuery(".mi-link, .hbe-toggle, .close-toggle, a, button, .flex-control-nav li, .toggle-title, .tab").on("mouseleave", function() {
						cursor.removeClass("active");
						follower.removeClass("active");
					});

					jQuery("input:not('submit')").on("mouseenter", function() {
						cursor.removeClass("active");
						follower.removeClass("active");
						cursor.addClass("hidden");
						follower.addClass("hidden");
					});
					jQuery("input:not('submit')").on("mouseleave", function() {
						cursor.removeClass("active");
						follower.removeClass("active");
						cursor.removeClass("hidden");
						follower.removeClass("hidden");
					});

				},200);

			}
		}
	}

/* Gsap lightbox
----*/

	function lightImage(src,overlay){

		if (
			src.includes('.jpg') ||
			src.includes('.jpeg') ||
			src.includes('.png') ||
			src.includes('.bmp') ||
			src.includes('.gif') ||
			src.includes('.svg')
		) {
			
			var img = document.createElement('img');
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
			
		} else if (src.includes('youtu') || src.includes('vimeo')) {
			var iframe = document.createElement('iframe');

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
		} else if (src.includes('mp4') || src.includes('webm') || src.includes('ogv')) {
			var video = document.createElement('video');
			video.src = src;
			video.autoplay = true;
			video.controls = true;
			overlay.prepend(video);
		}
	}

	function gsapLightbox(element,gallery){

		var href = element.attr('href');

	  	if (
			href.includes('.jpg') ||
			href.includes('.jpeg') ||
			href.includes('.png') ||
			href.includes('.bmp') ||
			href.includes('.gif') ||
			href.includes('.svg') ||
			href.includes('youtu') ||
			href.includes('mp4') ||
			href.includes('webm') ||
			href.includes('ogv')
		){

			var structure = (gallery == true) ? 
			jQuery('<div class="gsap-lightbox-overlay"><div class="image-wrapper"></div><a href="#" class="gsap-lightbox-controls gsap-lightbox-toggle"></a><a href="#" class="gsap-lightbox-controls gsap-lightbox-nav prev" data-direction="prev"></a><a href="#" class="gsap-lightbox-controls gsap-lightbox-nav next" data-direction="next"></a><svg class="placeholder" viewBox="0 0 20 4"><circle cx="2" cy="2" r="2" /><circle cx="10" cy="2" r="2" /><circle cx="18" cy="2" r="2" /></svg></div>') :
			jQuery('<div class="gsap-lightbox-overlay"><div class="image-wrapper"></div><a href="#" class="gsap-lightbox-controls gsap-lightbox-toggle"></a><svg class="placeholder" viewBox="0 0 20 4"><circle cx="2" cy="2" r="2" /><circle cx="10" cy="2" r="2" /><circle cx="18" cy="2" r="2" /></svg></div>');

			jQuery('body').append(structure);

			animateCursor();

			var overlay = jQuery('.gsap-lightbox-overlay'),
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

				var nav  	    = overlay.find('.gsap-lightbox-nav'),
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

				jQuery('a[data-gallery="'+galleryName+'"]').each(function(){
					gallerySet.push(jQuery(this).attr('href'));
				});

				if (!gallerySet.length) {
					jQuery('a').each(function(){
						gallerySet.push(jQuery(this).attr('href'));
					});
				}

				count = gallerySet.indexOf(element.attr('href'));

				var max = gallerySet.length;

				if (max == 1) {
					jQuery('.gsap-lightbox-overlay .gsap-lightbox-nav').remove();
				}
				
				nav.on('click',function(e){

					overlay.find('img').remove();

					e.preventDefault();

					count += (jQuery(this).data('direction') == "next") ? 1 : -1;
					if (count < 0) {count = max - 1;}
					if (count >= max) {count = 0;}

					lightImage(gallerySet[count],wrapper);
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

				lightImage(element.attr('href'),wrapper);

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
	}

/* Video trigger
----*/

	function videoTrigger(){
		jQuery('.video-btn').each(function(){

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

	videoTrigger();

/* GSAP config
----*/
	
	gsap.config({ nullTargetWarn:false});
	gsap.registerPlugin(ScrollToPlugin);

/* General
----*/

	(function($){

		"use strict";

		/* Custom cursor
		----*/

			animateCursor();

			$(window).on('resize',function(){
				if ($(window).width() < 1280) {
					$(".cursor").removeClass('visible'),
					$(".cursor-follower").removeClass('visible');
				} else {

					if ($('body').hasClass('cursor-animated')) {
						$(".cursor").addClass('visible'),
						$(".cursor-follower").addClass('visible');
					} else {
						animateCursor();
					}
				}
			});

		/* WPML Language switcher
		----*/

			$('.widget_icl_lang_sel_widget .wpml-ls-current-language > a')
			.append('<span class="toggle"></span>');

			$('.wpml-ls-legacy-dropdown-click a > span.toggle').on('click',function(e){
				$(this).parent().toggleClass('active');
				if ($(this).parent().next('ul').length != 0) {
					$(this).parent().toggleClass('animate');
					$(this).parent().next('ul').stop().slideToggle(300);
				};
				e.preventDefault();
			});

			$('.wpml-ls-legacy-dropdown .wpml-ls-current-language').hover(
				function(){
					$(this).toggleClass('active');
					if ($(this).find('ul').length != 0) {
						$(this).toggleClass('animate');
						$(this).find('ul').stop().slideToggle(300);
					};
				},
				function(){
					$(this).toggleClass('active');
					if ($(this).find('ul').length != 0) {
						$(this).toggleClass('animate');
						$(this).find('ul').stop().slideToggle(300);
					};
				}
			);

		/* Widget navigation
		----*/

			$('.widget_nav_menu').each(function(){

				var $this = $(this);
				var childItems = $this.find('.menu-item-has-children > a')
				.append('<span class="toggle"></span>');

				if ($this.find('.menu-item-has-children > a').attr( "href" ) == "#") {
					$this.find('.menu-item-has-children > a').on('click',function(e){
						$(this).toggleClass('active');
						if ($(this).next('ul').length != 0) {
							$(this).toggleClass('animate');
							$(this).next('ul').stop().slideToggle(300);
						};
						e.preventDefault();
					});
				} else {
					$this.find('.menu-item-has-children > a > span.toggle').on('click',function(e){
						e.stopImmediatePropagation();
						$(this).toggleClass('active');
						if ($(this).parent().next('ul').length != 0) {
							$(this).parent().toggleClass('animate');
							$(this).parent().next('ul').stop().slideToggle(300);
						};
						e.preventDefault();
					});
				}

			});

			$('.widget_product_categories').each(function(){

				var $this = $(this);

				if ($this.find('.count').length != 0) {
					$this.find('a').each(function(){
						var $self = $(this);
						var countClone = $self.next('.count').clone();
						$self.next('.count').remove();
						$self.append(countClone);
					});
				}

				var childItems = $this.find('.cat-parent > a')
				.append('<span class="toggle"></span>');

				if ($this.find('.cat-parent > a').attr( "href" ) == "#") {
					$this.find('.cat-parent > a').on('click',function(e){
						$(this).toggleClass('active');
						if ($(this).parent().next('.children').length != 0) {
							$(this).parent().toggleClass('animate');
							$(this).parent().next('.children').stop().slideToggle(300);
						};
						e.preventDefault();
					});
				} else {
					$this.find('.cat-parent > a > span.toggle').on('click',function(e){
						e.stopImmediatePropagation();
						$(this).toggleClass('active');
						if ($(this).parent().next('.children').length != 0) {
							$(this).parent().toggleClass('animate');
							$(this).parent().next('.children').stop().slideToggle(300);
						};
						e.preventDefault();
					});
				}

			});

		/* Widget calendar
		----*/

			$('.widget_calendar').each(function(){

				var $this = $(this);
				var caption = $this.find('caption');

				$this.find('.wp-calendar-nav-prev a').clone().addClass('prev').html('').appendTo(caption);
				$this.find('.wp-calendar-nav-next a').clone().addClass('next').html('').appendTo(caption);
				$this.find('.wp-calendar-nav').remove();

			});

			$('.wp-block-calendar').each(function(){

				var $this = $(this);
				var caption = $this.find('caption');

				$this.find('.wp-calendar-nav a').clone().addClass('prev').html('').appendTo(caption);
				$this.find('.wp-calendar-nav a').clone().addClass('next').html('').appendTo(caption);
				$this.find('.wp-calendar-nav').remove();

			});

		/* Widget product search
		----*/

			$('.widget_product_search').each(function(){
				$('<div class="search-icon"></div>').insertAfter($(this).find('input[type="submit"]'));
			});

		/* Move to top button
		----*/

			var didScroll = false,
				top       = $('#to-top'),
				nav       = $('.bullets-container');
	
			function showOnScroll() {
				window.addEventListener( 'scroll', function( event ) {
				    if( !didScroll ) {
				        didScroll = true;
				        scrollPage(400);
				    }
				}, false );
			}

			function scrollPage(activateOn) {
				var sy = window.pageYOffset;
				if ( sy >= activateOn ) {
					top.addClass('animate');
					nav.addClass('animate');
				} else {
					top.removeClass('animate');
					nav.removeClass('animate');
				}

				didScroll = false;
			}

			showOnScroll();

			top.on('click',function(){
				gsap.to(window, {
					duration: 1, 
					scrollTo: {y:top.attr('href')},
					ease:Power3.easeOut 
				});
				return false;
			});

		/* Form placeholder
		----*/

			$('.widget_login, .widget_reglog').each(function(){
				var $this = $(this);

				$this.find('label').each(function(){
					var labelText = $(this).text();
					$(this).next('input').attr('placeholder',labelText);
					$(this).remove();
				});

				$this.find('input[type="submit"]').on("click",function(event) {

					if (!$this.find('input[type="text"]').val() || !$this.find('input[type="password"]').val() ||
						$this.find('input[type="text"]').val() == $this.find('input[type="text"]').data('placeholder') ||
						$this.find('input[type="password"]').val() == $this.find('input[type="password"]').data('placeholder')) {
						event.preventDefault();
					}

				});
			});

		/* Responsive tables
		----*/

			function responsiveTable(){

				if ($(window).outerWidth() <= 767) {
					$('table').addClass('responsive');
					$('table').parent().addClass('overflow-x');
				} else {
					$('table').removeClass('responsive');
					$('table').parent().removeClass('overflow-x');
				}

			}
			responsiveTable();
			$(window).resize(responsiveTable);

	})(jQuery);

/* Tiny slider & Lightbox
----*/

	(function($){

		"use strict";

		$('.post-media .slides').each(function(){
			if (!$(this).parent().hasClass('grid')) {

				if ($(this).parent().hasClass('slider') || $(this).parent().hasClass('post-gallery')) {

					var slider = tns({
						container: this,
						mode:'gallery',
						nav:false,
						items: 1,
					});

				} else {

					var items = $(this).parent().data('columns'),
						items768 = (items > 3) ? 3 : items;

					var slider = tns({
						container: this,
						mode:'carousel',
						gutter:8,
						touch:true,
						mouseDrag:true,
						nav:false,
						loop:false,
						items: items,
						responsive: {
							320: {items: 1},
							768: {items:items768,gutter:8},
							1024:{items:items},
						}
					});

				}

			}
		});

		$('.post.format-gallery').each(function(){

			var $this = $(this);

			setTimeout(function(){
				$this.find('.tns-controls-trigger button').on('click',function(){
					$this.find('.tns-controls button[data-controls="'+$(this).attr('data-controls')+'"]').trigger('click');
				});

				$this.find('.post-media .slides').each(function(){
					var lazyImage = $(this).find('.tns-item:last-child img.lazy');
					lazyImage.attr('src',lazyImage.data('src')).removeClass('lazy');
				});

			},200);

		});

		$('.gallery').each(function(){
			$(this).find('a').on('click',function(e){
				var href = $(this).attr('href');
			  	if (
					href.includes('.jpg') ||
					href.includes('.jpeg') ||
					href.includes('.png') ||
					href.includes('.bmp') ||
					href.includes('.gif') ||
					href.includes('.svg')
				){
					e.preventDefault();
					gsapLightbox($(this),true);
				}
			});
		});

		$('.et-gallery').each(function(){

			var $this = $(this);

			$this.find('a').on('click',function(e){
				e.preventDefault();
				gsapLightbox($(this),true);
			});

			if ($this.hasClass('slider')) {
				var slider = tns({
					container: this.querySelector('.slides'),
					mode:'gallery',
					nav:false,
					items: 1,
				});

				var lazyImage = $this.find('.slides .et-gallery-item:last-child img.lazy');

				lazyImage.attr('src',lazyImage.data('src')).removeClass('lazy');
				lazyImage.parent().addClass('loaded');

			}

		});

		$('.et-button.modal-true').on('click',function(e){
			e.preventDefault();
			gsapLightbox($(this),false);
		});

		$('.et-carousel > .slides').each(function(){

			var $this    = $(this),
				items    = $this.parent().data('columns'),
				items768 = ($this.parent().hasClass('et-testimonial-container')) ? 1 : (items > 3) ? 3 : items,
				items1024= (items > 2 && $this.parent().hasClass('et-testimonial-container')) ? 2 : items,
				gatter   = ($this.parent().hasClass('et-instagram')) ? 0 : 24,
				autoplay = ($this.parent().data('autoplay')) ? $this.parent().data('autoplay') : false,
				nav      = ($this.parent().data('nav')) ? $this.parent().data('nav') : 'arrows';

			if ($this.parent().hasClass('loop-posts') || $this.hasClass('loop-products')) {gatter = 0;}

			if ($this.parent().hasClass('loop-posts') && (items >= 3)) {items768 = 2;}

			if ($this.parent().hasClass('et-gallery')) {gatter = 8;}

			var bullets = (nav == 'both' || nav == 'dottes') ? true : false,
				arrows  = (nav == 'dottes') ? false : true;

			var slider = tns({
				container: this,
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

				if ($this.parents('.et-carousel').hasClass('et-testimonial-container') && items == 1) {

					gsap.to($this.find('.tns-slide-active'),{
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

			}

			slider.events.on('transitionStart', transitionStart);
			slider.events.on('transitionEnd', transitionEnd);

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
			$(window).resize(function(){
				carouselNavMove();
			});

		});

	})(jQuery);

/* Footer
----*/

	(function($){

		"use strict";

		var footer = $('.footer.sticky-true');
		if (typeof(footer) != 'undefined' && footer.length) {
			$.fn.footerReveal=function(o){var t=$(this),e=t.prev(),i=$(window),s=$.extend({shadow:!0,shadowOpacity:.8,zIndex:-100},o);$.extend(!0,{},s,o);return t.outerHeight()<=i.outerHeight()&&t.offset().top>=i.outerHeight()&&(t.css({"z-index":s.zIndex,position:"fixed",bottom:0}),s.shadow&&e.css({"-moz-box-shadow":"0 20px 30px -20px rgba(0,0,0,"+s.shadowOpacity+")","-webkit-box-shadow":"0 20px 30px -20px rgba(0,0,0,"+s.shadowOpacity+")","box-shadow":"0 20px 30px -20px rgba(0,0,0,"+s.shadowOpacity+")"}),i.on("load resize footerRevealResize",function(){t.css({width:e.outerWidth()}),e.css({"margin-bottom":t.outerHeight()})})),this};
			footer.footerReveal({ shadow: false, zIndex: -101 });
			setTimeout(function(){
				footer.addClass('active');
			},1500);
		}

	})(jQuery);

/* Header
----*/

	/* Megamenu
	----*/

		(function($){

			"use strict";


			/* Megamenu tabs
			----*/

				$('.megamenu-tab').each(function(){

					var $this   		  = $(this),
						tabs     		  = $this.find('.tab-item'),
						tabsQ    		  = tabs.length,
						tabsDefaultWidth  = 0,
						tabsDefaultHeight = 0,
						tabsContent 	  = $this.find('.tab-content'),
						action      	  = ($this.hasClass('action-hover')) ? 'hover' : 'click';

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

									tabsContent.hide(0).removeClass('active');
									tabsContent.eq($self.index()).show(0).addClass('active');

									if ($this.parents('.submenu-appear-none').length) {
										var currentHeight = tabsContent.eq($self.index()).height();
										$this.parents('.megamenu').css('height',currentHeight);
									}
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

									tabsContent.hide(0).removeClass('active');
									tabsContent.eq($self.index()).show(0).addClass('active');

									if ($this.parents('.submenu-appear-none').length) {
										var currentHeight = tabsContent.eq($self.index()).height();
										$this.parents('.megamenu').css('height',currentHeight);
									}
								}
								
							});
						}
						
					}

				});

			/* Megamenu
			----*/

				function megamenuPosition(){

					$('.header-menu > .menu-item').each(function(){

						var $this = $(this);
						var megamenu = $this.children('.megamenu');

						if (megamenu.length) {
							if ($this.data('width') == '100') {
								var megamenuWidth = $(window).innerWidth();
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
				$(window).resize(megamenuPosition);

			/* Megamenu grid autoalign
			----*/

				$('.megamenu').each(function(){
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

		})(jQuery);

	/* Submenu
	----*/

		(function($){

			"use strict";

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

			submenuPosition();
			$(window).resize(submenuPosition);

			$('.nav-menu:not(".megamenu-demo")').each(function(){

				var $this  		    	= $(this),
					hover           	= $this.find('.menu-item-has-children'),
					subMenuEffect   	= ($this.parent().hasClass('submenu-appear-none')) ? 'default' : 'fade',
					menuEffect      	= (!$this.parent().hasClass('menu-hover-none')) ? true : false,
					iconCorrection      = ($this.parent().hasClass('menu-hover-underline') || $this.parent().hasClass('menu-hover-overline')) ? true : false;

				if ($('body').hasClass('single-header')) {
					$this.children('li').first().addClass('active');
				}

				hover.push($this.children('.mm-true'));

				if (menuEffect) {

					var active          	= '',
						activeOffset        = 0,
						currentMenuItem     = $this.children('li.active'),
						color               = $this.data('color'),
						color_hover         = $this.data('color-hover');


					if (typeof(currentMenuItem) == "undefined" || !currentMenuItem.length) {
						// Add active to first item
                        $this.children('li').first().addClass('active');
					}

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

						var li 		= $(this),
							effect  = li.children('a').find('.effect'),
							effectX = li.position().left - activeOffset,
							effectW = effect.width();

						if (iconCorrection) {

							if (active.parents('a').find('.menu-icon').length && !li.children('a').find('.menu-icon').length) {
								effectX -= 24;
							}

							if (!active.parents('a').find('.menu-icon').length && li.children('a').find('.menu-icon').length) {
								effectX += 24;
							}

						}

						li.on('mouseover touchstart',function(){

							gsap.to(active,1, {
								x:effectX,
								width:effectW,
								ease:"elastic.out(1, 0.75)"
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
							ease:"elastic.out(1, 0.75)"
						});

						$this.find('.in').removeClass('in');
						$this.find('.using').removeClass('using');
					});

				}

				$.each(hover,function(){

					var li 		= $(this),
						subMenu = li.children('.sub-menu'),
						height  = subMenu.height();

					var tl = new gsap.timeline({paused: true});

					if (subMenuEffect == "default") {

						tl.from(subMenu,1, {
							height:0,
							ease:"elastic.out(1, 0.75)"
						},'+=0.2');

						tl.from(subMenu,0.1, {
							opacity:0,
							ease:"expo.out"
						},'-=1');

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

					}


				});


			});

		})(jQuery);

	/* Sticky
	----*/

		(function($){

			"use strict";

			var header = $( '.header.sticky-true' );

			header.each(function(){

				var $this = $(this);

				if ($this.length) {

					var docElem        = document.documentElement;
					var didScroll      = false;
			        var changeHeaderOn = 300 + $this.offset().top;

				    function init() {

				    	if( !didScroll ) {
			                didScroll = true;
			                scrollPage();
			            }

				        window.addEventListener( 'scroll', function( event ) {
				            if( !didScroll ) {
				                didScroll = true;
				                scrollPage();
				            }
				        }, false );

				    }

				    function scrollPage() {
				        var sy = scrollY();

			    		if ( sy >= changeHeaderOn ) {
			        		$this.addClass('active');
			        	} else {
			        		$this.removeClass('active');
			        	}

				        didScroll = false;
				    }

				    function scrollY() {
				        return window.pageYOffset || docElem.scrollTop;
				    }

				    $('<div class="header-placeholder" style="height:'+$this.outerHeight()+'px;"></div>').insertAfter($this);

				    init();

			    }
			});

		})(jQuery);

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

			(function($){
	
				"use strict";

				$('.header-search').each(function(){

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

			})(jQuery);

		/* Shopping cart
		----*/

			(function($){
	
				"use strict";

				$('.header-cart').each(function(){
					var element      = this,
						$this   	 = $(element),
						toggle  	 = $this.find('.cart-toggle'),
						box     	 = $this.find('.cart-box'),
						content 	 = $this.find('.widget_shopping_cart');

					svgBackMorph(element,toggle,box,content,'.cart_list');
				});

				$('.ajax_add_to_cart').each(function(){
					$(this).on('click',function(){
						$('.header-cart').each(function(){
							var cartToggle = $(this).find('.close-toggle');
							if (cartToggle.hasClass('active')) {
								cartToggle.addClass('hide').trigger('click');
							}
						});
					});
				});

			})(jQuery);

		/* Language switcher
		----*/

			(function($){
	
				"use strict";

				$('.language-switcher').each(function(){

					var element      = this,
						$this   	 = $(element),
						toggle  	 = $this.find('.language-toggle'),
						box     	 = $this.find('.language-box'),
						content 	 = $this.find('.language-switcher-content');

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

				$('.wpml-ls-legacy-dropdown-click').each(function(){
					var $this = $(this);

					$this.find('.js-wpml-ls-item-toggle').on('click',function(){
						$this.find('.js-wpml-ls-sub-menu').toggleClass('active');
					});

				});

			})(jQuery);

		/* Header login
		----*/

			(function($){
	
				"use strict";

				$('.header-login').each(function(){

					var element      = this,
						$this   	 = $(element),
						toggle  	 = $this.find('.login-toggle'),
						box     	 = $this.find('.login-box'),
						content 	 = $this.find('.widget_reglog');

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

			})(jQuery);

		/* Toggle off
		----*/

			(function($){
		
				"use strict";

				$('.header .hbe-toggle').each(function(){

					$(this).on('click',function(){
						if ($(this).hasClass('active')) {

							$('.header .hbe-toggle.active').not(this).each(function(){

								var $this = $(this);

								if ($this.hasClass('active')) {
									$this.parent().find('.close-toggle').addClass('hide').trigger('click');
								}

							});
						}
					});
				});

			})(jQuery);

		/* Mobile navigation
		----*/

			(function($){
	
				"use strict";

				// Animate mobile
				var mobileOverlay   = $('.mobile-container-overlay'),
					mobileContainer = $('.mobile-container'),
					content         = mobileContainer.find('.mobile-container-inner'),
					menu            = mobileContainer.find('.mobile-menu > li'),
					close			= mobileContainer.find('.mobile-toggle.active');

				var tl = new gsap.timeline({paused: true});

				tl.to(mobileOverlay,0, {
				  left:0,
				  immediateRender:false
			  	});

				tl.to(mobileOverlay,0.2, {
				  opacity:'1'
			  	});

				tl.to(mobileContainer,0.8, {
				  x:'0',
				  ease:"expo.out"
			    });

				tl.to(content,0.2, {
				  opacity:'1'
			  	},'-=0.4');

				tl.from(close,1.2, {
				  x:'-12px',
				  ease:"elastic.out(1, 0.5)"
			  	},'-=0.4');

				tl.staggerFrom(menu,1.2, {
				  x:'-12px',
				  opacity:0,
				  ease:"elastic.out(1, 0.75)",
			  	},0.05,'-=1.4');

				tl.add("open");

				tl.to(content,0.1, {
				  opacity:0,
				});

				tl.to(mobileContainer,0.4, {
				  x:'-100%',
				  ease:"expo.out"
			  	});

				tl.to(mobileOverlay,0.2, {
				  opacity:'0'
			  	});

				tl.to(mobileOverlay,0, {
				  left:'-100%',
				  immediateRender:false
			  	});

				tl.add("close");

				$('.mobile-toggle').on('click',function(){

					if ($(this).hasClass('active')) {
						tl.tweenTo('close');

						$('.mobile-menu .menu-item-has-children').each(function(){
							$(this).toggleClass('active');
							$(this).find('ul').stop().slideUp(200);
							$(this).find('.arrow').removeClass('active');
						});

					} else {
						tl.progress(0);
						tl.tweenTo("open");
					}

				});

				$('.mobile-container-overlay').on('click',function(e){
					if(e.target !== e.currentTarget) return;
					tl.play();
					$('.mobile-menu .menu-item-has-children').each(function(){
						$(this).find('ul').stop().slideUp(200);
						$(this).find('.arrow').removeClass('active');
					});
				});

				$('.mobile-menu .menu-item-has-children > a').each(function(){
					var $link = $(this);
					if ($link.attr( "href" ) == "#") {
						$link.on('click',function(e){
							e.preventDefault();
							$link.find('.arrow').toggleClass('active');
							$link.parent('.menu-item-has-children').siblings().find('.arrow').removeClass('active');
							$link.parent('.menu-item-has-children').siblings().children('ul').slideUp(200);
							$link.next('ul').stop().slideToggle(200);
						});
					} else {
						$link.find('.arrow').on("click", function(e){
							e.preventDefault();
							var $this = $(this);
							$this.toggleClass('active');
							$link.parent('.menu-item-has-children').siblings().find('.arrow').removeClass('active');
							$link.parent('.menu-item-has-children').siblings().children('ul').slideUp(200);
							$link.next('ul').stop().slideToggle(200);
						});
					}
				});

			})(jQuery);

		/* Sidebar menu
		----*/

			(function($){
	
				"use strict";

				$('.sidebar-container').each(function(){

					var $this   	 = $(this),
						toggle  	 = $this.find('.sidebar-container-toggle'),
						small   	 = toggle.find('.small'),
						normalTop    = toggle.find('.normal').find('.top'),
						normalBottom = toggle.find('.normal').find('.bottom'),
						crossTop     = toggle.find('.cross').find('.top'),
						crossBottom  = toggle.find('.cross').find('.bottom'),
						content 	 = $this.find('.sidebar-container-content'),
						menu    	 = $this.find('.sidebar-menu > .menu-item');

					var tl = new gsap.timeline({paused: true});

					tl.to(small,0.1, {
						 opacity:'0'
					});

					tl.to(normalTop,0.8, {
					  morphSVG:{shape:crossTop},
					  ease:"elastic.out(1, 1.75)"
				  	},'-=0.1');

					tl.to(normalBottom,0.8, {
					  morphSVG:{shape:crossBottom},
					  ease:"elastic.out(1, 1.75)"
				  	},'-=0.8');

					tl.to($this,0.8, {
						width:640,
						ease:"elastic.out(1, 1.75)"
					},'-=0.6');

					tl.to(content,0.2, {
					  opacity:'1'
				  	},'-=0.4');

					tl.staggerFrom(menu,1.2, {
					  x:'-12px',
					  opacity:0,
					  ease:"elastic.out(1, 0.75)",
				  	},0.05,'-=0.4');

					tl.add('open');

					tl.to(content,0.2, {
						opacity:0,
					},'+=0.2');

					tl.to($this,0.4, {
						width:64,
						ease:"expo.out"
					},'-=0.2');

					tl.to(normalTop,0.8, {
					  morphSVG:{shape:normalTop, shapeIndex:3},
					  ease:"elastic.out(1, 1.75)"
				  	},'-=0.4');

					tl.to(normalBottom,0.8, {
					  morphSVG:{shape:normalBottom, shapeIndex:3},
					  ease:"elastic.out(1, 1.75)"
				  	},'-=0.8');

					tl.to(small,0.1, {
						 opacity:'1'
					},'-=0.8');

					toggle.on('click',function(){

						if (!toggle.hasClass('active')) {
							toggle.addClass('active');

							content.addClass('active');

							tl.progress(0);
							tl.tweenTo('open');
						} else {
							tl.play();
							content.removeClass('active');
							toggle.removeClass('active');
						}

					});

					$.each($this.find('.sidebar-menu > .menu-item-has-children'),function(){

						var li 		= $(this),
							subMenu = li.children('.sub-menu');

						var tl = new gsap.timeline({paused: true});

						tl.from(subMenu,0.6, {
							x:'-12px',
							ease:"expo.out"
						},'+=0.2');

						tl.from(subMenu,0.1, {
							opacity:0,
							ease:"expo.out"
						},'-=0.6');

						li.hover(
							function(){

								li.parent().addClass('active');

								tl.progress(0);
								tl.play();
							},
							function(){
								tl.reverse();

								li.parent().removeClass('active');

							}
						);


					});

				});

			})(jQuery);

		/* Modal menu
		----*/

			(function($){

				"use strict";

				function responsiveModalContainer(){

					var element = document.getElementsByClassName('modal-container')[0];

					if (typeof(element) != 'undefined') {

						var	$this   = $(element),
							width   = $(window).width(),
							height  = $(window).height(),
							svg     = $this.find('.modal-back');

						// get svg viewBox
						var viewBox = element.querySelector('.modal-back').getAttribute('viewBox');

						viewBox = viewBox.split(' ');
						viewBox  = viewBox.splice(2, 2);

						var heightReplace = viewBox[1];
						var widthReplace  = viewBox[0];
						var widthReplace2  = parseInt(widthReplace ) - 100;
						var heightReplace2 = parseInt(heightReplace)  + 100;

						widthReplace2 = widthReplace2.toString();

						var start    = svg.find('.start').attr('d'),
							end      = svg.find('.end').attr('d'),
							original = svg.find('.start').attr('data-original'),
							clone 	 = svg.find('.start').attr('data-dclone');

						start   = start.replace(new RegExp(widthReplace,"g"),width);
						start   = start.replace(new RegExp(widthReplace2,"g"),(width - 100));

						clone   = clone.replace(new RegExp(widthReplace,"g"),width);
						clone   = clone.replace(new RegExp(widthReplace2,"g"),(width - 100));

						end     = end.replace(new RegExp(widthReplace,"g"),width);
						end     = end.replace(new RegExp(heightReplace2,"g"),(height + 100));

						if (typeof(original) != 'undefined') {
							original = original.replace(new RegExp(widthReplace,"g"),width);
							original = original.replace(new RegExp(widthReplace2,"g"),(width - 100));
						}

						element.querySelector('.modal-back').setAttribute('viewBox','0 0 '+width+' '+height);

						svg.find('.start').attr('d',start);
						svg.find('.start').attr('data-dclone',clone);
						svg.find('.end').attr('d',end);

						if (typeof(original) != 'undefined') {
							svg.find('.start').attr('data-original',original);
						}

					}
				}

				responsiveModalContainer();

				var modalContainer = $('.modal-container'),
					content        = modalContainer.find('.modal-container-inner'),
					menu           = modalContainer.find('.modal-menu > li'),
					close		   = modalContainer.find('.modal-toggle.active'),
					svg     	   = modalContainer.find('.modal-back'),
					start  		   = svg.find('.start'),
					startOriginal  = start.attr('d'),
					end    		   = svg.find('.end').attr('d');


				var tl = new gsap.timeline({paused: true});

				function buildModNavTimeline(){

				  	tl.to(modalContainer,0, {
					  top:0,
					  immediateRender:false
				  	});

					tl.from(start,1.6, {
					  x:'100%',
					  y:'-100%',
					  ease:"expo.out"
				  	},'+=0.2');

					tl.to(start,1.6, {
					  morphSVG:{shape:end, shapeIndex:4},
					  ease:"elastic.out(1, 0.75)",
				  	},'-=1.4');

				  	tl.to(content,0.2, {
					  opacity:'1'
				  	},'-=1.4');

				  	tl.from(close,0.2, {
					  opacity:0,
					  ease:"expo.out"
				  	},'-=1.4');

				  	tl.from(close,1.2, {
					  x:'-12px',
					  ease:"elastic.out(1, 0.5)"
				  	},'-=1.4');

					tl.staggerFrom(menu,1.2, {
					  x:'-12px',
					  opacity:0,
					  ease:"elastic.out(1, 0.75)",
				  	},0.05,'-=1.4');

					tl.add("open");

					tl.to(content,0.1, {
					  opacity:0,
					},'+=0.2');

					tl.to(close,0.2, {
					  opacity:0,
					},'-=0.1');

				  	tl.to(start,1.6, {
					  morphSVG:{shape:startOriginal, shapeIndex:4},
					  ease:"expo.out",
				  	},'-=0.1');

				  	tl.to(start,1.6, {
					  x:'100%',
					  y:'-100%',
					  ease:"expo.out"
				  	},'-=1.6');

					tl.to(modalContainer,0, {
					  top:'-100%',
					  immediateRender:false
				  	});

					tl.add("close");

				}

				buildModNavTimeline();


				$('.modal-toggle').on('click',function(){

					if ($(this).hasClass('active')) {
						tl.tweenTo('close');

						setTimeout(function(){
							modalContainer.removeClass('active');
						},1000);

					} else {

						modalContainer.addClass('active');

						tl.progress(0);
						tl.tweenTo("open");
					}

				});

				$(window).resize(function(){

					tl.seek('open').kill();

					responsiveModalContainer();

					modalContainer = $('.modal-container').removeClass('active').removeAttr('style');
					content        = modalContainer.find('.modal-container-inner').removeAttr('style');
					menu           = modalContainer.find('.modal-menu > li');
					close		   = modalContainer.find('.modal-toggle.active');
					svg     	   = modalContainer.find('.modal-back');
					start  		   = svg.find('.start');
					end    		   = svg.find('.end').attr('d');
				
					var startC = start.attr('data-dclone');
						start.attr('d',startC);

					startOriginal  = start.attr('d');

					tl = new gsap.timeline({paused: true});

					buildModNavTimeline();
				
				});

				$.each($('.modal-menu > .menu-item-has-children'),function(){

					var li 		= $(this),
						subMenu = li.children('.sub-menu');

					var tl = new gsap.timeline({paused: true});

					tl.from(subMenu,0.6, {
						x:'-12px',
						ease:"expo.out"
					},'+=0.2');

					tl.from(subMenu,0.1, {
						opacity:0,
						ease:"expo.out"
					},'-=0.6');

					li.hover(
						function(){

							li.parent().addClass('active');

							tl.progress(0);
							tl.play();
						},
						function(){
							tl.reverse();

							li.parent().removeClass('active');

						}
					);


				});

				$.each($('.modal-menu > li'),function(){

					var li = $(this);

					li.append('<span class="index">0'+(li.index()+1)+'</span>');

				});


			})(jQuery);

		/* Widget navigation
		----*/

			(function($){
	
				"use strict";

				// Animate sidebar
				var sidebarArea 		= $('.layout-sidebar'),
					sidebarOverlay   	= $('<div class="sidebar-layout-overlay"></div>').insertAfter(sidebarArea),
					content         	= sidebarArea.find('.widget-area'),
					close				= sidebarArea.find('.content-sidebar-toggle.active');


				var tl = new gsap.timeline({paused: true});

				tl.to(sidebarOverlay,0, {
				  left:0,
				  immediateRender:false
			  	});

				tl.to(sidebarOverlay,0.2, {
				  opacity:'1'
			  	});

				tl.to(sidebarArea,0.8, {
				  x:'0',
				  ease:"expo.out"
			    });

				tl.to(content,0.2, {
				  opacity:'1'
			  	},'-=0.4');

				tl.from(close,1.2, {
				  x:'-12px',
				  ease:"elastic.out(1, 0.5)"
			  	},'-=0.4');

				tl.add("open");

				tl.to(content,0.1, {
				  opacity:0,
				});

				tl.to(sidebarArea,0.4, {
				  x:'-100%',
				  ease:"expo.out"
			  	});

				tl.to(sidebarOverlay,0.2, {
				  opacity:'0'
			  	});

				tl.to(sidebarOverlay,0, {
				  left:'-100%',
				  immediateRender:false
			  	});

				tl.add("close");

				$('.content-sidebar-toggle').on('click',function(){

					if ($(this).hasClass('active')) {
						tl.tweenTo('close');
						setTimeout(function(){$('#et-content').removeAttr('style');},1000);
					} else {
						tl.progress(0);
						tl.tweenTo("open");
						$('#et-content').css('z-index',99);
					}

				});

				$('.sidebar-layout-overlay').on('click',function(e){
					if(e.target !== e.currentTarget) return;
					tl.play();
					setTimeout(function(){$('#et-content').removeAttr('style');},1000);
				});

			})(jQuery);

	/* Mobile tabs
	----*/
		
		(function($){

			"use strict";

			$('.et-mobile-tab').each(function(){

				var $this    = $(this),
					tabs     = $this.find('.tab'),
					tabsQ    = tabs.length,
					tabsContent = $this.find('.mob-tab-content');

				var docElem        = document.documentElement;
				var didScroll      = false;
		        var changeHeaderOn = 300;

		        function init() {

			    	if( !didScroll ) {
		                didScroll = true;
		                scrollPage();
		            }

			        window.addEventListener( 'scroll', function( event ) {

			        	if (!$this.find('.tab.active').length) {

				            if( !didScroll ) {
				                didScroll = true;
				                scrollPage();
				            }

			            }

			        }, false );

			    }

			    function scrollPage() {
			        var sy = scrollY();

		    		if ( sy <= changeHeaderOn ) {
		        		$this.addClass('active');
		        	} else {
		        		$this.removeClass('active');
		        		$this.find('.tab.active').trigger('click');
		        	}

			        didScroll = false;
			    }

			    function scrollY() {
			        return window.pageYOffset || docElem.scrollTop;
			    }

				tabs.wrapAll('<div class="mob-tabset et-clearfix"></div>');
				tabsContent.wrapAll('<div class="mob-tabs-container et-clearfix"></div>');

				setTimeout(function(){$this.addClass('active');},500);

				tabs.each(function(){

					var self 	    = $(this),
						selfContent = $('#'+self.data('target')),
						content     = selfContent.children().not('.et-gap');

					var tl = new gsap.timeline({paused: true});

					tl.from(selfContent,0.6,{
						ease:'expo.out',
						scaleY:0,
						transformOrigin:'left bottom'
					},'+=0.1');

					tl.from(content,0.6,{
						x:-24,
						opacity:0,
						stagger:0.05,
						ease:'expo.out',
						transformOrigin:'left bottom'
					});

					tl.add('open');

					self.on('click', function(){

						self.toggleClass('active').siblings().removeClass('active');

						if (self.hasClass('active')) {

							$this.find('.mob-tabs-container').addClass('active');
							$this.toggleClass('front');

							tabsContent.not(selfContent)
							.removeAttr('style')
							.css('transform','scaleY(0)');

							tl.progress(0);
							tl.play();

						} else {
							selfContent
							.removeAttr('style')
							.css('transform','scaleY(0)');

							$this.find('.mob-tabs-container').removeClass('active');
						}

					});

				});
				
				init();
			});

		})(jQuery);

/* Elements
----*/

	/* instagram
	----*/
		
		(function($){

			"use strict";
				    
		    $('.instagram-image-list').each(function(){

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

		    $('.et-instagram').each(function(){

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

					}

			    	$this.find('img.lazy').each(function(){
		                var lazyImg = $(this);
		                lazyImg.attr('src',lazyImg.data('src')).removeClass('lazy');
		                lazyImg.parent().addClass('loaded').removeClass('lazy-inline-image');
		                lazyImg.parent().find('svg').remove();
		            });
			    },4000);

		    });

		})(jQuery);

	/* et-button
	----*/

		(function($){

			"use strict";

			$('.et-button').each(function(){

				var $this  = $(this),
					effect = $this.data('effect');

				var tl = new gsap.timeline({paused: true});

				switch (effect) {
					case 'fill':

						var hover 	    = $this.find('path.hover'),
							icon        = $this.find('.icon svg'),
							color 	    = $this.data('color'),
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
					    },'-=0.6');

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
					   },'-=0.6');

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

						var regular   	  = $this.find('.regular'),
							morphPath 	  = regular.data('hover'),
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
						gsap.to(window, {
							duration: 1, 
							scrollTo: {y:$this.attr('href')},
							ease:Power3.easeOut 
						});
						return false;
					});
				}

			});

		})(jQuery);

	/* et-icon
	----*/

		(function($){

			"use strict";

			$('.click-true .hicon, .et-icon.click-true').each(function(){

				var $this  		  = $(this),
					iconBack   	  = $this.find('.icon-back path'),
					morphPath 	  = iconBack.data('hover'),
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

		})(jQuery);

	/* et-heading
	----*/

		(function($){

			"use strict";

			$('.et-heading.animate-true').each(function(){

				var $this = $(this),
					delay = '+='+(0.2 + parseInt($this.data('delay'))/1000),
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
						duration: 0.2,
					},delay);

					tl.from(letterText.chars,{
						duration: 0.6,
						opacity:0,
						scale:3,
						x:100,
						y:50,
						force3D:true,
						stagger: 0.01,
						ease:"expo.out"
					},'-=0.2');

				}

				if ($this.hasClass('words')) {

					var wordsText = new SplitText($this.find('.text'),{type:"words"});
					
					gsap.set($this,{perspective:500});

					tl.from(wordsText.words,{
						duration: 0.2,
					},delay);

					tl.from(wordsText.words,{
						duration: 0.8,
						opacity:0,
						scaleY:1.5,
						transformOrigin:'left top',
						y:24,
						force3D:true,
						stagger: 0.04,
						ease:"expo.out"
					},'-=0.2');

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
					},'-=0.2');

				}

				$this.waypoint({
	                handler: function(direction) {

	                	tl.progress(0);
						tl.play();

	                    this.destroy();

	                },
	                offset: 'bottom-in-view'
	            });

			});

		})(jQuery);

	/* et-blockquote
	----*/

		(function($){

			"use strict";

			$('.et-blockquote').each(function(){

				var $this = $(this);

				var tl = new gsap.timeline({paused: true});

				tl.from($this,{
					duration: 0.4,
					opacity:0,
				},'+=0.2');

			    tl.from($this.find('.author-wrapper *'),{
					duration: 0.8,
					opacity:0,
					x:-32,
					stagger: 0.05,
					ease:"expo.out"
				},'-=0.2');

				$this.waypoint({
	                handler: function(direction) {

	                	tl.progress(0);
						tl.play();

	                    this.destroy();

	                },
	                offset: 'bottom-in-view'
	            });

			});

		})(jQuery);

	/* et-icon-list
	----*/

		(function($){

			"use strict";

			$('.et-icon-list.animate-true').each(function(){

				var $this = $(this),
					delay = '+='+(0.2 + parseInt($this.data('delay'))/1000);

				var tl = new gsap.timeline({paused: true});

				tl.from($this.find('li'),{
					duration: 0.8,
					x:-50,
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
	                offset: 'bottom-in-view'
	            });

			});

		})(jQuery);

	/* et-accordion
	----*/

		(function($){

			"use strict";

			$('.et-accordion').each(function(){

				var $this = $(this);

				gsap.set($this.find('.toggle-title.active').next(),{
					opacity: 1,
    				height: 'auto'
				});

				$this.find('.toggle-title').on('click', function(){

					var $self = $(this);

						if(!$self.hasClass('active')){
							if($this.hasClass('collapsible-true')){
								$self.addClass("active").siblings().removeClass("active");

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


		})(jQuery);

	/* et-tabs
	----*/
		
		(function($){

			"use strict";

			$('.et-tab').each(function(){

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

		})(jQuery);

	/* et-animate-box
	----*/
		
		(function($){

			"use strict";

			function animateBoxBack(box){

				var $this  = jQuery(box),
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

			$('.et-animate-box').each(function(){


				var element   = this,
					$this     = $(element),
					id        = $this.attr('id'),
					delay     = '+='+(0.2 + parseInt($this.data('delay'))/1000),
					animation = $this.data('animation'),
					offset    = (animation == 'bottom') ? '100%': '70%',
					stagger   = $this.data('stagger'),
					content   = $this.find('.content').children();

				$this.cursorColor();

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
	                offset: offset
	            });

	            $(window).resize(function(){

	            	setTimeout(function(){

		            	element = document.getElementById(id);

		            	$this = $('#'+id);

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
				                offset: offset
				            });

			            }

		            },50);

				});

			});
			

		})(jQuery);

	/* et-stagger-box
	----*/
		
		(function($){

			"use strict";

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

			$('.et-stagger-box').each(function(){

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
	                offset: '70%'
	            });

			});
			

		})(jQuery);

	/* et-content-box
	----*/

		(function($){

			"use strict";

			$('.et-icon-box').each(function(){

				var $this  = $(this),
					effect = $this.data('effect');

				$this.cursorColor();

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

			$('.et-icon-box-container').each(function(){

				var $this 	  	     = $(this),
					animation 	     = $this.data('animation'),
					stagger          = $this.data('content-animation');

				if (animation != "none") {

					$this.find('.et-icon-box').each(function(){

						var box     = $(this),
							delay   = (0.2 + box.index()*0.05),
							columns = box.data('columns');

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
								if (columns == 1) {

									tl.from(box,{
										duration:0.8,
										delay:delay,
										opacity:0,
										x:40,
										ease:"expo.out"
									});

								} else {

									tl.from(box,{
										duration:0.8,
										delay:delay,
										opacity:0,
										y:40,
										ease:"expo.out"
									});

								}
							break;
						}

						box.waypoint({
			                handler: function(direction) {

			                	tl.progress(0);
								tl.play();

			                    this.destroy();

			                },
			                offset: 'bottom-in-view'
			            });

		           

					});

				}

			});

		})(jQuery);

	/* et-step-box
	----*/

		(function($){

			"use strict";

			$('.et-step-box').each(function(){

				var $this = $(this),
					delay = (0.2 + $this.index()*0.05);

				$this.find('.step-count').text('0.'+($this.index()+1));

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
	                offset: 'bottom-in-view'
	            });

			});

		})(jQuery);

	/* et-pricing-table
	----*/
		
		(function($){

			$('.et-pricing-table').each(function(){

				var $this = $(this);

				if ($this.hasClass('highlight-true')) {
					$this.cursorColor();
				}

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
	                offset: '50%'
	            });

			});
						

		})(jQuery);

	/* et-testimonials
	----*/

		(function($){

			"use strict";

			$('.et-testimonial-container').each(function(){

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
		                offset: 'bottom-in-view'
		            });

	            }

			});

		})(jQuery);

	/* et-clients
	----*/
		
		(function($){

			"use strict";

			$('.et-client').each(function(){

				var $this   = $(this),
					delay   = (0.2 + $this.index()*0.01);

				if ($this.parent().hasClass('grid')) {

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
		                offset: 'bottom-in-view'
		            });

	            }

			});

			
			

		})(jQuery);

	/* et-person
	----*/
		
		(function($){

			$('.et-person').each(function(){

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
	                offset: '70%'
	            });

			});
						

		})(jQuery);

	/* et-tagline
	----*/
		
		(function($){

			$('.et-tagline').each(function(){

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
	                offset: '70%'
	            });
			});

			boxMove('.et-tagline');

		})(jQuery);

	/* et-banner
	----*/

		(function($){

			$('.et-popup-banner-wrapper').each(function(){

				var $this  = $(this);
				var	$delay = $this.find('.et-popup-banner').attr('data-delay');
				var cookie = $this.find('.et-popup-banner').attr('data-cookie');

				var bannerClone = $this.clone();

				$('body').append(bannerClone);

				$this.remove();

				bannerClone.find('a').on('click',function(event){
					event.stopPropagation();
				});

				if (typeof($.cookie(bannerClone.attr('id'))) == 'undefined') {

					setTimeout(function(){
						bannerClone.addClass('animate');
					},$delay);

					bannerClone.find('.popup-banner-toggle').bind('click',function(){
						bannerClone.removeClass('animate');
						if (cookie == 'true') {
							$.cookie(bannerClone.attr('id'),'active',{ expires: 1,path: '/'});
						}
					});

				}

			});

		})(jQuery);

	/* et-image
	----*/
		
		(function($){

			$('.et-image').each(function(){

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
		                offset: '70%'
		            });

				}

				if ($this.hasClass('parallax')) {

					var x = $this.data('coordinatex'),
						y = $this.data('coordinatey');

					$(window).scroll(function(){

						var yPos = Math.round((0-$(window).scrollTop()) / $this.data('speed'))  +  y;

						gsap.to($this,0.8,{
							x:x,
							y:yPos,
							force3D:true,
						});

					});
				}
				
			});

			function disableParallax(){
				if ($(window).width() <= 1300) {
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
			$(window).resize(function(){
				disableParallax();
			});

		})(jQuery);

	/* et-counter
	----*/
		
		(function($){

			"use strict";

			$('.et-counter').each(function(){

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
	                offset: 'bottom-in-view'
	            });


			});

		})(jQuery);

	/* et-progress
	----*/
		
		(function($){

			"use strict";

			$('.et-progress').each(function(){

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
	                offset: 'bottom-in-view'
	            });


			});

		})(jQuery);

	/* et-timer
	----*/
		
		(function($){

			"use strict";

			$('.et-timer').each(function(){

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
	                offset: 'bottom-in-view'
	            });

			});

		})(jQuery);

	/* et-info-presentation
	----*/

	    (function($){

	    	"use strict";

	    	$('.et-info-present').each(function(){

	    		var $this  = $(this);

	    		var slider = tns({
					container: this.querySelector('.slides'),
					autoplay:$this.attr('data-autoplay'),
					mode:'gallery',
					nav:true,
					controls:false,
					items: 1,
				});

				$this.find('.presentation-box').each(function(){
					$(this).cursorColor();
				});

	    	});

			

 		})(jQuery);

	/* et-row/et-column
	----*/

	    (function($){

	        "use strict";

	        function backgroundScroll(el,speed,direction){
	    		var size = (direction == "horizontal") ? el.data('img-width') : el.data('img-height');
	    		if (direction == "horizontal") {
					el.animate({'background-position-x' :size}, {duration:speed,easing:'linear',complete:function(){el.css('background-position-x','0');backgroundScroll(el, speed,direction);}});
	    		} else if (direction == "vertical") {
	    			el.animate({'background-position-y' :size}, {duration:speed,easing:'linear',complete:function(){el.css('background-position-y','0');backgroundScroll(el, speed,direction);}});
	    		};
			}

	        $('.vc-parallax').each(function(){
	            var $this = $(this),
	            	plx = $this.find('.parallax-container');
	            
	            if ($this.hasClass('vc-video-parallax')) {
	           		plx = $this.find('.video-container');
	            }

	            var duration = parseInt($this.data('parallax-duration')),
	            	ratio    = (typeof(duration) != 'undefined' && duration != null && duration != 0) ? 0.1 : 1;

	            	duration = duration/100;

	            $(window).scroll(function() {
	                var yPos = Math.round(($(window).scrollTop()-plx.offset().top) / $this.data('parallax-speed'));

	                yPos = ratio*yPos;

	                gsap.to(plx,{
	                	duration:duration,
	                	delay:0,
	                	y:yPos,
	            	});
	            });

	        });

		    $('.vc-animated-bg').each(function(){

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

		    $('.vc-curtain').each(function(){

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
	                offset: '70%'
	            });

		    });

		    $('.vc_row').each(function(){
		    	$(this).cursorColor();
		    });

		    $('.wpb_column').each(function(){
		    	$(this).cursorColor();
		    });

	    })(jQuery);

/* Posts
----*/

	(function($){

		"use strict";

		var max     	= parseInt(controller_opt.postMax),
			start   	= parseInt(controller_opt.start) + 1,
			next    	= controller_opt.postNextLink,
			noMore  	= controller_opt.noMore,
			defaultText = $('.post-ajax-button .text').text(),
			request 	= false;

		if ($('.blog-layout').hasClass('masonry')) {

			$('.masonry #loop-posts').imagesLoaded(function(){
				var masonry = $('.masonry #loop-posts').masonry({
				  itemSelector: '.post',
				  columnWidth:'.post',
				  percentPosition:true,
				  gutter:0
				});
			});

		}

		function ajaxAddToCart(){
			$('ul > .product').each(function(){

				var $this = $(this);
				var addToCard = $this.find('.ajax_add_to_cart');
				var productProgress = $this.find('.ajax-add-to-cart-loading');
				var addToCardEvent  = true;

				if (addToCard.hasClass('added')) {
					addToCardEvent  = false;
				}

				if (addToCard.attr('data-product_status') == 'outofstock') {
					addToCardEvent  = false;
				}

				if (addToCard.attr('data-product_type') == 'variable') {
					addToCardEvent  = false;
				}

				if (addToCardEvent == true) {
					addToCard.on('click',function(){
						var $self = $(this);
						productProgress.addClass('active');
						setTimeout(function(){
							productProgress.addClass('load-complete');
							gsap.to(productProgress.find('.tick'),0.2, {
							  opacity:1,
							});
							gsap.to(productProgress.find('.tick'),0.8, {
							  scale:1.15,
							  ease:"elastic.out"
							});
							setTimeout(function(){
								productProgress.removeClass('active').removeClass('load-complete');
								addToCardEvent  = false;
							}, 500);
						}, 1500);
						
					});
				}
			});
		}

		function listImages(){
			if ($(window).width() <= 720) {
				$('.list .loop-posts .post img').each(function(){

					var $this   			= $(this),
						dataRespSrc 	    = $this.attr('data-resp-src'),
						dataRespSrcOriginal = $this.attr('data-resp-src-original'),
						dataWidth           = $this.attr('data-width'),
						dataHeight          = $this.attr('data-height');
					
					if ($this.hasClass('lazy')) {
						$this.attr('src',dataRespSrc);
						$this.attr('data-src',dataRespSrcOriginal);	
					} else {
						$this.attr('src',dataRespSrcOriginal);
					}	
					$this.attr('width',dataWidth);
					$this.attr('height',dataHeight);

					$this.addClass('changed');

				});
			} else {
				$('.list .loop-posts .post img').each(function(){

					var $this = $(this);

					if ($this.hasClass('changed')) {

						var	dataRespSrc 	    = $this.attr('data-clone-resp-src'),
							dataRespSrcOriginal = $this.attr('data-clone-resp-src-original'),
							dataWidth           = $this.attr('data-clone-width'),
							dataHeight          = $this.attr('data-clone-height');
						
						if ($this.hasClass('lazy')) {
							$this.attr('src',dataRespSrc);
							$this.attr('data-src',dataRespSrcOriginal);	
						} else {
							$this.attr('src',dataRespSrcOriginal);
						}	
						$this.attr('width',dataWidth);
						$this.attr('height',dataHeight);

						$this.removeClass('changed');

					}

				});
			}
		}

		function getPosts(postType,trigger,masonry){

			if(start <= max) {

				if (request) {
					return;
				}

				request = true;

				trigger.removeClass('disable').addClass('loading');
				trigger.find('.text').text(defaultText);

				$.get(next,function(content) {

					var content = $(content).find('#loop-'+postType+' > .post').addClass('append');

					if (typeof content !== "undefined") {

						start++;
						next = next.replace(/\/page\/[0-9]*/, '/page/'+ start);
						request = false;

						setTimeout(function(){
						
							$('#loop-'+postType).append(content);

							// plugins-recall

							if ($('#loop-posts').length) {

								if ($('.post-layout').hasClass('masonry')) {

									$('.masonry #loop-posts').masonry('destroy');
									$('.masonry #loop-posts').removeData('masonry');

									$('.masonry #loop-posts').masonry({
									  itemSelector: '.post',
									  columnWidth:'.post',
									  percentPosition:true,
									  gutter:0
									});

								}

								$('.post-media .slides').each(function(){
									var slider = tns({
										container: this,
										mode:'gallery',
										nav:false,
										items: 1
									});
								});

								videoTrigger();

								setTimeout(function(){
									$('.tns-controls-trigger button').on('click',function(){
										$('.tns-controls button[data-controls="'+$(this).attr('data-controls')+'"]').trigger('click');
									});

									$('.post-media .slides').each(function(){
										var lazyImage = $(this).find('li:last-child img.lazy');
										lazyImage.attr('src',lazyImage.data('src')).removeClass('lazy');
									});

								},200);

							}

							if ($('#loop-projects').length) {
								boxMove('.full .loop-projects > .project');
							}

							if ($('#loop-products').length) {
								ajaxAddToCart();
							}

							listImages();
							animateCursor();

							trigger.removeClass('loading');

							$('#loop-'+postType+' > .post').removeClass('append');

							lazyLoad(document.getElementById('loop-'+postType));

							if(start > max) {
								trigger.addClass("disable");
								trigger.find('.text').text(noMore);
							}

						},1000);


					} else {
						alert('Something went wrong, please contact site administrator');
					}

				});

			}
		}

		function fetchPosts(postType){

			var loop    = $('#loop-'+postType),
				nav     = loop.data('nav'),
				trigger = $('.post-ajax-button');

			switch(postType){
				case 'projects':
					max  = controller_opt.projectMax;
					next = controller_opt.projectNextLink;
				break;
				case 'products':
					max  = controller_opt.productMax;
					next = controller_opt.productNextLink;
				break;
			}

			if(start > max) {
				trigger.addClass("disable");
				trigger.find('.text').text(noMore);
			}

			trigger.on('click',function(e){
				e.preventDefault();
			});

			if (nav == "loadmore") {

				trigger = $('#loadmore');
				trigger.on('click',function(){
					trigger = $(this);
					getPosts(postType,trigger);
				});

			} else if(nav == "infinite"){

				trigger = $('#infinite');

				$(window).scroll(function(){
					if  (trigger.inView()){
						getPosts(postType,trigger);
					}
				});

			}
		}

		function filterPosts(postType,link,count,perPage,id,layout,full,loopId = ''){

			if (request) {
				return;
			}

			var trigger = $('#loop-'+postType+loopId).next('.post-ajax-button');

			request = true;

			$('#loop-'+postType+loopId).addClass('loading');
			
			trigger.find('.text').text(defaultText);
			trigger.removeClass('disable').addClass('loading');

			$.ajax({
                url:controller_opt.ajaxUrl,
                type: 'post',
                data: {
                	action:'term_filter',
                	id:id,
                	count:perPage,
                	layout:layout,
                	full:full
                },
                success: function(data) {
                	if (data.length) {

                		request = false;

                	 	start = parseInt(controller_opt.start) + 1;
						next  = link + '/page/' + start;
						max   = Math.ceil(count/perPage);

						setTimeout(function(){

							$('#loop-'+postType+loopId).html('');
							$('#loop-'+postType+loopId).append(data);

							// plugins-recall

							if ($('#loop-projects'+loopId).length) {
								boxMove('.full .loop-projects > .project');
							}

							listImages();
							animateCursor();

							$('#loop-'+postType+loopId).removeClass('loading');
							trigger.removeClass("loading");

							$('#loop-'+postType+loopId+' > .post').removeClass('append');

							lazyLoad(document.getElementById('loop-'+postType+loopId));

							if(start > max) {
								trigger.addClass("disable");
								trigger.find('.text').text(noMore);
							}

						},1000);

                	} else {
						alert('No data');
					}
				},
				error: function(data){
					alert('Something went wrong, please contact site administrator');
				}
            });

		}

		if ($('#loop-posts').length) {
			fetchPosts('posts');
		}

		if ($('#loop-projects').length) {

			if ($('#project-filter').length) {
				$('#project-filter a').on('click',function(e){

					var $this = $(this);

					e.preventDefault();
					$this.addClass('active').siblings().removeClass('active');
					$this.parent().find('select option[value="'+$this.attr('href')+'"]').attr('selected','selected').siblings().removeAttr('selected');
					filterPosts('projects',$this.attr('href'),$this.data('count'),controller_opt.projectPerPage,$this.data('filter-id'),$('#project-filter').data('layout'),$('#project-filter').data('full'));
				});

				$('#project-filter select').on('change',function(){

					var $this = $(this);

					$this.parent().find('.filter[href="'+$this.val()+'"]').addClass('active').siblings().removeClass('active');
					filterPosts('projects',$this.val(),$this.find('option:selected').data('count'),controller_opt.projectPerPage,$this.find('option:selected').data('filter-id'),$('#project-filter').data('layout'),$('#project-filter').data('full'));
				});
			}

			fetchPosts('projects');
		}

		if ($('#loop-products').length) {
			if (!$('#loop-products').parent().hasClass('related')) {
				fetchPosts('products');
			}
		}

		$('.see-responses').on('click',function(e){
			e.preventDefault();
			$(this).next('.responses').toggleClass('active');
			
		});

		$('.post-social-share').each(function(){

			var $this  = $(this),
				toggle = $this.find('.social-toggle'),
				links  = $this.find('.social-links'),
				a      = links.children();

			var tl = new gsap.timeline({paused: true});

			tl.staggerFrom(a,0.6, {
				x:'24px',
				opacity:0,
				ease:"elastic.out(1, 0.5)",
		  	},-0.05);

			toggle.on('click',function(e){
				e.preventDefault();
				var $this = $(this);
				if (links.hasClass('active')) {
					links.removeClass('active');
				} else {
					links.addClass('active');
					tl.progress(0);
					tl.play();
				}
			});
		});

		listImages();

		$(window).on('resize',function(){
			listImages();
		});

		boxMove('.full .loop-projects > .project');

		ajaxAddToCart();

		$('.et-shortcode-posts.full').each(function(){

			var $this = $(this);

			$this.find('.full-content').cursorColor();

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
	            offset: 'bottom-in-view'
            });

		});

		$('.et-shortcode-projects.filter').each(function(){
			
			var $this   = $(this),
				request = false;

			$this.find('.et-post-filter a').on('click',function(e){

				var filter = $(this)

				e.preventDefault();
				filter.addClass('active').siblings().removeClass('active');
				filter.parent().find('select option[value="'+filter.attr('href')+'"]').attr('selected','selected').siblings().removeAttr('selected');
				filterPosts('projects',filter.attr('href'),filter.data('count'),$this.find('.et-post-filter').data('posts-per-page'),filter.data('filter-id'),$this.find('.et-post-filter').data('layout'),$this.find('.et-post-filter').data('full'),$this.data('id'));
			});

			$this.find('.et-post-filter select').on('change',function(){

				var filter = $(this);

				filter.parent().find('.filter[href="'+filter.val()+'"]').addClass('active').siblings().removeClass('active');
				filterPosts('projects',filter.val(),filter.find('option:selected').data('count'),$this.find('.et-post-filter').data('posts-per-page'),filter.find('option:selected').data('filter-id'),$this.find('.et-post-filter').data('layout'),$this.find('.et-post-filter').data('full'),$this.data('id'));
			});

		});

	})(jQuery);