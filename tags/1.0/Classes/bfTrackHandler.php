<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of bfTrackHandler
 * track related functions are written here
 *
 * @author kiran
 */
class bfTrackHandler {
    //put your code here
    var $isGameCenterEnabled;
    var $artworkUrl60;
    var $artistViewUrl;
    var $artworkUrl512;
    var $artistId;
    var $artistName;
    var $price;
    var $version;
    var $description;
    var $releaseDate;
    var $sellerName;
    var $currency;
    var $trackId;
    var $trackName;
    var $bundleId;
    var $primaryGenreName;
    var $releaseNotes;
    var $primaryGenreId;
    var $wrapperType;
    var $artworkUrl100;
    var $contentAdvisoryRating;
    var $trackCensoredName;
    var $trackViewUrl;
    var $fileSizeBytes;
    var $averageUserRatingForCurrentVersion;
    var $userRatingCountForCurrentVersion;
    var $trackContentRating;
    var $averageUserRating;
    var $userRatingCount;

    public function getTrackInfo($trackId){
        return true;
    }

}
?>
