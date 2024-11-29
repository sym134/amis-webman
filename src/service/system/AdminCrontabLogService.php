<?php

namespace jizhi\admin\service\system;

use jizhi\admin\service\AdminService;
use jizhi\admin\model\system\AdminCrontabLog;

/**
 * 定时任务日志
 *
 * @method AdminCrontabLog getModel()
 * @method AdminCrontabLog|\Illuminate\Database\Query\Builder query()
 */
class AdminCrontabLogService extends AdminService
{
	protected string $modelName = AdminCrontabLog::class;
}
