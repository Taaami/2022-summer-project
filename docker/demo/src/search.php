<?php
//调入头文件
include_once('sys/config.php');//config嵌套了lib
include_once('header.php');

if (!empty($_GET['search'])) {
	//$the_search = isNotXss($_GET['search']);
	$the_search = $_GET['search'];
	//防止sql注入...
	//$data = $dbc->prepare('SELECT * FROM comment WHERE comment_text LIKE ? LIMIT 1;');
	$query = "SELECT * FROM comment WHERE comment_text like '%{$the_search}%' LIMIT 1;";
	
	//$data->execute();
	$data = mysqli_query($dbc,$query);	
?>

<div class="bs-example table-responsive">
	<?php echo 'The result for'.$the_search.'is:'?>
	<table class="table table-striped table-hover ">
	<tr>
		<th>用户名</th>
		<th>留言</th>
	</tr>
<?php
while($com = mysqli_fetch_array($data)) {
	$html['username'] = htmlspecialchars($com['user_name']);
	$html['comment_text'] = htmlspecialchars($com['comment_text']);
	
	echo '<tr>';
	echo '<td>'.$html['username'].'</td>';
	echo '<td>'.$html['comment_text'].'</td>';
	echo '</tr>';
}
if (isset($_SESSION['username']))
{?>
	
	</table>
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