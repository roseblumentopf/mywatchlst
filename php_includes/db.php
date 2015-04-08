<?php

$conn = mysqli_connect("localhost", "root", "", "mywatchlst");
// Evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
}

