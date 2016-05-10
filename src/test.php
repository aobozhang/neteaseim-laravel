<?php
namespace Aobo\Neteaseim;
require("NeteaseimClass.php");

$option = [
    'appkey'      => env('NETEASEIM_APPKEY', ''),
    'appsecret'   => env('NETEASEIM_APPSECRET', ''),
];

$easemob = new NeteaseimClass($option);

var_dump($easemob->showFriends('1234'));
