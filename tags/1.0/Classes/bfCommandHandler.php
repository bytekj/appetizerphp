<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of bfCommandHandler
 * All the api's are converted to request objects here
 *
 * @author kiran
 */
class bfCommandHandler {
    //put your code here
    var $CommandType; //user or track related command
    var $RequestType; //get or set

    var $RequestData;
    var $ResponseData;

    var $Offset;
    var $Limit;
    var $AppId;
    var $UID;

    var $ResponseType;


    //this is set to 1 if api needs debugging
    var $debug;

    var $error;


    public function setCommandType($commandType) {
        $this->CommandType = $commandType;
    }

    public function setRequestType($requestType) {
        $this->RequestType = $requestType;
    }

    public function setRequestData($requestData) {
        $this->RequestData = $requestData;
    }

    public function setResponseType($type) {
        switch($type) {
            case 'json' :
                $this->ResponseType = $type;
                break;
            default :
                $this->error = "wrong response type";
                $this->processCommandError();
                break;

        }
    }
    public function setResponseData($responseData) {
        $this->ResponseData = $responseData;
    }

    public function setOffset($offset) {
        $this->Offset = $offset;
    }

    public function setLimit($limit) {
        $this->Limit = $limit;
    }

    public function setAppId($appid) {
        $this->AppId = $appid;
    }

    public function setUID($uid) {
        $this->UID = $uid;
    }

    public function processCommand() {
        switch($this->RequestType) {
            case "GET" :
            //handle get command
                $this->processGetCommand();
                break;
            case "SET" :
                $this->processSetCommand();
                break;
            default:
                $this->processCommandError();
        }

    }

    private function processGetCommand() {
        switch($this->CommandType) {
            case "TRACKINFO" : {
                    //get track info
                    $objTrackHandler = new bfTrackHandler();
                    $objTrackHandler->getTrackInfo($this->AppId);
                    

                    break;

                }
            default :
                $this->processCommandError();

        }
        //process get type commands
    }

    private function processSetCommand() {
        //process set type command
    }

    private function processCommandError() {
        //handle errors here
    }
}
?>
