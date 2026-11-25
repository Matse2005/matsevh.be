<?php

return [

    // Filament pages, the public login page included, accept temporary uploads
    // from anonymous visitors, so they go to a private disk and only file types
    // the admin forms actually use are allowed.
    'temporary_file_upload' => [
        'disk' => 'local',
        'rules' => ['required', 'file', 'max:12288', 'extensions:jpg,jpeg,png,gif,webp,svg,pdf,doc,docx'],
        'directory' => null,
        'middleware' => null,
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
        ],
        'max_upload_time' => 5,
        'cleanup' => true,
    ],

];
