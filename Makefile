start:
	php artisan serve --host 127.0.0.1

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	docker compose exec laravel.test php artisan migrate
	npm install

install:
	composer install
	cp -n .env.example .env || true


compose:
	docker-compose up -d

lint:
	composer run-script phpcs -- --standard=PSR12 app/Http/Controllers

deploy:
	git push heroku main

migrate:
	php artisan migrate

test:
	php artisan test

test-coverage:
	./vendor/bin/phpunit --coverage-clover coverage.xml tests

