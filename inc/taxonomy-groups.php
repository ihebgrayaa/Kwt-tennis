<?PHP

// Register Custom Taxonomy

function groups() {



	$labels = array(

		'name'                       => _x( 'Group', 'Taxonomy General Name', 'text_domain' ),

		'singular_name'              => _x( 'Group', 'Taxonomy Singular Name', 'text_domain' ),

		'menu_name'                  => __( 'Groups', 'text_domain' ),

		'all_items'                  => __( 'All Groups', 'text_domain' ),

		'parent_item'                => __( 'Parent Group', 'text_domain' ),

		'parent_item_colon'          => __( 'Parent Group:', 'text_domain' ),

		'new_item_name'              => __( 'Group Name', 'text_domain' ),

		'add_new_item'               => __( 'Add Group', 'text_domain' ),

		'edit_item'                  => __( 'Edit Group', 'text_domain' ),

		'update_item'                => __( 'Update Group', 'text_domain' ),

		'view_item'                  => __( 'View Group', 'text_domain' ),

		'separate_items_with_commas' => __( 'Separate Groups with commas', 'text_domain' ),

		'add_or_remove_items'        => __( 'Add or remove Groups', 'text_domain' ),

		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),

		'popular_items'              => __( 'Popular Groups', 'text_domain' ),

		'search_items'               => __( 'Search Groups', 'text_domain' ),

		'not_found'                  => __( 'Not Found', 'text_domain' ),

		'no_terms'                   => __( 'No Groups', 'text_domain' ),

		'items_list'                 => __( 'Groups list', 'text_domain' ),

		'items_list_navigation'      => __( 'Groups list navigation', 'text_domain' ),

	);

	$args = array(

		'labels'                     => $labels,

		'hierarchical'               => true,

		'public'                     => true,

		'show_ui'                    => true,

		'show_admin_column'          => false,

		'show_in_nav_menus'          => false,

		'show_tagcloud'              => false,

	);

	register_taxonomy( 'groups', array( 'programs' ), $args );



}

add_action( 'init', 'Groups', 0 );

