<?php

include_once("php_includes/itunes.php");
include_once("php_includes/dbserver.php");
if (isset($_GET['id'])) {
    $test = $_GET['id'];
//    $ip = $_SERVER['REMOTE_ADDR'];
//    $detailstemp = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
//    $usercountry = $detailstemp->country;
    $usercountry = 'US';
    $user = false;
    $already = false;
    if (isset($_SESSION["userid"])) {
        $user_id = $_SESSION["userid"];
        $user_email = $_SESSION["email"];
        $user = true;

        $sql = "SELECT * FROM reminder_itunes_us WHERE user_id='$user_id' AND tmdb_id='$test' AND status='0'";
        $user_query = mysqli_query($server, $sql);
        $numrows = mysqli_num_rows($user_query);
        if ($numrows > 0) {
            $already = true;
        }
    }

    function umlautepas($string) {
        $upas = Array("ae" => "ä", "ue" => "ü", "oe" => "ö", "Ae" => "Ä", "Ue" => "Ü", "Oe" => "Ö");
        return strtr($string, $upas);
    }

    //------------movie-data-------------------------------------------------------------------

    $ca = curl_init();
    curl_setopt($ca, CURLOPT_URL, 'http://api.themoviedb.org/3/configuration?api_key=93ad36446acab4b05301022006e5bdc4');
    curl_setopt($ca, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ca, CURLOPT_HEADER, FALSE);
    curl_setopt($ca, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response1 = curl_exec($ca);
    //curl_close($ca);

    $config = json_decode($response1, true);

    $sql = "SELECT id, imdb_id, adult, backdrop_path, genres, original_title, overview, popularity, poster_path, runtime, release_date, vote_average, vote_count, director, cast, trailer FROM tmdb_movies WHERE id='$test' LIMIT 1";
    $query = mysqli_query($server, $sql);
    $row = mysqli_fetch_row($query);

    $imdb = $row[1];

    if (count($row[4]) === 0) {
        $genres = '-';
    } else {
        $genres = $row[4];
    }
    $date = $row[10];

    if ($date === '' || $date === '0000-00-00') {
        $name = $row[5];
    } else {
        $yeararray = explode("-", $date);
        $year = $yeararray[0];
        $name = $row[5] . ' (' . $year . ')';
    }
    $overview = $row[6];

    if (count($row[9]) === 0 || $row[9] === '0') {
        $runtime = "-";
    } else {
        $runtime = $row[9] . " min";
    }

    if ($row[13] === '') {
        $director = '-';
    } else {
        $director = $row[13];
    }

    if ($row[14] === '') {
        $credits = '-';
    } else {
        $credits = $row[14];
    }

    if ($row[15] === '') {
        $trailer = '';
    } else {
        $trailer = "<a href='' data-toggle='modal' data-target='#myModalTrailer'>Trailer</a>";
        $trailerurl = $row[15];
    }

    $tmdblink = ("<a href='https://www.themoviedb.org/movie/" . $test . "' target='_blank'>TMDb</a>");
    $imdblink = ("<a href='http://www.imdb.com/title/" . $imdb . "' target='_blank'>IMDb</a>");

    if (!isset($row[8])) {
        $poster = ("<img src='images/error.jpg' width='185' height='278' alt='not available'/>");
    } else {
        $poster = ("<img src='" . $config['images']['base_url'] . $config['images']['poster_sizes'][2] . $row[8] . "' alt='not available'/>"); //TO-DO: Überprüfung ob Bild vorhanden
    }

    //------------------Similar Movies-----------------------------------------------------------------
    //$ch1 = curl_init();

    curl_setopt($ca, CURLOPT_URL, 'http://api.themoviedb.org/3/movie/' . $test . '/similar?api_key=93ad36446acab4b05301022006e5bdc4');
    curl_setopt($ca, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ca, CURLOPT_HEADER, FALSE);

    curl_setopt($ca, CURLOPT_HTTPHEADER, array(
        "Accept: application/json"
    ));

    $response3 = curl_exec($ca);
    //curl_close($ch1);

    $similarjson = json_decode($response3, true);
    $getsimilar = false;
    if (count($similarjson['results']) === 0) {
        $getsimilar = false;
    } else {
        for ($i = 0; $i < 5; $i++) {
            if (!isset($similarjson['results'][$i]['poster_path'])) {
                @${similar . $i} = ("<a href='http://h2201857.stratoserver.net/clean/movie/" . $similarjson['results'][$i]['id'] . "'><img src='images/error.jpg' width='92px' height='138px' alt='not available' title='" . $similarjson['results'][$i]['original_title'] . "'/></a>");
            } else {
                @${similar . $i} = ("<a href='http://h2201857.stratoserver.net/clean/movie/" . $similarjson['results'][$i]['id'] . "'><img src='" . $config['images']['base_url'] . $config['images']['poster_sizes'][0] . $similarjson['results'][$i]['poster_path'] . "' alt='not available' title='" . $similarjson['results'][$i]['original_title'] . "'/></a>");
            }
        }
        $getsimilar = true;
    }
    curl_close($ca);
    //-------------------itunes------------------------------------------------------------

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
            $pos = strpos($itunes[$i]->trackName, $row[5]);
            $posdir = strpos($itunes[$i]->artistName, $director);

            //echo $posdir;
            if ($director === $itunes[$i]->artistName && $row[5] === $itunes[$i]->trackName) {
                $rows = $i;
                $available = 1;
                echo "1";
                break;
            }
            if ($director === $itunes[$i]->artistName) {
                $rows = $i;
                $available = 1;
                echo "2";
                break;
            }
            if ($posdir !== -1 && $pos !== -1 && $itunesyear === $year && $director === $itunes[$i]->artistName) {
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

    if ($available === 0) {//not from english speaking country 
        echo "nicht original";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://api.themoviedb.org/3/movie/' . $test . '/alternative_titles?api_key=93ad36446acab4b05301022006e5bdc4');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json"
        ));

        $response5 = curl_exec($ch);
        curl_close($ch);

        $titlesjson = json_decode($response5, true);
        //print_r($titlesjson);
        //$temp = 0;
        $altname = '';
        // falls mehrere vorhanden, nocheinmal die längen überprüfen und dann wohl den kürzesten nehmen
        for ($i = 0; $i < count($titlesjson['titles']); $i++) {
            if ($usercountry === $titlesjson['titles'][$i]['iso_3166_1']) {
                //$length = strlen($titlesjson['titles'][$i]['title']);
                //if ($length > $temp) {
                $altname = $titlesjson['titles'][$i]['title'];
                //echo $temp = $length;
                break;
                //}
            }
        }
        if ($altname === '') {
            $altname = $row[5];
        }
        $altnameposdot = strpos($altname, ":");
        if ($altnameposdot > 0) {
            $altnameexplode = explode(": ", $altname);
            $altname = $altnameexplode[1];
        }
        $substrcount = substr_count($altname, "-");
        //echo $altnameposline = strpos($altname, "-");
        if ($substrcount >= 1) {//!!!!!!!!!!!!!!!!!!!!!
            $altnameexplode = explode("- ", $altname);
            $altname = $altnameexplode[1];
        }
//        if ($usercountry === 'DE') {
//            $altname = umlautepas($altname);
//        }
        echo $altname;
        $itunesalt = iTunes::search($altname, array(
                    'country' => 'DE',
                    'entity' => 'movie'
                ))->results;

        if (count($itunesalt) < 1) {
            $available = 0;
        } else {

            for ($i = 0; $i < count($itunesalt); $i++) {
                $itunesdate = $itunesalt[$i]->releaseDate;
                $itunesyeararray = explode("-", $itunesdate);
                $itunesyear = $itunesyeararray[0];
                $pos = strpos($itunesalt[$i]->trackName, $altname);
                $posdir = strpos($itunesalt[$i]->artistName, $director);
                //echo $itunesalt[$i]->artistName;
                //echo $posdir;

                if ($director === $itunesalt[$i]->artistName && $altname === $itunesalt[$i]->trackName) {
                    $rows = $i;
                    $available = 1;
                    echo "1";
                    break;
                }
                if ($director === $itunesalt[$i]->artistName) {
                    $rows = $i;
                    $available = 1;
                    echo "2";
                    break;
                }
                if ($posdir !== -1 && $pos !== -1 && $itunesyear === $year && $director === $itunes[$i]->artistName) {
                    $rows = $i;
                    $available = 1;
                    echo "3";
                    break;
                }
//                if ($itunesyear === $year) {
//                    $rows = $i;
//                    $available = 1;
//                    //echo "4";
//                    break;
//                }
            }
        }
        if (isset($rows)) {
            $trackname = $itunesalt[$rows]->trackName;
            $trackid = $itunesalt[$rows]->trackId;
            $linkitunes = $itunesalt[$rows]->trackViewUrl;
            @$trackPricetemp = $itunesalt[$rows]->trackPrice;
            $trackPrice = ("<a href='$linkitunes' target='_blank'>$trackPricetemp</a>");
            @$trackRentalPricetemp = $itunesalt[$rows]->trackRentalPrice;
            $trackRentalPrice = ("<a href='$linkitunes' target='_blank'>$trackRentalPricetemp</a>");
            $trackpreview = ("<a href='$linkitunes' target='_blank'>Preview</a>");
        } else {
            //echo "2"; 
        }
    }
}






