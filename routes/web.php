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

Route::get('/dup_cpf', 'Auth\RegisterController@dup_cpf')->name('dup_cpf');
Route::get('/dup_email', 'Auth\RegisterController@dup_email')->name('dup_email');

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
Route::get('/liberacao_completa_visitantes', 'LiberarController@completas_visitantes')->name('liberacao.completa_visitantes')->middleware('auth');
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
Route::get('/usuarios/index/desabilitados', 'UsuariosController@index_desabilitados')->name('usuarios.index_desabilitados')->middleware('auth');
Route::get('/aluno_resp/index/desabilitados', 'CadAlunoController@index_desabilitados')->name('aluno_resp.index_desabilitados')->middleware('auth');
Route::get('/aluno_resp_resp/index/desabilitados_resp', 'CadAlunoController@index_desabilitados_resp')->name('aluno_resp.index_desabilitados_resp')->middleware('auth');


Route::get('/usuarios/{usuario}/desativa', 'UsuariosController@desativa')->name('usuarios.desativa')->middleware('auth');
Route::get('/usuarios/{usuario}/reativa', 'UsuariosController@reativa')->name('usuarios.reativa')->middleware('auth');
Route::get('/aluno_resp/{aluno_resp}/reativa', 'CadAlunoController@reativa')->name('aluno_resp.reativa')->middleware('auth');
Route::get('/usuarios/{usuario}/reset', 'UsuariosController@reset')->name('usuarios.reset')->middleware('auth');

//Ações em massa
Route::delete('/delete_massa','UsuariosController@delete_massa')->name('usuarios.delete_massa')->middleware('auth');
Route::post('/ativa_massa','UsuariosController@ativa_massa')->name('usuarios.ativa_massa')->middleware('auth');
Route::post('/desativa_massa','UsuariosController@desativa_massa')->name('usuarios.desativa_massa')->middleware('auth');
Route::delete('/delete_massa_aluno','CadAlunoController@delete_massa_aluno')->name('aluno_resp.delete_massa_aluno')->middleware('auth');
Route::post('/ativa_massa_aluno','CadAlunoController@ativa_massa_aluno')->name('aluno_resp.ativa_massa_aluno')->middleware('auth');
Route::post('/desativa_massa_aluno','CadAlunoController@desativa_massa_aluno')->name('aluno_resp.desativa_massa_aluno')->middleware('auth');
Route::get('/aluno_resp/{aluno_resp}/desativa', 'CadAlunoController@desativa')->name('aluno_resp.desativa')->middleware('auth');
//Ações em massa
Route::post('/motivo_sint','UsuariosController@motivo_sint')->name('usuarios.motivo_sint')->middleware('auth');
Route::get('/usuarios/{usuario}/parecer_sint', 'UsuariosController@parecer_sint')->name('usuarios.parecer_sint')->middleware('auth');

Route::post('/motivo_sint_aluno','CadAlunoController@motivo_sint_aluno')->name('aluno_resp.motivo_sint_aluno')->middleware('auth');
Route::post('/motivo_sint_resp','CadAlunoController@motivo_sint_resp')->name('aluno_resp.motivo_sint_resp')->middleware('auth');
Route::get('/aluno_resp/{aluno_resp}/parecer_sint_aluno', 'CadAlunoController@parecer_sint_aluno')->name('aluno_resp.parecer_sint_aluno')->middleware('auth');
Route::put('/aluno_resp/{aluno_resp}', 'CadAlunoController@update')->name('aluno_resp.update')->middleware('auth');

Route::post('/motivo_escola_aluno','CadAlunoController@motivo_escola_aluno')->name('aluno_resp.motivo_escola_aluno')->middleware('auth');
Route::post('/motivo_escola_resp','CadAlunoController@motivo_escola_resp')->name('aluno_resp.motivo_escola_resp')->middleware('auth');
Route::get('/aluno_resp/{aluno_resp}/parecer_escola_aluno', 'CadAlunoController@parecer_escola_aluno')->name('aluno_resp.parecer_escola_aluno')->middleware('auth');



Route::get('/usuarios/{usuario}/desab', 'UsuariosController@desabilitar')->name('usuarios.desab')->middleware('auth');
Route::get('/usuarios/{usuario}/hab', 'UsuariosController@habilitar')->name('usuarios.hab')->middleware('auth');

