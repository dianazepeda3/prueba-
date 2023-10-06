<?php

namespace App\Main;
use Illuminate\Support\Facades\Auth;

class Menu
{
    /**
     * List of menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        $alumno = "";
        $user = Auth::user();
        if($user)
            $alumno = $user->alumno;        

        return [
            'MENU PRINCIPAL',
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboard-overview-1' => [
                        'icon' => '',
                        'route_name' => 'dashboard-overview-1',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Overview 1'
                    ],
                    'dashboard-overview-2' => [
                        'icon' => '',
                        'route_name' => 'dashboard-overview-2',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Overview 2'
                    ]
                ]
            ],
            'tramites' => [
                'icon' => 'award',
                'route_name' => 'tramites',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Tramites'
            ],
            'usuarios' => [
                'icon' => 'users',                
                'title' => 'Usuarios',
                'sub_menu' => [
                    'lista-usuarios' => [
                        'icon' => 'list',
                        'route_name' => 'usuarios',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Ver Usuarios'
                    ],
                    'usuarios-form' => [
                        'icon' => 'user-plus',
                        'route_name' => 'usuarios-form',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Agregar Usuario'
                    ]
                ]
            ],            
            'maestros' => [
                'icon' => 'user',
                'route_name' => 'maestros',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Maestros'
            ],
            'firma' => [
                'icon' => 'edit',
                'route_name' => 'firma',
                'params' => [
                    // Additional
                ],
                'title' => 'Firma Digital'
            ],
            'alumno' => [
                'icon' => 'user',
                'route_name' => 'show-datos',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Mis Datos'
            ],
            'documentos' => [
                'icon' => 'file-text',
                'route_name' => 'show-documentos',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Mis Documentos'
            ],
            'calendar' => [
                'icon' => 'calendar',
                'route_name' => 'calendar',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Calendar'
            ],
            'chat' => [
                'icon' => 'message-square',
                'route_name' => 'chat',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Chat'
            ],
            'email' => [
                'icon' => 'inbox',
                'title' => 'Email',
                'sub_menu' => [
                    'inbox' => [
                        'icon' => '',
                        'route_name' => 'inbox',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Inbox'
                    ],
                    'email-detail' => [
                        'icon' => '',
                        'route_name' => 'email-detail',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Email Detail'
                    ],
                    'compose' => [
                        'icon' => '',
                        'route_name' => 'compose',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Compose'
                    ]
                ]
            ],
            'ecommerce' => [
                'icon' => 'credit-card',
                'title' => 'E-commerce',
                'sub_menu' => [
                    'products' => [
                        'icon' => '',
                        'route_name' => 'products',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Products'
                    ],
                    'product-detail' => [
                        'icon' => '',
                        'route_name' => 'product-detail',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Product Detail'
                    ],
                    'orders' => [
                        'icon' => '',
                        'route_name' => 'orders',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Orders'
                    ],
                    'order-detail' => [
                        'icon' => '',
                        'route_name' => 'order-detail',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Order Detail'
                    ],
                ]
            ],
            'file-manager' => [
                'icon' => 'hard-drive',
                'route_name' => 'file-manager',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'File Manager'
            ],
            'PAGES',
            'profile' => [
                'icon' => 'trello',
                'route_name' => 'profile',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Profile'
            ],
            'pricing' => [
                'icon' => 'shopping-bag',
                'route_name' => 'pricing',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Pricing'
            ],
            'invoice' => [
                'icon' => 'files',
                'route_name' => 'invoice',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Invoice'
            ],
            'faq' => [
                'icon' => 'file-check-2',
                'route_name' => 'faq',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'FAQ'
            ],
            'timeline' => [
                'icon' => 'clipboard-check',
                'route_name' => 'timeline',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Timeline'
            ],
            'crud' => [
                'icon' => 'edit',
                'title' => 'Crud',
                'sub_menu' => [
                    'crud-data-list' => [
                        'icon' => '',
                        'route_name' => 'crud-data-list',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Data List'
                    ],
                    'crud-form' => [
                        'icon' => '',
                        'route_name' => 'crud-form',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Form'
                    ]
                ]
            ],
            'wizards' => [
                'icon' => 'file-text',
                'title' => 'Wizards',
                'sub_menu' => [
                    'wizard-layout-1' => [
                        'icon' => '',
                        'route_name' => 'wizard-layout-1',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Layout 1'
                    ],
                    'wizard-layout-2' => [
                        'icon' => '',
                        'route_name' => 'wizard-layout-2',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Layout 2'
                    ],
                    'wizard-layout-3' => [
                        'icon' => '',
                        'route_name' => 'wizard-layout-3',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Layout 3'
                    ]
                ]
            ],
            'login' => [
                'icon' => 'unlock',
                'route_name' => 'login',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Login'
            ],
            'register' => [
                'icon' => 'inbox',
                'route_name' => 'register',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Register'
            ],
            'error-page' => [
                'icon' => 'hard-drive',
                'route_name' => 'error-page',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Error Page'
            ],
            'USER INTERFACE',
            'components' => [
                'icon' => 'inbox',
                'title' => 'Components',
                'sub_menu' => [
                    'table' => [
                        'icon' => '',
                        'title' => 'Table',
                        'sub_menu' => [
                            'regular-table' => [
                                'icon' => '',
                                'route_name' => 'regular-table',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Regular Table'
                            ],
                            'tabulator' => [
                                'icon' => '',
                                'route_name' => 'tabulator',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Tabulator'
                            ]
                        ]
                    ],
                    'overlay' => [
                        'icon' => '',
                        'title' => 'Overlay',
                        'sub_menu' => [
                            'modal' => [
                                'icon' => '',
                                'route_name' => 'modal',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Modal'
                            ],
                            'slide-over' => [
                                'icon' => '',
                                'route_name' => 'slide-over',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Slide Over'
                            ],
                            'notification' => [
                                'icon' => '',
                                'route_name' => 'notification',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Notification'
                            ],
                        ]
                    ],
                    'tab' => [
                        'icon' => '',
                        'route_name' => 'tab',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Tab'
                    ],
                    'accordion' => [
                        'icon' => '',
                        'route_name' => 'accordion',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Accordion'
                    ],
                    'button' => [
                        'icon' => '',
                        'route_name' => 'button',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Button'
                    ],
                    'alert' => [
                        'icon' => '',
                        'route_name' => 'alert',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Alert'
                    ],
                    'progress-bar' => [
                        'icon' => '',
                        'route_name' => 'progress-bar',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Progress Bar'
                    ],
                    'tooltip' => [
                        'icon' => '',
                        'route_name' => 'tooltip',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Tooltip'
                    ],
                    'dropdown' => [
                        'icon' => '',
                        'route_name' => 'dropdown',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Dropdown'
                    ],
                    'typography' => [
                        'icon' => '',
                        'route_name' => 'typography',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Typography'
                    ],
                    'icon' => [
                        'icon' => '',
                        'route_name' => 'icon',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Icon'
                    ],
                    'loading-icon' => [
                        'icon' => '',
                        'route_name' => 'loading-icon',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Loading Icon'
                    ]
                ]
            ],
            'forms' => [
                'icon' => 'sidebar',
                'title' => 'Forms',
                'sub_menu' => [
                    'regular-form' => [
                        'icon' => '',
                        'route_name' => 'regular-form',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Regular Form'
                    ],
                    'datepicker' => [
                        'icon' => '',
                        'route_name' => 'datepicker',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Datepicker'
                    ],
                    'tom-select' => [
                        'icon' => '',
                        'route_name' => 'tom-select',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Tom Select'
                    ],
                    'file-upload' => [
                        'icon' => '',
                        'route_name' => 'file-upload',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'File Upload'
                    ],
                    'wysiwyg-editor' => [
                        'icon' => '',
                        'title' => 'Wysiwyg Editor',
                        'sub_menu' => [
                            'wysiwyg-editor-classic' => [
                                'icon' => '',
                                'route_name' => 'wysiwyg-editor-classic',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Classic'
                            ],
                            'wysiwyg-editor-inline' => [
                                'icon' => '',
                                'route_name' => 'wysiwyg-editor-inline',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Inline'
                            ],
                            'wysiwyg-editor-balloon' => [
                                'icon' => '',
                                'route_name' => 'wysiwyg-editor-balloon',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Balloon'
                            ],
                            'wysiwyg-editor-balloon-block' => [
                                'icon' => '',
                                'route_name' => 'wysiwyg-editor-balloon-block',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Balloon Block'
                            ],
                            'wysiwyg-editor-document' => [
                                'icon' => '',
                                'route_name' => 'wysiwyg-editor-document',
                                'params' => [
                                    // Additional parameters
                                ],
                                'title' => 'Document'
                            ],
                        ]
                    ],
                    'validation' => [
                        'icon' => '',
                        'route_name' => 'validation',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Validation'
                    ]
                ]
            ],
            'widgets' => [
                'icon' => 'hard-drive',
                'title' => 'Widgets',
                'sub_menu' => [
                    'chart' => [
                        'icon' => '',
                        'route_name' => 'chart',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Chart'
                    ],
                    'slider' => [
                        'icon' => '',
                        'route_name' => 'slider',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Slider'
                    ],
                    'image-zoom' => [
                        'icon' => '',
                        'route_name' => 'image-zoom',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Image Zoom'
                    ]
                ]
            ]
        ];
    }
}
