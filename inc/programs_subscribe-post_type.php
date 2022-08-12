<?PHP

// Register Custom Post Type

function programs_subscribe() {



	$labels = array(

		'name'                  => _x( 'Subscribes', 'Post Type General Name', 'text_domain' ),

		'singular_name'         => _x( 'Subscribe', 'Post Type Singular Name', 'text_domain' ),

		'menu_name'             => __( 'Subscribes', 'text_domain' ),

		'name_admin_bar'        => __( 'Subscribes', 'text_domain' ),

		'archives'              => __( 'Subscribe Archives', 'text_domain' ),

		'attributes'            => __( 'Subscribe Attributes', 'text_domain' ),

		'parent_Subscribe_colon'     => __( 'Parent Subscribe:', 'text_domain' ),

		'all_Subscribes'             => __( 'All Subscribes', 'text_domain' ),

		'add_new_Subscribe'          => __( 'Add New Subscribe', 'text_domain' ),

		'add_new'               => __( 'Add New', 'text_domain' ),

		'new_Subscribe'              => __( 'New Subscribe', 'text_domain' ),

		'edit_Subscribe'             => __( 'Edit Subscribe', 'text_domain' ),

		'update_Subscribe'           => __( 'Update Subscribe', 'text_domain' ),

		'view_Subscribe'             => __( 'View Subscribe', 'text_domain' ),

		'view_Subscribes'            => __( 'View Subscribes', 'text_domain' ),

		'search_Subscribes'          => __( 'Search Subscribe', 'text_domain' ),

		'not_found'             => __( 'Not found', 'text_domain' ),

		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),

		'featured_image'        => __( 'Featured Image', 'text_domain' ),

		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),

		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),

		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),

		'insert_into_Subscribe'      => __( 'Insert into Subscribe', 'text_domain' ),

		'uploaded_to_this_Subscribe' => __( 'Uploaded to this Subscribe', 'text_domain' ),

		'Subscribes_list'            => __( 'Subscribes list', 'text_domain' ),

		'Subscribes_list_navigation' => __( 'Subscribes list navigation', 'text_domain' ),

		'filter_Subscribes_list'     => __( 'Filter Subscribes list', 'text_domain' ),

	);

	$args = array(

		'label'                 => __( 'Subscribe', 'text_domain' ),

		'description'           => __( 'Subscribes Description', 'text_domain' ),

		'labels'                => $labels,

		'supports'              => array( 'title', 'editor', 'thumbnail' ),

		'hierarchical'          => false,

		'public'                => true,

		'show_ui'               => true,

		'show_in_menu'          => false,

		'menu_position'         => 5,

		'menu_icon'             => 'dashicons-businessman',

		'show_in_admin_bar'     => false,

		'show_in_nav_menus'     => false,

		'can_export'            => true,

		'has_archive'           => true,

		'exclude_from_search'   => false,

		'publicly_queryable'    => true,

		'capability_type'       => 'page',

	);

	register_post_type( 'programs_subscribe', $args );



}

add_action( 'init', 'programs_subscribe', 0 );