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
        DB::table('categories')->insert([
          'category_id' => '1',
          'category_name' => 'Making money online',
          'category_details' => 'Here you can write posts about Making money online kind of stuffs',
          'total_posts'=> '245',
        ]);
    }
}
