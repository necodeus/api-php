#!/bin/bash

docker rm \
    -f api-nginx

docker run \
    -d \
    -p "80:80" \
    -v "./.docker-config/conf.d/default.conf:/etc/nginx/conf.d/default.conf" \
    -v "./.:/var/www/html" \
    -v "exclude:/var/www/html/vendor" \
    --name api-nginx api-nginx:latest
