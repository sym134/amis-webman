<?php

namespace Jizhi\Admin\model\system;

use Jizhi\Admin\model\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends BaseModel
{
    use SoftDeletes;
    public const UPDATED_AT = null;
    const STORAGE_MODE = ['local' => '本地', 'qiniu' => '七牛', 'aliyun' => '阿里云', 'qcloud' => '腾讯云'];
    const FILE_TYPE = ['image' => '图片', 'text' => '文档', 'audio' => '音频', 'file' => '文件'];

    protected $table = 'attachments';
}
