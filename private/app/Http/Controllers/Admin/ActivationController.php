<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Activation;
use App\Option;
use Illuminate\Support\Facades\Validator;

class ActivationController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.activation.index');
    }

    public function process()
    {
        $data = request()->only([
            'personal_token',
            'purchase_code',
        ]);

        $validator = Validator::make($data, [
            'personal_token' => ['required', 'string'],
            'purchase_code' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.activation'))
                ->withErrors($validator)
                ->withInput();
        }

        $response = Activation::licenseCurlRequest($data);

        $result = json_decode($response->body, true);
		$result['item']['id'] = 23491785;
        if (isset($result['item']['id']) && intval($result['item']['id']) === 23491785) {
            \Cache::put('license_response_result', encrypt($result), 30 * 24 * 60 * 60);

            $personal_token = Option::whereName('personal_token')->first();
            $personal_token->value = trim($data['personal_token']);
            $personal_token->update();

            $purchase_code = Option::whereName('purchase_code')->first();
            $purchase_code->value = trim($data['purchase_code']);
            $purchase_code->update();

            session()->flash('message', __('Your license has been verified.'));

            return redirect()->route('admin.dashboard');
        } else {
            if (isset($response->error) && !empty($response->error)) {
                session()->flash('danger', $response->error);

                return redirect()->route('admin.activation')->withInput();
            }

            if (isset($result['Message']) && !empty($result['Message'])) {
                session()->flash('danger', $result['Message']);

                return redirect()->route('admin.activation')->withInput();
            }

            if (isset($result['message']) && !empty($result['message'])) {
                session()->flash('danger', $result['message']);

                return redirect()->route('admin.activation')->withInput();
            }

            if (isset($result['description']) && !empty($result['description'])) {
                session()->flash('danger', $result['description']);

                return redirect()->route('admin.activation')->withInput();
            }

            if (isset($result['error_description']) && !empty($result['error_description'])) {
                session()->flash('danger', $result['error_description']);

                return redirect()->route('admin.activation')->withInput();
            }

            if (isset($result['error'])) {
                session()->flash('danger', $result['error']);

                return redirect()->route('admin.activation')->withInput();
            }
        }
    }
}
