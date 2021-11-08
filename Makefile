start:
	php artisan serve --host 127.0.0.1

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi

	php artisan migrate
	npm install

compose:
	docker-compose up

lint:
	composer run-script phpcs -- --standard=PSR12 app/Http/Controllers

deploy:
	git push heroku main

migrate:
	php artisan migrate

test:
	php artisan test



