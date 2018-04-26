<?php
/*** ADD SCRIPTS AND STYLES ***/
function cka_scripts() {
  // styles
  wp_enqueue_style( 'font-style', '//fast.fonts.net/cssapi/71138be6-38c0-4939-b911-a168745b6726.css');
  wp_enqueue_style( 'main-style', get_template_directory_uri() . '/main.css' );
  wp_enqueue_style( 'override-style', get_template_directory_uri() . '/override.css' );
  //wp_enqueue_style( 'main-style', get_stylesheet_uri() );

  // scripts
  wp_enqueue_script( 'main-script', get_template_directory_uri() . '/inc/script.js', array('jquery'), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'cka_scripts' );


/*** ADD SUPPORT FOR CUSTOM MENUS ***/
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
  register_nav_menu( 'footer-menu', __( 'Footer Menu' ) );
}

/*** IMAGE SIZES ***/
add_theme_support('post-thumbnails');
add_image_size('Homepage Slideshow',1680,905,true);
add_image_size('Page Slideshow',1680,610,true);
add_image_size('Page Photo',445,999999);
add_image_size('Portfolio',368,287,true);
add_image_size('Portfolio Gallery',1900,1145,true);
add_image_size('Staff Photo',140,160,true);

/*** CUSTOM POST TYPES ***/
add_action('init', 'cka_register');

