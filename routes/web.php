<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandAdminController;
use App\Http\Controllers\CinetPayController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactAdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverAdminController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FunfactController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ModelAdminController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PreReservationAdminController;
use App\Http\Controllers\ReservationAdminController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewAdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RideAdminController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialNetworkParameterAdminController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehiculeAdminController;
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

    // Auth required
    Route::get('/ajouter', [RideController::class, 'add'])
        ->middleware('auth')
        ->name('ride_add');
    Route::post('/enregistrer', [RideController::class, 'save'])
        ->middleware('auth')
        ->name('ride_save');
    Route::get('/trajet-cree/{ride}', [RideController::class, 'complete'])
        ->middleware('auth')
        ->name('ride_complete');

    // No auth Required
    Route::get('/search', [SearchController::class, 'search'])->name('ride_search');
    Route::get('/list', [RideController::class, 'list'])->name('ride_list');
    Route::post('/reservation', [SearchController::class, 'match'])->name('ride_match');
    Route::get('/reservation', [SearchController::class, 'matchResult'])->name('ride_match_result');

    Route::get('/point-de-depart/{ride}', [RideController::class, 'detailsDepart'])->name('ride_show_departure');
    Route::get('/point-d-arrivee/{ride}', [RideController::class, 'detailsArrivee'])->name('ride_show_arrival');
    Route::get('/chauffeur/{ride}', [RideController::class, 'detailsChauffeur'])->name('ride_driver');

    Route::get('/{ride}', [RideController::class, 'show'])->name('ride_show');

});

Route::prefix('google')->group(function () {
    Route::get('/directions', [GoogleController::class, 'directions'])->name('google_directions');
});

