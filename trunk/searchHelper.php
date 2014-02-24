<?php

require_once 'config.php';
require_once 'db.php';
require_once 'trackHandler.php';


if ($_GET['query']) {
    $query = $_GET['query'];
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */


    $sql = "select trackName from tracks where trackName like '" . $query . "%' or trackName like '% " . $query . "%'";
    $res = db_getdata($sql);

    $len = sizeof($res);

    while ($len) {

        //echo "<br>len: ".$len.">>> ".$res[$len-1]['trackId'];
        $result['results'][] = $res[$len - 1][trackName];
        $len--;
    }

    $res1 = json_encode($result);

    echo $res1;
} else {
    echo "invalid request";
}
?>
