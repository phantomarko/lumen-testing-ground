# Lumen Project 🟥
This is a project created from Laravel Lumen to learn good practices in DDD, clean architectures and design patterns. 
Also it has example uses and integrations of the most common and useful packages:
* Tactician Command Bus
* Symfony Service Container
* Doctrine Entity Manager
* Doctrine Document Manager
* Laravel Events
* ... 

## Prerequisites 📚️
* PHP 8.0 and composer installed globally
* docker and docker-compose

## Setup ⚙️

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
   
4. If you are a Linux user, probably you will get permissions problems. To solve them, change the ownership and permissions of the storage folder
    ```shell
    $ sudo chown {YOUR_CURRENT_USER}:www-data -R storage
   
    $ sudo chmod 775 -R storage
    ```
   
5. Build and start containers of the MySQL and MongoDB servers and web admins
    ```shell
    $ docker-compose build
   
    $ docker-compose up -d
    ```
   
6. Enter to the PHP container
    ```shell
    $ docker-compose exec php bash
    ```
   
7. Execute the MySQL migrations inside the container
    ```shell
    $ ./vendor/bin/doctrine-migrations migrate
    ```
   
8. The API should be ready to be used in [http://localhost:8000/](http://localhost:8000/)
   
## API Endpoints

* **GET** _/products/{UUID}_


* **POST** _/products_
    ```json
    {
        "name": "Name",
        "priceAmount": 288.88,
        "priceCurrency": "USD"
    }
    ```

## Web DB Administrators 🍬
The project includes docker services to access both databases via web application. Check docker-compose.yml to see the
access credentials

|  Server |     Admin     |                                     Url                                    |
|:-------:|:-------------:|:--------------------------------------------------------------------------:|
|  MySQL  |    Adminer    | [http://localhost:8080/?server=mysql](http://localhost:8080/?server=mysql) |
| MongoDB | Mongo Express | [http://localhost:8081/](http://localhost:8081/)                           |

## Tests ✅
* Run all the unit tests
    ```shell
    $ ./vendor/bin/phpunit tests
    ```

* Run a concrete test or set of tests
    ```shell
    $ ./vendor/bin/phpunit tests/unit/Application/Product/Command/CreateProductCommandHandlerTest.php
    ```
