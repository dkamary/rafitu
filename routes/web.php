<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
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
    Route::get('/search', [SearchController::class, 'search'])->name('ride_search');
    Route::get('/list', [RideController::class, 'list'])->name('ride_list');

    Route::get('/{ride}', [RideController::class, 'show'])->name('ride_show'); // Doit toujours être à la fin!
});

Route::prefix('google')->group(function () {
    Route::get('/directions', [GoogleController::class, 'directions'])->name('google_directions');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    // PAGES STATIC
    Route::prefix('pages')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('pages_index');
        Route::get('/charte-confidentialite-et-cookies', [PageController::class, 'charteConfidentialiteEtCookie'])->name('pages_charte_cookie');
        Route::get('/conditions-utilisation', [PageController::class, 'conditionUtilisation'])->name('pages_condition_utilisation');
        Route::get('/contact', [PageController::class, 'contact'])->name('pages_contact');
        Route::get('/newsletter', [PageController::class, 'newsletter'])->name('pages_newsletter');
        Route::get('/nos-valeurs', [PageController::class, 'nosValeurs'])->name('pages_nosValeurs');
        Route::get('/qui-sommes-nous', [PageController::class, 'quiSommesNous'])->name('pages_qui_sommes_nous');
        Route::get('/reglement-trajet', [PageController::class, 'reglementTrajet'])->name('pages_reglement_trajet');
        Route::get('/faq', [PageController::class, 'faq'])->name('pages_faq');

        Route::post('/enregistrer/{slug}', [PageController::class, 'saveBySlug'])->name('pages_save_by_slug');
    });

    // BLOG
    Route::prefix('blog')->group(function() {
        Route::get('/', [BlogController::class, 'index'])->name('admin_blog_index');
        Route::match(['get', 'post'], '/new', [BlogController::class, 'createNew'])->name('admin_blog_new');
        Route::match(['get', 'post'], '/edit/{page}', [BlogController::class, 'edit'])->name('admin_blog_edit');
        Route::get('/delete/{page}', [BlogController::class, 'archive'])->name('admin_blog_delete');
    });

    // USERS
    Route::prefix('users')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('admin_user_index');
        Route::match(['get', 'post'], '/new', [UserController::class, 'create'])->name('admin_user_new');
        Route::match(['get', 'post'], '/edit/{user}', [UserController::class, 'edit'])->name('admin_user_edit');
        Route::get('/deactivate/{user}', [UserController::class, 'deactivate'])->name('admin_user_deactivate');
        Route::post('/mot-de-passe', [UserController::class, 'updatePassword'])->name('admin_user_update_password');
    });

    // FAQ
    Route::prefix('faq')->group(function(){
        Route::post('/save', [FaqController::class, 'save'])->name('admin_faq_save');
        Route::post('/refresh', [FaqController::class, 'refresh'])->name('admin_faq_refresh');
        Route::get('/remove/{faq}', [FaqController::class, 'remove'])->name('admin_faq_remove');
    });
});

// CONTACT
Route::prefix('contact')->group(function(){
    Route::post('/enregistrement', [ContactController::class, 'submit'])->name('contact_submit');
    Route::get('/confirmation', [ContactController::class, 'confirmation'])->name('contact_confirmation');
});

// RESERVATION
Route::prefix('reservation')->group(function(){
    Route::post('/submit', [ReservationController::class, 'submit'])->name('reservation_submit');
    Route::get('/result/{reservation}', [ReservationController::class, 'result'])->name('reservation_result');

    Route::get('/{reservation}', [ReservationController::class, 'show'])->name('reservation_show');
});

// ESPACE CLIENT
Route::prefix('espace-client')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard_index');
    Route::match(['get', 'post'], '/mon-profil', [DashboardController::class, 'user'])->name('dashboard_user');
    Route::post('/mot-de-passe', [DashboardController::class, 'password'])->name('dashboard_update_password');
    Route::get('/mes-trajets', [DashboardController::class, 'rides'])->name('dashboard_rides');
    Route::get('/trajet/{ride}', [DashboardController::class, 'rideShow'])->name('dashboard_ride');
    Route::prefix('messenger')->group(function(){
        Route::get('/', [DashboardController::class, 'messengerIndex'])->name('dashboard_messenger_index');
        Route::get('/{message}', [DashboardController::class, 'messengerShow'])->name('dashboard_messenger_show');
        Route::get('/new-message/{lastId}', [DashboardController::class, 'messengerLast'])->name('dashboard_messenger_last');
        Route::post('/send-message', [DashboardController::class, 'messengerSend'])->name('dashboard_messenger_send');
    });
    Route::prefix('/voiture')->group(function(){
        Route::get('/', [DashboardController::class, 'vehicleIndex'])->name('dashboard_vehicle_index');
        Route::match(['get', 'post'], '/ajouter', [DashboardController::class, 'vehicleAdd'])->name('dashboard_vehicle_add');
        Route::match(['get', 'post'], '/editer/{vehicle}', [DashboardController::class, 'vehicleEdit'])->name('dashboard_vehicle_edit');
        Route::post('/effacer', [DashboardController::class, 'vehicleRemove'])->name('dashboard_vehicle_remove');
    });
});

// FRONT OFFICE PAGE
Route::get('/{slug}', [HomeController::class, 'staticPage'])->name('static_pages');
