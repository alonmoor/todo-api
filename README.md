# build

 * set server/public as document root on php powered server
 * update mysql database credentials in .env

```
$ cd client 
$ npm install
$ ember build
$ cd ../server
$ composer update
$ php artisan migrate
$ php artisan db:seed --class=TasksTableSeeder

```





