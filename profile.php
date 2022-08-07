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

	$query = mysqli_query($con, "SELECT * FROM userlog WHERE user_ID = '$id'");
	$row = mysqli_fetch_array($query);
?>

<!-- BODY -->

		<header class="p-6 flex justify-center space-x-3 bg-primary">
			<div>
				<!-- Profile icon -->
				<svg class="fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="30">
				<path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
				</svg>
			</div>
			<div>
				<h1 class="font-serif text-2xl text-white">
				Profile
				</h1>
			</div>
		</header>
		
<!-- PROFILE -->
		<main class="p-6">
			<div class="p-4 flex justify-between">
			<div class="self-center">
					<a href="./tutorial.php">
						<!-- Tutorial icon -->
						<button class="btn btn-primary text-white hover:btn-secondary active:btn-secondary">
						<svg stroke="currentColor" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="25">
						<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
						</svg>
						Tutorial
					</button></a>
				</div>
				
				<div>
					<!-- Logout icon -->
					<a href="./includes/logout.inc.php">
						<button class="btn btn-primary text-white hover:btn-secondary active:btn-secondary">
							<svg stroke="currentColor" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="25"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" /></svg>
							Logout
						</button>
					</a>
				</div>
			</div>
			
		<!-- ACCOUNT INFO -->

			<section class="p-10 bg-white grid grid-cols-2 place-items-center">
				<!-- Avatar -->
				<div>
					<?php
						if ($row['ava_hp'] > 70) {
							$hpbar = 'progress-accent';
							echo '<img src="./img/avatar_regular.png"><br>
									<p class="text-center">Your knight is doing well!</p>';
						}
						else if ($row['ava_hp'] < 31) {
							$hpbar = 'progress-warning';
							echo '<img src="./img/avatar_low.png"><br>
							<p class="text-center">Your knight is too tired!</p>';
						}
						else {
							$hpbar = 'progress-secondary';
							echo '<img src="./img/avatar_mid.png"><br>
							<p class="text-center">Your knight is holding on.</p>';
						}
					?>
				</div>

				<div>
					<?php
						echo '
						<h1 class="font-serif uppercase text-primary font-bold text-lg">' . $row['user_name'] . '</h1>
						<h6 class="font-serif text-gray-400">Email: ' . $row['user_email'] . '</h6>
						
						<br><br>

						<h2 class="font-medium">
							LEVEL: ' . $row['ava_lv'] . '<br>
							HP: <progress class="progress ' . $hpbar . '  w-full max-w-xs" value="' . $row['ava_hp'] . '" max="100"></progress> '. $row['ava_hp'] . '</span> / 100<br><br>
							EXP: <progress class="progress  w-full max-w-xs" value="' . $row['total_exp'] . '" max="100"></progress> ' . $row['total_exp'] . '</span> / 100<br>
						</h2>';
					?>
				</div>
			</section>
		</main>

<!-- FOOTER GOES HERE -->
<?php
	include_once './footer.php';
?>