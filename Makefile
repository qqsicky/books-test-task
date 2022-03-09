up:
	docker-compose up -d

down:
	docker-compose down

down-clear:
	docker-compose down -v --remove-orphans

in-php:
	docker-compose exec books-php bash

composer-install:
	docker-compose exec books-php composer install

recreate-db:
	docker-compose run books-php bin/console d:m:m first --no-interaction
	docker-compose run books-php bin/console d:m:m --no-interaction
	docker-compose run books-php bin/console d:f:l --no-interaction

start-tests:
	docker-compose exec books-php ./vendor/bin/phpunit tests

cache-clear:
	docker-compose exec books-php bin/console c:c

first-run:
	up composer-install recreate start-tests
