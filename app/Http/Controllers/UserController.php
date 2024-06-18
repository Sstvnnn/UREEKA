<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function registerAPI(Request $request) {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required|in:Admin,Guest',
        ]);
    
        try {
            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);
    
            // Return a success response with the user data
            return response()->json($user, 201);
    
        } catch (\Exception $e) {
    
            // Return an error response
            return response()->json([
                'message' => 'User Registration Failed',
            ], 500);
        }
    }
    
//    public function showRegister() {
//        return view('register');
//    }
//
//    public function register(Request $request) {
//        $users = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => $request->password,
//            'role' => $request->role,
//        ]);
//
//        if ($users) {
////            return response()->json($users);
//            return redirect()->intended('/');
//        }
//    }

    

//    public function showLogin() {
//        return view('login');
//    }
//
//    public function login(Request $request) {
//         $credentials = $request->validate([
//           'email' => ['required', 'email'],
//           'password' => ['required'],
//         ]);
//
//         if (Auth::attempt($credentials)) {
//             $request->session()->regenerate();
//
//             $user = Auth::user();
//
//             if ($user->role == "Admin") {
//                 return redirect()->intended('/admin-dashboard');
//             } else {
//                 return redirect()->intended('/user-dashboard');
//             }
//         }
//
//         return back()->with('loginError', 'Login failed!');
//    }

    public function loginAPI(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $request->session()->regenerate();
            return response()->json([
                'message' => 'Login success!',
                'content' => $user,
            ]);
        }
//
        return response()->json(['error' => 'Login failed!'], 401);
//        return back()->with('loginError', 'Login failed!');
    }

    public function logoutAPI(Request $request) {
        Auth::logout();
        return response()->json(['message' => 'Logged out!'], 200);
    }
}
