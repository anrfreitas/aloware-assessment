#!/usr/bin/env bash

(
    # trying to start an existing container
    docker container start zero-laravel &&
    echo -e "Container \033[0;32mzero-laravel\033[0m was started!"
)||
(
    # if previous command failed, we'll create a new container
    docker run --name zero-laravel -d -p 9010:9010 --net=aloware-assessment_normal -v $(pwd)/app:/app zero/laravel-image &&
    echo -e "Container \033[0;32mzero-laravel\033[0m was created!"
)
