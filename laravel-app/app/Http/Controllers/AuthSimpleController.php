<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthSimpleController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate(['email'=>'required|email','password'=>'required']);
        $user = User::where('email',$request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->regenerate();
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_name', $user->name);
            return redirect()->intended(route('livros.index'))->with('success','Bem-vindo, '.$user->name);
        }

        return back()->withErrors(['email'=>'Credenciais inválidas'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success','Desconectado com sucesso.');
    }
}
