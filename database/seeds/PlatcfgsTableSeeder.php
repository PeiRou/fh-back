<?php

use Illuminate\Database\Seeder;

class PlatcfgsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('platcfgs')->insert(array(
            0 => array(
                'id'                =>1,
                'is_open'           => false,
                'schedule_type'     => '手动发布',
                'schedule_games'    => '',
                'schedule_msg'      => '',
                'start_time'        => '',
                'end_time'          => '',
                'is_auto'           => false,
                'min_money'         => 0,
                'ip_black'          => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}
