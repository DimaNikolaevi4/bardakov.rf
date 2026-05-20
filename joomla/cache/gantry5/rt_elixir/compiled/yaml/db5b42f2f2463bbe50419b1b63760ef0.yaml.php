<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/home/m/mitiba/bardakov.rf/public_html/templates/rt_elixir/gantry/theme.yaml',
    'modified' => 1666521226,
    'data' => [
        'details' => [
            'name' => 'Elixir',
            'version' => '1.0.3',
            'icon' => 'paper-plane',
            'date' => 'April 27, 2020',
            'author' => [
                'name' => 'RocketTheme, LLC',
                'email' => 'support@rockettheme.com',
                'link' => 'http://www.rockettheme.com'
            ],
            'documentation' => [
                'link' => 'http://docs.gantry.org/gantry5'
            ],
            'support' => [
                'link' => 'https://gitter.im/gantry/gantry5'
            ],
            'updates' => [
                'link' => 'http://updates.rockettheme.com/themes/elixir.yaml'
            ],
            'news' => [
                'link' => 'http://news.rockettheme.com/prime/themes.yaml'
            ],
            'copyright' => '(C) 2007 - 2020 RocketTheme, LLC. All rights reserved.',
            'license' => 'GPLv2',
            'description' => 'Elixir Theme',
            'images' => [
                'thumbnail' => 'admin/images/preset1.png',
                'preview' => 'admin/images/preset1.png'
            ]
        ],
        'configuration' => [
            'gantry' => [
                'platform' => 'joomla',
                'engine' => 'nucleus'
            ],
            'theme' => [
                'parent' => 'rt_elixir',
                'base' => 'gantry-theme://common',
                'file' => 'gantry-theme://include/theme.php',
                'class' => '\\Gantry\\Framework\\Theme'
            ],
            'fonts' => [
                'feather' => [
                    400 => 'gantry-theme://fonts/feather/feather'
                ],
                'averia' => [
                    300 => 'gantry-theme://fonts/averia/averia-libre-v8-latin-300',
                    '300italic' => 'gantry-theme://fonts/averia/averia-libre-v8-latin-300italic',
                    400 => 'gantry-theme://fonts/averia/averia-libre-v8-latin-regular',
                    '400italic' => 'gantry-theme://fonts/averia/averia-libre-v8-latin-italic',
                    700 => 'gantry-theme://fonts/averia/averia-libre-v8-latin-700',
                    '700italic' => 'gantry-theme://fonts/averia/averia-libre-v8-latin-700italic'
                ]
            ],
            'css' => [
                'compiler' => '\\Gantry\\Component\\Stylesheet\\ScssCompiler',
                'target' => 'gantry-theme://css-compiled',
                'paths' => [
                    0 => 'gantry-theme://scss',
                    1 => 'gantry-engine://scss'
                ],
                'files' => [
                    0 => 'elixir',
                    1 => 'elixir-joomla',
                    2 => 'custom'
                ],
                'persistent' => [
                    0 => 'elixir'
                ],
                'overrides' => [
                    0 => 'elixir-joomla',
                    1 => 'custom'
                ]
            ],
            'dependencies' => [
                'gantry' => '>=5.4.30'
            ],
            'section-variations' => [
                'Padding Variations' => [
                    'section-vertical-paddings' => 'Section Vertical Paddings',
                    'section-horizontal-paddings' => 'Section Horizontal Paddings',
                    'section-vertical-paddings-large' => 'Large Vertical Paddings',
                    'section-horizontal-paddings-large' => 'Large Horizontal Paddings',
                    'section-vertical-paddings-small' => 'Small Vertical Paddings',
                    'section-horizontal-paddings-small' => 'Small Horizontal Paddings',
                    'largemarginall' => 'Large Margin All',
                    'largepaddingall' => 'Large Padding All',
                    'largemargintop' => 'Large Margin Top',
                    'largepaddingtop' => 'Large Padding Top',
                    'largemarginbottom' => 'Large Margin Bottom',
                    'largepaddingbottom' => 'Large Padding Bottom',
                    'largemarginleft' => 'Large Margin Left',
                    'largepaddingleft' => 'Large Padding Left',
                    'largemarginright' => 'Large Margin Right',
                    'largepaddingright' => 'Large Padding Right',
                    'medmarginall' => 'Medium Margin All',
                    'medpaddingall' => 'Medium Padding All',
                    'medmargintop' => 'Medium Margin Top',
                    'medpaddingtop' => 'Medium Padding Top',
                    'medmarginbottom' => 'Medium Margin Bottom',
                    'medpaddingbottom' => 'Medium Padding Bottom',
                    'medmarginleft' => 'Medium Margin Left',
                    'medpaddingleft' => 'Medium Padding Left',
                    'medmarginright' => 'Medium Margin Right',
                    'medpaddingright' => 'Medium Padding Right',
                    'smallmarginall' => 'Small Margin All',
                    'smallpaddingall' => 'Small Padding All',
                    'smallmargintop' => 'Small Margin Top',
                    'smallpaddingtop' => 'Small Padding Top',
                    'smallmarginbottom' => 'Small Margin Bottom',
                    'smallpaddingbottom' => 'Small Padding Bottom',
                    'smallmarginleft' => 'Small Margin Left',
                    'smallpaddingleft' => 'Small Padding Left',
                    'smallmarginright' => 'Small Margin Right',
                    'smallpaddingright' => 'Small Padding Right'
                ],
                'Remove Padding / Margin' => [
                    'nomarginall' => 'No Margin All',
                    'nopaddingall' => 'No Padding All',
                    'nomargintop' => 'No Margin Top',
                    'nopaddingtop' => 'No Padding Top',
                    'nomarginbottom' => 'No Margin Bottom',
                    'nopaddingbottom' => 'No Padding Bottom',
                    'nomarginleft' => 'No Margin Left',
                    'nopaddingleft' => 'No Padding Left',
                    'nomarginright' => 'No Margin Right',
                    'nopaddingright' => 'No Padding Right'
                ]
            ],
            'block-variations' => [
                'Title Variations' => [
                    'title1' => 'Title 1',
                    'title2' => 'Title 2',
                    'title3' => 'Title 3',
                    'title4' => 'Title 4',
                    'title5' => 'Title 5',
                    'title6' => 'Title 6',
                    'title-grey' => 'Title Grey',
                    'title-pink' => 'Title Pink',
                    'title-red' => 'Title Red',
                    'title-purple' => 'Title Purple',
                    'title-orange' => 'Title Orange',
                    'title-blue' => 'Title Blue',
                    'title-underline' => 'Title Underline',
                    'title-rounded' => 'Title Rounded'
                ],
                'Box Variations' => [
                    'box1' => 'Box 1',
                    'box2' => 'Box 2',
                    'box3' => 'Box 3',
                    'box4' => 'Box 4',
                    'box5' => 'Box 5',
                    'box6' => 'Box 6',
                    'box-white' => 'Box White',
                    'box-grey' => 'Box Grey',
                    'box-pink' => 'Box Pink',
                    'box-red' => 'Box Red',
                    'box-purple' => 'Box Purple',
                    'box-orange' => 'Box Orange',
                    'box-blue' => 'Box Blue'
                ],
                'Effects' => [
                    'spaced' => 'Spaced',
                    'bordered' => 'Bordered',
                    'shadow' => 'Shadow 1',
                    'shadow2' => 'Shadow 2',
                    'rounded' => 'Rounded',
                    'square' => 'Square'
                ],
                'Utility' => [
                    'equal-height' => 'Equal Height',
                    'g-outer-box' => 'Outer Box',
                    'disabled' => 'Disabled',
                    'align-right' => 'Align Right',
                    'align-left' => 'Align Left',
                    'title-center' => 'Centered Title',
                    'center' => 'Center',
                    'largemarginall' => 'Large Margin All',
                    'largepaddingall' => 'Large Padding All',
                    'largemargintop' => 'Large Margin Top',
                    'largepaddingtop' => 'Large Padding Top',
                    'largemarginbottom' => 'Large Margin Bottom',
                    'largepaddingbottom' => 'Large Padding Bottom',
                    'largemarginleft' => 'Large Margin Left',
                    'largepaddingleft' => 'Large Padding Left',
                    'largemarginright' => 'Large Margin Right',
                    'largepaddingright' => 'Large Padding Right',
                    'medmarginall' => 'Medium Margin All',
                    'medpaddingall' => 'Medium Padding All',
                    'medmargintop' => 'Medium Margin Top',
                    'medpaddingtop' => 'Medium Padding Top',
                    'medmarginbottom' => 'Medium Margin Bottom',
                    'medpaddingbottom' => 'Medium Padding Bottom',
                    'medmarginleft' => 'Medium Margin Left',
                    'medpaddingleft' => 'Medium Padding Left',
                    'medmarginright' => 'Medium Margin Right',
                    'medpaddingright' => 'Medium Padding Right',
                    'smallmarginall' => 'Small Margin All',
                    'smallpaddingall' => 'Small Padding All',
                    'smallmargintop' => 'Small Margin Top',
                    'smallpaddingtop' => 'Small Padding Top',
                    'smallmarginbottom' => 'Small Margin Bottom',
                    'smallpaddingbottom' => 'Small Padding Bottom',
                    'smallmarginleft' => 'Small Margin Left',
                    'smallpaddingleft' => 'Small Padding Left',
                    'smallmarginright' => 'Small Margin Right',
                    'smallpaddingright' => 'Small Padding Right'
                ],
                'Remove Padding / Margin' => [
                    'nomarginall' => 'No Margin All',
                    'nopaddingall' => 'No Padding All',
                    'nomargintop' => 'No Margin Top',
                    'nopaddingtop' => 'No Padding Top',
                    'nomarginbottom' => 'No Margin Bottom',
                    'nopaddingbottom' => 'No Padding Bottom',
                    'nomarginleft' => 'No Margin Left',
                    'nopaddingleft' => 'No Padding Left',
                    'nomarginright' => 'No Margin Right',
                    'nopaddingright' => 'No Padding Right'
                ]
            ]
        ],
        'admin' => [
            'styles' => [
                'core' => [
                    0 => 'base',
                    1 => 'accent',
                    2 => 'font',
                    3 => 'button'
                ],
                'section' => [
                    0 => 'sidebar',
                    1 => 'top',
                    2 => 'navigation',
                    3 => 'header',
                    4 => 'above',
                    5 => 'main',
                    6 => 'showcase',
                    7 => 'slideshow',
                    8 => 'utility',
                    9 => 'feature',
                    10 => 'expanded',
                    11 => 'extension',
                    12 => 'bottom',
                    13 => 'footer',
                    14 => 'copyright',
                    15 => 'offcanvas'
                ],
                'configuration' => [
                    0 => 'breakpoints'
                ]
            ]
        ]
    ]
];
