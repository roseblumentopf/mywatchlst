<?php
function getDb() {
$server = mysqli_connect("81.169.195.24:3306", "clean2", "testtest", "clean2");
// Evaluate the connection
if (mysqli_connect_errno()) {
    return mysqli_connect_error();
    //exit();
} else {
    return $server;
}

}
