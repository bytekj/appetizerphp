<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'db.php';
require_once 'config.php';
require_once 'trackHandler.php';
require_once 'appstore.php';

$trackId = $_GET['trackId'];

try {
    $trackExist = checkTrackExists($trackId);
    if($_GET['debug'] == 1) {
        echo "Track exists ".$trackExist;
    }
    
    if($trackExist == '1') {
        echo "Track exists ".$trackExist;
        removeTrack($trackId);
        echo "<br/> Track Removed";
    }

/*     if($trackExist == '0') */
    {
        $jdecode = getAppStoreTrackInfo($trackId);
        storeResult($jdecode);
    }

    $sql = "insert into staff_picks (trackId) values('".$trackId."')";
    db_putdata($sql);
    echo "<br/>success Track Added";
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

?>
