<?php

use App\Models\Major;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class MajorsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $now = Carbon::now();
    
    Major::insert([
      [
        'id' => $this->generateID(),
        'name' => 'RPL',
        'description' => 'Rekayasa Perangkat Lunak',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'TKJ',
        'description' => 'Teknik Komputer Jaringan',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'MM',
        'description' => 'Multimedia',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'AP',
        'description' => 'Akomodasi Perhotelan',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'JB',
        'description' => 'Jasa Boga',
        'created_at' => $now,
        'updated_at' => $now
      ],
      [
        'id' => $this->generateID(),
        'name' => 'UPW',
        'description' => 'Usaha Perjalanan Wisata',
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
