<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\news;
use App\Models\tempimage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Image;


use Illuminate\Http\Request;

class NewsController extends Controller
{
    
    public function create()
    {
        return view("Admin.news.create");
    }

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:news',
            'writer'=>'required',
            'description' => 'required|',
            'short_description'=> 'required',
            'is_Home' => 'required|in:Yes,No',
            'status' => 'required',
             
         ]);

         if($validator->passes()){
             $news = new news();
             $news->title = $request->title;
             $news->slug = $request->slug;
             $news->writer = $request->writer;
             $news->short_descripion = $request->short_description;
             $news->descripion = $request->description;
             $news->is_Home = $request->is_Home;
             $news->status = $request->status;
             $news->save();



             if(!empty($request->newsimage)){
                $tempimgid = $request->newsimage;
                $tempimginfo = tempimage::find($tempimgid);
                $extArray = explode('.',$tempimginfo->image);
                $ext = last($extArray);

                $newImageName = $news->id.'-'.time().'.'.$ext;
                $TempSpath = public_path().'/temp/'.$tempimginfo->image;
                $TempDpath = public_path().'/uploads/News/'.$newImageName;
                File::copy($TempSpath,$TempDpath);

                $news->img = $newImageName;
                $news->save();

                 // Generate thumbnail

                    //large
                    $dpath = public_path().'/uploads/News/thumb/large/'.$newImageName;
                    $thumb = Image::make($TempDpath);
                    $thumb->resize(1400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $thumb->save($dpath);



                    //small
                    $dpath = public_path().'/uploads/News/thumb/small/'.$newImageName;
                    $thumb = Image::make($TempDpath);
                    $thumb->fit(300,300);
                    $thumb->save($dpath);
             }

             $request->session()->flash('success','News Added Successfully');
             return response()->json([
                'status' =>  true,
                'msg' => "News Added Successfully",
            ]);
         }else{
            return response()->json([
                'status' =>  false,
                'errors' => $validator->errors(),
            ]);
         }
    }

    public function edit(Request $request,string $id)
    {
        $news = news::find($id);
         
        if(empty($news)){
            $request->session()->flash('error','News not Found');
            return response()->json([
                'status' => false,
                'msg' => 'News Not Found'
             ]);
         return redirect()->route('news');
        }

       
        return view('Admin.news.edit',compact('news'));

        return response()->json([
            'status' => true,
            'msg' => 'News  Found Successfully'
         ]);
    }

  
    public function update(Request $request, string $id)
    {
        $news = news::find($id); 
        if(empty($news)){
            $request->session()->flash('error','News not Found');
            return response()->json([
                'status' => false,
                'NotFound' => true,
                'msg' => 'News Not Found'
             ]);
        } 
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:news,slug,'.$news->id.',id',
            'writer'=>'required',
            'description' => 'required|',
            'short_description'=> 'required',
            'is_Home' => 'required|in:Yes,No',
            'status' => 'required',
             
         ]);

         if($validator->passes()){
             $news->title = $request->title;
             $news->slug = $request->slug;
             $news->writer = $request->writer;
             $news->short_descripion = $request->short_description;
             $news->descripion = $request->description;
             $news->is_Home = $request->is_Home;
             $news->status = $request->status;
             $news->update();
             
             $OldImageName = $news->img;


             if(!empty($request->newsimage)){
                $tempimgid = $request->newsimage;
                $tempimginfo = tempimage::find($tempimgid);
                $extArray = explode('.',$tempimginfo->image);
                $ext = last($extArray);

                $newImageName = $news->id.'-'.time().'.'.$ext;
                $TempSpath = public_path().'/temp/'.$tempimginfo->image;
                $TempDpath = public_path().'/uploads/News/'.$newImageName;
                File::copy($TempSpath,$TempDpath);

                $news->img = $newImageName;
                $news->update();

                File::delete(public_path('uploads/News/thumb/large/'.$OldImageName));
                File::delete(public_path('uploads/News/thumb/small/'.$OldImageName));
                File::delete(public_path('uploads/News/'.$OldImageName));


                 // Generate thumbnail

                    //large
                    $dpath = public_path().'/uploads/News/thumb/large/'.$newImageName;
                    $thumb = Image::make($TempDpath);
                    $thumb->resize(1400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $thumb->save($dpath);



                    //small
                    $dpath = public_path().'/uploads/News/thumb/small/'.$newImageName;
                    $thumb = Image::make($TempDpath);
                    $thumb->fit(300,300);
                    $thumb->save($dpath);
             }

             $request->session()->flash('success','News Updated Successfully');
             return response()->json([
                'status' =>  true,
                'msg' => "News Updated Successfully",
            ]);
         }else{
            return response()->json([
                'status' =>  false,
                'errors' => $validator->errors(),
            ]);
         }
    }

    public function destroy(Request $request, string $id)
    {
        $news = news::find($id); 
        if(empty($news)){
            $request->session()->flash('error','News not Found');
            return response()->json([
                'status' => false,
                'NotFound' => true,
                'msg' => 'News Not Found'
             ]);
        } 
        File::delete(public_path('uploads/News/thumb/large/'.$news->img));
        File::delete(public_path('uploads/News/thumb/small/'.$news->img));
        File::delete(public_path('uploads/News/'.$news->img));

        $news->delete();

        $request->session()->flash('success','News will be Deleted Successfully');
        return response()->json([
            'status' => true,
            'msg' => 'News will be Deleted Successfully',
            ]);
    }
}
