<?php

namespace Jizhi\Admin\service\monitor;

use Jizhi\Admin\service\AdminService;
use Jizhi\Admin\model\monitor\AdminLoginLog;

/**
 * 登录日志
 *
 * @method AdminLoginLog getModel()
 * @method AdminLoginLog|\Illuminate\Database\Query\Builder query()
 */
class AdminLoginLogService extends AdminService
{
	protected string $modelName = AdminLoginLog::class;
}
