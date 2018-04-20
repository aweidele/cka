<?php get_header(); 
if(have_posts()) : while(have_posts()) : the_post();
$gallery = get_field('gallery');
$sold = get_field('sold')[0];
?>
  <section id="projectGallery" class="slideshow">
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
        <li><span>Previous</span></li>
        <li><span>Next</span></li>
      </ul>
      <p><a href="">Next Project</a></p>
    <div>
<!-- pre><?php print_r($gallery); ?></pre -->
  </section>
  <section id="projectCopy">
    <h2><?php the_title(); ?></h2>
    <div class="column">
      <h3><?php echo get_field('subhead'); ?></h3>
      <?php the_content(); ?>
    </div>
    <div class="column sidebar">
      <div>
        <h3><?php echo get_field('address'); ?></h3>
<?php if ($sold != 'Yes') { ?>
        <p>Call (914) 234-2595 for information</p>
<?php } else { ?>
        <p>SOLD</p>
<?php } ?>
      </div>
    </div><!-- .sidebar -->
<?php
endwhile;
endif;
get_footer(); ?>