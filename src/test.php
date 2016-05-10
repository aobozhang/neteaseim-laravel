<?php
namespace Aobo\NeteaseIM;
require("NeteaseIMClass.php");

$option = [
    'appkey'      => env('NETEASEIM_APPKEY', ''),
    'appsecret'   => env('NETEASEIM_APPSECRET', ''),
];

$easemob = new NeteaseIMClass($option);

var_dump($easemob->showFriends('1234'));
