start: docker-clear docker-build docker-up composer-install
test: test-unit load-fixtures test-functional

docker-clear:
	docker-compose down --remove-orphans

docker-build:
	docker-compose build

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

composer-install:
	docker-compose run --rm vacancy-php-cli composer install

migration:
	docker-compose run --rm vacancy-php-cli php bin/console do:mi:di

migrate:
	docker-compose run --rm vacancy-php-cli php bin/console do:mi:mi

load-fixtures:
	docker-compose run --rm vacancy-php-cli php bin/console doctrine:fixtures:load --no-interaction

test-unit:
	docker-compose run --rm vacancy-php-cli php bin/phpunit --testsuite=Unit

test-functional:
	docker-compose run --rm vacancy-php-cli php bin/phpunit --testsuite=Functional

generate-doc:
	docker-compose run --rm vacancy-php-cli php bin/console doc:generate

clear:
	docker-compose run --rm vacancy-php-cli php bin/console cache:clear

create-admin:
	docker-compose run --rm vacancy-php-cli php bin/console admin:create
