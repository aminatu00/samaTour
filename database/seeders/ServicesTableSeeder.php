<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Service;


class ServicesTableSeeder extends Seeder
{
    public function run(): void
    {
        $services = ['Ophtalmo', 'Dentiste', 'Gyneco', 'Pédiatrie', 'Cardio'];
        foreach ($services as $s) {
            Service::create(['name' => $s]);
        }
    }
}
