<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\preguntas;
class PreguntasController extends Controller
{
    public function createNewPregunta(Request $request){
        $data=$request->validate([
            'idAdmin'=>'required|integer',
            'idEstado'=>'required|integer',
            'pregunta'=>'required|string'
        ]);
        try{
            $datos=preguntas::create($data);
            if($datos){
                return response()->json([
                    'message'=>'success'
                ], 200);
            }else{
                return response()->json([
                    'message'=>'error_al_subir_datos'
                ], 500);
            }
        }catch(Exception $e){
            return response()->json([
                'message'=>'Error al enviar los datos'
            ], 500);
        }
    }

    public function getHistorialPreguntas(){
        $datos=preguntas::all();
        return response()->json($datos, 200);
    }
}
