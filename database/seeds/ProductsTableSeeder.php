<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$corporations = DB::table('corporations');
    	for ($i = 1; $i < 10; $i++) {
        	DB::table('corporations')->insert($this->getDummyData($i));
    	}
    }
}
