<?php /* Template Name: Lifestyle */ ?>

Hi???
<?php
// $filters = get_terms( 'lifestyle_filter' );
// $redirect = get_term_link($filters[0]);
// header("Location: ".$redirect)
//print_r($filters);
//print_r($redirect);
?>
<?php /*
 <?php get_header(); ?>
  <section id="portfolio">
    <div class="projects">
<?php

  $filters = get_terms( 'lifestyle_filter' );
  $args = array('post_type'=>'lifestyle','posts_per_page'=>-1);
  $portfolio = new WP_Query($args);
  if($portfolio->have_posts()) :
  while($portfolio->have_posts()) : $portfolio->the_post();
    $thumbnail = get_the_post_thumbnail(get_the_ID(),'Portfolio');
?>

      <div class="project">
        <a href="<?php echo get_permalink(); ?>">
          <div class="photo"><?php echo $thumbnail; ?></div>
          <div class="blurb">
            <h2><?php echo get_the_title(); ?></h2>
            <p><?php echo get_field('subhead'); ?></p>
          </div>
        </a>
      </div>

<?php
  endwhile;
  endif;
?>
    </div>
  </section>
<?php get_footer(); ?>
<!--
<?php print_r($filters); ?>
-->
*/ ?>
