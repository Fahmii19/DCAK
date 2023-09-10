<?php

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Artisan;
// Packages
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// require __DIR__ . '/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // Route::get('/koordinator', [MenuController::class, 'koordinator'])->middleware('can:view koordinator');
    // Route::get('/calon-pemilih', [MenuController::class, 'calonPemilih'])->middleware('can:view calon pemilih');
    // Route::get('/pemilih', [MenuController::class, 'pemilih'])->middleware('can:view pemilih');
    // Route::get('/akun-dcak', [MenuController::class, 'akunDcak'])->middleware('can:view akun dcak');
});

// Rute untuk login User
// Route::get('login-dcak', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('login-process', [AuthController::class, 'login'])->name('loginProcess');
Route::post('logout-dcak', [AuthController::class, 'logout'])->name('logout-dcak');

// Inputan Calon Pemilih
Route::get('form-pemilih', [HomeController::class, 'formPemilih'])->name('formPemilih');



// Login Admin
Route::get('login', [AuthController::class, 'showLoginFormAdmin'])->name('showLoginFormAdmin');
Route::post('login-process-admin', [AuthController::class, 'loginProcessAdmin'])->name('loginProcessAdmin');
Route::post('logout-admin', [AuthController::class, 'logoutAdmin'])->name('logoutAdmin');


// landing Page
Route::get('/homepage', [HomeController::class, 'landingPage'])->name('landing');

//UI Pages Routs
Route::get('/', [HomeController::class, 'uisheet'])->name('uisheet');

Route::get('/users-dcak', [UserController::class, 'getAllUsers'])->middleware('role:super-user');

Route::group(['middleware' => 'auth'], function () {
    // Permission Module
    Route::get('/role-permission', [RolePermission::class, 'index'])->name('role.permission.list');
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    // Dashboard Routes
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Authentication Routes

    // dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Calon Pemilih
    Route::get('/calon-pemilih', [HomeController::class, 'calonPemilih'])->name('calon-pemilih');
    Route::get('/table-calon-pemilih', [HomeController::class, 'tableCalonPemilih'])->name('table-calon-pemilih');
    Route::get('/input-calon-pemilih', [HomeController::class, 'inputCalonPemilih'])->name('input-calon-pemilih');
    Route::post('/form-input-calon-pemilih', [HomeController::class, 'formInputCalonPemilih'])->name('form-input-calon-pemilih');
    Route::post('/import-calon-pemilih', [HomeController::class, 'importExcelCalonPemilih'])->name('import-calon-pemilih');

    // koordinator
    Route::get('/koordinator', [HomeController::class, 'koordinator'])->name('koordinator');
    Route::get('/table-koordinator', [HomeController::class, 'tableKoordinator'])->name('table-koordinator');
    Route::get('/input-koordinator', [HomeController::class, 'inputKoordinator'])->name('input-koordinator');
    Route::post('/form-input-koordinator', [HomeController::class, 'formInputKoordinator'])->name('form-input-koordinator');

    // pemilih
    Route::get('/pemilih', [HomeController::class, 'pemilih'])->name('pemilih');
    Route::get('/table-pemilih', [HomeController::class, 'tablePemilih'])->name('table-pemilih');
    Route::get('/input-pemilih', [HomeController::class, 'inputPemilih'])->name('input-pemilih');
    Route::post('/form-input-pemilih', [HomeController::class, 'formInputPemilih'])->name('form-input-pemilih');
    Route::get('/input-pemilih-nama', [HomeController::class, 'inputPemilihNama'])->name('input-pemilih-nama');
    // Route::get('/cari-pemilih', [HomeController::class, 'cariPemilih'])->name('cari-pemilih');
    Route::get('/search/nama', [HomeController::class, 'searchNama'])->name('search.nama');
    Route::get('/get-pemilih-detail', [HomeController::class, 'getPemilihDetail'])->name('get.pemilih_detail');

    Route::post('/form-input-pencarian-pemilih', [HomeController::class, 'formInputPencarianPemilih'])->name('form-input-pencarian-pemilih');



    // kelurahan
    Route::get('/kelurahan', [HomeController::class, 'kelurahan'])->name('kelurahan');
    Route::get('/table-kelurahan', [HomeController::class, 'tableKelurahan'])->name('table-kelurahan');
    Route::get('/input-kelurahan', [HomeController::class, 'inputKelurahan'])->name('input-kelurahan');
    Route::post('/form-input-kelurahan', [HomeController::class, 'inputFormKelurahan'])->name('form-input-kelurahan');

    // kecamatan
    Route::get('/kecamatan', [HomeController::class, 'kecamatan'])->name('kecamatan');
    Route::get('/table-kecamatan', [HomeController::class, 'tableKecamatan'])->name('table-kecamatan');
    Route::get('/input-kecamatan', [HomeController::class, 'inputKecamatan'])->name('input-kecamatan');
    Route::post('/form-input-kecamatan', [HomeController::class, 'inputFormKecamatan'])->name('form-input-kecamatan');

    // akun dcak
    Route::get('/akun-dcak', [HomeController::class, 'akunDcak'])->name('akun-dcak');
    Route::get('/table-akun-dcak', [HomeController::class, 'tableAkunDcak'])->name('table-akun-dcak');
    Route::get('/input-akun-dcak', [HomeController::class, 'inputAkunDcak'])->name('input-akun-dcak');
    Route::post('/form-input-akun-dcak', [HomeController::class, 'formInputAkunDcak'])->name('form-input-akun-dcak');

    // saksi
    Route::get('/saksi', [HomeController::class, 'saksi'])->name('saksi');
    // realcount
    Route::get('/realcount', [HomeController::class, 'realcount'])->name('realcount');

    // Users Module
    Route::resource('users', UserController::class);
});

