<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khonkaenjob";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connect failed" . mysqli_connect_error());
}
// else {
//     echo "Connect success";
// }
