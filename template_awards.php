<?php
/* Template Name: Awards */
$args = array("post_type" => 'awards');
$awardsQuery = new WP_Query($args);
$awards = array();
if($awardsQuery->have_posts()) : while($awardsQuery->have_posts()) : $awardsQuery->the_post();

  $project = get_field('project');
  $terms = wp_get_post_terms(get_the_ID(),'awardyear');
  echo get_the_title()."<br />";
  //echo "<pre>"; print_r($project); echo "</pre>";
  $awards[$terms[0]->slug][] = array(
    "title" => get_the_title(),
    "project" => '<a href="'.get_permalink($project->ID).'">'.$project->post_title.'</a>'
  );

endwhile;
endif;
?>
<pre><?php print_r($awards); ?></pre>