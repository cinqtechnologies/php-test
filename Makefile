configure:
	@# configure - Must be executed after cloning the project in order to set up the environment.
	make up && \
	make composer-install && \
	make migrate && \
	make database-seed && \
	make codesniffer && \
	make test && \
	make logs-directory

up:
	@# up - docker-compose up with server start.
	@docker-compose up -d
	@docker exec -it ecommerce_php sh -c "service nginx start"

down:
	@# down - Stop and remove all containers.
	@docker-compose down

restart:
	@# restart - Restart all containers.
	@docker-compose down && docker-compose up -d
	@docker exec -it ecommerce_php sh -c "service nginx start"

test:
	@# test - Run unit tests (PHPUnit).
	@docker exec -it ecommerce_php sh -c "cd /www/ecommerce && ./bin/phpunit $(ARGS)"

composer-update:
	@# composer-update - Update composer dependencies.
	@docker exec -it ecommerce_php sh -c "cd /www/ecommerce && composer update"

composer-install:
	@# composer-install - Install composer dependencies.
	@docker exec -it ecommerce_php sh -c "cd /www/ecommerce && composer install"

autoload:
	@# autoload - Update classes autoload.
	@docker exec -it ecommerce_php sh -c "cd /www/ecommerce && composer dump-autoload"

migrate:
	@# migrate - Setup database and tables.
	@docker exec -it ecommerce_php sh -c "cd /www/ecommerce && ./bin/phinx migrate"

database-seed:
	@# database-seed - Populate database with testing initial records.
	@docker exec -it ecommerce_php sh -c "cd /www/ecommerce && ./bin/phinx seed:run"

codesniffer:
	@# codesniffer - Run code sniffer on: src/Ecommerce.
	@docker exec -it ecommerce_php sh -c "cd /www/ecommerce && ./bin/phpcs --standard=psr2 -p src/Ecommerce"

phpmd:
	@# phpmd - Run PHP Mess Detector on: src/Ecommerce.
	@docker exec -it ecommerce_php sh -c "cd /www/ecommerce && ./bin/phpmd src/Ecommerce text cleancode"

build:
	@# build - Run unit test, codesniffer and php mess detector.
	@echo ""
	@echo "> UNIT TEST"
	@echo ""
	@make test
	@echo ""
	@echo "> CODESNIFFER"
	@echo ""
	@make codesniffer
	@echo ""
	@echo "> PHPMD"
	@echo ""
	@make phpmd

help:
	@# help - Show this help text.
	@./bin/MakefileHelp.sh

logs-directory:
	@# logs-directory - Create logs file.
	@mkdir -p logs && chmod 777 logs/
