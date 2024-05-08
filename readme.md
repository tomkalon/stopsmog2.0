# StopSmog 2.0

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
A simple application for monitoring air purity.

## Technologies
Project is created with:
* PHP 8.3
* Symfony 7.0
* Stimulus JS
* MySQL / MariaDB
* Bootstrap
* SASS
* JQuery
* Docker

## Setup
To run this project, follow the commands below:

### 1) Install Docker on your computer if you don't already have it.

### 2) Download the repository and navigate to the directory you created.

```
git clone git@github.com:tomkalon/stopsmog2.0.git stopsmog

cd stopsmog
```


### 3) In the .env.dist file you can adjust the project settings.

Here you can change the container name suffix.
```
PROJECT_NAME=stopsmog
```

...and adjust the settings to your needs.

### 4) Prepare your Docker environment.

```
docker-compose -f docker-compose.yml --env-file .env.dist up --build
```

### 5) Once completed, navigate to the 'php-apache' container and execute the following commands:
```
composer install

Complete the database details in the .env file.

symfony console d:m:m
```

### 6) To run project initialization and make new administrator account, run:
```
symfony console app:admin:add
```

### 7) In the "node" container, execute the following commands in the terminal:
```
yarn install
yarn run dev
```

In case of problems, remove yarn.lock and repeat the procedure.

### 8) The PHP server is configured on the default port 80. Launch your browser and enter the address:
```
http://localhost/
```

or login at:
```
http://localhost/admin
```
