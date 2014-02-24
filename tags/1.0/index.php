<?php

require_once 'Config/config.php';
require_once CLASS_PATH.'/DBHandler.php';
require_once CLASS_PATH.'/TrackHandler.php';

$appid = $_GET['appid'];
//echo "<br> TESTING apple api response";

//http://itunes.apple.com/lookup?id=284910350
$uid = $_GET['uid'];
if(isset ($uid)) {
    echo $uid." ".$appid;
    markInstall($uid,$appid);
    echo "success";
}
else {
    $req = "http://itunes.apple.com/lookup?id=".$appid;

    $ch = curl_init($req);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
//echo json_encode($result);

    $jdecode = json_decode($data,TRUE);
//echo "<pre>";
//print_r($jdecode);
//echo "</pre>";

    storeResult($jdecode);



//echo "<br> redirecting to ".$jdecode['results'][0]['trackViewUrl'];
    header("Location: http://click.linksynergy.com/fs-bin/stat?id=unD1DgKKAwc&offerid=146261&type=3&subid=0&tmpid=1826&RD_PARM1=".urlencode($jdecode['results'][0]['trackViewUrl']));
    exit;
}
?>
