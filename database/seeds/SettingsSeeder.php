<?php

use App\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings') -> truncate();

        Setting::create([
        	'metaAuthor' =>	'Remplace por el nombre del autor',
        	'metaKeywords' => 'Remplace 2020',
        	'metaDescription' => 'Esto es una descripción breve'
        ]);
    }
}
