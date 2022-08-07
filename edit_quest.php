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
				<a href="./view_quest.php?qid=<?php echo $qid?>">
					<svg xmlns="http://www.w3.org/2000/svg" class="fill-white hover:fill-amber-500 active:fill-amber-300" viewBox="0 0 20 20" width="30">
					<path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
				</a>
			</div>
			<h1 class="font-serif text-2xl text-white">
                Edit Quest
            </h1>
			<div>
				<!-- DELETE FX-->
				<form action="./includes/delq.inc.php" method="post">
					<input type="hidden" name="delfx" value="<?php echo $qid ?>">
					<button type="submit" name="delete">
					<svg xmlns="http://www.w3.org/2000/svg" class="fill-white hover:fill-error" viewBox="0 0 20 20" width="30">
  						<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
					</button>
				</form>
			</div>
		</header>

<!-- CONTENTS -->

		<main class="p-6"> 
		<form action="includes/editquest.inc.php" method="post">
			<!-- Quest ID -->
			<input type="hidden" name="qid" value="<?php echo $qid ?>">
			<section class="p-6 flex justify-center bg-white">
			<div><!-- Quest name input -->
				<div>
					<label class="label">
						<span class="label-text">Quest title</span>
					</label>
					<input type="text" name="q_name" class="input input-bordered input-primary w-full max-w-xs" value="<?php echo $qinfo['q_name']; ?>">
				</div>

				<!--Day input -->
				<div>
					<label class="label">
						<span class="label-text">Day</span>
					</label>
					<select name="q_day" class="input input-bordered input-primary w-full max-w-xs">
						<option hidden><?php echo $qinfo['q_day']; ?></option>
						<option>Monday</option>
						<option>Tuesday</option>
						<option>Wednesday</option>
						<option>Thursday</option>
						<option>Friday</option>
						<option>Saturday</option>
						<option>Sunday</option>
					</select>
				</div>

				<!-- Start time input -->
				<div>
					<label class="label">
						<span class="label-text">Start time</span>
					</label>
					<input type="time" name="q_start" class="input input-bordered input-primary w-full max-w-xs" value="<?php echo $qinfo['q_start']; ?>">
				</div>

				<!-- End time input -->
				<div>
					<label class="label">
						<span class="label-text">End time</span>
					</label>
					<input type="time" name="q_end" class="input input-bordered input-primary w-full max-w-xs" value="<?php echo $qinfo['q_end']; ?>">
				</div>

				<!-- Quest description input -->
                <div>
					<label class="label">
						<span class="label-text">Description</span>
					</label>
					<textarea name="q_desc" rows="5" class="textarea textarea-primary w-full max-w-xs"><?php echo $qinfo['q_desc']; ?></textarea>
				</div>

				<!-- SAVE BUTTON -->
				<div>
					<button type="submit" name="edit" class="btn btn-primary hover:bg-secondary active:hover:bg-secondary w-full max-w-xs">
                            Save
                        </button>
				</div>

				<!-- ERROR MESSAGES -->
				<p class="text-red-600 text-center">
                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo "(!) All fields must be filled up.";
                            }
							else if ($_GET["error"] == "stmtfailed") {
								echo "(!) Something went wrong.<br> Please try again.";
							}
							else if ($_GET["error"] == "cantdelete") {
								echo "(!) Unable to delete.";
							}
							if ($_GET["error"] == "timeclash") {
                                echo "(!) Time is clashing with other quests.";
                            }
						}
                    ?>
                </p>
			</div>
            </section>
		</form>
		</main>
	</body>
</html>