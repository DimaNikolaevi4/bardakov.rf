<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => '/home/m/mitiba/bardakov.rf/public_html/templates/jl_business/gantry/theme.yaml',
    'modified' => 1666520420,
    'data' => [
        'details' => [
            'name' => 'Business',
            'version' => '2.0.3',
            'icon' => 'paper-plane',
            'date' => 'October 11, 2022',
            'author' => [
                'name' => 'JoomLead',
                'email' => 'support@joomlead.com',
                'link' => 'https://www.joomlead.com'
            ],
            'documentation' => [
                'link' => 'http://docs.gantry.org/gantry5'
            ],
            'support' => [
                'link' => 'https://joomlead.com/'
            ],
            'updates' => [
                'link' => NULL
            ],
            'copyright' => '(C) 2022 JoomLead. All rights reserved.',
            'license' => 'GPLv2',
            'description' => 'Business Free',
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
                'parent' => 'jl_business',
                'base' => 'gantry-theme://common',
                'file' => 'gantry-theme://includes/theme.php',
                'class' => '\\Gantry\\Framework\\Theme'
            ],
            'fonts' => [
                'Inter' => [
                    300 => 'gantry-theme://fonts/inter/inter-light',
                    400 => 'gantry-theme://fonts/inter/inter-regular',
                    500 => 'gantry-theme://fonts/inter/inter-medium',
                    600 => 'gantry-theme://fonts/inter/inter-semibold',
                    700 => 'gantry-theme://fonts/inter/inter-bold'
                ]
            ],
            'css' => [
                'compiler' => '\\Gantry\\Component\\Stylesheet\\ScssCompiler',
                'options' => [
                    'compatibility' => '5.5',
                    'deprecations' => true
                ],
                'paths' => [
                    0 => 'gantry-theme://scss',
                    1 => 'gantry-engine://scss'
                ],
                'files' => [
                    0 => 'business',
                    1 => 'business-joomla',
                    2 => 'custom'
                ],
                'persistent' => [
                    0 => 'business'
                ],
                'overrides' => [
                    0 => 'business-joomla',
                    1 => 'custom'
                ]
            ],
            'dependencies' => [
                'gantry' => '5.5'
            ],
            'section-variations' => [
                'Padding Variations' => [
                    'jl-section' => 'Default Vertical Paddings',
                    'jl-section-xsmall' => 'XSmall Vertical Paddings',
                    'jl-section-small' => 'Small Vertical Paddings',
                    'jl-section-large' => 'Large Vertical Paddings',
                    'jl-section-xlarge' => 'XLarge Vertical Paddings'
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
                ],
                'Inverse Color' => [
                    'jl-light' => 'Light',
                    'jl-dark' => 'Dark'
                ]
            ],
            'block-variations' => [
                'Title Variations' => [
                    'title1' => 'Title 1',
                    'title2' => 'Title 2',
                    'title-gradient' => 'Title Gradient',
                    'title-outline' => 'Title Outline'
                ],
                'Box Variations' => [
                    'box1' => 'Box 1',
                    'box2' => 'Box 2',
                    'box3' => 'Box 3',
                    'box4' => 'Box 4',
                    'box5' => 'Box 5',
                    'box6' => 'Box 6',
                    'bg-gradient-chill' => 'Gradient Chill',
                    'bg-gradient-warn' => 'Gradient Warn',
                    'bg-gradient-hot' => 'Gradient Hot',
                    'bg-gradient-cold' => 'Gradient Cold',
                    'bg-gradient-accent' => 'Gradient Accent'
                ],
                'Effects' => [
                    'shadow' => 'Shadow 1',
                    'shadow2' => 'Shadow 2',
                    'rounded' => 'Rounded',
                    'square' => 'Square'
                ],
                'Utility' => [
                    'disabled' => 'Disabled',
                    'align-right' => 'Align Right',
                    'align-left' => 'Align Left',
                    'center' => 'Center',
                    'full-width' => 'Full Width',
                    'equal-height' => 'Equal Height',
                    'title-center' => 'Centered Title'
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
                ],
                'Inverse Color' => [
                    'jl-light' => 'Light',
                    'jl-dark' => 'Dark'
                ],
                'Visibility' => [
                    'jl-visible@s' => 'Visible Small',
                    'jl-visible@m' => 'Visible Medium',
                    'jl-visible@l' => 'Visible Large',
                    'jl-visible@xl' => 'Visible X-Large',
                    'jl-hidden@s' => 'Hidden Small',
                    'jl-hidden@m' => 'Hidden Medium',
                    'jl-hidden@l' => 'Hidden Large',
                    'jl-hidden@xl' => 'Hidden X-Large'
                ]
            ]
        ],
        'admin' => [
            'styles' => [
                'core' => [
                    0 => 'base',
                    1 => 'accent',
                    2 => 'font'
                ],
                'section' => [
                    0 => 'sidebar',
                    1 => 'top',
                    2 => 'navigation',
                    3 => 'hero',
                    4 => 'slideshow',
                    5 => 'header',
                    6 => 'above',
                    7 => 'feature',
                    8 => 'showcase',
                    9 => 'utility',
                    10 => 'main',
                    11 => 'expanded',
                    12 => 'extension',
                    13 => 'bottom',
                    14 => 'below',
                    15 => 'footer',
                    16 => 'copyright',
                    17 => 'offcanvas'
                ],
                'configuration' => [
                    0 => 'breakpoints'
                ]
            ]
        ]
    ]
];
