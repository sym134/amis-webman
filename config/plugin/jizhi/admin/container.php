<?php

use Illuminate\Filesystem\Filesystem;
use jizhi\admin\support\cores\Menu;
use jizhi\admin\support\cores\Asset;
use jizhi\admin\support\Pipeline;
use jizhi\admin\support\cores\Context;
use jizhi\admin\support\apis\DataListApi;
use jizhi\admin\support\apis\DataCreateApi;
use jizhi\admin\support\apis\DataDetailApi;
use jizhi\admin\support\apis\DataDeleteApi;
use jizhi\admin\support\apis\DataUpdateApi;
use jizhi\admin\service\AdminSettingService;

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    'apis'          => [
        DataListApi::class,
        DataCreateApi::class,
        DataDetailApi::class,
        DataDeleteApi::class,
        DataUpdateApi::class,
    ],
    'files'         => new Filesystem,
    'admin.menu'    => new Menu,
    'admin.asset'   => new Asset,
    'admin.setting' => AdminSettingService::make(),
    'admin.context' => new Context,
    'Pipeline' => new Pipeline,
    // 'admin.module'  => new Module,
]);
$builder->useAutowiring(true);
return $builder->build();
