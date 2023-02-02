<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class () extends Migration {
    public function up(): void
    {
        /** @var \Spatie\Permission\Models\Role $role */
        $role = Role::create(['name' => 'admin']);
        $permissions = [
            Permission::create(['name' => 'manage litters']),
            Permission::create(['name' => 'manage stations']),
        ];
        $role->syncPermissions($permissions);
    }
};
