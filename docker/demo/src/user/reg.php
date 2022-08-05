<?php
include_once('../sys/config.php');
require_once('../header.php');

if(isset($_SESSION['error_info']) && $_SESSION['error_info'] != '') {
	echo $_SESSION['error_info'];
	$_SESSION['error_info'] = '';
}
?>
<div class="login-body">
    <form class="bs-example form-horizontal login-form" action="regCheck.php" method="post" name="reg">
        <div class="login-title">注册</div>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">用户：</label>
            <div class="col-lg-3">
                <input type="text" name="user" class="form-control login-input" id="inputEmail">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">新密码：</label>
            <div class="col-lg-3">
                <input type="password" name="passwd" class="form-control login-input" id="inputEmail">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">确认：</label>
            <div class="col-lg-3">
                <input type="password" name="passwd2" class="form-control login-input" id="inputEmail" onblur="check()">
            </div>
            <div class="submit"><input type="submit" name="submit" class="btn submit-btn" value="注册"/></div>
        </div>				  
    </form>
</div>
<script src="../js/check.js"></script>
<?php
require_once('../footer.php');
?>
