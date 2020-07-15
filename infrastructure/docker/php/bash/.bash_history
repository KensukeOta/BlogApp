php artisan make:controller UserController
exit
php artisan make:migration add_user_id_to_posts_table --table=users
php artisan make:migration add_user_id_to_posts_table --table=posts
php artisan migrate
php artisan migrate
exit
php artisan migrate
php artisan migrate
php artisan migrate:rollback
php artisan migrate
exit
php artisan migrate
exit
