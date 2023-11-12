<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create university
        $university = University::factory()->create([
            'name' => 'Vinco Learning',
            'initials' => 'VL',
            'address' => 'Lubumbashi 2000 haut Katanga',
            'email' => 'administration@vinco.digital',
            'phone' => '+243 999 999 999',
            'code' => Str::random(5),
        ]);
    }
}
