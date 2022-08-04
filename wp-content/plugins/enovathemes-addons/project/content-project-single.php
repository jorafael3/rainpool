<?php 
	textron_enovathemes_global_variables();
    $project_single_social    = (isset($GLOBALS['textron_enovathemes']['project-single-social']) && $GLOBALS['textron_enovathemes']['project-single-social'] == 1) ? "true" : "false";

?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<?php

			$project_layout = get_post_meta( get_the_ID(), 'enovathemes_addons_project_layout', true );
			$project_format = get_post_meta( get_the_ID(), 'enovathemes_addons_project_format', true );

	        $audio             = get_post_meta( get_the_ID(), 'enovathemes_addons_audio', true );
	        $audio_embed       = get_post_meta( get_the_ID(), 'enovathemes_addons_audio_embed', true );
	        $video             = get_post_meta( get_the_ID(), 'enovathemes_addons_video', true );
	        $video_embed       = get_post_meta( get_the_ID(), 'enovathemes_addons_video_embed', true );
	        
	        $gallery_type      = get_post_meta( get_the_ID(), 'enovathemes_addons_gallery_type', true );
	        $gallery_columns   = get_post_meta( get_the_ID(), 'enovathemes_addons_gallery_columns', true );
	        $gallery           = get_post_meta( get_the_ID(), 'enovathemes_addons_gallery', true );

	        if ($gallery_type == "carousel_thumb") {
	        	$gallery_type = "slider";
	        }

			$class   = array();
			$class[] = 'project-layout-single';
			$class[] = 'project-layout-'.$project_layout;

			$thumb_size = 'textron_600X400';
			$layout     = 'full';

			if ($gallery_type == "slider" || $gallery_columns == 1) {
				$thumb_size  = 'textron_1200X800';
			}

			if ($gallery_columns == 4 || ($gallery_columns == 3 && $gallery_type == "grid")) {
				$thumb_size  = 'textron_425X425';
				$layout      = 'list';
			}

			$media_output = "";
	        $body_output  = "";

	        if ($project_format == "audio"){
	            $media_output .='<div class="post-audio post-media">';
	                if(!empty($audio_embed) && empty($audio)) {
	                    $media_output .= '<iframe allowfullscreen="allowfullscreen" frameBorder="0" src="'.$audio_embed.'" class="iframeaudio"></iframe>';;
	                } elseif (!empty($audio)) {
	                    $media_output .='<audio id="audio-'.get_the_ID().'" controls>';
	                        $media_output .='<source src="'.$audio.'" type="audio/mp3">';
	                    $media_output .='</audio>';
	                }
	            $media_output .='</div>';
	        } elseif($project_format == "video") {
	            $media_output .='<div class="post-video post-media">';
                    if (has_post_thumbnail()){

                        $link_class[] = 'video-btn';

                        $attributes   = array();
                        $attributes[] = 'href="#"';
                        $attributes[] = 'class="'.implode(" ", $link_class).'"';

                        $media_output .='<div class="image-container image-container-single">';

                            $media_output .= textron_enovathemes_build_post_media('full',$thumb_size,false);

                            $media_output .='<a '.implode(" ", $attributes).'>';
                                $media_output .='<svg viewBox="0 0 512 512">';
                                    $media_output .='<path class="back" d="M512,256c0,141.38-114.62,256-256,256S0,397.38,0,256,114.62,0,256,0,512,114.62,512,256Z" />';
                                    $media_output .='<path class="play" d="M346.89,261.61,205.11,350c-4.76,3-11.11-.24-11.11-5.61V167.62c0-5.37,6.35-8.57,11.11-5.61l141.78,88.38A6.61,6.61,0,0,1,346.89,261.61Z"/>';
                                $media_output .='</svg>';
                            $media_output .='</a>';
                            
                        $media_output .='</div>';
                    }

                    if(!empty($video_embed) && empty($video)) {

                        $video_embed = str_replace('watch?v=', 'embed/', $video_embed);
                        $video_embed = str_replace('//vimeo.com/', '//player.vimeo.com/video/', $video_embed);

                        $media_output .='<iframe allowfullscreen="allowfullscreen" allow="autoplay" frameBorder="0" src="'.$video_embed.'" class="iframevideo video-element"></iframe>';

                    } elseif(!empty($video)) {

                        $media_output .='<video poster="'.TEXTRON_ENOVATHEMES_IMAGES.'/transparent.png'.'" id="video-'.get_the_ID().'" class="lazy video-element" playsinline controls>';

                            if (!empty($video)) {
                                $media_output .='<source data-src="'.$video.'" type="video/mp4">';
                            }
                            
                        $media_output .='</video>';

                    }
                $media_output .='</div>';
	        } elseif($project_format == "gallery") {

	            if (!empty($gallery)) {

	                $gallery_class = array();

	                $gallery_class[] = 'post-media';
	                $gallery_class[] = 'gallery';
	                $gallery_class[] = $gallery_type;

	                $slides_class   = array();
	                $slides_class[] = 'slides';

	                if ($gallery_type == 'slider') {
	                	$slides_class[] = 'tns-slider';
	                	$slides_class[] = 'tns-gallery';
	                	$slides_class[] = 'tns-subpixel';
	                	$slides_class[] = 'tns-calc';
	                	$slides_class[] = 'tns-horizontal';
	                }

	                $media_output .='<div id="project-gallery" class="'.implode(' ',$gallery_class).'" data-columns="'.esc_attr($gallery_columns).'">';
                        $media_output .='<ul class="'.implode(' ',$slides_class).'">';
                            foreach ($gallery as $image => $url){
                                $media_output .='<li>';
                                    $media_output .='<div class="image-container image-container-single">';
                                    	if ($gallery_type == 'grid') {
                                    		$media_output .='<a href="'.esc_url($url).'" data-gallery="project-gallery">';
                                    	}
	                                    $media_output .=textron_enovathemes_build_post_media($layout,$thumb_size,$image);
	                                    if ($gallery_type == 'grid') {
                                    		$media_output .='</a>';
                                    	}
                                    $media_output .='</div>';
                                $media_output .='</li>';
                            }
                        $media_output .='</ul>';
	                $media_output .='</div>';

	            } else {

	                if (has_post_thumbnail()){
                        $media_output .='<div class="post-image overlay-hover post-media">';
                            $media_output .='<div class="image-container image-container-single">';
                            	$media_output .=textron_enovathemes_build_post_media('full',$thumb_size,false);
                            $media_output .='</div>';
                        $media_output .='</div>';
                    }

	            }
	        }

        	$body_output .= '<div class="project-details">';

            	if('' != get_the_title())  {
	                $body_output .= '<h3 class="post-title">';
	                    $body_output .= get_the_title( get_the_ID());
	                $body_output .= '</h3>';
                }

                if (get_the_content()) {
	                $content = apply_filters( 'the_content', get_the_content() );
	                $content = str_replace( ']]>', ']]&gt;', $content );
                }

                if ($project_single_social == "true") {
                    $body_output .= enovathemes_addons_post_social_share('project-social-share');
                }

                $body_output .= '<div class="project-content">';
                	$body_output .= get_the_content();
                $body_output .= '</div>';

        		$body_output .= '<div class="project-category">';
                	$body_output .= '<span>'.esc_html__("Category:", "enovathemes-addons").' </span>'.get_the_term_list( get_the_ID(), 'project-category', '', ', ', '' );
                $body_output .= '</div>';
	            
            $body_output .= '</div>';

		?>

		<div id="et-content" class="content et-clearfix padding-false">
			<div class="<?php echo implode(' ', $class); ?>">
				<div id="single-project-page" class="single-project-page single-post-page">

					<article <?php post_class() ?> id="project-<?php the_ID(); ?>">

						<div class="post-inner et-clearfix">

							<?php if ($project_layout != "custom"): ?>

								<div class="container">
									<?php echo textron_enovathemes_output_html($media_output); ?>
									<?php echo textron_enovathemes_output_html($body_output); ?>
								</div>
									
							<?php else: ?>
								<?php the_content(); ?>
							<?php endif ?>
						</div>

					</article>
					<div class="container et-clearfix"><?php textron_enovathemes_post_nav('project',get_the_ID()); ?></div>
					<?php echo enovathemes_addons_related_projects(); ?>

				</div>
			</div>
		</div>

	<?php endwhile; ?>
<?php endif; ?>
