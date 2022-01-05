PORT = 8000
SERVER = 0.0.0.0
ASTAROTH_PATH = vendor/labile/astaroth-core/
DOCTRINE_BIN_PATH = vendor/bin/doctrine

forward:
	@./lt --port 8000 --subdomain vkcallback --print-requests

up-dev:
	@php -S $(SERVER):$(PORT)

up-container:
	@docker-compose -f $(DOCKER_COMPOSE_PATH) up -d --remove-orphans

remove-container:down-container
	@docker-compose -f $(DOCKER_COMPOSE_PATH) rm

logs-container:
	@docker-compose -f $(DOCKER_COMPOSE_PATH) logs -f

clear-logs-container:
	@sudo sh -c "truncate -s 0 /var/lib/docker/containers/*/*-json.log"

ps-container:
	@docker-compose -f $(DOCKER_COMPOSE_PATH) ps

down-container:
	@docker-compose -f $(DOCKER_COMPOSE_PATH) down

drop-entity:
	@docker-compose -f $(DOCKER_COMPOSE_PATH) exec app php $(DOCTRINE_BIN_PATH) orm:schema-tool:drop --force

update:
	@composer update

migration:
	@docker-compose -f $(DOCKER_COMPOSE_PATH) exec app php $(DOCTRINE_BIN_PATH) orm:schema-tool:update --force

php-docker:
	@docker run -ti -v $(shell pwd):/app:rw denissliva/php8.1-astaroth sh