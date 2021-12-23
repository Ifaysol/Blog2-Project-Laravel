<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Blog::sum("id"));
        //$data["list"] = Blog::all();
        $data["list"] = Blog::paginate();
        //$data["list"]->dump();
        return view("blog.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blog.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        //dd($request->toArray());
        // $blog = Blog::FirstOrCreate([
        //     "post" => $request->get("post")
        // ]);
        //dd($blog);
        $path = "";
        if($request->hasFile("image")){
            $fileName = Str::snake($request->get("post")) .".". $request->file("image")->getClientOriginalExtension();
            $path = Storage::putFileAs("images/blogs", $request->file("image"),  $fileName);
        }
        
        if(!$path){
            return redirect()
            ->back()
            ->withInput()
            ->with("ERROR", __("Failed to upload image."));
        }
        $blog = Blog::create([
            "post" => $request->get("post"),
            "image" => $path,
        ]);
        if(empty($blog)){
            return redirect()
            ->back()
            ->withInput();
        }
        return redirect()
        ->route("blogs.index")
        ->with("SUCCESS", __("Post has been create successfully."));
            
    }

    /**
     * complete the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function complete(Blog $blog)
    {
        $blog->forceFill([
            "is_complete" => true 
        ]);
        if($blog->update()){
        return redirect()->route("blogs.index")->with("SUCCESS", __("Blog has been completed successfully"));
    };
    return redirect()->back()->withInput()->with("ERROR", __("Failed to complete this blog"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $data["blog"] = $blog;
        return view("blog.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->post = $request->get("post");
        if($request->hasFile("image")){
            $fileName = Str::snake($request->get("post")) .".". $request->file("image")->getClientOriginalExtension();
            $blog->post = Storage::putFileAs("images/blogs", $request->file("image"),  $fileName);
        }
            $blog->image = $request->file("image")->store("images/blogs");
        
        if($blog->update()){
            return redirect()->route("blogs.index")->with("SUCCESS", __("Blog has been update successfully"));
        }
        return redirect()->back()->withInput()->with("ERROR", __("Failed to update this blog"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {   
       //dd($blog);
       if($blog->image){
        Storage::delete($blog->image);
    }

       if($blog->delete()){
           return redirect()->back()->with("SUCCESS", __("Blog has been deleted successfully"));
       };
       return redirect()->back()->with("ERROR", __("Failed to delete this blog"));
    }
}
