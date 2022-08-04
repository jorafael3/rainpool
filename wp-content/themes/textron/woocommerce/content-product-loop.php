<?php
	textron_enovathemes_global_variables();
	$product_sidebar = (isset($GLOBALS['textron_enovathemes']['product-sidebar']) && $GLOBALS['textron_enovathemes']['product-sidebar']) ? $GLOBALS['textron_enovathemes']['product-sidebar'] : "none";

	if (is_active_sidebar('shop-widgets') && $product_sidebar  == "none" && !defined('ENOVATHEMES_ADDONS')) {
		$product_sidebar = 'left';
	}

?>
<div class="container et-clearfix">
	<?php if ($product_sidebar == "left"): ?>
		<div class="layout-sidebar product-sidebar et-clearfix">
			<?php get_sidebar('shop'); ?>
		</div>
		<div class="layout-content product-content et-clearfix">
			<?php if ($product_sidebar != "none"): ?>
				<a href="#" title="<?php echo esc_attr__("Toggle sidebar","textron"); ?>" class="content-sidebar-toggle"><?php echo textron_enovathemes_svg_icon('grid.svg'); ?></a>
			<?php endif ?>
			<?php woocommerce_content(); ?>
		</div>
	<?php elseif ($product_sidebar == "right"): ?>
		<div class="layout-content product-content et-clearfix">
			<?php if ($product_sidebar != "none"): ?>
				<a href="#" title="<?php echo esc_attr__("Toggle sidebar","textron"); ?>" class="content-sidebar-toggle"><?php echo textron_enovathemes_svg_icon('grid.svg'); ?></a>
			<?php endif ?>
			<?php woocommerce_content(); ?>
		</div>
		<div class="layout-sidebar product-sidebar et-clearfix">
			<?php get_sidebar('shop'); ?>
		</div>
	<?php else: ?>
		<?php woocommerce_content(); ?>
	<?php endif ?>
</div>
