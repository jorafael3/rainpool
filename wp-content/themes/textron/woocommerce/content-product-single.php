<?php

    textron_enovathemes_global_variables();

	$product_single_sidebar     = (isset($GLOBALS['textron_enovathemes']['product-single-sidebar']) && $GLOBALS['textron_enovathemes']['product-single-sidebar']) ? $GLOBALS['textron_enovathemes']['product-single-sidebar'] : "none";
    $product_single_post_layout = (isset($GLOBALS['textron_enovathemes']['product-single-post-layout']) && !empty($GLOBALS['textron_enovathemes']['product-single-post-layout'])) ? $GLOBALS['textron_enovathemes']['product-single-post-layout'] : "single-product-tabs-under";

    if (is_active_sidebar('shop-single-widgets') && $product_single_sidebar  == "none" && !defined('ENOVATHEMES_ADDONS')) {
		$product_single_sidebar = 'right';
	}

    $class = array();

    if ($product_single_sidebar != "none") {
        $class[] = 'sidebar-active';
    }

	$class[] = 'post-layout-single';
	$class[] = 'product-layout-single';
	$class[] = 'layout-sidebar-'.$product_single_sidebar;
	$class[] = $product_single_post_layout;

?>
<div id="et-content" class="content et-clearfix padding-false">
	<div class="<?php echo implode(' ', $class); ?>">
		<div class="container et-clearfix">
			<?php if ($product_single_sidebar == "left"): ?>
				<div class="layout-sidebar product-sidebar et-clearfix">
					<?php get_sidebar('shop-single'); ?>
				</div>
				<div class="layout-content product-content et-clearfix">
					<?php if ($product_single_sidebar != "none"): ?>
						<a href="#" title="<?php echo esc_attr__("Toggle sidebar","textron"); ?>" class="content-sidebar-toggle"><?php echo textron_enovathemes_svg_icon('grid.svg'); ?></a>
					<?php endif ?>
					<?php woocommerce_content(); ?>
				</div>
			<?php elseif ($product_single_sidebar == "right"): ?>
				<div class="layout-content product-content et-clearfix">
					<?php if ($product_single_sidebar != "none"): ?>
						<a href="#" title="<?php echo esc_attr__("Toggle sidebar","textron"); ?>" class="content-sidebar-toggle"><?php echo textron_enovathemes_svg_icon('grid.svg'); ?></a>
					<?php endif ?>
					<?php woocommerce_content(); ?>
				</div>
				<div class="layout-sidebar product-sidebar et-clearfix">
					<?php get_sidebar('shop-single'); ?>
				</div>
			<?php else: ?>
				<?php woocommerce_content(); ?>
			<?php endif ?>
		</div>
	</div>
</div>