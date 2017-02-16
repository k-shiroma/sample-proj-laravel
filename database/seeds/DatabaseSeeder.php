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
        $this->call(CorporationsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(SalesHistoriesTableSeeder::class);
    }
}
