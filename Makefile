.DEFAULT_GOAL := help

build:
	docker-compose build

serve:
	docker-compose up -d

stop:
	docker-compose stop

applogin:
	docker-compose exec app bash

dblogin:
	docker-compose exec db bash

	
