<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ChatsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(PlatcfgsTableSeeder::class);
    }
}
