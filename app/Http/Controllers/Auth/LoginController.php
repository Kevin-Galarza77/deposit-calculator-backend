<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{

    public function login(Request $request)
    {

        $alert = 'No se pudo iniciar sesión, intenta nuevamente';
        $status = false;
        $data = [];
        $messages = [];

        $validator = $this->validateLogin($request->all());

        if (!$validator['status']) {

            $messages = $validator['messages'];
        } else {

            $user = User::where('email', $request['email'])->first();

            if (!$user || !Hash::check($request['password'], $user->password)) {

                $alert = 'Correo o contraseña incorrectos.';
            } else {

                if (!$user->tokens->isEmpty()) {

                    $alert  = 'Inicio de sesión exitoso!';
                    $tokenExists = PersonalAccessToken::where('tokenable_id', $user->id);
                    $tokenExists->delete();
                    $token  = $user->createToken('auth-token')->plainTextToken;
                    $data   = ['token' => $token, 'id' => $user['id'], 'user' => $user['email'], 'name' => $user['name'], 'rol' => $user['rol_id']];
                    $status = true;
                } else {

                    $token  = $user->createToken('auth-token')->plainTextToken;
                    $status = true;
                    $alert  = 'Inicio de sesión exitoso!';
                    $data   = ['token' => $token, 'id' => $user['id'], 'user' => $user['email'], 'name' => $user['name'], 'rol' => $user['rol_id']];
                }
            }
        }

        return [
            'alert'     =>  $alert,
            'status'    =>  $status,
            'messages'  =>  $messages,
            'data'      =>  $data
        ];
    }

    public function validateLogin($data)
    {
        $status = true;
        $messages = [
            'email.required'                    =>  'El email es requerido.',
            'email.email'                       =>  'El correo electrónico debe estar escrito en un formato correcto',
            'password.required'                 =>  'La contraseña es requerida.',
        ];

        $validate = [
            'email'                   =>  'required|email',
            'password'                =>  'required',
        ];

        $validator = Validator::make($data, $validate, $messages);

        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            $status = false;
        }

        return [
            'messages'   =>  $messages,
            'status'     =>  $status
        ];
    }
}
