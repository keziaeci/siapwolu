<?php 
session_start();
$_SESSION = [];
session_unset();
session_destroy();

//menghapus cookie
setcookie('num', '', time() - 3600);
setcookie('key', '', time() - 3600);
setcookie('pwsni', '', time() - 3600);

header("Location: welcome.php");
exit;
?>