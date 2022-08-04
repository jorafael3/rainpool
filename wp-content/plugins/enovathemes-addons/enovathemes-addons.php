<?php
/*
    Plugin Name: Enovathemes add-ons
    Plugin URI: http://www.enovathemes.com
    Text Domain: enovathemes-addons
    Domain Path: /languages/
    Description: Plugin comes with Enovathemes to extend theme functionality (shortcodes, portfolio, enovathemes slider)
    Author: Enovathemes
    Version: 1.9
    Author URI: http://enovathemes.com
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function enovathemes_addons_load_plugin_textdomain() {
    load_plugin_textdomain( 'enovathemes-addons', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'enovathemes_addons_load_plugin_textdomain' );

define( 'ENOVATHEMES_ADDONS', plugin_dir_path( __FILE__ ));
define( 'THEME_IMG', get_template_directory_uri().'/images/');
define( 'THEME_SVG', THEME_IMG.'icons/');

if ( !class_exists( 'ReduxFramework' ) && file_exists( ENOVATHEMES_ADDONS . '/optionpanel/framework.php' ) ) {
    require_once('optionpanel/framework.php' );
}
if (!isset( $redux_demo ) && file_exists( ENOVATHEMES_ADDONS . '/optionpanel/config.php' ) ) {
    require_once('optionpanel/config.php' );
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (is_plugin_active( 'js_composer/js_composer.php' )) {
    require_once('includes/megamenu.php' );
    require_once('includes/footer.php' );
    require_once('includes/header.php' );
    require_once('includes/title.php' );
    require_once('shortcodes/shortcodes.php' );
    require_once('includes/admin-footer-scripts.php' );
}

require_once('includes/cmb2.php' );
require_once('project/project.php' );
require_once('widgets/widget-login.php' );
require_once('widgets/widget-posts.php' );
require_once('widgets/widget-mailchimp.php' );
require_once('widgets/widget-flickr.php' );
require_once('widgets/widget-facebook.php' );
require_once('widgets/widget-contact-form.php' );
require_once('includes/dynamic-styles.php' );

/*  Scripts
/*-------------------*/

    function enovathemes_addons_script(){
        if(!is_admin()){

            global $wp_query;

            wp_register_script( 'widget-contact-form', plugins_url('/js/widget-contact-form.js', __FILE__ ), array('jquery'), '', true);
            wp_register_script( 'widget-mailchimp', plugins_url('/js/widget-mailchimp.js', __FILE__ ), array('jquery'), '', true);

            if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

                wp_enqueue_script( 'wpb_composer_front_js' );
                wp_enqueue_style( 'js_composer_front' );
                wp_enqueue_style( 'js_composer_custom_css' );

            }

            /* < Dynamic google fonts
            ------------------------------------*/

                $global_dynamic_font = array();

                $title_section_id  = "none";
                $blog_title_id     = (isset($GLOBALS['textron_enovathemes']['blog-title']) && !empty($GLOBALS['textron_enovathemes']['blog-title'])) ? $GLOBALS['textron_enovathemes']['blog-title'] : "none";
                $project_title_id  = (isset($GLOBALS['textron_enovathemes']['project-title']) && !empty($GLOBALS['textron_enovathemes']['project-title'])) ? $GLOBALS['textron_enovathemes']['project-title'] : "none";
                $product_title_id  = (isset($GLOBALS['textron_enovathemes']['product-title']) && !empty($GLOBALS['textron_enovathemes']['product-title'])) ? $GLOBALS['textron_enovathemes']['product-title'] : "none";

                $header_desktop_id = (isset($GLOBALS['textron_enovathemes']['header-desktop-id']) && !empty($GLOBALS['textron_enovathemes']['header-desktop-id'])) ? $GLOBALS['textron_enovathemes']['header-desktop-id'] : "default";
                $header_mobile_id  = (isset($GLOBALS['textron_enovathemes']['header-mobile-id']) && !empty($GLOBALS['textron_enovathemes']['header-mobile-id'])) ? $GLOBALS['textron_enovathemes']['header-mobile-id'] : "default";
                $footer_id         = (isset($GLOBALS['textron_enovathemes']['footer-id']) && !empty($GLOBALS['textron_enovathemes']['footer-id'])) ? $GLOBALS['textron_enovathemes']['footer-id'] : "default";

                /* Page
                ---------------*/

                    if (is_page()) {

                        $page_header_desktop_id = get_post_meta( get_the_ID(), 'enovathemes_addons_desktop_header', true );
                        $page_header_mobile_id  = get_post_meta( get_the_ID(), 'enovathemes_addons_mobile_header', true );
                        $page_footer_id         = get_post_meta( get_the_ID(), 'enovathemes_addons_footer', true );
                        $title_section_id       = get_post_meta( get_the_ID(), 'enovathemes_addons_title_section', true );

                        if ($page_header_desktop_id != "inherit") {
                            $header_desktop_id = $page_header_desktop_id;
                        }

                        if ($page_header_mobile_id != "inherit") {
                            $header_mobile_id = $page_header_mobile_id;
                        }

                        if ($page_footer_id != "inherit") {
                            $footer_id = $page_footer_id;
                        }

                        $element_font = get_post_meta(get_the_ID(), 'element_font', true);
                        if (!empty($element_font)) {
                            $global_dynamic_font = array_merge($global_dynamic_font,enovathemes_addons_create_dynamic_scripts($element_font));
                        }

                    }

                /* Blog
                ---------------*/

                    if (is_home() || is_category() || is_tag() || is_day() || is_month() || is_year() || is_author() || is_search() || is_singular('post')) {
                        $title_section_id = $blog_title_id;
                    }

                /*  CPT
                ---------------*/

                    $post_info = get_post(get_the_ID());

                    if (!is_wp_error($post_info) && is_object($post_info)) {

                        $post_type   = $post_info->post_type;

                        if ($post_type != 'post' && $post_type != 'page') {
                            switch ($post_type) {
                                case 'project':
                                    $title_section_id = $project_title_id;
                                    break;
                                case 'product':
                                    $title_section_id = $product_title_id;
                                    break;
                                default :
                                    $title_section_id = $blog_title_id;
                                    break;
                            }
                        }

                    }

                if ($header_desktop_id == $header_mobile_id && $header_desktop_id != "default") {
                    $header_mobile_id = "none";
                }

                /*  Singular header
                ---------------*/

                    if (is_singular('header')) {
                        $header_mobile_id = get_the_ID();
                        $header_desktop_id = get_the_ID();
                    }

                /*  Singular footer
                ---------------*/

                    if (is_singular('footer')) {
                        $footer_id = get_the_ID();
                    }

                /*  Singular title section
                ---------------*/

                    if (is_singular('title_section')) {
                        $title_section_id = get_the_ID();
                    }

                /*  Singular post
                ---------------*/

                    if (is_singular('post')) {
                        $element_font = get_post_meta(get_the_ID(), 'element_font', true);
                        if (!empty($element_font)) {
                            $global_dynamic_font = array_merge($global_dynamic_font,enovathemes_addons_create_dynamic_scripts($element_font));
                        }
                    }

                /*  Singular project
                ---------------*/

                    if (is_singular('project')) {
                        $element_font = get_post_meta(get_the_ID(), 'element_font', true);
                        if (!empty($element_font)) {
                            $global_dynamic_font = array_merge($global_dynamic_font,enovathemes_addons_create_dynamic_scripts($element_font));
                        }
                    }

                /*  Singular product
                ---------------*/

                    if (is_singular('product')) {
                        $element_font = get_post_meta(get_the_ID(), 'element_font', true);
                        if (!empty($element_font)) {
                            $global_dynamic_font = array_merge($global_dynamic_font,enovathemes_addons_create_dynamic_scripts($element_font));
                        }
                    }

                /*  Mobile header
                ---------------*/

                    if ($header_mobile_id != "none" && $header_mobile_id != "default") {
                        $element_font = get_post_meta($header_mobile_id, 'element_font', true);
                        if (!empty($element_font)) {
                            $global_dynamic_font = array_merge($global_dynamic_font,enovathemes_addons_create_dynamic_scripts($element_font));
                        }
                    }

                /*  Desktop header
                ---------------*/

                    if ($header_desktop_id != "none" && $header_desktop_id != "default") {
                        $element_font = get_post_meta($header_desktop_id, 'element_font', true);
                        if (!empty($element_font)) {
                            $global_dynamic_font = array_merge($global_dynamic_font,enovathemes_addons_create_dynamic_scripts($element_font));
                        }
                    }

                /* Megamenu
                --------------*/

                    $query_options = array(
                        'post_type'           => 'megamenu',
                        'post_status'         => 'publish',
                        'ignore_sticky_posts' => 0,
                        'orderby'             => 'title',
                        'order'               => 'ASK',
                        'posts_per_page'      => -1,
                    );

                    $megamenu = new WP_Query($query_options);
                    if ($megamenu->have_posts()){
                        while($megamenu->have_posts()) { $megamenu->the_post();
                            $megamenu_id = get_the_ID();
                            $element_font = get_post_meta($megamenu_id, 'element_font', true);
                            if (!empty($element_font)) {
                                $global_dynamic_font = array_merge($global_dynamic_font,enovathemes_addons_create_dynamic_scripts($element_font));
                            }
                        }
                        wp_reset_postdata();
                    }

                /*  Title section
                ---------------*/

                    if ($title_section_id != "none" && $title_section_id != "default") {
                        $element_font = get_post_meta($title_section_id, 'element_font', true);
                        if (!empty($element_font)) {
                            $global_dynamic_font = array_merge($global_dynamic_font,enovathemes_addons_create_dynamic_scripts($element_font));
                        }
                    }

                /*  Footer
                ---------------*/

                    if ($footer_id != "none" && $footer_id != "default") {
                        $element_font = get_post_meta($footer_id , 'element_font', true);
                        if (!empty($element_font)) {
                            $global_dynamic_font = array_merge($global_dynamic_font,enovathemes_addons_create_dynamic_scripts($element_font));
                        }
                    }

                /*  Dynamic font enqueue
                ---------------*/

                    if (!empty($global_dynamic_font)) {

                        $global_dynamic_font = array_unique($global_dynamic_font,SORT_REGULAR);

                        $global_dynamic_font_result = array();
                        foreach ($global_dynamic_font as $dynamic_font) {

                            if (!isset($global_dynamic_font_result[$dynamic_font['font-name']])){
                                $global_dynamic_font_result[$dynamic_font['font-name']] = $dynamic_font;
                            }else{

                                if (!strpos($global_dynamic_font_result[$dynamic_font['font-name']]['font-style'], $dynamic_font['font-style'])) {
                                    $global_dynamic_font_result[$dynamic_font['font-name']]['font-style'] = $global_dynamic_font_result[$dynamic_font['font-name']]['font-style'].','.$dynamic_font['font-style'];
                                }

                                if (!strpos($global_dynamic_font_result[$dynamic_font['font-name']]['subset'], $dynamic_font['subset'])) {
                                    $global_dynamic_font_result[$dynamic_font['font-name']]['subset'] = $global_dynamic_font_result[$dynamic_font['font-name']]['subset'].','.$dynamic_font['subset'];
                                    $global_dynamic_font_result[$dynamic_font['font-name']]['subset'] = implode(',', array_unique(explode(',', $global_dynamic_font_result[$dynamic_font['font-name']]['subset'])));
                                }

                            }
                        }

                        $global_dynamic_font_string   = '';
                        $global_dynamic_subset_string = '';

                        foreach ($global_dynamic_font_result as $global_dynamic_font_output) {
                            $global_dynamic_font_string .= str_replace(' ', '+', $global_dynamic_font_output['font-name']).':'.$global_dynamic_font_output['font-style'].'|';
                            $global_dynamic_subset_string .= $global_dynamic_font_output['subset'].',';
                        }

                        wp_enqueue_style( 'dynamic-google-fonts', 'https://fonts.googleapis.com/css?family='.rtrim($global_dynamic_font_string,'|').'&amp;subset='.rtrim($global_dynamic_subset_string,','),array(), false );

                    }

            /* Dynamic google fonts >
            ------------------------------------*/

        }
    }
    add_action( 'wp_enqueue_scripts', 'enovathemes_addons_script' );

/*  Header html
/*-------------------*/

    function enovathemes_addons_header_html($header_id, $header_type){

        $query = new WP_Query(array(
            'post_type' => 'header',
            'p'         => $header_id,
        ));
        if ($query->have_posts()) {
            while ( $query->have_posts() ) { $query->the_post();

                $transparent   = get_post_meta($header_id, 'enovathemes_addons_transparent', true);
                $sticky        = get_post_meta($header_id, 'enovathemes_addons_sticky', true);
                $shadow        = get_post_meta($header_id, 'enovathemes_addons_shadow', true);
                $shadow_sticky = get_post_meta($header_id, 'enovathemes_addons_shadow_sticky', true);
                $type          = get_post_meta($header_id, 'enovathemes_addons_header_type', true);

                $transparent      = (empty($transparent)) ? "false" : "true";
                $sticky           = (empty($sticky)) ? "false" : "true";
                $shadow           = (empty($shadow)) ? "false" : "true";
                $shadow_sticky    = (empty($shadow_sticky)) ? "false" : "true";

                $class = array(); ?>

                <?php if ($header_type == "mobile"): ?>

                    <?php

                        $class[] = 'header et-mobile et-clearfix';
                        $class[] = 'transparent-'.$transparent;
                        $class[] = 'sticky-'.$sticky;
                        $class[] = 'shadow-'.$shadow;
                        $class[] = 'shadow-sticky-'.$shadow_sticky;
                        $class[] = 'mobile-true';
                        $class[] = 'desktop-false';

                    ?>

                    <?php if (get_the_content($header_id)): ?>
                        <header id="et-mobile-<?php echo esc_attr($header_id); ?>" class="<?php echo esc_attr(implode(" ", $class)); ?>">
                            <?php
                                $content = do_shortcode(shortcode_unautop(get_the_content($header_id)));
                                $content = str_replace( ']]>', ']]&gt;', $content );
                                $content = str_replace( '<p>[', '[', $content );
                                $content = str_replace( ']</p>', ']', $content );
                                $content = str_replace( ']<br />', ']', $content );
                                echo $content;
                            ?>
                        </header>
                    <?php endif ?>

                <?php elseif($header_type == "desktop"): ?>

                    <?php

                        $class[] = 'header';
                        $class[] = 'et-desktop';
                        $class[] = 'et-clearfix';

                        if ($type == "sidebar") {
                            $class[] = 'side-true';
                        }

                        $class[] = 'transparent-'.$transparent;
                        $class[] = 'sticky-'.$sticky;
                        $class[] = 'shadow-'.$shadow;
                        $class[] = 'shadow-sticky-'.$shadow_sticky;
                        $class[] = 'mobile-false';
                        $class[] = 'desktop-true';

                    ?>
                    <?php if (get_the_content($header_id)): ?>
                        <header id="et-desktop-<?php echo esc_attr($header_id); ?>" class="<?php echo esc_attr(implode(" ", $class)); ?>">
                            <?php
                                $content = do_shortcode(shortcode_unautop(get_the_content($header_id)));
                                $content = str_replace( ']]>', ']]&gt;', $content );
                                $content = str_replace( '<p>[', '[', $content );
                                $content = str_replace( ']</p>', ']', $content );
                                $content = str_replace( ']<br />', ']', $content );
                                echo $content;
                            ?>
                        </header>
                    <?php endif ?>
                <?php endif; ?>

            <?php }
            wp_reset_postdata();
        } else {
            echo '<div class="container"><div class="alert error"><div class="alert-message">'.esc_html__("No custom header is found, make sure you create a one", "enovathemes-addons").'</div></div></div>';
        }
    }

