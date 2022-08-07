<?php

if (isset($_POST["turn"])) {
    $id = $_POST["id"];
    $w1 = $_POST["w1"];

    require_once 'dbh.inc.php';
    require_once 'fx.inc.php';

    $query = mysqli_query($con, "SELECT * FROM userlog WHERE user_ID = '$id'");
	$user = mysqli_fetch_assoc($query);

    $query2 = mysqli_query($con, "SELECT * FROM questlog WHERE user_ID = '$id'");
    $quest = mysqli_fetch_assoc($query2);

    $wipe = '1';

    $fresh = '0';
    $rerank = 'F';
    $w1 = $user['w_1'];
    $w2 = $user['w_2'];
    $w3 = $user['w_3'];

    turnIn($con, $id, $fresh, $w1, $w2, $w3, $rerank); // TURN IN
    wipeQuest($con, $id, $wipe); // CLEAR

}
else {
    header("location: ../checkpoint.php");
    exit();
}


