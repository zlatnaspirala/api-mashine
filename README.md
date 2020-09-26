# api-mashine #
### version 1.00 ###

## General Shema ##
```
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
```

### Install and run:

Create with mysql database with name apimashine.

Navigate to the root folder application/

```php
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
```s
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

  - [README-LARAVER.md](https://github.com/zlatnaspirala/api-mashine/blob/test-dev/README-LARAVER.md)


#### Help links:

 - https://sebastiandedeyne.com/typescript-with-laravel-mix/
 - https://medium.com/@titasgailius/initial-laravel-setup-with-vuejs-vue-router-vuex-in-typescript-305f7fe9d62b

### LICENCE:

#### zlatnaspirala/api-mashine is licensed under the
#### GNU General Public License v3.0

Copyright 2016, zlatnaspirala@gmail.com
All rights reserved.

<b>Disclaimer of warranty</b>
    'Visual js' is provided "as-is" and without warranty of any kind, express, implied or otherwise,
    including without limitation, any warranty of merchantability or fitness for a particular purpose.
    In no event shall the author of this software be held liable for data loss,
    damages, loss of profits or any other kind of loss while using or misusing this software.



### External LICENCE:

   https://github.com/cloudcreativity/laravel-json-api
   Apache-2.0 License
