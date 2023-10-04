<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AdminController;

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

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(AdminController::class)->group(function() {
        Route::get('tramites', 'tramites')->name('tramites');
        Route::get('tramites/{alumno}', 'verTramite')->name('showTramite');  
        Route::get('tramites/{alumno}/editar-datos-personales', 'editDatosPersonales')->name('edit-datos-personales');
        Route::get('tramites/{alumno}/editar-datos-escolares', 'editDatosEscolares')->name('edit-datos-escolares');   
        Route::patch('tramites/{alumno}/editar-datos-escolares', 'updateDatosEscolares')->name('update-datos-escolares');           
        Route::get('tramites/{alumno}/editar-datos-laborales', 'editDatosLaborales')->name('edit-datos-laborales');
    });
});

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(AlumnoController::class)->group(function() {        
        Route::get('alumno/{alumno}', 'show')->name('show-datos');    
        Route::get('alumno/edit/{alumno}', 'edit')->name('edit-datos'); 
        Route::put('alumno/edit/{alumno}', 'update')->name('update-datos'); 
        
        //Opciones de Titulacion
        Route::get('/alumno/opciones_titulacion/{id}', 'getSubcategorias');
    });
});

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(PageController::class)->group(function() {
        Route::get('inicio/', 'dashboardOverview1')->name('dashboard-overview-1');
        Route::get('usuarios', 'usuarios')->name('usuarios');
        Route::get('usuarios/create', 'usuarios_form')->name('usuarios-form');       
        Route::get('maestros', 'maestros')->name('maestros');

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
