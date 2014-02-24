<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of DBHandler
 *
 * @author kiran
 */
class bfDBHandler {
    //put your code here
    
    private static function getUserName() {
        return "buyhlin1_kj";
    }
    private static function getPassword() {
        return "kirAn6";
    }
    private static function getDatabase() {
        return "buyhlin1_bytefeast";
    }

    private function connect() {
        $link = mysql_connect(localhost, bfDBHandler::getUserName(), bfDBHandler::getPassword());
        if(!$link) {
            die('Could not connect :'. mysql_error());
        }
        else {
            mysql_select_db(bfDBHandler::getDatabase());
        }
        return $link;
    }

    private function Disconnect($link) {
        mysql_close($link);
    }

    public function GetQuery($sql) {

        try {
            $link = $this->connect();
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
            $this->Disconnect($link);
            return $result_set;
        }
        catch(Exception $e) {
            echo "<pre>";
            print_r($e);
            echo "</pre>";
        }
    }

    public function PutQuery($sql) {
        $link = $this->connect();

        try {
            $res = mysql_query($sql);
            $this->Disconnect($link);
            return $res;
        }
        catch(Exception $e) {
            echo "<pre>";
            print_r($e);
            echo "</pre>";

        }
    }
}
?>
