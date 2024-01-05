<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::factory()->create(['idrole' => 1, 'nama' => 'admin']);
        Role::factory()->create(['idrole' => 2, 'nama' => 'guru']);
        Role::factory()->create(['idrole' => 3, 'nama' => 'siswa']);
    }
}
