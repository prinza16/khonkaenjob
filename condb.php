<?php
error_reporting(E_ERROR);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khonkaen_job";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connect failed" . mysqli_connect_error());
}
// else {
//     echo "Connect success";
// }
