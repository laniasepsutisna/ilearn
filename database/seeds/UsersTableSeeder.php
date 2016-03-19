<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;
use App\Models\User;

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

        $admin = User::create([
            'id' => Uuid::uuid4(),
            'no_induk' => $faker->unique()->randomNumber,
            'username'  => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'LMS',
            'email' => 'admin@domain.com',
            'role' => 'staff',
            'status' => 'active',
            'password' => bcrypt('secret')
        ]);

        $admin->usermeta()->create([
            'picture' => 'icon-user-default.png',
            'cover' => 'cover-default.jpg'
        ]);

        $admin = User::create([
            'id' => Uuid::uuid4(),
            'no_induk' => $faker->unique()->randomNumber,
            'username'  => 'timoti',
            'firstname' => 'Timothy',
            'lastname' => 'Adri, S.Kom',
            'email' => 'chimotfunky@yahoo.com',
            'role' => 'teacher',
            'status' => 'active',
            'password' => bcrypt('secret')
        ]);

        $admin->usermeta()->create([
            'picture' => 'icon-user-default.png',
            'cover' => 'cover-default.jpg'
        ]);

        $admin = User::create([
            'id' => Uuid::uuid4(),
            'no_induk' => $faker->unique()->randomNumber,
            'username'  => 'reynold',
            'firstname' => 'Putu Reynold',
            'lastname' => 'Andika',
            'email' => 'reynold@andika.com',
            'role' => 'student',
            'status' => 'active',
            'password' => bcrypt('secret')
        ]);

        $admin->usermeta()->create([
            'picture' => 'icon-user-default.png',
            'cover' => 'cover-default.jpg'
        ]);

        for ($i=0; $i < 10; $i++) {            
            $status = ['info', 'warning'];
            $admin->announcements()->create([
                'title' => $faker->unique()->sentence(),
                'user_id' => $admin->id,
                'status' => $status[rand(0, 1)],
                'content' => $faker->text(),
            ]);
            $this->command->info('Pengumuman ke-' . $i);
        }

        $role = ['staff', 'teacher', 'student'];

        for ($i=0; $i < 50 ; $i++) {
            $user = User::create([
                'id' => Uuid::uuid4(),
                'no_induk' => $faker->unique()->randomNumber,
                'username'  => strtolower($faker->unique()->userName),
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => strtolower($faker->unique()->freeEmail),
                'role' => $role[rand(0,2)],
                'status' => 'banned',
                'password' => bcrypt('secret')
            ]);

            $user->usermeta()->create([
                'picture' => 'icon-user-default.png',
                'cover' => 'cover-default.jpg'
            ]);
            $this->command->info('User ke-' . $i);
        }

        $this->command->info('Finished!');
    }
}
