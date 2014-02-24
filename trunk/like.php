<?php
require_once 'db.php';
require_once 'config.php';
require_once 'trackHandler.php';
require_once 'appstore.php';

$trackId = $_GET['trackId'];

$uid = $_GET['uid'];

try {
    $trackExist = checkTrackExists($trackId);
    if($_GET['debug'] == 1) {
        echo "<BR>>>>>".$trackExist;

    }
    if($trackExist == '0') {
	    $jdecode = getAppStoreTrackInfo($trackId);
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

