<?php

use Jizhi\Admin\event\SystemUser;

return [
    'user.login' => [
        [SystemUser::class, 'login'],
    ],
    'user.operateLog' => [
        [SystemUser::class, 'operateLog'],
    ]
];
