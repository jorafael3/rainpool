<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

textron_enovathemes_global_variables();

$product_navigation = (isset($GLOBALS['textron_enovathemes']['product-navigation']) && $GLOBALS['textron_enovathemes']['product-navigation']) ? $GLOBALS['textron_enovathemes']['product-navigation'] : "pagination";

$class = array();

$class[] = 'loop-posts';
$class[] = 'loop-products';
$class[] = 'et-item-set';
$class[] = 'nav-'.$product_navigation;

?>
<ul id="loop-products" class="<?php echo esc_attr(implode(' ', $class)); ?>" data-nav="<?php echo esc_attr($product_navigation); ?>">
