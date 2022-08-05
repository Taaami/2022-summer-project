<?php
include_once('../sys/config.php');
include_once('../header.php');

if(isset($_SESSION['error_info']) && $_SESSION['error_info'] != '') {
	echo $_SESSION['error_info'];
	$_SESSION['error_info'] = '';
}
?>
<div class="login-body">
    <form class="bs-example form-horizontal login-form" action="logCheck.php" method="post" name="log">
        <div class="login-title">登录</div>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">用户名：</label>
            <div class="col-lg-3">
                <input type="text" name="user" class="form-control login-input" id="inputEmail">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">密码：</label>
            <div class="col-lg-3">
                <input type="password" name="pass" class="form-control login-input" id="inputEmail" onblur="check()">
            </div>
            <div class="submit"><input type="submit" name="submit" class="btn submit-btn" value="登录"/></div>
        </div>				  
    </form>
</div>
<?php
require_once('../footer.php');
?>