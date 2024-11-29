<?php

namespace jizhi\admin\controller\system;

use support\Request;
use support\Response;
use jizhi\admin\controller\AdminController;
use jizhi\admin\service\system\CacheService;

class CacheController extends AdminController
{
    public function index(): Response
    {
        return $this->response()->success(
            amis()->Form()->title('清除缓存')->api($this->getStorePath())
                ->mode('horizontal')
                ->body([
                    amis()->CheckboxControl('storage', '存储器')->value(1),
                ])
        );
    }

    public function store(Request $request): Response
    {
        CacheService::clear($request->all());
        return $this->autoResponse(1, '清理');
    }
}
