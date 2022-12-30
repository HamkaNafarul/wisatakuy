<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function auth(UserAuthRequest $request)
    {
        $credentials = $request->validated();
        if (filter_var($credentials['email_username'], FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $credentials['email_username'], 'password' => $credentials['password']]);
        } else {
            Auth::attempt(['username' => $credentials['email_username'], 'password' => $credentials['password']]);
        }

        if (Auth::check()) {
            $request->session()->regenerate();
            if (Auth::user()->is_admin) {
                // return $credentials;
                return redirect()->route('admin-page');
            }
            return redirect()->route('index');
        }
        // return  $credentials[0];

        $alert = [
            'type'  => 'danger',
            'message'   => 'Login Gagal. Data tidak sesuai.'
        ];
        return back()->withInput()->with('alert', $alert);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $user           = new User();
        $user->name     = $data['name'];
        $user->username = $data['username'];
        $user->email    = $data['email'];
        $user->password = Hash::make($data['password']);
        if ($user->save()) {
            $alert = [
                'type'      => 'success',
                'message'   => 'Pendaftaran berhasil. Silahkan login.'
            ];
            return redirect()->route('login')->with('alert', $alert);
        } else {
            $alert = [
                'type'      => 'danger',
                'message'   => 'Pendaftaran gagal.'
            ];
            return back()->withInput()->with('alert', $alert);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
