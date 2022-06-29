<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hadith;
use App\Models\Level;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use GeneralTrait;

    public function index(){
        $users = User::all();
        return $this-> returnData('users', $users);
    }

    public function register(Request $request){

        $request->validate([
            'Fname' => 'required',
            'Lname' => '',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
            'age' => '',
            'image'=>'',
            'path' => ''
        ]);
        $user = new User([
            'Fname' => $request->get('Fname'),
            'Lname' => $request->get('Lname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'age' => $request->get('age'),
            'path'=> $request->get('path'),
            'image'=> $request->get('image')
        ]);
        if ($request->has('path')) {
            $name= uploadImage('profileImages', $request->path);
            $user->image=$name;
            $user->path = $user->getPhotoAttribute($name);
        }

        $user->save();
        // creating the token 
        $token = $user->createToken('hadithToken')->plainTextToken;
        //return the user data with token
        return $this->returnDataWithToken('user', $user, 'token', $token, "201");

    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //check email
        $user = User::where('email', $request->get('email'))->first();

        //check password
        if(!$user || !Hash::check($request->get('password'), $user->password)) {
            return $this->returnError(401, "bad creds");
        }
        // creating the token 
        $token = $user->createToken('hadithToken')->plainTextToken;
        //return the user data with token
        return $this->returnDataWithToken('user', $user, 'token', $token, "201"); 
    }

    public function logout(){
          /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();
        $user->tokens()->delete();
        // auth()->user()->tokens()->delete();
        return $this->returnSuccessMessage("logged out.."); 
    }
    

    //upload user profile picture
    // public function uploadPhoto( Request $request , $id){
    //     $user = User::findOrFail($id);
    //     $request-> validate([
    //         'path' => 'required|image'
    //     ]);
    //     $name = $request->file('path')->getClientOriginalName();
    //     $path = $request->file('path')->store('public');
    //     $request->path->move($path, $name);
    //     $user->image=$user->id.$name;
    //     $user->path = $path;
    //     $user->save();
    //     return $this-> returnData('user', $user);
    // }

     public function uploadPhoto( Request $request , $id){
        $user = User::findOrFail($id);
        $request-> validate([
            'path' => 'required|image'
        ]);
        $name= uploadImage('profileImages', $request->path);
        $user->image=$name;
        $user->path = $user->getPhotoAttribute($name);
        $user->save();
        return $this-> returnData('user', $user);
    }



    //here the part of adding a hadith to favorite
    public function attachHadith($userId ,$hadithId){
        $user = User::findOrFail($userId);
        $hadith = Hadith::findOrFail($hadithId);
        if (! $user->hadiths->contains($hadith->id)) {
            $user -> hadiths()-> attach($hadith,['isFavorite'=>true]);
            return $this->returnSuccessMessage("added a hadith to favorites..");
        }
        return $this->returnSuccessMessage("already exists in favorites..");
    }

    
    //removing a Hadith from favorites
    public function detachHadith($userId ,$hadithId){
        $user = User::findOrFail($userId);
        $hadith = Hadith::findOrFail($hadithId);
        $user -> hadiths()-> detach($hadith);
        return $this->returnSuccessMessage("removed a hadith from favorites..");
    }


    //get all favorite hadiths for a user
    public function favorites($id){
        $user =  User::findOrFail($id);
        $favorites = $user->hadiths;
        return $this->returnData('favorites', $favorites);
    }


     //here the part of adding a grade to a level for a specific user
     public function attachGrade($userId ,$levelId, Request $request){
        $user = User::findOrFail($userId);
        $level = Level::findOrFail($levelId);
        $user -> levels()-> attach($level,['grade'=>$request->get('grade')]);
        $level->grade = $request->get('grade');
        $level->save();
        return $this->returnSuccessMessage("added a grade to that user..");
    }


     //get all levels for a user
     public function grades($id){
        $user =  User::findOrFail($id);
        $grades = $user->levels;
        return $this->returnData('grades', $grades);
    }

}
