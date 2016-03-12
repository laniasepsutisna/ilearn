<?php

use App\Models\Role;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $maddog = Role::create(['name' => 'maddog']);
        $staff = Role::create(['name' => 'staff']);
        $teacher = Role::create(['name' => 'teacher']);
        $student = Role::create(['name' => 'student']);

        $admin = User::create([
            'id' => Uuid::uuid4(),
            'identitynumber' => $faker->unique()->randomNumber,
            'username'  => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'LMS',
            'email' => 'admin@domain.com',
            'status' => 'active',
            'password' => bcrypt('secret')
        ]);
        $admin->assignRole($maddog);
        
        $admin->usermetas()->create([
            'picture' => 'icon-user-default.png',
            'cover' => 'cover-default.jpg'
        ]);

        for ($i=0; $i < 21; $i++) {            
            $status = ['info', 'warning'];
            $admin->announcements()->create([
                'title' => $faker->unique()->sentence(),
                'user_id' => $admin->id,
                'status' => $status[rand(0, 1)],
                'content' => $faker->text(),
            ]);
        }

        $role = [$staff, $teacher, $student];

        for ($i=0; $i < 50 ; $i++) {
            $user = User::create([
                'id' => Uuid::uuid4(),
                'identitynumber' => $faker->unique()->randomNumber,
                'username'  => strtolower($faker->unique()->userName),
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => strtolower($faker->unique()->freeEmail),
                'status' => 'banned',
                'password' => bcrypt('secret')
            ]);

            $user->assignRole($role[rand(0, 2)]);

            $user->usermetas()->create([
                'picture' => 'icon-user-default.png',
                'cover' => 'cover-default.jpg'
            ]);
        }

        $this->command->info('Finished!');
    }
}
