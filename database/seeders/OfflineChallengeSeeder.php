<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OfflinechallengeDemo;


class OfflineChallengeSeeder extends Seeder
{
    public function run(): void
    {
        OfflinechallengeDemo::insert([
            [
                'title' => 'امش 3000 خطوة',
                'type' => 'خطوات',
                'duration' => 1,
                'reward' => 'شارة خضراء',
            ],
            [
                'title' => 'اركض 1 كيلومتر',
                'type' => 'جري',
                'duration' => 1,
                'reward' => 'وسام ذهبي',
            ],
            [
                'title' => 'احرق 150 سعرة',
                'type' => 'سعرات',
                'duration' => 1,
                'reward' => 'كأس إنجاز',
            ],
            [
                'title' => 'خطوة مع أحد أفراد العائلة',
                'type' => 'خطوات جماعية',
                'duration' => 2,
                'reward' => 'شارة العائلة',
            ],
        ]);
    }
}
