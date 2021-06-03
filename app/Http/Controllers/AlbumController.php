<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::latest()->get();
        return response()->json($albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $this->validate($req,[
            "name" => "required|unique:albums,name|max:20",
            "desc" => "max:300",
            "thumb" => "mimes:png,jpg,jpeg,JPG,JPEG,PNG|nullable",
        ],[
            "name.required" => "Please set a name for your album",
            "name.unique" => "This album already exists",
            "desc.max" => "Word limit exceeds",
            "thumb.mimes" => "Image file is not valid"
        ]);

        $album = new Album();
        $album->name = $req->name;
        $album->desc = $req->desc;
        $album->slug = Str::slug($req->name,"-");
        if($req->hasFile("thumb"))
        {
            $file = $req->file("thumb");
            $new_name = $req->name."_thumbnail_".time().".".$file->getClientOriginalExtension();
            $file->move(public_path("upload/album/$req->name/"),$new_name);
            $album->thumb = $new_name;
        }
        $album->save();
        return ["status"=>"OK","msg" => "Album was created successfully"];
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
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        $data = Album::findOrFail($req->albumId);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        $this->validate($req,[
            "albumId" => "required|exists:albums,id",
            "name" => "required|unique:albums,name,$req->albumId,id",
            "desc" => "max:300",
            "thumb" => "mimes:png,jpg,jpeg,JPG,JPEG,PNG|nullable",
        ],[
            "name.required" => "Please set a name for your album",
            "name.unique" => "This album already exists",
            "desc.max" => "Word limit exceeds",
            "thumb.mimes" => "Image file is not valid"
        ]);
        $data = Album::find($req->albumId);
        $old_folder_name = $data->name;

        // Upload Image if exists
        if($req->hasFile("thumb"))
        {
            // Delete Old
            if(file_exists(public_path("upload/album/$old_folder_name/$data->thumb")))
            {
                unlink(public_path("upload/album/$old_folder_name/$data->thumb"));
            }
            // 
            $file = $req->file("thumb");
            $new_name = $req->name."_thumbnail_".time().".".$file->getClientOriginalExtension();
            $file->move(public_path("upload/album/$old_folder_name/"),$new_name);
            $data->thumb = $new_name;
        }
        // 

        // Update name and folder name
        if($req->name != $data->name)
        {
            $data->name = $req->name;
            $data->slug = Str::slug($req->name,"-");
            if(file_exists(public_path("upload/album/$old_folder_name")))
            {
                rename(public_path("upload/album/$old_folder_name"),public_path("upload/album/$req->name"));
            }
        }
        // 

        $data->save();
        return ["status" => "OK", "msg" => "Album updated successfully"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $this->validate($req,[
            "albumId" => "required|numeric|exists:albums,id"
        ]);
        $album = Album::find($req->albumId);
        Images::where("album_id",$album->id)->delete();

        // Delete folder
        if(is_dir(public_path("upload/album/$album->name")))
        {
            File::deleteDirectory(public_path("upload/album/$album->name"));
        }
        //
        $album->delete();
        return ["status"=>"OK","msg"=>"Album was deleted"];
    }

    public function uploadPhoto(Request $req)
    {
        $this->validate($req,[
            "albumId" => "required|numeric|exists:albums,id",
            "title" => "max:100",
            "desc" => "max:200",
            "files" => "required"
        ],[
            "title.max" => "Word limit exceeds",
            "desc.max" => "Word limit exceeds",
            "files.required" => "You must upload at least one image",
        ]);

        $albumData = Album::find($req->albumId);

        foreach($req->file("files") as $file)
        {
            $new_name = "image_".rand()."_".time().".".$file->getClientOriginalExtension();
            $file->move(public_path("upload/album/$albumData->name/"),$new_name);

            Images::create([
                "album_id" => $req->albumId,
                "title" => $req->title,
                "desc" => $req->desc,
                "image" => $new_name
            ]);
        }
        return ["status"=>"OK","msg" => "All the image has been uploaded"];
        
    }
    public function getAllImage(Request $req)
    {
        $data = Images::where("album_id",$req->albumId)->with("album:id,name")->latest()->get();
        return response()->json($data);
    }

    public function delAlbumImg(Request $req)
    {
        foreach($req->imgs as $img)
        {
            $data = Images::findOrFail($img);
            $album = Album::find($data->album_id)->name;
            if(file_exists(public_path("upload/album/$album/$data->image")))
            {
                unlink(public_path("upload/album/$album/$data->image"));
            }
            $data->delete();
        }
        return ["status"=>"OK"];
    }

    public function emptyAlbum(Request $req)
    {
        $this->validate($req,[
            "albumId" => "required|numeric|exists:albums,id",
        ]);

        $albumData = Album::find($req->albumId);

        $images = Images::where("album_id",$req->albumId)->get();
        foreach($images as $image)
        {
            if(file_exists(public_path("upload/album/$albumData->name/$image->image")))
            {
                unlink(public_path("upload/album/$albumData->name/$image->image"));
            }
            $image->delete();
        }
        return ["status"=>"OK"];
    }

    public function getImageAndData(Request $req)
    {
        $album = Album::find($req->albumid);
        $images = array();
        $albumImgs = Images::where("album_id",$req->albumid)->latest()->get();
        foreach($albumImgs as $image)
        {
            $imageData = array(
                "title" => $image->title,
                "description" => $image->desc,
                "src" => asset("upload/album/$album->name/$image->image")
            );
            array_push($images,$imageData);
        }


        return [
            "albumInfo" => $album,
            "images" => $images,
        ];
    }

    public function getImg6(Request $req)
    {
        $imgs = Images::latest()->limit(6)->get();
        $images = array();
        foreach($imgs as $img)
        {
            $album = Album::find($img->album_id);
            $imageData = array(
                "title" => $img->title,
                "description" => $img->desc,
                "src" => asset("upload/album/$album->name/$img->image")
            );
            array_push($images,$imageData);
        }

        return response()->json($images);
    }
}
