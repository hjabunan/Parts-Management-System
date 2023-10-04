<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartsBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = [
            [
                'name' => 'NULL',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'BRAVI',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'BT',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'BT-TYRO',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'CASCADE',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ENTIRE',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'KAUP',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'LOCAL',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'LOCAL CHARGERS',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'LOCAL TIRES',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'LOCAL-BATTERIES',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'LOCAL-CHARGERS',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'LOCAL-LUBES',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'LOCAL-ROTABLE',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'LOCAL-TIRES',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'MOTOLITE',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'NEXEN',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'OTHERS',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PARTS',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'RAYMOND',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'RUBBER NET',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'TAILIFT',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'TENNANT',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'TOYOTA',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'TOYOTA CHINA',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'TOYOTA US',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'TROJAN',
                'status' => '1',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('pms_brands')->insert($brand);
    }
}
