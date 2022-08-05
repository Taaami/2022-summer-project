<?php
include_once('../sys/config.php');


if (isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
	
	//净化sql注入....
	$clean_name = $_POST['user'];
	$clean_name = stripslashes($clean_name);//简单防一下sql
	//$clean_name = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $clean_name ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));

	$clean_pass = $_POST['pass'];
	$clean_pass = stripslashes($clean_pass);
	//$clean_pass = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $clean_pass ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));

    $query = "SELECT * FROM users WHERE user_name = '$clean_name' AND user_pass = SHA('$clean_pass')";

    $data = mysqli_query($dbc, $query) or die('Error!!');
	mysqli_close($dbc);

    if (mysqli_num_rows($data) == 1) {
        $row = mysqli_fetch_array($data);
		$_SESSION['username'] = $row['user_name'];
		$_SESSION['avatar'] = $row['user_avatar'];
		
        header('Location: user.php');
        }
	else {
		sleep(4);//输错了会有一定的延时
		$_SESSION['error_info'] = '用户名或密码错误';
		header('Location: login.php');
	}
	
		
}
else {
	not_find($_SERVER['PHP_SELF']);
}
?>