<?php

namespace Jizhi\Admin\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Jizhi\Admin\Admin;
use Webman\MiddlewareInterface;

class ForceHttps implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (!is_null($request->route) && strpos($request->route->getPath(), '/' . config('plugin.jizhi.admin.admin.route.prefix')) === 0) {
            if ($request->protocolVersion() === '1.1' && Admin::config('admin.https')) {
                return Admin::response()->additional(['code' => 301])->fail('请使用https');
            }
        }

        return $handler($request);
    }
}
