PORT = 8000
SERVER = 0.0.0.0
ASTAROTH_PATH = vendor/labile/astaroth-core/
DOCTRINE_BIN_PATH = vendor/bin/doctrine
DEV_DOMAIN = astarothdev

up-dev:
	php -S $(SERVER):$(PORT)

up-container:
	docker-compose -f docker/docker-compose.yml up

forward:
	ssh -R 80:$(SERVER):$(PORT) nokey@localhost.run

gen-entity:
	$(DOCTRINE_BIN_PATH) orm:schema-tool:update --force

drop-entity:
	$(DOCTRINE_BIN_PATH) orm:schema-tool:drop --force

gen-env:
	cp -n $(ASTAROTH_PATH)tests/.env .env

update:
	composer update