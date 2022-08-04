<?php

/*  ELEMENTS
/*------------*/

	/* TYPOGRAPHY
	---------------*/

		/*	et_heading
		--------------*/

			function et_heading($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'type'             => 'h1',
						'link'             => '',
						'target'           => '_self',
						'text_align'       => 'left',
						'highlight'        => 'false',
						'tablet_text_align'=> 'inherit',
						'mobile_text_align'=> 'inherit',
						'mfs'              => 'i',
						'mls'              => 'i',
						'mf'               => 'i',
						'ml'               => 'i',
						'tlf'              => 'i',
						'tll'              => 'i',
						'tpf'              => 'i',
						'tpl'              => 'i',
						'extra_class'      => '',
						'element_id'       => '',
						'animation_type'   => 'curtain',
						'animate'          => 'false',
						'delay'            => '0'
					), $atts)
				);

				static $id_counter = 1;

				$output = '';

				$class   = array();
				$class[] = 'et-heading';
				$class[] = 'text-align-'.$text_align;
				$class[] = 'highlight-'.$highlight;

				if ($tablet_text_align != 'inherit') {
					$class[] = 'text768-1023-align-'.$tablet_text_align;
				}

				if ($mobile_text_align != 'inherit') {
					$class[] = 'text767-align-'.$mobile_text_align;
				}

				if ($animate == "true") {
					$class[] = 'animate-'.$animate;
					$class[] = $animation_type;
				}

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$attributes   = array();

				if ($animate == "true") {
					$attributes[] = 'data-delay="'.esc_attr(absint($delay)).'"';
				}

				if ($mfs != 'i') {
					$attributes[] = 'data-374-f="'.esc_attr($mfs).'"';
				}
				if ($mls != 'i') {
					$attributes[] = 'data-374-lh="'.esc_attr($mls).'"';
				}

				if ($mf != 'i') {
					$attributes[] = 'data-375-767-f="'.esc_attr($mf).'"';
				}
				if ($ml != 'i') {
					$attributes[] = 'data-375-767-lh="'.esc_attr($ml).'"';
				}

				if ($tpf != 'i') {
					$attributes[] = 'data-768-1023-f="'.esc_attr($tpf).'"';
				}
				if ($tpf != 'i') {
					$attributes[] = 'data-768-1023-lh="'.esc_attr($tpl).'"';
				}

				if ($tlf != 'i') {
					$attributes[] = 'data-1024-1279-f="'.esc_attr($tlf).'"';
				}
				if ($tll != 'i') {
					$attributes[] = 'data-1024-1279-lh="'.esc_attr($tll).'"';
				}

				if (isset($content) && !empty($content)) {
					$output .= '<'.$type.' class="'.implode(" ",$class).'" id="et-heading-'.$element_id.'" '.implode(" ",$attributes).'>';

						if (isset($link) && !empty($link)) {
							$output .= '<a href="'.esc_url($link).'" target="'.esc_attr($target).'">';
						}
							$output .= '<span class="text-wrapper">';

								$content = preg_replace("/_br_/","[et_gap]",$content);

								$output .= '<span class="text">'.do_shortcode($content).'</span>';
								if ($animation_type == "curtain") {
									$output .= '<span class="curtain"></span>';
								}
							$output .= '</span>';

						if (isset($link) && !empty($link)) {
							$output .= '</a>';
						}

					$output .= '</'.$type.'>';
				}

				$id_counter++;

				return $output;
			}

			add_shortcode('et_heading', 'et_heading');

		/*	et_blockquote
		--------------*/

			function et_blockquote($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'image'       => '',
						'text'        => '',
						'author'      => '',
						'title'       => '',
						'extra_class' => '',
						'element_id'  => '',
					), $atts)
				);

				static $id_counter = 1;

				$output      = '';

				$class   = array();
				$class[] = 'et-blockquote';

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				if (isset($text) && !empty($text)) {
					$output .= '<div class="'.implode(" ",$class).'" id="et-blockquote-'.$element_id.'">';
						if ($image) {
						
							$image = wp_get_attachment_image_src($image, 'full');

							$image_src      = $image[0];
							$image_width    = $image[1];
							$image_height   = $image[2];
							$image_caption  = get_the_post_thumbnail_caption($image);
							$image_alt 	    = (empty($image_caption)) ? get_bloginfo('name') : $image_caption;

							$output .= '<img src="'.esc_url($image_src).'" width="'.$image_width.'" height="'.$image_height.'" alt="'.$image_alt.'" />';

						}

						$output .= '<div class="author-wrapper et-clearfix">';
							$output .= '<blockquote>'.do_shortcode($text).'</blockquote>';
							$output .= '<div class="author-info-wrapper et-clearfix">';
								if (isset($author) && !empty($author)) {
									$output .= '<h5 class="author">'.esc_html($author).'</h5>';
								}
								if (isset($title) && !empty($title)) {
									$output .= '<span class="title">'.esc_html($title).'</span>';
								}
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				}
				$id_counter++;

				return $output;
			}

			add_shortcode('et_blockquote', 'et_blockquote');

	/* UI
	---------------*/

		/*	et_menu
		--------------*/

			function et_menu($atts, $content = null) {

				global $textron_enovathemes;

				$main_color = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';

				extract(shortcode_atts(
					array(
						'menu'            		=> '',
						'align'                 => 'none',
						'menu_hover'            => 'none',
						'submenu_appear'        => 'none',
						'submenu_appear_from'   => 'bottom',
						'submenu_shadow'        => 'false',
						'submenu_indicator'     => 'false',
						'submenu_separator'     => 'false',
						'menu_separator'        => 'false',
						'menu_color'            => '',
						'menu_color_hover'      => $main_color,
						'submenu_submenu_indicator' => 'false',
						'extra_class'     		=> '',
						'element_id'            => '',
					), $atts)
				);

				static $id_counter = 1;

				$output      = '';

				$class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-menu-container';
				$class[] = 'nav-menu-container';
				$class[] = 'menu-align-'.$align;
				$class[] = 'menu-hover-'.$menu_hover;
				$class[] = 'submenu-appear-'.$submenu_appear;
				$class[] = 'submenu-appear-from-'.$submenu_appear_from;
				$class[] = 'submenu-shadow-'.$submenu_shadow;
				$class[] = 'tl-submenu-ind-'.$submenu_indicator;
				$class[] = 'sl-submenu-ind-'.$submenu_submenu_indicator;
				$class[] = 'separator-'.$submenu_separator;
				$class[] = 'top-separator-'.$menu_separator;

				if($menu_hover == "underline") {
					$link_after  = '<span class="effect"></span></span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>';
				} else {
					$link_after  = '</span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span><span class="effect"></span>';
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				if (isset($menu) && !empty($menu)) {
					$menu_arg = array(
						'menu'  => $menu,
						'menu_class'      => 'et-menu nav-menu et-clearfix',
						'menu_id'         => 'et-menu-'.$element_id,
						'container'       => 'nav',
						'container_class' => implode(" ", $class),
						'container_id'    => 'et-menu-container-'.$element_id,
						'items_wrap'      => '<ul id="%1$s" class="%2$s" data-color="'.esc_attr($menu_color).'" data-color-hover="'.esc_attr($menu_color_hover).'">%3$s</ul>',
						'echo'            => false,
						'link_before'     => '<span class="txt">',
						'link_after'      => $link_after,
						'depth'           => 10,
						'walker'          => new et_scm_walker
					);
				} 	

				$output .= wp_nav_menu($menu_arg);

				$id_counter++;

				return $output;
			}

			add_shortcode('et_menu', 'et_menu');

		/*  et_button
	    --------------*/

		    function et_button( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'button_text' 		    => '',
					'button_link' 	        => '',
					'target'                => '_self',
					'button_link_modal'     => 'false',
					'width'                 => 220,
					'height'				=> 56,
					'button_shadow' 	    => 'false',
					'button_style' 	        => 'normal',
					'button_type'           => 'round',
					'button_size'           => 'medium',
					'button_size_custom'    => 'false',
					'button_color'          => '#ffffff',
					'button_color_hover'    => '#ffffff',
					'icon' 	                => '',
					'icon_position'         => 'left',
					'animate_hover' 	    => 'none',
					'animate_hover_outline' => 'none',
					'click_smooth' 	        => 'false',
					'animation'             => 'none',
					'animation_delay'       => '',
					'extra_class'           => '',
		            'element_id'            => '',
				), $atts));

				static $id_counter = 1;

	            $output      = '';

	            $class = array();


				if ($button_style == "outline") {
					$animate_hover = $animate_hover_outline;
				}

				if ($button_size_custom == "true") {
	            	$button_size = 'custom';
	            }

	            $class[] = 'et-button';
	            $class[] = 'icon-position-'.$icon_position;
	            $class[] = 'modal-'.$button_link_modal;
	            $class[] = 'hover-'.$animate_hover;
				$class[] = 'smooth-'.$click_smooth;
	            $class[] = 'shadow-'.$button_shadow;
	            $class[] = $animation;
				$class[] = $button_type;
				$class[] = $button_style;
				$class[] = $button_size;

				if ($button_link_modal == "true") {
					$target = "_self";
				}

				if (isset($click_smooth) && $click_smooth == "true") {
					$class[] = 'click-smooth';
				}

				if (isset($extra_class) && !empty($extra_class)) {
					$class[] = $extra_class;
				}

	            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

				if ($button_link_modal == "true") {$target = "_self";}

				$attributes   = array();
				$attributes[] = 'target="'.esc_attr($target).'"';
				$attributes[] = 'href="'.esc_url($button_link).'"';
				$attributes[] = 'data-effect="'.esc_attr($animate_hover).'"';

				if ($animation != "none") {

					if (
						$animation != 'top-to-bottom' &&
						$animation != 'bottom-to-top' &&
						$animation != 'left-to-right' &&
						$animation != 'right-to-left' &&
						$animation != 'appear'
					) {
						wp_enqueue_style( 'vc_animate-css' );
					}

					$attributes[] = 'data-del="'.esc_attr($animation_delay).'"';
					$class[]      = 'wpb_animate_when_almost_visible';

				}

				if ($animate_hover == 'fill') {
					$attributes[] = 'data-color="'.esc_attr($button_color).'"';
					$attributes[] = 'data-color-hover="'.esc_attr($button_color_hover).'"';
				}

				if ($button_size_custom == "false") {

					if ($button_size == "small") {
						$width = 180;
						$height= 48;
					}

					if ($button_size == "large") {
						$width = 256;
						$height= 64;
					}

				}

				if (isset($button_text) && !empty($button_text) && isset($button_link) && !empty($button_link)) {
					$output .='<a id="et-button-'.$element_id.'" class="'.implode(" ", $class).'" '.implode(" ", $attributes).'>';

						$icon_output = '';

						if (isset($icon) && !empty($icon)) {

							$icon = get_post($icon);

							if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {
								$icon_output = '<span class="icon">'.file_get_contents($icon->guid).'</span>';
							}

						}

						if ($icon_position == "left" && !empty($icon_output)) {$output .= $icon_output;}
						$output .='<span class="text">'.esc_attr($button_text).'</span>';
						if ($icon_position == "right" && !empty($icon_output)) {$output .= $icon_output;}

						// Button types
						if ($button_type == 'round') {

							$d       = 'M192,56H28A28,28,0,0,1,28,0H192A28,28,0,0,1,192,56Z';
							$d_hover = ($animate_hover == "click") ? 'M192,56A519,519,0,0,0,28,56A23,27,0,0,1,28,0A519,519,0,0,0,192,0A23,27,0,0,1,192,56Z' : $d;

						} else {

							$d       = 'M212,56H8A9,9,0,0,1,0,48V8A9,9,0,0,1,8,0H212A9,9,0,0,1,220,8V48A9,9,0,0,1,212,56Z';
							$d_hover = ($animate_hover == "click") ? 'M212,56A999,999,0,0,0,8,56A9,9,0,0,1,0,48A99,99,0,0,0,0,8A9,9,0,0,1,8,0A999,999,0,0,0,212,0A9,9,0,0,1,220,8A99,99,0,0,0,220,48A9,9,0,0,1,212,56Z' : $d;

						}

						if ($width != 220 || $height != 56) {

							if ($height%2) {$height -= 1;}
							if ($width%2)  {$width -= 1;}

							if ($button_type == 'round') {

								$width_replace  	    = 192;
								$height_replace 	    = 56;
								$corner_replace 	    = 28;
								$hover_curve_replace_x  = 23;
								$hover_curve_replace_y  = 27;

								$corner 	            = $height/2;
								$hover_curve_x          = ($height/2) - 3;
								$hover_curve_y          = ($height/2) - 1;
								$width_corner           = $width - $corner;

								$d = str_replace($corner_replace,$corner,$d);
								$d = str_replace($height_replace,$height,$d);
								$d = str_replace($width_replace,$width_corner,$d);

								$d_hover = str_replace($corner_replace,$corner,$d_hover);
								$d_hover = str_replace($height_replace,$height,$d_hover);
								$d_hover = str_replace($width_replace,$width_corner,$d_hover);

								if ($animate_hover == "click") {
									$d_hover = str_replace($hover_curve_replace_x,$hover_curve_x,$d_hover);
									$d_hover = str_replace($hover_curve_replace_y,$hover_curve_y,$d_hover);
								}

							} else {

								$width_replace  	    = 220;
								$height_replace 	    = 56;
								$width_corner_replace 	= 212;
								$height_corner_replace 	= 48;
								$width_corner           = $width - 7;
								$height_corner          = $height - 7;

								$d = str_replace($height_corner_replace,$height_corner,$d);
								$d = str_replace($width_corner_replace,$width_corner,$d);
								$d = str_replace($height_replace,$height,$d);
								$d = str_replace($width_replace,$width,$d);

								$d_hover = str_replace($height_corner_replace,$height_corner,$d_hover);
								$d_hover = str_replace($width_corner_replace,$width_corner,$d_hover);
								$d_hover = str_replace($height_replace,$height,$d_hover);
								$d_hover = str_replace($width_replace,$width,$d_hover);


							}

						}

						$output .='<svg viewBox="0 0 '.$width.' '.$height.'" class="button-back">';
							$output .='<path class="regular" d="'.$d.'" data-hover="'.$d_hover.'"/>';
							if ($animate_hover == "fill") {
						    	$output .='<path transform="translate(-'.$width.' 0)" class="hover" d="'.$d_hover.'" />';
							}
						$output .='</svg>';
					$output .='</a>';
				}

				$id_counter++;

				return $output;
			}
			add_shortcode('et_button', 'et_button');

		/*	et_separator
		--------------*/

			function et_separator($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'type'        => 'solid',
						'align'       => 'left',
						'extra_class' => '',
						'element_id'  => '',
						'animate'     => 'false',
						'start_delay' => '',
						'width'       => '',
						'height'      => '',
						'rv'          => '',
					), $atts)
				);

				static $id_counter = 1;

				$class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$responsive_visibility = array();

				if (!empty($rv)) {
					$rv = explode(',', $rv);

					foreach ($rv as $key) {
						$responsive_visibility[] = 'hide'.$key;
					}

				}

				$class[] = 'et-separator';
				$class[] = 'et-clearfix';
				$class[] = 'animate-'.$animate;
				$class[] = $type;
				$class[] = $align;

				if (isset($width) && !empty($width)) {
					if ($width > $height) {
						$class[] = 'horizontal';
					} else {
						$class[] = 'vertical';
					}
				} else {
					$class[] = 'horizontal';
				}

		        $element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$class[] = 'et-separator-'.$element_id;

				if (!empty($responsive_visibility)) {
					$class = array_merge($class,$responsive_visibility);
				}

				$output = '<div class="'.implode(" ", $class).'" data-delay="'.esc_attr($start_delay).'"><div class="line"></div></div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_separator', 'et_separator');

		/*	et_icon_separator
		--------------*/

			function et_icon_separator($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'type'        => 'solid',
						'align'       => 'left',
						'extra_class' => '',
						'element_id'  => '',
						'width'       => '120',
						'height'      => '',
						'icon'        => '',
						'icon_size'   => 'small',
					), $atts)
				);

				static $id_counter = 1;

				$class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-icon-separator';
				$class[] = 'et-clearfix';
				$class[] = $align;

		        $element_id = (!empty($element_id)) ? $element_id : $id_counter;

		        $class[] = 'et-icon-separator-'.$element_id;

				if (isset($icon) && !empty($icon)) {

					$icon = get_post($icon);

					if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {

						$icon_output = file_get_contents($icon->guid);

						$output = '';

						$output .= '<div class="'.implode(" ", $class).'" >';
							if ($align != 'left') {
								$output .= '<span class="left line '.$icon_size.'"></span>';
							}
							$output .= '<span class="icon '.$icon_size.'">'.$icon_output.'</span>';
							if ($align != 'right') {
								$output .= '<span class="right line '.$icon_size.'"></span>';
							}
						$output .= '</div>';

					}

				}

				$id_counter++;

				return $output;
			}
			add_shortcode('et_icon_separator', 'et_icon_separator');

		/*  et_icon
	    --------------*/

	        function et_icon($atts, $content = null) {

	            extract(shortcode_atts(
	                array(
						'icon'          => '',
						'size'          => 'medium',
						'icon_link'     => '',
						'target' 	    => '_self',
						'click'         => 'false',
						'shadow'        => '',
	                    'extra_class'   => '',
	                    'element_id'    => '',
	                ), $atts)
	            );


	            static $id_counter = 1;

	            $output = $icon_output = '';

	            $class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

	            $class[] = 'et-icon';
				$class[] = 'size-'.$size;
	            $class[] = 'click-'.$click;
	            $class[] = 'shadow-'.$shadow;

	            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

	            $class[] = 'et-icon-'.$element_id;

				if (isset($icon) && !empty($icon)) {

					$icon = get_post($icon);

					if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {

						$icon_output = file_get_contents($icon->guid);

						$size = 40;

						if ($size == "small") {
							$size = 32;
						}elseif ($size == "large") {
							$size = 48;
						}

						$s2  = $size/2;
						$size_hover = $size + 4;

						$d 	     = 'M'.$s2.','.($size + 2).'A'.$s2.','.$s2.',0,0,1,'.$s2.',2A'.$s2.','.$s2.',0,0,1,'.$s2.','.($size + 2).'Z';
						$d_hover = 'M'.$s2.','.$size_hover.'C -2 '.($size_hover+2).',-2 -2,'.$s2.' 0,C '.$size_hover.' -2,'.$size_hover.' '.($size_hover+2).','.$s2.' '.$size_hover.'Z';

						$icon_back   = '<svg viewBox="0 0 '.$size.' '.$size.'" class="icon-back">';
							$icon_back .='<path d="'.$d.'" data-hover="'.$d_hover.'"/>';
						$icon_back .='</svg>';

			            $output .= '<div class="'.implode(" ", $class).'">';
			            	if (!empty($icon_link)) {
			            		$output .= '<a href="'.esc_url($icon_link).'" target="'.esc_attr($target).'">';
									$output .= $icon_output;
									$output .= $icon_back;
								$output .= '</a>';
			            	} else {
								$output .= $icon_output;
								$output .= $icon_back;
			            	}
			            $output .= '</div>';

					} else {
						$output .= esc_html__("Please upload svg");
					}

		            $id_counter++;

		            return $output;

		        }
	        }

	        add_shortcode('et_icon', 'et_icon');

		/*	et_icon_list
		--------------*/

			function et_icon_list($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'icon_size'          => 'medium',
						'icon'               => '',
						'element_id'         => '',
						'icon_background_color'    => '',
						'icon_border_width'  => '0',
						'shadow'             => '',
						'animate'            => '',
					    'delay'              => '',
						'extra_class'        => ''
					), $atts)
				);


				$output = "";

				static $id_counter = 1;

				$class = array();
				$attributes = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-icon-list';
				$class[] = $icon_size;

				if (isset($shadow) && $shadow == 'true') {
					$class[] = 'shadow';
				}

				if ((isset($icon_border_width) && !empty($icon_border_width)) || isset($icon_background_color) && !empty($icon_background_color)) {
					$class[] = 'full';
				}

				if ($animate == "true") {
					$attributes[] = 'data-delay="'.esc_attr(absint($delay)).'"';
				}

				if ($animate == "true") {
					$class[] = 'animate-'.$animate;
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				if (isset($icon) && !empty($icon)) {

					$icon = get_post($icon);

					if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {

						$icon_output = file_get_contents($icon->guid);

						$output .= '<ul id="et-icon-list-'.$element_id.'" class="'.implode(" ", $class).'" '.implode(" ", $attributes).'>';
							$split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/", $content);
							foreach($split as $haystack) {
					            $output .= '<li>';
					            	$output .= '<div class="icon-wrap">';
						            	$output .= '<div class="et-icon size-'.esc_attr($icon_size).'">';
					            			$output .= $icon_output;
					            		$output .= '</div>';
				            		$output .= '</div>';
					            	$output .= '<div>' . do_shortcode($haystack) . '</div>';
					            $output .= '</li>';
					        }
					    $output .= '</ul>';
					}   
				}

				$id_counter++;

				return $output;
			}
			add_shortcode('et_icon_list', 'et_icon_list');

		/*	et_accordion
		--------------*/

			function et_accordion($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'collapsible' => 'false',
						'element_id'  => '',
					), $atts)
				);

				$output = '';
				static $id_counter = 1;

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$output .= '<div class="et-accordion-wrapper">';
					$output .='<div id="et-accordion-'.$element_id.'" class="et-accordion et-clearfix collapsible-'.esc_attr($collapsible).'">';
						$output .= do_shortcode($content);
					$output .= '</div>';
				$output .= '</div>';

				$id_counter++;

				return $output;

			}
			add_shortcode('et_accordion', 'et_accordion');

			function et_accordion_item($atts, $content = null) {

				extract(shortcode_atts(array(
					'title' => '',
					'icon'  => '',
					'open'  => 'false'
				), $atts));

				$output = '';
				static $id_counter = 1;

				$class = array();


				$class[] = 'toggle-title';
				$class[] = 'et-clearfix';

				if($open == 'true'){
					$class[] = "active";
				}

				if (isset($icon) && !empty($icon)) {
					$class[] = 'icon';
				}

				$output .= '<div class="'.implode(' ', $class).'">';

					if (isset($icon) && !empty($icon)) {
						$icon = get_post($icon);
						if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {
							$icon_output = file_get_contents($icon->guid);
							$output .= '<span class="toggle-icon">'.$icon_output.'</span>';
						}
					}

					if (isset($title) && !empty($title)) {
						$output .= esc_attr($title);
					}

					$output .= '<span class="toggle-ind">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>';
				$output .= '</div> ';

				$output .= '<div id="'.sanitize_title($title).'-'.$id_counter.'" class="toggle-content">';
					$output .= '<div class="toggle-content-inner et-clearfix">';
				    	$output .= do_shortcode($content);
				    $output .= '</div> ';
				$output .= '</div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_accordion_item', 'et_accordion_item');

		/*	et_tab
		--------------*/

			function et_tab($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'type'   => 'horizontal',
						'center' => 'false',
						'element_id'  => '',
					), $atts)
				);

				$output = '';
				static $id_counter = 1;

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$class = array();

				$class[] = 'et-tab';
				$class[] = 'et-clearfix';
				$class[] = 'center-'.esc_attr($center);
				$class[] = $type;

				$output .= '<div class="et-tab-wrapper">';
					$output .='<div id="et-tab-'.$element_id.'" class="'.implode(" ", $class).'">';
						$output .= do_shortcode($content);
					$output .= '</div>';
				$output .= '</div>';

				$id_counter++;

				return $output;

			}
			add_shortcode('et_tab', 'et_tab');

			function et_tab_item($atts, $content = null) {

				extract(shortcode_atts(array(
					'title'  => '',
					'icon'   => '',
					'active' => 'false',
				), $atts));

				$output = '';
				$class  = '';

				static $id_counter = 1;

				if($active == 'true'){
					$active = "active";
				}

				if (isset($icon) && !empty($icon)) {
					$class = 'icon';
				}


				$output .= '<div data-target="tab-'. sanitize_title( $title ) .'" class="'.esc_attr($active).' '.esc_attr($class).' tab et-clearfix">';
					if (isset($icon) && !empty($icon)) {
						$icon = get_post($icon);
						if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {
							$icon_output = file_get_contents($icon->guid);
							$output .= '<span class="icon">'.$icon_output.'</span>';
						}
					}
					if (isset($title) && !empty($title)) {
						$output .= esc_html($title);
					}
				$output .= '</div> ';
				$output .= '<div id="tab-'.sanitize_title($title).'-'.$id_counter.'" class="tab-content et-clearfix">';
				    $output .= do_shortcode($content);
				$output .= '</div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_tab_item', 'et_tab_item');

		/*	et_animate_box
		--------------*/

			function et_animate_box($atts, $content = null) {

				$main_color = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';

				extract(shortcode_atts(
					array(
						'element_id'    => '',
						'extra_class'   => '',
						'crp'           => '',
						'animation'     => 'top',
						'stagger'       => 'none',
						'delay'         => '0',
						'color'         => $main_color
					), $atts)
				);

				$output = "";

				static $id_counter = 1;

				$class      = array();
				$attributes = array();
				$padding_data = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-animate-box';

				if (!empty($crp)) {
					$crp = explode(',', $crp);

					$query_array = array();

					foreach ($crp as $key => $value) {
						array_push($query_array, explode(':', $value));
					}

					foreach ($query_array as $key => $value) {
						if ($value[1] != "i") {
							$padding_data[] = 'data-'.$value[0].'-l="'.$value[1].'" ';
						}
						if ($value[2] != "i") {
							$padding_data[] = 'data-'.$value[0].'-r="'.$value[2].'" ';
						}
					}
				}

				$attributes[] = 'data-delay="'.esc_attr($delay).'"';

				if (isset($animation)) {
					$attributes[] = 'data-animation="'.$animation.'"';
				}

				if (isset($stagger)) {
					$attributes[] = 'data-stagger="'.$stagger.'"';
				}

				if (isset($color)) {
					$attributes[] = 'data-color="'.$color.'"';
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$class[] = 'et-animate-box-'.$element_id;

				$output .='<div id="et-animate-box-'.$element_id.'" class="'.implode(' ', $class).'" '.implode(' ', $attributes).'>';
					$output .='<div class="content vci" '.implode(' ', $padding_data).'>'.do_shortcode($content).'</div>';

					switch ($animation) {
						case 'top':
							$d  = 'M0,0A133,133,0,0,0,100,0V110A133,133,0,0,1,0,110V0Z';
							break;
						case 'bottom':
							$d  = 'M0,10A133,133,0,0,1,100,10V120A133,133,0,0,0,0,120V10Z';
							break;
						case 'left':
							$d  = 'M0,0H100A133,133,0,0,1,90,120H0A133,133,0,0,0,0,0Z';
							break;
						case 'right':
							$d  = 'M10,0H100A133,133,0,0,0,100,120H10A133,133,0,0,1,10,0Z';
							break;
					}

					$output .='<svg viewBox="0 0 100 120" class="box-back">';
						$output .='<path d="'.$d.'" data-dclone="'.$d.'" data-end="M0,0H100V120H0V0Z"/>';
					$output .='</svg>';

				$output .='</div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_animate_box', 'et_animate_box');

		/*	et_stagger_box
		--------------*/

			function et_stagger_box($atts, $content = null) {

				$main_color = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';

				extract(shortcode_atts(
					array(
						'element_id'    => '',
						'extra_class'   => '',
						'stagger'       => 'top',
						'delay'         => '0',
						'interval'      => '50',
					), $atts)
				);

				$output = "";

				static $id_counter = 1;

				$class      = array();
				$attributes = array();
				$padding_data = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-stagger-box';


				$attributes[] = 'data-delay="'.esc_attr($delay).'"';
				$attributes[] = 'data-interval="'.esc_attr($interval).'"';


				if (isset($stagger)) {
					$attributes[] = 'data-stagger="'.$stagger.'"';
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$class[] = 'et-stagger-box-'.$element_id;

				$output .='<div id="et-stagger-box-'.$element_id.'" class="'.implode(' ', $class).'" '.implode(' ', $attributes).'>';
					$output .='<div class="content">'.do_shortcode($content).'</div>';
				$output .='</div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_stagger_box', 'et_stagger_box');

	/* SOCIAL
	---------------*/

		/*	et_social_links
		--------------*/

			function et_social_links($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'extra_class'     		=> '',
						'element_id'            => '',
						'target' 				=> '_self',
						'styling_original'      => 'false',
						'size'                  => 'small',
						'icon_background_color' => '',
						'icon_border_color'     => '',
						'shadow'                => '',
					), $atts)
				);

				static $id_counter = 1;

				$output      = '';

				$class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-social-links';
				$class[] = 'styling-original-'.$styling_original;
				$class[] = 'size-'.$size;

				if ((!isset($icon_background_color) || empty($icon_background_color)) && (!isset($icon_border_color) || empty($icon_border_color)) && $styling_original == 'false') {
					$class[] = 'free';
				}

				if (isset($shadow) && !empty($shadow)) {
					$class[] = 'shadow-true';
				}


				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$output .= '<div id="et-social-links-'.$element_id.'" class="'.implode(" ", $class).'">';
					foreach($atts as $social => $href) {
						if($href && $social != 'target' && $social != 'icon_color' && $social != 'icon_color_hover' && $social != 'icon_background_color' && $social != 'icon_background_color' && $social != 'icon_background_color_hover' && $social != 'icon_border_color' && $social != 'icon_border_color_hover' && $social != 'icon_border_width' && $social != 'styling_original' && $social != 'shadow' && $social != 'element_id' && $social != 'element_css' && $social != 'size') {
							$output .='<a class="'.$social.'" href="'.$href.'" target="'.esc_attr($target).'" title="'.$social.'">';
								$output .= file_get_contents(THEME_SVG.'social/'.$social.'.svg');
							$output .='</a>';
						}
					}
				$output .= '</div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_social_links', 'et_social_links');

		/*	et_social_share
		--------------*/

			function et_social_share($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'extra_class'     		=> '',
						'element_id'            => '',
						'target' 				=> '_self',
						'styling_original'      => 'false',
						'icon_background_color' => '',
						'icon_border_color'     => '',
						'shadow'                => '',
					), $atts)
				);

				static $id_counter = 1;

				$output      = '';

				$class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-social-share';
				$class[] = 'et-social-links';
				$class[] = 'styling-original-'.$styling_original;

				if (isset($shadow) && !empty($shadow)) {
					$class[] = 'shadow-true';
				}

				if ((!isset($icon_background_color) || empty($icon_background_color)) && (!isset($icon_border_color) || empty($icon_border_color)) && $styling_original == 'false') {
					$class[] = 'free';
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$output = '<div id="et-social-share-'.$element_id.'" class="'.implode(" ", $class).'">';
		            $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
		            $output .= '<div class="social-links et-clearfix">';
		                $output .= '<a title="'.esc_html__("Share on Facebook", 'enovathemes-addons').'" class="facebook social-share post-facebook-share" target="_blank" href="//facebook.com/sharer.php?u='.urlencode(get_the_permalink(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/facebook.svg').'</a>';
		                $output .= '<a title="'.esc_html__("Tweet this!", 'enovathemes-addons').'" class="twitter social-share post-twitter-share" target="_blank" href="//twitter.com/intent/tweet?text='.urlencode(get_the_title(get_the_ID()).' - '.get_the_permalink(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/twitter.svg').'</a>';
		                $output .= '<a title="'.esc_html__("Share on Pinterest", 'enovathemes-addons').'" class="pinterest social-share post-pinterest-share" target="_blank" href="//pinterest.com/pin/create/button/?url='.urlencode(get_the_permalink(get_the_ID())).'&media='.urlencode(esc_url($url)).'&description='.rawurlencode(get_the_title(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/pinterest.svg').'</a>';
		                $output .= '<a title="'.esc_html__("Share on LinkedIn", 'enovathemes-addons').'" class="linkedin social-share post-linkedin-share" target="_blank" href="//www.linkedin.com/shareArticle?mini=true&url='.urlencode(get_the_permalink(get_the_ID())).'&title='.rawurlencode(get_the_title(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/linkedin.svg').'</a>';
		                $output .= '<a title="'.esc_html__("Share on Whatsapp", 'enovathemes-addons').'" class="whatsapp social-share post-whatsapp-share" target="_blank" href="whatsapp://send?text='.urlencode(get_the_permalink(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/whatsapp.svg').'</a>';
		                $output .= '<a title="'.esc_html__("Share on Viber", 'enovathemes-addons').'" class="viber social-share post-viber-share" target="_blank" href="viber://forward?text='.urlencode(get_the_permalink(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/viber.svg').'</a>';
		                $output .= '<a title="'.esc_html__("Share on Telegram", 'enovathemes-addons').'" class="telegram social-share post-telegram-share" target="_blank" href="tg://msg_url?url='.urlencode(get_the_permalink(get_the_ID())).'&text='.rawurlencode(get_the_title(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/telegram.svg').'</a>';
		            $output .= '</div>';

		        $output .= '</div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_social_share', 'et_social_share');

		/*  et_mailchimp
		/*------------*/

			function et_mailchimp($atts, $content = null) {

				extract(shortcode_atts(
					array(
			 			'list'        => '',
			 			'element_id'  => '',
					), $atts)
				);

				$output = '';

				static $id_counter = 1;

					$element_id = (!empty($element_id)) ? $element_id : $id_counter;

					$args = array(
						'before_widget' => '<div id="et-mailchimp-'.$element_id.'" class="et-mailchimp widget_mailchimp">',
						'after_widget'  => '</div>',
						'before_title'  => '<h5 class="widget_title">',
		                'after_title'   => '</h5>',
					);

					$instance = array(
						'title'                => '',
			 			'description'          => '',
			 			'list'                 => $list,
			 			'first_name'           => false,
			 			'last_name'            => false,
			 			'phone'                => false,
			 			'required_first_name'  => false,
			 			'required_last_name'   => false,
			 			'required_phone'       => false,
					);

					$output .= textron_enovathemes_get_the_widget( 'Enovathemes_Addons_WP_Widget_Mailchimp', $instance,$args);

				$id_counter++;

				return $output;
			}

			add_shortcode('et_mailchimp', 'et_mailchimp');

		/*  et_instagram
		/*------------*/

			function et_instagram($atts) {

				extract(
				 	shortcode_atts(
					array(
						'username' => '',
						'number'   => '',
						'type'     => 'grid',
						'columns'  => '1',
					), $atts)
				);

				static $id_counter = 1;

				$output = "";

				$carousel_wrapper_start = "";
				$carousel_wrapper_end   = "";

				$class   = array();
				$class[] = 'et-instagram';

				if ($type == 'et-carousel') {
					$type = 'carousel';
					$carousel_wrapper_start = '<div class="slides">';
					$carousel_wrapper_end   = '</div>';
				}

				$class[] = esc_attr($type);

				if (isset($username) && !empty($username)) {

					$output .='<div id="et-instagram-'.$id_counter.'" data-columns="'.esc_attr($columns).'" data-username="'.esc_attr($username).'" data-limit="'.esc_attr($number).'" class="'.implode(" ", $class).'">';
						$output .= $carousel_wrapper_start;
						$output .= $carousel_wrapper_end;
					$output .= '</div>';

					$id_counter++;

					return $output;

				}
			}

			add_shortcode('et_instagram', 'et_instagram');

	/* SELFHOSTED
	---------------*/

		/*  et_icon_box
		/*------------*/

			function et_icon_box( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'icon_size'   		 => 'large',
					'icon'        		 => '',
					'title'              => '',
					'title_tag'          => 'default',
					'link'               => '',
					'icon_position'      => 'top',
					'icon_alignment'     => 'left',
					'icon_back_color'    => '',
					'icon_border_color'  => '',
					'icon_border_width'  => '0',
					'box_color'          => '',
					'box_color_hover'    => '',
					'animation'          => 'none',
					'shadow'             => '',
					'crp'                => '',
					'element_id'         => '',
					'extra_class'        => '',
				), $atts));

				$output = '';

				$link_before = "";
				$link_after  = "";

				static $id_counter = 1;

				$class      = array();
				$attributes = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				if (isset($link) && !empty($link)) {
					$link_before = '<a href="'.esc_url($link).'">';
					$link_after  = '</a>';
					$class[] = 'link';
				}

				$class[] = 'et-icon-box';
				$class[] = 'vci';
				$class[] = 'icon-position-'.esc_attr($icon_position);
				$class[] = 'icon-alignment-'.esc_attr($icon_alignment);
				$class[] = 'animation-'.esc_attr($animation);
				$class[] = esc_attr($icon_size);

				if (!isset($content) || empty($content)) {
					$class[] = 'no-content';
				}

				if (isset($shadow) && $shadow == 'true') {
					$class[] = 'shadow';
				}

				if (
					(isset($icon_border_width) && !empty($icon_border_width)) || 
					(isset($icon_back_color) && !empty($icon_back_color))
				) {
					$class[] = 'full';
				}

				if (!empty($crp)) {
					$crp = explode(',', $crp);

					$query_array = array();

					foreach ($crp as $key => $value) {
						array_push($query_array, explode(':', $value));
					}

					foreach ($query_array as $key => $value) {
						if ($value[1] != "i") {
							$attributes[] = 'data-'.$value[0].'-l="'.$value[1].'" ';
						}
						if ($value[2] != "i") {
							$attributes[] = 'data-'.$value[0].'-r="'.$value[2].'" ';
						}
					}
				}

				$color = '';

				if (empty($box_color_hover) && !empty($box_color)) {
					$color = $box_color;
				}

				if ((empty($box_color) && !empty($box_color_hover)) || (!empty($box_color) && !empty($box_color_hover))) {
					$color = $box_color_hover;
				}

				if (!empty($color)) {
					$attributes[] = 'data-color="'.esc_attr($color).'"';
				}

				$attributes[] = 'data-effect="'.esc_attr($animation).'"';

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$icon_output = '';

				if (isset($icon) && !empty($icon)) {

					$icon = get_post($icon);

					if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {
						$icon_output .= '<div class="et-icon '.esc_attr($icon_size).'">';
							$icon_output .= file_get_contents($icon->guid);
							if ((isset($icon_border_width) && !empty($icon_border_width)) || 
								(isset($icon_back_color) && !empty($icon_back_color))) {
								$icon_output .='<div class="icon-back"></div>';
		                    }
						$icon_output .= '</div>';
					}

				}

		        $output .='<div id="et-icon-box-'.$element_id.'" class="'.implode(' ', $class).'" '.implode(' ', $attributes).'>';
		        		
	        		$output .= $link_before;

		        		$output .='<div class="et-icon-box-inner et-clearfix '.esc_attr($icon_size).'">';
		        			
		        			if ($icon_position == 'left' || $icon_position == "top") {
		        				$output .= $icon_output;
		        			}
			        	
							$output .='<div class="et-icon-content">';
								if (isset($title) && !empty($title)) {

									$title = preg_replace("/_br_/","[et_gap]",$title);

									if ($title_tag == 'default') {
										$output .='<h4 class="et-icon-box-title default">'.do_shortcode($title).'</h4>';
									} else {
										$output .='<'.$title_tag.' class="et-icon-box-title">'.do_shortcode($title).'</'.$title_tag.'>';
									}
								}
								if (isset($content) && !empty($content)) {
									$output .='<p class="et-icon-box-content">'.do_shortcode(preg_replace("/_br_/","[et_gap]",$content)).'</p>';
								}
							$output .='</div>';

							if ($icon_position == 'right') {
		        				$output .= $icon_output;
		        			}

						$output .='</div>';

					$output .= $link_after;
						
				$output .='</div>';

				$id_counter++;

				return $output;

			}
			add_shortcode('et_icon_box', 'et_icon_box');

		/*  et_icon_box_container
		/*------------*/

			function et_icon_box_container( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'animation'         => 'none',
					'gap'               => 'false',
					'shadow'            => '',
					'columns'           => '1',
					'height'            => '0',
					'vertical_align'    => 'top',
					'element_id'        => '',
				), $atts));

				$output = '';

				static $id_counter = 1;

				$class 	    = array();
				$attributes = array();

				$class[] = 'columns-'.$columns;
				$class[] = 'et-icon-box-container';
				$class[] = 'gap-'.$gap;

				if ($height != "0") {
					$class[] = 'full';
				}

				if (isset($shadow) && !empty($shadow)) {
					$class[] = 'shadow';
				}

				$attributes[] = 'data-animation="'.$animation.'"';

				if (isset($vertical_align) && !empty($vertical_align)) {
					$class[] = $vertical_align;
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

		        $output .='<div id="et-icon-box-container-'.$element_id.'" class="'.implode(' ', $class).'" '.implode(' ', $attributes).'>';
	        		$output .=do_shortcode($content);
				$output .='</div>';

				$id_counter++;

				return $output;


			}
			add_shortcode('et_icon_box_container', 'et_icon_box_container');

		/*  et_step_box
		/*------------*/

			function et_step_box( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'title'       => '',
					'title_tag'   => 'h6',	
					'element_id'  => '',
					'extra_class' => '',
				), $atts));

				$output = '';

				static $id_counter = 1;

				$class = array();
				$attributes = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-step-box';

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

		        $output .='<div id="et-step-box-'.$element_id.'" class="'.implode(' ', $class).'">';
		        		$output .='<div class="et-step-box-inner et-clearfix">';
							$output .='<div class="step-count"></div>';
							if (isset($title) && !empty($title)) {
								$title = preg_replace("/_br_/","[et_gap]",$title);
								$output .='<'.$title_tag.' class="et-step-box-title">'.do_shortcode($title).'</'.$title_tag.'>';
							}
							if (isset($content) && !empty($content)) {
								$output .='<p class="et-step-box-content">'.do_shortcode($content).'</p>';
							}
						$output .='</div>';
				$output .='</div>';

				$id_counter++;

				return $output;


			}
			add_shortcode('et_step_box', 'et_step_box');

		/*  et_step_box_container
		/*------------*/

			function et_step_box_container( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'columns'        => '1',
					'extra_class'    => '',
				), $atts));

				$output = '';

				static $id_counter = 1;

				$class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'columns-'.$columns;

				$class[] = 'et-step-box-container';

		        $output .='<div id="et-step-box-container-'.$id_counter.'" class="'.implode(' ', $class).'">';
	        		$output .=do_shortcode($content);
				$output .='</div>';

				$id_counter++;

				return $output;


			}
			add_shortcode('et_step_box_container', 'et_step_box_container');

		/*	et_carousel
		--------------*/

			function et_carousel($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'columns'         => '1',
						'navigation_type' => 'arrows',
						'autoplay'        => 'false',
					), $atts)
				);

				$output = '';

				static $id_counter = 1;

				$attributes = array();

				$attributes[] = 'data-nav="'.$navigation_type.'"';
				$attributes[] = 'data-autoplay="'.$autoplay.'"';
				$attributes[] = 'data-columns="'.$columns.'"';

				$output .='<div id="et-carousel-'.$id_counter.'" class="et-carousel '.esc_attr($navigation_type).'" '.implode(' ', $attributes).'>';
					$output .= '<div class="slides">';
						$output .= do_shortcode($content);
					$output .= '</div>';
				$output .= '</div>';

				$id_counter++;

				return $output;

			}
			add_shortcode('et_carousel', 'et_carousel');

			function et_carousel_item($atts, $content = null) {

				$output = '';

				$output .='<div class="et-carousel-item et-clearfix">';
					$output .= do_shortcode($content);
				$output .='</div>';

				return $output;
			}
			add_shortcode('et_carousel_item', 'et_carousel_item');

		/*  et_pricing_table
		/*------------*/

			function et_pricing_table_container($atts, $content = null) {

				extract(shortcode_atts(array(
					'columns'     => '1',
					'gap'         => 'false',
					'shadow'      => 'false',
					'element_id'  => ''
				), $atts));

				static $id_counter = 1;

				$output = '';

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$class   = array();
				$class[] = 'columns-'.$columns;
				$class[] = 'gap-'.$gap;

				if ($shadow == true) {
					$class[] = 'shadow';
				}

				$output .='<div id="et-pricing-table-container'.$element_id.'" class="et-pricing-table-container '.implode(' ', $class).'">';
					$output .=do_shortcode($content);
				$output .='</div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_pricing_table_container', 'et_pricing_table_container');

			function et_pricing_table($atts, $content = null) {

				$main_color = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';

				extract(shortcode_atts(array(
					'color'       => $main_color,
					'highlight'   => 'false',
					'title'	      => '',
					'currency'    => '',
					'price'       => '',
					'plan'        => '',
					'button_text' => '',
					'button_link' => '',
					'target'      => '_self',
					'label'       => '',
					'element_id'  => ''
				), $atts));


				static $id_counter = 1;

				$output = '';

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$output .='<div id="et-pricing-table-'.$element_id.'" class="et-pricing-table highlight-'.$highlight.'" data-color="'.esc_attr($color).'">';

					$output .='<div class="pricing-table-inner">';

						$output .='<div class="pricing-table-head">';

							if (isset($label) && !empty($label)) {
								$output .= '<span class="label">'.esc_attr($label).'</span>';
							}

							if (isset($title) && !empty($title)) {
								$output .= '<h4 class="title in">'.esc_attr($title).'</h4>';
							}
							if (isset($plan) && !empty($plan)) {
								$output .= '<div class="plan in">'.esc_attr($plan).'</div>';
							}
							$output .='<div class="pricing-table-price in">';
								if (isset($currency) && !empty($currency)) {
									$output .= '<span class="currency">'.esc_attr($currency).'</span>';
								}
								if (isset($price) && !empty($price)) {
									$output .= '<span class="price">'.esc_attr($price).'</span>';
								}
							$output .='</div>';
						$output .='</div>';

						$output .='<div class="pricing-table-body">';
							$output .='<ul>';
								$split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/", $content);
								foreach($split as $haystack) {
						            $output .= '<li class="in">';
						            	$output .= $haystack;
						            $output .= '</li>';
						        }
					        $output .='</ul>';
				        $output .='</div>';

				        if (isset($button_text) && !empty($button_text) && isset($button_link) && !empty($button_link)) {
				        	$output .='<div class="pricing-table-footer in">';

				        		$button_args = array(
				        			'button_text' 	=> $button_text,
									'button_link' 	=> $button_link,
									'target'        => $target,
									'animate_hover' => 'scale',
									'button_shadow' => (($highlight == "true") ? 'true' : 'false'),
						            'element_id'    => $element_id,
				        		);

				        		$button_args_string = array();


				        		foreach ($button_args as $key => $value) {
				        			array_push($button_args_string, $key.'="'.$value.'"');
				        		}

				        		$output .= do_shortcode('[et_button '.implode(' ', $button_args_string).']');

								
							$output .='</div>';
						}

					$output .='</div>';

				$output .='</div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_pricing_table', 'et_pricing_table');

		/*	et_testimonial
		--------------*/

			function et_testimonial_container($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'columns'         => '1',
						'navigation_type' => 'arrows',
						'autoplay'        => 'false',
						'element_id'      => '',
					), $atts)
				);

				$output = '';

				static $id_counter = 1;

				$attributes = array();
				$class      = array();

				$attributes[] = 'data-nav="'.$navigation_type.'"';
				$attributes[] = 'data-autoplay="'.$autoplay.'"';
				$attributes[] = 'data-columns="'.$columns.'"';

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$class[] = 'et-testimonial-container';
				$class[] = 'et-carousel';
				$class[] = esc_attr($navigation_type);

				if ($columns != 1) {
					$class[] = 'mult';
				}

				$output .='<div id="et-testimonial-container-'.$element_id.'" class="'.implode(' ', $class).'" '.implode(' ', $attributes).'>';
					$output .= '<div class="slides">';
						$output .= do_shortcode($content);
					$output .= '</div>';
				$output .= '</div>';

				$id_counter++;

				return $output;

			}
			add_shortcode('et_testimonial_container', 'et_testimonial_container');

			function et_testimonial($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'text'        => '',
						'author'      => '',
						'title'       => '',
						'image'       => '',
						'extra_class' => '',
						'element_id'  => '',
					), $atts)
				);

				static $id_counter = 1;

				$output       = '';
				$image_output = '';

				$class   = array();
				$class[] = 'et-testimonial';

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				if ($image) {
						
					$image = wp_get_attachment_image_src($image, 'full');

					$image_src      = $image[0];
					$image_width    = $image[1];
					$image_height   = $image[2];
					$image_caption  = get_the_post_thumbnail_caption($image);
					$image_alt 	    = (empty($image_caption)) ? get_bloginfo('name') : $image_caption;

					$image_output .= '<img src="'.esc_url($image_src).'" width="'.$image_width.'" height="'.$image_height.'" alt="'.$image_alt.'" />';

				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				if (isset($text) && !empty($text)) {
					$output .= '<div id="et-testimonial-'.$element_id.'" class="'.implode(" ",$class).'">';
						
						$output .= '<div class="et-testimonial-inner">';

							$output .= $image_output;
							
							$output .= '<div class="author-wrapper et-clearfix">';
								$output .= '<blockquote>'.do_shortcode($text).'</blockquote>';
								$output .= '<div class="author-info-wrapper et-clearfix">';
									if (isset($author) && !empty($author)) {
										$output .= '<h5 class="author">'.esc_html($author).'</h5>';
									}
									if (isset($title) && !empty($title)) {
										$output .= '<span class="title">'.esc_html($title).'</span>';
									}
								$output .= '</div>';
							$output .= '</div>';

						$output .= '</div>';

					$output .= '</div>';
				}
				$id_counter++;

				return $output;
			}

			add_shortcode('et_testimonial', 'et_testimonial');

		/*	et_client
		--------------*/

			function et_client_container($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'type'            => 'grid',
						'columns'         => '1',
						'columns_tab'     => 'inherit',
						'columns_mob'     => 'inherit',
						'navigation_type' => 'arrows',
						'autoplay'        => 'false',
						'element_id'      => '',
					), $atts)
				);

				$output = '';

				static $id_counter = 1;

				$class   = array();
				$class[] = 'et-client-container';
				$class[] = $type;

				if (isset($type) && $type == "carousel") {
					$class[] = 'et-carousel';
					$class[] = $navigation_type;
				}

				$attributes = array();

				$attributes[] = 'data-nav="'.$navigation_type.'"';
				$attributes[] = 'data-autoplay="'.$autoplay.'"';
				$attributes[] = 'data-columns="'.$columns.'"';

				if ($columns_tab != 'inherit') {
					$attributes[] = 'data-columns-tab="'.$columns_tab.'"';
				}

				if ($columns_mob != 'inherit') {
					$attributes[] = 'data-columns-mob="'.$columns_mob.'"';
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$output .='<div id="et-client-container-'.$element_id.'" class="'.implode(' ', $class).'" '.implode(' ', $attributes).'>';
					if (isset($type) && $type == "carousel") {
						$output .= '<div class="slides">';
							$output .= do_shortcode($content);
						$output .= '</div>';
					} else {
						$output .= do_shortcode($content);
					}
				$output .= '</div>';

				$id_counter++;

				return $output;

			}
			add_shortcode('et_client_container', 'et_client_container');

			function et_client($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'link'  => '',
						'title' => '',
						'image' => '',
						'element_id'  => '',
					), $atts)
				);

				static $id_counter = 1;

				$output      = '';
				$link_before = '';
				$link_after  = '';

				if (isset($link) && !empty($link)) {
					$link_before = '<a href="'.esc_url($link).'">';
					$link_after  = '</a>';
				}

				$class   = array();
				$class[] = 'et-client';

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				if (isset($image) && !empty($image)) {
					$output .= '<div id="et-client-'.$element_id.'" class="'.implode(" ",$class).'">';
						$output .= '<div class="client-inner">';
							$image     = wp_get_attachment_image_src($image,'full');
							$image_src = $image[0];
							$output .= $link_before;
								$output .= '<img class="regular" src="'.esc_url($image_src).'" alt="'.esc_attr($title).'" />';
							$output .= $link_after;
						$output .= '</div>';
					$output .= '</div>';
				}

				$id_counter++;

				return $output;
			}

			add_shortcode('et_client', 'et_client');

		/*	et_person
		--------------*/

			function et_person($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'name'        => '',
						'title'       => '',
						'image'       => '',
						'extra_class' => '',
						'element_id'  => '',
					), $atts)
				);

				static $id_counter = 1;

				$output      = '';

				$class   = array();
				$class[] = 'et-person';

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				if (isset($image) && !empty($image)) {
					$output .= '<div id="et-person-'.$element_id.'" class="'.implode(" ",$class).'">';
						$output .= '<div class="person-inner">';
							if (isset($image) && !empty($image)) {
								$output .= enovathemes_addons_inline_image_placeholder($image,'full','person-image');
							}

							$output .= '<div class="person-content et-clearfix">';
								
								if (isset($title) && !empty($title)) {
									$output .= '<span class="title in">'.esc_html($title).'</span>';
								}

								if (isset($name) && !empty($name)) {
									$output .= '<h4 class="name in">'.esc_html($name).'</h4>';
								}

								$output .= '<div class="styling-original-false et-social-links in">';
									foreach($atts as $social => $href) {
										if($href && $social != 'name' && $social != 'title' && $social != 'image' && $social != 'extra_class' && $social != 'element_id') {
											$output .='<a class="'.$social.'" href="'.$href.'" target="blank" title="'.$social.'">';
												$output .= file_get_contents(THEME_SVG.'social/'.$social.'.svg');
											$output .='</a>';
										}
									}
								$output .= '</div>';

							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				}
				$id_counter++;

				return $output;
			}

			add_shortcode('et_person', 'et_person');

		/*  et_banner
		/*------------*/

			function et_banner( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'visible_mob'   => '',
					'visible_tablet'=> '',
					'visible_desk'  => '',
					'cookie'        => '',
					'delay'         => '3000',
					'effect'        => 'fade-in-scale',
					'text_align'    => 'left',
					'element_id'    => '',
				), $atts));

				$output = '';

				wp_enqueue_script( 'cookie');

				static $id_counter = 1;

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$attributes = array();
				if (isset($cookie) && !empty($cookie)) {
					$attributes[] = 'data-cookie="'.esc_attr($cookie).'"';
				}

				if (isset($delay) && !empty($delay)) {
					$attributes[] = 'data-delay="'.absint($delay).'"';
				}

				$output .='<div id="et-popup-banner-wrapper-'.$element_id.'" class="et-popup-banner-wrapper" data-mob="'.$visible_mob.'" data-tablet="'.$visible_tablet.'" data-desktop="'.$visible_desktop.'">';
					$output .='<div id="et-popup-banner-'.$element_id.'" class="et-popup-banner et-clearfix '.esc_attr($effect).' text-align-'.esc_attr($text_align).'" '.implode(" ", $attributes).'>';
						$output .='<div class="popup-banner-toggle"></div>';
						$output .= do_shortcode($content);
					$output .='</div>';
				$output .='</div>';

				$id_counter++;

				return $output;


			}
			add_shortcode('et_banner', 'et_banner');

		/*  et_tagline
		/*------------*/

			function et_tagline( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'title'         => '',
					'button_text'   => '',
					'button_link'   => '',
					'back_img'      => '',
					'element_id'    => '',
				), $atts));

				$output = '';
				$link_before = '';
				$link_after  = '';

				if (isset($button_link) && !empty($button_link)){
					$link_before = '<a href="'.esc_url($button_link).'">';
					$link_after = '</a>';
				}

				static $id_counter = 1;

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$output .='<div id="et-tagline-'.$element_id.'" class="et-tagline post-image post-media">';
					$output .= $link_before;

						$image        = wp_get_attachment_image_src($back_img,'full');
				        $image_src    = $image[0];
				        $image_width  = $image[1];
				        $image_height = $image[2];
						$x_center 	  = ($image_width/2);
				        $y_center 	  = ($image_height/2);
				        $output .= file_get_contents(THEME_SVG.'placeholder.svg');
						$output .= '<svg class="media-placeholder" viewBox="0 0 '.$image_width.' '.$image_height.'"><path d="M0,0H'.$image_width.'V'.$image_height.'H0V0Z" /></svg>';
						$output .='<div class="post-image-overlay">';
							$output .='<div class="post-image-overlay-content">';
								if (isset($title) && !empty($title)) {
									$output .='<h6 class="tagline-title in">'.esc_html($title).'</h6>';
								}
								if (isset($button_link) && !empty($button_link) && isset($button_text) && !empty($button_text)) {
									$output .='<div class="tagline-button in">'.esc_html($button_text).file_get_contents(THEME_SVG.'arrow.svg').'</div>';
								}
							$output .='</div>';
						$output .='</div>';
					$output .= $link_after;
				$output .='</div>';

				$id_counter++;

				return $output;


			}
			add_shortcode('et_tagline', 'et_tagline');

		/*	et_info_present
		--------------*/

			function et_info_present($atts, $content = null) {

				extract(shortcode_atts(
					array(
						'autoplay' => 'false',
					), $atts)
				);

				$output = '';

				static $id_counter = 1;

				$attributes = array();

				$attributes[] = 'data-autoplay="'.$autoplay.'"';

				$output .='<div id="et-info-present-'.$id_counter.'" class="et-info-present" data-autoplay="'.$autoplay.'">';
					$output .= '<div class="slides">';
						$output .= do_shortcode($content);
					$output .= '</div>';
				$output .= '</div>';

				$id_counter++;

				return $output;

			}
			add_shortcode('et_info_present', 'et_info_present');

			function et_info_present_item($atts, $content = null) {

				$main_color = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';

				extract(shortcode_atts(
					array(
						'box_color'  => $main_color,
						'animation'  => 'top',
						'stagger'    => 'none',
						'image'      => '',
						'icon'       => '',
						'title'      => '',
						'subtitle'   => '',
						'element_id' => ''
					), $atts)
				);

				static $id_counter = 1;

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$output = '';

				$output .='<div id="et-info-present-item-'.$element_id.'" class="et-info-present-item et-clearfix">';
					
					if (isset($image) && !empty($image)) {

						$image        = wp_get_attachment_image_src($image,'full');
				        $image_src    = $image[0];
				        $image_width  = $image[1];
				        $image_height = $image[2];

				        $x_center = ($image_width/2);
				        $y_center = ($image_height/2);

				        $output .= '<div style="max-width:'.$image_width.'px;max-height:'.$image_height.'px;background-image:url('.esc_url($image_src).');" class="presentation-image">';
	            			$output .= '<svg class="media-placeholder" width="'.$image_width.'" height="'.$image_height.'" viewBox="0 0 '.$image_width.' '.$image_height.'"><path d="M0,0H'.$image_width.'V'.$image_height.'H0V0Z" /></svg>';
				        $output .= '</div>';

			        }

					$attributes = array();

					if (isset($animation)) {
						$attributes[] = 'data-animation="'.$animation.'"';
					}

					if (isset($stagger)) {
						$attributes[] = 'data-stagger="'.$stagger.'"';
					}

					if (isset($box_color)) {
						$attributes[] = 'data-color="'.$box_color.'"';
					}

					$output .= '<div id="presentation-box-'.$element_id.'" class="presentation-box" '.implode(' ', $attributes).'>';

						$output .= '<div class="content">';

							if (isset($icon) && !empty($icon)) {

								$icon = get_post($icon);

								if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {
									$output .= '<div class="et-icon presentation-icon large">';
										$output .= file_get_contents($icon->guid);
									$output .= '</div>';
								}

							}

							if (isset($title) && !empty($title)) {
								$output .= '<h3 class="presentation-title">';
									$output .= esc_html($title);
								$output .= '</h3>';
							}

							if (isset($subtitle) && !empty($subtitle)) {
								$output .= '<div class="presentation-subtitle">';
									$output .= esc_html($subtitle);
								$output .= '</div>';
							}

						$output .= '</div>';
					
					$output .= '</div>';

				$output .='</div>';

				$id_counter++;

				return $output;
			}
			add_shortcode('et_info_present_item', 'et_info_present_item');

	/* MEDIA
	---------------*/

		/*  et_image
		/*------------*/

			function et_image( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'image' 				  => '',
					'size' 					  => 'full',
					'link' 					  => '',
					'link_target'             => '_self',
					'parallax'                => 'false',
					'parallax_speed'          => '10',
					'parallax_x'              => '0',
					'parallax_y'              => '0',
					'alignment'               => 'none',
					'animate'                 => 'false',
					'animation_type'          => 'fade-blur',
					'delay'                   => '0',
					'element_id'              => ''
				), $atts));


				$output = '';

				static $id_counter = 1;

				$class      = array();
				$attributes = array();

				$class[] = 'et-image';
				$class[] = 'align'.$alignment;

				
				if (isset($parallax) && $parallax == "true") {
					$class[]      = 'parallax';
					$attributes[] = 'data-coordinatex="'.esc_attr($parallax_x).'"';
					$attributes[] = 'data-coordinatey="'.esc_attr($parallax_y).'"';
					$attributes[] = 'data-speed="'.esc_attr($parallax_speed).'"';

					$animate = "false";

				}

				if ($animate == "true") {
					$attributes[] = 'data-animation="'.esc_attr($animation_type).'"';
					$attributes[] = 'data-delay="'.esc_attr($delay).'"';
				}

				$class[] = 'animate-'.$animate;

				if (isset($image) && !empty($image)) {

					$link_before = '';
					$link_after  = '';

					if (isset($link) && !empty($link)) {
						$class[] = 'link';
						$link_before = '<a title="'.esc_attr($title).'" target="'.$link_target.'" href="'.esc_url($link).'">';
						$link_after  = '</a>';
					}

					$element_id = (!empty($element_id)) ? $element_id : $id_counter;

					$img      = wp_get_attachment_image_src($image,$size);
					$image_w  = $img[1];
					$image_h  = $img[2];

					$output .='<div id="et-image-'.$element_id.'" style="width:'.$image_w.'px;height:'.$image_h.'px;" class="'.implode(' ', $class).'" '.implode(' ', $attributes).'>';
						$output .= $link_before;
							$output .= enovathemes_addons_inline_image_placeholder($image,$size);
							if (
								$animation_type == "curtain-left" ||
								$animation_type == "curtain-right" ||
								$animation_type == "curtain-top" ||
								$animation_type == "curtain-bottom"
							) {
								$output .='<div class="curtain"></div>';
							}
						$output .=$link_after;
					$output .='</div>';

					$id_counter++;

			    	return $output;
				}

			}
			add_shortcode('et_image', 'et_image');

		/*  et-gallery
		/*------------*/

			function et_gallery( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'images'     => '',
					'size'       => 'full',
					'type'       => 'grid',
					'link'       => 'none',
					'columns'    => '1',
					'navigation_type' => 'arrows',
					'autoplay'        => 'false',
					'element_id' => ''
				), $atts));


				$output = '';

				static $id_counter = 1;

				$class      = array();
				$attributes = array();

				$class[] = 'et-gallery';
				$class[] = $type;
				$class[] = $navigation_type;

				if ($type == 'carousel') {
					$class[] = 'et-carousel';
					$attributes[] = 'data-nav="'.$navigation_type.'"';
					$attributes[] = 'data-autoplay="'.esc_attr($autoplay).'"';
				}

				$attributes[] = 'data-columns="'.esc_attr($columns).'"';

				if (isset($images) && !empty($images)) {

					$element_id = (!empty($element_id)) ? $element_id : $id_counter;

					$output .='<div id="et-gallery-'.$element_id.'" class="'.implode(' ', $class).'" '.implode(' ', $attributes).'>';

						$output .='<div class="slides">';

							$images = explode(',', $images);

							foreach ($images as $image) {

								$link_before = '';
								$link_after  = '';

								$image_full = wp_get_attachment_image_src($image, "full");

								if (isset($link) && $link != "none") {
									$link_before = ($link == "lightbox") ? '<a data-gallery="et-gallery-'.$element_id.'" href="'.esc_url($image_full[0]).'">' : '<a href="'.esc_url($image_full[0]).'">';
									$link_after  = '</a>';
								}

								$output .='<div class="et-gallery-item">';
									$output .=$link_before;
										$output .= enovathemes_addons_inline_image_placeholder($image,$size);
									$output .=$link_after;
								$output .='</div>';

							}

						$output .='</div>';

					$output .='</div>';

					$id_counter++;

			    	return $output;
				}

			}
			add_shortcode('et_gallery', 'et_gallery');

		/*  et-video
		/*------------*/

			function et_video( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'mp4'   => '',
					'embed' => '',
					'image' => '',
					'modal' => '',
				), $atts));

				$output = '';

				static $id_counter = 1;

				if (isset($embed) && !empty($embed)) {
					$embed = str_replace('watch?v=', 'embed/', $embed);
	                $embed = str_replace('//vimeo.com/', '//player.vimeo.com/video/', $embed);
                }

				$output .='<div id="et-video-'.$id_counter.'" class="et-video post-video post-media">';

                    if ($image){

                    	$link_class = array('video-btn');
                    	$attributes = array();

                    	if (isset($modal) && !empty($modal)) {

                    		$url = (isset($mp4) && !empty($mp4)) ? $mp4 : ((isset($embed) && !empty($embed)) ? $embed : '');

                    		$link_class[] = 'video-modal';
                    		$attributes[] = 'data-source="'.$url.'"';
                    		$attributes[] = 'href="'.$url.'"';

	                    } else {
	                    	$attributes[] = 'href="#"';
	                    } 
                        
                        $attributes[] = 'class="'.implode(" ", $link_class).'"';

                        $output .='<div class="image-container">';

                            $output .= textron_enovathemes_build_post_media('full','full',$image);

                            $output .='<a '.implode(" ", $attributes).'>';
                                $output .='<svg viewBox="0 0 512 512">';
                                    $output .='<path class="back" d="M512,256c0,141.38-114.62,256-256,256S0,397.38,0,256,114.62,0,256,0,512,114.62,512,256Z" />';
                                    $output .='<path class="play" d="M346.89,261.61,205.11,350c-4.76,3-11.11-.24-11.11-5.61V167.62c0-5.37,6.35-8.57,11.11-5.61l141.78,88.38A6.61,6.61,0,0,1,346.89,261.61Z"/>';
                                $output .='</svg>';
                            $output .='</a>';
                            
                        $output .='</div>';
                    }

                    if(empty($modal)) {

                        if(!empty($embed) && empty($video)) {

                            $output .='<iframe allowfullscreen="allowfullscreen" allow="autoplay" frameBorder="0" src="'.$embed.'" class="iframevideo video-element"></iframe>';

                        } elseif(!empty($mp4)) {

                            $output .='<video poster="'.TEXTRON_ENOVATHEMES_IMAGES.'/transparent.png'.'" id="video-'.get_the_ID().'" class="lazy video-element" playsinline controls>';
                                $output .='<source data-src="'.$mp4.'" src="'.TEXTRON_ENOVATHEMES_IMAGES.'/video_placeholder.mp4'.'" type="video/mp4">';
                            $output .='</video>';

                        }

                    }

				$output .='</div>';

				$id_counter++;

		    	return $output;

			}
			add_shortcode('et_video', 'et_video');

		/*  et-audio
		/*------------*/

			function et_audio( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'mp3'        => '',
				), $atts));

				$output = '';

				static $id_counter = 1;

                if(!empty($mp3)) {

                	$output .='<div id="et-audio-'.$id_counter.'" class="et-audio">';
	                    $output .='<audio class="plyr-element" playsinline controls>';
	                    	$output .='<source src="'.$mp3.'" type="audio/mp3">';
	                    $output .='</audio>';
                    $output .='</div>';
                }

				$id_counter++;

		    	return $output;

			}
			add_shortcode('et_audio', 'et_audio');

	/* INFOGRAPHICS
	---------------*/

		/*  et_counter
		/*------------*/

			function et_counter( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'text_align'     => 'left',
					'title'          => '',
					'type'           => 'h4',
					'number'         => '',
					'number_postfix' => '',
					'icon'           => '',
					'delay'          => '',
					'element_id'     => '',
				), $atts));

				$output = '';

				static $id_counter = 1;

				$class = array();
				$class[] = 'et-counter';
				$class[] = $text_align;

				if (isset($icon) && !empty($icon)) {
					$class[] = 'icon';
				}


				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$attributes   = array();
				$attributes[] = 'data-value="'.$number.'"';
				$attributes[] = 'data-delay="'.esc_attr($delay).'"';

				if (isset($number) && !empty($number)) {
			    	$output .='<div id="et-counter-'.$element_id.'" class="'.implode(' ', $class).'" '.implode(' ', $attributes).'>';

			    		$output .='<div class="et-counter-inner">';

			    			if (isset($icon) && !empty($icon)) {

								$icon = get_post($icon);

								if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {

									$icon_output = file_get_contents($icon->guid);

									$output .= '<div class="counter-icon et-icon size-large">';
										$output .= $icon_output;
									$output .= '</div>';

								}

							}

							$output .='<div class="counter-content">';

					    		$output .='<div class="counter-value in">';

						    		$output .='<span class="counter">0</span>';

					    			if (isset($number_postfix) && !empty($number_postfix)) {
						    			$output .='<span class="postfix">'.esc_attr($number_postfix).'</span>';
						    		}

						    	$output .='</div>';

					    		if (isset($title) && !empty($title)) {
					    			$output .='<'.$type.' class="counter-title in">'.esc_html($title).'</'.$type.'>';
					    		}

				    		$output .='</div>';

			    		$output .='</div>';

			    	$output .='</div>';

			    	$id_counter++;

			    	return $output;
				}

			}
			add_shortcode('et_counter', 'et_counter');

		/*  et_progress
		/*------------*/

			function et_progress( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'version'        => 'default',
					'title'	         => '',
					'type'           => 'h4',
					'percentage'	 => '',
					'element_id'     => '',
					'delay'          => '',
				), $atts));

				$output = '';

				static $id_counter = 1;

				$attributes = array();

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				if(!is_numeric($percentage) || $percentage < 0){$percentage = "";}
				elseif ($percentage > 100) {$percentage = "100";}

				$attributes[] = 'data-delay="'.esc_attr($delay).'"';
				$attributes[] = 'data-percentage="'.absint($percentage).'"';

				if (isset($percentage) && !empty($percentage)) {

					$output .= '<div id="et-progress-'.$element_id.'" class="et-progress '.$version.'" '.implode(' ', $attributes).'>';
						
						if ($version == "circle") {

							$output .= '<div class="text">';
								$output .= '<span class="percent">0</span>';
					    		$output .='<'.$type.' class="title">'.esc_html($title).'</'.$type.'>';
							$output .= '</div>';

							$output .='<svg viewBox="0 0 56 56">';
		                        $output .='<circle class="track-circle" cx="28" cy="28" r="27" />';
		                        $output .='<circle class="bar-circle" cx="28" cy="28" r="27" />';
		                    $output .='</svg>';
		                    
						} else {

							$output .= '<div class="text">';
					    		$output .='<'.$type.' class="title">'.esc_html($title).'</'.$type.'>';
								$output .= '<span class="percent">0</span>';
							$output .= '</div>';

							$output .= '<div class="track-bar">';
								$output .= '<div class="bar"></div>';
								$output .= '<div class="track"></div>';
							$output .= '</div>';
						}
					$output .= '</div>';

					$id_counter++;

			    	return $output;
				}

			}
			add_shortcode('et_progress', 'et_progress');

		/*  timer
		/*------------*/

			function et_timer( $atts, $content = null ) {

				extract(shortcode_atts(array(
					'enddate' => '',
					'days'    => '',
					'hours'   => '',
					'minutes' => '',
					'seconds' => '',
					'element_id'=> ''
				), $atts));

				static $id_counter = 1;

				$output 	  = '';

				$attributes = array();

				if (isset($enddate) && !empty($enddate)) {
					$attributes[] = 'data-enddate="'.esc_attr($enddate).'"';
				}

				if (isset($days) && !empty($days)) {
					$attributes[] = 'data-days="'.esc_attr($days).'"';
				} else {
					$attributes[] = 'data-days="Days"';
				}

				if (isset($hours) && !empty($hours)) {
					$attributes[] = 'data-hours="'.esc_attr($hours).'"';
				} else {
					$attributes[] = 'data-hours="Hours"';
				}

				if (isset($minutes) && !empty($minutes)) {
					$attributes[] = 'data-minutes="'.esc_attr($minutes).'"';
				} else {
					$attributes[] = 'data-minutes="Minutes"';
				}

				if (isset($seconds) && !empty($seconds)) {
					$attributes[] = 'data-seconds="'.esc_attr($seconds).'"';
				} else {
					$attributes[] = 'data-seconds="Seconds"';
				}

				$element_id = (!empty($element_id)) ? $element_id : $id_counter;

				if (isset($enddate) && !empty($enddate)) {

					$output .='<div id="et-timer-'.$element_id.'" '.implode(" ", $attributes).' class="et-timer et-clearfix">';
						$output .='<ul>';
						  $output .='<li><div><span class="timer-count days">00</span><h5 class="days_text timer-title">'.$days.'</h5></div></li>';
							$output .='<li><div><span class="timer-count hours">00</span><h5 class="hours_text timer-title">'.$hours.'</h5></div></li>';
							$output .='<li><div><span class="timer-count minutes">00</span><h5 class="minutes_text timer-title">'.$minutes.'</h5></div></li>';
							$output .='<li><div><span class="timer-count seconds">00</span><h5 class="seconds_text timer-title">'.$seconds.'</h5></div></li>';
						$output .='</ul>';
					$output .='</div>';

					$id_counter++;

			    	return $output;
				}

			}
			add_shortcode('et_timer', 'et_timer');

	/* OTHER
	---------------*/

		/*  et_gap
		/*------------*/

			function et_gap( $atts, $content = null ) {
				extract(shortcode_atts(array(
					'extra_class' => '',
					'element_id'  => '',
					'rv'          => '',
				), $atts));

				static $id_counter = 1;

				$responsive_visibility = array();

				if (!empty($rv)) {
					$rv = explode(',', $rv);

					foreach ($rv as $key) {
						$responsive_visibility[] = 'hide'.$key;
					}

				}

				$class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-gap';
				$class[] = 'et-clearfix';

		        $element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$class[] = 'et-gap-'.$element_id;

				if (!empty($responsive_visibility)) {
					$class = array_merge($class,$responsive_visibility);
				}

				return '<span class="'.implode(" ", $class).'"></span>';

				$id_counter++;
			}
			add_shortcode('et_gap', 'et_gap');

			function et_gap_inline( $atts, $content = null ) {
				extract(shortcode_atts(array(
					'extra_class' => '',
					'element_id'  => '',
					'rv'          => '',
				), $atts));

				static $id_counter = 1;

				$responsive_visibility = array();

				if (!empty($rv)) {
					$rv = explode(',', $rv);

					foreach ($rv as $key) {
						$responsive_visibility[] = 'hide'.$key;
					}

				}

				$class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'et-gap-inline';
				$class[] = 'et-clearfix';

		        $element_id = (!empty($element_id)) ? $element_id : $id_counter;

				$class[] = 'et-gap-inline-'.$element_id;

				if (!empty($responsive_visibility)) {
					$class = array_merge($class,$responsive_visibility);
				}

				return '<div class="'.implode(" ", $class).'"></div>';

				$id_counter++;
			}
			add_shortcode('et_gap_inline', 'et_gap_inline');

