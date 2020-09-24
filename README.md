# api-mashine
Laravel &lt;-> JSON API &lt;--> WEB APP

### Install and run:

```js
composer install
cp .env.example .env
php artisan passport:install
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan passport:keys
php artisan serve
npm run watch
```

### Update :

For Server part:
```
php artisan migrate:fresh --seed
```

For Web client:
```js
  npm update
```

### Based on

####  Laravel JSON API

 - https://laravel-json-api.readthedocs.io/en/latest/


#### More info:

  - README-LARAVER.md


#### Help links:

 - https://sebastiandedeyne.com/typescript-with-laravel-mix/
 - https://medium.com/@titasgailius/initial-laravel-setup-with-vuejs-vue-router-vuex-in-typescript-305f7fe9d62b

