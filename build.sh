#!/bin/bash
sudo apt-get install docker.io
cd docker/demo
sudo docker build -t demo:v3 .
sudo docker run -d --name test -p 9000:80 demo:v3
sudo docker ps