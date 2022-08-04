<?php if(is_active_sidebar('shop-widgets')): ?>
	<?php
		textron_enovathemes_global_variables();
		$shop_sidebar= (isset($GLOBALS['textron_enovathemes']['shop-sidebar']) && $GLOBALS['textron_enovathemes']['shop-sidebar']) ? $GLOBALS['textron_enovathemes']['shop-sidebar'] : "right";
	?>
	<aside class='shop-widgets widget-area'>  
		<?php if ($shop_sidebar != "none"): ?>
			<a href="#" title="<?php echo esc_attr__("Toggle sidebar","textron"); ?>" class="content-sidebar-toggle active"><?php echo textron_enovathemes_svg_icon('close.svg'); ?></a>
		<?php endif ?>
		<?php if ( function_exists( 'dynamic_sidebar' )){dynamic_sidebar('shop-widgets');} ?>
	</aside>
<?php endif ?>	
