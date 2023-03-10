<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index() : View {
        $type = request()->input('type');
        $builder = Review::where('id', '>', 0);
        if($type && $type == 'todo') {
            $builder->where('is_active', '=', 2);
        } elseif($type && $type == 'deactivated') {
            $builder->where('is_active', '=', 0);
        }
        $reviews = $builder
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('admin.review.index', [
            'reviews' => $reviews,
        ]);
    }

    public function show(Review $review) : View {

        return view('admin.review.show', [
            'review' => $review,
        ]);
    }

    public function validation(Request $request) {
        $review = Review::where('id', '=', (int)$request->input('id'))->first();
        if(!$review) {
            if(!$request->isXmlHttpRequest()) {
                session()->flash('warning', 'Commentaire introuvable!');

                return response()->redirectToRoute('admin_review_index');
            }

            return response()->json([
                'done' => true,
                'message' => 'Commentaire introuvable!',
            ]);
        }

        $review->is_active = 1;
        $review->save();

        if($request->isXmlHttpRequest()) {

            return response()->json([
                'done' => true,
                'message' => 'Commentaire validé',
                'review' => $review,
            ]);
        }

        session()->flash('success', 'Commentaire validé');

        return response()->redirectToRoute('admin_review_index');
    }

    public function deactivate(Request $request) {
        $review = Review::where('id', '=', (int)$request->input('id'))->first();
        if(!$review) {
            if(!$request->isXmlHttpRequest()) {
                session()->flash('warning', 'Commentaire introuvable!');

                return response()->redirectToRoute('admin_review_index');
            }

            return response()->json([
                'done' => true,
                'message' => 'Commentaire introuvable!',
            ]);
        }

        $review->is_active = 0;
        $review->save();

        if($request->isXmlHttpRequest()) {

            return response()->json([
                'done' => true,
                'message' => 'Commentaire désactivé',
                'review' => $review,
            ]);
        }

        session()->flash('success', 'Commentaire désactivé');

        return response()->redirectToRoute('admin_review_index');
    }
}
