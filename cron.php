<?
require_once('app/fulcrum.php');
$sources = $feeder->allFeeds();

foreach($sources as $source){
	$feeder->getFeed($source['url'], $source['title'], $source['category']);
}