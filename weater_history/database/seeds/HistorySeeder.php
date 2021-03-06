<?php

use App\Models\HistoryModel;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(HistoryModel::class, 200)->create();
    }
}
