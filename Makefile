SHELL=/bin/bash
## or docker compose 
DCC=docker compose

.DEFAULT_GOAL := help

start: up composer-install ## Run containers, composer install and migrate

up: ## Run containers
	$(DCC) up -d --remove-orphans

up-force: ## Run containers with --force
	$(DCC) up -d --force-recreate --remove-orphans --timeout 5

stop: ## Stop containers
	$(DCC) stop --timeout 5

down: stop ## Down containers
	$(DCC) down

build: ## Build containers with --pull
	$(DCC) build --pull

composer-install: ## Run composer install
	$(DCC) exec php-fpm composer i

schema-update: ## Run containers and run doctrine:migrations:migrate
	$(DCC) exec php-fpm bin/console d:m:m --no-interaction

schema-down: ## Run containers and run doctrine:migrations:migrate prev
	$(DCC) exec php-fpm bin/console d:m:m prev --no-interaction

fixtures-load: ## Run containers and run doctrine:fixtures:load
	$(DCC) exec php-fpm bin/console doctrine:fixtures:load

make-migration: ## Make migration
	$(DCC) exec php-fpm bin/console make:migration

cs: ## Run composer fix-cs
	$(DCC) exec php-fpm composer fix-cs

stan: ## Run composer phpstan
	$(DCC) exec php-fpm composer stan

md: ## Run composer phpmd
	$(DCC) exec php-fpm composer md

deptrac: ## Run composer deptrac
	$(DCC) exec php-fpm composer deptrac

bash: ## Run exec bash
	$(DCC) exec php-fpm bash

codecept: ## Run codecept run
	$(DCC) exec php-fpm composer test

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
