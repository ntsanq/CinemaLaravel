## About This Project

This project that writing for a cinema management. 

## To run this project

#### Requirements
- PHP : v8.0 or higher. [Install PHP](https://nextgentips.com/2022/01/31/how-to-install-php-8-1-on-ubuntu-20-04/?noamp=mobile)
- MySQL : v8.0. [Install MySQL](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)
- Composer : v2.3.7.[Install Composer](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)

#### Set up
                     
- **Step 1**: Clone this project:
```sh  
$ git clone https://github.com/ntsanq/CinemaLaravel.git
$ cd CinemaLaravel
$ composer install
``` 


- **Step 2**: Create example database: <br>
Create new database <br>
Make your new .env with database's name you created <br>
Run:
```sh  
$ php artisan migrate --seed 
$ php artisan serve                           (one tab)
$ npm run dev                                 (one tab)
``` 


Run your server: http://localhost:8000

## Author
[@ntsanq - Nguyen Thanh Sang](https://github.com/ntsanq)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
