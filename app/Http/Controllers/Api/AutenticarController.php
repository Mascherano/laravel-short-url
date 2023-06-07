<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterApiRequest;
use App\Http\Requests\LoginApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AutenticarController extends Controller
{
    public function register(RegisterApiRequest $request)
    {
        
        $user               = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);

        if($user->save()){

            return response()->json([
                'res' => true,
                'msg' => 'El usuario ha sido registrado correctamente',
            ], 200);

        }else{

            return response()->json([
                'res' => false,
                'msg' => 'El usuario no ha sido registrado correctamente',
            ], 403);

        }
        
    }

    public function login(LoginApiRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if($user){

            if($user->tokens){
                $user->tokens()->delete();
            }

            if(!$user || !Hash::check($request->password, $user->password)){
                throw ValidationException::withMessages([
                    'msg' => ['Las credenciales son incorrectas.'],
                ]);
            }

            $token = $user->createToken($request->email)->plainTextToken;
    
            return response()->json([
                'res'       => true,
                'msg'       => 'token generado correctamente.',
                'token'     => $token,
            ], 200);

        }else{

            return response()->json([
                'res' => false,
                'msg' => 'El email ingresado no esta en nuestros registros, por favor vuelve a intentarlo.',
            ], 400);

        }
        
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'res' => true,
            'msg' => 'Token eliminado correctamente'
        ], 200);
        
    }
}
