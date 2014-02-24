<?php

require_once 'config.php';
require_once 'db.php';
require_once 'trackHandler.php';
require_once 'appstore.php';

function curPageURL() {
  $pageURL = 'http://';
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }
  return $pageURL;
}

function getReferralLink($trackViewUrl) {
	$rec = geoip_record_by_name($_SERVER['REMOTE_ADDR']);
	$country_flag=0;
	$program_id = 0;
	
	switch($rec['country_code']){
		case 'AT':
			$program_id = 24380;
			$country_flag = 1;
		break;
		case 'BE':
			$program_id = 24379;
			$country_flag = 1;
		break;
		case 'CH':
			$program_id = 24372;
			$country_flag = 1;
		break;
		case 'DE':
			$program_id = 23761;
			$country_flag = 1;
		break;
		case 'DK':
			$program_id = 24375;
			$country_flag = 1;
		break;
		case 'ES':
			$program_id = 24364;
			$country_flag = 1;
		break;
		case 'FI':
			$program_id = 24366;
			$country_flag = 1;
		break;
		case 'FR':
			$program_id = 23753;
			$country_flag = 1;
		break;
		case 'GB':
			$program_id = 23708;
			$country_flag = 1;
		break;
		case 'IE':
			$program_id = 24367;
			$country_flag = 1;
		break;
		case 'IT':
			$program_id = 24373;
			$country_flag = 1;
		break;
		case 'NL':
			$program_id = 24371;
			$country_flag = 1;
		break;
		case 'NO': 
			$program_id = 24369;
			$country_flag = 1;
		break;
		case 'SE':
			$program_id = 23762;
			$country_flag = 1;
		break;
		case 'US':
			$country_flag = 2;
		break;
	}
	if($country_flag == 2 | $country_flag == 0){
		$location = "http://click.linksynergy.com/fs-bin/stat?id=unD1DgKKAwc&offerid=146261&type=3&subid=0&tmpid=1826&RD_PARM1=".urlencode($trackViewUrl)."%2526partnerId%253D30";
	}
	else if($country_flag == 1){
		$location = "http://clk.tradedoubler.com/click?p=".$program_id."&a=2112071&url=".urlencode($trackViewUrl)."&partnerId=2003";
	}
	if($_GET['debug'] == 1){
		echo "<pre>";
		print_r($rec);
		echo "</pre>";
		echo $location;
		exit();
	}
	
	return $location;
}

$appid = $_GET['appid'];
$uid = $_GET['uid'];
$appInfo = getTrackInfo($appid);

if (is_null($appInfo)) {
   $jdecode = getAppStoreTrackInfo($appid);
	storeResult($jdecode);
    $appInfo = getTrackInfo($appid);
}

if (is_null($appInfo)) {
	header("Location: http://appetizerapp.in");
	exit;
}

$title = $appInfo['trackCensoredName'];
$url = getReferralLink($appInfo['trackViewUrl']);

if(isset ($uid)) {
	markInstall($uid,$appid);
	header("Location: ".$url);
	exit;
}

echo "<html>";
echo "<head prefix=\"og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# appetizerapp: http://ogp.me/ns/fb/appetizerapp#\">";
echo "<meta property=\"fb:app_id\" content=\"259908017410928\" />"; 
echo "<meta property=\"og:type\"   content=\"appetizerapp:app\" />";
echo "<meta property=\"og:url\"    content=".strip_tags(curPageURL())." />";
echo "<meta property=\"og:description\" content=\"Get ".$title." on the App Store. See screenshots and ratings, and read customer reviews.\" />";
echo "<meta property=\"og:image\"  content=\"".$appInfo['artworkUrl100']."\" />";
echo "<meta property=\"og:title\"  content=\"".$title."\" />";
echo "<meta property=\"appetizerapp:track_id\" content=\"".$appid."\" />";
echo "<meta property=\"appetizerapp:primary_genre_name\" content=\"".$appInfo['primaryGenreName']."\" />";
echo "<title>Appetizer - ".$title."</title>";
echo "</head>";
echo "<body><iframe src=\"".$url."\" style=\"border: 0; position:fixed; top:0; left:0; right:0; bottom:0; width:100%; height:100%;\"></iframe></body>";
echo "</html>";

?>
