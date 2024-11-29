<?php

namespace jizhi\admin\service\system;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use jizhi\admin\model\system\Config;
use Illuminate\Database\Eloquent\Collection;
use jizhi\admin\service\AdminService;

class StorageService extends AdminService
{
    public function saveConfig(array $data): bool
    {
        settings()->set('storage', $data);
        settings()->clearCache('storage');
        return true;
    }

    public function getEditData($id): Model|Collection|Builder|array|null
    {
        return settings()->get('storage');
    }
}
