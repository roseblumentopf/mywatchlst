<?php
  include_once("php_includes/movie_data.php");
  //header('Content-type: text/css');
  $row = getRow();
  $image = $row[3];
?>
<style type="text/css">
#home-sec { 
    
background: url(http://image.tmdb.org/t/p/w1280<?=$image?>) no-repeat 50% 50%;
background-attachment: fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
width: 100%;
display: block;
height: auto;
 //padding-top:190px;
 //margin-top: 40px;
   min-height:650px;
    //color:#fff;
}
</style>