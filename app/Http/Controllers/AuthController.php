<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserStatus;
use App\Models\UserType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('pages.security.login');
    }

    public function authNormal(Request $request)
    {
        $email = trim($request->input('email'));
        $password = $request->input('password');
        $user = User::where('email', 'LIKE', $email)->first();
        if (!$user) {
            return back()
                ->with('error', 'L\'adresse email est introuvable')
                ->withInput();
        }

        if(!Auth::attempt(['email' => $email, 'password' => $password])) {
            if($request->hasHeader('x-login-source')) {

                return response()->json([
                    'authentified' => false,
                ]);
            }

            return back()
                ->with('error', 'Le mot de passe est incorrect')
                ->withInput();
        }

        $user = Auth::user();
        Auth::login($user);

        if($request->hasHeader('x-login-source')) {

            return response()->json([
                'authentified' => true,
            ]);
        }

        /**
         * @var User $user
         */
        $userType = $user->getUserType();
        if($userType->isAdmin()) {

            return response()->redirectToIntended(route('admin'));
        }

        return response()->redirectToIntended(route('home'));
    }

    public function oauthSuccess(): Response
    {
        return new Response('Success');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        session()->flash('success', 'Vous êtes maintenant déconnecté!');

        return response()->redirectToRoute('home');
    }

    public function register(): View
    {
        return view('pages.security.register');
    }

    public function createNewUser(Request $request): RedirectResponse
    {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $mobile = $request->input('mobile');

        $errors = [];

        if (filter_var(trim($email), FILTER_VALIDATE_EMAIL) == false) {
            $errors[] = 'Votre adresse n\'est pas valide!';
        }

        if (strlen(trim($firstname)) < 2) {
            $errors[] = 'Votre prénom est trop court!';
        }

        if (strlen(trim($lastname)) < 2) {
            $errors[] = 'Votre nom est trop court!';
        }

        if(strlen(trim($mobile)) < 2) {
            $errors[] = 'Votre numéro de téléphone est trop court!';
        }

        if ($errors != []) {
            session()->flash('errors', $errors);

            return back()->withInput([
                'firstname' => $firstname,
                'lastname' => $lastname,
            ]);
        }

        $userStatus = UserStatus::where('id', '=', 3)->first();
        if (!$userStatus) {
            $userStatus = UserStatus::where('id', '=', 1)->first();
            if (!$userStatus) {
                $userStatus = UserStatus::create(['label', 'Actif']);
            }
        }

        $user = new User([
            'email' => $email,
            'login' => $email,
            'password' => bcrypt($password),
            'firstname' => $firstname,
            'lastname' => $lastname,
            'user_type_id' => $this->getUserType()->id,
            'user_status_id' => $this->getUserStatus()->id,
            'mobile' => $mobile,
        ]);
        $user->save();
        $user->token = $this->generateToken($user);
        $user->save();

        $this->sendEmailVerification($user);

        return response()->redirectToRoute('user_created_confirm_email', ['email' => $user->email,]);
    }

    public function userCreatedConfirmEmail($email): View
    {
        $user = User::where('email', 'LIKE', $email)->first();

        return view('pages.security.user-created-confirm-email', [
            'user' => $user,
        ]);
    }

    public function confirmEmail(string $email, string $token): View
    {
        $user = User::where('email', 'LIKE', $email)->first();
        $validate = false;
        $error = null;

        if (!$user) {
            $validate = false;
            $error = sprintf('L\'utilisateur avec l\'adresse email `%s` est introuvable!', $email);

            return view('pages.user-validated', [
                'user' => $user,
                'error' => $error,
            ]);
        }

        $validate = $this->validateToken($user, $token);
        if ($validate) {
            $userStatus = UserStatus::where('id', '=', 1)->first();
            if (!$userStatus) $userStatus = UserStatus::create(['label' => 'Actif', 'is_active' => 1]);
            $user->user_status_id = (int)$userStatus->id;
            $user->save();
        } else {
            $error = 'Impossible de valider votre email. Veuillez vérifier cliquer à nouveau sur le lien dans votre email';
        }

        return view('pages.security.user-validated', [
            'user' => $user,
            'error' => $error,
            'validate' => $validate,
        ]);
    }

    public function forgot(Request $request) : View {
        $email = $request->input('email');
        if(!$email) {
            return view('pages.password-forgotten', [
                'email' => null,
                'message' => null,
                'error' => false,
            ]);
        }

        $user = User::where('email', 'LIKE', $email)->first();
        if(!$user) {
            return view('pages.password-forgotten', [
                'email' => $email,
                'message' => 'Cet adresse email n\'a pas été trouvé dans notre base de données',
                'error' => true,
            ]);
        }

        // envoie de notificiation
        $user->token = $this->generateToken($user);
        $user->save();
        $this->sendEmailReset($user);

        return view('pages.password-forgotten', [
            'email' => $email,
            'message' => 'Email de réinitialisation de mot de passe envoyé',
            'error' => false,
        ]);
    }

    public function reset(Request $request, string $email, string $token) : View {
        $user = User::where('email', 'LIKE', $email)->first();
        if(!$user) {

            return view('pages.security.password-reset', [
                'user' => $user,
                'email' => $email,
                'token' => $token,
                'done' => false,
                'error' => true,
                'message' => sprintf('L\'utilisateur avec l\'adresse email `%s` est introuvable!', $email),
            ]);
        }

        if($user->token != $token) {

            return view('pages.password-reset', [
                'user' => $user,
                'done' => false,
                'error' => true,
                'message' => 'Le token fourni n\'est pas correct!<br> Veuillez cliquer à nouveau le lien dans le mail de réinitialisation!',
            ]);
        }

        if($request->input('action') != 'reset') {

            return view('pages.security.password-reset', [
                'user' => $user,
                'done' => false,
                'error' => false,
            ]);
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return view('pages.security.password-reset', [
            'user' => $user,
            'done' => true,
            'error' => false,
        ]);
    }

    /**
     * Get User Type
     *
     * @return UserType
     */
    private function getUserType(): UserType
    {
        $userType = UserType::where('id', '=', 4)->first();
        if (!$userType) {
            $userType = UserType::create([
                'label' => 'Passager',
            ]);
        }

        return $userType;
    }

    /**
     * Get User Status
     *
     * @return UserStatus
     */
    private function getUserStatus(): UserStatus
    {
        $userStatus = UserStatus::where('id', '=', 3)->first();
        if (!$userStatus) {
            $userStatus = UserStatus::where('id', '=', 1)->first();
            if (!$userStatus) {
                $userStatus = UserStatus::create(['label', 'Actif']);
            }
        }

        return $userStatus;
    }

    /**
     * Send email verification
     *
     * @param User $user
     * @return void
     */
    private function sendEmailVerification(User $user): void
    {
        $subject = '[RAFITU] - Confirmer votre inscription';
        $content = view('templates.emails.email-validation', [
            'user' => $user,
        ])->render();

        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type:text/html;charset=UTF-8 \r\n";
        $headers .= "From: RAFITU <noreply@rafitu.com> \r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion() ."\r\n";

        mail($user->email, $subject, $content, $headers);
    }

    /**
     * Send email reset
     *
     * @param User $user
     * @return void
     */
    private function sendEmailReset(User $user) : void {
        $subject = '[RAFITU] - Réinitialiser votre mot de passe';
        $content = view('templates.emails.email-reset', [
            'user' => $user,
        ])->render();

        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type:text/html;charset=UTF-8 \r\n";
        $headers .= "From: RAFITU <noreply@rafitu.com> \r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion() ."\r\n";

        mail($user->email, $subject, $content, $headers);
    }

    /**
     * Generate token
     *
     * @param User $user
     * @return string
     */
    private function generateToken(User $user): string
    {
        $md5 = md5($user->id . '-' . $user->email);

        return $md5;
    }

    /**
     * Validate token
     *
     * @param User $user
     * @param string $token
     * @return boolean
     */
    private function validateToken(User $user, string $token): bool
    {
        return $this->generateToken($user) == $token;
    }

    // private function generateToken(int $length = 50) : string {
    //     $dico = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@%$';

    //     return substr(str_shuffle($dico), 0, $length);
    // }
}
