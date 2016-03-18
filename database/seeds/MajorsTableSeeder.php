<?php

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Major::create([
        	'name' => 'RPL',
        	'description' => 'Rekayasa Perangkat Lunak'
    	]);

        Major::create([
            'name' => 'TKJ',
            'description' => 'Teknik Komputer Jaringan'
        ]);

        Major::create([
            'name' => 'MM',
            'description' => 'Multimedia'
        ]);

        Major::create([
            'name' => 'AP',
            'description' => 'Akomodasi Perhotelan'
        ]);

        Major::create([
            'name' => 'JB',
            'description' => 'Jasa Boga'
        ]);

        Major::create([
            'name' => 'UPW',
            'description' => 'Usaha Perjalanan Wisata'
        ]);
    }
}
