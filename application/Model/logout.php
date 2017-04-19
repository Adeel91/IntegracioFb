<?php

session_start();
session_unset();
$_SESSION['FBID'] = NULL;
$_SESSION['FULLNAME'] = NULL;
$_SESSION['EMAIL'] = NULL;
$_SESSION['Video'] = NULL;

header("Location: index.php");
?>
