<?php
	//-- LOGIN SESSION --
	session_start();
	
	//-- HEADER GOES HERE --
	include_once './header.php';

	//-- DATABASE HERE --
	include 'includes/dbh.inc.php';
	$id = $_SESSION["userid"];

	// If not logged in
	if (!$id == true) {
		header("location: ./login.php");
		exit();
	}

	$query = mysqli_query($con, "SELECT * FROM questLog WHERE user_ID = '$id'");
	$row = mysqli_fetch_array($query);

	// Gets quest ID from url
	if(isset($_GET["qid"])) {
		$qid = mysqli_real_escape_string($con, $_GET['qid']);
		$quest = mysqli_query($con, "SELECT * FROM questlog WHERE user_ID = '$id' AND q_id = '$qid'");
		$qinfo = mysqli_fetch_array($quest);
		mysqli_free_result($quest);
	}
?>

	<!-- BODY -->

		<header class="p-6 flex justify-center space-x-3 bg-primary">
			<div>
				<!-- Back icon -->
				<a href="./index.php">
					<svg xmlns="http://www.w3.org/2000/svg" class="fill-white hover:fill-secondary active:fill-secondary" viewBox="0 0 20 20" width="30">
					<path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
				</a>
			</div>
			<h1 class="font-serif text-2xl text-white text-center">
                View Quest
            </h1>
			<div>
				<a href="./edit_quest.php?qid=<?php echo $qid?>">
					<!-- Edit icon -->
					<svg class="fill-white hover:fill-secondary active:fill-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="30">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" /></svg>
				</a>
			</div>
		</header>

<!-- CONTENTS -->

		<main> 
			<section class="p-6">
				<div class="p-6 bg-white grid grid-cols-2 gap-4 place-items-center">
					<!-- INFO -->
					<div>
						<?php
							echo '
							<div class="badge badge-secondary text-black">QUEST</div>
							<h2 class="font-serif uppercase text-lg font-semibold text-primary">' . $qinfo['q_name'] . '</h2>
							<h5><b>Day</b>: <div class="badge badge-lg text-white">' . $qinfo['q_day'] . '</div><br>
							<b>Time</b>: ' . substr($qinfo['q_start'], 0, 5) . ' - ' . substr($qinfo['q_end'], 0, 5) . '
							<br><br>
							<b>Description</b>:</h5>
							<p>' . $qinfo['q_desc'] . '</p>';
						?>
					</div>

					<!-- GRAPHIC -->
					<div>
						<img src="./img/avatar_quest.png" width="350">
					</div>
				</div>
				<hr>
			</section>
		</main>
	</body>
</html>