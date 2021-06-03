<?php

namespace Database\Seeders;

use App\Models\MyProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!MyProfile::find(1))
        {
            DB::table("my_profiles")->insert([
                "id" => 1,
                "first_name" => "Md Sazzad",
                "last_name" => "Hossain",
                "job_title" => "Web Developer",
                "bio" => "Coding is in my DNA",
                "email" => "mdeasinislam6@gmail.com",
                "phone" => "01533860142",
                "fb" => "https://facebook.com/iam.osthir"
            ]);
        }
    }
}
