<?php

/*  Default fonts
/*-------------------*/
    
    function textron_enovathemes_fonts_url() {
        $font_url = '';
        if ( 'off' !== _x( 'on', 'Google font: on or off', 'textron' ) ) {
            $font_url = add_query_arg( 'family', urlencode( 'Heebo:100,200,300,400,500,600,700,800,900|Roboto:100,300,400,500,700,900' ), "//fonts.googleapis.com/css" );
        }
        return $font_url;
    }

/*  Enovathemes title
/*-------------------*/

    add_filter( 'wp_title', 'textron_enovathemes_filter_wp_title' );
    function textron_enovathemes_filter_wp_title( $title ) {
        global $page, $paged;

        if ( is_feed() ){
            return $title;
        }
            
        $site_description = get_bloginfo( 'description' );

        $filtered_title = $title . get_bloginfo( 'name' );
        $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
        $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( esc_html__( 'Page %s', 'textron'), max( $paged, $page ) ) : '';

        return $filtered_title;
    }

/*  Post format chat
/*-------------------*/

    function textron_enovathemes_post_chat_format($content) {
        global $post;
        if (has_post_format('chat')) {
            $chatoutput = "<ul class=\"chat\">\n";
            $split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/", $content);

            foreach($split as $haystack) {
                if (strpos($haystack, ":")) {
                    $string = explode(":", trim($haystack), 2);
                    $who = strip_tags(trim($string[0]));
                    $what = strip_tags(trim($string[1]));
                    $row_class = empty($row_class)? " class=\"chat-highlight\"" : "";
                    $chatoutput = $chatoutput . "<li><span class='name'>$who:</span><p>$what</p></li>\n";
                } else {
                    $chatoutput = $chatoutput . $haystack . "\n";
                }
            }

            $content = $chatoutput . "</ul>\n";
            return $content;
        } else { 
            return $content;
        }
    }
    add_filter( "the_content", "textron_enovathemes_post_chat_format", 9);

/*  Get the widget
/*-------------------*/

    if( !function_exists('textron_enovathemes_get_the_widget') ){
  
        function textron_enovathemes_get_the_widget( $widget, $instance = '', $args = '' ){
            ob_start();
            the_widget($widget, $instance, $args);
            return ob_get_clean();
        }
        
    }

/*  get SVG contents
/*-------------------*/
    
    function textron_enovathemes_svg_icon( $svg, $url = false) {
        ob_start();
        if ($url) {
            include($svg);
        } else {
            include(get_template_directory().'/images/icons/'.$svg);
        }
        $contents = ob_get_clean();
        return $contents;
    }

/*  Post image overlay
/*-------------------*/

    function textron_enovathemes_post_image_overlay($blog_post_layout){

        $post_format   = get_post_format(get_the_ID());
        $link_url      = get_post_meta( get_the_ID(), 'enovathemes_addons_link', true );

        $read_more_link = ($blog_post_layout == "full" && $post_format == "link" && !empty($link_url)) ? $link_url : get_the_permalink();

        $output = '';

        $output .='<a class="post-image-overlay" href="'.esc_url($read_more_link).'" title="'.esc_attr__("Read more about", 'textron').' '.esc_attr(the_title_attribute( 'echo=0' )).'">';
        $output .='</a>';

        return $output;
    }

