<?php

namespace App\Http\Controllers\Admin;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends AdminController
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

        $files = File::where($conditions)
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate(20);

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('admin.files.index', [
            'files' => $files,
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
        return view('admin.files.create');
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
            'file',
        ]);

        $validator = Validator::make($data, [
            'file' => ['required', 'mimes:' . get_option('upload_filetypes'), 'max:' . get_option('fileupload_max')],
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.files.create'))
                ->withErrors($validator)
                ->withInput();
        }

        /**
         * @var \App\File|null $file
         */
        $file = \App\Helpers\Upload::process('file');

        if ($file) {
            session()->flash('success', 'File has been uploaded successfully.');

            return redirect()->route('admin.files.edit', [$file->id]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('admin.files.edit', [
            'file' => $file,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\File $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $data = $request->only([
            'name',
        ]);

        $validator = Validator::make($data, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.files.edit', [$file->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $file->update($data);

        session()->flash('success', 'File has been updated successfully.');

        return redirect(route('admin.files.edit', [$file->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File $file
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(File $file)
    {
        if ($file->delete()) {
            $file_path = public_path($file->file);

            $file_info = pathinfo($file_path);

            @unlink($file_path);

            array_map(
                'unlink',
                (array)@glob($file_info['dirname'] . DS . $file_info['filename'] . "-*." . $file_info['extension'])
            );

            session()->flash('success', __('File has been deleted successfully.'));
        } else {
            session()->flash('danger', __('Unable to delete this file.'));
        }

        return redirect()->route('admin.files.index');
    }
}
