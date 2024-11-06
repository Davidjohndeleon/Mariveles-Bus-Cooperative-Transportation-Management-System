<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fare;

class FareTableSeeder extends Seeder
{
    public function run()
    {
        // Fares for Balanga to Mariveles
        $fares1 = [
            ['landmark' => 'BALANGA', 'distance' => 0, 'regular_fare' => 11, 'elderly_student_disabled_fare' => 9, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'ALA-ULI', 'distance' => 6, 'regular_fare' => 13, 'elderly_student_disabled_fare' => 10, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'GEN. LIM', 'distance' => 9, 'regular_fare' => 18, 'elderly_student_disabled_fare' => 13, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'ORION', 'distance' => 11, 'regular_fare' => 22, 'elderly_student_disabled_fare' => 15, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'DAAN PARE', 'distance' => 13, 'regular_fare' => 26, 'elderly_student_disabled_fare' => 18, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'LIMAY', 'distance' => 19, 'regular_fare' => 37, 'elderly_student_disabled_fare' => 30, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'ALANGAN', 'distance' => 22, 'regular_fare' => 42, 'elderly_student_disabled_fare' => 34, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'BRGY CARBON', 'distance' => 23, 'regular_fare' => 44, 'elderly_student_disabled_fare' => 35, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'LAMAO', 'distance' => 25, 'regular_fare' => 48, 'elderly_student_disabled_fare' => 37, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'BATANGAS II', 'distance' => 27, 'regular_fare' => 52, 'elderly_student_disabled_fare' => 41, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'HOUSING', 'distance' => 29, 'regular_fare' => 55, 'elderly_student_disabled_fare' => 44, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'STORAGE/UCAMI', 'distance' => 31, 'regular_fare' => 59, 'elderly_student_disabled_fare' => 47, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'CABCABEN', 'distance' => 34, 'regular_fare' => 65, 'elderly_student_disabled_fare' => 52, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'MT. VIEW', 'distance' => 35, 'regular_fare' => 68, 'elderly_student_disabled_fare' => 54, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'DOÑA NENE', 'distance' => 36, 'regular_fare' => 70, 'elderly_student_disabled_fare' => 56, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'ALASASIN', 'distance' => 37, 'regular_fare' => 72, 'elderly_student_disabled_fare' => 58, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'KARAGATAN', 'distance' => 38, 'regular_fare' => 74, 'elderly_student_disabled_fare' => 59, 'route' => 'Balanga to Mariveles'],
            ['landmark' => 'MARIVELES', 'distance' => 40, 'regular_fare' => 75, 'elderly_student_disabled_fare' => 60, 'route' => 'Balanga to Mariveles'],
        ];

        // Fares for Mariveles to Balanga
        $fares2 = [
            ['landmark' => 'Mariveles', 'distance' => 0, 'regular_fare' => 11, 'elderly_student_disabled_fare' => 9, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Karagatan', 'distance' => 6, 'regular_fare' => 13, 'elderly_student_disabled_fare' => 10, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Alasasin', 'distance' => 8, 'regular_fare' => 17, 'elderly_student_disabled_fare' => 13, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Doña Nene', 'distance' => 9, 'regular_fare' => 18, 'elderly_student_disabled_fare' => 15, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Mt. View', 'distance' => 11, 'regular_fare' => 22, 'elderly_student_disabled_fare' => 18, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Cabcaben', 'distance' => 13, 'regular_fare' => 26, 'elderly_student_disabled_fare' => 21, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Storage/Lucanin', 'distance' => 16, 'regular_fare' => 31, 'elderly_student_disabled_fare' => 25, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Housing', 'distance' => 18, 'regular_fare' => 35, 'elderly_student_disabled_fare' => 28, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Batangas II', 'distance' => 20, 'regular_fare' => 39, 'elderly_student_disabled_fare' => 31, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Lamao', 'distance' => 22, 'regular_fare' => 42, 'elderly_student_disabled_fare' => 34, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'BRC/Carbon', 'distance' => 24, 'regular_fare' => 46, 'elderly_student_disabled_fare' => 37, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Alangan', 'distance' => 25, 'regular_fare' => 48, 'elderly_student_disabled_fare' => 38, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Limay', 'distance' => 28, 'regular_fare' => 54, 'elderly_student_disabled_fare' => 43, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Daan Pare', 'distance' => 34, 'regular_fare' => 65, 'elderly_student_disabled_fare' => 52, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Orion', 'distance' => 36, 'regular_fare' => 68, 'elderly_student_disabled_fare' => 54, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Gen. Lim', 'distance' => 36, 'regular_fare' => 68, 'elderly_student_disabled_fare' => 54, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Alauli', 'distance' => 37, 'regular_fare' => 70, 'elderly_student_disabled_fare' => 56, 'route' => 'Mariveles to Balanga'],
            ['landmark' => 'Balanga', 'distance' => 40, 'regular_fare' => 75, 'elderly_student_disabled_fare' => 58, 'route' => 'Mariveles to Balanga'],
        ];

        
        foreach ($fares1 as $fare) {
            Fare::create($fare);
        }
        foreach ($fares2 as $fare) {
            Fare::create($fare);
        }
    }
}
