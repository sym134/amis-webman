<?php

namespace jizhi\admin\support\cores;


use jizhi\admin\Admin;
use jizhi\admin\service\AdminRelationshipService;

class Relationships
{
    public static function boot(): void
    {
        if (!Admin::hasTable('admin_relationships')) {
            return;
        }

        $relationships = AdminRelationshipService::make()->getAll();

        if (blank($relationships)) {
            return;
        }

        foreach ($relationships as $relationship) {
            try {
                $relationship->model::resolveRelationUsing($relationship->title, function ($model) use ($relationship) {
                    $method = $relationship->method;

                    return $model->$method(...array_column($relationship->buildArgs(), 'value'));
                });
            } catch (\Throwable $e) {
            }
        }
    }
}
