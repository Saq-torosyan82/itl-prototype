<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //register permissions

        //jobs
        Permission::create(['name' => 'view jobs']);
        Permission::create(['name' => 'post jobs']);
        Permission::create(['name' => 'delete jobs']);
        Permission::create(['name' => 'delete all jobs']);


        //resume
        Permission::create(['name' => 'upload resume']);
        Permission::create(['name' => 'delete resume']);
        Permission::create(['name' => 'delete resumes']);

        Permission::create(['name' => 'view resumes']);
        Permission::create(['name' => 'delete all resumes']);



        //profile
        Permission::create(['name' => 'update profile']);

        //settings
        Permission::create(['name' => 'update settings']);

        //admin
        Permission::create(['name' => 'view applicants']);
        Permission::create(['name' => 'view employers']);
        Permission::create(['name' => 'edit others profile']);






        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'applicant']);
        $role1->givePermissionTo('view jobs');
        $role1->givePermissionTo('upload resume');
        $role1->givePermissionTo('delete resume');
        $role1->givePermissionTo('update profile');
        $role1->givePermissionTo('update settings');


        $role2 = Role::create(['name' => 'employer']);
        $role2->givePermissionTo('post jobs');
        $role2->givePermissionTo('delete jobs');
        $role2->givePermissionTo('view resumes');
        $role2->givePermissionTo('update profile');
        $role2->givePermissionTo('update settings');


        $role3 = Role::create(['name' => 'agency']);
        $role3->givePermissionTo('view jobs');
        $role3->givePermissionTo('delete jobs');
        $role3->givePermissionTo('delete all jobs');
        $role3->givePermissionTo('view applicants');
        $role3->givePermissionTo('view employers');
        $role3->givePermissionTo('view resumes');
        $role3->givePermissionTo('delete resumes');
        $role3->givePermissionTo('delete all resumes');
        $role3->givePermissionTo('edit others profile');

        $role3 = Role::create(['name' => 'company']);
        $role3->givePermissionTo('view jobs');
        $role3->givePermissionTo('delete jobs');
        $role3->givePermissionTo('delete all jobs');
        $role3->givePermissionTo('view applicants');
        $role3->givePermissionTo('view employers');
        $role3->givePermissionTo('view resumes');
        $role3->givePermissionTo('delete resumes');
        $role3->givePermissionTo('delete all resumes');
        $role3->givePermissionTo('edit others profile');
    }
}
