<?
# Require config
require_once('config.php');

# Establish Database connection
$db = new mysqli (DB_HOST, DB_USER, DB_PASS, DB_NAME);
global $db;

if(mysqli_connect_errno()) {
	echo "Cannot connect to the database. Error: " . mysqli_connect_errno();
	exit();
}

# Require Feeder Class file
require_once('feeder.class.php');

# Feeder variable for ease of use.
$feeder = new \FulcruM\Feeder();

$langList = Array('tr', 'en');

$lang = isset($_GET['lang']) ? (in_array($_GET['lang'], $langList) ? $_GET['lang'] : DEFAULT_LANG) : (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : DEFAULT_LANG);

if(empty($_GET['lang'])){
	header('Location: /' . $lang .'/');
}

if(!in_array($_GET['lang'], $langList)) {
	header('Location: /' . $lang .'/');
}