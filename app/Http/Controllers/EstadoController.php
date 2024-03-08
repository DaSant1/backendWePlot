<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estado;
class EstadoController extends Controller
{
    public function createNewEstado(Request $request){
        $data=$request->validate([
            'Estado'=>'required'
        ]);

        try{
            $datos=estado::create($data);
            if($datos){
                return response()->json([
                    'message'=>'Success'
                ], 200);
            }else{
                return response()->json([
                    'message'=>'Datos No Ingresados, intentelo más tarde'
                ], 500);
            }
        }catch(Exception $e){
            return response()->json([
                'message'=>'Error en Enviar los Datos'
            ], 500);
        }
    }

    public function  getEstados(){
        $estados=estado::all();
        return response()->json($data, 200);
    }
}
