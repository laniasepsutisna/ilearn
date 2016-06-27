<?php

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class CoursesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{	
		$teacher = User::where('username', 'timoti')->first();
    $now = Carbon::now();

		$teacher->teacherassignments()
			->saveMany([
				new Course([
					'id' => $this->generateID(),
					'name' => 'Mengenal Laravel',
					'description' => 'Belajar membuat CRUD menggunakan Laravel.',
					'picture' => 'laravel.jpg',
					'level' => 'normal',
	        'created_at' => $now,
	        'updated_at' => $now
				]),
				new Course([
					'id' => $this->generateID(),
					'name' => 'Menginstall Vagrant',
					'description' => 'Tutorial menginstall vagrant.',
					'picture' => 'vagrant.jpg',
					'level' => 'mudah',
	        'created_at' => $now,
	        'updated_at' => $now
				]),
				new Course([
					'id' => $this->generateID(),
					'name' => 'Tutorial Git',
					'description' => 'Mengenal workflow git.',
					'picture' => 'git.jpg',
					'level' => 'sulit',
	        'created_at' => $now,
	        'updated_at' => $now
				]),
			]);
	}

	private function generateID()
	{
    return Uuid::uuid4();
	}
}
