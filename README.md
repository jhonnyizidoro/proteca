# PROTECA

## How to get it running using docker

1 - Clone the repository
>git clone https://github.com/jhonnyizidoro/proteca.git

2 - Create the .env file and configure **DB_DATABASE, DB_USERNAME and DB_PASSWORD**
>cd proteca

>cp .env.example .env

3 - Install Docker containers, this will take a while
>docker-compose up

4 - Access docker PHP/Apache container
>docker exec -it Proteca_web /bin/bash

5 - Install laravel
>composer install

6 - Generate a new APP_KEY
>php artisan key:generate

7 - Create database tables
>php artisan migrate

>php artisan db:seed