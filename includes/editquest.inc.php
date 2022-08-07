<?php
if (isset($_POST["edit"])) {
    $q_name = $_POST["q_name"];
    $q_day = $_POST["q_day"];
    $q_start = $_POST["q_start"];
    $q_end = $_POST["q_end"];
    $q_desc = $_POST["q_desc"];

    require_once 'dbh.inc.php';
    require_once 'fx.inc.php';

    $qid = mysqli_real_escape_string($con, $_POST['qid']);

    // CHECKS EMPTY INPUT
    if (emptyInputQuests($q_name, $q_day, $q_start, $q_end, $q_desc) !== false) {
        // Gets quest ID from url
        header("location: ../edit_quest.php?qid=".$qid."&error=emptyinput");
        exit();
    }

    //CHECKS TIME CLASH
    if (timeEditClash($con, $id, $qid, $q_day, $q_start, $q_end) !== false) {
        header("location: ../edit_quest.php?qid=".$qid."&error=timeclash");
        exit();
    }

    editQuest($con, $qid, $q_name, $q_day, $q_start, $q_end, $q_desc); // EDITS QUEST
}
else {
    header("location: ../edit_quest.php?qid=".$qid."");
    exit();
}

