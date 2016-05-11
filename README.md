# easemob-facades for laravel
used Neteaseim as Normal laravel facades



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

            Aobo\Neteaseim\NeteaseimServiceProvider::class,

        ],
    ];

```  
* Third:  

type follow in console:
```
php artisan vendor:publish
```

> <strong>Till now, you can use it </strong>  


## Usage  

```php
use Neteaseim;

...

$param = [
    'accid' => 'test-accid-'.str_random(32),
    'name'  => 'test-name-'.str_random(32)
];

var_dump(Neteaseim::user_create($param));

```  

## To Use Your Own Configuration  

Modify ".env" -- recommend

```
NETEASEIM_APPKEY=your key
NETEASEIM_APPSECRET=your secret
```

Or You Can Modify "config\neteaseim.php" -- The Same effect.

```php
return [
    'appkey'      => env('NETEASEIM_APPKEY', 'your key'),
    'appsecret'   => env('NETEASEIM_APPSECRET', 'your secret')
];
```  
