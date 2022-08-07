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
    // Randomise 
    $random = rand(1,9);
    // Query
	$query = mysqli_query($con, "SELECT * FROM userlog WHERE user_ID = '$id'");
	$row = mysqli_fetch_array($query);
?>

<!-- BODY -->

		<header class="p-6 flex justify-center space-x-3 bg-primary">
			<div>
                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="30">
                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" /></svg>
            </div>
            <h1 class="font-serif text-2xl text-white">
                Advice corner
            </h1>
		</header>

    <!-- CONTENT -->

        <main class="p-6">
            <!-- Sheep -->
            <section class="p-6 grid grid grid-row-2 gap-4 place-items-center">
				<div>
					<img src="./img/burnout_wizard.png" width="200">
				</div>
                
                <!-- NPC -->
                <div class="p-6 container w-full justify-center bg-white border-2">
                    <h3 class="font-serif font-medium text-primary">
                        Productivity Sheep
                    </h3>
                    <div>
<!-- NPC DIALOGUE -->
                        <p class="text-slate-700 text-justify">
                        <?php
         //COLLECTION OF RESPONSES
                            if (isset($_GET["response"])) {
                                if ($_GET["response"] == "OK") {
                                    echo "Hoho! Splendid! Keep on at it, then. Make sure to take care of yourself while you're at it!";
                                }
                                if ($_GET["response"] == "burnt") {
                                    echo "I see. Are you multitasking a few tasks?";
                                }
                                if ($_GET["response"] == "tired") {
                                    echo "Oh, are you perhaps lacking sleep?";
                                }
                                if ($_GET["response"] == "multitask") {
                                    echo "You might be overburdened. Try focusing on the ones with higher priority and keep the less important ones for later. Or do the easiest ones first!";
                                }
                                if ($_GET["response"] == "oversleep") {
                                    echo "Oversleeping can cause you to become slower! Which fits you most?";
                                }
                                if ($_GET["response"] == "nosleep") {
                                    echo "That's no good. You may not feel it now, but neglecting sleep can affect your performance. Which fits you most?";
                                }
                                if ($_GET["response"] == "sleeptrain") {
                                    echo "A good idea would be to set a time for you to sleep and try following that! Perhaps aim for an hour earlier than usual. Keep repeating that and you'll adjust yourself back to normal!";
                                }
                                if ($_GET["response"] == "alarm") {
                                    echo "Perhaps it's your alarm song! You won't wake up if it's set as your favourite song or calming tune. You might need something... alarming!";
                                }
                                if ($_GET["response"] == "bluelight") {
                                    echo "Have you been looking at your screen at night? Perhaps it's the bluelight affecting you. Perhaps try a filter for that! Or reduce your time online at night.";
                                }
                                if ($_GET["response"] == "grog") {
                                    echo "Perhaps your energy is low! Try doing stretches daily and eat more healthy food to get your energy back!";
                                }
                                if ($_GET["response"] == "perfection") {
                                    echo "'Finished, not perfect'! The best thing to do is to aim for completion first. If you have spare time afterwards, THEN aim to perfect the work!";
                                }
                                if ($_GET["response"] == "capable") {
                                    echo "The first step is the biggest step! Let's try doing at least a tiny chunk of it. You'll feel much better, trust me.";
                                }
                                if ($_GET["response"] == "start") {
                                    echo "Ask a friend, teacher or workmate! Sometimes it's good to have outside help, even if it's just mental support. You might even get an idea while chatting!";
                                }
                                if ($_GET["response"] == "choose") {
                                    echo "Hmmm... which one fits you most?";
                                }
                            }
        //COLLECTION OF ADVICES
                            else if (isset($_GET["advice"])) {
                                if ($_GET["advice"] == "1") {
                                    echo "Some say doing stretches before work helps energise you!";
                                }
                                if ($_GET["advice"] == "2") {
                                    echo "Talk to someone! Verbalising your thoughts can sometimes help you find an answer than when you're thinking by yourself.";
                                }
                                if ($_GET["advice"] == "3") {
                                    echo "Games can be addicting! I recommend avoiding them until you finish your goals for the day as motivation to complete your work.";
                                }
                                if ($_GET["advice"] == "4") {
                                    echo "Sometimes it's best to remove yourself from work for a bit and rest when you're stuck. When you come back, you might be sharp enough to solve the problem!";
                                }
                                if ($_GET["advice"] == "5") {
                                    echo "Never be afraid of asking for help. Sometimes it takes a team to tackle a task!";
                                }
                                if ($_GET["advice"] == "6") {
                                    echo "Are you the type to work with music? Finding new tunes can help refresh you!";
                                }
                                if ($_GET["advice"] == "7") {
                                    echo "Keep your posture correct when working! You don't want a sore neck or back.";
                                }
                                if ($_GET["advice"] == "8") {
                                    echo "Discover new hobbies during your freetime! It can help with stress.";
                                }
                                if ($_GET["advice"] == "9") {
                                    echo "If you like munching on things, try having fruits nearby as a healthier alternative! They also help hydrate and keep you energised.";
                                }
                            }
        //GREETING
                            else {
                                echo "Hey, " . $row['user_name'] . "! How're you doing today?";
                            }
                        ?>
                        </p>
                    </div>