/*  HEADER BUILDER
/*------------*/

	/*	et_header_logo
	--------------*/

		function et_header_logo($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'logo'            		=> '',
					'retina_logo'           => '',
					'sticky_logo'           => '',
					'sticky_retina_logo'    => '',
					'align'                 => 'none',
					'extra_class'     		=> '',
					'element_id'            => '',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'hbe';
			$class[] = 'header-logo';
			$class[] = 'hbe-'.$align;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			// logo

			if (!empty($logo)) {

				$logo = get_post($logo);


				if (is_object($logo) && $logo->post_mime_type == 'image/svg+xml') {

					$logo = file_get_contents($logo->guid);

				} else {

					$logo_src = $logo->guid;


					// retina logo
					if (!empty($retina_logo)) {

						$retina_logo = get_post($retina_logo);

						if (is_object($retina_logo) && $retina_logo->post_mime_type != 'image/svg+xml') {
							$logo_src = $retina_logo->guid;
						}
						
					}
				}

			}

			// sticky logo

			if (!empty($sticky_logo)) {

				$sticky_logo = get_post($sticky_logo);

				if (is_object($sticky_logo) && $sticky_logo->post_mime_type == 'image/svg+xml') {

				    $sticky_logo = file_get_contents($sticky_logo->guid);

				} else {

				    $sticky_logo_src = $sticky_logo->guid;

				    // retina logo

				    if (!empty($sticky_retina_logo)) {
				    	$sticky_retina_logo = get_post($sticky_retina_logo);
				    	if (is_object($sticky_retina_logo) && $sticky_retina_logo->post_mime_type != 'image/svg+xml') {
				        	$sticky_logo_src = $sticky_retina_logo->guid;
				    	}
				    }
				}

			}

			$output .= '<div id="header-logo-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= '<a href="'.esc_url(home_url('/')).'" title="'.get_bloginfo('name').'">';
					if (!empty($logo)) {
						if (isset($logo_src) && !empty($logo_src)) {
							$output .= '<img class="logo" src="'.$logo_src.'" alt="'.get_bloginfo('name').'">';
						} else {
							$output .= '<div class="logo">'.$logo.'</div>';
						}
					}
					if (!empty($sticky_logo)) {
						if (isset($sticky_logo_src) && !empty($sticky_logo_src)) {
							$output .= '<img class="sticky-logo" src="'.$sticky_logo_src.'" alt="'.get_bloginfo('name').'">';
						} else {
							$output .= '<div class="sticky-logo">'.$sticky_logo.'</div>';
						}
					}
				$output .= '</a>';
			$output .= '</div>';

			$id_counter++;

			return $output;
		}

		add_shortcode('et_header_logo', 'et_header_logo');

	/*	et_header_menu
	--------------*/

		function et_header_menu($atts, $content = null) {

			global $textron_enovathemes;

			$main_color = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';

			extract(shortcode_atts(
				array(
					'menu'            		=> '',
					'align'                 => 'none',
					'menu_hover'            => 'none',
					'submenu_appear'        => 'none',
					'submenu_shadow'        => 'false',
					'submenu_indicator'     => 'false',
					'submenu_separator'     => 'false',
					'menu_separator'        => 'false',
					'menu_color'            => '',
					'menu_color_hover'      => $main_color,
					'submenu_submenu_indicator' => 'false',
					'extra_class'     		=> '',
					'element_id'            => '',
					'hide_default'          => 'false',
					'hide_sticky'           => 'false',
					'one_page'              => 'false',
					'offset'                => '0'
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'header-menu-container';
			$class[] = 'nav-menu-container';
			$class[] = 'hbe';
			$class[] = 'hbe-'.$align;
			$class[] = 'one-page-'.$one_page;
			$class[] = 'one-page-offset-'.$offset;
			$class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
			$class[] = 'menu-hover-'.$menu_hover;
			$class[] = 'submenu-appear-'.$submenu_appear;
			$class[] = 'submenu-shadow-'.$submenu_shadow;
			$class[] = 'tl-submenu-ind-'.$submenu_indicator;
			$class[] = 'sl-submenu-ind-'.$submenu_submenu_indicator;
			$class[] = 'separator-'.$submenu_separator;
			$class[] = 'top-separator-'.$menu_separator;

			if($menu_hover == "underline") {
				$link_after  = '<span class="effect"></span></span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>';
			} else {
				$link_after  = '</span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span><span class="effect"></span>';
			}

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			if (empty($menu) || $menu == "choose" || !isset($menu)) {
				if (has_nav_menu( 'header-menu' )) {
					$menu_arg = array(
						'theme_location'  => 'header-menu',
						'menu_class'      => 'header-menu nav-menu hbe-inner et-clearfix',
						'menu_id'         => 'header-menu-'.$element_id,
						'container'       => 'nav',
						'container_class' => implode(" ", $class),
						'container_id'    => 'header-menu-container-'.$element_id,
						'items_wrap'      => '<ul id="%1$s" class="%2$s" data-color="'.esc_attr($menu_color).'" data-color-hover="'.esc_attr($menu_color_hover).'">%3$s</ul>',
						'echo'            => false,
						'link_before'     => '<span class="txt">',
						'link_after'      => $link_after,
						'depth'           => 10,
						'walker'          => new et_scm_walker
					);
				}
			} else {
				$menu_arg = array(
					'menu'  => $menu,
					'menu_class'      => 'header-menu nav-menu hbe-inner et-clearfix',
					'menu_id'         => 'header-menu-'.$element_id,
					'container'       => 'nav',
					'container_class' => implode(" ", $class),
					'container_id'    => 'header-menu-container-'.$element_id,
					'items_wrap'      => '<ul id="%1$s" class="%2$s" data-color="'.esc_attr($menu_color).'" data-color-hover="'.esc_attr($menu_color_hover).'">%3$s</ul>',
					'echo'            => false,
					'link_before'     => '<span class="txt">',
					'link_after'      => $link_after,
					'depth'           => 10,
					'walker'          => new et_scm_walker
				);
			}

			$output .= wp_nav_menu($menu_arg);

			$id_counter++;

			return $output;
		}

		add_shortcode('et_header_menu', 'et_header_menu');

	/*	et_megamenu
	--------------*/

		function et_megamenu($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'menu'              => '',
					'submenu_hover'     => 'none',
					'submenu_separator' => 'false',
					'extra_class'       => '',
					'element_id'        => '',
					'columns'           => '1'
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'mm-container';
			$class[] = 'submenu-hover-'.$submenu_hover;
			$class[] = 'separator-'.$submenu_separator;
			$class[] = 'column-'.$columns;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$menu_arg = array(
				'menu'  => $menu,
				'menu_class'      => 'mm-'.$element_id.' et-mm et-clearfix',
				'container'       => 'div',
				'container_class' => implode(" ", $class),
				'container_id'    => 'mm-container-'.$element_id,
				'echo'            => false,
				'link_before'     => '<span class="txt">',
				'link_after'      => '</span>',
				'depth'           => 3,
				'walker'          => new et_scm_walker
			);

			$output .= wp_nav_menu($menu_arg);

			$id_counter++;

			return $output;
		}

		add_shortcode('et_megamenu', 'et_megamenu');

	/*	et_megamenu_tab
	--------------*/

		function et_megamenu_tab($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'size'    => 'small',
					'action' => 'click',
					'element_id' => ''
				), $atts)
			);

			$output = '';

			$class = array();

			$class[] = 'megamenu-tab';
			$class[] = 'et-clearfix';
			$class[] = esc_attr($size);
			$class[] = 'action-'.$action;

			if (!isset($element_id) || empty($element_id)) {
				$element_id = rand(1,1000000);
			}

			$output .='<div id="megamenu-tab-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= do_shortcode($content);
			$output .= '</div>';

			return $output;

		}
		add_shortcode('et_megamenu_tab', 'et_megamenu_tab');

		function et_megamenu_tab_item($atts, $content = null) {

			extract(shortcode_atts(array(
				'title'  => '',
				'icon'   => '',
				'active' => 'false',
			), $atts));

			$output = '';

			$id_counter = rand(1,1000000);

			if($active == 'true'){
				$active = "active";
			}

			$output .= '<div data-target="tab-item-'. sanitize_title( $title ) .'" class="'.esc_attr($active).' tab-item et-clearfix">';
				
				if (isset($icon) && !empty($icon)) {

					$icon = get_post($icon);

					if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {

						$icon_output = file_get_contents($icon->guid);

			            $output .= '<span class="icon" id="icon-'.$element_id.'"">'.$icon_output.'</span>';

					}

		        }

				if (isset($title) && !empty($title)) {
					$output .= '<span class="txt">'.esc_attr($title).'</span>';
				}
				$output .= '<span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>';
			$output .= '</div> ';
			$output .= '<div id="tab-item-'.sanitize_title($title).'-'.$id_counter.'" class="tab-content et-clearfix">';
			    $output .= do_shortcode($content);
			$output .= '</div>';

			return $output;
		}
		add_shortcode('et_megamenu_tab_item', 'et_megamenu_tab_item');

	/*	et_search_toggle
	--------------*/

		function et_search_toggle($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'align'                 => 'none',
					'extra_class'     		=> '',
					'element_id'            => '',
					'hide_default'          => 'false',
					'hide_sticky'           => 'false',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'header-search';
			$class[] = 'hbe hbe-icon-element';
			$class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
			$class[] = 'hbe-'.$align;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="header-search-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= '<div id="search-toggle-'.$element_id.'" class="search-toggle hbe-toggle">';
	                $output .= file_get_contents(THEME_SVG.'search.svg');
				$output .= '</div>';
				$output .= '<div id="search-box-'.$element_id.'" class="search-box">';

					$output .= '<form class="search-form" action="'.esc_url(home_url('/')).'/" method="get">';
					    $output .= '<fieldset>';
					        $output .= '<input type="text" name="s" id="s" />';
					        $output .= '<input type="submit" id="searchsubmit" class="close-toggle" />';
					        $output .= '<div class="search-icon">'.file_get_contents(THEME_SVG.'search.svg').'</div>';
					    $output .= '</fieldset>';
					$output .= '</form>';
	                $output .= file_get_contents(THEME_SVG.'search-back.svg');

				$output .= '</div>';
			$output .= '</div>';

			$id_counter++;

			return $output;
		}

		add_shortcode('et_search_toggle', 'et_search_toggle');

	/*	et_search_form
	--------------*/

		function et_search_form($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'align'                 => 'none',
					'extra_class'     		=> '',
					'element_id'            => '',
					'hide_default'          => 'false',
					'hide_sticky'           => 'false',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'header-search-form';
			$class[] = 'hbe hbe-icon-element';
			$class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
			$class[] = 'hbe-'.$align;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="header-search-form-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= '<form id="search-form-'.$element_id.'" class="search-form" action="'.esc_url(home_url("/")).'" method="get">';
				    $output .= '<fieldset>';
				        $output .= '<input type="text" name="s" id="s" placeholder="'.esc_attr__("Search...", "enovathemes-addons").'" />';
				        $output .= '<input type="submit" id="searchsubmit" />';
				    	$output .= '<div id="search-icon-'.$element_id.'" class="search-icon">'.file_get_contents(THEME_SVG.'search.svg').'</div>';
				    $output .= '</fieldset>';
				$output .= '</form>';
			$output .= '</div>';

			$id_counter++;

			return $output;
		}

		add_shortcode('et_search_form', 'et_search_form');

	/*  et_cart_toggle
    --------------*/

        function et_cart_toggle($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'align'                 => 'none',
                    'box_align'             => 'left',
                    'extra_class'           => '',
                    'element_id'            => '',
                    'hide_default'          => 'false',
					'hide_sticky'           => 'false',
                ), $atts)
            );


            static $id_counter = 1;

            global $woocommerce;

            $output      = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'header-cart';
            $class[] = 'hbe hbe-icon-element';
            $class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
            $class[] = 'hbe-'.$align;
            $class[] = 'box-align-'.$box_align;

            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

            $output .= '<div id="header-cart-'.$element_id.'" class="'.implode(" ", $class).'">';
                $output .= '<div id="cart-toggle-'.$element_id.'" class="cart-toggle hbe-toggle">';

                	if (class_exists('Woocommerce')) {
                		if ($woocommerce->cart->cart_contents_count) {
							$output .= '<span class="cart-contents">'.$woocommerce->cart->cart_contents_count.'</span>';
						} else {
							$output .= '<span class="cart-contents"></span>';
						}
                	} else {
                		$output .= '<span class="cart-contents"></span>';
                	}
					
                	$output .= file_get_contents(THEME_SVG.'cart.svg');
		        $output .= '</div>';


            	$output .= '<div id="cart-box-'.$element_id.'" class="cart-box">';

            		$output .= '<div class="cart-toggle close-toggle">';
	                	$output .= file_get_contents(THEME_SVG.'close.svg');
			        $output .= '</div>';

            		if (class_exists('Woocommerce')){
            			$output .= textron_enovathemes_get_the_widget( 'WC_Widget_Cart', 'title=Cart' );
            		} else {
            			$output .= esc_html__('Please install Woocommerce','enovathemes-addons');
            		}

            		$output .= file_get_contents(THEME_SVG.'back.svg');

            	$output .= '</div>';

            $output .= '</div>';

            $id_counter++;

            return $output;

        }

        add_shortcode('et_cart_toggle', 'et_cart_toggle');

    /*  et_language_switcher
    --------------*/

        function et_language_switcher($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'align'        => 'none',
                    'box_align'    => 'left',
                    'extra_class'  => '',
                    'element_id'   => '',
					'submenu_width'=> '200',
                    'hide_default' => 'false',
					'hide_sticky'  => 'false'
                ), $atts)
            );

	            static $id_counter = 1;

	            $output      = '';

	            $class = array();

				if (!empty($extra_class)) {
					$class[] = esc_attr($extra_class);
				}

				$class[] = 'hbe-icon-element';
	            $class[] = 'language-switcher';
	            $class[] = 'hbe';
	            $class[] = 'hide-default-'.$hide_default;
				$class[] = 'hide-sticky-'.$hide_sticky;
	            $class[] = 'hbe-'.$align;
				$class[] = 'box-align-'.$box_align;

	            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

	            $output .= '<div id="language-switcher-'.$element_id.'" class="'.implode(" ", $class).'" data-width="'.esc_attr($submenu_width).'">';

                	$output .= '<div class="language-toggle hbe-toggle">';
						$output .= file_get_contents(THEME_SVG.'language-switcher.svg');
					$output .= '</div>';

					$output .= '<div id="language-box-'.$element_id.'" class="language-box">';

	            		$output .= '<div class="language-toggle close-toggle">';
		                	$output .= file_get_contents(THEME_SVG.'close.svg');
				        $output .= '</div>';

						$output .= '<div class="language-switcher-content">';

			            	if (class_exists('SitePress')){

			            		$languages = icl_get_languages('skip_missing=0');

			            		if(1 < count($languages)){
			            			$output .= '<ul class="wpml-ls">';
									    foreach($languages as $l){
									    	$output .= '<li><a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" />'.$l['translated_name'].'</a><li>';
									    }
								    $output .= '</ul>';
								}

							}elseif(function_exists('pll_the_languages')) {
								$output .= '<ul class="polylang-ls">';
									$output .=pll_the_languages(
										array(
											'echo'=>0,
											'show_flags'=>1,
											'hide_if_empty'=>0
										)
									);
								$output .= '</ul>';
							} else {
								$output .= '<ul class="no-ls">';
									$output .= '<li><a target="_blank" href="//wordpress.org/plugins/polylang/">'.esc_html__("Polylang","enovathemes-addons").'</a></li>';
									$output .= '<li><a target="_blank" href="//wpml.org/">'.esc_html__("WPML","enovathemes-addons").'</a></li>';
								$output .= '</ul>';
							}

						$output .= '</div>';

						$output .= file_get_contents(THEME_SVG.'back.svg');

					$output .= '</div>';

	            $output .= '</div>';

	            $id_counter++;

	            return $output;

        }

        add_shortcode('et_language_switcher', 'et_language_switcher');

	/*	et_login_toggle
	--------------*/

		function et_login_toggle($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'align'       => 'none',
					'box_align'   => 'left',
					'extra_class' => '',
					'element_id'  => '',
					'hide_default'=> 'false',
					'hide_sticky' => 'false',
					'registration_link'  => '',
	 				'forgot_link'  => '',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'header-login';
			$class[] = 'hbe hbe-icon-element';
			$class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
			$class[] = 'hbe-'.$align;
			$class[] = 'box-align-'.$box_align;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="header-login-'.$element_id.'" class="'.implode(" ", $class).'">';

				$output .= '<div id="login-toggle-'.$element_id.'" class="login-toggle hbe-toggle">';
					$output .= file_get_contents(THEME_SVG.'user.svg');
					$output .= '<div id="login-title-'.$element_id.'" class="login-title login">'.esc_html__("Login","enovathemes-addons").'</div>';
					$output .= '<div id="login-title-'.$element_id.'" class="login-title logout">'.esc_html__("Logout","enovathemes-addons").'</div>';
				$output .= '</div>';

				$output .= '<div id="login-box-'.$element_id.'" class="login-box">';

					$output .= '<div class="login-toggle close-toggle">';
						$output .= file_get_contents(THEME_SVG.'close.svg');
					$output .= '</div>';

					$instance = array('title'=> '','registration_link'=>$registration_link,'forgot_link'=>$forgot_link);
					$output .= textron_enovathemes_get_the_widget( 'Enovathemes_Addons_WP_Widget_Login', $instance,'');
					$output .= file_get_contents(THEME_SVG.'back.svg');

				$output .= '</div>';

			$output .= '</div>';

			$id_counter++;

			return $output;
		}

		add_shortcode('et_login_toggle', 'et_login_toggle');

	/*	et_header_slogan
	--------------*/

		function et_header_slogan($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'align'       => 'none',
					'extra_class' => '',
					'element_id'  => '',
					'hide_default'=> 'false',
					'hide_sticky' => 'false',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'hbe';
			$class[] = 'header-slogan';
			$class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
			$class[] = 'hbe-'.$align;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="header-slogan-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= do_shortcode($content);
			$output .= '</div>';

			$id_counter++;

			return $output;
		}

		add_shortcode('et_header_slogan', 'et_header_slogan');

	/*	et_header_social_links
	--------------*/

		function et_header_social_links($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'align'                 => 'none',
					'size'                  => 'medium',
					'extra_class'     		=> '',
					'element_id'            => '',
					'target' 				=> '_self',
					'styling_original'      => 'false',
					'hide_default'          => 'false',
					'hide_sticky'           => 'false',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'header-social-links';
			$class[] = 'hbe hbe-icon-element';
			$class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
			$class[] = 'hbe-'.$align;
			$class[] = 'size-'.$size;
			$class[] = 'styling-original-'.$styling_original;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="header-social-links-'.$element_id.'" class="'.implode(" ", $class).'">';
				foreach($atts as $social => $href) {
					if($href && $social != 'target' && $social != 'icon_color' && $social != 'icon_color_hover' && $social != 'icon_background_color' && $social != 'icon_background_color' && $social != 'icon_background_color_hover' && $social != 'icon_border_color' && $social != 'icon_border_color_hover' && $social != 'icon_border_width' && $social != 'styling_original' && $social != 'size' && $social != 'icon_size' && $social != 'icon_box_size' && $social != 'margin' && $social != 'element_id' && $social != 'element_css' && $social != 'align') {
						$output .='<a class="'.$social.'" href="'.$href.'" target="'.esc_attr($target).'" title="'.$social.'">';
							$output .= file_get_contents(THEME_SVG.'social/'.$social.'.svg');
						$output .='</a>';
					}
				}
			$output .= '</div>';

			$id_counter++;

			return $output;
		}
		add_shortcode('et_header_social_links', 'et_header_social_links');

	/*	et_header_vertical_separator
	--------------*/

		function et_header_vertical_separator($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'type'        => 'solid',
					'align'       => 'none',
					'extra_class' => '',
					'element_id'  => '',
					'width'       => '',
					'height'      => '',
					'hide_default'=> 'false',
					'hide_sticky' => 'false',
				), $atts)
			);

			static $id_counter = 1;

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'header-vertical-separator';
            $class[] = 'hbe';
            $class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
            $class[] = 'hbe-'.$align;
            $class[] = $type;

			if (isset($width) && !empty($width)) {
				if ($width > $height) {
					$class[] = 'horizontal';
				} else {
					$class[] = 'vertical';
				}
			} else {
				$class[] = 'horizontal';
			}

	        $element_id = (!empty($element_id)) ? $element_id : $id_counter;

	        $class[] = 'header-vertical-separator-'.$element_id;

			$output = '<div class="'.implode(" ", $class).'"><div class="line"></div></div>';

			$id_counter++;

			return $output;
		}
		add_shortcode('et_header_vertical_separator', 'et_header_vertical_separator');

	/*  et_header_icon
    --------------*/

        function et_header_icon($atts, $content = null) {

            extract(shortcode_atts(
                array(
					'icon'          => '',
					'size'          => 'medium',
					'icon_box_size' => '',
					'icon_link'     => '',
					'target' 	    => '_self',
					'click'         => 'false',
                    'align'         => 'none',
                    'extra_class'   => '',
                    'element_id'    => '',
                    'hide_default'  => 'false',
					'hide_sticky'   => 'false',
                ), $atts)
            );


            static $id_counter = 1;

            $output = $icon_output = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'header-icon';
            $class[] = 'hbe hbe-icon-element';
            $class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
			$class[] = 'hbe-'.$align;
			$class[] = 'size-'.$size;
            $class[] = 'click-'.$click;

            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

			if (isset($icon) && !empty($icon)) {

				$icon = get_post($icon);

				if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {

					$icon_output = file_get_contents($icon->guid);

					$size = 40;

					if ($size == "small") {
						$size = 32;
					}elseif ($size == "large") {
						$size = 48;
					}elseif ($size == "custom") {
						$size = $icon_box_size;
					}

					$s2  = $size/2;
					$size_hover = $size + 4;

					$d 	     = 'M'.$s2.','.($size + 2).'A'.$s2.','.$s2.',0,0,1,'.$s2.',2A'.$s2.','.$s2.',0,0,1,'.$s2.','.($size + 2).'Z';
					$d_hover = 'M'.$s2.','.$size_hover.'C -2 '.($size_hover+2).',-2 -2,'.$s2.' 0,C '.$size_hover.' -2,'.$size_hover.' '.($size_hover+2).','.$s2.' '.$size_hover.'Z';

					$icon_back   = '<svg viewBox="0 0 '.$size.' '.$size.'" class="icon-back">';
						$icon_back .='<path d="'.$d.'" data-hover="'.$d_hover.'"/>';
					$icon_back .='</svg>';

		            $output .= '<div id="header-icon-'.$element_id.'" class="'.implode(" ", $class).'">';
		            	if (!empty($icon_link)) {
		            		$output .= '<a href="'.esc_url($icon_link).'" target="'.esc_attr($target).'" class="hbe-toggle hicon">';
								$output .= $icon_output;
								$output .= $icon_back;
							$output .= '</a>';
		            	} else {
		            		$output .= '<span class="hbe-toggle hicon">';
								$output .= $icon_output;
								$output .= $icon_back;
							$output .= '</span>';
		            	}
		            $output .= '</div>';

				} else {
					$output .= esc_html__("Please upload svg");
				}

	            $id_counter++;

	            return $output;

	        }
        }

        add_shortcode('et_header_icon', 'et_header_icon');

    /*  et_header_button
    --------------*/

	    function et_header_button( $atts, $content = null ) {

			extract(shortcode_atts(array(
				'button_text' 		    => '',
				'button_link' 	        => '',
				'target'                => '_self',
				'button_link_modal'     => 'false',
				'width'                 => 220,
				'height'				=> 56,
				'button_shadow' 	    => 'false',
				'button_style' 	        => 'normal',
				'button_type'           => 'round',
				'button_size'           => 'medium',
				'button_size_custom'    => 'false',
				'button_color'          => '#ffffff',
				'button_color_hover'    => '#ffffff',
				'icon' 	                => '',
				'icon_position'         => 'left',
				'animate_hover' 	    => 'none',
				'animate_hover_outline' => 'none',
				'click_smooth' 	        => 'false',
				'align'                 => 'none',
				'extra_class'           => '',
	            'element_id'            => '',
	            'hide_default'          => 'false',
				'hide_sticky'           => 'false'
			), $atts));

			static $id_counter = 1;

            $output      = '';

            $class = array();
            $link_class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			if ($button_style == "outline") {
				$animate_hover = $animate_hover_outline;
			}

            $class[] = 'et-header-button';
            $class[] = 'hbe hbe-icon-element';
            $class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
            $class[] = 'hbe-'.$align;

            if ($button_size_custom == "true") {
            	$button_size = 'custom';
            }

            $link_class[] = 'et-button';
            $link_class[] = 'icon-position-'.$icon_position;
            $link_class[] = 'modal-'.$button_link_modal;
            $link_class[] = 'hover-'.$animate_hover;
			$link_class[] = 'smooth-'.$click_smooth;
            $link_class[] = 'shadow-'.$button_shadow;
			$link_class[] = $button_type;
			$link_class[] = $button_style;
			$link_class[] = $button_size;

			if ($button_link_modal == "true") {
				$target = "_self";
			}

			if (isset($icon) && !empty($icon)) {
				$class[] = 'has-icon';
			}

			if (isset($click_smooth) && $click_smooth == "true") {
				$class[] = 'click-smooth';
			}

            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

			if ($button_link_modal == "true") {$target = "_self";}

			$attributes   = array();
			$attributes[] = 'target="'.esc_attr($target).'"';
			$attributes[] = 'href="'.esc_url($button_link).'"';
			$attributes[] = 'data-effect="'.esc_attr($animate_hover).'"';
			$attributes[] = 'class="'.implode(" ", $link_class).'"';

			if ($animate_hover == 'fill') {
				$attributes[] = 'data-color="'.esc_attr($button_color).'"';
				$attributes[] = 'data-color-hover="'.esc_attr($button_color_hover).'"';
			}

			if ($button_size_custom == "false") {

				if ($button_size == "small") {
					$width = 180;
					$height= 48;
				}

				if ($button_size == "large") {
					$width = 256;
					$height= 64;
				}

			}

			if (isset($button_text) && !empty($button_text) && isset($button_link) && !empty($button_link)) {

				$output .='<div id="et-header-button-'.$element_id.'" class="'.implode(" ", $class).'">';

					$output .='<a '.implode(" ", $attributes).'>';

						$icon_output = '';

						if (isset($icon) && !empty($icon)) {

							$icon = get_post($icon);

							if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {
								$icon_output = '<span class="icon">'.file_get_contents($icon->guid).'</span>';
							}

						}

						if ($icon_position == "left" && !empty($icon_output)) {$output .= $icon_output;}
						$output .='<span class="text">'.esc_attr($button_text).'</span>';
						if ($icon_position == "right" && !empty($icon_output)) {$output .= $icon_output;}

						// Button types
						if ($button_type == 'round') {

							$d       = 'M192,56H28A28,28,0,0,1,28,0H192A28,28,0,0,1,192,56Z';
							$d_hover = ($animate_hover == "click") ? 'M192,56A519,519,0,0,0,28,56A23,27,0,0,1,28,0A519,519,0,0,0,192,0A23,27,0,0,1,192,56Z' : $d;

						} else {

							$d       = 'M212,56H8A9,9,0,0,1,0,48V8A9,9,0,0,1,8,0H212A9,9,0,0,1,220,8V48A9,9,0,0,1,212,56Z';
							$d_hover = ($animate_hover == "click") ? 'M212,56A999,999,0,0,0,8,56A9,9,0,0,1,0,48A99,99,0,0,0,0,8A9,9,0,0,1,8,0A999,999,0,0,0,212,0A9,9,0,0,1,220,8A99,99,0,0,0,220,48A9,9,0,0,1,212,56Z' : $d;

						}

						if ($width != 220 || $height != 56) {

							if ($height%2) {$height -= 1;}
							if ($width%2)  {$width -= 1;}

							if ($button_type == 'round') {

								$width_replace  	    = 192;
								$height_replace 	    = 56;
								$corner_replace 	    = 28;
								$hover_curve_replace_x  = 23;
								$hover_curve_replace_y  = 27;

								$corner 	            = $height/2;
								$hover_curve_x          = ($height/2) - 3;
								$hover_curve_y          = ($height/2) - 1;
								$width_corner           = $width - $corner;

								$d = str_replace($corner_replace,$corner,$d);
								$d = str_replace($height_replace,$height,$d);
								$d = str_replace($width_replace,$width_corner,$d);

								$d_hover = str_replace($corner_replace,$corner,$d_hover);
								$d_hover = str_replace($height_replace,$height,$d_hover);
								$d_hover = str_replace($width_replace,$width_corner,$d_hover);

								if ($animate_hover == "click") {
									$d_hover = str_replace($hover_curve_replace_x,$hover_curve_x,$d_hover);
									$d_hover = str_replace($hover_curve_replace_y,$hover_curve_y,$d_hover);
								}

							} else {

								$width_replace  	    = 220;
								$height_replace 	    = 56;
								$width_corner_replace 	= 212;
								$height_corner_replace 	= 48;
								$width_corner           = $width - 7;
								$height_corner          = $height - 7;

								$d = str_replace($height_corner_replace,$height_corner,$d);
								$d = str_replace($width_corner_replace,$width_corner,$d);
								$d = str_replace($height_replace,$height,$d);
								$d = str_replace($width_replace,$width,$d);

								$d_hover = str_replace($height_corner_replace,$height_corner,$d_hover);
								$d_hover = str_replace($width_corner_replace,$width_corner,$d_hover);
								$d_hover = str_replace($height_replace,$height,$d_hover);
								$d_hover = str_replace($width_replace,$width,$d_hover);


							}

						}

						$output .='<svg viewBox="0 0 '.$width.' '.$height.'" class="button-back">';
							$output .='<path class="regular" d="'.$d.'" data-hover="'.$d_hover.'"/>';
							if ($animate_hover == "fill") {
						    	$output .='<path transform="translate(-'.$width.' 0)" class="hover" d="'.$d_hover.'" />';
							}
						$output .='</svg>';

					$output .='</a>';

				$output .='</div>';
			}

			$id_counter++;

			return $output;
		}
		add_shortcode('et_header_button', 'et_header_button');

	/*  et_align_container
    --------------*/

        function et_align_container($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'extra_class' => '',
                    'align'       => 'none',
                ), $atts)
            );

            static $id_counter = 1;

            $output      = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] ='align-container';
            $class[] ='align-'.$align;

            $output .= '<div id="align-container-'.$id_counter.'" class="'.implode(" ", $class).'">'.do_shortcode($content).'</div>';

			$id_counter++;

	        return $output;
        }

        add_shortcode('et_align_container', 'et_align_container');

	/*  et_header_mobile_container
    --------------*/

        function et_header_mobile_container($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'extra_class' => '',
                    'element_id'  => '',
                ), $atts)
            );

            static $id_counter = 1;

            $output      = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'mobile-container';

            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="mobile-container-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= '<div class="mobile-container-inner et-clearfix">';
					$output .= do_shortcode($content);
				$output .= '</div>';
			$output .= '</div>';
			$output .= '<div id="mobile-container-overlay-'.$element_id.'" class="mobile-container-overlay"></div>';

			$id_counter++;

	        return $output;
        }

        add_shortcode('et_header_mobile_container', 'et_header_mobile_container');

    /*	et_mobile_toggle
	--------------*/

		function et_mobile_toggle($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'align'                 => 'none',
					'size'                  => 'medium',
					'extra_class'     		=> '',
					'element_id'            => '',
					'hide_default'          => 'false',
					'hide_sticky'           => 'false',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'mobile-container-toggle';
			$class[] = 'hbe hbe-icon-element';
			$class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
			$class[] = 'hbe-'.$align;
			$class[] = 'size-'.$size;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="mobile-container-toggle-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= '<div id="mobile-toggle-'.$element_id.'" class="mobile-toggle hbe-toggle">'.file_get_contents(THEME_SVG.'mobile-toggle.svg').'</div>';
			$output .= '</div>';

			$id_counter++;

			return $output;

		}

		add_shortcode('et_mobile_toggle', 'et_mobile_toggle');

	/* et_mobile_close
    --------------*/

        function et_mobile_close($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'align'       => 'none',
                    'size'        => 'medium',
                    'extra_class' => '',
                    'element_id'  => '',
                ), $atts)
            );

            static $id_counter = 1;

            $output      = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'mobile-container-toggle';
            $class[] = 'hbe hbe-icon-element';
            $class[] = 'hbe-'.$align;
            $class[] = 'size-'.$size;

            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="mobile-container-toggle-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= '<div id="mobile-toggle-'.$element_id.'" class="mobile-toggle hbe-toggle active">'.file_get_contents(THEME_SVG.'mobile-toggle.svg').'</div>';
			$output .= '</div>';

            $id_counter++;

            return $output;

        }

        add_shortcode('et_mobile_close', 'et_mobile_close');

	/*	et_mobile_menu
	--------------*/

		function et_mobile_menu($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'menu'            		=> 'choose',
					'extra_class'     		=> '',
					'element_id'            => '',
					'text_align'            => 'left'
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'mobile-menu-container';
			$class[] = 'hbe';
			$class[] = 'text-align-'.$text_align;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			if (empty($menu) || $menu == "choose" || !isset($menu)) {
				if (has_nav_menu( 'header-menu' )) {
					$menu_arg = array(
						'theme_location'  => 'header-menu',
						'menu_class'      => 'mobile-menu hbe-inner et-clearfix',
						'menu_id'         => 'mobile-menu-'.$element_id,
						'container'       => 'div',
						'container_class' => implode(" ", $class),
						'container_id'    => 'mobile-menu-container-'.$element_id,
						'echo'            => false,
						'link_before'     => '<span class="txt">',
						'link_after'      => '</span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>',
						'depth'           => 10,
					);
				}
			} else {
				$menu_arg = array(
					'menu'  => $menu,
					'menu_class'      => 'mobile-menu hbe-inner et-clearfix',
					'menu_id'         => 'mobile-menu-'.$element_id,
					'container'       => 'div',
					'container_class' => implode(" ", $class),
					'container_id'    => 'mobile-menu-container-'.$element_id,
					'echo'            => false,
					'link_before'     => '<span class="txt">',
					'link_after'      => '</span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>',
					'depth'           => 10,
				);
			}

			$output .= wp_nav_menu($menu_arg);

			$id_counter++;

			return $output;
		}

		add_shortcode('et_mobile_menu', 'et_mobile_menu');

	/*	et_mobile_tab
	--------------*/

		function et_mobile_tab($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'type'   => 'horizontal',
					'element_id'  => '',
				), $atts)
			);

			$output = '';
			static $id_counter = 1;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$class = array();

			$class[] = 'et-mobile-tab';
			$class[] = 'et-clearfix';
			$class[] = $type;

			$output .= '<div class="et-mobile-tab-wrapper">';
				$output .='<div id="et-mobile-tab-'.$element_id.'" class="'.implode(" ", $class).'">';
					$output .= do_shortcode($content);
				$output .= '</div>';
			$output .= '</div>';

			$id_counter++;

			return $output;

		}
		add_shortcode('et_mobile_tab', 'et_mobile_tab');

		function et_mobile_tab_item($atts, $content = null) {

			extract(shortcode_atts(array(
				'title'  => '',
				'icon'   => '',
				'active' => 'false',
			), $atts));

			$output = '';

			static $id_counter = 1;

			if($active == 'true'){
				$active = "active";
			}

			$output .= '<div id="tab-'.sanitize_title($title).'-'.$id_counter.'" class="mob-tab-content et-clearfix">';
			    $output .= do_shortcode($content);
			$output .= '</div>';

			$output .= '<div data-target="tab-'. sanitize_title( $title ).'-'.$id_counter.'" class="'.esc_attr($active).' tab et-clearfix">';
				if (isset($icon) && !empty($icon)) {
					$icon = get_post($icon);
					if (is_object($icon) && $icon->post_mime_type == 'image/svg+xml') {
						$icon_output = file_get_contents($icon->guid);
						$output .= '<span class="icon">'.$icon_output.'</span>';
					}
				}
				if (isset($title) && !empty($title)) {
					$output .= esc_html($title);
				}
			$output .= '</div> ';

			$id_counter++;

			return $output;
		}
		add_shortcode('et_mobile_tab_item', 'et_mobile_tab_item');

	/*  et_header_modal_container
    --------------*/

		function et_header_modal_container($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'extra_class' => '',
					'element_id'  => '',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'modal-container';

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="modal-container-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= '<div class="modal-container-inner et-clearfix">';
					$output .= do_shortcode($content);
				$output .= '</div>';
				$output .= file_get_contents(THEME_SVG.'modal-container-back.svg');
			$output .= '</div>';

			$id_counter++;

			return $output;
		}

		add_shortcode('et_header_modal_container', 'et_header_modal_container');

	/*	et_modal_toggle
	--------------*/

		function et_modal_toggle($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'align'                 => 'none',
					'size'                  => 'medium',
					'extra_class'     		=> '',
					'element_id'            => '',
					'hide_default'          => 'false',
					'hide_sticky'           => 'false',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'modal-container-toggle';
			$class[] = 'hbe hbe-icon-element';
			$class[] = 'hide-default-'.$hide_default;
			$class[] = 'hide-sticky-'.$hide_sticky;
			$class[] = 'hbe-'.$align;
			$class[] = 'size-'.$size;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="modal-container-toggle-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= '<div id="modal-toggle-'.$element_id.'" class="modal-toggle hbe-toggle">'.file_get_contents(THEME_SVG.'mobile-toggle.svg').'</div>';
			$output .= '</div>';

			$id_counter++;

			return $output;

		}

		add_shortcode('et_modal_toggle', 'et_modal_toggle');

	/* et_modal_close
    --------------*/

        function et_modal_close($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'align'       => 'none',
                    'size'        => 'medium',
                    'extra_class' => '',
                    'element_id'  => '',
                ), $atts)
            );

            static $id_counter = 1;

            $output      = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'modal-container-toggle';
            $class[] = 'hbe hbe-icon-element';
            $class[] = 'hbe-'.$align;
            $class[] = 'size-'.$size;

            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="modal-container-toggle-'.$element_id.'" class="'.implode(" ", $class).'">';
				$output .= '<div id="modal-toggle-'.$element_id.'" class="modal-toggle hbe-toggle active">'.file_get_contents(THEME_SVG.'mobile-toggle.svg').'</div>';
			$output .= '</div>';

            $id_counter++;

            return $output;

        }

        add_shortcode('et_modal_close', 'et_modal_close');

    /*  et_modal_menu
    --------------*/

        function et_modal_menu($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'menu'         => 'choose',
                    'extra_class'  => '',
                    'element_id'   => '',
                ), $atts)
            );

            static $id_counter = 1;

            $output      = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'modal-menu-container';
            $class[] = 'nav-menu-container';
            $class[] = 'hbe';
            $class[] = 'text-align-left';

            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

            if (empty($menu) || $menu == "choose" || !isset($menu)) {
				if (has_nav_menu( 'header-menu' )) {
					$menu_arg = array(
						'theme_location'  => 'header-menu',
						'menu_class'      => 'modal-menu nav-menu hbe-inner et-clearfix',
		                'menu_id'         => 'modal-menu-'.$element_id,
		                'container'       => 'div',
		                'container_class' => implode(" ", $class),
		                'container_id'    => 'modal-menu-container-'.$element_id,
		                'echo'            => false,
		                'link_before'     => '<span class="txt">',
		                'link_after'      => '</span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>',
		                'depth'           => 2,
					);
				}
			} else {

	            $menu_arg = array(
	                'menu'  => $menu,
	                'menu_class'      => 'modal-menu nav-menu hbe-inner et-clearfix',
	                'menu_id'         => 'modal-menu-'.$element_id,
	                'container'       => 'div',
	                'container_class' => implode(" ", $class),
	                'container_id'    => 'modal-menu-container-'.$element_id,
	                'echo'            => false,
	                'link_before'     => '<span class="txt">',
	                'link_after'      => '</span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>',
	                'depth'           => 2,
	            );

	        }

            $output .= wp_nav_menu($menu_arg);

            $id_counter++;

            return $output;
        }

        add_shortcode('et_modal_menu', 'et_modal_menu');

    /*  et_vertical_align_top
    --------------*/

        function et_vertical_align_top($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'extra_class' => '',
                ), $atts)
            );

            static $id_counter = 1;

            $output      = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'snva';
            $class[] = 'vertical-align-top';

            $output .= '<div id="vertical-align-top-'.$id_counter.'" class="'.implode(" ", $class).'">'.do_shortcode($content).'</div>';

			$id_counter++;

	        return $output;
        }

        add_shortcode('et_vertical_align_top', 'et_vertical_align_top');

    /*  et_vertical_align_middle
    --------------*/

        function et_vertical_align_middle($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'extra_class' => '',
                ), $atts)
            );

            static $id_counter = 1;

            $output      = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'snva';
            $class[] = 'vertical-align-middle';

            $output .= '<div id="vertical-align-middle-'.$id_counter.'" class="'.implode(" ", $class).'">'.do_shortcode($content).'</div>';

			$id_counter++;

	        return $output;
        }

        add_shortcode('et_vertical_align_middle', 'et_vertical_align_middle');

    /*  et_vertical_align_bottom
    --------------*/

        function et_vertical_align_bottom($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'extra_class' => '',
                ), $atts)
            );

            static $id_counter = 1;

            $output      = '';

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'snva';
            $class[] = 'vertical-align-bottom';

            $output .= '<div id="vertical-align-bottom-'.$id_counter.'" class="'.implode(" ", $class).'">'.do_shortcode($content).'</div>';

			$id_counter++;

	        return $output;
        }

        add_shortcode('et_vertical_align_bottom', 'et_vertical_align_bottom');

    /*  et_header_sidebar_container
    --------------*/

        function et_header_sidebar_container($atts, $content = null) {

            extract(shortcode_atts(
                array(
                    'extra_class' => '',
                    'element_id'  => '',
                ), $atts)
            );

            static $id_counter = 1;

            $output      = '';

            $class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

            $class[] = 'sidebar-container';

            $element_id = (!empty($element_id)) ? $element_id : $id_counter;

            $output .= '<div id="sidebar-container-'.$element_id.'" class="'.implode(" ", $class).'">';

				$output .= '<div id="sidebar-container-toggle-'.$element_id.'" class="sidebar-container-toggle">';
					$output .= '<div id="sidebar-toggle-'.$element_id.'" class="sidebar-toggle hbe-toggle">'.file_get_contents(THEME_SVG.'sidebar-toggle.svg').'</div>';
				$output .= '</div>';

				$output .= '<div class="sidebar-container-content">';
					$output .= do_shortcode($content);
				$output .= '</div>';

			$output .= '</div>';

			$id_counter++;

	        return $output;
        }

        add_shortcode('et_header_sidebar_container', 'et_header_sidebar_container');

    /*	et_sidebar_menu
	--------------*/

		function et_sidebar_menu($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'menu'            	=> 'choose',
					'submenu_indicator' => 'false',
					'extra_class'     	=> '',
					'element_id'        => ''
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'sidebar-menu-container';
			$class[] = 'nav-menu-container';
			$class[] = 'hbe';
			$class[] = 'tl-text-align-left';
			$class[] = 'tl-submenu-ind-'.$submenu_indicator;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			if (empty($menu) || $menu == "choose" || !isset($menu)) {
				if (has_nav_menu( 'header-menu' )) {
					$menu_arg = array(
						'theme_location'  => 'header-menu',
						'menu_class'      => 'sidebar-menu nav-menu hbe-inner et-clearfix',
						'menu_id'         => 'sidebar-menu-'.$element_id,
						'container'       => 'div',
						'container_class' => implode(" ", $class),
						'container_id'    => 'sidebar-menu-container-'.$element_id,
						'echo'            => false,
						'link_before'     => '<span class="txt">',
						'link_after'      => '</span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>',
						'depth'           => 2,
						'walker'          => new et_scm_walker
					);
				}
			} else {

				$menu_arg = array(
					'menu'  => $menu,
					'menu_class'      => 'sidebar-menu nav-menu hbe-inner et-clearfix',
					'menu_id'         => 'sidebar-menu-'.$element_id,
					'container'       => 'div',
					'container_class' => implode(" ", $class),
					'container_id'    => 'sidebar-menu-container-'.$element_id,
					'echo'            => false,
					'link_before'     => '<span class="txt">',
					'link_after'      => '</span><span class="arrow">'.file_get_contents(THEME_SVG.'arrow.svg').'</span>',
					'depth'           => 2,
					'walker'          => new et_scm_walker
				);

			}

			$output .= wp_nav_menu($menu_arg);

			$id_counter++;

			return $output;
		}

		add_shortcode('et_sidebar_menu', 'et_sidebar_menu');

	/*	et_bullets
	--------------*/

		function et_bullets($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'menu'        => '',
					'extra_class' => '',
					'element_id'  => '',
					'offset'      => '0'
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class = array();

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$class[] = 'bullets-container';
			$class[] = 'one-page-true';
			$class[] = 'one-page-offset-'.$offset;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$menu_arg = array(
				'menu'  => $menu,
				'menu_class'      => 'bullets-menu hbe-inner et-clearfix',
				'menu_id'         => 'bullets-menu-'.$element_id,
				'container'       => 'nav',
				'container_class' => implode(" ", $class),
				'container_id'    => 'bullets-menu-container-'.$element_id,
				'link_after'      => '<span class="effect"></span>',
				'echo'            => false,
				'depth'           => 1,
			);

			$output .= wp_nav_menu($menu_arg);

			$id_counter++;

			return $output;
		}

		add_shortcode('et_bullets', 'et_bullets');

