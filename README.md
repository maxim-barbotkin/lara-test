## Test task
    
 Install guide

- git clone git@github.com:maxim-barbotkin/lara-test.git
- composer install
- copy env.example to .env and replase database with your actual database
- php artisan key:generate 
- php artisan config:cache 
- php artisan migrate --seed

after that you can start the application  running this command php artisan serve. (if you use Windows OS you should at first configure your virtual server)   

for runnnig tests
 
    ./vendor/bin/phpunit
    
