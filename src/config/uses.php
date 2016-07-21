<?php
/**
 * Created by PhpStorm.
 * User: XingHuo
 * Date: 16/7/19
 * Time: 下午5:14
 */


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