// BACK OFFICE
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
        Route::get('/mentions-legales', [PageController::class, 'mentionsLegales'])->name('pages_mentions_legales');

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
        Route::post('/info', [FaqController::class, 'info'])->name('admin_faq_info');
    });

    // CHAUFFEUR
    Route::prefix('drivers')->group(function(){
        Route::get('/', [DriverAdminController::class, 'index'])->name('admin_driver_index');
        Route::get('/list', [DriverAdminController::class, 'list'])->name('admin_driver_list');
        Route::get('/{driver}', [DriverAdminController::class, 'show'])->name('admin_driver_show');
        Route::get('/validate/{driver}', [DriverAdminController::class, 'validateDriver'])->name('admin_driver_validate');
        Route::post('/effacer', [DriverAdminController::class, 'remove'])->name('admin_driver_remove');
    });

    // VEHICULE
    Route::prefix('vehicule')->group(function(){
        Route::get('/', [VehiculeAdminController::class, 'index'])->name('admin_vehicule_index');
        Route::get('/nouveau', [VehiculeAdminController::class, 'nouveau'])->name('admin_vehicule_new');
        Route::post('/sauvegarder', [VehiculeAdminController::class, 'sauvegarder'])->name('admin_vehicule_save');
        Route::post('/effacer', [VehiculeAdminController::class, 'effacer'])->name('admin_vehicule_delete');
        Route::get('/editer/{vehicule}', [VehiculeAdminController::class, 'editer'])->name('admin_vehicule_editer');

        // MARQUES
        Route::prefix('marque')->group(function(){
            Route::get('/', [BrandAdminController::class, 'index'])->name('admin_brand_index');
            Route::get('/nouveau', [BrandAdminController::class, 'nouveau'])->name('admin_brand_nouveau');
            Route::post('/sauvegarder', [BrandAdminController::class, 'sauvegarder'])->name('admin_brand_sauvegarder');
            Route::post('/effacer', [BrandAdminController::class, 'effacer'])->name('admin_brand_effacer');
            Route::match(['get', 'post'], '/editer/{brand}', [BrandAdminController::class, 'editer'])
                ->name('admin_brand_editer')
                ->where('brand', '[0-9]+');

            // MODELE
            Route::prefix('modele')->group(function(){
                Route::get('/{brand}', [ModelAdminController::class, 'index'])
                    ->name('admin_model_index')
                    ->where('brand', '[0-9]+');
                Route::get('/{brand}/nouveau', [ModelAdminController::class, 'nouveau'])
                    ->name('admin_model_nouveau')
                    ->where('brand', '[0-9]+');
                Route::post('/{brand}/sauvegarder', [ModelAdminController::class, 'sauvegarder'])
                    ->name('admin_model_sauvegarder')
                    ->where('brand', '[0-9]+');
                Route::post('/{brand}/effacer', [ModelAdminController::class, 'effacer'])
                    ->name('admin_model_effacer')
                    ->where('brand', '[0-9]+');
                Route::get('/{brand}/editer/{model}', [ModelAdminController::class, 'editer'])
                    ->name('admin_model_editer')
                    ->where('brand', '[0-9]+');
            });
        });
    });

    // CONTACT
    Route::prefix('contact')->group(function(){
        Route::match(['get', 'post'], '/', [ContactAdminController::class, 'index'])->name('admin_contact_index');
    });

    // TRANSACTIONS
    Route::prefix('transactions')->group(function(){
        Route::get('/paiements', [AdminTransactionController::class, 'paiements'])->name('transaction_paiements');
        Route::match(['get', 'post',], '/commissions', [AdminTransactionController::class, 'commissions'])->name('transaction_commissions');
        Route::match(['get', 'post',], '/commissions-pay', [AdminTransactionController::class, 'commissions_pay'])->name('transaction_commissions_pay');
        Route::get('/remboursements', [AdminTransactionController::class, 'remboursements'])->name('transaction_remboursements');
        Route::get('/mode-de-paiements', [AdminTransactionController::class, 'modePaiements'])->name('transaction_mode_de_paiements');
        Route::post('/mode-de-paiements/cinetpay', [AdminTransactionController::class, 'updateCinetPay'])->name('transaction_mode_de_paiements_cinetpay');
        Route::post('/mode-de-paiements/paypal', [AdminTransactionController::class, 'updatePaypal'])->name('transaction_mode_de_paiements_paypal');
    });

    // TRAJET
    Route::prefix('trajet')->group(function(){
        Route::get('/', [RideAdminController::class, 'index'])->name('admin_ride_index');
        Route::get('/a-valider', [RideAdminController::class, 'toValidate'])->name('admin_ride_validation');
        Route::post('valider', [RideAdminController::class, 'validation'])->name('admin_ride_validate');
        Route::get('/afficher/{ride}', [RideAdminController::class, 'show'])->name('admin_ride_show');
        Route::post('/sauvegarder', [RideAdminController::class, 'save'])->name('admin_ride_save'); // JSON
        Route::post('/effacer', [RideAdminController::class, 'remove'])->name('admin_ride_remove'); // JSON
        Route::match(['get', 'post'], '/parametres', [RideAdminController::class, 'parameters'])->name('admin_ride_parameters');
        Route::get('/republier/{ride}', [RideAdminController::class, 'republish'])->name('admin_ride_republish');
    });

    // PRERESERVATION
    Route::prefix('prereservation')->group(function(){
        Route::get('/', [PreReservationAdminController::class, 'index'])->name('admin_prereservation_index');
        Route::get('/edit/{prereservation}', [PreReservationAdminController::class, 'edit'])->name('admin_prereservation_edit');
        Route::post('/save/{prereservation}', [PreReservationAdminController::class, 'save'])->name('admin_prereservation_save');
    });

    // RESERVATION
    Route::prefix('reservation')->group((function() {
        Route::get('/', [ReservationAdminController::class, 'allReservation'])->name('admin_reservation_all');
        Route::get('/payee', [ReservationAdminController::class, 'paidReservation'])->name('admin_reservation_paid');
        Route::get('/impayee', [ReservationAdminController::class, 'unpaidReservation'])->name('admin_reservation_unpaid');
        Route::get('/annulee', [ReservationAdminController::class, 'canceledReservation'])->name('admin_reservation_canceled');
        Route::get('/effacee', [ReservationAdminController::class, 'deletedReservation'])->name('admin_reservation_deleted');
        Route::get('/details/{reservation}', [ReservationAdminController::class, 'details'])->name('admin_reservation_details');
        Route::post('/cancel/{reservation}', [ReservationAdminController::class, 'cancel'])->name('admin_reservation_cancel');
        Route::post('/delete/{reservation}', [ReservationAdminController::class, 'remove'])->name('admin_reservation_delete');
    }));

    // Social network
    Route::prefix('reseaux-sociaux')->group(function(){
        Route::get('/', [SocialNetworkParameterAdminController::class, 'index'])->name('admin_social_network_parameter_index');
        Route::post('/save', [SocialNetworkParameterAdminController::class, 'save'])->name('admin_social_network_parameter_save');
    });

    // Paramètres
    Route::prefix('parametres')->group(function(){
        Route::get('/', [AdminController::class, 'parameters'])->name('admin_parameters_index');
    });

    // Funfact
    Route::prefix('faits-amusants')->group(function(){
        Route::get('/', [FunfactController::class, 'index'])->name('admin_funfact_index');
        Route::get('/nouveau', [FunfactController::class, 'create'])->name('admin_funfact_new');
        Route::get('/editer/{funfact}', [FunfactController::class, 'edit'])->name('admin_funfact_edit');
        Route::post('/sauvegarde', [FunfactController::class, 'save'])->name('admin_funfact_save');
        Route::post('/effacer', [FunfactController::class, 'remove'])->name('admin_funfact_remove');
    });

    // Commentaires
    Route::prefix('commentaires')->group(function(){
        Route::get('/', [ReviewAdminController::class, 'index'])->name('admin_review_index');
        Route::get('/afficher/{review}', [ReviewAdminController::class, 'show'])->name('admin_review_show');
        Route::post('/desactiver', [ReviewAdminController::class, 'deactivate'])->name('admin_review_deactivate');
        Route::post('/valider', [ReviewAdminController::class, 'validation'])->name('admin_review_validate');
    });

    // Uploads
    Route::prefix('upload')->group(function(){
        Route::get('/', [UploadController::class, 'index'])->name('admin_upload_index');
        Route::post('/televerser', [UploadController::class, 'upload'])->name('admin_upload_upload');
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
    Route::post('/annulation', [ReservationController::class, 'cancel'])->name('reservation_cancel');
    Route::get('/annulee/{reservation}', [ReservationController::class, 'canceled'])->name('reservation_canceled');

    Route::get('/{reservation}', [ReservationController::class, 'show'])->name('reservation_show');
});

