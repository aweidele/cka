<?php /* Template Name: Homepage */ ?>
<?php get_header(); ?>
<?php
if(have_posts()) : while(have_posts()) : the_post(); 
$homepage_slideshow = get_field('homepage_slideshow');
$homepage_slideshow_timing = get_field('homepage_slideshow_timing');
?>
<section id="homepage_slideshow" class="slideshow fssh">
<input type="hidden" name="slideshow_timing" value="<?php echo $homepage_slideshow_timing; ?>" />
<?php foreach($homepage_slideshow as $i => $slide) { 
$headline_color = $slide['color'];
$caption_color = $slide['caption_color'];
?>

  <div class="slide" id="slide_<?php echo $i; ?>">
    <a href="<?php echo $slide['link']; ?>"><img src="<?php echo $slide['image']['sizes']['Homepage Slideshow']; ?>" />
    <div class="slide_caption">
      <h2<?php if($headline_color != '') { echo ' style="color: '.$headline_color.'"'; } ?>><?php echo $slide['headline']; ?></h2>
      <p class="caption"<?php if($caption_color != '') { echo ' style="color: '.$caption_color.'"'; } ?>><?php echo $slide['caption']; ?></p>
      <p class="tagline"<?php if($headline_color != '') { echo ' style="color: '.$headline_color.'"'; } ?>><?php echo $slide['tagline']; ?></p>
    </div></a>
  </div>

<?php } ?>
</section>
<!-- <?php print_r($homepage_slideshow); ?> -->
<?php
endwhile;
endif;
?>
<?php get_footer(); ?>