<?php /* Template Name: Top Level Page */ ?>
<?php get_header(); ?>
<?php
if(have_posts()) : while(have_posts()) : the_post(); 

  $my_wp_query = new WP_Query();
  $all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order', 'post_parent' => $id));
  $childPages = get_page_children(get_the_ID(),$all_wp_pages);

  $slideshow = get_field('slideshow');
  $slideshow_timing = get_field('slideshow_timing');
  $tlContent = get_the_content();
  
  $a = " active";
  
?>

  <section id="toplevelSlideshow" class="slideshow">
    <input type="hidden" name="slideshow_timing" value="<?php echo $slideshow_timing; ?>" />
<?php foreach($slideshow as $slide) { ?>
    <div class="slide<?php echo $a; ?>"><img src="<?php echo $slide['sizes']['Page Slideshow']; ?>" /></div>
<?php 
  $a = '';
} ?>
  </section><!-- #toplevelSlideshow -->

<?php if ($tlContent != '') { ?>

  <section id="toplevelContent">
<?php if (is_user_logged_in()) { ?><div><?php } ?>
<?php echo wpautop($tlContent); ?>
<?php if (is_user_logged_in()) { ?></div><?php } ?>
  </section><!-- #toplevelContent -->

<?php } ?>
  <div class="childPages" id="<?php echo $post->post_name; ?>">
<?php foreach ($childPages as $childPage) { 
?>

  <section id="<?php echo $childPage->post_name; ?>">
<?php if (is_user_logged_in()) { ?><div><?php } ?>
<?php
$template = get_page_template_slug($childPage->ID);

if($template == "template_awards.php") {
  $awards = get_awards();
}

$subpage = new WP_Query( array('page_id'=>$childPage->ID) );

while ( $subpage->have_posts() ) : $subpage->the_post();
  $thumbnail = get_the_post_thumbnail(get_the_ID(),'Page Photo'); 
  $subtitle = get_field('subtitle');
  $quote = get_field('quote');
  $quote_attribute = get_field('quote_attribute');
  $sidebar_images = get_field('sidebar_images');

/** TEAM **/
if($template == "template_team.php") { ?>
      <h2><?php if ($subtitle != '') { echo $subtitle; } else { echo get_the_title(); } ?></h2>
<?php 
  ourTeam();
} else {

if($template == "template_awards.php") {
  $col1 = get_field('column_1');
  $col2 = get_field('column_2');
}
  ?>
  
<?php if($quote != "") { ?>
    <div class="sectionQuote">
      <p class="quote">“<?php echo $quote; ?>”</p>
<?php if($quote_attribute != "") { ?>
      <p class="attribute">— <?php echo $quote_attribute; ?></p>
<?php } ?>
    </div>
<?php } ?>

<?php 
if($thumbnail != "" || (is_array($sidebar_images) && sizeof($sidebar_images))) { ?>
    <div class="sectionImage"><?php 
      if(sizeof($sidebar_images)) {
        foreach($sidebar_images as $image) { ?>
      <div><img src="<?php echo $image['sizes']['Page Photo']; ?>" /></div>  
<?php
        }
      } else {
        echo $thumbnail;
      } ?></div>

    <div class="sectionContent">
      <h2><?php if ($subtitle != '') { echo $subtitle; } else { echo get_the_title(); } ?></h2>
      <?php the_content(); ?></div>

<?php } else { ?>

      <h2><?php if ($subtitle != '') { echo $subtitle; } else { echo get_the_title(); } ?></h2>
      <?php the_content(); ?>

<?php } ?>
<?php if (is_user_logged_in()) { ?></div><?php } ?>
<?php if (is_user_logged_in()) { ?>
      <p class="editpost"><a href="<?php echo get_edit_post_link( $page->ID ); ?>">Edit</a></p><?php } ?>
<?php } /** if($template == "template_team.php") **/
endwhile;
?>
  </section>
  
<?php 
} /* foreach ($childPages as $childPage) */ ?>
  </div>
<?php
endwhile;
endif;
?>
<?php get_footer(); 

function get_awards() {

  $args = array("post_type" => 'awards','posts_per_page' => -1);
  $awardsQuery = new WP_Query($args);
  $awards = array();
  if($awardsQuery->have_posts()) : while($awardsQuery->have_posts()) : $awardsQuery->the_post();

    $project = get_field('project');
    $terms = wp_get_post_terms(get_the_ID(),'awardyear');
    $awards[$terms[0]->slug][] = array(
      "title" => get_the_title(),
      "project" => '<a href="'.get_permalink($project->ID).'">'.$project->post_title.'</a>',
      "location" => get_field('location')
    );

  endwhile;
  endif;
  wp_reset_query();
  return $awards;
}

function ourTeam() {
  $args = array("post_type" => 'team','posts_per_page' => -1);;
  $teamQuery = new WP_Query($args);
  $teamArray = array();
  $i = 0;
  $r = 0;
  if($teamQuery->have_posts()) : while($teamQuery->have_posts()) : $teamQuery->the_post();
    $teamArray[$r][] = array(
      "name"=>get_the_title(),
      "bio"=>get_the_content(),
      "thumb"=>get_the_post_thumbnail(get_the_ID(),'Staff Photo')
    );
    if($i%2) { $r++; }
    $i++;
  
  endwhile;
  endif;
  wp_reset_query(); 
  
  foreach($teamArray as $row) { ?>

      <div class="teamRow">
<?php foreach($row as $teammember) { ?>
        <div class="team">
          <?php echo $teammember['thumb']; ?>
          <h3><?php echo $teammember['name']; ?></h3>
          <div class="bio"><?php echo wpautop($teammember['bio']); ?></div>
        </div>
<?php } ?>  
      </div>

<?php 
  }
} ?>