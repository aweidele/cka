<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="shortcut icon" type="image/ico" href="<?php echo get_template_directory_uri(); ?>/icon.ico" />
<title><?php
  if (is_front_page()) {
    echo get_bloginfo('name');
    if (get_bloginfo('description')!="") { echo " | ".get_bloginfo('description'); }
  } else {
    wp_title ( ' | ', true,'right' );
    echo get_bloginfo('name');
  } ?></title>
<?php
wp_head();
$template =  end(explode('/',get_page_template()));
?>
</head>
<body>
<header<?php if(
  is_front_page() ||
  is_page_template('template_homepage.php') ||
  is_page_template('template_contact.php')
  ) { echo ' class="homepage"'; } ?>>
  <div id="headerWrapper">
    <h1><a href="<?php echo get_option('home'); ?>">Carol Kurth Architecture</a></h1>
<?php if(
  is_front_page() ||
  is_page_template('template_homepage.php') ||
  is_page_template('template_contact.php')
  ) { ?>
    <div class="sublogos">
      <p class="architecture">Carol Kurth® Architecture PC</p>
      <p class="interiors">Carol Kurth® Interiors LTD</p>
    </div>
<?php } ?>
<?php
$locations = get_nav_menu_locations();
$primaryMenu = wp_get_nav_menu_items($locations['primary-menu']);
$splitMenu = array_chunk($primaryMenu, ceil(sizeof($primaryMenu) / 2), true);
?>
    <label for="menuToggle" class="hamburger"><span>Menu</span></label>
    <input type="checkbox" id="menuToggle">
    <nav>
<?php foreach($splitMenu as $menu) { ?>
      <ul>
<?php foreach($menu as $menuItem) { ?>
        <li><a href="<?php echo $menuItem->url; ?>"><?php echo $menuItem->title; ?></a></li>
<?php } ?>
      </ul>
<?php } ?>
    </nav>
<?php
$template =  end(explode('/',get_page_template()));

  /*** TOPLEVEL TEMPLATE NAVIGATION ***/
  if($template == 'template_toplevel.php') {
    $my_wp_query = new WP_Query();
    $all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order', 'post_parent' => $id));
    $childPages = get_page_children(get_the_ID(),$all_wp_pages);
    $splitMenu = array_chunk($childPages, ceil(sizeof($childPages) / 2), true);
?>
    <nav class="subnav jumpnav">
<?php foreach($splitMenu as $menu) { ?>
      <ul>
<?php foreach($menu as $menuItem) { ?>
        <li><a href="#<?php echo $menuItem->post_name; ?>"><?php echo $menuItem->post_title; ?></a></li>
<?php } ?>
      </ul>
<?php } ?>
    </nav>
<?php

  /*** PORFOLIO PAGE NAVIGATION ***/
  } else if ($template == 'template_portfolio.php' ||
             is_singular( 'portfolio' ) ||
             is_tax('filter')) {
    $filters = get_terms( 'filter' );
    $menu = array();
    foreach($filters as $filter) {
      $menu[] = array(
        "name" => $filter->name,
        "link" => get_term_link($filter->slug, 'filter')
      );
    }

   //$menu[] = array(
   //  "name" => "View All",
   //   "link" =>  get_permalink(9)
   // );
    $splitMenu = array_chunk($menu, ceil(sizeof($menu) / 2), true);

?>
    <nav class="subnav<?php if (!is_singular( 'portfolio' )) { echo " filter"; } ?>">
<?php foreach($splitMenu as $menu) { ?>
      <ul>
<?php foreach($menu as $menuItem) { ?>
        <li><a href="<?php echo $menuItem['link']; ?>"><?php echo $menuItem['name']; ?></a></li>
<?php } ?>
      </ul>
<?php } ?>
    </nav>
<?php

  /*** LIFESTYLE PAGE NAVIGATION ***/
  } else if ($template == 'template_lifestyle.php' ||
             is_singular( 'lifestyle' ) ||
             is_post_type_archive( 'lifestyle' ) ||
             is_tax('product_filter')) {
    $filters = get_terms( 'product_filter' );
    $menu = array();
	$menulength = 0;

    foreach($filters as $filter) {
      $menu[] = array(
        "name" => $filter->name,
        "link" => get_term_link($filter->name, 'product_filter'),
      );
	  $menulength += strlen($filter->name);
    }

   $ls_links = get_field('lifestyle_links',1645);
   foreach($ls_links as $l) {
     $menu[] = array(
       "name" => $l['link_label'],
  	   "link" => $l['link_url'],
	   "target" => "_blank"
      );
	  $menulength += strlen($l['link_label']);
   }
   $splitMenu = array_chunk($menu, ceil(sizeof($menu) / 2), true);

?>
    <nav class="subnav<?php if (!is_singular( 'lifestyle' )) { echo " filter"; } ?>">
<?php foreach($splitMenu as $menu) { ?>
      <ul>
<?php foreach($menu as $menuItem) { ?>
        <li><a href="<?php echo $menuItem['link']; ?>"<?php if(isset($menuItem["target"]) && $menuItem["target"] != "") { echo ' target="'.$menuItem["target"].'"'; } ?>><?php echo $menuItem['name']; ?></a></li>
<?php } ?>
      </ul>
<?php } ?>
    </nav>

<?php } // end if ?>
  </div>
</header>
<main id="contentWrapper">
