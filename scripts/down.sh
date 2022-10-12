#!/usr/bin/env bash
cd ..
sudo chmod 666 /var/run/docker.sock
docker stop $(docker ps -a -q)
