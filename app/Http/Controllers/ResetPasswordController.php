<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;



class ResetPasswordController extends Controller
{
    public function sendEmail(Request $request){
     
        if(!$this->valid($request->email)){
            return $this->faild();
        }
        $this->send($request->email);
        return $this->success();
    }

    
    public function send($email){
        $token = $this-> createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));
    }


    public function createToken($email){
        $oldToken = DB::table('password_resets')->where('email' , $email)->first();

        if($oldToken){
            return $oldToken->token;
        }
          
            $token = str::random(60);
            $this->saveToken($token,$email);
            return $token;
        
     
    }


    public function saveToken($token,$email){
      DB::table('password_resets')->insert([
          'email'=>$email,
          'token'=>$token,
          'created_at'=>Carbon::now()
      ]);
    }


    public function valid ($email){
        return !!user::where('email' , $email)->first();
    }
    public function faild()
    {
        return response()->json([
            'error' => 'email is not found '
        ], Response::HTTP_NOT_FOUND);
    }
    public function success(){
        return response()->json([
            'data'=>'Reset Email is send successfully , check your inbox'
        ], Response::HTTP_OK);
    }
}
