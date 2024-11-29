<?php

namespace jizhi\admin\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class AutoSetLocale implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (!is_null($request->route) && strpos($request->route->getPath(), '/' . config('plugin.jizhi.admin.admin.route.prefix')) === 0) {
            $locale = request()->header('locale', config('plugin.jizhi.admin.admin.translation.locale')); // 获取客户端要求的语言包
            // 切换语言
            locale($locale);
        }
        return $handler($request);
    }
}
