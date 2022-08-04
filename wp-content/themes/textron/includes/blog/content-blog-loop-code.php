<?php

	textron_enovathemes_global_variables();

	$blog_post_excerpt = (isset($GLOBALS['textron_enovathemes']['blog-post-excerpt']) && $GLOBALS['textron_enovathemes']['blog-post-excerpt']) ? $GLOBALS['textron_enovathemes']['blog-post-excerpt'] : 0;
	$blog_post_layout  = (isset($GLOBALS['textron_enovathemes']['blog-post-layout']) && $GLOBALS['textron_enovathemes']['blog-post-layout']) ? $GLOBALS['textron_enovathemes']['blog-post-layout'] : "masonry";
    $blog_sidebar      = (isset($GLOBALS['textron_enovathemes']['blog-sidebar']) && $GLOBALS['textron_enovathemes']['blog-sidebar']) ? $GLOBALS['textron_enovathemes']['blog-sidebar'] : "none";
    $blog_navigation   = (isset($GLOBALS['textron_enovathemes']['blog-navigation']) && $GLOBALS['textron_enovathemes']['blog-navigation']) ? $GLOBALS['textron_enovathemes']['blog-navigation'] : "pagination";
	$blog_image_full   = (isset($GLOBALS['textron_enovathemes']['blog-image-full']) && $GLOBALS['textron_enovathemes']['blog-image-full'] == 1) ? "true" : "false";

	$class = array();

	$class[] = 'loop-posts';

	if (is_active_sidebar('blog-widgets') && $blog_sidebar == "none" && !defined('ENOVATHEMES_ADDONS')) {
		$blog_sidebar = 'right';
	}

?>

<?php if ($blog_sidebar != "none"): ?>
	<a href="#" title="<?php echo esc_attr__("Toggle sidebar","textron"); ?>" class="content-sidebar-toggle"><?php echo textron_enovathemes_svg_icon('grid.svg'); ?></a>
<?php endif ?>

<?php if (have_posts()) : ?>

	<main id="loop-posts" class="<?php echo esc_attr(implode(' ', $class)); ?>" data-nav="<?php echo esc_attr($blog_navigation); ?>">

		<?php

			$thumb_size = 'textron_600X400';

			switch ($blog_post_layout) {
				case 'full':
					$thumb_size = 'textron_1200X800';
					break;
				case 'list':
					$thumb_size = 'textron_425X425';
					break;
				default:
					$thumb_size = 'textron_600X400';
					break;
			}
			
			if ($blog_image_full == "true") {
				$thumb_size = 'full';
			}

		?>

		<?php while (have_posts()) : the_post(); ?>
			<?php echo textron_enovathemes_post($blog_post_layout,$blog_post_excerpt,$thumb_size,$blog_image_full,false); ?>
		<?php endwhile; ?>

	</main>

	<?php textron_enovathemes_navigation('post',$blog_navigation); ?>

<?php else : ?>
	<?php textron_enovathemes_not_found('post'); ?>
<?php endif; ?>