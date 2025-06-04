<?php

namespace Database\Seeders;


use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Generating permissions...');
        \Artisan::call('shield:generate', ['--all' => true, '--panel' => 'admin']);
        $this->command->info('Permissions generated successfully.');

        $name = 'admin';
        $email = 'admin@gmail.com';
        $password = 'adminpass';
        $role = 'super_admin';

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($password),
                'role' => $role,
            ]
        );

        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $guruRole = Role::firstOrCreate(['name' => 'guru', 'guard_name' => 'web']);
        $siswaRole = Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);

        $superAdminRole->givePermissionTo(\Spatie\Permission\Models\Permission::all());
        // $guruRole->givePermissionTo(\Spatie\Permission\Models\Permission::all());
        // $siswaRole->givePermissionTo(\Spatie\Permission\Models\Permission::all());

        $guruRole->givePermissionTo([
            'view_any_industri',
            'view_industri',
            'page_DashboardGuru',
        ]);

        $siswaRole->givePermissionTo([
            'view_any_guru',
            'view_guru',
            'create_guru',
            'update_guru',
            'view_any_industri',
            'view_industri',
            'create_industri',
            'update_industri',
            'view_any_p::k::l',
            'view_p::k::l',
            'create_p::k::l',
            'update_p::k::l',
            'delete_p::k::l',
            'delete_any_p::k::l',
            'page_DashboardSiswa',
        ]);

        $user->assignRole($superAdminRole);
    }
}
