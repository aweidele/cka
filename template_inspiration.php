<?php
/* Template Name: Inspiration */
get_header();
if(have_posts()) : while(have_posts()) : the_post(); 
?>
    <!-- pre><?php print_r(get_field('slideshow_timing')); ?></pre>
    <pre><?php print_r(get_field('slideshow')); ?></pre -->
  <section id="inspiration" class="slideshow fssh">
    <input type="hidden" value="<?php echo get_field('slideshow_timing'); ?>" name="slideshow_timing">
    <div class="slides">
<?php 
foreach(get_field('slideshow') as $i => $slide) {  ?>
      <div class="slide" id="slide_<?php echo str_pad($i, 2, '0', STR_PAD_LEFT);; ?>"><a href="<?php echo $slide['link_to_project']; ?>"><img src="<?php echo $slide['image']['sizes']['Homepage Slideshow']; ?>"></a></div>
<?php } ?>
    </div>
    <div class="slideshowControls">
      <ul>
        <li class="prev"><span>Previous</span></li>
        <li class="next"><span>Next</span></li>
      </ul>
    </div>
  </section>
<?php 
endwhile;
endif;
get_footer(); ?>