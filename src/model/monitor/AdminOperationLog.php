<?php

namespace Jizhi\Admin\model\monitor;

use Jizhi\Admin\model\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminOperationLog extends BaseModel
{
    use SoftDeletes;

    protected $table = 'admin_operation_log';
    public const UPDATED_AT = null;
}
