<?php

return [
    [
        'name' => 'Dashboard View',
        'slug' => 'dashboard-view',
        'create' => false,
        'read' => true,
        'update' => false,
        'delete' => false,
    ],
    [
        'name' => 'User',
        'slug' => 'user',
        'create' => false,
        'read' => true,
        'update' => false,
        'delete' => true,
    ],
    [
        'name' => 'Role',
        'slug' => 'role',
        'create' => false,
        'read' => false,
        'update' => false,
        'delete' => false,
    ],
    [
        'name' => 'UserRolePermission',
        'slug' => 'user-role-permission',
        'create' => false,
        'read' => true,
        'update' => false,
        'delete' => true,
    ],
];
