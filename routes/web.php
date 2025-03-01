<?php

use App\Http\Controllers\Auth\UpdatePasswordController;
use App\Http\Controllers\CommonLetterLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LetterLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [LandingPageController::class, "index"])->name("landing-page");

Auth::routes(["register" => false, "confirm" => false, "reset" => false]);

Route::middleware(["auth", "prevent_back", "throttle:60,1"])->group(function () {
    /**
     * data akun
     */
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::put("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::put("/password/update", [UpdatePasswordController::class, "update"])->name("password.change");

    Route::middleware(["completed_profile"])->group(function () {
        Route::get("/dashboard", [HomeController::class, "dashboard"])->name("dashboard");

        Route::group(["middleware" => ["permission:users_manage"]], function () {
            /**
             * data user
             */
            Route::resource('user', UserController::class)->except("edit", "show", "update");
        });

        Route::group(["middleware" => ["permission:letters_manage"]], function () {
            /**
             * data surat
             */
            Route::get("/surat", [CommonLetterLogController::class, "index"])->name("letter.common.index");
            Route::get("/surat/{slug}", [CommonLetterLogController::class, "listIndex"])->name("letter.common.show");

            Route::delete("/surat/{commonLetterLog}", [CommonLetterLogController::class, "destroy"])->name("letter.common.destroy");

            Route::post("/surat", [CommonLetterLogController::class, "store"])->name("letter.common.store");
            Route::post("/surat/{slug}", [CommonLetterLogController::class, "storeSlug"])->name("letter.common.store.slug");

            Route::put("/surat/{commonLetterLog}", [CommonLetterLogController::class, "update"])->name("letter.common.update");
            Route::put("/surat/{commonLetterLog}/api", [CommonLetterLogController::class, "APIUpdate"])->name("api.letter.common.update");


            /**
             * data rincian surat
             */
            Route::get("/surat/{commonLetterLog}/input", [LetterLogController::class, "create"])->name("letter.log.create");
            Route::post("/surat/{commonLetterLog}/input", [LetterLogController::class, "store"])->name("letter.log.store");
            Route::put("/surat/{commonLetterLog}/publish", [LetterLogController::class, "storeAndPublish"])->name("letter.log.publish");

            /**
             * Download/Lihat Surat
             */
            Route::post("/surat/{commonLetterLog}/download", [CommonLetterLogController::class, "download"])->name("letter.common.download");
            Route::post("/surat/{commonLetterLog}/preview", [CommonLetterLogController::class, "preview"])->name("letter.common.preview");
        });
    });
});

Route::get('/forgot-password', function () {
    return view('authentication.forgot');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('authentication.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
