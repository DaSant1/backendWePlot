<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
//use Mail;


use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    
    public function authenticate(Request $request){
        $credentials=$request->only('email','password');
        try{
            if(!$token=JWTAuth::attempt($credentials)){
                return response()->json([
                    'error'=>'credenciales Invalidas'
                ], 400);
            }
        }catch(JWTException $e){
            return response()->json([
                'error'=>'No se pudo crear el Token, intentelo más tarde'
            ], 500);
        }
        return response()->json(compact('token'), 200);
    }

    public function getAthenticateUser(){
        try{
            if(!$user=JWTAuth::parseToken()->authenticate()){
                return response()->json([
                    'message'=>'usuario no encontrado'
                ], 400);
            }
        }catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response()->json([
                'Token_Expirado'
            ], $e->getStatusCode());
        }catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            return response()->json(['Token_Invalido'], $e->getStatusCode());
        }catch(Tymon\JWTAuth\Exceptions\JWTException $e){
            return response()->json(['Token_Ausente'],$e->getStatusCode());
        }
        return response()->json(compact('user'), 200);
    }

    public function registrer(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=> 'required|string',
            'email'=> 'required|string',
            'password'=> 'required|string',
            'first_name'=>'required|string',
            'last_name'=>'required|string'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson(), 400);
        }

        if($this->_validate_email($request->email)===true){
            return response()->json([
                'message'=>'El Usuario ya existe'
            ], 409);
        }else{
            $this->_RegistrerUser($request);
        }

       
    }
    private function _RegistrerUser(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=> 'required|string',
            'email'=> 'required|string',
            'password'=> 'required|string',
            'first_name'=>'required|string',
            'last_name'=>'required|string'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson(), 400);
        }
        try{
            $user=User::create([
                'name'=>$request->get('name'),
                'email'=>$request->get('email'),
                'first_name'=>$request->get('first_name'),
                'last_name'=>$request->get('last_name'),
                'password'=>Hash::make($request->get('password')),
            ]);
    
            $token=JWTAuth::fromUser($user);
           // $this->emailSender($request);
            return response()->json(compact('user','token'), 200);
        }catch(Exception $e){
            return response()->json([
                'message'=>'ha ocurrido un error en subir datos'
            ], 422);
        }
        
    }
    private function _validate_email($email){

            $user=user::where('email',$email)->first();
            
            if($user){
                return true;
            }else{
                return false;
            }
        
    }

    private function emailSender(Request $request) {
        $data = $request->validate([
            'email' => 'email|required'
        ]);
    
        $subject = "Tu cuenta de WePlot ha sido creada Exitosamente";
        $for = $data['email'];
    
        Mail::send('email', ['subject' => $subject], function ($msj) use ($subject, $for) {
            $msj->from('weplotsystem@gmail.com', "Systema Integrado de WePlot");
            $msj->subject($subject);
            $msj->to($for);
        });
    }

    public   function getUsers(){
        $data=User::all();
        return response()->json($data, 200);
    }
}
