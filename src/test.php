<?php
namespace Aobo\Neteaseim;
require("NeteaseimClass.php");

$option = [
    'appkey'      => env('NETEASEIM_APPKEY', ''),
    'appsecret'   => env('NETEASEIM_APPSECRET', ''),
];

$neteaseim = new NeteaseimClass($option);

$param = [
    'accid' => 'test-accid-'.str_random(32),
    'name'  => 'test-name-'.str_random(32)
];

var_dump($neteaseim->user_create($param));
