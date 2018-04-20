<?php
get_header();
if ( isset( $_GET[ 'v' ] ) && $_GET[ 'v' ] == 'list' ) {
  ?>
  <section id="portfolio">
    <div class="projects">
      <?php
      if ( have_posts() ): while ( have_posts() ): the_post();
      $thumbnail = get_the_post_thumbnail( get_the_ID(), 'Portfolio' );
      ?>

      <div class="project">
        <a href="<?php echo get_permalink(); ?>">
          <div class="photo">
            <?php echo $thumbnail; ?>
          </div>
          <div class="blurb">
            <h2>
              <?php echo get_the_title(); ?>
            </h2>
            <p>
              <?php echo get_field('subhead'); ?>
            </p>
          </div>
        </a>
      </div>

      <?php
      endwhile;
      endif;
      ?>
    </div>
  </section> <?php
} else {
  $filter = get_queried_object();
  $linkText = get_field( 'view_link_text', $filter );
  $slideshow = get_field( 'splash_page_slideshow', $filter );
  $speed = get_field( 'splash_page_slideshow_speed', $filter );
  ?>
  <section id="homepage_slideshow" class="slideshow fssh">
    <input type="hidden" name="slideshow_timing" value="<?php echo $speed; ?>"/>
    <?php foreach($slideshow as $i => $slide) { ?>
    <div class="slide" id="slide_<?php echo $i; ?>">
      <img src="<?php echo $slide['sizes']['Homepage Slideshow']; ?>"/>
    </div>
    <?php } ?>
    <div class="lifestyleCaption">
      <div>
        <div>
          <h2><?php echo $filter->name; ?></h2>
          <?php echo term_description(); ?>
          <a href="?v=list" class="view"><?php echo $linkText; ?> ></a>
        </div>
      </div>
    </div>
  </section> <?php
}
?>
<?php get_footer();?>
