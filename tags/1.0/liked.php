<?php
require_once 'db.php';
require_once 'config.php';
require_once 'trackHandler.php';

try {
    $uid = $_GET['uid'];

    $sql = "select trackId from likes where uid='".$uid."'";
    $res = db_getdata($sql);

    $len = sizeof($res);
    
    $result['resultCount'] = $len;
    while($len) {

        //echo "<br>len: ".$len.">>> ".$res[$len-1]['trackId'];
        $result['results'][] = getTrackInfo($res[$len-1]['trackId']);
        $len--;
    }
    if($_GET['debug'] == 1) {
        echo "<pre>";
        print_r(json_encode($result));
        echo "</pre>";
        echo json_last_error();
    }
    echo json_encode($result);
} catch (Exception $exc) {
    echo "kk";
    echo $exc->getTraceAsString();
}

?>