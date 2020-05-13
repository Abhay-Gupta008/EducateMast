<?php

use Illuminate\Database\Seeder;
use App\Role;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        $roles = ['Admin', 'Author', 'Trusted', 'User'];

        foreach($roles as $key => $role) {
            $tablePosition = $key + 1;
            Role::create([
                'id' => $tablePosition,
                'name' => $role,
            ]);
        }
    }
}
