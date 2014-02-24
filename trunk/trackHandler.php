<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
function markInstall($uid,$appid){
    $sql = "INSERT INTO `buyhlin1_bytefeast`.`unser_installs` (`trackId`, `uid`) 
        VALUES ('".$appid."', '".$uid."');";

    db_putdata($sql);

    return true;
}

function escapeChars($string) {
    $s1 = str_replace("'", "\'", $string);
    $s2 = str_replace("\"", "\\\"", $s1);
    return $s2;
}
function storeResult($decodedjson) {

    try {
        storeTrack($decodedjson['results'][0]);
    } catch (Exception $exc) {
        $exc->getTraceAsString();
    }

}
function storeTrack($track) {
    $sql = "insert into tracks (kind,
                    isGameCenterEnabled,
                    artworkUrl60,
                    artistViewUrl,
                    artworkUrl512,
                    artistId,
                    artistName,
                    price,
                    version,
                    description,
                    releaseDate,
                    sellerName,
                    currency,
                    trackId,
                    trackName,
                    bundleId,
                    primaryGenreName,
                    releaseNotes,
                    primaryGenreId,
                    wrapperType,
                    artworkUrl100,
                    contentAdvisoryRating,
                    trackCensoredName,
                    trackViewUrl,
                    fileSizeBytes,
                    averageUserRatingForCurrentVersion,
                    userRatingCountForCurrentVersion,
                    trackContentRating,
                    averageUserRating,
                    userRatingCount)
            values('".
            escapeChars($track['kind'])."','".
            escapeChars($track['isGameCenterEnabled'])."','".
            escapeChars($track['artworkUrl60'])."','".
            escapeChars($track['artistViewUrl'])."','".
            escapeChars($track['artworkUrl512'])."','".
            escapeChars($track['artistId'])."','".
            escapeChars($track['artistName'])."','".
            escapeChars($track['price'])."','".
            escapeChars($track['version'])."','".
            escapeChars($track['description'])."','".
            escapeChars($track['releaseDate'])."','".
            escapeChars($track['sellerName'])."','".
            escapeChars($track['currency'])."','".
            escapeChars($track['trackId'])."','".
            escapeChars($track['trackName'])."','".
            escapeChars($track['bundleId'])."','".
            escapeChars($track['primaryGenreName'])."','".
            escapeChars($track['releaseNotes'])."','".
            escapeChars($track['primaryGenreId'])."','".
            escapeChars($track['wrapperType'])."','".
            escapeChars($track['artworkUrl100'])."','".
            escapeChars($track['contentAdvisoryRating'])."','".
            escapeChars($track['trackCensoredName'])."','".
            escapeChars($track['trackViewUrl'])."','".
            escapeChars($track['fileSizeBytes'])."','".
            escapeChars($track['averageUserRatingForCurrentVersion'])."','".
            escapeChars($track['userRatingCountForCurrentVersion'])."','".
            escapeChars($track['trackContentRating'])."','".
            escapeChars($track['averageUserRating'])."','".
            escapeChars($track['userRatingCount'])."')";


    db_putdata($sql);

    storeFeatures($track['trackId'],$track['features']);
    storeGenre($track['trackId'], $track['genres']);
    storeGenreIds($track['trackId'],$track['genreIds']);
    storeIpadScreenshotUrls($track['trackId'], $track['ipadScreenshotUrls']);
    storeLanguageCodes($track['trackId'], $track['languageCodesISO2A']);
    storeScreenshotUrls($track['trackId'], $track['screenshotUrls']);
    storeSupportedDevices($track['trackId'], $track['supportedDevices']);

}

function storeFeatures($trackId,$Features) {
    $len = sizeof($Features);
    for($i = 0;$i < $len;$i++) {
        $sql = "insert into features(trackId,features)
            values('".$trackId."','".$Features[$i]."')";
        db_putdata($sql);
    }

}

