<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\accessorie;
use App\Models\Category;
use App\Models\tempimage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AccessoriesController extends Controller
{
    public function create()
    {
         $categories = Category::all();
         return view('Admin.accessories.create');
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:accessories',
            'description' => 'required|',
            'price' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
            'qty' => 'required|numeric',
            'status' => 'required',
         ]);
 
         if($validator->passes()){
            $accessorie  = new accessorie();
            $accessorie->title = $request->title;
            $accessorie->slug = $request->slug;
            $accessorie->description = $request->description;
            $accessorie->price = $request->price;
            $accessorie->is_featured = $request->is_featured;
            $accessorie->qty = $request->qty;
            $accessorie->status = $request->status;
            $accessorie->save();



            if(!empty($request->img)){
                
            
                    $tempimginfo = tempimage::find($request->img);
                    $extArray = explode('.',$tempimginfo->image);
                    $ext = last($extArray);
                   


                    $ImageName = $accessorie->id.'-'.'-'.time().'.'.$ext;
                    $accessorie->img = $ImageName;
                    $accessorie->save();;



                    // Generate thumbnail

                    //large
                    $Spath = public_path().'/temp/'.$tempimginfo->image;
                    $dpath = public_path().'/uploads/Accessorie/thumb/'.$ImageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($Spath);
                    $image->cover(550,550);
                    $image->save($dpath);
                    



                
            }
             

            $request->session()->flash('success','Accessories Added Successfully');
            return response()->json([
                'status' => true,
                'msg' => 'Accessories Added Successfully'
            ]); 
         }
         else{
             return response()->json([
                 'status' => false,
                 'errors' => $validator->errors()
             ]);
         }
    }
    public function edit(Request $request, string $id)
    {
        $accessorie = accessorie::find($id);
         
        if(empty($accessorie)){
            $request->session()->flash('error','Accessories not Found');
            return response()->json([
                'status' => false,
                'msg' => 'Accessories Not Found'
             ]);
         return redirect()->route('accessorie');
        }

        
        return view('Admin.accessories.edit',compact('accessorie'));

        return response()->json([
            'status' => true,
            'msg' => 'Product  Found Successfully'
         ]);
        

    }


    public function update(Request $request, string $id)
    {
        $accessorie = accessorie::find($id);
         
        if(empty($accessorie)){
            $request->session()->flash('error','Accessories not Found');
            return response()->json([
                'status' => false,
                'NotFound' => true,
                'msg' => 'Accessories Not Found'
             ]);
        }
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:accessories,slug,'.$accessorie->id.',id',
            'description' => 'required|',
            'price' => 'required|numeric',  
            'is_featured' => 'required|in:Yes,No',    
            'qty' => 'required|numeric',
            'status' => 'required',
         ]);
 
         if($validator->passes()){
            $accessorie->title = $request->title;
            $accessorie->slug = $request->slug;
            $accessorie->description = $request->description;
            $accessorie->price = $request->price;
            $accessorie->is_featured = $request->is_featured;
            $accessorie->qty = $request->qty;
            $accessorie->status = $request->status;
            $accessorie->update();

            $OldImageName = $accessorie->img;

            if(!empty($request->img)){
                
            
                $tempimginfo = tempimage::find($request->img);
                $extArray = explode('.',$tempimginfo->image);
                $ext = last($extArray);
               


                $ImageName = $accessorie->id.'-'.'-'.time().'.'.$ext;
                $accessorie->img = $ImageName;
                $accessorie->save();;


                File::delete(public_path('/uploads/Accessorie/thumb/'.$OldImageName));
                

                // Generate thumbnail

                //large
                $Spath = public_path().'/temp/'.$tempimginfo->image;
                $dpath = public_path().'/uploads/Accessorie/thumb/'.$ImageName;
                $manager = new ImageManager(new Driver());
                $image = $manager->read($Spath);
                $image->cover(550,550);
                $image->save($dpath);
                



            
        }


            $request->session()->flash('success','Accessories Updated Successfully');
            return response()->json([
                'status' => true,
                'msg' => 'Accessories Updated Successfully'
             ]);
        }
         else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }
    public function destroy(string $id,Request $request)
    {
        $accessorie = accessorie::find($id);
        if(empty($accessorie)){
        $request->session()->flash('error','Accessories Not Found');
            return response()->json([
            'status' => false,
            'NotFound' => true,
            ]);
        }

      

        if(!empty($accessorie->img)){
            
            File::delete(public_path('/uploads/Accessorie/thumb/'.$accessorie->img));

          
          
        }
        $accessorie->delete();
        $request->session()->flash('success','Accessories will be Deleted Successfully');
        return response()->json([
            'status' => true,
            'msg' => 'Accessories will be Deleted Successfully',
            ]);

    }
    public function getProduct (Request $request)
    {
      $tempproduct = [];
      if($request->term != ""){
      $products = product::where('title','like','%'.$request->term.'%')->get();
     
       if($products != null){
        foreach($products as $product){
            $tempproduct[] = array('id' => $product->id, 'text' => $product->title);
        }
     }
     }
      return response()->json([
         'tags' => $tempproduct,
         'status' => true,
      ]);
    }
}
