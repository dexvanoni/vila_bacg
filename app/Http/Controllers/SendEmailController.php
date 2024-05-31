<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use PDF;
use App\Liberar;
use App\User;
use App\CadAluno;
 
class SendEmailController extends Controller
{
     
    public function sendmail($convidado){

        $convidado = Liberar::find($convidado);
        $liberador = User::find($convidado->onesignal_id);

        //$data["email"]=$request->get("email");
        $data["email"]= $liberador->email;
        //$data["client_name"]=$request->get("client_name");
        $data["client_name"]= $liberador->nome_completo;
        //$data["subject"]=$request->get("subject");
        $data["subject"]='Novo visitante liberado no SISVila';

        // $pdf = PDF::loadView('mails.qr_convidado_email', compact('convidado'));
        $pdf = PDF::loadView('mails.qr_convidado_email', compact('convidado'));
 
        try{
            Mail::send('mails.mail', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "cartao_de_acesso.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";
 
        }else{
 
           $this->statusdesc  =   "Message sent Succesfully";
           $this->statuscode  =   "1";
        }
        return redirect()
                    ->route('home')
                    ->with('success', 'Visitante liberado e email encaminhado!');
 }

 public function sendmail_cadastro($convidado){

        $convidado = Liberar::find($convidado);
        $liberador = User::find($convidado->onesignal_id);

        //$data["email"]=$request->get("email");
        $data["email"]= $liberador->email;
        //$data["client_name"]=$request->get("client_name");
        $data["client_name"]= $liberador->nome_completo;
        //$data["subject"]=$request->get("subject");
        $data["subject"]='Novo visitante liberado no SISVila';

        // $pdf = PDF::loadView('mails.qr_convidado_email', compact('convidado'));
        $pdf = PDF::loadView('mails.qr_convidado_email', compact('convidado'));
 
        try{
            Mail::send('mails.mail', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "cartao_de_acesso.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";
 
        }else{
 
           $this->statusdesc  =   "Message sent Succesfully";
           $this->statuscode  =   "1";
        }
        return redirect()
                    ->route('home')
                    ->with('success', 'Visitante liberado e email encaminhado!');
 }


 public function sendmail_meuqr($usuario){


        $usuarios = User::find($usuario);

        //$data["email"]=$request->get("email");
        $data["email"]= $usuarios->email;
        //$data["client_name"]=$request->get("client_name");
        $data["client_name"]= $usuarios->name;
        //$data["subject"]=$request->get("subject");
        $data["subject"]='Seu QR-Code do SISVila chegou!';

        // $pdf = PDF::loadView('mails.qr_convidado_email', compact('convidado'));
        $pdf = PDF::loadView('mails.meuqr', compact('usuarios'));
 
        try{
            Mail::send('mails.meumail', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "cartao_de_acesso.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";
 
        }else{
 
           $this->statusdesc  =   "Message sent Succesfully";
           $this->statuscode  =   "1";
        }
        return redirect()
                    ->route('usuarios.index')
                    ->with('success', 'Email encaminhado!');
 }

 public function sendmail_meuqr_aluno($aluno){


        $alunos = CadAluno::find($aluno);
        

        if(is_null($alunos->email_resp)){
            return redirect()
                    ->route('aluno_resp.index_resp')
                    ->with('success', 'Email não encaminhado! Este usuário não tem email cadastrado.');
        }


        //$data["email"]=$request->get("email");
        $data["email"]= $alunos->email_resp;
        //$data["client_name"]=$request->get("client_name");
        $data["client_name"]= $alunos->nome_resp;
        //$data["subject"]=$request->get("subject");
        $data["subject"]='Seu QR-Code do SISVila chegou!';

        // $pdf = PDF::loadView('mails.qr_convidado_email', compact('convidado'));
        $pdf = PDF::loadView('mails.meuqr_aluno', compact('alunos'));
 
        try{
            Mail::send('mails.meumail_aluno', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "cartao_de_acesso.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";
 
        }else{
 
           $this->statusdesc  =   "Message sent Succesfully";
           $this->statuscode  =   "1";
        }
        return redirect()
                    ->route('aluno_resp.index_resp')
                    ->with('success', 'Email encaminhado!');
 }
}