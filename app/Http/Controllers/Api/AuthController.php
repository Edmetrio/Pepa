<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\Extensionistafornecedor;
use App\Models\Models\Telefone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'role_id' => ['required'],
            'numero' => ['required'],
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'numero' => $request->numero,
            'role_id' => $request->role_id,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('token')->plainTextToken;

        if($request->role_id === '9t243f2e-ef1e-4454-9ae2-34d091efbc8p')
        {
            Extensionistafornecedor::create([
                'extensionista_id' => 'h962bb71-3ccf-4994-9c60-0dba5f49a7y8',
                'users_id' => $user->id,
                'situacao_id' => '3gd66d9f-614f-8adc-994f-a578099e95j8'
            ]);
            $details = $request->all();
            Mail::to('admin@firsteducation.edu.mz')->send(new RegisterMail($details));
            Mail::to('extensionista@firsteducation.edu.mz')->send(new RegisterMail($details));
        } else {

        }

        $input = $request->all();
        $input['users_id'] = $user->id;
        Telefone::create($input);

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Credenciais Incorrectas'
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logout efectuado com sucesso!'
        ];
    }
}
