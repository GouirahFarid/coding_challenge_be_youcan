

# Youcan tech-challenge By Faid Gouirah


## Stack Used
- [PHP version 8](https://www.php.net/)
- [Laravel  version 9](https://laravel.com/)
- [MySQL](https://www.mysql.com/)
- [Node.js version 16](https://nodejs.org/en/)
- [Vue.js version 3](https://vuejs.org/)
- [Git](https://git-scm.com/)

## Installation process
- Clone GitHub repository in your local machine using command ```git clone https://github.com/GouirahFarid/coding_challenge_be_youcan.git``` or download it
- remained file ``.env.example`` to``.env``
  
- Inside project folder run ``composer install`` command and after that run ``php artisan key:generate``
- create a database and add it into   ``.env`` File
- Inside project folder run ``php artisan migrate`` and make sure migrations files are migrated and database tables are created successfully
-Inside project folder  run ``npm   install & npm run dev``
- open new terminal  and run ``php artisan serve``

## Create/Delete Category/Product from CLI


You can create/Delete Category/Product from tou CLI by using run these commands
- ``php artisan create:category`` to create category
- ``php artisan detele:category`` to delete category
- ``php artisan create:product`` to create product
- ``php artisan detele:product`` to delete product

## Create/Delete/Get Category/Product API Using postman
You can create/Delete Category/Product
- Check ``routes/api`` and ``Requests/*`` to know more

## Create/Delete/Get Category/Product From Web

- check the link generated by ``php artisan serve`` and make sure to run ``npm run dev``
