<?php
	
	textron_enovathemes_global_variables();

	$project_post_layout = (isset($GLOBALS['textron_enovathemes']['project-post-layout']) && !empty($GLOBALS['textron_enovathemes']['project-post-layout'])) ? $GLOBALS['textron_enovathemes']['project-post-layout'] : "project-with-details";

	$class = array();
	
	$class[] = 'post-layout';
	$class[] = 'project-layout';
	$class[] = 'medium';
	$class[] = 'project-layout-'.$project_post_layout;
	$class[] = $project_post_layout;
	

?>
<div id="et-content" class="content et-clearfix padding-false">
	<div class="<?php echo implode(' ', $class); ?>">
		<div class="container">
			<?php include(ENOVATHEMES_ADDONS.'project/content-project-loop-code.php'); ?>
		</div>
	</div>
</div>