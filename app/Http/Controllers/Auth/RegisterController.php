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
            'cpf' => ['unique:users,cpf'],
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
                return redirect()->route('dup_cpf');
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
        /*
        $validator = Validator::make($data, [
            'email' => ['unique:users,email'],
            'cpf' => ['unique:users,cpf'],
        ]);
        
        if ($validator->fails()) {
            // Extrai todos os erros do validador
                $errors = $validator->errors();

                // Apenas para exemplo: logar erros para depuração
                $erros = $errors->toArray();

                // Opcionalmente, verifique se um campo específico tem erros
                if ($errors->has('email')) {
                    return redirect('/dup_email');
                    //return view('cadastros.dup_email');
                    echo "SisVila Informa:<br><br>Erro no campo EMAIL!<br>Este EMAIL já existe. <br>Volte a tela de cadastro e repita o preenchimento.<br>Dúvidas contate o Administrador. <br> <button id='backBtn'>Voltar</button>";
                }
                if ($errors->has('cpf')) {
                    return redirect('/dup_cpf');
                    //return view('cadastros.dup_cpf');
                    echo "SisVila Informa:<br><br>Erro no campo CPF! <br>Este CPF já existe. <br>Volte a tela de cadastro e repita o preenchimento.<br>Dúvidas contate o Administrador. <br> <button id='backBtn'>Voltar</button>";
                }

                //exit;
        }
        */
    

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
            'arquivo_cnh' => $fileNameToStore_cnh
        ]);

         //ENVIAR QR-CODE do visitante para email do liberador
    
        //return redirect()
                    //->route('email_qrcode_cadastro', $onesignal_id);
    }

    
     
}

