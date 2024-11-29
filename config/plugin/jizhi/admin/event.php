<?php

use jizhi\admin\event\SystemUser;

return [
    'user.login' => [
        [SystemUser::class, 'login'],
    ],
    'user.operateLog' => [
        [SystemUser::class, 'operateLog'],
    ]
];
