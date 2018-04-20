

</div><!-- #contentWrapper -->
<?php
$locations = get_nav_menu_locations();
$footerMenu = wp_get_nav_menu_items($locations['footer-menu']);
//echo "<pre>";
//print_r($footerMenu);
//echo "</pre>";
?>
<footer>
  <ul class="footernav">
<?php foreach($footerMenu as $item) { ?>
    <li><a href="<?php echo $item->url; ?>"<?php
      if($item->type == 'custom') { echo ' target="_blank"'; }
    ?>><?php echo $item->title; ?></a></li>
<?php } ?>
  </ul>
  <ul>
    <a href="<?php echo get_permalink( 17 ); ?>">
    <li>Carol Kurth Architecture, PC</li>
    <li>644 Old Post Road</li>
    <li>Bedford, NY 10506</li></a>
    <li>(914) 234-2595</li>
    <li><a href="mailto:<?php echo get_option('admin_email'); ?>">Email</a></li>
  </ul>
  <ul class="social">
    <li class="facebook"><a href="https://www.facebook.com/pages/Carol-Kurth-Architecture-PC-Carol-Kurth-Interiors-LTD/122788477741778" target="_blank"><span>Facebook</span></a></li>
    <li class="instagram"><a href="http://instagram.com/carolkurth" target="_blank"><span>Instagram</span></a></li>
    <li class="twitter"><a href="https://twitter.com/CarolKurth" target="_blank"><span>Twitter</span></a></li>
    <li class="houzz"><a href="http://www.houzz.com/pro/carolkurth/carol-kurth-architecture-interiors" target="_blank"><span>Houzz</span></a></li>
  </ul>
</footer>
<div id="feedback">feedback</div>
<?php wp_footer(); ?>
</body>
</html>