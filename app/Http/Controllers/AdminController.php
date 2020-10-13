<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:super admin');
    }

     public function index()
    {
        $admins = User::whereNotIn('id', [Auth::user()->id])->get();

        return view('admin.index', compact(['admins']));
    }

    public function show($id)
    {
        $admin = User::findOrFail($id);

        return view('admin.show', compact(['admin']));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $admin = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'photo' => 'img/profile/default.png',
            'password' => bcrypt('lapaswanita')
        ]);

        $admin->save();
        $admin->roles()->attach(2);

        return redirect()->route('admin.index');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.edit', compact(['admin']));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        if($id == Auth::user()->id){
            return response()->json(['status'=>"304"]);
        }

        $admin = User::findOrFail($id);
        $admin->delete();

        return response()->json(['status'=>"200", 'id'=>$id]);
    }
}
