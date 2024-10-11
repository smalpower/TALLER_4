<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'ver egresados',
            'agregar egresados',
            'editar egresados',
            'eliminar egresados',
            'asignar roles',
            'eliminar roles'
        ];

        // Crear o encontrar permisos
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'administrador']);
        $directorRole = Role::firstOrCreate(['name' => 'director']);
        $teacherRole = Role::firstOrCreate(['name' => 'docente']);

        // Asignar permisos a los roles
        $adminRole->syncPermissions(Permission::all()); // Admin tiene todos los permisos
        $directorRole->syncPermissions(['ver egresados', 'agregar egresados', 'editar egresados']);
        $teacherRole->syncPermissions(['ver egresados']);

        // Crear usuarios y asignar roles
        $adminUser = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Usuario Administrador',
            'password' => bcrypt('123456789'),
        ]);
        $adminUser->assignRole('administrador');

        $directorUser = User::firstOrCreate([
            'email' => 'director@example.com',
        ], [
            'name' => 'Usuario Director',
            'password' => bcrypt('123456789'),
        ]);
        $directorUser->assignRole('director');

        $teacherUser = User::firstOrCreate([
            'email' => 'docente@example.com',
        ], [
            'name' => 'Usuario Docente',
            'password' => bcrypt('123456789'),
        ]);
        $teacherUser->assignRole('docente');
    }
}
