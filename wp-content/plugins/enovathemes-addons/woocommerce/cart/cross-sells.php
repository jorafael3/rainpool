<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $cross_sells ) : ?>

	<?php

		textron_enovathemes_global_variables();

        $product_post_size = (isset($GLOBALS['textron_enovathemes']['product-post-size']) && $GLOBALS['textron_enovathemes']['product-post-size']) ? $GLOBALS['textron_enovathemes']['product-post-size'] : "medium";

        $columns = 3;

        switch ($product_post_size) {
            case 'small':
                $columns = 4;
                break;
            case 'medium':
                $columns = 3;
                break;
            case 'large':
                $columns = 2;
                break;
            default:
                $columns = 3;
                break;
        }

	?>
	<div class="related-products manual-carousel" data-columns="<?php echo esc_attr($columns); ?>">

		<div class="cross-sells">

			<h4><?php _e( 'You may be interested in&hellip;', 'woocommerce' ) ?></h4>

			<?php woocommerce_product_loop_start(); ?>

				<?php foreach ( $cross_sells as $cross_sell ) : ?>

					<?php
					 	$post_object = get_post( $cross_sell->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						include(ENOVATHEMES_ADDONS.'woocommerce/content-product.php'); ?>

				<?php endforeach; ?>

			<?php woocommerce_product_loop_end(); ?>

		</div>

	</div>

<?php endif;

wp_reset_postdata();
