<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function register(){
        return view('register');
    }

    public function handleRegister(Request $request){
        
        $validator = Validator::make($request->all(), [
            'username' => 'required', 
            'name' => 'required', 
            'email' => 'required|email|unique:users,email', 
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator) 
                ->withInput(); 
        }

        $user = User::create([
            'username' => $request->username, 
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('login')
                ->with('success', 'User created successfully');
        } else {
            return redirect()->route('register')
                ->with('error', 'Failed to create user');
        }
    }

    public function login(){
        return view('login');
    }

    public function handleLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return redirect()->route('login')
                ->with('error', 'Login failed username or password is incorrect');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('login');
    }

    // Profile
    public function profile(User $user)
    {
        $user = auth()->user(); 
        $posts = Postingan::where('user_id', $user->id)->get(); // Filter posts by user ID
        return view('profile', ['posts' => $posts, 'user' => $user]);
    }

    public function editProfile(User $user)
    {
        return view('profile-edit',['user'=>$user]);
    }
    public function editProfileRequest(Request $request, User $user)
    {
        if(!$request->filled('profile_image')){
            return redirect()->back()->with('error', 'Error. File image Produk Wajib Diisi');
        }elseif(!$request->filled('username')){
            return redirect()->back()->with('error', 'Error. File username Produk Wajib Diisi');
        }elseif(!$request->filled('name')){
            return redirect()->back()->with('error', 'Error. File name Wajib Diisi');
        }
        elseif(!$request->filled('bio')){
            return redirect()->back()->with('error', 'Error. File bio Wajib Diisi');
        }
        
        if($user->user_id === $user->id){
            $user->username = $request->username;
            $user->name = $request->name;
            $user->bio = $request->bio;
            $user->profile_image = $request->profile_image;
        }
        $user->save();
        return redirect()->route('profile', ['user'=>$user->id])->with('message', 'Berhasil update data');
    }
    
    public function confirmPassword(Request $request)
    {
        $password = $request->input('password');
        if (Hash::check($password, Auth::user()->password)) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    

}
