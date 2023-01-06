<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/register/employer/{hash}', [RegisteredUserController::class, 'createEmpByInvitationFromCompany'])
    ->middleware('guest')->name('invite.employer');
Route::post('/register/by_invitation', [RegisteredUserController::class, 'createInvitedClient'])
    ->middleware('guest')->name('create.invited.client');

Route::get('/register/employer', [RegisteredUserController::class, 'createEmp'])
    ->middleware('guest')->name('register/employer');

Route::get('/register/company', [RegisteredUserController::class, 'createCompany'])
    ->middleware('guest')->name('register.company');

Route::post('/register/company', [RegisteredUserController::class, 'createCompanyFirst'])
    ->middleware('guest');

Route::get('/register/candidate', [RegisteredUserController::class, 'createCandidate'])
    ->middleware('guest')->name('register/candidate');

Route::post('/register/candidate', [RegisteredUserController::class, 'createCandidateFirst'])
    ->middleware('guest')->name('post-register/candidate');

Route::post('/register/candidate-final', [RegisteredUserController::class, 'createCandidateSecond'])
    ->middleware('guest')->name('final-register/candidate');

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/login/client', [AuthenticatedSessionController::class, 'viewLoginClient'])
    ->middleware('guest')
    ->name('login-client');

Route::post('/login/client', [AuthenticatedSessionController::class, 'loginClient'])
    ->middleware('guest');

Route::get('/forgot-password/client', [PasswordResetLinkController::class, 'viewForgotPasswordClientForm'])
    ->middleware('guest')
    ->name('password.client.request');

Route::get('/login/candidate', [AuthenticatedSessionController::class, 'viewLoginCandidate'])
    ->middleware('guest')
    ->name('login-candidate');

Route::post('/login/candidate', [AuthenticatedSessionController::class, 'loginCandidate'])
    ->middleware('guest');

Route::get('/forgot-password/candidate', [PasswordResetLinkController::class, 'viewForgotPasswordForm'])
    ->middleware('guest')
    ->name('password.candidate.request');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');