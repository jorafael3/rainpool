<?php
function enovathemes_addons_responsive_styles($query,$typography = true,$row_column = false){

	$dynamic_css = '';

    if ($row_column) {

    	for ($i=0; $i <= 80; $i+=2) {

    		if ($i == 6) {$i+=2;}
			if ($i >= 10) {$i+=6;}

    		if ($query == 768) {

	    		$dynamic_css .='.vc_row.vc_column-gap-'.$i.' > .vc_column_container,
				.vc_row.vc_column-gap-'.$i.' > .container > .vc_column_container,
				.vc_row.vc_column-gap-'.$i.' > .vc_element > .vc_column_container,
				.vc_row.vc_column-gap-'.$i.' > .container > .vc_element > .vc_column_container
				{padding-left:'.($i/2).'px !important;padding-right:'.($i/2).'px !important;}';

				$dynamic_css .='.vc_row.vc_column-gap-'.$i.' {margin-left:-'.($i/2).'px !important;margin-right:-'.($i/2).'px !important;width: calc(100% + '.$i.'px);}';
				$dynamic_css .='.vc_row.vc_column-gap-'.$i.' .grid-overlay {width: calc(100% - '.$i.'px);left:'.($i/2).'px;}';

				$dynamic_css .='.compose-mode .vc_element.vc_hold-hover>.wpb_row.vc_column-gap-'.$i.'>.container>.vc_element:before,
				.compose-mode .vc_element.vc_hover>.wpb_row.vc_column-gap-'.$i.'>.container>.vc_element:before,
				.compose-mode .vc_element:hover>.wpb_row.vc_column-gap-'.$i.'>.container>.vc_element:before,
				.compose-mode .vc_element.vc_hold-hover>.vc_inner.vc_column-gap-'.$i.'>.vc_element:before,
				.compose-mode .vc_element.vc_hover>.vc_inner.vc_column-gap-'.$i.'>.vc_element:before,
				.compose-mode .vc_element:hover>.vc_inner.vc_column-gap-'.$i.'>.vc_element:before,
				.view-mode .vc_element.vc_hold-hover>.wpb_row.vc_column-gap-'.$i.'>.container>.vc_element:before,
				.view-mode .vc_element.vc_hover>.wpb_row.vc_column-gap-'.$i.'>.container>.vc_element:before,
				.view-mode .vc_element:hover>.wpb_row.vc_column-gap-'.$i.'>.container>.vc_element>.vc_column_container>:before{
				    left:'.($i/2).'px;
				    width:calc(100% - '.$i.'px);
				}';

			}

			if ($query == '1280') {
				$dynamic_css .='.vc_row.vc_column-gap-'.$i.'>.container {max-width:'.(1200 + $i).'px}';
			}

	    }
    } else {
    	for ($i=0; $i <= 50; $i++) {
	        $dynamic_css .='.vci[data-'.$query.'-l="'.$i.'"]{padding-left: '.$i.'% !important}';
			$dynamic_css .='.vci[data-'.$query.'-r="'.$i.'"]{padding-right: '.$i.'% !important}';
	    }

	    if ($typography) {
	    	for ($i=10; $i <= 80; $i++) {
		        $dynamic_css .='[data-'.$query.'-f="'.$i.'"]{font-size: '.$i.'px !important}';
		        $dynamic_css .='[data-'.$query.'-lh="'.$i.'"]{line-height: '.$i.'px !important}';
		    }
	    }
    }

    return $dynamic_css;
}

