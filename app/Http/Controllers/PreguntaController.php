<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PreguntaController extends Controller
{
    // /**
    //  * Formulario para crear una pregunta --> Desde el front 
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    // }
    
    /**
     * Actualiza y a la vez almacena nuevas preguntas de una encuesta dada+
     * 
     * @param  int  $encuestaId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //, $encuestaId) ??
    {
        $encuestaId = 1;

        try {
            // Iniciar una transacción ya que estamos trabajando con múltiples consultas
            DB::beginTransaction();

            foreach ($request->json() as $preguntaData) {

                $validator = Validator::make($preguntaData, [
                        '*.id' => 'integer',
                        // 'id_encuesta' => 'required|integer',
                        'titulo_pregunta' => 'required|string',
                        'tipo_pregunta' => 'required|string',
                        'rango_puntuacion' => 'array',
                        'opciones' => 'array',
                        // '*.opciones' => ['array', 'required_if:*.tipo_pregunta,3'], // Opcionalmente requerido solo si el tipo es "multiple choice"
                    ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                }
                if (isset($preguntaData['id'])) {
                // se asume que las preguntas nuevas no tendrán un ID asignado, si tiene, se actualizan
                    Pregunta::where('id', $preguntaData['id'])
                        ->update([
                            'titulo_pregunta' => $preguntaData['titulo_pregunta'],
                            'tipo_pregunta' => $preguntaData['tipo_pregunta'],
                            'rango_puntuacion' => $preguntaData['rango_puntuacion'] ?? null,
                            'opciones' => $preguntaData['opciones'] ?? null,
                        ]);
                } else {
                    $pregunta = new Pregunta([
                        'id_encuesta' => $encuestaId,
                        'titulo_pregunta' => $preguntaData['titulo_pregunta'],
                        'tipo_pregunta' => $preguntaData['tipo_pregunta'],
                        'rango_puntuacion' => $preguntaData['rango_puntuacion'] ?? null,
                        'opciones' => $preguntaData['opciones'] ?? null,
                    ]);
                    $pregunta->save();
                }
            }
            // Confirmar la transacción si todo ha ido bien
            DB::commit();

            return response()->json(['message' => 'Se guardaron las preguntas'], 201);

        } catch (\Exception $e) {
            // Deshacer la transacción en caso de error
            DB::rollBack();

            return response()->json(['error' => $e], 500);
        }
    }
    // Crear sólo una pregunta: (no se usa)
    // {
    //     $pregunta = Pregunta::create($request->all());
    //     return response()->json($pregunta, 201);
    // }

    /**
     * Mostrar todas las preguntas de una encuesta (Vista del encuestado / o  Vista del editor de encuestas?) 
     * (Formulario para Respuesta@create )
     *
     * @param  int  $encuestaId
     * @return \Illuminate\Http\Response
     */
    public function getPreguntas($encuestaId)
    {
        $encuesta = Encuesta::find($encuestaId);
        if (!$encuesta) {
            return response()->json(['error' => 'Encuesta no encontrada'], 404);
        }

        $preguntas = Pregunta::where('id_encuesta', $encuestaId)->orderBy('id')->get();

        return response()->json($preguntas, 200);
    }

    // /**
    //  * Formulario para editar una pregunta 
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pregunta = Pregunta::findOrFail($id);
            if (!$pregunta) {
                return response()->json(['error' => 'Pregunta no encontrada'], 404);
            }
            // Obtener el ID de la encuesta antes de eliminar la pregunta
            $encuestaId = $pregunta->id_encuesta;
            // Eliminar la pregunta
            $pregunta->delete();
            // return response()->json(['message' => 'Pregunta eliminada con éxito', 'encuestaId' => $encuestaId], 200);
            // Redirigir a la lista actualizada de preguntas correspondientes a la encuesta
            // session(['encuestaId' => $encuestaId]);
            return redirect()->back()->with('success', 'Pregunta eliminada con éxito')->with('encuestaId', $encuestaId);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la pregunta')->with('encuestaId', $encuestaId);
        }
    }
}
