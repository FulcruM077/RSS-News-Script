<?
namespace FulcruM;

class Feeder {

	# Get feed content and record it to database
	public function getFeed($feed_url, $feed_title, $feed_category)
	{
        global $db; 
	    $content = file_get_contents($feed_url);
	    $x = new \SimpleXmlElement($content);
	     
	    foreach($x->channel->item as $entry) {
	    	# Hash and shorten feed post url to avoid double posting.
	    	$hash = substr(md5($entry->link), 0, 15);
	    	$published = date('Y-m-d H:i:s', strtotime($entry->pubDate));

	    	if($this->checkPost($hash)) {
	    		if($this->checkDate($published)){
					$stmt = $db->prepare("INSERT INTO posts (
						hash,
						title,
						url,
						lang,
						category,
						published,
						source
						) VALUES (
						?,
						?,
						?,
						?,
						?,
						?,
						?
						)");
					$stmt->bind_param("sssssss", $hash, $title, $url, $lang, $feed_category, $published, $feed_title);
						$title = $entry->title;
						$url = $entry->link;
						$lang = substr($x->channel->language, 0, 2);
					$stmt->execute();
					$stmt->close();
				}
			}
	    }
	}

	# Check post hash if we included that post before to avoid double posting.
	public function checkPost($hash)
	{
		global $db;
		$stmt = $db->prepare("SELECT
			hash
			FROM posts
			WHERE hash = ?");
		$stmt->bind_param("s", $hash);
		$stmt->execute();
		$stmt->store_result();
		$count = $stmt->num_rows;
		$stmt->close();
			if($count > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	# Check post date for posts without a proper date
	public function checkDate($date)
	{
		global $db;
		if(empty($date)) {
			return FALSE;
		}
		if($date < "2016-01-01 00:00:00"){
			return FALSE;
		}
		else {
			return TRUE;
		}
	}

	# Get all feeds from database so we can process them
	public function allFeeds()
	{
		global $db;
		$stmt = $db->prepare("SELECT
			title,
			url,
			lang,
			category
			FROM feeds");
		$stmt->execute();
		$stmt->bind_result($title, $url, $lang, $category);
	          while ($stmt->fetch()){
	            $row[] = array('title' => $title, 'url' => $url, 'lang' => $lang, 'category' => $category);
	            }
	        $stmt->close();
	        if(!empty($row)) {
	        return($row); }
	}

	# Remove unwanted chars from urls, you can edit this section to optimize different languages
	public function permalink($string)
  	{
	  	$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '-');
	  	$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '');
	  	$string = strtolower(str_replace($find, $replace, $string));
	  	$string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
	  	$string = trim(preg_replace('/\s+/', ' ', $string));
	  	$string = str_replace(' ', '-', $string);
	  	return $string;
  	}

  	# Get News for front page
	public function getNews($limit, $lang)
	{
	  global $db;
	    $stmt = $db->prepare("SELECT 
	        id,
	        hash,
	        title,
	        url,
	        lang,
	        category,
	        published,
	        source,
	        hit
	        FROM posts WHERE lang = ? ORDER BY published DESC LIMIT " . $limit);
	    $stmt->bind_param("s", $lang);
	    $stmt->execute();
	    $stmt->bind_result($id, $hash, $title, $url, $lang, $category, $published, $source, $hit);
	        while ($stmt->fetch())
	        {
	          $row[] = array('id' => $id, 'hash' => $hash, 'title' => $title, 'url' => $url, 'lang' => $lang, 'category' => $category, 'published' => $published, 'source' => $source, 'hit' => $hit);
	        }
	    $stmt->close();
	    if(!empty($row)) {
	    return($row); }
	}

	# Get post for redirect
	public function getPost($hash)
	{
	  global $db;
	    $stmt = $db->prepare("SELECT 
	        id,
	        hash,
	        title,
	        url,
	        lang,
	        category,
	        published,
	        source,
	        hit
	        FROM posts WHERE hash = ?");
	    $stmt->bind_param("s", $hash);
	    $stmt->execute();
	    $stmt->bind_result($id, $hash, $title, $url, $lang, $category, $published, $source, $hit);
	        while ($stmt->fetch())
	        {
	          $row[] = array('id' => $id, 'hash' => $hash, 'title' => $title, 'url' => $url, 'lang' => $lang, 'category' => $category, 'published' => $published, 'source' => $source, 'hit' => $hit);
	        }
	    $stmt->close();
	    if(!empty($row)) {
	    return($row); }
	}

	# Get category posts
	public function getCat($category, $lang)
	{
	  global $db;
	    $stmt = $db->prepare("SELECT 
	        id,
	        hash,
	        title,
	        url,
	        lang,
	        category,
	        published,
	        source,
	        hit
	        FROM posts WHERE category = ? AND lang = ? ORDER BY published DESC LIMIT 30");
	    $stmt->bind_param("ss", $category, $lang);
	    $stmt->execute();
	    $stmt->bind_result($id, $hash, $title, $url, $lang, $category, $published, $source, $hit);
	        while ($stmt->fetch())
	        {
	          $row[] = array('id' => $id, 'hash' => $hash, 'title' => $title, 'url' => $url, 'lang' => $lang, 'category' => $category, 'published' => $published, 'source' => $source, 'hit' => $hit);
	        }
	    $stmt->close();
	    if(!empty($row)) {
	    return($row); }
	}

	# Get categories
	public function getCats($lang)
	{
	  global $db;
	    $stmt = $db->prepare("SELECT 
	        id,
	        title,
	        text,
	        slug,
	        lang
	        FROM cats WHERE lang = ? ORDER BY title ASC");
	    $stmt->bind_param("s", $lang);
	    $stmt->execute();
	    $stmt->bind_result($id, $title, $text, $slug, $lang);
	        while ($stmt->fetch())
	        {
	          $row[] = array('id' => $id, 'title' => $title, 'text' => $text, 'slug' => $slug, 'lang' => $lang);
	        }
	    $stmt->close();
	    if(!empty($row)) {
	    return($row); }
	}

	# Count the hits for redirects
	public function hitCount($hash)
	{
		global $db;
		$stmt = $db->prepare("UPDATE posts SET
			hit = hit+1
			WHERE hash = ?");
		$stmt->bind_param("s", $hash);
		$stmt->execute();
		$stmt->close();
	}

	# Get popular news by hit with a limit you desire
	public function popularNews($limit, $lang)
	{
		global $db;
		$stmt = $db->prepare("SELECT
			id,
			hash,
			title,
			url,
			lang,
			category,
			published,
			source,
			hit
			FROM posts WHERE published >= DATE(NOW()) - INTERVAL 1 DAY AND lang = ? ORDER BY hit DESC LIMIT " . $limit);
		$stmt->bind_param("s", $lang);
		$stmt->execute();
		$stmt->bind_result($id, $hash, $title, $url, $lang, $category, $published, $source, $hit);
	        while ($stmt->fetch())
	        {
	          $row[] = array('id' => $id, 'hash' => $hash, 'title' => $title, 'url' => $url, 'lang' => $lang, 'category' => $category, 'published' => $published, 'source' => $source, 'hit' => $hit);
	        }
	    $stmt->close();
	    if(!empty($row)) {
	    return($row); }
	}
}