function storeGenreIds($trackId,$GenreIds) {
    $len = sizeof($GenreIds);
    for($i = 0;$i < $len;$i++) {
        $sql = "insert into genreIds(trackId,genreId)
            values('".$trackId."','".$GenreIds[$i]."')";
        db_putdata($sql);
    }

}

function storeGenre($trackId, $genre) {
    $len = sizeof($genre);
    for($i = 0;$i < $len;$i++) {
        $sql = "insert into genres(trackId,genre)
            values('".$trackId."','".$genre[$i]."')";
        db_putdata($sql);
    }

}

function storeIpadScreenshotUrls($trackId,$ipadScreenshotUrls) {
    $len = sizeof($ipadScreenshotUrls);
    for($i = 0;$i < $len;$i++) {
        $sql = "insert into ipadScreenshotUrls(trackId,ipadScreenshotUrl)
            values('".$trackId."','".$ipadScreenshotUrls[$i]."')";
        db_putdata($sql);
    }

}

function storeScreenshotUrls($trackId,$scheenhotUrls) {
    $len = sizeof($scheenhotUrls);
    for($i = 0;$i < $len;$i++) {
        $sql = "insert into screenshotUrls(trackId,screenshotUrl)
            values('".$trackId."','".$scheenhotUrls[$i]."')";
        db_putdata($sql);
    }

    return true;
}

function storeSupportedDevices($trackId,$supportedDevices) {
    $len = sizeof($supportedDevices);
    for($i = 0;$i < $len;$i++) {
        $sql = "insert into supportedDevices(trackId,supportedDevices)
            values('".$trackId."','".$supportedDevices[$i]."')";
        db_putdata($sql);
    }

    return true;
}

function storeLanguageCodes($trackId,$langCodes) {
    $len = sizeof($langCodes);
    for($i = 0;$i < $len;$i++) {
        $sql = "insert into languageCodesISO2A(trackId,languageCode)
            values('".$trackId."','".$langCodes[$i]."')";
        db_putdata($sql);
    }

    return true;
}

function getTrackInfo($trackId) {
    if($_GET['debug'] == 1) {
        echo "<br>>>>>>".$trackId;
    }
    try {
        $trackInfo = getTrack($trackId);

        //$trackInfo['features'] = getTrackFeatures($trackId);

        //$trackInfo['genres'] = getTrackGenre($trackId);

        //$trackInfo['ipadScreenshotUrls'] = getTrackipadScreenshots($trackId);

        //$trackInfo['languageCode'] = getTrackLanguageCodes($trackId);

        //$trackInfo['screenshotUrls'] = getTrackScreenShotUrls($trackId);

        //$trackInfo['supportedDevices'] = getTrackSupportedDevices($trackId);


        return $trackInfo;
    } catch (Exception $exc) {

        echo $exc->getTraceAsString();
    }

}
function getTrack($trackId) {
/*
    $trackInfoSql = "select
                    kind,
                    isGameCenterEnabled,
                    artworkUrl60,
                    artistViewUrl,
                    artworkUrl512,
                    artistId,
                    artistName,
                    price,
                    version,
                    description,
                    releaseDate,
                    sellerName,
                    currency,
                    trackId,
                    trackName,
                    bundleId,
                    primaryGenreName,
                    releaseNotes,
                    primaryGenreId,
                    wrapperType,
                    artworkUrl100,
                    contentAdvisoryRating,
                    trackCensoredName,
                    trackViewUrl,
                    fileSizeBytes,
                    averageUserRatingForCurrentVersion,
                    userRatingCountForCurrentVersion,
                    trackContentRating,
                    averageUserRating,
                    userRatingCount
                    from tracks
                    where trackId='".$trackId."'";
*/

    $trackInfoSql = "select
                    artworkUrl60,
                    artworkUrl100,
                    trackId,
                    wrapperType,
                    trackCensoredName,
                    trackViewUrl,
                    primaryGenreName
                    from tracks
                    where trackId='".$trackId."'";

    $res = db_getdata($trackInfoSql);
    return $res[0];
}
function getTrackFeatures($trackId) {
    $trackFeaturesSql = "select features from features where trackId='".$trackId."'";
    $res = db_getdata($trackFeaturesSql);
    $res = -1;
    if($res <> -1) {
        $len = sizeof($res);

        while($len) {

            $Features[] = $res[$len-1]['features'];
            $len --;
        }
    }
    else {
        $Features = array();
    }
    return $Features;
}

