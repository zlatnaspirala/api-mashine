
# Api mashine

## Source:
  [cloudcreativity/laravel-json-api](https://github.com/cloudcreativity/laravel-json-api)
  more [JSON API](http://jsonapi.org)
  This is demonstrated using Eloquent models as the domain records that are serialized in the API,
  but the package is not Eloquent specific.

## Installation

Clone project and navigate terminal to the root folder:

``` bash
  https://github.com/zlatnaspirala/api-mashine

  composer install
  cp .env.example .env
  php artisan passport:install
  php artisan migrate
  php artisan db:seed
  // php artisan key:generate
  // php artisan passport:keys
  php artisan serve
```

Update:

```php
  php artisan migrate:fresh --seed
```

> Remember you'll need to add an entry for `homestead.app` in your `/etc/hosts` file.
Once it is up and running, go to the following address in your browser to see the JSON endpoints:
```
http://homestead.app/api/v1/posts
```

To access the web interface:
```
http://localhost:8000
```

## Authentication

 - Any write requests require an authenticated user. We've installed
 - [Laravel Passport](https://laravel.com/docs/passport) for API authentication. You will need to use
 - [Personal Access Tokens](https://laravel.com/docs/passport#personal-access-tokens) and the Vagrant provisioning
   runs the Passport installation command.

 - To create a token, go to the web interface and login (the username and password fields are completed with
  credentials that will sign you in successfully). You'll then see the Passport Person Access Token component
  which you can use to issue tokens.

- Once you have a token, send a request as follows, replacing the `<api_token>` with your token.

```http
POST http://homestead.app/api/v1/posts
Accept: application/vnd.api+json
Content-Type: application/vnd.api+json
Authorization: Bearer <api_token>

{
    "data": {
        "type": "posts",
        "attributes": {
            "slug": "hello-world",
            "title": "Hello World",
            "content": "..."
        }
    }
}
```

## Eloquent vs Not-Eloquent

This package can handle both Eloquent and non-Eloquent records. You get a lot more functionality out of the box if
you are using Eloquent, but it's possible to integrate non-Eloquent records as needed.

This demo includes the following JSON-API resources:

| Resource | Record | Eloquent? |
| --- | --- | --- |
| comments | App\Comment | Yes |
| posts | App\Post | Yes |
| sites | App\Site | No |
| tags | App\Tag | Yes |
| users | App\User | Yes |

## Software architecture

<pre>
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

More about client - server relations:

+------------------------------------------------------------------------------------------------+
|  +--------------------------------------------------------------------------+                  |
|  Single web route: Route::get('/home', 'HomeController@index')|>name('home');                  |
|  +--------------------------------------------------------------------------+                  |
|                                                                                                |
|   +---------------------------------------------+      Only resources with                     |
|   |                                             |      `ContentNegotiator` have option         |
|   | app.blade.php                               |      to receive different content-type       |
|   |                                             |                                              |
|   | +-----------------------------------------+ |        URL               Controller Action   |
|   | | home.blade.php                          | |                                              |
|   | |                                         | |      `GET /posts`             | `index` |    |
|   | +-----------------------------------------+ |      `POST /posts`            | `create` |   |
|   +---------------------------------------------+      `GET /posts/{rec}`       | `read` |     |
|                                                        `PATCH /posts/{record}`  | `update` |   |
|                                                        `DELETE /posts/{record}` | `delete` |   |
|     +-----------------------------------------------------------+                              |
|     |ONLY Request's with Content-Type: application/vnd.api+json |                              |
|     |will be taken into consideration                           |                              |
|     +-----------------------------------------------------------+                              |
|                                                                                                |
|                                                                                                |
+--------------+-------+--------+--------+-------------------------------------------------------+
               ^       ^        ^        ^
               |  GET  | POST   | PATCH  |  DELETE
               |       |        |        |
               |       |        |        |
+------------------------------------------------------------------------------------------------+
|  +-------------------------------------------------------------------------------------------+ |
|  | Client verification                            For create and update user must be logged. | |
|  |                                                                                           | |
|  +-------------------------------------------------------------------------------------------+ |
|                                                                                                |
|                     +----------------------------------------------+                           |
|                     |   Every call must contain X-CSRF-TOKEN       |                           |
|                     |                                              |                           |
|                     |   PERSONAL KEY  For POST and PATCH , DELETE  |                           |
|                     |                                              |                           |
|                     +----------------------------------------------+                           |
|                                                                                                |
|                                                                                                |
|                      +-------------------------------------------+                             |
|                      |   WEB APPLICATION PART. Vue/typescript    |                             |
|                      |   Using class component decoration        |                             |
|                      +-------------------------------------------+                             |
|                                                                                                |
|                                                                                                |
+------------------------------------------------------------------------------------------------+

</pre>

## Tests

We're big on testing, and the `cloudcreativity/laravel-json-api` package comes with test helpers to make integration
testing a JSON API a breeze. You can see this in action in the `tests/Integration` folder, where there's a test case
for the `posts` resource.

To run the tests:

```bash
vendor/bin/phpunit
```

Foe windows users:

```bash
"vendor/bin/phpunit"
```
