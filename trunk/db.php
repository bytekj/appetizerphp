<?php

require_once("config.php");

function db_connect() {
    global $username;
    global $password;
    global $database;
    //echo "username: ".$username."<br>pass: ".$password."<br>";
    $link = mysql_connect(localhost, $username, $password);
    if(!$link) {
        //echo "hurrey";

        die('Could not connect :'. mysql_error());
    }
    else {
        mysql_select_db($database);
    }
    return $link;
}
function db_disconnect($link) {
    mysql_close($link);
}
function db_getdata($sql) {
    $link = db_connect();
    try {
        $result_set = "";
        $cnt = 0;
        $result = mysql_query($sql);
        if(mysql_affected_rows($link)) {
            while($row = mysql_fetch_assoc($result)) {
                $result_set[$cnt] = $row;
                $cnt++;
            }
        }
        else {
            $result_set = -1;
        }
        return $result_set;
    }
    catch(Exception $e) {
        echo "<pre>";
        print_r($e);
        echo "</pre>";
    }
    db_disconnect($link);
}
function db_putdata($sql) {
    $link = db_connect();

    try {
        return mysql_query($sql);
    }
    catch(Exception $e) {
        echo "<pre>";
        print_r($e);
        echo "</pre>";
    }
}

?>
