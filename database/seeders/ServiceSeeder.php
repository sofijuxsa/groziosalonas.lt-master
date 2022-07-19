<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name' => 'Pedikiūras', 'duration' => '0:45'],
            ['name' => 'Manikiūras', 'duration' => '1:00'],
            ['name' => 'Makiažas', 'duration' => '0:40'],
            ['name' => 'Bikini depiliacija', 'duration' => '0:40'],
            ['name' => 'Pažastų depiliacija', 'duration' => '0:20'],
            ['name' => 'Kojų depiliacija', 'duration' => '0:20'],
            ['name' => 'Moteriškas kirpimas', 'duration' => '0:50'],
            ['name' => 'Vyriškas kirpimas', 'duration' => '0:50'],
            ['name' => 'Plaukų dažymas', 'duration' => '1:30'],
            ['name' => 'Antakių dažymas', 'duration' => '0:20'],
            ['name' => 'Antakių laminavimas', 'duration' => '1:30']
        ];

        foreach ($services as $service){
            DB::table('services')->insert([
                'name' => $service['name'],
                'duration' => $service['duration']
            ]);
        }
    }
}
