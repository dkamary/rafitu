<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function submit(Request $request) : RedirectResponse {
        $contactMessage = ContactMessage::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'is_read' => 0,
            'sent_date' => date('Y-m-d H:i:s'),
        ]);

        session()->flash('success', 'Votre message a été enregistré');

        return response()->redirectToRoute('contact_confirmation');
    }

    public function confirmation() : View {
        return view('pages.contact-confirmation');
    }
}
