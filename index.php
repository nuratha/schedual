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

	// Get system time
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$ztime = date("H:i");
	$zday = date("l");
	
	// Gets day from url
	if(isset($_GET["day"])) {
		$day = mysqli_real_escape_string($con, $_GET['day']);
		
		// Invalid day in url
		if ($_GET["day"] !== "Monday" && $_GET["day"] !== "Tuesday" && $_GET["day"] !== "Wednesday" && $_GET["day"] !== "Thursday" && $_GET["day"] !== "Friday" && $_GET["day"] !== "Saturday" && $_GET["day"] !== "Sunday") {
			echo "(!) URL ERROR: " . $day . " is not a valid day.";
		}
	}
	else {
		$day = mysqli_real_escape_string($con, $zday);
	}

	//Log query
	$qquery = mysqli_query($con, "SELECT * FROM questlog 
									JOIN calclog on calclog.tid = questlog.tid
									WHERE questlog.user_ID = '$id' AND q_day = '$day' ORDER BY q_start");
	
?>

	<!-- BODY -->
		<header class="p-6 flex justify-between space-x-3 bg-primary">
			<div></div>
			<div class="flex justify-content space-x-3">
				<div>
					<!-- Home icon -->
					<svg class="fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="30">
					<path d="M10.707 2.293a1 1 0 0 0-1.414 0l-7 7a1 1 0 0 0 1.414 1.414L4 10.414V17a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-6.586l.293.293a1 1 0 0 0 1.414-1.414l-7-7z"/>
					</svg>
				</div>
				<div>
					<h1 class="font-serif text-2xl text-white">
					Quests Log
					</h1>
				</div>
			</div>
			<div>
			<?php
				echo '<h2 class="font-serif text-white">' . $ztime . '</h2>';
			?>
			</div>
		</header>

<!-- CONTENTS -->

		<main> 
			<section class="p-6">
				<div class="p-6 flex space-x-3 justify-between">
					<!-- Day -->
					<div class="flex space-x-3 items-center">
						<div class="dropdown">
							<label tabindex="0" class="btn m-1 border-0 bg-primary hover:bg-secondary active:bg-secondary focus:bg-secondary font-serif text-white">Day</label>
							<ul tabindex="0" class="dropdown-content menu p-2 shadow bg-slate-700 text-white rounded-box w-52">
								<li><a href="./index.php?day=Monday">Monday</a></li>
								<li><a href="./index.php?day=Tuesday">Tuesday</a></li>
								<li><a href="./index.php?day=Wednesday">Wednesday</a></li>
								<li><a href="./index.php?day=Thursday">Thursday</a></li>
								<li><a href="./index.php?day=Friday">Friday</a></li>
								<li><a href="./index.php?day=Saturday">Saturday</a></li>
								<li><a href="./index.php?day=Sunday">Sunday</a></li>
							</ul>
						</div>

						<div>
							<p class="font-serif uppercase font-semibold text-black">
								: <?php echo $day; ?>
							</p>
						</div>
					</div>
					
					<div>
						<!-- Add icon -->
						<a href="./add_select.php">
							<svg class="fill-primary hover:fill-secondary active:fill-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="50">
							<path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-11a1 1 0 1 0-2 0v2H7a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2V7z" clip-rule="evenodd"/></svg>
						</a>
					</div>
				</div>

<!-- TABLE -->
				<div class="p-6 grid grid-cols-3 place-items-center bg-primary font-serif uppercase text-white">
					<!-- head -->
					<div>Time</div>
					<div>Log</div>
					<div>Check!</div>
				</div>
				<div class="p-3 grid grid-cols-3 place-items-center gap-3 bg-white">
					<!-- records -->  
					<?php
						if (mysqli_num_rows($qquery) > 0) {
							while ($quest = mysqli_fetch_assoc($qquery)) {
								$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
								$day_now = array_search($zday, $days);
								$day_q = array_search($quest['q_day'], $days);
								//Labeling
								if ($quest['cid'] == 1) { // ACTIVE INDICATOR
									$badge = '';
									$symbol = '';
								}
								else if ($quest['cid'] == 2) { //COMPLETE INDICATOR
									$badge = 'badge-accent';
									$symbol = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20">
									<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>';
								}
								else if ($quest['cid'] == 3) { //LATE PENALITY INDICATOR
									$badge = 'badge-warning';
									$symbol = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
								}

								echo 
								'<div>' . substr($quest['q_start'], 0, 5) . ' - ' . substr($quest['q_end'], 0, 5)  . '</div>
								<div><a class="font-bold underline decoration-2 hover:text-primary focus:text-white" href="./view_' . $quest['tname'] . '.php?qid='.$quest['q_id'].'">' . $quest['q_name'] .'</a> <span class="badge ' . $badge . '">' . $quest['tname'] . '</span></div>
									<div><form action="includes/check.inc.php" method="post">
										<input type="hidden" name="id" value="' . $id .'">
										<input type="hidden" name="ztime" value="' . $ztime .'">
										<input type="hidden" name="zday" value="' . $zday .'">
										<input type="hidden" name="pgday" value="' . $day .'">
										<input type="hidden" name="q_end" value="' . $quest['q_end'] .'">
										<input type="hidden" name="q_day" value="' . $quest['q_day'] .'">
										<input type="hidden" name="qid" value="' . $quest['q_id'] .'">
										<input type="hidden" name="tid" value="' . $quest['tid'] .'">
										<input type="hidden" name="boole" value="' . $quest['cid'] .'">
										<button type="submit" name="check" class="btn btn-square btn-outline">
											' . $symbol . '
										</button>
									</form></div>';
							}
						}
						else {
							echo 
							'<div> </div>
							<div>Nothing here yet!</div>
							<div> </div>
							<div> </div>';
						}
					?>
				</div>
			</section>
		</main>

<!-- FOOTER GOES HERE -->
<?php
	include_once './footer.php';
?>