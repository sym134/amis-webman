<?php

namespace jizhi\admin\service\system;

use jizhi\admin\service\AdminService;
use jizhi\admin\model\system\Attachment;

class AttachmentService extends AdminService
{
    public function __construct()
    {
        parent::__construct();
        $this->modelName = Attachment::class;
    }


}
