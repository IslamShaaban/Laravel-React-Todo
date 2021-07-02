FROM php:7.4.3
RUN apt-get update -y && apt-get install -y openssl zip unzip git npm
RUN apt-get install curl gnupg -yq
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
RUN apt-get install nodejs -yq
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /todolist
COPY . /todolist
RUN composer install
RUN npm install -g npm@7.19.1
RUN npm install
RUN npm run dev