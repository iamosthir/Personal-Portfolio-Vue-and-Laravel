<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skills::latest()->get();
        return response()->json($skills);
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
        $this->validate($request,[
            "name" => "required",
            "desc" => "required",
            "icon" => "required|mimes:png,jpg,jpg|max:100"
        ],[
            "name.required" => "Skill name is required",
            "desc.required" => "Description is required",
            "icon.required" => "Icon is required",
            "icon.mimes" => "Icon file is not valid",
            "icon.max" => "Please upload images less than 100 KB"
        ]);

        $skill = new Skills();
        $skill->name = $request->name;
        $skill->desc = $request->desc;
        if($request->hasFile("icon"))
        {
            $file = $request->file("icon");
            $new_name = "icon_".$request->name."_".rand().".".$file->getClientOriginalExtension();
            $file->move(public_path("upload/skill/icon/"),$new_name);
            $skill->icon = $new_name;
        }
        $skill->save();
        return["status" => "OK","msg"=>"$request->name skill was created successfully"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skills  $skills
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        if($req->has("id"))
        {
            $data = Skills::findOrFail($req->id);
            return response()->json($data);
        }
        else
        {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skills  $skills
     * @return \Illuminate\Http\Response
     */
    public function edit(Skills $skills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skills  $skills
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            "id" => "required|numeric|exists:skills,id",
            "name" => "required",
            "desc" => "required",
            "icon" => "nullable|mimes:png,jpg,jpg|max:100"
        ],[
            "id.required" =>"Invalid Skill Data",
            "id.numeric" => "Invalid Skill Data",
            "id.exists"=>"Invalid Skill Data",
            "name.required" => "Skill name is required",
            "desc.required" => "Description is required",
            "icon.mimes" => "Icon file is not valid",
            "icon.max" => "Please upload images less than 100 KB"
        ]);
        $data = Skills::find($request->id);
        $data->name = $request->name;
        $data->desc = $request->desc;
        if($request->hasFile("icon"))
        {
            if($data->icon != "")
            {
                if(file_exists(public_path("upload/skill/icon/$data->icon")))
                {
                    unlink(public_path("upload/skill/icon/$data->icon"));
                }

                $file = $request->file("icon");
                $new_name = "icon_".$request->name."_".rand().".".$file->getClientOriginalExtension();
                $file->move(public_path("upload/skill/icon/"),$new_name);
                $data->icon = $new_name;
            }
        }
        $data->save();
        return ["status"=>"OK","msg"=>"$request->name was updated","new_icon" => $data->icon];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skills  $skills
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $this->validate($req,[
            "id"=>"required|numeric|exists:skills,id"
        ]);
        $data = Skills::find($req->id);

        if($data->icon != "")
        {
            if(file_exists(public_path("upload/skill/icon/$data->icon")))
            {
                unlink(public_path("upload/skill/icon/$data->icon"));
            }
        }
        $data->delete();
        return ["status" => "OK","msg" => "Skill was deleted successfully"];
    }
}
