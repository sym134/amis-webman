<?php

namespace jizhi\admin\service\monitor;

use jizhi\admin\service\AdminService;
use jizhi\admin\model\monitor\AdminLoginLog;

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
