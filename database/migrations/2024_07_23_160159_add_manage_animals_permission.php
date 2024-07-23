<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class () extends Migration {
    public function up(): void
    {
        /** @var \Spatie\Permission\Models\Role $role */
        $role = Role::findByName('admin');
        $permission = Permission::create(['name' => 'manage animals']);
        $role->givePermissionTo($permission);
    }
};