/*  TITLE SECTION
/*------------*/

	/*	et_title_section_title
	--------------*/

		function et_title_section_title($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'type'        => 'h1',
					'align'       => 'left',
					'tablet_align'=> 'left',
					'mobile_align'=> 'left',
					'text_align'  => 'left',
					'mf'             => 'inherit',
					'ml'           => 'inherit',
					'tlf'   => 'inherit',
					'tll' => 'inherit',
					'tpf'    => 'inherit',
					'tpf'  => 'inherit',
					'extra_class' => '',
					'element_id'  => '',
					'etp_title'   => '',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class   = array();
			$class[] = 'title-section-title-container tse';
			$class[] = 'text-align-'.$text_align;
			$class[] = 'align-'.$align;
			$class[] = 'tablet-align-'.$tablet_align;
			$class[] = 'mobile-align-'.$mobile_align;

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$attributes   = array();
			$attributes[] = 'data-mobile-font="'.esc_attr($mf).'"';
			$attributes[] = 'data-mobile-line-height="'.esc_attr($ml).'"';
			$attributes[] = 'data-tablet-landscape-font="'.esc_attr($tlf).'"';
			$attributes[] = 'data-tablet-portrait-font="'.esc_attr($tpf).'"';
			$attributes[] = 'data-tablet-landscape-line-height="'.esc_attr($tll).'"';
			$attributes[] = 'data-tablet-portrait-line-height="'.esc_attr($tpf).'"';

			$output .= '<div class="'.implode(" ",$class).'">';
				$output .= '<'.$type.' class="title-section-title" id="title-section-title-'.$element_id.'" '.implode(" ",$attributes).'>';
					$output .= esc_html($etp_title);
				$output .= '</'.$type.'>';
			$output .= '</div>';

			$id_counter++;

			return $output;
		}

		add_shortcode('et_title_section_title', 'et_title_section_title');

	/*	et_title_section_subtitle
	--------------*/

		function et_title_section_subtitle($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'type'        => 'p',
					'align'       => 'left',
					'tablet_align'=> 'left',
					'mobile_align'=> 'left',
					'text_align'  => 'left',
					'mf'             => 'inherit',
					'ml'           => 'inherit',
					'tlf'   => 'inherit',
					'tll' => 'inherit',
					'tpf'    => 'inherit',
					'tpf'  => 'inherit',
					'extra_class' => '',
					'element_id'  => '',
					'etp_subtitle'=> '',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class   = array();
			$class[] = 'title-section-subtitle-container tse';
			$class[] = 'text-align-'.$text_align;
			$class[] = 'align-'.$align;
			$class[] = 'tablet-align-'.$tablet_align;
			$class[] = 'mobile-align-'.$mobile_align;

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$attributes   = array();
			$attributes[] = 'data-mobile-font="'.esc_attr($mf).'"';
			$attributes[] = 'data-mobile-line-height="'.esc_attr($ml).'"';
			$attributes[] = 'data-tablet-landscape-font="'.esc_attr($tlf).'"';
			$attributes[] = 'data-tablet-portrait-font="'.esc_attr($tpf).'"';
			$attributes[] = 'data-tablet-landscape-line-height="'.esc_attr($tll).'"';
			$attributes[] = 'data-tablet-portrait-line-height="'.esc_attr($tpf).'"';

			$output .= '<div class="'.implode(" ",$class).'">';
				$output .= '<'.$type.' class="title-section-subtitle" id="title-section-subtitle-'.$element_id.'" '.implode(" ",$attributes).'>';
					$output .= esc_html($etp_subtitle);
				$output .= '</'.$type.'>';
			$output .= '</div>';

			$id_counter++;

			return $output;
		}

		add_shortcode('et_title_section_subtitle', 'et_title_section_subtitle');

	/*	et_breadcrumbs
	--------------*/

		function et_breadcrumbs($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'align'            => 'left',
					'tablet_align'     => 'left',
					'mobile_align'     => 'left',
					'text_align'       => 'left',
					'extra_class'      => '',
					'element_id'       => '',
					'etp_breadcrumbs'  => '',
				), $atts)
			);

			static $id_counter = 1;

			$output      = '';

			$class   = array();
			$class[] = 'et-breadcrumbs-container tse';
			$class[] = 'text-align-'.$text_align;
			$class[] = 'align-'.$align;
			$class[] = 'tablet-align-'.$tablet_align;
			$class[] = 'mobile-align-'.$mobile_align;

			if (!empty($extra_class)) {
				$class[] = esc_attr($extra_class);
			}

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div class="'.implode(" ",$class).'" id="et-breadcrumbs-container-'.$element_id.'">';
				$output .= '<div id="et-breadcrumbs-'.$element_id.'" class="et-breadcrumbs">'.$etp_breadcrumbs.'</div>';
			$output .= '</div>';

			$id_counter++;

			return $output;
		}

		add_shortcode('et_breadcrumbs', 'et_breadcrumbs');

