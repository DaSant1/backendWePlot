<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\createimage;
use Illuminate\Support\Facades\Validator;
class CreateimageController extends Controller
{
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'fileName.*'=>'required|file|mimes:png,jpg|max:2048'//valida el ingreso de imagen
        ]);
        if($validator->fails()){
            return response()->json('error_archivo', 422);
        }

        $files=$request->file('fileName');

        foreach($files as $file){
            $path=$file->store('public\images');
            $name=$file->getClientOriginalName();

            $image= new createimage();
            $image->Title=$name;
            $image->path= $path;
            $image->idUser=1;
            $image->save();
        }
        return response()->json([
            'message'=>'Archivos subidos correctamente'
        ], 200);
    }

    public function getImagenByPath(Request $request){
        $path=$request->input('path');
        if(!$path){
            return response()->json([
                'message'=>'es necesario tener una ruta de imagen'
            ], 400);
        }
        $filePath=storage_path('app/'.$path);
        if(!file_exists($filePath)){
            return response()->json([
                'message'=>'error, imagen no encontrada'
            ], 404);
        }
        return response()->json([
            'image_path'=>$filePath
        ], 200);
    }
}
