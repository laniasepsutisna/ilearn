<?php

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = [
            'picture' => 'icon-user-default.png',
            'cover' => 'cover-default.jpg'
        ];

        $admin = User::create([
            'username'  => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'LMS',
            'email' => 'admin@domain.com',
            'role' => 'staff',
            'status' => 'active',
            'password' => bcrypt('secret')
        ]);
        $admin->usermeta()->create($image);

        $guru = User::create([
            'username'  => 'timoti',
            'firstname' => 'Timothy',
            'lastname' => 'Adri, S.Kom',
            'email' => 'chimotfunky@yahoo.com',
            'role' => 'teacher',
            'status' => 'active',
            'password' => bcrypt('secret')
        ]);
        $guru->usermeta()->create($image);

        $guru1 = User::create([
            'username'  => 'yanti',
            'firstname' => 'Haryanti',
            'lastname' => 'S.Kom',
            'email' => 'yanti@yahoo.com',
            'role' => 'teacher',
            'status' => 'active',
            'password' => bcrypt('secret')
        ]);
        $guru1->usermeta()->create($image);

        $siswa = User::create([
            'username'  => 'reynold',
            'firstname' => 'Putu Reynold',
            'lastname' => 'Andika',
            'email' => 'reynold@andika.com',
            'role' => 'student',
            'status' => 'active',
            'password' => bcrypt('secret')
        ]);
        $siswa->usermeta()->create($image);

        $siswa1 = User::create([
            'username'  => 'olin',
            'firstname' => 'Charolina',
            'lastname' => 'Oktaviana',
            'email' => 'char@olin.com',
            'role' => 'student',
            'status' => 'active',
            'password' => bcrypt('secret')
        ]);
        $siswa1->usermeta()->create($image);

        $faker = Faker::create();

        for ($i=0; $i < 10; $i++) {            
            $status = ['info', 'danger'];
            $admin->announcements()->create([
                'title' => $faker->unique()->sentence(),
                'user_id' => $admin->id,
                'status' => $status[rand(0, 1)],
                'content' => $faker->text(),
            ]);
        }
    }
}
