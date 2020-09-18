
# Project source => https://laravel-json-api.readthedocs.io/en/latest/
# Laravel JSON API


<code>

## Theory of Operation
Your application will have one (or many) APIs that conform to the JSON API spec. You define an API in your app via routes, while JSON API settings are configured in a config file for each API. If you have multiple APIs, each has a unique name.

A JSON API contains a number of resource types that are available within your API. Each resource type relates directly to a PHP object class. We refer to instances of JSON API resource types as resources, and instances of your PHP classes as records.

Each resource type has the following units that serve a particular purpose:

 - Adapter: Defines how to query and update records in your application's storage (e.g. database).
 - Schema: Serializes a record into its JSON API representation.
 - Validators: Provides validator instances to validate JSON API query parameters and HTTP content body.

Optionally you can also add an Authorizer instance to authorize incoming JSON API request, either for multiple resource types or for a specific resource type.

Although this may sound like a lot of units, our development approach is to use single-purpose units that are easy to reason about.

## Why Records not Models?
In Laravel the phrase model is potentially confusing with Eloquent models. While some applications might solely encode Eloquent models to JSON API resources, others will use a mixture of Eloquent models and other PHP classes, or might not even be using Eloquent models.

So we decided to refer to PHP object instances that are converted to JSON API resources as records.

</code>
