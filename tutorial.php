<?php
	//-- LOGIN SESSION --
	session_start();
	
	//-- HEADER GOES HERE --
	include_once './header.php';

	// Makes changes faster and easier
	$css1 = 'collapse collapse-arrow border border-base-300 bg-slate-900 rounded-box">
	<div class="collapse-title text-lg font-medium';
	$css2 = 'collapse-content';
	$txt = 'text-justify';
?>

	<!-- BODY -->

	<body class="p-6 bg-primary content-center text-white">
		<header class="p-6 flex justify-between">
			<div class="flex space-x-3">
				<div>
					<!-- Tutorial icon -->
					<svg class="fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="30">
						<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
					</svg>
				</div>
				<div>
					<h1 class="font-serif text-2xl text-white text-center">
					Tutorial
					</h1>
				</div>
			</div>
			<div>
            	<a href="./profile.php">
					<!-- Exit icon -->
					<svg class="fill-white hover:fill-secondary active:fill-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40">
						<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
					</svg>
				</a>
			</div>
		</header>

	<!-- CONTENTS -->

		<main class="p-6">
<!-- System -->
			<!-- SCHEDUAL -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					Why SCHEDUAL?
				</div>
				<div class="<?php echo $css2 ?>"> 
					<p class="<?php echo $txt ?>">SCHEDUAL is a type of scheduling app that integrates basic gaming terminology and mechanics in an effort to encourage users to complete their work task by creating an environment where they may perceive it as a game quest.<br>The system lightly models that of modern online tabletop games - where you create your own characters, assign your own tasks and relevant reward and level your characters up through your created scenarios, while also keeping the interface of a distiguishable scheduling app as to not overwhelm or distract users.<br>SCHEDUAL aims to help users increase their productivity and help them maintain their schedules.</p>
				</div>
			</div>

<!-- Screen types -->
			<!-- Quest page -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					What is the "Quest Log" screen?
				</div>
				<div class="<?php echo $css2 ?>"> 
					<p class="<?php echo $txt ?>">The Quest Log screen is where all your created schedules are shown. Each log is labelled with the type of quest it is (quest/idle). A button for each quest is shown on the right side of the screen, where you can mark your task completion to keep track of your progress. Depending on your timing and the type of quest, you will be given EXP or HP, or even a late penalty!<br>You may create new quests through the (+) button on the top right.</p>
				</div>
			</div>
			<!-- Advice page -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					What is the "Advice Corner" screen?
				</div>
				<div class="<?php echo $css2 ?>"> 
					<p class="<?php echo $txt ?>">The Advice Corner screen allows users to "chat" with a magical sheep! Choose answers that are relevant to your experience, and the Productivity Sheep will help assess your procrastination with tips. You may also receive randomised advice by clicking "Do you have more advice?".</p>
				</div>
			</div>
			<!-- Checkpoint page -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					What is the "Checkpoint" screen?
				</div>
				<div class="<?php echo $css2 ?>"> 
					<p class="<?php echo $txt ?>">The Checkpoint screen will display your weekly progress of the current week, and past 3 weeks for you to compare and monitor your productivity. Your weekly EXP gain will be accumulated and ranked. SCHEDUAL encourages you to complete at least 5 task in a week for a perfect score! You may also save your weekly progress before moving onto the next week.</p>
				</div>
			</div>
			<!-- Profile page -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					What is the "Profile" screen?
				</div>
				<div class="<?php echo $css2 ?>"> 
					<p class="<?php echo $txt ?>">The Profile screen will display your personal avatar. The avatar will have its own EXP and HP counter, where any task completed or neglected will affect his health! The more productive you become, the higher it will level up as well! It will also display your username, email, the tutorial section and the logout button.<br>As of now, the avatar is a knight, and cannot be customisable.</p>
				</div>
			</div>

<!-- Quest types -->
			<!-- Quests -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					What are "Quest" tasks?
				</div>
				<div class="<?php echo $css2 ?>"> 
					<p class="<?php echo $txt ?>">Quests are work-related tasks you create from the "Add Quest" page. Add as many as you like! Completing a quest ontime will reward you EXP that will be fed to your knight. You can still earn EXP on quests that were turned in "late", but your HP will be deducted as penalty! Try to make it ontime for your duties!</p>
				</div>
			</div>
			<!-- Idle -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					What are "Idle" tasks?
				</div>
				<div class="<?php echo $css2 ?>"> 
					<p class="<?php echo $txt ?>">Idle tasks are freetime activities you create from the "Add Idle" page. Add as many as you like! Completing an idle task will recover your avatar's HP. However, the HP is capped at a maximum of 100%.<br>SCHEDUAL encourages you to take breaks alongside pushing you to complete quests ontime, as your health matters as well!</p>
				</div>
			</div>	 

<!-- Point types -->
			<!-- EXP -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					What is EXP? How do I earn it?
				</div>
				<div class="<?php echo $css2 ?>"> 
					<p class="<?php echo $txt ?>">Experience Points (EXP) are earned by completing quest tasks! Earn as much EXP as possible to level up your avatar.</p>
				</div>
			</div>
			
			<!-- HP -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					What is HP? How do I earn it?
				</div>
			<div class="<?php echo $css2 ?>"> 
				<p class="<?php echo $txt ?>">Health Points (HP) are earned by completing "idle" tasks! Be sure to keep your avatar's health bar full.</p>
				</div>
			</div>
<!-- Other functions & miscellaneous -->
			<!-- Save weekly progress -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					What is the "Save This Week's Progress" in the Checkpoint screen?
				</div>
				<div class="<?php echo $css2 ?>"> 
				<p class="<?php echo $txt ?>">When the week is done, you are encouraged to hit the button to save your collected EXP for that week. The week will then refresh, and you can start anew! This is so that you have your personal scoreboard to monitor your progress. You can pace yourself as flexible as you need, starting on any day of the week!</p>
				</div>
			</div>
			<!-- I accidentally marked my quests as completed! -->
			<div tabindex="0" class="<?php echo $css1 ?>">
			I accidentally marked my quests as completed!
				</div>
				<div class="<?php echo $css2 ?>"> 
				<p class="<?php echo $txt ?>">No worries! Simply uncheck your progress and the points will be reverted. Your progress will only fully save when you hit the "Save This Week's Progress" in the Checkpoint screen.</p>
				</div>
			</div>
			<!-- Avatar -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					Can I customise the avatar?
				</div>
				<div class="<?php echo $css2 ?>"> 
				<p class="<?php echo $txt ?>">Currently, the avatar cannot be changed. Please treat your knight well!</p>
				</div>
			</div>
			<!-- Idle terminology -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					Why "Idle"?
				</div>
				<div class="<?php echo $css2 ?>"> 
				<p class="<?php echo $txt ?>">The term derives from the gaming environment where a player is considered "idle" when they do other things for a long period of time while the game is still running (Leaving the computer/room, eating, on another tab/program). Using this terminology for assigned breaks and freetime activities was suitable as your game (tasks) are still ongoing, but you're taking a little rest.</p>
				</div>
			</div>

<!-- Contact -->
			<div tabindex="0" class="<?php echo $css1 ?>">
					I need more help!
				</div>
				<div class="<?php echo $css2 ?>"> 
					<p class="<?php echo $txt ?>">Don't worry! You can contact us via <b>20200147@student.iumw.edu.my</b> for further questions, or if you run into any issues.</p>
				</div>
			</div>	
		</main>
	</body>
</html>