<?php
require_once('sys/config.php');
require_once('header.php');

$query = "SELECT * FROM comment ORDER BY comment_id";
$data = mysqli_query($dbc,$query) or die('Error!!');
mysqli_close($dbc);
?>
<div class="row">
<div class="message-title-big">留言板</div>
<?php
while($com = mysqli_fetch_array($data)) {
	//净化输出变量
	$html['username'] = htmlspecialchars($com['user_name']);
	$html['comment_text'] = htmlspecialchars($com['comment_text']);

	echo '<div class="message-content-body">';
	echo '<div class="message-user">'.$html['username'].'</div>';
	echo '<div class="message-content">'.$html['comment_text'].'</div>';
	echo '</div>';
}
?>
</div>
<?php 
if (isset($_SESSION['username']))
{?>
<div class="row">
	<div class="message-title">留言区</div>
	<form action="messageSub.php" method="post" name="message">
		<div class="message-body">
			<textarea class="form-control" rows="3" id="textArea" name="message"></textarea>
		</div>
		<div class="submit-new">
			<input type="submit" name="submit" class="btn submit-btn" value="留言"/>
			<a href="user/user.php" class="return">返回</a>
		</div>
	</form>
</div>
<?php 
}

require_once('footer.php');
?>