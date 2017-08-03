#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3
 * Time: 14:37
 */

define('APP_PATH', __DIR__ . '/application/');
define('BIND_MODULE','admin/Socket');

require __DIR__ . '/../vendor/autoload.php';
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';