<?php

use Illuminate\Support\Facades\Route;
// use Auth;

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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('master6');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/master3', function () {
    return view('master.master3');
});

Route::get('/', function () {
    return view('master.master6');
});
Route::resource('users', 'UsersController')->middleware('rol:asociado,presidente');
Route::resource('rols', 'RolsController')->middleware('rol:presidente');
Route::resource('permisos', 'PermisosController')->middleware('rol:presidente');
Route::resource('especies', 'EspecieController')->middleware('rol:administrador');
Route::resource('variedads', 'VariedadController')->middleware('rol:administrador');
Route::resource('categorias', 'CategoriaController')->middleware('rol:administrador');
Route::resource('tamanos', 'TamanoController')->middleware('rol:administrador');
Route::resource('unidadMedidas', 'UnidadMedidaController')->middleware('rol:administrador');
Route::resource('productos', 'ProductoController')->middleware('rol:administrador');
Route::resource('ventas', 'VentaController')->middleware('rol:administrador');

Route::resource('reporteProductos', 'ReporteProductosController')->middleware('rol:presidente,administrador');
Route::resource('reporteVentas', 'ReporteVentasController')->middleware('rol:presidente,administrador');
