<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';



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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'autorizacao' => ['required', 'string', 'max:255'],
            'local' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string', 'max:255'],
            'ramal' => ['string', 'max:4'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'cpf' => ['required', 'string', 'min:11'],
            'rg' => ['required', 'string', 'min:4'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'autorizacao' => $data['autorizacao'],
            'local' => $data['local'],
            'telefone' => $data['telefone'],
            'ramal' => $data['ramal'],
            'password' => Hash::make($data['password']),
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'status' => $data['status'],
        ]);
    }
}
