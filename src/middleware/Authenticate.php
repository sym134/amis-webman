<?php

namespace Jizhi\Admin\middleware;

use Webman\Event\Event;
use Webman\Http\Request;
use Webman\Http\Response;
use Jizhi\Admin\Admin;
use Webman\MiddlewareInterface;

class Authenticate implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (!is_null($request->route) && strpos($request->route->getPath(), '/' . config('plugin.jizhi.admin.admin.route.prefix')) === 0) {
            [$state, $user] = Admin::permission()->authIntercept($request);
            if ($state) {
                return Admin::response()->additional(['code' => 401])->fail(admin_trans('admin.please_login'));
            }
            $request->user = $user;
            // 记录日志
            Event::emit('user.operateLog', true);
        }
        return $handler($request);
    }
}
