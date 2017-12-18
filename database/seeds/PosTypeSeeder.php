<?php

use Illuminate\Database\Seeder;

class PosTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\PosType::query()->create([
            'name' => 'Counter Point',
            'description' => 'Counter Point'
        ]);

        App\Models\PosType::query()->create([
            'name' => 'Epicor (Eagle)',
            'description' => 'Epicor (Eagle)'
        ]);

        App\Models\PosType::query()->create([
            'name' => 'ERPLY',
            'description' => 'ERPLY'
        ]);

        App\Models\PosType::query()->create([
            'name' => 'LightSpeed',
            'description' => 'LightSpeed'
        ]);

        App\Models\PosType::query()->create([
            'name' => 'Netsuite',
            'description' => 'Netsuite'
        ]);

        App\Models\PosType::query()->create([
            'name' => 'RICS',
            'description' => 'RICS'
        ]);

        App\Models\PosType::query()->create([
            'name' => 'QuickBooks',
            'description' => 'QuickBooks'
        ]);
    }
}
