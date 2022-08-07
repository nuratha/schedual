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
				<!-- Back icon -->
				<a href="./index.php">
					<svg xmlns="http://www.w3.org/2000/svg" class="fill-white hover:fill-amber-500 active:fill-amber-300" viewBox="0 0 20 20" width="30">
					<path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
				</a>
			</div>
			<h1 class="font-serif text-2xl text-white">
                Select Quest
            </h1>
		</header>

		<!-- CONTENTS -->

		<main class="p-6 container"> 
            <section class="p-6 text-center font-semibold">
                <p>
                    Choose a category for your task!
                </p>
            </section>
			
			<!-- Quest icon -->
			<section class="grid grid-cols-2 gap-2 place-items-center">
                <div class="p-6 bg-white hover:bg-gray-200 active:bg-amber-200">
					<a href="./input_quest.php"><img src="./img/avatar_quest.png" width="350"></a>
					<h6 class="text-center text-xl font-medium underline">
                        Quest
                    </h6>
					<p class="text-center">
						Tasks related to work or school.
					</p>
				</div>
            
            <!-- Idle icon -->
                <div class="p-6 bg-white hover:bg-gray-200 active:bg-amber-200">
					<a href="./input_idle.php"><img src="./img/avatar_idle.png" width="350"></a>
                    <h6 class="text-center text-xl font-medium underline">
                        Idle
                    </h6>
					<p class="text-center">
						Breaks and leisure activity.
					</p>
				</div>
			</section>
		</main>
	</body>
</html>