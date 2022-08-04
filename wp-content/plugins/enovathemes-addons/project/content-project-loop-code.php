<?php
	
	textron_enovathemes_global_variables();
	
	$project_post_layout = (isset($GLOBALS['textron_enovathemes']['project-post-layout']) && !empty($GLOBALS['textron_enovathemes']['project-post-layout'])) ? $GLOBALS['textron_enovathemes']['project-post-layout'] : "project-with-details";
	$project_navigation  = (isset($GLOBALS['textron_enovathemes']['project-navigation']) && !empty($GLOBALS['textron_enovathemes']['project-navigation'])) ? $GLOBALS['textron_enovathemes']['project-navigation'] : "pagination";
	$project_image_full  = (isset($GLOBALS['textron_enovathemes']['project-image-full']) && $GLOBALS['textron_enovathemes']['project-image-full'] == 1) ? "true" : "false";
	$project_ajax_filter = (isset($GLOBALS['textron_enovathemes']['project-filter']) && $GLOBALS['textron_enovathemes']['project-filter'] == 1) ? "true" : "false";
	$projects_per_page   = (isset($GLOBALS['textron_enovathemes']['project-per-page']) && !empty($GLOBALS['textron_enovathemes']['project-per-page'])) ? $GLOBALS['textron_enovathemes']['project-per-page'] : get_option( 'posts_per_page' );
	
    $class = array();

	$class[] = 'loop-posts';
	$class[] = 'loop-projects';
	$class[] = 'et-item-set';
	$class[] = 'nav-'.$project_navigation;

?>
<?php if (have_posts()) : ?>
	<?php if ($project_ajax_filter == "true"){

		$options = array(
			'post_type' 	 => 'project',
			'term'      	 => 'project-category',
			'default_filter' => 'all',
			'shortcode' 	 => false,
			'order' 		 => 'DESC',
			'orderby' 		 => 'date',
			'posts_per_page' => $projects_per_page,
			'layout' 		 => $project_post_layout,
			'full' 		     => $project_image_full,
		);

		if ($project_navigation == "pagination") {
			$project_navigation = "infinite";
		}
		
		echo enovathemes_addons_term_filter($options);

	}?>
	<main id="loop-projects" class="<?php echo esc_attr(implode(' ', $class)); ?>" data-nav="<?php echo esc_attr($project_navigation); ?>">
		
		<?php

			$thumb_size = 'textron_600X400';

			if ($project_post_layout == "list") {
				$thumb_size = 'textron_425X425';
			}

			if ($project_image_full == "true") {
				$thumb_size = 'full';
			}

		?>

		<?php while (have_posts()) : the_post(); ?>
			<?php echo enovathemes_addons_project_post($project_post_layout,$thumb_size); ?>
		<?php endwhile; ?>
	</main>

	<?php textron_enovathemes_navigation('project',$project_navigation); ?>

<?php else : ?>
	<?php textron_enovathemes_not_found('project'); ?>
<?php endif; ?>