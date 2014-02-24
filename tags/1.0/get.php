<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Classes/bfTrackHandler.php';
require_once 'Classes/bfTrackDataHandler.php';
require_once 'Classes/bfCommandHandler.php';

require_once 'DB/bfDBHandler.php';

$appid = $_GET['appid'];

$objCommandHandler = new bfCommandHandler();
$objCommandHandler->setCommandType("TRACKINFO");
$objCommandHandler->setRequestType("GET");
$objCommandHandler->setAppId($appid);
$objCommandHandler->setResponseType('json');
$result = $objCommandHandler->processCommand();
echo "<pre>";
print_r($result);
echo "<pre>";

?>