function getTrackGenre($trackId) {
    $trackGenreSql = "SELECT `genre` FROM `genres` WHERE `trackId` = '".$trackId."'";
    $res = db_getdata($trackGenreSql);
    if($res <> -1) {
        $len = sizeof($res);

        while($len) {
            $genres[] = $res[$len-1]['genre'];
            $len--;
        }
    }
    else {
        $genres = array();
    }

    return $genres;
}
function getTrackipadScreenshots($trackId) {
    $trackIpadScreenShotUrlsSql = "select ipadScreenshotUrl
                            from ipadScreenshotUrls where trackId='".$trackId."'";

    $res = db_getdata($trackIpadScreenShotUrlsSql);
    if($res <> -1) {
        $len = sizeof($res);
        while($len) {
            $return[] = $res[$len-1]['ipadScreenshotUrl'];
            $len--;
        }
    }
    else {
        $return = array();
    }

    return $return;
}
function getTrackLanguageCodes($trackId) {
    $trackLanguageCodesSql = "select languageCode from languageCodesISO2A where trackId='".$trackId."'";
    $res = db_getdata($trackLanguageCodesSql);
    if($res <> -1) {
        $len = sizeof($res);
        while($len) {
            $return[] = $res[$len-1]['languageCodes'];
            $len--;
        }
    }
    else {
        $return = array();
    }
    return $return;
}
function getTrackScreenShotUrls($trackId) {
    $trackScreenShotUrlsSql = "select screenshotUrl from screenshotUrls where trackId='".$trackId."'";
    $res = db_getdata($trackScreenShotUrlsSql);
    if($res <> -1) {
        $len = sizeof($res);
        while($len) {
            $return[] = $res[$len-1]['screenshotUrl'];
            $len--;
        }
    }
    else {
        $return = array();
    }
    return $return;

}

function getTrackSupportedDevices($trackId) {
    $trackSupportedDevicesSql = "select supportedDevices from supportedDevices where trackId='".$trackId."'";
    $res = db_getdata($trackSupportedDevicesSql);
    if($res <> -1) {

        $len = sizeof($res);
        while($len) {
            $return[] = $res[$len-1]['supportedDevices'];
            $len--;
        }
    }
    else {
        $return = array();
    }
    return $return;
}


function checkTrackExists($trackId) {
    $sql = "SELECT count(trackId) FROM `tracks` WHERE `trackId`=".$trackId;

    $res = db_getdata($sql);
    if($_GET['debug']==1) {

        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }
    return $res[0]['count(trackId)'];
}


function removeTrack($trackId) {
	// staff_picks
	db_putdata("DELETE FROM `staff_picks` WHERE `trackId`=".$trackId);
	// features
	db_putdata("DELETE FROM `features` WHERE `trackId`=".$trackId);
	// genreIds
	db_putdata("DELETE FROM `genreIds` WHERE `trackId`=".$trackId);
	// genres
	db_putdata("DELETE FROM `genres` WHERE `trackId`=".$trackId);
	// ipadScreenshotUrls
	db_putdata("DELETE FROM `ipadScreenshotUrls` WHERE `trackId`=".$trackId);
	// languageCodesISO2A
	db_putdata("DELETE FROM `languageCodesISO2A` WHERE `trackId`=".$trackId);
	// screenshotUrls
	db_putdata("DELETE FROM `screenshotUrls` WHERE `trackId`=".$trackId);
	// supportedDevices
	db_putdata("DELETE FROM `supportedDevices` WHERE `trackId`=".$trackId);
	// tracks
	db_putdata("DELETE FROM `tracks` WHERE `trackId`=".$trackId);
}
?>
