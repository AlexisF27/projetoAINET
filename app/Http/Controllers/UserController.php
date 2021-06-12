<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    //
    public function admin_index(){
        $todosUsers = User::paginate(10);
        return view('users.admin', compact('todosUsers'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function profile(User $user)
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function update(User $user)
    {
        $request = request();


        $profileImage = $request->file('profile_picture');
        if ($profileImage!=null){
            $profileImageSaveAsName = time() . "profileD." . $profileImage->getClientOriginalExtension();
            $upload_path = 'storage/fotos/';
        $profile_image_url = $profileImageSaveAsName;
        $success = $profileImage->move($upload_path, $profileImageSaveAsName);

        }
        else
        {
            $profileImageSaveAsName= $user->foto_url;
        }



        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->foto_url = $profileImageSaveAsName;



        $user->save();

        return back();
    }
}
