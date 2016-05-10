# easemob-facades for laravel
used NeteaseIM as Normal laravel facades


[![Latest Stable Version](https://poser.pugx.org/aobozhang/easemob-facades/v/stable)](https://packagist.org/packages/aobozhang/easemob-facades) [![Total Downloads](https://poser.pugx.org/aobozhang/easemob-facades/downloads)](https://packagist.org/packages/aobozhang/easemob-facades) [![Latest Unstable Version](https://poser.pugx.org/aobozhang/easemob-facades/v/unstable)](https://packagist.org/packages/aobozhang/easemob-facades) [![License](https://poser.pugx.org/aobozhang/easemob-facades/license)](https://packagist.org/packages/aobozhang/easemob-facades)

## Installation  

* First:  

```
composer require aobozhang/neteaseim-laravel
```

* Second:  

Modify "config\app.php"  

```php
<?php

    return = [

        ...,

        'providers' = [

            ...,

            Aobo\NetEaseIM\EasemobServiceProvider::class,

        ],
    ];

```  
* Third:  

```
php artisan vendor:publish
```

> <strong>Till now, you can use it </strong>  
> Test Account Supply by [http://github/easemob/](http://github/easemob/)



## Usage  

```php
use Easemob;

...

$options = [
    'username' => 'test_username',
    'password' => 'test_password'
];

return Easemob::accreditRegister($options);

```  

## To Use Your Own Configuration  

Modify ".env" -- recommend

```
EASEMOB_ORG_NAME=YourOrgName
EASEMOB_APP_NAME=YourAppName
EASEMOB_CLIENT_ID=YourClientID
EASEMOB_CLIENT_SECRET=YourClientSecret
```

Or You Can Modify "config\easemob.php" -- The Same effect.

```
return [
    'org_name'      => env('EASEMOB_ORG_NAME', 'easemob-playground'),
    'app_name'      => env('EASEMOB_APP_NAME', 'test1'),
    'client_id'     => env('EASEMOB_CLIENT_ID', 'YXA6wDs-MARqEeSO0VcBzaqg5A'),
    'client_secret' => env('EASEMOB_CLIENT_SECRET', 'YXA6JOMWlLap_YbI_ucz77j-4-mI0JA'),
];
```  
