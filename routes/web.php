<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EstadisticaController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',function(){
    return view('login.welcome2');
})->name('inicio-visitante');
Route::get('manual-usuario',function(User $user){ return view('manual.manual',compact('user'));})->name('manual_usuario');
Route::get('manual-usuario/iniciar-sesion',function(User $user){ return view('manual.login',compact('user'));})->name('manual_usuario_login');
Route::get('manual-usuario/modalidad',function(User $user){ return view('manual.modalidad',compact('user'));})->name('manual_usuario_modalidad');
Route::get('manual-usuario/subir-documentacion',function(User $user){ return view('manual.subir-documentacion',compact('user'));})->name('manual_usuario_subir_documentacion');
Route::get('manual-usuario/editar-informacion',function(User $user){ return view('manual.edit-info',compact('user'));})->name('manual_usuario_editar_info');


Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
    Route::get('register', 'registerView')->name('register.index');
    Route::post('register', 'register')->name('register.store');
});

//Login
Route::post('login', [AlumnoController::class, 'logSiiau'])->name('log.siiau');
Route::post('login2', [AdminController::class, 'login'])->name('log.admin');

Route::middleware('is_admin')->group(function() {    
    Route::controller(AdminController::class)->group(function() {                
        //Usuarios
        Route::get('usuarios', 'usuarios')->name('usuarios');
        Route::get('usuarios/create', 'usuarios_form')->name('usuarios-form');   
        Route::get('usuarios/create/{usuario}', 'usuarios_edit')->name('usuarios-edit');  
        Route::patch('usuarios/update/{user}', 'updateUsuario')->name('usuarios_update');
        Route::post('usuarios/store', 'storeUsuarios')->name('usuarios_store');
        Route::delete('usuarios/{usuario}', 'deleteUsuario')->name('eliminar_usuario');   
        Route::post('usuarios/fitrar', 'filtrar_usuarios')->name('filtrar_usuarios');     
        
        Route::get('maestros/{id}', 'getMaestros');
        Route::post('maestros/edit-director-secretario','edit_director_secretario')->name('editar_director_secretario');        
        
        //Manual
        Route::get('manual-usuario/tramites',function(User $user){ return view('manual-admin.tramites',compact('user'));})->name('manual_usuario_tramites');
        Route::get('manual-usuario/usuarios',function(User $user){ return view('manual-admin.usuarios',compact('user'));})->name('manual_usuario_usuarios');
        Route::get('manual-usuario/maestros',function(User $user){ return view('manual-admin.maestros',compact('user'));})->name('manual_usuario_maestros');
        Route::get('manual-usuario/firma',function(User $user){ return view('manual-admin.firma',compact('user'));})->name('manual_usuario_firma');        
    });
});


Route::middleware('is_administrativo')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(AdminController::class)->group(function() {
        Route::get('tramites/documento/{documento}', 'visualizarDocumento')->name('ver-documento-admin');        

        //Tramite
        Route::get('tramites', 'tramites')->name('tramites');
        Route::get('tramites/{alumno}', 'verTramite')->name('showTramite'); 
        Route::post('tramites/fitrar', 'filtrar_tramites')->name('filtrar_tramites');   
        Route::get('tramites/{alumno}/finalizar', 'finalizar_tramite')->name('finalizar_tramite');         
        
        Route::get('tramites/documentos/revisar/{tramite}','revisarDocumento')->name('revisar-documentos');
        Route::get('tramites/documentos/validar/{tramite}','validarDocumento')->name('validar-documentos');        

        Route::get('tramites/documentos/aprobar/{documento}','aprobarDocumento')->name('aprobar-documento');
        Route::patch('tramites/documentos/desaprobar/{documento}','desaprobarDocumento')->name('desaprobar-documento');
        Route::get('tramites/documentos/eliminar/{documento}','eliminarDocumento')->name('admin-eliminar-documento');

        //Generar Documentos 
        Route::post('tramites/documentos/cartsNoAdeudo/{alumno}', 'generarformatoNoAdeudo')->name('generar_cartaNoAdeudo');
        Route::get('tramites/documentos/autorizar-cartaNoAdeudo/{alumno}', 'autorizarCartaNoAdeudo')->name('autorizar_cartaNoAdeudo');        
        Route::post('tramites/documentos/cartaNoAdeudoCE/{alumno}', 'generarformatoNoAdeudoCE')->name('generar_cartaNoAdeudo_ce');        
        Route::get('tramites/documentos/autorizar-cartaNoAdeudoCE/{alumno}', 'autorizarCartaNoAdeudoCE')->name('autorizar_cartaNoAdeudo_ce');                
    });
});

