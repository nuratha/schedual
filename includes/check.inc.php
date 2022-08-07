<?php
if (isset($_POST["check"])) {
    $id = $_POST["id"];
    $qid = $_POST["qid"];
    $tid = $_POST["tid"];
    $ztime = $_POST["ztime"];
    $zday = $_POST["zday"];
    $pgday = $_POST["pgday"];
    $q_day = $_POST["q_day"];
    $q_end = $_POST["q_end"];
    $complete = $_POST["boole"];

    $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $day_now = array_search($zday, $days);
    $day_q = array_search($q_day, $days);

    require_once 'dbh.inc.php';
    require_once 'fx.inc.php';
    
    $query = mysqli_query($con, "SELECT * FROM calclog WHERE tid = '$tid'");
	$pts = mysqli_fetch_assoc($query);

    $query2 = mysqli_query($con, "SELECT * FROM userlog WHERE user_ID = '$id'");
	$user = mysqli_fetch_assoc($query2);

    $w1 = $user['w_1'];
    $hp = $user['ava_hp'];
    $lv = $user['ava_lv'];
    $xp = $user['total_exp'];
    $gainHP = $pts['gain_hp'];
    $loseHP = $pts['lose_hp'];
    $gainEXP = $pts['gain_exp'];

    if (($complete == 2) || ($complete == 3)) { // UNCHECK BOX
        // QUEST
        if ($tid == 1) {
            if ($complete == 3) { //REVERT LATE PENALTY
                $hpadd = $hp + $loseHP;
                countHP($con, $id, $hpadd);
            }
            
            $exp = $xp - $gainEXP;

            if (($w1 - $gainEXP) >= 0) { // NO NEGATIVES
                $total = $w1 - $gainEXP;
            }
            else {
                $total = '0';
            }
            countEXP($con, $id, $total); // REVERT
            totalEXP($con, $id, $exp, $lv); // REWARD
        }

        // IDLE
        if ($tid == 2) {
            // NO NEGATIVES
            if (($hp - $gainHP) >= 0) {
                $hpadd = $hp - $gainHP;
            }
            else {
                $hpadd = '0';
            }
            $hpadd = $hp - $gainHP;
            countHP($con, $id, $hpadd); // REVERT
        }
        
        $complete = 1;
    }
    else if ($complete == 1) { // CHECK BOX
        $complete = 2;
        // QUEST
        if ($tid == 1) {
            if ($ztime > substr($q_end, 0, 5) || ($day_now > $day_q)) { //LATE PENALTY
                $complete = 3;
                $hpadd = $hp - $loseHP;
                countHP($con, $id, $hpadd);
            }

            $exp = $xp + $gainEXP;
            $total = $w1 + $gainEXP;
            countEXP($con, $id, $total); // REWARD
            totalEXP($con, $id, $exp, $lv); // REWARD
        }

        // IDLE
        if ($tid == 2) {
            if ($ztime > substr($q_end, 0, 5) || ($day_now > $day_q)) { //LATE PENALTY
                $complete = 3;
                $hpadd = $hp + 0;
            }
            else {
                // NO OVERFLOW HP
                if (($hp + $gainHP) <= 100) {
                    $hpadd = $hp + $gainHP;
                }
                else {
                    $hpadd = '100';
                }
            }
            countHP($con, $id, $hpadd); // RECOVER
        }
    }

    updateProg($con, $qid, $complete, $pgday); // EDITS QUEST PROGRESS

}
else {
    header("location: ../index.php?day=".$pgday."");
    exit();
}