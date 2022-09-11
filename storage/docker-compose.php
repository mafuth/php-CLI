<?php
$output="version: '20.10.17'
services:
    php-apache-environment:
        container_name: php-apache
        restart: always
        build:
            context: ./php
            dockerfile: Dockerfile
        depends_on:
            - db
        volumes:
            - ./php/src:/var/www/html/
        ports:
            - '8000:".$config['port']."'
    db:
        container_name: db
        image: mysql
        restart: always
        environment:
            MYSQL_ROOT_PASSWORD: 'root'
            MYSQL_DATABASE: '".$config['dbname']."'
            MYSQL_USER: '".$config['username']."'
            MYSQL_PASSWORD: '".$config['password']."'
        ports:
            - '9906:3306'
    phpmyadmin:
      image: phpmyadmin/phpmyadmin
      ports:
          - '8080:".$config['port']."'
      restart: always
      environment:
          PMA_HOST: db
      depends_on:
          - db";