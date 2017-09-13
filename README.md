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

2- /resources/views/notifications/_cardExample.blade.php

3- /resources/views/notifications/_ModalExample.blade.php

4- /public/css/notifications.css

5- /public/js/notifications.js

## migrate ```notifications``` table
in your terminal, type : ```php artisan migrate```

Note: this library supposed that you already migrated the users table under ```users``` name in your database.

## add CSRF_token
add CSRF_token to your head tag, add: ```php <meta name="csrf-token" content="{{ csrf_token() }}"> ``` to your <head></head> tag in html

# How to use?
 ## 1- Modal (popup)
 1- login in to your website
 
 2- add the following at the end of your page (default: app.blade.php):
 
 ```php 
 {!! Notifier::break(0,30,0)->get()->first() !!}
 {!! Notifier::addStylesAndScriptes() !!}
 ```
 
 3- remove the first underscore (_) from ```/resources/views/notifications/_ModalExample.blade.php``` to be as ```/resources/views/notifications/ModalExample.blade.php```. (this example is using bootstrap)
 
 
 Note: the first underscore of your notification file tells Notifier to ignore this file.
 
 
All of your notifications are located in ```/resources/views/notifications/```, each notification in each file (blade template)

So, whenever you add a file to this folder, it means you are adding a new notification to your list.

4- visit your website :)
