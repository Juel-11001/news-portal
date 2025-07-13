<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create([ 
            'lang'=> 'en',
            'name'=> 'English',
            'slug'=> 'en',
            'status'=> 1,
            'default'=> 1
        ]);
    }
}
