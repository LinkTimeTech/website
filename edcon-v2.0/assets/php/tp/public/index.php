<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
ini_set('date.timezone', 'Asia/Shanghai');
define('OMISE_PUBLIC_KEY', 'pkey_test_56bod6t9yl5li6whpfa');
//pkey_5af2oawcv1t31tqg8xg
//pkey_test_5acsuittt50wpshlf49
//pkey_test_5abmx0y59wgx8ynuis5
define('OMISE_SECRET_KEY', 'skey_test_56bod6tahnicxrvrxxq');
//skey_5af2osj87h3wu6v1cfp
//skey_test_5aaqj86dz4wq716mo0m
//skey_test_5abmvviayyjvuy0ztg2
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';