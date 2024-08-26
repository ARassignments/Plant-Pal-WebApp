<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
   
    public function index(Request $request)
    {
        $ratings = Rating::latest('ratings.created_at')->select('ratings.*', 'products.title')->leftJoin('products', 'products.id', '=', 'ratings.product_id');
        $ratings = $ratings->paginate(8);
        return view('Admin.Rating.rating',compact('ratings'));
    }


    public function store(Request $request, $id)
    {


        if(Auth::check() == false){

            if(!session()->has('url.intended')){
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('login');
            
        }
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
           'name' => 'required|min:3',
           'email' => 'required|email',
           'message' => 'required|min:10'
        ]);


        if($validator->passes()){

            $RatingCheck = Rating::where(['user_id' => $user->id , 'product_id' => $id])->first();

            if($RatingCheck != null){
                $error = 'Your Already Comment For This Product';
                $request->session()->flash('error',$error);
    
                return response()->json([
                    'status' => true,
                    'msg' => $error,
                ]);
                
            }

            $rating = new Rating();
            $rating->user_id = $user->id; 
            $rating->product_id = $id; 
            $rating->name = $request->name; 
            $rating->email = $request->email; 
            $rating->message = $request->message; 
            $rating->save();

            $message = 'Your Comment Send Successfully';
            $request->session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'msg' => $message,
            ]);

        }
        else{

            return response()->json([
             'status' => false,
             'errors' => $validator->errors(),
            ]);
        }
    }

   
    
    public function ChangeStatus(Request $request, string $id)
    {
       $rating = Rating::find($id);

       if(empty($rating)){

        $error = "Ratng Not Found";

        $request->session()->flash('error',$error);
          
        return response()->json([
        'status' => false,
        'msg' => $error,
        ]);

       }

     if($rating->status == 0){

        $rating->status = 1;
        $rating->save();

        $status = true;
        $message = "Rating Status Change Successfully";
     }
     else{
        $rating->status = 0;
        $rating->save();

        $status = true;
        $message = "Rating Status Change Successfully";
     }

     $request->session()->flash('success',$message);



     return response()->json([
        'status' => $status,
        'msg' => $message
     ]);
    }

    
    public function destroy(Request $request , string $id)
    {
        $rating = Rating::find($id);

       if(empty($rating)){

        $error = "Ratng Not Found";

        $request->session()->flash('error',$error);
          
        return response()->json([
        'status' => false,
        'msg' => $error,
        ]);

       }

       $rating->delete();



       $status = true;
        $message = "Rating Delete Successfully";

       $request->session()->flash('success',$message);



     return response()->json([
        'status' => $status,
        'msg' => $message
     ]);
    }


    public function show(Request $request , $id){
  
        $rating = Rating::where('ratings.id',$id)->select('ratings.*', 'products.title')->leftJoin('products', 'products.id', '=', 'ratings.product_id')->first();
 

        if(empty($rating)){

            $error = "Ratng Not Found";
            $request->session()->flash('error',$error);
            return redirect()->route('Rating');
        }

        return view('Admin.rating.rating-detail',compact('rating'));
    }
}
