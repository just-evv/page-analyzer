start:
	php artisan serve --host 127.0.0.1

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi

compose:
	docker-compose up

lint:
	composer run-script phpcs routes/web.php app/Http/Controllers/UrlController.php

deploy:
	git push heroku main

migrate:
	php artisan migrate

test:
	php artisan test



