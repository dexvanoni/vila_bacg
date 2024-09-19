<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Http\Request;
use App\Rules\ValidCpf;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   
    protected $redirectTo = '/cadastro';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // LIBERADO PARA QUALQUER PESSOA FAZER O REGISTRO

        //$this->middleware('administrador');
        //$this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm($param = null)
    {
        // Passar o parâmetro para a view
        return view('auth.register', ['param' => $param]);
    }

    public function dup_cpf()
    {
        // Passar o parâmetro para a view
        return view('cadastros.dup_cpf');
    }

    public function dup_email()
    {
        // Passar o parâmetro para a view
        return view('cadastros.dup_email');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['unique:users,email'],
            'cpf' => ['unique:users,cpf', 'regex:/^\d{11}$/', new ValidCpf],
        ], [
            'cpf.regex' => 'O CPF deve conter apenas 11 números.',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            // Se houver falha na validação do email, redireciona para 'dup_email'
            if ($validator->errors()->has('email')) {
                return redirect()->route('dup_email');
            }

            // Se houver falha na validação do cpf, redireciona para 'dup_cpf'
            if ($validator->errors()->has('cpf')) {
                return redirect()->route('dup_cpf')
                         ->withErrors($validator)
                         ->withInput();
            }

            // Se houver falha em outros campos, redireciona para 'register'
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        // Se a validação passar, continua com a criação do usuário
        $user = $this->create($request->all());

        return redirect($this->redirectTo);
    }

    protected function create(array $data)
    {
        
        // Handle File Upload
        if(request()->hasFile('arquivo')){
            // Get filename with the extension
            $filenameWithExt = request()->file('arquivo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = request()->file('arquivo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename.'_'.time().'.'.$extension))));
            // Upload Image
            $path = request()->file('arquivo')->storeAs('/usuarios', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        };

        if(request()->hasFile('arquivo_cnh')){
            // Get filename with the extension
            $filenameWithExt_cnh = request()->file('arquivo_cnh')->getClientOriginalName();
            // Get just filename
            $filename_cnh = pathinfo($filenameWithExt_cnh, PATHINFO_FILENAME);
            // Get just ext
            $extension_cnh = request()->file('arquivo_cnh')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_cnh= str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename_cnh.'_'.time().'.'.$extension_cnh))));
            // Upload Image
            $path_cnh = request()->file('arquivo_cnh')->storeAs('/usuarios_cnh', $fileNameToStore_cnh);
        } else {
            $fileNameToStore_cnh = 'noimage_cnh.png';
        };

        //$senha = '12345678';
         return User::create([
            'name' => $data['name'],
            'nascimento' => $data['nascimento'],
            'email' => $data['email'],
            'autorizacao' => $data['autorizacao'],
            'local' => $data['local'],
            'telefone' => $data['telefone'],
            'ramal' => "0",
            'password' => Hash::make($data['password']),
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'status' => $data['status'],
            'arquivo' => $fileNameToStore,
            'condutor' => $data['condutor'],
            'num_cnh' => $data['num_cnh'],
            'validade_cnh' => $data['validade_cnh'],
            'categoria_cnh' => $data['categoria_cnh'],
            'cep_func' => $data['cep_func'],
            'rua_func' => $data['rua_func'],
            'num_casa_func' => $data['num_casa_func'],
            'cidade_func' => $data['cidade_func'],
            'bairro_func' => $data['bairro_func'],
            'arquivo_cnh' => $fileNameToStore_cnh,
            'controle_email' => 0
        ]);

         //ENVIAR QR-CODE do visitante para email do liberador
    
        //return redirect()
                    //->route('email_qrcode_cadastro', $onesignal_id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Handle File Upload for Profile Image
        if($request->hasFile('arquivo')){
            // Get filename with the extension
            $filenameWithExt = $request->file('arquivo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('arquivo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename.'_'.time().'.'.$extension))));
            // Upload Image
            $path = $request->file('arquivo')->storeAs('/usuarios', $fileNameToStore);
            
            // Delete old image if exists and is not the default image
            if($user->arquivo != 'noimage.png'){
                Storage::delete('/usuarios/'.$user->arquivo);
            }
            // Update user image
            $user->arquivo = $fileNameToStore;
        }

        // Handle File Upload for CNH Image
        if($request->hasFile('arquivo_cnh')){
            // Get filename with the extension
            $filenameWithExt_cnh = $request->file('arquivo_cnh')->getClientOriginalName();
            // Get just filename
            $filename_cnh = pathinfo($filenameWithExt_cnh, PATHINFO_FILENAME);
            // Get just ext
            $extension_cnh = $request->file('arquivo_cnh')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore_cnh = str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($filename_cnh.'_'.time().'.'.$extension_cnh))));
            // Upload Image
            $path_cnh = $request->file('arquivo_cnh')->storeAs('/usuarios_cnh', $fileNameToStore_cnh);
            
            // Delete old image if exists and is not the default image
            if($user->arquivo_cnh != 'noimage_cnh.png'){
                Storage::delete('/usuarios_cnh/'.$user->arquivo_cnh);
            }
            // Update user CNH image
            $user->arquivo_cnh = $fileNameToStore_cnh;
        }

        // Update other user fields
        $user->name = $request->input('name');
        $user->nascimento = $request->input('nascimento');
        $user->email = $request->input('email');
        // Atualize outros campos conforme necessário
        $user->autorizacao = $request->input('autorizacao');
        $user->local = $request->input('local');
        $user->telefone = $request->input('telefone');
        $user->ramal = $request->input('ramal');
        $user->password = Hash::make($request->input('password'));
        $user->cpf = $request->input('cpf');
        $user->rg = $request->input('rg');
        $user->status = $request->input('status');
        $user->condutor = $request->input('condutor');
        $user->num_cnh = $request->input('num_cnh');
        $user->validade_cnh = $request->input('validade_cnh');
        $user->categoria_cnh = $request->input('categoria_cnh');
        $user->cep_func = $request->input('cep_func');
        $user->rua_func = $request->input('rua_func');
        $user->num_casa_func = $request->input('num_casa_func');
        $user->cidade_func = $request->input('cidade_func');
        $user->bairro_func = $request->input('bairro_func');

        // Save the updated user
        $user->save();

        return redirect()->route('usuario.show', $user->id)->with('success', 'Usuário atualizado com sucesso!');
    }

    
     
}