// MESSAGE
Route::prefix('message')->group(function(){
    Route::post('/send', [MessageController::class, 'send'])->name('message_send');
    Route::get('/last-message', [MessageController::class, 'lastMessage'])->name('message_last');
    Route::get('/conversation', [MessageController::class, 'conversation'])->name('message_conversation');
    Route::post('/start/{driver}', [MessageController::class, 'startChatWith'])->name('message_start_chat');
    Route::post('/seen', [MessageController::class, 'seen'])->name('message_seen');
    Route::post('/remove', [MessageController::class, 'remove'])->name('message_remove');
});

// ESPACE CLIENT
Route::prefix('espace-client')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard_index');
    Route::match(['get', 'post'], '/mon-profil', [DashboardController::class, 'user'])->name('dashboard_user');
    Route::post('/mot-de-passe', [DashboardController::class, 'password'])->name('dashboard_update_password');
    Route::get('/mes-reservations', [DashboardController::class, 'reservations'])->name('dashboard_reservations');
    Route::get('/trajet/{reservation}', [DashboardController::class, 'reservationShow'])->name('dashboard_reservation_show');
    Route::prefix('messenger')->group(function(){
        Route::get('/', [DashboardController::class, 'messengerIndex'])->name('dashboard_messenger_index');
        Route::get('/{token}', [DashboardController::class, 'messengerShow'])->name('dashboard_messenger_show');
        Route::get('/new-message/{lastId}', [DashboardController::class, 'messengerLast'])->name('dashboard_messenger_last');
        Route::post('/send-message', [DashboardController::class, 'messengerSend'])->name('dashboard_messenger_send');
        Route::post('/effacer-conversation', [DashboardController::class, 'messengerRemove'])->name('dashboard_messenger_remove');
    });
    Route::prefix('/voiture')->group(function(){
        Route::get('/', [DashboardController::class, 'vehicleIndex'])->name('dashboard_vehicle_index');
        Route::match(['get', 'post'], '/ajouter', [DashboardController::class, 'vehicleAdd'])->name('dashboard_vehicle_add');
        Route::match(['get', 'post'], '/editer/{vehicle}', [DashboardController::class, 'vehicleEdit'])->name('dashboard_vehicle_edit');
        Route::post('/effacer', [DashboardController::class, 'vehicleRemove'])->name('dashboard_vehicle_remove');
    });
});

