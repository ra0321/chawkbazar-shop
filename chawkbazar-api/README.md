## Introduction

Marvel is a laravel multi api package for ecommerce. This package is for building dynamic ecommerce site using marvel package with graphql/rest.

## Getting Started

### Prerequisites

#### Linux and MacOs

-   Docker

#### Windows

-   PHP 7.4 or above
-   Composer
-   Xamp/Wamp for any such application for apace, nginx, mysql
-   PHP plugins you must need

    -   simplexml
    -   PHP's dom extension
    -   mbstring
    -   GD Library

### Resources you might need

1. https://laravel.com/docs/8.x
2. https://lighthouse-php.com/4.18/getting-started/installation.html
3. https://github.com/spatie/laravel-medialibrary
4. https://github.com/andersao/l5-repository
5. https://spatie.be/docs/laravel-permission/v3/introduction

### Packages we have used

```json
"mll-lab/graphql-php-scalars": "3.1.0",
"nuwave/lighthouse": "^4.18.0",
"laravel/legacy-factories": "^1",
"cviebrock/eloquent-sluggable": "^8.0",
"laravel/sanctum": "^2.7",
"mll-lab/laravel-graphql-playground": "^2.1",
"prettus/l5-repository": "^2.6",
"spatie/laravel-medialibrary": "^9.4.0",
"spatie/laravel-permission": "^3.11",
"php-http/guzzle7-adapter": "^0.1.1",
"bensampo/laravel-enum": "^3.1.0",
"league/flysystem-aws-s3-v3": "~1.0"
```

## Installation Linux and MacOS

-   Run Docker application first
-   Now go to your marvel-laravel root directory and run `bash install.sh`. It will guide you through some process. Follow those process carefully and your app will be up and running
-   navigate to `api` then `sail down` to stop the container

## Installation Windows

For windows we suggest you not to use `sail`. Please follow below steps if you are an windows user.

### Prerequisites

-   PHP 7.4 or above
-   Composer
-   Xamp/Wamp for any such application for apace,nginx,mysql
-   PHP plugins you must need

    -   simplexml
    -   PHP's dom extension
    -   mbstring
    -   GD Library

-   Rename .env.example file to .env and provide necessary credentials. Like database credentials stripe credentials, s3 credentials(only if you use s3 disk) admin email shop url etc.
    -   Specially check for this `env` variables
    ```
    DB_HOST=localhost
    DB_DATABASE=marvel_laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```
-   Run `composer install`
-   run `php artisan key:generate`
-   Run `sail artisan marvel:install` and follow necessary steps.
-   For image upload to work properly you need to run `sail artisan storage:link`.
-   run `php artisan serve`

> NB: You must need to run `php/sail artisan marvel:install` to finish the installation. Otherwise your api will not work properly. Run the command and follow the necessary steps.

## Configuration

All the configurations files are in `packages/marvel-shop/src/Config` folder. You can change any necessary configuration from these files. You can also publishes the shop configuration using `artisan vendor:publish --provider="Marvel\ShopServiceProvider" --tag="config"` command in your root folder.

-   Create .env file from our example.env file and put necessary configuration
-   By default s3 is using for media storage but you can also use local folder. Change `MEDIA_DISK` IN `.env` file as your need. Supported options are `public` and 's3`
-   Set Payment related configuration to `STRIPE_API_KEY` `.env` variable
-   Set `ADMIN_EMAIL`, `SHOP_URL` and necessary Database credentials.

> -   For Windows user or if you don't use `sail` then replace `sail` in these commands with `php` like `sail artisan marvel:install` will be
>     `php artisan marvel:install`

## Console Commands

-   `sail artisan marvel:install` complete installation with necessary steps
-   `sail artisan marvel:seed` seeding demo data
-   `sail artisan marvel:copy-files` copy necessary files
-   `sail artisan vendor:publish --provider="Marvel\ShopServiceProvider" --tag="config"` published the configuration file

