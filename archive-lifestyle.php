<?php
get_header();
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
</section>
<?php
get_footer();
?>
