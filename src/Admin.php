<?php

namespace jizhi\admin;

use support\Db;
use Shopwwi\WebmanAuth\Facade\Auth;
use jizhi\admin\trait\AssetsTrait;
use jizhi\admin\support\cores\Menu;
use jizhi\admin\support\cores\Context;
use jizhi\admin\support\cores\Permission;
use jizhi\admin\support\cores\JsonResponse;
use jizhi\admin\service\AdminSettingService;
use jizhi\admin\model\{AdminMenu, AdminRole, AdminUser, AdminPermission};

class Admin
{
    use AssetsTrait;

    public static function make(): static
    {
        return new static();
    }

    // public static function boot(): void
    // {
    //     Relationships::boot();
    //     Api::boot();

    // Sanctum 指定模型表
    // if (class_exists(Sanctum::class)) {
    //     Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    // }

    //Octane 清空sql记录
    // if (class_exists('\Laravel\Octane\Events\RequestReceived')) {
    //     Event::listen(\Laravel\Octane\Events\RequestReceived::class, function ($event) {
    //         SqlRecord::$sql = [];
    //     });
    // }
    // }

    public static function response(): JsonResponse
    {
        return new JsonResponse();
    }

    /**
     * @return Menu;
     */
    public static function menu(): Menu
    {
        return appw('admin.menu');
    }

    /**
     * @return Permission
     */
    public static function permission(): Permission
    {
        return new Permission;
    }

    public static function guard()
    {
        return Auth::guard(self::config('admin.auth.guard') ?: 'admin');
    }

    /**
     * @return AdminUser|null
     */
    public static function user(): ?AdminUser
    {
        return static::guard()->user();
    }

    /**
     * 上下文管理.
     *
     * @return Context
     */
    public static function context(): Context
    {
        return appw('admin.context');
    }

    /**
     * @return AdminSettingService
     */
    public static function setting(): AdminSettingService
    {
        // return appw('admin.setting');
        return settings();
    }

    /**
     * @return string
     */
    public static function adminMenuModel(): string
    {
        return self::config('admin.models.admin_menu', AdminMenu::class);
    }

    /**
     * @return string
     */
    public static function adminPermissionModel(): string
    {
        return self::config('admin.models.admin_permission', AdminPermission::class);
    }

    /**
     * @return string
     */
    public static function adminRoleModel(): string
    {
        return self::config('admin.models.admin_role', AdminRole::class);
    }

    /**
     * @return string
     */
    public static function adminUserModel(): string
    {
        return self::config('admin.models.admin_user', AdminUser::class);
    }

    public static function config($key, $default = '')
    {
        $key = 'plugin.jizhi.admin.' . $key; // webman
        return config($key, $default);
    }

    // 替换后台视图api
    public static function view($apiPrefix = ''): array|string|null
    {
        if (!$apiPrefix) {
            $apiPrefix = self::config('admin.route.prefix');
        }

        if (is_file(public_path('admin-assets/index.html'))) {
            $view = file_get_contents(public_path('admin-assets/index.html'));
        } else {
            $view = file_get_contents(base_path('vendor/jizhi/admin/src/admin-assets/index.html'));
        }

        $script = '<script>window.$adminApiPrefix = "/' . $apiPrefix . '"</script>';

        return preg_replace('/<script>window.*?<\/script>/is', $script, $view);
    }

    public static function hasTable($table): bool
    {
        $key = 'admin_has_table_' . $table;
        if (cache()->has($key)) {
            return true;
        }

        $has = Db::schema()->hasTable($table);

        if ($has) {
            cache()->forever($key, true);
        }

        return $has;
    }

    /**
     * 中间件
     *
     * @return array
     *
     * Author:sym
     * Date:2024/6/18 上午7:43
     * Company:极智网络科技
     */
    public static function middleware(): array
    {
        return [
            \jizhi\admin\middleware\ConnectionDatabase::class,
            \jizhi\admin\middleware\ForceHttps::class,
            \jizhi\admin\middleware\AutoSetLocale::class,
            \jizhi\admin\middleware\Authenticate::class,
            \jizhi\admin\middleware\Permission::class,
        ];
    }
}
