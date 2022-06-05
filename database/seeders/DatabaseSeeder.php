<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\VersionControl::create([
            'key' => 'mykey',
            'value' => 'value1',
            'unix_timestamp' => Carbon::now()->timestamp
        ]);

        \App\Models\VersionControl::create([
            'key' => 'mykey',
            'value' => 'value2',
            'unix_timestamp' => Carbon::now()->timestamp
        ]);
    }
}
