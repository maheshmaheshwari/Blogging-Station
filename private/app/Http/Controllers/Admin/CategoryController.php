<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_categories = Category::pluck('name', 'id');

        return view('admin.categories.create', [
            'all_categories' => $all_categories,
        ]);
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
            'parent_id',
            'name',
            'slug',
            'status',
            'description',
            'color',
            'seo',
        ]);

        if (isset($data['slug']) && !empty($data['slug'])) {
            $data['slug'] = Category::createSlug(Category::class, $data['slug']);
        } else {
            $data['slug'] = Category::createSlug(Category::class, $data['name']);
        }

        $data['description'] = Category::purify($data['description']);

        $validator = Validator::make($data, [
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'seo' => [
                'nullable',
                'array',
            ],
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.categories.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $category = Category::create($data);

        \Cache::forget('homepage');

        session()->flash('message', 'Category added.');

        return redirect()->route('admin.categories.edit', [$category->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::pluck('name', 'id');

        return view('admin.categories.edit', [
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->only([
            'parent_id',
            'name',
            'slug',
            'status',
            'description',
            'color',
            'seo',
        ]);

        if (isset($data['slug']) && !empty($data['slug'])) {
            $data['slug'] = Category::createSlug(Category::class, $data['slug'], $category->id);
        } else {
            $data['slug'] = Category::createSlug(Category::class, $data['name'], $category->id);
        }

        $data['description'] = Category::purify($data['description']);

        $validator = Validator::make($data, [
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
            'seo' => [
                'nullable',
                'array',
            ],
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.categories.edit', [$category->id]))
                ->withErrors($validator)
                ->withInput();
        }

        /*
        if (empty($data['parent_id'])) {
            $data['parent_id'] = 0;
        }
        */

        $category->update($data);

        \Cache::forget('homepage');

        session()->flash('message', 'The category updated.');

        return redirect(route('admin.categories.edit', [$category->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            $category->articles()->detach();
        } else {
            session()->flash('message', 'Unable to delete this article.');
        }

        return redirect(route('admin.categories.index'));
    }
}
