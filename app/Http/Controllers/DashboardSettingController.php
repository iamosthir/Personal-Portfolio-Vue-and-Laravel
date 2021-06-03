<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Blog;
use App\Models\BlogCategoryController;
use App\Models\DashboardSetting;
use App\Models\Images;
use App\Models\MyProfile;
use App\Models\ProjectCategory;
use App\Models\Projects;
use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class DashboardSettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super', ['only' => 'show']);
        $this->adminModel = config('multiauth.models.admin');
    }

    // Layout Themes
    #- light
    #- dark
    // Sidebar
    #-light-sidebar
    #-dark-sidebar
    // Colors
    #-theme-black
    #-theme-white
    #-theme-red
    #-theme-cyan
    public function layoutColor(Request $req)
    {
        $this->validate($req,[
            "color" => "required",
        ]);
        $data = DashboardSetting::find(1);
        if($req->color == "light")
        {
            $data->layout_mode = "light";
            $data->sidebar_color = "light-sidebar";
            $data->color_theme = "theme-white";
        }
        elseif($req->color == "dark")
        {
            $data->layout_mode = "dark";
            $data->sidebar_color = "dark-sidebar";
            $data->color_theme = "theme-black";
        }
        $data->save();
        return ["msg" => "Theme Change to $req->color mode"];
    }

    public function sidebarColor(Request $req)
    {
        $this->validate($req, [
            "color" => "required",
        ]);

        $data = DashboardSetting::find(1);

        if ($req->color == "light") {
            $data->sidebar_color = "light-sidebar";
        } elseif ($req->color == "dark") {
            $data->sidebar_color = "dark-sidebar";
        }
        $data->save();
        return ["msg" => "Sidebar color changed"];
    }

    public function colorTheme(Request $req)
    {
        $this->validate($req, [
            "color" => "required",
        ]);

        $data = DashboardSetting::find(1);
        $data->color_theme = $req->color;
        $data->save();
        return ["msg" => "Color Theme changed"];
    }

    public function changeHeader(Request $req)
    {
        $this->validate($req,[
            "style" => "required",
        ]);
        $data = DashboardSetting::find(1);
        if($req->style == true)
        {
            $data->sticky_header = "sticky";            
        }
        else
        {
            $data->sticky_header = null;
        }
        $data->save();
        return ["msg" => "Success $req->style"];
    }

    public function resetDb(Request $req)
    {
        if ($req->ajax()) {
            // Reset Tables
            Album::truncate();
            Blog::truncate();
            BlogCategoryController::truncate();
            DashboardSetting::truncate();
            Images::truncate();
            MyProfile::truncate();
            Projects::truncate();
            ProjectCategory::truncate();
            Skills::truncate();
            // 

            // Seed default data in database
            Artisan::call("db:seed");
            // 

            // Delete Upload Folder
            File::delete(public_path("upload"));
            // 

            return ["status" => "OK"];

        }
    }
}
