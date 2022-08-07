<?php
	//-- HEADER GOES HERE --
	include_once './header.php';
?>

<!-- BODY -->

		<header class="p-6 flex justify-center space-x-3 bg-slate-900">
			<h1 class="font-serif text-2xl text-white text-center">
                Sign Up
            </h1>
		</header>

		<!-- CONTENTS -->

		<main class="p-10 bg-slate-900">
                <div class="p-6 container w-96 bg-white flex flex-col place-items-center space-y-3">
                <form action="includes/signup.inc.php" method="post">
                    <!-- Username input -->
                    <div>
                        <label class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text" name="username" class="input input-bordered input-primary w-full max-w-xs" placeholder="Maxwell">
                    </div>
                    
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
                    
                    <!-- Confirm pswd input -->
                    <div>
                    <label class="label">
                        <span class="label-text">Confirm password</span>
                    </label>
                    <input type="password" name="pswdConfirm" class="input input-bordered input-primary w-full max-w-xs" placeholder="*******">
                    </div>

                    <br>
                    
                    <!-- SIGNUP BUTTON -->
                    <div>
                        <button type="submit" name="submit" class="btn btn-primary hover:bg-secondary active:hover:bg-secondary w-full max-w-xs">
                            Sign Up
                        </button>
                    </div>
                    
                    <!-- ERROR MESSAGES -->
                    <p class="text-red-600 text-center">
                        <?php
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "(!) All fields must be filled up.";
                                }
                                
                                else if ($_GET["error"] == "invalidemail") {
                                    echo "(!) Invalid email input.";
                                }
                                
                                else if ($_GET["error"] == "pswdnotmatch") {
                                    echo "(!) Passwords did not match.";
                                }
                                
                                else if ($_GET["error"] == "emailtaken") {
                                    echo "(!) This email is already taken.";
                                }

                                else if ($_GET["error"] == "stmtfailed") {
                                    echo "(!) Something went wrong.<br> Please try again.";
                                }

                                else if ($_GET["error"] == "none") {
                                    echo "Successfully signed up!";
                                }
                            }
                        ?>
                    </p>

                    <br>
                    
                    <!-- NAVIGATION -->
                    <div>
                        <h2 class="underline text-violet-900 hover:text-amber-500 active:hover:text-amber-300 text-center"><a href="./login.php">
                            Log In Here!
                        </a></h2>
                    </div>
                    </form>
                </div>
        </main>
	</body>
</html>