<?php

define("CSS_DIR", get_template_directory_uri() . "/css");
define("JS_DIR", get_template_directory_uri() . "/js");
define("FONTS_DIR", get_template_directory_uri() . "/fonts");
define("BOWER_DIR", get_template_directory_uri() . "/assets/bower_components");

if ( ! function_exists( '_90d_setup' ) ) :
function _90d_setup() {

	/* SEO */
	add_theme_support( 'title-tag' );

	/* Image */
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true ); // default Post Thumbnail dimensions (cropped) - equal to medium size set in media settings
		add_image_size( 'page-backgroud', 2000, 1250, true);
		add_image_size( 'news-featured', 750, 460, true);
		add_image_size( 'property-thumbnail', 300, 180, true);
		add_image_size( 'property-gallery', 1440, 550, true);
	}

	/* Navigation */
	register_nav_menus( array(
		'main' => __( 'Main Menu', '_90d' ),
		'footer'  => __( 'Footer Menu', '_90d' ),
	) );

}
endif; // _90d_setup
add_action( 'after_setup_theme', '_90d_setup' );


function _90d_sidebars() {

	register_sidebar( array(
		'name'          => __( 'Site Header', '_90d' ),
		'id'            => 'site-header-widgets',
		'description'   => __( '', '_90d' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => __( 'News Sidebar', '_90d' ),
		'id'            => 'news-widgets',
		'description'   => __( '', '_90d' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => "</h3>\n",
	) );

}
add_action( 'widgets_init', '_90d_sidebars' );


if ( ! function_exists( '_90d_jquery' ) ) :
function _90d_jquery() {
    if ( ! is_admin() ) { // only use this method is we're not in wp-admin
        wp_deregister_script('jquery'); // deregister the original version of jQuery
        wp_register_script('jquery', '', FALSE, '1.11.3'); // register it again, this time with no file path
        wp_enqueue_script('jquery'); // add it back into the queue
		/*
		*	Notice we've deregistered the original version, registered a new version
		*	(which just so happens to have no file associated with it), then placed
		*	it back in the queue. Now any other JavaScript files that depend on jQuery
		*	will load, as WordPress recognises the dependancy (jQuery) has been set.
		*	I also figured we’d need to keep the version number in there just in case
		*	another script references a specific version dependency.
		*/
    }
}
endif; // _90d_setup
add_action('template_redirect', '_90d_jquery');


function _90d_taxonomy() {
	register_taxonomy(
		'property-type',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'property',   		 //post type name
		array(
			'hierarchical' 		=> false,
			'label' 			=> 'Property Types',  //Display name
			'query_var' 		=> true,
			'rewrite'			=> array(
				'slug' 			=> 'property-type', // This controls the base slug that will display before each term
				'with_front' 	=> true // Don't display the category base before
			)
		)
	);
	register_taxonomy(
		'property-location',
		'property',
		array(
			'hierarchical' 		=> false,
			'label' 			=> 'Property Locations',
			'query_var' 		=> true,
			'rewrite'			=> array(
				'slug' 			=> 'property-location',
				'with_front' 	=> true
			)
		)
	);
	register_taxonomy(
		'property-size',
		'property',
		array(
			'hierarchical' 		=> false,
			'label' 			=> 'Property Size Ranges',
			'query_var' 		=> true,
			'rewrite'			=> array(
				'slug' 			=> 'property-size',
				'with_front' 	=> true
			)
		)
	);
}
add_action( 'init', '_90d_taxonomy');

function remove_meta_that_use_acf_instead() {
	remove_meta_box( 'tagsdiv-property-type', 'property', 'normal' );
	remove_meta_box( 'tagsdiv-property-location', 'property', 'normal' );
	remove_meta_box( 'tagsdiv-property-size', 'property', 'normal' );
}

add_action( 'admin_menu' , 'remove_meta_that_use_acf_instead' );

function _90d_custom_post_types() {

	$properties_labels = array(
		"name" => "Properties",
		"singular_name" => "Property",
	);
	$properties_args = array(
		"labels" => $properties_labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array(
			"slug" => 'property',
			"with_front" => false
		),
		"query_var" => true,
		"menu_position" => 10,
		"menu_icon" => "dashicons-building",
		"supports" => array( "title", "editor", "revisions" ),
		"taxonomies" => array( 'property-type', 'property-location', 'property-size' )
	);
	register_post_type( "property", $properties_args );

}
add_action( 'init', '_90d_custom_post_types' );


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Site Misc Settings',
		'menu_title'	=> 'Site Misc Settings',
		'menu_slug' 	=> 'site-misc-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

function pretty_print($var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

function get_the_slug( $id=null ){
  if( empty($id) ) {
		global $post;
    if( empty($post) ) {
      return ''; // No global $post var available.
		}
    $id = $post->ID;
	}
  $slug = basename( get_permalink($id) );
  return $slug;
}

/* Display the page or post slug - Uses get_the_slug() and applies 'the_slug' filter */
function the_slug( $id=null ){
  echo apply_filters( 'the_slug', get_the_slug($id) );
}


function _90d_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter('mce_buttons_2', '_90d_mce_buttons_2');


function _90d_mce_before_init_insert_formats( $init_array ) {
	$style_formats = array(
		array(
			'title' => '.center-dynamic-width-elements',
			'block' => 'div',
			'classes' => 'center-dynamic-width-elements',
			'wrapper' => true,

		),
		array(
			'title' => '.small-text',
			'block' => 'div',
			'classes' => 'small-text',
			'wrapper' => true,
		),
		array(
			'title' => '.extra-small-text',
			'block' => 'div',
			'classes' => 'extra-small-text',
			'wrapper' => true,
		),
	);
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;
}
add_filter( 'tiny_mce_before_init', '_90d_mce_before_init_insert_formats' );


function _90d_theme_add_editor_styles() {
    add_editor_style( 'css/admin-styles.css' );
}
add_action( 'admin_init', '_90d_theme_add_editor_styles' );



function _90d_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );

	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', '_90d_imagelink_setup', 10);


function _90d_excerpt_more( $more ) {
	return ' <a class="read-more btn btn-grey" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More &gt;', '_90d' ) . '</a>';
}
add_filter( 'excerpt_more', '_90d_excerpt_more' );


function _90d_page_nav($show_prev = true, $show_next = true) {

	//$pagelist = get_pages('sort_column=menu_order&sort_order=asc');
	$menu_item_list = wp_get_nav_menu_items('MainMenu');

	$menu_items = array();
	foreach ($menu_item_list as $menu_item) {
		$menu_items[] += $menu_item->object_id;
	}
	$currentID = array_search(get_the_ID(), $menu_items);
	if(is_home()) { //if is the blog page
		$currentID = array_search(get_option( 'page_for_posts' ), $menu_items);
	}
	$prevID = $menu_items[$currentID-1];
	$nextID = $menu_items[$currentID+1];

	$return = "<div class='page-nav'>";
	if (!empty($prevID) && $show_prev) {
		$return .= "<div class='prev'>";
			$return .= "<a href='" . get_permalink($prevID) . "' title='" . get_the_title($prevID) . "' class='animsition-link'>" . get_the_title($prevID) . "</a>";
		$return .= "</div>";
	}

	if (!empty($nextID) && $show_next) {
		$return .= "<div class='next'>";
			$return .= "<a href='" . get_permalink($nextID) . "' title='" . get_the_title($nextID) . "' class='animsition-link'>" . get_the_title($nextID) . "</a>";
		$return .= "</div>";
	}

	$return .= "</div>";

	return $return;

}


function _90d_add_query_vars_filter( $vars ){
  $vars[] = "fs"; //filtered search
	$vars[] = "rs"; //reset search
  return $vars;
}
add_filter( 'query_vars', '_90d_add_query_vars_filter' );




function _90d_custom_pagination($numpages = '', $pagerange = 2, $paged='', $filtered_search = false, $navigation_class, $show_page_summary = true) {

  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  $pagination_args = array(
    'base'            => trailingslashit(get_pagenum_link()) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => false,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => true,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => $filtered_search ? ['fs' => 'true'] : false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {

    echo "<nav class='{$navigation_class}'>";
			echo "<div class='page-numbers page-number-links'>{$paginate_links}</div>";
			if ($show_page_summary) {
				echo "<div class='page-numbers page-summary'>Page {$paged} of {$numpages}</div>";
			}
    echo "</nav>";
  }

}
