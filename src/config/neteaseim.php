<?php

//默认返回官网提供的测试账号；配置.env以使用自己的账号或者直接修改；
return [
    'appkey'      => env('NETEASEIM_APPKEY', ''),
    'appsecret'   => env('NETEASEIM_APPSECRET', ''),
];
