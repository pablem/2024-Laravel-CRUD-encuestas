<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EncuestaController extends Controller
{
/// Lista de encuestas creadas 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return response()->json(Encuesta::all(),200);
    }

    //// Formulario para crear una nueva encuesta --> desde el front
    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'string|required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $encuesta = Encuesta::create($request->all());
        return response()->json($encuesta, 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encuesta = Encuesta::find($id);

        if (is_null($encuesta)) {
            return response()->json(['error' => 'Encuesta no encontrada'], 404);
        }
        return response()->json($encuesta::find($id), 200);
    }

    //// Formulario para editar una Encuesta
    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $encuesta = Encuesta::find($id);
        if (!$encuesta) {
            return response()->json(['error' => 'Encuesta no encontrada'], 404);
        }
        // $validator = Validator::make($request->all(), [
        //     // Aquí debes definir las reglas de validación para los campos de la encuesta
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 400);
        // }
        $encuesta->update($request->all());
        return response()->json($encuesta, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encuesta = Encuesta::find($id);
        if (!$encuesta) {
            return response()->json(['error' => 'Encuesta no encontrada'], 404);
        }
        $encuesta->delete();
        return response()->json(['message' => 'Encuesta eliminada con éxito'], 200);
    }
}
