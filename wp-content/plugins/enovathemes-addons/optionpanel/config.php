<?php

if ( ! class_exists( 'Redux' ) ) {
    return;
}

$opt_name = "textron_enovathemes";
$theme    = wp_get_theme();

$args = array(
    'opt_name'             => $opt_name,
    'display_name'         => $theme->get( 'Name' ),
    'display_version'      => $theme->get( 'Version' ),
    'menu_type'            => 'submenu',
    'allow_sub_menu'       => true,
    'menu_title'           => esc_html__('Theme settings', 'enovathemes-addons'),
    'page_title'           => esc_html__('Theme settings', 'enovathemes-addons'),
    'google_api_key'       => '',
    'google_update_weekly' => true,
    'async_typography'     => true,
    'admin_bar'            => true,
    'admin_bar_icon'       => '',
    'admin_bar_priority'   => 50,
    'global_variable'      => 'textron_enovathemes',
    'dev_mode'             => false,
    'update_notice'        => false,
    'customizer'           => false,
    'page_priority'        => null,
    'page_parent'          => 'themes.php',
    'page_permissions'     => 'manage_options',
    'menu_icon'            => '',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => 'enovathemes',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true
);

Redux::setArgs( $opt_name, $args );

if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}

$inc = 123;

/* General
---------------*/

    Redux::setSection( $opt_name, array(
		'title'      => esc_html__('General', 'enovathemes-addons'),
		'id'         => esc_html__('sec_general', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-wrench',
	    'fields' => array(
	    	array(
				'id'       =>'disable-gutenberg',
				'type'     => 'switch',
				'title'    => esc_html__('Disable gutenberg', 'enovathemes-addons'),
				'subtitle' => esc_html__('By default WordPress comes with new block editor "Gutenberg". If you want classic editor or Visual Composer, make sure this option is active', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'       =>'disable-gutenberg-type',
				'type'     => 'checkbox',
				'title'    => esc_html__('Choose post types to disable Gutenberg', 'enovathemes-addons'),
				'options'  => array(
			        'post' => esc_html__('Posts', 'enovathemes-addons'),
			        'page' => esc_html__('Pages', 'enovathemes-addons'),
			        'project' => esc_html__('Projects', 'enovathemes-addons'),
			        'product' => esc_html__('Products', 'enovathemes-addons'),
			    ),
			    'default' => array(
			        'post' => '0',
			        'page' => '1',
			        'project' => '1',
			        'product' => '0'
    			),
			    'required' => array('disable-gutenberg','equals',1)
			),
	    	array(
				'id'       =>'disable-defaults',
				'type'     => 'switch',
				'class'    => 'hidden-field',
				'title'    => esc_html__('Turn off default styling', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'       =>'plugins-combined',
				'type'     => 'switch',
				'title'    => esc_html__('Load combined js plugins file', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'       =>'cursor',
				'type'     => 'switch',
				'title'    => esc_html__('Custom cursor', 'enovathemes-addons'),
				'subtitle' => esc_html__('Toggle this option if you want to have custom cursor', 'enovathemes-addons'),
				"default"  => 0
			),
	    	array(
			    'id'   => 'info_normal_'.$inc++,
				'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Colors', 'enovathemes-addons')
			),
			array(
				'id'       =>'main-color',
				'type'     => 'color',
				'title'    => esc_html__('Main color', 'enovathemes-addons'),
				'default'  => '#00bfff',
                'transparent' => false
			),
			array(
				'id'       =>'secondory-color',
				'type'     => 'color',
				'title'    => esc_html__('Secondory color', 'enovathemes-addons'),
				'default'  => '#00245a',
                'transparent' => false
			),
			array(
				'id'       =>'area-color',
				'type'     => 'color',
				'title'    => esc_html__('Area color', 'enovathemes-addons'),
				'default'  => '#edf1f8',
                'transparent' => false
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
				'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Layout settings', 'enovathemes-addons')
			),
	    	array(
				'id'        =>'layout',
				'type'      => 'radio',
				'title'     => esc_html__('Layout', 'enovathemes-addons'),
				'subtitle'  => esc_html__('Boxed layout allows you to display the whole website in the box. (works on screens larger than 1200px wide). Make sure your navigation is not sidebar', 'enovathemes-addons'),
				'options'   => array(
					'wide'  => esc_html__('Wide', 'enovathemes-addons'),
					'boxed' => esc_html__('Boxed', 'enovathemes-addons'),
				),
				'default' => 'wide',
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
				'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Site background settings', 'enovathemes-addons'),
			    'required' => array('layout','equals','boxed')
			),
	    	array(
				'id'       =>'site-background',
				'type'     => 'background',
				'title'    => esc_html__('Site background options', 'enovathemes-addons'),
				'required' => array('layout','equals','boxed')
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
				'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Footer settings', 'enovathemes-addons')
			),
			array(
				'id'   => 'warning-info-'.$inc++,
				'class'=> 'warning-info',
				'type' => 'info',
				'style' => 'warning',
				'desc' => esc_html__('Important! If you do not see any option, first you must', 'enovathemes-addons').' <a href="'.esc_url(home_url('/')).'wp-admin/post-new.php?post_type=footer">'.esc_html__("create a footer", "enovathemes-addons").'</a>'
			),
			array(
				'id'=>'footer-id',
				'type' => 'select',
				'data' => 'posts',
				'args' => array('post_type' => 'footer', 'posts_per_page' => -1),
				'title'    => esc_html__('Footer', 'enovathemes-addons'),
			),
			array(
				'id'=>'footer-id-wpml',
				'type' => 'text',
				'class'    => 'wpml-on',
				'title'    => esc_html__('WPML footer per language', 'enovathemes-addons'),
				'description'    => esc_html__('Specify footer for each language with the following format language code:footer id, separate multiple by | (example: en:7846|de:54568)', 'enovathemes-addons'),
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
				'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Header settings', 'enovathemes-addons')
			),
			array(
				'id'   => 'warning-info-'.$inc++,
				'class'=> 'warning-info',
				'type' => 'info',
				'style' => 'warning',
				'desc' => esc_html__('Important! If you do not see any option, first you must', 'enovathemes-addons').' <a href="'.esc_url(home_url('/')).'wp-admin/post-new.php?post_type=header">'.esc_html__("create a header", "enovathemes-addons").'</a>'
			),
			array(
				'id'=>'header-desktop-id',
				'type' => 'select',
				'data' => 'posts',
				'args' => array('post_type' => 'header', 'posts_per_page' => -1),
				'title'    => esc_html__('Desktop header', 'enovathemes-addons'),
			),
			array(
				'id'=>'header-desktop-id-wpml',
				'type' => 'text',
				'class'    => 'wpml-on',
				'title'    => esc_html__('WPML desktop header per language', 'enovathemes-addons'),
				'description'    => esc_html__('Specify desktop header for each language with the following format language code:header id, separate multiple by | (example: en:7846|de:54568)', 'enovathemes-addons'),
			),
			array(
				'id'=>'header-mobile-id',
				'type' => 'select',
				'data' => 'posts',
				'args' => array('post_type' => 'header', 'posts_per_page' => -1),
				'title'    => esc_html__('Mobile header', 'enovathemes-addons'),
			),
			array(
				'id'=>'header-mobile-id-wpml',
				'type' => 'text',
				'class'    => 'wpml-on',
				'title'    => esc_html__('WPML mobile header per language', 'enovathemes-addons'),
				'description'    => esc_html__('Specify mobile header for each language with the following format language code:header id, separate multiple by | (example: en:7846|de:54568)', 'enovathemes-addons'),
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
				'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Page title section settings', 'enovathemes-addons')
			),
			array(
				'id'   => 'warning-info-'.$inc++,
				'class'=> 'warning-info',
				'type' => 'info',
				'style' => 'warning',
				'desc' => esc_html__('Important! If you do not see any option, first you must', 'enovathemes-addons').' <a href="'.esc_url(home_url('/')).'wp-admin/post-new.php?post_type=title_section">'.esc_html__("create a title section", "enovathemes-addons").'</a>'
			),
			array(
				'id'=>'title-section-id',
				'type' => 'select',
				'data' => 'posts',
				'args' => array('post_type' => 'title_section', 'posts_per_page' => -1),
				'title'    => esc_html__('Page title section', 'enovathemes-addons'),
			),
			array(
				'id'=>'title-section-id-wpml',
				'type' => 'text',
				'class'    => 'wpml-on',
				'title'    => esc_html__('WPML title section per language', 'enovathemes-addons'),
				'description'    => esc_html__('Specify title section for each language with the following format language code:title section id, separate multiple by | (example: en:7846|de:54568)', 'enovathemes-addons'),
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
				'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('One page navigation settings', 'enovathemes-addons')
			),
			array(
				'id'       =>'one-page-filter',
				'type'     => 'text',
				'title'    => esc_html__('One page menu filter', 'enovathemes-addons'),
				'subtitle'=> esc_html__("Exclude links from one page menu by entering comma-separated menu items' ids", 'enovathemes-addons'),
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
				'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('API settings', 'enovathemes-addons')
			),
			array(
				'id'      =>'mailchimp-api-key',
				'type'     => 'text',
				'title'    => esc_html__('Mailchimp API key', 'enovathemes-addons'),
				'subtitle' => esc_html__("If you are not sure how to retrieve this, follow this link from MailChimp Knowledge Base to retrieve your account's API key", 'enovathemes-addons').' <a href="http://kb.mailchimp.com/accounts/management/about-api-keys#Finding-or-generating-your-API-key" target="_blank">'.esc_html__("Retrieve your account's API key", 'enovathemes-addons').'</a>',
			),
			array(
				'id'       =>'flickr-api',
				'type'     => 'text',
				'title'    => esc_html__("Flickr API Key", 'enovathemes-addons'),
				'subtitle' => esc_html__("If you are not sure how to retrieve this, follow this link from Flickr Knowledge Base to retrieve your account's API key", 'enovathemes-addons').' <a href="https://www.flickr.com/services/developer/api/" target="_blank">'.esc_html__("Retrieve your account's API key", 'enovathemes-addons').'</a>',
			),
			array(
				'id'       =>'mtt',
				'type'     => 'switch',
				'title'    => esc_html__('Move to top arrow', 'enovathemes-addons'),
				'subtitle' => esc_html__('Toggle this option if you want to have move to top arrow', 'enovathemes-addons'),
				"default"  => 1
			)
	    )
	));

