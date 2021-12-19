<?php
    session_start();
    $_SESSION['user'] = null;
    $_SESSION["userid"] = null;
    session_destroy();
    header("location: SignIn.php")
?>