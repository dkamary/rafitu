<?php

namespace App\Http\Controllers;

use App\Models\Managers\PostManager;
use App\Models\Page;
use App\Models\PageCategory;
use App\Models\PageStatus;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostAdminController extends Controller
{
    public function index(int $pageStatus = PageStatus::PUBLIEE) : View {
        $posts = Page::where('page_status_id', '=', $pageStatus)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
        $status = PageStatus::where('is_active', '=', 1)->get();

        return view('', [
            'posts' => $posts,
            'status' => $status,
        ]);
    }

    public function create() : View {
        $status = PageStatus::where('is_active', '=', 1)->get();
        $page = new Page();

        return view('', [
            'page' => $page,
            'status' => $status,
        ]);
    }

    public function edit(Page $page) : View {
        $status = PageStatus::where('is_active', '=', 1)->get();

        return view('', [
            'page' => $page,
            'status' => $status,
        ]);
    }

    public function save(Request $request) {
        $page = Page::where('id', '=', (int)$request->input('id'))->first();
        $isNew = false;
        if(!$page) {
            $page = new Page();
            $page->created_at = date('Y-m-d H:i:s');
            $isNew = true;
        }
        $page->slug = $request->input('xxx');
        $page->title = $request->input('title');
        $page->description = $request->input('description');
        $page->content = $request->input('content');
        $page->page_category_id = PageCategory::BLOG;
        $page->author_id = $request->input('author_id');
        $page->page_status_id = (int)$request->input('page_status_id');
        $page->updated_at = date('Y-m-d H:i:s');
        $page->save();

        $isUpdated = false;
        if($imgPreview = PostManager::manageUpload($request, 'preview_image', $page)) {
            $page->preview_image = $imgPreview;
            $isUpdated = true;
        }

        if($isUpdated) {
            $page->save();
        }

        if($request->isXmlHttpRequest()) {

            return response()->json([
                'done' => true,
                'page' => [
                    'title' => $page->title,
                    'slug' => $page->slug,
                    'description' => $page->description,
                ],
                'message' => sprintf('Page % avec succès', $isNew ? 'créée' : 'mis à jour'),
            ]);
        }

        session()->flash('success', sprintf('Page % avec succès', $isNew ? 'créée' : 'mis à jour'));

        return response()->redirectToRoute('admin_post_index');
    }

    public function changeStatus(Page $page, int $pageStatus) {
        $page->page_status_id = $pageStatus;
        $page->save();

        if(request()->isXmlHttpRequest()) {

            return response()->json([
                'done' => true,
                'page' => [
                    'title' => $page->title,
                    'slug' => $page->slug,
                    'description' => $page->description,
                ],
                'message' => 'Le status de la page a changé',
            ]);
        }

        session()->flash('success', 'Le status de la page a changé');

        return response()->redirectToRoute('admin_post_index');
    }
}
