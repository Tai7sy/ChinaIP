# ChinaIP
A PHP class that can help you determine if it is a Chinese IP address


Your can use it like this:
```php
include_once('class.chinaip.php');
$chinaip = new chinaip();
if($chinaip->inChina($ip))
{
	//do something
}
```

The 'class.chinaip.db.update.php' could update the ip database from [apnic.net](http://ftp.apnic.net/apnic/stats/apnic/delegated-apnic-latest)