Route::middleware('is_coordi')->group(function() {
    Route::controller(AdminController::class)->group(function() {                         
        //Generar Documentos
        Route::post('tramites/documentos/generar-dictamen/{tramite}','generate_dictamen')->name('generar-dictamen');
        Route::get('tramites/documentos/generar-comprobante-academico/{tramite}','generate_comprobante_academico')->name('generar_comprobante_academico');        
        Route::get('tramites/documentos/etapa2/{tramite}','pasarEtapa2')->name('pasar_etapa2');
               
        // Tramite        
        Route::get('tramite/crear', 'createTramite')->name('crear_tramite');
        Route::post('tramites/store','setDatosInfo')->name('datos-escolares'); 
        Route::delete('tramites/{alumno}', 'eliminarTramite')->name('eliminar_tramites');          

        //Acta
        Route::get('tramites/documentos/acta-titulacion/{alumno}', 'generarDocumentoActaTitulacion')->name('descargar_acta_titulacion');
        Route::post('tramites/documentos/subir-acta-firmada/{alumno}','subirActaFirmada')->name('subir_acta_firmada');
        Route::get('tramites/documentos/protesta/{alumno}','generarDocumentoProtesta')->name('descargar_protesta');
        Route::post('tramites/documentos/subir-protesta-firmada/{alumno}','subirProtestaFirmada')->name('subir_protesta_firmada');
        Route::get('tramites/documentos/acta-circunstanciada/{alumno}','generarDocumentoActaCircunstanciada')->name('descargar_actacirunstanciada');
        
        //Datos Titulación
        Route::get('tramites/datos-titulacion/{alumno}','editDatosTitulacion')->name('editar_datos_titulacion');
        Route::patch('tramites/editar-datos-titulacion/{alumno}', 'updateDatosTitulacion')->name('update-datos-titulacion');  

        //FIRMA
        Route::get('firma','firma')->name('firma');
        Route::post('firma/guardar','uploadFirma')->name('guardar-firma');
        Route::get('firma/ver-firma/{firma}','visualizarFirma')->name('ver-firma');       

        //Maestros
        Route::get('maestros', 'maestros')->name('maestros');        
        Route::get('maestro/create', 'maestros_form')->name('maestro_form'); 
        Route::get('maestros/create/{maestro}', 'maestros_edit')->name('maestros-edit'); 
        Route::patch('maestros/update/{maestro}', 'updateMaestro')->name('maestros_update');
        Route::post('maestros/store', 'storeMaestro')->name('maestros_store');
        Route::delete('maestros/{maestro}', 'deleteMaestro')->name('eliminar_maestro');        
    });
});

Route::middleware('is_administrativo')->group(function() {
    Route::controller(EstadisticaController::class)->group(function() {
        
        //Estadisticas
        Route::get('estadisticas','index')->name('estadisticas');
    });
});

Route::middleware('is_student')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(AlumnoController::class)->group(function() {               
        Route::get('datos', 'show')->name('show-datos');    
        Route::get('datos/edit', 'edit')->name('edit-datos'); 
        Route::patch('datos/edit', 'update')->name('update-datos'); 
        Route::get('documentos', 'showDocumentos')->name('show-documentos');
        Route::get('documentos/visualizar/{documento}', 'visualizarDocumento')->name('ver-documento');
        Route::get('documentos/revisar','revisionDocumentos')->name('mandar-revision-documentos');
        Route::get('documentos/descargar/{documento}', 'descargarDocumento')->name('descargar-documento');
        Route::get('documentos/eliminar/{documento}','eliminarDocumento')->name('eliminar-documento');
        Route::post('documento','uploadDocumento')->name('upload-documento');
        Route::get('documento/descargar/formato-a','descargaFormato01')->name('descargar-formato01');
        Route::get('documento/solicitar-cna-universidad/{alumnoDocs}','solicitarCartaCE')->name('solicitar_cna_universidad');
        Route::get('documento/solicitar-cna-biblioteca/{alumnoDocs}','solicitarCarta')->name('solicitar_cna_biblioteca');        
        Route::get('documentos/visualizar-carta','visualizarCarta')->name('visualizar_carta');

        Route::post('documentos/autorizacionTesis/{alumno}','generarformatoaAutorizacionTesis')->name('autorizacionTesis');
        
        //Carta Autorización
        Route::get('documentos/carta-autorizacion/{alumno}','autorizacionTesisVista')->name('generar_carta_autorizacion');        
    });
});

Route::middleware('auth')->group(function() {
    Route::controller(AdminController::class)->group(function() {
        // Editar datos
        Route::get('tramites/editar-datos-personales/{alumno}', 'editDatosPersonales')->name('edit-datos-personales');
        Route::patch('tramites/editar-datos-personales/{alumno}', 'updateDatosPersonales')->name('update-datos-personales');           
        Route::get('tramites/editar-datos-escolares/{alumno}', 'editDatosEscolares')->name('edit-datos-escolares');   
        Route::patch('tramites/editar-datos-escolares/{alumno}', 'updateDatosEscolares')->name('update-datos-escolares');           
        Route::get('tramites/editar-datos-laborales/{alumno}', 'editDatosLaborales')->name('edit-datos-laborales');
        Route::patch('tramites/editar-datos-laborales/{alumno}', 'updateDatosLaborales')->name('update-datos-laborales'); 
           
        //Opciones de Titulacion
        Route::get('/alumno/opciones_titulacion/{id}', 'getSubcategorias');        
    });
});


Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(PageController::class)->group(function() {
        Route::get('inicio2', 'dashboardOverview1')->name('inicio');
        Route::get('inicio', 'inicioAlumno')->name('inicio_alumno');                                       

        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('email-detail-page', 'emailDetail')->name('email-detail');
        Route::get('compose-page', 'compose')->name('compose');
        Route::get('products-page', 'products')->name('products');
        Route::get('product-detail-page', 'productDetail')->name('product-detail');
        Route::get('orders-page', 'orders')->name('orders');
        Route::get('order-detail-page', 'orderDetail')->name('order-detail');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('profile-page', 'profile')->name('profile');
        Route::get('pricing-page', 'pricing')->name('pricing');
        Route::get('invoice-page', 'invoice')->name('invoice');
        Route::get('faq-page', 'faq')->name('faq');
        Route::get('timeline-page', 'timeline')->name('timeline');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('login-page', 'login')->name('login');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic-page', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline-page', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon-page', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block-page', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document-page', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });
});
