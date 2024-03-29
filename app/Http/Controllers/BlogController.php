<?php

namespace App\Http\Controllers;

use App\Models\Managers\PostManager;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index() : View {
        $pages = Page::where('page_status_id', '=', 1)
        ->where('page_category_id', '!=', 1)
        ->orderBy('id', 'DESC')
        ->paginate(50);

        return view('admin.blogs.index', ['pages' => $pages]);
    }

    public function createNew(Request $request) {
        if($request->getMethod() != Request::METHOD_POST) {

            return view('admin.blogs.new');
        }

        $title = substr(trim($request->input('title', uniqid('article-'))), 0, 254);
        $slug = PostManager::getValidSlug(Str::slug($title, '-', 'fr'));

        $page = Page::create([
            'title' => $title,
            'slug' => $slug,
            'description' => substr(trim($request->input('description', '...')), 0, 254),
            'content' => $request->input('content', '<p></p>'),
            'page_status_id'=> 1,
            'page_category_id' => 2,
            'preview_image' => '',
            'author_id' => auth()->user()->id,
        ]);

        session()->flash('success', 'Nouvel article enregistré avec succès');

        return response()->redirectToRoute('admin_blog_edit', ['page' => $page,]);
    }

    public function edit(Request $request, Page $page) {
        if($request->getMethod() != Request::METHOD_POST) {

            return view('admin.blogs.edit', ['page' => $page]);
        }
        // verify slug
        $title = substr(trim($request->input('title', uniqid('article-'))), 0, 254);
        $slug = PostManager::getValidSlug(Str::slug($title, '-', 'fr'), 2, $page->id);

        $page->title = $title;
        if(!$page->title) $page->title = 'Article ' . uniqid();
        $page->slug = $slug;
        $page->description = substr(trim($request->input('description', '...')), 0, 254);
        $page->content = $request->input('content', '<p></p>');

        $page->save();

        session()->flash('success', 'Article mis à jour avec succès');

        return response()->redirectToRoute('admin_blog_edit', ['page' => $page]);
    }

    public function archive(Page $page) : RedirectResponse {
        $page->page_status_id = 3;
        $page->save();

        session()->flash('success', 'Article archivé');

        return response()->redirectToRoute('admin_blog_index');
    }

}
