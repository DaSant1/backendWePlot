<?php

namespace App\Http\Controllers;
use App\Models\respuestas_clientes;
use Illuminate\Http\Request;

class RespuestasClientesController extends Controller
{
    public function createNewRespuesta(Request $request){
        $data=$request->validate([
            'idUser'=>'required',
            'idPregunta'=>'required',
            'respuesta'=>'required|string'
        ]);

        try{
            $pregunta=respuestas_clientes::create($data);
            if($pregunta){
                return response()->json([
                    'message'=>'respuesta Ingresada correctamente'
                ], 200);
            }else{
                return response()->json([
                    'message'=>'ha ocurrido un error en el proceso de mandar los datos'
                ], 500);
            }
        }catch(Exception $e){
            return response()->json([
                'message'=>'ha ocurrido un error en el proceso, intentelo más tarde'
            ], 500);
        }
    }

    public function getRespuestasClientesByTimestamp(Request $request){
        $data=$request->validate([
            'initialDate'=>'required',
            'endDate'=>'required'
        ]);
        try{
            $historial=respuestas_clientes::join('users as u','u.id','=','respuestas_clientes.idUser')
                    ->join('preguntas as p','p.id','=','respuestas_clientes.idPregunta')
                    ->whereDate('respuestas_clientes.created_at','<=',$request->endDate)
                    ->whereDate('respuestas_clientes.created_at','>=',$request->initialDate)
                    ->get();
            return response()->json($historial, 200);
        }catch(Exception $e){
            return response()->json([
                'message'=>'error al acceder a los datos'
            ], 500);
        }
        
    }
}
