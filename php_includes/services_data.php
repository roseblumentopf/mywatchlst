<?php
include_once("php_includes/movie_data.php");

function umlautepas($string) {
    $upas = Array("ae" => "ä", "ue" => "ü", "oe" => "ö", "Ae" => "Ä", "Ue" => "Ü", "Oe" => "Ö");
    return strtr($string, $upas);
}

$row = getRow();
$itunes = iTunes::search($row[5], array(
            'country' => 'US',
            'entity' => 'movie'
        ))->results;

$available = 0;
$trackPrice = 0;
$trackRentalPrice = 0;
if (count($itunes) > 0) {
    echo "original";

    for ($i = 0; $i < count($itunes); $i++) {
        $itunesdate = $itunes[$i]->releaseDate;
        $itunesyeararray = explode("-", $itunesdate);
        $itunesyear = $itunesyeararray[0];
        @$pos = strpos($itunes[$i]->trackName, $row[5]); //Fehler wegen ->undefinded property stdclass->trackname
        $posdir = strpos($itunes[$i]->artistName, getDirector($row));

//echo $posdir;
        if (getDirector($row) === $itunes[$i]->artistName && $row[5] === $itunes[$i]->trackName) {
            $rows = $i;
            $available = 1;
            echo "1";
            break;
        }
        if (getDirector($row) === $itunes[$i]->artistName) {
            $rows = $i;
            $available = 1;
            echo "2";
            break;
        }
        if ($posdir !== -1 && $pos !== -1 && $itunesyear === getYear($row) && getDirector($row) === $itunes[$i]->artistName) {
            $rows = $i;
            $available = 1;
            echo "3";
            break;
        }
//            if ($pos !== false) {
//                $row = $i;
//                $available = 1;
//                echo "4";
//                break;
//            }
//            if ($itunesyear === $year) {
//                $rows = $i;
//                $available = 1;
//                //echo "4";
//                break;
//            }
    }
    if (isset($rows)) {
        $trackname = $itunes[$rows]->trackName;
        $trackid = $itunes[$rows]->trackId;
        $linkitunes = $itunes[$rows]->trackViewUrl;
        @$trackPricetemp = $itunes[$rows]->trackPrice;
        $trackPrice = ("<a href='$linkitunes' target='_blank'>$trackPricetemp</a>");
        @$trackRentalPricetemp = $itunes[$rows]->trackRentalPrice;
        $trackRentalPrice = ("<a href='$linkitunes' target='_blank'>$trackRentalPricetemp</a>");
        $trackpreview = ("<a href='$linkitunes' target='_blank'>Preview</a>");
    } else {
//echo "1";
    }
}

//if ($available === 0) {//not from english speaking country 
//    echo "nicht original";
//    $ch = curl_init();
//
//    curl_setopt($ch, CURLOPT_URL, 'http://api.themoviedb.org/3/movie/' . $test . '/alternative_titles?api_key=93ad36446acab4b05301022006e5bdc4');
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//    curl_setopt($ch, CURLOPT_HEADER, FALSE);
//
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//        "Accept: application/json"
//    ));
//
//    $response5 = curl_exec($ch);
//    curl_close($ch);
//
//    $titlesjson = json_decode($response5, true);
////print_r($titlesjson);
////$temp = 0;
//    $altname = '';
//// falls mehrere vorhanden, nocheinmal die längen überprüfen und dann wohl den kürzesten nehmen
//    for ($i = 0; $i < count($titlesjson['titles']); $i++) {
//        if ($usercountry === $titlesjson['titles'][$i]['iso_3166_1']) {
////$length = strlen($titlesjson['titles'][$i]['title']);
////if ($length > $temp) {
//            $altname = $titlesjson['titles'][$i]['title'];
////echo $temp = $length;
//            break;
////}
//        }
//    }
//    if ($altname === '') {
//        $altname = $row[5];
//    }
//    $altnameposdot = strpos($altname, ":");
//    if ($altnameposdot > 0) {
//        $altnameexplode = explode(": ", $altname);
//        $altname = $altnameexplode[1];
//    }
//    $substrcount = substr_count($altname, "-");
////echo $altnameposline = strpos($altname, "-");
//    if ($substrcount >= 1) {//!!!!!!!!!!!!!!!!!!!!!
//        $altnameexplode = explode("- ", $altname);
//        $altname = $altnameexplode[1];
//    }
////        if ($usercountry === 'DE') {
////            $altname = umlautepas($altname);
////        }
//    echo $altname;
//    $itunesalt = iTunes::search($altname, array(
//                'country' => 'DE',
//                'entity' => 'movie'
//            ))->results;
//
//    if (count($itunesalt) < 1) {
//        $available = 0;
//    } else {
//
//        for ($i = 0; $i < count($itunesalt); $i++) {
//            $itunesdate = $itunesalt[$i]->releaseDate;
//            $itunesyeararray = explode("-", $itunesdate);
//            $itunesyear = $itunesyeararray[0];
//            $pos = strpos($itunesalt[$i]->trackName, $altname);
//            $posdir = strpos($itunesalt[$i]->artistName, getDirector($row));
////echo $itunesalt[$i]->artistName;
////echo $posdir;
//
//            if (getDirector($row) === $itunesalt[$i]->artistName && $altname === $itunesalt[$i]->trackName) {
//                $rows = $i;
//                $available = 1;
//                echo "1";
//                break;
//            }
//            if (getDirector($row) === $itunesalt[$i]->artistName) {
//                $rows = $i;
//                $available = 1;
//                echo "2";
//                break;
//            }
//            if ($posdir !== -1 && $pos !== -1 && $itunesyear === getYear($row) && getDirector($row) === $itunes[$i]->artistName) {
//                $rows = $i;
//                $available = 1;
//                echo "3";
//                break;
//            }
////                if ($itunesyear === $year) {
////                    $rows = $i;
////                    $available = 1;
////                    //echo "4";
////                    break;
////                }
//        }
//    }
//    if (isset($rows)) {
//        $trackname = $itunesalt[$rows]->trackName;
//        $trackid = $itunesalt[$rows]->trackId;
//        $linkitunes = $itunesalt[$rows]->trackViewUrl;
//        @$trackPricetemp = $itunesalt[$rows]->trackPrice;
//        $trackPrice = ("<a href='$linkitunes' target='_blank'>$trackPricetemp</a>");
//        @$trackRentalPricetemp = $itunesalt[$rows]->trackRentalPrice;
//        $trackRentalPrice = ("<a href='$linkitunes' target='_blank'>$trackRentalPricetemp</a>");
//        $trackpreview = ("<a href='$linkitunes' target='_blank'>Preview</a>");
//    } else {
////echo "2"; 
//    }
//}

