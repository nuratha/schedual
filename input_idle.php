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

?>

<!-- BODY -->
		<header class="p-6 flex justify-center space-x-3 bg-primary">
			<div>
				<!-- Back icon -->
				<a href="./add_select.php">
					<svg xmlns="http://www.w3.org/2000/svg" class="fill-white hover:fill-amber-500 active:fill-amber-300" viewBox="0 0 20 20" width="30">
					<path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
				</a>
			</div>
			<h1 class="font-serif text-2xl text-white">
                Idle Details
            </h1>
		</header>

<!-- CONTENTS -->
		<main class="p-6"> 
		<form action="includes/idle.inc.php" method="post">
			<section class="p-6 flex justify-center bg-white">
				<input type="hidden" name="tid" value="2">
				<div>
				<!-- Quest name input -->
				<label class="label">
					<span class="label-text">Idle title</span>
				</label>
				<div>
					<input type="text" name="q_name" class="input input-bordered input-primary w-full max-w-xs" placeholder="Idle name">
				</div>

				<!--Day input -->
				<div>
					<label class="label">
						<span class="label-text">Day</span>
					</label>
					<select name="q_day" class="input input-bordered input-primary w-full max-w-xs">
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
					<input type="time" name="q_start" class="input input-bordered input-primary w-full max-w-xs">
				</div>

				<!-- End time input -->
				<div>
					<label class="label">
						<span class="label-text">End time</span>
					</label>
					<input type="time" name="q_end"  class="input input-bordered input-primary w-full max-w-xs">
				</div>

				<!-- Quest description input -->
                <div>
					<label class="label">
						<span class="label-text">Description</span>
					</label>
					<textarea name="q_desc" rows="5" class="textarea textarea-primary w-full max-w-xs" placeholder="Idle description"></textarea>
				</div>
				<!-- SAVE BUTTON -->
				<div>
					<button type="submit" name="submit" class="btn btn-primary hover:bg-secondary active:hover:bg-secondary w-full max-w-xs">
                            Add
                        </button>
				</div>

				<!-- ERROR MESSAGES -->
				<p class="text-red-600 text-center">
                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo "(!) All fields must be filled up.";
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