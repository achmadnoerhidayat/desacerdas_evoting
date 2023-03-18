FROM php:7.4-fpm

WORKDIR /var/www/html/php

RUN apt-get update \
    && apt-get install --quiet --yes --no-install-recommends \
     libzip-dev \
     unzip \
     vim \
    && docker-php-ext-install zip pdo pdo_mysql 

RUN docker-php-ext-install mysqli dba

RUN groupadd --gid 1000 appuser \
  && useradd --uid 1000 -g appuser \
     -G www-data,root --shell /bin/bash \
     --create-home appuser

USER appuser