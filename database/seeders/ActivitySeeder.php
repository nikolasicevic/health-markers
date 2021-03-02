<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    const ACTIVITIES = [
        'Basket',
        'Plivanje',
        'Trčanje',
        'Teretana',
        'Šetnja',
        'Kućni trening',
        'Fudbal',
        'Biciklizam',
        'Odbojka',
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < count(self::ACTIVITIES); $i++) { 
            Activity::create(['name' => self::ACTIVITIES[$i]]);
        }
    }
}
