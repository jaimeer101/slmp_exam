## Instrucions to install
1. clone the project
2. create database in your server
3. if no env, copy .env.example and rename it .env
4. update database connection in the .env \
DB_CONNECTION=mysql\
DB_HOST=database server ip\
DB_PORT=database server port\
DB_DATABASE=database name\
DB_USERNAME=database username\
DB_PASSWORD=database password
5. Install composer
composer install
6. Run migration
php artisan migrate
7. Run the below command to insert data \
php artisan db:seed --class=UsersSeeder\
php artisan db:seed --class=PostsSeeder\
php artisan db:seed --class=CommentsSeeder\
php artisan db:seed --class=AlbumsSeeder \
php artisan db:seed --class=PhotosSeeder\
php artisan db:seed --class=TodosSeeder
8. Run the below command to generate token \
php artisan generate:user-token {existing user id}\
sample: php artisan generate:user-token 1 \
Note: After generating, copy in a text file the generated token
9. Run php artisan serve


## Postman
1. Under Authorization Tab, select Bearer Token, paste the generated token in the Token Field the access the url


## API Reference

#### Get all items

```http
  GET /api/users
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `token` | `string` | **Required**. From the generated user token|

#### Get item

```http
  GET /api/users/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |
| `token`      | `string` | **Required**. From the generated user token |

#### add(num1, num2)

Takes two numbers and returns the sum.

