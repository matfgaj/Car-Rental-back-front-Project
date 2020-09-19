<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use App\Http\Requests;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->isMethod('put') ? User::FindOrfail($request->user_id)
         : new User;

         

         $user->id = $request->input('user_id');
         $user->name = $request->input('name');
         $user->email = $request->input('email');
         $user->password = $request->input('password');
         $user->role = 'user';
         $user->cars = '';
         $user->email_verified_at = now();

         if($user->save()){
             return new UserResource($user);
         }

    }
    public function show($id)
    {
        $user = User::findOrFail($id);

        return $user->cars;
    }

}