# notifier

Notifier is a laravel library that helps you to popup notifications to your registered users.

# requirements
  1- Jquery

# How to install ? 
 - Composer: 
 type ``` composer require carkii/notifier ```

## configaration (provider & alias)
in ``` config\app.php ```, add notifier service provider :
```php
'providers' => [
    /*  
    //
    other providers
    //
    */
    Carkii\Notifier\NotifierServiceProvider::class,
  ]
```

and add aliase to same file:

```php
'aliases' => [
    /*  
    //
    other aliases
    //
    */
    'Notifier' => Carkii\Notifier\facades\Notifier::class,
  ]
```
## publish 
publish the required files by typing ``` php artisan vendor:publish ``` in terminal.

This will add the following to your project:

1- /config/notifier.php

2- /resources/views/notifications/example.blade.php

3- /public/css/notifications.css

4- /public/js/notifications.js

## migrate ```notifications``` table
in your terminal, type : ```php artisan migrate```

Note: this library supposed that you already migrated the users table under ```users``` name in your database.

## add CSRF_token
add CSRF_token to your head tag, add: ```php <meta name="csrf-token" content="{{ csrf_token() }}"> ``` to your <head></head> tag in html


