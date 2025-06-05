<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileController;
use App\Http\Requests\UpdateProfileController;
use App\Models\Profile;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function show($id){
        $profile=Profile::where('user_id',$id)->firstOrFail();//بروفايل لون أخضر ضروري استدعي model
        return response()->json($profile,200);
    }

    public function store(StoreProfileController $request) {

        $profile = Profile::create($request->validated());
        return response()->json([
            'massege'=>'profile created sucssfuly',
            'profile'=>$profile
        ],201);
    }
    // public function update(UpdateProfileController $request,$id){
    //     $profile=Profile::FindOrfail($id);
    //     return response()->json($profile,200);

    // }
}
