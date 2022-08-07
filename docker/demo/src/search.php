<?php
//调入头文件
include_once('sys/config.php');
include_once('header.php');

if (!empty($_GET['search'])) {
	$the_search = $_GET['search'];
	//防止sql注入...
	$query = "SELECT * FROM comment WHERE comment_text like '%{$the_search}%' LIMIT 1;";
	$data = mysqli_query($dbc,$query);	
?>

<div class="row">
<div class="message-title-big">留言板</div>
<?php
while($com = mysqli_fetch_array($data)) {
	$html['username'] = htmlspecialchars($com['user_name']);
	$html['comment_text'] = htmlspecialchars($com['comment_text']);	
	echo '<div class="message-content-body">';
	echo '<div class="message-user">'.$html['username'].'</div>';
	echo '<div class="message-content">'.$html['comment_text'].'</div>';
	echo '</div>';
}
if (isset($_SESSION['username']))
{?>
</div>
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
}
require_once('footer.php');
?>