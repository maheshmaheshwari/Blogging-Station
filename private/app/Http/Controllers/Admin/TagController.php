<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = [];

        if (null !== request()->input('Filter')) {
            $filter_fields = [
                'name',
                'slug',
            ];

            foreach (request()->input('Filter') as $param_name => $param_value) {
                if (!$param_value) {
                    continue;
                }
                //$value = urldecode($value);
                if (in_array($param_name, $filter_fields)) {
                    $like_params = ['name', 'slug'];

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

        $tags = Tag::where($conditions)
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate(20);

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('admin.tags.index', [
            'tags' => $tags,
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
        return view('admin.tags.create');
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
            'name',
            'slug',
            'status',
            'description',
            'seo',
        ]);

        if (isset($data['slug']) && !empty($data['slug'])) {
            $data['slug'] = Tag::createSlug(Tag::class, $data['slug']);
        } else {
            $data['slug'] = Tag::createSlug(Tag::class, $data['name']);
        }

        $data['description'] = Tag::purify($data['description']);

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
            return redirect(route('admin.tags.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $tag = Tag::create($data);

        \Cache::forget('homepage');

        session()->flash('message', 'Tag added.');

        return redirect(route('admin.tags.edit', [$tag->id]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->only([
            'name',
            'slug',
            'status',
            'description',
            'seo',
        ]);

        if (isset($data['slug']) && !empty($data['slug'])) {
            $data['slug'] = Tag::createSlug(Tag::class, $data['slug'], $tag->id);
        } else {
            $data['slug'] = Tag::createSlug(Tag::class, $data['name'], $tag->id);
        }

        $data['description'] = Tag::purify($data['description']);

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
            return redirect(route('admin.tags.edit', [$tag->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $tag->update($data);

        \Cache::forget('homepage');

        session()->flash('message', 'The tag updated.');

        return redirect(route('admin.tags.edit', [$tag->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        if ($tag->delete()) {
            $tag->articles()->detach();
        } else {
            session()->flash('message', 'Unable to delete this tag.');
        }

        return redirect(route('admin.tags.index'));
    }
}
