<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/connexion', [AuthController::class, 'index'])->name('login');
Route::get('/deconnexion', [AuthController::class, 'logout'])->name('logout');
Route::post('/authentification', [AuthController::class, 'authNormal'])->name('auth_normal');
Route::get('/inscription', [AuthController::class, 'register'])->name('register');
Route::post('/creation-utilisateur', [AuthController::class, 'createNewUser'])->name('user_creation');
Route::get('/compte-a-confirmer/{email}', [AuthController::class, 'userCreatedConfirmEmail'])->name('user_created_confirm_email');
Route::get('/confirmer-email/{email}/{token}', [AuthController::class, 'confirmEmail'])->name('confirm_email');
Route::match(['post', 'get'], '/mot-de-passe-oublie', [AuthController::class, 'forgot'])->name('password_forgot');
Route::match(['post', 'get'], '/reinitialisation/{email}/{token}', [AuthController::class, 'reset'])->name('password_reset');

Route::prefix('google/authentification')->group(function () {
    Route::get('/', [GoogleController::class, 'auth'])->name('auth_google');
    Route::get('/redirection', [GoogleController::class, 'redirect'])->name('auth_google_redirect');
});

Route::prefix('trajet')->group(function () {
    Route::get('/ajouter', [RideController::class, 'add'])->name('ride_add');
    Route::post('/enregistrer', [RideController::class, 'save'])->name('ride_save');
    Route::get('/trajet-cree/{ride}', [RideController::class, 'complete'])->name('ride_complete');
    Route::get('/search', [RideController::class, 'search'])->name('ride_search');
});

Route::prefix('google')->group(function () {
    Route::get('/directions', [GoogleController::class, 'directions'])->name('google_directions');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::prefix('pages')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('pages_index');
        Route::get('/charte-confidentialite-et-cookies', [PageController::class, 'charteConfidentialiteEtCookie'])->name('pages_charte_cookie');
        Route::get('/conditions-utilisation', [PageController::class, 'conditionUtilisation'])->name('pages_condition_utilisation');
        Route::get('/contact', [PageController::class, 'contact'])->name('pages_contact');
        Route::get('/newsletter', [PageController::class, 'newsletter'])->name('pages_newsletter');
        Route::get('/nos-valeurs', [PageController::class, 'nosValeurs'])->name('pages_nosValeurs');
        Route::get('/qui-sommes-nous', [PageController::class, 'quiSommesNous'])->name('pages_qui_sommes_nous');
        Route::get('/reglement-trajet', [PageController::class, 'reglementTrajet'])->name('pages_reglement_trajet');

        Route::post('/enregistrer/{slug}', [PageController::class, 'saveBySlug'])->name('pages_save_by_slug');
    });
});

// FRONT OFFICE PAGE
Route::get('/{slug}', [HomeController::class, 'staticPage'])->name('static_pages');
