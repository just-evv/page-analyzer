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
	docker-compose up -d
	docker-compose exec -T analyzer php artisan migrate
	npm install

compose:
	docker-compose up -d

lint:
	composer run-script phpcs -- --standard=PSR12 app tests

deploy:
	git push heroku main

docker-migrate:
	docker-compose exec -T analyzer php artisan migrate

test:
	docker-compose exec -T analyzer php artisan test

test-coverage:
	./vendor/bin/phpunit --coverage-clover coverage.xml tests

