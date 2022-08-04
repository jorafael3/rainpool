<?php

/* vc defaults
----*/

	vc_remove_param('vc_section', 'full_width');
	vc_remove_param('vc_row', 'full_width');
	vc_remove_param('vc_row_inner', 'gap');
	vc_remove_param('vc_row', 'gap');
	vc_remove_param('vc_row', 'parallax');
	vc_remove_param('vc_row', 'parallax_image');
	vc_remove_param('vc_row', 'video_bg');
	vc_remove_param('vc_row', 'video_bg_url');
	vc_remove_param('vc_row', 'video_bg_parallax');
	vc_remove_param('vc_row', 'parallax_speed_bg');
	vc_remove_param('vc_row', 'parallax_speed_video');

/* vc_row
----*/

	/* defaults
	----*/

		vc_add_param('vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Row stretch', 'textron' ),
			'param_name' => 'full_width',
			'value'      => array(
				esc_html__( 'No stretching', 'textron' )           => 'stretch_no',
				esc_html__( 'Stretch row and content', 'textron' ) => 'stretch_row_content',
			),
			'weight' => 1,
			'description' => esc_html__( '"No stretching" alignes the row with the main theme container, Stretch row and content" makes the row and content full width', 'textron' )
		));

		$column_gap_values = array(
			esc_html__('0px', 'textron')    => '0',
			esc_html__('2px', 'textron')    => '2',
			esc_html__('4px', 'textron')    => '4',
			esc_html__('8px', 'textron')    => '8',
			esc_html__('16px', 'textron')   => '16',
			esc_html__('24px', 'textron')   => '24',
			esc_html__('32px', 'textron')   => '32',
			esc_html__('40px', 'textron')   => '40',
			esc_html__('48px', 'textron')   => '48',
			esc_html__('56px', 'textron')   => '56',
			esc_html__('64px', 'textron')   => '64',
			esc_html__('72px', 'textron')   => '72',
			esc_html__('80px', 'textron')   => '80',
		);

		vc_add_param('vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Columns gap', 'textron' ),
			'param_name' => 'gap',
			'weight'     => 1,
			'value'      => $column_gap_values,
			'std' => '24'
		));

		vc_add_param('vc_row_inner', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Columns gap', 'textron' ),
			'param_name' => 'gap',
			'weight'     => 1,
			'value'      => $column_gap_values,
			'std' => '24'
		));

		vc_add_param('vc_row_inner', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Z index (integer without any string)', 'textron' ),
			'description'=> esc_html__( 'Higher value places the row on top', 'textron' ),
			'param_name' => 'z_index',
		));

		vc_add_param('vc_row_inner', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Height in px (without any string)', 'textron' ),
			'param_name' => 'row_height',
		));

		vc_add_param('vc_row_inner', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Height in px for sticky header version (without any string)', 'textron' ),
			'param_name' => 'row_height_sticky',
		));

		vc_add_param('vc_row_inner', array(
			'type'       => 'checkbox',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Hide on sticky header version?', 'textron' ),
			'param_name' => 'hide_row_sticky',
		));

		vc_add_param('vc_row_inner', array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Element id','textron'),
			'group'      => esc_html__('Header builder','textron'),
			"class"      => "element-attr-hide",
			'param_name' => 'element_id',
			'value'      => '',
		));

		vc_add_param('vc_row_inner', array(
			'type'       => 'textarea',
			'heading'    => esc_html__('Element css','textron'),
			'group'      => esc_html__('Header builder','textron'),
			"class"      => "element-attr-hide",
			'param_name' => 'element_css',
			'value'      => '',
		));

	/* parallax
	----*/

		vc_add_param('vc_row', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Parallax background', 'textron' ),
			'param_name' => 'parallax',
			'group'      => esc_html__('Background options','textron'),
		));

		vc_add_param('vc_row', array(
			'type'       => 'attach_image',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Parallax image', 'textron' ),
			'param_name' => 'parallax_image',
			'dependency' => Array('element' => 'parallax', 'value' => 'true')
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Parallax duration', 'textron' ),
			'param_name' => 'parallax_duration_bg',
			'description'=> esc_html__('Enter parallax duration in ms','textron'),
			'dependency' => Array('element' => 'parallax', 'value' => 'true'),
			'default'    => '0'
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Parallax speed', 'textron' ),
			'param_name' => 'parallax_speed_bg',
			'description'=> esc_html__('Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)','textron'),
			'dependency' => Array('element' => 'parallax', 'value' => 'true'),
			'default'    => '1.5'
		));

	/* video
	----*/

		vc_add_param('vc_row', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Background video', 'textron' ),
			'param_name' => 'video_bg',
			'group'      => esc_html__('Background options','textron'),
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video mp4 file url', 'textron' ),
			'param_name' => 'video_bg_mp4',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video webm file url', 'textron' ),
			'param_name' => 'video_bg_webm',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video ogv file url', 'textron' ),
			'param_name' => 'video_bg_ogv',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_row', array(
			'type'       => 'attach_image',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Video overlay', 'textron' ),
			'param_name' => 'video_bg_overlay',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_row', array(
			'type'       => 'attach_image',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Video placeholder', 'textron' ),
			'param_name' => 'video_bg_placeholder',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_row', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Video parallax', 'textron' ),
			'param_name' => 'video_bg_parallax',
			'group'      => esc_html__('Background options','textron'),
			'dependency' => Array(
				'element' => 'video_bg', 'value' => 'true',

			)
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video parallax speed', 'textron' ),
			'param_name' => 'video_bg_parallax_speed',
			'description'=> esc_html__('Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)','textron'),
			'dependency' => Array(
				'element' => 'video_bg_parallax', 'value' => 'true',
			),
			'default'    => '1.5'
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video parallax duration', 'textron' ),
			'param_name' => 'video_bg_parallax_duration',
			'description'=> esc_html__('Enter parallax duration in ms','textron'),
			'dependency' => Array(
				'element' => 'video_bg_parallax', 'value' => 'true',
			),
			'default'    => '0'
		));



	/* fixed
	----*/

		vc_add_param('vc_row', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Fixed background', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'fixed_bg',
		));

		vc_add_param('vc_row', array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Fixed background image', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'fixed_bg_image',
			'dependency' => Array('element' => 'fixed_bg', 'value' => 'true')
		));

	/* animated
	----*/

		vc_add_param('vc_row', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Animated background', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'animated_bg',
		));

		vc_add_param('vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Animated background direction', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'animated_bg_dir',
			'value'     => array(
				esc_html__('Horizontal','textron')  => 'horizontal',
				esc_html__('Vertical','textron')  => 'vertical',
			),
			'dependency' => Array('element' => 'animated_bg', 'value' => 'true')
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Animated background speed in ms (default is 35000)', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'animated_bg_speed',
			'dependency' => Array('element' => 'animated_bg', 'value' => 'true')
		));

		vc_add_param('vc_row', array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Animated background image', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'animated_bg_image',
			'dependency' => Array('element' => 'animated_bg', 'value' => 'true')
		));

	/* header buiilder tab
	----*/

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Height in px (without any string)', 'textron' ),
			'param_name' => 'row_height',
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Z index (integer without any string)', 'textron' ),
			'description'=> esc_html__( 'Higher value places the row on top', 'textron' ),
			'param_name' => 'z_index',
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Height in px for sticky header version (without any string)', 'textron' ),
			'param_name' => 'row_height_sticky',
		));

		vc_add_param('vc_row', array(
			'type'       => 'colorpicker',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Background color of sticky header version', 'textron' ),
			'param_name' => 'row_background_sticky',
		));

		vc_add_param('vc_row', array(
			'type'       => 'checkbox',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Hide from default header version?', 'textron' ),
			'param_name' => 'hide_row_default',
		));

		vc_add_param('vc_row', array(
			'type'       => 'checkbox',
			'group'      => esc_html__('Header builder','textron'),
			'heading'    => esc_html__( 'Hide on sticky header version?', 'textron' ),
			'param_name' => 'hide_row_sticky',
		));

		vc_add_param('vc_row', array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Element id','textron'),
			'group'      => esc_html__('Header builder','textron'),
			"class"      => "element-attr-hide",
			'param_name' => 'element_id',
			'value'      => '',
		));

		vc_add_param('vc_row', array(
			'type'       => 'textarea',
			'heading'    => esc_html__('Element css','textron'),
			'group'      => esc_html__('Header builder','textron'),
			"class"      => "element-attr-hide",
			'param_name' => 'element_css',
			'value'      => '',
		));

	/* textron
	----*/

		vc_add_param('vc_row', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Top gradient border', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'top_gradient',
		));

		vc_add_param('vc_row', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Bottom gradient border', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'bottom_gradient',
		));

		vc_add_param('vc_row', array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Gradient border color', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'gradient_color',
			'default'    => '#ffffff'
		));

		vc_add_param('vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Grid overlay', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'grid_overlay',
			'value'     => array(
				esc_html__('None','textron')  => 'none',
				esc_html__('White','textron')  => 'white',
				esc_html__('Black','textron')  => 'black',
			),
		));

		vc_add_param('vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Curtain', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'curtain',
			'value'     => array(
				esc_html__('None', 'textron')   => 'none',
				esc_html__('Curtain from left', 'textron')   => 'curtain-left',
				esc_html__('Curtain from right', 'textron')  => 'curtain-right',
				esc_html__('Curtain from top', 'textron')    => 'curtain-top',
				esc_html__('Curtain from bottom', 'textron') => 'curtain-bottom',
			),
		));

		vc_add_param('vc_row', array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Curtain color', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'curtain_color',
			'dependency' => Array('element' => 'curtain', 'value' => array('curtain-left','curtain-right','curtain-top','curtain-bottom'))
		));

/* vc_column
----*/

	vc_remove_param('vc_column', 'parallax');
	vc_remove_param('vc_column', 'parallax_image');
	vc_remove_param('vc_column', 'video_bg');
	vc_remove_param('vc_column', 'video_bg_url');
	vc_remove_param('vc_column', 'video_bg_parallax');
	vc_remove_param('vc_column', 'parallax_speed_bg');
	vc_remove_param('vc_column', 'parallax_speed_video');

	$animation_delay_values = array();

	for ($i=0; $i <= 2000; $i = $i + 50) {
		$animation_delay_values[$i.esc_html__('ms', 'textron')] = $i;
	}

	vc_add_param('vc_column', array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Animation delay in ms (example 300)', 'textron' ),
		'param_name' => 'animation_delay',
		'weight'     => 1,
		'value'      => $animation_delay_values
	));

	vc_add_param('vc_column', array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Text align', 'textron' ),
		'param_name' => 'text_align',
		'value'      => array(
			esc_html__('None','textron')   => 'none',
			esc_html__('Left','textron')   => 'left',
			esc_html__('Right','textron')  => 'right',
			esc_html__('Center','textron') => 'center'
		)
	));

	vc_add_param('vc_column', array(
		'type'       => 'checkbox',
		'heading'    => esc_html__( 'Shadow', 'textron' ),
		'group'      => esc_html__( 'Design Options', 'textron' ),
		'param_name' => 'shadow',
		'weight'     => 1,
		'value'      => ''
	));

	vc_add_param('vc_column', array(
		'type'       => 'crp',
		'heading'    => esc_html__( 'Responsive padding', 'textron' ),
		'group'      => esc_html__('Responsive Options','textron'),
		'param_name' => 'crp',
	));

	vc_add_param('vc_column', array(
		'type'       => 'textfield',
		'heading'    => esc_html__('Element id','textron'),
		"class"      => "element-attr-hide",
		'param_name' => 'element_id',
		'value'      => '',
	));

	vc_add_param('vc_column', array(
		'type'       => 'textarea',
		'heading'    => esc_html__('Element css','textron'),
		"class"      => "element-attr-hide",
		'param_name' => 'element_css',
		'value'      => '',
	));

	/* parallax
	----*/

		vc_add_param('vc_column', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Parallax background', 'textron' ),
			'param_name' => 'parallax',
			'group'      => esc_html__('Background options','textron'),
		));

		vc_add_param('vc_column', array(
			'type'       => 'attach_image',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Parallax image', 'textron' ),
			'param_name' => 'parallax_image',
			'dependency' => Array('element' => 'parallax', 'value' => 'true')
		));

		vc_add_param('vc_column', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Parallax speed', 'textron' ),
			'param_name' => 'parallax_speed_bg',
			'description'=> esc_html__('Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)','textron'),
			'dependency' => Array('element' => 'parallax', 'value' => 'true'),
			'default'    => '1.5'
		));

		vc_add_param('vc_column', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Parallax duration', 'textron' ),
			'param_name' => 'parallax_duration_bg',
			'description'=> esc_html__('Enter parallax duration in ms','textron'),
			'dependency' => Array('element' => 'parallax', 'value' => 'true'),
			'default'    => '0'
		));

	/* video
	----*/

		vc_add_param('vc_column', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Background video', 'textron' ),
			'param_name' => 'video_bg',
			'group'      => esc_html__('Background options','textron'),
		));

		vc_add_param('vc_column', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video mp4 file url', 'textron' ),
			'param_name' => 'video_bg_mp4',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_column', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video webm file url', 'textron' ),
			'param_name' => 'video_bg_webm',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_column', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video ogv file url', 'textron' ),
			'param_name' => 'video_bg_ogv',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_column', array(
			'type'       => 'attach_image',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Video overlay', 'textron' ),
			'param_name' => 'video_bg_overlay',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_column', array(
			'type'       => 'attach_image',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Video placeholder', 'textron' ),
			'param_name' => 'video_bg_placeholder',
			'dependency' => Array('element' => 'video_bg', 'value' => 'true')
		));

		vc_add_param('vc_column', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Video parallax', 'textron' ),
			'param_name' => 'video_bg_parallax',
			'group'      => esc_html__('Background options','textron'),
			'dependency' => Array(
				'element' => 'video_bg', 'value' => 'true',

			)
		));

		vc_add_param('vc_column', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video parallax speed', 'textron' ),
			'param_name' => 'video_bg_parallax_speed',
			'description'=> esc_html__('Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)','textron'),
			'dependency' => Array(
				'element' => 'video_bg_parallax', 'value' => 'true',
			),
			'default'    => '1.5'
		));

		vc_add_param('vc_column', array(
			'type'       => 'textfield',
			'group'      => esc_html__('Background options','textron'),
			'heading'    => esc_html__( 'Background video parallax duration', 'textron' ),
			'param_name' => 'video_bg_parallax_duration',
			'description'=> esc_html__('Enter parallax duration in ms','textron'),
			'dependency' => Array(
				'element' => 'video_bg_parallax', 'value' => 'true',
			),
			'default'    => '1.5'
		));

	/* fixed
	----*/

		vc_add_param('vc_column', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Fixed background', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'fixed_bg',
		));

		vc_add_param('vc_column', array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Fixed background image', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'fixed_bg_image',
			'dependency' => Array('element' => 'fixed_bg', 'value' => 'true')
		));

	/* animated
	----*/

		vc_add_param('vc_column', array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Animated background', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'animated_bg',
		));

		vc_add_param('vc_column', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Animated background direction', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'animated_bg_dir',
			'value'     => array(
				esc_html__('Horizontal','textron')  => 'horizontal',
				esc_html__('Vertical','textron')  => 'vertical',
			),
			'dependency' => Array('element' => 'animated_bg', 'value' => 'true')
		));

		vc_add_param('vc_column', array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Animated background speed in ms (default is 35000)', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'animated_bg_speed',
			'dependency' => Array('element' => 'animated_bg', 'value' => 'true')
		));

		vc_add_param('vc_column', array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Animated background image', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'animated_bg_image',
			'dependency' => Array('element' => 'animated_bg', 'value' => 'true')
		));

		vc_add_param('vc_column', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Curtain', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'curtain',
			'value'     => array(
				esc_html__('None', 'textron')   => 'none',
				esc_html__('Curtain from left', 'textron')   => 'curtain-left',
				esc_html__('Curtain from right', 'textron')  => 'curtain-right',
				esc_html__('Curtain from top', 'textron')    => 'curtain-top',
				esc_html__('Curtain from bottom', 'textron') => 'curtain-bottom',
			),
		));

		vc_add_param('vc_column', array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Curtain color', 'textron' ),
			'group'      => esc_html__('Background options','textron'),
			'param_name' => 'curtain_color',
			'dependency' => Array('element' => 'curtain', 'value' => array('curtain-left','curtain-right','curtain-top','curtain-bottom'))
		));

/* vc_column_text
----*/

	vc_add_param('vc_column_text', array(
		'type'       => 'textfield',
		'heading'    => esc_html__('Element id','textron'),
		"class"      => "element-attr-hide",
		'param_name' => 'element_id',
		'value'      => '',
	));

	vc_add_param('vc_column_text', array(
		'type'       => 'textarea',
		'heading'    => esc_html__('Element css','textron'),
		"class"      => "element-attr-hide",
		'param_name' => 'element_css',
		'value'      => '',
	));

	vc_add_param('vc_column_text', array(
		'type'       => 'dropdown',
		'heading'    => esc_html__( 'Animation delay in ms (example 300)', 'textron' ),
		'param_name' => 'animation_delay',
		'weight'     => 1,
		'value'      => $animation_delay_values
	));

	function textron_enovathemes_remove_woocommerce() {
	    if (class_exists('Woocommerce')) {
	        vc_remove_element( 'recent_products' );
			vc_remove_element( 'featured_products' );
			vc_remove_element( 'product' );
			vc_remove_element( 'products' );
			vc_remove_element( 'product_category' );
			vc_remove_element( 'product_categories' );
			vc_remove_element( 'sale_products' );
			vc_remove_element( 'best_selling_products' );
			vc_remove_element( 'top_rated_products' );
			vc_remove_element( 'related_products' );
			vc_remove_element( 'product_attribute' );
	    }
	}
	add_action( 'vc_build_admin_page', 'textron_enovathemes_remove_woocommerce', 11 );
	add_action( 'vc_load_shortcode', 'textron_enovathemes_remove_woocommerce', 11 );

