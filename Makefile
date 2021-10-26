start:
	php artisan serve --host 127.0.0.1

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi

compose:
	docker-compose up

lint:
	composer phpcs

deploy:
	git push heroku main

migrate:
	php artisan migrate

test:
	php artisan test

lint:
	composer phpcs