function cka_register() {

	/*** Portfolio ***/
	$labels = array(
		'name' => _x('Portfolio', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New Project', 'portfolio item'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/portfolio.svg',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		//"menu_position" => 21
	  );

	register_post_type( 'portfolio' , $args );

	/*** Lifestyle ***/
	$labels = array(
		'name' => _x('Product', 'post type general name'),
		'singular_name' => _x('Product', 'post type singular name'),
		'add_new' => _x('Add New Product', 'portfolio item'),
		'add_new_item' => __('Add New Product'),
		'edit_item' => __('Edit Product'),
		'new_item' => __('New Product'),
		'view_item' => __('View Product'),
		'search_items' => __('Search Product'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/portfolio.svg',
    'rewrite' => array(
      'slug' => 'product'),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
    'has_archive' => true,
		//"menu_position" => 21
	  );

	register_post_type( 'lifestyle' , $args );

  /*** Art ***/
  // $labels = array(
  //   'name' => _x('Art', 'post type general name'),
  //   'singular_name' => _x('Art', 'post type singular name'),
  //   'add_new' => _x('Add New Art', 'portfolio item'),
  //   'add_new_item' => __('Add New Art'),
  //   'edit_item' => __('Edit Art'),
  //   'new_item' => __('New Art'),
  //   'view_item' => __('View Art'),
  //   'search_items' => __('Search Art'),
  //   'not_found' =>  __('Nothing found'),
  //   'not_found_in_trash' => __('Nothing found in Trash'),
  //   'parent_item_colon' => ''
  // );
  //
  // $args = array(
  //   'labels' => $labels,
  //   'public' => true,
  //   'publicly_queryable' => true,
  //   'show_ui' => true,
  //   'query_var' => true,
  //   'menu_icon' => 'dashicons-art',
  //   'capability_type' => 'post',
  //   'hierarchical' => false,
  //   'menu_position' => null,
  //   'supports' => array('title','editor','thumbnail','excerpt'),
  //   'has_archive' => true,
  //   //"menu_position" => 21
  //   );
  //
  // register_post_type( 'art' , $args );

	/*** Awards ***/
	$labels = array(
		'name' => _x('Awards', 'post type general name'),
		'singular_name' => _x('Award', 'post type singular name'),
		'add_new' => _x('Add New Award', 'portfolio item'),
		'add_new_item' => __('Add New Award'),
		'edit_item' => __('Edit Award'),
		'new_item' => __('New Award'),
		'view_item' => __('View Award'),
		'search_items' => __('Search Award'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/trophy.svg',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		//"menu_position" => 21
	  );

	register_post_type( 'awards' , $args );

	/*** Real Estate ***/
	$labels = array(
		'name' => _x('Real Estate', 'post type general name'),
		'singular_name' => _x('Listing', 'post type singular name'),
		'add_new' => _x('Add New Listing', 'portfolio item'),
		'add_new_item' => __('Add New Listing'),
		'edit_item' => __('Edit Listing'),
		'new_item' => __('New Listing'),
		'view_item' => __('View Listing'),
		'search_items' => __('Search Listing'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/realestate.svg',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		//"menu_position" => 21
	  );

	register_post_type( 'realestate' , $args );

	/*** Our Team ***/
	$labels = array(
		'name' => _x('Our Team', 'post type general name'),
		'singular_name' => _x('Team Member', 'post type singular name'),
		'add_new' => _x('Add New Team Member', 'portfolio item'),
		'add_new_item' => __('Add New Team Member'),
		'edit_item' => __('Edit Team Member'),
		'new_item' => __('New Team Member'),
		'view_item' => __('View Team Member'),
		'search_items' => __('Search Team Members'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/team.svg',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		//"menu_position" => 21
	  );

	register_post_type( 'team' , $args );

	flush_rewrite_rules();
}

/*** REGISTER TAXONOMIES ***/
add_action( 'init', 'create_taxonomies', 0 );
function create_taxonomies() {
    // Add Portfolio Filter Taxonomy
    register_taxonomy(
        'filter',
        'portfolio',
        array(
            'labels' => array(
                'name'              => _x( 'Filters' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Filter' , 'taxonomy singular name'),
                'add_new_item' => 'Add Filter',
                'new_item_name' => "New Filter"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'support' => array('tags')
        )
    );
    // Add Lifestyle Filter Taxonomy
    register_taxonomy(
        'product_filter',
        'lifestyle',
        array(
            'labels' => array(
                'name'              => _x( 'Product Filters' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Product Filter' , 'taxonomy singular name'),
                'add_new_item' => 'Add Filter',
                'new_item_name' => "New Filter"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'support' => array('tags'),
            'rewrite' => array(
              'slug' => 'product/filter'),
        )
    );
    // Add Art Filter Taxonomy
    // register_taxonomy(
    //     'art_filter',
    //     'art',
    //     array(
    //         'labels' => array(
    //             'name'              => _x( 'Art Filters' , 'taxonomy general name' ),
    //             'singular_name'     => _x( 'Art Filter' , 'taxonomy singular name'),
    //             'add_new_item' => 'Add Filter',
    //             'new_item_name' => "New Filter"
    //         ),
    //         'show_ui' => true,
    //         'show_admin_column' => true,
    //         'show_tagcloud' => false,
    //         'hierarchical' => true,
    //         'support' => array('tags'),
    //         'rewrite' => array(
    //           'slug' => 'art/filter'),
    //     )
    // );
    // Add News Filter Taxonomy
    register_taxonomy(
        'heading',
        'post',
        array(
            'labels' => array(
                'name'              => _x( 'Filters' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Filter' , 'taxonomy singular name'),
                'add_new_item' => 'Add Filter',
                'new_item_name' => "New Filter"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'support' => array('tags')
        )
    );

    // Add Awards Year Taxonomy
    register_taxonomy(
        'awardyear',
        'awards',
        array(
            'labels' => array(
                'name'              => _x( 'Years' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Year' , 'taxonomy singular name'),
                'add_new_item' => 'Add Year',
                'new_item_name' => "New Year"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'support' => array('tags')
        )
    );

    // Add Real Estate Location Taxonomy
    register_taxonomy(
        'relocation',
        'realestate',
        array(
            'labels' => array(
                'name'              => _x( 'Locations' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Location' , 'taxonomy singular name'),
                'add_new_item' => 'Add Location',
                'new_item_name' => "New Location"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'support' => array('tags')
        )
    ); /*
	flush_rewrite_rules();
	*/

}

/**** ADD OPTIONS PAGE TO POST TYPES ***  */
if ( function_exists( 'acf_add_options_sub_page' ) ){
	acf_add_options_sub_page(array(
		'title'      => 'Art Splash Page',
		'parent'     => 'edit.php?post_type=art',
		'capability' => 'manage_options'
	));
}

/**** REORDER ADMIN MENU ITEMS ***  */
    function custom_menu_order($menu_ord) {
        if (!$menu_ord) return true;

        return array(
            'index.php', // Dashboard
            'separator1', // First separator
            'upload.php', // Media
            'edit.php?post_type=page', // Pages
            'edit.php?post_type=team', // Team
            'edit.php?post_type=awards', // Awards
            'edit.php?post_type=portfolio', // Portfolio
            'edit.php?post_type=lifestyle', // Lifestyle
            'edit.php?post_type=art', // Art
            'edit.php', // Posts
            'edit.php?post_type=realestate', // Real Estate
            //'link-manager.php', // Links
            'separator2', // First separator
            //'edit-comments.php', // Comments
            'separator-last', // Last separator
            'themes.php', // Appearance
            'plugins.php', // Plugins
            'users.php', // Users
            'tools.php', // Tools
            'options-general.php', // Settings
        );
    }
    add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
    add_filter('menu_order', 'custom_menu_order');

    function edit_admin_menus() {
        global $menu;
        $menu[5][0] = 'Press'; // Change Posts to "Press"
    }
    add_action( 'admin_menu', 'edit_admin_menus' );


/*** SHORTCODES ***/
function column_shortcode( $atts, $content = null ) {
  $msg = '<div class="column">';
  $msg .= do_shortcode($content);
  $msg .= '</div>';
  return $msg;
}
function awards_shortcode( $atts, $content = null ) {
  global $awards;
  $y = shortcode_atts( array(
    'year'  => '2015'
    ) , $atts);

  $year = $y['year'];
  $msg = "<h3>".$year."</h3>\n";
  foreach($awards[$year] as $award) {
    $msg .= '<p class="award">';
    $msg .= '<strong>'.$award['title'].'</strong> for ';
    $msg .= $award['project'];
    //$msg .= ', '.$award['location'];
    $msg .= "</p>\n";
  }
  return $msg;
}
add_shortcode( 'column', 'column_shortcode' );
add_shortcode( 'awards', 'awards_shortcode' );
/*** ADD CAMPAIGN SETTINGS PAGE **
if( is_admin() ) {
  include(get_template_directory().'/inc/campaign_settings.php');
  $my_settings_page = new MySettingsPage();
} */


/** DEFINE COLOR PICKER PALETTE **/
function my_acf_admin_head() {
	echo "
	<script>
	(function($){
  	acf.add_action('ready append', function() {
  		acf.get_fields({ type : 'color_picker'}).each(function() {
  	  	$(this).iris({
  			  palettes: ['#83a94e', '#FFFFFF', '#000000', '#333333', '#666666', '#999999'],
  			  change: function(event, ui) {
  					$(this).parents('.wp-picker-container').find('.wp-color-result').css('background-color', ui.color.toString());
  			  }
  			});
  		});
  	});
	})(jQuery);
	</script>
	";
}

add_action( 'acf/input/admin_head', 'my_acf_admin_head' );

?>
