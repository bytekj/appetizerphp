<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * api isStaffPick.php
 */
require_once 'db.php';
require_once 'config.php';


$appid = $_GET['trackId'];

if(isset($appid)){
    if(is_staff_pick($appid) == -1){
        echo 0;
    }
    else{
        echo 1;
    }
}

function is_staff_pick($appid){
    $sql = "select trackId from staff_picks where trackId='".$appid."'";
    
    return db_getdata($sql);;
}

?>
