<?php
	function enovathemes_addons_project() {

		global $textron_enovathemes;
		$slug = (isset($GLOBALS['textron_enovathemes']['project-slug']) && !empty($GLOBALS['textron_enovathemes']['project-slug'])) ? esc_attr($GLOBALS['textron_enovathemes']['project-slug']) : 'project';

		$labels = array(
			'name'               => esc_html__('Projects', 'enovathemes-addons'),
			'singular_name'      => esc_html__('Project', 'enovathemes-addons'),
			'add_new'            => esc_html__('Add new', 'enovathemes-addons'),
			'add_new_item'       => esc_html__('Add new project', 'enovathemes-addons'),
			'edit_item'          => esc_html__('Edit project', 'enovathemes-addons'),
			'new_item'           => esc_html__('New project', 'enovathemes-addons'),
			'all_items'          => esc_html__('All projects', 'enovathemes-addons'),
			'view_item'          => esc_html__('View project', 'enovathemes-addons'),
			'search_items'       => esc_html__('Search projects', 'enovathemes-addons'),
			'not_found'          => esc_html__('No projects found', 'enovathemes-addons'),
			'not_found_in_trash' => esc_html__('No projects found in trash', 'enovathemes-addons'), 
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__('Projects', 'enovathemes-addons')
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true, 
			'show_in_menu'       => true, 
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $slug,'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true, 
			'hierarchical'       => false,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-portfolio',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt'),
			'show_in_rest'       	=> true,
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rest_base'             => 'project',
		);

		register_post_type( 'project', $args );
	}

	add_action( 'init', 'enovathemes_addons_project' );

	function enovathemes_addons_project_taxonomies() {

		global $textron_enovathemes;
		$category_slug = (isset($GLOBALS['textron_enovathemes']['project-cat-slug']) && !empty($GLOBALS['textron_enovathemes']['project-cat-slug'])) ? esc_attr($GLOBALS['textron_enovathemes']['project-cat-slug']) : 'project-category';
		$tag_slug      = (isset($GLOBALS['textron_enovathemes']['project-tag-slug']) && !empty($GLOBALS['textron_enovathemes']['project-tag-slug'])) ? esc_attr($GLOBALS['textron_enovathemes']['project-tag-slug']) : 'project-tag';

		register_taxonomy('project-category', 'project', array(
			'hierarchical' => true,
			'labels' => array(
				'name' 				=> esc_html__( 'Category', 'enovathemes-addons' ),
				'singular_name' 	=> esc_html__( 'Category', 'enovathemes-addons' ),
				'search_items' 		=> esc_html__( 'Search category', 'enovathemes-addons' ),
				'all_items' 		=> esc_html__( 'All categories', 'enovathemes-addons' ),
				'parent_item' 		=> esc_html__( 'Parent category', 'enovathemes-addons' ),
				'parent_item_colon' => esc_html__( 'Parent category', 'enovathemes-addons' ),
				'edit_item' 		=> esc_html__( 'Edit category', 'enovathemes-addons' ),
				'update_item' 		=> esc_html__( 'Update category', 'enovathemes-addons' ),
				'add_new_item' 		=> esc_html__( 'Add new category', 'enovathemes-addons' ),
				'new_item_name' 	=> esc_html__( 'New category', 'enovathemes-addons' ),
				'menu_name' 		=> esc_html__( 'Categories', 'enovathemes-addons' ),
			),
			'rewrite' => array(
				'slug' 		   => $category_slug,
				'with_front'   => true,
				'hierarchical' => true
			),
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true,
			'show_in_rest'       	=> true,
			'rest_controller_class' => 'WP_REST_Terms_Controller',
			'rest_base'             => 'project-category',
		));

		register_taxonomy('project-tag', 'project', array(
			'hierarchical' => false,
			'labels' => array(
				'name' 				=> esc_html__( 'Projects tags', 'enovathemes-addons' ),
				'singular_name' 	=> esc_html__( 'Projects tag', 'enovathemes-addons' ),
				'search_items' 		=> esc_html__( 'Search project tags', 'enovathemes-addons' ),
				'all_items' 		=> esc_html__( 'All project tags', 'enovathemes-addons' ),
				'parent_item' 		=> esc_html__( 'Parent project tags', 'enovathemes-addons' ),
				'parent_item_colon' => esc_html__( 'Parent project tag:', 'enovathemes-addons' ),
				'edit_item' 		=> esc_html__( 'Edit project tag', 'enovathemes-addons' ),
				'update_item' 		=> esc_html__( 'Update project tag', 'enovathemes-addons' ),
				'add_new_item'	    => esc_html__( 'Add new project tag', 'enovathemes-addons' ),
				'new_item_name' 	=> esc_html__( 'New project tag', 'enovathemes-addons' ),
				'menu_name' 		=> esc_html__( 'Tags', 'enovathemes-addons' ),
			),
			'rewrite' 		   => array(
				'slug' 		   => $tag_slug,
				'with_front'   => true,
				'hierarchical' => false
			),
			'show_in_rest'       	=> true,
			'rest_controller_class' => 'WP_REST_Terms_Controller',
			'rest_base'             => 'project-tag',
		));

	}
	add_action( 'init', 'enovathemes_addons_project_taxonomies', 0 );

	add_filter("manage_edit-project_columns", "enovathemes_addons_project_edit_columns");

	function enovathemes_addons_project_edit_columns($columns){
		$columns['cb']             = "<input type=\"checkbox\" />";
		$columns['image']          = esc_html__("Thumbnail", 'enovathemes-addons');
		$columns['title']          = esc_html__("Title", 'enovathemes-addons');
		$columns['project-tags']   = esc_html__("Tags", 'enovathemes-addons');
		$columns['layout']         = esc_html__("Layout", 'enovathemes-addons');
		$columns['format']         = esc_html__("Format", 'enovathemes-addons');

		unset($columns['comments']);
		return $columns;
	}

	add_action("manage_project_posts_custom_column", "enovathemes_addons_project_custom_columns");

	function enovathemes_addons_project_custom_columns($column){
		
		global $post;

		$project_layout    = get_post_meta($post->ID, 'enovathemes_addons_project_layout', true );
		$project_format    = get_post_meta($post->ID, 'enovathemes_addons_project_format', true );
		$gallery_type      = get_post_meta($post->ID, 'enovathemes_addons_gallery_type', true );
		$gallery_columns   = get_post_meta($post->ID, 'enovathemes_addons_gallery_columns', true );

		if (empty($project_layout)) {$project_layout = "sidebar";}
		if (empty($project_format)) {$project_format = "gallery";}
		if (empty($gallery_type)) {$gallery_type = "grid";}
		if (empty($gallery_columns)) {$gallery_columns = 1;}

	    if ($gallery_columns == 1) {
	    	$gallery_columns = $gallery_columns.esc_html__(' column','enovathemes-addons');
	    } else {
			$gallery_columns = $gallery_columns.esc_html__(' columns','enovathemes-addons');
	    }

	    if ($gallery_type == 'carousel_thumb') {
	    	$gallery_type = 'slider';
	    }

		switch ($column){

			case "project-tags":

				$terms = get_the_terms( $post->ID, 'project-tag' );

				if ( !empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $term ) {
						$out[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'project-tag' => $term->slug ), 'edit.php' ) ),
							esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'project-tag', 'display' ) )
						);
					}

					echo join( ', ', $out );

				} else {
					echo esc_html__("No tags", 'enovathemes-addons');
				}
				
			break;

			case "image":

				if (has_post_thumbnail()){
					echo '<a href="'.get_edit_post_link($post->ID).'">'.get_the_post_thumbnail($post->ID,'thumbnail').'</a>';
				}
				
			break;

			case "layout":
				echo '<div class="custom-meta-ind indicator-5">'.$project_layout.'</div><div class="custom-meta-ind indicator-3">'.$gallery_type.'</div><div class="custom-meta-ind indicator-2">'.$gallery_columns.'</div>';
			break;

			case "format":

				if ($project_layout == "custom") {
						echo "--";
				} else {

					switch ($project_format) {
						case 'gallery':
							echo '<span class="post-state-format post-format-icon post-format-gallery"></span>';
							break;
						case 'audio':
							echo '<span class="post-state-format post-format-icon post-format-audio"></span>';
							break;
						case 'video':
							echo '<span class="post-state-format post-format-icon post-format-video"></span>';
							break;
					}

				}
				
			break;
			
		}
	}
?>