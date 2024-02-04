<img src="readme.png">

## GSO Marketplace

### Project Overview
This project sets up a Dockerized development environment for Laravel applications. It includes configurations for PHP 8.3, MySQL 8.3, Nginx, and utilizes Laravel Breeze for authentication scaffolding.

## Architecture Overview

This project sets up a Dockerized development environment for Laravel applications, incorporating PHP 8.3, MySQL 8.3, Nginx, and Adminer. Laravel, renowned for its elegant syntax and robust features, serves as the web application framework. Additionally, Laravel Breeze, a minimalist authentication starter kit, simplifies authentication workflows.

- **Laravel**: PHP web framework
- **Laravel Breeze**: Simplifies authentication setup within Laravel applications.
- **PHP 8.3**: Empowers server-side scripting with enhanced features and performance.
- **MySQL 8.3**: An open-source relational database management system
- **Nginx**: A high-performance web server
- **Adminer**: A lightweight, feature-rich database management tool accessible through a single PHP file, providing a unified interface for various database systems.

This architecture fosters seamless development and management of Laravel applications, offering simplicity, versatility, and robustness throughout the development lifecycle.


## How to Install

To set up the environment, follow these steps:

1. Clone this repository to your local machine.
2. Navigate to the project directory `cd project-directory`
3. Run `make setup` to initiate the setup process.
4. Navigate to http://localhost:8000/. Happy Coding :rocket:
```
# Change the name of the directory if you want

cd Desktop
git clone git@github.com:danielp30/osp-gruppe1.git osp-final
cd osp-final
make setup 
```

## After Installation

Once the installation is complete, you can perform the following actions:

- **Connect to the container**: Use `docker exec -it laravel-app sh` to access the Laravel application container.
- **Stop the container**: Execute `docker-compose stop` to halt the running containers.
- **Start the container**: Run `docker-compose start` to start the containers.
- **Create containers without running Laravel setup**: To create containers without running the Laravel setup, execute `docker-compose up -d`

## Adminer
Adminer is a lightweight, yet powerful database management tool written in PHP

To access Adminer, navigate to `http://localhost:8080` in your web browser. The port `8080` is where Adminer is configured to run. Once accessed, you can log in using the database credentials provided in your `.env` file

## Contributors
- Daniel Peci
- Manuel Diaz
- Antonio Miraldi
- Jonas Boll



