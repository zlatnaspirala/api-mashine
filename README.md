# api-mashine
## version 1.00

## Laravel8 JSON API <-> Web app - Any client app

<pre>
 +---------------------------------------------------------------------------------+
 |                                                                                 |
 | +------------------------------------+  +-------------------------------------+ |
 | |                                    |  |                                     | |
 | |  +------------------------------+  |  | Even out web app need client key    | |
 | |  |                              |  |  | access to be created initially. Next| |
 | |  |  LARAVEL 8 JSON-API Core     |  |  | step is to create  access token  for  |
 | |  |                              |  |  | every logged user. This will be     | |
 | |  +------------------------------+  |  | automated in future.                | |
 | |  +------------------------------+  |  |                                     | |
 | |  |            GUARD             |  |  | - User must be logged if we want to | |
 | |  |    lara^el/passport auth     |  |  | create database entries.            | |
 | |  +------------------------------+  |  | - Personal access token generate    | |
 | | +--------------+ +---------------+ |  | - Access is ready.                  | |
 | | |home.blade.php| |      API      | |  |                                     | |
 | | |     route    | |     route     | |  |                                     | |
 | | |    web.php   | |    app.php    | |  |                                     | |
 | | +--------------+ +---------------+ |  |                                     | |
 | +------------------------------------+  +-------------------------------------+ |
 |     ^               ^    |   ^   |                                              |
 |     |            +-------v-------v--+                                           |
 |     |LOGIN       | Logged user      |                                           |
 |     |            | request POST     |                                           |
 |     |            +--^--------^------+                                           |
 |     |               |    |   |   |                                              |
 |  +-----------------------v-------v--+   +-------------------------------------+ |
 |  || Web app based on Vue framework ||   |    Other type of applications       | |
 |  ||   Class component oriented     ||   | +----------------+ +--------------+ | |
 |  +----------------------------------+   | | Native android | | native ios   | | |
 |  |            +-------------------+ |   | | Android Studio | | xcode proj   | | |
 |  | +--------+ |  vue components   | |   | +----------------+ +--------------+ | |
 |  | | app.ts | | +--+ +--+    +--+ | |   | +----------------+ +--------------+ | |
 |  | +--------+ | |  | |  |    |  | | |   | | hybrids multi  | |other - server| | |
 |  |            | +--+ +--+ ++ +--+ | |   | | platform (web) | |console access| | |
 |  |            +-------------------+ |   | +----------------+ +--------------+ | |
 |  +----------------------------------+   +-------------------------------------+ |
 |                                                                                 |
 +---------------------------------------------------------------------------------+

</pre>

### Install and run:

Create with mysql database with name apimashine.

Navigate to the root folder application/

```js
composer install
cp .env.example .env
php artisan passport:install
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan passport:keys
php artisan serve
```

### Update :

For Server part:
```
php artisan migrate:fresh --seed
```

For Web client:
```js
  npm run watch

  npm install
  npm update
```

### Based on

####  Laravel JSON API

 - https://laravel-json-api.readthedocs.io/en/latest/
 - Vue last stable version


#### More info:

  - README-LARAVER.md


#### Help links:

 - https://sebastiandedeyne.com/typescript-with-laravel-mix/
 - https://medium.com/@titasgailius/initial-laravel-setup-with-vuejs-vue-router-vuex-in-typescript-305f7fe9d62b