/* CSS
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('CSS', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-star',
	    'fields'     => array(
	    	array(
	            'id'       => 'custom-css',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'class'    => 'hidden-field',
				'theme'    => 'monokai',
	            'title'    => esc_html__('Custom CSS Styles', 'enovathemes-addons'),
	            'subtitle' => esc_html__('Enter custom css code here.', 'enovathemes-addons')
	        ),
	        array(
	            'id'       => 'custom-css-max-374',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 374px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-min-375',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 375px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-min-375-max-767',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 375px) and (max-width: 767px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-max-767',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 767px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-min-768',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 768px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-min-768-max-1023',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 768px) and (max-width: 1023px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-max-1023',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 1023px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-min-1024',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1024px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-min-1024-max-1279',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1024px) and (max-width: 1279px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-max-1279',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 1279px)', 'enovathemes-addons'),
	        ),
	        array(
	            'id'       => 'custom-css-min-1280',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1280px)', 'enovathemes-addons'),
	        ),
	    )
	));

/* Typography
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Typography', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-font',
	    'fields'     => array(
	    	array(
				'id'       =>'main-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Main typography', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => true,
				'font-style'     => false,
				'font-weight'    => true,
				'color'          => true,
				'text-align'     => false,
				'font-family'    => true,
				'default'     => array(
					'font-family'    => 'Roboto',
			        'font-size'      => '16px',
			        'font-weight'    => '400',
			        'line-height'    => '26px',
			        'letter-spacing' => '0.25',
			        'color'          => '#616161',
			    )
			),

			array(
				'id'       =>'headings-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Headings typography', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => true,
				'letter-spacing' => true,
				'line-height'    => false,
				'font-style'     => false,
				'font-size'      => false,
				'font-weight'    => true,
				'color'          => true,
				'text-align'     => false,
				'font-family'    => true,
				'default'     => array(
					'font-family'    => 'Heebo',
			        'font-weight'    => '500',
			        'letter-spacing' => '0.5',
			        'color'          => '#00245a'
			    )
			),

			array(
				'id'       =>'h1-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H1 typography', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false,
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '48px',
			        'line-height' => '56px'
			    )
			),

			array(
				'id'       =>'h2-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H2 typography', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false,
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '40px',
			        'line-height' => '48px'
			    )
			),

			array(
				'id'       =>'h3-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H3 typography', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false,
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '32px',
			        'line-height' => '40px'
			    )
			),

			array(
				'id'       =>'h4-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H4 typography', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false,
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '24px',
			        'line-height' => '32px'
			    )
			),

			array(
				'id'       =>'h5-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H5 typography', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false,
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '20px',
			        'line-height' => '28px'
			    )
			),

			array(
				'id'       =>'h6-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H6 typography', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false,
				'font-weight'    => false,
				'font-size'      => true,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '18px',
			        'line-height' => '26px'
			    )
			),
        )
	));

/* Forms
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Forms', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-tasks',
	    'fields'     => array(
			array(
				'id'       =>'form-text-color',
				'type'     => 'link_color',
				'title'    => esc_html__('Forms fields text colors', 'enovathemes-addons'),
				'visited'  => false,
				'active'    => false,
				'default'  => array(
			        'regular' => '#616161',
			        'hover'   => '#616161',
			    )
			),
			array(
				'id'       =>'form-back-color',
				'type'     => 'link_color',
				'title'    => esc_html__('Forms fields background colors', 'enovathemes-addons'),
				'visited'  => false,
				'active'    => false,
				'default'   => array(
			        'regular' => '#ffffff',
			        'hover'   => '#ffffff',
			    )
			),
			array(
				'id'       =>'form-border-color',
				'type'     => 'link_color',
				'title'    => esc_html__('Forms fields border colors', 'enovathemes-addons'),
				'visited'  => false,
				'active'    => false,
				'default'   => array(
			        'regular' => '#e0e0e0',
			        'hover'   => '#00245a',
			    )
			),
			array(
				'id'       =>'form-button-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Button typography', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'font-weight'    => true,
				'font-size'      => false,
				'font-family'    => true,
				'letter-spacing' => true,
				'text-transform' => true,
				'line-height'    => false,
				'font-style'     => false,
				'color'          => false,
				'text-align'     => false,
				'text-transform' => false,
				'word-spacing'   => false,
				'default'     => array(
					'font-weight'    => '500',
					'font-family'    => 'Heebo',
					'letter-spacing' => '0.5px',
			    )
			),
			array(
				'id'       => 'form-button-back',
				'type'     => 'link_color',
				'active'   => false,
				'visited'  => false,
				'title'    => esc_html__('Button background colors', 'enovathemes-addons'),
				'default'  => array(
					'regular'  => '#00245a',
					'hover'    => '#00bfff'
				)
			),
			array(
				'id'       =>'form-button-color',
				'type'     => 'link_color',
				'active'   => false,
				'visited'  => false,
				'title'    => esc_html__('Button text colors', 'enovathemes-addons'),
				'default'  => array(
					'regular'  => '#ffffff',
					'hover'    => '#ffffff'
				)
			),
		)
	));

/* Blog
---------------*/

	global $wpdb;

	$querystr = "
	    SELECT $wpdb->posts.*
	    FROM $wpdb->posts, $wpdb->postmeta
	    WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
	    AND $wpdb->posts.post_status = 'publish'
	    AND $wpdb->posts.post_type = 'title_section'
	    ORDER BY $wpdb->posts.post_title ASC
	";

	$title_sections = $wpdb->get_results($querystr, OBJECT);

	$title_sections_array = array(
		'none'    => esc_html__( 'None', 'enovathemes-addons' ),
		'default' => esc_html__( 'Default', 'enovathemes-addons' ),
		'inherit' => esc_html__( 'Inherit', 'enovathemes-addons' ),
	);

    if($title_sections){

    	foreach ($title_sections as $title_section) {
    		$title_section_id    = $title_section->ID;
    		$title_section_title = $title_section->post_title;
    		$title_sections_array[$title_section_id] = $title_section_title;
    	}

    }

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Blog', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-pencil',
	    'fields' => array(
			array(
				'id'=>'blog-title',
				'type' => 'select',
				'title' => esc_html__('Choose title section', 'enovathemes-addons'),
				'options' => $title_sections_array,
				'default' => 'inherit',
			),
			array(
				'id'=>'blog-title-single',
				'type' => 'select',
				'title' => esc_html__('Choose title section for single post pages', 'enovathemes-addons'),
				'options' => $title_sections_array,
				'default' => 'inherit',
			),
			array(
				'id'      =>'blog-title-text',
				'type'    => 'text',
				'title'   => esc_html__('Blog title', 'enovathemes-addons'),
				'default' => 'Blog',
			),
			array(
				'id'      =>'blog-subtitle-text',
				'type'    => 'text',
				'title'   => esc_html__('Blog subtitle', 'enovathemes-addons'),
				'default' => '',
			),
			array(
				'id'        =>'blog-sidebar',
				'type'      => 'select',
				'title'     => esc_html__('Blog sidebar position', 'enovathemes-addons'),
				'options'   => array(
					'none'  => esc_html__('None', 'enovathemes-addons'),
					'left'  => esc_html__('Left', 'enovathemes-addons'),
					'right' => esc_html__('Right', 'enovathemes-addons'),
				),
				'default' => 'none',
			),
			array(
				'id'        =>'blog-navigation',
				'type'      => 'select',
				'title'     => esc_html__('Blog navigation', 'enovathemes-addons'), 
				'options'   => array(
					'pagination' => esc_html__('Pagination', 'enovathemes-addons'), 
					'loadmore'   => esc_html__('Load more', 'enovathemes-addons'), 
					'infinite'   => esc_html__('Infinite load', 'enovathemes-addons'),
				),
				'default' => 'pagination',
			),
			array(
				'id'       => 'blog-post-layout',
				'type'     => 'image_select',
				'title'    => esc_html__('Blog post layout', 'enovathemes-addons'),
				'width'    => '140',
				'height'   => '140',
				'options'  => array(
					'grid' => array(
						'alt'   => esc_html__('Grid', 'enovathemes-addons'),
						'title' => esc_html__('Grid', 'enovathemes-addons'),
						'img'   => THEME_IMG.'grid.png'
					),
					'masonry' => array(
						'alt'   => esc_html__('Masonry', 'enovathemes-addons'),
						'title' => esc_html__('Masonry', 'enovathemes-addons'),
						'img'   => THEME_IMG.'masonry.png'
					),
					'list' => array(
						'alt'   => esc_html__('List', 'enovathemes-addons'),
						'title' => esc_html__('List', 'enovathemes-addons'),
						'img'   => THEME_IMG.'list.png'
					),
					'full' => array(
						'alt'   => esc_html__('Full', 'enovathemes-addons'),
						'title' => esc_html__('Full', 'enovathemes-addons'),
						'img'   => THEME_IMG.'full.png'
					),
				),
				'default' => 'masonry'
			),
			array(
				'id'       =>'blog-image-full',
				'type'     => 'switch',
				'title'    => esc_html__('Use original image size (no cropping)', 'enovathemes-addons'),
				"default"  => 0,
				'required' => array('blog-post-layout','equals',array('grid','masonry'))
			),
			array(
				'id'       =>'blog-post-excerpt',
				'type'     => 'slider',
				'title'    => esc_html__('Blog post excerpt length', 'enovathemes-addons'),
				'min'      =>'0',
				'max'      =>'500',
				'step'     =>'1',
				'default'  => '0',
				'required' => array('blog-post-layout','equals',array('grid','full','masonry'))
			),
			array(
				'id'        =>'blog-single-sidebar',
				'type'      => 'select',
				'title'     => esc_html__('Blog single post sidebar position', 'enovathemes-addons'),
				'options'   => array(
					'none'  => esc_html__('None', 'enovathemes-addons'),
					'left'  => esc_html__('Left', 'enovathemes-addons'),
					'right' => esc_html__('Right', 'enovathemes-addons'),
				),
				'default' => 'none',
			),
			array(
				'id'       =>'blog-single-social',
				'type'     => 'switch',
				'title'    => esc_html__('Blog single post social share', 'enovathemes-addons'),
				"default"  => 0
			),
			array(
				'id'       =>'blog-related-posts',
				'type'     => 'switch',
				'title'    => esc_html__('Blog single post related posts', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'        =>'blog-related-posts-by',
				'type'      => 'select',
				'title'     => esc_html__('Related posts by', 'enovathemes-addons'),
				'options'   => array(
					'categories'  => esc_html__('Categories', 'enovathemes-addons'),
					'tags'  => esc_html__('Tags', 'enovathemes-addons'),
				),
				'default' => 'categories',
				'required' => array('blog-related-posts','equals',1)
			),
			array(
				'id'       =>'blog-authorbox',
				'type'     => 'switch',
				'title'    => esc_html__('Blog single post author box', 'enovathemes-addons'),
				"default"  => 1
			),
		)
	));

