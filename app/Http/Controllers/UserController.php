<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function register(){
        return view('register');
    }

    public function handleRegister(Request $request){
        // Membuat validator untuk memvalidasi data yang diterima dari request
        $validator = Validator::make($request->all(), [
            'username' => 'required', // Field 'username' wajib diisi
            'name' => 'required', // Field 'name' wajib diisi
            'email' => 'required|email|unique:users,email', // Field 'email' wajib diisi, harus berformat email, dan unik di tabel 'users'
            'password' => 'required|min:8|confirmed', // Field 'password' wajib diisi, minimal 8 karakter, dan harus dikonfirmasi
            // 'bio' => 'nullable', // Field 'gender' wajib diisi, harus bernilai 'male' atau 'female'
            // 'profil_image' => 'nullable', // Field 'age' wajib diisi, harus berupa bilangan bulat, dan minimal 1
        ]);

        // Mengecek apakah validasi gagal
        if ($validator->fails()) {
            // Jika validasi gagal, arahkan kembali ke halaman 'register'
            // dengan pesan kesalahan dan input sebelumnya
            return redirect()->route('register')
                ->withErrors($validator) // Mengirim pesan kesalahan ke view
                ->withInput(); // Mengirim kembali input yang sudah diisi
        }

        // Membuat pengguna baru dengan data yang valid
        $user = User::create([
            'username' => $request->username, // Mengisi field 'name' dengan data dari request
            'name' => $request->name, // Mengisi field 'name' dengan data dari request
            'email' => $request->email, // Mengisi field 'email' dengan data dari request
            'password' => Hash::make($request->password), // Mengenkripsi password sebelum disimpan
        ]);

        // $user = User::where('email', $request->email)->first();
        // $user->assignRole('user');

        // Mengecek apakah pengguna berhasil dibuat
        if ($user) {
            // Jika berhasil, arahkan kembali ke halaman 'register'
            // dengan pesan sukses
            return redirect()->route('login')
                ->with('success', 'User created successfully');
        } else {
            // Jika gagal, arahkan kembali ke halaman 'register'
            // dengan pesan error
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
        $user = auth()->user(); // Retrieve the currently logged-in user
        $posts = Postingan::where('user_id', $user->id)->get(); // Filter posts by user ID
        return view('profile', ['posts' => $posts, 'user' => $user]);
    }

     // Relasi untuk pengguna yang diikuti (following)
     public function following()
     {
         return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
     }
 
     // Relasi untuk pengguna yang mengikuti (followers)
     public function followers()
     {
         return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
     }
}
