<?php

namespace App\Http\Controllers;

use App\Models\BlogCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BlogCategoryController::latest()->get();
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
    public function store(Request $req)
    {
        $this->validate($req,[
            "name" => "required|unique:blog_category_controllers,name"
        ],[
            "name.required" => "Please give a name of your category",
            "name.unique" => "This category already exists"
        ]);
        $ctg = new BlogCategoryController();
        $ctg->name = $req->name;
        $ctg->slug = Str::slug($req->name,"-");
        $ctg->save();
        return ["status" =>"OK","msg" => "Blog category was created successfully"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategoryController  $blogCategoryController
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        $data = BlogCategoryController::find($req->id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategoryController  $blogCategoryController
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategoryController $blogCategoryController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogCategoryController  $blogCategoryController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            "id" => "required|numeric|exists:blog_category_controllers,id",
            "name" => "required|unique:blog_category_controllers,name,$request->id,id",
        ],[
            "name.required" => "Category name is required",
            "name.unique" => "Category already exist with this name"
        ]);
        $data = BlogCategoryController::find($request->id);
        $data->name = $request->name;
        $data->slug = Str::slug($request->name,"-");
        $data->save();
        return ["status" => "OK", "msg" => "$request->name was updated successfully"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategoryController  $blogCategoryController
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $this->validate($req,[
            "id" => "required|numeric|exists:blog_category_controllers,id",
        ]);
        $data = BlogCategoryController::find($req->id);
        $data->delete();
        return ["status" => "OK","msg"=>"Category was deleted"];
    }

    public function ctgData(Request $req)
    {
        $data = BlogCategoryController::where("slug",$req->slug)->first();
        return response()->json($data);
    }
}
