<?php

namespace jizhi\admin\bootstrap;

use Webman\Bootstrap;
use Workerman\Worker;
use jizhi\admin\support\SqlRecord;

class SqlMonitor implements Bootstrap
{

    public static function start(?Worker $worker): void
    {
        if (config('app.debug')) {
            SqlRecord::listen();
        }
    }
}
