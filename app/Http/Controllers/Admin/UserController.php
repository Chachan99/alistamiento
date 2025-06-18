<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::with('roles')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|exists:roles,name',
            'numero_cedula' => 'nullable|string|max:50',
            'fecha_expedicion_licencia' => 'nullable|date',
            'fecha_vencimiento_licencia' => 'nullable|date',
            'pdf_licencia' => 'nullable|file|mimes:pdf',
            'pdf_cedula' => 'nullable|file|mimes:pdf',
        ]);

        $data = $request->only([
            'name', 'email', 'numero_cedula', 'fecha_expedicion_licencia', 'fecha_vencimiento_licencia'
        ]);
        $data['password'] = bcrypt($request->password);

        // Guardar archivos si existen
        if ($request->hasFile('pdf_licencia')) {
            $data['pdf_licencia'] = $request->file('pdf_licencia')->store('licencias', 'public');
        }
        if ($request->hasFile('pdf_cedula')) {
            $data['pdf_cedula'] = $request->file('pdf_cedula')->store('cedulas', 'public');
        }

        $user = User::create($data);
        $user->assignRole($request->role);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario)
    {
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'role' => 'required|exists:roles,name',
            'numero_cedula' => 'nullable|string|max:50',
            'fecha_expedicion_licencia' => 'nullable|date',
            'fecha_vencimiento_licencia' => 'nullable|date',
            'pdf_licencia' => 'nullable|file|mimes:pdf',
            'pdf_cedula' => 'nullable|file|mimes:pdf',
        ]);

        $data = $request->only([
            'name', 'email', 'numero_cedula', 'fecha_expedicion_licencia', 'fecha_vencimiento_licencia'
        ]);

        // Guardar archivos si existen
        if ($request->hasFile('pdf_licencia')) {
            $data['pdf_licencia'] = $request->file('pdf_licencia')->store('licencias', 'public');
        }
        if ($request->hasFile('pdf_cedula')) {
            $data['pdf_cedula'] = $request->file('pdf_cedula')->store('cedulas', 'public');
        }

        $usuario->update($data);
        $usuario->syncRoles([$request->role]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return back()->with('success', 'Usuario eliminado.');
    }
}