if (defined( 'ENOVATHEMES_ADDONS' )) {
	add_action( 'init', 'textron_enovathemes_integrateVC');
    function textron_enovathemes_integrateVC() {

    	global $textron_enovathemes;

		$main_color 	 = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';
		$secondory_color = (isset($GLOBALS['textron_enovathemes']['secondory-color']) && $GLOBALS['textron_enovathemes']['secondory-color']) ? $GLOBALS['textron_enovathemes']['secondory-color'] : '#00245a';
		$area_color      = (isset($GLOBALS['textron_enovathemes']['area-color']) && $GLOBALS['textron_enovathemes']['area-color']) ? $GLOBALS['textron_enovathemes']['area-color'] : '#edf1f8';

    	$google_fonts_family = array('Theme default');

		$google_fonts = enovathemes_addons_google_fonts();

		if (!is_wp_error( $google_fonts ) ) {

			foreach ( $google_fonts as $font ) {
				array_push($google_fonts_family, $font['family']);
			}

		}

    	$animation_delay_values = array();

		for ($i=0; $i <= 2000; $i = $i + 50) {
			$animation_delay_values[$i.esc_html__('ms', 'textron')] = $i;
		}

		$typography_values = array('Inherit'=>'i');
		for ($i=10; $i <= 80; $i++) {
	        $typography_values[$i.esc_html__('px', 'textron')] = $i;
	    }

    	$order_by_values = array(
			esc_html__( 'Date', 'textron' ) => 'date',
			esc_html__( 'ID', 'textron' ) => 'ID',
			esc_html__( 'Author', 'textron' ) => 'author',
			esc_html__( 'Title', 'textron' ) => 'title',
			esc_html__( 'Modified', 'textron' ) => 'modified',
			esc_html__( 'Random', 'textron' ) => 'rand',
			esc_html__( 'Comment count', 'textron' ) => 'comment_count',
			esc_html__( 'Menu order', 'textron' ) => 'menu_order',
		);

		$order_way_values = array(
			esc_html__( 'Ascending', 'textron' ) => 'ASC',
			esc_html__( 'Descending', 'textron' ) => 'DESC',
		);

		$operator_values = array(
			esc_html__( 'IN', 'textron' ) => 'IN',
			esc_html__( 'NOT IN', 'textron' ) => 'NOT IN',
			esc_html__( 'AND', 'textron' ) => 'AND',
		);

		$animation_values = array(
			esc_html__('None', 'textron')     => 'none',
			esc_html__('Fade In', 'textron')  => 'fadeIn',
			esc_html__('Move Up', 'textron')  => 'moveUp',
		);

		$size_values_box = array(
			esc_html__('Small', 'textron')        => 'small',
			esc_html__('Medium', 'textron')       => 'medium',
			esc_html__('Large', 'textron')        => 'large'
		);

		$size_values_default = array(
			esc_html__('Small', 'textron')        => 'small',
			esc_html__('Medium', 'textron')       => 'medium',
			esc_html__('Large', 'textron')        => 'large'
		);

		$size_values_extra = array(
			esc_html__('Extra small', 'textron')  => 'extra-small',
			esc_html__('Small', 'textron')        => 'small',
			esc_html__('Medium', 'textron')       => 'medium',
			esc_html__('Large', 'textron')        => 'large',
			esc_html__('Extra large', 'textron')  => 'large-x',
			esc_html__('Extra Extra large', 'textron')  => 'large-xx'
		);

		$font_weight_values = array(
			'100'  => '100',
			'200'  => '200',
			'300'  => '300',
			'400'  => '400',
			'500'  => '500',
			'600'  => '600',
			'700'  => '700',
			'800'  => '800',
			'900'  => '900',
		);

		$font_size_values = array(esc_html__('Inherit', 'textron') => 'inherit');
		for ($i=0; $i <= 72; $i++) {
			$font_size_values[$i.esc_html__('px', 'textron')] = $i.'px';
		}

		$line_height_values = array(esc_html__('Inherit', 'textron') => 'inherit');
		for ($i=0; $i <= 80; $i++) {
			$line_height_values[$i.esc_html__('px', 'textron')] = $i.'px';
		}

		$align_values = array(
			esc_html__('Left','textron')   => 'left',
			esc_html__('Right','textron')  => 'right',
			esc_html__('Center','textron') => 'center'
		);

		$align_values_extended = array(
			esc_html__('None','textron')   => 'none',
			esc_html__('Left','textron')   => 'left',
			esc_html__('Right','textron')  => 'right',
			esc_html__('Center','textron') => 'center'
		);

		$logic_values = array(
			esc_html__('False','textron')   => 'false',
			esc_html__('True','textron')  => 'true',
		);

		$animation_type_values = array(
			esc_html__('Sequential','textron')  => 'sequential',
			esc_html__('Random','textron')      => 'random'
		);

		$image_size_values = array(
			'full'      => 'full',
			'large'     => 'large',
			'medium'    => 'medium',
			'thumbnail' => 'thumbnail',
		);

		$image_overlay_values = array(
			esc_html__('Overlay fade','textron') 						 => 'overlay-fade',
			esc_html__('Overlay fade with image zoom','textron')         => 'overlay-fade-zoom',
			esc_html__('Overlay fade with extreme image zoom','textron') => 'overlay-fade-zoom-extreme',
			esc_html__('Overlay move fluid','textron')                   => 'overlay-move',
			esc_html__('Transform','textron')                            => 'transform'
		);

		$image_caption_values = array(
			esc_html__('Caption up','textron') 					  => 'caption-up',
			esc_html__("Caption up and image up", 'textron') => "caption-up-image"
		);

		$layout_type_values = array(
			esc_html__('Grid', 'textron')     => 'grid',
			esc_html__('Carousel', 'textron') => 'carousel',
		);

		$gap_values = array();

		for ($i=0; $i <= 80; $i = $i + 2) {
			$gap_values[$i.esc_html__('px', 'textron')] = $i;
		}

		$social_links_array = enovathemes_addons_social_icons(get_template_directory().'/images/icons/social/');

		$menus = textron_enovathemes_get_all_menus();

		$menu_list = array("choose" => esc_html__('Choose','textron'));

		foreach ($menus as $menu => $attr) {
			$menu_list[$attr->slug] = $attr->name;
		}

		$menu_list = array_flip($menu_list);

		/* ELEMENTS
		----*/

			/* TYPOGRAPHY
			----*/

				/* et_heading
				----*/

			    	vc_map(array(
			    		'name'                    => esc_html__('Heading','textron'),
			    		'description'             => esc_html__('Add/animate heading','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_heading',
			    		'class'                   => 'et_heading font',
			    		'icon'                    => 'et_heading',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-heading.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-heading.js',
			    		'params'                  => array(
			    			array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'content',
								'description'=> esc_html__('If you want to highlight/style a separate word, wrap it inside the span like this <span style="color: #XXXXXX">word</span>. If you need to break the sentence use the "_br_" special word','textron'),
							),
							array(
								'param_name'=>'text_align',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Text align', 'textron'),
								'value'     => $align_values
							),
							array(
								'param_name'=>'highlight',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Highlight', 'textron'),
								'value'     => $logic_values
							),
							array(
								'param_name'=>'type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Tag', 'textron'),
								'value'     => array(
									'H1'  => 'h1',
									'H2'  => 'h2',
									'H3'  => 'h3',
									'H4'  => 'h4',
									'H5'  => 'h5',
									'H6'  => 'h6',
									'p'   => 'p',
									'div' => 'div',
								),
								'std' => 'h1'
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Link','textron'),
								'param_name' => 'link',
								'value'      => '',
							),
							array(
								'param_name'=>'target',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Target', 'textron'),
								'value'     => array(
									'_self'  => '_self',
									'_blank' => '_blank'
								)
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Text color','textron'),
								'param_name' => 'text_color',
								'value'      => $secondory_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Background color','textron'),
								'param_name' => 'background_color',
								'value'      => '',
							),
							array(
								'param_name'=>'font_family',
								'type'      => 'dropdown',
								'group'     => esc_html__('Typography', 'textron'),
								'heading'   => esc_html__('Font family', 'textron'),
								'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
								'value'     => $google_fonts_family,
							),
							array(
								'param_name'=>'font_weight',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Font weight', 'textron'),
								'group'     => esc_html__('Typography', 'textron'),
								'value'     => $font_weight_values,
							),
							array(
								'param_name'=>'font_subsets',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Font subsets', 'textron'),
								'group'     => esc_html__('Typography', 'textron'),
								'value'     => array(
									'latin' => 'latin',
								)
							),
							array(
								'type'       => 'textfield',
								'group'      => esc_html__('Typography', 'textron'),
								'heading'    => esc_html__('Font size (without any string)','textron'),
								'param_name' => 'font_size',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'group'   	 => esc_html__('Typography', 'textron'),
								'heading'    => esc_html__('Letter spacing (without any string)','textron'),
								'param_name' => 'letter_spacing',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'group'   	 => esc_html__('Typography', 'textron'),
								'heading'    => esc_html__('Line height (without any string)','textron'),
								'param_name' => 'line_height',
								'value'      => ''
							),
							array(
								'type'       => 'dropdown',
								'group'   	 => esc_html__('Typography', 'textron'),
								'heading'    => esc_html__('Text transform','textron'),
								'param_name' => 'text_transform',
								'value'      => array(
									esc_html__('None','textron')       => 'none',
									esc_html__('Uppercase','textron')  => 'uppercase',
									esc_html__('Lowercase','textron')  => 'lowercase',
									esc_html__('Capitalize','textron') => 'capitalize',
								)
							),

							/* tablet
							----*/

								array(
									'param_name'=>'tablet_text_align',
									'type'      => 'dropdown',
									'group'      => esc_html__('Tablet','textron'),
									'heading'   => esc_html__('Text align', 'textron'),
									'value'      => array(
										esc_html__('Inherit','textron') => 'inherit',
										esc_html__('Left','textron')    => 'left',
										esc_html__('Right','textron')   => 'right',
										esc_html__('Center','textron')  => 'center',
									)
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Font size (min-width 1024px and max-width 1279px)','textron'),
									'group'      => esc_html__('Tablet','textron'),
									'param_name' => 'tlf',
									'value'      => $typography_values,
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Line height (min-width 1024px and max-width 1279px)','textron'),
									'group'      => esc_html__('Tablet','textron'),
									'param_name' => 'tll',
									'value'      => $typography_values,
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Font size (min-width 768px and max-width 1023px)','textron'),
									'group'      => esc_html__('Tablet','textron'),
									'param_name' => 'tpf',
									'value'      => $typography_values,
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Line height (min-width 768px and max-width 1023px)','textron'),
									'group'      => esc_html__('Tablet','textron'),
									'param_name' => 'tpl',
									'value'      => $typography_values,
								),

							/* mobile
							----*/

								array(
									'param_name'=>'mobile_text_align',
									'type'      => 'dropdown',
									'group'      => esc_html__('Mobile','textron'),
									'heading'   => esc_html__('Text align', 'textron'),
									'value'      => array(
										esc_html__('Inherit','textron') => 'inherit',
										esc_html__('Left','textron')    => 'left',
										esc_html__('Right','textron')   => 'right',
										esc_html__('Center','textron')  => 'center',
									)
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Font size (min-width 375px and max-width 767px)','textron'),
									'group'      => esc_html__('Mobile','textron'),
									'param_name' => 'mf',
									'value'      => $typography_values,
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Line height (min-width 375px and max-width 767px)','textron'),
									'group'      => esc_html__('Mobile','textron'),
									'param_name' => 'ml',
									'value'      => $typography_values,
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Font size (max-width 374px)','textron'),
									'group'      => esc_html__('Mobile','textron'),
									'param_name' => 'mfs',
									'value'      => $typography_values,
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Line height (max-width 374px)','textron'),
									'group'      => esc_html__('Mobile','textron'),
									'param_name' => 'mls',
									'value'      => $typography_values,
								),

							/* animation
							----*/

								array(
									'type'       => 'checkbox',
									'heading'    => esc_html__('Animate','textron'),
									'group'      => 'Animation',
									'param_name' => 'animate',
									'dependency' => Array('element' => 'highlight', 'value' => 'false')
								),
								array(
									'type'       => 'dropdown',
									'group'      => esc_html__('Animation','textron'),
									'heading'    => esc_html__('Animation type','textron'),
									'param_name' => 'animation_type',
									'value'     => array(
										esc_html__('Curtain', 'textron') => 'curtain',
										esc_html__('Letter', 'textron')  => 'letter',
										esc_html__('Words', 'textron')   => 'words',
										esc_html__('Rows', 'textron')    => 'rows',
									),
									'dependency' => Array('element' => 'animate', 'value' => 'true')
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Curtain Color','textron'),
									'group'      => esc_html__('Animation','textron'),
									'param_name' => 'element_color',
									'value'      => $main_color,
									'dependency' => Array(
										'element' => 'animate', 'value' => 'true',
										'element' => 'animation_type', 'value' => array('curtain')
									)
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Animation','textron'),
									'heading'    => esc_html__('Start delay in ms (enter only integer number)','textron'),
									'param_name' => 'delay',
									'value'      => '0',
									'dependency' => Array('element' => 'animate', 'value' => 'true')
								),
				
							/* margin
							----*/

								array(
									'type'       => 'margin',
									'group'      => esc_html__('Margin','textron'),
									'heading'    => esc_html__('Margin','textron'),
									'param_name' => 'margin',
									'value'      => ''
								),

							/* padding
							----*/

								array(
									'type'       => 'padding',
									'group'      => esc_html__('Padding','textron'),
									'heading'    => esc_html__('Padding','textron'),
									'param_name' => 'padding',
									'value'      => ''
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element font','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_font',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

				/* et_blockquote
				----*/

			    	vc_map(array(
			    		'name'                    => esc_html__('Blockquote','textron'),
			    		'description'             => esc_html__('Add blockquote','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_blockquote',
			    		'class'                   => 'et_blockquote',
			    		'icon'                    => 'et_blockquote',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-blockquote.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-blockquote.js',
			    		'params'                  => array(
			    			array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Upload image','textron'),
								'param_name' => 'image',
							),
			    			array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Content','textron'),
								'param_name' => 'text',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Author','textron'),
								'param_name' => 'author',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),

							/* margin
							----*/

								array(
									'type'       => 'margin',
									'group'      => esc_html__('Margin','textron'),
									'heading'    => esc_html__('Margin','textron'),
									'param_name' => 'margin',
									'value'      => ''
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

			/* UI
			----*/

				/* et_menu
				----*/

			    	vc_map(array(
			    		'name'                    => esc_html__('Navigation menu','textron'),
			    		'description'             => esc_html__('Do not use with header builder','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_menu',
			    		'class'                   => 'et_menu hbe font',
			    		'icon'                    => 'et_menu',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-menu.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-menu.js',
			    		'params'                  => array(
			    			array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Menu name','textron'),
								'param_name' => 'menu',
								'value'      => $menu_list,
								'default'    => 'choose'
							),
							array(
								'param_name'=>'align',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Align', 'textron'),
								'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
								'value'     => $align_values_extended
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),

							/* top level
							----*/

								/* styling
								----*/

									array(
										'type'       => 'textfield',
										'heading'    => esc_html__('Space between menu items in px (without any string)','textron'),
										'group'      => 'Top level',
										'param_name' => 'menu_space',
										'value'      => '40',
									),

									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Items separator','textron'),
										'group'      => 'Top level',
										'param_name' => 'menu_separator',
										'value'      => $logic_values
									),
									array(
										'type'       => 'colorpicker',
										'heading'    => esc_html__('Items separator color','textron'),
										'group'      => 'Top level',
										'param_name' => 'menu_separator_color',
										'value'      => '#e0e0e0',
										'dependency' => Array('element' => 'menu_separator', 'value' => 'true')
									),
									array(
										'type'       => 'textfield',
										'heading'    => esc_html__('Items separator height (without any string)','textron'),
										'description'=> esc_html__('Leave blank if you want 100% height','textron'),
										'group'      => 'Top level',
										'param_name' => 'menu_separator_height',
										'value'      => '',
										'dependency' => Array('element' => 'menu_separator', 'value' => 'true')
									),
									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Submenu indicator','textron'),
										'group'      => 'Top level',
										'param_name' => 'submenu_indicator',
										'value'      => $logic_values
									),

									array(
										'type'       => 'colorpicker',
										'heading'    => esc_html__('Menu color','textron'),
										'group'      => 'Top level',
										'param_name' => 'menu_color',
										'value'      => $secondory_color,
									),

									array(
										'type'       => 'colorpicker',
										'heading'    => esc_html__('Menu color hover','textron'),
										'group'      => 'Top level',
										'param_name' => 'menu_color_hover',
										'value'      => $main_color,
									),

									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Menu hover effect','textron'),
										'group'      => 'Top level',
										'param_name' => 'menu_hover',
										'value'      => array(
											esc_html__('None','textron')      => 'none',
											esc_html__('Underline','textron') => 'underline',
											esc_html__('Overline','textron')  => 'overline',
											esc_html__('Outline','textron')   => 'outline',
											esc_html__('Box','textron')       => 'box',
											esc_html__('Fill','textron')      => 'fill',
										),
									),

									array(
										'type'       => 'colorpicker',
										'heading'    => esc_html__('Menu hover effect color','textron'),
										'group'      => 'Top level',
										'param_name' => 'menu_effect_color',
										'value'      => '',
										'dependency' => Array('element' => 'menu_hover', 'value' => array('underline','overline','outline','box','fill'))
									),

								/* typography
								----*/

									array(
										'param_name'=>'font_family',
										'type'      => 'dropdown',
										'group'     => esc_html__('Top level','textron'),
										'heading'   => esc_html__('Font family', 'textron'),
										'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
										'value'     => $google_fonts_family,
									),
									array(
										'param_name'=>'font_weight',
										'type'      => 'dropdown',
										'group'     => esc_html__('Top level','textron'),
										'heading'   => esc_html__('Font weight', 'textron'),
										'value'     => $font_weight_values,
										'std'       => '700'
									),
									array(
										'param_name'=>'font_subsets',
										'type'      => 'dropdown',
										'group'     => esc_html__('Top level','textron'),
										'heading'   => esc_html__('Font subsets', 'textron'),
										'value'      => array(
											'latin' => 'latin',
										)
									),
									array(
										'type'       => 'textfield',
										'heading'    => esc_html__('Font size (without any string)','textron'),
										'group'      => esc_html__('Top level','textron'),
										'param_name' => 'font_size',
										'value'      => '16',
									),
									array(
										'type'       => 'textfield',
										'group'      => esc_html__('Top level','textron'),
										'heading'    => esc_html__('Letter spacing (without any string)','textron'),
										'param_name' => 'letter_spacing',
										'value'      => ''
									),
									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Text transform','textron'),
										'group'      => 'Top level',
										'param_name' => 'text_transform',
										'value'      => array(
											esc_html__('None','textron')       => 'none',
											esc_html__('Uppercase','textron')  => 'uppercase',
											esc_html__('Lowercase','textron')  => 'lowercase',
											esc_html__('Capitalize','textron') => 'capitalize',
										)
									),

							/* submenu
							----*/

								/* styling
								----*/

									array(
										'type'       => 'textfield',
										'heading'    => esc_html__('Offset','textron'),
										'description'=> esc_html__('Leave blank to have 100% offset','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenuoffset',
										'value'      => '',
									),
									array(
										'type'       => 'colorpicker',
										'heading'    => esc_html__('Submenu color','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenu_color',
										'value'      => $secondory_color,
									),

									array(
										'type'       => 'colorpicker',
										'heading'    => esc_html__('Submenu color hover','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenu_color_hover',
										'value'      => $main_color,
									),

									array(
										'type'       => 'colorpicker',
										'heading'    => esc_html__('Submenu background color','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenu_back_color',
										'value'      => '#ffffff',
									),

									array(
										'type'       => 'colorpicker',
										'heading'    => esc_html__('Submenu background color hover','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenu_back_color_hover',
										'value'      => '',
									),

									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Submenu shadow','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenu_shadow',
										'value'      => $logic_values
									),

									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Submenu indicator','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenu_submenu_indicator',
										'value'      => $logic_values
									),

									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Submenu items separator','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenu_separator',
										'value'      => $logic_values
									),

									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Submenu appear effect','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenu_appear',
										'value'      => array(
											esc_html__('Default','textron')   => 'none',
											esc_html__('Fade','textron')      => 'fade',
										),
									),

									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Submenu appear from','textron'),
										'group'      => 'Submenu',
										'param_name' => 'submenu_appear_from',
										'value'      => array(
											esc_html__('From bottom','textron') => 'bottom',
											esc_html__('From top','textron')    => 'top'
										),
									),


								/* typography
								----*/

									array(
										'param_name'=>'subfont_family',
										'type'      => 'dropdown',
										'group'     => esc_html__('Submenu','textron'),
										'heading'   => esc_html__('Submenu font family', 'textron'),
										'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
										'value'     => $google_fonts_family,
									),
									array(
										'param_name'=>'subfont_weight',
										'type'      => 'dropdown',
										'group'     => esc_html__('Submenu','textron'),
										'heading'   => esc_html__('Submenu font weight', 'textron'),
										'value'     => $font_weight_values
									),
									array(
										'param_name'=>'subfont_subsets',
										'type'      => 'dropdown',
										'group'     => esc_html__('Submenu','textron'),
										'heading'   => esc_html__('Submenu font subsets', 'textron'),
										'value'      => array(
											'latin' => 'latin',
										)
									),
									array(
										'type'       => 'textfield',
										'heading'    => esc_html__('Submenu font size (without any string)','textron'),
										'group'      => esc_html__('Submenu','textron'),
										'param_name' => 'subfont_size',
										'value'      => '16',
									),
									array(
										'type'       => 'textfield',
										'group'      => esc_html__('Submenu','textron'),
										'heading'    => esc_html__('Submenu letter spacing (without any string)','textron'),
										'param_name' => 'subletter_spacing',
										'value'      => ''
									),
									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Submenu text transform','textron'),
										'group'      => 'Submenu',
										'param_name' => 'subtext_transform',
										'value'      => array(
											esc_html__('None','textron')       => 'none',
											esc_html__('Uppercase','textron')  => 'uppercase',
											esc_html__('Lowercase','textron')  => 'lowercase',
											esc_html__('Capitalize','textron') => 'capitalize',
										)
									),

							/* margin
							----*/

								array(
									'type'       => 'margin',
									'group'      => esc_html__('Margin','textron'),
									'heading'    => esc_html__('Margin','textron'),
									'param_name' => 'margin',
									'value'      => ''
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element font','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_font',
									'value'      => '',
								),

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element font','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'subelement_font',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

		    	/* et_button
				----*/

					vc_map(array(
		    			'name'                    => esc_html__('Button','textron'),
			    		'description'             => esc_html__('Do not use with header builder','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_button',
			    		'class'                   => 'et_button',
			    		'icon'                    => 'et_button',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-button.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-button.js',
			    		'show_settings_on_create' => true,
			    		'params'                  => array(
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Button text','textron'),
								'param_name' => 'button_text',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Button link','textron'),
								'param_name' => 'button_link',
								'value'      => '',
							),
							array(
								'param_name'=>'target',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Target', 'textron'),
								'value'     => array(
									'_self'  => '_self',
									'_blank' => '_blank'
								)
							),
							array(
			    				'type'       => 'checkbox',
								'heading'    => esc_html__('Open link in modal window?', 'textron'),
								'param_name' => 'button_link_modal',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),

			    			/* typography
							----*/

								array(
									'param_name'=>'font_family',
									'type'      => 'dropdown',
									'group'     => esc_html__('Typography', 'textron'),
									'heading'   => esc_html__('Font family', 'textron'),
									'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
									'value'     => $google_fonts_family,
								),
								array(
									'param_name'=>'font_weight',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Font weight', 'textron'),
									'group'     => esc_html__('Typography', 'textron'),
									'value'     => $font_weight_values,
									'std'       => '400'
								),
								array(
									'param_name'=>'font_subsets',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Font subsets', 'textron'),
									'group'     => esc_html__('Typography', 'textron'),
									'value'     => array(
										'latin' => 'latin',
									)
								),
				    			array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Button font size (without any string)','textron'),
									'group'      => esc_html__('Typography','textron'),
									'param_name' => 'button_font_size',
									'value'      => '16',
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Button letter spacing (without any string)','textron'),
									'group'      => esc_html__('Typography','textron'),
									'param_name' => 'button_letter_spacing',
									'value'      => ''
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Button line height (without any string)','textron'),
									'group'      => esc_html__('Typography','textron'),
									'param_name' => 'button_line_height',
									'value'      => '22'
								),
								array(
									'type'       => 'dropdown',
									'group'   	 => esc_html__('Typography', 'textron'),
									'heading'    => esc_html__('Text transform','textron'),
									'param_name' => 'button_text_transform',
									'value'      => array(
										esc_html__('None','textron')       => 'none',
										esc_html__('Uppercase','textron')  => 'uppercase',
										esc_html__('Lowercase','textron')  => 'lowercase',
										esc_html__('Capitalize','textron') => 'capitalize',
									)
								),

							/* styling
							----*/

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Button size','textron'),
									'group'      => 'Styling',
									'param_name' => 'button_size',
									'value'      => array(
										esc_html__('Small','textron')  => 'small',
										esc_html__('Medium','textron') => 'medium',
										esc_html__('Large','textron')  => 'large',
									),
									'std' => 'medium',
									'dependency' => Array('element' => 'button_size_custom', 'value' => 'false')
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Button custom size','textron'),
									'group'      => 'Styling',
									'param_name' => 'button_size_custom',
									'value'      => $logic_values
								),

								array(
									'type'       => 'textfield',
									'group'      => 'Styling',
									'heading'    => esc_html__('Button width in px (without any string)','textron'),
									'param_name' => 'width',
									'value'      => '220',
									'dependency' => Array('element' => 'button_size_custom', 'value' => 'true')
								),

								array(
									'type'       => 'textfield',
									'group'      => 'Styling',
									'heading'    => esc_html__('Button height in px (without any string)','textron'),
									'param_name' => 'height',
									'value'      => '56',
									'dependency' => Array('element' => 'button_size_custom', 'value' => 'true')
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Button style','textron'),
									'group'      => 'Styling',
									'param_name' => 'button_style',
									'value'      => array(
										esc_html__('Normal','textron')  => 'normal',
										esc_html__('Outline','textron') => 'outline',
									)
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Button type','textron'),
									'group'      => 'Styling',
									'param_name' => 'button_type',
									'value'      => array(
										esc_html__('Round','textron')  => 'round',
										esc_html__('Rounded','textron') => 'rounded',
									)
								),
								array(
				    				'type'       => 'checkbox',
									'heading'    => esc_html__('Button shadow', 'textron'),
									'group'      => esc_html__('Styling','textron'),
									'param_name' => 'button_shadow',
									'value'      => '',
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Button color','textron'),
									'group'      => esc_html__('Styling','textron'),
									'param_name' => 'button_color',
									'value'      => '#ffffff'
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Button background color','textron'),
									'group'      => esc_html__('Styling','textron'),
									'param_name' => 'button_back_color',
									'value'      => $main_color,
									'dependency' => Array('element' => 'button_style', 'value' => 'normal')
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Button border color','textron'),
									'group'      => esc_html__('Styling','textron'),
									'param_name' => 'button_border_color',
									'value'      => $main_color,
									'dependency' => Array('element' => 'button_style', 'value' => 'outline')
								),

							/* hover
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Button color hover','textron'),
									'group'      => esc_html__('Hover','textron'),
									'param_name' => 'button_color_hover',
									'value'      => '#ffffff'
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Button background color hover','textron'),
									'group'      => esc_html__('Hover','textron'),
									'param_name' => 'button_back_color_hover',
									'value'      => $secondory_color,
									'dependency' => Array('element' => 'button_style', 'value' => 'normal')
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Button border color hover','textron'),
									'group'      => esc_html__('Hover','textron'),
									'param_name' => 'button_border_color_hover',
									'value'      => $secondory_color,
									'dependency' => Array('element' => 'button_style', 'value' => 'outline')
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Hover animation','textron'),
									'group'      => esc_html__('Hover','textron'),
									'param_name' => 'animate_hover',
									'value'      => array(
										esc_html__('Normal','textron')  	  => 'none',
										esc_html__('Fill effect','textron')   => 'fill',
										esc_html__('Scale effect','textron')  => 'scale',
										esc_html__('Move effect','textron')   => 'move',
										esc_html__('Elastic click','textron') => 'click',
									),
									'dependency' => Array('element' => 'button_style', 'value' => 'normal')
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Hover animation','textron'),
									'group'      => esc_html__('Hover','textron'),
									'param_name' => 'animate_hover_outline',
									'value'      => array(
										esc_html__('Normal','textron')  	  => 'none',
										esc_html__('Fill effect','textron')   => 'fill',
										esc_html__('Scale effect','textron')  => 'scale',
									),
									'dependency' => Array('element' => 'button_style', 'value' => 'outline')
								),

							/* click
							----*/

								array(
									'type'       => 'checkbox',
									'heading'    => esc_html__('Smooth Click animation','textron'),
									'group'      => esc_html__('Click','textron'),
									'param_name' => 'click_smooth',
									'value'      => ''
								),

							/* icon
							----*/

								array(
									'type'       => 'attach_image',
									'heading'    => esc_html__('Icon','textron'),
									'group'      => esc_html__('Icon','textron'),
									'param_name' => 'icon',
									'value'      => '',
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Icon size (without any string)','textron'),
									'group'      => esc_html__('Icon','textron'),
									'param_name' => 'icon_font_size',
									'value'      => '16',
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Icon margin (without any string)','textron'),
									'group'      => esc_html__('Icon','textron'),
									'param_name' => 'icon_margin',
									'value'      => '8',
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Icon position','textron'),
									'group'      => esc_html__('Icon','textron'),
									'param_name' => 'icon_position',
									'value'      => array(
										esc_html__('Left','textron')  => 'left',
										esc_html__('Right','textron')  => 'right',
									)
								),

							/* animation
							----*/

								array(
					                'type'       => 'animation_style',
					                'heading'    => esc_html__('Animation','textron'),
									'group'      => esc_html__('Animation','textron'),
					                'param_name' => 'animation',
					                'weight'     => 0,
					            ),
					            array(
									'type'       => 'dropdown',
									'heading'    => esc_html__( 'Animation delay in ms (example 300)', 'textron' ),
									'param_name' => 'animation_delay',
									'group'      => esc_html__('Animation','textron'),
									'value'      => $animation_delay_values,
									'dependency' => Array('element' => 'animate', 'value' => 'true')
								),
							
							/* margin
							----*/

								array(
									'type'       => 'margin',
									'group'      => esc_html__('Margin','textron'),
									'heading'    => esc_html__('Margin','textron'),
									'param_name' => 'margin',
									'value'      => ''
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element font','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_font',
									'value'      => '',
								),
			    		)
		    		));

				/* et_separator
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Separator','textron'),
						'description'             => esc_html__('Use this element to separate content','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_separator',
						'class'                   => 'et_separator',
						'icon'                    => 'et_separator',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-separator.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-separator.js',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Type','textron'),
								'param_name' => 'type',
								'value'      => array(
									esc_html__('solid','textron')  => 'solid',
									esc_html__('dotted','textron') => 'dotted',
									esc_html__('dashed','textron') => 'dashed',
								)
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Color','textron'),
								'param_name' => 'color',
								'value'      => '#e0e0e0'
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Width (without any string, if you want 100% leave blank)','textron'),
								'param_name' => 'width',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Height (without any string, if you want 1px leave blank)','textron'),
								'param_name' => 'height',
								'value'      => ''
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Align','textron'),
								'param_name' => 'align',
								'value'      => $align_values
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => ''
							),

							/* margin
							----*/

								array(
									'type'       => 'margin',
									'group'      => esc_html__('Margin','textron'),
									'heading'    => esc_html__('Margin','textron'),
									'param_name' => 'margin',
									'value'      => ''
								),

							/* responsive visibility
							----*/

								array(
									'type'       => 'rv',
									'heading'    => esc_html__( 'Responsive visibility', 'textron' ),
									'group'      => esc_html__('Responsive visibility','textron'),
									'param_name' => 'rv',
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
						)
					));

			    /* et_icon_separator
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Icon separator','textron'),
						'description'             => esc_html__('Use this element to separate content','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_icon_separator',
						'class'                   => 'et_icon_separator',
						'icon'                    => 'et_icon_separator',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon-separator.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon-separator.js',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Icon','textron'),
								'param_name' => 'icon',
							),
							array(
								'param_name'=>'icon_size',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Icon size', 'textron'),
								'value'     => $size_values_default
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Separator color','textron'),
								'param_name' => 'color_sep',
								'value'      => '#e0e0e0'
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'param_name' => 'color_icon',
								'value'      => $main_color
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Gap from top (without any string)','textron'),
								'param_name' => 'top',
								'value'      => '24'
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Gap from bottom (without any string)','textron'),
								'param_name' => 'bottom',
								'value'      => '24'
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Separator width (without any string)','textron'),
								'param_name' => 'width',
								'value'      => '120'
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Height (without any string, if you want 1px leave blank)','textron'),
								'param_name' => 'height',
								'value'      => '1'
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Align','textron'),
								'param_name' => 'align',
								'value'      => $align_values
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => ''
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
						)
					));

			    /* et_icon
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Icon','textron'),
						'description'             => esc_html__('Insert icon','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_icon',
						'class'                   => 'et_icon',
						'icon'                    => 'et_icon',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon.js',
						'show_settings_on_create' => true,
						'params'                  => array(

							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Icon','textron'),
								'param_name' => 'icon',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Icon link','textron'),
								'param_name' => 'icon_link',
								'value'      => '',
							),

							array(
								'param_name'=>'target',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Target', 'textron'),
								'value'     => array(
									'_self'  => '_self',
									'_blank' => '_blank'
								),
								'dependency' => Array('element' => 'icon_link', 'not_empty' => true)
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Elastic click','textron'),
								'param_name' => 'click',
								'value'      => $logic_values
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon color','textron'),
									'group'      => 'Styling',
									'param_name' => 'icon_color',
									'value'      => '#000000',
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon color hover','textron'),
									'group'      => 'Styling',
									'param_name' => 'icon_color_hover',
									'value'      => $main_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon background color','textron'),
									'group'      => 'Styling',
									'param_name' => 'icon_background_color',
									'value'      => '',
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon background color hover','textron'),
									'group'      => 'Styling',
									'param_name' => 'icon_background_color_hover',
									'value'      => '',
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon border color','textron'),
									'group'      => 'Styling',
									'param_name' => 'icon_border_color',
									'value'      => '',
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon border color hover','textron'),
									'group'      => 'Styling',
									'param_name' => 'icon_border_color_hover',
									'value'      => '',
								),

								array(
									'type'       => 'textfield',
									'group'      => 'Styling',
									'heading'    => esc_html__('Icon border width in px (without any string)','textron'),
									'param_name' => 'icon_border_width',
								),

								array(
									'type'       => 'checkbox',
									'group'      => 'Styling',
									'heading'    => esc_html__('Shadow','textron'),
									'param_name' => 'shadow',
									'value'      => ''
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Size','textron'),
									'group'      => 'Styling',
									'param_name' => 'size',
									'value'      => array(
										esc_html__('Small','textron')  => 'small',
										esc_html__('Medium','textron') => 'medium',
										esc_html__('Large','textron')  => 'large',
									),
									'std' => 'medium'
								),

							/* margin
							----*/

								array(
									'type'       => 'margin',
									'group'      => esc_html__('Margin','textron'),
									'heading'    => esc_html__('Margin','textron'),
									'param_name' => 'margin',
									'value'      => ''
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
						)
					));

			    /* et_icon_list
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Icon list','textron'),
						'description'             => esc_html__('Insert icon list','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_icon_list',
						'class'                   => 'et_icon_list',
						'icon'                    => 'et_icon_list',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon-list.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon-list.js',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Icon','textron'),
								'param_name' => 'icon',
								'value'      => '',
							),
			    			array(
								'param_name'=>'icon_size',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Size', 'textron'),
								'value'     => $size_values_default,
								'std'       => 'medium'
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'param_name' => 'icon_color',
								'value'      => ''
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'param_name' => 'icon_background_color',
								'value'      => ''
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color','textron'),
								'param_name' => 'icon_border_color',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Icon border width (without any string)','textron'),
								'param_name' => 'icon_border_width',
							),
							array(
								'type'       => 'checkbox',
								'heading'    => esc_html__('Shadow','textron'),
								'param_name' => 'shadow',
								'value'      => ''
							),
							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('List items','textron'),
								'param_name' => 'content',
								'value'      => '',
								'description' => esc_html__('Use line break (press Enter) to separate between items','textron'),
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => ''
							),

							/* animation
							----*/

								array(
					                'type'       => 'checkbox',
					                'heading'    => esc_html__('Animation','textron'),
									'group'      => esc_html__('Animate','textron'),
					                'param_name' => 'animate',
					                'weight'     => 0,
					            ),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Animation','textron'),
									'heading'    => esc_html__('Start delay in ms (enter only integer number)','textron'),
									'param_name' => 'delay',
									'value'      => '0',
									'dependency' => Array('element' => 'animate', 'value' => 'true')
								),

							/* margin
							----*/

								array(
									'type'       => 'margin',
									'group'      => esc_html__('Margin','textron'),
									'heading'    => esc_html__('Margin','textron'),
									'param_name' => 'margin',
									'value'      => ''
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
						)
					));

			    /* et_accordion
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Accordion','textron'),
			    		'description'             => esc_html__('Insert accordion','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_accordion',
			    		'class'                   => 'et_accordion',
			    		'icon'                    => 'et_accordion',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-accordion.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-accordion.js',
			    		'as_parent'               => array('only' => 'et_accordion_item'),
			    		'content_element'         => true,
			    		'show_settings_on_create' => true,
			    		'is_container'            => true,
			    		'js_view'                 => 'VcColumnView',
			    		'params'                  => array(
			    			array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Collapsible','textron'),
								'param_name' => 'collapsible',
								'value'      => $logic_values
							),

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Title color','textron'),
									'group'      => 'Styling',
									'param_name' => 'color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Title color active','textron'),
									'group'      => 'Styling',
									'param_name' => 'color_active',
									'value'      => '#ffffff',
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Title background color','textron'),
									'group'      => 'Styling',
									'param_name' => 'background_color',
									'value'      => $area_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Title background color active','textron'),
									'group'      => 'Styling',
									'param_name' => 'background_color_active',
									'value'      => $secondory_color,
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));


			    	vc_map(array(
						'name'                    => esc_html__('Accordion item','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_accordion_item',
						'class'                   => 'et_accordion_item',
						'icon'                    => 'et_accordion_item',
						'as_child'                => array('only' => 'et_accordion'),
	    				"as_parent"               => array('except' => 'vc_section'),
	    				'content_element'         => true,
						"js_view"                 => 'VcColumnView',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Open','textron'),
								'param_name' => 'open',
								'value'      => $logic_values
							),
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Icon','textron'),
								'param_name' => 'icon',
								'value'      => '',
							),
							array(
			    				'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => ''
							),

						)
					));

			    /* et_tabs
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Tabs','textron'),
			    		'description'             => esc_html__('Insert tabs','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_tab',
			    		'class'                   => 'et_tab',
			    		'icon'                    => 'et_tab',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-tab.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-tab.js',
			    		'as_parent'               => array('only' => 'et_tab_item'),
			    		'content_element'         => true,
			    		'show_settings_on_create' => true,
			    		'is_container'            => true,
			    		'js_view'                 => 'VcColumnView',
			    		'params'                  => array(
			    			array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Type','textron'),
								'param_name' => 'type',
								'value'      => array(
									esc_html__('Horizontal','textron')  => 'horizontal',
									esc_html__('Vertical','textron')  => 'vertical',
								)
							),
							array(
								'type'       => 'checkbox',
								'heading'    => esc_html__('Tabs center','textron'),
								'param_name' => 'center',
							),

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Tab color','textron'),
									'group'      => 'Styling',
									'param_name' => 'color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Tab color active','textron'),
									'group'      => 'Styling',
									'param_name' => 'color_active',
									'value'      => '#ffffff',
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Tab background color','textron'),
									'group'      => 'Styling',
									'param_name' => 'background_color',
									'value'      => $area_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Tab background color active','textron'),
									'group'      => 'Styling',
									'param_name' => 'background_color_active',
									'value'      => $secondory_color,
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));


			    	vc_map(array(
						'name'                    => esc_html__('Tab','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_tab_item',
						'class'                   => 'et_tab_item',
						'icon'                    => 'et_tab_item',
						'as_child'                => array('only' => 'et_tab'),
	    				"as_parent"               => array('except' => 'vc_section'),
	    				'content_element'         => true,
						"js_view"                 => 'VcColumnView',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Active','textron'),
							'param_name' => 'active',
							'value'      => array(
								'false' => 'false',
								'true'  => 'true'
							)
						),
						array(
							'type'       => 'attach_image',
							'heading'    => esc_html__('Icon','textron'),
							'param_name' => 'icon',
							'value'      => '',
						),
						array(
		    				'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => ''
						),
						)
					));

			    /* et_animate_box
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Animate box','textron'),
						'description'             => esc_html__('Insert animate box with any content','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_animate_box',
						'class'                   => 'et_animate_box',
						'icon'                    => 'et_animate_box',
						"as_parent"               => array('except' => 'vc_row, vc_section'),
	    				'content_element'         => true,
						"js_view"                 => 'VcColumnView',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-animate-box.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-animate-box.js',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Background color','textron'),
								'param_name' => 'color',
								'value'      => $main_color
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => ''
							),

							/* padding
							----*/

								array(
									'type'       => 'padding',
									'group'      => esc_html__('Padding','textron'),
									'heading'    => esc_html__('Padding','textron'),
									'param_name' => 'padding',
									'value'      => '48,48,48,48'
								),

								array(
									'type'       => 'crp',
									'heading'    => esc_html__( 'Responsive padding', 'textron' ),
									'group'      => esc_html__('Responsive padding','textron'),
									'param_name' => 'crp',
								),

							/* animation
							----*/

								array(
									'type'       => 'dropdown',
									'group'      => esc_html__('Animation','textron'),
									'heading'    => esc_html__('Box animation','textron'),
									'param_name' => 'animation',
									'value'      => array(
										esc_html__('From top','textron')  => 'top',
										esc_html__('From bottom','textron') => 'bottom',
										esc_html__('From left','textron') => 'left',
										esc_html__('From right','textron') => 'right'
									)
								),

								array(
									'type'       => 'dropdown',
									'group'      => esc_html__('Animation','textron'),
									'heading'    => esc_html__('Content animation','textron'),
									'param_name' => 'stagger',
									'value'      => array(
										esc_html__('None','textron')  => 'none',
										esc_html__('Stagger from top','textron')  => 'top',
										esc_html__('Stagger from bottom','textron') => 'bottom',
										esc_html__('Stagger from left','textron') => 'left',
										esc_html__('Stagger from right','textron') => 'right'
									)
								),

								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Animation','textron'),
									'heading'    => esc_html__('Start delay in ms (enter only integer number)','textron'),
									'param_name' => 'delay',
									'value'      => '0',
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								)
								
						)
					));

			    /* et_stagger_box
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Stagger box','textron'),
						'description'             => esc_html__('Insert stagger box with any content','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_stagger_box',
						'class'                   => 'et_stagger_box',
						'icon'                    => 'et_stagger_box',
						"as_parent"               => array('except' => 'vc_row, vc_section'),
	    				'content_element'         => true,
						"js_view"                 => 'VcColumnView',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-stagger-box.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-stagger-box.js',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => ''
							),

							/* animation
							----*/

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Content animation','textron'),
									'param_name' => 'stagger',
									'value'      => array(
										esc_html__('Stagger from top','textron')  => 'top',
										esc_html__('Stagger from bottom','textron') => 'bottom',
										esc_html__('Stagger from left','textron') => 'left',
										esc_html__('Stagger from right','textron') => 'right'
									)
								),

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Stagger interval in ms (enter only integer number)','textron'),
									'param_name' => 'interval',
									'value'      => '50',
								),

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Start delay in ms (enter only integer number)','textron'),
									'param_name' => 'delay',
									'value'      => '0',
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								)
								
						)
					));

			/* SOCIAL
			----*/

				/* et_social_icons
				----*/

					foreach ($social_links_array as $social) {
						vc_add_param('et_social_links', array(
							'type'       => 'textfield',
							'heading'    => ucfirst($social).' link',
							'param_name' => $social,
							'value'      => '',
							'weight' => 1
						));
					}

			    	vc_map(array(
						'name'                    => esc_html__('Social links','textron'),
			    		'description'             => esc_html__('Use to add social links','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_social_links',
			    		'class'                   => 'et_social_links',
			    		'icon'                    => 'et_social_links',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-social-links.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-social-links.js',
						'params'                  => array(
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),
							array(
								'param_name'=>'target',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Target', 'textron'),
								'value'     => array(
									'_self'  => '_self',
									'_blank' => '_blank'
								)
							),

							/* styling
							----*/

								array(
									'param_name'=>'shadow',
									'type'      => 'checkbox',
									'group'     => esc_html__('Styling','textron'),
									'heading'   => esc_html__('Shadow', 'textron'),
									'value'     => ''
								),

								array(
									'param_name'=>'size',
									'type'      => 'dropdown',
									'group'     => esc_html__('Styling','textron'),
									'heading'   => esc_html__('Size', 'textron'),
									'value'     => $size_values_default
								),

								array(
									'param_name'=>'styling_original',
									'type'      => 'dropdown',
									'group'     => esc_html__('Styling','textron'),
									'heading'   => esc_html__('Original styling', 'textron'),
									'value'     => $logic_values
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon color','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'icon_color',
									'value'      => '#000000',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon color hover','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'icon_color_hover',
									'value'      => $secondory_color,
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon background color','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'icon_background_color',
									'value'      => '',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon background color hover','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'icon_background_color_hover',
									'value'      => '',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon border color','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'icon_border_color',
									'value'      => '',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon border color hover','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'icon_border_color_hover',
									'value'      => '',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Icon border width (without any string)','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'icon_border_width',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
						)
					));

				/* et_social_icons
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Social share','textron'),
			    		'description'             => esc_html__('Use to add social sharing','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_social_share',
			    		'class'                   => 'et_social_share',
			    		'icon'                    => 'et_social_share',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-social-share.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-social-share.js',
						'params'                  => array(
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),

							/* styling
							----*/

								array(
									'param_name'=>'shadow',
									'type'      => 'checkbox',
									'heading'   => esc_html__('Shadow', 'textron'),
									'value'     => ''
								),

								array(
									'param_name'=>'styling_original',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Original styling', 'textron'),
									'value'     => $logic_values
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon color','textron'),
									'param_name' => 'icon_color',
									'value'      => '#000000',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon color hover','textron'),
									'param_name' => 'icon_color_hover',
									'value'      => $secondory_color,
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon background color','textron'),
									'param_name' => 'icon_background_color',
									'value'      => '',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon background color hover','textron'),
									'param_name' => 'icon_background_color_hover',
									'value'      => '',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon border color','textron'),
									'param_name' => 'icon_border_color',
									'value'      => '',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon border color hover','textron'),
									'param_name' => 'icon_border_color_hover',
									'value'      => '',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Icon border width (without any string)','textron'),
									'param_name' => 'icon_border_width',
									'dependency' => Array('element' => 'styling_original', 'value' => 'false')
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
						)
					));

				/* et_mailchimp
				----*/

	 				$list_array = enovathemes_addons_mailchimp_list();

	 				$list_values = array('' => esc_html__('Choose','textron'));

	 				if ( !is_wp_error( $list_array ) ){

	 					// foreach ( $list_array as $list){
	 					// 	$list_values[$list['id']] = $list['name'];
	 					// }
	 				}

					$list_values = array_flip($list_values);

					if (empty($list_values)) {
						array_push($list_values, esc_html__('Mailchimp did not return any list','textron'));
					}

			    	vc_map(array(
			    		'name'                    => esc_html__('Mailchimp','textron'),
			    		'description'             => esc_html__('Use to add AJAX mailchimp subscribe','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_mailchimp',
			    		'class'                   => 'et_mailchimp',
			    		'icon'                    => 'et_mailchimp',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mailchimp.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mailchimp.js',
			    		'show_settings_on_create' => true,
			    		'params'                  => array(
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('List','textron'),
								'description'=> esc_html__('Make sure you have the Mailchimp API key and at least one list in your Mailchimp dashboard. Go to theme options >> general >> Mailchimp API key','textron'),
								'param_name' => 'list',
								'value'      => $list_values,
							),

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Text field color','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'text_color',
									'value'      => $secondory_color,
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Text field color focus','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'text_color_focus',
									'value'      => $secondory_color,
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Text field background color','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'text_background_color',
									'value'      => '#ffffff',
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Text field background color focus','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'text_background_color_focus',
									'value'      => '#ffffff',
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Text field border color','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'text_border_color',
									'value'      => $area_color,
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Text field border color focus','textron'),
									'group'     => esc_html__('Styling','textron'),
									'param_name' => 'text_border_color_focus',
									'value'      => $secondory_color,
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));


			/* SELFHOSTED
			----*/

				/* et_icon_box_container
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Icon box container','textron'),
						'description'             => esc_html__('Insert icon box container','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_icon_box_container',
						'class'                   => 'et_icon_box_container',
						'icon'                    => 'et_icon_box_container',
						"as_parent"               => array('only' => 'et_icon_box'),
	    				'content_element'         => true,
						"js_view"                 => 'VcColumnView',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon-box-container.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon-box-container.js',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'type'       => 'checkbox',
								'heading'    => esc_html__('Gap','textron'),
								'param_name' => 'gap',
								'value'      => ''
							),
							array(
								'type'       => 'checkbox',
								'heading'    => esc_html__('Box Shadow','textron'),
								'param_name' => 'shadow',
								'value'      => '',
							),
							array(
								'param_name'=>'columns',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Column', 'textron'),
								'value'     => array(
									'1'  => '1',
									'2'  => '2',
									'3'  => '3',
									'4'  => '4',
								)
							),
							array(
								'param_name'=>'height',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Min height', 'textron'),
								'value'     => array(
									'0'      => '0',
									'100vh'  => '100vh',
									'70vh'   => '70vh',
									'60vh'   => '60vh',
									'50vh'   => '50vh',
									'custom'  => 'custom',
								)
							),
							array(
								'param_name'=>'custom-height',
								'type'      => 'textfield',
								'heading'   => esc_html__('Custom min height value (enter any value you need using all available units)', 'textron'),
								'value'     => '',
								'dependency' => Array(
									'element' => 'height', 'value' => 'custom',
								)
							),
							array(
								'param_name'=>'vertical_align',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Vertical align boxes', 'textron'),
								'value'     => array(
									'top'     => 'top',
									'middle'  => 'middle',
									'bottom'  => 'bottom',
								),
								'dependency' => Array(
									'element' => 'height', 'value' => array('100vh','70vh','60vh','50vh','custom'),
								)
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => ''
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Box animation','textron'),
								'param_name' => 'animation',
								'value'      => array(
									esc_html__('None','textron')   => 'none',
									esc_html__('Fade','textron')   => 'fade',
									esc_html__('Appear','textron') => 'appear',
								)
							),
						
							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
						)
					));

				/* et_icon_box
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Icon box','textron'),
						'description'             => esc_html__('Insert icon box','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_icon_box',
						'class'                   => 'et_icon_box',
						'icon'                    => 'et_icon_box',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon-box.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-icon-box.js',
						'show_settings_on_create' => true,
						'params'                  => array(

							/* icon
							----*/

								array(
									'type'       => 'attach_image',
									'heading'    => esc_html__('Icon','textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'param_name' => 'icon',
									'value'      => '',
								),
				    			array(
									'param_name'=>'icon_size',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Icon size', 'textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'value'     => array(
										esc_html__('Extra small','textron')    => 'small-x',
										esc_html__('Small','textron')    => 'small',
										esc_html__('Medium','textron')   => 'medium',
										esc_html__('Large','textron')    => 'large',
									),
									'std' => 'large'
								),
								array(
									'param_name'=>'icon_position',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Icon position', 'textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'value'     => array(
										esc_html__('Top','textron')  => 'top',
										esc_html__('Left','textron')  => 'left',
										esc_html__('Right','textron')  => 'right',
									),
								),
								array(
									'param_name'=>'icon_alignment',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Icon alignment', 'textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'value'     => $align_values,
									'dependency' => Array(
										'element' => 'icon_position', 'value' => 'top',
									)
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon color','textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'param_name' => 'icon_color',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon color hover','textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'param_name' => 'icon_color_hover',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon background color','textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'param_name' => 'icon_back_color',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon background color hover','textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'param_name' => 'icon_back_color_hover',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon border color','textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'param_name' => 'icon_border_color',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Icon border color hover','textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'param_name' => 'icon_border_color_hover',
									'value'      => ''
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Icon border width (without any string)','textron'),
									'group'      => esc_html__('Icon', 'textron'),
									'param_name' => 'icon_border_width',
								),
								
							/* content
							----*/

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Title','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'title',
									'value'      => ''
								),
								array(
									'param_name'=>'title_tag',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Tag', 'textron'),
									'group'      => esc_html__('Content', 'textron'),
									'value'     => array(
										'default'  => 'default',
										'H1'  => 'h1',
										'H2'  => 'h2',
										'H3'  => 'h3',
										'H4'  => 'h4',
										'H5'  => 'h5',
										'H6'  => 'h6',
										'p'   => 'p',
										'div' => 'div',
									),
									'std' => 'h4'
								),
								array(
									'type'       => 'textarea_html',
									'heading'    => esc_html__('Content','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'content',
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Link','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'link',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Title color','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'title_color',
									'value'      => $secondory_color
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Title color hover','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'title_color_hover',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Content color','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'text_color',
									'value'      => '#616161'
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Content color hover','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'text_color_hover',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Box background color','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'box_color',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Box background color hover','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'box_color_hover',
									'value'      => ''
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Box border width (without any string)','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'box_border_width',
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Box border color','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'box_border_color',
									'value'      => ''
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Box border color hover','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'box_border_color_hover',
									'value'      => ''
								),
							
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Hover animation','textron'),
								'param_name' => 'animation',
								'value'      => array(
									esc_html__('None','textron')          => 'none',
									esc_html__('Icon scale','textron')    => 'scale',
									esc_html__('Box transform','textron') => 'transform',
								)
							),

							array(
								'type'       => 'checkbox',
								'heading'    => esc_html__('Box Shadow','textron'),
								'param_name' => 'shadow',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),

							/* padding
							----*/

								array(
									'type'       => 'padding',
									'group'      => esc_html__('Padding','textron'),
									'heading'    => esc_html__('Padding','textron'),
									'param_name' => 'padding',
									'value'      => '48,32,48,32'
								),

								array(
									'type'       => 'crp',
									'heading'    => esc_html__( 'Responsive padding', 'textron' ),
									'group'      => esc_html__('Responsive padding','textron'),
									'param_name' => 'crp',
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
						)
					));

				/* et_step_box_container
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Step box','textron'),
						'description'             => esc_html__('Insert step box','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						'base'                    => 'et_step_box_container',
						'class'                   => 'et_step_box_container',
						'icon'                    => 'et_step_box_container',
						"as_parent"               => array('only' => 'et_step_box'),
	    				'content_element'         => true,
						"js_view"                 => 'VcColumnView',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'param_name'=>'columns',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Column', 'textron'),
								'value'     => array(
									'1'  => '1',
									'2'  => '2',
									'3'  => '3',
									'4'  => '4',
								)
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => ''
							),

						)
					));

				/* et_step_box
				----*/

			    	vc_map(array(
						'name'                    => esc_html__('Step box','textron'),
						'description'             => esc_html__('Insert step box','textron'),
						'category'                => esc_html__('Enovathemes','textron'),
						"as_child"                => array('only' => 'et_step_box_container'),
						'base'                    => 'et_step_box',
						'class'                   => 'et_step_box',
						'icon'                    => 'et_step_box',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-step-box.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-step-box.js',
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),


							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Title color','textron'),
									'group'      => esc_html__('Styling', 'textron'),
									'param_name' => 'title_color',
									'value'      => $main_color
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Content color','textron'),
									'group'      => esc_html__('Styling', 'textron'),
									'param_name' => 'text_color',
									'value'      => '#616161'
								),

							/* content
							----*/

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Title','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'title',
									'value'      => ''
								),
								array(
									'param_name'=>'title_tag',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Tag', 'textron'),
									'group'      => esc_html__('Content', 'textron'),
									'value'     => array(
										'H1'  => 'h1',
										'H2'  => 'h2',
										'H3'  => 'h3',
										'H4'  => 'h4',
										'H5'  => 'h5',
										'H6'  => 'h6',
										'p'   => 'p',
										'div' => 'div',
									),
									'std' => 'h6'
								),
								array(
									'type'       => 'textarea_html',
									'heading'    => esc_html__('Content','textron'),
									'group'      => esc_html__('Content', 'textron'),
									'param_name' => 'content',
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
						)
					));

				/* et_carousel
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Carousel','textron'),
			    		'description'             => esc_html__('Insert carousel with any content you want','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_carousel',
			    		'class'                   => 'et_carousel',
			    		'icon'                    => 'et_carousel',
			    		'show_settings_on_create' => true,
				    	'content_element'         => true,
						"js_view"                 => 'VcColumnView',
			    		'as_parent'               => array('only' => 'et_carousel_item'),
			    		'params'                  => array(
							array(
								'param_name'=>'columns',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Column', 'textron'),
								'value'     => array(
									'1'  => '1',
									'2'  => '2',
									'3'  => '3',
									'4'  => '4',
									'5'  => '5',
									'6'  => '6',
								)
							),
							array(
								'param_name'=>'navigation_type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Navigation type', 'textron'),
								'value'     => array(
									esc_html__('Only arrows','textron')  => 'arrows',
									esc_html__('Only dottes','textron')  => 'dottes',
									esc_html__('Both arrows and dottes','textron')  => 'both'
								)
							),
							array(
								'param_name'=>'autoplay',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Autoplay', 'textron'),
								'value'     => $logic_values
							),
			    		)
			    	));

			    	vc_map(array(
			    		'name'                    => 'Carousel item',
			    		'description'             => esc_html__('Insert carousel item','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_carousel_item',
			    		'class'                   => 'et_carousel_item',
			    		'icon'                    => 'et_carousel_item',
			    		'show_settings_on_create' => false,
				    	'content_element'         => true,
			    		'as_child'                => array('only' => 'et_carousel'),
			    		"as_parent"               => array('except' => 'vc_row, vc_section'),
						"js_view"                 => 'VcColumnView',
			    		'params'                  => array()
			    	));

			    /* et_pricing_table
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Pricing table','textron'),
			    		'description'             => esc_html__('Use to display your service/product pricing','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_pricing_table_container',
			    		'class'                   => 'et_pricing_table_container',
			    		'icon'                    => 'et_pricing_table',
			    		'show_settings_on_create' => true,
				    	'content_element'         => true,
						"js_view"                 => 'VcColumnView',
			    		'as_parent'               => array('only' => 'et_pricing_table'),
			    		'params'                  => array(
							array(
								'param_name'=>'columns',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Column', 'textron'),
								'value'     => array(
									'1'  => '1',
									'2'  => '2',
									'3'  => '3',
									'4'  => '4',
									'5'  => '5',
								)
							),
							array(
								'type'       => 'checkbox',
								'heading'    => esc_html__('Box Shadow','textron'),
								'param_name' => 'shadow',
								'value'      => ''
							),
							array(
								'type'       => 'checkbox',
								'heading'    => esc_html__('Gap','textron'),
								'param_name' => 'gap',
								'value'      => ''
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),
							
			    		)
			    	));

					vc_map(array(
			    		'name'                    => esc_html__('Pricing table','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'description'             => esc_html__('Use to display your service/product pricing','textron'),
			    		'base'                    => 'et_pricing_table',
			    		'icon'                    => 'et_pricing_table',
			    		'as_child'                => array('only' => 'et_pricing_table_container'),
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-pricing-table.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-pricing-table.js',
			    		'content_element'         => true,
			    		'params'                  => array(
			    			array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Color','textron'),
								'param_name' => 'color',
								'value'      => $main_color
							),
			    			array(
			    				'type'       => 'checkbox',
								'heading'    => esc_html__('Highlight', 'textron'),
								'param_name' => 'highlight',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Label','textron'),
								'param_name' => 'label',
								'value'      => ''
							),
			    			array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Currency','textron'),
								'param_name' => 'currency',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Price','textron'),
								'param_name' => 'price',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Plan','textron'),
								'param_name' => 'plan',
								'value'      => ''
							),
							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('List items','textron'),
								'param_name' => 'content',
								'value'      => '',
								'description' => esc_html__('Use line break (press Enter) to separate between items','textron'),
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Button text','textron'),
								'param_name' => 'button_text',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Button link','textron'),
								'param_name' => 'button_link',
								'value'      => ''
							),
							array(
								'param_name'=>'target',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Target', 'textron'),
								'value'     => array(
									'_self'  => '_self',
									'_blank' => '_blank'
								)
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

				/* et_testimonial
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Testimonials','textron'),
			    		'description'             => esc_html__('Add testimonials to carousel container','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_testimonial_container',
			    		'class'                   => 'et_testimonial_container',
			    		'icon'                    => 'et_testimonial_container',
			    		'show_settings_on_create' => true,
				    	'content_element'         => true,
			    		'js_view'                 => 'VcColumnView',
			    		'as_parent'               => array('only' => 'et_testimonial'),
			    		'params'                  => array(
							array(
								'param_name'=>'columns',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Column', 'textron'),
								'value'     => array(
									'1'  => '1',
									'2'  => '2',
									'3'  => '3',
								)
							),
							array(
								'param_name'=>'navigation_type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Navigation type', 'textron'),
								'value'     => array(
									esc_html__('Only arrows','textron')  => 'arrows',
									esc_html__('Only dottes','textron')  => 'dottes',
									esc_html__('Both arrows and dottes','textron')  => 'both'
								)
							),
							array(
								'param_name'=>'autoplay',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Autoplay', 'textron'),
								'value'     => $logic_values
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							)
			    		)
			    	));

			    	vc_map(array(
			    		'name'                    => esc_html__('Testimonial','textron'),
			    		'description'             => esc_html__('Add testimonial','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_testimonial',
			    		'class'                   => 'et_testimonial',
			    		'icon'                    => 'et_testimonial',
			    		'as_child'                => array('only' => 'et_testimonial_container'),
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-testimonial.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-testimonial.js',
			    		'params'                  => array(
			    			array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Content','textron'),
								'param_name' => 'text',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Author','textron'),
								'param_name' => 'author',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => '',
							),
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Author image','textron'),
								'param_name' => 'image',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),
			    		)
			    	));

			    /* et_client
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Clients','textron'),
			    		'description'             => esc_html__('Add clients','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_client_container',
			    		'class'                   => 'et_client_container',
			    		'icon'                    => 'et_client_container',
			    		'show_settings_on_create' => true,
			    		'is_container'            => true,
				    	'content_element'         => true,
						"js_view"                 => 'VcColumnView',
			    		'as_parent'               => array('only' => 'et_client'),
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-client.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-client.js',
			    		'params'                  => array(
			    			array(
								'param_name'=>'type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Type', 'textron'),
								'value'     => array(
									esc_html__('Grid', 'textron')     => 'grid',
									esc_html__('Carousel', 'textron') => 'carousel',
								)
							),
							array(
								'param_name'=>'columns',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Column', 'textron'),
								'value'     => array(
									'1'  => '1',
									'2'  => '2',
									'3'  => '3',
									'4'  => '4',
									'5'  => '5',
									'6'  => '6',
								)
							),
							array(
								'param_name'=>'columns_tab',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Column tablet', 'textron'),
								'value'     => array(
									esc_html__('Inherit', 'textron')  => 'inherit',
									'1'  => '1',
									'2'  => '2',
									'3'  => '3',
									'4'  => '4',
									'5'  => '5',
									'6'  => '6',
								),
								'dependency' => Array('element' => 'type', 'value' => 'grid')
							),
							array(
								'param_name'=>'columns_mob',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Column mobile', 'textron'),
								'value'     => array(
									esc_html__('Inherit', 'textron')  => 'inherit',
									'1'  => '1',
									'2'  => '2',
									'3'  => '3',
									'4'  => '4',
									'5'  => '5',
									'6'  => '6',
								),
								'dependency' => Array('element' => 'type', 'value' => 'grid')
							),
							array(
								'param_name'=>'navigation_type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Navigation type', 'textron'),
								'value'     => array(
									esc_html__('Only arrows','textron')  => 'arrows',
									esc_html__('Only dottes','textron')  => 'dottes',
									esc_html__('Both arrows and dottes','textron')  => 'both'
								),
								'dependency' => Array('element' => 'type', 'value' => 'carousel')
							),
							array(
								'param_name'=>'autoplay',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Autoplay', 'textron'),
								'value'     => $logic_values,
								'dependency' => Array('element' => 'type', 'value' => 'carousel')
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							)
			    		)
			    	));

			    	vc_map(array(
			    		'name'                    => esc_html__('Client','textron'),
			    		'description'             => esc_html__('Add client','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_client',
			    		'class'                   => 'et_client',
			    		'icon'                    => 'et_client',
			    		'as_child'                => array('only' => 'et_client_container'),
			    		'show_settings_on_create' => true,
			    		'params'                  => array(
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Link','textron'),
								'param_name' => 'link',
								'value'      => '',
							),
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Client image','textron'),
								'param_name' => 'image',
							),

			    		)
			    	));

			    /* et_person
				----*/

			    	foreach ($social_links_array as $social) {
						vc_add_param('et_person', array(
							'type'       => 'textfield',
							'heading'    => ucfirst($social).' link',
							'group'      => esc_html__('Social','textron'),
							'param_name' => $social,
							'value'      => '',
						));
					}

			    	vc_map(array(
			    		'name'                    => esc_html__('Person','textron'),
			    		'description'             => esc_html__('Add person','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_person',
			    		'class'                   => 'et_person',
			    		'icon'                    => 'et_person',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-person.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-person.js',
			    		'params'                  => array(
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Name','textron'),
								'param_name' => 'name',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => '',
							),
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Image','textron'),
								'param_name' => 'image',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),
			    		)
			    	));

				/* et_banner
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Popup banner','textron'),
			    		'description'             => esc_html__('Insert popup banner (if you want to have the popup in entire site, put the banner inside footer)','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_banner',
			    		'class'                   => 'et_banner',
			    		'icon'                    => 'et_banner',
			    		"as_parent"               => array('except' => 'vc_row, vc_section'),
						"js_view"                 => 'VcColumnView',
			    		"content_element"         => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-banner.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-banner.js',
			    		'params'                  => array(
			    			array(
			    				'type'       => 'checkbox',
								'heading'    => esc_html__('Hide on mobile', 'textron'),
								'param_name' => 'visible_mob',
								'value'      => '',
								'description'=> esc_html__('Check this option if you want to hide banner on mobile', 'textron'),
							),
							array(
			    				'type'       => 'checkbox',
								'heading'    => esc_html__('Hide on desktop', 'textron'),
								'param_name' => 'visible_desk',
								'value'      => '',
								'description'=> esc_html__('Check this option if you want to hide banner on desktop', 'textron'),
							),
							array(
			    				'type'       => 'checkbox',
								'heading'    => esc_html__('Hide on tablet', 'textron'),
								'param_name' => 'visible_tablet',
								'value'      => '',
								'description'=> esc_html__('Check this option if you want to hide tablet on mobile', 'textron'),
							),
							array(
			    				'type'       => 'checkbox',
								'heading'    => esc_html__('Use cookie', 'textron'),
								'param_name' => 'cookie',
								'value'      => '',
								'description'=> esc_html__('Toggle this option if you want to display your banner onces per visit session', 'textron'),
							),
			    			array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Delay in ms','textron'),
								'param_name' => 'delay',
								'value'      => '3000',
							),
							array(
								'param_name'=>'effect',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Effect', 'textron'),
								'value'     => array(
									esc_html__('Fade in and scale', 'textron') => 'fade-in-scale',
									esc_html__('Slide in right', 'textron')  	 => 'slide-in-right',
									esc_html__('Slide in bottom', 'textron')   => 'slide-in-bottom',
									esc_html__('3d flip horizontal', 'textron')=> 'flip-horizonatal',
									esc_html__('3d flip vertical', 'textron')  => 'flip-vertical'
								)
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Width in px','textron'),
								'param_name' => 'width',
								'value'      => '720',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Height in px','textron'),
								'param_name' => 'height',
								'value'      => '400',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Background color','textron'),
								'param_name' => 'back_color',
								'value'      => '#ffffff'
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Border color','textron'),
								'param_name' => 'border_color',
								'value'      => ''
							),
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Background image','textron'),
								'param_name' => 'back_img',
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Text align','textron'),
								'param_name' => 'text_align',
								'value'      => $align_values,
							),

							/* padding
							----*/

								array(
									'type'       => 'padding',
									'group'      => esc_html__('Padding','textron'),
									'heading'    => esc_html__('Padding','textron'),
									'param_name' => 'padding',
									'value'      => ''
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

				/* et_tagline
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Tagline','textron'),
			    		'description'             => esc_html__('Insert tagline (if you want to have the popup in entire site, put the tagline inside header)','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_tagline',
			    		'class'                   => 'et_tagline',
			    		'icon'                    => 'et_tagline',
			    		"content_element"         => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-tagline.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-tagline.js',
			    		'params'                  => array(
			    			array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Button text','textron'),
								'param_name' => 'button_text',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Button link','textron'),
								'param_name' => 'button_link',
								'value'      => '',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Background color','textron'),
								'param_name' => 'back_color',
								'value'      => $main_color
							),
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Background image','textron'),
								'param_name' => 'back_img',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Title color','textron'),
								'param_name' => 'title_color',
								'value'      => '#ffffff'
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Button color','textron'),
								'param_name' => 'button_color',
								'value'      => $main_color
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

				/* et_info_present
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Infographic presentation','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_info_present',
			    		'class'                   => 'et_info_present',
			    		'icon'                    => 'et_info_present',
			    		'show_settings_on_create' => true,
				    	'content_element'         => true,
						"js_view"                 => 'VcColumnView',
			    		'as_parent'               => array('only' => 'et_info_present_item'),
			    		'params'                  => array(
							array(
								'param_name'=>'autoplay',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Autoplay', 'textron'),
								'value'     => $logic_values
							),
			    		)
			    	));

			    	vc_map(array(
			    		'name'                    => 'Infographic presentation item',
			    		'description'             => esc_html__('Insert infographic presentation item','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_info_present_item',
			    		'class'                   => 'et_info_present_item',
			    		'icon'                    => 'et_info_present',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-info-presentation.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-info-presentation.js',
			    		'show_settings_on_create' => true,
			    		'as_child'                => array('only' => 'et_info_present'),
			    		'params'                  => array(
			    			array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Upload image','textron'),
								'param_name' => 'image',
							),
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Upload SVG icon','textron'),
								'param_name' => 'icon',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Subtitle','textron'),
								'param_name' => 'subtitle',
								'value'      => '',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Box background color','textron'),
								'param_name' => 'box_color',
								'value'      => $main_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'param_name' => 'icon_color',
								'value'      => $secondory_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Title color','textron'),
								'param_name' => 'title_color',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'dropdown',
								'group'      => esc_html__('Animation','textron'),
								'heading'    => esc_html__('Box animation','textron'),
								'param_name' => 'animation',
								'value'      => array(
									esc_html__('From top','textron')  => 'top',
									esc_html__('From bottom','textron') => 'bottom',
									esc_html__('From left','textron') => 'left',
									esc_html__('From right','textron') => 'right'
								)
							),

							array(
								'type'       => 'dropdown',
								'group'      => esc_html__('Animation','textron'),
								'heading'    => esc_html__('Content animation','textron'),
								'param_name' => 'stagger',
								'value'      => array(
									esc_html__('None','textron')  => 'none',
									esc_html__('Stagger from top','textron')  => 'top',
									esc_html__('Stagger from bottom','textron') => 'bottom',
									esc_html__('Stagger from left','textron') => 'left',
									esc_html__('Stagger from right','textron') => 'right'
								)
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

			/* MEDIA
			----*/

				/* et_image
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Image','textron'),
			    		'description'             => esc_html__('Insert/animate single image','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_image',
			    		'class'                   => 'et_image',
			    		'icon'                    => 'et_image',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-image.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-image.js',
			    		'show_settings_on_create' => true,
			    		'params'                  => array(
			    			array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Upload image','textron'),
								'param_name' => 'image',
							),
			    			array(
								'param_name'=>'size',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Size', 'textron'),
								'value'     => $image_size_values
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Image link','textron'),
								'param_name' => 'link',
								'value'      => '',
							),
							array(
								'param_name'=>'link_target',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Link target', 'textron'),
								'value'     => array(
									'_self'  => '_self',
									'_blank' => '_blank'
								),
								'dependency' => Array('element' => 'link', 'value' => 'custom')
							),
							array(
								'param_name'=>'alignment',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Alignment', 'textron'),
								'value'     => $align_values_extended
							),

							/* parallax
							----*/

								array(
									'type'       => 'checkbox',
									'heading'    => esc_html__('Parallax','textron'),
									'group'      => esc_html__('Parallax','textron'),
									'param_name' => 'parallax',
									'value'      => ''
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Offset X coordinate','textron'),
									'group'      => esc_html__('Parallax','textron'),
									'param_name' => 'parallax_x',
									'value'      => '0',
									'dependency' => Array(
										'element' => 'parallax', 'value' => 'true'
									)
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Offset Y coordinate','textron'),
									'group'      => esc_html__('Parallax','textron'),
									'param_name' => 'parallax_y',
									'value'      => '0',
									'dependency' => Array(
										'element' => 'parallax', 'value' => 'true'
									)
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Parallax speed radtio','textron'),
									'group'      => esc_html__('Parallax','textron'),
									'description'=> esc_html__('The more the value is the slower the parallax effect is','textron'),
									'param_name' => 'parallax_speed',
									'value'     => array(
										'1'  => '1',
										'2'  => '2',
										'3'  => '3',
										'4'  => '4',
										'5'  => '5',
										'6'  => '6',
										'7'  => '7',
										'8'  => '8',
										'9'  => '9',
										'10' => '10',
										'11' => '11',
										'12' => '12',
										'13' => '13',
										'14' => '14',
										'15' => '15',
										'16' => '16',
										'17' => '17',
										'18' => '18',
										'19' => '19',
										'20' => '20'
									),
									'std' => '10',
									'dependency' => Array(
										'element' => 'parallax', 'value' => 'true'
									)
								),

							/* animation
							----*/

								array(
									'type'       => 'checkbox',
									'heading'    => esc_html__('Animate','textron'),
									'group'      => 'Animation',
									'param_name' => 'animate',
								),
								array(
									'type'       => 'dropdown',
									'group'      => esc_html__('Animation','textron'),
									'heading'    => esc_html__('Animation type','textron'),
									'param_name' => 'animation_type',
									'value'     => array(
										esc_html__('Fade and Blur', 'textron')      => 'fade-blur',
										esc_html__('Curtain from left', 'textron')   => 'curtain-left',
										esc_html__('Curtain from right', 'textron')  => 'curtain-right',
										esc_html__('Curtain from top', 'textron')    => 'curtain-top',
										esc_html__('Curtain from bottom', 'textron') => 'curtain-bottom',
										esc_html__('Appear from left', 'textron')    => 'left',
										esc_html__('Appear from right', 'textron')   => 'right',
										esc_html__('Appear from top', 'textron')     => 'top',
										esc_html__('Appear from bottom', 'textron')  => 'bottom'
									),
									'dependency' => Array('element' => 'animate', 'value' => 'true')
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Curtain Color','textron'),
									'group'      => esc_html__('Animation','textron'),
									'param_name' => 'element_color',
									'value'      => $main_color,
									'dependency' => Array(
										'element' => 'animate', 'value' => 'true',
										'element' => 'animation_type', 'value' => array('curtain-left','curtain-right','curtain-top','curtain-bottom')
									)
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Animation','textron'),
									'heading'    => esc_html__('Start delay in ms (enter only integer number)','textron'),
									'param_name' => 'delay',
									'value'      => '0',
									'dependency' => Array('element' => 'animate', 'value' => 'true')
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

				/* et_gallery
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Gallery','textron'),
			    		'description'             => esc_html__('Insert/animate gallery','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_gallery',
			    		'class'                   => 'et_gallery',
			    		'icon'                    => 'et_gallery',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-gallery.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-gallery.js',
			    		'show_settings_on_create' => true,
			    		'params'                  => array(
			    			array(
								'type'       => 'attach_images',
								'heading'    => esc_html__('Upload images','textron'),
								'param_name' => 'images',
							),
			    			array(
								'param_name'=>'size',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Size', 'textron'),
								'value'     => $image_size_values
							),
							array(
			    				'type'       => 'dropdown',
								'heading'    => esc_html__('Gallery type', 'textron'),
								'param_name' => 'type',
								'value'      => array(
									esc_html__('Grid','textron')     => 'grid',
									esc_html__('Carousel','textron') => 'carousel',
									esc_html__('Slider','textron')   => 'slider',
								)
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Link to','textron'),
								'param_name' => 'link',
								'value'      => array(
									esc_html__('None','textron')       => 'none',
									esc_html__('Attachment','textron') => 'attach',
									esc_html__('Lightbox','textron')   => 'lightbox',
								)
							),
							array(
								'param_name'=>'columns',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Columns', 'textron'),
								'value'     => array(
									'1'  => '1',
									'2'  => '2',
									'3'  => '3',
									'4'  => '4',
									'5'  => '5',
									'6'  => '6',
									'7'  => '7',
									'8'  => '8',
									'9'  => '9',
									'10' => '10'
								),
								'dependency' => Array(
									'element' => 'type', 'value' => array('grid','carousel'),
								)
							),
							array(
								'param_name'=>'navigation_type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Navigation type', 'textron'),
								'value'     => array(
									esc_html__('Only arrows','textron')  => 'arrows',
									esc_html__('Only dottes','textron')  => 'dottes',
									esc_html__('Both arrows and dottes','textron')  => 'both'
								),
								'dependency' => Array(
									'element' => 'type', 'value' => array('carousel'),
								)
							),
							array(
								'param_name'=>'autoplay',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Autoplay', 'textron'),
								'value'     => $logic_values,
								'dependency' => Array(
									'element' => 'type', 'value' => array('carousel','carousel-thumbs'),
								)
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								)
			    		)
			    	));

				/* et_video
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Video','textron'),
			    		'description'             => esc_html__('Insert video (selfhosted, youtube, vimeo)','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_video',
			    		'class'                   => 'et_video',
			    		'icon'                    => 'et_video',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-video.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-video.js',
			    		'params'                  => array(
			    			array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Poster','textron'),
								'param_name' => 'image',
							),
							array(
								'type'       => 'checkbox',
								'heading'    => esc_html__('Modal','textron'),
								'param_name' => 'modal',
								'dependency' => Array('element' => 'image', 'not_empty' => true)
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('MP4 video file url','textron'),
								'param_name' => 'mp4',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Video embed url','textron'),
								'param_name' => 'embed',
								'value'      => '',
							)
			    		)
			    	));

			    /* et_audio
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Audio','textron'),
			    		'description'             => esc_html__('Insert audio','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_audio',
			    		'class'                   => 'et_audio',
			    		'icon'                    => 'et_audio',
			    		'show_settings_on_create' => true,
			    		'params'                  => array(
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('MP3 audio file url','textron'),
								'param_name' => 'mp3',
								'value'      => '',
							),
			    		)
			    	));

			/* INFOGRAPHICS
			----*/

				/* et_counter
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Counter','textron'),
			    		'description'             => esc_html__('Insert number counter','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_counter',
			    		'class'                   => 'et_counter',
			    		'icon'                    => 'et_counter',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-counter.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-counter.js',
			    		'params'                  => array(
				    		array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Text align','textron'),
								'param_name' => 'text_align',
								'value'      => $align_values,
							),
			    			array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Number','textron'),
								'param_name' => 'number',
								'value'      => '',
								'description' => esc_html__('Insert an integer value to count to','textron'),
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Number postfix','textron'),
								'param_name' => 'number_postfix',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => '',
							),
							array(
								'param_name'=>'type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Title tag', 'textron'),
								'value'     => array(
									'H1'  => 'h1',
									'H2'  => 'h2',
									'H3'  => 'h3',
									'H4'  => 'h4',
									'H5'  => 'h5',
									'H6'  => 'h6',
									'p'   => 'p',
									'div' => 'div',
								),
								'std' => 'h4'
							),
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Icon','textron'),
								'param_name' => 'icon',
								'value'      => '',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'param_name' => 'icon_color',
								'value'      => $secondory_color
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Value font-size','textron'),
								'param_name' => 'value_font_size',
								'value'      => '48'
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Value color','textron'),
								'param_name' => 'value_color',
								'value'      => $main_color
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Title color','textron'),
								'param_name' => 'title_color',
								'value'      => $secondory_color
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Start delay in ms (enter only integer number)','textron'),
								'param_name' => 'delay',
								'value'      => '0',
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

				/* et_progress
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Progress','textron'),
			    		'description'             => esc_html__('Insert progress bar','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_progress',
			    		'class'                   => 'et_progress',
			    		'icon'                    => 'et_progress',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-progress.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-progress.js',
			    		'show_settings_on_create' => true,
			    		'params'                  => array(
			    			array(
								'param_name'=>'version',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Type', 'textron'),
								'value'     => array(
									esc_html__('Default', 'textron') => 'default',
									esc_html__('Circle', 'textron')  => 'circle',
								),
								'std' => 'default'
							),
			    			array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Title','textron'),
								'param_name' => 'title',
								'value'      => '',
							),
							array(
								'param_name'=>'type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Title tag', 'textron'),
								'value'     => array(
									'H1'  => 'h1',
									'H2'  => 'h2',
									'H3'  => 'h3',
									'H4'  => 'h4',
									'H5'  => 'h5',
									'H6'  => 'h6',
									'p'   => 'p',
									'div' => 'div',
								),
								'std' => 'h4'
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Percentage','textron'),
								'param_name' => 'percentage',
								'value'      => '',
								'description' => esc_html__('Only integer value, without any string','textron'),
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Bar Color','textron'),
								'param_name' => 'bar_color',
								'value'      => $main_color
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Track Color','textron'),
								'param_name' => 'track_color',
								'value'      => $area_color
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Text color','textron'),
								'param_name' => 'text_color',
								'value'      => $secondory_color
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Start delay in ms (enter only integer number)','textron'),
								'param_name' => 'delay',
								'value'      => '0',
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

			    /* et_timer
				----*/

					vc_map(array(
			    		'name'                    => esc_html__('Timer','textron'),
			    		'description'             => esc_html__('Insert timer','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_timer',
			    		'class'                   => 'et_timer',
			    		'icon'                    => 'et_timer',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-timer.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-timer.js',
			    		'show_settings_on_create' => true,
			    		'params'                  => array(
			    			array(
								'type'       => 'textfield',
								'heading'    => esc_html__('End date to count to','textron'),
								'param_name' => 'enddate',
								'value'      => '',
								'description' => esc_html__('Use format : June 7, 2025 15:03:25','textron'),
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Days label','textron'),
								'param_name' => 'days',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Hours label','textron'),
								'param_name' => 'hours',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Minutes label','textron'),
								'param_name' => 'minutes',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Seconds label','textron'),
								'param_name' => 'seconds',
								'value'      => ''
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Value color','textron'),
								'param_name' => 'value_color',
								'value'      => $main_color
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Text color','textron'),
								'param_name' => 'text_color',
								'value'      => $secondory_color
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

			/* OTHER
			----*/

				/* et_bullets
				----*/

			    	vc_map(array(
			    		'name'                    => esc_html__('Bulleted navigation','textron'),
			    		'description'             => esc_html__('Use only with One page layout active','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_bullets',
			    		'class'                   => 'et_bullets hbe',
			    		'icon'                    => 'et_bullets',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-bullets.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-bullets.js',
			    		'params'                  => array(

			    			array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Menu name','textron'),
								'param_name' => 'menu',
								'value'      => $menu_list,
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Extra class','textron'),
								'param_name' => 'extra_class',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('One page navigation offset in px (without any string)','textron'),
								'description'=> esc_html__('If you have sticky header on the page, you can set the offset','textron'),
								'param_name' => 'offset',
								'value'      => '0',
							),

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Background color','textron'),
									'group'      => 'Styling',
									'param_name' => 'back_color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Color','textron'),
									'group'      => 'Styling',
									'param_name' => 'color',
									'value'      => '#ffffff',
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Color hover','textron'),
									'group'      => 'Styling',
									'param_name' => 'color_hover',
									'value'      => $main_color,
								),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

			    /* et_gap
				----*/

			    	vc_map(array(
			    		'name'                    => esc_html__('Gap','textron'),
			    		'description'             => esc_html__('Insert space','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_gap',
			    		'class'                   => 'et_gap',
			    		'icon'                    => 'et_gap',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-gap.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-gap.js',
			    		'params'                  => array(
			    			array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Gap size (without any string)','textron'),
								'param_name' => 'height',
								'value'      => '32'
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Custom class','textron'),
								'param_name' => 'extra_class',
								'value'      => ''
							),
							array(
								'type'       => 'rv',
								'heading'    => esc_html__( 'Responsive visibility', 'textron' ),
								'group'      => esc_html__('Responsive visibility','textron'),
								'param_name' => 'rv',
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),

			    		)
			    	));

			    	vc_map(array(
			    		'name'                    => esc_html__('Inline gap','textron'),
			    		'description'             => esc_html__('Insert horizontal space','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_gap_inline',
			    		'class'                   => 'et_gap_inline',
			    		'icon'                    => 'et_gap_inline',
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-gap-inline.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-gap-inline.js',
			    		'params'                  => array(
			    			array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Gap size (without any string)','textron'),
								'param_name' => 'width',
								'value'      => '32'
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Custom class','textron'),
								'param_name' => 'extra_class',
								'value'      => ''
							),
							array(
								'type'       => 'rv',
								'heading'    => esc_html__( 'Responsive visibility', 'textron' ),
								'group'      => esc_html__('Responsive visibility','textron'),
								'param_name' => 'rv',
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),

			    		)
			    	));

			/* WOOCOMMERCE
			----*/

				if (class_exists('Woocommerce')) {

					$cat_args = array(
						'orderby'    => 'name',
					    'order'      => 'asc',
					    'hide_empty' => false
					);

					$category_values = array();
					$category_list   = get_terms( 'product_cat', $cat_args );
					if(is_object($category_list)  && !empty($category_list)){

					    foreach ($category_list as $category) {
					    	if ($category->parent) {
					    		$category_values[' - '.$category->name] = $category->slug;
					    	} else {
					    		$category_values[$category->name] = $category->slug;
					    	}
					    }
					}

					if(function_exists('wc_get_attribute_taxonomies')){

						$attributes_tax = wc_get_attribute_taxonomies();
						$attributes = array();
						foreach ( $attributes_tax as $attribute ) {
							$attributes[ $attribute->attribute_label ] = $attribute->attribute_name;
						}

					}

					$product_categories = array(
						esc_html__('All','textron')  => 'all',
					);

					$args = array(
					    'orderby'           => 'name',
					    'order'             => 'ASC',
					    'hide_empty'        => true,
					    'exclude'           => array(),
					    'exclude_tree'      => array(),
					    'number'            => '',
					    'fields'            => 'all',
					    'slug'              => '',
					    'parent'            => '',
					    'hierarchical'      => false,
					    'child_of'          => 0,
					    'get'               => '',
					    'name__like'        => '',
					    'description__like' => '',
					    'pad_counts'        => false,
					    'offset'            => '',
					    'search'            => '',
					    'cache_domain'      => 'core'
					);
					$tax_terms = get_terms('product_cat');

					if (count($tax_terms) != 0){
		            	foreach(get_terms('product_cat',$args) as $filter_term){
		        			$filter_count    = $filter_term->count;
		        			$filter_children = get_term_children( $filter_term->term_id, 'product_cat' );
		        			if(is_array($filter_children) && !empty($filter_children)) {
		        				foreach ($filter_children as $filter_child) {
		        					$filter_child_obj = get_term($filter_child, 'product_cat');
		        					$filter_count = $filter_count + $filter_child_obj->count;
		        				}
		        			}

		        			$product_categories[$filter_term->name] = $filter_term->slug;
			            }
					}

					/* et_woo_products
					----*/

				    	vc_map(array(
				    		'name'                    => esc_html__('Woocommerce products','textron'),
				    		'description'             => esc_html__('Use this element to add different types of products','textron'),
				    		'category'                => array(esc_html__('Enovathemes','textron'),esc_html__('WooCommerce','textron')),
				    		'base'                    => 'et_woo_products',
				    		'class'                   => 'et_woo_products',
				    		'icon'                    => 'et_woo_products',
				    		'show_settings_on_create' => true,
				    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-woo.js',
				    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-woo.js',
				    		'params'                  => array(
				    			array(
									'param_name'=>'layout',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Layout', 'textron'),
									'value'     => array(
										esc_html__('Grid', 'textron')     => 'grid',
										esc_html__('Carousel', 'textron') => 'carousel',
									)
								),
								array(
									'param_name'=>'navigation_type',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Navigation type', 'textron'),
									'value'     => array(
										esc_html__('Only arrows','textron')  => 'arrows',
										esc_html__('Only dottes','textron')  => 'dottes',
										esc_html__('Both arrows and dottes','textron')  => 'both',
									),
									'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
								),
								array(
									'param_name'=>'autoplay',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Autoplay', 'textron'),
									'value'     => $logic_values,
									'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
								),
								array(
									'type' => 'dropdown',
									'heading'     => esc_html__( 'Columns', 'textron' ),
									'value'       => $size_values_box,
									'param_name'  => 'columns',
									'save_always' => true
								),
								array(
									'type' => 'textfield',
									'heading' => esc_html__( 'Quantity', 'textron' ),
									'value' => 12,
									'save_always' => true,
									'param_name' => "quantity",
									'description' => esc_html__( 'The "quantity" shortcode determines how many products to show', 'textron' ),
								),
								array(
									'type' => 'textfield',
									'heading' => esc_html__( 'Category', 'textron' ),
									'value' => '',
									'param_name' => 'category',
									'save_always' => true,
									'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'textron' ),
									'dependency' => Array(
										'element' => 'type', 'value' => array('recent','featured','sale','best_selling','top_rated','attribute'),
									)
								),
								array(
									'type' => 'dropdown',
									'heading' => esc_html__( 'Operator', 'textron' ),
									'param_name' => 'operator',
									'value' => $operator_values,
									'save_always' => true,
									'description' => esc_html__( 'Select filter operator', 'textron' ),
									'dependency' => Array('element' => 'category', 'not_empty' => true)
								),
								array(
									'type' => 'dropdown',
									'heading' => esc_html__( 'Order by', 'textron' ),
									'param_name' => 'orderby',
									'value' => $order_by_values,
									'save_always' => true,
									'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'textron' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
								),
								array(
									'type' => 'dropdown',
									'heading' => esc_html__( 'Sort order', 'textron' ),
									'param_name' => 'order',
									'value' => $order_way_values,
									'save_always' => true,
									'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'textron' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
								),
								array(
									'param_name'=>'type',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Type', 'textron'),
									'value'     => array(
										esc_html__('Recent', 'textron')       => 'recent',
										esc_html__('Featured', 'textron')     => 'featured',
										esc_html__('Sale', 'textron')         => 'sale',
										esc_html__('Best selling', 'textron') => 'best_selling',
										esc_html__('Top rated', 'textron')    => 'top_rated',
										esc_html__('Attribute', 'textron')    => 'attribute',
										esc_html__('Related', 'textron')      => 'related',
										esc_html__('Custom', 'textron')       => 'custom',
									)
								),

								/* attribute
								----*/

									array(
										'type' => 'dropdown',
										'heading' => esc_html__( 'Attribute', 'textron' ),
										'param_name' => 'attribute',
										'value' => $attributes,
										'save_always' => true,
										'description' => esc_html__( 'List of product taxonomy attributes', 'textron' ),
										'dependency' => Array(
											'element' => 'type', 'value' => array('attribute'),
										)
									),
									array(
										'type' => 'textfield',
										'heading' => esc_html__( 'Filter', 'textron' ),
										'value' => '',
										'param_name' => 'filter',
										'save_always' => true,
										'description' => esc_html__( 'Taxonomy values', 'textron' ),
										'dependency' => Array(
											'element' => 'type', 'value' => array('attribute'),
										)
									),

								/* custom
								----*/

									array(
										'type' => 'textfield',
										'heading' => esc_html__( 'Products', 'textron' ),
										'value' => '',
										'param_name' => 'ids',
										'save_always' => true,
										'description' => esc_html__( 'Enter comma separated products ids', 'textron' ),
										'dependency' => Array(
											'element' => 'type', 'value' => array('custom'),
										)
									),
				    		)
				    	));

					/* et_woo_categories
					----*/

						vc_map(array(
				    		'name'                    => esc_html__('Woocommerce categories','textron'),
				    		'description'             => esc_html__('Use this element to add product categories','textron'),
				    		'category'                => array(esc_html__('Enovathemes','textron'),esc_html__('WooCommerce','textron')),
				    		'base'                    => 'et_woo_categories',
				    		'class'                   => 'et_woo_categories',
				    		'icon'                    => 'et_woo_categories',
				    		'show_settings_on_create' => true,
				    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-woo-category.js',
				    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-woo-category.js',
				    		'params'                  => array(
				    			array(
									'param_name'=>'layout',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Layout', 'textron'),
									'value'     => array(
										esc_html__('Grid', 'textron')     => 'grid',
										esc_html__('Carousel', 'textron') => 'carousel',
									)
								),
								array(
									'param_name'=>'navigation_type',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Navigation type', 'textron'),
									'value'     => array(
										esc_html__('Only arrows','textron')  => 'arrows',
										esc_html__('Only dottes','textron')  => 'dottes',
										esc_html__('Both arrows and dottes','textron')  => 'both',
									),
									'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
								),
								array(
									'param_name'=>'autoplay',
									'type'      => 'dropdown',
									'heading'   => esc_html__('Autoplay', 'textron'),
									'value'     => $logic_values,
									'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
								),
								array(
								'type' => 'dropdown',
									'heading'     => esc_html__( 'Columns', 'textron' ),
									'value'       => $size_values_box,
									'param_name'  => 'columns',
									'save_always' => true
								),
								array(
									'type' => 'textfield',
									'heading' => esc_html__( 'Category', 'textron' ),
									'value' => '',
									'param_name' => 'category',
									'save_always' => true,
									'description' => esc_html__( 'Enter comma separated category IDs if you want to show certain categories', 'textron' ),
								),
								array(
									'type' => 'dropdown',
									'heading' => esc_html__( 'Order by', 'textron' ),
									'param_name' => 'orderby',
									'value' => array(
										esc_html__( 'Date', 'textron' ) => 'date',
										esc_html__( 'ID', 'textron' ) => 'ID',
										esc_html__( 'Menu order', 'textron' ) => 'menu_order',
									),
									'save_always' => true,
									'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'textron' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
								),
								array(
									'type' => 'dropdown',
									'heading' => esc_html__( 'Sort order', 'textron' ),
									'param_name' => 'order',
									'value' => $order_way_values,
									'save_always' => true,
									'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'textron' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
								),
				    		)
				    	));

				}

			/* POSTS
			----*/

				/* et_posts
				----*/

			    	vc_map(array(
			    		'name'                    => esc_html__('Posts','textron'),
			    		'description'             => esc_html__('Use this element to add posts','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_posts',
			    		'class'                   => 'et_posts',
			    		'icon'                    => 'et_posts',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-post.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-post.js',
			    		'params'                  => array(
			    			array(
								'param_name'=>'layout',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Layout', 'textron'),
								'value'     => array(
									esc_html__('Grid', 'textron')     => 'grid',
									esc_html__('List', 'textron')     => 'list',
									esc_html__('Carousel', 'textron') => 'carousel',
									esc_html__('Full', 'textron')     => 'full',
								)
							),
							array(
								'param_name'=>'orientation',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Orientation', 'textron'),
								'value'     => array(
									esc_html__('Landscape', 'textron') => 'landscape',
									esc_html__('Portrait', 'textron')  => 'portrait',
								),
								'dependency' => Array('element' => 'layout', 'value' => array('full'))
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Body color','textron'),
								'param_name' => 'body_color',
								'value'      => '#ffffff',
								'dependency' => Array('element' => 'layout', 'value' => array('full'))
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Text color','textron'),
								'param_name' => 'text_color',
								'value'      => '',
								'dependency' => Array('element' => 'layout', 'value' => array('full'))
							),
							array(
								'param_name'=>'navigation_type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Navigation type', 'textron'),
								'value'     => array(
									esc_html__('Only arrows','textron')  => 'arrows',
									esc_html__('Only dottes','textron')  => 'dottes',
									esc_html__('Both arrows and dottes','textron')  => 'both',
								),
								'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
							),
							array(
								'param_name'=>'autoplay',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Autoplay', 'textron'),
								'value'     => $logic_values,
								'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Quantity', 'textron' ),
								'value' => 12,
								'save_always' => true,
								'param_name' => "quantity",
								'description' => esc_html__( 'The "quantity" shortcode determines how many posts to show', 'textron' ),
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Category', 'textron' ),
								'value' => '',
								'param_name' => 'category',
								'save_always' => true,
								'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'textron' ),
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Operator', 'textron' ),
								'param_name' => 'operator',
								'value' => $operator_values,
								'save_always' => true,
								'description' => esc_html__( 'Select filter operator', 'textron' ),
								'dependency' => Array('element' => 'category', 'not_empty' => true)
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Order by', 'textron' ),
								'param_name' => 'orderby',
								'value' => $order_by_values,
								'save_always' => true,
								'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'textron' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Sort order', 'textron' ),
								'param_name' => 'order',
								'value' => $order_way_values,
								'save_always' => true,
								'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'textron' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Post excerpt length', 'textron' ),
								'value' => '104',
								'param_name' => 'excerpt',
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Post title length', 'textron' ),
								'value' => '46',
								'param_name' => 'title_length',
							),

							/* element_css
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Element id','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_id',
									'value'      => '',
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__('Element css','textron'),
									"class"      => "element-attr-hide",
									'param_name' => 'element_css',
									'value'      => '',
								),
			    		)
			    	));

				/* et_projects
				----*/

					$cat_args = array(
						'orderby'    => 'name',
					    'order'      => 'asc',
					    'hide_empty' => false
					);

					$category_values = array();
					$category_list   = get_terms( 'project-category', $cat_args );
					if( !empty($category_list) ){

					    foreach ($category_list as $category) {
					    	if ($category->parent) {
					    		$category_values[' - '.$category->name] = $category->slug;
					    	} else {
					    		$category_values[$category->name] = $category->slug;
					    	}
					    }
					}

					if(function_exists('wc_get_attribute_taxonomies')){

						$attributes_tax = wc_get_attribute_taxonomies();
						$attributes = array();
						foreach ( $attributes_tax as $attribute ) {
							$attributes[ $attribute->attribute_label ] = $attribute->attribute_name;
						}

					}

					$project_cat = array(
						esc_html__('All','textron')  => 'all',
					);

					$args = array(
					    'orderby'           => 'name',
					    'order'             => 'ASC',
					    'hide_empty'        => true,
					    'exclude'           => array(),
					    'exclude_tree'      => array(),
					    'number'            => '',
					    'fields'            => 'all',
					    'slug'              => '',
					    'parent'            => '',
					    'hierarchical'      => false,
					    'child_of'          => 0,
					    'get'               => '',
					    'name__like'        => '',
					    'description__like' => '',
					    'pad_counts'        => false,
					    'offset'            => '',
					    'search'            => '',
					    'cache_domain'      => 'core'
					);
					$tax_terms = get_terms('project-category');

					if (count($tax_terms) != 0){
		            	foreach(get_terms('project-category',$args) as $filter_term){
		        			$filter_count    = $filter_term->count;
		        			$filter_children = get_term_children( $filter_term->term_id, 'project-category' );
		        			if(is_array($filter_children) && !empty($filter_children)) {
		        				foreach ($filter_children as $filter_child) {
		        					$filter_child_obj = get_term($filter_child, 'project-category');
		        					$filter_count = $filter_count + $filter_child_obj->count;
		        				}
		        			}

		        			$project_cat[$filter_term->name] = $filter_term->slug;
			            }
					}

			    	vc_map(array(
			    		'name'                    => esc_html__('Projects','textron'),
			    		'description'             => esc_html__('Use this element to add projects','textron'),
			    		'category'                => esc_html__('Enovathemes','textron'),
			    		'base'                    => 'et_projects',
			    		'class'                   => 'et_projects',
			    		'icon'                    => 'et_projects',
			    		'show_settings_on_create' => true,
			    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-project.js',
			    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-project.js',
			    		'params'                  => array(
			    			
			    			array(
								'param_name'=>'layout',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Layout', 'textron'),
								'value'     => array(
									esc_html__('Grid', 'textron')     => 'grid',
									esc_html__('List', 'textron')     => 'list',
									esc_html__('Full', 'textron')     => 'full',
									esc_html__('Carousel', 'textron') => 'carousel',
								)
							),
							array(
								'param_name'=>'navigation_type',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Navigation type', 'textron'),
								'value'     => array(
									esc_html__('Only arrows','textron')  => 'arrows',
									esc_html__('Only dottes','textron')  => 'dottes',
									esc_html__('Both arrows and dottes','textron')  => 'both',
								),
								'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
							),
							array(
								'param_name'=>'autoplay',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Autoplay', 'textron'),
								'value'     => $logic_values,
								'dependency' => Array('element' => 'layout', 'value' => array('carousel'))
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Quantity', 'textron' ),
								'value' => 12,
								'save_always' => true,
								'param_name' => "quantity",
								'description' => esc_html__( 'The "quantity" shortcode determines how many projects to show', 'textron' ),
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Category', 'textron' ),
								'value' => '',
								'param_name' => 'category',
								'save_always' => true,
								'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'textron' ),
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Operator', 'textron' ),
								'param_name' => 'operator',
								'value' => $operator_values,
								'save_always' => true,
								'description' => esc_html__( 'Select filter operator', 'textron' ),
								'dependency' => Array('element' => 'category', 'not_empty' => true)
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Order by', 'textron' ),
								'param_name' => 'orderby',
								'value' => $order_by_values,
								'save_always' => true,
								'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'textron' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Sort order', 'textron' ),
								'param_name' => 'order',
								'value' => $order_way_values,
								'save_always' => true,
								'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'textron' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
							),
							array(
			    				'type'       => 'checkbox',
								'heading'    => esc_html__('Project filter', 'textron'),
								'param_name' => 'project_filter',
								'value'      => '',
								'description'=> esc_html__('Check this option if you want to have AJAX category filter (Make sure the Category field is empty)', 'textron'),
								'dependency' => Array(
									'element' => 'layout', 'value' => array('grid','list','full'),
								)
							),
							array(
								'param_name'=>'default_filter',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Define default filter', 'textron'),
								'value'     => $project_cat,
								'dependency' => Array('element' => 'project_filter', 'value' => 'true')
							),
			    		)
			    	));

		/* HEADER BUILDER
		----*/

			$vc_menu_categories = array(
				esc_html__('Desktop header','textron'),
				esc_html__('Mobile header','textron'),
				esc_html__('Sidebar header','textron')
			);

			/* et_header_logo
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Header logo','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories,
		    		'base'                    => 'et_header_logo',
		    		'class'                   => 'et_header_logo hbe',
		    		'icon'                    => 'et_header_logo',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-logo.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-logo.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended,
							'default' => 'left'
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* static header
						----*/

							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Normal logo','textron'),
								'group'      => esc_html__('Default logo','textron'),
								'param_name' => 'logo',
							),

							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Retina logo (twice the width and height of normal logo)','textron'),
								'group'      => esc_html__('Default logo','textron'),
								'description'=> esc_html__('Ignore if your logo has SVG format','textron'),
								'param_name' => 'retina_logo',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Width (without any string)','textron'),
								'group'      => esc_html__('Default logo','textron'),
								'param_name' => 'width',
								'value'      => '148',
							),

						/* sticky header
						----*/

							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Normal logo','textron'),
								'group'      => esc_html__('Sticky logo','textron'),
								'param_name' => 'sticky_logo',
							),

							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Retina logo (twice the width and height of normal logo)','textron'),
								'group'      => esc_html__('Sticky logo','textron'),
								'description'=> esc_html__('Ignore if your logo has SVG format','textron'),
								'param_name' => 'sticky_retina_logo',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Width (without any string)','textron'),
								'group'      => esc_html__('Sticky logo','textron'),
								'param_name' => 'sticky_width',
								'value'      => '',
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    		)
		    	));

			/* et_header_menu
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Header navigation menu','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories[0],
		    		'base'                    => 'et_header_menu',
		    		'class'                   => 'et_header_menu hbe font',
		    		'icon'                    => 'et_header_menu',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-menu.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-menu.js',
		    		'params'                  => array(
		    			array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Menu name','textron'),
							'param_name' => 'menu',
							'value'      => $menu_list,
							'default'    => 'choose'
						),
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('One page layout navigation','textron'),
							'description' => esc_html__('If you want yo use this menu as one page layout navigation, check this option.', 'textron'),
							'param_name' => 'one_page',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('One page navigation offset in px (without any string)','textron'),
							'param_name' => 'offset',
							'value'      => '0',
							'dependency' => Array('element' => 'one_page', 'value' => "true")
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* top level
						----*/

							/* styling
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Space between menu items in px (without any string)','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_space',
									'value'      => '40',
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Items separator','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_separator',
									'value'      => $logic_values
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Items separator color','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_separator_color',
									'value'      => '#e0e0e0',
									'dependency' => Array('element' => 'menu_separator', 'value' => 'true')
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Items separator height (without any string)','textron'),
									'description'=> esc_html__('Leave blank if you want 100% height','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_separator_height',
									'value'      => '',
									'dependency' => Array('element' => 'menu_separator', 'value' => 'true')
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu indicator','textron'),
									'group'      => 'Top level',
									'param_name' => 'submenu_indicator',
									'value'      => $logic_values
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu color','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu color hover','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_color_hover',
									'value'      => $main_color,
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Menu hover effect','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_hover',
									'value'      => array(
										esc_html__('None','textron')      => 'none',
										esc_html__('Underline','textron') => 'underline',
										esc_html__('Overline','textron')  => 'overline',
										esc_html__('Outline','textron')   => 'outline',
										esc_html__('Box','textron')       => 'box',
										esc_html__('Fill','textron')      => 'fill',
									),
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu hover effect color','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_effect_color',
									'value'      => '',
									'dependency' => Array('element' => 'menu_hover', 'value' => array('underline','overline','outline','box','fill'))
								),

							/* typography
							----*/

								array(
									'param_name'=>'font_family',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font family', 'textron'),
									'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
									'value'     => $google_fonts_family,
								),
								array(
									'param_name'=>'font_weight',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font weight', 'textron'),
									'value'     => $font_weight_values,
									'std'       => '700'
								),
								array(
									'param_name'=>'font_subsets',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font subsets', 'textron'),
									'value'      => array(
										'latin' => 'latin',
									)
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Font size (without any string)','textron'),
									'group'      => esc_html__('Top level','textron'),
									'param_name' => 'font_size',
									'value'      => '16',
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Top level','textron'),
									'heading'    => esc_html__('Letter spacing (without any string)','textron'),
									'param_name' => 'letter_spacing',
									'value'      => ''
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Text transform','textron'),
									'group'      => 'Top level',
									'param_name' => 'text_transform',
									'value'      => array(
										esc_html__('None','textron')       => 'none',
										esc_html__('Uppercase','textron')  => 'uppercase',
										esc_html__('Lowercase','textron')  => 'lowercase',
										esc_html__('Capitalize','textron') => 'capitalize',
									)
								),

						/* submenu
						----*/

							/* styling
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Offset','textron'),
									'description'=> esc_html__('Leave blank to have 100% offset','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenuoffset',
									'value'      => '',
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu color','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu color hover','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_color_hover',
									'value'      => $main_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu background color','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_back_color',
									'value'      => '#ffffff',
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu background color hover','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_back_color_hover',
									'value'      => '',
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu shadow','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_shadow',
									'value'      => $logic_values
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu indicator','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_submenu_indicator',
									'value'      => $logic_values
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu items separator','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_separator',
									'value'      => $logic_values
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu appear effect','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_appear',
									'value'      => array(
										esc_html__('Default','textron')   => 'none',
										esc_html__('Fade','textron')      => 'fade',
									),
								),


							/* typography
							----*/

								array(
									'param_name'=>'subfont_family',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font family', 'textron'),
									'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
									'value'     => $google_fonts_family,
								),
								array(
									'param_name'=>'subfont_weight',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font weight', 'textron'),
									'value'     => $font_weight_values
								),
								array(
									'param_name'=>'subfont_subsets',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font subsets', 'textron'),
									'value'      => array(
										'latin' => 'latin',
									)
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Submenu font size (without any string)','textron'),
									'group'      => esc_html__('Submenu','textron'),
									'param_name' => 'subfont_size',
									'value'      => '16',
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Submenu','textron'),
									'heading'    => esc_html__('Submenu letter spacing (without any string)','textron'),
									'param_name' => 'subletter_spacing',
									'value'      => ''
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu text transform','textron'),
									'group'      => 'Submenu',
									'param_name' => 'subtext_transform',
									'value'      => array(
										esc_html__('None','textron')       => 'none',
										esc_html__('Uppercase','textron')  => 'uppercase',
										esc_html__('Lowercase','textron')  => 'lowercase',
										esc_html__('Capitalize','textron') => 'capitalize',
									)
								),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'subelement_font',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

						/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_megamenu
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Megamenu','textron'),
		    		'description'             => esc_html__('Use only with megamenu builder','textron'),
		    		'category'                => $vc_menu_categories[0],
		    		'base'                    => 'et_megamenu',
		    		'class'                   => 'et_megamenu hbe font',
		    		'icon'                    => 'et_megamenu',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-megamenu.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-megamenu.js',
		    		'params'                  => array(
		    			array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Menu name','textron'),
							'param_name' => 'menu',
							'value'      => $menu_list,
						),
						array(
							'param_name'=>'columns',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Column', 'textron'),
							'value'     => array(
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6'
							)
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* top level
						----*/

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu color','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu color hover','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_color_hover',
									'value'      => $main_color,
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Megamenu top level item border-bottom color','textron'),
									'group'      => 'Top level',
									'param_name' => 'megamenu_border_color',
									'value'      => '',
								),

							/* typography
							----*/

								array(
									'param_name'=>'font_family',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font family', 'textron'),
									'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
									'value'     => $google_fonts_family,
								),
								array(
									'param_name'=>'font_weight',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font weight', 'textron'),
									'value'     => $font_weight_values,
									'std'       => '700'
								),
								array(
									'param_name'=>'font_subsets',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font subsets', 'textron'),
									'value'      => array(
										'latin' => 'latin',
									)
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Font size (without any string)','textron'),
									'group'      => esc_html__('Top level','textron'),
									'param_name' => 'font_size',
									'value'      => '16',
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Top level','textron'),
									'heading'    => esc_html__('Letter spacing (without any string)','textron'),
									'param_name' => 'letter_spacing',
									'value'      => ''
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Text transform','textron'),
									'group'      => 'Top level',
									'param_name' => 'text_transform',
									'value'      => array(
										esc_html__('None','textron')       => 'none',
										esc_html__('Uppercase','textron')  => 'uppercase',
										esc_html__('Lowercase','textron')  => 'lowercase',
										esc_html__('Capitalize','textron') => 'capitalize',
									)
								),

						/* submenu
						----*/

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu color','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu color hover','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_color_hover',
									'value'      => $main_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu background color hover','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_back_color_hover',
									'value'      => '',
								),

								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu items separator','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_separator',
									'value'      => $logic_values
								),

							/* typography
							----*/

								array(
									'param_name'=>'subfont_family',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font family', 'textron'),
									'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
									'value'     => $google_fonts_family,
								),
								array(
									'param_name'=>'subfont_weight',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font weight', 'textron'),
									'value'     => $font_weight_values
								),
								array(
									'param_name'=>'subfont_subsets',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font subsets', 'textron'),
									'value'      => array(
										'latin' => 'latin',
									)
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Submenu font size (without any string)','textron'),
									'group'      => esc_html__('Submenu','textron'),
									'param_name' => 'subfont_size',
									'value'      => '',
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Submenu','textron'),
									'heading'    => esc_html__('Submenu letter spacing (without any string)','textron'),
									'param_name' => 'subletter_spacing',
									'value'      => ''
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Submenu','textron'),
									'heading'    => esc_html__('Submenu line height (without any string)','textron'),
									'param_name' => 'subline_height',
									'value'      => '22'
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu text transform','textron'),
									'group'      => 'Submenu',
									'param_name' => 'subtext_transform',
									'value'      => array(
										esc_html__('None','textron')       => 'none',
										esc_html__('Uppercase','textron')  => 'uppercase',
										esc_html__('Lowercase','textron')  => 'lowercase',
										esc_html__('Capitalize','textron') => 'capitalize',
									)
								),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => '32,0,16,0'
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'subelement_font',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    		)
		    	));

			/* et_megamenu_tab
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Megamenu tab','textron'),
		    		'description'             => esc_html__('Use only with megamenu builder','textron'),
		    		'category'                => $vc_menu_categories[0],
		    		'base'                    => 'et_megamenu_tab',
		    		'class'                   => 'et_megamenu_tab hbe font',
		    		'icon'                    => 'et_megamenu_tab',
		    		'as_parent'               => array('only' => 'et_megamenu_tab_item'),
		    		'content_element'         => true,
		    		'show_settings_on_create' => true,
		    		'is_container'            => true,
		    		'js_view'                 => 'VcColumnView',
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-megamenu-tab.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-megamenu-tab.js',
		    		'params'                  => array(
						array(
							'param_name'=>'size',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Tabs size', 'textron'),
							'value'     => $size_values_box
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),
						array(
							'param_name'=>'action',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Toggle on', 'textron'),
							'value'     => array(
								esc_html__('On click','textron')  => 'click',
								esc_html__('On hover','textron')  => 'hover',
							)
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Tabset background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'tabset_color',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Tab content background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'tab_content_color',
								'value'      => '#f5f5f5',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Menu color','textron'),
								'group'      => 'Styling',
								'param_name' => 'menu_color',
								'value'      => $secondory_color,
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Menu color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'menu_color_hover',
								'value'      => $main_color,
							),

						/* typography
						----*/

							array(
								'param_name'=>'font_family',
								'type'      => 'dropdown',
								'group'     => esc_html__('Typography','textron'),
								'heading'   => esc_html__('Font family', 'textron'),
								'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
								'value'     => $google_fonts_family,
							),
							array(
								'param_name'=>'font_weight',
								'type'      => 'dropdown',
								'group'     => esc_html__('Typography','textron'),
								'heading'   => esc_html__('Font weight', 'textron'),
								'value'     => $font_weight_values,
								'std'       => '700'
							),
							array(
								'param_name'=>'font_subsets',
								'type'      => 'dropdown',
								'group'     => esc_html__('Typography','textron'),
								'heading'   => esc_html__('Font subsets', 'textron'),
								'value'      => array(
									'latin' => 'latin',
								)
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Font size (without any string)','textron'),
								'group'      => esc_html__('Typography','textron'),
								'param_name' => 'font_size',
								'value'      => '16',
							),
							array(
								'type'       => 'textfield',
								'group'      => esc_html__('Typography','textron'),
								'heading'    => esc_html__('Letter spacing (without any string)','textron'),
								'param_name' => 'letter_spacing',
								'value'      => ''
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Text transform','textron'),
								'group'      => 'Typography',
								'param_name' => 'text_transform',
								'value'      => array(
									esc_html__('None','textron')       => 'none',
									esc_html__('Uppercase','textron')  => 'uppercase',
									esc_html__('Lowercase','textron')  => 'lowercase',
									esc_html__('Capitalize','textron') => 'capitalize',
								)
							),

						/* padding
						----*/

							array(
								'type'       => 'padding',
								'group'      => esc_html__('Padding','textron'),
								'heading'    => esc_html__('Padding','textron'),
								'param_name' => 'padding',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

				vc_map(array(
					'name'                    => esc_html__('Megamenu tab item','textron'),
					'category'                => $vc_menu_categories[0],
					'base'                    => 'et_megamenu_tab_item',
					'class'                   => 'et_megamenu_tab_item hbe',
					'icon'                    => 'et_megamenu_tab_item',
					'as_child'                => array('only' => 'et_megamenu_tab'),
					"as_parent"               => array('except' => 'vc_section'),
					'content_element'         => true,
					"js_view"                 => 'VcColumnView',
					'show_settings_on_create' => true,
					'params'                  => array(
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Active','textron'),
							'param_name' => 'active',
							'value'      => array(
								'false' => 'false',
								'true'  => 'true'
							)
						),
						
						array(
		    				'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => ''
						),

						array(
							'type'       => 'attach_image',
							'heading'    => esc_html__('Icon','textron'),
							'param_name' => 'icon',
							'value'      => '',
						)
					)
				));

			/* et_search_toggle
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Search toggle','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => array($vc_menu_categories[0],$vc_menu_categories[1]),
		    		'base'                    => 'et_search_toggle',
		    		'class'                   => 'et_search_toggle hbe',
		    		'icon'                    => 'et_search_toggle',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-search-toggle.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-search-toggle.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => '#000000',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_border_color',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Icon border width in px (without any string)','textron'),
								'param_name' => 'icon_border_width',
							),

						/* searchbox
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Search box color','textron'),
								'group'      => 'Search box',
								'param_name' => 'search_color',
								'value'      => '#616161',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Search box background color','textron'),
								'group'      => 'Search box',
								'param_name' => 'search_background_color',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Search box',
								'param_name' => 'search_icon_color',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Search box',
								'param_name' => 'search_icon_background_color',
								'value'      => $secondory_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color hover','textron'),
								'group'      => 'Search box',
								'param_name' => 'search_icon_background_color_hover',
								'value'      => $main_color,
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    			/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_search_form
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Search form','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories,
		    		'base'                    => 'et_search_form',
		    		'class'                   => 'et_search_form hbe',
		    		'icon'                    => 'et_search_form',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-search-form.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-search-form.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => '#bdbdbd',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color_hover',
								'value'      => $secondory_color,
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color_hover',
								'value'      => '',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_border_color',
								'value'      => '',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_border_color_hover',
								'value'      => '',
							),

						/* searchbox
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Search box width in px (without any string)','textron'),
								'group'      => 'Styling',
								'param_name' => 'search_width',
								'value'      => '256',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Search box color','textron'),
								'group'      => 'Styling',
								'param_name' => 'search_color',
								'value'      => '#616161',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Search box background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'search_background_color',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Search box border color','textron'),
								'group'      => 'Styling',
								'param_name' => 'search_border_color',
								'value'      => '#e0e0e0',
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

						/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_cart_toggle
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Cart toggle','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => array($vc_menu_categories[0],$vc_menu_categories[1]),
		    		'base'                    => 'et_cart_toggle',
		    		'class'                   => 'et_cart_toggle hbe',
		    		'icon'                    => 'et_cart_toggle',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-cart-toggle.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-cart-toggle.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => '#000000',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_border_color',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Icon border width in px (without any string)','textron'),
								'param_name' => 'icon_border_width',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Bubble color','textron'),
								'group'      => 'Styling',
								'param_name' => 'bubble_color',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Bubble background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'bubble_background_color',
								'value'      => $main_color,
							),

						/* cartbox
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Cart box product title color','textron'),
								'group'      => 'Cart box',
								'param_name' => 'cart_title_color',
								'value'      => $secondory_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Cart box text color','textron'),
								'group'      => 'Cart box',
								'param_name' => 'cart_color',
								'value'      => '#616161',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Cart box button color','textron'),
								'group'      => 'Cart box',
								'param_name' => 'cart_button_color',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Cart box button color hover','textron'),
								'group'      => 'Cart box',
								'param_name' => 'cart_button_color_hover',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Cart box button background color','textron'),
								'group'      => 'Cart box',
								'param_name' => 'cart_button_background_color',
								'value'      => $main_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Cart box button background color hover','textron'),
								'group'      => 'Cart box',
								'param_name' => 'cart_button_background_color_hover',
								'value'      => $secondory_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Cart box background color','textron'),
								'group'      => 'Cart box',
								'param_name' => 'cart_background_color',
								'value'      => '#ffffff',
							),
							array(
								'param_name'=>'box_align',
								'type'      => 'dropdown',
								'group'      => 'Cart box',
								'heading'   => esc_html__('Align', 'textron'),
								'value'     => array(
									esc_html__('Left','textron')  => 'left',
									esc_html__('Right','textron') => 'right',
								)
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

						/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_language_switcher
			----*/

				vc_map(array(
		    		'name'                    => esc_html__('Language switcher','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => array($vc_menu_categories[0],$vc_menu_categories[1]),
		    		'base'                    => 'et_language_switcher',
		    		'class'                   => 'et_language_switcher hbe',
		    		'icon'                    => 'et_language_switcher',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-language-switcher.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-language-switcher.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => '#000000',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_border_color',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Icon border width in px (without any string)','textron'),
								'param_name' => 'icon_border_width',
							),

						/* submenu
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Submenu color','textron'),
								'group'      => 'Submenu',
								'param_name' => 'submenu_color',
								'value'      => $secondory_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Submenu color hover','textron'),
								'group'      => 'Submenu',
								'param_name' => 'submenu_color_hover',
								'value'      => $main_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Submenu background color','textron'),
								'group'      => 'Submenu',
								'param_name' => 'submenu_background_color',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Submenu background color hover','textron'),
								'group'      => 'Submenu',
								'param_name' => 'submenu_background_color_hover',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Submenu  width in px (without any string)','textron'),
								'group'      => 'Submenu',
								'param_name' => 'submenu_width',
								'value'      => '200',
							),
							array(
								'param_name'=>'box_align',
								'group'      => 'Submenu',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Align', 'textron'),
								'value'     => array(
									esc_html__('Center','textron')  => 'center',
									esc_html__('Left','textron')  => 'left',
									esc_html__('Right','textron') => 'right',
								)
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    			/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_login_toggle
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Front-end login','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => array($vc_menu_categories[0],$vc_menu_categories[1]),
		    		'base'                    => 'et_login_toggle',
		    		'class'                   => 'et_login_toggle hbe',
		    		'icon'                    => 'et_login_toggle',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-login-toggle.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-login-toggle.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Registration page link','textron'),
							'param_name' => 'registration_link',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Password recovery page','textron'),
							'param_name' => 'forgot_link',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => '#000000',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_border_color',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Icon border width in px (without any string)','textron'),
								'param_name' => 'icon_border_width',
							),

						/* loginbox
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Login box text color','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_color',
								'value'      => '#616161',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Login box background color','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_background_color',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Login box input border color','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_border_color',
								'value'      => '#e0e0e0',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Login box button color','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_button_color',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Login box button color hover','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_button_color_hover',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Login box button background color','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_button_background_color',
								'value'      => $main_color,
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Login box button background color hover','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_button_background_color_hover',
								'value'      => $secondory_color,
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Login box button border width in px (without any string)','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_button_border_width',
								'value'      => '',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Login box button border color','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_button_border_color',
								'value'      => '',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Login box button border color hover','textron'),
								'group'      => 'Login box',
								'param_name' => 'login_button_border_color_hover',
								'value'      => '',
							),
							array(
								'param_name'=>'box_align',
								'type'      => 'dropdown',
								'group'     => 'Login box',
								'heading'   => esc_html__('Align', 'textron'),
								'value'     => array(
									esc_html__('Left','textron')  => 'left',
									esc_html__('Right','textron') => 'right',
								)
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    			/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_header_slogan
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Slogan','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories,
		    		'base'                    => 'et_header_slogan',
		    		'class'                   => 'et_header_slogan hbe',
		    		'icon'                    => 'et_header_slogan',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-slogan.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-slogan.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Max width (without any string)','textron'),
							'param_name' => 'max_width',
							'value'      => '',
						),
						array(
							'type'       => 'textarea_html',
							'heading'    => esc_html__('Content','textron'),
							'param_name' => 'content',
							'value'      => '',
						),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    			/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_header_social_links
			----*/

				foreach ($social_links_array as $social) {
					vc_add_param('et_header_social_links', array(
						'type'       => 'textfield',
						'heading'    => ucfirst($social).' link',
						'param_name' => $social,
						'value'      => '',
						'weight' => 1
					));
				}

		    	vc_map(array(
					'name'                    => esc_html__('Social links','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories,
		    		'base'                    => 'et_header_social_links',
		    		'class'                   => 'et_header_social_links hbe',
		    		'icon'                    => 'et_header_social_links',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-social-links.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-social-links.js',
					'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),
						array(
							'param_name'=>'target',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Target', 'textron'),
							'value'     => array(
								'_self'  => '_self',
								'_blank' => '_blank'
							)
						),

						/* styling
						----*/

							array(
								'param_name'=>'styling_original',
								'type'      => 'dropdown',
								'group'     => esc_html__('Styling','textron'),
								'heading'   => esc_html__('Original styling', 'textron'),
								'value'     => $logic_values
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'     => esc_html__('Styling','textron'),
								'param_name' => 'icon_color',
								'value'      => $secondory_color,
								'dependency' => Array('element' => 'styling_original', 'value' => 'false')
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color hover','textron'),
								'group'     => esc_html__('Styling','textron'),
								'param_name' => 'icon_color_hover',
								'value'      => $main_color,
								'dependency' => Array('element' => 'styling_original', 'value' => 'false')
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'     => esc_html__('Styling','textron'),
								'param_name' => 'icon_background_color',
								'value'      => '',
								'dependency' => Array('element' => 'styling_original', 'value' => 'false')
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color hover','textron'),
								'group'     => esc_html__('Styling','textron'),
								'param_name' => 'icon_background_color_hover',
								'value'      => '',
								'dependency' => Array('element' => 'styling_original', 'value' => 'false')
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color','textron'),
								'group'     => esc_html__('Styling','textron'),
								'param_name' => 'icon_border_color',
								'value'      => '',
								'dependency' => Array('element' => 'styling_original', 'value' => 'false')
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color hover','textron'),
								'group'     => esc_html__('Styling','textron'),
								'param_name' => 'icon_border_color_hover',
								'value'      => '',
								'dependency' => Array('element' => 'styling_original', 'value' => 'false')
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Icon border width (without any string)','textron'),
								'group'     => esc_html__('Styling','textron'),
								'param_name' => 'icon_border_width',
								'dependency' => Array('element' => 'styling_original', 'value' => 'false')
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Size','textron'),
								'group'      => 'Styling',
								'param_name' => 'size',
								'value'      => array(
									esc_html__('Small','textron')  => 'small',
									esc_html__('Medium','textron') => 'medium',
									esc_html__('Large','textron')  => 'large',
									esc_html__('Custom','textron')  => 'custom',
								),
								'std' => 'medium'
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Icon size in px (without any string)','textron'),
								'param_name' => 'icon_size',
								'value'      => '',
								'dependency' => Array('element' => 'size', 'value' => 'custom')
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Icon box size in px (without any string)','textron'),
								'param_name' => 'icon_box_size',
								'value'      => '',
								'dependency' => Array('element' => 'size', 'value' => 'custom')
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

						/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
					)
				));

			/* et_header_icon
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Header icon','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories,
		    		'base'                    => 'et_header_icon',
		    		'class'                   => 'et_header_icon hbe',
		    		'icon'                    => 'et_header_icon',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-icon.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-icon.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						array(
							'type'       => 'attach_image',
							'heading'    => esc_html__('Icon','textron'),
							'param_name' => 'icon',
							'value'      => '',
						),

						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Icon link','textron'),
							'param_name' => 'icon_link',
							'value'      => '',
						),

						array(
							'param_name'=>'target',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Target', 'textron'),
							'value'     => array(
								'_self'  => '_self',
								'_blank' => '_blank'
							),
							'dependency' => Array('element' => 'icon_link', 'not_empty' => true)
						),

						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Elastic click','textron'),
							'param_name' => 'click',
							'value'      => $logic_values
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => '#000000',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color_hover',
								'value'      => $main_color,
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color_hover',
								'value'      => '',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_border_color',
								'value'      => '',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon border color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_border_color_hover',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Icon border width in px (without any string)','textron'),
								'param_name' => 'icon_border_width',
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Size','textron'),
								'group'      => 'Styling',
								'param_name' => 'size',
								'value'      => array(
									esc_html__('Small','textron')  => 'small',
									esc_html__('Medium','textron') => 'medium',
									esc_html__('Large','textron')  => 'large',
									esc_html__('Custom','textron')  => 'custom',
								),
								'std' => 'medium'
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Icon size in px (without any string)','textron'),
								'param_name' => 'icon_size',
								'value'      => '',
								'dependency' => Array('element' => 'size', 'value' => 'custom')
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Icon box size in px (without any string)','textron'),
								'param_name' => 'icon_box_size',
								'value'      => '',
								'dependency' => Array('element' => 'size', 'value' => 'custom')
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    			/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_header_vertical_separator
			----*/

		    	vc_map(array(
					'name'                    => esc_html__('Vertical separator','textron'),
					'description'             => esc_html__('Use only with header builder','textron'),
					'category'                => $vc_menu_categories,
					'base'                    => 'et_header_vertical_separator',
		    		'class'                   => 'et_header_vertical_separator hbe',
		    		'icon'                    => 'et_header_vertical_separator',
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-vertical-separator.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-vertical-separator.js',
					'show_settings_on_create' => true,
					'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Type','textron'),
							'param_name' => 'type',
							'value'      => array(
								esc_html__('solid','textron')  => 'solid',
								esc_html__('dotted','textron') => 'dotted',
								esc_html__('dashed','textron') => 'dashed',
							)
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__('Color','textron'),
							'param_name' => 'color',
							'value'      => '#e0e0e0'
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Width (without any string, if you want 100% leave blank)','textron'),
							'param_name' => 'width',
							'value'      => ''
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Height (without any string, if you want 1px leave blank)','textron'),
							'param_name' => 'height',
							'value'      => ''
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => ''
						),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
					)
				));

			/* et_header_button
			----*/

				vc_map(array(
	    			'name'                    => esc_html__('Header button','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories,
		    		'base'                    => 'et_header_button',
		    		'class'                   => 'et_header_button hbe',
		    		'icon'                    => 'et_header_button',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-button.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-header-button.js',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
		    			array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),

						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Button text','textron'),
							'param_name' => 'button_text',
							'value'      => '',
						),

						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Button link','textron'),
							'param_name' => 'button_link',
							'value'      => '',
						),
						array(
							'param_name'=>'target',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Target', 'textron'),
							'value'     => array(
								'_self'  => '_self',
								'_blank' => '_blank'
							)
						),
						array(
		    				'type'       => 'checkbox',
							'heading'    => esc_html__('Open link in modal window?', 'textron'),
							'param_name' => 'button_link_modal',
							'value'      => '',
						),

						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

		    			/* typography
						----*/

							array(
								'param_name'=>'font_family',
								'type'      => 'dropdown',
								'group'     => esc_html__('Typography', 'textron'),
								'heading'   => esc_html__('Font family', 'textron'),
								'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
								'value'     => $google_fonts_family,
							),
							array(
								'param_name'=>'font_weight',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Font weight', 'textron'),
								'group'     => esc_html__('Typography', 'textron'),
								'value'     => $font_weight_values,
								'std'       => '400'
							),
							array(
								'param_name'=>'font_subsets',
								'type'      => 'dropdown',
								'heading'   => esc_html__('Font subsets', 'textron'),
								'group'     => esc_html__('Typography', 'textron'),
								'value'     => array(
									'latin' => 'latin',
								)
							),
			    			array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Button font size (without any string)','textron'),
								'group'      => esc_html__('Typography','textron'),
								'param_name' => 'button_font_size',
								'value'      => '16',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Button letter spacing (without any string)','textron'),
								'group'      => esc_html__('Typography','textron'),
								'param_name' => 'button_letter_spacing',
								'value'      => ''
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Button line height (without any string)','textron'),
								'group'      => esc_html__('Typography','textron'),
								'param_name' => 'button_line_height',
								'value'      => '22'
							),
							array(
								'type'       => 'dropdown',
								'group'   	 => esc_html__('Typography', 'textron'),
								'heading'    => esc_html__('Text transform','textron'),
								'param_name' => 'button_text_transform',
								'value'      => array(
									esc_html__('None','textron')       => 'none',
									esc_html__('Uppercase','textron')  => 'uppercase',
									esc_html__('Lowercase','textron')  => 'lowercase',
									esc_html__('Capitalize','textron') => 'capitalize',
								)
							),

						/* styling
						----*/

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Button size','textron'),
								'group'      => 'Styling',
								'param_name' => 'button_size',
								'value'      => array(
									esc_html__('Small','textron')  => 'small',
									esc_html__('Medium','textron') => 'medium',
									esc_html__('Large','textron')  => 'large',
								),
								'std' => 'medium',
								'dependency' => Array('element' => 'button_size_custom', 'value' => 'false')
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Button custom size','textron'),
								'group'      => 'Styling',
								'param_name' => 'button_size_custom',
								'value'      => $logic_values
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Button width in px (without any string)','textron'),
								'param_name' => 'width',
								'value'      => '220',
								'dependency' => Array('element' => 'button_size_custom', 'value' => 'true')
							),

							array(
								'type'       => 'textfield',
								'group'      => 'Styling',
								'heading'    => esc_html__('Button height in px (without any string)','textron'),
								'param_name' => 'height',
								'value'      => '56',
								'dependency' => Array('element' => 'button_size_custom', 'value' => 'true')
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Button style','textron'),
								'group'      => 'Styling',
								'param_name' => 'button_style',
								'value'      => array(
									esc_html__('Normal','textron')  => 'normal',
									esc_html__('Outline','textron') => 'outline',
								)
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Button type','textron'),
								'group'      => 'Styling',
								'param_name' => 'button_type',
								'value'      => array(
									esc_html__('Round','textron')  => 'round',
									esc_html__('Rounded','textron') => 'rounded',
								)
							),
							array(
			    				'type'       => 'checkbox',
								'heading'    => esc_html__('Button shadow', 'textron'),
								'group'      => esc_html__('Styling','textron'),
								'param_name' => 'button_shadow',
								'value'      => '',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Button color','textron'),
								'group'      => esc_html__('Styling','textron'),
								'param_name' => 'button_color',
								'value'      => $main_color
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Button background color','textron'),
								'group'      => esc_html__('Styling','textron'),
								'param_name' => 'button_back_color',
								'value'      => '#ffffff',
								'dependency' => Array('element' => 'button_style', 'value' => 'normal')
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Button border color','textron'),
								'group'      => esc_html__('Styling','textron'),
								'param_name' => 'button_border_color',
								'value'      => $main_color,
								'dependency' => Array('element' => 'button_style', 'value' => 'outline')
							),

						/* hover
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Button color hover','textron'),
								'group'      => esc_html__('Hover','textron'),
								'param_name' => 'button_color_hover',
								'value'      => '#ffffff'
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Button background color hover','textron'),
								'group'      => esc_html__('Hover','textron'),
								'param_name' => 'button_back_color_hover',
								'value'      => $secondory_color,
								'dependency' => Array('element' => 'button_style', 'value' => 'normal')
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Button border color hover','textron'),
								'group'      => esc_html__('Hover','textron'),
								'param_name' => 'button_border_color_hover',
								'value'      => $secondory_color,
								'dependency' => Array('element' => 'button_style', 'value' => 'outline')
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Hover animation','textron'),
								'group'      => esc_html__('Hover','textron'),
								'param_name' => 'animate_hover',
								'value'      => array(
									esc_html__('Normal','textron')  	  => 'none',
									esc_html__('Fill effect','textron')   => 'fill',
									esc_html__('Scale effect','textron')  => 'scale',
									esc_html__('Move effect','textron')   => 'move',
									esc_html__('Elastic click','textron') => 'click',
								),
								'dependency' => Array('element' => 'button_style', 'value' => 'normal')
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Hover animation','textron'),
								'group'      => esc_html__('Hover','textron'),
								'param_name' => 'animate_hover_outline',
								'value'      => array(
									esc_html__('Normal','textron')  	  => 'none',
									esc_html__('Fill effect','textron')   => 'fill',
									esc_html__('Scale effect','textron')  => 'scale',
								),
								'dependency' => Array('element' => 'button_style', 'value' => 'outline')
							),

						/* click
						----*/

							array(
								'type'       => 'checkbox',
								'heading'    => esc_html__('Smooth Click animation','textron'),
								'group'      => esc_html__('Click','textron'),
								'param_name' => 'click_smooth',
								'value'      => ''
							),

						/* icon
						----*/

							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__('Icon','textron'),
								'group'      => esc_html__('Icon','textron'),
								'param_name' => 'icon',
								'value'      => '',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Icon size (without any string)','textron'),
								'group'      => esc_html__('Icon','textron'),
								'param_name' => 'icon_font_size',
								'value'      => '16',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Icon margin (without any string)','textron'),
								'group'      => esc_html__('Icon','textron'),
								'param_name' => 'icon_margin',
								'value'      => '8',
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Icon position','textron'),
								'group'      => esc_html__('Icon','textron'),
								'param_name' => 'icon_position',
								'value'      => array(
									esc_html__('Left','textron')  => 'left',
									esc_html__('Right','textron')  => 'right',
								)
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

		    			/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
	    		));

			/* et_align_container
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Align container','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => array($vc_menu_categories[1],$vc_menu_categories[2]),
		    		'base'                    => 'et_align_container',
		    		'class'                   => 'et_align_container',
		    		'icon'                    => 'et_align_container',
		    		'show_settings_on_create' => true,
		    		"as_parent"               => array('only' => 'et_gap, et_separator, et_header_button, et_header_icon, et_header_social_links, et_header_slogan, et_search_form, et_header_logo'),
					"js_view"                 => 'VcColumnView',
		    		"content_element"         => true,
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Content align', 'textron'),
							'description' => esc_html__('Align any inside element', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),
		    		)
		    	));

		    /* et_vertical_align_top
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Vertical align top','textron'),
		    		'description'             => esc_html__('Use only with header builder for sidebar and mobile navigation headers','textron'),
		    		'category'                => array($vc_menu_categories[1],$vc_menu_categories[2]),
		    		'base'                    => 'et_vertical_align_top',
		    		'class'                   => 'et_vertical_align_top',
		    		'icon'                    => 'et_vertical_align_top',
		    		'show_settings_on_create' => true,
		    		"as_parent"               => array('only' => 'et_gap, et_separator, et_header_button, et_header_icon, et_header_social_links, et_header_slogan, et_search_form, et_header_logo, et_align_container, et_sidebar_menu, et_mobile_menu'),
					"js_view"                 => 'VcColumnView',
		    		"content_element"         => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),
		    		)
		    	));

		    /* et_vertical_align_middle
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Vertical align middle','textron'),
		    		'description'             => esc_html__('Use only with header builder for sidebar and mobile navigation headers','textron'),
		    		'category'                => array($vc_menu_categories[1],$vc_menu_categories[2]),
		    		'base'                    => 'et_vertical_align_middle',
		    		'class'                   => 'et_vertical_align_middle',
		    		'icon'                    => 'et_vertical_align_middle',
		    		'show_settings_on_create' => true,
		    		"as_parent"               => array('only' => 'et_gap, et_separator, et_header_button, et_header_icon, et_header_social_links, et_header_slogan, et_search_form, et_header_logo, et_align_container, et_sidebar_menu, et_mobile_menu'),
					"js_view"                 => 'VcColumnView',
		    		"content_element"         => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),
		    		)
		    	));

		    /* et_vertical_align_bottom
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Vertical align bottom','textron'),
		    		'description'             => esc_html__('Use only with header builder for sidebar and mobile navigation headers','textron'),
		    		'category'                => array($vc_menu_categories[1],$vc_menu_categories[2]),
		    		'base'                    => 'et_vertical_align_bottom',
		    		'class'                   => 'et_vertical_align_bottom',
		    		'icon'                    => 'et_vertical_align_bottom',
		    		'show_settings_on_create' => true,
		    		"as_parent"               => array('only' => 'et_gap, et_separator, et_header_button, et_header_icon, et_header_social_links, et_header_slogan, et_search_form, et_header_logo, et_align_container, et_sidebar_menu, et_mobile_menu'),
					"js_view"                 => 'VcColumnView',
		    		"content_element"         => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),
		    		)
		    	));

			/* et_mobile_container
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Mobile container','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories[1],
		    		'base'                    => 'et_header_mobile_container',
		    		'class'                   => 'et_header_mobile_container',
		    		'icon'                    => 'et_header_mobile_container',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-container.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-container.js',
		    		"as_parent"               => array('only' => 'et_gap, et_separator, et_header_button, et_header_icon, et_header_social_links, et_header_slogan, et_search_form, et_mobile_menu, et_header_logo,et_align_container, et_mobile_close,et_vertical_align_top,et_vertical_align_middle,et_vertical_align_bottom'),
					"js_view"                 => 'VcColumnView',
		    		"content_element"         => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'background_color',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Default text color','textron'),
								'group'      => 'Styling',
								'param_name' => 'text_color',
								'value'      => '#616161',
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Padding','textron'),
								'heading'    => esc_html__('Padding','textron'),
								'param_name' => 'margin',
								'value'      => '48,32,48,32'
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

		    /* et_mobile_toggle
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Mobile container toggle','textron'),
		    		'description'             => esc_html__('Use only with header builder to toggle the mobile container','textron'),
		    		'category'                => $vc_menu_categories[1],
		    		'base'                    => 'et_mobile_toggle',
		    		'class'                   => 'et_mobile_toggle hbe',
		    		'icon'                    => 'et_mobile_toggle',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-toggle.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-toggle.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => $secondory_color,
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color_hover',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color_hover',
								'value'      => $main_color,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Size','textron'),
								'group'      => 'Styling',
								'param_name' => 'size',
								'value'      => array(
									esc_html__('Small','textron')  => 'small',
									esc_html__('Medium','textron') => 'medium',
									esc_html__('Large','textron')  => 'large',
								),
								'std' => 'medium'
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    			/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_mobile_close
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Mobile container close','textron'),
		    		'description'             => esc_html__('Use only with header builder to close the mobile container','textron'),
		    		'category'                => $vc_menu_categories[1],
		    		'base'                    => 'et_mobile_close',
		    		'class'                   => 'et_mobile_close hbe',
		    		'icon'                    => 'et_mobile_close',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-close.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-close.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => $secondory_color,
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color_hover',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color_hover',
								'value'      => $main_color,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Size','textron'),
								'group'      => 'Styling',
								'param_name' => 'size',
								'value'      => array(
									esc_html__('Small','textron')  => 'small',
									esc_html__('Medium','textron') => 'medium',
									esc_html__('Large','textron')  => 'large',
								),
								'std' => 'medium'
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    		)
		    	));

			/* et_mobile_menu
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Mobile menu','textron'),
		    		'description'             => esc_html__('Use only with mobile container','textron'),
		    		'category'                => $vc_menu_categories[1],
		    		'base'                    => 'et_mobile_menu',
		    		'class'                   => 'et_mobile_menu font',
		    		'icon'                    => 'et_mobile_menu',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-menu.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-menu.js',
		    		'params'                  => array(
		    			array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Menu name','textron'),
							'param_name' => 'menu',
							'value'      => $menu_list,
							'default'    => 'choose'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__('Menu items separator color','textron'),
							'param_name' => 'separator_color',
							'value'      => '#e0e0e0',
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Text align','textron'),
							'param_name' => 'text_align',
							'value'      => $align_values,
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* top level
						----*/

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu color','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu color hover','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_color_hover',
									'value'      => $main_color,
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu background color hover','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_background_color_hover',
									'value'      => '',
								),

							/* typography
							----*/

								array(
									'param_name'=>'font_family',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font family', 'textron'),
									'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
									'value'     => $google_fonts_family,
								),
								array(
									'param_name'=>'font_weight',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font weight', 'textron'),
									'value'     => $font_weight_values,
									'std'       => '700'
								),
								array(
									'param_name'=>'font_subsets',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font subsets', 'textron'),
									'value'      => array(
										'latin' => 'latin',
									)
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Font size (without any string)','textron'),
									'group'      => esc_html__('Top level','textron'),
									'param_name' => 'font_size',
									'value'      => '32',
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Menu items line height (without any string)','textron'),
									'group'      => esc_html__('Top level','textron'),
									'param_name' => 'line_height',
									'value'      => '32',
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Top level','textron'),
									'heading'    => esc_html__('Letter spacing (without any string)','textron'),
									'param_name' => 'letter_spacing',
									'value'      => ''
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Text transform','textron'),
									'group'      => 'Top level',
									'param_name' => 'text_transform',
									'value'      => array(
										esc_html__('None','textron')       => 'none',
										esc_html__('Uppercase','textron')  => 'uppercase',
										esc_html__('Lowercase','textron')  => 'lowercase',
										esc_html__('Capitalize','textron') => 'capitalize',
									)
								),

						/* submenu
						----*/

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu color','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu color hover','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_color_hover',
									'value'      => $main_color,
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu background color hover','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_background_color_hover',
									'value'      => '',
								),

							/* typography
							----*/

								array(
									'param_name'=>'subfont_family',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font family', 'textron'),
									'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
									'value'     => $google_fonts_family,
								),
								array(
									'param_name'=>'subfont_weight',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font weight', 'textron'),
									'value'     => $font_weight_values
								),
								array(
									'param_name'=>'subfont_subsets',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font subsets', 'textron'),
									'value'      => array(
										'latin' => 'latin',
									)
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Submenu font size (without any string)','textron'),
									'group'      => esc_html__('Submenu','textron'),
									'param_name' => 'subfont_size',
									'value'      => '24',
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Submenu items line height (without any string)','textron'),
									'group'      => esc_html__('Submenu','textron'),
									'param_name' => 'subline_height',
									'value'      => '24',
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Submenu','textron'),
									'heading'    => esc_html__('Submenu letter spacing (without any string)','textron'),
									'param_name' => 'subletter_spacing',
									'value'      => ''
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu text transform','textron'),
									'group'      => 'Submenu',
									'param_name' => 'subtext_transform',
									'value'      => array(
										esc_html__('None','textron')       => 'none',
										esc_html__('Uppercase','textron')  => 'uppercase',
										esc_html__('Lowercase','textron')  => 'lowercase',
										esc_html__('Capitalize','textron') => 'capitalize',
									)
								),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'subelement_font',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

			/* et_mobile_tabs
			----*/

				vc_map(array(
		    		'name'                    => esc_html__('Mobile tabs','textron'),
		    		'description'             => esc_html__('Insert mobile tabs','textron'),
		    		'category'                => $vc_menu_categories[1],
		    		'base'                    => 'et_mobile_tab',
		    		'class'                   => 'et_mobile_tab',
		    		'icon'                    => 'et_mobile_tab',
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-tab.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-mobile-tab.js',
		    		'as_parent'               => array('only' => 'et_mobile_tab_item'),
		    		'content_element'         => true,
		    		'show_settings_on_create' => true,
		    		'is_container'            => true,
		    		'js_view'                 => 'VcColumnView',
		    		'params'                  => array(

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Tab color','textron'),
								'param_name' => 'color',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Tab color active','textron'),
								'param_name' => 'color_active',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Tab background color','textron'),
								'param_name' => 'background_color',
								'value'      => $main_color,
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Tab background color active','textron'),
								'param_name' => 'background_color_active',
								'value'      => $secondory_color,
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

		    	vc_map(array(
					'name'                    => esc_html__('Tab','textron'),
					'category'                => $vc_menu_categories[1],
					'base'                    => 'et_mobile_tab_item',
					'class'                   => 'et_mobile_tab_item',
					'icon'                    => 'et_mobile_tab_item',
					'as_child'                => array('only' => 'et_mobile_tab'),
    				"as_parent"               => array('except' => 'vc_section'),
    				'content_element'         => true,
					"js_view"                 => 'VcColumnView',
					'show_settings_on_create' => true,
					'params'                  => array(
						array(
							'type'       => 'attach_image',
							'heading'    => esc_html__('Icon','textron'),
							'param_name' => 'icon',
							'value'      => '',
						),
						array(
		    				'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => ''
						),
					)
				));

			/* et_modal_container
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Modal container','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories[0],
		    		'base'                    => 'et_header_modal_container',
		    		'class'                   => 'et_header_modal_container',
		    		'icon'                    => 'et_header_modal_container',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-modal-container.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-modal-container.js',
		    		"as_parent"               => array('only' => 'vc_row, et_modal_close'),
					"js_view"                 => 'VcColumnView',
		    		"content_element"         => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'background_color',
								'value'      => '#ffffff',
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Default text color','textron'),
								'group'      => 'Styling',
								'param_name' => 'text_color',
								'value'      => '#616161',
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

		    /* et_modal_toggle
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Modal container toggle','textron'),
		    		'description'             => esc_html__('Use only with header builder to toggle the modal container','textron'),
		    		'category'                => $vc_menu_categories[0],
		    		'base'                    => 'et_modal_toggle',
		    		'class'                   => 'et_modal_toggle hbe',
		    		'icon'                    => 'et_modal_toggle',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-modal-toggle.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-modal-toggle.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => '#bdbdbd',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color_hover',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color_hover',
								'value'      => $secondory_color,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Size','textron'),
								'group'      => 'Styling',
								'param_name' => 'size',
								'value'      => array(
									esc_html__('Small','textron')  => 'small',
									esc_html__('Medium','textron') => 'medium',
									esc_html__('Large','textron')  => 'large',
								),
								'std' => 'small'
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    			/* visibility
						----*/

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from default header version?','textron'),
								'param_name' => 'hide_default',
								'value'      => '',
							),

							array(
								'type'       => 'checkbox',
								'group'    => esc_html__('Visibility','textron'),
								'heading'    => esc_html__('Hide from sticky header version?','textron'),
								'param_name' => 'hide_sticky',
								'value'      => '',
							),
		    		)
		    	));

			/* et_modal_close
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Modal container close','textron'),
		    		'description'             => esc_html__('Use only with header builder to close the modal container','textron'),
		    		'category'                => $vc_menu_categories[0],
		    		'base'                    => 'et_modal_close',
		    		'class'                   => 'et_modal_close hbe',
		    		'icon'                    => 'et_modal_close',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-modal-close.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-modal-close.js',
		    		'params'                  => array(
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'description' => esc_html__('!If you choose Center, do not forget to set the parent element text-align to center', 'textron'),
							'value'     => $align_values_extended
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color',
								'value'      => $secondory_color,
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_color_hover',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Icon background color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'icon_background_color_hover',
								'value'      => $main_color,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Size','textron'),
								'group'      => 'Styling',
								'param_name' => 'size',
								'value'      => array(
									esc_html__('Small','textron')  => 'small',
									esc_html__('Medium','textron') => 'medium',
									esc_html__('Large','textron')  => 'large',
								),
								'std' => 'small'
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),

		    		)
		    	));

			/* et_modal_menu
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Modal menu','textron'),
		    		'description'             => esc_html__('Use only with modal container','textron'),
		    		'category'                => $vc_menu_categories[0],
		    		'base'                    => 'et_modal_menu',
		    		'class'                   => 'et_modal_menu font',
		    		'icon'                    => 'et_modal_menu',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-modal-menu.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-modal-menu.js',
		    		'params'                  => array(
		    			array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Menu name','textron'),
							'param_name' => 'menu',
							'value'      => $menu_list,
							'default'    => 'choose'
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* top level
						----*/

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu color','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Menu color hover','textron'),
									'group'      => 'Top level',
									'param_name' => 'menu_color_hover',
									'value'      => $main_color,
								),

							/* typography
							----*/

								array(
									'param_name'=>'font_family',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font family', 'textron'),
									'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
									'value'     => $google_fonts_family,
								),
								array(
									'param_name'=>'font_weight',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font weight', 'textron'),
									'value'     => $font_weight_values,
									'std'       => '400'
								),
								array(
									'param_name'=>'font_subsets',
									'type'      => 'dropdown',
									'group'     => esc_html__('Top level','textron'),
									'heading'   => esc_html__('Font subsets', 'textron'),
									'value'      => array(
										'latin' => 'latin',
									)
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Font size (without any string)','textron'),
									'group'      => esc_html__('Top level','textron'),
									'param_name' => 'font_size',
									'value'      => '72',
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Menu items line height (without any string)','textron'),
									'group'      => esc_html__('Top level','textron'),
									'param_name' => 'line_height',
									'value'      => '96',
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Top level','textron'),
									'heading'    => esc_html__('Letter spacing (without any string)','textron'),
									'param_name' => 'letter_spacing',
									'value'      => '-2'
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Text transform','textron'),
									'group'      => 'Top level',
									'param_name' => 'text_transform',
									'value'      => array(
										esc_html__('None','textron')       => 'none',
										esc_html__('Uppercase','textron')  => 'uppercase',
										esc_html__('Lowercase','textron')  => 'lowercase',
										esc_html__('Capitalize','textron') => 'capitalize',
									)
								),

						/* submenu
						----*/

							/* styling
							----*/

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu color','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_color',
									'value'      => $secondory_color,
								),

								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__('Submenu color hover','textron'),
									'group'      => 'Submenu',
									'param_name' => 'submenu_color_hover',
									'value'      => $main_color,
								),

							/* typography
							----*/

								array(
									'param_name'=>'subfont_family',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font family', 'textron'),
									'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
									'value'     => $google_fonts_family,
								),
								array(
									'param_name'=>'subfont_weight',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font weight', 'textron'),
									'value'     => $font_weight_values
								),
								array(
									'param_name'=>'subfont_subsets',
									'type'      => 'dropdown',
									'group'     => esc_html__('Submenu','textron'),
									'heading'   => esc_html__('Submenu font subsets', 'textron'),
									'value'      => array(
										'latin' => 'latin',
									)
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Submenu font size (without any string)','textron'),
									'group'      => esc_html__('Submenu','textron'),
									'param_name' => 'subfont_size',
									'value'      => '16',
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Submenu items line height (without any string)','textron'),
									'group'      => esc_html__('Submenu','textron'),
									'param_name' => 'subline_height',
									'value'      => '32',
								),
								array(
									'type'       => 'textfield',
									'group'      => esc_html__('Submenu','textron'),
									'heading'    => esc_html__('Submenu letter spacing (without any string)','textron'),
									'param_name' => 'subletter_spacing',
									'value'      => ''
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__('Submenu text transform','textron'),
									'group'      => 'Submenu',
									'param_name' => 'subtext_transform',
									'value'      => array(
										esc_html__('None','textron')       => 'none',
										esc_html__('Uppercase','textron')  => 'uppercase',
										esc_html__('Lowercase','textron')  => 'lowercase',
										esc_html__('Capitalize','textron') => 'capitalize',
									)
								),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Margin','textron'),
								'heading'    => esc_html__('Margin','textron'),
								'param_name' => 'margin',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'subelement_font',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

			/* et_sidebar_container
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Sidebar container','textron'),
		    		'description'             => esc_html__('Use only with header builder','textron'),
		    		'category'                => $vc_menu_categories[2],
		    		'base'                    => 'et_header_sidebar_container',
		    		'class'                   => 'et_header_sidebar_container',
		    		'icon'                    => 'et_header_sidebar_container',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-sidebar-container.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-sidebar-container.js',
		    		"as_parent"               => array('only' => 'et_sidebar_toggle, et_gap, et_separator, et_header_button, et_header_icon, et_header_social_links, et_header_slogan, et_search_form, et_sidebar_menu, et_header_logo,et_align_container,et_vertical_align_top,et_vertical_align_middle,et_vertical_align_bottom'),
					"js_view"                 => 'VcColumnView',
		    		"content_element"         => true,
		    		'params'                  => array(

						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Background color','textron'),
								'group'      => 'Styling',
								'param_name' => 'background_color',
								'value'      => '#ffffff',
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Default text color','textron'),
								'group'      => 'Styling',
								'param_name' => 'text_color',
								'value'      => '#616161',
							),

						/* margin
						----*/

							array(
								'type'       => 'margin',
								'group'      => esc_html__('Padding','textron'),
								'heading'    => esc_html__('Padding','textron'),
								'param_name' => 'margin',
								'value'      => '48,32,48,32'
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

		    /* et_sidebar_menu
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Sidebar navigation menu','textron'),
		    		'description'             => esc_html__('Use only with sidebar builder','textron'),
		    		'category'                => $vc_menu_categories[2],
		    		'base'                    => 'et_sidebar_menu',
		    		'class'                   => 'et_sidebar_menu hbe font',
		    		'icon'                    => 'et_sidebar_menu',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-sidebar-menu.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-sidebar-menu.js',
		    		'params'                  => array(
		    			array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Menu name','textron'),
							'param_name' => 'menu',
							'value'      => $menu_list,
							'default'    => 'choose'
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						/* styling
						----*/

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Menu color','textron'),
								'group'      => 'Styling',
								'param_name' => 'menu_color',
								'value'      => $secondory_color,
							),

							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__('Menu color hover','textron'),
								'group'      => 'Styling',
								'param_name' => 'menu_color_hover',
								'value'      => $main_color,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Submenu indicator','textron'),
								'group'      => 'Styling',
								'param_name' => 'submenu_indicator',
								'value'      => $logic_values
							),

						/* typography
						----*/

							array(
								'param_name'=>'font_family',
								'type'      => 'dropdown',
								'group'     => esc_html__('Top level','textron'),
								'heading'   => esc_html__('Font family', 'textron'),
								'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
								'value'     => $google_fonts_family,
							),
							array(
								'param_name'=>'font_weight',
								'type'      => 'dropdown',
								'group'     => esc_html__('Top level','textron'),
								'heading'   => esc_html__('Font weight', 'textron'),
								'value'     => $font_weight_values,
								'std'       => 'uppercase'
							),
							array(
								'param_name'=>'font_subsets',
								'type'      => 'dropdown',
								'group'     => esc_html__('Top level','textron'),
								'heading'   => esc_html__('Font subsets', 'textron'),
								'value'      => array(
									'latin' => 'latin',
								)
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Font size (without any string)','textron'),
								'group'      => esc_html__('Top level','textron'),
								'param_name' => 'font_size',
								'value'      => '32',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Line height (without any string)','textron'),
								'group'      => esc_html__('Top level','textron'),
								'param_name' => 'line_height',
								'value'      => '32',
							),
							array(
								'type'       => 'textfield',
								'group'      => esc_html__('Top level','textron'),
								'heading'    => esc_html__('Letter spacing (without any string)','textron'),
								'param_name' => 'letter_spacing',
								'value'      => ''
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Text transform','textron'),
								'group'      => 'Top level',
								'param_name' => 'text_transform',
								'value'      => array(
									esc_html__('None','textron')       => 'none',
									esc_html__('Uppercase','textron')  => 'uppercase',
									esc_html__('Lowercase','textron')  => 'lowercase',
									esc_html__('Capitalize','textron') => 'capitalize',
								)
							),

							/* submenu
							----*/

								array(
									'type'       => 'textfield',
									'heading'    => esc_html__('Submenu offset','textron'),
									'group'      => esc_html__('Submenu','textron'),
									'param_name' => 'suboffset',
									'value'      => '',
								),

								/* typography
								----*/

									array(
										'param_name'=>'subfont_family',
										'type'      => 'dropdown',
										'group'     => esc_html__('Submenu','textron'),
										'heading'   => esc_html__('Submenu font family', 'textron'),
										'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
										'value'     => $google_fonts_family,
									),
									array(
										'param_name'=>'subfont_weight',
										'type'      => 'dropdown',
										'group'     => esc_html__('Submenu','textron'),
										'heading'   => esc_html__('Submenu font weight', 'textron'),
										'value'     => $font_weight_values
									),
									array(
										'param_name'=>'subfont_subsets',
										'type'      => 'dropdown',
										'group'     => esc_html__('Submenu','textron'),
										'heading'   => esc_html__('Submenu font subsets', 'textron'),
										'value'      => array(
											'latin' => 'latin',
										)
									),
									array(
										'type'       => 'textfield',
										'heading'    => esc_html__('Submenu font size (without any string)','textron'),
										'group'      => esc_html__('Submenu','textron'),
										'param_name' => 'subfont_size',
										'value'      => '16',
									),
									array(
										'type'       => 'textfield',
										'heading'    => esc_html__('Submenu line height (without any string)','textron'),
										'group'      => esc_html__('Submenu','textron'),
										'param_name' => 'subline_height',
										'value'      => '20',
									),
									array(
										'type'       => 'textfield',
										'group'      => esc_html__('Submenu','textron'),
										'heading'    => esc_html__('Submenu letter spacing (without any string)','textron'),
										'param_name' => 'subletter_spacing',
										'value'      => ''
									),
									array(
										'type'       => 'dropdown',
										'heading'    => esc_html__('Submenu text transform','textron'),
										'group'      => 'Submenu',
										'param_name' => 'subtext_transform',
										'value'      => array(
											esc_html__('None','textron')       => 'none',
											esc_html__('Uppercase','textron')  => 'uppercase',
											esc_html__('Lowercase','textron')  => 'lowercase',
											esc_html__('Capitalize','textron') => 'capitalize',
										)
									),

						/* padding
						----*/

							array(
								'type'       => 'padding',
								'group'      => esc_html__('Padding','textron'),
								'heading'    => esc_html__('Padding','textron'),
								'param_name' => 'padding',
								'value'      => ''
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

		/* TITLE SECTION
		----*/

			/* et_title_section_title
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Page title','textron'),
		    		'description'             => esc_html__('Use only with title section','textron'),
		    		'category'                => esc_html__('Title section','textron'),
		    		'base'                    => 'et_title_section_title',
		    		'class'                   => 'et_title_section_title font',
		    		'icon'                    => 'et_title_section_title',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-title-section-title.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-title-section-title.js',
		    		'params'                  => array(
		    			array(
							'type'       => 'textfield',
							"class"      => "element-attr-hide",
							'heading'    => esc_html__('Etp title','textron'),
							'param_name' => 'etp_title',
							'value'      => '',
						),
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'value'     => $align_values
						),
						array(
							'param_name'=>'text_align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Text align', 'textron'),
							'value'     => $align_values
						),
						array(
							'param_name'=>'type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Tag', 'textron'),
							'value'     => array(
								'H1'  => 'h1',
								'H2'  => 'h2',
								'H3'  => 'h3',
								'H4'  => 'h4',
								'H5'  => 'h5',
								'H6'  => 'h6',
								'p'   => 'p',
								'div' => 'div',
							),
							'std' => 'h1'
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__('Text color','textron'),
							'param_name' => 'text_color',
							'value'      => $secondory_color,
						),

						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__('Background color','textron'),
							'param_name' => 'background_color',
							'value'      => '',
						),

						array(
							'param_name'=>'font_family',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Font family', 'textron'),
							'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
							'value'     => $google_fonts_family,
						),
						array(
							'param_name'=>'font_weight',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Font weight', 'textron'),
							'value'     => $font_weight_values,
						),
						array(
							'param_name'=>'font_subsets',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Font subsets', 'textron'),
							'value'      => array(
								'latin' => 'latin',
							)
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Font size (without any string)','textron'),
							'param_name' => 'font_size',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Letter spacing (without any string)','textron'),
							'param_name' => 'letter_spacing',
							'value'      => ''
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Line height (without any string)','textron'),
							'param_name' => 'line_height',
							'value'      => ''
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Text transform','textron'),
							'param_name' => 'text_transform',
							'value'      => array(
								esc_html__('None','textron')       => 'none',
								esc_html__('Uppercase','textron')  => 'uppercase',
								esc_html__('Lowercase','textron')  => 'lowercase',
								esc_html__('Capitalize','textron') => 'capitalize',
							)
						),

						/* tablet
						----*/

							array(
								'param_name'=>'tablet_align',
								'type'      => 'dropdown',
								'group'      => esc_html__('Tablet','textron'),
								'heading'   => esc_html__('Align', 'textron'),
								'value'     => $align_values
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Tablet landscape font size (without any string)','textron'),
								'group'      => esc_html__('Tablet','textron'),
								'param_name' => 'tlf',
								'value'      => $font_size_values,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Tablet landscape line height (without any string)','textron'),
								'group'      => esc_html__('Tablet','textron'),
								'param_name' => 'tll',
								'value'      => $line_height_values,
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Tablet portrait font size (without any string)','textron'),
								'group'      => esc_html__('Tablet','textron'),
								'param_name' => 'tpf',
								'value'      => $font_size_values,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Tablet portrait line height (without any string)','textron'),
								'group'      => esc_html__('Tablet','textron'),
								'param_name' => 'tpl',
								'value'      => $line_height_values,
							),

						/* mobile
						----*/

							array(
								'param_name'=>'mobile_align',
								'type'      => 'dropdown',
								'group'      => esc_html__('Mobile','textron'),
								'heading'   => esc_html__('Align', 'textron'),
								'value'     => $align_values
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Font size (without any string)','textron'),
								'group'      => esc_html__('Mobile','textron'),
								'param_name' => 'mf',
								'value'      => $font_size_values,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Line height (without any string)','textron'),
								'group'      => esc_html__('Mobile','textron'),
								'param_name' => 'ml',
								'value'      => $line_height_values,
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

			/* et_title_section_subtitle
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Page subtitle','textron'),
		    		'description'             => esc_html__('Use only with title section','textron'),
		    		'category'                => esc_html__('Title section','textron'),
		    		'base'                    => 'et_title_section_subtitle',
		    		'class'                   => 'et_title_section_subtitle font',
		    		'icon'                    => 'et_title_section_subtitle',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-title-section-subtitle.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-title-section-subtitle.js',
		    		'params'                  => array(
		    			array(
							'type'       => 'textfield',
							"class"      => "element-attr-hide",
							'heading'    => esc_html__('Etp title','textron'),
							'param_name' => 'etp_subtitle',
							'value'      => '',
						),
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'value'     => $align_values
						),
						array(
							'param_name'=>'text_align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Text align', 'textron'),
							'value'     => $align_values
						),
						array(
							'param_name'=>'type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Tag', 'textron'),
							'value'     => array(
								'H1'  => 'h1',
								'H2'  => 'h2',
								'H3'  => 'h3',
								'H4'  => 'h4',
								'H5'  => 'h5',
								'H6'  => 'h6',
								'p'   => 'p',
								'div' => 'div',
							),
							'std' => 'p'
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__('Text color','textron'),
							'param_name' => 'text_color',
							'value'      => $secondory_color,
						),

						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__('Background color','textron'),
							'param_name' => 'background_color',
							'value'      => '',
						),

						array(
							'param_name'=>'font_family',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Font family', 'textron'),
							'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
							'value'     => $google_fonts_family,
						),
						array(
							'param_name'=>'font_weight',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Font weight', 'textron'),
							'value'     => $font_weight_values
						),
						array(
							'param_name'=>'font_subsets',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Font subsets', 'textron'),
							'value'      => array(
								'latin' => 'latin',
							)
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Font size (without any string)','textron'),
							'param_name' => 'font_size',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Letter spacing (without any string)','textron'),
							'param_name' => 'letter_spacing',
							'value'      => ''
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Line height (without any string)','textron'),
							'param_name' => 'line_height',
							'value'      => ''
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Text transform','textron'),
							'param_name' => 'text_transform',
							'value'      => array(
								esc_html__('None','textron')       => 'none',
								esc_html__('Uppercase','textron')  => 'uppercase',
								esc_html__('Lowercase','textron')  => 'lowercase',
								esc_html__('Capitalize','textron') => 'capitalize',
							)
						),

						/* tablet
						----*/

							array(
								'param_name'=>'tablet_align',
								'type'      => 'dropdown',
								'group'      => esc_html__('Tablet','textron'),
								'heading'   => esc_html__('Align', 'textron'),
								'value'     => $align_values
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Tablet landscape font size (without any string)','textron'),
								'group'      => esc_html__('Tablet','textron'),
								'param_name' => 'tlf',
								'value'      => $font_size_values,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Tablet landscape line height (without any string)','textron'),
								'group'      => esc_html__('Tablet','textron'),
								'param_name' => 'tll',
								'value'      => $line_height_values,
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Tablet portrait font size (without any string)','textron'),
								'group'      => esc_html__('Tablet','textron'),
								'param_name' => 'tpf',
								'value'      => $font_size_values,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Tablet portrait line height (without any string)','textron'),
								'group'      => esc_html__('Tablet','textron'),
								'param_name' => 'tpl',
								'value'      => $line_height_values,
							),

						/* mobile
						----*/

							array(
								'param_name'=>'mobile_align',
								'type'      => 'dropdown',
								'group'      => esc_html__('Mobile','textron'),
								'heading'   => esc_html__('Align', 'textron'),
								'value'     => $align_values
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Font size (without any string)','textron'),
								'group'      => esc_html__('Mobile','textron'),
								'param_name' => 'mf',
								'value'      => $font_size_values,
							),

							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__('Line height (without any string)','textron'),
								'group'      => esc_html__('Mobile','textron'),
								'param_name' => 'ml',
								'value'      => $line_height_values,
							),

						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

			/* et_breadcrumbs
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Breadcrumbs','textron'),
		    		'description'             => esc_html__('Use only with title section','textron'),
		    		'category'                => esc_html__('Title section','textron'),
		    		'base'                    => 'et_breadcrumbs',
		    		'class'                   => 'et_breadcrumbs font',
		    		'icon'                    => 'et_breadcrumbs',
		    		'show_settings_on_create' => true,
		    		'admin_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-breadcrumbs.js',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/et-breadcrumbs.js',
		    		'params'                  => array(
		    			array(
							'type'       => 'textfield',
							"class"      => "element-attr-hide",
							'heading'    => esc_html__('Etp breadcrumbs','textron'),
							'param_name' => 'etp_breadcrumbs',
							'value'      => '',
						),
						array(
							'param_name'=>'align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Align', 'textron'),
							'value'     => $align_values
						),
						array(
							'param_name'=>'text_align',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Text align', 'textron'),
							'value'     => $align_values
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Extra class','textron'),
							'param_name' => 'extra_class',
							'value'      => '',
						),

						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__('Text color','textron'),
							'param_name' => 'text_color',
							'value'      => 'rgba(0,36,90,0.3)',
						),

						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__('Text color hover','textron'),
							'param_name' => 'text_color_hover',
							'value'      => $secondory_color,
						),

						array(
							'param_name'=>'font_family',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Font family', 'textron'),
							'description' => esc_html__('800+ google fonts included. For preview click', 'textron').' <a href="//fonts.google.com/" target="_blank">'.esc_html__('here', 'textron').'</a>',
							'value'     => $google_fonts_family,
						),
						array(
							'param_name'=>'font_weight',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Font weight', 'textron'),
							'value'     => $font_weight_values
						),
						array(
							'param_name'=>'font_subsets',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Font subsets', 'textron'),
							'value'      => array(
								'latin' => 'latin',
							)
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Font size (without any string)','textron'),
							'param_name' => 'font_size',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Letter spacing (without any string)','textron'),
							'param_name' => 'letter_spacing',
							'value'      => ''
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Line height (without any string)','textron'),
							'param_name' => 'line_height',
							'value'      => ''
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Text transform','textron'),
							'param_name' => 'text_transform',
							'value'      => array(
								esc_html__('None','textron')       => 'none',
								esc_html__('Uppercase','textron')  => 'uppercase',
								esc_html__('Lowercase','textron')  => 'lowercase',
								esc_html__('Capitalize','textron') => 'capitalize',
							)
						),

						/* tablet
						----*/

							array(
								'param_name'=>'tablet_align',
								'type'      => 'dropdown',
								'group'      => esc_html__('Tablet','textron'),
								'heading'   => esc_html__('Align', 'textron'),
								'value'     => $align_values
							),


						/* mobile
						----*/

							array(
								'param_name'=>'mobile_align',
								'type'      => 'dropdown',
								'group'      => esc_html__('Mobile','textron'),
								'heading'   => esc_html__('Align', 'textron'),
								'value'     => $align_values
							),


						/* element_css
						----*/

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element id','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_id',
								'value'      => '',
							),

							array(
								'type'       => 'textfield',
								'heading'    => esc_html__('Element font','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_font',
								'value'      => '',
							),

							array(
								'type'       => 'textarea',
								'heading'    => esc_html__('Element css','textron'),
								"class"      => "element-attr-hide",
								'param_name' => 'element_css',
								'value'      => '',
							),
		    		)
		    	));

		/* WIDGETS
		----*/

			/* widget_contact_form
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Fast contact form','textron'),
		    		'description'             => esc_html__('Use to add AJAX contact form','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_contact_form',
		    		'class'                   => 'widget_contact_form',
		    		'icon'                    => 'widget_contact_form',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Submit button text','textron'),
							'param_name' => 'submit_text',
							'value'      => 'Send',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Recipient','textron'),
							'param_name' => 'recipient',
							'value'      => get_option('admin_email'),
						),
		    		)
		    	));

		    /* widget_facebook
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Facebook like box','textron'),
		    		'description'             => esc_html__('Add facebook likebox','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_facebook',
		    		'class'                   => 'widget_facebook',
		    		'icon'                    => 'widget_facebook',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('App ID from the app dashboard','textron'),
							'param_name' => 'app_id',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('The URL of the Facebook Page','textron'),
							'param_name' => 'href',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Replace en_US with your locale, e.g., ru_RU for Russian (Russia)','textron'),
							'description' => esc_html__('You can change the language of the Page plugin by loading a localized version of the Facebook JavaScript SDK.','textron'),
							'param_name' => 'language_code',
							'value'      => 'en_US',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('The pixel width of the plugin. Min. is 180 & Max. is 500','textron'),
							'param_name' => 'width',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('The pixel height of the plugin. Min. is 70','textron'),
							'param_name' => 'height',
							'value'      => '',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show timeline','textron'),
							'param_name' => 'timeline',
							'value'      => 'true',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show events','textron'),
							'param_name' => 'events',
							'value'      => 'true',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show messages','textron'),
							'param_name' => 'messages',
							'value'      => 'true',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Hide cover photo in the header','textron'),
							'param_name' => 'hide_cover',
							'value'      => 'false',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show profile photos when friends like this','textron'),
							'param_name' => 'show_facepile',
							'value'      => 'false',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Use the small header instead','textron'),
							'param_name' => 'small_header',
							'value'      => 'false',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Try to fit inside the container width','textron'),
							'param_name' => 'adapt_container_width',
							'value'      => 'true',
						),

		    		)
		    	));

		    /* widget_flickr
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Flickr images','textron'),
		    		'description'             => esc_html__('Use to add images from flickr','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_flickr',
		    		'class'                   => 'widget_flickr',
		    		'icon'                    => 'widget_flickr',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/widget-flickr.js',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Number of photos to show','textron'),
							'param_name' => 'photos_number',
							'value'      => '6',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Flickr id','textron'),
							'description'=> esc_html__('For more infomration go:','textron').' '.'<a target="_blank" href="http://idgettr.com/">'.esc_html__( 'here', 'textron' ).'</a>',
							'param_name' => 'flickr_id',
							'value'      => '',
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Image size','textron'),
							'param_name' => 'image_size',
							'value'      => array(
								esc_html__('Small','textron')      => 'square',
								esc_html__('Thumbnails','textron') => 'thumb',
								esc_html__('Medium','textron')     => 'mid',
							),
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Display','textron'),
							'param_name' => 'image_size',
							'value'      => array(
								esc_html__('Latest','textron') => 'latest',
								esc_html__('Random','textron') => 'random',
							),
						),
						array(
							'param_name'=>'columns_mob',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Columns mobile', 'textron'),
							'value'     => array(
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10'  => '10'
							)
						),
						array(
							'param_name'=>'columns_tablet',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Columns tablet', 'textron'),
							'value'     => array(
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10'  => '10'
							)
						),
						array(
							'param_name'=>'columns_desk',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Columns desktop', 'textron'),
							'value'     => array(
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10'  => '10'
							)
						),
		    		)

		    	));


		    /* widget_mailchimp
			----*/

 				$list_array = enovathemes_addons_mailchimp_list();

 				$list_values = array();

 				if ( !is_wp_error( $list_array ) ){

 					// foreach ( $list_array as $list){
 					// 	$list_values[$list['id']] = $list['name'];
 					// }
 				}

				$list_values = array_flip($list_values);

				if (empty($list_values)) {
					array_push($list_values, esc_html__('Mailchimp did not return any list','textron'));
				}

		    	vc_map(array(
		    		'name'                    => esc_html__('Mailchimp','textron'),
		    		'description'             => esc_html__('Use to add AJAX mailchimp subscribe','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_mailchimp',
		    		'class'                   => 'widget_mailchimp',
		    		'icon'                    => 'widget_mailchimp',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textarea',
							'heading'    => esc_html__('Description','textron'),
							'param_name' => 'description',
							'value'      => '',
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('List','textron'),
							'description'=> esc_html__('Make sure you have the Mailchimp API key and at least one list in your Mailchimp dashboard. Go to theme options >> general >> Mailchimp API key','textron'),
							'param_name' => 'list',
							'value'      => $list_values,
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show First Name field','textron'),
							'param_name' => 'first_name',
							'value'      => 'false',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Required?','textron'),
							'param_name' => 'required_first_name',
							'value'      => 'false',
							'dependency' => Array('element' => 'first_name', 'value' => 'true')
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show Last Name field','textron'),
							'param_name' => 'last_name',
							'value'      => 'false',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Required?','textron'),
							'param_name' => 'required_last_name',
							'value'      => 'false',
							'dependency' => Array('element' => 'last_name', 'value' => 'true')
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show phone field','textron'),
							'param_name' => 'phone',
							'value'      => 'false',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Required?','textron'),
							'param_name' => 'required_phone',
							'value'      => 'false',
							'dependency' => Array('element' => 'phone', 'value' => 'true')
						),
		    		)
		    	));

			/* widget_posts
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Recent posts','textron'),
		    		'description'             => esc_html__('Use to add recent posts with image','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_posts',
		    		'class'                   => 'widget_posts',
		    		'icon'                    => 'widget_posts',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/widget-posts.js',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Number of posts','textron'),
							'param_name' => 'number',
							'value'      => '',
						)
		    		)
		    	));

		    /* widget_login
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Login form','textron'),
		    		'description'             => esc_html__('Use to add front-end login form','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_login',
		    		'class'                   => 'widget_login',
		    		'icon'                    => 'widget_login',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Registration page link','textron'),
							'param_name' => 'registration_link',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Password recovery page','textron'),
							'param_name' => 'forgot_link',
							'value'      => '',
						)
		    		)
		    	));

			/* widget_product_categories
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Product categories','textron'),
		    		'description'             => esc_html__('Woocommerce','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_product_categories',
		    		'class'                   => 'widget_product_categories',
		    		'icon'                    => 'widget_product_categories',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/widget-product-categories.js',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Order by','textron'),
							'param_name' => 'orderby',
							'value'      => array(
								esc_html__('Category order','textron') => 'order',
								esc_html__('Name','textron') => 'name',
							),
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show as dropdown','textron'),
							'param_name' => 'dropdown',
							'value'      => '1',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show product counts','textron'),
							'param_name' => 'count',
							'value'      => '1',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show hierarchy','textron'),
							'param_name' => 'hierarchical',
							'value'      => '1',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Only show children of the current category','textron'),
							'param_name' => 'show_children_only',
							'value'      => '1',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Hide empty categories','textron'),
							'param_name' => 'hide_empty',
							'value'      => '1',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Maximum depth','textron'),
							'param_name' => 'max_depth',
							'value'      => '',
						),
		    		)

		    	));

		    /* widget_products_by_rating
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Product by rating','textron'),
		    		'description'             => esc_html__('Woocommerce','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_products_by_rating',
		    		'class'                   => 'widget_products_by_rating',
		    		'icon'                    => 'widget_products_by_rating',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/widget-products-by-rating.js',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Number of products to show','textron'),
							'param_name' => 'number',
							'value'      => '',
						),
		    		)

		    	));

		    /* widget_products
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Products','textron'),
		    		'description'             => esc_html__('Woocommerce','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_products',
		    		'class'                   => 'widget_products',
		    		'icon'                    => 'widget_products',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/widget-products.js',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Number of products to show','textron'),
							'param_name' => 'number',
							'value'      => '',
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Show','textron'),
							'param_name' => 'show',
							'value'      => array(
								esc_html__('All products','textron') => '',
								esc_html__('Featured','textron') => 'featured',
								esc_html__('On-sale products','textron') => 'onsale',
							),
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Order by','textron'),
							'param_name' => 'orderby',
							'value'      => array(
								esc_html__('Date','textron') => 'date',
								esc_html__('Price','textron') => 'price',
								esc_html__('Random','textron') => 'random',
								esc_html__('Sales','textron') => 'sales',
							),
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__('Order','textron'),
							'param_name' => 'order',
							'value'      => array(
								esc_html__('ASC','textron') => 'asc',
								esc_html__('DESC','textron') => 'desc',
							),
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Hide free products','textron'),
							'param_name' => 'hide_free',
							'value'      => '1',
						),
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__('Show hidden products','textron'),
							'param_name' => 'show_hidden',
							'value'      => '1',
						),
		    		)

		    	));

		    /* widget_recent_product_reviews
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Recent product reviews','textron'),
		    		'description'             => esc_html__('Woocommerce','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_recent_product_reviews',
		    		'class'                   => 'widget_recent_product_reviews',
		    		'icon'                    => 'widget_recent_product_reviews',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/widget-products-reviews.js',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Number of products to show','textron'),
							'param_name' => 'number',
							'value'      => '',
						),
		    		)

		    	));

		    /* widget_recent_viewed_products
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Recent viewed products','textron'),
		    		'description'             => esc_html__('Woocommerce','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_recent_viewed_products',
		    		'class'                   => 'widget_recent_viewed_products',
		    		'icon'                    => 'widget_recent_viewed_products',
		    		'front_enqueue_js'        => TEXTRON_ENOVATHEMES_TEMPPATH .'/js/vc_elements/widget-products-viewed.js',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Number of products to show','textron'),
							'param_name' => 'number',
							'value'      => '',
						),
		    		)

		    	));

		    /* widget_product_tag_cloud
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Product tag cloud','textron'),
		    		'description'             => esc_html__('Woocommerce','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_product_tag_cloud',
		    		'class'                   => 'widget_product_tag_cloud',
		    		'icon'                    => 'widget_product_tag_cloud',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						)
		    		)

		    	));

		    /* widget_cart
			----*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Cart','textron'),
		    		'description'             => esc_html__('Woocommerce','textron'),
		    		'category'                => esc_html__('WordPress Widgets','textron'),
		    		'base'                    => 'widget_cart',
		    		'class'                   => 'widget_cart',
		    		'icon'                    => 'widget_cart',
		    		'show_settings_on_create' => true,
		    		'params'                  => array(
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__('Title','textron'),
							'param_name' => 'title',
							'value'      => '',
						),
		    		)
		    	));

	}

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

		class WPBakeryShortCode_et_Carousel extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Carousel_Item extends WPBakeryShortCodesContainer {}

		class WPBakeryShortCode_et_Pricing_Table_Container extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Pricing_Table extends WPBakeryShortCodesContainer {}

		class WPBakeryShortCode_et_Accordion extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Accordion_Item extends WPBakeryShortCodesContainer {}

		class WPBakeryShortCode_et_Tab extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Tab_Item extends WPBakeryShortCodesContainer {}

		class WPBakeryShortCode_et_Mobile_Tab extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Mobile_Tab_Item extends WPBakeryShortCodesContainer {}

		class WPBakeryShortCode_et_Testimonial_Container extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Testimonial extends WPBakeryShortCodesContainer {}

		class WPBakeryShortCode_et_Client_Container extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Client extends WPBakeryShortCodesContainer {}

		class WPBakeryShortCode_et_Info_Present extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Banner extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Animate_Box extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Stagger_Box extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Icon_Box_Container extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Step_Box_Container extends WPBakeryShortCodesContainer {}
		
		class WPBakeryShortCode_et_Header_Sidebar_Container extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Header_Mobile_Container extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Header_Modal_Container extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Header_Modal_Container_Column extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Align_Container extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Vertical_Align_Top extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Vertical_Align_Middle extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Vertical_Align_Bottom extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Megamenu_Tab extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Megamenu_Tab_Item extends WPBakeryShortCodesContainer {}

	}
}

?>
