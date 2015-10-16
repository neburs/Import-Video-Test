Hello to all.

This group of files, are a possible solution for the statement proposed.
I use some design patterns (inheritance, factory, strategy, command,...) for find a possible solution that permit expand the functionalities of it following the open/closed principle (open for extensions, closed for modifications). Next I explain the flow.
When execute the ImportCommand indicating the reader (provider) you are like to use, this instantiate the reader and read all files of this in the directory feed-exports “for example if you indicate the glorf provider, this read all files in feed-exports directory that called glorf*.json” and then create for each row an instance of own domain of film for next, persist the information. Actually the persist method only show a echo with the information of the film.

So if you need no add new readers only need to implement in the Readers Directory the Specific Reader that implementing the ReaderInterface and that's all.

In the future, if you need to persist the data in a db, you will need to implement in the Models Folder the specific repository for the db implementing the specific interface for each model (The interfaces are in Domain/Core/Interfaces) and then, inject the strategy for persist data in the ImportCommand.

Requisites for execute the project.

For install and execute the project you will need to install the php 5.6 version or higher and the composer software (see https://getcomposer.org/download/ for know how install)


Instructions for Install the project.

- Go to the main folder of the project and execute

````bash
$ composer install
````


For execute the program

- Go to the main folder of the project and execute

````bash
$ ./import [the name of the reader provider]
````

Example

````bash
$ ./import flub
````


For execute the unit tests.

- Go to the main folder of the project and execute

````bash
$ ./vendor/bin/phpunit
````


For execute the functional tests.

- Go to the main folder of the project and execute

````bash
$ ./vendor/bin/phpunit Tests/Functional
````
