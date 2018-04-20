<?php
/* Template Name: Contact */
get_header(); 
if(have_posts()) : while(have_posts()) : the_post();
?>
  
  <section id="contact">
    <div class="contentWrapper">
      <div id="contactContent" class="column">
        <div class="contactContentContainer">
          <h2><?php the_title(); ?></h2>
          <h3><?php echo get_field('name'); ?></h3>
          <p><?php echo get_field('address'); ?><br />
          T. <?php echo get_field('phone'); ?><br />
          F. <?php echo get_field('fax'); ?><br />
          <a href="mailto:<?php echo get_field('email'); ?>"><?php echo get_field('email'); ?></a></p>
          <?php the_content(); ?>
          <p class="copyright"><?php echo get_field('copyright'); ?></p>
        </div>
      </div>
      <div id="map" class="column">
      
<!-- BEGIN GOOGLE MAP CODE -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
var map;
var adjmi = new google.maps.LatLng(41.204001, -73.644193);

var MY_MAPTYPE_ID = 'custom_style';

function initialize() {

  //var featureOpts = [ { "featureType": "administrative.country", "stylers": [ { "visibility": "off" } ] },{ "featureType": "administrative.province", "stylers": [ { "visibility": "off" } ] },{ "featureType": "landscape.natural", "stylers": [ { "visibility": "on" }, { "color": "#d6d6d4" } ] },{ "featureType": "landscape.man_made", "elementType": "geometry", "stylers": [ { "color": "#e6e4e1" }, { "visibility": "off" } ] },{ "featureType": "poi", "stylers": [ { "visibility": "off" } ] },{ "featureType": "poi.park", "stylers": [ { "visibility": "on" }, { "color": "#9ca196" } ] },{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "color": "#999999" }, { "visibility": "on" } ] },{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" } ] },{ "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "weight": 0.9 }, { "color": "#000000" } ] },{ "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "color": "#000000" }, { "visibility": "off" } ] },{ "featureType": "transit", "stylers": [ { "visibility": "off" } ] },{ "featureType": "administrative.neighborhood", "elementType": "labels.text.fill", "stylers": [ { "color": "#000000" } ] },{ "featureType": "administrative.neighborhood", "elementType": "labels.text.stroke", "stylers": [ { "color": "#ffffff" } ] },{ "featureType": "landscape.man_made", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" }, { "color": "#bab8bb" } ] },{ "featureType": "road.local", "elementType": "geometry.fill" },{ "featureType": "road.local", "elementType": "geometry.stroke", "stylers": [ { "weight": 1.2 } ] },{ "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ] } ];
  var featureOpts = [];
  var mapOptions = {
    zoom: 16,
    center: adjmi,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
    },
    mapTypeId: MY_MAPTYPE_ID
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  
  var image = '<?php bloginfo('template_directory'); ?>/images/marker.png';
  var ma_marker = new google.maps.LatLng(41.203914, -73.644393);
  var beachMarker = new google.maps.Marker({
      position: ma_marker,
      map: map,
      icon: image
  });

  
  
  var styledMapOptions = {
    name: 'Custom Style'
  };

  var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

  map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <div id="map-canvas"></div>
<!-- END GOOGLE MAP CODE -->
      
      </div>
      <div id="mobileMap"><a href="https://goo.gl/maps/4veKj" target="_blank"><?php echo get_the_post_thumbnail(); ?></a></div>
    </div>
  </section>
  
<?php 
endwhile;
endif;
get_footer(); ?>