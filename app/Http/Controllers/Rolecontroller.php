<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Rolecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('can: Ver Roles');
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();

        return view('sistema.user.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $role = Role::create(['name' => $request->input('nombre')]);
        return back();
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
    public function edit(Role $role)
    {
        //
        //$role = Role::find($id);
        $permisos = Permission::all();
        return view('sistema.user.rolePermiso', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        $role->permissions()->sync($request->permisos);
        return redirect()->route('roles.index', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
