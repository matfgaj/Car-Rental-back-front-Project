<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
        
    }

    public function __invoke(Request $request)
    {
        $user = $request->user();

        return response()->json([            
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->role,
            'cars' => $user->cars,
            'history' => $user->history,


        ]);

    }   
}