//App Details Page => 'Dashboard'], function() {
Route::group(['prefix' => 'menu-style'], function () {
    //MenuStyle Page Routs
    Route::get('horizontal', [HomeController::class, 'horizontal'])->name('menu-style.horizontal');
    Route::get('dual-horizontal', [HomeController::class, 'dualhorizontal'])->name('menu-style.dualhorizontal');
    Route::get('dual-compact', [HomeController::class, 'dualcompact'])->name('menu-style.dualcompact');
    Route::get('boxed', [HomeController::class, 'boxed'])->name('menu-style.boxed');
    Route::get('boxed-fancy', [HomeController::class, 'boxedfancy'])->name('menu-style.boxedfancy');
});

//App Details Page => 'special-pages'], function() {
Route::group(['prefix' => 'special-pages'], function () {
    //Example Page Routs
    Route::get('billing', [HomeController::class, 'billing'])->name('special-pages.billing');
    Route::get('calender', [HomeController::class, 'calender'])->name('special-pages.calender');
    Route::get('kanban', [HomeController::class, 'kanban'])->name('special-pages.kanban');
    Route::get('pricing', [HomeController::class, 'pricing'])->name('special-pages.pricing');
    Route::get('rtl-support', [HomeController::class, 'rtlsupport'])->name('special-pages.rtlsupport');
    Route::get('timeline', [HomeController::class, 'timeline'])->name('special-pages.timeline');
});

//Widget Routs
Route::group(['prefix' => 'widget'], function () {
    Route::get('widget-basic', [HomeController::class, 'widgetbasic'])->name('widget.widgetbasic');
    Route::get('widget-chart', [HomeController::class, 'widgetchart'])->name('widget.widgetchart');
    Route::get('widget-card', [HomeController::class, 'widgetcard'])->name('widget.widgetcard');
});

//Maps Routs
Route::group(['prefix' => 'maps'], function () {
    Route::get('google', [HomeController::class, 'google'])->name('maps.google');
    Route::get('vector', [HomeController::class, 'vector'])->name('maps.vector');
});

//Auth pages Routs
Route::group(['prefix' => 'auth'], function () {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
});

//Error Page Route
Route::group(['prefix' => 'errors'], function () {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
});


//Forms Pages Routs
Route::group(['prefix' => 'forms'], function () {
    Route::get('element', [HomeController::class, 'element'])->name('forms.element');
    Route::get('wizard', [HomeController::class, 'wizard'])->name('forms.wizard');
    Route::get('validation', [HomeController::class, 'validation'])->name('forms.validation');
});


//Table Page Routs
Route::group(['prefix' => 'table'], function () {
    Route::get('bootstraptable', [HomeController::class, 'bootstraptable'])->name('table.bootstraptable');
    Route::get('datatable', [HomeController::class, 'datatable'])->name('table.datatable');
});

//Icons Page Routs
Route::group(['prefix' => 'icons'], function () {
    Route::get('solid', [HomeController::class, 'solid'])->name('icons.solid');
    Route::get('outline', [HomeController::class, 'outline'])->name('icons.outline');
    Route::get('dualtone', [HomeController::class, 'dualtone'])->name('icons.dualtone');
    Route::get('colored', [HomeController::class, 'colored'])->name('icons.colored');
});
//Extra Page Routs
Route::get('privacy-policy', [HomeController::class, 'privacypolicy'])->name('pages.privacy-policy');
Route::get('terms-of-use', [HomeController::class, 'termsofuse'])->name('pages.term-of-use');