/*  Title section html
/*-------------------*/

    add_filter("the_content", "enovathemes_addons_title_section_filter");
    function enovathemes_addons_title_section_filter($content) {

        if (is_singular('title_section')) {

            $home_link   = esc_url(home_url('/'));
            $home_text   = esc_html__('Home','enovathemes-addons');

            if(!empty(get_option('page_on_front'))){$home_text = get_the_title( get_option('page_on_front') );}

            $text_before = '<span>';
            $text_after  = '</span>';

            $etp_title       = esc_html__("Page title here","textron-enovathemes");
            $etp_subtitle    = esc_html__("Page subtitle here","textron-enovathemes");
            $etp_breadcrumbs = $home_text.' / '.get_the_title();

            $content = str_replace("etp-title-replace-this", $etp_title, $content);
            $content = str_replace("etp-subtitle-replace-this", $etp_subtitle, $content);
            $content = preg_replace("/etp-breadcrumbs-replace-this/", $etp_breadcrumbs, $content);
        }

        return $content;

    }

    function enovathemes_addons_title_section_html($title_section_id, $etp_title, $etp_subtitle, $etp_breadcrumbs){

        $query = new WP_Query(array(
            'post_type' => 'title_section',
            'p'         => $title_section_id,
        ));
        if ($query->have_posts()) {
            while ( $query->have_posts() ) { $query->the_post(); ?>
                <?php if (get_the_content($title_section_id)): ?>
                    <section id="title-section-<?php echo esc_attr($title_section_id); ?>" class="title-section et-clearfix">
                        <?php
                            $content = do_shortcode(get_the_content($title_section_id));
                            $content = str_replace( ']]>', ']]&gt;', $content );
                            $content = str_replace("etp-title-replace-this", $etp_title, $content);
                            $content = str_replace("etp-subtitle-replace-this", $etp_subtitle, $content);
                            $content = preg_replace("/etp-breadcrumbs-replace-this/", $etp_breadcrumbs, $content);
                            echo textron_enovathemes_output_html($content);
                        ?>
                    </section>
                <?php endif ?>
            <?php }
            wp_reset_postdata();
        } else {
            echo '<div class="container"><div class="alert error"><div class="alert-message">'.esc_html__("No custom title section is found, make sure you create a one", "enovathemes-addons").'</div></div></div>';
        }
    }

/*  Footer html
/*-------------------*/

    function enovathemes_addons_footer_html($footer_id){
        $query = new WP_Query(array(
            'post_type' => 'footer',
            'p'         => $footer_id,
        ));
        if ($query->have_posts()) {
            while ( $query->have_posts() ) { $query->the_post();

                $sticky = get_post_meta($footer_id, 'enovathemes_addons_sticky', true);
                $sticky = (empty($sticky)) ? "false" : "true";

                $class = array();

                $class[] = 'footer';
                $class[] = 'et-footer';
                $class[] = 'et-clearfix';
                $class[] = 'sticky-'.$sticky;

                ?>
                <?php if (get_the_content($footer_id)): ?>
                    <footer id="et-footer-<?php echo esc_attr($footer_id); ?>" class="<?php echo esc_attr(implode(" ", $class)); ?>">
                        <?php
                            $content = do_shortcode(get_the_content($footer_id));
                            $content = str_replace( ']]>', ']]&gt;', $content );
                            echo $content;
                        ?>
                    </footer>
                <?php endif ?>
            <?php }
            wp_reset_postdata();
        } else {
            echo '<div class="alert error"><div class="alert-message">'.esc_html__("No custom footer is found, make sure you create a one", "enovathemes-addons").'</div></div>';
        }
    }

