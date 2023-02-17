<?php

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

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lista', 'HomeController@lista')->name('lista');
Route::get('sair', 'Auth\LoginController@logout')->name('sair');


Route::resource('avisos', AvisosController::class)->middleware('auth');
Route::get('/avisos/{aviso}/download', 'AvisosController@download_arquivo')->name('avisos.download')->middleware('auth');
Route::get('/avisos/{aviso}/delete', 'AvisosController@delete')->name('avisos.delete')->middleware('auth');

Route::resource('acessos', AcessoController::class)->middleware('auth');

//liberação de visitantes
Route::resource('liberacao', LiberarController::class)->middleware('auth');
Route::post('/liberacao/anterior', 'LiberarController@anterior')->name('liberacao.anterior')->middleware('auth');
Route::post('/liberacao/novo', 'LiberarController@novo')->name('liberacao.novo')->middleware('auth');
Route::post('/liberacao/transporte', 'LiberarController@transporte')->name('liberacao.transporte')->middleware('auth');
Route::post('/liberacao/entregador', 'LiberarController@entregador')->name('liberacao.entregador')->middleware('auth');
Route::post('/liberacao/convidado', 'LiberarController@convidado')->name('liberacao.convidado')->middleware('auth');
Route::get('/liberacao_completa', 'LiberarController@completas')->name('liberacao.completa')->middleware('auth');
Route::get('/notificar_entrada/{onesignal}/{id}', 'LiberarController@notificar_entrada')->name('notificar_entrada')->middleware('auth');
Route::get('/notificar_saida/{onesignal}/{id}', 'LiberarController@notificar_saida')->name('notificar_saida')->middleware('auth');
Route::get('/invalidar_entrada/{onesignal}/{id}', 'LiberarController@invalidar_entrada')->name('invalidar_entrada')->middleware('auth');

Route::resource('ocorrencias', OcorrenciasController::class)->middleware('auth');
Route::get('/ocorrencias/{ocorrencia}/delete', 'OcorrenciasController@delete')->name('ocorrencias.delete')->middleware('auth');

Route::resource('lista_ingresso', ListaController::class)->middleware('auth');
Route::get('/lista_ingresso_lista', 'ListaController@lista')->name('lista_ingresso.lista')->middleware('auth');
Route::get('/lista_ingresso/{lista}/download', 'ListaController@download_lista')->name('listas.download')->middleware('auth');
Route::get('/lista_ingresso_modelo', 'ListaController@download_modelo')->name('listas.modelo')->middleware('auth');

Route::resource('locais', LocaisController::class)->middleware('auth');
Route::get('/locais/{local}/delete', 'LocaisController@delete')->name('locais.delete')->middleware('auth');

Route::resource('usuarios', UsuariosController::class)->middleware('auth');
Route::get('/usuarios/{usuario}/delete', 'UsuariosController@delete')->name('usuarios.delete')->middleware('auth');
Route::get('/usuarios/{usuario}/desab', 'UsuariosController@desabilitar')->name('usuarios.desab')->middleware('auth');
Route::get('/usuarios/{usuario}/hab', 'UsuariosController@habilitar')->name('usuarios.hab')->middleware('auth');

Route::get('/qrcode/{usuario}/qrcode', 'QrCodeController@qr_organico')->name('qrcode_organico')->middleware('auth');