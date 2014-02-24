<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'config.php';
require_once 'db.php';
require_once 'trackHandler.php';

$offset = $_GET['o'];
$limit = $_GET['l'];
if (is_null($offset)) {
    echo "No offset";
}
if (is_null($limit)) {
    echo "No limit";
    exit;
}
$sql = "SELECT trackId from staff_picks ORDER BY id DESC limit ".$offset.",".$limit;
if($_GET['debug'] == 1) {
    echo "<br>>>>> ".$sql;
}
$res = db_getdata($sql);
if($res <> -1) {
    if($_GET['debug'] == 1) {
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }
    $len=sizeof($res);
    $result['resultCount'] = $len;
    $i=0;
    while($len) {
        if($_GET['debug'] == 1) {
            echo "<pre>";
            print_r($res[$i]);
            echo "</pre>";
        }
        $result['results'][] = getTrackInfo($res[$i]['trackId']);
        $result['results'][$i]['bflikes'] = $res[$i]['likes'];
        $i++;
        $len--;
    }
    echo json_encode($result);
}
else {
    echo "No donut for you!";
}

?>
