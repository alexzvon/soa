test:
	ls

host:
	sudo echo "10.10.20.15 arw.loc" >> /etc/hosts

build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

exec:
	docker-compose exec --user local php_fpm /bin/sh

root:
	docker-compose exec php_fpm /bin/sh

ps:
	docker-compose ps

rm:
	docker rm $(docker ps -aq)

rmi:
	docker rmi -f $(docker images -q)

