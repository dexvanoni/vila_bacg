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
$app_url = config("app.url");
if (app()->environment('prod') && !empty($app_url)) {
    URL::forceRootUrl($app_url);
    $schema = explode(':', $app_url)[0];
    URL::forceScheme($schema);
};

Route::get('/pesquisa', 'CadAlunoController@pesquisar')->name('pesquisa');

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
})->name('inicial');

Route::get('/alert', function () {
    return view('alert');
})->name('alert');

Route::get('/tutorial', function () {
    return view('tutorial');
})->name('tutorial');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lista', 'HomeController@lista')->name('lista');
Route::get('sair', 'Auth\LoginController@logout')->name('sair');
Route::get('/home', 'HomeController@index')->name('home');

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

//Inserir convidados por lista de ingresso via excel import
Route::post('/liberacao/import', 'LiberarController@import')->name('liberacao.import')->middleware('auth');

Route::resource('ocorrencias', OcorrenciasController::class)->middleware('auth');
Route::get('/ocorrencias/{ocorrencia}/delete', 'OcorrenciasController@delete')->name('ocorrencias.delete')->middleware('auth');

Route::resource('lista_ingresso', ListaController::class)->middleware('auth');
Route::get('/lista_ingresso_lista', 'ListaController@lista')->name('lista_ingresso.lista')->middleware('auth');
Route::get('/lista_ingresso/{lista}/download', 'ListaController@download_lista')->name('listas.download')->middleware('auth');
Route::get('/lista_ingresso_modelo', 'ListaController@download_modelo')->name('listas.modelo')->middleware('auth');

Route::get('/lista_ingresso/{lista}/download', 'ListaController@download_lista')->name('listas.download')->middleware('auth');

Route::resource('locais', LocaisController::class)->middleware('auth');
Route::get('/locais/{local}/delete', 'LocaisController@delete')->name('locais.delete')->middleware('auth');

Route::resource('usuarios', UsuariosController::class)->middleware('auth');
Route::get('/usuarios/{usuario}/delete', 'UsuariosController@delete')->name('usuarios.delete')->middleware('auth');
Route::get('/usuarios/{usuario}/desab', 'UsuariosController@desabilitar')->name('usuarios.desab')->middleware('auth');
Route::get('/usuarios/{usuario}/hab', 'UsuariosController@habilitar')->name('usuarios.hab')->middleware('auth');

Route::get('/qrcode/{usuario}/qrcode', 'QrCodeController@qr_organico')->name('qrcode_organico')->middleware('auth');
Route::get('/qrcode/{convidado}/qrcode/convidado', 'QrCodeController@qr_convidado')->name('qrcode_convidado');
Route::get('/qrcode/{convidado}/qrcode/whats', 'QrCodeController@qr_whats')->name('qrcode_whats')->middleware('auth');
Route::get('/ver_lista/{lista}', 'ListaController@ver_lista')->name('ver_lista')->middleware('auth');

use App\Http\Controllers\SendEmailController;

Route::get('send-email-pdf/{convidado}', [SendEmailController::class, 'sendmail'])->name('email_qrcode');

Route::resource('pets', PetsController::class)->middleware('auth');
Route::get('/pets/{pets}/delete', 'PetsController@delete')->name('pets.delete')->middleware('auth');

Route::get('/reset', 'UserSettingsController@update')->name('senha.update')->middleware('auth');
Route::get('/resetSenha/{id}', 'UserSettingsController@create')->name('form.senha')->middleware('auth');

Route::get('/em_desenvolvimento', function () {
    return view('desenvolvimento');
})->name('desenv');

Route::get('/leitor', 'QrCodeController@leitor')->name('leitor')->middleware('auth');
Route::post('/qrcode_portaria', 'QrCodeController@morador')->name('qrcode_portaria')->middleware('auth');

//Route::post('/qrcode_portaria', 'RetornoController@leitura')->name('qrcode_portaria')->middleware('auth');
//Route::post('/qrcode_portaria', [RetornoController::class, 'leitura'])->name('qrcode_portaria');

Route::get('/movimentacao', function () {
    return view('liberar.morador');
})->name('movimentacao');

Route::get('/cracha', 'QrCodeController@impressao')->name('crachas')->middleware('auth');

// Rota de cadastro de launos e responsáveis
Route::post('/register_aluno', 'CadAlunoController@store')->name('register_aluno');
