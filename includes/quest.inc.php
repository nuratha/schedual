<?php
session_start();
$id = $_SESSION["userid"];

if (isset($_POST["submit"])) {
    $tid = $_POST["tid"];
    $q_name = $_POST["q_name"];
    $q_day = $_POST["q_day"];
    $q_start = $_POST["q_start"];
    $q_end = $_POST["q_end"];
    $q_desc = $_POST["q_desc"];

    require_once 'dbh.inc.php';
    require_once 'fx.inc.php';

    // CHECKS EMPTY INPUT
    if (emptyInputQuests($q_name, $q_day, $q_start, $q_end, $q_desc) !== false) {
        header("location: ../input_quest.php?error=emptyinput");
        exit();
    }

    //CHECKS TIME CLASH
    if (timeClash($con, $id, $q_day, $q_start, $q_end) !== false) {
        header("location: ../input_quest.php?error=timeclash");
        exit();
    }
    inputQuest($con, $id, $tid, $q_name, $q_day, $q_start, $q_end, $q_desc); // ADDS QUEST
}
else {
    header("location: ../input_quest.php");
    exit();
}

