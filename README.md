# Lumen Project 🟥
This is a project created from Laravel Lumen to learn good practices in DDD, clean architectures and design patterns. 
Also it has example uses and integrations of the most common and useful packages:
* Tactician Command Bus
* Symfony Service Container
* Doctrine Entity Manager
* Doctrine Document Manager
* ... 

## PHPUnit ✅

Run all the unit tests
```bash
$ ./vendor/bin/phpunit tests
```

Run a concrete test or set of tests
```bash
$ ./vendor/bin/phpunit tests/unit/Application/Product/Command/CreateProductCommandHandlerTest.php
```

## Doctrine Migrations 🗃️

Display list of all commands
```bash
$ ./vendor/bin/doctrine-migrations list
```

Generate a migration by comparing your current database to your mapping information
```bash
$ ./vendor/bin/doctrine-migrations diff
```

Execute a migration to a specified version or the latest available version
```bash
$ ./vendor/bin/doctrine-migrations migrate
```

## Docker 🐋

Start
```bash
$ docker-compose up -d
```

Stop
```bash
$ docker-compose down --remove-orphans
```

Access to mongo shell directly in the container
```bash
$ docker run -it --rm --network app-network mongo \
    mongo --host mongo \
        -u root \
        -p example \
        --authenticationDatabase admin \
        some-db
```

## Web DB Admins 🍬

### Adminer (MySQL)

[http://localhost:8080/?server=db](http://localhost:8080/?server=db)

### Mongo Express (MongoDB)

[http://localhost:8081/?server=db](http://localhost:8081/?server=db)
