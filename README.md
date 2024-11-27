jizhi-admin-webman
==================

基于 [OwlAdmin](https://github.com/slowlyo/owl-admin) 修改的 Webman版本。

## php版本
php>=8.2
## webman 安装

```shell
composer create-project workerman/webman
cd webman
```

## 数据库配置文件位置为 config/database.php
```shell
return [
 // 默认数据库
 'default' => 'mysql',
 // 各种数据库配置
 'connections' => [

     'mysql' => [
         'driver'      => 'mysql',
         'host'        => '127.0.0.1',
         'port'        => 3306,
         'database'    => 'webman',
         'username'    => 'webman',
         'password'    => '',
         'unix_socket' => '',
         'charset'     => 'utf8',
         'collation'   => 'utf8_unicode_ci',
         'prefix'      => '',
         'strict'      => true,
         'engine'      => null,
     ],
 ],
];
```

## 安装

```shell
composer require jizhi/amis-webman
```

## 配置 .env （按需添加）

```env
# 语言
APP_LOCALE=zh_CN

# admin 登录验证码
ADMIN_LOGIN_CAPTCHA=true
# admin https
ADMIN_HTTPS=false
# admin开发工具
ADMIN_SHOW_DEVELOPMENT_TOOLS=true
# 显示自动生成权限按钮
ADMIN_SHOW_AUTO_GENERATE_PERMISSION_BUTTON=true
DB_CONNECTION=mysql
```

## 配置auth config/plugin/shopwwi/auth/app.php

```php
 return [
     'enable' => true,
     'app_key' => 'base64:N721v3Gt2I58HH7oiU7a70PQ+i8ekPWRqwI+JSnM1wo=',
     'guard' => [
    // ........
         // 添加 admin
         'admin' => [
             'key' => 'id',
             'field' => ['id','name','email','mobile'], //设置允许写入扩展中的字段
             'num' => 0, //-1为不限制终端数量 0为只支持一个终端在线 大于0为同一账号同终端支持数量 建议设置为1 则同一账号同终端在线1个
             'model'=> \plugin\owladmin\app\model\AdminUser::class
         ]
     ],
    // ........
```

## 安装数据
```shell
php webman admin:install
```

## 运行

```shell
php start.php start
```

## 访问

http://127.0.0.1:8780/admin


## 常见问题
### 相片路径
打开后台》系统管理 / 存储设置，修改【域名】

