<?php

$dbServer = "localhost";
$dbUser = "root";
$dbPswd = "";
$dbName = "scheducon";

$con = mysqli_connect($dbServer,$dbUser, $dbPswd, $dbName);

if (!$con) {
    die("Connection failed: ".mysqli_connect_error());
}
?>


