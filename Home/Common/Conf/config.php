<?php
return array(
	//'配置项'=>'配置值'
    //数据库连接
    'DB_TYPE' => 'mysql',
    'DB_HOST'   => 'localhost',
    'DB_NAME'   => 'personal', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
//    'DB_HOST'   => 'qdm219678487.my3w.com',
//    'DB_NAME'   => 'qdm219678487_db', // 数据库名
//    'DB_USER'   => 'qdm219678487', // 用户名
//    'DB_PWD'    => 'zwxcyr0716', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'tb', // 数据库表前缀
//    'SHOW_PAGE_TRACE' => true,
    'DEFAULT_MODULES' => 'Home',
    'URL_CASE_INSENSITIVE' =>true,
    'DB_PARAMS'    =>    array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
);