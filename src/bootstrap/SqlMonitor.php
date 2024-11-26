<?php

namespace Jizhi\Admin\bootstrap;

use Webman\Bootstrap;
use Workerman\Worker;
use Jizhi\Admin\support\SqlRecord;

class SqlMonitor implements Bootstrap
{

    public static function start(?Worker $worker): void
    {
        if (config('app.debug')) {
            SqlRecord::listen();
        }
    }
}
