<?php

namespace App\Http\Controllers\Admin;

use App\Ad;
use App\Category;
use App\Page;
use App\Sidebar;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SidebarController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sidebars = Sidebar::pluck('name', 'id');

        $sidebar_id = request()->get('sidebar_id');

        $widget_types = Sidebar::widgetTypes();

        if ($sidebar_id) {
            $sidebar = Sidebar::find($sidebar_id);

            $pages = Page::whereStatus(1)->pluck('title', 'id');
            $categories = Category::whereStatus(1)->pluck('name', 'id');
            $tags = Tag::whereStatus(1)->pluck('name', 'id');
            $authors = User::whereStatus(1)->pluck('name', 'id');
            $ads = Ad::whereStatus(1)->pluck('name', 'id');
        }

        return view('admin.sidebars.index', [
            'sidebars' => $sidebars,
            'sidebar_id' => $sidebar_id,
            'widget_types' => $widget_types,
            'sidebar' => (isset($sidebar)) ? $sidebar : null,
            'pages' => (isset($pages)) ? $pages : null,
            'categories' => (isset($categories)) ? $categories : null,
            'tags' => (isset($tags)) ? $tags : null,
            'authors' => (isset($authors)) ? $authors : null,
            'ads' => (isset($ads)) ? $ads : null,
        ]);
    }

    public function addWidget(Request $request)
    {
        $data = $request->only([
            'sidebar_id',
            'title',
            'type',
        ]);

        $widget_types = Sidebar::widgetTypes();

        $validator = Validator::make($data, [
            'sidebar_id' => 'required',
            'title' => 'required',
            'type' => ['required', 'in:' . implode(',', array_keys($widget_types))],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sidebar = Sidebar::find($data['sidebar_id']);

        $widgets = $sidebar->widgets;

        $widgets[] = [
            'id' => 'w_' . uniqid(),
            'position' => count($sidebar->widgets) + 1,
            'title' => $data['title'],
            'class' => '',
            'type' => $data['type'],
        ];

        $sidebar->widgets = $widgets;

        $sidebar->save();

        return redirect()->back();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->only(['name']);

        $validator = Validator::make($data, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sidebar = new Sidebar();

        $sidebar->name = $data['name'];
        $sidebar->widgets = [];

        $sidebar->save();

        return redirect()->route('admin.sidebars.index', ['sidebar_id' => $sidebar->id]);
    }

    /**
     * Edit the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Sidebar $sidebar
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Sidebar $sidebar)
    {
        $data = $request->only(['name', 'item']);

        $validator = Validator::make($data, [
            'name' => 'required',
            'item' => 'array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sidebar->name = $data['name'];

        $widgets = [];

        if (isset($data['item'])) {
            foreach ($data['item'] as $widget) {
                /*
                $widgets[] = [
                    'id'       => $widget['id'],
                    'position' => (int)$widget['position'],
                    'title'    => (string)$widget['title'],
                    'class'    => (string)$widget['class'],
                    'type'     => $widget['type'],
                ];
                */
                $widgets[] = $widget;
            }
        }

        $sidebar->widgets = $widgets;

        $sidebar->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sidebar $sidebar
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Sidebar $sidebar)
    {
        $sidebar->delete();

        return redirect()->route('admin.sidebars.index');
    }
}
