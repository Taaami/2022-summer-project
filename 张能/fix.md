# sql修复

- 根据break工作记录，需要修复sql注入漏洞，主要是针对search输入语句如select、order一类做拦截，阻止查询数据库的动作

- 在文件`search.php`做修改，加入过滤语句
  
  ![](img\search_php.png)

- 修改后使用sql注入语句测试修复效果
  
  ![](img\'.png)
  
  输入'后有回显
  
  ![](img\order.jpg)
  
  输入order语句被拦截，无法查询数据库
  
  ![](img\select.png)
  
  输入search语句同样被拦截，无法查询表名等数据

- 测试运行自动化break脚本`exp.py`
  
  ![](img\test.png)
  
  无法完成漏洞攻击
