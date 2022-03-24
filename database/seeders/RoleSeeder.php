<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Colaborador']);

        Permission::create(['name' => 'admin.home', 'description' => 'Ver Dashboard'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver listado de Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.create', 'description' => 'Agregar un Usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Asignar un Rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.destroy', 'description' => 'Eliminar un Usario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update', 'description' => 'Actualizar Un RoL'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.barrios.index', 'description' => 'Ver listado de barrios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.barrios.create', 'description' => 'Crear barrios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.barrios.edit', 'description' => 'Editar barrios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.barrios.destroy', 'description' => 'Eliminar barrios'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.calles.index', 'description' => 'Ver listado de calles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.calles.create', 'description' => 'Crear calles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.calles.edit', 'description' => 'Editar calles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.calles.destroy', 'description' => 'Eliminar calles'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.bacheos.index', 'description' => 'Ver listado de bacheos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.bacheos.create', 'description' => 'Crear bacheos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.bacheos.edit', 'description' => 'Editar bacheos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.bacheos.destroy', 'description' => 'Eliminar bacheos'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.roles.index', 'description' => 'Ver listado de Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.create', 'description' => 'Crear Role'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit', 'description' => 'Editar Role'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.destroy', 'description' => 'Eliminar Role'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.status.index', 'description' => 'Ver listado de status'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.status.create', 'description' => 'Crear status'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.status.edit', 'description' => 'Editar status'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.status.destroy', 'description' => 'Eliminar status'])->syncRoles([$role1]);
    }
}
