<?php

namespace App\Http\Controllers\Admin;

use App\Option;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends AdminController
{
    public function homepage()
    {
        $homepage = Option::where('name', 'homepage')->first();

        return view('admin.pages.homepage', [
            'homepage' => $homepage->value,
        ]);
    }

    public function homepageStore()
    {
        $homepage = Option::where('name', 'homepage')->first();

        $homepage->value = request()->post('homepage');

        $homepage->update();

        \Cache::forget('homepage');

        session()->flash('message', __('Homepage content has been saved.'));
        return redirect()->route('admin.pages.homepage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = [];

        if (request()->input('Filter')) {
            $filter_fields = [
                'title',
                'slug',
                'status',
            ];

            foreach (request()->input('Filter') as $param_name => $param_value) {
                if (!$param_value) {
                    continue;
                }
                //$value = urldecode($value);
                if (in_array($param_name, $filter_fields)) {
                    $like_params = ['title', 'slug'];

                    if (in_array($param_name, $like_params)) {
                        $conditions[] = [$param_name, 'like', '%' . $param_value . '%'];
                    } else {
                        $conditions[] = [$param_name, '=', $param_value];
                    }
                }
            }
        }

        $orderBy = [
            'col' => request()->input('order', 'id'),
            'dir' => request()->input('dir', 'desc'),
        ];

        $pages = Page::query()
            ->where($conditions)
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate();

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('admin.pages.index', [
            'pages' => $pages,
            'orderBy' => $orderBy,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'slug',
            'content',
            'status',
        ]);

        if (isset($data['slug']) && !empty($data['slug'])) {
            $data['slug'] = Page::createSlug(Page::class, $data['slug']);
        } else {
            $data['slug'] = Page::createSlug(Page::class, $data['title']);
        }

        $data['content'] = Page::purify($data['content'], [
            //'AutoFormat.AutoParagraph' => false
        ]);

        $validator = Validator::make($data, [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'nullable',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.pages.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $page = Page::create($data);

        if ($page->id) {
            session()->flash('message', __('Page added.'));
        }

        return redirect(route('admin.pages.edit', [$page->id]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', [
            'page' => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->only([
            'title',
            'slug',
            'content',
            'status',
        ]);

        if (isset($data['slug']) && !empty($data['slug'])) {
            $data['slug'] = Page::createSlug(Page::class, $data['slug'], $page->id);
        } else {
            $data['slug'] = Page::createSlug(Page::class, $data['title'], $page->id);
        }

        /*
        $data['content'] = Page::purify($data['content'], [
            'AutoFormat.AutoParagraph' => false
        ]);
        */

        $validator = Validator::make($data, [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'nullable',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.pages.edit', [$page->id]))
                ->withErrors($validator)
                ->withInput();
        }

        if ($page->update($data)) {
            session()->flash('message', __('Page updated.'));
        }

        return redirect(route('admin.pages.edit', [$page->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page $page
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();
        session()->flash('message', 'Unable to delete this page.');

        return redirect(route('admin.pages.index'));
    }
}
