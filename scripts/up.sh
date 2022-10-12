#!/usr/bin/env bash

cd ..
docker-compose up -d

apps=`ls ./apps`
for app in $apps
do
    echo -e "Building docker image at \033[0;32m./apps/$app\033[0m..."
    (cd "./apps/$app" && bash "build.sh")
done

for app in $apps
do
    echo -e "Creating docker container at \033[0;32m./apps/$app\033[0m..."
    (cd "./apps/$app" && bash "startup.sh")
done
