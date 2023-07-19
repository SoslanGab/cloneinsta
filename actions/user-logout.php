<?php

session_start();
setcookie('stayLoggedIn', false);
setcookie('id', false);
setcookie('username', false);
setcookie('pfpLink', false);
session_destroy();

header ("Location: ../index.php");
exit();