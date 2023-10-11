docker rm -f api-php
docker run -d -p "9000:9000" -v ".\\:/var/www/html" -v "exclude:/var/www/html/vendor" --name api-php api-php:latest
docker exec -it api-php composer install
