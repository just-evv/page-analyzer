setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi

compose:
	docker-compose up

lint:
	composer phpcs

deploy:
	git push heroku

migrate:
	php artisan migrate