/*  Pagination
/*-------------------*/

    function textron_enovathemes_post_nav_num($post_type){

        if( is_singular() ){
            return;
        }

        global $wp_query;

        $big    = 999999;
        $output = "";

        switch ($post_type) {
            case 'project':
                $posts_per_page = (isset($GLOBALS['textron_enovathemes']['project-per-page']) && !empty($GLOBALS['textron_enovathemes']['project-per-page'])) ? $GLOBALS['textron_enovathemes']['project-per-page'] : get_option( 'posts_per_page' );
                break;
            case 'product':
                $posts_per_page = (isset($GLOBALS['textron_enovathemes']['product-per-page']) && !empty($GLOBALS['textron_enovathemes']['product-per-page'])) ? $GLOBALS['textron_enovathemes']['product-per-page'] : get_option( 'posts_per_page' );
                break;
            default:
                $posts_per_page = '';
                break;
        }

        $total  = (empty($posts_per_page)) ? $wp_query->max_num_pages : ceil($wp_query->found_posts/$posts_per_page);

        $args = array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'total'     => $total,
        'current'   => max(1, get_query_var('paged')),
        'show_all'  => false,
        'end_size'  => 2,
        'mid_size'  => 3,
        'prev_next' => true,
        'prev_text' => textron_enovathemes_svg_icon('arrow.svg'),
        'next_text' => textron_enovathemes_svg_icon('arrow.svg'),
        'type'      => 'list');

        if ($posts_per_page < $wp_query->found_posts) {
            $output .='<nav class="enovathemes-navigation">';
                $output .= paginate_links($args);
            $output .='</nav>';
        }
        
        echo textron_enovathemes_output_html($output);
    }

/*  Simple pagination
/*-------------------*/
    
    function textron_enovathemes_post_nav($post_type,$post_id){

            global $textron_enovathemes;

            $single_nav_mob = "false";

            if ($post_type == "project") {
                $post_prev_text = esc_html__('Previous project', 'textron');
                $post_next_text = esc_html__('Next project', 'textron');
            } elseif ($post_type == "product") {
                $post_prev_text = esc_html__('Previous product', 'textron');
                $post_next_text = esc_html__('Next product', 'textron');
            } else {
                $post_prev_text = esc_html__('Previous post', 'textron');
                $post_next_text = esc_html__('Next post', 'textron');
            }

            $prev_post = get_adjacent_post(false, '', true);
            $next_post = get_adjacent_post(false, '', false);
            
        ?>
        <nav class="post-single-navigation <?php echo esc_attr($post_type) ?> mob-hide-false et-clearfix">  
          <?php if(!empty($next_post)) {echo '<a rel="prev" href="' . esc_url(get_permalink($next_post->ID)) . '" title="'.esc_attr__("Previous ","textron").$post_type.'">'.$post_prev_text.'</a>'; } ?>
          <?php if(!empty($prev_post)) {echo '<a rel="next" href="' . esc_url(get_permalink($prev_post->ID)) . '" title="'.esc_attr__("Next ","textron").$post_type.'">'.$post_next_text.'</a>'; } ?>
        </nav>
        <?php 
    }

/*  Navigation
/*-------------------*/

    function textron_enovathemes_navigation($post_type, $navigation){

        switch ($navigation) {
            case 'infinite':
            case 'loadmore':

                $link_class[] = 'et-button';
                $link_class[] = 'hover-scale';
                $link_class[] = 'shadow-false';
                $link_class[] = 'round';
                $link_class[] = 'normal';
                $link_class[] = 'medium';
                $link_class[] = 'post-ajax-button';

                $attributes   = array();
                $attributes[] = 'href="#"';
                $attributes[] = 'data-effect="scale"';
                $attributes[] = 'class="'.implode(" ", $link_class).'"';
                $attributes[] = 'id="'.$navigation.'"';
                
                $output ='<a '.implode(" ", $attributes).'>';
                    $output .='<span class="text">Load more</span>';
                    $output .='<svg viewBox="0 0 220 56" class="button-back">';
                        $output .='<path class="regular" d="M192,56H28A28,28,0,0,1,28,0H192A28,28,0,0,1,192,56Z" />';
                        $output .='<circle class="loader-path" cx="110" cy="28" r="20" />';
                    $output .='</svg>';
                $output .='</a>';

                echo textron_enovathemes_output_html($output);

                break;
            default:
                echo textron_enovathemes_post_nav_num($post_type);
                break;
        }

    }

/*  Excerpt
/*-------------------*/

    function textron_enovathemes_substrwords($text, $maxchar, $end='...') {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);      
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                } 
                else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        } 
        else {
            $output = $text;
        }
        return $output;
    }

