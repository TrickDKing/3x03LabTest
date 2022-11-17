#!/usr/bin/env sh

set -x
docker run -d -p 80:80 --name my-apache-php-app -v /home/labtest/src:/var/www/html php:7.2-apache
sleep 1
set +x 
