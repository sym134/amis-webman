<?php

namespace jizhi\admin\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

/**
 * 语言切换
 * AutoSetLocale
 * jizhi\admin\middleware
 *
 * Author:sym
 * Date:2024/12/2 22:03
 * Company:极智科技
 */
class AutoSetLocale implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        $locale = request()->header('locale', config('plugin.jizhi.admin.app.translation.locale')); // 获取客户端要求的语言包
        // 切换语言
        locale($locale);
        return $handler($request);
    }
}
