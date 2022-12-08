<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function save(Request $request) : RedirectResponse {
        $id = (int)$request->input('id');
        $faq = Faq::where('id', '=', $id)->first();
        if(!$faq) {
            $faq = Faq::create([
                'question' => $request->input('question'),
                'answer' => $request->input('answer'),
                'rank' => $request->input('rank'),
            ]);

            return response()->redirectToRoute('pages_faq');

            return response()->json([
                'done' => true,
                'message' => 'Nouveau FAQ ajouté',
                'faq' => $faq,
                'insert' => true,
                'update' => false,
            ]);
        }

        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');
        $faq->rank = $request->input('rank');
        $faq->save();

        return response()->redirectToRoute('pages_faq');

        return response()->json([
            'done' => true,
            'message' => 'FAQ mis à jour',
            'faq' => $faq,
            'insert' => false,
            'update' => true,
        ]);
    }

    public function refresh() : View {
        return view('');
    }

    public function remove(Faq $faq) : RedirectResponse {
        $faq->remove();

        session()->flash('success', 'FAQ effacé');

        return response()->redirectToRoute('pages_faq');
    }
}
