<?php if(is_active_sidebar('blog-widgets')): ?>
	<?php
		textron_enovathemes_global_variables();
		$blog_sidebar= (isset($GLOBALS['textron_enovathemes']['blog-sidebar']) && $GLOBALS['textron_enovathemes']['blog-sidebar']) ? $GLOBALS['textron_enovathemes']['blog-sidebar'] : "right";
	?>
	<aside class='blog-widgets widget-area'>  
		<?php if ($blog_sidebar != "none"): ?>
			<a href="#" title="<?php echo esc_attr__("Toggle sidebar","textron"); ?>" class="content-sidebar-toggle active"><?php echo textron_enovathemes_svg_icon('close.svg'); ?></a>
		<?php endif ?>
		<?php if ( function_exists( 'dynamic_sidebar' )){dynamic_sidebar('blog-widgets');} ?>
	</aside>
<?php endif ?>	
