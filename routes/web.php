<?php

use App\Http\Controllers\SendLetterController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\JobSettingSearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\DocumentController;

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

//Route::get('/get-applicant-resume', [ResumeController::class, 'showApplicantTable'])
//    ->middleware(['auth']);
Route::get('/get-skills', [SkillsController::class, 'list'])
    ->middleware(['auth'])
    ->name('get-skills');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/search-settings', function(){
    return view('search-settings');
})->middleware(['auth'])
    ->name('search-settings');

Route::get('/employer', function(){
    return view('employer');
})->name("employer");


//Profile Routes
Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware(['verified'])
    ->name('profile');

Route::post('/profile', [ProfileController::class, 'update']);
Route::post('/save_picture', [ProfileController::class, 'savePicture'])->name('save-picture');
Route::post('/save_logo', [ProfileController::class, 'saveLogo'])->name('save-logo');


Route::post('/updatepw', [ProfileController::class, 'updatepw'])->name('updatepw');

Route::get('/profile/preview',[ProfileController::class, 'ProfileInf'])
    ->middleware(['auth'])
    ->name('preview-profile-inf');

Route::get('/settings', [SettingsController::class, 'show'])
    ->middleware(['auth'])
    ->name('settings');

Route::get('/vacancies', [JobsController::class, 'showVacant'])
    ->middleware(['auth'])
    ->name('vacancies');

Route::get('/post-job', [JobsController::class, 'postJob'])
    ->middleware(['auth'])
    ->name('post-job');
Route::post('/post-job', [JobsController::class, 'create'])
    ->middleware(['auth'])
    ->name('post-job');

Route::get('/job/{id}', [JobsController::class, 'show'])
    ->middleware(['auth'])
    ->name('job');

Route::post('/job/search/table', [JobsController::class, 'search'])
    ->middleware(['auth']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Resume

Route::get('/my-resume', [ResumeController::class, 'index'])
    ->middleware(['auth']);
Route::post('/my-resume', [ResumeController::class, 'store'])
    ->middleware(['auth']);
Route::put('/my-resume/{id}', [ResumeController::class, 'update'])
    ->middleware(['auth']);
Route::delete('/my-resume/{id?}', [ResumeController::class, 'destroy'])
    ->middleware(['auth']);
Route::post('/my-resume', [ResumeController::class, 'uploadFile'])
    ->middleware(['auth'])
    ->name('upload-my-resume');

Route::get('/resume', [ResumeController::class, 'show'])
    ->middleware(['auth'])
    ->name('resume');
//
//Route::post('/download-resume', [ResumeController::class, 'download'])
//    ->middleware(['auth'])
//    ->name('download-resume');
//
//Route::post( '/delete-resume', [ResumeController::class, 'delete'])
//    ->middleware(['auth'])
//    ->name('delete-resume');
//
//Route::get('/search-resumes', [ResumeController::class, 'search'])
//    ->middleware(['auth'])
//    ->name('search-resumes');

Route::get('/search-settings', [JobSettingSearchController::class, 'show'])
    ->middleware(['auth'])
    ->name('search-settings');
Route::post('/job-search-settings-save', [JobSettingSearchController::class, 'save'])
    ->middleware(['auth'])
    ->name('job-search-settings-save');

Route::post('/upload-resume', [ResumeController::class, 'store'])
    ->middleware(['auth'])
    ->name('upload-resume');

//ITL-6 and ITL-5
Route::get('social-register/{driver}/{user_type?}', [SocialController::class, 'redirectToProvider'])
    ->middleware('guest')
    ->name('social.register');
Route::get('social-login/{driver}', [SocialController::class, 'redirectToProvider'])
    ->middleware('guest')
    ->name('social.login');
Route::get('oauth/{driver}/callback', [SocialController::class, 'handleProviderCallback']);

//Cover Letter ITL-11 AND CV ITL-10
Route::get('/document', [DocumentController::class, 'index'])->middleware(['auth']);
Route::post('/document', [DocumentController::class, 'store'])->middleware(['auth']);
Route::get('/document/{id}', [DocumentController::class, 'edit'])->middleware(['auth']);
Route::put('/document/{id}', [DocumentController::class, 'update'])->middleware(['auth']);
Route::delete('/document/{id?}', [DocumentController::class, 'destroy'])->middleware(['auth']);
Route::get('/document', [DocumentController::class, 'index'])->middleware(['auth']);
Route::post('/upload-document', [DocumentController::class, 'uploadFile'])->middleware(['auth'])->name('upload-document');

Route::post('/save_logo', [ProfileController::class, 'saveLogo'])->name('save-logo');
Route::post('/profile/company', [ProfileController::class, 'updateCompanyProfile'])->name('profile.company');

Route::post('/send-invitation', [SendLetterController::class, 'sendInvitation'])
    ->middleware(['auth'])
    ->name('send-invitation-letter');
require __DIR__.'/auth.php';
