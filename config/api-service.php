<?PHP
return [
    'navigation'                       => [
        'token' => [
            'cluster' => null,
            'group'   => 'User',
            'sort'    => -1,
            'icon'    => 'heroicon-o-key',
        ],
    ],
    'models'                           => [
        'token' => [
            'enable_policy' => false,
        ],
    ],
    'route'                            => [
        'panel_prefix'             => false,
        'use_resource_middlewares' => true,
    ],
    'tenancy'                          => [
        'enabled'   => true,
        'awareness' => false,
    ],
    'use-spatie-permission-middleware' => false,
];
