<?php

namespace jizhi\admin\model;

use support\Model;
use jizhi\admin\Admin;
use jizhi\admin\trait\DatetimeFormatterTrait;

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
            $this->setConnection(Admin::config('app.database.connection'));
        }

        parent::__construct($attributes);
    }
}