function enovathemes_addons_include_dynamic_styles_cached() {

    if ( false === ( $dynamic_css = get_transient( 'dynamic-styles-cached' ) ) ) {


    	global $textron_enovathemes, $woocommerce, $post, $product, $wp_query, $query_string;

	    $dynamic_css = "";

	    if(isset($GLOBALS['textron_enovathemes']['custom-css']) && !empty($GLOBALS['textron_enovathemes']['custom-css'])){
			$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css'];
		}

		/* Animation delay
		/*-------------*/

			for ($i=0; $i <= 2000; $i+=50) {
		        $dynamic_css .='[data-del="'.$i.'"]{animation-delay:'.$i.'ms !important;}';
		    }

		/* Typography
		/*-------------*/

			$et_main_font_size          = (isset($GLOBALS['textron_enovathemes']['main-typo']['font-size']) && $GLOBALS['textron_enovathemes']['main-typo']['font-size']) ? $GLOBALS['textron_enovathemes']['main-typo']['font-size'] : "16px";
			$et_main_font_weight        = (isset($GLOBALS['textron_enovathemes']['main-typo']['font-weight']) && $GLOBALS['textron_enovathemes']['main-typo']['font-weight']) ? $GLOBALS['textron_enovathemes']['main-typo']['font-weight'] : "400";
			$et_main_line_height        = (isset($GLOBALS['textron_enovathemes']['main-typo']['line-height']) && $GLOBALS['textron_enovathemes']['main-typo']['line-height']) ? $GLOBALS['textron_enovathemes']['main-typo']['line-height'] : "26px";
			$et_main_letter_spacing     = (isset($GLOBALS['textron_enovathemes']['main-typo']['letter-spacing']) && $GLOBALS['textron_enovathemes']['main-typo']['letter-spacing']) ? $GLOBALS['textron_enovathemes']['main-typo']['letter-spacing'] : "0.25px";
			$et_main_font_family        = (isset($GLOBALS['textron_enovathemes']['main-typo']['font-family']) && $GLOBALS['textron_enovathemes']['main-typo']['font-family']) ? $GLOBALS['textron_enovathemes']['main-typo']['font-family'] : "Roboto";
			$et_main_color              = (isset($GLOBALS['textron_enovathemes']['main-typo']['color']) && $GLOBALS['textron_enovathemes']['main-typo']['color']) ? $GLOBALS['textron_enovathemes']['main-typo']['color'] : "#616161";
			$et_headings_font_family    = (isset($GLOBALS['textron_enovathemes']['headings-typo']['font-family']) && $GLOBALS['textron_enovathemes']['headings-typo']['font-family']) ? $GLOBALS['textron_enovathemes']['headings-typo']['font-family'] : "Heebo";
			$et_headings_font_weight    = (isset($GLOBALS['textron_enovathemes']['headings-typo']['font-weight']) && $GLOBALS['textron_enovathemes']['headings-typo']['font-weight']) ? $GLOBALS['textron_enovathemes']['headings-typo']['font-weight'] : '500';
			$et_headings_text_transform = (isset($GLOBALS['textron_enovathemes']['headings-typo']['text-transform']) && $GLOBALS['textron_enovathemes']['headings-typo']['text-transform']) ? $GLOBALS['textron_enovathemes']['headings-typo']['text-transform'] : "none";
			$et_headings_letter_spacing = (isset($GLOBALS['textron_enovathemes']['headings-typo']['letter-spacing']) && $GLOBALS['textron_enovathemes']['headings-typo']['letter-spacing']) ? $GLOBALS['textron_enovathemes']['headings-typo']['letter-spacing'] : "0.5px";
			$et_headings_color          = (isset($GLOBALS['textron_enovathemes']['headings-typo']['color']) && $GLOBALS['textron_enovathemes']['headings-typo']['color']) ? $GLOBALS['textron_enovathemes']['headings-typo']['color'] : "#00245a";
			$et_h1_font_size            = (isset($GLOBALS['textron_enovathemes']['h1-typo']['font-size']) && $GLOBALS['textron_enovathemes']['h1-typo']['font-size']) ? $GLOBALS['textron_enovathemes']['h1-typo']['font-size'] : "48px";
			$et_h1_line_height          = (isset($GLOBALS['textron_enovathemes']['h1-typo']['line-height']) && $GLOBALS['textron_enovathemes']['h1-typo']['line-height']) ? $GLOBALS['textron_enovathemes']['h1-typo']['line-height'] : "56px";
			$et_h2_font_size            = (isset($GLOBALS['textron_enovathemes']['h2-typo']['font-size']) && $GLOBALS['textron_enovathemes']['h2-typo']['font-size']) ? $GLOBALS['textron_enovathemes']['h2-typo']['font-size'] : "40px";
			$et_h2_line_height          = (isset($GLOBALS['textron_enovathemes']['h2-typo']['line-height']) && $GLOBALS['textron_enovathemes']['h2-typo']['line-height']) ? $GLOBALS['textron_enovathemes']['h2-typo']['line-height'] : "48px";
			$et_h3_font_size            = (isset($GLOBALS['textron_enovathemes']['h3-typo']['font-size']) && $GLOBALS['textron_enovathemes']['h3-typo']['font-size']) ? $GLOBALS['textron_enovathemes']['h3-typo']['font-size'] : "32px";
			$et_h3_line_height          = (isset($GLOBALS['textron_enovathemes']['h3-typo']['line-height']) && $GLOBALS['textron_enovathemes']['h3-typo']['line-height']) ? $GLOBALS['textron_enovathemes']['h3-typo']['line-height'] : "40px";
			$et_h4_font_size            = (isset($GLOBALS['textron_enovathemes']['h4-typo']['font-size']) && $GLOBALS['textron_enovathemes']['h4-typo']['font-size']) ? $GLOBALS['textron_enovathemes']['h4-typo']['font-size'] : "24px";
			$et_h4_line_height          = (isset($GLOBALS['textron_enovathemes']['h4-typo']['line-height']) && $GLOBALS['textron_enovathemes']['h4-typo']['line-height']) ? $GLOBALS['textron_enovathemes']['h4-typo']['line-height'] : "32px";
			$et_h5_font_size            = (isset($GLOBALS['textron_enovathemes']['h5-typo']['font-size']) && $GLOBALS['textron_enovathemes']['h5-typo']['font-size']) ? $GLOBALS['textron_enovathemes']['h5-typo']['font-size'] : "20px";
			$et_h5_line_height          = (isset($GLOBALS['textron_enovathemes']['h5-typo']['line-height']) && $GLOBALS['textron_enovathemes']['h5-typo']['line-height']) ? $GLOBALS['textron_enovathemes']['h5-typo']['line-height'] : "28px";
			$et_h6_font_size            = (isset($GLOBALS['textron_enovathemes']['h6-typo']['font-size']) && $GLOBALS['textron_enovathemes']['h6-typo']['font-size']) ? $GLOBALS['textron_enovathemes']['h6-typo']['font-size'] : "18px";
			$et_h6_line_height          = (isset($GLOBALS['textron_enovathemes']['h6-typo']['line-height']) && $GLOBALS['textron_enovathemes']['h6-typo']['line-height']) ? $GLOBALS['textron_enovathemes']['h6-typo']['line-height'] : "28px";

			$dynamic_css .='body,input,select,pre,code,kbd,samp,dt,
			#cancel-comment-reply-link,
			.box-item-content, textarea, 
			.widget_price_filter .price_label {
				font-size: '.$et_main_font_size.';
				font-weight: '.$et_main_font_weight.';
				font-family:'.$et_main_font_family.';
				line-height: '.$et_main_line_height.';
				letter-spacing: '.$et_main_letter_spacing.';
				color:'.$et_main_color.';
			}';

			$dynamic_css .='.header-login .login-title, 
			.cart-contents {
				font-size: '.$et_main_font_size.';
				font-weight: '.$et_main_font_weight.';
				font-family:'.$et_main_font_family.';
				letter-spacing: '.$et_main_letter_spacing.';
			}';

			$dynamic_css .='h1,h2,h3,h4,h5,h6, 
			.woocommerce-Tabs-panel .shop_attributes th,
			#reply-title,
			.product .summary .price,
			.et-timer .timer-count,
			.et-pricing-table .currency,
			.et-pricing-table .price,
			.et-counter .counter,
			.et-progress .percent,
			.error404-default-subtitle,
			.woocommerce-MyAccount-navigation ul li a,
			.woocommerce-tabs .tabs li a {
				font-family:'.$et_headings_font_family.';
				text-transform: '.$et_headings_text_transform.';
				font-weight: '.$et_headings_font_weight.';
				color:'.$et_headings_color.';
			}';

			$dynamic_css .='h1,h2 {
				letter-spacing: '.$et_headings_letter_spacing.';
			}';

			$dynamic_css .='.widget_layered_nav ul li a, 
			.widget_nav_menu ul li a, 
			.widget_product_categories ul li a,
			.widget_categories ul li a,
			.wp-block-archives li a,
			.post-single-navigation a, 
			.widget_pages ul li a, 
			.widget_archive ul li a, 
			.widget_meta ul li a, 
			.widget_recent_entries ul li a, 
			.widget_rss ul li a, 
			.widget_icl_lang_sel_widget li a, 
			.recentcomments a, 
			.widget_product_search form button:before, 
			.wp-block-search form button:before, 
			.page-content-wrap .widget_shopping_cart .cart_list li .remove,
			.pricing-table-body ul li{
				font-family:'.$et_headings_font_family.';
				font-weight: '.$et_headings_font_weight.';
				letter-spacing: '.$et_headings_letter_spacing.';
				color:'.$et_headings_color.';
			}';

			$dynamic_css .='.widget_et_recent_entries .post-title a,
			.widget_products .product_list_widget > li .product-title a,
			.widget_recently_viewed_products .product_list_widget > li .product-title a,
			.widget_recent_reviews .product_list_widget > li .product-title a,
			.widget_top_rated_products .product_list_widget > li .product-title a {
				color:'.$et_headings_color.' !important;
			}';

			$dynamic_css .='.page-content-wrap .widget_shopping_cart .cart-product-title a {
				color:'.$et_headings_color.';
			}';

			$dynamic_css .='h1 {font-size: '.$et_h1_font_size.'; line-height: '.$et_h1_line_height.';}';
			$dynamic_css .='h2 {font-size: '.$et_h2_font_size.'; line-height: '.$et_h2_line_height.';}';
			$dynamic_css .='h3 {font-size: '.$et_h3_font_size.'; line-height: '.$et_h3_line_height.';}';
			$dynamic_css .='h4 {font-size: '.$et_h4_font_size.'; line-height: '.$et_h4_line_height.';}';
			$dynamic_css .='h5 {font-size: '.$et_h5_font_size.'; line-height: '.$et_h5_line_height.';}';
			$dynamic_css .='h6 {font-size: '.$et_h6_font_size.'; line-height: '.$et_h6_line_height.';}';

			$dynamic_css .='.widgettitle
			{font-size: '.$et_h5_font_size.'; line-height: '.$et_h5_line_height.';}';

			$dynamic_css .='.woocommerce-Tabs-panel h2,
			.widget_layered_nav ul li a, 
			.widget_nav_menu ul li a, 
			.widget_product_categories ul li a
			{font-size: '.$et_h6_font_size.'; line-height: '.$et_h6_line_height.';}';

			$dynamic_css .='#reply-title,.woocommerce h2
			{font-size: '.$et_h4_font_size.'; line-height: '.$et_h4_line_height.';}';

			$dynamic_css .='.et-timer .timer-count
			{font-size: '.$et_h1_font_size.'; line-height: '.$et_h1_line_height.';}';

		/* Color
		/*-------------*/

			$main_color      = (isset($GLOBALS['textron_enovathemes']['main-color']) && $GLOBALS['textron_enovathemes']['main-color']) ? $GLOBALS['textron_enovathemes']['main-color'] : '#00bfff';
			$secondory_color = (isset($GLOBALS['textron_enovathemes']['secondory-color']) && $GLOBALS['textron_enovathemes']['secondory-color']) ? $GLOBALS['textron_enovathemes']['secondory-color'] : '#082c5f';
			$area_color      = (isset($GLOBALS['textron_enovathemes']['area-color']) && $GLOBALS['textron_enovathemes']['area-color']) ? $GLOBALS['textron_enovathemes']['area-color'] : '#edf1f8';


			/* $area_color
			/*-------------*/

				$dynamic_css .='#loadmore svg,
				.et-pricing-table .et-button svg,
				.lazy-inline-image path,
				.full-images-placeholder .media-placeholder{
					fill: '.$area_color.';
				}';

				$dynamic_css .='.enovathemes-navigation li a,
				.enovathemes-navigation li .current,
				.woocommerce-pagination li a,
				.woocommerce-pagination li .current,
				.woocommerce-pagination .next,
				.woocommerce-pagination .prev,
				.full .post-media .image-container,
				.product .image-container,
				.widget .image-container,
				.et-instagram .image-container,
				.single-post-page .post-media .image-container,
				.et-video .image-container,
				.widget .post-media .image-container,
				.wp-block-archives li a:before,
				.widget_pages ul li a:before,
				.widget_archive ul li a:before,
				.widget_meta ul li a:before,
				.widget_layered_nav ul li a:before,
				.widget_nav_menu ul li a:before,
				.widget_product_categories ul li a:before,
				.widget_calendar caption,
				.widget_calendar td#today,
				.wp-block-calendar caption,
				.wp-block-calendar td#today,
				.widget_tag_cloud .tagcloud a,
				.wp-block-tag-cloud a, 
				.post-tags a, 
				.widget_product_tag_cloud .tagcloud a, 
				.project-tags a,
				.post-tags-single a,
				.post-author-ind,
				.related-posts-wrapper,
				.comment-reply-link,
				ul.chat li > p,
				.project-read-more,
				.product .button,
				.product .added_to_cart,
				.widget_price_filter .ui-slider-horizontal,
				.woocommerce-product-gallery__trigger,
				.woocommerce-tabs .tabs li a,
				.comment-form-rating a,
				.star-rating,
				.shop_table thead, .shop_table thead th,
				.et-pricing-table .label,
				.et-testimonial-container.mult .et-testimonial-inner,
				.woocommerce-message {
				    background-color: '.$area_color.';
				}';

				$dynamic_css .='.widget_calendar caption,
				.widget_calendar td,
				.widget_calendar th,
				.wp-block-calendar caption,
				.wp-block-calendar td,
				.wp-block-calendar th,
				.see-responses,
				.woocommerce-Tabs-panel .shop_attributes th,
				.woocommerce-Tabs-panel .shop_attributes td,
				.shop_table thead, .shop_table thead th {
				    border-color: '.$area_color.';
				}';

			/* $secondory_color
			/*-------------*/

				$dynamic_css .='circle.loader-path {
					stroke: '.$secondory_color.';
				}';

				$dynamic_css .='@keyframes color {
					0%,100% {stroke: '.$secondory_color.';}
					40%, 60% {stroke: '.$main_color.';}
					80%, 90% {stroke: '.$secondory_color.';}
				}';

				$dynamic_css .='.post-read-more:hover svg,
				.content-sidebar-toggle svg,
				.image-container .placeholder circle,
				.enovathemes-navigation .next svg,
				.enovathemes-navigation .prev svg,
				.post-social-share a.social-toggle svg,
				.project-read-more svg,
				.et-person .et-social-links svg,
				.lazy-inline-image circle {
					fill: '.$secondory_color.';
				}';

				$dynamic_css .='.post-single-navigation a:hover,
				.see-responses:hover,
				.woocommerce-product-gallery .flex-control-nav li img.flex-active {
					border-color: '.$secondory_color.';
				}';

				$dynamic_css .='#to-top:hover,
				.post-date:after,
				.post-quote-author:before,
				.post-status-author:before,
				.enovathemes-navigation li a:hover,
				.enovathemes-navigation li .current,
				.woocommerce-pagination li a:hover,
				.woocommerce-pagination li .current,
				.format-quote .post-excerpt:before,
				.format-status .post-excerpt:before,
				.format-aside .post-excerpt:before,
				.format-link .post-body:before,
				.format-quote .post-content:before,
				.format-status .post-content:before,
				.format-aside .post-content:before,
				.format-link .post-body:before,
				.single-post-page > .format-link .post-link:before,
				.post.sticky .post-body:before,
				.author-wrapper:before,
				.single-post-page blockquote:before,
				form #searchsubmit + .search-icon,
				.widget_tag_cloud .tagcloud a:hover, 
				.wp-block-tag-cloud a:hover,
				.post-tags a:hover, 
				.widget_product_tag_cloud .tagcloud a:hover, 
				.project-tags a:hover,
				.post-tags-single a:hover,
				.post-single-navigation a:hover:before,
				.related-posts-title:after,
				.comment-reply-title:after,
				.comments-title:after,
				.upsells > h4:after,
				.crosssells > h4:after,
				.related > h4:after,
				.comment-reply-link,
				.post-media .tns-controls button:before,
				.post-media .tns-controls button:hover,
				.et-carousel .tns-controls button:before,
				.et-carousel .tns-controls button:hover,
				.et-gallery.slider .tns-controls button:before,
				.et-gallery.slider .tns-controls button:hover,
				.project-read-more:hover,
				.project-meta-heading:after,
				.gsap-lightbox-controls:after,
				.product .button:hover,
				.product .added_to_cart:hover,
				.product .single_add_to_cart_button,
				.woocommerce-product-gallery__trigger:hover,
				.woocommerce-product-gallery__trigger:before,
				.comment-text .meta:after,
				.woocommerce h2:after,
				.woocommerce h3:after,
				.et-blockquote .title:before,
				.et-testimonial .title:after,
				.popup-banner-toggle,
				.widget_mailchimp,
				.post-social-share a:hover,
				.woocommerce-pagination .next:before,
				.woocommerce-pagination .prev:before {
					background-color: '.$secondory_color.';
				}';

				$dynamic_css .='.woocommerce-product-search button[type="submit"] {
					background-color: '.$secondory_color.' !important;
				}';
				
				$dynamic_css .='.widget_instagram ul li a:after,
					.widget_flickr ul li a:after,
					.widget_products .product_list_widget > li > a .image-container:after,
					.widget_recently_viewed_products .product_list_widget > li a .image-container:after,
					.widget_recent_reviews .product_list_widget > li a .image-container:after,
					.widget_top_rated_products .product_list_widget > li a .image-container:after,
					.widget_shopping_cart_content .product_list_widget > li .image-container:after,
					.shop_table .product-thumbnail .image-container:after,
					.widget_et_recent_entries .post-thumbnail a:after,
					.widget_products .product_list_widget > li .product-image .image-container a:after,
					.widget_recently_viewed_products .product_list_widget > li .product-image .image-container a:after,
					.widget_recent_reviews .product_list_widget > li .product-image .image-container a:after,
					.widget_top_rated_products .product_list_widget > li .product-image .image-container a:after  {
					background-color: '.enovathemes_addons_hex_to_rgba($secondory_color,0.8).';
				}';

				$dynamic_css .='.project .post-image-overlay .post-image-overlay-content {
					background: linear-gradient(to bottom, '.enovathemes_addons_hex_to_rgba($secondory_color,0).' 0%,'.$secondory_color.' 100%);
			    	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$secondory_color.'", endColorstr="'.$secondory_color.'",GradientType=0 );
				}';

				$dynamic_css .='.project .post-image-overlay:before {
					background: linear-gradient(to bottom, '.enovathemes_addons_hex_to_rgba($secondory_color,0).' 25%,'.enovathemes_addons_hex_to_rgba($secondory_color,0.7).' 100%);
			    	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$secondory_color.'", endColorstr="'.$secondory_color.'",GradientType=0 );
				}';

				$dynamic_css .='.post-meta, .post-meta a,
				.loop-posts .post-title,
				.loop-posts .post-title a,
				a, a:hover,
				.post-ajax-button,
				.post-quote-author,
				.post-status-author,
				.format-quote .post-excerpt,
				.format-status .post-excerpt,
				.format-aside .post-excerpt,
				.widget_calendar,
				.widget_calendar a,
				.wp-block-calendar,
				.wp-block-calendar a,
				.widget_tag_cloud .tagcloud a, 
				.wp-block-tag-cloud a,
				.post-tags a, 
				.widget_product_tag_cloud .tagcloud a, 
				.project-tags a,
				.post-tags-single a,
				.instagram-follow a,
				.post-author-ind,
				ul.chat li > *,
				.project-read-more,
				.project-details .project-category,
				.project-details .project-category a,
				.project-content,
				.product .button,
				.product .added_to_cart,
				.widget_price_filter .price_label,
				.product .price del,
				.woocommerce-variation-availability,
				.product_meta *,
				.woocommerce-tabs .tabs li a,
				.comment-text .meta,
				.widget_rating_filter ul li,
				.shop_table thead th,
				.woocommerce table.wishlist_table thead th,
				.woocommerce-MyAccount-navigation li a,
				blockquote,q,
				.et-blockquote .title,
				.et-testimonial .title,
				.et-pricing-table .plan,
				.et-pricing-table .et-button,
				.et-pricing-table .label,
				.et-person .title,
				.woocommerce-message {
					color: '.$secondory_color.';
				}';

			/* $main_color
			/*-------------*/

				$dynamic_css .='#to-top svg,
				.post-read-more svg,
				.video-btn .back,
				.ajax-add-to-cart-loading svg.tick,
				.et-person .et-social-links a:hover svg {
					fill: '.$main_color.';
				}';

				$dynamic_css .='.cursor-follower {
				    background-color: '.enovathemes_addons_hex_to_rgba($main_color,0.2).';
				}';

				$dynamic_css .='.loop-posts .post-title:hover,
				.loop-posts .post-title a:hover,
				.post-read-more,
				.widget_title,
				.widgettitle,
				.instagram-follow a:hover,
				.product .summary .price ins,
				.page-content-wrap .widget_shopping_cart .cart-product-title a:hover,
				.page-content-wrap .widget_shopping_cart .cart-product-title:hover a,
				.widget_products .product_list_widget > li > a:hover .product-title,
				.widget_recently_viewed_products .product_list_widget > li > a:hover .product-title,
				.widget_recent_reviews .product_list_widget > li > a:hover .product-title,
				.widget_top_rated_products .product_list_widget > li > a:hover .product-title,
				.search-posts .post-title a:hover,
				.search-posts .post-title:hover a,
				.comment-meta .comment-date-time a:hover,
				.comment-author a:hover,
				.comment-content .edit-link a a,
				#cancel-comment-reply-link:hover,
				.woocommerce-review-link,
				.product .price,
				.star-rating,
				.comment-form-rating a,
				.comment-form-rating a:after,
				.border-true.et-client-container .et-client .plus,
				.widget_nav_menu ul li.current-menu-item a,
				.project-category,
				.project-category a,
				.enovathemes-filter .filter.active,
				.project-details .project-category a:hover,
	        	.woocommerce-MyAccount-navigation li.is-active a,
	        	.woocommerce-MyAccount-navigation li a:hover,
	        	.et-blockquote .author,
	        	.et-testimonial .author,
				.et-person .name {
					color: '.$main_color.';
				}';

				$dynamic_css .='.post-single-navigation a:hover,
				.post-meta a:hover,
				.project-meta ul a:not(.social-share):hover,
				.widget_et_recent_entries .post-title:hover a,
				.widget_categories ul li a:hover,
				.wp-block-archives li a:hover,
				.widget_pages ul li a:hover,
				.widget_archive ul li a:hover,
				.widget_meta ul li a:hover,
				.widget_layered_nav ul li a:hover,
				.widget_nav_menu ul li a:hover,
				.widget_product_categories ul li a:hover,
				.widget_recent_entries ul li a:hover, 
				.widget_rss ul li a:hover,
				.widget_icl_lang_sel_widget li a:hover,
				.widget_products .product_list_widget > li .product-title:hover a,
				.widget_recently_viewed_products .product_list_widget > li .product-title:hover a,
				.widget_recent_reviews .product_list_widget > li .product-title:hover a,
				.widget_top_rated_products .product_list_widget > li .product-title:hover a,
				.recentcomments a:hover,
				.page-content-wrap .widget_shopping_cart .cart_list li .remove:hover,
				.et-shortcode-projects-full .overlay-read-more:hover,
				.product_meta a:hover,
				.layout-sidebar .widget_mailchimp input[type="submit"]:hover {
					color: '.$main_color.' !important;
				}';

				$dynamic_css .='.post-read-more:after,
				.comment-reply-link:after,
				.enovathemes-navigation li a:hover,
				.enovathemes-navigation li .current,
				.woocommerce-pagination li a:hover,
				.woocommerce-pagination li .current,
				.post-sticky,
				.post-media .flex-direction-nav li a:hover,
				.post-media .flex-control-nav li a:hover,
				.post-media .flex-control-nav li a.flex-active,
				.slick-dots li button:hover,
				.slick-dots li.slick-active button,
				.owl-carousel .owl-nav > *:hover,
				.overlay-flip-hor .overlay-hover .post-image-overlay, 
				.overlay-flip-ver .overlay-hover .post-image-overlay,
				.image-move-up .post-image-overlay,
				.image-move-down .post-image-overlay,
				.image-move-left .post-image-overlay,
				.image-move-right .post-image-overlay,
				.overlay-image-move-up .post-image-overlay,
				.overlay-image-move-down .post-image-overlay,
				.overlay-image-move-left .post-image-overlay,
				.overlay-image-move-right .post-image-overlay,
				.product .onsale,
				.product-quick-view:hover,
				.added_to_cart,
				.woocommerce-store-notice.demo_store,
				.shop_table .product-remove a:hover,
				.tabset .tab.active:before,
				.et-mailchimp input[type="text"] + .after,
				.owl-carousel .owl-dots > .owl-dot.active,
				.mob-menu-toggle-alt,
				.single-post-page > .format-link .format-container,
				.et-image .curtain,
				.post-meta:before,
				.project-category:after,
				.nivo-lightbox-prev:hover,
				.nivo-lightbox-next:hover,
				.nivo-lightbox-close:hover,
				.project-single-navigation > *:hover,
				.project-layout.project-with-caption .post-body,
				.project-description-title:before,
				.project-meta-title:before,
				.added_to_cart:after,
				.et-person .name:after,
				.et-shortcode-projects-full .post .post-body,
				form #searchsubmit:hover + .search-icon,
				.cursor,
				.content-sidebar-toggle.active,
				.comment-reply-link:hover,
				.post-social-share a,
				.gsap-lightbox-controls:hover,
				.product .single_add_to_cart_button:hover,
				.woocommerce-tabs .tabs li:hover a,
				.woocommerce-tabs .tabs li.active a,
				.et-carousel .tns-nav button.tns-nav-active,
				.et-info-present .tns-nav button.tns-nav-active,
				.widget_categories ul li a:before,
				.widget_mailchimp input[type="submit"] {
					background-color: '.$main_color.';
				}';

				$dynamic_css .='.mejs-controls .mejs-time-rail .mejs-time-current,
				.slick-slider .slick-prev:hover,
				.slick-slider .slick-next:hover,
				#project-gallery .owl-nav > .owl-prev:hover,
				#project-gallery .owl-nav > .owl-next:hover,
				.widget_tag_cloud .tagcloud a:after,
				.widget_product_tag_cloud .tagcloud a:after,
				.project-tags a:after,
				.widget_price_filter .ui-slider-horizontal .ui-slider-range,
				#cboxClose:hover,
				.woocommerce-product-search button[type="submit"]:hover {
					background-color: '.$main_color.' !important;
				}';

				$dynamic_css .='ul.chat li:nth-child(2n+2) > p {
					background-color: '.enovathemes_addons_hex_to_rgba($main_color,0.1).';
				}';

		        $dynamic_css .='.widget_price_filter .ui-slider .ui-slider-handle {
		            border:8px solid '.$main_color.';
		        }';

				$dynamic_css .= '.counter-moving-child:before {
					border-color:'.$main_color.';
				}';

				$dynamic_css .= '.highlight-true .testimonial-content {
					box-shadow:inset 0 0 0 1px '.$main_color.';border-color:'.$main_color.';
				}';

				$dynamic_css .= '.highlight-true .testimonial-content:after {
					border-color: '.$main_color.' transparent transparent transparent;
				}';

				$dynamic_css .= '.post-image-overlay {
					background-color: '.enovathemes_addons_hex_to_rgba($main_color,0.9).';
				}';

				$dynamic_css .= '.overlay-fall .overlay-hover .post-image-overlay,
				.project-with-overlay .overlay-hover .post-image-overlay {
					background-color: '.$main_color.';
				}';

				// Header defaults
				$dynamic_css .='#header-menu-default > .menu-item.depth-0 > .mi-link .txt:after {
				    border-bottom-color: '.$main_color.';
				}';

				$dynamic_css .='a:hover,
				.comment-content .edit-link a a:hover,
				.woocommerce-review-link:hover,
				.product_meta a:hover {
					color: '.$secondory_color.';
				}';

				$dynamic_css .='.widget_tag_cloud .tagcloud a:hover:after,
				.widget_product_tag_cloud .tagcloud a:hover:after,
				.project-tags a:hover:after {
					background-color:'.$secondory_color.' !important;
				}';

		/* Site background
		/*-------------*/

			$et_site_back_col   = (isset($GLOBALS['textron_enovathemes']['site-background']['background-color']) && $GLOBALS['textron_enovathemes']['site-background']['background-color']) ? $GLOBALS['textron_enovathemes']['site-background']['background-color'] : "#ffffff";
			$et_site_back_img   = (isset($GLOBALS['textron_enovathemes']['site-background']['background-image']) && $GLOBALS['textron_enovathemes']['site-background']['background-image']) ? esc_url($GLOBALS['textron_enovathemes']['site-background']['background-image']) : "";
			$et_site_back_r     = (isset($GLOBALS['textron_enovathemes']['site-background']['background-repeat']) && $GLOBALS['textron_enovathemes']['site-background']['background-repeat']) ? $GLOBALS['textron_enovathemes']['site-background']['background-repeat'] : "no-repeat";
			$et_site_back_s     = (isset($GLOBALS['textron_enovathemes']['site-background']['background-size']) && $GLOBALS['textron_enovathemes']['site-background']['background-size']) ? $GLOBALS['textron_enovathemes']['site-background']['background-size'] : "inherit";
			$et_site_back_a     = (isset($GLOBALS['textron_enovathemes']['site-background']['background-attachment']) && $GLOBALS['textron_enovathemes']['site-background']['background-attachment']) ? $GLOBALS['textron_enovathemes']['site-background']['background-attachment'] : "inherit";
			$et_site_back_p     = (isset($GLOBALS['textron_enovathemes']['site-background']['background-position']) && $GLOBALS['textron_enovathemes']['site-background']['background-position']) ? $GLOBALS['textron_enovathemes']['site-background']['background-position'] : "left top";

			$dynamic_css .='html,#gen-wrap {
				background-color:'.$et_site_back_col.';';
				if(!empty($et_site_back_img)){
					$dynamic_css .='background-image:url('.$et_site_back_img.');
					background-repeat:'.$et_site_back_r.';
					background-attachment: '.$et_site_back_a.';
					-webkit-background-size: '.$et_site_back_s.';
					-moz-background-size: '.$et_site_back_s.';
					background-size: '.$et_site_back_s.';
					background-position:'.$et_site_back_p;
				}
			$dynamic_css .='}';

		/* Forms
		---------------*/

			$form_text_color_reg         = (isset($GLOBALS['textron_enovathemes']['form-text-color']['regular']) && !empty($GLOBALS['textron_enovathemes']['form-text-color']['regular'])) ? $GLOBALS['textron_enovathemes']['form-text-color']['regular'] : '#616161';
			$form_text_color_hov         = (isset($GLOBALS['textron_enovathemes']['form-text-color']['hover']) && !empty($GLOBALS['textron_enovathemes']['form-text-color']['hover'])) ? $GLOBALS['textron_enovathemes']['form-text-color']['hover'] : '#616161';
			$form_back_color_reg         = (isset($GLOBALS['textron_enovathemes']['form-back-color']['regular']) && $GLOBALS['textron_enovathemes']['form-back-color']['regular']) ? $GLOBALS['textron_enovathemes']['form-back-color']['regular'] : "#ffffff";
			$form_back_color_hov         = (isset($GLOBALS['textron_enovathemes']['form-back-color']['hover']) && $GLOBALS['textron_enovathemes']['form-back-color']['hover']) ? $GLOBALS['textron_enovathemes']['form-back-color']['hover'] : "#ffffff";
			$form_border_color_reg       = (isset($GLOBALS['textron_enovathemes']['form-border-color']['regular']) && !empty($GLOBALS['textron_enovathemes']['form-border-color']['regular'])) ? $GLOBALS['textron_enovathemes']['form-border-color']['regular'] : "#e0e0e0";
			$form_border_color_hov       = (isset($GLOBALS['textron_enovathemes']['form-border-color']['hover']) && !empty($GLOBALS['textron_enovathemes']['form-border-color']['hover'])) ? $GLOBALS['textron_enovathemes']['form-border-color']['hover'] : "#bdbdbd";

			$form_button_typo_font_family  	   = (isset($GLOBALS['textron_enovathemes']['form-button-typo']['font-family']) && !empty($GLOBALS['textron_enovathemes']['form-button-typo']['font-family'])) ? $GLOBALS['textron_enovathemes']['form-button-typo']['font-family'] : "Heebo";
			$form_button_typo_font_weight  	   = (isset($GLOBALS['textron_enovathemes']['form-button-typo']['font-weight']) && !empty($GLOBALS['textron_enovathemes']['form-button-typo']['font-weight'])) ? $GLOBALS['textron_enovathemes']['form-button-typo']['font-weight'] : "500";
			$form_button_typo_letter_spacing   = (isset($GLOBALS['textron_enovathemes']['form-button-typo']['letter-spacing']) && !empty($GLOBALS['textron_enovathemes']['form-button-typo']['letter-spacing'])) ? $GLOBALS['textron_enovathemes']['form-button-typo']['letter-spacing'] : "0.5px";
			$form_button_color_reg             = (isset($GLOBALS['textron_enovathemes']['form-button-color']['regular']) && $GLOBALS['textron_enovathemes']['form-button-color']['regular']) ? $GLOBALS['textron_enovathemes']['form-button-color']['regular'] : "#ffffff";
			$form_button_color_hov             = (isset($GLOBALS['textron_enovathemes']['form-button-color']['hover']) && $GLOBALS['textron_enovathemes']['form-button-color']['hover']) ? $GLOBALS['textron_enovathemes']['form-button-color']['hover'] : "#ffffff";
			$form_button_back_reg              = (isset($GLOBALS['textron_enovathemes']['form-button-back']['regular']) && $GLOBALS['textron_enovathemes']['form-button-back']['regular']) ? $GLOBALS['textron_enovathemes']['form-button-back']['regular'] : "#00245a";
			$form_button_back_hov              = (isset($GLOBALS['textron_enovathemes']['form-button-back']['hover']) && $GLOBALS['textron_enovathemes']['form-button-back']['hover']) ? $GLOBALS['textron_enovathemes']['form-button-back']['hover'] : "#00bfff";

			$dynamic_css .='textarea, select,
			 input[type="date"], input[type="datetime"],
			 input[type="datetime-local"], input[type="email"],
			 input[type="month"], input[type="number"],
			 input[type="password"], input[type="search"],
			 input[type="tel"], input[type="text"],
			 input[type="time"], input[type="url"],
			 input[type="week"], input[type="file"],
			 .select2-container .select2-selection--multiple {
				color:'.$form_text_color_reg.';
				background-color:'.$form_back_color_reg.';
				border-color:'.$form_border_color_reg.';
			}';

			$dynamic_css .='.tech-page-search-form .search-icon,
			.widget_search form input[type="submit"]#searchsubmit + .search-icon {
				color:'.$form_text_color_reg.' !important;
			}';

			$dynamic_css .='.select2-container--default .select2-selection--single {
				color:'.$form_text_color_reg.' !important;
				background-color:'.$form_back_color_reg.' !important;
				border-color:'.$form_border_color_reg.' !important;
			}';

			$dynamic_css .='.select2-container--default .select2-selection--single .select2-selection__rendered{
				color:'.$form_text_color_reg.' !important;
			}';

			$dynamic_css .='.select2-dropdown,
			.select2-container--default .select2-search--dropdown .select2-search__field,
			.select2-container .select2-selection--multiple:after {
				background-color:'.$form_back_color_reg.' !important;
			}';

			$dynamic_css .='textarea:focus, select:focus,
			 input[type="date"]:focus, input[type="datetime"]:focus,
			 input[type="datetime-local"]:focus, input[type="email"]:focus,
			 input[type="month"]:focus, input[type="number"]:focus,
			 input[type="password"]:focus, input[type="search"]:focus,
			 input[type="tel"]:focus, input[type="text"]:focus,
			 input[type="time"]:focus, input[type="url"]:focus,
			 input[type="week"]:focus, input[type="file"]:focus {
				color:'.$form_text_color_hov.';
				border-color:'.$form_border_color_hov.';
				background-color:'.$form_back_color_hov.';';
			$dynamic_css .='}';

			$dynamic_css .='.tech-page-search-form [type="submit"]#searchsubmit:hover + .search-icon,
			.widget_search form input[type="submit"]#searchsubmit:hover + .search-icon {
				color:'.$form_text_color_hov.' !important;
			}';

			$dynamic_css .='.select2-container--default .select2-selection--single:focus {
				color:'.$form_text_color_hov.' !important;
				border-color:'.$form_border_color_hov.' !important;
				background-color:'.$form_back_color_hov.' !important;';
			$dynamic_css .='}';

			$dynamic_css .='.select2-container--default .select2-selection--single .select2-selection__rendered:focus{
				color:'.$form_text_color_hov.' !important;
			}';

			$dynamic_css .='.select2-dropdown:focus,
			.select2-container--default .select2-search--dropdown .select2-search__field:focus {
				background-color:'.$form_back_color_hov.' !important;
			}';

			$dynamic_css .='input[type="button"],
			 input[type="reset"],
			 input[type="submit"],
			 button,
			 a.checkout-button,
			 .return-to-shop a,
			 a.woocommerce-button,
			 #page-links > a,
			 .edit-link a,
			 .project-link,
			 .page-content-wrap .woocommerce-mini-cart__buttons > a,
			 .woocommerce .wishlist_table td.product-add-to-cart a,
			 .woocommerce-message .button,
			 a.error404-button,
			.logout-button {
				color:'.$form_button_color_reg.';
				font-family:'.$form_button_typo_font_family.'; 
				font-weight:'.$form_button_typo_font_weight.'; 
				letter-spacing:'.$form_button_typo_letter_spacing.'; 
				background-color:'.$form_button_back_reg.';';
			$dynamic_css .='}';

			$dynamic_css .='.et-button,
			.post-read-more,
			.comment-reply-link,
			.enovathemes-filter .filter,
			.woocommerce-mini-cart__buttons > a,
			.product .button,
			.added_to_cart,
			.widget_tag_cloud .tagcloud a,
			.post-tags a,
			.widget_product_tag_cloud .tagcloud a,
			.project-tags a,
			.post-tags-single a {
				font-family:'.$form_button_typo_font_family.'; 
				font-weight:'.$form_button_typo_font_weight.'; 
				letter-spacing:'.$form_button_typo_letter_spacing.';
			}';

			$dynamic_css .='input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			button:hover,
			a.checkout-button:hover,
			.return-to-shop a:hover,
			.wishlist_table .product-add-to-cart a:hover,
			a.woocommerce-button:hover,
			.woocommerce-mini-cart__buttons > a:hover,
			#page-links > a:hover,
			.edit-link a:hover,
			.project-link:hover,
			.page-content-wrap .woocommerce-mini-cart__buttons > a:hover,
			.woocommerce .wishlist_table td.product-add-to-cart a:hover,
			.error404-button:hover,
			.logout-button:hover {
				color:'.$form_button_color_hov.' !important;
				background-color:'.$form_button_back_hov.';';
			$dynamic_css .='}';

			$dynamic_css .='.widget_price_filter .ui-slider .ui-slider-handle {
				background-color:'.$form_button_back_reg.';
			}';
		
		/* Responsive
		---------------*/
			
			$dynamic_css .='@media only screen and (max-width: 374px)  {';
				$dynamic_css .= enovathemes_addons_responsive_styles('374');
				if(isset($GLOBALS['textron_enovathemes']['custom-css-max-374']) && !empty($GLOBALS['textron_enovathemes']['custom-css-max-374'])){
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-max-374'];
				}
			$dynamic_css .='}';
			
			if(isset($GLOBALS['textron_enovathemes']['custom-css-min-375']) && !empty($GLOBALS['textron_enovathemes']['custom-css-min-375'])){
				$dynamic_css .='@media only screen and (min-width: 375px)  {';
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-min-375'];
				$dynamic_css .='}';
			}

			$dynamic_css .='@media only screen and (min-width: 375px) and (max-width: 767px)  {';
				$dynamic_css .= enovathemes_addons_responsive_styles('375-767');
			$dynamic_css .='}';

			$dynamic_css .='@media only screen and (max-width: 767px)  {';
				$dynamic_css .='h1 {font-size: '.$et_h3_font_size.'; line-height: '.$et_h3_line_height.';}';
				$dynamic_css .='h2 {font-size: '.$et_h4_font_size.'; line-height: '.$et_h4_line_height.';}';
				$dynamic_css .='h3 {font-size: '.$et_h5_font_size.'; line-height: '.$et_h5_line_height.';}';
				if(isset($GLOBALS['textron_enovathemes']['custom-css-max-767']) && !empty($GLOBALS['textron_enovathemes']['custom-css-max-767'])){
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-max-767'];
				}
			$dynamic_css .='}';
			
			$dynamic_css .='@media only screen and (min-width: 768px) {';

				$dynamic_css .= enovathemes_addons_responsive_styles('768',false,true);

				if(isset($GLOBALS['textron_enovathemes']['custom-css-min-768']) && !empty($GLOBALS['textron_enovathemes']['custom-css-min-768'])){
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-min-768'];
				}
			$dynamic_css .='}';
			
			$dynamic_css .='@media only screen and (min-width: 768px) and (max-width: 1023px)  {';
				$dynamic_css .= enovathemes_addons_responsive_styles('768-1023');
				if(isset($GLOBALS['textron_enovathemes']['custom-css-min-768-max-1023']) && !empty($GLOBALS['textron_enovathemes']['custom-css-min-768-max-1023'])){
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-min-768-max-1023'];
				}
			$dynamic_css .='}';
			
			if(isset($GLOBALS['textron_enovathemes']['custom-css-max-1023']) && !empty($GLOBALS['textron_enovathemes']['custom-css-max-1023'])){
				$dynamic_css .='@media only screen and (max-width: 1023px)  {';
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-max-1023'];
				$dynamic_css .='}';
			}
			
			if(isset($GLOBALS['textron_enovathemes']['custom-css-min-1024']) && !empty($GLOBALS['textron_enovathemes']['custom-css-min-1024'])){
				$dynamic_css .='@media only screen and (min-width: 1024px) {';
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-min-1024'];
				$dynamic_css .='}';
			}

			$dynamic_css .='@media only screen and (min-width: 1024px) and (max-width: 1279px)  {';
				$dynamic_css .= enovathemes_addons_responsive_styles('1024-1279');
				if(isset($GLOBALS['textron_enovathemes']['custom-css-min-1024-max-1279']) && !empty($GLOBALS['textron_enovathemes']['custom-css-min-1024-max-1279'])){
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-min-1024-max-1279'];
				}
			$dynamic_css .='}';

			if(isset($GLOBALS['textron_enovathemes']['custom-css-max-1279']) && !empty($GLOBALS['textron_enovathemes']['custom-css-max-1279'])){
				$dynamic_css .='@media only screen and (max-width: 1279px)  {';
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-max-1279'];
				$dynamic_css .='}';
			}

			$dynamic_css .='@media only screen and (min-width: 1280px)  {';
				$dynamic_css .= enovathemes_addons_responsive_styles('1280',false,true);
				if(isset($GLOBALS['textron_enovathemes']['custom-css-min-1280']) && !empty($GLOBALS['textron_enovathemes']['custom-css-min-1280'])){
					$dynamic_css .= $GLOBALS['textron_enovathemes']['custom-css-min-1280'];
				}
			$dynamic_css .='}';
			
			$dynamic_css .='@media only screen and (min-width: 1280px) and (max-width: 1599px)  {';
				$dynamic_css .= enovathemes_addons_responsive_styles('1280-1599',false);
			$dynamic_css .='}';

			$dynamic_css .='@media only screen and (min-width: 1600px) and (max-width: 1919px)  {';
				$dynamic_css .= enovathemes_addons_responsive_styles('1600-1919',false);
			$dynamic_css .='}';

		$dynamic_css = enovathemes_addons_minify_css($dynamic_css);

        // do not set an empty transient - should help catch private or empty accounts.
        if ( ! empty( $dynamic_css ) ) {
            $dynamic_css = base64_encode( serialize( $dynamic_css ) );
            set_transient( 'dynamic-styles-cached', $dynamic_css, apply_filters( 'null_dynamic_css_cache_time', 0 ) );
        }
    }

    if ( ! empty( $dynamic_css ) ) {
        $dynamic_css = unserialize( base64_decode( $dynamic_css ) );

        $file = get_template_directory() . '/css/dynamic-styles-cached.css';

        if (is_file($file)) {
        	file_put_contents($file, $dynamic_css);
        	wp_enqueue_style('dynamic-styles-cached', get_template_directory_uri() . '/css/dynamic-styles-cached.css');
        }

    }

}
add_action( 'wp_enqueue_scripts', 'enovathemes_addons_include_dynamic_styles_cached',20);
?>