<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/blueprints/styles/font.yaml',
    'modified' => 1666521226,
    'data' => [
        'name' => 'Font Families',
        'description' => 'Font families for the theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'family-title' => [
                    'type' => 'input.fonts',
                    'label' => 'Title Font',
                    'default' => 'averia, Helvetica, Tahoma, Geneva, Arial, sans-serif'
                ],
                'family-default' => [
                    'type' => 'input.fonts',
                    'label' => 'Body Font',
                    'default' => 'averia, Helvetica, Tahoma, Geneva, Arial, sans-serif'
                ]
            ]
        ]
    ]
];
