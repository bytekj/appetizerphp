<?php

require_once 'config.php';
require_once 'db.php';
require_once 'trackHandler.php';


if ($_GET['genre']) {
    $genre = $_GET['genre'];
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */


    $sql = "select trackId from tracks where primaryGenreId like '" . $genre . "'";
    $res = db_getdata($sql);



    $len = sizeof($res);

    $result['resultCount'] = $len;
    while ($len) {

        //echo "<br>len: ".$len.">>> ".$res[$len-1]['trackId'];
        $result['results'][] = getTrackInfo($res[$len - 1]['trackId']);
        $len--;
    }

    $res1 = json_encode($result);

    echo $res1;
} else {
    echo "invalid request";
}
?>
