<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use \Spatie\Permission\Models\Role;
class AsignarController extends Controller
{
    public function __construct()
    {
        $this->middleware('can: Ver Usuarios');
        // $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener usuarios con sus roles
        $users = User::with('roles')->get();
        return view('sistema.user.listUser', compact('users'));
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
        $user = User::find($id);
        $roles = Role::all();

        return view('sistema.user.userRol', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::find($id);

        $user->roles()->sync($request->roles);

        return redirect()->route('asignar.index', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