All of the above custom command you will find in `packages/marvel-shop/src/Console` folder.

## Development

We have provided below two api.

-   REST API
-   GraphQL API

## REST API

All the rest routes is resides in `packages/marvel-shop/src/Rest/Routes.php` file and you can easily navigate to corresponding controller and necessary files.

### Endpoints Details

-   [users](https://documenter.getpostman.com/view/11693148/TVzUDbnG)
-   [products](https://documenter.getpostman.com/view/11693148/TVzUDbdH)
-   [coupons](https://documenter.getpostman.com/view/11693148/TVzUDbUa)
-   [categories](https://documenter.getpostman.com/view/11693148/TVzSkHgz)
-   [order_status](https://documenter.getpostman.com/view/11693148/TVzUDbYv)
-   [orders](https://documenter.getpostman.com/view/11693148/TVzRHJPt)
-   [types](https://documenter.getpostman.com/view/11693148/TVzUDbhp)
-   [attachments](https://documenter.getpostman.com/view/11693148/TVzUDbYt)
-   [checkout](https://documenter.getpostman.com/view/11693148/TVzUDbUb)
-   [settings](https://documenter.getpostman.com/view/11693148/TVzUDbdK)
-   [shipping](https://documenter.getpostman.com/view/11693148/TVzUDbdR)
-   [taxes](https://documenter.getpostman.com/view/11693148/TVzUDbhj)
-   [analytics](https://documenter.getpostman.com/view/11693148/TzCHBAdS)

### Folder structure

### config

The `packages/marvel-shop/config` folder contains all the `config` for our app.

### database

The `packages/marvel-shop/database` folder contains all the `factories` and `migrations`.

-   #### Http:

    Contains two folders. `Controllers` and `Requests`. All the necessary controllers and requests are in this two folder.

-   #### Database:
    Contains `Models` and `Repositories`. For repositories we have used `l5-repository`(https://github.com/andersao/l5-repository).

### Enums

All the `enums` that are used throughout the app is in `packages/marvel-shop/src/Enums` folder.

### Events

All the events are in `packages/marvel-shop/src/Events` folder.

### Listeners

All the listeners corresponding to the above events are in `packages/marvel-shop/src/Listeners` folder

### Mail

All the mailables are in `packages/marvel-shop/src/Mails` folder.

### Notifications

Notifications related to order placed is reside `packages/marvel-shop/src/Notifications`. Currently we have provided mail notification but you can easily add others notification system using laravel conventions.

### Providers

All the secondary service providers that we have used in our app resides in `packages/marvel-shop/src/Providers` folder. The main `ShopServiceProviders` reside in `packages/marvel-shop/src/` folder.

### stubs

The `packages/marvel-shop/stubs` folder contains all the necessary email templates and demo data related resources for the app.

## GraphQL API

### Laravel GraphQL API Endpoint

```
your_domain/graphql
```

To access the graphql api you will need a graphql client. GraphiQL is one of them. You can install it from below link(https://www.electronjs.org/apps/graphiql)

### Alternatives

-   GraphQL Playground
-   https://altair.sirmuel.design/

### Folder Structure

All the code specifically related to GraphQL reside in `packages/marvel-shop/src/GraphQL/` folder.

-   #### Mutations:

    Folder contain necessary mutations files which is connected to rest Controller file for code reusability.

-   #### Queries:

    Folder contain necessary queries files which is connected to rest Controller file for code reusability.

-   #### Schema
    This is the most important part of the graphql api. Check the lighthouse-php(https://lighthouse-php.com/4.18/getting-started/installation.html) doc for understanding how schema works. We have provided schema for all the models in our app. If you check the above `lighthouse-php` doc you will understand how schema works and how you can modify it to your need.

> ### Before Finishing up

Before you finishes the installation process make sure you have completed the below steps.

-   Copied necessary files and content to your existing laravel projects(if using existing projects)
-   Installed all the necessary dependencies.
-   Ran `marvel:install` commands and followed the necessary steps.
-   Created a .env file with all the necessary env variables in the provided projects.
-   Put `DISK_NAME` configuration for `public` or 's3`
-   Set Payment related configuration to `STRIPE_API_KEY`

### Payment Gateway

We have used `omnipay` for payment and given `stripe` and `cash_on_delivery` default. We have used `ignited/laravel-omnipay` by forking it in our packages due to some compatibility issue with Laravel 8.

## Extending The Functionality

If you want to extend the functionality of the app you can easily do it on your app. You would not need to modify code from our packages folder. Like you can add any `routes` and corresponding `controller` in your laravel app as your need. We highly suggest you to do all the modification in your app so you can update the package easily.

## Deployment

Its a basic laravel application so you can deploy it as any other laravel application. Make sure you have installed all the php required plugins we mentioned above.

## FAQ

### 1. I am trying to upload files but not working.

Before upload files you need to ensure few things. First of all the you have to check which disk are you using. You can find it in `api/packages/marvel-shop/src/Config/media-library.php` file.Check the `disk_name`. If you are using `s3` then you have to configure s3 details in .env file. You can also use your local server to store images. For that `disk_name` will be `public`. Make sure you have run `php artisan storage:link` otherwise the images will not be available as public.

### 2. I am changing schema files but changes is not working

Your changes might not work because schema is cached. SO you might need to clear schema cache using the below command `php artisan lighthouse:clear-cache`.

### 3. Changing .env files but not getting the changes

Run Below command `php artisan optimize:clear`

### 4. Changing route but not getting the changes.

Run `php artisan optimize:clear` or `php artisan route:clear`

### 5. I have set `STRIPE_API_KEY` in .env but still getting error.

In some cases `STRIPE_API_KEY` value can't read from .env in those cases you have to put the key in the config file directly in `api/packages/marvel-shop/src/Config/laravel-omnipay.php`

6. Getting error on forget password email sending
   Make sure you have run the `php artisan marvel:install` commands successfully and copied the necessary email templates to your resources folder. You can also do it by `php artisan marvel:copy-files` command.

    > NB: This same issue can occur during order creation.

### 7. Can I use it with my existing laravel?

Yes, you can. Follow the below steps.

-   Make sure you are using laravel 8.
-   Copy `api/packages` folder from the downloaded files into your laravel root folder.
-   Put below code in your laravel `composer.json` file into `require` section.

```json
"ignited/laravel-omnipay": "dev-master",
"omnipay/common": "dev-master",
"omnipay/stripe": "dev-master",
"marvel/shop": "dev-master"
```

-   Put below code in bottom of your `composer.json`. If you already have an `repositories` section then put code
    inside `repositories` to your existing `repositories`

```js
"repositories": {
        "marvel/shop": {
            "type": "path",
            "url": "packages/marvel-shop"
        },
        "ignited/laravel-omnipay": {
            "type": "path",
            "url": "packages/laravel-omnipay"
        },
        "omnipay/common": {
            "type": "path",
            "url": "packages/omnipay-common"
        },
        "omnipay/stripe": {
            "type": "path",
            "url": "packages/omnipay-stripe"
        }
    }
```

-   Now run `composer install`
-   Copy necessary env variables from .env.example to you env file.
-   Run `php artisan marvel:install` and follow necessary steps.
-   To run server `php artisan serve`
-   For image upload to work properly you need to run `php artisan storage:link`.

### 8. Why am I getting `Access denied for user`?

navigate to `api` then run `./vendor/bin/sail down -v`. It will delete any of your existing mysql volumes. Now run `./vendor/bin/sail up -d` on same directory or run `bash install.sh` on root directory

### Why am I getting permission issue during deployment?

Run below commands for fixing permission issue in your laravel app during deployment

```

sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache

sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache

```

### Why am I getting "The GET method is not supported for this route. Supported methods: HEAD"?

Run `php artisan optimize:clear`
