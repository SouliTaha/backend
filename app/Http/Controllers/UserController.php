<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
 public function  UserById($id){
        $id = Auth::user()->id;
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'User Not Found'], 404);
        }
             return response()->json($user,200);
    
    }
/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request, $id)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
       if(is_null($user)){
           return response()->json(['message'=> 'user not found'], 404);
       }
        
        $user->update($request->all());
        return response($user,200);
    }

}
