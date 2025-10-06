<?php

return [
    'navigation' => [
        'group' => 'Sistema',
        'label' => 'Registros',
    ],

    'page' => [
        'title' => 'Registros',

        'form' => [
            'placeholder' => 'Seleccione o busque un archivo de registro…',
        ],
    ],

    'file_is_too_large' => 'El archivo es demasiado grande!',

    'actions' => [
        'delete' => [
            'label' => 'Borrar',

            'flash' => [
                'success' => 'Archivo eliminado correctamente',
            ],

            'modal' => [
                'heading' => '¿Borrar los registros?',
                'description' => '¿De verdad desea borrar el archivo de registros?',

                'actions' => [
                    'confirm' => 'Borrar',
                ],
            ],
        ],

        'jumpToStart' => [
            'label' => 'Ir al inicio',
        ],

        'jumpToEnd' => [
            'label' => 'Ir al final',
        ],

        'refresh' => [
            'label' => 'Actualizar',
        ],

        'download' => [
            'label' => 'Descargar',
        ],
    ],
];
