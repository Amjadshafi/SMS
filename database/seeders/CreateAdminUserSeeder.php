<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $org = Organization::create([
        //     'name' => "Organizaion",
        //     'email' => "org@gmail.com"
        // ]);
        $user = User::create([
            'name' => 'Super Admin', 
            'email' => 'admin@gmail.com',
            'username' => 'superadmin',
            // 'organization_id' => $org->id,
            'password' => Hash::make('admin1122')
        ]);
    
        $role = Role::create(['name' => 'Super Admin']);


        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
        
        Role::create(['name' => 'Admin']);
    }
}