<?php
    //php block to clear all session variables and send the user back to login page
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['inputUser']);
    unset($_SESSION['inputPass']);
    unset($_SESSION['firstName']);
    unset($_SESSION['lastName']);
    header("Location: userlogin.php?logout=true");
?>

