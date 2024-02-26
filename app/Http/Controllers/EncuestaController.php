<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Redirect;

class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $encuestas = Encuesta::paginate(1);
        $encuestas = Encuesta::orderBy('created_at', 'desc')->get();
        return view('encuestas.index', compact('encuestas'));
    }

    /**
     * CREATE & Store a newly created resource in storage.
     */
    public function createAndStore(): RedirectResponse
    {
        $encuesta = new Encuesta();
        $encuesta->save();
        //Hace falt un objeto json de preguntas vacío?
        return redirect()->route('encuestas.edit',$encuesta);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Encuesta $encuesta): Renderable
    {
        //RECUPERAR las preguntas y renderizarlas
        return view('encuestas.edit', compact('encuesta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Encuesta $encuesta): RedirectResponse
    {
        $request->validate([
            'titulo_encuesta' => 'required|string|max:40',
        ]);
        $encuesta->update([
            'titulo_encuesta' => $request->string('titulo_encuesta'),
            'descripcion' => $request->string('descripcion') ?? null,
        ]);
        return redirect()->route('encuestas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Encuesta $encuesta): RedirectResponse
    {
        $encuesta->delete();
        return redirect()->route('encuestas.index');
    }
}
