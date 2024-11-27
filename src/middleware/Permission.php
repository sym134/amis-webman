<?php

namespace Jizhi\Admin\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Jizhi\Admin\Admin;
use Webman\MiddlewareInterface;

class Permission implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (strpos($request->route->getPath(), '/' . config('plugin.jizhi.admin.admin.route.prefix')) === 0) {
            if (Admin::permission()->permissionIntercept($request, '')) {
                return Admin::response()->fail(admin_trans('admin.unauthorized'));
            }
        }
        return $handler($request);
    }
}

