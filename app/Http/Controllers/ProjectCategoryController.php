<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProjectCategory::latest()->with("projects:id")->get();
        return response()->json($data);
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
            "name" => "required|unique:project_categories,name",
        ],[
            "name.required" => "Category name is required",
            "name.unique" => "Category exist with this same name"
        ]);
        $ctg = new ProjectCategory();
        $ctg->name = $request->name;
        $ctg->save();
        return ["status"=>"OK","msg"=>"Category created"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        if($req->has("id"))
        {
            $data = ProjectCategory::find($req->id);
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
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            "id" => "required|numeric|exists:project_categories,id",
            "name" => "required|unique:project_categories,name,$request->id,id",
        ],[
            "name.required" => "Category name is required",
            "name.unique" => "Category already exist with this name"
        ]);
        $data = ProjectCategory::find($request->id);
        $data->name = $request->name;
        $data->save();
        return ["status" => "OK", "msg" => "$request->name was updated successfully"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $this->validate($req,[
            "id" => "required|numeric|exists:project_categories,id",
        ]);
        $data = ProjectCategory::find($req->id);
        $data->delete();
        return ["status" => "OK","msg"=>"Category was deleted"];
    }
}