/*  Actions/Filters
/*-------------------*/

    register_activation_hook(__FILE__, 'enovathemes_addons_plugin_activate');
    add_action('admin_init', 'enovathemes_addons_plugin_activate');
    function enovathemes_addons_plugin_activate() {
        update_option('uploads_use_yearmonth_folders', false);
    }

    add_filter('body_class', 'enovathemes_addons_general_body_classes');
    function enovathemes_addons_general_body_classes($classes) {

            $custom_class = array();
            $custom_class[] = "addon-active";

            $classes[] = implode(" ", $custom_class);
            return $classes;
    }


    function enovathemes_addons_recursively_parse_nested_shortcodes( $regex, $content, $existing = array() ) {

        if ( is_array( $content ) ) {
            $content = implode( ' ', $content );
        }

        $count = preg_match_all( "/$regex/", $content, $matches );

        if ( $count ) {

            foreach ( $matches[3] as $index => $attributes ) {

                if ( empty( $existing[ $matches[2][ $index ] ] ) ) {
                    $existing[ $matches[2][ $index ] ] = array();
                }

                $shortcode_data = shortcode_parse_atts( $attributes );

                $existing[ $matches[2][ $index ] ][] = $shortcode_data;

            }

            return enovathemes_addons_recursively_parse_nested_shortcodes( $regex, $matches[5], $existing );

        } else {

            return $existing;
        }

    }

    function enovathemes_addons_extract_shortcode_attrs($post_id,$content,$element_css,$element_font){

        global $shortcode_tags;

        $extended_shortcode_tags = $shortcode_tags;
        $extended_shortcode_tags['vc_row'] = 'vc_row';
        $extended_shortcode_tags['vc_row_inner'] = 'vc_row_inner';
        $extended_shortcode_tags['vc_column'] = 'vc_column';
        $extended_shortcode_tags['vc_column_text'] = 'vc_column_text';

        preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
        $tagnames = array_intersect( array_keys( $extended_shortcode_tags ), $matches[1] );

        $shortcode_regex = get_shortcode_regex($tagnames);
        $shortcode_data  = enovathemes_addons_recursively_parse_nested_shortcodes( $shortcode_regex, $content );

        if ($element_css == true) {

            $element_styling = array();

            foreach ($shortcode_data as $shortcode => $attributes) {
                foreach ($attributes as $attribute => $group) {
                    if (is_array($group)) {
                        if (array_key_exists('element_css',$group)) {

                            $element_styling_group = str_replace('dir-child*', '>', $group['element_css']);
                            $element_styling_group = str_replace('|typebutton|', '[type="button"]', $element_styling_group);
                            $element_styling_group = str_replace('|typesubmit|', '[type="submit"]', $element_styling_group);
                            $element_styling[]     = $element_styling_group;
                        }
                    }
                }
            }

            if (!empty($element_styling)) {
                $element_styling = array_unique($element_styling);
                $element_styling = implode('', $element_styling);
                $element_styling = textron_enovathemes_minify_css($element_styling);
            } else {
                $element_styling = '';
            }

            update_post_meta($post_id, "element_css",$element_styling);

        }

        if ($element_font == true) {

            $element_font = array();

            foreach ($shortcode_data as $shortcode => $attributes) {
                foreach ($attributes as $attribute => $group) {
                    if (is_array($group)) {
                        if (array_key_exists('element_font',$group)) {
                            array_push($element_font, $group['element_font']);
                        }
                        if (array_key_exists('subelement_font',$group)) {
                            array_push($element_font, $group['subelement_font']);
                        }
                    }
                }
            }

            if (!empty($element_font)) {
                $element_font = implode(",", $element_font);
            } else {
                $element_font = '';
            }

            update_post_meta($post_id, "element_font",$element_font);

        }

    }

    add_action( 'init', 'enovathemes_addons_init' );
    function enovathemes_addons_init(){

        if (!class_exists('Mobile_Detect')) {
            require_once('includes/Mobile_Detect.php');
        }

        global $textron_enovathemes;

        add_action( 'save_post', 'enovathemes_addons_save_elements_styles', 99, 3);
        function enovathemes_addons_save_elements_styles( $post_id )
        {

            if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
            if (!current_user_can( 'edit_page', $post_id ) ) return;

            $post_info = get_post($post_id);

            if (!is_wp_error($post_info) && is_object($post_info)) {

                $content   = $post_info->post_content;
                $post_type = $post_info->post_type;

                $element_css      = (isset($_POST['element_css'])) ? true : false;
                $element_font     = (isset($_POST['element_font'])) ? true : false;

                enovathemes_addons_extract_shortcode_attrs($post_id,$content,$element_css,$element_font);

                if ($post_type == "megamenu" && isset($_POST['enovathemes_addons_megamenu_width'])) {
                    if ($_POST['enovathemes_addons_megamenu_width'] == 100) {
                        update_post_meta($post_id, "enovathemes_addons_megamenu_position","left");
                        update_post_meta($post_id, "enovathemes_addons_megamenu_offset","");
                    }
                }

                if ($post_type == "header" && isset($_POST['enovathemes_addons_header_type'])) {

                    if ($_POST['enovathemes_addons_header_type'] == 'sidebar') {
                        update_post_meta($post_id, "enovathemes_addons_transparent", "");
                        update_post_meta($post_id, "enovathemes_addons_sticky", "");
                        update_post_meta($post_id, "enovathemes_addons_shadow", "");
                    }

                }

            }

        }

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

            // Disable Gutenberg

            if (isset($GLOBALS['textron_enovathemes']['disable-gutenberg']) && $GLOBALS['textron_enovathemes']['disable-gutenberg'] == 1) {


                $disable_gutenberg_post = (isset($GLOBALS['textron_enovathemes']['disable-gutenberg-type']['post']) && $GLOBALS['textron_enovathemes']['disable-gutenberg-type']['post'] == 1) ? 'true' : 'false';
                $disable_gutenberg_page = (isset($GLOBALS['textron_enovathemes']['disable-gutenberg-type']['page']) && $GLOBALS['textron_enovathemes']['disable-gutenberg-type']['page'] == 1) ? 'true' : 'false';
                $disable_gutenberg_project = (isset($GLOBALS['textron_enovathemes']['disable-gutenberg-type']['project']) && $GLOBALS['textron_enovathemes']['disable-gutenberg-type']['project'] == 1) ? 'true' : 'false';
                $disable_gutenberg_product = (isset($GLOBALS['textron_enovathemes']['disable-gutenberg-type']['product']) && $GLOBALS['textron_enovathemes']['disable-gutenberg-type']['product'] == 1) ? 'true' : 'false';


                function enovathemes_addons_disable_gutenberg_post($is_enabled, $post_type) {
                    if ($post_type === 'post') return false;

                    return $is_enabled;
                }

                if ($disable_gutenberg_post == "true") {
                    add_filter('use_block_editor_for_post_type', 'enovathemes_addons_disable_gutenberg_post', 10, 2);
                }

                function enovathemes_addons_disable_gutenberg_page($is_enabled, $post_type) {
                    if ($post_type === 'page') return false;

                    return $is_enabled;
                }

                if ($disable_gutenberg_page == "true") {
                    add_filter('use_block_editor_for_post_type', 'enovathemes_addons_disable_gutenberg_page', 10, 2);
                }

                function enovathemes_addons_disable_gutenberg_project($is_enabled, $post_type) {
                    if ($post_type === 'project') return false;

                    return $is_enabled;
                }

                if ($disable_gutenberg_project == "true") {
                    add_filter('use_block_editor_for_post_type', 'enovathemes_addons_disable_gutenberg_project', 10, 2);
                }

                function enovathemes_addons_disable_gutenberg_product($is_enabled, $post_type) {
                    if ($post_type === 'product') return false;

                    return $is_enabled;
                }

                if ($disable_gutenberg_product == "true") {
                    add_filter('use_block_editor_for_post_type', 'enovathemes_addons_disable_gutenberg_product', 10, 2);
                }

            }


            $list = array(
                'page',
                'footer',
                'header',
                'megamenu',
                'title_section',
            );

            if(function_exists('vc_set_default_editor_post_types')){
                vc_set_default_editor_post_types( $list );
            }

            vc_add_shortcode_param( 'rv', 'enovathemes_addons_param_settings_rv' );
            function enovathemes_addons_param_settings_rv( $settings, $value ) {

                $output = '';

                $output .= '<span class="vc_description vc_clearfix">'.esc_html__('Responsive visibility options','enovathemes-addons').'</span><br>';
                $output .= '<table class="responsive-visibility">';
                    $output .= '<tr>';
                        $output .= '<th>'.esc_html__('Screen width','enovathemes-addons').'</th>';
                        $output .= '<th>'.esc_html__('Hide?','enovathemes-addons').'</th>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="374">';
                        $output .= '<td class="title">'.esc_html__('max-width 374px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="374" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="375">';
                        $output .= '<td class="title">'.esc_html__('min-width 375px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="375" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="767">';
                        $output .= '<td class="title">'.esc_html__('max-width 767px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="767" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="768">';
                        $output .= '<td class="title">'.esc_html__('min-width 768px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="768" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="768-1023">';
                        $output .= '<td class="title">'.esc_html__('min-width 768px and max-width 1023px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="768-1023" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="1024">';
                        $output .= '<td class="title">'.esc_html__('min-width 1024px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="1024" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="1024-1279">';
                        $output .= '<td class="title">'.esc_html__('min-width 1024px and max-width 1279px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="1024-1279" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="1280">';
                        $output .= '<td class="title">'.esc_html__('min-width 1280px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="1280" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="1280-1599">';
                        $output .= '<td class="title">'.esc_html__('min-width 1280px and max-width 1599px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="1280-1599" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="1600">';
                        $output .= '<td class="title">'.esc_html__('min-width 1600px','enovathemes-addons').'</th>';
                        $output .= '<td class="checkbox"><input type="checkbox" name="1600" class="rvc" value="true"></td>';
                    $output .= '</tr>';
                $output .= '</table>';

                $output.= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />';

                return $output;
            }

            vc_add_shortcode_param( 'crp', 'enovathemes_addons_param_settings_crp' );
            function enovathemes_addons_param_settings_crp( $settings, $value ) {

                $output = '';

                $padding_array = array('i','0');

                for ($i=0; $i <= 50; $i++) {
                    array_push($padding_array, $i);
                }

                $select = '<select class="column-responsive-padding-opt">';
                    $select .= '<option value="i" selected="selected">'.esc_html__('inherit','enovathemes-addons').'</option>';
                    $select .= '<option value="0">0</option>';
                    foreach ($padding_array as $option) {
                        if ($option != "i" && $option != "0") {
                            $select .= '<option value="'.$option.'">'.$option.'%</option>';
                        }
                    }
                $select .= '</select>';

                $output .= '<span class="vc_description vc_clearfix">'.esc_html__('Responsive padding is advanced option designed to take controll over left/right padding','enovathemes-addons').'</span><br>';
                $output .= '<table class="column-responsive-padding">';
                    $output .= '<tr>';
                        $output .= '<th>'.esc_html__('Screen width','enovathemes-addons').'</th>';
                        $output .= '<th>'.esc_html__('Padding left','enovathemes-addons').'</th>';
                        $output .= '<th>'.esc_html__('Padding right','enovathemes-addons').'</th>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="374">';
                        $output .= '<td class="title">'.esc_html__('Max 374 width','enovathemes-addons').'</th>';
                        $output .= '<td class="left">'.$select.'</td>';
                        $output .= '<td class="right">'.$select.'</td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="375-767">';
                        $output .= '<td class="title">'.esc_html__('Min 375 Max 767 width','enovathemes-addons').'</th>';
                        $output .= '<td class="left">'.$select.'</td>';
                        $output .= '<td class="right">'.$select.'</td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="768-1023">';
                        $output .= '<td class="title">'.esc_html__('Min 768 Max 1023 width','enovathemes-addons').'</th>';
                        $output .= '<td class="left">'.$select.'</td>';
                        $output .= '<td class="right">'.$select.'</td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="1024-1279">';
                        $output .= '<td class="title">'.esc_html__('Min 1024 Max 1279 width','enovathemes-addons').'</th>';
                        $output .= '<td class="left">'.$select.'</td>';
                        $output .= '<td class="right">'.$select.'</td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="1280-1599">';
                        $output .= '<td class="title">'.esc_html__('Min 1280 Max 1599 width','enovathemes-addons').'</th>';
                        $output .= '<td class="left">'.$select.'</td>';
                        $output .= '<td class="right">'.$select.'</td>';
                    $output .= '</tr>';
                    $output .= '<tr class="media-query" data-query="1600-1919">';
                        $output .= '<td class="title">'.esc_html__('Min 1600 Max 1919 width','enovathemes-addons').'</th>';
                        $output .= '<td class="left">'.$select.'</td>';
                        $output .= '<td class="right">'.$select.'</td>';
                    $output .= '</tr>';
                $output .= '</table>';

                $output.= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />';

                return $output;
            }

            vc_add_shortcode_param( 'margin', 'enovathemes_addons_param_settings_margin' );
            function enovathemes_addons_param_settings_margin( $settings, $value ) {

                $output = '';
                $output .= '<span class="vc_description vc_clearfix">'.esc_html__('Use only numbers without any string. Default unit is px','enovathemes-addons').'</span><br>';
                $output .= '<form class="margin-box">';
                     $output .= '<input class="margin-input" type="text" value="0" name="margin-left" />';
                     $output .= '<input class="margin-input" type="text" value="0" name="margin-top" />';
                     $output .= '<input class="margin-input" type="text" value="0" name="margin-right" />';
                     $output .= '<input class="margin-input" type="text" value="0" name="margin-bottom" />';
                     $output .= '<div class="element">'.esc_html__("Element", "enovathemes-addons").'</div>';
                $output .= '</form>';
                $output.= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />';
                return $output;
            }

            vc_add_shortcode_param( 'padding', 'enovathemes_addons_param_settings_padding' );
            function enovathemes_addons_param_settings_padding( $settings, $value ) {

                $output = '';
                $output .= '<span class="vc_description vc_clearfix">'.esc_html__('Use only numbers without any string. Default unit is px','enovathemes-addons').'</span><br>';
                $output .= '<form class="padding-box">';
                     $output .= '<input class="padding-input" type="text" value="0" name="padding-left" />';
                     $output .= '<input class="padding-input" type="text" value="0" name="padding-top" />';
                     $output .= '<input class="padding-input" type="text" value="0" name="padding-right" />';
                     $output .= '<input class="padding-input" type="text" value="0" name="padding-bottom" />';
                     $output .= '<div class="element">'.esc_html__("Element", "enovathemes-addons").'</div>';
                $output .= '</form>';
                $output.= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />';
                return $output;
            }

            function enovathemes_addons_vc_param_animation_style_list( $styles ) {
                $styles = array(
                    array(
                        'values' => array(
                            esc_html__( 'None', 'enovathemes-addons' ) => 'none',
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Attention Seekers', 'enovathemes-addons' ),
                        'values' => array(
                            // text to display => value
                            esc_html__( 'bounce', 'enovathemes-addons' ) => array(
                                'value' => 'bounce',
                                'type' => 'other',
                            ),
                            esc_html__( 'flash', 'enovathemes-addons' ) => array(
                                'value' => 'flash',
                                'type' => 'other',
                            ),
                            esc_html__( 'pulse', 'enovathemes-addons' ) => array(
                                'value' => 'pulse',
                                'type' => 'other',
                            ),
                            esc_html__( 'rubberBand', 'enovathemes-addons' ) => array(
                                'value' => 'rubberBand',
                                'type' => 'other',
                            ),
                            esc_html__( 'shake', 'enovathemes-addons' ) => array(
                                'value' => 'shake',
                                'type' => 'other',
                            ),
                            esc_html__( 'swing', 'enovathemes-addons' ) => array(
                                'value' => 'swing',
                                'type' => 'other',
                            ),
                            esc_html__( 'tada', 'enovathemes-addons' ) => array(
                                'value' => 'tada',
                                'type' => 'other',
                            ),
                            esc_html__( 'wobble', 'enovathemes-addons' ) => array(
                                'value' => 'wobble',
                                'type' => 'other',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Bouncing Entrances', 'enovathemes-addons' ),
                        'values' => array(
                            // text to display => value
                            esc_html__( 'bounceIn', 'enovathemes-addons' ) => array(
                                'value' => 'bounceIn',
                                'type' => 'in',
                            ),
                            esc_html__( 'bounceInDown', 'enovathemes-addons' ) => array(
                                'value' => 'bounceInDown',
                                'type' => 'in',
                            ),
                            esc_html__( 'bounceInLeft', 'enovathemes-addons' ) => array(
                                'value' => 'bounceInLeft',
                                'type' => 'in',
                            ),
                            esc_html__( 'bounceInRight', 'enovathemes-addons' ) => array(
                                'value' => 'bounceInRight',
                                'type' => 'in',
                            ),
                            esc_html__( 'bounceInUp', 'enovathemes-addons' ) => array(
                                'value' => 'bounceInUp',
                                'type' => 'in',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Bouncing Exits', 'enovathemes-addons' ),
                        'values' => array(
                            // text to display => value
                            esc_html__( 'bounceOut', 'enovathemes-addons' ) => array(
                                'value' => 'bounceOut',
                                'type' => 'out',
                            ),
                            esc_html__( 'bounceOutDown', 'enovathemes-addons' ) => array(
                                'value' => 'bounceOutDown',
                                'type' => 'out',
                            ),
                            esc_html__( 'bounceOutLeft', 'enovathemes-addons' ) => array(
                                'value' => 'bounceOutLeft',
                                'type' => 'out',
                            ),
                            esc_html__( 'bounceOutRight', 'enovathemes-addons' ) => array(
                                'value' => 'bounceOutRight',
                                'type' => 'out',
                            ),
                            esc_html__( 'bounceOutUp', 'enovathemes-addons' ) => array(
                                'value' => 'bounceOutUp',
                                'type' => 'out',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Fading Entrances', 'enovathemes-addons' ),
                        'values' => array(
                            // text to display => value
                            esc_html__( 'fadeIn', 'enovathemes-addons' ) => array(
                                'value' => 'fadeIn',
                                'type' => 'in',
                            ),
                            esc_html__( 'fadeInDown', 'enovathemes-addons' ) => array(
                                'value' => 'fadeInDown',
                                'type' => 'in',
                            ),
                            esc_html__( 'fadeInDownBig', 'enovathemes-addons' ) => array(
                                'value' => 'fadeInDownBig',
                                'type' => 'in',
                            ),
                            esc_html__( 'fadeInLeft', 'enovathemes-addons' ) => array(
                                'value' => 'fadeInLeft',
                                'type' => 'in',
                            ),
                            esc_html__( 'fadeInLeftBig', 'enovathemes-addons' ) => array(
                                'value' => 'fadeInLeftBig',
                                'type' => 'in',
                            ),
                            esc_html__( 'fadeInRight', 'enovathemes-addons' ) => array(
                                'value' => 'fadeInRight',
                                'type' => 'in',
                            ),
                            esc_html__( 'fadeInRightBig', 'enovathemes-addons' ) => array(
                                'value' => 'fadeInRightBig',
                                'type' => 'in',
                            ),
                            esc_html__( 'fadeInUp', 'enovathemes-addons' ) => array(
                                'value' => 'fadeInUp',
                                'type' => 'in',
                            ),
                            esc_html__( 'fadeInUpBig', 'enovathemes-addons' ) => array(
                                'value' => 'fadeInUpBig',
                                'type' => 'in',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Fading Exits', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'fadeOut', 'enovathemes-addons' ) => array(
                                'value' => 'fadeOut',
                                'type' => 'out',
                            ),
                            esc_html__( 'fadeOutDown', 'enovathemes-addons' ) => array(
                                'value' => 'fadeOutDown',
                                'type' => 'out',
                            ),
                            esc_html__( 'fadeOutDownBig', 'enovathemes-addons' ) => array(
                                'value' => 'fadeOutDownBig',
                                'type' => 'out',
                            ),
                            esc_html__( 'fadeOutLeft', 'enovathemes-addons' ) => array(
                                'value' => 'fadeOutLeft',
                                'type' => 'out',
                            ),
                            esc_html__( 'fadeOutLeftBig', 'enovathemes-addons' ) => array(
                                'value' => 'fadeOutLeftBig',
                                'type' => 'out',
                            ),
                            esc_html__( 'fadeOutRight', 'enovathemes-addons' ) => array(
                                'value' => 'fadeOutRight',
                                'type' => 'out',
                            ),
                            esc_html__( 'fadeOutRightBig', 'enovathemes-addons' ) => array(
                                'value' => 'fadeOutRightBig',
                                'type' => 'out',
                            ),
                            esc_html__( 'fadeOutUp', 'enovathemes-addons' ) => array(
                                'value' => 'fadeOutUp',
                                'type' => 'out',
                            ),
                            esc_html__( 'fadeOutUpBig', 'enovathemes-addons' ) => array(
                                'value' => 'fadeOutUpBig',
                                'type' => 'out',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Flippers', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'flip', 'enovathemes-addons' ) => array(
                                'value' => 'flip',
                                'type' => 'other',
                            ),
                            esc_html__( 'flipInX', 'enovathemes-addons' ) => array(
                                'value' => 'flipInX',
                                'type' => 'in',
                            ),
                            esc_html__( 'flipInY', 'enovathemes-addons' ) => array(
                                'value' => 'flipInY',
                                'type' => 'in',
                            ),
                            esc_html__( 'flipOutX', 'enovathemes-addons' ) => array(
                                'value' => 'flipOutX',
                                'type' => 'out',
                            ),
                            esc_html__( 'flipOutY', 'enovathemes-addons' ) => array(
                                'value' => 'flipOutY',
                                'type' => 'out',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Lightspeed', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'lightSpeedIn', 'enovathemes-addons' ) => array(
                                'value' => 'lightSpeedIn',
                                'type' => 'in',
                            ),
                            esc_html__( 'lightSpeedOut', 'enovathemes-addons' ) => array(
                                'value' => 'lightSpeedOut',
                                'type' => 'out',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Rotating Entrances', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'rotateIn', 'enovathemes-addons' ) => array(
                                'value' => 'rotateIn',
                                'type' => 'in',
                            ),
                            esc_html__( 'rotateInDownLeft', 'enovathemes-addons' ) => array(
                                'value' => 'rotateInDownLeft',
                                'type' => 'in',
                            ),
                            esc_html__( 'rotateInDownRight', 'enovathemes-addons' ) => array(
                                'value' => 'rotateInDownRight',
                                'type' => 'in',
                            ),
                            esc_html__( 'rotateInUpLeft', 'enovathemes-addons' ) => array(
                                'value' => 'rotateInUpLeft',
                                'type' => 'in',
                            ),
                            esc_html__( 'rotateInUpRight', 'enovathemes-addons' ) => array(
                                'value' => 'rotateInUpRight',
                                'type' => 'in',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Rotating Exits', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'rotateOut', 'enovathemes-addons' ) => array(
                                'value' => 'rotateOut',
                                'type' => 'out',
                            ),
                            esc_html__( 'rotateOutDownLeft', 'enovathemes-addons' ) => array(
                                'value' => 'rotateOutDownLeft',
                                'type' => 'out',
                            ),
                            esc_html__( 'rotateOutDownRight', 'enovathemes-addons' ) => array(
                                'value' => 'rotateOutDownRight',
                                'type' => 'out',
                            ),
                            esc_html__( 'rotateOutUpLeft', 'enovathemes-addons' ) => array(
                                'value' => 'rotateOutUpLeft',
                                'type' => 'out',
                            ),
                            esc_html__( 'rotateOutUpRight', 'enovathemes-addons' ) => array(
                                'value' => 'rotateOutUpRight',
                                'type' => 'out',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Specials', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'hinge', 'enovathemes-addons' ) => array(
                                'value' => 'hinge',
                                'type' => 'out',
                            ),
                            esc_html__( 'rollIn', 'enovathemes-addons' ) => array(
                                'value' => 'rollIn',
                                'type' => 'in',
                            ),
                            esc_html__( 'rollOut', 'enovathemes-addons' ) => array(
                                'value' => 'rollOut',
                                'type' => 'out',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Zoom Entrances', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'zoomIn', 'enovathemes-addons' ) => array(
                                'value' => 'zoomIn',
                                'type' => 'in',
                            ),
                            esc_html__( 'zoomInDown', 'enovathemes-addons' ) => array(
                                'value' => 'zoomInDown',
                                'type' => 'in',
                            ),
                            esc_html__( 'zoomInLeft', 'enovathemes-addons' ) => array(
                                'value' => 'zoomInLeft',
                                'type' => 'in',
                            ),
                            esc_html__( 'zoomInRight', 'enovathemes-addons' ) => array(
                                'value' => 'zoomInRight',
                                'type' => 'in',
                            ),
                            esc_html__( 'zoomInUp', 'enovathemes-addons' ) => array(
                                'value' => 'zoomInUp',
                                'type' => 'in',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Zoom Exits', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'zoomOut', 'enovathemes-addons' ) => array(
                                'value' => 'zoomOut',
                                'type' => 'out',
                            ),
                            esc_html__( 'zoomOutDown', 'enovathemes-addons' ) => array(
                                'value' => 'zoomOutDown',
                                'type' => 'out',
                            ),
                            esc_html__( 'zoomOutLeft', 'enovathemes-addons' ) => array(
                                'value' => 'zoomOutLeft',
                                'type' => 'out',
                            ),
                            esc_html__( 'zoomOutRight', 'enovathemes-addons' ) => array(
                                'value' => 'zoomOutRight',
                                'type' => 'out',
                            ),
                            esc_html__( 'zoomOutUp', 'enovathemes-addons' ) => array(
                                'value' => 'zoomOutUp',
                                'type' => 'out',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Slide Entrances', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'slideInDown', 'enovathemes-addons' ) => array(
                                'value' => 'slideInDown',
                                'type' => 'in',
                            ),
                            esc_html__( 'slideInLeft', 'enovathemes-addons' ) => array(
                                'value' => 'slideInLeft',
                                'type' => 'in',
                            ),
                            esc_html__( 'slideInRight', 'enovathemes-addons' ) => array(
                                'value' => 'slideInRight',
                                'type' => 'in',
                            ),
                            esc_html__( 'slideInUp', 'enovathemes-addons' ) => array(
                                'value' => 'slideInUp',
                                'type' => 'in',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Slide Exits', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'slideOutDown', 'enovathemes-addons' ) => array(
                                'value' => 'slideOutDown',
                                'type' => 'out',
                            ),
                            esc_html__( 'slideOutLeft', 'enovathemes-addons' ) => array(
                                'value' => 'slideOutLeft',
                                'type' => 'out',
                            ),
                            esc_html__( 'slideOutRight', 'enovathemes-addons' ) => array(
                                'value' => 'slideOutRight',
                                'type' => 'out',
                            ),
                            esc_html__( 'slideOutUp', 'enovathemes-addons' ) => array(
                                'value' => 'slideOutUp',
                                'type' => 'out',
                            ),
                        ),
                    ),
                    array(
                        'label' => esc_html__( 'Defaults', 'enovathemes-addons' ),
                        'values' => array(
                            esc_html__( 'Top to bottom', 'enovathemes-addons' ) => array(
                                'value' => 'top-to-bottom',
                                'type' => 'in',
                            ),
                            esc_html__( 'Bottom to top', 'enovathemes-addons' ) => array(
                                'value' => 'bottom-to-top',
                                'type' => 'in',
                            ),
                            esc_html__( 'Left to right', 'enovathemes-addons' ) => array(
                                'value' => 'left-to-right',
                                'type' => 'in',
                            ),
                            esc_html__( 'Right to left', 'enovathemes-addons' ) => array(
                                'value' => 'right-to-left',
                                'type' => 'in',
                            ),
                            esc_html__( 'Appear from center', 'enovathemes-addons' ) => array(
                                'value' => 'appear',
                                'type' => 'in',
                            ),
                        ),
                    ),
                );
                return $styles;
            }
            add_filter( 'vc_param_animation_style_list', 'enovathemes_addons_vc_param_animation_style_list' );
        }

    }

    add_action( 'pre_get_posts', 'enovathemes_addons_pre_get_post' );
    function enovathemes_addons_pre_get_post( $query ) {

        global $textron_enovathemes;

        if( (is_post_type_archive( 'project' ) || is_tax( 'project-category' ) || is_tax( 'project-tag' )) && !is_admin() && $query->is_main_query() ) {

            $project_per_page   = (isset($GLOBALS['textron_enovathemes']['project-per-page']) && !empty($GLOBALS['textron_enovathemes']['project-per-page'])) ? $GLOBALS['textron_enovathemes']['project-per-page'] : get_option( 'posts_per_page' );

            $query->set( 'posts_per_page', $project_per_page );
            $query->set( 'order_by', 'date' );
            $query->set( 'order', 'DESK' );

        }

        if( (is_post_type_archive( 'product' ) || is_tax( 'product_cat' ) || is_tax( 'product_tag' )) && !is_admin() && $query->is_main_query() ) {

            $product_per_page  = (isset($GLOBALS['textron_enovathemes']['product-per-page']) && !empty($GLOBALS['textron_enovathemes']['product-per-page'])) ? $GLOBALS['textron_enovathemes']['product-per-page'] : get_option( 'posts_per_page' );

            $query->set( 'posts_per_page', $product_per_page );
            $query->set( 'order_by', 'date' );
            $query->set( 'order', 'DESK' );

        }

    }

    remove_filter( 'the_content', 'wp_make_content_images_responsive' );
    add_action('init', 'enovathemes_addons_disable_responsive_images');
    function enovathemes_addons_disable_responsive_images() {

        add_filter( 'wp_get_attachment_image_attributes', function( $attr ){
            if( isset( $attr['sizes'] ) ){unset( $attr['sizes'] );}
            if( isset( $attr['srcset'] ) ){unset( $attr['srcset'] );}
            $attr['data-responsive-images'] = 'false';
            $attr['alt'] = esc_html(get_the_title(get_the_ID()));
            return $attr;

        }, PHP_INT_MAX );

        add_filter( 'wp_calculate_image_sizes', '__return_empty_array',  PHP_INT_MAX );
        add_filter( 'wp_calculate_image_srcset', '__return_empty_array', PHP_INT_MAX );
        remove_filter( 'the_content', 'wp_make_content_images_responsive' );
    }

    add_action( 'redux/loaded', 'textron_enovathemes_remove_demo' );
    if ( ! function_exists( 'textron_enovathemes_remove_demo' ) ) {
        function textron_enovathemes_remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

/*  Visual composer front-end save
/*-------------------*/

    function enovathemes_addons_et_vc_save(){

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

            if (isset($_POST["post_id"]) && !empty($_POST["post_id"])) {

                $post_id   = $_POST["post_id"];
                $post_info = get_post($post_id);

                if (!is_wp_error($post_info) && is_object($post_info)) {

                    $post_type = $post_info->post_type;

                    if (
                        $post_type == "post" ||
                        $post_type == "page" ||
                        $post_type == "project" ||
                        $post_type == "product" ||
                        $post_type == "header" ||
                        $post_type == "footer" ||
                        $post_type == "megamenu" ||
                        $post_type == "title_section"
                    ) {
                        $element_css  = true;
                        $element_font = true;
                        $content      = urldecode($_POST["content"]);

                        if (!empty($content)) {
                            enovathemes_addons_extract_shortcode_attrs($post_id,$content,$element_css,$element_font);
                        }
                    }

                }

            }
            die;

        }

        die();

    }

    add_action('wp_ajax_nopriv_et_vc_save', 'enovathemes_addons_et_vc_save');
    add_action('wp_ajax_et_vc_save', 'enovathemes_addons_et_vc_save');

/*  Fast contact form
/*-------------------*/

    function enovathemes_addons_et_contact_form_send(){

        if ( ! isset( $_POST['et_contact_form_nonce'] ) || !wp_verify_nonce( $_POST['et_contact_form_nonce'], 'et_contact_form_action' )) {
           echo esc_html__("Sorry, your nonce did not verify.", "enovathemes-addons");
           exit;
        } else {

            $name    = strip_tags(trim($_POST["name"]));
            $name    = str_replace(array("\r","\n"),array(" "," "),$name);
            $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $recipient = filter_var(trim($_POST["recipient"]), FILTER_SANITIZE_EMAIL);
            $message = trim($_POST["message"]);

            // Check that data was sent to the mailer.
            if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Set a 400 (bad request) response code and exit.
                http_response_code(400);
                echo esc_html__("Oops! There was a problem with your submission. Please complete the form and try again.", "enovathemes-addons");
                exit;
            }

            if (empty($recipient)) {
                $recipient = get_option('admin_email');
            }

            // Set the email subject.
            $subject = esc_html__("Fast contact mail from ", "enovathemes-addons")." ".$name;

            // Build the email content.
            $email_content .= esc_html__("Name: ", "enovathemes-addons").$name."\n";
            $email_content .= esc_html__("Email: ", "enovathemes-addons").$email."\n";
            $email_content .= esc_html__("Message: ", "enovathemes-addons")."\n\n".$message."\n";

            // Build the email headers.
            $email_headers = "From: $name <$email>";

            // Send the email.
            if (wp_mail($recipient, $subject, $email_content, $email_headers)) {
                // Set a 200 (okay) response code.
                http_response_code(200);
                echo esc_html__("Thank You! Your message has been sent.", "enovathemes-addons");
            } else {
                // Set a 500 (internal server error) response code.
                http_response_code(500);
                echo esc_html__("Oops! Something went wrong and we couldn't send your message.", "enovathemes-addons");
            }
            die;

        }
    }

    add_action('admin_post_nopriv_et_contact_form', 'enovathemes_addons_et_contact_form_send');
    add_action('admin_post_et_contact_form', 'enovathemes_addons_et_contact_form_send');

/*  Instagram
/*-------------------*/

    function enovathemes_addons_scrape_instagram( $username ) {

        $username = trim( strtolower( $username ) );

        switch ( substr( $username, 0, 1 ) ) {
            case '#':
                $url              = '//instagram.com/explore/tags/' . str_replace( '#', '', $username );
                $transient_prefix = 'h';
                break;

            default:
                $url              = '//instagram.com/' . str_replace( '@', '', $username );
                $transient_prefix = 'u';
                break;
        }

        if ( false === ( $instagram = get_transient( 'instagram-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ) ) ) ) {

            $remote = wp_remote_get( $url );

            if ( is_wp_error( $remote ) ) {
                return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'enovathemes-addons' ) );
            }

            if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
                return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'enovathemes-addons' ) );
            }

            $shards      = explode( 'window._sharedData = ', $remote['body'] );
            $insta_json  = explode( ';</script>', $shards[1] );
            $insta_array = json_decode( $insta_json[0], true );

            if ( ! $insta_array ) {
                return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'enovathemes-addons' ) );
            }

            if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
            } elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
                $images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
            } else {
                return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'enovathemes-addons' ) );
            }

            if ( ! is_array( $images ) ) {
                return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'enovathemes-addons' ) );
            }

            $instagram = array();

            foreach ( $images as $image ) {
                if ( true === $image['node']['is_video'] ) {
                    $type = 'video';
                } else {
                    $type = 'image';
                }

                $caption = __( 'Instagram Image', 'enovathemes-addons' );
                if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
                    $caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
                }

                $instagram[] = array(
                    'description' => $caption,
                    'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
                    'time'        => $image['node']['taken_at_timestamp'],
                    'comments'    => $image['node']['edge_media_to_comment']['count'],
                    'likes'       => $image['node']['edge_liked_by']['count'],
                    'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
                    'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
                    'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
                    'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
                    'type'        => $type,
                );
            } // End foreach().

            // do not set an empty transient - should help catch private or empty accounts.
            if ( ! empty( $instagram ) ) {
                $instagram = base64_encode( serialize( $instagram ) );
                set_transient( 'instagram-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
            }
        }

        if ( ! empty( $instagram ) ) {

            return unserialize( base64_decode( $instagram ) );

        } else {

            return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'enovathemes-addons' ) );

        }
    }

/*  Google fonts
/*-------------------*/

    function enovathemes_addons_google_fonts() {

        $api_key = 'AIzaSyD4_siUiwNbGDKcVNPQjCl-6eyzhctrPsM';
        $url     = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . $api_key;

        $transient_prefix = $api_key;

        if ( false === ( $google_fonts = get_transient( 'gfonts-' . $transient_prefix . '-enovathemes' ) ) ) {

            $remote = wp_remote_get( $url );

            if ( is_wp_error( $remote ) ) {
                return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Google fonts.', 'enovathemes-addons' ) );
            }

            if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
                return new WP_Error( 'invalid_response', esc_html__( 'Google fonts did not return a 200.', 'enovathemes-addons' ) );
            }

            $gfonts_array = json_decode( $remote['body'], true );

            if ( ! $gfonts_array ) {
                return new WP_Error( 'bad_json', esc_html__( 'Google fonts has returned invalid data.', 'enovathemes-addons' ) );
            }

            if ( isset( $gfonts_array['items'] ) ) {
                $fonts = $gfonts_array['items'];
            } else {
                return new WP_Error( 'bad_json_2', esc_html__( 'Google fonts has returned invalid data.', 'enovathemes-addons' ) );
            }

            if ( ! is_array( $fonts ) ) {
                return new WP_Error( 'bad_array', esc_html__( 'Google fonts has returned invalid data.', 'enovathemes-addons' ) );
            }

            foreach ( $fonts as $font ) {
                $google_fonts[] = array(
                    'family'   => $font['family'],
                    'variants' => $font['variants'],
                    'subsets'  => $font['subsets']
                );
            } // End foreach().

            // do not set an empty transient - should help catch private or empty accounts.
            if ( ! empty( $google_fonts ) ) {
                $google_fonts = base64_encode( serialize( $google_fonts ) );
                set_transient( 'gfonts-' . $transient_prefix . '-enovathemes', $google_fonts, apply_filters( 'null_gfonts_cache_time', MONTH_IN_SECONDS * 2 ) );
            }
        }

        if ( ! empty( $google_fonts ) ) {

            return unserialize( base64_decode( $google_fonts ) );

        } else {

            return new WP_Error( 'no_fonts', esc_html__( 'Google fonts did not return any fonts.', 'enovathemes-addons' ) );

        }
    }

    function enovathemes_addons_create_dynamic_scripts($element_font){
        if (!empty($element_font)) {

            $element_font_builder = array();

            $element_font = explode(",", $element_font);

            foreach ($element_font as $font) {
                $font = explode(":", $font);
                array_push($element_font_builder, $font);
            }

            $element_font_result = array();
            foreach ($element_font_builder as $font_style) {

                if (!isset($element_font_result[$font_style[0]])){
                    $element_font_result[$font_style[0]] = $font_style;
                }else{

                    if (array_key_exists(2,$font_style)) {

                        if (strpos($element_font_result[$font_style[0]][1], $font_style['1'])) {
                            $element_font_result[$font_style[0]][2] = $element_font_result[$font_style[0]][2];
                        } else {
                            $element_font_result[$font_style[0]][1] = $element_font_result[$font_style[0]][1].','.$font_style['1'];
                            $element_font_result[$font_style[0]][2] = $element_font_result[$font_style[0]][2];
                        }

                    } else {
                        if (strpos($element_font_result[$font_style[0]][1], $font_style['1']) !== false) {
                            $element_font_result[$font_style[0]][2] = $element_font_result[$font_style[0]][2];
                        }
                    }

                }
            }

            $element_font_result = array_values($element_font_result);

            $element_font_output = array();

            foreach ($element_font_result as $font_output) {

                if ($font_output[0] != "Theme default") {
                    $font_output = array(str_replace(' ', '+', $font_output[0]),$font_output[1],$font_output[2]);
                    array_push($element_font_output, array(
                        'font-name' => $font_output[0],
                        'font-style'=> str_replace('italic','i',$font_output[1]),
                        'subset'    => $font_output[2]
                    ));
                }

            }

            return $element_font_output;
        }
    }

