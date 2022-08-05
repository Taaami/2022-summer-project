<?php
include_once('../sys/config.php');
//设置CSRFtoken
$token = getToken();
$_SESSION['token'] = $token;
if (isset($_SESSION['username'])) {
	include_once('../header.php');
	$html_avatar = htmlspecialchars($_SESSION['avatar']);
	$html_username = htmlspecialchars($_SESSION['username']);

	if(isset($_SESSION['error_info']) && $_SESSION['error_info'] != '') {
		echo $_SESSION['error_info'];
		$_SESSION['error_info'] = '';
	}
?>
<form action="updateName.php" method="post" name="update_name" class="bs-example form-horizontal">
	<input type="hidden" name="id" value="<?php echo $_SESSION['user_id']?>">
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">用户名：</label>
                <div class="col-lg-3">
                    <input type="text" name="username" value="<?php echo $html_username?>" class="form-control" id="inputEmail">
				</div>
				<div class="submit-new edit"><input type="submit" name="submit" class="btn submit-btn" value="更新"/></div>
        </div>
</form>
<form class="bs-example form-horizontal" action="updatePass.php" method="get" name="update_passwd">
	<legend></legend>
    <div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">新密码：</label>
        <div class="col-lg-3">
            <input type="password" name="passwd" class="form-control" id="inputEmail">
        </div>
	</div>
	<div class="form-group">
		<label for="inputEmail" class="col-lg-2 control-label">确认：</label>
        <div class="col-lg-3">
			<input type="password" name="passwd2" class="form-control" id="inputEmail" onblur="check()">
        </div>
		<div  class="submit-new edit"><input type="submit" name="submit" class="btn submit-btn" value="更新"/></div>
    </div>
    <input type="hidden" name="token" value="<?=$token?>" />
</form>

<form class="bs-example form-horizontal" action="updateAvatar.php" method="post" enctype="multipart/form-data" name="upload">
	<legend></legend>                 
	<div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">头像：</label>
		<div>
			<img src="<?php echo $html_avatar?>" width="100" height="100" class="img-thumbnail upload-img">
			<input type="file" name="upfile" class="upload">
		</div>
		<div class="submit-new edit"><input type="submit" name="submit"  class="btn submit-btn" value="上传"/></div>
    </div>
	<div class="form-group" style="padding-left:15px">
		<label></label>
		<div class="operate">
		<a href="user.php"><button type="button" class="btn btn-primary">返回</button></a>
		</div>
	</div>
</form>
<script src="../js/check.js"></script>
<?php 
require_once('../footer.php');
}
//用户没有登录
else {
	not_find($_SERVER['PHP_SELF']);
}
?>