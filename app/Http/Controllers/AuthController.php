<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
   public function redirect(string $driver)
{
    return Socialite::driver($driver)->redirect();
}
 
public function callback(string $driver)
{
    $user = Socialite::driver($driver)->user();
 
    $dbUser = User::where('email', $user->email)->where('driver',$driver)->first();
 
    if($dbUser){
        Auth::login($dbUser);
    }else{
        $user = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make( date('ymdhis') ),
            'driver' => $driver,
            'avatar' => $user->getAvatar(),
         ]);
         Auth::login($user);
     }
         
    return redirect()->route('area-51');
}
}
