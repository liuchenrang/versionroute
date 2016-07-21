# versionroute
lumen version route

config demo

return [
    'versions' => [
        'v1' => [
            'api/user/hello' => [
                'uses' => [
                    'V1\V120\NoteController@hello',
                    'V1\V20\NoteController@hello',
                    'V1\NoteController@hello',
                ]
            ]
        ]
    ],
    'namespace' => [
        'v1' => 'App\Http\Controllers\Api'
    ],
    'common' => [
        'default_version' => '1.0.0',
        'request_version_name' => '_s',
    ]

];
enable 
$app->register(Jiuyan\VersionRoute\VersionRouteServiceProvider::class);


|____Http
| |____Controllers
| | |____Api
| | | |____UserController.php
| | | |____V1
| | | | |____NoteController.php
| | | | |____V120
| | | | | |____NoteController.php
| | | | |____V20
| | | | | |____NoteController.php
