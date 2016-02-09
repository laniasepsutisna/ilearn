<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = Role::create(['name' => 'staff']);
        $teacher = Role::create(['name' => 'teacher']);
        $student = Role::create(['name' => 'student']);

        $user = User::create([
            'username'  => 'staff',
            'first_name' => 'Staff',
            'last_name' => 'SMK Wira',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $user->assignRole($staff);

        $user = User::create([
            'username'  => 'teacher',
            'first_name' => 'Teacher',
            'last_name' => 'SMK Wira',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $user->assignRole($teacher);

        $user = User::create([
            'username'  => 'student',
            'first_name' => 'Students',
            'last_name' => 'SMK Wira',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $user->assignRole($student);
    }
}
