<?php

// CHECKS EMPTY INPUT (SIGN UP)
function emptyInputSignup($username, $email, $pswd, $pswdConfirm) {
    $result;

    if(empty($username) || empty($email) || empty($pswd) || empty($pswdConfirm)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

// CHECKS EMPTY INPUT (LOGIN)
function emptyInputLogin($email, $pswd) {
    $result;

    if(empty($email) || empty($pswd)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

// CHECKS EMPTY INPUT (QUEST/IDLE)
function emptyInputQuests($q_name, $q_day, $q_start, $q_end, $q_desc) {
    $result;

    if(empty($q_name) || empty($q_day) || empty($q_start) || empty($q_end) || empty($q_desc)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

// CHECKS TIME CLASH
function timeClash($con, $id, $q_day, $q_start, $q_end) {
    $sql = "SELECT * FROM questlog WHERE user_ID = '$id' AND q_day = '$q_day'";
    $query = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($query);
    
    $q_start = strtotime($q_start);
    $q_end = strtotime($q_end);

    $dbstart = strtotime($row['q_start']);
    $dbend = strtotime($row['q_end']);

    $timeCheck;
    /*  Explanation:
        Quest cannot end before it starts 
        OR
        Quest cannot end after existing quest starts and before existing quest ends
        OR
        Quest cannot start after existing quest starts or before existing quest ends
        OR
        Quest cannot engulf an existing quest start/end time
        OR
        Quest cannot exist within existing quest start/end time
    */
    if (($q_end < $q_start) || (($q_end > $dbstart) && ($q_end < $dbend)) || (($q_start > $dbstart) && ($q_start < $dbend)) || (($q_start <= $dbstart) && ($q_end >= $dbend)) || (($q_start >= $dbstart) && ($q_end <= $dbend))) { 
        $timeCheck = true;
    }
    else {
        $timeCheck = false;
    }

    return $timeCheck;
}

// CHECKS TIME CLASH
function timeEditClash($con, $id, $qid, $q_day, $q_start, $q_end) {
    $sql = "SELECT * FROM questlog WHERE user_ID = '$id' AND q_day = '$q_day' AND q_id <> '$qid'";
    $query = mysqli_query($con, $sql);
	$ed = mysqli_fetch_assoc($query);
    
    $q_start = strtotime($q_start);
    $q_end = strtotime($q_end);

    $dbstart = strtotime($ed['q_start']);
    $dbend = strtotime($ed['q_end']);

    $timeEdit;

    if (($q_end < $q_start) || (($q_end > $dbstart) && ($q_end < $dbend)) || (($q_start > $dbstart) && ($q_start < $dbend)) || (($q_start <= $dbstart) && ($q_end >= $dbend)) || (($q_start >= $dbstart) && ($q_end <= $dbend))) { 
        $timeEdit = true;
    }
    else {
        $timeEdit = false;
    }

    return $timeEdit;
}

// CHECKS BAD EMAIL
function invalidEmail($email) {
        $result;
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        }
        else {
            $result = false;
        }
    
        return $result;
}

// CHECKS MISMATCHED PASSWORD
function matchPswd($pswd, $pswdConfirm) {
    $result;

    if ($pswd !== $pswdConfirm) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

// CHECKS EXISTING EMAIL
function existAcc($con, $email) {
    $sql = "SELECT * FROM userlog WHERE user_email = ?;";
    $stmt = mysqli_stmt_init($con);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// CREATES ACCOUNT
function createUser($con, $username, $email, $pswd) {
    $sql = "INSERT INTO userlog (user_name, user_email, user_pswd) VALUES (?, ?, ?);";

    $stmt = mysqli_stmt_init($con);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPswd = password_hash($pswd, PASSWORD_DEFAULT); // ENCRYPTS PASSWORD

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPswd);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
}

// LOGIN ACCOUNT
function loginUser($con, $email, $pswd) {
    $accExist = existAcc($con, $email);

    // CHECKS NONEXISTENT EMAIL
    if ($accExist === false) {
        header("location: ../login.php?error=bademail");
        exit();
    }

    $pswdHashed = $accExist["user_pswd"];
    $checkPswd = password_verify($pswd, $pswdHashed);

    // CHECKS INCORRECT PASSWORD
    if ($checkPswd === false) {
        header("location: ../login.php?error=badlogin");
        exit();
    }
    else if ($checkPswd === true) {
        session_start();
        $_SESSION["userid"] = $accExist["user_ID"];

        header("location: ../index.php");
        exit();
    }
}

// ADD NEW QUEST
function inputQuest($con, $id, $tid, $q_name, $q_day, $q_start, $q_end, $q_desc) {
    $sql = "INSERT INTO questlog (user_ID, tid, q_name, q_day, q_start, q_end, q_desc) VALUES (?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($con);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../input_quest.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $id, $tid, $q_name, $q_day, $q_start, $q_end, $q_desc);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../index.php");
}

// ADD NEW IDLE
function inputIdle($con, $id, $tid, $q_name, $q_day, $q_start, $q_end, $q_desc) {
    $sql = "INSERT INTO questlog (user_ID, tid, q_name, q_day, q_start, q_end, q_desc) VALUES (?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($con);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../input_idle.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $id, $tid, $q_name, $q_day, $q_start, $q_end, $q_desc);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../index.php");
}

// EDIT QUEST
function editQuest($con, $qid, $q_name, $q_day, $q_start, $q_end, $q_desc) {
    $sql = "UPDATE questlog SET q_name='". $q_name . "', q_day='". $q_day . "', q_start='". $q_start . "', q_end='". $q_end . "', q_desc='". $q_desc . "' WHERE q_id = '". $qid . "'";

    if (!mysqli_query($con, $sql)) {
        header("location: ../edit_quest.php?qid=".$qid."&error=stmtfailed");
        exit();
    }
    else {
        header("location: ../view_quest.php?qid=".$qid."");
    }
}

// EDIT IDLE
function editIdle($con, $qid, $q_name, $q_day, $q_start, $q_end, $q_desc) {
    $sql = "UPDATE questlog SET q_name='". $q_name . "', q_day='". $q_day . "', q_start='". $q_start . "', q_end='". $q_end . "', q_desc='". $q_desc . "' WHERE q_id = '". $qid . "'";

    if (!mysqli_query($con, $sql)) {
        header("location: ../edit_idle.php?qid=".$qid."&error=stmtfailed");
        exit();
    }
    else {
        header("location: ../view_idle.php?qid=".$qid."");
    }
}

// UPDATE PROGRESS
function updateProg($con, $qid, $complete, $pgday) {
    $sql = "UPDATE questlog SET cid='". $complete . "' WHERE q_id = '". $qid . "'";

    if (!mysqli_query($con, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    else {
        header("location: ../index.php?day=".$pgday."");
    }
}

// TOTAL EXP
function totalEXP($con, $id, $exp, $lv) {
    if ($exp >= 100) { // LEVEL UP
        $lvl = $lv + 1;
        $t = $exp - 100;
    }
    else if ($exp < 0) { // LEVEL REVERT
        if ($lv <= 1) {
            $lvl = '1';
        }
        else {
            $lvl = $lv - 1;
        }
        $t = 100 + $exp; // cuz negative value
    }
    else {
        $lvl = $lv;
        $t = $exp;
    }

    $sql = "UPDATE userlog SET total_exp ='" . $t . "', ava_lv ='" . $lvl . "' WHERE user_ID = '". $id . "'";

    if (!mysqli_query($con, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    else {
        header("location: ../index.php");
    }
}

// COUNT EXP
function countEXP($con, $id, $total) {
    // RANKING
    if ($total >= 80) { 
        $rank = 'A';
    }
    else if ($total >= 60 && $total < 80) { // RANKING
        $rank = 'B';
    }
    else if ($total >= 40 && $total < 60) { // RANKING
        $rank = 'C';
    }
    else if ($total >= 20 && $total < 40) { // RANKING
        $rank = 'D';
    }
    else if ($total >= 1 && $total < 20) { // RANKING
        $rank = 'E';
    }
    else if ($total == 0) { // RANKING
        $rank = 'F';
    }
    $sql = "UPDATE userlog SET w_1 ='" . $total . "', rank ='" . $rank . "' WHERE user_ID = '". $id . "'";

    if (!mysqli_query($con, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    else {
        header("location: ../index.php");
    }
}

// COUNT HP
function countHP($con, $id, $hpadd) {
    $sql = "UPDATE userlog SET ava_hp='" . $hpadd . "' WHERE user_ID = '". $id . "'";

    if (!mysqli_query($con, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    else {
        header("location: ../index.php");
    }
}

//TURN IN
function turnIn($con, $id, $fresh, $w1, $w2, $w3, $rerank) {
    $sql = "UPDATE userlog SET w_1 ='" . $fresh . "', w_2 ='" . $w1 . "', w_3 ='" . $w2 . "', w_4 ='" . $w3 . "', rank ='" . $rerank . "' WHERE user_ID = '". $id . "'";

    if (!mysqli_query($con, $sql)) {
        header("location: ../checkpoint.php?error=stmtfailed");
        exit();
    }
    else {
        header("location: ../checkpoint.php");
    }
}

//WIPE
function wipeQuest($con, $id, $wipe) {
    $sql = "UPDATE questlog SET cid ='" . $wipe . "' WHERE user_ID = '". $id . "'";

    if (!mysqli_query($con, $sql)) {
        header("location: ../checkpoint.php?error=stmtfailed");
        exit();
    }
    else {
        header("location: ../checkpoint.php");
    }
}