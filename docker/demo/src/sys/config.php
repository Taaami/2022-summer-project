<?php

//链接数据库
$host = '127.0.0.1';//本机地址
$username = 'root';//账户名
$password = 'root';//密码
$database = 'project';//数据库名
$dbc = mysqli_connect($host, $username, $password, $database);//创建数据库对象

if (!$dbc)
{
	echo mysql_error();
}

//启用session
session_start();

//根目录
$basedir = '/demo'; 

//载入函数库
include_once('lib.php');
?>
