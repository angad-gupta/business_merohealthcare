<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Order;
use Carbon\Carbon;
use App\User;

class UserController extends Controller
{
    public function orders()
    {
        // return "asd";
        $user = Auth::user();
        $orders = Order::where('user_id','=',$user->id)->where('status','!=','pending')->orderBy('id','desc')->get();
        return response()->json(['orders'=>$orders],200);
    }

    public function getProfile()
    {
    	$user =User::findOrFail(Auth::user()->id);
        return response()->json(['user'=>$user],200);
    }

    public function saveProfile(Request $request)
    {
        $d = Carbon::parse($request->dob)->format('Y-m-d');
        // dd($d);
        $this->validate($request, [
            "name" => "required",
            "pan_number" => 'nullable|numeric',
            "address_type" => "required",
            "gender" => "required",
            // "nearest_landmark" => "required",
            "address" => "required",
            "phone" => "required",
            // "city" => "required"
        ]);

        $input = $request->all();
        // dd($request);

        $user = Auth::user();
        if ($file = $request->file('photo'))
        {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);
            if($user->photo != null)
            {
                    if (file_exists(public_path().'/assets/images/'.$user->photo)) {
                        unlink(public_path().'/assets/images/'.$user->photo);
                    }
            }
            
            $input['photo'] = $name;
        }

        $profile = User::findOrFail($user->id);
        $profile->gender = $request->gender;
        $profile->dob = $d;
        $profile->save(); 

        // $input['gender'] = $gender;

        $user->update($input);
        $data['success'] = true;
        return response()->json($data,200);
    }

}
