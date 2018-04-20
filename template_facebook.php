<?php
/* Template Name: Facebook Feed */
get_header();
$timestamp = date('U');
$filename = get_template_directory()."/facebook.json";
$data = file_get_contents($filename);
$cache = json_decode($data,true);

if( ($timestamp-$cache['timestamp']) < 1800) {
  $postArray = $cache['postArray'];
} else {
	require_once('inc/facebook.php');
	$config = array();
	$config['appId'] = '452741141490790';
	$config['secret'] = 'b54608a216a50857d8281d19c060d419';
	$config['fileUpload'] = false;

	$facebook = new Facebook($config);
	$pageid = get_field('pageID');

	$pagephotos = $facebook->api("/" . $pageid . "/photos/uploaded");
	$pagefeed = $facebook->api("/" . $pageid . "/posts");

	/*** GET PHOTOS ***/
	$photoArray = array();
	$targetWidth = 363;
	foreach($pagephotos['data'] as $photo) {
	  $id = $photo['id'];
	  $width = INF;
	  $largest = 0;
	  foreach($photo['images'] as $key => $image) {
		if($image['width'] > $targetWidth && $image['width'] < $width) {
		  $width = $image['width'];
		  $w = $key;
		}
		if($image['width'] > $largest) { $largest = $image['width']; $l = $key; }
		if($width == INF) {  $width = $largest; $w = $l; }
	  }
	  $photoArray[$id] = $photo['images'][$w]['source'];
	}

	/*** GET POSTS ***/
	$postArray = array();
	foreach($pagefeed['data'] as $post) {

	  if(is_array($post['shares'])) {
		$shares = $post['shares']['count'];
	  } else {
		$shares = 0;
	  }

	  if($post['type'] == 'status' && isset($post['message'])) {
		$postArray[] = array(
		  'message' => $post['message'],
		  'likes' => sizeof($post['likes']['data']),
		  'comments' => sizeof($post['comments']['data']),
		  'shares' => $shares,
		  'link' => $post['link'],
		  'type' => 'status'
		);
	  } else if($post['type'] == 'photo') {
		$postArray[] = array(
		  'message' => $post['message'],
		  'photo' => $photoArray[$post['object_id']],
		  'likes' => sizeof($post['likes']['data']),
		  'comments' => sizeof($post['comments']['data']),
		  'shares' => $shares,
		  'link' => $post['link'],
		  'type' => 'photo'
		);
	  }
	}
	
	$json = json_encode(array(
	    'timestamp' => $timestamp,
	    'postArray' => $postArray
	  )
	);
	file_put_contents($filename, $json);
}
 ?>
  <section id="inspiration">
    <div class="cards">
<?php foreach($postArray as $post) { ?>
      <div class="card">
<?php if($post['type'] == 'photo') { ?>
        <a href="<?php echo $post['link']; ?>" target="ckfb"><img src="<?php echo $post['photo']; ?>"></a>
<?php } ?>
        <div class="cardInfo">
          <p><?php 
          $msg =  ereg_replace(
              "~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~",
              "<a href=\"\\0\">\\0</a>", 
              $post['message']); 
          echo $msg; ?></p>
          <ul class="likes">
            <li class="likes"><span>Likes: </span><?php echo $post['likes']; ?></li>
            <li class="shares"><span>Shares: </span><?php echo $post['shares']; ?></li>
            <li class="comments"><span>Comments: </span><?php echo $post['comments']; ?></li>
          </ul>
          <p class="links"><a href="<?php echo $post['link']; ?>" target="ckfb">View on Facebook</a></p>
        </div>
      </div>
<?php } ?>
    </div>
  </section>
<?php get_footer(); ?>