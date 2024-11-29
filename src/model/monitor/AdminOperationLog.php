<?php

namespace jizhi\admin\model\monitor;

use jizhi\admin\model\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminOperationLog extends BaseModel
{
    use SoftDeletes;

    protected $table = 'admin_operation_log';
    public const UPDATED_AT = null;
}
