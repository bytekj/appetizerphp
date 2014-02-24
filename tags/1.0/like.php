<?php
require_once 'db.php';
require_once 'config.php';
require_once 'trackHandler.php';

$trackId = $_GET['trackId'];

$uid = $_GET['uid'];

try {
    $trackExist = checkTrackExists($trackId);
    if($_GET['debug'] == 1) {
        echo "<BR>>>>>".$trackExist;

    }
    if($trackExist == '0') {
    
        $req = "http://itunes.apple.com/lookup?id=".$trackId;

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
    }

    $sql = "insert into likes (trackId, uid) values('".$trackId."','".$uid."')";
    db_putdata($sql);
    $sql = "insert into users (fbid) values('".$uid."')";
    db_putdata($sql);
    //}
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}


?>

