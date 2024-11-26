<?php

use Illuminate\Filesystem\Filesystem;
use Jizhi\Admin\support\Cores\Menu;
use Jizhi\Admin\support\Cores\Asset;
use Jizhi\Admin\support\Pipeline;
use Jizhi\Admin\support\Cores\Context;
use Jizhi\Admin\support\Apis\DataListApi;
use Jizhi\Admin\support\Apis\DataCreateApi;
use Jizhi\Admin\support\Apis\DataDetailApi;
use Jizhi\Admin\support\Apis\DataDeleteApi;
use Jizhi\Admin\support\Apis\DataUpdateApi;
use Jizhi\Admin\service\AdminSettingService;

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
