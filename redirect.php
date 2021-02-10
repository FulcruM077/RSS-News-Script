<?
require_once('app/fulcrum.php');

# Get post details
$post = $feeder->getPost($_GET['hash']);

foreach($post as $item){
	# Update hit of post
	$feeder->hitCount($item['hash']);

	# Redirect
	header("Location:" . $item['url']);
}