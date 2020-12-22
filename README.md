## "Money management" - small laravel 8 application

Accounting for cash, with reports and charts

### Installation
+ Clone the application using the command `git clone https://github.com/Victor8730/Money-Manager.git`
+ Run command update composer `composer update`
+ Rename a file `.env.example` to `.env` and change config setting
+ Run docker-compose up -d
+ Go to the console inside the container 
    + Run command migration `php artisan migrate`
    + Run command `php artisan db:seed`

