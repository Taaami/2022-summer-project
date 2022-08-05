# 作品名
一句话简介
## 功能清单
## 本项目用到的关键技术
## 快速上手体验
通过 `bash build.sh` 方式部署后，打开浏览器访问: `http://localhost:9000/demo` 即可快速体验系统所有功能。
>`手动配置过程见附录-2`
## 演示
视频
## 附录-1 项目测试验证环境信息
```
Client:
 Version:           20.10.14+dfsg1
 API version:       1.41
 Go version:        go1.18.1
 Git commit:        a224086
 Built:             Sun May  1 19:59:40 2022
 OS/Arch:           linux/amd64
 Context:           default
 Experimental:      true

Server:
 Engine:
  Version:          20.10.14+dfsg1
  API version:      1.41 (minimum version 1.12)
  Go version:       go1.18.1
  Git commit:       87a90dc
  Built:            Sun May  1 19:59:40 2022
  OS/Arch:          linux/amd64
  Experimental:     false
 containerd:
  Version:          1.6.6~ds1
  GitCommit:        1.6.6~ds1-1
 runc:
  Version:          1.1.3+ds1
  GitCommit:        1.1.3+ds1-2
 docker-init:
  Version:          0.19.0
  GitCommit:        

VirtualBox : Linux kali 5.15.0-kali3-amd64 #1 SMP Debian 5.15.15-2kali1 (2022-01-31) x86_64 GNU/Linux
Mysql : Ver 14.14 Distrib 5.7.24, for Linux (x86_64) using  EditLine wrapper
PHP : PHP 8.1.2 (cli) (built: Jan 27 2022 01:00:14) (NTS)
Python : Python 3.9.10
Apache2 : Server version Apache/2.4.54 (Debian)
```
## 附录-2 配置本项目
```shell
#!/bin/bash
# build.sh
# 下载安装docker
sudo apt-get install docker.io
# 进入镜像文件
cd docker/demo
# 使用Dockerfile 创建镜像
sudo docker build -t demo:v3 .
# 创建并运行
sudo docker run -d --name test -p 9000:80 demo:v3
# 查看运行状态
sudo docker ps
# 浏览器访问localhost:9000/demo
```
## 附录-3
