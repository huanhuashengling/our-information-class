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

    'default' => 'local',

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

    'cloud' => 's3',

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

        'public' => [
            'driver' => 'local',
            'root' => storage_path('uploads'),
            'visibility' => 'public',
        ],
        
        'ysposts' => [
            'driver' => 'local',
            'root' => public_path('posts/ys'),
            // 'url' => 'posts/' . 
            'visibility' => 'public',
        ],

        'ysworks' => [
            'driver' => 'local',
            'root' => public_path('works/ys'),
            // 'url' => 'posts/' . 
            'visibility' => 'public',
        ],

        'yscover' => [
            'driver' => 'local',
            'root' => public_path('works/ys/cover'),
            // 'url' => 'posts/' . 
            'visibility' => 'public',
        ],

        'dtposts' => [
            'driver' => 'local',
            'root' => public_path('posts/dt'),
            // 'url' => 'posts/' . 
            'visibility' => 'public',
        ],
        'dtsxposts' => [
            'driver' => 'local',
            'root' => public_path('posts/dtsx'),
            // 'url' => 'posts/' . 
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
        ],

    ],

];
