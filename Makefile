start:
	php artisan serve --host 127.0.0.1

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	php artisan migrate
	npm install

docker-setup:
	docker run --rm -v $(PWD):/app composer/composer:latest install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	docker run -d -p 5432:5432 postgres:13
	php artisan migrate


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

