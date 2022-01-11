<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InnitialData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::unprepared( file_get_contents( "storage/app/shared/database.sql" ) );
    }
}
