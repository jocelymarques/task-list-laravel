<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validar os dados de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Buscar o usuário pelo e-mail
        $user = User::where('email', $request->email)->first();

        // 3. Verificar se o usuário existe e a senha está correta
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        // 4. Revogar tokens antigos (Opcional: use se quiser apenas 1 sessão por vez)
        // $user->tokens()->delete();

        // 5. Criar um novo token
        // 'auth_token' é o nome do token, você pode mudar se quiser
        $token = $user->createToken('auth_token')->plainTextToken;

        // 6. Retornar o token e dados do usuário
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        // Remove o token atual que foi usado na requisição
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }
}