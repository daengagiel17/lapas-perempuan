<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = User::findOrFail(Auth::user()->id);

        // foreach(Auth::user()->roles as $key => $role){
        //     dd($role);
        // }

        return view('profile.show', compact(['user']));
    }

    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);
        
        return view('profile.edit', compact(['user']));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        if ($request->hasFile('photo')) {
            $dir = 'img/profile/';
            if (($user->photo != '') && ($user->photo != 'img/profile/default.png') && (File::exists($user->photo))){
                File::delete($user->photo);
            }
            $extension = strtolower($request->file('photo')->getClientOriginalExtension()); // get image extension
            $fileName = str_random() . '.' . $extension; // rename image
            $request->file('photo')->move($dir, $fileName);
            $user->photo = $dir . $fileName;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();
        
        return redirect()->route('profile.show');
    }

}
