<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editor()
    {
        $data = request()->only([
            'file',
        ]);

        $validator = Validator::make($data, [
            'file' => 'mimes:gif,jpg,jpeg,png|max:' . get_option('fileupload_max'),
        ]);

        if ($validator->fails()) {
            return response()->json("HTTP/1.1 400 Invalid file type.");
        }

        /**
         * @var \App\File|null $file
         */
        $file = \App\Helpers\Upload::process('file');

        if ($file) {
            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            return response()->json(['location' => asset($file->file)]);
        } else {
            // Notify editor that the upload failed
            return response()->json("HTTP/1.1 500 Server Error");
        }
    }
}
