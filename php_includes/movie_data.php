<?php

include_once("php_includes/itunes.php");
include_once("php_includes/dbserver.php");

function getId() {
    if (isset($_GET['id'])) {
        return $test = $_GET['id'];
    } else {
        echo "nicht vorhanden";
    }
}

function getUserCountry() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $detailstemp = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"), true);
    if (isset($detailstemp->country)) {
        return $usercountry = $detailstemp->country;
    } else {
        return $usercountry = null;
    }
}

function getRow() {
    $test = getId();
    $server = getDb();
    $sql = "SELECT id, imdb_id, adult, backdrop_path, genres, original_title, overview, popularity, poster_path, runtime, release_date, vote_average, vote_count, director, cast, trailer FROM tmdb_movies WHERE id='$test' LIMIT 1";
    $query = mysqli_query($server, $sql);
    return $row = mysqli_fetch_row($query);
}

function checkUser() {
    if (isset($_SESSION["userid"])) {
        $user_id = $_SESSION["userid"];
        $user_email = $_SESSION["email"];
        return $user = true;
    } else {
        return $user = false;
    }
}

function checkReminderStatus($test) {
    $sql = "SELECT * FROM reminder_itunes_us WHERE user_id='$user_id' AND tmdb_id='$test' AND status='0'";
    $user_query = mysqli_query($server, $sql);
    $numrows = mysqli_num_rows($user_query);
    if ($numrows > 0) {
        return $already = true;
    } else {
        return $already = false;
    }
}

function getConfig() {
    $ca = curl_init();
    curl_setopt($ca, CURLOPT_URL, 'http://api.themoviedb.org/3/configuration?api_key=93ad36446acab4b05301022006e5bdc4');
    curl_setopt($ca, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ca, CURLOPT_HEADER, FALSE);
    curl_setopt($ca, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response1 = curl_exec($ca);
    curl_close($ca);

    return $config = json_decode($response1, true);
}

function getImdbId($row) {
    return $imdb = $row[1];
}

function getGenres($row) {
    if (count($row[4]) === 0) {
        return $genres = '-';
    } else {
        return $genres = $row[4];
    }
}

function getYear($row) {
    $date = $row[10];
    if ($date === '' || $date === '0000-00-00') {
        return $year = '';
    } else {
        $yeararray = explode("-", $date);
        return $year = $yeararray[0];
    }
}

function getName($row) {
    $date = $row[10];
    if ($date === '' || $date === '0000-00-00') {
        return $name = $row[5];
    } else {
        $yeararray = explode("-", $date);
        $year = $yeararray[0];
        return $name = $row[5] . ' (' . $year . ')';
    }
}

function getOverview($row) {
    return $overview = $row[6];
}

function getRuntime($row) {
    if (count($row[9]) === 0 || $row[9] === '0') {
        return $runtime = "-";
    } else {
        return $runtime = $row[9] . " min";
    }
}

function getDirector($row) {
    if ($row[13] === '') {
        return $director = '-';
    } else {
        return $director = $row[13];
    }
}

function getCredits($row) {
    if ($row[14] === '') {
        return $credits = '-';
    } else {
        return $credits = $row[14];
    }
}

function getTrailerUrl($row) {
    if ($row[15] === '') {
        return $trailer = '';
    } else {
        $trailerurl = $row[15];
        return $trailer = "<a href='' data-toggle='modal' data-target='#myModalTrailer'>Trailer</a>";
    }
}

function getTmdbLink() {
    return $tmdblink = ("<a href='https://www.themoviedb.org/movie/" . getId() . "' target='_blank'>TMDb</a>");
}

function getImdbLink($row) {
    return $imdblink = ("<a href='http://www.imdb.com/title/" . getImdbId($row) . "' target='_blank'>IMDb</a>");
}

function getPoster($row) {
    $config = getConfig();
    if (!isset($row[8])) {
        return $poster = ("<img src='images/error.jpg' width='185' height='278' alt='not available'/>");
    } else {
        return $poster = ("<img src='" . $config['images']['base_url'] . $config['images']['poster_sizes'][2] . $row[8] . "' alt='not available'/>"); //TO-DO: Überprüfung ob Bild vorhanden
    }
}

//------------------Similar Movies-----------------------------------------------------------------
//$ch1 = curl_init();
//    curl_setopt($ca, CURLOPT_URL, 'http://api.themoviedb.org/3/movie/' . $test . '/similar?api_key=93ad36446acab4b05301022006e5bdc4');
//    curl_setopt($ca, CURLOPT_RETURNTRANSFER, TRUE);
//    curl_setopt($ca, CURLOPT_HEADER, FALSE);
//
//    curl_setopt($ca, CURLOPT_HTTPHEADER, array(
//        "Accept: application/json"
//    ));
//
//    $response3 = curl_exec($ca);
//    //curl_close($ch1);
//
//    $similarjson = json_decode($response3, true);
//    $getsimilar = false;
//    if (count($similarjson['results']) === 0) {
//        $getsimilar = false;
//    } else {
//        for ($i = 0; $i < 5; $i++) {
//            if (!isset($similarjson['results'][$i]['poster_path'])) {
//                @${similar . $i} = ("<a href='http://h2201857.stratoserver.net/clean/movie/" . $similarjson['results'][$i]['id'] . "'><img src='images/error.jpg' width='92px' height='138px' alt='not available' title='" . $similarjson['results'][$i]['original_title'] . "'/></a>");
//            } else {
//                @${similar . $i} = ("<a href='http://h2201857.stratoserver.net/clean/movie/" . $similarjson['results'][$i]['id'] . "'><img src='" . $config['images']['base_url'] . $config['images']['poster_sizes'][0] . $similarjson['results'][$i]['poster_path'] . "' alt='not available' title='" . $similarjson['results'][$i]['original_title'] . "'/></a>");
//            }
//        }
//        $getsimilar = true;
//    }
//    curl_close($ca);