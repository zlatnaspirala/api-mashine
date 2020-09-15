# laravel-magic #

Explore laravel (php) and create starter project.

### Project specification: ###

```bash
  Laravel Installer version 4.0.3
  Laravel           version 8.0.1
```

<pre>
 Project structure
 legend:
 [NON-P] - Only for help purpose or other.

ROOT
├── .dist/  (This is auto generated/ not important)      [NON-P]
├── dev-reference-projects/ (GitHub submodules projects) [NON-P]
├── starter-basic/
|   ├── default laravel project structure... fo now

</pre>

### Installation: ###

You could also find the composer's global installation path by running `composer global about`

Install:
```bash
  composer global require laravel/installer

  composer require cloudcreativity/laravel-json-api
```

For windows:
```cmd
  setx /M path "%path%;%appdata%\Composer\vendor\bin"
```

 This is variant of vagrant setup without installing php etc.
 https://laravel.com/docs/master/homestead

 For MACOS mashine take a look at:
 https://laravel.com/docs/master/valet


 File `.env` is source control data. All of the variables listed
in this file will be loaded into the $_ENV PHP super-global when
your application receives a request.
 Create database with same (application-name) name.

 Determining The Current Environment:

```php
  $environment = App::environment();
   if (App::environment('local')) {
    // The environment is local
  }
```

Create database with app name. migrate is executing already prepared
 create table query.

```
  php artisan migrate
  php artisan migrate --force
```

 - Drop All Tables & Migrate
 The `migrate:fresh` command will drop all tables from
 the database and then execute the migrate command:

```
  php artisan migrate:fresh
  php artisan migrate:fresh --seed
```

#### Running Seeders
Once you have written your seeder,
you may need to regenerate Composer's autoloader using the dump-autoload command:

```
  composer dump-autoload

  php artisan db:seed
  php artisan db:seed --class=UserSeeder

```


### JSON Laravel

```

php artisan make:json-api
php artisan make:json-api:resource posts --auth

```


### Production

To give your application a speed boost, you should cache all of
your configuration files into a single file using the
config:cache Artisan command.

```bash
  php artisan config:cache
```

also route optimisation for prod:

```bash
composer install --optimize-autoloader --no-dev
php artisan route:cache
php artisan view:cache
```

To enable maintenance mode, execute the down Artisan command:

```bash
  php artisan down
```

You may also provide a retry option to the down command,
which will be set as the Retry-After HTTP header's value:

```
  php artisan down --retry=60
```

Bypassing Maintenance Mode
Even while in maintenance mode, you may use the secret option
to specify a maintenance mode bypass token:

```bash
  php artisan down --secret="1630542a-246b-4b66-afa1-dd72a4c43515"
```

After placing the application in maintenance mode, you may navigate
to the application URL matching this token and Laravel will issue a
maintenance mode bypass cookie to your browser:

```
https://example.com/1630542a-246b-4b66-afa1-dd72a4c43515
```

When accessing this hidden route, you will then be redirected
to the / route of the application. Once the cookie has been issued
to your browser, you will be able to browse the application normally
as if it was not in maintenance mode.

Disabling Maintenance Mode
To disable maintenance mode, use the up command:

```bash
  php artisan up
```

### Developing

----------------------------------------------------------------------------------------------
#### Request Lifecycle
----------------------------------------------------------------------------------------------
  - The entry point for all requests to a Laravel application is the public/index.php file
    The index.php file loads the Composer generated autoloader definition and then retrieves
    an instance of the Laravel application from bootstrap/app.php script.
    - The first action taken by Laravel itself is to create an instance
      of the application / service container.
  - Next, the incoming request is sent to either the HTTP kernel or the console kernel,
    depending on the type of request that is entering the application.
----------------------------------------------------------------------------------------------


----------------------------------------------------------------------------------------------
####
#####                       Register servive providers
----------------------------------------------------------------------------------------------
                                            V
----------------------------------------------------------------------------------------------
####                      Some client PUBLIC => https://mydomain.com
#####              Typeof request can be: `HTTP kernel` or `console kernel`
----------------------------------------------------------------------------------------------
                                            V
----------------------------------------------------------------------------------------------
####                       public/index.php => bootstrap/app.php
----------------------------------------------------------------------------------------------
                                            |
                                            V
----------------------------------------------------------------------------------------------




### About Service Providers

One of the most important Kernel bootstrapping actions is loading the service providers
for your application. All of the service providers for the application are configured
in the config/app.php configuration file's providers array. First, the register method
will be called on all providers, then, once all providers have been registered,
the boot method will be called.

