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

	$query = mysqli_query($con, "SELECT * FROM userLog WHERE user_ID = '$id';");
	$row = mysqli_fetch_array($query);
?>

	<!-- BODY -->

		<header class="p-6 flex justify-center space-x-3 bg-primary">
			<div>
				<svg class="fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="30">
					<path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
				  </svg>
			</div>
			<div>
				<h1 class="font-serif text-2xl text-white">
				Checkpoint
				</h1>
			</div>
		</header>

		<!-- CONTENTS -->

		<main> 
			<section class="p-3 place-items-center bg-primary">
			<!-- RANKING TABLE -->
				<div class="p-6 bg-white grid grid-cols-2 grid-rows-2 place-items-center drop-shadow-lg">
					<div class="text-amber-600 font-medium text-xl">
						<?php echo $row['w_1']; ?>
					</div>
					<div class="text-amber-600 font-medium text-xl">
						<?php echo $row['rank']; ?>
					</div>
					<div><p>
						Accumulated EXP
					</p></div>
					<div><p>
						Weekly Rank
					</p></div>
				</div>
			</section>

			<section class="p-6 flex justify-center">
				<form action="includes/turnin.inc.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id?>">
					<input type="hidden" name="w1" value="<?php echo $row['w_1']?>">
					<button type="submit" name="turn" class="btn btn-accent hover:btn-secondary active:btn-secondary">Save this week's progress!</button>
				</form>
			</section>

<!-- PROGRESS CHART -->

			<section class="p-6">
				<div>
					<canvas id="myCheckpoint">Failed to load chart.</canvas>
				</div>
				<script>
					// LABELS
					var xValues = ["3 weeks ago", "2 weeks ago", "Last week", "This week"];
					
					// EXPERIENCE POINTS
					var yValues = [
						<?php echo $row['w_4']; ?>, 
						<?php echo $row['w_3']; ?>, 
						<?php echo $row['w_2']; ?>,
						<?php echo $row['w_1']; ?>
					];
					
					// CUSTOMISATION
					var barColors = [
						"#8B5CF6", 
						"#8B5CF6",
						"#8B5CF6",
						"#F59E0B"
					];
					
					// RENDERS CHART
					new Chart("myCheckpoint", {
					type: "bar",
					data: {
						labels: xValues,
						datasets: [{
						backgroundColor: barColors,
						data: yValues,
						}]
					},
					options: {
						plugins: {
							// Removes legend up top
							legend: {
								display: false
							},
							// Chart title
							title: {
								display: true,
								text: "Productivty Chart",
								font: {
									size: 16
								}
								}
							}
						}
					});
					</script>
			</section>
		</main>

<!-- FOOTER GOES HERE -->
<?php
	include_once './footer.php';
?>