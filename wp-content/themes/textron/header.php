<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<!-- META TAGS -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=8">
	<!-- LINK TAGS -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
	
	$detect_class = '';

	if (class_exists('Mobile_Detect')) {
    	$detect  = new Mobile_Detect;

    	if ($detect->isMobile() || $detect->isTablet()) {
			$detect_class = 'detected';
			$detect_class = 'class="detected"';
		}
	}

?>
<!-- general wrap start -->
<div id="gen-wrap" class="wrapper">
	<!-- wrap start -->
	<div id="wrap" <?php echo esc_attr($detect_class); ?>>
		<?php do_action('textron_enovathemes_header'); ?>
		<div class="page-content-wrap">