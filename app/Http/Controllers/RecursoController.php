<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso;
use JeroenNoten\LaravelAdminLte\View\Components\Form\Input;
use Carbon\Carbon;


class RecursoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $recursos = Recurso::all();
        return view('sistema.listRecurso', compact('recursos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sistema.addRecurso');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validation = $request->validate(
            [
                'nombre' => 'required|string',
                'TipoRecurso' => 'required|string|max:25',
                'descripcion' => 'required|string',
                'Formato' => 'required|string|max:25',
                'Ubicacion' => 'required|string|max:20',
                'fechapublicacion' => 'required|date',
                'Estado' => 'required|string|max:25',
                'Encargado' => 'required|string|max:25',
            ]
        );
        // Crear una nueva instancia de Recurso
        $recurso = new Recurso();

        // Convertir el valor de 'Estado' en 1 o 0
        $estado = $request->input('Estado') === 'Activo' ? 1 : 0;

        // Asignar los valores a los campos correspondientes
        $recurso->nombre = $request->Input('nombre');
        $recurso->{"tipo de recurso"} = $request->Input('TipoRecurso');
        $recurso->descipcion = $request->Input('descripcion');
        $recurso->formato = $request->Input('Formato');
        $recurso->ubicacion = $request->Input('Ubicacion');
        $recurso->{"fecha de publicacion"} = $request->Input('fechapublicacion');
        $recurso->estado = $estado; // Aquí usamos el valor numérico 1 o 0
        $recurso->responsable = $request->Input('Encargado');

        // Guardar el recurso en la base de datos
        $recurso->save();

        // Retornar a la vista anterior
        return back()->with('message', 'ok');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $recurso = Recurso::find($id);

        return view('sistema.editRecurso', compact('recurso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $recurso = Recurso::find($id);

        $estado = $request->input('Estado') === 'Activo' ? 1 : 0;

        $recurso->nombre = $request->input('nombre');
        $recurso->{"tipo de recurso"} = $request->input('TipoRecurso');
        $recurso->descipcion = $request->input('descripcion'); // OJO: debe ser 'descripcion' en BD
        $recurso->formato = $request->input('Formato');
        $recurso->ubicacion = $request->input('ubicaicon');
        // Usar Carbon para asegurar el formato de fecha
        if ($request->filled('fechapublicacion')) {
            $recurso->{"fecha de publicacion"} = Carbon::parse($request->input('fechapublicacion'))->format('Y-m-d');
        } else {
            // Opcional: lógica en caso de que no venga la fecha
            return back()->withErrors('La fecha de publicación es obligatoria.');
        }
        $recurso->estado = $estado;
        $recurso->responsable = $request->input('Encargado');

        $recurso->save();

        return back()->with('message', 'Actualizado correctamente');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $recurso = recurso::find($id);

        $recurso->delete();

        return back();
    }
}
