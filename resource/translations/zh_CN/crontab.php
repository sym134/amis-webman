<?php
return [
    'name'                    => '任务名称',
    'task_type'               => '任务类型',
    'execution_cycle'         => '执行周期',
    'target'                  => '目标',
    'parameter'               => '参数',
    'rule'                    => '规则',
    'week'                    => '星期',
    'day'                     => '天',
    'hour'                    => '小时',
    'minute'                  => '分钟',
    'second'                  => '秒',
    'remark'                  => '备注',
    'created_by'              => '创建者',
    'task_status'             => '任务状态',
    'name_description'        => '*任务名称必须唯一',
    'target_description'      => '类任务参考：xxx\xxx\类:方法名称',
    'execution_log'           => '执行日志',
    'run'                     => '执行',
    'execution_cycle_options' => [
        'day'      => '每天',
        'day-n'    => 'N天',
        'hour'     => '每小时',
        'hour-n'   => 'N小时',
        'minute-n' => 'N分钟',
        'week'     => '每周',
        'month'    => '每月',
        'second-n' => 'N秒',
    ],

    'crontab_log' => [
        'crontab_id'       => '任务ID',
        'task_name'        => '任务名称',
        'task_type'        => '任务类型',
        'execution_cycle'  => '执行周期',
        'target'           => '调用目标',
        'exception_info'   => '错误信息',
        'parameter'        => '参数',
        'execution_status' => '执行状态',
    ],
];
