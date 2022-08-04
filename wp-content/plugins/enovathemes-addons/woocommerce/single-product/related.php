<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

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

		<section class="related products">

			<h4><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h4>

			<?php woocommerce_product_loop_start(); ?>

				<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					 	$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						include(ENOVATHEMES_ADDONS.'woocommerce/content-product.php');
					?>

				<?php endforeach; ?>

			<?php woocommerce_product_loop_end(); ?>

		</section>

	</div>

<?php endif;

wp_reset_postdata();
