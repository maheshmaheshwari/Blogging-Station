<?php

namespace App\Http\Controllers\Admin;

use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdController extends AdminController
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
            ];

            foreach (request()->input('Filter') as $param_name => $param_value) {
                if (!$param_value) {
                    continue;
                }
                //$value = urldecode($value);
                if (in_array($param_name, $filter_fields)) {
                    $like_params = ['name'];

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

        $ads = Ad::where($conditions)
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate(20);

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('admin.ads.index', [
            'ads' => $ads,
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
        return view('admin.ads.create');
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
            'status',
            'code',
        ]);

        $validator = Validator::make($data, [
            'name' => 'required',
            'status' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.ads.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $ad = Ad::create($data);

        session()->flash('message', 'Add added.');

        return redirect(route('admin.ads.edit', [$ad->id]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', [
            'ad' => $ad,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        $data = $request->only([
            'name',
            'status',
            'code',
        ]);

        $validator = Validator::make($data, [
            'name' => 'required',
            'status' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.ads.edit', [$ad->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $ad->update($data);

        session()->flash('success', 'The ad updated.');

        return redirect(route('admin.ads.edit', [$ad->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad $ad
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Ad $ad)
    {
        if ($ad->delete()) {
            session()->flash('success', __('Ad deleted.'));
        } else {
            session()->flash('danger', 'Unable to delete this ad.');
        }

        return redirect(route('admin.ads.index'));
    }
}
