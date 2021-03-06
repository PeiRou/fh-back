<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'logs' => [
            'driver' => 'local',
            'root' => storage_path('logs'),
        ],

        'thread' => [
            'driver' => 'local',
            'root' => storage_path('thread'),
        ],
//彩票转移数据暂时存放的文件
        'betTemp' => [
            'driver' => 'local',
            'root' => storage_path('betTemp'),
        ],
//第三方转移数据暂时存放的文件
        'betJqTemp' => [
            'driver' => 'local',
            'root' => storage_path('betJqTemp'),
        ],

        'guanOpen' => [
            'driver' => 'local',
            'root' => storage_path('guanOpen'),
        ],

        'static' => [
            'driver' => 'local',
            'root' => public_path('static'),
        ],

        'gameTime' => [
            'driver' => 'local',
            'root' => storage_path('gameTime'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'GamesApi' => [
            'driver' => 'local',
            'root' => storage_path('GamesApi'),
        ],

        'Card' => [
            'driver' => 'local',
            'root' => storage_path('Card'),
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
