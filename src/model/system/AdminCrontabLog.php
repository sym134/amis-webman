<?php

namespace jizhi\admin\model\system;

use jizhi\admin\model\BaseModel as Model;

/**
 * 定时任务日志
 */
class AdminCrontabLog extends Model
{

    protected $table = 'admin_crontab_log';

    protected $casts = [
        'parameter' => 'json',
    ];

    public const UPDATED_AT = null;
}
