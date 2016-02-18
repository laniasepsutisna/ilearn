<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

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
            'firstname' => 'Staff',
            'lastname' => 'SMK Wira',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $user->assignRole($staff);

        $user = User::create([
            'username'  => 'teacher',
            'firstname' => 'Teacher',
            'lastname' => 'SMK Wira',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $user->assignRole($teacher);

        $user = User::create([
            'username'  => 'student',
            'firstname' => 'Students',
            'lastname' => 'SMK Wira',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $user->assignRole($student);
    }
}
