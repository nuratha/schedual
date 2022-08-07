<?php
	//-- HEADER GOES HERE --
	include_once './header.php';
?>

	<!-- BODY -->

		<header class="p-6 flex justify-center space-x-3 bg-slate-900">
			<h1 class="font-serif text-2xl text-white text-center">
                Log In
            </h1>
		</header>

		<!-- CONTENTS -->

		<main class="p-10 bg-slate-900">
            <form action="includes/login.inc.php" method="post">
                <div class="p-6 container w-96 bg-white flex flex-col place-items-center space-y-3">
                <form action="includes/login.inc.php" method="post">
                    <!-- Email input -->
                    <div>
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="text" name="email" class="input input-bordered input-primary w-full max-w-xs" placeholder="name@email.com">
                    </div>
                    
                    <!-- Pswd input -->
                    <div>
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="pswd" class="input input-bordered input-primary w-full max-w-xs" placeholder="*******">
                    </div>

                    <br>

                    <!-- LOGIN BUTTON -->
                    <div>
                        <button type="submit" name="submit" class="btn btn-primary hover:bg-secondary active:hover:bg-secondary w-full max-w-xs">
                            Log In
                        </button>
                    </div>

                    <!-- ERROR MESSAGES -->
                    <p class="text-red-600 text-center">
                        <?php
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "(!) All fields must be filled up.";
                                }
                                
                                else if ($_GET["error"] == "bademail") {
                                    echo "(!) Email is not registered.";
                                }
                                
                                else if ($_GET["error"] == "badlogin") {
                                    echo "(!) Email or password does not match.";
                                }

                                else if ($_GET["error"] == "stmtfailed") {
                                    echo "(!)Something went wrong.<br>Please try again.";
                                }
                            }
                        ?>
                    </p>

                    <!-- NAVIGATION -->
                    <div>
                        <label class="underline text-violet-900 hover:text-amber-500 active:hover:text-amber-300"><a href="./signup.php">
                            Or Sign Up!
                        </a></label>
                    </div>
                </form>
                </div>
            </form>
        </main>
	</body>
</html>