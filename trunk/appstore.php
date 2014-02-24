<?php

function getAppStoreTrackInfo($appid) {
	// get app info and store
	//http://itunes.apple.com/lookup?id=284910350
	$url = "http://itunes.apple.com/lookup?id=".$appid;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch);
	curl_close($ch);
	$jdecode = json_decode($data,TRUE);
	return $jdecode;
}


?>