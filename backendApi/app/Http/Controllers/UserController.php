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
        $user = new User;

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
    public function update(Request $request)
    {
        $user = User::FindOrfail($request->user_id);
    

        if ($request->input('user_id')) {
            $user->id = $request->input('user_id');
          }
          if ($request->input('name')) {
            $user->name = $request->input('name');
          }
          if ($request->input('email')) {
            $user->email = $request->input('email');
          }
          if ($request->input('password')) {
            $user->password = $request->input('password');
          }
          if ($request->input('cars')) {
            $user->cars = $request->input('cars');
          }
          if ($request->input('previouscars')) {
            $user->previouscars = $request->input('previouscars');
          }
         
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