/*  Flickr
/*-------------------*/

    function enovathemes_addons_flickr($user_id,$per_page) {

        global $textron_enovathemes;
        $api_key = (isset($textron_enovathemes['flickr-api']) && !empty($textron_enovathemes['flickr-api'])) ? esc_attr($textron_enovathemes['flickr-api']): "";

        $transient_prefix = $api_key.esc_attr($user_id);

        if ( false === ( $flickr_images = get_transient( 'flickr-' . $transient_prefix . '-enovathemes' ) ) ) {

            $params = array(
                'api_key'   => $api_key,
                'method'    => 'flickr.people.getPublicPhotos',
                'user_id'   => $user_id,
                'per_page'  => $per_page,
                'format'    => 'php_serial',
                'content_type' => 1,
                'privacy_filter' => 1,
                'extras'    => 'url_q'
            );

            $encoded_params = array();
            foreach ($params as $k => $v){
                $encoded_params[] = urlencode($k).'='.urlencode($v);
            }

            $url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);

            $rsp = file_get_contents($url);

            if ($rsp === FALSE) {
                return new WP_Error( 'flickr_no_images', esc_html__( 'Server Error. Not data is found', 'enovathemes-addons' ) );
            }

            $rsp_obj = unserialize($rsp);

            if ($rsp_obj['stat'] == 'ok'){

                if ($rsp_obj['photos']['photo']) {
                    foreach ( $rsp_obj['photos']['photo'] as $photo ) {
                        $flickr_images[] = array(
                            'url_q'   => $photo['url_q'],
                            'url_o'   => '//flickr.com/photos/'.$user_id,
                        );
                    }
                } else {
                    return new WP_Error( 'flickr_no_images', esc_html__( 'Flickr did not find any images.', 'enovathemes-addons' ) );
                }

                // do not set an empty transient - should help catch private or empty accounts.
                if ( ! empty( $flickr_images ) ) {
                    set_transient( 'flickr-' . $transient_prefix . '-enovathemes', $flickr_images, apply_filters( 'null_flickr_cache_time', HOUR_IN_SECONDS * 2 ) );
                }
            } else {
                return $rsp_obj['message'];
            }

        }

        if ( ! empty( $flickr_images ) ) {
            return $flickr_images;
        } else {
            return new WP_Error( 'flickr_no_images', esc_html__( 'Flickr did not find any images.', 'enovathemes-addons' ) );
        }
    }

