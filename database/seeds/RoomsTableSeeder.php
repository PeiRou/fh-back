<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert(array(
            0 => array(
                'id'        => 1,
                'name'      => '爱彩聊天室',
                'type'      => '平台聊天室',
                'online'    => '0',
                'is_disable'=> 'true',
                'chip'      => '10',
                'recharge'  => '10',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}