Route::get('/qrcode/{usuario}/qrcode', 'QrCodeController@qr_organico')->name('qrcode_organico')->middleware('auth');
Route::get('/qrcode/{usuario}/qrcode/alunos', 'QrCodeController@qr_alunos')->name('qrcode_alunos')->middleware('auth');
Route::get('/qrcode/{convidado}/qrcode/convidado', 'QrCodeController@qr_convidado')->name('qrcode_convidado');
Route::get('/qrcode/{convidado}/qrcode/whats', 'QrCodeController@qr_whats')->name('qrcode_whats')->middleware('auth');
Route::get('/ver_lista/{lista}', 'ListaController@ver_lista')->name('ver_lista')->middleware('auth');

use App\Http\Controllers\SendEmailController;

Route::get('send-email-pdf/{convidado}', [SendEmailController::class, 'sendmail'])->name('email_qrcode');
Route::get('send-email-pdf_cadastro/{convidado}', [SendEmailController::class, 'sendmail_cadastro'])->name('email_qrcode_cadastro');
Route::get('send-email-pdf/meuqr/{usuario}', [SendEmailController::class, 'sendmail_meuqr'])->name('email_qrcode_meuqr');
Route::get('send-email-pdf/meuqr_aluno/{aluno}', [SendEmailController::class, 'sendmail_meuqr_aluno'])->name('email_qrcode_meuqr_aluno');

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

Route::get('/cracha_alunos', 'QrCodeController@impressao_alunos')->name('crachas_alunos')->middleware('auth');

// Rota de cadastro de alunos e responsáveis
Route::post('/register_aluno', 'CadAlunoController@store')->name('register_aluno');

Route::get('/aluno_resp', 'CadAlunoController@index')->name('aluno_resp.index')->middleware('auth');
Route::get('/aluno_resp_resp', 'CadAlunoController@index_resp')->name('aluno_resp.index_resp')->middleware('auth');

Route::get('/aluno_resp/{aluno_resp}', 'CadAlunoController@show')->name('aluno_resp.show')->middleware('auth');
Route::get('/aluno_resp_resp/{aluno_resp}', 'CadAlunoController@show_resp')->name('aluno_resp.show_resp')->middleware('auth');
Route::get('/aluno_resp/{aluno_resp}/delete', 'CadAlunoController@delete')->name('aluno_resp.delete')->middleware('auth');
Route::get('/aluno_resp/{aluno_resp}/desab', 'CadAlunoController@desabilitar')->name('aluno_resp.desab')->middleware('auth');
Route::get('/aluno_resp/{aluno_resp}/hab', 'CadAlunoController@habilitar')->name('aluno_resp.hab')->middleware('auth');
Route::get('/aluno_resp/{aluno_resp}/edit', 'CadAlunoController@edit')->name('aluno_resp.edit')->middleware('auth');

Route::get('/select', 'UsuariosController@select')->name('select');

// ALTERA A ROTA PADRÃO register PARA RECEBER O PARAMETRO DA VIEW select (qual usuário será cadastrado)
Route::get('/register/{param?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('/cadastro', function () {
    return view('cadastros.cadastro_realizado');
})->name('cadastro');


//documentos
Route::resource('docs', DocsController::class)->middleware('auth');
Route::get('/docs/{doc}/delete', 'DocsController@delete')->name('docs.delete')->middleware('auth');
Route::delete('/delete_massa_docs','DocsController@delete_massa_docs')->name('docs.delete_massa_docs')->middleware('auth');
Route::get('/docs/{doc}/download', 'DocsController@download_doc')->name('docs.download')->middleware('auth');

//rota para envio de email na página usuarios.show
use App\Http\Controllers\EmailController;
Route::post('usuario/{id}/send-email', [EmailController::class, 'sendEmail'])->name('usuario.sendEmail');

//funções para os usuários

Route::get('/usuarios/{usuario}/administrador', 'UsuariosController@administrador')->name('usuarios.administrador')->middleware('auth');
Route::get('/usuarios/{usuario}/apemei', 'UsuariosController@apemei')->name('usuarios.apemei')->middleware('auth');
Route::get('/usuarios/{usuario}/apyjuca', 'UsuariosController@apyjuca')->name('usuarios.apyjuca')->middleware('auth');
Route::get('/usuarios/{usuario}/apin', 'UsuariosController@apin')->name('usuarios.apin')->middleware('auth');
Route::get('/usuarios/{usuario}/resetar', 'UsuariosController@resetar')->name('usuarios.resetar')->middleware('auth');

Route::resource('escolas', MailEscolaController::class)->middleware('auth');