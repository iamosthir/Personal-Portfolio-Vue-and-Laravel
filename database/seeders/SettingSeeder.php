<?php

namespace Database\Seeders;

use App\Models\DashboardSetting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!DashboardSetting::find(1))
        {
            DB::table('dashboard_settings')->insert([
                "id" => 1,
                "layout_mode" => "light",
                "color_theme" => "theme-white",
                "sidebar_color" => "light-sidebar",
                "sticky_header" => "sticky",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);
        }
    }
}
