<?php

use Illuminate\Database\Seeder;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->insert(array(
            0 => array(
                'id'       =>1,
                'name'     => 'admin',
                'nickname' => '超级管理员',
                'password' => '$2y$10$5qA0mP/FRtUHycndKNcCWeiYD.I/ZKsA5gS75Q3vir8RfC.ccJGY2',   // 123456
                'remember_token' => 'tDpcjqLYBeWU11ULTVcmsIFaaSiqdvVh8zDeNbFZ29lhqQNUR3Ki0QtEzCNd',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}
