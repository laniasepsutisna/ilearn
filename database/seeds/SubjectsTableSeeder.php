<?php

use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SubjectsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $now = Carbon::now();
    
    Subject::insert([
      [
        'id' => $this->generateID(),
        'name' => 'Matematika',
        'description' => 'Matematika Dasar',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'IPA',
        'description' => 'Ilmu Pengetahuan Alam',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'IPS',
        'description' => 'Ilmu Pengetahuan Sosial',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'Produktif 23',
        'description' => 'Produktif RPL',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'Produktif 22',
        'description' => 'Produktif Multimedia',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'Produktif 20',
        'description' => 'Produktif Teknik Komputer Jaringan',
        'created_at' => $now,
        'updated_at' => $now
      ]
    ]);
  }

  private function generateID()
  {
    return Uuid::uuid4();
  }
}
