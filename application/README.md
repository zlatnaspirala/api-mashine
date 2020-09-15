
# Laravel JSON-API platform

This application demonstrates how to use the
[cloudcreativity/laravel-json-api](https://github.com/cloudcreativity/laravel-json-api)
package to create a [JSON API](http://jsonapi.org) compliant API. This is demonstrated using Eloquent models as
the domain records that are serialized in the API, but the package is not Eloquent specific.

## Installation

Clone project and navigate terminal to the root folder:

``` bash
composer install
cp .env.example .env
php vendor/bin/homestead make
vagrant up
```


function RUN() {
    var DATA = {
    "data": {
    "type": "posts",
    "attributes": {
      "title": "Hello World",
      "content": "..."
    },
    "relationships": {
      "tags": {
          "data": [
              {
                  "type": "tags",
                  "id": "1"
              }
          ]
      }
    }
    }
    }

      fetch('/api/v1/posts/1/create', {
              method: 'POST', // *GET, POST, PUT, DELETE, etc.
              //mode: 'cors', // no-cors, *cors, same-origin
              //cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
              //credentials: 'same-origin', // include, *same-origin, omit
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1]
                // 'Content-Type': 'application/x-www-form-urlencoded',
              },
              //redirect: 'follow', // manual, *follow, error
              //referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
              body: JSON.stringify(DATA) // body data type must match "Content-Type" header
            })
          .then((response) =>{
            return response.json()
          } )
          .then((data) => {

            console.log(data)

          })
}


> Remember you'll need to add an entry for `homestead.app` in your `/etc/hosts` file.

Once it is up and running, go to the following address in your browser to see the JSON endpoints:

```
http://homestead.app/api/v1/posts
```

To access the web interface:

```
http://homestead.app
```

> If you use the Vagrant hosts updater plugin, the hostname may be `demo-laravel-json-api` or similar.

## Authentication

Any write requests require an authenticated user. We've installed
[Laravel Passport](https://laravel.com/docs/passport) for API authentication. You will need to use
[Personal Access Tokens](https://laravel.com/docs/passport#personal-access-tokens) and the Vagrant provisioning
runs the Passport installation command.

To create a token, go to the web interface and login (the username and password fields are completed with
credentials that will sign you in successfully). You'll then see the Passport Person Access Token component
which you can use to issue tokens.

Once you have a token, send a request as follows, replacing the `<api_token>` with your token.

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

## Tests

We're big on testing, and the `cloudcreativity/laravel-json-api` package comes with test helpers to make integration
testing a JSON API a breeze. You can see this in action in the `tests/Integration` folder, where there's a test case
for the `posts` resource.

To run the tests:

```bash
vendor/bin/phpunit
```
