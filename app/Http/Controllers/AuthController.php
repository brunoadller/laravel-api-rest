<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//chama para gerar o hash da senha
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //REGISTRAR O USUARIO

    public function register(Request $request ){
        $request->validate([
            'name' => 'required|string',
            //valida o email que sera unico 
            'email' => 'required|string|unique:users,email',
            //valida a senha e confirma em baixo
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            //ira encriptar a senha
            'password' => bcrypt($request->password)
        ]);

        //gerando o token
        //joga o token para a variavel plaintexttoken para retornar ao usuario
        $token = $user->createToken('primeiroToken')->plainTextToken;

        //retorna para o usuario
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }
}
