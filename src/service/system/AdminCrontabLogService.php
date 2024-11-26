<?php

namespace Jizhi\Admin\service\system;

use Jizhi\Admin\service\AdminService;
use Jizhi\Admin\model\system\AdminCrontabLog;

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
