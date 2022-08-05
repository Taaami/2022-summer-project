<?php
include_once('../sys/config.php');
if($_GET['token'] == $_SESSION['token']){
    unset($_SESSION['token']);
}else{
    die("Hacker Forbiden");
}
if (!empty($_GET['passwd'])) {
	//$clean_passwd = clean_input($_GET['passwd']);
	$clean_passwd = $_GET['passwd'];
	$query = "UPDATE users SET user_pass = SHA('$clean_passwd') WHERE user_id = '{$_SESSION['user_id']}'";
	mysqli_query($dbc,$query) or die("updata error!");
	mysqli_close($dbc);
	echo 2;
	header('Location: edit.php');
}
else {
	not_find($_SERVER['PHP_SELF']);
}
?>