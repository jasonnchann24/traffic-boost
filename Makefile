cp-env:
	cp ./environments/.env.api ./api/.env
	cp ./environments/.env.client ./client/.env

php: 
	docker-compose exec php bash

node:
	docker-compose exec client /bin/sh

install-app: build-laravel build-nuxt permissions

build-laravel:
	docker-compose down
	cp ./environments/.env.api api/.env
	sudo chown ${USER}:${USER} -R api
	sudo chgrp -R www-data api/storage api/bootstrap/cache
	sudo chmod -R 775 api/storage api/bootstrap/cache
	docker-compose up -d
	docker-compose exec php composer install
	docker-compose exec php php artisan key:generate

build-nuxt:
	docker-compose down
	sudo chown ${USER}:${USER} -R client
	cp ./environments/.env.client client/.env
	docker-compose up -d

permissions:
	sudo chown -R www-data:www-data api/storage
	sudo chmod -R 775 api/bootstrap/cache
	sudo chmod -R 775 api/storage

storage:
	docker-compose exec php php artisan storage:link