## Why to use?

This package enable jwt token based api authentication and gives you a way to build your api without stuck on authentication and security part.


## How to use

Setup some keys in `.env` file

```
APP_KEY=yourapikey
JWT_SECRET=string_greater_than_or_equal_32
JWT_TOKEN_EXP=int_in_minute_by_default_60
GATE_PASS=string_greater_than_or_equal_8
```

Note:- `GATE_PASS` should be private and only shared with the **authorized Person** whom you want to give authority to create user. 


## Start with new user

You can always modify user's table look into `database/migrations` and add or modify columns but keep in mind we are using `email` and `password` for authentication by default.



## Register new user

post request on `api.your.domain/register`

required params `name`, `email`, `password` and `gate_pass`(that you put in .env => `GATE_PASS` it should be private)


### Request

``` curl

# using curl

curl -X POST \
  http://api.your.domain/register \
  -H 'content-type: application/json' \
  -d '{
    "name":"John Doe",
    "email":"john.doe@example.com",
    "password":"yourpass",
    "gate_pass":"same_as_env"
  }'

```

### Response

``` json
{
    "status": 200,
    "response": "user successfully created"
}
```


## Login and get token

post request on `api.your.domain/login`

params that required `email` and `password`

### Request

``` curl

# using curl

curl -X POST \
  http://api.your.domain/login \
  -H 'content-type: application/json' \
  -d '{
  "email":"john.doe@example.com",
  "password":"yourpass"
}'

```

### Response

``` json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...zXXFdki4"
}
```

## Work after logged in

### Define Routes
After logged in we get the token and that token need to pass in every protected  route, all auth route protected by the `middleware => 'jwt.auth'` so you can use it as you want, we have already defined  `jwt.auth` group in `routes/web.php` so you can use that group to define protected routes.

#### For Example

``` php
  
  // working with single route

  $router->post('single', 'YourController@method')->middleware('jwt.auth');
  

  // working with group route (recommended)

  $router->group(['middleware' => 'jwt.auth'], function() use ($router) {

    // define your route

    $router->post('in-group', 'YourController@method');


  });

```

### How to use (token)

We have defined a route `http://api.your.domain/user` to check logged in user details.


### Request

``` curl

# using curl

curl -X POST \
  'http://api.travelsolution.test/user' \
  -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...zXXFdki4' \
  -H 'Content-Type: application/json' \
```

### Response

``` json

{
    "id": 1,
    "name": "John Doe",
    "email": "john.doe@example.com",
    "created_at": "2019-07-08 19:45:23",
    "updated_at": "2019-07-08 19:45:23"
}

```

___


# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