<!-- USER OPTIONS -->
                    <div class="p-6 flex flex-col space-y-3 align-center">
                        <?php
        //COLLECTION OF WORKLOAD-RELATED RESPONSES
                            if (isset($_GET["work"])) {
                                if ($_GET["work"] == "choose") {
                                    echo "<a href='./burnout.php?response=multitask&fine=OK'><button class='btn btn-outline w-full'>
                                    I'm juggling too much
                                    </button></a>";

                                    echo "<a href='./burnout.php?response=choose&sleep=choose'><button class='btn btn-outline w-full'>
                                    I feel tired
                                    </button></a>";
                                    
                                    echo "<button class='btn btn-outline' onclick='history.go(-1);'>
                                    [Back]
                                    </button>";
                                }
                                if ($_GET["work"] == "unstart") {
                                    echo "<a href='./burnout.php?response=choose&work=avoid'><button class='btn btn-outline w-full'>
                                    I'm avoiding my work
                                    </button></a>";

                                    echo "<a href='./burnout.php?response=start&fine=OK'><button class='btn btn-outline w-full'>
                                    I don't know how to start
                                    </button></a>";
                                    
                                    echo "<button class='btn btn-outline' onclick='history.go(-1);'>
                                    [Back]
                                    </button>";
                                }
                                if ($_GET["work"] == "avoid") {
                                    echo "<a href='./burnout.php?response=perfection&fine=OK'><button class='btn btn-outline w-full'>
                                    I want it perfect
                                    </button></a>";

                                    echo "<a href='./burnout.php?response=capable&fine=OK'><button class='btn btn-outline w-full'>
                                    I don't think I'm capable to do it
                                    </button></a>";
                                    
                                    echo "<button class='btn btn-outline' onclick='history.go(-1);'>
                                    [Back]
                                    </button>";
                                }
                            }
        //COLLECTION OF MENTAL HEALTH-RELATED RESPONSES
                            else if (isset($_GET["mh"])) {
                                if ($_GET["mh"] == "choose") {
                                    echo "<a href='./burnout.php?response=choose&work=choose'><button class='btn btn-outline w-full'>
                                    I feel overworked
                                    </button></a>";
    
                                    echo "<a href='./burnout.php?response=capable&fine=OK'><button class='btn btn-outline w-full'>
                                    I can't seem to start anything
                                    </button></a>";

                                    echo "<a href='./burnout.php?response=choose&work=unstart'><button class='btn btn-outline w-full'>
                                    I don't feel like doing anything
                                    </button></a>";
                                        
                                    echo "<button class='btn btn-outline' onclick='history.go(-1);'>
                                    [Back]
                                    </button>";
                                }
                            }
        //COLLECTION OF SLEEP-RELATED RESPONSES
                            else if (isset($_GET["sleep"])) {
                                if ($_GET["sleep"] == "choose") {
                                    echo "<a href='./burnout.php?response=oversleep&sleep=over'><button class='btn btn-outline w-full'>
                                    I've been oversleeping.
                                    </button></a>";

                                    echo "<a href='./burnout.php?response=nosleep&sleep=lack'><button class='btn btn-outline w-full'>
                                    I've been sleeping less.
                                    </button></a>";

                                    echo "<a href='./burnout.php?response=choose&mh=choose'><button class='btn btn-outline w-full'>
                                    My sleeping is fine
                                    </button></a>";
                                    
                                    echo "<button class='btn btn-outline' onclick='history.go(-1);'>
                                    [Back]
                                    </button>";
                                }
                                if ($_GET["sleep"] == "lack") {
                                    echo "<a href='./burnout.php?response=sleeptrain&fine=OK'><button class='btn btn-outline w-full'>
                                    It's hard to fall asleep.
                                    </button></a>";
    
                                    echo "<a href='./burnout.php?response=bluelight&fine=OK'><button class='btn btn-outline w-full'>
                                    My sleep schedule is bad.
                                    </button></a>";
                                        
                                    echo "<button class='btn btn-outline' onclick='history.go(-1);'>
                                    [Back]
                                    </button>";
                                }
                                if ($_GET["sleep"] == "over") {
                                    echo "<a href='./burnout.php?response=alarm&fine=OK'><button class='btn btn-outline w-full'>
                                    I keep missing my alarm.
                                    </button></a>";

                                    echo "<a href='./burnout.php?response=choose&mh=choose'><button class='btn btn-outline w-full'>
                                    I don't want to start the day
                                    </button></a>";
    
                                    echo "<a href='./burnout.php?response=grog&fine=OK'><button class='btn btn-outline w-full'>
                                    I'm always sleepy now
                                    </button></a>";
                                        
                                    echo "<button class='btn btn-outline' onclick='history.go(-1);'>
                                    [Back]
                                    </button>";
                                }
                            }
        //COLLECTION OF FINISHING RESPONSES
                            else if (isset($_GET["fine"])) {
                                if ($_GET["fine"] == "OK") {
                                    echo "<a href='./burnout.php?response=OK&fine=finish'><button class='btn btn-outline w-full'>
                                    I'll do that!
                                    </button></a>";
    
                                    echo "<a href='./burnout.php?advice=".$random."&fine=OK'><button class='btn btn-outline w-full'>
                                    Do you have more advice?
                                    </button></a>";
                                        
                                    echo "<button class='btn btn-outline' onclick='history.go(-1);'>
                                    [Back]
                                    </button>";
                                }
                                if ($_GET["fine"] == "finish") {
                                    echo "<a href='./burnout.php'><button class='btn btn-outline w-full'>
                                    [Talk again]
                                    </button></a>";
                                }
                            }
        //STARTING OPTIONS
                            else {
                                echo "<a href='./burnout.php?response=OK&fine=finish'><button class='btn btn-outline w-full'>
                                I'm OK!
                                </button></a>";
                                echo "<a href='./burnout.php?response=choose&work=choose'><button class='btn btn-outline w-full'>
                                A little burnt out
                                </button></a>";
                                echo "<a href='./burnout.php?response=choose&mh=choose'><button class='btn btn-outline w-full'>
                                Mentally drained...
                                </button></a>";
                            }
                        ?>
                    </div>
                </div>
            </section>
        </main>
    </body>

    <!-- FOOTER GOES HERE -->
<?php
	include_once './footer.php';
?>