<?php

if (isset($_GET['s'])) {
    $test = urlencode($_GET['s']);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'http://api.themoviedb.org/3/search/movie?query=' . $test . '&api_key=93ad36446acab4b05301022006e5bdc4');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Accept: application/json"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    //print_r($result);

    $ca = curl_init();
    curl_setopt($ca, CURLOPT_URL, 'http://api.themoviedb.org/3/configuration?api_key=93ad36446acab4b05301022006e5bdc4');
    curl_setopt($ca, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ca, CURLOPT_HEADER, FALSE);
    curl_setopt($ca, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response1 = curl_exec($ca);
    curl_close($ca);

    $config = json_decode($response1, true);

    if (count($result['results']) === 0) {
        $sresult0 = "No matches";
    } else {
        for ($i = 0; $i < 3; $i++) {
            if (!isset($result['results'][$i]['poster_path'])) {
                @${sresult . $i} = ("<a href='http://localhost/mywatchlst/movie/" . $result['results'][$i]['id'] . "'><img src='images/error.jpg' width='154px' height='231px' alt='not available' title='" . $result['results'][$i]['original_title'] . "'/></a>");
            } else {
                @${sresult . $i} = ("<a href='http://localhost/mywatchlst/movie/" . $result['results'][$i]['id'] . "'><img src='" . $config['images']['base_url'] . $config['images']['poster_sizes'][1] . $result['results'][$i]['poster_path'] . "' alt='not available' title='" . $result['results'][$i]['original_title'] . "'/></a>");
            }
        }
    }
}
