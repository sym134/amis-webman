<?php

use Webman\Route;
use jizhi\admin\Admin;
use jizhi\admin\controller\AuthController;
use jizhi\admin\controller\HomeController;
use jizhi\admin\controller\IndexController;
use jizhi\admin\controller\AdminRoleController;
use jizhi\admin\controller\AdminUserController;
use jizhi\admin\controller\AdminMenuController;
use jizhi\admin\controller\dev_tools\ApiController;
use jizhi\admin\controller\system\CacheController;
use jizhi\admin\controller\system\StorageController;
use jizhi\admin\controller\dev_tools\PagesController;
use jizhi\admin\controller\dev_tools\EditorController;
use jizhi\admin\controller\AdminPermissionController;
use jizhi\admin\controller\dev_tools\PluginController;
use jizhi\admin\controller\system\AttachmentController;
use jizhi\admin\controller\system\AdminCrontabController;
use jizhi\admin\controller\monitor\AdminLoginLogController;
use jizhi\admin\controller\dev_tools\RelationshipController;
use jizhi\admin\controller\dev_tools\CodeGeneratorController;
use jizhi\admin\controller\system\AdminCrontabLogController;
use jizhi\admin\controller\monitor\AdminOperationLogController;

Route::get('/admin', fn() => Admin::view());


Route::group('/' . config('plugin.jizhi.admin.admin.route.prefix'), function () {

    Route::get('/login', [AuthController::class, 'loginPage']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/captcha', [AuthController::class, 'reloadCaptcha']);
    Route::get('/current-user', [AuthController::class, 'currentUser']);

    Route::get('/menus', [IndexController::class, 'menus']);
    Route::get('/_settings', [IndexController::class, 'settings']);
    Route::post('/_settings', [IndexController::class, 'saveSettings']);
    Route::get('/no-content', [IndexController::class, 'noContentResponse']);
    Route::get('/_download_export', [IndexController::class, 'downloadExport']);
    Route::get('/_iconify_search', [IndexController::class, 'iconifySearch']);
    Route::get('/page_schema', [IndexController::class, 'pageSchema']);

    Route::any('/upload_file', [IndexController::class, 'uploadFile']);
    Route::any('/upload_chunk_start', [IndexController::class, 'chunkUploadStart']);
    Route::any('/upload_chunk', [IndexController::class, 'chunkUpload']);
    Route::any('/upload_chunk_finish', [IndexController::class, 'chunkUploadFinish']);
    Route::any('/upload_rich', [IndexController::class, 'uploadRich']);
    Route::any('/upload_image', [IndexController::class, 'uploadImage']);
    Route::get('/user_setting', [AuthController::class, 'userSetting']);
    Route::put('/user_setting', [AuthController::class, 'saveUserSetting']);

    Route::resource('/dashboard', HomeController::class);

    Route::group('/system', function () {
        Route::get('/', [AdminUserController::class, 'index']);

        Route::resource('/admin_users', AdminUserController::class);
        Route::resource('/cache', CacheController::class);
        Route::post('/admin_menus/save_order', [AdminMenuController::class, 'saveOrder']);
        Route::resource('/admin_menus', AdminMenuController::class);
        Route::resource('/admin_roles', AdminRoleController::class);
        Route::resource('/admin_permissions', AdminPermissionController::class);

        Route::post('/admin_role_save_permissions', [AdminRoleController::class, 'savePermissions']);
        Route::post('/_admin_permissions_auto_generate', [AdminPermissionController::class, 'autoGenerate']);

        Route::resource('/storage', StorageController::class);
        Route::resource('/attachment', AttachmentController::class);

        Route::resource('/admin_crontab', AdminCrontabController::class);
        Route::get('/admin_crontab_run', [AdminCrontabController::class, 'run']);
        Route::resource('/admin_crontab_log', AdminCrontabLogController::class);
    });

    Route::group('/log_monitoring', function () {
        // 登录日志
        Route::resource('/admin_login_log', AdminLoginLogController::class);
        Route::resource('/admin_operation_log', AdminOperationLogController::class);
    });


    if (config('plugin.jizhi.admin.admin.show_development_tools')) {
        Route::group('/dev_tools', function () {
            Route::resource('/code_generator', CodeGeneratorController::class);
            Route::group('/code_generator', function () {
                Route::post('/preview', [CodeGeneratorController::class, 'preview']);
                Route::post('/generate', [CodeGeneratorController::class, 'generate']);
                Route::post('/clear', [CodeGeneratorController::class, 'clear']);
                Route::post('/gen_record_options', [CodeGeneratorController::class, 'genRecordOptions']);
                Route::post('/form_data', [CodeGeneratorController::class, 'formData']);
                Route::post('/get_record', [CodeGeneratorController::class, 'getRecord']);
                Route::post('/get_property_options', [CodeGeneratorController::class, 'getPropertyOptions']);

                Route::group('/component_property', function () {
                    Route::post('/save', [CodeGeneratorController::class, 'saveComponentProperty']);
                    Route::post('/list', [CodeGeneratorController::class, 'getComponentProperty']);
                    Route::post('/del', [CodeGeneratorController::class, 'delComponentProperty']);
                });

                Route::group('/common_field', function () {
                    Route::post('/save', [CodeGeneratorController::class, 'saveColumnProperty']);
                    Route::post('/list', [CodeGeneratorController::class, 'getColumnProperty']);
                    Route::post('/del', [CodeGeneratorController::class, 'delColumnProperty']);
                });
            });

            Route::resource('/plugin', PluginController::class);
            Route::group('/plugin', function () {
                Route::post('/enable', [PluginController::class, 'enable']);
                // Route::post('/install', [PluginController::class, 'install']);
                // Route::post('/uninstall', [PluginController::class, 'uninstall']);
                // Route::post('/get_config', [PluginController::class, 'getConfig']);
                // Route::post('/save_config', [PluginController::class, 'saveConfig']);
                // Route::post('/config_form', [PluginController::class, 'configForm']);
            });

            Route::post('/editor_parse', [EditorController::class, 'index']);

            Route::resource('/pages', PagesController::class);

            Route::resource('/relationships', RelationshipController::class);
            Route::group('/relation', function () {
                Route::get('/model_options', [RelationshipController::class, 'modelOptions']);
                Route::get('/column_options', [RelationshipController::class, 'columnOptions']);
                Route::get('/all_models', [RelationshipController::class, 'allModels']);
                Route::post('/generate_model', [RelationshipController::class, 'generateModel']);
            });

            Route::resource('/apis', ApiController::class);
            Route::group('/api', function () {
                Route::get('/templates', [ApiController::class, 'template']);
                Route::get('/args_schema', [ApiController::class, 'argsSchema']);
                Route::post('/add_template', [ApiController::class, 'addTemplate']);
            });
        });
    }
})->middleware(Admin::middleware());
