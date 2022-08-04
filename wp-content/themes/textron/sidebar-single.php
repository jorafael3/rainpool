<?php if(is_active_sidebar('blog-single-widgets')): ?>
	<?php
		textron_enovathemes_global_variables();
		$blog_single_sidebar = (isset($GLOBALS['textron_enovathemes']['blog-single-sidebar']) && $GLOBALS['textron_enovathemes']['blog-single-sidebar']) ? $GLOBALS['textron_enovathemes']['blog-single-sidebar'] : "none";
	?>
	<aside class='blog-single-widgets widget-area'>  
		<?php if ($blog_single_sidebar != "none"): ?>
			<a href="#" title="<?php echo esc_attr__("Toggle sidebar","textron"); ?>" class="content-sidebar-toggle active"><?php echo textron_enovathemes_svg_icon('close.svg'); ?></a>
		<?php endif ?>
		<?php if ( function_exists( 'dynamic_sidebar' )){dynamic_sidebar('blog-single-widgets');} ?>
	</aside>
<?php endif ?>	