/*  WIDGETS
/*------------*/

	/*  widget_contact_form
	/*------------*/

		function widget_contact_form($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'      => '',
					'submit_text'=> esc_html__('Send', 'enovathemes-addons'),
					'recipient'  => get_option('admin_email'),
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-contact-form-'.$id_counter.'" class="widget widget_fast_contact_widget">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
				);

				$instance = array(
					'title'       => $title,
					'submit_text' => $submit_text,
					'recipient' => $recipient,
				);

				$output .= textron_enovathemes_get_the_widget( 'Enovathemes_Addons_WP_Widget_Contact_Form', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_contact_form', 'widget_contact_form');

	/*  widget_facebook
	/*------------*/

		function widget_facebook($atts, $content = null) {

			extract(shortcode_atts(
				array(
				'title'         	    => '',
	 			'app_id'        	    => '',
				'language_code' 	    => 'en_US',
				'href'          	    => '',
				'width'         	    => '',
				'height'        	    => '',
				'timeline'      	    => 'true',
				'messages'      	    => 'true',
				'events'        	    => 'true',
				'hide_cover'    	    => 'false',
				'show_facepile' 	    => 'true',
				'small_header'  	    => 'false',
				'adapt_container_width' => 'true',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-facebook-'.$id_counter.'" class="widget widget_facebook">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
				);

				$instance = array(
					'title'         	    => $title,
		 			'app_id'        	    => $app_id,
					'language_code' 	    => $language_code,
					'href'          	    => $href,
					'width'         	    => $width,
					'height'        	    => $height,
					'timeline'      	    => $timeline,
					'messages'      	    => $messages,
					'events'        	    => $events,
					'hide_cover'    	    => $hide_cover,
					'show_facepile' 	    => $show_facepile,
					'small_header'  	    => $small_header,
					'adapt_container_width' => $adapt_container_width,
				);

				$output .= textron_enovathemes_get_the_widget( 'Enovathemes_Addons_WP_Widget_Facebook', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_facebook', 'widget_facebook');

	/*  widget_flickr
	/*------------*/

		function widget_flickr($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'          => '',
		 			'photos_number'  => '6',
		 			'flickr_id'      => '',
		 			'image_size'     => 'square',
		 			'display'        => 'latest',
		 			'columns_mob'    => '1',
		 			'columns_tablet' => '1',
		 			'columns_desk'   => '1',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-flickr-'.$id_counter.'" class="widget widget_flickr">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
				);

				$instance = array(
					'title'       => $title,
					'photos_number'  => $photos_number,
		 			'flickr_id'      => $flickr_id,
		 			'image_size'     => $image_size,
		 			'display'        => $display,
		 			'columns_mob'    => $columns_mob,
		 			'columns_tablet' => $columns_tablet,
		 			'columns_desk'   => $columns_desk,
				);

				$output .= textron_enovathemes_get_the_widget( 'Enovathemes_Addons_WP_Widget_Flickr', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_flickr', 'widget_flickr');

	/*  widget_instagram
	/*------------*/

		function widget_instagram($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'          => '',
					'link'           => '',
					'username'       => '',
					'number'         => 9,
					'target'         => '_self',
					'columns_mob'    => '1',
			 		'columns_tablet' => '1',
			 		'columns_desk'   => '1',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-instagram-'.$id_counter.'" class="widget widget_instagram">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
				);

				$instance = array(
					'title'          => $title,
					'link'           => $link,
					'username'       => $username,
					'number'         => $number,
					'target'         => $target,
					'columns_mob'    => $columns_mob,
			 		'columns_tablet' => $columns_tablet,
			 		'columns_desk'   => $columns_desk,
				);

				$output .= textron_enovathemes_get_the_widget( 'Enovathemes_Addons_WP_Widget_Instagram', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_instagram', 'widget_instagram');

	/*  widget_mailchimp
	/*------------*/

		function widget_mailchimp($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'       => '',
		 			'description' => '',
		 			'list'        => '',
		 			'first_name'  => 'false',
		 			'last_name'   => 'false',
		 			'phone'       => 'false',
		 			'required_first_name'  => 'false',
		 			'required_last_name'   => 'false',
		 			'required_phone'       => 'false',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-mailchimp-'.$id_counter.'" class="widget widget_mailchimp">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
				);

				$instance = array(
					'title'       => $title,
		 			'description' => $description,
		 			'list'        => $list,
		 			'first_name'  => $first_name,
		 			'last_name'   => $last_name,
		 			'phone'       => $phone,
		 			'required_first_name'  => $required_first_name,
		 			'required_last_name'   => $required_last_name,
		 			'required_phone'       => $required_phone,
				);

				$output .= textron_enovathemes_get_the_widget( 'Enovathemes_Addons_WP_Widget_Mailchimp', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_mailchimp', 'widget_mailchimp');

	/*  widget_posts
	/*------------*/

		function widget_posts($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title' => '',
					'number'=> '',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-posts-'.$id_counter.'" class="widget widget_et_recent_entries">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
				);

				$instance = array(
					'title'  => $title,
					'number' => intval($number),
				);

				$output .= textron_enovathemes_get_the_widget( 'Enovathemes_Addons_WP_Widget_Posts', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_posts', 'widget_posts');

	/*  widget_login
	/*------------*/

		function widget_login($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'             => '',
					'registration_link' => '',
					'forgot_link'       => '',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-login-'.$id_counter.'" class="widget widget_login widget_reglog">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
				);

				$instance = array(
					'title'  => $title,
					'registration_link'=> $registration_link,
					'forgot_link'=> $forgot_link,
				);

				$output .= textron_enovathemes_get_the_widget( 'Enovathemes_Addons_WP_Widget_Login', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_login', 'widget_login');

	/*  widget_product_categories
	/*------------*/

		function widget_product_categories($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'              => '',
					'orderby'            => 'order',
					'dropdown'           => '',
					'count'              => '',
					'hierarchical'       => '',
					'show_children_only' => '',
					'hide_empty'         => '',
					'max_depth'          => '',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-product-categories-'.$id_counter.'" class="widget widget_product_categories">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
				);

				$instance = array(
					'title'  			 => $title,
					'orderby'            => $orderby,
					'dropdown'           => $dropdown,
					'count'              => $count,
					'hierarchical'       => $hierarchical,
					'show_children_only' => $show_children_only,
					'hide_empty'         => $hide_empty,
					'max_depth'          => $max_depth,
				);

				$output .= textron_enovathemes_get_the_widget( 'WC_Widget_Product_Categories', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_product_categories', 'widget_product_categories');

	/*  widget_products_by_rating
	/*------------*/

		function widget_products_by_rating($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'  => '',
					'number' => ''
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-top-rated-products-'.$id_counter.'" class="widget widget_top_rated_products">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
	                'widget_id'     => $id_counter,
				);

				$instance = array(
					'title'  	=> $title,
					'number'    => $number
				);

				$output .= textron_enovathemes_get_the_widget( 'WC_Widget_Top_Rated_Products', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_products_by_rating', 'widget_products_by_rating');

	/*  widget_products
	/*------------*/

		function widget_products($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'       => '',
					'number'      => '',
					'show'        => '',
					'orderby'     => '',
					'order'       => '',
					'hide_free'   => '',
					'show_hidden' => '',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget-products-'.$id_counter.'" class="widget widget_products">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
	                'widget_id'     => $id_counter,
				);

				$instance = array(
					'title'  	=> $title,
					'number'    => $number,
					'show'        => $show,
					'orderby'     => $orderby,
					'order'       => $order,
					'hide_free'   => $hide_free,
					'show_hidden' => $show_hidden,
				);

				$output .= textron_enovathemes_get_the_widget( 'WC_Widget_Products', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_products', 'widget_products');

	/*  widget_recent_product_reviews
	/*------------*/

		function widget_recent_product_reviews($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'  => '',
					'number' => ''
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget_recent_reviews-'.$id_counter.'" class="widget widget_recent_reviews">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
	                'widget_id'     => $id_counter,
				);

				$instance = array(
					'title'  	=> $title,
					'number'    => $number
				);

				$output .= textron_enovathemes_get_the_widget( 'WC_Widget_Recent_Reviews', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_recent_product_reviews', 'widget_recent_product_reviews');

	/*  widget_recent_viewed_products
	/*------------*/

		function widget_recent_viewed_products($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'  => '',
					'number' => ''
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget_recently_viewed_products-'.$id_counter.'" class="widget widget_recently_viewed_products">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
	                'widget_id'     => $id_counter,
				);

				$instance = array(
					'title'  	=> $title,
					'number'    => $number
				);

				$output .= textron_enovathemes_get_the_widget( 'WC_Widget_Recently_Viewed', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_recent_viewed_products', 'widget_recent_viewed_products');

	/*  widget_product_tag_cloud
	/*------------*/

		function widget_product_tag_cloud($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'  => '',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				$args = array(
					'before_widget' => '<div id="widget_product_tag_cloud-'.$id_counter.'" class="widget widget_product_tag_cloud">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="widget_title">',
	                'after_title'   => '</h5>',
	                'widget_id'     => $id_counter,
				);

				$instance = array(
					'title'  	=> $title,
				);

				$output .= textron_enovathemes_get_the_widget( 'WC_Widget_Product_Tag_Cloud', $instance,$args);

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_product_tag_cloud', 'widget_product_tag_cloud');

	/*  widget_cart
	/*------------*/

		function widget_cart($atts, $content = null) {

			extract(shortcode_atts(
				array(
					'title'             => '',
					'registration_link' => '',
					'forgot_link'       => '',
				), $atts)
			);

			$output = '';

			static $id_counter = 1;

				if (class_exists('Woocommerce')){
	        		
					$args = array(
						'before_widget' => '<div id="widget_shopping_cart-'.$id_counter.'" class="widget woocommerce widget_shopping_cart">',
						'after_widget'  => '</div>',
						'before_title'  => '<h5 class="widget_title">',
		                'after_title'   => '</h5>',
					);

					$instance = array(
						'title'  => $title,
					);

					$output .= textron_enovathemes_get_the_widget( 'WC_Widget_Cart', $instance,$args);

				} else {
        			$output .= esc_html__('Please install Woocommerce','enovathemes-addons');
        		}

			$id_counter++;

			return $output;
		}

		add_shortcode('widget_cart', 'widget_cart');

/*  WOOCOMMERCE
/*------------*/

	function et_woo_products($atts, $content = null) {
		extract(shortcode_atts(
			array(
				'layout' 		   => 'grid',
				'navigation_type'  => 'arrows',
				'autoplay'         => 'false',
				'columns' 		   => 'small',
				'quantity' 		   => '12',
				'category' 		   => '',
				'operator' 		   => 'IN',
				'orderby' 		   => 'date',
				'order' 		   => 'ASC',
				'type' 			   => 'recent',
				'attribute' 	   => '',
				'ids' 			   => ''
			), $atts)
		);

		if (class_exists('Woocommerce')) {

			$output = '';

			global $post, $textron_enovathemes;

			$query_options = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'meta_query'          => WC()->query->get_meta_query(),
				'tax_query'           => WC()->query->get_tax_query(),
				'ignore_sticky_posts' => 1,
				'orderby'             => $orderby,
				'order'               => $order,
				'posts_per_page' 	  => absint($quantity),
			);

			if ($type == "custom"){
				if ( ! empty( $ids ) ) {
					$query_options['post__in'] = array_map( 'trim', explode( ',', $ids ) );
				}
			}

			if ($type == "featured"){
				$query_options = array(
					'post_type'           => 'product',
					'post_status'         => 'publish',
					'meta_query'          => WC()->query->get_meta_query(),
					'ignore_sticky_posts' => 1,
					'orderby'             => $orderby,
					'order'               => $order,
					'posts_per_page' 	  => absint($quantity),
					'tax_query'           => array(
						array(
							'taxonomy' => 'product_visibility',
							'field'    => 'name',
							'terms'    => 'featured',
							'operator' => 'IN',
						)
					),
				);
			}

			if ($type == "related"){

				if ( $post && $post->post_type ) {
					$post_type = $post->post_type;
					if (!is_wp_error($post_type)) {
						if ( empty( $product ) || ! $product->is_visible() ) {
							return;
						}
						$terms = get_the_terms( $product->get_id() , 'product_tag');
						if ($terms) {
							$tagids = array();
							foreach($terms as $tag) {$tagids[] = $tag->term_id;}
						}
						$query_options = array(
							'post_type'           => 'product',
							'post_status'         => 'publish',
							'ignore_sticky_posts' => 1,
							'posts_per_page'      => absint($quantity),
							'orderby'             => $orderby,
							'order'               => $order,
							'meta_query'          => WC()->query->get_meta_query(),
							'tax_query' => array(
			                    array(
			                        'taxonomy' => 'product_tag',
			                        'field'    => 'id',
			                        'terms'    => $tagids,
			                        'operator' => 'IN'
			                     )
			                ),
							'post__not_in'        => array($product->get_id())
						);
					}
				}
			}

			if ($type == "sale"){
				$query_options = array(
					'post_type'           => 'product',
					'post_status'         => 'publish',
					'meta_query'          => WC()->query->get_meta_query(),
					'ignore_sticky_posts' => 1,
					'orderby'             => $orderby,
					'order'               => $order,
					'posts_per_page' 	  => absint($quantity),
					'post__in'            => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
				);
			}

			if ($type == "best_selling"){
				$query_options = array(
					'post_type'           => 'product',
					'post_status'         => 'publish',
					'meta_query'          => WC()->query->get_meta_query(),
					'tax_query'           => WC()->query->get_tax_query(),
					'ignore_sticky_posts' => 1,
					'orderby'             => $orderby,
					'order'               => $order,
					'posts_per_page' 	  => absint($quantity),
					'meta_key'            => 'total_sales',
				);
			}

			if ($type == "attribute"){
				$query_options = array(
					'post_type'           => 'product',
					'post_status'         => 'publish',
					'meta_query'          => WC()->query->get_meta_query(),
					'ignore_sticky_posts' => 1,
					'orderby'             => $orderby,
					'order'               => $order,
					'posts_per_page' 	  => absint($quantity),
					'tax_query'           => array(
						array(
							'taxonomy' => strstr( $attribute, 'pa_' ) ? sanitize_title( $attribute ) : 'pa_' . sanitize_title( $attribute ),
							'terms'    => array_map( 'sanitize_title', explode( ',', $filter ) ),
							'field'    => 'slug',
						)
					),
				);
			}

			if ($type != "custom" && $type != "related" && isset($category) && !empty($category)) {
				$query_options = array(
					'post_type'           => 'product',
					'post_status' 	 	  => 'publish',
					'ignore_sticky_posts' => true,
					'orderby'             => $orderby,
					'order'               => $order,
					'posts_per_page' 	  => absint($quantity),
					'tax_query'           => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => explode(',',$category),
							'operator' => $operator
						)
					)
				);

				if ($type == "featured"){
					$query_options = array(
						'post_type'           => 'product',
						'post_status'         => 'publish',
						'meta_query'          => WC()->query->get_meta_query(),
						'ignore_sticky_posts' => 1,
						'orderby'             => $orderby,
						'order'               => $order,
						'posts_per_page' 	  => absint($quantity),
						'tax_query'           => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => explode(',',$category),
								'operator' => $operator
							),
							array(
								'taxonomy' => 'product_visibility',
								'field'    => 'name',
								'terms'    => 'featured',
								'operator' => 'IN',
							)
						),
					);
				}

				if ($type == "sale"){
					$query_options = array(
						'post_type'           => 'product',
						'post_status'         => 'publish',
						'meta_query'          => WC()->query->get_meta_query(),
						'ignore_sticky_posts' => 1,
						'orderby'             => $orderby,
						'order'               => $order,
						'posts_per_page' 	  => absint($quantity),
						'post__in'            => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
						'tax_query'           => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => explode(',',$category),
								'operator' => $operator
							)
						)
					);
				}

				if ($type == "best_selling"){
					$query_options = array(
						'post_type'           => 'product',
						'post_status'         => 'publish',
						'meta_query'          => WC()->query->get_meta_query(),
						'ignore_sticky_posts' => 1,
						'orderby'             => $orderby,
						'order'               => $order,
						'posts_per_page' 	  => absint($quantity),
						'meta_key'            => 'total_sales',
						'tax_query'           => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => explode(',',$category),
								'operator' => $operator
							)
						)
					);
				}

				if ($type == "attribute"){
					$query_options = array(
						'post_type'           => 'product',
						'post_status'         => 'publish',
						'meta_query'          => WC()->query->get_meta_query(),
						'ignore_sticky_posts' => 1,
						'orderby'             => $orderby,
						'order'               => $order,
						'posts_per_page' 	  => absint($quantity),
						'tax_query'           => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => explode(',',$category),
								'operator' => $operator
							),
							array(
								'taxonomy' => strstr( $attribute, 'pa_' ) ? sanitize_title( $attribute ) : 'pa_' . sanitize_title( $attribute ),
								'terms'    => array_map( 'sanitize_title', explode( ',', $filter ) ),
								'field'    => 'slug',
							)
						),
					);
				}

			}

			$products = new WP_Query($query_options);

			if($products->have_posts()){

				$product_image_full   = (isset($GLOBALS['textron_enovathemes']['product-image-full']) && $GLOBALS['textron_enovathemes']['product-image-full'] == 1) ? "true" : "false";

				$class      = array();
				$list_class = array();
				$attributes = array();
				$carousel_columns = 5;

				$list_class[] = 'loop-posts';
				$list_class[] = 'loop-products';

				$class[] = 'et-woo-products';
				$class[] = esc_attr($columns);
				$class[] = esc_attr($layout);

				if ($layout == "carousel") {

					$class[] = 'et-carousel';
					$class[] = $navigation_type;

					$carousel_columns = 5;

					if ($columns == 'medium') {
						$carousel_columns = 4;
					} elseif($columns == 'large') {
						$carousel_columns = 3;
					}

					$attributes[] = 'data-columns="'.esc_attr($carousel_columns).'"';
					$attributes[] = 'data-autoplay="'.esc_attr($autoplay).'"';
					$attributes[] = 'data-nav="'.esc_attr($navigation_type).'"';

					$list_class[] = 'slides';

				}

				$element_id = rand(1,1000000);
				$attributes[] = 'id="et-woo-products'.$element_id .'"';
				$attributes[] = 'class="'.esc_attr(implode(' ', $class)).'"';

				$output .= '<div '.implode(' ', $attributes).'>';
					$output .= '<ul class="'.esc_attr(implode(' ', $list_class)).'" data-columns="'.esc_attr($carousel_columns).'">';

						while ($products->have_posts() ) {
							$products->the_post();

							global $product;

							$output .= '<li class="'.join( ' ', get_post_class('post')).'" id="product-'.esc_attr($product->get_id()).'">';

								ob_start();

									do_action( 'woocommerce_before_shop_loop_item' );
									do_action( 'woocommerce_before_shop_loop_item_title' );
									do_action( 'woocommerce_shop_loop_item_title' );
									do_action( 'woocommerce_after_shop_loop_item_title' );
									do_action( 'woocommerce_after_shop_loop_item' );

								$output .= ob_get_clean();

							$output .= '</li>';

						}

						wp_reset_postdata();

					$output .= '</ul>';
				$output .= '</div>';

	            return $output;

			}

		}
	}
	add_shortcode('et_woo_products', 'et_woo_products');

	function et_woo_categories($atts, $content = null) {
		extract(shortcode_atts(
			array(
				'layout' 		   => 'grid',
				'navigation_type'  => 'arrows',
				'autoplay'         => 'false',
				'columns' 		   => 'small',
				'category' 		   => '',
				'orderby' 		   => 'date',
				'order' 		   => 'ASC',
			), $atts)
		);

		if (class_exists('Woocommerce')) {

			$output = '';

			global $post;

			$categories = array_filter( array_map( 'trim', explode( ',', $category ) ) );

			$args = array(
				'orderby'    => $orderby,
				'order'      => $order,
				'include'    => $categories,
				'pad_counts' => true,
				'taxonomy'   => 'product_cat',
			    'hide_empty' => true,
			);

			$product_categories = get_terms($args);

			ob_start();

			if($product_categories){

				$class      = array();
				$list_class = array();
				$attributes = array();
				$carousel_columns = 5;

				$list_class[] = 'loop-posts';
				$list_class[] = 'loop-products';

				$class[] = 'et-woo-products';
				// $class[] = 'et-woo-categories';
				$class[] = esc_attr($columns);
				$class[] = esc_attr($layout);

				if ($layout == "carousel") {

					$class[] = 'et-carousel';
					$class[] = $navigation_type;

					$carousel_columns = 5;

					if ($columns == 'medium') {
						$carousel_columns = 4;
					} elseif($columns == 'large') {
						$carousel_columns = 3;
					}

					$attributes[] = 'data-columns="'.esc_attr($carousel_columns).'"';
					$attributes[] = 'data-autoplay="'.esc_attr($autoplay).'"';
					$attributes[] = 'data-nav="'.esc_attr($navigation_type).'"';

					$list_class[] = 'slides';

				}

				$element_id = rand(1,1000000);
				$attributes[] = 'id="et-woo-categories'.$element_id .'"';
				$attributes[] = 'class="'.esc_attr(implode(' ', $class)).'"';

				foreach ( $product_categories as $product_category ) {
					wc_get_template( 'content-product_cat.php', array(
						'category' => $product_category,
					) );
				}

				$output .= '<div '.implode(' ', $attributes).'>';
					$output .= '<ul class="'.esc_attr(implode(' ', $list_class)).'" data-columns="'.esc_attr($carousel_columns).'">';
						$output .= textron_enovathemes_minify_css(ob_get_clean());
					$output .= '</ul>';
				$output .= '</div>';

	            return $output;

	            woocommerce_reset_loop();

			}

		}
	}
	add_shortcode('et_woo_categories', 'et_woo_categories');

/*  POSTS
/*------------*/

	function et_posts($atts, $content = null) {
		extract(shortcode_atts(
			array(
				'layout' 		   => 'grid',
				'orientation'      => 'landscape',
				'navigation_type'  => 'only-arrows',
				'autoplay'         => 'false',
				'quantity' 		   => '12',
				'category' 		   => '',
				'excerpt' 		   => '104',
				'title_length'     => '47',
				'operator' 		   => 'IN',
				'orderby' 		   => 'date',
				'order' 		   => 'ASC',
				'text_color'       => '',
				'body_color'       => '',
				'element_id'       => ''
			), $atts)
		);

		$output = '';

		global $post;

		static $id_counter = 1;

		$query_options = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby'             => $orderby,
			'order'               => $order,
			'posts_per_page' 	  => absint($quantity),
		);

		if (isset($category) && !empty($category)) {
			$query_options = array(
				'post_type'           => 'post',
				'post_status' 	 	  => 'publish',
				'ignore_sticky_posts' => true,
				'orderby'             => $orderby,
				'order'               => $order,
				'posts_per_page' 	  => absint($quantity),
				'tax_query'           => array(
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => explode(',',$category),
						'operator' => $operator
					)
				)
			);

		}

		$posts = new WP_Query($query_options);

		if($posts->have_posts()){

			$class 		= array();
			$attributes = array();

			$full_images = $full_content = '';

			$class[] = 'loop-posts';
			$class[] = 'et-clearfix';

			if ($layout == "carousel") {

				$class[] = 'et-carousel';
				$class[] = 'navigation-'.$navigation_type;

				$attributes[] = 'data-nav="'.$navigation_type.'"';
				$attributes[] = 'data-autoplay="'.$autoplay.'"';
				$attributes[] = 'data-columns="3"';
				
			} else {
				$attributes[] = 'data-columns="2"';
			}

			$shortcode_class = array();
			$shortcode_class[] = 'et-shortcode-posts';
			$shortcode_class[] = 'blog-layout';
			$shortcode_class[] = 'blog-layout-'.esc_attr($layout);
			$shortcode_class[] = esc_attr($layout);

			$thumb_size = ($layout == "list") ? 'textron_425X425' : 'textron_600X400';

			if ($layout == "full")  {
				$thumb_size = 'textron_1200X800';
				$shortcode_class[] = 'layout-sidebar-none';
				$shortcode_class[] = $orientation;
				if (isset($text_color) && !empty($text_color)) {
					$shortcode_class[] = 'color';
				}
			}

			$image_width = $image_height = 0;

			$element_id = (!empty($element_id)) ? $element_id : $id_counter;

			$output .= '<div id="et-posts-'.$element_id.'" class="'.implode(' ',$shortcode_class).'">';
				$output .= '<div class="'.esc_attr(implode(' ', $class)).'" '.implode(' ', $attributes).'>';
					
					if ($layout == "carousel") {$output .= '<div class="slides">';}

					while ($posts->have_posts() ) {
						$posts->the_post();
						if ($layout == 'full') {

							if (has_post_thumbnail()){
			                    $full_images .='<div class="post-image overlay-hover post-media">';
			                        $full_images .= textron_enovathemes_post_image_overlay($layout);
			                        $full_images .='<div class="image-container">';

			                        	$thumbnail_id  = get_post_thumbnail_id( get_the_ID() );
								        $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
								        $thumbnail     = wp_get_attachment_image_src($thumbnail_id,$thumb_size);
								        $data_img      = TEXTRON_SVG.'image_placeholder.svg';

			                            $full_images .= '<img class="lazy-img" width="'.esc_attr($thumbnail[1]).'" height="'.esc_attr($thumbnail[2]).'" src="'.$data_img.'" data-src="'.esc_url($thumbnail[0]).'" alt="'.$thumbnail_alt.'" />';
			                        $full_images .='</div>';
			                    $full_images .='</div>';

			                    if ($posts->current_post==0){
			                    	$image_width  = esc_attr($thumbnail[1]);
			                    	$image_height = esc_attr($thumbnail[2]);
			                    }

			                }

			                $full_content .='<div class="post-body et-clearfix">';
							    $full_content .='<div class="post-body-inner">';
					                $full_content .='<div class="post-meta et-clearfix">';
					                    $full_content .= '<div class="post-date">'.get_the_date().'</div>';
					                    if ('' != get_the_category_list()) {
					                        $full_content .= '<div class="post-category">'.get_the_category_list(', ').'</div>';
					                    }
					                $full_content .='</div>';

									if ( '' != the_title_attribute( 'echo=0' ) ){
					                    $full_content .='<h4 class="post-title entry-title">';
					                        $full_content .= '<a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr__("Read more about", 'enovathemes-addons').' '.the_title_attribute( 'echo=0' ).'" rel="bookmark">';
					                            $full_content .= textron_enovathemes_substrwords(the_title_attribute( 'echo=0' ), $title_length);
					                        $full_content .= '</a>';
					                    $full_content .='</h4>';
					                }
									if ( '' != get_the_excerpt() && $excerpt > 0){
					                        $full_content .='<div class="post-excerpt">'.textron_enovathemes_substrwords(get_the_excerpt(),$excerpt).'</div>';
					                }

                    				$full_content .='<a href="'.esc_url(get_the_permalink()).'" class="post-read-more" title="'.esc_attr__("Read more about", 'enovathemes-addons').' '.the_title_attribute( 'echo=0' ).'">'.esc_html__("Read more", 'enovathemes-addons').file_get_contents(THEME_SVG.'arrow.svg').'</a>';


				                $full_content .='</div>';
							$full_content .='</div>';

						} else {
							$output .= textron_enovathemes_post($layout,$excerpt,$thumb_size);
						}
					}

					if ($layout == 'full') {

						$output .= '<div class="post">';

							$output .= '<div class="full-images">';

								if (!empty($image_width)) {
									$output .= '<div class="full-images-placeholder image-container">';
										$output .= '<svg class="media-placeholder" viewBox="0 0 '.$image_width.' '.$image_height.'"><path d="M0,0H'.$image_width.'V'.$image_height.'H0V0Z" /></svg>';
			            				$output .= file_get_contents(THEME_SVG.'placeholder.svg');
			            			$output .= '</div>';
		            			}

								$output .= '<div class="full-images-slides">';
									$output .= $full_images;
								$output .= '</div>';
							$output .= '</div>';

							if (!empty($body_color)) {
								$output .= '<div class="full-content" data-color="'.esc_attr($body_color).'">';
							} else {
								$output .= '<div class="full-content">';
							}
								$output .='<div class="tns-controls-trigger">';
			                        $output .='<button type="button" data-controls="prev" tabindex="-1" aria-controls="tns1"></button>';
			                        $output .='<button type="button" data-controls="next" tabindex="-1" aria-controls="tns1"></button>';
			                    $output .='</div>';
								$output .= '<div class="full-content-slides">';
									$output .= $full_content;
								$output .= '</div>';
							$output .= '</div>';

						$output .= '</div>';

					}

					wp_reset_postdata();

					if ($layout == "carousel") {$output .= '</div>';}

				$output .= '</div>';
			$output .= '</div>';

			$id_counter++;

            return $output;

		}
	}
	add_shortcode('et_posts', 'et_posts');

	function et_projects($atts, $content = null) {
		extract(shortcode_atts(
			array(
				'layout' 		   => 'grid',
				'project_filter'   => 'false',
				'default_filter'   => 'all',
				'navigation_type'  => 'arrows',
				'autoplay'         => 'false',
				'quantity' 		   => '12',
				'category' 		   => '',
				'operator' 		   => 'IN',
				'orderby' 		   => 'date',
				'order' 		   => 'ASC',
			), $atts)
		);

		$output = '';

		global $post, $textron_enovathemes;

		$project_image_full  = (isset($GLOBALS['textron_enovathemes']['project-image-full']) && $GLOBALS['textron_enovathemes']['project-image-full'] == 1) ? "true" : "false";

		$query_options = array(
			'post_type'           => 'project',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby'             => $orderby,
			'order'               => $order,
			'posts_per_page' 	  => absint($quantity),
		);

		if (isset($category) && !empty($category)) {

			$project_filter = false;

			$query_options = array(
				'post_type'           => 'project',
				'post_status' 	 	  => 'publish',
				'ignore_sticky_posts' => true,
				'orderby'             => $orderby,
				'order'               => $order,
				'posts_per_page' 	  => absint($quantity),
				'tax_query'           => array(
					array(
						'taxonomy' => 'project-category',
						'field'    => 'slug',
						'terms'    => explode(',',$category),
						'operator' => 'IN'
					)
				)
			);

		}

		if ($default_filter != 'all' && $project_filter == true) {
			$query_options = array(
				'post_type'           => 'project',
				'post_status' 	 	  => 'publish',
				'ignore_sticky_posts' => true,
				'orderby'             => $orderby,
				'order'               => $order,
				'posts_per_page' 	  => absint($quantity),
				'tax_query'           => array(
					array(
						'taxonomy' => 'project-category',
						'field'    => 'slug',
						'terms'    => $default_filter,
						'operator' => 'IN'
					),
					array(
						'taxonomy' => 'project-category',
						'field'    => 'slug',
						'terms'    => $project_post_category_filter,
						'operator' => 'NOT IN'
					)
				)
			);
		}

		$projects = new WP_Query($query_options);

		if($projects->have_posts()){

			$class      = array();
			$attributes = array();

			$class[] = 'loop-posts';
			$class[] = 'loop-projects';

			if ($layout == "carousel") {
				$class[] = 'et-carousel';
				$class[] = 'navigation-'.$navigation_type;
				$attributes[] = 'data-columns="3"';
				$attributes[] = 'data-autoplay="'.esc_attr($autoplay).'"';
				$attributes[] = 'data-nav="'.esc_attr($navigation_type).'"';
			}

			$shortcode_class = array();
			$shortcode_class[] = 'et-shortcode-projects';
			$shortcode_class[] = 'project-layout';
			$shortcode_class[] = esc_attr($layout);

			if ($project_filter == "true") {
				$shortcode_class[] = 'filter';
			}

			$element_id = rand(1,1000000);

			$attributes[] = 'id="loop-projects'.$element_id .'"';

			$output .= '<div id="et-shortcode-projects-'.$element_id.'" data-id="'.$element_id.'" class="'.implode(" ", $shortcode_class).'">';

				if ($project_filter == "true"){

					$options = array(
						'post_type' 	 => 'project',
						'term'      	 => 'project-category',
						'default_filter' => 'all',
						'shortcode' 	 => false,
						'order' 		 => 'DESC',
						'orderby' 		 => 'date',
						'shortcode' 	 => 'true',
						'posts_per_page' => $quantity,
						'layout' 		 => $layout,
						'full' 		     => $project_image_full,
					);

					$output .= enovathemes_addons_term_filter($options);
				}

				$output .= '<div class="'.esc_attr(implode(' ', $class)).'" '.implode(' ', $attributes).'>';

					$thumb_size = 'textron_600X400';

					if ($layout == "list") {
						$thumb_size = 'textron_425X425';
					}

					if ($project_image_full == "true") {
						$thumb_size = 'full';
					}


					if ($layout == "carousel") {$output .= '<div class="slides">';}

						while ($projects->have_posts() ) {
							$projects->the_post();
							$output .= enovathemes_addons_project_post($layout,$thumb_size);
						}

					if ($layout == "carousel") {$output .= '</div>';}


					wp_reset_postdata();

				$output .= '</div>';

				if ($project_filter == "true"){
					$output .='<svg viewBox="0 0 56 56" class="post-ajax-button shortcode">';
                        $output .='<circle class="loader-path" cx="28" cy="28" r="20" />';
                    $output .='</svg>';
				}

			$output .= '</div>';

            return $output;

		}
	}
	add_shortcode('et_projects', 'et_projects');

/*	Content filter
/*------------*/

    add_filter("the_content", "enovathemes_addons_the_content_filter");
    function enovathemes_addons_the_content_filter($content) {

        $block = join("|",array("et_gap","et_gap_inline","et_icon","et_separator"));

        $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

        $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

        return $rep;

    }

    function enovathemes_addons_shortcode_empty_paragraph_fix( $content ) {

        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );

        $content = strtr( $content, $array );

        return $content;
    }

    add_filter( 'the_content', 'enovathemes_addons_shortcode_empty_paragraph_fix' );
?>