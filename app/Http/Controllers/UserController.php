<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        
        // Obtener el primer usuario con el rol de administrador
        $firstAdmin = User::role('administrador')->orderBy('id')->first();
    
        return view('home', compact('users', 'roles', 'firstAdmin'));
    }
    

    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findById($request->role_id); // Asegúrate de que 'role_id' está presente en la solicitud
    
        // Verificar si el usuario ya tiene el rol
        if ($user->hasRole($role->name)) {
            return redirect()->back()->with('error', 'No se puede agregar el mismo rol al mismo usuario.');
        }
    
        // Asignar el rol al usuario
        $user->assignRole($role->name);
    
        return redirect()->back()->with('success', 'Rol asignado correctamente.');
    }

    public function removeRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findById($request->role_id); // Asegúrate de que 'role_id' está presente en la solicitud
    
        // Verificar si el usuario tiene el rol
        if (!$user->hasRole($role->name)) {
            return redirect()->back()->with('error', 'El usuario no tiene este rol asignado.');
        }
    
        // Eliminar el rol del usuario
        $user->removeRole($role->name);
    
        return redirect()->back()->with('success', 'Rol eliminado correctamente.');
    }

    
}