/*  Loop post content
/*-------------------*/

    function textron_enovathemes_build_post_media($blog_post_layout,$thumb_size,$id){
        $thumbnail_id  = ($id) ? $id: get_post_thumbnail_id( get_the_ID() );
        $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
        $thumbnail     = wp_get_attachment_image_src($thumbnail_id,$thumb_size);

        if (is_array($thumbnail)) {

            if ($thumbnail_alt) {
                $thumbnail_alt = 'alt="'.$thumbnail_alt.'"';
            }

            $responsive_data = array();
            $responsive_data_clone = array();

            if ($blog_post_layout == "list") {

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
               $data_img = TEXTRON_SVG.'image_placeholder.svg';
            }
            
            $output = "";
            $output .= '<img class="lazy" alt="'.esc_attr(get_bloginfo('name')).'" src="'.$data_img.'" width="'.esc_attr($thumbnail[1]).'" height="'.esc_attr($thumbnail[2]).'" data-src="'.esc_url($thumbnail[0]).'" '.$thumbnail_alt.' '.implode(' ', $responsive_data).' '.implode(' ', $responsive_data_clone).' />';
            $output .= textron_enovathemes_svg_icon('placeholder.svg');
            return $output;

        }
    }

    function textron_enovathemes_post_media($blog_post_layout,$thumb_size){
        
        $post_format   = get_post_format(get_the_ID());
        $video         = get_post_meta( get_the_ID(), 'enovathemes_addons_video', true );
        $video_embed   = get_post_meta( get_the_ID(), 'enovathemes_addons_video_embed', true );
        $gallery       = get_post_meta( get_the_ID(), 'enovathemes_addons_gallery', true );

        $output = "";

        if ($blog_post_layout == "full"){
            if (
                $post_format == "0" || 
                $post_format == 'chat' || 
                $post_format == 'aside'  || 
                $post_format == 'quote' || 
                $post_format == 'status' || 
                $post_format == 'audio' || 
                $post_format == 'link'){
                if (has_post_thumbnail()){
                    $output .='<div class="post-image overlay-hover post-media">';
                        $output .= textron_enovathemes_post_image_overlay($blog_post_layout);
                        $output .='<div class="image-container">';
                            $output .= textron_enovathemes_build_post_media($blog_post_layout,$thumb_size,false);
                        $output .='</div>';
                    $output .='</div>';
                }
            } elseif($post_format == "gallery") {

                if (!empty($gallery)) {

                    $output .='<div class="post-gallery post-media overlay-hover" data-columns="1">';
                        $output .='<ul class="slides tns-slider tns-gallery tns-subpixel tns-calc tns-horizontal">';
                            foreach ($gallery as $image => $url){
                                $output .='<li>';
                                    $output .= textron_enovathemes_post_image_overlay($blog_post_layout);
                                    $output .='<div class="image-container">';
                                        $output .= textron_enovathemes_build_post_media($blog_post_layout,$thumb_size,$image);
                                    $output .='</div>';
                                $output .='</li>';
                            }
                        $output .='</ul>';
                    $output .='</div>';

                } else {

                    if (has_post_thumbnail()){
                        $output .='<div class="post-image overlay-hover post-media">';
                            $output .= textron_enovathemes_post_image_overlay($blog_post_layout);
                            $output .='<div class="image-container">';
                                $output .= textron_enovathemes_build_post_media($blog_post_layout,$thumb_size,false);
                            $output .='</div>';
                        $output .='</div>';
                    }

                }
            } elseif($post_format == "video") {
                if (!empty($video) || !empty($video_embed)){
                    $output .='<div class="post-video post-media">';

                        if (has_post_thumbnail()){

                            $link_class[] = 'video-btn';

                            $attributes   = array();
                            $attributes[] = 'href="#"';
                            $attributes[] = 'class="'.implode(" ", $link_class).'"';

                            $output .='<div class="image-container">';

                                $output .= textron_enovathemes_build_post_media($blog_post_layout,$thumb_size,false);

                                $output .='<a '.implode(" ", $attributes).'>';
                                    $output .='<svg viewBox="0 0 512 512">';
                                        $output .='<path class="back" d="M512,256c0,141.38-114.62,256-256,256S0,397.38,0,256,114.62,0,256,0,512,114.62,512,256Z" />';
                                        $output .='<path class="play" d="M346.89,261.61,205.11,350c-4.76,3-11.11-.24-11.11-5.61V167.62c0-5.37,6.35-8.57,11.11-5.61l141.78,88.38A6.61,6.61,0,0,1,346.89,261.61Z"/>';
                                    $output .='</svg>';
                                $output .='</a>';
                                
                            $output .='</div>';
                        }

                        if(!empty($video_embed) && empty($video)) {

                            $video_embed = str_replace('watch?v=', 'embed/', $video_embed);
                            $video_embed = str_replace('//vimeo.com/', '//player.vimeo.com/video/', $video_embed);

                            $output .='<iframe allowfullscreen="allowfullscreen" allow="autoplay" frameBorder="0" src="'.$video_embed.'" class="iframevideo video-element"></iframe>';

                        } elseif(!empty($video)) {

                            $output .='<video poster="'.TEXTRON_ENOVATHEMES_IMAGES.'/transparent.png'.'" id="video-'.get_the_ID().'" class="lazy video-element" playsinline controls>';

                                if (!empty($video)) {
                                    $output .='<source data-src="'.$video.'" src="'.TEXTRON_ENOVATHEMES_IMAGES.'/video_placeholder.mp4'.'" type="video/mp4">';
                                }
                                
                            $output .='</video>';

                        }
                    $output .='</div>';
                }
            }
        } else {
            
            $output .='<div class="post-image overlay-hover post-media">';
                $output .= textron_enovathemes_post_image_overlay($blog_post_layout);
                $output .='<div class="image-container">';
                    if (has_post_thumbnail()){
                        $output .=textron_enovathemes_build_post_media($blog_post_layout,$thumb_size,false);
                    }
                $output .='</div>';
            $output .='</div>';
            
        }

        return $output;
    }

    function textron_enovathemes_post_body($blog_post_layout,$blog_post_excerpt){
        
        $post_format   = get_post_format(get_the_ID());
        $link_url      = get_post_meta( get_the_ID(), 'enovathemes_addons_link', true );
        $status_author = get_post_meta( get_the_ID(), 'enovathemes_addons_status', true );
        $quote_author  = get_post_meta( get_the_ID(), 'enovathemes_addons_quote', true );
        $audio         = get_post_meta( get_the_ID(), 'enovathemes_addons_audio', true );
        $audio_embed   = get_post_meta( get_the_ID(), 'enovathemes_addons_audio_embed', true );

        $read_more_link = ($blog_post_layout == "full" && $post_format == "link" && !empty($link_url)) ? $link_url : get_the_permalink();
        
        $output = "";

        $output .='<div class="post-body et-clearfix">';


            $output .='<div class="post-body-inner">';

                if ($post_format == "gallery" && $blog_post_layout == "full") {
                
                    $output .='<div class="tns-controls-trigger">';
                        $output .='<button type="button" data-controls="prev" tabindex="-1" aria-controls="tns1"></button>';
                        $output .='<button type="button" data-controls="next" tabindex="-1" aria-controls="tns1"></button>';
                    $output .='</div>';
                }

                $output .='<div class="post-meta et-clearfix">';

                    $output .= '<div class="post-date">'.get_the_date().'</div>';

                    if ('' != get_the_category_list()) {
                        $output .= '<div class="post-category">'.get_the_category_list(', ').'</div>';
                    }
                    
                $output .='</div>';

                if ( '' != the_title_attribute( 'echo=0' ) ){
                    $output .='<h4 class="post-title entry-title">';
                        $output .= '<a href="'.esc_url($read_more_link).'" title="'.esc_attr__("Read more about", 'textron').' '.the_title_attribute( 'echo=0' ).'" rel="bookmark">';
                            $output .= the_title_attribute( 'echo=0' );
                        $output .= '</a>';
                    $output .='</h4>';
                }

                if ($blog_post_layout == "full"){

                    if($post_format == "audio"){
                        $output .='<div class="post-audio media">';
                            if(!empty($audio_embed) && empty($audio)) {
                                $output .= '<iframe allowfullscreen="allowfullscreen" frameBorder="0" src="'.$audio_embed.'" class="iframeaudio"></iframe>';
                            } elseif (!empty($audio)) {
                                $output .='<audio class="plyr-element" id="audio-'.get_the_ID().'" controls>';
                                    $output .='<source src="'.$audio.'" type="audio/mp3">';
                                $output .='</audio>';
                            }
                        $output .='</div>';
                    }

                    if ($post_format == "aside" || $post_format == "quote" || $post_format == "status"){

                        if ( '' != get_the_content() ){
                            $output .='<div class="post-excerpt">';

                                $output .= get_the_content(); 
                                $defaults = array(
                                    'before'           => '<div id="page-links">',
                                    'after'            => '</div>',
                                    'link_before'      => '',
                                    'link_after'       => '',
                                    'next_or_number'   => 'next',
                                    'separator'        => ' ',
                                    'nextpagelink'     => esc_html__( 'Continue reading', 'textron' ),
                                    'previouspagelink' => esc_html__( 'Go back' , 'textron'),
                                    'pagelink'         => '%',
                                    'echo'             => 0
                                );
                                $output .= wp_link_pages($defaults);

                            $output .='</div>';
                        }

                        if (!empty($quote_author)){
                            $output .= '<div class="post-quote-author">'.esc_attr($quote_author).'</div>';
                        }

                        if (!empty($status_author)){
                            $output .= '<div class="post-status-author">'.esc_attr($status_author).'</div>';
                        }

                    } else {
                        if ( '' != get_the_excerpt() && $blog_post_excerpt > 0){
                            $output .='<div class="post-excerpt">'.textron_enovathemes_substrwords(get_the_excerpt(),$blog_post_excerpt).'</div>';
                        }
                    }

                } elseif($blog_post_layout == "grid" || $blog_post_layout == "masonry") {
                    
                    if ( '' != get_the_excerpt() && $blog_post_excerpt > 0){
                        $output .='<div class="post-excerpt">'.textron_enovathemes_substrwords(get_the_excerpt(),$blog_post_excerpt).'</div>';
                    }
                }

                if ($blog_post_layout != "list" && $blog_post_layout != "grid" && $blog_post_layout != "masonry") {
                    $output .='<a href="'.esc_url($read_more_link).'" class="post-read-more" title="'.esc_attr__("Read more about", 'textron').' '.the_title_attribute( 'echo=0' ).'">'.esc_html__("Read more", 'textron').textron_enovathemes_svg_icon('arrow.svg').'</a>';
                }

            $output .='</div>';


        $output .='</div>';

        if ($blog_post_layout == "grid" || $blog_post_layout == "masonry") {
            $output .='<div class="post-read-more-wrap"><a href="'.esc_url($read_more_link).'" class="post-read-more" title="'.esc_attr__("Read more about", 'textron').' '.the_title_attribute( 'echo=0' ).'">'.esc_html__("Read more", 'textron').textron_enovathemes_svg_icon('arrow.svg').'</a></div>';
        }

        return $output;
        
    }

    function textron_enovathemes_post($blog_post_layout,$blog_post_excerpt,$thumb_size){

        $output = "";
        $class  = "";

        if (!has_post_thumbnail()){
            $class = ' no-media';
        }

        $output .='<article class="'.join( ' ', get_post_class('et-item')).$class.'" id="post-'.get_the_ID().'">';
        
            $output .='<div class="post-inner et-item-inner et-clearfix">';

                if (has_post_thumbnail(get_the_ID())) {
                    // Post media
                    $output .= textron_enovathemes_post_media($blog_post_layout,$thumb_size);
                }
                
                // Post body
                $output .= textron_enovathemes_post_body($blog_post_layout,$blog_post_excerpt);

            $output .='</div>';
        $output .='</article>';

        return $output;

    }

