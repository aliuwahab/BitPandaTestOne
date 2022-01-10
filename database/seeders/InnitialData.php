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
        $errors = [];

        ini_set('memory_limit', '-1');

        try {
            \DB::unprepared( file_get_contents( "storage/app/shared/database.sql" ) );
        } catch (\Exception $exception) {
            $errors[] = $exception->getMessage();
        }
    }
}
