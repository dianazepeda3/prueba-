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
                        'route_name' => 'inicio',
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
                'icon' => 'users',                
                'title' => 'Maestros',
                'sub_menu' => [
                    'lista-maestros' => [
                        'icon' => 'list',
                        'route_name' => 'maestros',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Ver Maestros'
                    ],
                    'maestros-form' => [
                        'icon' => 'user-plus',
                        'route_name' => 'maestros-form',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Agregar Maestro'
                    ]
                ]
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
        ];
    }

    public static function menu_admin()
    {
        return [
            'MENU PRINCIPAL',
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboard-overview-1' => [
                        'icon' => '',
                        'route_name' => 'inicio',
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
                'icon' => 'users',                
                'title' => 'Maestros',
                'sub_menu' => [
                    'lista-maestros' => [
                        'icon' => 'list',
                        'route_name' => 'maestros',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Ver Maestros'
                    ],
                    'maestros-form' => [
                        'icon' => 'user-plus',
                        'route_name' => 'maestros-form',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Agregar Maestro'
                    ]
                ]
            ], 
            'firma' => [
                'icon' => 'edit',
                'route_name' => 'firma',
                'params' => [
                    // Additional
                ],
                'title' => 'Firma Digital'
            ],        
        ];
    }

    public static function menu_coordi()
    {
        return [
            'MENU PRINCIPAL',
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboard-overview-1' => [
                        'icon' => '',
                        'route_name' => 'inicio',
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
            'maestros' => [
                'icon' => 'users',                
                'title' => 'Maestros',
                'sub_menu' => [
                    'lista-maestros' => [
                        'icon' => 'list',
                        'route_name' => 'maestros',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Ver Maestros'
                    ],
                    'maestros-form' => [
                        'icon' => 'user-plus',
                        'route_name' => 'maestros-form',
                        'params' => [
                            // Additional parameters
                        ],
                        'title' => 'Agregar Maestro'
                    ]
                ]
            ], 
            'firma' => [
                'icon' => 'edit',
                'route_name' => 'firma',
                'params' => [
                    // Additional
                ],
                'title' => 'Firma Digital'
            ],        
        ];
    }

    public static function menu_biblio_ce()
    {
        return [
            'MENU PRINCIPAL',
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboard-overview-1' => [
                        'icon' => '',
                        'route_name' => 'inicio',
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
        ];
    }

    public static function menu_alumno()
    {    
        return [
            'MENU PRINCIPAL',
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Inicio',
                'route_name' => 'inicio_alumno',
                'params' => [
                    // Additional parameters
                ],                
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
        ];
    }

    public static function menu2()
    {
        $alumno = "";
        $user = Auth::user();
        if($user)
            $alumno = $user->alumno;        

        return [
            'MANUAL DE USUARIO',
            'inicio' => [
                'icon' => 'home',
                'title' => 'Inicio',
                'route_name' => 'manual_usuario',
                'params' => [
                    // Additional parameters
                ],
            ],
            'sesion' => [
                'icon' => 'log-in',
                'route_name' => 'manual_usuario_login',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Inicio de Sesión'
            ],
            'opcion-titulacion' => [
                'icon' => 'award',
                'route_name' => 'manual_usuario_modalidad',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Seleccionar modalidad'
            ],
            'editar-info' => [
                'icon' => 'edit',
                'route_name' => 'manual_usuario_editar_info',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Editar información'
            ],
            'documentacion' => [
                'icon' => 'file-text',
                'route_name' => 'manual_usuario_subir_documentacion',
                'params' => [
                    // Additional parameters
                ],
                'title' => 'Documentos'
            ],                                          
        ];
    }
}
