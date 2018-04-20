<?php get_header(); 
// GET LIST OF PROJECTS
$projects = array();
$args = array('post_type'=>'portfolio','posts_per_page'=>-1);
$portfolio = new WP_Query($args);
if($portfolio->have_posts()) : while($portfolio->have_posts()) : $portfolio->the_post();
  $projects[] = $post->ID;
endwhile;
endif;
wp_reset_query();

$current = array_search($post->ID,$projects);
$prev = $current - 1 >= 0 ? $current - 1 : sizeof($projects) - 1;
$next = $current + 1 < sizeof($projects) ? $current + 1 : 0;

if(have_posts()) : while(have_posts()) : the_post();
$gallery = get_field('gallery');
?>
  <section id="projectGallery" class="slideshow">
    <div class="placeholderImage"><img src="<?php echo $gallery[0]['sizes']['Portfolio Gallery']; ?>"></div>
    <input type="hidden" name="slideshow_timing" value="5000" />
    <div class="slides">
<?php foreach($gallery as $slide) { ?>
      <div class="slide"><img src="<?php echo $slide['sizes']['Portfolio Gallery']; ?>" /></div>
<?php } ?>
    </div>
    <div class="slideshowCaption">
      <h2><?php the_title(); ?></h2>
      <h3><?php echo get_field('subhead'); ?></h3>
    </div>
    <div class="slideshowControls">
      <ul>
        <li class="prev"><span>Previous</span></li>
        <li class="next"><span>Next</span></li>
      </ul>
      <button class="pause"><span>Pause</span></button>
      <p class="prev"><a href="<?php echo get_permalink($projects[$prev]); ?>">Previous Project</a></p>
      <p class="next"><a href="<?php echo get_permalink($projects[$next]); ?>">Next Project</a></p>
    <div>
<!-- pre><?php print_r($gallery); ?></pre -->
  </section>
  <section id="projectCopy">
    <h2><?php the_title(); ?></h2>
    <div class="column">
      <h3><?php echo get_field('subhead'); ?></h3>
      <?php the_content();b ?>
    </div>
    <div class="column sidebar">
<?php 
  $press = get_field('press');
  if(is_array($press)) { ?>
      <div>
        <h3>Press</h3>
<?php foreach($press as $story) { ?>
        <p><a href="<?php echo get_permalink($story->ID); ?>"><?php echo $story->post_title; ?></a></p>
<?php } ?>
      </div>
<?php 
  }
  $awards = get_field('awards');
  if(is_array($awards)) { ?>
      <div>
        <h3>Awards</h3>
<?php foreach($awards as $award) { ?>
        <p><?php echo $award->post_title; ?></p>
<?php } ?>
      </div>
<?php }
  if(get_field('exhibitions') != '') { ?>
      <div>
        <h3>Exhibitions</h3>
        <?php echo wpautop(get_field('exhibitions')); ?>
      </div>
<?php }
  if(get_field('credits') != '') { ?>
      <div>
        <h3>Credits</h3>
        <?php echo wpautop(get_field('credits')); ?>
      </div>
<?php } ?>
    </div>
<?php
endwhile;
endif;
//echo "<pre>",print_r($projects),"</pre>";
get_footer(); ?>