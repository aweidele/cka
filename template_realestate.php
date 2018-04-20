<?php /* Template Name: Real Estate */ ?>
<?php get_header(); ?>
  <section id="realEstate">
    <div class="projects">
<?php
  $args = array('post_type'=>'realestate','posts_per_page'=>-1);
  $portfolio = new WP_Query($args);
  if($portfolio->have_posts()) :
  while($portfolio->have_posts()) : $portfolio->the_post();
    $thumbnail = get_the_post_thumbnail(get_the_ID(),'Portfolio');
    $sold = get_field('sold')[0];
    $project_link = get_field('project_link');
?>

      <div class="project">
<?php if($project_link != "") { ?>
        <a href="<?php echo $project_link; ?>">
<?php } ?>
          <div class="photo">
            <?php echo $thumbnail; ?>
<?php if ($sold == 'Yes') { ?>
            <p class="sold">SOLD</p>
<?php } ?>
          </div>
          <div class="blurb">
            <h3><?php echo get_the_title(); ?></h3>
            <p><?php echo get_field('address'); ?></p>
<?php if ($sold != 'Yes') { ?>
            <p>Call (914) 234-2595 for information</p>
<?php } else { ?>
            <p>SOLD</p>
<?php } ?>
          </div>
<?php if($project_link != "") { ?>
        </a>
<?php } ?>
      </div>

<?php
  endwhile;
  endif;
  wp_reset_query();
?>
    </div>
    <div class="pageCopy">
      <?php echo wpautop(do_shortcode($post->post_content)); ?>
    </div>
  </section>
<?php get_footer(); ?>