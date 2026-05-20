<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/particles/logos.yaml',
    'modified' => 1666521226,
    'data' => [
        'name' => 'Logos',
        'description' => 'Display desired brand logos.',
        'type' => 'particle',
        'icon' => 'fa-apple',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable particle.',
                    'default' => true
                ],
                'logos' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Logos',
                    'description' => 'Add logos.',
                    'value' => 'title',
                    'ajax' => true,
                    'overridable' => false,
                    'fields' => [
                        '.image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Logo Image',
                            'description' => 'Pick desired logo.'
                        ],
                        '.title' => [
                            'type' => 'input.text',
                            'label' => 'Logo Title',
                            'description' => 'Title that will appear when hovering image or link.'
                        ],
                        '.url' => [
                            'type' => 'input.text',
                            'label' => 'Url',
                            'description' => 'Add link to logo.'
                        ],
                        '.target' => [
                            'type' => 'select.selectize',
                            'label' => 'Target',
                            'description' => 'Target browser window when item is clicked.',
                            'placeholder' => 'Select...',
                            'default' => '_self',
                            'options' => [
                                '_self' => 'Self',
                                '_blank' => 'New Window'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
