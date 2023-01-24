<?php

namespace App\Http\Controllers;

use App\Models\NewsletterEmail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class NewsletterController extends Controller
{
    public function submit(Request $request) : RedirectResponse {
        // récupérer l'email
        $email = $request->input('email');
        if(!$email) {
            session()->flash('warning', "L'adresse email `<strong>$email</strong>` n'a pas été trouvé !");

            return response()->redirectToRoute('newsletter_email_added');
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            session()->flash('warning', "L'adresse email `<strong>$email</strong>` est malformé !");

            return response()->redirectToRoute('newsletter_email_added');
        }

        // vérifier si l'email existe
        $email = trim($email);
        $newsletterEmail = NewsletterEmail::where('email', 'like', $email)->first();
        if($newsletterEmail) {
            session()->flash('success', "L'adresse email `<strong>$email</strong>` est déjà enregistrée dans notre base de données !");

            return response()->redirectToRoute('newsletter_email_added');
        }

        // Si l'email n'existe pas alors
        // créer une instance de Newsletter email
        $newsletterEmail = NewsletterEmail::create([
            'email' => $email,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        session()->flash('success', "Votre adresse email `<strong>$email</strong>` a bien été ajoutée à notre base de données !");

        return response()->redirectToRoute('newsletter_email_added');
    }

    public function result() : View {
        return view('newsletter.result', [
            'pageTitle' => 'Inscription à la newsletter',
        ]);
    }
}
