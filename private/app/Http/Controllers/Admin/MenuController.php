<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Menu;
use App\Page;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::pluck('name', 'id');

        $menu_id = request()->get('menu_id');

        if ($menu_id) {
            $menu = Menu::find($menu_id);

            $pages = Page::whereStatus(1)->pluck('title', 'id');
            $categories = Category::whereStatus(1)->pluck('name', 'id');
            $tags = Tag::whereStatus(1)->pluck('name', 'id');
            $authors = User::whereStatus(1)->pluck('name', 'id');
        }

        return view('admin.menus.index', [
            'menus' => $menus,
            'menu_id' => $menu_id,
            'menu' => (isset($menu)) ? $menu : null,
            'pages' => (isset($pages)) ? $pages : null,
            'categories' => (isset($categories)) ? $categories : null,
            'tags' => (isset($tags)) ? $tags : null,
            'authors' => (isset($authors)) ? $authors : null,
        ]);
    }

    public function addMenuItem(Request $request)
    {
        $data = $request->only([
            'menu_id',
            'title',
            'type',
        ]);

        $menu_types = Menu::itemTypes();

        $validator = Validator::make($data, [
            'menu_id' => 'required',
            'title' => 'required',
            'type' => ['required', 'in:' . implode(',', array_keys($menu_types))],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $menu = Menu::find($data['menu_id']);

        $items = $menu->items;

        $items[] = [
            'id' => 'm_' . uniqid(),
            'type' => $data['type'],
            'position' => count($menu->items) + 1,
            'title' => $data['title'],
            'class' => '',
        ];

        $menu->items = $items;

        $menu->save();

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

        $menu = new Menu();

        $menu->name = $data['name'];
        $menu->items = [];

        $menu->save();

        return redirect()->route('admin.menus.index', ['menu_id' => $menu->id]);
    }

    /**
     * Edit the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Menu $menu)
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

        $menu->name = $data['name'];

        $items = [];

        if (isset($data['item'])) {
            foreach ($data['item'] as $item) {
                /*
                $items[] = [
                    'id'       => $item['id'],
                    'position' => (int)$item['position'],
                    'title'    => (string)$item['title'],
                    'class'    => (string)$item['class'],
                    'type'     => $item['type'],
                ];
                */
                $items[] = $item;
            }
        }

        $menu->items = $items;

        $menu->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index');
    }
}
