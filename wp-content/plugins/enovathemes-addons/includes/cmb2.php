<?php

require_once(__DIR__ . '/cmb2/init.php');

add_action( 'cmb2_admin_init', 'enovathemes_addons_register_metabox' );

function enovathemes_addons_register_metabox() {

	$prefix = 'enovathemes_addons_';

	global $textron_enovathemes;

	$main_color 	 = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';
	$secondory_color = (isset($GLOBALS['textron_enovathemes']['secondory-color']) && $GLOBALS['textron_enovathemes']['secondory-color']) ? $GLOBALS['textron_enovathemes']['secondory-color'] : '#00245a';


	/*  Footer
	/*-------------------*/

		$cmb_footer_layout = new_cmb2_box( array(
			'id'            => $prefix.'footer_options_metabox',
			'title'         => esc_html__( 'Footer options', 'enovathemes-addons' ),
			'object_types'  => array( 'footer', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
		) );

		$cmb_footer_layout->add_field( array(
			'name' => esc_html__( 'Element css', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_css',
		));

		$cmb_footer_layout->add_field( array(
			'name' => esc_html__( 'Element font', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_font',
		));

		$cmb_footer_layout->add_field( array(
			'name'             => esc_html__( 'Sticky?', 'enovathemes-addons' ),
			'id'               => $prefix . 'sticky',
			'type'             => 'checkbox',
		) );

		$cmb_footer_layout->add_field( array(
			'name'        => esc_html__( 'Custom form styling', 'enovathemes-addons' ),
			'description' => esc_html__( 'If you use form elements in the footer you can configure form styles here', 'enovathemes-addons' ),
			'id'          => $prefix . 'custom_form_styling',
			'type'        => 'checkbox',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Field text color', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_color',
			'type'    => 'colorpicker',
			'default' => '#616161',
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Field text color focus', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_color_focus',
			'type'    => 'colorpicker',
			'default' => '#616161',
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Field background color', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_back_color',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Field background color focus', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_back_color_focus',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Field border color', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_border_color',
			'type'    => 'colorpicker',
			'default' => '#e5e5e5',
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Field border color focus', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_border_color_focus',
			'type'    => 'colorpicker',
			'default' => $secondory_color,
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Button text color', 'enovathemes-addons' ),
			'id'      => $prefix . 'button_color',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Button text color hover', 'enovathemes-addons' ),
			'id'      => $prefix . 'button_color_hover',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Button background color', 'enovathemes-addons' ),
			'id'      => $prefix . 'button_back_color',
			'type'    => 'colorpicker',
			'default' => $secondory_color,
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Button background color hover', 'enovathemes-addons' ),
			'id'      => $prefix . 'button_back_color_hover',
			'type'    => 'colorpicker',
			'default' => $main_color,
			'classes' => 'custom-form-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'        => esc_html__( 'Custom widget styling', 'enovathemes-addons' ),
			'description' => esc_html__( 'If you use widgets in the footer you can configure widgets styles here', 'enovathemes-addons' ),
			'id'          => $prefix . 'custom_widget_styling',
			'type'        => 'checkbox',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Widget title color', 'enovathemes-addons' ),
			'id'      => $prefix . 'widget_title_color',
			'type'    => 'colorpicker',
			'default' => $main_color,
			'classes' => 'custom-widget-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Widget text color', 'enovathemes-addons' ),
			'id'      => $prefix . 'widget_color',
			'type'    => 'colorpicker',
			'default' => '#616161',
			'classes' => 'custom-widget-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Widget link color', 'enovathemes-addons' ),
			'id'      => $prefix . 'widget_link_color',
			'type'    => 'colorpicker',
			'default' => $secondory_color,
			'classes' => 'custom-widget-styling',
		) );

		$cmb_footer_layout->add_field( array(
			'name'    => esc_html__( 'Widget link color hover', 'enovathemes-addons' ),
			'id'      => $prefix . 'widget_link_color_hover',
			'type'    => 'colorpicker',
			'default' => $main_color,
			'classes' => 'custom-widget-styling',
		) );

	/*  Header
	/*-------------------*/

		$cmb_header_layout = new_cmb2_box( array(
			'id'            => $prefix.'header_options_metabox',
			'title'         => esc_html__( 'Header options', 'enovathemes-addons' ),
			'object_types'  => array( 'header', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
		) );

		$cmb_header_layout->add_field( array(
			'name' => esc_html__( 'Element css', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_css',
		));

		$cmb_header_layout->add_field( array(
			'name' => esc_html__( 'Element font', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_font',
		));

		$cmb_header_layout->add_field( array(
			'name'             => esc_html__( 'Header type', 'enovathemes-addons' ),
			'id'               => $prefix . 'header_type',
			'type'             => 'select',
			'classes'          => 'select-230',
			'options'          => array(
				'desktop'      => esc_html__( 'Desktop', 'enovathemes-addons' ),
				'mobile'       => esc_html__( 'Mobile', 'enovathemes-addons' ),
				'sidebar'      => esc_html__( 'Sidebar', 'enovathemes-addons' ),
			),
			'default' => 'desktop',
		) );

		$cmb_header_layout->add_field( array(
			'name'             => esc_html__( 'Transparent', 'enovathemes-addons' ),
			'id'               => $prefix . 'transparent',
			'type'             => 'checkbox',
			'classes'          => 'sidebar-off',
		) );

		$cmb_header_layout->add_field( array(
			'name'             => esc_html__( 'Sticky', 'enovathemes-addons' ),
			'id'               => $prefix . 'sticky',
			'type'             => 'checkbox',
			'classes'          => 'sidebar-off',
		) );

		$cmb_header_layout->add_field( array(
			'name'             => esc_html__( 'Shadow', 'enovathemes-addons' ),
			'id'               => $prefix . 'shadow',
			'type'             => 'checkbox',
			'classes'          => 'sidebar-off',
		) );
		$cmb_header_layout->add_field( array(
			'name'             => esc_html__( 'Shadow on sticky', 'enovathemes-addons' ),
			'id'               => $prefix . 'shadow_sticky',
			'type'             => 'checkbox',
			'classes'          => 'sidebar-off',
		) );

	/*  Megamenu
	/*-------------------*/

		$cmb_megamenu_layout = new_cmb2_box( array(
			'id'            => $prefix.'megamenu_options_metabox',
			'title'         => esc_html__( 'Megamenu options', 'enovathemes-addons' ),
			'object_types'  => array( 'megamenu', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
		) );

		$cmb_megamenu_layout->add_field( array(
			'name' => esc_html__( 'Element css', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_css',
		));

		$cmb_megamenu_layout->add_field( array(
			'name' => esc_html__( 'Element font', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_font',
		));

		$cmb_megamenu_layout->add_field( array(
			'name'             => esc_html__( 'Megamenu width', 'enovathemes-addons' ),
			'id'               => $prefix . 'megamenu_width',
			'type'             => 'select',
			'classes'          => 'select-230',
			'options'          => array(
				'100'=> '100%',
				'1200' => 'grid width',
				'75' => '75%',
				'60' => '60%',
				'50' => '50%',
				'30' => '30%',
				'25' => '25%',
			),
			'default' => '1200',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'             => esc_html__( 'Megamenu position', 'enovathemes-addons' ),
			'id'               => $prefix . 'megamenu_position',
			'type'             => 'select',
			'classes'          => 'select-230 megamenu-toggle',
			'options'          => array(
				'left'=> 'left',
				'right' => 'right',
				'center' => 'center',
			),
			'default' => 'left',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Megamenu horizontal offset in px', 'enovathemes-addons' ),
			'description' => esc_html__( 'Enter negative or positive integer value without any string', 'enovathemes-addons' ),
			'id'      => $prefix . 'megamenu_offset',
			'classes'          => 'megamenu-toggle',
			'type'    => 'text_small',
			'default' => '',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'        => esc_html__( 'Custom form styling', 'enovathemes-addons' ),
			'description' => esc_html__( 'If you use form elements in the megamenu you can configure form styles here', 'enovathemes-addons' ),
			'id'          => $prefix . 'custom_form_styling',
			'type'        => 'checkbox',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Field text color', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_color',
			'type'    => 'colorpicker',
			'default' => '#616161',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Field text color focus', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_color_focus',
			'type'    => 'colorpicker',
			'default' => '#212121',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Field background color', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_back_color',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Field background color focus', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_back_color_focus',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Field border color', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_border_color',
			'type'    => 'colorpicker',
			'default' => '#e0e0e0',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Field border color focus', 'enovathemes-addons' ),
			'id'      => $prefix . 'field_border_color_focus',
			'type'    => 'colorpicker',
			'default' => '#cccccc',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Button text color', 'enovathemes-addons' ),
			'id'      => $prefix . 'button_color',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Button text color hover', 'enovathemes-addons' ),
			'id'      => $prefix . 'button_color_hover',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Button background color', 'enovathemes-addons' ),
			'id'      => $prefix . 'button_back_color',
			'type'    => 'colorpicker',
			'default' => '#00bfff',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Button background color hover', 'enovathemes-addons' ),
			'id'      => $prefix . 'button_back_color_hover',
			'type'    => 'colorpicker',
			'default' => '#212121',
			'classes' => 'custom-form-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'        => esc_html__( 'Custom widget styling', 'enovathemes-addons' ),
			'description' => esc_html__( 'If you use widgets in the megamenu you can configure widgets styles here', 'enovathemes-addons' ),
			'id'          => $prefix . 'custom_widget_styling',
			'type'        => 'checkbox',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Widget title color', 'enovathemes-addons' ),
			'id'      => $prefix . 'widget_title_color',
			'type'    => 'colorpicker',
			'default' => '#212121',
			'classes' => 'custom-widget-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Widget text color', 'enovathemes-addons' ),
			'id'      => $prefix . 'widget_color',
			'type'    => 'colorpicker',
			'default' => '#616161',
			'classes' => 'custom-widget-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Widget link color', 'enovathemes-addons' ),
			'id'      => $prefix . 'widget_link_color',
			'type'    => 'colorpicker',
			'default' => '#00bfff',
			'classes' => 'custom-widget-styling',
		) );

		$cmb_megamenu_layout->add_field( array(
			'name'    => esc_html__( 'Widget link color hover', 'enovathemes-addons' ),
			'id'      => $prefix . 'widget_link_color_hover',
			'type'    => 'colorpicker',
			'default' => '#212121',
			'classes' => 'custom-widget-styling',
		) );

	/*  Title section
	/*-------------------*/

		$cmb_title_section_layout = new_cmb2_box( array(
			'id'            => $prefix.'title_section_options_metabox',
			'title'         => esc_html__( 'Title section', 'enovathemes-addons' ),
			'object_types'  => array( 'title_section', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
		) );

		$cmb_title_section_layout->add_field( array(
			'name' => esc_html__( 'Element css', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_css',
		));

		$cmb_title_section_layout->add_field( array(
			'name' => esc_html__( 'Element font', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_font',
		));

	/*  Pages
	/*-------------------*/

		$cmb_page_layout = new_cmb2_box( array(
			'id'            => $prefix.'page_options_metabox',
			'title'         => esc_html__( 'Page options', 'enovathemes-addons' ),
			'object_types'  => array( 'page', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
		) );

		$cmb_page_layout->add_field( array(
			'name' => esc_html__( 'Element css', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_css',
		));

		$cmb_page_layout->add_field( array(
			'name' => esc_html__( 'Element font', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_font',
		));

		$cmb_page_layout->add_field( array(
			'name'             => esc_html__( 'Subtitle', 'enovathemes-addons' ),
			'id'               => $prefix . 'subtitle',
			'type'             => 'text_medium',
		) );

		/*  Headers
		/*-------------------*/

			$headers_array = array(
				'none'    => esc_html__( 'None', 'enovathemes-addons' ),
				'default' => esc_html__( 'Default', 'enovathemes-addons' ),
				'inherit' => esc_html__( 'Inherit', 'enovathemes-addons' ),
			);

			$et_header = new WP_Query(array(
	            'post_type'           => 'header',
	            'post_status'         => 'publish',
	            'ignore_sticky_posts' => 0,
	            'orderby'             => 'title',
	            'order'               => 'ASK',
	            'posts_per_page'      => -1,
	        ));

	        if($et_header->have_posts()){
	        	while($et_header->have_posts()) : $et_header->the_post();

	        		$header_id    = get_the_ID();
	        		$header_title = get_the_title($header_id);

	        		$headers_array[$header_id] = $header_title;

	        	endwhile;
	        	wp_reset_postdata();
	        }

	        $cmb_page_layout->add_field( array(
				'name'             => esc_html__( 'Mobile header', 'enovathemes-addons' ),
				'id'               => $prefix . 'mobile_header',
				'type'             => 'select',
				'classes'          => 'select-230',
				'options'          => $headers_array,
				'default' => 'inherit',
			) );

			$cmb_page_layout->add_field( array(
				'name'             => esc_html__( 'Desktop header', 'enovathemes-addons' ),
				'id'               => $prefix . 'desktop_header',
				'type'             => 'select',
				'classes'          => 'select-230',
				'options'          => $headers_array,
				'default' => 'inherit',
			) );

		/*  Footers
		/*-------------------*/

			$footers_array = array(
				'none'    => esc_html__( 'None', 'enovathemes-addons' ),
				'default' => esc_html__( 'Default', 'enovathemes-addons' ),
				'inherit' => esc_html__( 'Inherit', 'enovathemes-addons' ),
			);

			$et_footer = new WP_Query(array(
	            'post_type'           => 'footer',
	            'post_status'         => 'publish',
	            'ignore_sticky_posts' => 0,
	            'orderby'             => 'title',
	            'order'               => 'ASK',
	            'posts_per_page'      => -1,
	        ));

	        if($et_footer->have_posts()){
	        	while($et_footer->have_posts()) : $et_footer->the_post();

	        		$footer_id    = get_the_ID();
	        		$footer_title = get_the_title($footer_id);

	        		$footers_array[$footer_id] = $footer_title;

	        	endwhile;
	        	wp_reset_postdata();
	        }

	        $cmb_page_layout->add_field( array(
				'name'             => esc_html__( 'Footer', 'enovathemes-addons' ),
				'id'               => $prefix . 'footer',
				'type'             => 'select',
				'classes'          => 'select-230',
				'options'          => $footers_array,
				'default' => 'inherit',
			) );

		/*  Title section
		/*-------------------*/

			$title_sections_array = array(
				'none'    => esc_html__( 'None', 'enovathemes-addons' ),
				'default' => esc_html__( 'Default', 'enovathemes-addons' ),
				'inherit' => esc_html__( 'Inherit', 'enovathemes-addons' ),
			);

			$et_title_section = new WP_Query(array(
	            'post_type'           => 'title_section',
	            'post_status'         => 'publish',
	            'ignore_sticky_posts' => 0,
	            'orderby'             => 'title',
	            'order'               => 'ASK',
	            'posts_per_page'      => -1,
	        ));

	        if($et_title_section->have_posts()){
	        	while($et_title_section->have_posts()) : $et_title_section->the_post();

	        		$title_section_id    = get_the_ID();
	        		$title_section_title = get_the_title($title_section_id);

	        		$title_sections_array[$title_section_id] = $title_section_title;

	        	endwhile;
	        	wp_reset_postdata();
	        }

	        $cmb_page_layout->add_field( array(
				'name'             => esc_html__( 'Title section', 'enovathemes-addons' ),
				'id'               => $prefix . 'title_section',
				'type'             => 'select',
				'classes'          => 'select-230',
				'options'          => $title_sections_array,
				'default'          => 'inherit',
				'description'      => esc_html__( 'If you want to display slider instead of title section, set the title section to "None" and choose slider below. Note that slider has higher priority, i.e. if slider is active the title section is inactive.', 'enovathemes-addons' ),
			) );

		/*  Slider
		/*-------------------*/

			$slider_array = array(
				'none'    => esc_html__( 'None', 'enovathemes-addons' ),
			);

			if(shortcode_exists("rev_slider")){
	            $slider = new RevSlider();
	            $revolution_sliders = $slider->getArrSliders();
	            if ($revolution_sliders) {
	                foreach ( $revolution_sliders as $revolution_slider ) {
	                   $alias = $revolution_slider->getAlias();
	                   $title = $revolution_slider->getTitle();
	                   $slider_array[$alias] = $title;
	                }
	            }
	        }

	        $cmb_page_layout->add_field( array(
				'name'             => esc_html__( 'Slider', 'enovathemes-addons' ),
				'id'               => $prefix . 'slider',
				'type'             => 'select',
				'classes'          => 'select-230',
				'options'          => $slider_array,
				'default'          => 'none',
				'description'      => esc_html__( 'Make sure the Revolution slider plugin is installed and active and at least one slider is created.', 'enovathemes-addons' ),
			) );

	    $cmb_page_layout->add_field( array(
			'name'             => esc_html__( 'One page', 'enovathemes-addons' ),
			'id'               => $prefix . 'one_page',
			'type'             => 'checkbox',
		) );

		/*  One page
		/*-------------------*/

			$cmb_page_layout->add_field( array(
			    'name' => esc_html__( 'Background options', 'enovathemes-addons' ),
			    'desc' => esc_html__( 'Add custom background color, image or video', 'enovathemes-addons' ),
			    'type' => 'title',
			    'id'   => 'back_options_title'
			) );

			$cmb_page_layout->add_field( array(
			    'name'    => esc_html__( 'Background color', 'enovathemes-addons' ),
			    'id'      => $prefix . 'page_back_color',
			    'type'    => 'colorpicker',
			    'options' => array(
			        'alpha' => false, // Make this a rgba color picker.
			    ),
			) );

			$cmb_page_layout->add_field( array(
				'name'    => esc_html__( 'Background image', 'enovathemes-addons' ),
				'id'      => $prefix . 'page_back_image',
				'type'    => 'file',
				'query_args' => array(
					'image/gif',
            		'image/jpeg',
            		'image/png'
				),
				'options' => array(
			        'url' => false
			    ),
			) );

			$cmb_page_layout->add_field( array(
				'name'    => esc_html__( 'MP4 video background', 'enovathemes-addons' ),
				'desc'    => esc_html__( 'Upload an MP4 video file or enter an URL.', 'enovathemes-addons' ),
				'id'      => $prefix . 'page_back_video',
				'type'    => 'file',
				'query_args' => array(
					'type' => 'video/mp4',
				)
			) );

	/*  Posts
	/*-------------------*/

		$cmb_post_layout = new_cmb2_box( array(
			'id'            => $prefix.'post_options_metabox',
			'title'         => esc_html__( 'Post options', 'enovathemes-addons' ),
			'object_types'  => array( 'post', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
		) );

		$cmb_post_layout->add_field( array(
			'name' => esc_html__( 'Element css', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_css',
		));

		$cmb_post_layout->add_field( array(
			'name' => esc_html__( 'Element font', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_font',
		));

		$cmb_post_layout->add_field( array(
			'name'             => esc_html__( 'Disable featured image on single post page?', 'enovathemes-addons' ),
			'description'      => esc_html__( 'If active, your image will not be visible in single post page', 'enovathemes-addons' ),
			'id'               => $prefix . 'disable_image',
			'type'             => 'checkbox',
		) );

		$cmb_post_layout->add_field( array(
			'name'             => esc_html__( 'Link url', 'enovathemes-addons' ),
			'id'               => $prefix . 'link',
			'classes'          => 'post-data link-format',
			'type'             => 'text_url',
		) );

		$cmb_post_layout->add_field( array(
			'name'             => esc_html__( 'Status author', 'enovathemes-addons' ),
			'id'               => $prefix . 'status',
			'classes'          => 'post-data status-format',
			'type'             => 'text_medium',
		) );

		$cmb_post_layout->add_field( array(
			'name'             => esc_html__( 'Quote author', 'enovathemes-addons' ),
			'id'               => $prefix . 'quote',
			'classes'          => 'post-data quote-format',
			'type'             => 'text_medium',
		) );

		$cmb_post_layout->add_field( array(
			'name'    => esc_html__( 'Format gallery', 'enovathemes-addons' ),
			'id'      => $prefix . 'gallery',
			'type'    => 'file_list',
			'classes' => 'gallery-format post-data',
			'preview_size' => array( 100, 100 ),
			'query_args' => array( 'type' => 'image' ),
		) );

		$cmb_post_layout->add_field( array(
			'name'    => esc_html__( 'MP3 audio file', 'enovathemes-addons' ),
			'desc'    => esc_html__( 'Upload an MP3 audio file or enter an URL.', 'enovathemes-addons' ),
			'id'      => $prefix . 'audio',
			'classes' => 'audio-format post-data',
			'type'    => 'file',
			'query_args' => array(
				'type' => 'audio/mp3',
			)
		) );

		$cmb_post_layout->add_field( array(
			'name'    => esc_html__( 'Audio embed', 'enovathemes-addons' ),
			'id'   => $prefix . 'audio_embed',
			'classes' => 'audio-format post-data',
			'type' => 'oembed',
		) );

		$cmb_post_layout->add_field( array(
			'name'    => esc_html__( 'MP4 video file', 'enovathemes-addons' ),
			'desc'    => esc_html__( 'Upload an MP4 video file or enter an URL.', 'enovathemes-addons' ),
			'id'      => $prefix . 'video',
			'classes' => 'video-format post-data',
			'type'    => 'file',
			'query_args' => array(
				'type' => 'video/mp4',
			)
		) );

		$cmb_post_layout->add_field( array(
			'name'    => esc_html__( 'Video embed', 'enovathemes-addons' ),
			'id'      => $prefix . 'video_embed',
			'classes' => 'video-format post-data',
			'type'    => 'oembed',
		) );

	/*  Projects
	/*-------------------*/

		$cmb_project_layout = new_cmb2_box( array(
			'id'            => '_'.$prefix.'project_options_metabox',
			'title'         => esc_html__( 'Project options', 'enovathemes-addons' ),
			'object_types'  => array( 'project', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
		) );

		$cmb_project_layout->add_field( array(
			'name' => esc_html__( 'Element css', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_css',
		));

		$cmb_project_layout->add_field( array(
			'name' => esc_html__( 'Element font', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_font',
		));

		$cmb_project_layout->add_field( array(
			'name'             => esc_html__( 'Project layout', 'enovathemes-addons' ),
			'id'               => $prefix . 'project_layout',
			'type'             => 'radio_inline',
			'options'          => array(
				'sidebar'      => esc_html__( 'Sidebar', 'enovathemes-addons' ),
				'wide'         => esc_html__( 'Wide', 'enovathemes-addons' ),
				'custom'       => esc_html__( 'Custom', 'enovathemes-addons' ),
			),
			'default' => 'sidebar',
		) );

		$cmb_project_layout->add_field( array(
			'name'             => esc_html__( 'Project format', 'enovathemes-addons' ),
			'id'               => $prefix . 'project_format',
			'type'             => 'radio_inline',
			'classes'          => 'project-data',
			'options'          => array(
				'gallery'      => esc_html__( 'Gallery', 'enovathemes-addons' ),
				'video'        => esc_html__( 'Video', 'enovathemes-addons' ),
				'audio'        => esc_html__( 'Audio', 'enovathemes-addons' ),
			),
			'default' => 'gallery',
		) );

		$cmb_project_layout->add_field( array(
			'name'             => esc_html__( 'Gallery type', 'enovathemes-addons' ),
			'id'               => $prefix . 'gallery_type',
			'type'             => 'select',
			'classes'          => 'select-230 gallery-format project-data format-data',
			'options'          => array(
				'grid'            => esc_html__( 'Grid', 'enovathemes-addons' ),
				'carousel'        => esc_html__( 'Carousel', 'enovathemes-addons' ),
				'carousel_thumb'  => esc_html__( 'Slider', 'enovathemes-addons' ),
			),
			'default' => 'grid',
		) );

		$cmb_project_layout->add_field( array(
			'name'             => esc_html__( 'Gallery columns', 'enovathemes-addons' ),
			'id'               => $prefix . 'gallery_columns',
			'type'             => 'select',
			'classes'          => 'select-230 gallery-format project-data format-data carousel-thumbnail-off',
			'options'          => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			'default' => '1',
		) );

		$cmb_project_layout->add_field( array(
			'name'    => esc_html__( 'Gallery', 'enovathemes-addons' ),
			'id'      => $prefix . 'gallery',
			'type'    => 'file_list',
			'classes' => 'gallery-format project-data format-data',
			'preview_size' => array( 100, 100 ),
			'query_args' => array( 'type' => 'image' ),
		) );

		$cmb_project_layout->add_field( array(
			'name'    => esc_html__( 'MP3 audio file', 'enovathemes-addons' ),
			'desc'    => esc_html__( 'Upload an MP3 audio file or enter an URL.', 'enovathemes-addons' ),
			'id'      => $prefix . 'audio',
			'classes' => 'audio-format project-data format-data',
			'type'    => 'file',
			'query_args' => array(
				'type' => 'audio/mp3',
			)
		) );

		$cmb_project_layout->add_field( array(
			'name'    => esc_html__( 'Audio embed', 'enovathemes-addons' ),
			'id'   => $prefix . 'audio_embed',
			'classes' => 'audio-format project-data format-data',
			'type' => 'oembed',
		) );

		$cmb_project_layout->add_field( array(
			'name'    => esc_html__( 'MP4 video file', 'enovathemes-addons' ),
			'desc'    => esc_html__( 'Upload an MP4 video file or enter an URL.', 'enovathemes-addons' ),
			'id'      => $prefix . 'video',
			'classes' => 'video-format project-data format-data',
			'type'    => 'file',
			'query_args' => array(
				'type' => 'video/mp4',
			)
		) );

		$cmb_project_layout->add_field( array(
			'name'    => esc_html__( 'Video embed', 'enovathemes-addons' ),
			'id'      => $prefix . 'video_embed',
			'classes' => 'video-format project-data format-data',
			'type'    => 'oembed',
		) );

	/*  Products
	/*-------------------*/

		$cmb_products_layout = new_cmb2_box( array(
			'id'            => $prefix.'products_options_metabox',
			'title'         => esc_html__( 'Products options', 'enovathemes-addons' ),
			'object_types'  => array( 'product', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true
		) );

		$cmb_products_layout->add_field( array(
			'name' => esc_html__( 'Element css', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_css',
		));

		$cmb_products_layout->add_field( array(
			'name' => esc_html__( 'Element css responsive', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_css_resp',
		));

		$cmb_products_layout->add_field( array(
			'name' => esc_html__( 'Element font', 'enovathemes-addons' ),
			'type' => 'hidden',
			'id'   => 'element_font',
		));
}
