<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Website\HomeController;

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

// Route::get('/aaa', function () {
//     return view('welcome');
// })->name('index');



//Route::group(array('namespace' => 'Admin', 'prefix' => 'admin','middleware' => 'auth'), function() {
	Route::group(array('prefix' => 'admin','middleware' => 'admin'), function() {
    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('admin.dashboard'); 

     
    Route::any('category', [AdminController::class, 'index']); 
    Route::any('add-category', [AdminController::class, 'addCategory']); 
    Route::any('store-category', [AdminController::class, 'storeCategory']); 
    Route::any('delete-category/{id}', [AdminController::class, 'deleteCategory']); 
    Route::any('edit-category/{id}', [AdminController::class, 'editCategory']); 
    Route::any('update-category/{id}', [AdminController::class, 'updateCategory']);
    

    Route::resource('country', CountryController::class);
    Route::any('deleteCount/{id}', [CountryController::class, 'deleteCount']);


    Route::resource('language', LanguageController::class);
    Route::any('deleteLang/{id}', [LanguageController::class, 'deleteLang']);
    Route::any('header/{id}/{val}', [PagesController::class, 'header'])->name('header');
    Route::any('footer/{id}/{val}', [PagesController::class, 'footer'])->name('footer');
    

    // For pages
    Route::resource('page', PagesController::class);
    Route::any('deletePage/{id}', [PagesController::class, 'deletePage']);

    Route::any('/settings', [PagesController::class, 'settings'])->name('admin.setting');
    Route::any('/setting-update', [PagesController::class, 'settingUpdate'])->name('setting.update');

    Route::resource('services', ServiceTypeController::class);
    
    Route::any('delete/{id}', [ServiceTypeController::class, 'delete']);
    
    Route::resource('symptoms', SymptomController::class);
    Route::any('deleteSymptoms/{id}', [SymptomController::class, 'deleteSymptoms']);
});
Route::get('logout', [CustomAuthController::class, 'signOut'])->name('logout');
Route::get('admin/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('admin/custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');


Route::group(['prefix' => '/', 'namespace' => 'Website'], function () {
 Route::get('/', [HomeController::class, 'index'])->name('index');
 
 Route::get('/{country}/{category}/{pageslug}', [HomeController::class, 'pageLng']);
 Route::get('/{country}/{pageslug}', [HomeController::class, 'pageLng2']);
});
