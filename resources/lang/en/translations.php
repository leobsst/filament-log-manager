<?php

return [
    'navigation' => [
        'group' => 'System',
        'label' => 'Logs',
    ],

    'page' => [
        'title' => 'Logs',

        'form' => [
            'placeholder' => 'Select or search a log file...',
        ],
    ],

    'file_is_too_large' => 'The file is too large!',

    'actions' => [
        'delete' => [
            'label' => 'Delete',

            'flash' => [
                'success' => 'File successfully deleted',
            ],

            'modal' => [
                'heading' => 'Delete log file?',
                'description' => 'Are you sure you want to delete this log file?',

                'actions' => [
                    'confirm' => 'Delete',
                ],
            ],
        ],

        'jumpToStart' => [
            'label' => 'Jump to Start',
        ],

        'jumpToEnd' => [
            'label' => 'Jump to End',
        ],

        'refresh' => [
            'label' => 'Refresh',
        ],

        'download' => [
            'label' => 'Download',
        ],
    ],
];
