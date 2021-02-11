# RSS-News-Script
Basic RSS news script. Gets news titles and URL's from the Feeds you added to the database. Redirect page got a timer so you can show advertisements there.

# Supports multi-language
You need to set Feed language at database to stop mix-ups. Script gets user language and tries to match it with the languages defined to system. If no defined language
matches the browser language it redirects to default langugae.

# Setting up database
You need to add feeds to the database from PhpMyadmin

INSERT INTO `cats` (`id`, `title`, `text`, `slug`, `lang`) VALUES (ID, 'Category Title', 'Category Description', 'category-slug', 'language as en/de/ru/tr');

# Setting up default languages

open app/config.php and edit the line below

define('DEFAULT_LANG', 'en'); 

# Setting up the available languages

open app/fulccrum.php and edit the line below

$langList = Array('tr', 'en');
