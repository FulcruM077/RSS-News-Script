<?
require_once('app/fulcrum.php');
$news = $feeder->getNews('30', $_GET['lang']);
require_once('theme/header.php');
require_once('theme/sidebar.php');
require_once('theme/home.php');
require_once('theme/footer.php');
