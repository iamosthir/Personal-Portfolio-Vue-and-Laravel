<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_profiles', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name")->nullable();
            $table->string("job_title")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("image_url")->nullable();
            $table->string("image_file")->nullable();
            $table->string("cv_url")->nullable();
            $table->string("cv_file")->nullable();
            $table->mediumText("bio")->nullable();
            $table->string("fb")->nullable();
            $table->string("insta")->nullable();
            $table->string("twitter")->nullable();
            $table->string("github")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("skype")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_profiles');
    }
}
