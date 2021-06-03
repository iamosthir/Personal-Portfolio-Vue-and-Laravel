<?php

namespace App\Http\Controllers;

use App\Models\MyProfile;
use Illuminate\Http\Request;

class MyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profileData = MyProfile::find(1);
        if($profileData!=null)
        {
            return response()->json($profileData);
        }
        else
        {
            return response()->json("",404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MyProfile  $myProfile
     * @return \Illuminate\Http\Response
     */
    public function show(MyProfile $myProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyProfile  $myProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(MyProfile $myProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyProfile  $myProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyProfile $myProfile)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyProfile  $myProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyProfile $myProfile)
    {
        //
    }

    public function updateProfile(Request $req)
    {
        $this->validate($req,[
            "first_name" => "required",
            "image" => "mimes:png,jpg,jpeg,PNG,JPG,JPEG|nullable",
            "cv" => "mimes:pdf,docx,doc,ppt,pptx,PDF,DOCX,DOC,PPT,PPTX|nullable"
        ],[
            "first_name.required" => "Your first name is required",
            "image.mimes" => "Invalid file type. 'PNG, JPEG, JPG' are the accepted file types",
            "cv.mimes" => "Invalid file type. 'PDF,DOC,PPT' are the accepted file types"
        ]);
        $myProfile = MyProfile::find(1);
        if($myProfile)
        {
            $myProfile->first_name = $req->first_name;
            $myProfile->last_name = $req->last_name;
            $myProfile->bio = $req->bio;
            $myProfile->job_title = $req->job_title;
            $myProfile->fb = $req->fb;
            $myProfile->github = $req->github;
            $myProfile->email = $req->email;
            $myProfile->phone = $req->phone;
            $myProfile->skype = $req->skype;
            $myProfile->linkedin = $req->linkedin;
            $myProfile->insta = $req->insta;
            $myProfile->twitter = $req->twitter;
            
            if($req->hasFile("image"))
            {
                if($myProfile->image_file != "")
                {
                    if(file_exists(public_path("upload/profile/$myProfile->image_file")))
                    {
                        unlink(public_path("upload/profile/$myProfile->image_file"));
                    }
                }

                $img = $req->file("image");
                $new_img_name = "profile-picture_".time().".".$img->getClientOriginalExtension();
                $img->move(public_path("upload/profile/"),$new_img_name);
                $myProfile->image_file = $new_img_name;
                $myProfile->image_url = asset("upload/profile/$new_img_name");
            }

            if($req->hasFile("cv"))
            {
                if($myProfile->cv_file != "")
                {
                    if(file_exists(public_path("upload/profile/$myProfile->cv_file")))
                    {
                        unlink(public_path("upload/profile/$myProfile->cv_file"));
                    }
                }

                $cv = $req->file("cv");
                $new_cv_name = "$req->first_name"."_$req->last_name"."_cv".time().".".$cv->getClientOriginalExtension();
                $cv->move(public_path("upload/profile/"),$new_cv_name);
                $myProfile->cv_file = $new_cv_name;
                $myProfile->cv_url = asset("upload/profile/$new_cv_name");
            }
            $myProfile->save();
            return ["status"=>"OK","msg" => "Profile information was updated successfully"];
        }
        else
        {
            return ["status"=>"FAIL","msg"=>"Targeted Data not found"];
        }
    }
}
