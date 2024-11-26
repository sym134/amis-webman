<?php

namespace Jizhi\Admin\service\system;

use Jizhi\Admin\service\AdminService;
use Jizhi\Admin\model\system\Attachment;

class AttachmentService extends AdminService
{
    public function __construct()
    {
        parent::__construct();
        $this->modelName = Attachment::class;
    }


}
