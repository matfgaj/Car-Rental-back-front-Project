<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SignInController extends Controller
{
    public function __invoke(Request $request)
    {
        if(!$token = auth()->attempt($request->only('email', 'password', 'role'))){
            return response(null,401);
        }
        
        return response()->json([
            'token' => $token
        ]);
    }    
}