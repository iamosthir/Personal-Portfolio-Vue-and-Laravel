<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if($req->has("category"))
        {
            $ctg = null;
            if($req->category == "all")
            {
                $ctg = "%";
            }
            else
            {
                $ctg = $req->category;
            }

            if($req->has("limit") && $req->limit != 0)
            {
                $data = Projects::select("id","prject_name","ctg_id","thumb")->where("ctg_id","like",$ctg)->with("ctg:id,name")->latest()->limit($req->limit)->get();
                return $data;
            }
            else
            {
                $data = Projects::select("id","prject_name","ctg_id","thumb")->where("ctg_id","like",$ctg)->with("ctg:id,name")->latest()->get();
                return $data;
            }
        }
        else
        {
            return "Invalid category";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $this->validate($req,[
            "title"=>"required",
            "thumb"=>"required|mimes:png,jpg,jpeg,JPG,PNG,JPEG",
            "skill_v2" => "required",
            "startDate" => "required|date",
            "ctg" => "required|exists:project_categories,id",
            "content" => "required",
        ],[
            "title.required" => "Title is required",
            "thumb.required" => "Project thumbnail is required",
            "skill_v2.required" => "Please select some skills",
            "startData.required" => "Define the start date of your project",
            "ctg.required" => "Category is required",
            "thumb.mimes" => "Invalid file type",
            "ctg.exists" => "Invalid category",
            "startData.date" => "Please provide a valid date!"
        ]);
        $skills = json_decode($req->skill_v2,true);

        $project = new Projects();
        $project->prject_name = $req->title;
        $project->started_at = $req->startDate;
        $project->ended_at = $req->endDate;
        $project->ctg_id = $req->ctg;
        $project->skills = $skills;
        $project->content = $req->content;

        $file = $req->file("thumb");
        $new_name = "$req->title"."_".rand().".".$file->getClientOriginalExtension();
        $file->move(public_path("upload/project/thumbnails/"),$new_name);
        $project->thumb = $new_name;


        $project->save();
        return ["status" => "OK","msg"=>"Project was published"];
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
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        if($req->has("id"))
        {
            $data = Projects::findOrFail($req->id);
            return response()->json($data);
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Projects $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $null_string = "null";
        $this->validate($req,[
            "title"=>"required",
            "thumb"=>"nullable|mimes:png,jpg,jpeg,JPG,PNG,JPEG",
            "skill_v2" => "required",
            "startDate" => "required|date",
            "ctg" => "required|exists:project_categories,id"
        ],[
            "title.required" => "Title is required",
            "skill_v2.required" => "Please select some skills",
            "startData.required" => "Define the start date of your project",
            "ctg.required" => "Category is required",
            "thumb.mimes" => "Invalid file type",
            "ctg.exists" => "Invalid category",
            "startData.date" => "Please provide a valid date!"
        ]);
        $skills = json_decode($req->skill_v2,true);

        $project = Projects::find($req->projectId);

        $project->prject_name = $req->title;
        $project->started_at = $req->startDate;
        $project->ended_at = $req->endDate;
        $project->ctg_id = $req->ctg;
        $project->skills = $skills;
        $project->content = $req->content;

        if($req->hasFile("thumb"))
        {
            if($project->thumb != '')
            {
                if(file_exists(public_path("upload/project/thumbnails/$project->thumb")))
                {
                    unlink(public_path("upload/project/thumbnails/$project->thumb"));   
                }
            }

            $file = $req->file("thumb");
            $new_name = "$req->title"."_".rand().".".$file->getClientOriginalExtension();
            $file->move(public_path("upload/project/thumbnails/"),$new_name);
            $project->thumb = $new_name;    
        }


        $project->save();
        return ["status" => "OK","msg"=>"Project was update"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $this->validate($req,[
            "projectId" => "required|numeric|exists:projects,id"
        ]);

        $data = Projects::find($req->projectId);

        if($data->thumb != '')
        {
            if(file_exists(public_path("upload/project/thumbnails/$data->thumb")))
            {
                unlink(public_path("upload/project/thumbnails/$data->thumb"));   
            }
        }
        $data->delete();
        return ["status"=>"OK","msg"=>"Project was deleted successfully"];
    }

    public function indexForAdmin()
    {
        $data = Projects::select("id","prject_name","ctg_id","thumb","created_at","skills")->latest()->with("ctg:id,name")->paginate(15);
        return response()->json($data);
    }

    public function prevNextProject(Request $req)
    {
        if($req->has("projectId"))
        {
            $prev = Projects::where("id","<",$req->projectId)->select("id","prject_name","thumb")->orderBy("id","desc")->first()??null;
            $next = Projects::where("id",">",$req->projectId)->select("id","prject_name","thumb")->orderBy("id","asc")->first()??null;
            return ["prev" => $prev, "next" =>$next];
        }
        else
        {
            return ["prev" => null, "next" => null];
        }
    }
}
