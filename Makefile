test:
	ls

build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

exec-site:
	docker-compose exec --user local php_fpm_site /bin/sh

exec-wh:
	docker-compose exec --user local php_fpm_wh /bin/sh

root-site:
	docker-compose exec php_fpm_site /bin/sh

root-wh:
	docker-compose exec php_fpm_wh /bin/sh

ps:
	docker-compose ps

