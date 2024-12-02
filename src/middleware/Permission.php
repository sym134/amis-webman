<?php

namespace jizhi\admin\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use jizhi\admin\Admin;
use Webman\MiddlewareInterface;

/**
 * 权限
 * Permission
 * jizhi\admin\middleware
 *
 * Author:sym
 * Date:2024/12/2 22:03
 * Company:极智科技
 */
class Permission implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (Admin::permission()->permissionIntercept($request, '')) {
            return Admin::response()->fail(admin_trans('admin.unauthorized'));
        }
        return $handler($request);
    }
}

