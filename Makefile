SERVER = 0.0.0.0:8000
ASTAROTH_PATH = vendor/labile/astaroth-core/
DOCTRINE_BIN_PATH = vendor/bin/doctrine

up-dev:
	php -S $(SERVER)

gen-entity:
	$(DOCTRINE_BIN_PATH) orm:schema-tool:update --force

gen-env:
	cp -n $(ASTAROTH_PATH)tests/.env .env