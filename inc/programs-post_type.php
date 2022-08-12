<?PHP

// Register Custom Post Type

function programs() {



	$labels = array(

		'name'                  => _x( 'Programs', 'Post Type General Name', 'text_domain' ),

		'singular_name'         => _x( 'Program', 'Post Type Singular Name', 'text_domain' ),

		'menu_name'             => __( 'Programs', 'text_domain' ),

		'name_admin_bar'        => __( 'Programs', 'text_domain' ),

		'archives'              => __( 'Program Archives', 'text_domain' ),

		'attributes'            => __( 'Program Attributes', 'text_domain' ),

		'parent_Program_colon'     => __( 'Parent Program:', 'text_domain' ),

		'all_Programs'             => __( 'All Programs', 'text_domain' ),

		'add_new_Program'          => __( 'Add New Program', 'text_domain' ),

		'add_new'               => __( 'Add New', 'text_domain' ),

		'new_Program'              => __( 'New Program', 'text_domain' ),

		'edit_Program'             => __( 'Edit Program', 'text_domain' ),

		'update_Program'           => __( 'Update Program', 'text_domain' ),

		'view_Program'             => __( 'View Program', 'text_domain' ),

		'view_Programs'            => __( 'View Programs', 'text_domain' ),

		'search_Programs'          => __( 'Search Program', 'text_domain' ),

		'not_found'             => __( 'Not found', 'text_domain' ),

		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),

		'featured_image'        => __( 'Featured Image', 'text_domain' ),

		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),

		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),

		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),

		'insert_into_Program'      => __( 'Insert into Program', 'text_domain' ),

		'uploaded_to_this_Program' => __( 'Uploaded to this Program', 'text_domain' ),

		'Programs_list'            => __( 'Programs list', 'text_domain' ),

		'Programs_list_navigation' => __( 'Programs list navigation', 'text_domain' ),

		'filter_Programs_list'     => __( 'Filter Programs list', 'text_domain' ),

	);

	$args = array(

		'label'                 => __( 'Program', 'text_domain' ),

		'description'           => __( 'Programs Description', 'text_domain' ),

		'labels'                => $labels,

		'supports'              => array( 'title', 'editor', 'thumbnail' ),

		'taxonomies'            => array( 'levels', 'groups', 'programs_type' ),

		'hierarchical'          => false,

		'public'                => true,

		'show_ui'               => true,

		'show_in_menu'          => 'false',

		'menu_position'         => 5,

		'menu_icon'             => 'dashicons-buddicons-groups',

		'show_in_admin_bar'     => true,

		'show_in_nav_menus'     => true,

		'can_export'            => true,

		'has_archive'           => true,

		'exclude_from_search'   => false,

		'publicly_queryable'    => true,

		'capability_type'       => 'page',

	);

	register_post_type( 'programs', $args );



}

add_action( 'init', 'programs', 0 );