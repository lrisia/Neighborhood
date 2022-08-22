<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organize = Organization::first();
        if (!$organize) {
            $this->command->line("Generating Organizations");
            $organizes = ['องค์การบริหาร องค์กรนิสิต', 'สำนักงานวิทยาศาสตร์', 'สำนักกีฬา', "สภาผู้แทนนิสิตองค์กรนิสิต"];
            collect($organizes)->each(function ($organizes_name, $key) {
                $organize = new Organization();
                $organize->name = $organizes_name;
                $organize->save();
            });
        }
    }
}
