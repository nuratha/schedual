<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pswd = $_POST["pswd"];
    $pswdConfirm = $_POST["pswdConfirm"];

    require_once 'dbh.inc.php';
    require_once 'fx.inc.php';

    // CHECKS EMPTY INPUT
    if (emptyInputSignup($username, $email, $pswd, $pswdConfirm) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    // CHECKS BAD EMAIL
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    // CHECKS MISMATCHED PASSWORD
    if (matchPswd($pswd, $pswdConfirm) !== false) {
        header("location: ../signup.php?error=pswdnotmatch");
        exit();
    }

    // CHECKS EXISTING EMAIL
    if (existAcc($con, $email) !== false) {
        header("location: ../signup.php?error=emailtaken");
        exit();
    }

    createUser($con, $username, $email, $pswd); // CREATES ACCOUNT

}
else {
    header("location: ../signup.php");
    exit();
}