<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\KategoriPariwisataController;
use App\Http\Controllers\Dashboard\KecamatanController;
use App\Http\Controllers\Dashboard\ObjekPariwisataController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Wisata\ScheduleController;
use App\Http\Controllers\PageController as PublicPageController;
use App\Http\Controllers\Wisata\UlasanController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PublicPageController::class, 'index'])->name('index');
Route::get('/wisata', [PublicPageController::class, 'listWisata'])->name('public.list_wisata');
Route::get('/wisata/{id}', [PublicPageController::class, 'wisata'])->name('public.wisata');
Route::get('/wisata/{id}/lokasi', [PublicPageController::class, 'lokasi'])->name('public.wisata.lokasi');
Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['guest'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register', [AuthController::class, 'store'])->name('store');

        Route::get('/forgot-password', function () {
            return view('auth.forgot-password');
        })->name('password.request');
        Route::post('/forgot-password', function (Request $request) {
            $request->validate(['email' => 'required|email|exists:users,email']);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with('alert', [
                    'type' => 'success',
                    'message'   => __($status)
                ])
                : back()->withErrors(['email' => __($status)]);
        })->name('password.email');

        Route::get('/reset-password/{token}', function ($token) {
            return view('auth.reset-password', ['token' => $token]);
        })->name('password.reset');

        Route::post('/reset-password', function (Request $request) {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('alert', [
                    'type' => 'success',
                    'message'   => __($status)
                ])
                : back()->withErrors(['email' => [__($status)]]);
        })->name('password.update');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin-page')->group(function () {
        Route::get('/', [PageController::class, 'main'])->name('admin-page');
        Route::resource('kategori', KategoriPariwisataController::class);
        Route::resource('pariwisata', ObjekPariwisataController::class);
        Route::resource('kecamatan', KecamatanController::class);
        Route::resource('user', UserController::class);
        
    });
});
Route::middleware(['auth'])->group(function () {
    Route::resource('jadwal', ScheduleController::class);
    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

