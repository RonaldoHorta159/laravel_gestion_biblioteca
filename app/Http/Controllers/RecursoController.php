<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso;
use JeroenNoten\LaravelAdminLte\View\Components\Form\Input;

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
                'nombre' => 'required|string|min:20',
                'TipoRecurso' => 'required|string|max:25',
                'descripcion' => 'required|string|max:200',
                'Formato' => 'required|string|max:25',
                'ubicaicon' => 'required|string|max:100',
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
        $recurso->descipcion = $request->Input('descripcion'); // Corregido "descipcion" a "descripcion"
        $recurso->formato = $request->Input('Formato');
        $recurso->ubicacion = $request->Input('ubicaicon');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