/* Project
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Project', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-folder-close',
	    'fields' => array(
			array(
				'id'=>'project-title',
				'type' => 'select',
				'title'    => esc_html__('Choose title section', 'enovathemes-addons'),
				'options' => $title_sections_array,
				'default' => 'inherit',
			),
			array(
				'id'=>'project-title-single',
				'type' => 'select',
				'title' => esc_html__('Choose title section for single project pages', 'enovathemes-addons'),
				'options' => $title_sections_array,
				'default' => 'inherit',
			),
			array(
				'id'      =>'project-title-text',
				'type'     => 'text',
				'title'    => esc_html__('Project title', 'enovathemes-addons'),
				'default'  => 'Projects',
			),
			array(
				'id'      =>'project-subtitle-text',
				'type'     => 'text',
				'title'    => esc_html__('Project subtitle', 'enovathemes-addons'),
				'default'  => '',
			),
			array(
				'id'       =>'project-filter',
				'type'     => 'switch',
				'title'    => esc_html__('Project AJAX filter', 'enovathemes-addons'),
				'subtitle' => esc_html__('Toggle this option if you want to have AJAX powered filter for your projects', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'       =>'project-per-page',
				'type'     => 'slider',
				'title'    => esc_html__('Projects per page', 'enovathemes-addons'),
				'min'      =>'0',
				'max'      =>'999',
				'step'     =>'1',
				'default'  => '9'
			),
			array(
				'id'       =>'project-navigation',
				'type'     => 'select',
				'title'    => esc_html__('Project navigation', 'enovathemes-addons'),
				'options'  => array(
					'pagination' => esc_html__('Pagination', 'enovathemes-addons'), 
					'loadmore'   => esc_html__('Load more', 'enovathemes-addons'), 
					'infinite'   => esc_html__('Infinite load', 'enovathemes-addons'),
				),
				'default'  => 'pagination'
			),
			array(
				'id'       => 'project-post-layout',
				'type'     => 'image_select',
				'title'    => esc_html__('Project layout', 'enovathemes-addons'),
				'width'    => '140',
				'height'   => '140',
				'options'  => array(
					'grid' => array(
						'alt'   => esc_html__('Grid', 'enovathemes-addons'),
						'title' => esc_html__('Grid', 'enovathemes-addons'),
						'img'   => THEME_IMG.'grid.png'
					),
					'list' => array(
						'alt'   => esc_html__('List', 'enovathemes-addons'),
						'title' => esc_html__('List', 'enovathemes-addons'),
						'img'   => THEME_IMG.'list.png'
					),
					'full' => array(
						'alt'   => esc_html__('Full', 'enovathemes-addons'),
						'title' => esc_html__('Full', 'enovathemes-addons'),
						'img'   => THEME_IMG.'full-project.png'
					),
				),
				'default' => 'grid'
			),
			array(
				'id'       =>'project-image-full',
				'type'     => 'switch',
				'title'    => esc_html__('Use original image size (no cropping)', 'enovathemes-addons'),
				"default"  => 0,
			),
			array(
				'id'       =>'project-single-social',
				'type'     => 'switch',
				'title'    => esc_html__('Single project social share', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'       =>'project-related-projects',
				'type'     => 'switch',
				'title'    => esc_html__('Single project related projects', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'        =>'project-related-projects-by',
				'type'      => 'select',
				'title'     => esc_html__('Related projects by', 'enovathemes-addons'),
				'options'   => array(
					'categories'  => esc_html__('Categories', 'enovathemes-addons'),
					'tags'  => esc_html__('Tags', 'enovathemes-addons'),
				),
				'default' => 'categories',
				'required' => array('project-related-projects','equals',1)
			),
			array(
				'id'   => 'warning-info-'.$inc++,
				'class'=> 'warning-info',
				'type' => 'info',
				'style' => 'warning',
				'desc' => esc_html__("Important! Don't forget to update/resave permalinks after the slug change", "enovathemes-addons")
			),
			array(
				'id'       =>'project-slug',
				'type'     => 'text',
				'title'    => esc_html__("Project slug", 'enovathemes-addons'),
				'default'  => 'project'
			),
			array(
				'id'       =>'project-cat-slug',
				'type'     => 'text',
				'title'    => esc_html__("Project category slug", 'enovathemes-addons'),
				'default'  => 'project-category'
			),
			array(
				'id'       =>'project-tag-slug',
				'type'     => 'text',
				'title'    => esc_html__("Project tag slug", 'enovathemes-addons'),
				'default'  => 'project-tag'
			),
		)
	));

/* Woo Commerce
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Shop', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-shopping-cart',
	    'fields' => array(
			array(
				'id'=>'product-title',
				'type' => 'select',
				'title'    => esc_html__('Choose title section', 'enovathemes-addons'),
				'options' => $title_sections_array,
				'default' => 'inherit',
			),
			array(
				'id'=>'product-title-single',
				'type' => 'select',
				'title' => esc_html__('Choose title section for single product pages', 'enovathemes-addons'),
				'options' => $title_sections_array,
				'default' => 'inherit',
			),
			array(
				'id'      =>'product-title-text',
				'type'     => 'text',
				'title'    => esc_html__('Shop title', 'enovathemes-addons'),
				'default'  => 'Shop',
			),
			array(
				'id'      =>'product-subtitle-text',
				'type'     => 'text',
				'title'    => esc_html__('Shop subtitle', 'enovathemes-addons'),
				'default'  => '',
			),
			array(
				'id'        =>'product-sidebar',
				'type'      => 'select',
				'title'     => esc_html__('Shop sidebar position', 'enovathemes-addons'),
				'options'   => array(
					'none'  => esc_html__('None', 'enovathemes-addons'),
					'left'  => esc_html__('Left', 'enovathemes-addons'),
					'right' => esc_html__('Right', 'enovathemes-addons'),
				),
				'default' => 'none',
			),
			array(
				'id'       =>'product-per-page',
				'type'     => 'slider',
				'title'    => esc_html__('Products per page', 'enovathemes-addons'),
				'min'      =>'0',
				'max'      =>'999',
				'step'     =>'1',
				'default'  => '9'
			),
			array(
				'id'       =>'product-navigation',
				'type'     => 'select',
				'title'    => esc_html__('Shop navigation', 'enovathemes-addons'),
				'subtitle' => esc_html__('Shop navigation', 'enovathemes-addons'),
				'options'  => array(
					'pagination' => esc_html__('Pagination', 'enovathemes-addons'), 
					'loadmore'   => esc_html__('Load more', 'enovathemes-addons'), 
					'infinite'   => esc_html__('Infinite load', 'enovathemes-addons'),
				),
				'default'  => 'pagination'
			),
			array(
				'id'        =>'product-post-size',
				'type'      => 'select',
				'title'     => esc_html__('Product size', 'enovathemes-addons'),
				'options'   => array(
					'small'  => esc_html__('Small', 'enovathemes-addons'),
					'medium' => esc_html__('Medium', 'enovathemes-addons'),
					'large'  => esc_html__('Large', 'enovathemes-addons'),
				),
				'default' => 'small',
			),
			array(
				'id'       =>'product-image-full',
				'type'     => 'switch',
				'title'    => esc_html__('Use original image size (no cropping)', 'enovathemes-addons'),
				"default"  => 0,
			),
			array(
				'id'        =>'product-single-sidebar',
				'type'      => 'select',
				'title'     => esc_html__('Single product sidebar position', 'enovathemes-addons'),
				'options'   => array(
					'none'  => esc_html__('None', 'enovathemes-addons'),
					'left'  => esc_html__('Left', 'enovathemes-addons'),
					'right' => esc_html__('Right', 'enovathemes-addons'),
				),
				'default' => 'none',
			),
			array(
				'id'       => 'product-single-post-layout',
				'type'     => 'image_select',
				'title'    => esc_html__('Single product layout', 'enovathemes-addons'),
				'width'    => '140',
				'height'   => '140',
				'options'  => array(
					'single-product-thumbnails-down' => array(
						'alt'   => 'Horizonal thumbnails',
						'title' => 'Horizonal thumbnails',
						'img'   => THEME_IMG.'product_post_layout_1.png'
					),
					'single-product-thumbnails-left' => array(
						'alt'   => 'Vertical thumbnails',
						'title' => 'Vertical thumbnails',
						'img'   => THEME_IMG.'product_post_layout_2.png'
					),
				),
				'default' => 'single-product-thumbnails-down'
			),
			array(
				'id'       =>'product-single-social',
				'type'     => 'switch',
				'title'    => esc_html__('Social share', 'enovathemes-addons'),
				"default"  => 1
			)
		)
	));

?>
