<?php

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
        	'name' => 'Matematika',
        	'description' => 'Matematika Dasar'
    	]);

        Subject::create([
            'name' => 'IPA',
            'description' => 'Ilmu Pengetahuan Alam'
        ]);

        Subject::create([
            'name' => 'IPS',
            'description' => 'Ilmu Pengetahuan Sosial'
        ]);

        Subject::create([
            'name' => 'Produktif 23',
            'description' => 'Produktif RPL'
        ]);

        Subject::create([
            'name' => 'Produktif 22',
            'description' => 'Produktif Multimedia'
        ]);

        Subject::create([
            'name' => 'Produktif 20',
            'description' => 'Produktif Teknik Komputer Jaringan'
        ]);
    }
}