/*  Not found
/*-------------------*/

    function textron_enovathemes_not_found($post_type){

        $output = '';

        $output .= '<p class="enovathemes-not-found">';

        switch ($post_type) {

            case 'project':
                $output .= esc_html__('No project found.', 'textron');
                break;

            case 'products':
                $output .= esc_html__('No products found.', 'textron');
                break;

            case 'general':
                $output .= esc_html__('No search results found. Try a different search', 'textron');
                break;
            
            default:
                $output .= esc_html__('No posts found.', 'textron');
                break;
        }

        $output .= '</p>';

        return $output;
    }

/*  Hex to rgba
/*-------------------*/

    function textron_enovathemes_hex_to_rgba($hex, $o) {
        $hex = (string) $hex;
        $hex = str_replace("#", "", $hex);
        $hex = array_map('hexdec', str_split($hex, 2));
        return 'rgba('.implode(",", $hex).','.$o.')';
    }

/*  Hex to rgb shade
/*-------------------*/

    function textron_enovathemes_hex_to_rgb_shade($hex, $o) {
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

    function textron_enovathemes_brightness($hex) {
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

    function textron_enovathemes_minify_css($css) {
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace(': ', ':', $css);
        $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
        return $css;
    }

/*  Output html
/*-------------------*/

    function textron_enovathemes_output_html($html) {
        $html = preg_replace('~>\s+<~', '><', $html);
        return $html;
    }

/*  Get all menus
/*-------------------*/

    function textron_enovathemes_get_all_menus(){
        return get_terms( 'nav_menu', array( 'hide_empty' => false ) ); 
    }

/*  Default header
/*-------------------*/

    function textron_enovathemes_default_header($header_type){

        if ($header_type == "mobile") { ?>

            <header id="et-mobile-default" class="header et-mobile et-clearfix transparent-false sticky-false shadow-true mobile-true desktop-false et-mobile-default">
                <div class="vc_row wpb_row vc_row-fluid vc-row-default">
                    <div class="container et-clearfix">
                        <div class="wpb_column vc_column_container vc_col-sm-12 text-align-none">
                            <div class="vc_column-inner vci ">
                                <div class="wpb_wrapper">


                                    <div id="mctd" class="mobile-container-toggle mctd hbe hbe-icon-element hide-default-false hide-sticky-false hbe-right size-small">
                                        <div id="mobile-toggle-default" class="mobile-toggle hbe-toggle">
                                            <?php echo textron_enovathemes_svg_icon('mobile-toggle.svg'); ?>
                                        </div>
                                    </div>

                                    <?php

                                        $output = "";

                                        $class = array();
                                        $class[] = 'hbe';
                                        $class[] = 'header-logo';
                                        $class[] = 'hbe-left';

                                        $output .= '<div id="mobile-header-logo-default" class="'.implode(" ", $class).'">';
                                            $output .= '<a href="'.esc_url(home_url('/')).'" title="'.get_bloginfo('name').'">';
                                                $output .= '<img class="logo" src="'.TEXTRON_ENOVATHEMES_IMAGES.'/logo.svg" alt="'.get_bloginfo('name').'">';
                                            $output .= '</a>';
                                        $output .= '</div>';

                                        echo textron_enovathemes_output_html($output);

                                    ?>

                                    <div id="mobile-container-default" class="mobile-container">
                                        <div class="mobile-container-inner et-clearfix">
                                            <div id="vertical-align-top-default" class="snva vertical-align-top">
                                                <div id="mctd-active" class="mobile-container-toggle mctd hbe hbe-icon-element hbe-right size-small">
                                                    <div id="mobile-toggle-default-active" class="mobile-toggle hbe-toggle active">
                                                        <?php echo textron_enovathemes_svg_icon('mobile-toggle.svg'); ?>
                                                    </div>
                                                </div>
                                                <?php

                                                    $output  = '';
                                                    $class   = array();
                                                    $class[] = 'mobile-menu-container';
                                                    $class[] = 'hbe';
                                                    $class[] = 'text-align-left';

                                                    if (has_nav_menu( 'header-menu' )) {
                                                        $menu_arg = array(
                                                            'theme_location'  => 'header-menu',
                                                            'menu_class'      => 'mobile-menu hbe-inner et-clearfix',
                                                            'menu_id'         => 'mobile-menu-default',
                                                            'container'       => 'div',
                                                            'container_class' => implode(" ", $class),
                                                            'container_id'    => 'mobile-menu-container-default',
                                                            'echo'            => false,
                                                            'link_before'     => '<span class="txt">',
                                                            'link_after'      => '</span><span class="arrow">'.textron_enovathemes_svg_icon('arrow.svg').'</span>',
                                                            'depth'           => 10,
                                                        );

                                                        $output .= wp_nav_menu($menu_arg);

                                                        echo textron_enovathemes_output_html($output);
                                                    }

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mobile-container-overlay-default" class="mobile-container-overlay"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

        <?php } elseif($header_type == "desktop"){ ?>
            <header id="et-desktop-default" class="header et-desktop et-clearfix transparent-false sticky-false shadow-true mobile-false desktop-true">
                <div class="vc_row wpb_row vc_row-fluid vc_row-has-fill vc_row-o-equal-height vc_row-flex vc-row-default">
                    <div class="container et-clearfix">
                        
                        <?php

                            $output = "";

                            $class = array();
                            $class[] = 'hbe';
                            $class[] = 'header-logo';
                            $class[] = 'hbe-left';

                            $output .= '<div id="header-logo-default" class="'.implode(" ", $class).'">';
                                $output .= '<a href="'.esc_url(home_url('/')).'" title="'.get_bloginfo('name').'">';
                                    $output .= '<img class="logo" src="'.TEXTRON_ENOVATHEMES_IMAGES.'/logo.svg" alt="'.get_bloginfo('name').'">';
                                $output .= '</a>';
                            $output .= '</div>';

                            echo textron_enovathemes_output_html($output);

                        ?>
                        
                        <?php

                            $output  = "";

                            $class   = array();
                            $class[] = 'header-menu-container';
                            $class[] = 'nav-menu-container';
                            $class[] = 'hbe';
                            $class[] = 'hbe-left';
                            $class[] = 'one-page-false';
                            $class[] = 'one-page-offset-0';
                            $class[] = 'hide-default-false';
                            $class[] = 'hide-sticky-false';
                            $class[] = 'menu-hover-underline';
                            $class[] = 'submenu-appear-none';
                            $class[] = 'submenu-shadow-true';
                            $class[] = 'tl-submenu-ind-false';
                            $class[] = 'sl-submenu-ind-true';
                            $class[] = 'separator-false';
                            $class[] = 'top-separator-false';

                            $link_after  = '<span class="effect"></span></span><span class="arrow">'.textron_enovathemes_svg_icon('arrow.svg').'</span>';
                            
                            $menu_arg = array(
                                'theme_location'  => 'header-menu',
                                'menu_class'      => 'header-menu nav-menu hbe-inner et-clearfix',
                                'menu_id'         => 'header-menu-default',
                                'container'       => 'nav',
                                'container_class' => implode(" ", $class),
                                'container_id'    => 'header-menu-container-default',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s" data-color="#00245a" data-color-hover="#00245a">%3$s</ul>',
                                'echo'            => false,
                                'link_before'     => '<span class="txt">',
                                'link_after'      => $link_after,
                                'depth'           => 10,
                                'walker'          => new et_scm_walker
                            );

                            if (has_nav_menu('header-menu')) {
                                $output .= wp_nav_menu($menu_arg);
                                echo textron_enovathemes_output_html($output);
                            }

                        ?>
                                
                    </div>
                </div>
            </header>
        <?php }
    }

/*  Default title section
/*-------------------*/

    function textron_enovathemes_default_title_section($etp_title, $etp_subtitle, $etp_breadcrumbs){ ?>

        <section id="title-section-default" class="title-section et-clearfix">
            <div class="container et-clearfix">
                <div class="title-section-title-container tse text-align-left align-left tablet-align-left mobile-align-left">
                    <h1 class="title-section-title" id="title-section-title-default">
                        <?php echo esc_html($etp_title); ?>
                    </h1>
                </div>
            </div>
        </section>

    <?php }

/*  Default footer
/*-------------------*/

    function textron_enovathemes_default_footer(){ ?>

        <footer id="et-footer-default" class="footer et-footer et-clearfix sticky-false">
            <?php echo '&copy; '.date("Y").' '.esc_html__( 'Copyright', 'textron' ).' '.esc_html(get_bloginfo('name')); ?>        
        </footer>

    <?php }

?>