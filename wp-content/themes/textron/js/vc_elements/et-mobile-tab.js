(function($){

    "use strict";

    function uniqueID() {return Math.floor((Math.random() * 1000000) + 1);}

    String.prototype.replaceAll = function(str1, str2, ignore) {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\dir-child*\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
    }

    function iframeCSS(CSS){
        var iframe = $('#vc_inline-frame');
        if (typeof(iframe) != 'undefined' && iframe != null){
            iframe.ready(function() {
                CSS = CSS.replaceAll("dir-child*","dir-child*");
                iframe.contents().find("#dynamic-styles-inline-css").append(CSS);
            });
        }
    }

    $( document ).ajaxComplete(function( event, xhr, settings ) {

        if (settings['type'] != 'POST') {return;}

        /* Prepare settings
        /*-------------*/

            var data = decodeURIComponent(settings['data']);

            data = data.split("&");

            var dataObj = [{}];

            for (var i = 0; i < data.length; i++) {
                var property = data[i].split("=");
                var key      = (property[0]);
                var value    = (property[1]);
                dataObj[key] = value;
            }

            var elementExists = Object.keys(dataObj).some(function(key) {
                return dataObj[key] === "et_mobile_tab";
            });

        /* Edit element
        /*-------------*/

            if(dataObj['action'] == "vc_edit_form" && dataObj['tag'] == "et_mobile_tab"){

                var edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_mobile_tab"]'),
                    element_css  = edit_element.find('textarea[name="element_css"]'),
                    element_id   = edit_element.find('input[name="element_id"]');

                $('#vc_ui-panel-edit-element[data-vc-shortcode="et_mobile_tab"] .vc_ui-button-action[data-vc-ui-element="button-save"]').on('click',function(){

                    if ($('#vc_ui-panel-edit-element[data-vc-shortcode="et_mobile_tab"]').length) {

                        var ID  = uniqueID();
                        var CSS = '';

                        edit_element = $('#vc_ui-panel-edit-element[data-vc-shortcode="et_mobile_tab"]');

                        var color                   = edit_element.find('input[name="color"]').val(),
                            color_active            = edit_element.find('input[name="color_active"]').val(),
                            background_color        = edit_element.find('input[name="background_color"]').val(),
                            background_color_active = edit_element.find('input[name="background_color_active"]').val();

                        CSS += '#et-mobile-tab-'+ID+' .mob-tabset {';
                            if (background_color.length) {
                                CSS += 'background:'+background_color+';';
                            }
                            if (color.length) {
                                CSS += 'color:'+color+';';
                            }
                        CSS += '}';

                        if (color.length) {
                            CSS += '#et-mobile-tab-'+ID+' .tab svg {';
                                CSS += 'fill:'+color+';';
                            CSS += '}';
                        }

                        CSS += '#et-mobile-tab-'+ID+' .tab.active {';
                            if (background_color_active.length) {
                                CSS += 'background:'+background_color_active+';';
                            } else {
                                CSS += 'background:transparent;';
                            }
                            if (color_active.length) {
                                CSS += 'color:'+color_active+';';
                            }
                        CSS += '}';

                        if (background_color_active.length) {
                            CSS += '#et-mobile-tab-'+ID+' .mob-tab-content {';
                                CSS += 'background:'+background_color_active+';';
                            CSS += '}';
                            CSS += '#et-mobile-tab-'+ID+' .tab:after {';
                                CSS += 'background:'+background_color_active+';';
                            CSS += '}';
                        }

                        if (color_active.length) {
                            CSS += '#et-mobile-tab-'+ID+' .tab.active svg, #et-mobile-tab-'+ID+' .tab.active svg * {';
                                CSS += 'fill:'+color_active+';';
                            CSS += '}';
                        }

                        CSS+='#et-mobile-tab-'+ID+' .widget, #et-mobile-tab-'+ID+' .widget_price_filter .price_label, #et-mobile-tab-'+ID+' .widget_calendar td#today, #et-mobile-tab-'+ID+' .widget_tag_cloud .tagcloud a, #et-mobile-tab-'+ID+' .widget_product_tag_cloud .tagcloud a, #et-mobile-tab-'+ID+' .widget_mailchimp, #et-mobile-tab-'+ID+' a { color:'+color_active+'; }';
                        CSS+='#et-mobile-tab-'+ID+' .widget_et_recent_entries .post-title a, #et-mobile-tab-'+ID+' .widget_products .product_list_widget dir-child* li .product-title a, #et-mobile-tab-'+ID+' .widget_recently_viewed_products .product_list_widget dir-child* li .product-title a, #et-mobile-tab-'+ID+' .widget_recent_reviews .product_list_widget dir-child* li .product-title a, #et-mobile-tab-'+ID+' .widget_top_rated_products .product_list_widget dir-child* li .product-title a { color:'+color_active+' !important; }';
                        CSS+='#et-mobile-tab-'+ID+' .widget .image-container .placeholder circle { fill:'+color_active+'; }';
                        CSS+='#et-mobile-tab-'+ID+' .widget_et_recent_entries .post-title:hover a, #et-mobile-tab-'+ID+' .widget_products .product_list_widget dir-child* li .product-title:hover a, #et-mobile-tab-'+ID+' .widget_recently_viewed_products .product_list_widget dir-child* li .product-title:hover a, #et-mobile-tab-'+ID+' .widget_recent_reviews .product_list_widget dir-child* li .product-title:hover a, #et-mobile-tab-'+ID+' .widget_top_rated_products .product_list_widget dir-child* li .product-title:hover a { color:'+color_active+' !important; }';
                        CSS+='#et-mobile-tab-'+ID+' .post-meta { color:'+color_active+'; }';
                        CSS+='#et-mobile-tab-'+ID+' .widget_title, #et-mobile-tab-'+ID+' .widget_layered_nav ul li a, #et-mobile-tab-'+ID+' .widget_nav_menu ul li a, #et-mobile-tab-'+ID+' .widget_product_categories ul li a, #et-mobile-tab-'+ID+' .widget_categories ul li a, #et-mobile-tab-'+ID+' .post-single-navigation a, #et-mobile-tab-'+ID+' .widget_pages ul li a, #et-mobile-tab-'+ID+' .widget_archive ul li a, #et-mobile-tab-'+ID+' .widget_meta ul li a, #et-mobile-tab-'+ID+' .widget_recent_entries ul li a, #et-mobile-tab-'+ID+' .widget_rss ul li a, #et-mobile-tab-'+ID+' .widget_icl_lang_sel_widget li a, #et-mobile-tab-'+ID+' .recentcomments a, #et-mobile-tab-'+ID+' .widget_product_search form button:before, #et-mobile-tab-'+ID+' .widget_shopping_cart .cart_list li .remove, #et-mobile-tab-'+ID+' .widget_shopping_cart .cart-product-title a{ color:'+color_active+'; }';
                        CSS+='#et-mobile-tab-'+ID+' .widget .star-rating, #et-mobile-tab-'+ID+' .widget_categories ul li a:before, #et-mobile-tab-'+ID+' .widget_pages ul li a:before, #et-mobile-tab-'+ID+' .widget_archive ul li a:before, #et-mobile-tab-'+ID+' .widget_meta ul li a:before, #et-mobile-tab-'+ID+' .widget_layered_nav ul li a:before, #et-mobile-tab-'+ID+' .widget_nav_menu ul li a:before, #et-mobile-tab-'+ID+' .widget_product_categories ul li a:before, #et-mobile-tab-'+ID+' .widget_price_filter .ui-slider-horizontal { background-color:'+color_active+'; }';
                        CSS+='#et-mobile-tab-'+ID+' .widget_tag_cloud .tagcloud a, #et-mobile-tab-'+ID+' .widget_product_tag_cloud .tagcloud a, #et-mobile-tab-'+ID+' .widget .image-container, #et-mobile-tab-'+ID+' .widget_calendar td#today { background-color:'+color_active+'; }';
                        CSS+='#et-mobile-tab-'+ID+' .widget_tag_cloud .tagcloud a:hover, #et-mobile-tab-'+ID+' .widget_product_tag_cloud .tagcloud a:hover { background-color:'+color_active+'; }';
                        CSS+='#et-mobile-tab-'+ID+' .woocommerce-mini-cart__total, #et-mobile-tab-'+ID+' .widget_mailchimp, #et-mobile-tab-'+ID+' .widget_calendar caption, #et-mobile-tab-'+ID+' .widget_calendar td, #et-mobile-tab-'+ID+' .widget_calendar th, #et-mobile-tab-'+ID+' .widget_calendar table:after, #et-mobile-tab-'+ID+' .widget_calendar table:before { border-color:'+color_active+'; }';

                        CSS+='#et-mobile-tab-'+ID+' .button,#et-mobile-tab-'+ID+' input|typebutton|, #et-mobile-tab-'+ID+' input|typesubmit|, #et-mobile-tab-'+ID+' .woocommerce-mini-cart__buttons dir-child* a, #et-mobile-tab-'+ID+' button { color:'+background_color_active+'; background-color:'+color_active+';}';
                        CSS+='#et-mobile-tab-'+ID+' .woocommerce-product-search button|typesubmit|, #et-mobile-tab-'+ID+' form #searchsubmit + .search-icon { background-color:'+color_active+' !important; }';
                        CSS+='#et-mobile-tab-'+ID+' .widget_product_search button|typesubmit|:before { background-color:'+background_color_active+'; }';
                        CSS+='#et-mobile-tab-'+ID+' #searchsubmit + .search-icon svg {fill:'+background_color_active+';}';
                        CSS+='#et-mobile-tab-'+ID+'.button:hover,#et-mobile-tab-'+ID+' input|typebutton|:hover, #et-mobile-tab-'+ID+' input|typesubmit|:hover, #et-mobile-tab-'+ID+' button:hover, #et-mobile-tab-'+ID+' .woocommerce-mini-cart__buttons dir-child* a:hover, #et-mobile-tab-'+ID+' button:hover { color:'+background_color_active+' !important; background-color:'+color_active+';}';

                        element_id.val(ID);

                        if (CSS) {
                            element_css.text(CSS);
                            iframeCSS(CSS);
                            CSS = '';
                        }

                    }
                    
                });

                return;
            }

    });

})(jQuery);