/*  Mailchimp
/*-------------------*/

    function enovathemes_addons_mailchimp_curl_connect( $url, $request_type, $api_key, $data = array() ) {
        if( $request_type == 'GET' )
            $url .= '?' . http_build_query($data);

        $mch = curl_init();
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Basic '.base64_encode( 'user:'. $api_key )
        );
        curl_setopt($mch, CURLOPT_URL, $url );
        curl_setopt($mch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($mch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($mch, CURLOPT_RETURNTRANSFER, true); // do not echo the result, write it into variable
        curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type); // according to MailChimp API: POST/GET/PATCH/PUT/DELETE
        curl_setopt($mch, CURLOPT_TIMEOUT, 10);
        curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false); // certificate verification for TLS/SSL connection

        if( $request_type != 'GET' ) {
            curl_setopt($mch, CURLOPT_POST, true);
            curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
        }

        return curl_exec($mch);
    }

    function enovathemes_addons_mailchimp_subscriber_status( $email, $status, $list_id, $api_key, $merge_fields = array('FNAME' => '','LNAME' => '','ADDRESS' => '','PHONE' => '') ){

        $data = array(
            'apikey'        => $api_key,
            'email_address' => $email,
            'status'        => $status,
            'merge_fields'  => $merge_fields
        );
        $mch_api = curl_init(); // initialize cURL connection

        curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
        curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
        curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
        curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
        curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
        curl_setopt($mch_api, CURLOPT_POST, true);
        curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json

        $result = curl_exec($mch_api);
        return $result;
    }

    function enovathemes_addons_mailchimp_list() {

        global $textron_enovathemes;
        $mailchimp_api_key = (isset($textron_enovathemes['mailchimp-api-key']) && !empty($textron_enovathemes['mailchimp-api-key'])) ? esc_attr($textron_enovathemes['mailchimp-api-key']): "";

        $api_key = $mailchimp_api_key;
        $transient_prefix = $api_key;

        if (empty($api_key)) {
            return new WP_Error( 'no_api_key', esc_html__( 'No Mailchimp API key is found. Go to theme options >> general >> Mailchimp API key', 'enovathemes-addons' ) );
        }

        $url = 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/';

        if ( false === ( $mailchimp_list = get_transient( 'mailchimp-' . $transient_prefix . '-enovathemes' ) ) ) {

            $data = array(
                'fields' => 'lists',
                'count' => 'all',
            );

            $result = json_decode( enovathemes_addons_mailchimp_curl_connect( $url, 'GET', $api_key, $data) );

            if (! $result ) {
                return new WP_Error( 'bad_json', esc_html__( 'Mailchimp has returned invalid data.', 'enovathemes-addons' ) );
            }

            if ( !empty( $result->lists ) ) {
                foreach( $result->lists as $list ){
                    $mailchimp_list[] = array(
                        'id'      => $list->id,
                        'name'    => $list->name,
                    );
                }
            } elseif(is_int( $result->status)) {
                return '<strong>' . $result->title . ':</strong> ' . $result->detail;
            } else {
                return new WP_Error( 'bad_json_2', esc_html__( 'Mailchimp has returned invalid data.', 'enovathemes-addons' ) );
            }

            // do not set an empty transient - should help catch private or empty accounts.
            if ( ! empty( $mailchimp_list ) ) {
                $mailchimp_list = base64_encode( serialize( $mailchimp_list ) );
                set_transient( 'mailchimp-' . $transient_prefix . '-enovathemes', $mailchimp_list, apply_filters( 'null_mailchimp_cache_time', WEEK_IN_SECONDS * 2 ) );
            }
        }

        if ( ! empty( $mailchimp_list ) ) {

            return unserialize( base64_decode( $mailchimp_list ) );

        } else {

            return new WP_Error( 'no_list', esc_html__( 'Mailchimp did not return any list.', 'enovathemes-addons' ) );

        }
    }

    function enovathemes_addons_mailchimp_subscribe(){

        global $post, $textron_enovathemes;

        if ( ! isset( $_POST['et_mailchimp_nonce'] ) || !wp_verify_nonce( $_POST['et_mailchimp_nonce'], 'et_mailchimp_action' )) {
           echo esc_html__("Sorry, your nonce did not verify.", "enovathemes-addons");
           exit;
        } else {

            $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $fname   = strip_tags(trim($_POST["fname"]));
            $lname   = strip_tags(trim($_POST["lname"]));
            $phone   = strip_tags(trim($_POST["phone"]));
            $list    = strip_tags(trim($_POST["list"]));

            $list_id = $list;
            $api_key = (isset($textron_enovathemes['mailchimp-api-key']) && !empty($textron_enovathemes['mailchimp-api-key'])) ? esc_attr($textron_enovathemes['mailchimp-api-key']): "";
            $result  = json_decode( enovathemes_addons_mailchimp_subscriber_status($email, 'subscribed', $list_id, $api_key, array('FNAME' => $fname,'LNAME' => $lname,'PHONE' => $phone) ) );

            if( $result->status == 400 ){
                foreach( $result->errors as $error ) {
                    echo '<p>Error: ' . $error->message . '</p>';
                }
            } elseif( $result->status == 'subscribed' ){
                echo 'Thank you, ' . $result->merge_fields->FNAME . '. You have subscribed successfully';
            }

            die;
        }
    }

    add_action('admin_post_nopriv_et_mailchimp', 'enovathemes_addons_mailchimp_subscribe');
    add_action('admin_post_et_mailchimp', 'enovathemes_addons_mailchimp_subscribe');

