<?php

namespace Jizhi\Admin\model;

use support\Model;
use Jizhi\Admin\Admin;
use Jizhi\Admin\trait\DatetimeFormatterTrait;

class BaseModel extends Model
{
    use DatetimeFormatterTrait;

    public function __construct(array $attributes = [])
    {
        if (env('ENABLED_SAAS')) {
            // 切换当前站点信息
            $this->setConnection((isset(request()->tenant) && request()->tenant['database']) ? request()->tenant['database'] : 'plugin.saas.saas');
        } else {
            // 切换当前站点信息
            $this->setConnection(Admin::config('admin.database.connection'));
        }

        parent::__construct($attributes);
    }
}
