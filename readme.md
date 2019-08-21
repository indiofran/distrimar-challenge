# Employee API

This is a challegen for the company Distrimar. This Exercise is an API for share all information about of employee from a Database

## Requirements

- PHP 7.1 or greater (version 3.x and below supports PHP 5.5+)
- PHP JSON extension enabled.
- PHP pdo_sqlite extension enabled.

## Features

This have a HTTP Server with six endpoints:

- Return the employees.
- Return a employee.
- Return the offices.
- Return a office.
- Return the departments.
- Return a department.


## Installation

1.**Install dependencies**

If you don't have composer installed, type:

```php
php composer.phar install
```

or if you have composer

```php
composer install
```

2. **Run App**

```sh
cd public\
php -S localhost:8000
```

## EndPoints


| URI | Method | Params |
| --------- | --------- | --------- 
| /employees | GET | p,rel[],cant
| /employees/{employee_id} | GET | rel[]
| /departments | GET | rel[]
| /departments/{department_id}| GET | p,rel[],cant
| /offices| GET | rel[]
| /offices/{office_id}| GET | p,rel[],cant

p = The number page of pagination. Default 1

cant = The number quantity of object per page. Default 10

rel[] = An array of relationships. Default empty array

##Test

To run the test:
in windows:
``` .\vendor\bin\phpunit```


**IMPORTANT NOTE**

Remember that all data store in sqlite file. ```\database\empleados.sqlite```