/*  Post social share
/*-------------------*/

    function enovathemes_addons_post_social_share($class){
        $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
        $output = '<div id="post-social-share" class="post-social-share '.esc_attr($class).' et-social-links">';
            $output .= '<a href="#" class="social-toggle">'.file_get_contents(THEME_SVG.'share.svg').'</a>';
            $output .= '<div class="social-links et-social-links">';
                $output .= '<a title="'.esc_html__("Share on Facebook", 'enovathemes-addons').'" class="social-share post-facebook-share" target="_blank" href="//facebook.com/sharer.php?u='.urlencode(get_the_permalink(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/facebook.svg').'</a>';
                $output .= '<a title="'.esc_html__("Tweet this!", 'enovathemes-addons').'" class="social-share post-twitter-share" target="_blank" href="//twitter.com/intent/tweet?text='.urlencode(get_the_title(get_the_ID()).' - '.get_the_permalink(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/twitter.svg').'</a>';
                $output .= '<a title="'.esc_html__("Share on Pinterest", 'enovathemes-addons').'" class="social-share post-pinterest-share" target="_blank" href="//pinterest.com/pin/create/button/?url='.urlencode(get_the_permalink(get_the_ID())).'&media='.urlencode(esc_url($url)).'&description='.rawurlencode(get_the_title(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/pinterest.svg').'</a>';
                $output .= '<a title="'.esc_html__("Share on LinkedIn", 'enovathemes-addons').'" class="social-share post-linkedin-share" target="_blank" href="//www.linkedin.com/shareArticle?mini=true&url='.urlencode(get_the_permalink(get_the_ID())).'&title='.rawurlencode(get_the_title(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/linkedin.svg').'</a>';
                $output .= '<a title="'.esc_html__("Share on Whatsapp", 'enovathemes-addons').'" class="whatsapp social-share post-whatsapp-share" target="_blank" href="whatsapp://send?text='.urlencode(get_the_permalink(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/whatsapp.svg').'</a>';
                $output .= '<a title="'.esc_html__("Share on Viber", 'enovathemes-addons').'" class="viber social-share post-viber-share" target="_blank" href="viber://forward?text='.urlencode(get_the_permalink(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/viber.svg').'</a>';
                // $output .= '<a title="'.esc_html__("Share on Telegram", 'enovathemes-addons').'" class="telegram social-share post-telegram-share" target="_blank" href="tg://msg_url?url='.urlencode(get_the_permalink(get_the_ID())).'&text='.rawurlencode(get_the_title(get_the_ID())).'">'.file_get_contents(THEME_SVG.'social/telegram.svg').'</a>';
            $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    add_action('wp_head', 'enovathemes_addons_open_graph_tags');
    function enovathemes_addons_open_graph_tags(){ ?>
        <?php

        if (defined( 'WPSEO_PATH' )) {
            return;
        }

        global $post;

        $sitename    = get_bloginfo('name');
        $image       = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),"full");
        $url         = get_the_permalink(get_the_ID());
        $title       = get_the_title(get_the_ID());
        $description = (has_excerpt(get_the_ID())) ? get_the_excerpt(get_the_ID()) : '';

        ?>
        <?php if ($title): ?>
            <meta property="og:site_name" content="<?php echo esc_attr($sitename); ?>" />
            <meta name="twitter:title" content="<?php echo esc_attr($sitename); ?>">
        <?php endif ?>
        <?php if ($url): ?>
            <meta property="og:url" content="<?php echo esc_url($url); ?>" />
            <meta property="og:type" content="article" />
        <?php endif ?>
        <?php if ($title): ?>
            <meta property="og:title" content="<?php echo esc_attr($title); ?>" />
        <?php endif ?>
        <?php if ($description): ?>
            <meta property="og:description" content="<?php echo esc_attr($description); ?>" />
            <meta name="twitter:description" content="<?php echo esc_attr($description); ?>">
        <?php endif ?>
        <?php if ($image): ?>
            <meta property="og:image" content="<?php echo esc_url($image[0]); ?>" />
            <meta property="og:image:width" content="<?php echo esc_attr($image[1]); ?>" />
            <meta property="og:image:height" content="<?php echo esc_attr($image[2]); ?>" />
            <meta name="twitter:image" content="<?php echo esc_url($image[0]); ?>">
            <meta name="twitter:card" content="summary_large_image">
        <?php endif ?>

    <?php }

/* Social icons
/*-------------------*/

    function enovathemes_addons_social_icons($dir) {

        if ( false === ( $social = get_transient( 'enovathemes-social-icons' ) ) ) {

            $social = array_diff(scandir($dir), array('..', '.'));

            $social_array = array();

            foreach ($social as $icon) {
                array_push($social_array,basename($icon,'.svg'));
            }

            $social = $social_array;

            // do not set an empty transient - should help catch private or empty accounts.
            if ( ! empty( $social ) ) {
                $social = base64_encode( serialize( $social ) );
                set_transient( 'enovathemes-social-icons', $social, apply_filters( 'null_social_cache_time', 0 ) );
            }
        }

        if ( ! empty( $social ) ) {

            return unserialize( base64_decode( $social ) );

        } else {

            return new WP_Error( 'no_icons', esc_html__( 'No icons.', 'textron' ) );

        }
    }

/*  Inline image placeholder
/*-------------------*/

    function enovathemes_addons_inline_image_placeholder($id,$size = 'full',$class = ''){

        $output = '';

        $image        = wp_get_attachment_image_src($id,$size);
        $image_src    = $image[0];
        $image_width  = $image[1];
        $image_height = $image[2];

        $image_caption = get_the_post_thumbnail_caption($image);
        $image_alt     = (empty($image_caption)) ? get_bloginfo('name') : $image_caption;
        $data_img      = "data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==";

        $x_center = ($image_width/2);
        $y_center = ($image_height/2);

        $cl = array('lazy-inline-image');

        if(!empty($class)){
            $cl[]= $class;
        }

        $output .= '<div style="max-width:'.$image_width.'px;max-height:'.$image_height.'px;" class="'.implode(' ', $cl).'">';
            $output .= '<img class="lazy" src="'.$data_img.'" width="'.esc_attr($image_width).'" height="'.esc_attr($image_height).'" data-src="'.esc_url($image_src).'" alt="'.esc_html($image_alt).'" />';
            $output .= '<svg class="media-placeholder" viewBox="0 0 '.$image_width.' '.$image_height.'"><path d="M0,0H'.$image_width.'V'.$image_height.'H0V0Z" /></svg>';
            $output .= file_get_contents(THEME_SVG.'placeholder.svg');
        $output .= '</div>';

        if (!empty($output)) {
            return $output;
        }

    }

/*  Breadcrumbs
/*-------------------*/

    function enovathemes_addons_breadcrumbs() {

        global $post, $textron_enovathemes;

        $text_before = '<span>';
        $text_after  = '</span>';
        $link_after  = file_get_contents(THEME_SVG.'arrow.svg');
        $output      = '';

        $home_text     = esc_html__('Home','enovathemes-addons');

        if(!empty(get_option('page_on_front')))
        $home_text = get_the_title( get_option('page_on_front') );

        $category_text = esc_html__('Category "%s"','enovathemes-addons');
        $tax_text      = esc_html__('Archive by "%s"','enovathemes-addons');
        $tag_text      = esc_html__('Posts tagged "%s"','enovathemes-addons');
        $author_text   = esc_html__('Articles posted by %s','enovathemes-addons');
        $error_text    = esc_html__('Error 404','enovathemes-addons');
        $search_text   = esc_html__('Search results for "%s" Query','enovathemes-addons');
        $wishlist_text = esc_html__("Wishlist", 'enovathemes-addons');

        $blog_text     = esc_html__("Blog", "enovathemes-addons");
        $project_text  = esc_html__("Projects", "enovathemes-addons");
        $product_text  = esc_html__("Shop", "enovathemes-addons");

        $home_link = esc_url(home_url('/'));
        $blog_link = get_post_type_archive_link( 'post' );
        $shop_link = (function_exists('wc_get_page_id')) ? get_permalink( wc_get_page_id( 'shop' ) ) : '';

        if (is_home() && is_front_page()) {
            // Post is frontpage
            $output .= $text_before . $blog_text . $text_after;
        } elseif (is_home() && !is_front_page()) {
            // Post is separate page
            $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
            if ( get_query_var('paged') ) {
               $output .= '<a href="' . $blog_link . '">' . $blog_text . '</a>'.$link_after;
            } else {
               $output .= $text_before . $blog_text . $text_after;
            }

        } elseif (is_front_page() && !is_home()) {
            // Front page and not post page
            $output .= $text_before . $home_text . $text_after;
        } else {

            /*  Page
            -------------------*/

                if (is_page()) {

                    $page_title = get_the_title();

                    $wishlistpage    = "false";
                    $wishlistpage_id = get_option('yith_wcwl_wishlist_page_id');
                    if (defined('YITH_WCWL') && !empty($wishlistpage_id)) {
                        $wishlistpage = (is_page(get_option('yith_wcwl_wishlist_page_id'))) ? "true" : "false";
                    }

                    if ($wishlistpage == "true") {
                        $page_title = $wishlist_text;
                    }

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;

                    if (class_exists('Woocommerce')) {

                        if (is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() || $wishlistpage == "true") {
                            $output .= '<a href="' . $shop_link . '">' . $product_text . '</a>'.$link_after;
                        }

                    }

                    if ($post->post_parent) {

                        $this_parents = get_post_ancestors($post->ID);

                        foreach (array_reverse($this_parents) as $parent_ID) {
                            $output .= '<a href="'.get_page_link($parent_ID, false, false).'">'.get_the_title($parent_ID).'</a>'.$link_after;
                        }

                        $output .= $text_before.$page_title.$text_after;

                    } else {
                        $output .= $text_before.$page_title.$text_after;
                    }
                }

            /*  Single post
            -------------------*/

                if (is_singular( 'post' )) {

                    $this_cats         = get_the_category();
                    $first_cat         = $this_cats[0];
                    $first_cat_link    = get_category_link($first_cat->cat_ID);

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                    $output .= '<a href="' . $blog_link . '">' . $blog_text . '</a>'.$link_after;

                    if ($first_cat->parent) {
                        $first_cat_parents = get_category_parents($first_cat->parent, true, '');
                        $output .= $first_cat_parents;
                    }

                    $output .= '<a href="'.$first_cat_link.'">'. $first_cat->name .'</a>'.$link_after;
                    $output .= $text_before.get_the_title().$text_after;

                }

            /*  Category / Tag / Taxonomy
            -------------------*/

                if ( is_category() ) {

                    $this_cat = get_category(get_query_var('cat'), false);

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                    $output .= '<a href="' . $blog_link . '">' . $blog_text . '</a>'.$link_after;

                    if ($this_cat->parent != 0) {
                        $this_parents = get_category_parents($this_cat->parent, true, '');
                        $output .= $this_parents.$link_after;
                        $output .= $text_before . sprintf($category_text, single_cat_title('', false)) . $text_after;
                    } else {
                        $output .= $text_before . sprintf($category_text, single_cat_title('', false)) . $text_after;
                    }

                }

                if (is_tag()) {

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                    $output .= '<a href="' . $blog_link . '">' . $blog_text . '</a>'.$link_after;
                    $output .= $text_before . sprintf($tag_text, single_tag_title('', false)) . $text_after;

                }

            /*  Date
            -------------------*/

                if ( is_day() ) {

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                    $output .= '<a href="'.get_year_link(get_the_time('Y'),get_the_time('Y')).'">'. get_the_time('Y') .'</a>'.$link_after;
                    $output .= '<a href="'.get_month_link(get_the_time('Y'),get_the_time('m')).'">'. get_the_time('F') .'</a>'.$link_after;
                    $output .= $text_before . get_the_time('d') . $text_after;

                }

                if ( is_month() ) {

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                    $output .= '<a href="'.get_year_link(get_the_time('Y'),get_the_time('Y')).'">'. get_the_time('Y') .'</a>'.$link_after;
                    $output .= $text_before . get_the_time('F') . $text_after;
                }

                if ( is_year() ) {

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                    $output .= $text_before . get_the_time('Y') . $text_after;
                }

            /*  Misc
            -------------------*/

                if ( is_search() ) {

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;

                    $cpt_list = get_post_types( array(
                        'public' => true,
                        'publicly_queryable' => true,
                        'exclude_from_search'=> false,
                        '_builtin' => false,
                    ), 'objects', 'and' );

                    if (is_array($cpt_list)) {
                        foreach ($cpt_list as $cpt) {

                            $cpt_title = $cpt->labels->name;

                            switch ($cpt->name) {
                                case 'project':
                                    $cpt_title = $project_text;
                                    break;
                                case 'product':
                                    $cpt_title = $product_text;
                                    break;
                            }

                            if (is_post_type_archive($cpt->name)) {
                                $output .= '<a href="' . get_post_type_archive_link($cpt->name) . '">' . $cpt_title . '</a>'.$link_after;
                            }

                        }
                    }


                    $output .= $text_before . sprintf($search_text, get_search_query()) . $text_after;

                }

                if ( is_author() ) {
                    global $author;
                    $userdata = get_userdata($author);

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                    $output .= $text_before . sprintf($author_text, $userdata->display_name) . $text_after;

                }

                if ( is_404() ) {

                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                    $output .= $text_before . $error_text . $text_after;
                }

            /*  CPT
            -------------------*/

                if (!is_search()  && !is_404()) {

                    $cpt_list = get_post_types( array(
                        'public' => true,
                        'publicly_queryable' => true,
                        'exclude_from_search'=> false,
                        '_builtin' => false,
                    ), 'objects', 'and' );

                    if (is_array($cpt_list)) {
                        foreach ($cpt_list as $cpt) {

                            $cpt_title = $cpt->labels->name;

                            switch ($cpt->name) {
                                case 'project':
                                    $cpt_title = $project_text;
                                    break;
                                case 'product':
                                    $cpt_title = $product_text;
                                    break;
                            }

                            /*  Archive
                            -------------------*/

                                if (is_post_type_archive($cpt->name)) {

                                    $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;

                                    if ( get_query_var('paged') ) {
                                       $output .= '<a href="' . get_post_type_archive_link($cpt->name) . '">' . $cpt_title . '</a>'.$link_after;
                                    } else {
                                       $output .= $text_before . $cpt_title . $text_after;
                                    }

                                }

                            /*  Taxonomy
                            -------------------*/

                                $cpt_taxonomies = get_object_taxonomies($cpt->name);
                                if (is_array($cpt_taxonomies)) {
                                    foreach ($cpt_taxonomies as $cpt_tax) {
                                        if (is_tax($cpt_tax)) {


                                            $this_tax    = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                                            $this_parents = ($this_tax) ? get_ancestors( $this_tax->term_id, get_query_var('taxonomy') ) : '';

                                            $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                                            $output .= '<a href="'.get_post_type_archive_link($cpt->name).'">'. $cpt_title .'</a>'.$link_after;

                                            if (is_array($this_parents) && !empty($this_parents)) {
                                                foreach (array_reverse($this_parents) as $this_parent_ID) {
                                                    $this_parent = get_term($this_parent_ID, get_query_var('taxonomy'));
                                                    $output .= '<a href="'.get_term_link( $this_parent->slug, get_query_var('taxonomy')).'">'. $this_parent->name .'</a>'.$link_after;
                                                }
                                                $output .= $text_before . sprintf($tax_text, single_cat_title('', false)) . $text_after;
                                            } else {
                                                $output .= $text_before . sprintf($tax_text, single_cat_title('', false)) . $text_after;
                                            }

                                        }
                                    }
                                } else {
                                    if (is_tax()) {

                                        $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                                        $output .= $text_before . sprintf($tax_text, single_cat_title('', false)) . $text_after;

                                    }
                                }

                            /*  Single post
                            -------------------*/

                                if ($cpt->name == 'project') {
                                    if (is_singular( 'project' )) {

                                        $this_terms = get_the_terms( $post->ID, 'project-category');

                                        $first_term         = $this_terms[0];
                                        $first_term_link    = ($first_term) ? get_term_link($first_term->term_id,'project-category') : "";
                                        $first_term_parents = ($first_term) ? get_ancestors($first_term->term_id,'project-category') : "";

                                        $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                                        $output .= '<a href="'.get_post_type_archive_link($cpt->name).'">'. $cpt_title .'</a>'.$link_after;

                                        if ($this_terms && is_array($first_term_parents) && !empty($first_term_parents)) {
                                            foreach (array_reverse($first_term_parents) as $this_parent_ID) {
                                                $this_parent = get_term($this_parent_ID, 'project-category');
                                                $output .= '<a href="'.get_term_link( $this_parent->slug, 'project-category').'">'. $this_parent->name .'</a>'.$link_after;
                                            }
                                        }

                                        if ($first_term) {
                                            $output .= '<a href="'.$first_term_link.'">'. $first_term->name .'</a>'.$link_after;
                                        }

                                        $output .= $text_before.get_the_title().$text_after;

                                    }
                                } elseif ($cpt->name == 'product') {

                                    if (is_singular( 'product' )) {

                                        $this_terms         = get_the_terms( $post->ID, 'product_cat');
                                        $first_term         = $this_terms[0];
                                        $first_term_link    = get_term_link($first_term->term_id,'product_cat');
                                        $first_term_parents = get_ancestors($first_term->term_id,'product_cat');

                                        $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                                        $output .= '<a href="' . $shop_link . '">' . $product_text . '</a>'.$link_after;

                                        if (is_array($first_term_parents)) {
                                            foreach (array_reverse($first_term_parents) as $this_parent_ID) {
                                                $this_parent = get_term($this_parent_ID, 'product_cat');
                                                $output .= '<a href="'.get_term_link( $this_parent->slug, 'product_cat').'">'. $this_parent->name .'</a>'.$link_after;
                                            }
                                        }

                                        $output .= '<a href="'.$first_term_link.'">'. $first_term->name .'</a>'.$link_after;
                                        $output .= $text_before.get_the_title().$text_after;

                                    }

                                } else {

                                    if (is_singular() && $cpt->name != 'project' && $cpt->name != 'product' && !is_single() && !is_page()) {
                                        $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                                        $output .= $text_before.get_the_title().$text_after;
                                    }

                                }

                        }
                    } else {
                        if (is_tax()) {

                            $output .= '<a href="' . $home_link . '">' . $home_text . '</a>'.$link_after;
                            $output .= $text_before . sprintf($tax_text, single_cat_title('', false)) . $text_after;

                        }
                    }

                }

        }

        if ( get_query_var('paged') ) {
            $output .= $text_before.esc_html__('Page','enovathemes-addons') . ' ' . get_query_var('paged').$text_after;
        }

        return $output;
    }

/*  Hex to rgba
/*-------------------*/

    function enovathemes_addons_hex_to_rgba($hex, $o) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);
        $hex = array_map('hexdec', str_split($hex, 2));
        return 'rgba('.implode(",", $hex).','.$o.')';
    }

/*  Hex to rgb shade
/*-------------------*/

    function enovathemes_addons_hex_to_rgb_shade($hex, $o) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);
        $hex = array_map('hexdec', str_split($hex, 2));
        $hex[0] -= $o;
        $hex[1] -= $o;
        $hex[2] -= $o;
        return 'rgb('.implode(",", $hex).')';
    }

/*  Brightness detection
/*-------------------*/

    function enovathemes_addons_brightness($hex) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $output = 'dark';

        if($r + $g + $b > 382){
            $output = 'light';
        }else{
            $output = 'dark';
        }

        return $output;
    }

/*  Minify CSS
/*-------------------*/

    function enovathemes_addons_minify_css($css) {
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace(': ', ':', $css);
        $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
        return $css;
    }


/*  Term filter
/*-------------------*/

    function enovathemes_addons_term_filter($options){

        $post_type          = $options['post_type'];
        $term               = $options['term'];
        $posts_per_page     = $options['posts_per_page'];
        $default_filter     = $options['default_filter'];
        $shortcode          = $options['shortcode'];
        $order              = $options['order'];
        $orderby            = $options['orderby'];
        $layout             = $options['layout'];
        $full               = $options['full'];
        $only_parent        = (isset($options['only_parent']) && !empty($options['only_parent'])) ? 0 : '';

        if (!is_tax()){


            $args = array(
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => true,
                'exclude_tree'      => array(),
                'number'            => '',
                'fields'            => 'all',
                'slug'              => '',
                'parent'            => $only_parent,
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
            $count_posts = wp_count_posts($post_type);
            $taxonomy  = $term;
            $tax_terms = get_terms($taxonomy,$args);

            if (count($tax_terms) != 0){

                $output = $container_start = $container_end = "";

                $filter_id = ($shortcode == true) ? $post_type.'-'.rand(1,1000000).'-filter' : $post_type.'-filter';

                $attributes = array();
                $attributes[] = 'data-posts-per-page="'.$posts_per_page.'"';
                $attributes[] = 'data-default-filter="'.$default_filter.'"';
                $attributes[] = 'data-order="'.$order.'"';
                $attributes[] = 'data-orderby="'.$orderby.'"';

                $output .= '<div id="'.$filter_id.'" '.implode(' ', $attributes).' class="et-post-filter enovathemes-filter button-group filter-button-group" data-layout="'.esc_attr($layout).'" data-full="'.esc_attr($full).'">';

                    $select_output = '<select>';

                    if ($default_filter == "all"){
                        $output .= '<a href="'.get_post_type_archive_link($post_type).'"  class="first-filter active filter et-button small" data-filter="*" data-filter-id="*" data-count="'.($count_posts->publish).'">'.esc_html__('Show All', 'enovathemes-addons').'</a>';
                        $select_output .= '<option value="'.get_post_type_archive_link($post_type).'"  data-filter-id="*" data-count="'.($count_posts->publish).'">'.esc_html__('Show All', 'enovathemes-addons').'</option>';
                    }

                    foreach($tax_terms as $filter_term){
                        $filter_count    = $filter_term->count;
                        $filter_children = get_term_children( $filter_term->term_id, $term);
                        if(is_array($filter_children) && !empty($filter_children)) {
                            foreach ($filter_children as $filter_child) {
                                $filter_child_obj = get_term($filter_child, $term);
                                if ($filter_term->taxonomy != 'product_cat') {
                                    $filter_count = $filter_count + $filter_child_obj->count;
                                }
                            }
                        }

                        $active_class = "";

                        if ($default_filter != 'all') {
                            if ($filter_term->slug == $default_filter) {
                                $active_class = "first-filter active";
                            }
                        }

                        $select_output .= '<option value="'.esc_url(get_term_link($filter_term, $term)).'" data-filter-id="'.$filter_term->term_id.'" data-count="'.$filter_count.'">'.$filter_term->name.'</option>';

                        $output .= '<a href="'.esc_url(get_term_link($filter_term, $term)).'" class="filter et-button small '.$active_class.'" data-filter="'.$filter_term->slug.'" data-filter-id="'.$filter_term->term_id.'" data-count="'.$filter_count.'">'.$filter_term->name.'</a>';

                    }

                    $select_output .= '</select>';

                    $output .= $select_output;

                $output .= '</div>';

                return $output;

            }

        }
    }

    function enovathemes_addons_term_filter_action() {

        global $wpdb;

        if (isset($_POST['id']) && !empty($_POST['id'])) {


            $id      = $_POST['id'];
            $count   = $_POST['count'];
            $layout  = $_POST['layout'];
            $full    = $_POST['full'];

            if ($id === "*") {
                $querystr = "SELECT DISTINCT * FROM $wpdb->posts AS p
                WHERE p.post_type IN ('project')
                AND p.post_status = 'publish'
                ORDER BY p.post_date DESC LIMIT {$count}";
            } else {
               $querystr = "SELECT DISTINCT * FROM $wpdb->posts AS p
                LEFT JOIN $wpdb->term_relationships AS r ON (p.ID = r.object_id)
                INNER JOIN $wpdb->term_taxonomy AS x ON (r.term_taxonomy_id = x.term_taxonomy_id)
                INNER JOIN $wpdb->terms AS t ON (r.term_taxonomy_id = t.term_id)
                WHERE p.post_type IN ('project')
                AND p.post_status = 'publish'
                AND x.taxonomy = 'project-category'
                AND (
                    (x.term_id = {$id})
                    OR
                    (x.parent = {$id})
                )
                ORDER BY p.post_date DESC LIMIT {$count}";
            }

            $query_results = $wpdb->get_results($querystr);

            if (!empty($query_results)) {

                $thumb_size = 'textron_600X400';

                if ($layout == "list") {
                    $thumb_size = 'textron_425X425';
                }

                if ($full == "true") {
                    $thumb_size = 'full';
                }

                $output = '';

                foreach ($query_results as $result) {
                    $output .='<article class="'.join( ' ', get_post_class('et-item post project append',$result->ID)).'" id="project-'.$result->ID.'">';
                        $output .='<div class="post-inner et-item-inner et-clearfix">';
                            if (has_post_thumbnail($result->ID)) {
                                $output .='<div class="post-image post-media">';
                                    $output .= '<a href="'.get_post_permalink($result->ID).'" title="'.esc_attr__("Read more about", "enovathemes-addons").' '.$result->post_title.'" rel="bookmark">';;
                                        $output .='<div class="image-container">';

                                            $thumbnail_id  = get_post_thumbnail_id( $result->ID );
                                            $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                            $thumbnail     = wp_get_attachment_image_src($thumbnail_id,$thumb_size);

                                            if ($thumbnail_alt) {
                                                $thumbnail_alt = 'alt="'.$thumbnail_alt.'"';
                                            }

                                            $responsive_data = array();
                                            $responsive_data_clone = array();

                                            if ($layout == "list") {

                                               $thumbnail_600X400 = wp_get_attachment_image_src($thumbnail_id,'textron_600X400');

                                               $data_img          = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';

                                               $responsive_data[] = 'data-resp-src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHZpZXdCb3g9JzAgMCAzIDInPjwvc3ZnPg"';
                                               $responsive_data[] = 'data-resp-src-original="'.esc_url($thumbnail_600X400[0]).'"';
                                               $responsive_data[] = 'data-resp-width="'.esc_attr($thumbnail_600X400[1]).'"';
                                               $responsive_data[] = 'data-resp-height="'.esc_attr($thumbnail_600X400[2]).'"';

                                               $responsive_data_clone[] = 'data-clone-resp-src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHZpZXdCb3g9JzAgMCAzIDInPjwvc3ZnPg"';
                                               $responsive_data_clone[] = 'data-clone-resp-src-original="'.esc_url($thumbnail[0]).'"';
                                               $responsive_data_clone[] = 'data-clone-resp-width="'.esc_attr($thumbnail[1]).'"';
                                               $responsive_data_clone[] = 'data-clone-resp-height="'.esc_attr($thumbnail[2]).'"';

                                            } else {
                                               $data_img = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHZpZXdCb3g9JzAgMCAzIDInPjwvc3ZnPg';
                                            }

                                            $output .= '<img class="lazy" src="'.$data_img.'" width="'.esc_attr($thumbnail[1]).'" height="'.esc_attr($thumbnail[2]).'" data-src="'.esc_url($thumbnail[0]).'" '.$thumbnail_alt.' '.implode(' ', $responsive_data).' '.implode(' ', $responsive_data_clone).' />';
                                            $output .= file_get_contents(THEME_SVG.'placeholder.svg');

                                        $output .='</div>';

                                        if ($layout == "full") {
                                            $output .='<div class="post-image-overlay">';
                                                $output .='<div class="post-image-overlay-content">';
                                                    if ( '' != $result->post_title){
                                                        $output .='<h4 class="post-title">';
                                                            $output .=$result->post_title;
                                                        $output .='</h4>';
                                                    }
                                                    $output .='<div class="project-category">';
                                                        $output .= strip_tags(get_the_term_list( $result->ID, 'project-category', '', ', ', '' ));
                                                    $output .='</div>';
                                                $output .='</div>';
                                            $output .='</div>';
                                        }
                                    $output .= '</a>';
                                $output .='</div>';
                            }

                            if ($layout != "full"){
                                $output .='<div class="post-body et-clearfix">';
                                    $output .='<div class="post-body-inner-wrap">';
                                        $output .='<div class="post-body-inner">';

                                            if ( '' != $result->post_title ){
                                                $output .='<h4 class="post-title entry-title">';
                                                    $output .= '<a href="'.get_post_permalink($result->ID).'" title="'.esc_attr__("Read more about", 'enovathemes-addons').' '.$result->post_title.'" rel="bookmark">';
                                                        $output .= $result->post_title;
                                                    $output .= '</a>';
                                                $output .='</h4>';
                                            }

                                            $output .='<div class="project-category">';
                                                $output .= get_the_term_list( $result->ID, 'project-category', '', ', ', '' );
                                            $output .='</div>';

                                            if ($layout == "list") {
                                                $output .='<a href="'.esc_url(get_post_permalink($result->ID)).'" class="project-read-more round et-button small" title="'.esc_attr__("Explore more about", 'enovathemes-addons').' '.$result->post_title.'">'.esc_html__("Explore more", 'enovathemes-addons').file_get_contents(THEME_SVG.'arrow.svg').'</a>';
                                            }

                                        $output .='</div>';
                                    $output .='</div>';
                                $output .='</div>';
                            }
                        $output .='</div>';
                    $output .='</article>';
                }

                if (!empty($output)) {
                    echo $output;
                }
            }
        }

        die();
    }
    add_action( 'wp_ajax_term_filter', 'enovathemes_addons_term_filter_action' );
    add_action( 'wp_ajax_nopriv_term_filter', 'enovathemes_addons_term_filter_action' );

/*  Project loop content
/*-------------------*/

    function enovathemes_addons_project_body($project_post_layout, $thumb_size){

        $output = "";

        if (has_post_thumbnail()) {
            $output .='<div class="post-image post-media">';
                $output .= '<a href="'.get_the_permalink().'" title="'.esc_attr__("Read more about", "enovathemes-addons").' '.get_the_title().'" rel="bookmark">';;
                    $output .='<div class="image-container">';
                        $output .= textron_enovathemes_build_post_media($project_post_layout,$thumb_size,false);
                    $output .='</div>';

                    if ($project_post_layout == "full") {
                        $output .='<div class="post-image-overlay">';
                            $output .='<div class="post-image-overlay-content">';
                                if ( '' != get_the_title()){
                                    $output .='<h4 class="post-title">';
                                        $output .=get_the_title();
                                    $output .='</h4>';
                                }
                                $output .='<div class="project-category">';
                                    $output .= strip_tags(get_the_term_list( get_the_ID(), 'project-category', '', ', ', '' ));
                                $output .='</div>';
                            $output .='</div>';
                        $output .='</div>';
                    }
                $output .= '</a>';
            $output .='</div>';
        }

        if ($project_post_layout != "full"){
            $output .='<div class="post-body et-clearfix">';
                $output .='<div class="post-body-inner-wrap">';
                    $output .='<div class="post-body-inner">';

                        if ( '' != get_the_title() ){
                            $output .='<h4 class="post-title entry-title">';
                                $output .= '<a href="'.get_the_permalink().'" title="'.esc_attr__("Read more about", 'enovathemes-addons').' '.get_the_title().'" rel="bookmark">';
                                    $output .= get_the_title();
                                $output .= '</a>';
                            $output .='</h4>';
                        }

                        $output .='<div class="project-category">';
                            $output .= get_the_term_list( get_the_ID(), 'project-category', '', ', ', '' );
                        $output .='</div>';

                        if ($project_post_layout == "list") {
                            $output .='<a href="'.esc_url(get_the_permalink()).'" class="project-read-more round et-button small" title="'.esc_attr__("Explore more about", 'enovathemes-addons').' '.the_title_attribute( 'echo=0' ).'">'.esc_html__("Explore more", 'enovathemes-addons').file_get_contents(THEME_SVG.'arrow.svg').'</a>';
                        }

                    $output .='</div>';
                $output .='</div>';
            $output .='</div>';
        }

        return $output;

    }

    function enovathemes_addons_project_post($project_post_layout,$thumb_size){

        $output = "";

        $output .='<article class="'.join( ' ', get_post_class('et-item post')).'" id="project-'.get_the_ID().'">';
            $output .='<div class="post-inner et-item-inner et-clearfix">';
                $output .= enovathemes_addons_project_body($project_post_layout,$thumb_size);
            $output .='</div>';
        $output .='</article>';

        return $output;

    }

/*  Project single content
/*-------------------*/

    function enovathemes_addons_related_projects(){

        global $textron_enovathemes, $post;

        $project_related_posts_by = (isset($GLOBALS['textron_enovathemes']['project-related-posts-by']) && $GLOBALS['textron_enovathemes']['project-related-posts-by']) ? $GLOBALS['textron_enovathemes']['project-related-posts-by'] : "categories";
        $project_related_projects = (isset($GLOBALS['textron_enovathemes']['project-related-projects']) && $GLOBALS['textron_enovathemes']['project-related-projects'] == 1) ? "true" : "false";
        $project_post_layout      = (isset($GLOBALS['textron_enovathemes']['project-post-layout']) && !empty($GLOBALS['textron_enovathemes']['project-post-layout'])) ? $GLOBALS['textron_enovathemes']['project-post-layout'] : "project-with-details";
        $project_image_full       = (isset($GLOBALS['textron_enovathemes']['project-image-full']) && $GLOBALS['textron_enovathemes']['project-image-full'] == 1) ? "true" : "false";

        $thumb_size = 'textron_600X400';

        if ($project_image_full == "true") {
            $thumb_size = 'full';
        }

        if ($project_post_layout == "list") {
            $thumb_size = 'textron_425X425';
        }

        $output = "";

        if ($project_related_projects == "true") {

            $terms = ($project_related_posts_by == "tag") ? get_the_terms( $post->ID , 'project-tag') : get_the_terms( $post->ID , 'project-category');
            $per_page = ($project_post_layout == "grid") ? 3 : 4;

            if ($terms){

                $category_ids = array();
                foreach($terms as $category) {$category_ids[] = $category->term_id;}

                $args = array(
                    'post_type' => 'project',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'project-category',
                            'field'    => 'id',
                            'terms'    => $category_ids,
                            'operator' => 'IN'
                        ),
                    ),
                    'posts_per_page'      => $per_page,
                    'ignore_sticky_posts' => 1,
                    'orderby'             => 'date',
                    'post__not_in'        => array(get_the_ID())
                );

                if ($project_related_posts_by == "tag") {
                    $args = array(
                        'post_type' => 'project',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'project-tag',
                                'field'    => 'id',
                                'terms'    => $category_ids,
                                'operator' => 'IN'
                            ),
                        ),
                        'posts_per_page'      => $per_page,
                        'ignore_sticky_posts' => 1,
                        'orderby'             => 'date',
                        'post__not_in'        => array(get_the_ID())
                    );
                }

                $related_projects = new WP_Query($args);

                if ($related_projects->have_posts()){
                    $output .='<div class="related-posts-wrapper '.esc_attr($project_post_layout).' et-clearfix">';
                        $output .='<div class="container">';
                            $output .='<h4 class="related-posts-title">'.esc_html__("Related projects", 'enovathemes-addons').'</h4>';
                            $output .='<div id="related-projects" data-columns="2" class="related-posts loop-posts loop-projects et-clearfix">';
                                while($related_projects->have_posts()) : $related_projects->the_post();
                                    $output .= enovathemes_addons_project_post($project_post_layout,$thumb_size);
                                endwhile;
                                wp_reset_postdata();
                            $output .='</div>';
                        $output .='</div>';
                    $output .='</div>';
                }
            }

            return $output;

        }

    }

/*  Woocommerce content
/*-------------------*/

    if ( ! function_exists( 'woocommerce_content' ) ) {

        function woocommerce_content() {

            if ( is_singular( 'product' ) ) {

                while ( have_posts() ) :
                    the_post();
                    wc_get_template_part( 'content', 'single-product' );
                endwhile;

            } else {
                ?>

                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

                <?php endif; ?>

                <?php do_action( 'woocommerce_archive_description' ); ?>

                <?php if ( have_posts() ) : ?>

                    <?php do_action( 'woocommerce_before_shop_loop' ); ?>

                    <?php woocommerce_product_loop_start(); ?>

                    <?php if ( wc_get_loop_prop( 'total' ) ) : ?>
                        <?php while ( have_posts() ) : ?>
                            <?php the_post(); ?>
                            <?php include(ENOVATHEMES_ADDONS.'woocommerce/content-product.php'); ?>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <?php woocommerce_product_loop_end(); ?>

                    <?php do_action( 'woocommerce_after_shop_loop' ); ?>

                <?php else : ?>

                    <?php do_action( 'woocommerce_no_products_found' ); ?>

                <?php
                endif;

            }
        }
    }

/*  Clear extra space from string
/*-------------------*/

    function enovathemes_addons_extra_white_space($text){
        $text = preg_replace('/[\t\n\r\0\x0B]/', '', $text);
        $text = preg_replace('/([\s])\1+/', ' ', $text);
        $text = trim($text);
        return $text;
    }

/*  Option panel saved hook
/*-------------------*/

    $old_main_color      = Redux::getOption('textron_enovathemes','main-color');
    $old_secondory_color = Redux::getOption('textron_enovathemes','secondory-color');
    $old_area_color      = Redux::getOption('textron_enovathemes','area-color');

    add_action( "redux/options/textron_enovathemes/saved", "enovathemes_addons_redux_save");
    function enovathemes_addons_redux_save(){

        global $wpdb, $old_main_color, $old_secondory_color, $old_area_color;

        $new_main_color      = Redux::getOption('textron_enovathemes','main-color');
        $new_secondory_color = Redux::getOption('textron_enovathemes','secondory-color');
        $new_area_color      = Redux::getOption('textron_enovathemes','area-color');

        $posts_table = $wpdb->prefix . "posts";
        $meta_table  = $wpdb->prefix . "postmeta";

        if (isset($old_main_color) && !empty($old_main_color) && $old_main_color != $new_main_color) {

            $sql_1 = $wpdb->prepare( "UPDATE {$posts_table} SET post_content  = REPLACE (post_content, %s, '{$new_main_color}') ",$old_main_color);
            $sql_2 = $wpdb->prepare( "UPDATE {$meta_table} SET meta_value  = REPLACE (meta_value, %s, '{$new_main_color}') ",$old_main_color);

            $wpdb->query($sql_1);
            $wpdb->query($sql_2);

            Redux::setOption('textron_enovathemes','mtt-back-color',array('hover'=> $new_main_color));
            Redux::setOption('textron_enovathemes','form-button-back',array('regular'=> $new_main_color));
        }

        if (isset($old_secondory_color) && !empty($old_secondory_color) && $old_secondory_color != $new_secondory_color) {

            $sql_1 = $wpdb->prepare( "UPDATE {$posts_table} SET post_content  = REPLACE (post_content, %s, '{$new_secondory_color}') ",$old_secondory_color);
            $sql_2 = $wpdb->prepare( "UPDATE {$meta_table} SET meta_value  = REPLACE (meta_value, %s, '{$new_secondory_color}') ",$old_secondory_color);

            $wpdb->query($sql_1);
            $wpdb->query($sql_2);

        }

        if (isset($old_area_color) && !empty($old_area_color) && $old_area_color != $new_area_color) {

            $sql_1 = $wpdb->prepare( "UPDATE {$posts_table} SET post_content  = REPLACE (post_content, %s, '{$new_area_color}') ",$old_area_color);
            $sql_2 = $wpdb->prepare( "UPDATE {$meta_table} SET meta_value  = REPLACE (meta_value, %s, '{$new_area_color}') ",$old_area_color);

            $wpdb->query($sql_1);
            $wpdb->query($sql_2);

        }

        $old_url = 'https://enovathemes.com/textron/';
        $new_url = esc_url(home_url('/'));
        $sql_guid = $wpdb->prepare( "UPDATE {$posts_table} SET guid  = REPLACE (guid, %s, '{$new_url}') ",$old_url);
        if (isset($old_url) && !empty($old_url) && $old_url != $new_url) {
            $wpdb->query($sql_guid);
        }

        delete_transient( 'dynamic-styles-cached' );

    }

/*  REST API custom fields
/*-------------------*/

    function enovathemes_addons_register_fields(){

        /*  Projects
        /*-------------------*/

            register_rest_field('project',
                'project_category_array',
                array(
                    'get_callback'    => 'enovathemes_addons_project_categories',
                    'update_callback' => null,
                    'schema'          => null
                )
            );

            register_rest_field('project',
                'project_image',
                array(
                    'get_callback'    => 'enovathemes_addons_project_image',
                    'update_callback' => null,
                    'schema'          => null
                )
            );


    }

    function enovathemes_addons_project_categories($object,$field_name,$request){

        $term_array = array();

        $terms_raw =  wp_get_post_terms( $object['id'], 'project-category');

        foreach ($terms_raw as $term) {
            array_push($term_array, $term->name."__".get_term_link($term->term_id));
        }

        $term_array_result = array();

        foreach ($term_array as $term_string) {
            $term_string = explode("__", $term_string);
            array_push($term_array_result, $term_string);
        }

        return $term_array_result;
    }

    function enovathemes_addons_project_image($object,$field_name,$request){

        $project_image = array();

        $textron_600X400 = wp_get_attachment_image_src($object['featured_media'],'textron_600X400');
        $textron_600X400 = wp_get_attachment_image_src($object['featured_media'],'textron_600X400');
        $textron_600X400 = wp_get_attachment_image_src($object['featured_media'],'textron_600X400');
        $textron_600X400 = wp_get_attachment_image_src($object['featured_media'],'textron_600X400');
        $textron_600X400 = wp_get_attachment_image_src($object['featured_media'],'textron_600X400');
        $full            = wp_get_attachment_image_src($object['featured_media'],'full');

        if (strpos($textron_600X400[0], '400x')) {
            array_push($project_image, 'textron_600X400__'.$textron_600X400[0]);
        }

        if (strpos($textron_600X400[0], '480x')) {
            array_push($project_image, 'textron_600X400__'.$textron_600X400[0]);
        }

        if (strpos($textron_600X400[0], '600x')) {
            array_push($project_image, 'textron_600X400__'.$textron_600X400[0]);
        }

        if (strpos($textron_600X400[0], '600x')) {
            array_push($project_image, 'textron_600X400__'.$textron_600X400[0]);
        }

        array_push($project_image, 'full__'.$full[0]);

        $project_image_result = array();

        foreach ($project_image as $image_string) {
            $image_string = explode("__", $image_string);
            array_push($project_image_result, $image_string);
        }

        return $project_image_result;
    }

    add_action('rest_api_init','enovathemes_addons_register_fields');

/*  CPT Templates
/*-------------------*/

    function enovathemes_addons_project_single_template($single_template) {
        global $post;
        if ($post->post_type == 'project') {
            if ( $theme_file = locate_template( array ( 'single-project.php' ) ) ) {
                $single_template = $theme_file;
            } else {
                $single_template = ENOVATHEMES_ADDONS . 'project/single-project.php';
            }
        }
        return $single_template;
    }
    add_filter( "single_template", "enovathemes_addons_project_single_template", 20 );

    function enovathemes_addons_project_archive_template($archive_template) {
        global $post;
        if ($post->post_type == 'project') {
            if ( $theme_file = locate_template( array ( 'archive-project.php' ) ) ) {
                $archive_template = $theme_file;
            } else {
                $archive_template = ENOVATHEMES_ADDONS . 'project/archive-project.php';
            }
        }
        return $archive_template;
    }
    add_filter( "archive_template", "enovathemes_addons_project_archive_template", 20 );

    function enovathemes_addons_project_taxonomy_template($taxonomy_template) {
        if (is_tax('project-category')) {

            if ( $theme_file = locate_template( array ( 'taxonomy-project.php' ) ) ) {
                $taxonomy_template = $theme_file;
            } else {

                $taxonomy_template = ENOVATHEMES_ADDONS . 'project/taxonomy-project.php';
            }

        }
        return $taxonomy_template;
    }
    add_filter( "taxonomy_template", "enovathemes_addons_project_taxonomy_template", 20 );


    function enovathemes_addons_header_single_template($single_template) {
        global $post;
        if ($post->post_type == 'header') {
            if ( $theme_file = locate_template( array ( 'single-header.php' ) ) ) {
                $single_template = $theme_file;
            } else {
                $single_template = ENOVATHEMES_ADDONS . 'templates/single-header.php';
            }
        }
        return $single_template;
    }
    add_filter( "single_template", "enovathemes_addons_header_single_template", 20 );

    function enovathemes_addons_megamenu_single_template($single_template) {
        global $post;
        if ($post->post_type == 'megamenu') {
            if ( $theme_file = locate_template( array ( 'single-megamenu.php' ) ) ) {
                $single_template = $theme_file;
            } else {
                $single_template = ENOVATHEMES_ADDONS . 'templates/single-megamenu.php';
            }
        }
        return $single_template;
    }
    add_filter( "single_template", "enovathemes_addons_megamenu_single_template", 20 );

    function enovathemes_addons_footer_single_template($single_template) {
        global $post;
        if ($post->post_type == 'footer') {
            if ( $theme_file = locate_template( array ( 'single-footer.php' ) ) ) {
                $single_template = $theme_file;
            } else {
                $single_template = ENOVATHEMES_ADDONS . 'templates/single-footer.php';
            }
        }
        return $single_template;
    }
    add_filter( "single_template", "enovathemes_addons_footer_single_template", 20 );

    function enovathemes_addons_title_section_single_template($single_template) {
        global $post;
        if ($post->post_type == 'title_section') {
            if ( $theme_file = locate_template( array ( 'single-title-section.php' ) ) ) {
                $single_template = $theme_file;
            } else {
                $single_template = ENOVATHEMES_ADDONS . 'templates/single-title-section.php';
            }
        }
        return $single_template;
    }
    add_filter( "single_template", "enovathemes_addons_title_section_single_template", 20 );

    add_filter( 'woocommerce_locate_template', 'enovathemes_addons_woocommerce_locate_template', 10, 3 );
    function enovathemes_addons_woocommerce_locate_template( $template, $template_name, $template_path ) {
      global $woocommerce;

      $_template = $template;

      if ( ! $template_path ) $template_path = $woocommerce->template_url;

      $plugin_path  = ENOVATHEMES_ADDONS . '/woocommerce/';

      // Look within passed path within the theme - this is priority
      $template = locate_template(

        array(
          $template_path . $template_name,
          $template_name
        )
      );

      // Modification: Get the template from this plugin, if it exists
      if ( ! $template && file_exists( $plugin_path . $template_name ) )
        $template = $plugin_path . $template_name;

      // Use default template
      if ( ! $template )
        $template = $_template;

      // Return what we found
      return $template;
    }

?>
