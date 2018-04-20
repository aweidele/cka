<?php 
  get_header();
  $newsPage = get_option('page_for_posts');
  $filters = get_terms( 'heading' ); 
?>
  
  <section id="newsFilters">
      <ul class="filters">
        <li><a href="<?php echo get_permalink($newsPage); ?>">View All News</a></li>
<?php foreach($filters as $f) { ?>
        <li><a href=""><?php echo $f->name; ?></a></li>
<?php } ?>
      </ul>  
  </section>
  <section id="news">
    <div id="singlePost" class="column">
<?php
if(have_posts()) : while(have_posts()) : the_post(); 
  $thumbnail = get_the_post_thumbnail(get_the_ID(),'Page Photo');
  $categories = get_the_category();
  $link = get_field('link_to_press');
  $related = get_field('related_projects');
?>
      <div class="post">
        <?php echo $thumbnail; ?>
        <ul class="datecat">
          <li><?php echo get_the_date('F j, Y'); ?></li>
<?php foreach($categories as $cat) { ?>
          <li><?php echo $cat->name; ?></li>
<?php } ?>
<?php if($link != '') { ?>
          <li><a href="<?php echo $link; ?>" target="_blank">Link to Article »</a></li>
<?php } ?>
        </ul>
        <h2><?php the_title(); ?></h2>
        <div class="postContent">
<?php the_content(); ?>
        </div>
<?php 
/// RELATED PROJECTS
if(is_array($related) && sizeof($related)) { ?>
        <div class="related_projects">
          <h3>Related Projects</h3>
          <ul>
<?php foreach($related as $project) { ?>
            <li><a href="<?php echo get_permalink($project->ID); ?>"><?php echo $project->post_title; ?></a></li>
<?php } ?>
          <ul>
        </div>
<?php }
/// END RELATED PROJECTS
 ?>
        <?php if (is_user_logged_in()) { ?><p class="editpost"><a href="<?php echo get_edit_post_link( get_the_ID() ); ?>">Edit</a></p><?php } ?>
      </div>
<?php
endwhile;
endif;
?>
    </div>
    <div id="newsfeed" class="column">
      <div class="posts">
<?php 
$feed = new WP_Query(array('posts_per_page'=>8));
if($feed->have_posts()) : while($feed->have_posts()) : $feed->the_post(); 
  $categories = get_the_category();
?>

        <div class="post">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <ul class="datecat">
            <li><?php echo get_the_date('F j, Y'); ?></li>
<?php foreach($categories as $cat) { ?>
            <li><?php echo $cat->name; ?></li>
<?php } ?>
          </ul>
        </div>

<?php
endwhile;
endif;
?>
      </div>
    </div><!-- end news feed -->
  </section>
  
<?php get_footer(); ?>