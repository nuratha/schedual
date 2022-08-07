<?php 
    // DELETE FX
	if (isset($_POST["delete"])) {
        require_once 'dbh.inc.php';

        $delfx = mysqli_real_escape_string($con, $_POST['delfx']);

		$del = mysqli_query($con, "DELETE FROM questlog WHERE q_id = '$delfx'");
	
		if($del) {
			header("location: ../index.php");
			exit();
		}
		else {
			header("location: ../edit_quest.php?qid=".$delfx."&error=cantdelete");
			exit();
		}
    }

	