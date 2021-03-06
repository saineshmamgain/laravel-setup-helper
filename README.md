# Laravel Setup Helper (WIP)

A package to add some extra goodies to your laravel applications.

## Setup

### Install

``composer require saineshmamgain/laravel-setup-helper`` (work in progress)

Publish the config

``php artisan vendor:publish --tag=setup-helper-config``

The config has currently two switches:

`allow_request_make_command` and `allow_repository_make_command`

Set to false if you don't want these functionalities.

###Run

``php artisan setup-helper:install``

Run with ``--force`` tag to replace previously generated files.

## Create a trait

``php artisan make:trait FooTrait``

## Create a contract (interface)

``php artisan make:contract FooContract``

## Create a Request Class

Can be controlled from config

``php artisan make:request FooRequest``

The request class created by this package extends a `BaseRequest` class which in turn extends the original `FormRequest` class. 

In this class by default `authorize()` method returns `true`.

While writing Form Requests in Laravel, we have to create a class and define rules in it.

for example if you want to write validations for creating a user you will create a `UserRequest` class 

now for editing the user either you will create an `EditUserRequest` class and define the rules there or you will use the `UserRequest` class and will write conditions for applying some rules only when it is an edit request.

To make this more smooth this package Provides `BaseRequest` class.

When installation is complete, the request files created by `php artisan make:request` command will extend this `BaseRequest` class.

`postMethodRules()` To apply rules only on `POST` requests

`getMethodRules()` To apply rules only on `GET` requests

`putMethodRules()` To apply rules only on `PUT` requests

`patchMethodRules()` To apply rules only on `PATH` requests

`deleteMethodRules()` To apply rules only on `DELETE` requests

## Create a repository

You can create a repository by `php artisan make:repository {ModelName}`

This package will automatically search for model mentioned in the command in both `\App` and `\App\Models` namespaces. 

This package ships with a simple repository.

After running command you will get a Repository created in the `\App\Repositories` namespace.

Repository ships with some common functions for example:

### Create

```UserRepository::init()->create(["name" => "John Doe", "email" => "johndoe@example.com])```

Since you will get a repository class you can define `beforeSave` and `afterSave` events in the class itself. 

DO NOT CONFUSE THESE FUNCTION WITH LARAVEL'S MODEL EVENTS.
