<?php

namespace Jizhi\Admin\support\Cores;

use Jizhi\Admin\Admin;
use Jizhi\Admin\support\Apis\{DataCreateApi, GetSettingsApi, OptionsApi, SaveSettingsApi};
use Jizhi\Admin\support\Apis\DataListApi;
use Jizhi\Admin\support\Apis\DataDetailApi;
use Jizhi\Admin\support\Apis\DataUpdateApi;
use Jizhi\Admin\support\Apis\DataDeleteApi;

// todo 导入api模板
class Api
{
    public static function boot(): void
    {
        appw('admin.context')->set('apis', [
            DataListApi::class,
            DataCreateApi::class,
            DataDetailApi::class,
            DataDeleteApi::class,
            DataUpdateApi::class,
            OptionsApi::class,
            GetSettingsApi::class,
            SaveSettingsApi::class,
        ]);

        if (!is_dir(self::path()))  return;

        collect(scandir(app_path('/ApiTemplates')))
            ->filter(fn($file) => !in_array($file, ['.', '..']) && str_ends_with($file, '.php'))
            ->each(function ($file) {
                $class = 'App\\ApiTemplates\\' . str_replace('.php', '', $file);
                try {
                    if (class_exists($class)) {
                        Admin::context()->add('apis', $class);
                    }
                } catch (\Throwable $e) {
                }
            });
    }

    public static function path($file = ''): string
    {
        return app_path('/ApiTemplates') . ($file ? '/' . ltrim($file, '/') : '');
    }
}
