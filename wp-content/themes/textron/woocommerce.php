<?php 
    textron_enovathemes_global_variables();

    $product_post_size = (isset($GLOBALS['textron_enovathemes']['product-post-size']) && $GLOBALS['textron_enovathemes']['product-post-size']) ? $GLOBALS['textron_enovathemes']['product-post-size'] : "medium";
    $product_sidebar   = (isset($GLOBALS['textron_enovathemes']['product-sidebar']) && $GLOBALS['textron_enovathemes']['product-sidebar']) ? $GLOBALS['textron_enovathemes']['product-sidebar'] : "none";

    if (is_active_sidebar('shop-widgets') && $product_sidebar == "none" && !defined('ENOVATHEMES_ADDONS')) {
        $product_sidebar = 'left';
    }

    $class = array();


    if ($product_sidebar != "none") {
        $class[] = 'sidebar-active';
    }

    $class[] = 'post-layout';
    $class[] = 'product-layout';
    $class[] = $product_post_size;
    $class[] = 'layout-sidebar-'.$product_sidebar;

?>
<?php get_header(); ?>
<?php do_action('textron_enovathemes_title_section'); ?>
<?php if (is_singular('product')): ?>
    <?php get_template_part('/woocommerce/content-product-single'); ?>
<?php else: ?>
    <div class="<?php echo implode(' ', $class); ?>">
        <?php get_template_part('/woocommerce/content-product-loop'); ?>
    </div>
<?php endif ?>
<?php get_footer(); ?>