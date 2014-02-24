<?php
require_once 'db.php';
require_once 'config.php';
require_once 'trackHandler.php';

try {
	$offset = $_GET['o'];
	$limit = $_GET['l'];
	if (is_null($offset)) {
	    echo "No offset";
	}
	if (is_null($limit)) {
	    echo "No limit";
	    exit;
	}

    $uid = $_GET['uid'];

    $sql = "select trackId from wishlist where uid='".$uid."'"." ORDER BY id DESC limit ".$offset.",".$limit;
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