<?php
//update 头像
include_once('../sys/config.php');
$uploaddir = '../images';//基础路径的相对路径

if (isset($_POST['submit']) && isset($uploaddir)) {
	//在此之前，开始判断这个是不是一个jpg文件
	// File information
    $uploaded_name = $_FILES['upfile'][ 'name' ];
    $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
    $uploaded_size = $_FILES['upfile'][ 'size' ];
    $uploaded_tmp  = $_FILES['upfile'][ 'tmp_name' ];
	// Is it an image?
	if(!(strtolower( $uploaded_ext ) == "jpg" &&   $uploaded_size < 1000000 && getimagesize( $uploaded_tmp))) {
		echo 'not a jpg file!<br />';
	}
	else {	
    	if (move_uploaded_file($_FILES['upfile']['tmp_name'], $uploaddir . '/' . $_FILES['upfile']['name'])) {//判断是否上传成功！
        	echo 'success!save：' . $uploaddir . '/' . $_FILES['upfile']['name'] . "\n";
			//更新用户信息
			$clean_user_avatar = $uploaddir . '/' .$_FILES['upfile']['name'];
			$query = "UPDATE users SET user_avatar = '$clean_user_avatar' WHERE user_id = '{$_SESSION['user_id']}'";
			mysqli_query($dbc,$query) or die('updata error!');
			mysqli_close($dbc);
			//刷新缓存
			$_SESSION['avatar'] = $clean_user_avatar;
			header('Location: edit.php');
    	}
		else {//上传失败
			echo 'already exists the same one!<br />';
			echo '<a href="edit.php">return</a>';
		}
	}
}
else {
	not_find($_SERVER['PHP_SELF']);
}
?>