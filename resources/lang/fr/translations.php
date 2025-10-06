<?php

return [
    'navigation' => [
        'group' => 'Système',
        'label' => 'Logs',
    ],

    'page' => [
        'title' => 'Logs',

        'form' => [
            'placeholder' => 'Sélectionnez ou recherchez un fichier de logs',
        ],
    ],

    'file_is_too_large' => 'Fichier trop volumineux !',

    'actions' => [
        'delete' => [
            'label' => 'Effacer',

            'flash' => [
                'success' => 'Fichier supprimé avec succès',
            ],

            'modal' => [
                'heading' => 'Effacer les logs ?',
                'description' => 'Voulez-vous vraiment effacer le fichier de logs ?',

                'actions' => [
                    'confirm' => 'Effacer',
                ],
            ],
        ],

        'jumpToStart' => [
            'label' => 'Aller au début',
        ],

        'jumpToEnd' => [
            'label' => 'Aller à la fin',
        ],

        'refresh' => [
            'label' => 'Actualiser',
        ],

        'download' => [
            'label' => 'Télécharger',
        ],
    ],
];
