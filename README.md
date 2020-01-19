# lalaexam

# create board table
php artisan migrate --path="/database/migrations/2020_01_19_093506_create_board_table.php"
or
php artisan migrate:refresh --path="/database/migrations/2020_01_19_093506_create_board_table.php"

#seeding
php artisan db:seed --class=BoardTableSeeder
