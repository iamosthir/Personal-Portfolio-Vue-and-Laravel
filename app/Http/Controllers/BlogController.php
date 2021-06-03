<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategoryController;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        // get the category slug
        $ctg_slug = $req->category_slug;
        $ctg = BlogCategoryController::select("id","name")->where("slug",$ctg_slug)->first();
        $posts = Blog::select("id","title","thumb","created_at")->where("ctg_id",$ctg->id)->latest()->paginate(10);
        return response()->json($posts);
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
            "title"=>"required",
            "thumb"=>"required|mimes:png,jpg,jpeg,JPG,PNG,JPEG",
            "ctg" => "required|exists:blog_category_controllers,id",
            "content" => "required"
        ],[
            "title.required" => "Title is required",
            "content.required" => "Content is required",
            "thumb.required" => "Project thumbnail is required",
            "ctg.required" => "Category is required",
            "thumb.mimes" => "Invalid file type",
            "ctg.exists" => "Invalid category",
        ]);
        $blog = new Blog();
        $blog->title =  $req->title;
        $blog->ctg_id = $req->ctg;
        $blog->content = $req->content;

        $file = $req->file("thumb");
        $new_name = "$req->title"."_".rand().".".$file->getClientOriginalExtension();
        $file->move(public_path("upload/blog/thumbnails/"),$new_name);
        $blog->thumb = $new_name;
        $blog->save();

        return ["status" => "OK","msg"=>"Your post was published"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        if($req->has("id"))
        {
            $data = Blog::findOrFail($req->id);
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $this->validate($req,[
            "title"=>"required",
            "thumb"=>"nullable|mimes:png,jpg,jpeg,JPG,PNG,JPEG",
            "ctg" => "required|exists:blog_category_controllers,id",
            "content" => "required"
        ],[
            "title.required" => "Title is required",
            "content.required" => "Content is required",
            "thumb.required" => "Project thumbnail is required",
            "ctg.required" => "Category is required",
            "thumb.mimes" => "Invalid file type",
            "ctg.exists" => "Invalid category",
        ]);

        $project = Blog::find($req->projectId);

        $project->title = $req->title;
        $project->ctg_id = $req->ctg;
        $project->content = $req->content;

        if($req->hasFile("thumb"))
        {
            if($project->thumb != '')
            {
                if(file_exists(public_path("upload/blog/thumbnails/$project->thumb")))
                {
                    unlink(public_path("upload/blog/thumbnails/$project->thumb"));   
                }
            }

            $file = $req->file("thumb");
            $new_name = "$req->title"."_".rand().".".$file->getClientOriginalExtension();
            $file->move(public_path("upload/blog/thumbnails/"),$new_name);
            $project->thumb = $new_name;    
        }


        $project->save();
        return ["status" => "OK","msg"=>"Blog was updated"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $this->validate($req,[
            "blogId" => "required|numeric|exists:blogs,id"
        ]);

        $data = Blog::find($req->blogId);

        if($data->thumb != '')
        {
            if(file_exists(public_path("upload/blog/thumbnails/$data->thumb")))
            {
                unlink(public_path("upload/blog/thumbnails/$data->thumb"));   
            }
        }
        $data->delete();
        return ["status"=>"OK","msg"=>"Blog was deleted successfully"];
    }

    public function indexForAdmin()
    {
        $data = Blog::select("id","title","thumb","created_at","ctg_id")->latest()->with("ctg:id,name")->paginate(20);
        return response()->json($data);
    }

    public function getLatesBlog(Request $req)
    {
        $limit = $req->limit;
        $blogs = Blog::select("id","title","thumb","created_at")->latest()->limit($limit)->get();

        return response()->json($blogs);
    }
}
