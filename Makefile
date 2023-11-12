build-php:
	docker build -f ./Dockerfile.php -t api-application:8.3 .

build-nginx:
	docker build -f ./Dockerfile.nginx -t api-nginx:latest .

build-minio:
	docker build -f ./Dockerfile.minio -t api-minio:latest .

build-all: build-php build-nginx

push:
	docker tag api-application:8.3 necodeo/api-application:8.3
	docker push necodeo/api-application:8.3

	docker tag api-nginx:latest necodeo/api-nginx:latest
	docker push necodeo/api-nginx:latest

	docker tag api-minio:latest necodeo/api-minio:latest
	docker push necodeo/api-minio:latest

run-php:
	docker run -d --name php -p 9000:9000 -v $(PWD):/var/www/html api-application:8.3

run-nginx:
	docker run -d --name nginx -p 80:80 -v $(PWD):/var/www/html -v $(PWD)/.docker-config/conf.d/default.conf:/etc/nginx/conf.d/default.conf api-nginx:latest

run-minio:
	docker run -d --name minio -p 9030:9000 -p 9031:9031 -v $(PWD)/minio/data:/data -v $(PWD)/minio/config:/root/.minio api-minio:latest server /data

run-all: run-php run-nginx

stop-php:
	docker stop php

stop-nginx:
	docker stop nginx

stop-all: stop-php stop-nginx

rm-php:
	docker rm php

rm-nginx:
	docker rm nginx

rm-all: rm-php rm-nginx

rmi-php:
	docker rmi api-application:8.2

rmi-nginx:
	docker rmi api-nginx:latest

rmi-all: rmi-php rmi-nginx
