# soa

Скачать клон

>git clone https://github.com/alexzvon/soa.git

Перейти в корневой каталог soa

>cat .env.example > .env

Перейти каталог сайта site.loc

>cd site
>cat .env.example > .env

Перейти в корневой каталог soa

>cd ..

Перейти каталог сайта weater_history.loc

>cd weater_history
>cat .env.example > .env

Перейти в корневой каталог soa

>cd ..

Под root добавить в /etc/hosts 

10.10.77.15    site.loc
10.10.77.18    weater_history.loc

Перед началом сборки рекомендую очистить все имиджи.
Что бы вы могли нормально работать с исходным текстом laravel необходимо согласовать ваш рабочий UID пользователя и GID группы.
По умолчанию стоит UID = 1000 и GID = 1000, если есть отличия тогда нужно найти строку 
&& set -eux; addgroup -g 1000 -S local; adduser --u 1000 -D -S -G local local; sed -i s/www-data/local/g /usr/local/etc/php-fpm.d/www.conf \
в файле config/php_fpm/Dockerfile и поменять на нужные.
 
Перейти в корневой каталог soa

Запускаем проект

>make up

если сборка прошла успешно - то должны стартовать все контейнеры, проверить можно командой

>make ps

должна показаться что-то вроде этого

      Name                    Command               State          Ports       
-------------------------------------------------------------------------------
soa_mysql          docker-entrypoint.sh --def ...   Up      3306/tcp, 33060/tcp
soa_nginx_site     /docker-entrypoint.sh ngin ...   Up      80/tcp             
soa_nginx_wh       /docker-entrypoint.sh ngin ...   Up      80/tcp             
soa_php_fpm_site   docker-php-entrypoint supe ...   Up      9000/tcp           
soa_php_fpm_wh     docker-php-entrypoint supe ...   Up      9000/tcp           
soa_redis          docker-entrypoint.sh redis ...   Up      6379/tcp   

Теперь необходимо создать БД. Сервер находится 10.10.77.12 root:qazwsxedc
БД должны называться site и wh. 
Как создать? способов много, я это делал через MySqlWorkBench, у когото может другой способ. 
Оставляю на ваше усмотрение. 

Можете использовать другой сервер - только не забудьте изменить доступ на сайтах.


Переходим в контейнер сайта site.loc

>make exec-site

Собираем сайт site.loc

>composer install
>npm install && npm run dev
>php artisan migrate
>exit


Переходим в контейнер сайта weater_history.loc

>make exec-wh

Собираем сайт weater_history.loc

>composer install
>npm install && npm run dev
>php artisan migrate
>php artisan db:seed --class=HistorySeeder
>exit

Набираем в браузере site.log - все вуаля.
