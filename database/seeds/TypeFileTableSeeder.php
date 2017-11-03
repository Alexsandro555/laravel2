<?php

use Illuminate\Database\Seeder;

class TypeFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('type_files')->insert([
        [
          'name' => 'photo',
          'config' => '{"resize":"0", "maxsize":"16000"}',
        ],
        [
          'name' => 'mediumphoto',
          'config' => '{"resize":"1", "width":"203", "height":"200", "ext":"jpeg,jpg,png", "maxsize":"16000"}',
        ],
        [
          'name' => 'minphoto',
          'config' => '{"resize":"1", "width":"150", "height":"148", "ext":"jpeg,jpg,png", "maxsize":"16000"}',
        ],
        [
          'name' => 'maxminphoto',
          'config' => '{"resize":"1", "width":"40", "height":"40", "ext":"jpeg,jpg,png", "maxsize":"16000"}',
        ],
        [
          'name' => 'file',
          'config' => '{"maxsize":"16000"}',
        ]
      ]);
    }
}
