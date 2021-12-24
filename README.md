# Lumen Project 🟥
This is a project created from Laravel Lumen to learn good practices in DDD, clean architectures and design patterns. 
Also it has example uses and integrations of the most common and useful packages:
* Tactician Command Bus
* Symfony Service Container
* Doctrine Entity Manager
* Doctrine Document Manager
* ... 

## Prerequisites 📚️
* PHP 8.0
* PHP Extensions: 
  * BCMath
  * Ctype
  * JSON
  * Mbstring
  * OpenSSL
  * PDO
  * Tokenizer
  * XML
  * MongoDB
* Docker and docker-compose

## Setup dev environment ⚙️

1. Do composer install to download vendor packages
    ```shell
    $ composer install
    ```

2. Create a copy of .env.example as .env
    ```shell
    $ cp .env.example .env
    ```

3. Open .env file and set any value to `APP_KEY` variable
    ```dotenv
    APP_KEY=anexampleappkey
    ```
   
4. Build and start containers of the MySQL and MongoDB servers and web admins
    ```shell
    $ docker-compose up -d
    ```
   
5. Execute the MySQL migrations
    ```shell
    $ ./vendor/bin/doctrine-migrations migrate
    ```

6. Start the PHP built-in web server
    ```shell
    $ php -S localhost:8000 -t {PROJECT_PATH}/public
    ```

## Web DB Administrators 🍬
The project includes docker services to access both databases via web application. Check docker-compose.yml to see the
access credentials

|  Server |     Admin     |                                     Url                                    |
|:-------:|:-------------:|:--------------------------------------------------------------------------:|
|  MySQL  |    Adminer    | [http://localhost:8080/?server=mysql](http://localhost:8080/?server=mysql) |
| MongoDB | Mongo Express | [http://localhost:8081/](http://localhost:8081/)                           |

## List of commands 📜

### Tests ✅
* Run all the unit tests
    ```shell
    $ ./vendor/bin/phpunit tests
    ```

* Run a concrete test or set of tests
    ```shell
    $ ./vendor/bin/phpunit tests/unit/Application/Product/Command/CreateProductCommandHandlerTest.php
    ```

### Doctrine Migrations 🗃️
* Display list of all commands
    ```shell
    $ ./vendor/bin/doctrine-migrations list
    ```

* Generate a migration by comparing your current database to your mapping information
    ```shell
    $ ./vendor/bin/doctrine-migrations diff
    ```

* Execute a migration to a specified version or the latest available version
    ```shell
    $ ./vendor/bin/doctrine-migrations migrate
    ```

### Docker 🐋
* Start
    ```shell
    $ docker-compose up -d
    ```
    ```shell
    $ docker-compose up -d --force-recreate
    ```

* Stop
    ```shell
    $ docker-compose down --remove-orphans
    ```
