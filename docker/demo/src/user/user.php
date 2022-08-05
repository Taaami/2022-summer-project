<?php
include_once('../sys/config.php');
if (isset($_SESSION['username'])) {
	include_once('../header.php');
	if (!isset($SESSION['user_id'])) {
		$query = "SELECT * FROM users WHERE user_name = '{$_SESSION['username']}'";
		$data = mysqli_query($dbc,$query) or die('Error!!');
		mysqli_close($dbc);
		$result = mysqli_fetch_array($data);
		$_SESSION['user_id'] = $result['user_id'];
	}

	//净化输出变量
	$html_avatar = htmlspecialchars($_SESSION['avatar']);

	//print_r($_SESSION);
?>
<div class="row">
	<div class="message-title">用户头像</div>
	<img src="<?php echo $html_avatar?>" width="100" height="100" class="img-thumbnail user-ava" >
	<div class="message-title">用户名</div>
	<div class="user-name"><?php echo $_SESSION['username']?></div>
	
	<div class="operation">
		<div class="operate"><a href="logout.php"><button type="button" class="btn btn-primary">退出</button></a></div>
		<div class="operate"><a href="edit.php"><button type="button" class="btn btn-primary">编辑</button></a></div>
		<div class="operate"><a href="../message.php"><button type="button" class="btn btn-primary">发留言</button></a></div><br /><br /><br /><br />
	</div>
</div>
<?php 
	require_once('../footer.php');
}
else {
	not_find($_SERVER['PHP_SELF']);
}
?>