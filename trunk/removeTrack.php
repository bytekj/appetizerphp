<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'db.php';
require_once 'config.php';
require_once 'trackHandler.php';

$trackId = $_GET['trackId'];

try {
    $trackExist = checkTrackExists($trackId);
    
    if($trackExist == '1') {
        echo "Track exists ".$trackExist;
        removeTrack($trackId);
        echo "<br/> Track Removed";
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

?>
