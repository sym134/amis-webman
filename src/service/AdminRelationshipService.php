<?php

namespace jizhi\admin\service;

use RegexIterator;
use ReflectionClass;
use Illuminate\Support\Str;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use jizhi\admin\support\cores\Database;
use jizhi\admin\model\AdminRelationship;

/**
 * @method AdminRelationship getModel()
 * @method AdminRelationship|Builder query()
 */
class AdminRelationshipService extends AdminService
{
    protected string $modelName = AdminRelationship::class;

    public string $cacheKey = 'admin_relationships';

    public function list(): array
    {
        $list = parent::list();

        collect($list['items'])->transform(function ($item) {
            $item->setAttribute('preview_code', $item->getPreviewCode());
        });

        return $list;
    }

    public function getAll()
    {
        return cache()->rememberForever($this->cacheKey, function () {
            return self::query()->get();
        });
    }

    public function saving(&$data, $primaryKey = ''): void
    {
        $exists = self::query()
            ->where('model', $data['model'])
            ->where('title', $data['title'])
            ->when($primaryKey, fn($q) => $q->where('id', '<>', $primaryKey))
            ->exists();

        admin_abort_if($exists, admin_trans('admin.relationships.rel_name_exists'));

        $methodExists = method_exists($data['model'], $data['title']);

        admin_abort_if($methodExists, admin_trans('admin.relationships.rel_name_exists'));
    }

    public function saved($model, $isEdit = false): void
    {
        cache()->forget($this->cacheKey);
    }

    public function deleted($ids): void
    {
        cache()->forget($this->cacheKey);
    }

    public function allModels(): array
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(app_path('admin/model'))); // todo 目前只有app，没有插件的model
        $phpFiles = new RegexIterator($iterator, '/^.+\.php$/i', RegexIterator::GET_MATCH);

        foreach ($phpFiles as $phpFile) {
            $filePath = $phpFile[0];
            require_once $filePath;
        }

        $modelDirClass = collect(get_declared_classes())
            ->filter(fn($i) => Str::startsWith($i, 'app\\admin\\model')) //webman
            ->toArray();

        $composer = require base_path('/vendor/autoload.php');
        $classMap = $composer->getClassMap();
        $tables   = Database::getTables();

        $models = collect($classMap)
            ->keys()
            ->filter(fn($item) => str_contains($item, 'model\\'))// webman
            ->filter(fn($item) => @class_exists($item))
            ->filter(fn($item) => (new ReflectionClass($item))->isSubclassOf(Model::class))
            ->merge($modelDirClass)
            ->unique()
            ->filter(fn($item) => in_array((new $item)->getTable(), $tables))
            ->values()
            ->map(fn($item) => [
                'label' => Str::of($item)->explode('\\')->pop(),
                'table' =>(new $item)->getTable(),
                'value' => $item,
            ]);

        return compact('tables', 'models');
    }

    public function generateModel($table): void
    {
        $className = Str::of($table)->studly()->singular()->value();

        $template = <<<PHP
<?php

namespace jizhi\admin\model;

use jizhi\admin\model\BaseModel as Model;

class $className extends Model
{
    protected \$table = '$table';
}
PHP;

        $path = app_path("model/$className.php");

        admin_abort_if(file_exists($path), admin_trans('admin.relationships.model_exists'));

        appw('files')->put($path, $template);
    }
}
