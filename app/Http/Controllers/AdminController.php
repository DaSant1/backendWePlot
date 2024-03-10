<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
class AdminController extends Controller
{
    public function getAdmins(){
        $data=admin::all();
    }

    public function registrerNewAdmin(Request $request){
        $data=$request->validate([
            'idUser'=>'required',
            
        ]);
        try{
            $datos=admin::create($data);
            if($datos){
                return response()->json([
                    'message'=>'creado Exitosamente'
                ], 200);
            }else{
                return response()->json([
                    'message'=>'ha ocurrido un error con crear el nuevo Admin'
                ], 422);
            }
        }catch(Exception $e){
            return response()->json([
                'message'=>'Ha ocurrido un error en matricular al Admin'
            ], 500);
        }
    }

    public function getAdminByIdUser(Request $request){
        $data=$request->validate([
            'idUser'=>'required'
        ]);
        try{
            $datos=admin::find($request->idUser,'idUser');
            if($datos){
                return response()->json([
                    'Existe'=>true
                ], 200);
            }else{
                return response()->json([
                    'Existe'=>false
                ], 200);
            }
        }catch(Exception $e){
            return response()->json([
                'message'=>'error'
            ], 500);
        }
    }
}
