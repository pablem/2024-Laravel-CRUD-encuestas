<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\Encuestado;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RespuestaController extends Controller
{
    /**
     * Muestra el formulario para crear respuestas a preguntas de una encuesta
     * 
     * @param  int  $encuestaId
     * @return \Illuminate\Http\Response
     */
    public function resopnder($encuestaId)
    {
        $encuesta = Encuesta::find($encuestaId);
        if (!$encuesta) {
            return response()->json(['error' => 'Encuesta no encontrada'], 404);
        }

        $preguntas = Pregunta::where('id_encuesta', $encuestaId)->orderBy('id')->get();

        return response()->json($preguntas, 200);
    }

    /**
     * Almacenar en BD las respuestas de un encuestado
     *
     * @param  int  $encuestaId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $encuestaId, $encuestadoID)
    {
        try {
            // Iniciar una transacción ya que estamos trabajando con múltiples consultas
            DB::beginTransaction();

            foreach ($request->json() as $respuestaData) {

                $validator = Validator::make($respuestaData, [
                    // 'id_encuesta' => 'required|integer',
                    'tipo_respuesta' => 'required|string',
                    'puntuacion' => 'integer',
                    'entrada_texto' => 'string',
                    'seleccion' => 'array',
                    // '*.opciones' => ['array', 'required_if:*.tipo_respuesta,3'], // Opcionalmente requerido solo si el tipo es "multiple choice"
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 400);
                }
                $pregunta = new Pregunta([
                    'id_encuesta' => $encuestaId,
                    'id_encuestado' => $encuestadoID,
                    'tipo_respuesta' => $respuestaData['tipo_respuesta'],
                    'puntuacion' => $respuestaData['puntuacion'] ?? null,
                    'entrada_texto' => $respuestaData['entrada_texto'] ?? null,
                    'seleccion' => $respuestaData['seleccion'] ?? null,
                ]);
                $pregunta->save();
            }
            // Confirmar la transacción si todo ha ido bien
            DB::commit();
            return response()->json(['message' => 'Se guardó su respuesta'], 201);

        } catch (\Exception $e) {
            // Deshacer la transacción en caso de error
            DB::rollBack();
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Sección Informes:
     * 1) DEVOLVER TODAS LAS RESPUESTAS DE UNA PREGUNTA EN ESPECÍFICO: HAY UNA FALLA DE ARQ DE LA BASE DE DATOS ?
     * (o número de opciones seleccionadas, número de caracteres del texto, etc...)
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
