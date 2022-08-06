<?php
//调入头文件
ini_set("display_error",'on');
include_once('sys/config.php');//config嵌套了lib
include_once('header.php');

//test
//
function inject_check($sql_str)     
{     
      return preg_match('/(select)|(insert)|(update)|(delete)|(order)|(union)/i',$sql_str);
}
function verify_id($id=null)     
{     
    if (!$id) { exit('没有提交参数！'); } // 是否为空判断     
    elseif (inject_check($id)) { exit('提交的参数非法！'); } // 注射判断     
    elseif (!is_numeric($id)) { exit('提交的参数非法！'); } // 数字判断     
    $id = intval($id); // 整型化         
    return $id;     
}     
//test

if (!empty($_GET['search'])) {
	if (inject_check($_GET['search'])){     
       		echo '你提交的数据非法，请检查后重新提交！';     
	}
	else{
   		$the_search = isNotXss($_GET['search']);	
    	//else     
    	//{     
        //	$id = verify_id($_GET['search']); // 这里引用了我们的过滤函数，对$id进行过滤     
        //	echo '提交的数据合法，请继续！';     
    	//}
	//防止sql注入...
	//$data = $dbc->prepare('SELECT * FROM comment WHERE comment_text LIKE ? LIMIT 1;');
	//$search = mysql_real_escape_string($the_search)
		$query = "SELECT * FROM comment WHERE comment_text like '%{$the_search}%' LIMIT 1;";
	
	//$data->execute();
		$data = mysqli_query($dbc,$query);
	}	
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