// PAIEMENT
Route::prefix('paiement')->group(function(){

    Route::match(['get', 'post'], '/paypal/pay', [PaypalController::class, 'pay'])->name('paypal_pay');
    Route::match(['get', 'post'], '/paypal/notification', [PaypalController::class, 'notification'])->name('paypal_notification');
    Route::match(['get', 'post'], '/paypal/accepte', [PaypalController::class, 'success'])->name('paypal_success');
    Route::match(['get', 'post'], '/paypal/annule', [PaypalController::class, 'cancel'])->name('paypal_cancel');
    Route::match(['get', 'post'], '/paypal/echec', [PaypalController::class, 'fail'])->name('paypal_fail');

    Route::match(['get', 'post'], '/cinetpay/pay', [CinetPayController::class, 'pay'])->name('cinetpay_pay');
    Route::match(['get', 'post'], '/cinetpay/notification', [CinetPayController::class, 'notification'])->name('cinetpay_notification');
    Route::match(['get', 'post'], '/cinetpay/accepte', [CinetPayController::class, 'success'])->name('cinetpay_success');
    Route::match(['get', 'post'], '/cinetpay/retour', [CinetPayController::class, 'retour'])->name('cinetpay_return');
    Route::match(['get', 'post'], '/cinetpay/annule', [CinetPayController::class, 'cancel'])->name('cinetpay_cancel');
    Route::match(['get', 'post'], '/cinetpay/echec', [CinetPayController::class, 'fail'])->name('cinetpay_fail');
    Route::match(['get', 'post'], '/cinetpay/transfert', [CinetPayController::class, 'transfert'])->name('cinetpay_transfert');

});

// CITY
Route::prefix('ville')->group(function(){
    Route::get('/list/{page?}/{count?}', [CityController::class, 'index'])->name('city_list');
    Route::get('/search/{search}/{count?}', [CityController::class, 'search0'])->name('city_search0');
    // Route::get('/search2/{search}/{count?}', [CityController::class, 'searchInText'])->name('city_search2');

    Route::post('/search', [CityController::class, 'search'])->name('city_search');
    Route::post('/search-ride', [CityController::class, 'searchRide'])->name('city_search_ride');
});

// SUGGESTIONS
Route::prefix('suggestions')->group(function() {
    Route::get('/trajet', [SuggestionController::class, 'trajet'])->name('suggestion_trajet');
    Route::get('/villes', [SuggestionController::class, 'ville'])->name('suggestion_ville');
});

// VERIFICATION CHAUFFEUR
Route::prefix('chauffeur')->group(function(){
    Route::match(['get', 'post'], '/verification', [DriverController::class, 'verification'])->name('driver_verification');

    Route::get('/deja-verifier', function(){
        return view('pages.ride.already-verified');
    })->name('driver_already_verified');

    Route::get('/verification-en-cours', function(){
        return view('pages.ride.verification-in-process');
    })->name('driver_verification_in_progress');

    Route::get('/{driver}', [DriverController::class, 'show'])->name('driver_show');
});

// NEWSLETTER
Route::prefix('newsletter')->group(function(){
    Route::post('/soumettre', [NewsletterController::class, 'submit'])->name('newsletter_submit');
    Route::get('/email-ajoutee', [NewsletterController::class, 'result'])->name('newsletter_email_added');
});

// VEHICULES
Route::prefix('vehicule')->group(function(){
    Route::get('/marques', [VehicleController::class, 'brands'])->name('vehicle_brands');
    Route::get('/modeles', [VehicleController::class, 'models'])->name('vehicle_models');
});

// AVIS
Route::prefix('avis')->group(function(){
    Route::get('/', [ReviewController::class, 'index'])->name('review_index');
    Route::get('/donner/{reservation}', [ReviewController::class, 'add'])->name('review_add');
    Route::post('/soumettre', [ReviewController::class, 'submit'])->name('review_submit');
    Route::get('/soumis/{reservation}', [ReviewController::class, 'complete'])->name('review_complete');
});

// CRON
Route::prefix('cron')->group(function(){
    Route::get('/commissions', [CronController::class, 'commissions'])->name('cron_commissions');
    Route::get('/avis', [CronController::class, 'reviews'])->name('cron_reviews');
});

// FRONT OFFICE PAGE
Route::get('/long-trajet/{distance?}', [HomeController::class, 'longTrajet'])->name('long_trajet');
Route::get('/trajet-quotidien/{distance?}', [HomeController::class, 'trajetQuotidien'])->name('trajet_quotidien');
Route::get('/trouver-un-trajet', [HomeController::class, 'rechercherTrajet'])->name('trouver_trajet');
Route::get('/actualites', [HomeController::class, 'listPage'])->name('blog_pages');
Route::get('/{slug}', [HomeController::class, 'staticPage'])->name('static_pages');
