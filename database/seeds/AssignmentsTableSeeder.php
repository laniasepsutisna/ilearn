<?php

use App\Models\Assignment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class AssignmentsTableSeeder extends Seeder
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
				new Assignment([
					'id' => $this->generateID(),
					'title' => 'Buat algoritma',
					'file' => '',
					'content' => 'Buatlah algoritma proses login menggunakan flowchart. Tugas dikumpul dalam bentuk pdf.',
	        'created_at' => $now,
	        'updated_at' => $now
				]),
				new Assignment([
					'id' => $this->generateID(),
					'title' => 'Install homestead',
					'file' => '',
					'content' => 'Buatlah tutorial menginstall homestead beserta screenshot-nya.',
	        'created_at' => $now,
	        'updated_at' => $now
				]),
				new Assignment([
					'id' => $this->generateID(),
					'title' => 'Menggunakan UUID di Laravel',
					'file' => '',
					'content' => 'Buatlah tutorial menggunakan UUID sebagai pengganti auto_increment id pada sebuah tabel di Laravel.',
	        'created_at' => $now,
	        'updated_at' => $now
				])
			]);
	}

	private function generateID()
	{
    return Uuid::uuid4();
	}
}
